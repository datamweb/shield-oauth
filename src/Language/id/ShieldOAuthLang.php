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
    'unknown'  => 'Ups, kesalahan tidak terduga!',
    'Callback' => [
        'oauth_class_not_set' => 'Terjadi kesalahan, sepertinya class OAuth tidak terpasang.',
        'anti_forgery'        => 'Maaf, permintaan Anda terdeteksi tidak valid!',
        'account_not_found'   => 'Tidak ada akun yang terdaftar dengan email "{0}".',
    ],

    // ShieldOAuthButton in views
    'other'       => 'Lainnya',
    'login_by'    => 'Masuk dengan : ',
    'register_by' => 'Registrasi dengan : ',

    // Errors List For all OAuth
    'Github' => [
        'github'    => 'GitHub',
        'not_allow' => 'Sekarang Anda tidak bisa masuk atau mendaftar dengan GitHub!',
    ],
    'Google' => [
        'google'    => 'Google',
        'not_allow' => 'Sekarang Anda tidak bisa masuk atau mendaftar dengan Google!',
    ],
    // 'Yahoo' => [
    //     'yahoo'     => 'Yahoo',
    //     'not_allow' => 'Sekarang Anda tidak bisa masuk atau mendaftar dengan Yahoo!',

    // ],
];
