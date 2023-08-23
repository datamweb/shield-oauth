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

namespace Datamweb\ShieldOAuth\Libraries\Basic;

use CodeIgniter\Config\Factories;
use CodeIgniter\Files\FileCollection;
use Config\Autoload;

class ShieldOAuth
{
    /**
     * --------------------------------------------------------------------
     * Set OAuth
     * --------------------------------------------------------------------
     * This function creating instances of OAuth class chosen by the user
     *
     * This function has the ability to identify classes in two Paths:
     *
     *  - \App\Libraries\ShieldOAuth\       for load any OAuth custom class created by the user
     *  - \Datamweb\ShieldOAuth\Libraries\  for load GithubOAuth or GoogleOAuth class
     */
    public static function setOAuth(string $serviceName): object
    {
        $serviceName = ucfirst($serviceName);
        $className   = '\Datamweb\ShieldOAuth\Libraries\\' . $serviceName . 'OAuth';

        // For detect custom OAuth
        if (file_exists(APPPATH . 'Libraries/ShieldOAuth' . DIRECTORY_SEPARATOR . $serviceName . 'OAuth.php')) {
            $className = '\App\Libraries\ShieldOAuth\\' . $serviceName . 'OAuth';
        }

        return Factories::loadOAuth($className); // @phpstan-ignore-line
    }

    /**
     * --------------------------------------------------------------------
     * Names of all supported OAuth services
     * --------------------------------------------------------------------
     * List of all the OAuth services
     *
     * Identifies all OAuth classes and generates a string according to the file name of the classes as follows.
     * e.g. 'github|google|yahoo' ...
     */
    public function allOAuth(): string
    {
        $files = new FileCollection();

        /** @var Autoload $autoload */
        $autoload = config(Autoload::class);

        // Checking if it is installed manually
        if (array_key_exists('Datamweb\ShieldOAuth', $autoload->psr4)) {
            // Adds all Libraries files
            $files = $files->add(APPPATH . 'ThirdParty/shield-oauth/src/Libraries', false);
        } else {
            // Adds all Libraries files if install via composer
            $files = $files->add(__DIR__ . '/..', false);
        }
        // For to detect custom OAuth
        if (is_dir(APPPATH . 'Libraries/ShieldOAuth')) {
            $files = $files->add(APPPATH . 'Libraries/ShieldOAuth', false);
        }
        // show only all *OAuth.php files
        $files = $files->retainPattern('*OAuth.php');

        $allOAuth = '';

        foreach ($files as $file) {
            // make string github|google and ... from class name
            $allOAuth .= strtolower(str_replace('OAuth.php', '|', $file->getBasename()));
        }

        return mb_substr($allOAuth, 0, -1);
    }

    /**
     * --------------------------------------------------------------------
     * Names of all Custom OAuth
     * --------------------------------------------------------------------
     * List of all just CustomOAuth services
     *
     * Returns array of all Custom OAuth classes file name
     * e.g. ['yahoo']
     *
     * @return array<int, string>
     */
    private function otherOAuth()
    {
        $pieces = explode('|', $this->allOAuth());

        return array_diff($pieces, ['github', 'google']);
    }

    /**
     * --------------------------------------------------------------------
     * Make OAuth Button
     * --------------------------------------------------------------------
     * Creates OAuth buttons based on existing OAuth classes
     *
     * Group a series of buttons together on a single line by bootstrap 5.0
     *
     * @see https://getbootstrap.com/docs/5.0/components/button-group/#nesting
     * @see https://getbootstrap.com/docs/5.0/components/button-group/#basic-example
     */
    public function makeOAuthButton(string $forPage = 'login'): string
    {
        $active_by = lang('ShieldOAuthLang.login_by');
        if ($forPage === 'register') {
            $active_by = lang('ShieldOAuthLang.register_by');
        }

        $Button = "<hr>
        <div class='text-center'>
                 <div class='btn-group' role='group' aria-label='Button group with nested dropdown'>
                 <a href='#' class='btn btn-primary active' aria-current='page'>" . $active_by . '</a>';

        $Button .= '<a href=' . base_url('oauth/google') . " class='btn btn-outline-secondary' aria-current='page'>" . lang('ShieldOAuthLang.Google.google') . '</a>';
        $Button .= '<a href=' . base_url('oauth/github') . " class='btn btn-outline-secondary' aria-current='page'>" . lang('ShieldOAuthLang.Github.github') . '</a>';
        if (count($this->otherOAuth()) > 0) {
            $Button .= "<div class='btn-group' role='group'>
                            <button type='button' class='btn btn-outline-secondary dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>"
                            . lang('ShieldOAuthLang.other') . "
                            </button>
                            <ul class='dropdown-menu'>";

            foreach ($this->otherOAuth() as $oauthName) {
                $OAuthName = ucfirst($oauthName);
                $Button .= "<li><a class='dropdown-item' href=" . base_url("oauth/{$oauthName}") . '>' . lang("ShieldOAuthLang.{$OAuthName}.{$oauthName}") . '</a></li>';
            }
            $Button .= '</ul></div>';
        }

        $Button .= '
        </div>
        </div>';

        return $Button;
    }
}
