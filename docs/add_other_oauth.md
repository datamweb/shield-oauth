# Adding New OAuth To Shield OAuth

Shield OAuth supports *Google OAuth* and *GitHub OAuth* out-of-the-box and also provides an easy way to connect any server that offers **OAuth** to it. This guide explains how to achieve this.

- [Adding New OAuth to Shield OAuth](#adding-new-oauth-to-shield-oauth) 
  - [Setup Instruction](#setup-instruction)
    - [Command Setup](#command-setup)
    - [Manual Setup](#manual-setup)

## Setup Instruction

### Command Setup

1. Run the following command. This command handles steps 1 - 3 of *Manual Setup*.

```console
php spark make:oauth Example
```

> **Note** The name of the new OAuth you want to create doesn't need to contain the `OAuth` suffix. The command will automatically add it to the class name for you.

This command will automatically generate new files *ExampleOAuth.php*, *ShieldOAuthLang.php* in the **app/Libraries/ShieldOAuth**, **app/Language/en** paths respectively and also update the *ShieldOAuthConfig.php* file in the **app/Config** path.

> **Note** The *ShieldOAuthConfig.php* file must be present in your **app/Config** path for this command to run successfully. So ensure that you have run the `make:oauthconfig` command first, as stated [here](install.md#set-keys).

2. Configure the files.

```php
// updated file - app/Config/ShieldOAuthConfig.php
<?php 
public array $oauthConfigs = [
    // ..
    'example' => [
        'client_id' => 'Get this from the OAuth server',
        'client_secret' => 'Get this from the OAuth server',

        'allow_login' => true
    ],
];

```

```php
// new file - app/Libraries/ShieldOAuth/ExampleOAuth.php
<?php 

declare(strict_types=1);

namespace App\Libraries\ShieldOAuth;

use Datamweb\ShieldOAuth\Libraries\Basic\AbstractOAuth;

class ExampleOAuth extends AbstractOAuth 
{
    private static $API_CODE_URL = '';
    private static $API_TOKEN_URL = '';
    private static $API_USER_INFO_URL = '';
    private static $APPLICATION_NAME = 'ShieldOAuth';

    protected string $token;
    protected string $client_id;
    protected string $client_secret;
    protected string $callback_url;

    public function __construct(string $token = '')
    {
        // your code here
    }

    public function makeGoLink(string $state): string
    {
        // your code here
        return '';
    }

    public function fetchAccessTokenWithAuthCode(array $allGet): void
    {
        // your code here
    }

    public function fetchUserInfoWithToken(): object
    {
        // your code here
        return json_decode('');
    }

    public function setColumnsName(string $nameOfProcess, object $userInfo): array
    {
        // your code here
        return [];
    }
}
```

> See [YahooOAuth](#yahoooauth-example-class) example for full code.

### Manual Setup

1. Create a file *ExampleOAuth* in the **app/Libraries/ShieldOAuth** path with the following contents. The **OAuth** suffix is mandatory in creating each new class. For example, if you want to add Yahoo, you should create a file named **YahooOAuth**.

```php
<?php 

declare(strict_types=1);

namespace App\Libraries\ShieldOAuth;

use Datamweb\ShieldOAuth\Libraries\Basic\AbstractOAuth;

class ExampleOAuth extends AbstractOAuth 
{
    private static $API_CODE_URL = '';
    private static $API_TOKEN_URL = '';
    private static $API_USER_INFO_URL = '';
    private static $APPLICATION_NAME = 'ShieldOAuth';

    protected string $token;
    protected string $client_id;
    protected string $client_secret;
    protected string $callback_url;

    public function __construct(string $token = '')
    {
        // your code here
    }

    public function makeGoLink(string $state): string
    {
        // your code here
        return '';
    }

    public function fetchAccessTokenWithAuthCode(array $allGet): void
    {
        // your code here
    }

    public function fetchUserInfoWithToken(): object
    {
        // your code here
        return json_decode('');
    }

    public function setColumnsName(string $nameOfProcess, object $userInfo): array
    {
        // your code here
        return [];
    }
}
```

> See [YahooOAuth](#yahoooauth-example-class) example for full code.

2. **Config Setup** Add the new OAuth config keys to the **app/Config/ShieldOAuthConfig.php** file.

```php
<?php 
public array $oauthConfigs = [
    //...
    'example' => [
        'client_id' => 'Get this from the OAuth server',
        'client_secret' => 'Get this from the OAuth server',

        'allow_login' => true
    ],
    //...
];

```

3. **Language setup** Add the following values to the **app/Language/en/ShieldOAuthLang.php** file. Create the file if it doesn't exist.

```php
return [
    // ...
    'Example' => [
        'not_allow' => 'Now you can\'t login or register with Example!',
        'example'     => 'Example',
    ],
    // ...
];
```

4. **Translations** Depending on the requirements of your application, you can translate the language file using the same keys, in as many languages as possible. See [CodeIgniter docs](https://codeigniter.com/user_guide/outgoing/localization.html#creating-language-files) for more information. Also note that the file name for each language must be **ShieldOAuthLang.php**.

## Available Methods

Your new *OAuth* file/class has just one requirement. It must extend `Datamweb\ShieldOAuth\Libraries\Basic\AbstractOAuth`. The abstract class `AbstractOAuth` implement methods `makeGoLink($state)`, `fetchAccessTokenWithAuthCode($allGet)`, `fetchUserInfoWithToken()` and `setColumnsName(string $nameOfProcess, $userInfo)`, which should be built according to the documentation of each server.

The `AbstractOAuth` defines four methods for your usage:

1. `makeGoLink($state)` In this method, you need to create a link to transfer the user to the new provider. The output of this method is a `string` in the form of URL. For example, regarding Yahoo, you can follow the instructions available [here](https://developer.yahoo.com/oauth2/guide/flows_authcode/#step-2-get-an-authorization-url-and-authorize-access) to create this link.
2. `fetchAccessTokenWithAuthCode($allGet)` In this method, you should try to get the value of `access_token` according to the code received from the previous method. The output of this method is of `void`. For Yahoo, you can see the description [here](https://developer.yahoo.com/oauth2/guide/flows_authcode/#step-4-exchange-authorization-code-for-access-token). Everything is ready, just replace.
3. `fetchUserInfoWithToken()` In this method, you try to receive user information (including first name, last name, email, etc) according to the token code set in the previous step.The output of this method is a `object` of user info(email, name, ...). See [here](https://developer.yahoo.com/oauth2/guide/OpenID2) for more details about Yahoo.
4. `setColumnsName(string $nameOfProcess, $userInfo)` In this method, you set the fields received from each service OAuth to be recorded in each column of the table.

## YahooOAuth Example Class

```php
<?php

declare(strict_types=1);

namespace App\Libraries\ShieldOAuth;

use Datamweb\ShieldOAuth\Libraries\Basic\AbstractOAuth;
use Exception;

class YahooOAuth extends AbstractOAuth
{
    // https://developer.yahoo.com/oauth2/guide/flows_authcode/#refresh-token-label
    static private $API_CODE_URL      = 'https://api.login.yahoo.com/oauth2/request_auth';
    static private $API_TOKEN_URL     = 'https://api.login.yahoo.com/oauth2/get_token';
    static private $API_USER_INFO_URL = 'https://api.login.yahoo.com/openid/v1/userinfo';
    static private $APPLICATION_NAME  = 'ShieldOAuth';

    protected string $token;
    protected $client;
    protected $config;
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
