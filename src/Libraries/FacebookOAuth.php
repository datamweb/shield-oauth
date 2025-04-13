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

use Datamweb\ShieldOAuth\Libraries\Basic\AbstractOAuth;

class FacebookOAuth extends AbstractOAuth
{ 

    private static $API_CODE_URL      = 'https://www.facebook.com/v16.0/dialog/oauth';
    private static $API_TOKEN_URL     = 'https://graph.facebook.com/v16.0/oauth/access_token';
    private static $API_USER_INFO_URL = 'https://graph.facebook.com/me?fields'; 
    private static $APPLICATION_NAME  = 'SheildOAuth';
    protected string $token;
    protected string $client_id;
    protected string $client_secret;
    protected string $callbake_url;
    protected string $fb_scope;


    public function __construct(string $token = '')
    {
        $this->token  = $token;
        $this->client = \Config\Services::curlrequest();

        $this->config        = config('ShieldOAuthConfig');
        $this->callbake_url  = base_url('oauth/' . $this->config->call_back_route);
        $this->client_id     = $this->config->oauthConfigs['facebook']['client_id'];
        $this->client_secret = $this->config->oauthConfigs['facebook']['client_secret'];
        $this->fb_scope = "id,first_name,last_name,middle_name,name,name_format,picture,short_name,email";
    }

    public function makeGoLink(string $state): string
    {
       return self::$API_CODE_URL . "?client_id={$this->client_id}&redirect_uri={$this->callbake_url}&state={$state}"; 
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
                    'redirect_uri'  => $this->callbake_url,
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
            $response = $this->client->request('POST', self::$API_USER_INFO_URL.'='.$this->fb_scope, [
                'headers' => [
                    'Accept'        => 'application/json',
                    'User-Agent'    => self::$APPLICATION_NAME . '/1.0',
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
        if ($nameOfProcess === 'syncingUserInfo') {
            $usersColumnsName = [
                $this->config->usersColumnsName['first_name'] => $userInfo->first_name,
                $this->config->usersColumnsName['last_name']  => $userInfo->last_name,
                $this->config->usersColumnsName['avatar']     => $userInfo->picture->data->url,
            ];
        }

        if ($nameOfProcess === 'newUser') {
            $usersColumnsName = [
                // users tbl                                    // OAuth
                'username'                                    => $userInfo->first_name,
                'email'                                       => $userInfo->email,
                'password'                                    => random_string('crypto', 32),
                'active'                                      => '1',
                $this->config->usersColumnsName['first_name'] => $userInfo->first_name,
                $this->config->usersColumnsName['last_name']  => $userInfo->last_name,
                $this->config->usersColumnsName['avatar']     => $userInfo->picture->data->url,
            ];
        }

        return $usersColumnsName;
    }
}
