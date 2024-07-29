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

// ShieldOAuthLang language file
return [
    // Errors List
    'unknown'  => 'خطای ناشناخته!',
    'Callback' => [
        'oauth_class_not_set' => 'خطای رخ داد، به نظر میرسد کلاس OAuth مورد نظر به درستی تنظیم نشده است.',
        'anti_forgery'        => 'متاسفانه، تلاش شما ، یک درخواست جعلی تشخیص داده شد.',
        'account_not_found'   => 'هیچ حسابی با ایمیل "{0}" ثبت نشده است.',
        'access_denied'       => 'تأیید اعتبار لغو شد! شما دسترسی‌های {0} را رد کردید.',
    ],

    // ShieldOAuthButton in views
    'other'       => 'سایر',
    'login_by'    => 'ورود با : ',
    'register_by' => 'ثبت نام با : ',

    // Errors List For all OAuth
    'Github' => [
        'github'    => 'گیت هاب',
        'not_allow' => 'اکنون، امکان ورود و یا ثبت نام با گیت هاب وجود دارد!',
    ],
    'Google' => [
        'google'    => 'گوگل',
        'not_allow' => 'اکنون امکان ورود و یا ثبت نام با گوگل وجود ندارد.',
    ],
    // 'Yahoo' => [
    //     'yahoo'     => 'یاهو',
    //     'not_allow' => "اکنون امکان ورود و یا ثبت نام با یاهو وجود ندارد!",
    // ],
];
