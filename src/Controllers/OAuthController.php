<?php

declare(strict_types=1);

/**
 * This file is part of Shield OAuth.
 *
 * (c) Datamweb <pooya_parsa_dadashi@yahoo.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Datamweb\ShieldOAuth\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\LoginModel;
use Datamweb\ShieldOAuth\Libraries\Basic\ControllersInterface;

class OAuthController extends BaseController implements ControllersInterface
{
    private const ACCESS_DENIED = 'access_denied';

    public function redirectOAuth(string $oauthName): RedirectResponse
    {
        // if user login
        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->loginRedirect());
        }

        if (config('ShieldOAuthConfig')->oauthConfigs[$oauthName]['allow_login'] === false) {
            $errorText = 'ShieldOAuthLang.' . ucfirst($oauthName) . '.not_allow';

            return redirect()->to(config('Auth')->logoutRedirect())->with('error', lang($errorText));
        }

        session()->set('oauth_name', $oauthName);

        // Loading the class according to oauthName choices
        $oauthClass = service('ShieldOAuth')::setOAuth($oauthName);

        // Run anti forgery
        $state = $this->makeAntiForgeryKey();

        $redirectLink = $oauthClass->makeGoLink($state);

        return redirect()->to($redirectLink);
    }

    public function callBack(): RedirectResponse
    {
        // if user after callback request url
        if (! session('oauth_name')) {
            return redirect()->to(config('Auth')->logoutRedirect())->with('error', lang('ShieldOAuthLang.Callback.oauth_class_not_set'));
        }
        $allGet = $this->request->getGet();

        // if permission is denied or was cancelled by user.
        if (isset($allGet['error']) && $allGet['error'] === self::ACCESS_DENIED) {
            return redirect()->to(config('Auth')->logoutRedirect())->with('error', lang('ShieldOAuthLang.Callback.access_denied'));
        }

        // if api have error
        if (isset($allGet['error'])) {
            return redirect()->to(config('Auth')->logoutRedirect())->with('error', lang('ShieldOAuthLang.unknown'));
        }
        // Loading the class according to oauthName choices
        $oauthName  = session()->get('oauth_name');
        $oauthClass = service('ShieldOAuth')::setOAuth($oauthName);

        // check request is Forgery
        if ($this->checkAntiForgery($allGet['state']) === false) {
            return redirect()->to(config('Auth')->logoutRedirect())->with('error', lang('ShieldOAuthLang.Callback.anti_forgery'));
        }

        // Delete to prevent reuse
        session()->remove(['state', 'oauth_name']);

        $userInfo = $oauthClass->getUserInfo($allGet);

        $find = ['email' => $userInfo->email];

        if ($this->checkExistenceUser($find)) {
            $updateFields = $oauthClass->getColumnsName('syncingUserInfo', $userInfo);

            $userid = $this->syncingUserInfo($find, $updateFields);
        }

        // Create new user if credentials not exist or let users register themselves
        if ($this->checkExistenceUser($find) === false) {
            // Check config setting first to see if it can register automatically or not
            if (config('ShieldOAuthConfig')->oauthConfigs[$oauthName]['allow_register'] === false) {
                return redirect()->to(config('Auth')->logoutRedirect())->with('error', lang('ShieldOAuthLang.Callback.account_not_found', [$userInfo->email]));
            }

            helper('text');
            $users = model('ShieldOAuthModel');
            // new user
            $entitiesUser = new User($oauthClass->getColumnsName('newUser', $userInfo));

            $users->save($entitiesUser);
            $userid = $users->getInsertID();
            // To get the complete user object with ID, we need to get from the database
            $user = $users->findById($userid);
            $users->save($user);
            // Add to default group
            $users->addToDefaultGroup($user);
        }

        auth()->loginById($userid);
        $this->recordLoginAttempt($oauthName, $userInfo->email);

        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->loginRedirect());
        }

        return redirect()->to(config('Auth')->logoutRedirect())->with('error', lang('ShieldOAuthLang.unknown'));
    }

    private function makeAntiForgeryKey(): string
    {
        helper('text');
        $state = random_string('crypto', 40);

        session()->set('state', $state);

        return $state;
    }

    private function checkAntiForgery(string $state): bool
    {
        return $state === session()->get('state');
    }

    private function checkExistenceUser(array $find = []): bool
    {
        $users = model('ShieldOAuthModel');
        // $find = ['email' => $this->userInfo()->email];
        $findUser = $users->findByCredentials($find);

        return $findUser !== null;
    }

    /**
     * Syncs user information based on provided fields.
     *
     * @param array<string, string>      $find         Array containing criteria to find the user
     * @param array<string, string|null> $updateFields Fields to update for the user
     *
     * @return int The ID of the user whose information is synced
     */
    private function syncingUserInfo(array $find = [], array $updateFields = []): int
    {
        $users = model('ShieldOAuthModel');
        $user  = $users->findByCredentials($find);

        $syncingUserInfo = config('ShieldOAuthConfig')->syncingUserInfo;
        if ($syncingUserInfo === true) {
            $user->fill($updateFields);
        }
        $users->save($user);

        return $user->id;
    }

    private function recordLoginAttempt(string $oauthName = '', string $identifier = ''): void
    {
        $loginModel = model(LoginModel::class);

        $loginModel->recordLoginAttempt(
            $oauthName . '_oauth',
            $identifier,
            true,
            $this->request->getIPAddress(),
            (string) $this->request->getUserAgent(),
            user_id(),
        );
    }
}
