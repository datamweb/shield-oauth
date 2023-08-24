# Installation

- [Installation](#installation)
  - [Requirements](#requirements)
  - [Composer Installation](#composer-installation)
  - [Add Required Columns](#add-required-columns)
  - [Cancel Filter For Shield OAuth Routes](#cancel-filter-for-shield-oauth-routes)
  - [Set keys](#set-keys)
  - [Adding all login button with OAuth in View](#adding-all-login-button-with-oauth-in-view)

These instructions assume that you have already installed the **CodeIgniter 4 app starter** and **Shield** as the basis for your new project, set up your `.env` file, and created a database that you can access via the Spark CLI script.

## Requirements

- [Composer](https://getcomposer.org)
- [Codeigniter](https://codeigniter4.github.io/CodeIgniter4/installation/installing_composer.html#installation) **v4.2.7** or later
- [Codeigniter Shield](https://github.com/codeigniter4/shield)
- [cURL Library](https://www.php.net/manual/en/book.curl.php) to be installed in your version of PHP

## Composer Installation

Installation is done through [Composer](https://getcomposer.org). The example assumes you have it installed globally.
If you have it installed as a phar, or otherwise you will need to adjust the way you call composer itself.

```console
composer require datamweb/shield-oauth:dev-main
```
> **Note**
> You can manually install `Shield OAuth` by extracting the project file to path `app\ThirdParty\shield-oauth` and then adding 
> 
>```php     
> public $psr4 = [
>     // add this line
>     'Datamweb\ShieldOAuth' => APPPATH . 'ThirdParty/shield-oauth/src',
> ];
> ``` 
> to the `app/Config/Autoload.php` file, however we do not recommend this. Please use the Composer.

## Add Required Columns

`Shield OAuth` needs to make some changes in Shield `users` Table. In general, you should have the following items in `users` Table.

```console
Data of Table "users":

+----+----------+--------+-...-+------------+-----------+--------+
| id | username | status | ... | first_name | last_name | avatar |
+----+----------+--------+-...-+------------+-----------+--------+
```
Therefore, you can add `first_name`, `last_name`, and `avatar` columns to table `users` by any method you want or run the migrations:

```console
php spark migrate -n Datamweb\ShieldOAuth
```

> **Note**
> By default, `Shield OAuth` uses columns named `first_name`, `last_name`, and `avatar`.
> For any reason, if you want to consider another name for them columns, you can do it through the config file(`config/ShieldOAuthConfig.php`) and set the desired values in:

```php 
public array $usersColumnsName = [
    'first_name' => 'first_name',
    'last_name'  => 'last_name',
    'avatar'     => 'avatar',
];
```

## Cancel Filter For Shield OAuth Routes

`Shield OAuth` adds multiple routes to your project. `oauth/call-back` and `oauth/(:any)`, so you should register them in the category of **not applying** the shield filter. For this, you can proceed as follows you need to add the following code in the `app/Config/Filters.php` file.

```php
public $globals = [
    'before' => [
        // ...
        'session' => ['except' => ['login*', 'register', 'auth/a/*', 'oauth*']],
    ],
    // ...
];
```

## Set keys 

Receive keys `client_id` and `client_secret` from each OAuth server.
To connect to any of the servers, you need to receive`client_id` and `client_secret` from them and then set them in file `app/Config/ShieldOAuthConfig`.

> **Note**
> By default, there is no file `app/Config/ShieldOAuthConfig`. It is strongly recommended to set the keys to `app/Config/ShieldOAuthConfig`. This behavior will make sure that there will be no problems for the settings you have made in case of update `Shield OAuth`. To create it, you can use the following command:
>
> ```console
> php spark make:oauthconfig
> ```

You can see [How To Get Keys](get_keys.md) for instructions on how to get the keys.

```php
public array $oauthConfigs = [
    'github' => [
            'client_id'     => '8441sgsgsgsgshfgjgykgub08b6',
            'client_secret' => '2336fsdgdfgdfgdfghfdhfghdhdhdhdhd',
            // ...
    ],
    'google' => [
            'client_id'     => '95040vghjhjghjgjgj.apps.googleusercontent.com',
            'client_secret' => 'fsdfsdfsgdgrdg',
        // ...
    ],
    // and other services...
```

## Adding all login button with OAuth in View
The last step is to, You can create your own buttons in views, what is important is that the addresses should be as follows:
```html
http://localhost:8080/oauth/google
http://localhost:8080/oauth/github
http://localhost:8080/oauth/yahoo
<!-- and other OAuth !>
```
However, `Shield OAuth` suggests the following for ease of use. By adding the following commands to the `vendor/codeigniter4/shield/src/Views/login.php` and `vendor/codeigniter4/shield/src/Views/register.php` file, `Shield OAuth` will automatically display all the OAuth you provide as buttons in login/register views.

```html
{{ShieldOAuthButtonForLoginPage}}
```

```html
{{ShieldOAuthButtonForRegisterPage}}
```
Because we have used Bootstrap to make the dropdown button, you need to add the following items at the end of the views file.

```php
<?= $this->section('pageScripts') ?>
<script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js' integrity='sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3' crossorigin='anonymous'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js' integrity='sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk' crossorigin='anonymous'></script>
<?= $this->endSection() ?>
```

> **Note**
> When you create a new class in path `app/Libraries/ShieldOAuth/`, for example `YahooOAuth.php`, you will have a new link as below, this is done automatically and there is no need to add code and perform special instructions.
>
> ```html
> http://localhost:8080/oauth/yahoo
> ```

> **Warning**
> The two views `vendor/codeigniter4/shield/src/Views/login.php` and `vendor/codeigniter4/shield/src/Views/register.php` are the main files of `Shield`, we have included them in order to make the **documentation understandable**, you should definitely use custom views.
