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

namespace Datamweb\ShieldOAuth\Libraries;

use CodeIgniter\HTTP\CURLRequest;
use Config\Services;
use Datamweb\ShieldOAuth\Libraries\Basic\AbstractOAuth;
use Exception;

class GithubOAuth extends AbstractOAuth
{
    public static string $API_CODE_URL      = 'https://github.com/login/oauth/authorize';
    public static string $API_TOKEN_URL     = 'https://github.com/login/oauth/access_token';
    public static string $API_USER_INFO_URL = 'https://api.github.com/user';
    private static string $APPLICATION_NAME = 'ShieldOAuth';
    protected string $token;
    protected CURLRequest $client;
    protected ?object $config = null;
    protected string $client_id;
    protected string $client_secret;
    protected string $callback_url;

    public function __construct(string $token = '')
    {
        $this->token  = $token;
        $this->client = Services::curlrequest();

        $this->config        = config('ShieldOAuthConfig');
        $this->callback_url  = base_url('oauth/' . $this->config->call_back_route);
        $this->client_id     = $this->config->oauthConfigs['github']['client_id'];
        $this->client_secret = $this->config->oauthConfigs['github']['client_secret'];
    }

    protected function makeGoLink(string $state): string
    {
        return $redirectUrl = self::$API_CODE_URL . "?client_id={$this->client_id}&redirect_uri={$this->callback_url}&scope=user%3Aemail&response_type=code&state={$state}";
    }

    protected function fetchAccessTokenWithAuthCode(array $allGet): void
    {
        try {
            // send request to API URL
            $response = $this->client->request('POST', self::$API_TOKEN_URL, [
                'form_params' => [
                    'client_id'     => $this->client_id,
                    'client_secret' => $this->client_secret,
                    'code'          => $allGet['code'],
                    'redirect_uri'  => $this->callback_url,
                    'grant_type'    => 'authorization_code',
                ],
                'headers' => [
                    'User-Agent' => self::$APPLICATION_NAME . '/1.0',
                    'Accept'     => 'application/json',
                ],
            ]);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        $token = json_decode($response->getBody())->access_token;
        $this->setToken($token);
    }

    protected function fetchUserInfoWithToken(): object
    {
        // send request to API URL
        try {
            $response = $this->client->request('GET', self::$API_USER_INFO_URL, [
                'headers' => [
                    'User-Agent'    => self::$APPLICATION_NAME . '/1.0',
                    'Accept'        => 'application/vnd.github+json',
                    'Authorization' => 'Bearer ' . $this->getToken(),
                ],
                'http_errors' => false,
            ]);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        return json_decode($response->getBody());
    }

    protected function setColumnsName(string $nameOfProcess, $userInfo): array
    {
        $usersColumnsName = [];
        if ($nameOfProcess === 'syncingUserInfo') {
            return [
                $this->config->usersColumnsName['first_name'] => $userInfo->name,
                $this->config->usersColumnsName['last_name']  => $userInfo->name,
                $this->config->usersColumnsName['avatar']     => $userInfo->avatar_url,
            ];
        }

        if ($nameOfProcess === 'newUser') {
            return [
                'username'                                    => $userInfo->login,
                'email'                                       => $userInfo->email,
                'password'                                    => random_string('crypto', 32),
                'active'                                      => true,
                $this->config->usersColumnsName['first_name'] => $userInfo->name,
                $this->config->usersColumnsName['last_name']  => $userInfo->name,
                $this->config->usersColumnsName['avatar']     => $userInfo->avatar_url,
            ];
        }

        return [];
    }
}
