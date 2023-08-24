# Quick Installation

It is strongly recommended that only people who have already read the documents in full should use this section. The purpose of providing this section is to save the time of people and developers who frequently use `Shield OAuth` in different projects.

### Step 1 : 

Installing the package by Composer :
```console
composer require datamweb/shield-oauth:dev-main
```

### Step 2 :

Add `first_name`, `last_name`, and `avatar` columns to table `users` :

```console
php spark migrate -n Datamweb\ShieldOAuth
```
 ### Step 3 : 

 - Add `{{ShieldOAuthButtonForLoginPage}}` to `vendor\codeigniter4\shield\src\Views\login.php`
 - Add `{{ShieldOAuthButtonForRegisterPage}}` to `vendor\codeigniter4\shield\src\Views\register.php`
 - Add
```php
<?= $this->section('pageScripts') ?>
<script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js' integrity='sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3' crossorigin='anonymous'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js' integrity='sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk' crossorigin='anonymous'></script>
<?= $this->endSection() ?>
```
 to `vendor\codeigniter4\shield\src\Views\login.php` and `vendor\codeigniter4\shield\src\Views\register.php`.
 
  ### Step 4 : 

Receive keys `client_id` and `client_secret` from each OAuth server. and setting them in file `app\Config\ShieldOAuthConfig.php`.

callBack address is `https://yourBaseURL.com/oauth/call-back`.
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

> **Note**
> By default, there is no file `app/Config/ShieldOAuthConfig.php`. It is strongly recommended to set the keys to `app/Config/ShieldOAuthConfig.php`. This behavior will make sure that there will be no problems for the settings you have made in case of update `Shield OAuth`. To create it, you can use the following command:
>
> ```console
> php spark make:oauthconfig
> ```

### Step 5 : 

Cancel filter for `Shield OAuth` routes.
```php
public $globals = [
    'before' => [
        // ...
        'session' => ['except' => ['login*', 'register', 'auth/a/*', 'oauth*']],
    ],
    // ...
];
```

### Step 6 :
See `https://yourBaseURL.com/login` Or `https://yourBaseURL.com/register` Use and enjoy!
