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
    'unknown'  => 'Unknown error!',
    'Callback' => [
        'oauth_class_not_set' => 'An error occurred, it seems that the OAuth Class is not set.',
        'anti_forgery'        => 'Your request has been detected as fake. we are sorry!',
    ],

    // ShieldOAuthButton in views
    'other'       => 'Other',
    'login_by'    => 'Login by : ',
    'register_by' => 'Register by : ',

    // Errors List For all OAuth
    'Github' => [
        'github'    => 'GitHub',
        'not_allow' => "Now you can't login or register with GitHub!",
    ],
    'Google' => [
        'google'    => 'Google',
        'not_allow' => "Now you can't login or register with Google!",
    ],
    // 'Yahoo' => [
    //     'yahoo'     => 'Yahoo',
    //     'not_allow' => "Now you can't login or register with Yahoo!",

    // ],
];
