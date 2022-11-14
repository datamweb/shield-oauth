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

use CodeIgniter\HTTP\RedirectResponse;

interface ControllersInterface
{
    /**
     * -------------------------------------------------------------------------------------------
     * Users Redirected to Request Their OAuth Identity
     * -------------------------------------------------------------------------------------------
     *
     * The user is redirected to the specified URL for login to any OAuth service with credentials.
     * Each OAuth service provides how to create a link for validation based on its instructions.
     * For example, Github is explained here.
     *
     * @see https://docs.github.com/en/developers/apps/building-oauth-apps/authorizing-oauth-apps#1-request-a-users-github-identity
     */
    public function redirectOAuth(string $oauthName): RedirectResponse;

    /**
     * -------------------------------------------------------------------------------------------
     * Call Back From Every OAuth Service
     * -------------------------------------------------------------------------------------------
     *
     * User return after credentials are valid or invalid in each OAuth service
     * If the user is valid in OAuth Service, the new user is registered or login if there is one in shield user table.
     * Otherwise, error messages will be displayed.
     */
    public function callBack(): RedirectResponse;
}
