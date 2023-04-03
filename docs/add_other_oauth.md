# Add New OAuth To Shield OAuth

As you know, `Shield OAuth` supports `Google OAuth` and `Github OAuth` by default. But you can connect any server that offers `OAuth` to it.
It is very simple, first, create a file named `NewOAuth` in path `app\Libraries\ShieldOAuth`. Existence of extension `OAuth` is mandatory in creating each new class. For example, if you want to add Yahoo, you should create a file named `YahooOAuth` in path `app\Libraries\ShieldOAuth`.

Implement methods `makeGoLink($state)`, `fetchAccessTokenWithAuthCode($allGet)`, `fetchUserInfoWithToken()` and `setColumnsName(string $nameOfProcess, $userInfo)` according to the documents of each server.

`NewOAuth` have only one requirement: they must extends `Datamweb\ShieldOAuth\Libraries\Basic\AbstractOAuth`.

The `AbstractOAuth` defines four methods for `NewOAuth`:

1. `makeGoLink($state)` In this method, you need to create a link to transfer the user to the new provider. The output of this method is a `string` in the form of URL. For example, regarding Yahoo, you can follow the instructions available [here](https://developer.yahoo.com/oauth2/guide/flows_authcode/#step-2-get-an-authorization-url-and-authorize-access) to create this link.
 
2. `fetchAccessTokenWithAuthCode($allGet)` In this method, you should try to get the value of `access_token` according to the code received from the previous method. The output of this method is of `void`. For Yahoo, you can see the description [here](https://developer.yahoo.com/oauth2/guide/flows_authcode/#step-4-exchange-authorization-code-for-access-token). Everything is ready, just replace.

3. `fetchUserInfoWithToken()` In this method, you try to receive user information (including first name, last name, email, etc) according to the token code set in the previous step.The output of this method is a `object` of user info(email, name, ...). See [here](https://developer.yahoo.com/oauth2/guide/OpenID2) for more details about Yahoo.

4. `setColumnsName(string $nameOfProcess, $userInfo)` In this method, you set the fields received from each service OAuth to be recorded in each column of the table.

I have given an example for Yahoo below:

- [Writing Class Yahoo OAuth](#writing-class-yahoo-oauth) 
- [Add Keys To Config File](#add-keys-to-config-file) 
- [Add lang file](#add-lang-file)


## Writing Class Yahoo OAuth 

Create a file in path `app\Libraries\ShieldOAuth\YahooOAuth.php` with the following contents.

```php

<?php

declare(strict_types=1);

namespace App\Libraries\ShieldOAuth;

use Datamweb\ShieldOAuth\Libraries\Basic\AbstractOAuth;

class YahooOAuth extends AbstractOAuth
{
    // https://developer.yahoo.com/oauth2/guide/flows_authcode/#refresh-token-label
    static private $API_CODE_URL      = 'https://api.login.yahoo.com/oauth2/request_auth';
    static private $API_TOKEN_URL     = 'https://api.login.yahoo.com/oauth2/get_token';
    static private $API_USER_INFO_URL = 'https://api.login.yahoo.com/openid/v1/userinfo';
    static private $APPLICATION_NAME  = 'ShieldOAuth';

    protected string $token;
    protected string $client_id;
    protected string $client_secret;
    protected string $callback_url;

    public function __construct(string $token = '')
    {
        $this->token  = $token;
        $this->client = \Config\Services::curlrequest();

        $this->config        = config('ShieldOAuthConfig');
        $this->callback_url  = base_url('oauth/' . $this->config->call_back_route);
        $this->client_id     = $this->config->oauthConfigs['yahoo']['client_id'];
        $this->client_secret = $this->config->oauthConfigs['yahoo']['client_secret'];
    }

    public function makeGoLink(string $state): string
    {
        $yahooURL= self::$API_CODE_URL."?response_type=code&client_id={$this->client_id}&redirect_uri={$this->callback_url}&state={$state}";

        return $yahooURL;
    }

    public function fetchAccessTokenWithAuthCode(array $allGet): void
    {

        $client = \Config\Services::curlrequest();
        try {
            //send request to API URL
            $response = $client->request('POST', self::$API_TOKEN_URL, [
                'form_params' => [
                        'client_id' => $this->client_id ,
                        'client_secret' => $this->client_secret ,
                        'redirect_uri' => $this->callback_url,
                        'code' => $allGet['code'],
                        'grant_type' => 'authorization_code'
                ],
                'http_errors' => false,
            ]);
            
        } catch (Exception $e) {
            die($e->getMessage());
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
                    'Authorization' => 'Bearer ' . $this->getToken(),
                ],
                'http_errors' => false,
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }

        return json_decode($response->getBody());
    }

    protected function setColumnsName(string $nameOfProcess, object $userInfo): array
    {
        if($nameOfProcess === 'syncingUserInfo'){
            $usersColumnsName = [
                $this->config->usersColumnsName['first_name'] => $userInfo->given_name,
                $this->config->usersColumnsName['last_name']  => $userInfo->family_name,
                $this->config->usersColumnsName['avatar']     => $userInfo->picture,
            ];
        }

        if($nameOfProcess === 'newUser'){
            $usersColumnsName = [
                'username'                                    => $userInfo->nickname,
                'email'                                       => $userInfo->email,
                'password'                                    => random_string('crypto', 32),
                'active'                                      => $userInfo->email_verified,
                $this->config->usersColumnsName['first_name'] => $userInfo->given_name,
                $this->config->usersColumnsName['last_name']  => $userInfo->family_name,
                $this->config->usersColumnsName['avatar']     => $userInfo->picture,
            ];
        }

        return $usersColumnsName;
    }
    
}

```

## Add Keys To Config File 
For each new OAuth service you create, you must add the following values in file `Config\ShieldOAuthConfig.php`. For Yahoo, it is as follows.

```php
     public array $oauthConfigs = [
        //...
        'yahoo' => [
        'client_id' => 'from yahoo ...',
        'client_secret' => 'from yahoo ...',

        'allow_login' => true
        ],
        //...
    ];
```

## Add lang file
For each new OAuth service you create, you must add the following values in file `Language\en\ShieldOAuthLang.php` and `Language\fa\ShieldOAuthLang.php`. For Yahoo, it is as follows.

```php
return [
    // ...
    'Yahoo' => [
        'not_allow' => 'Now you can\'t login or register with Yahoo!',
        'yahoo'     => 'Yahoo',
    ],
    // ...
];
```