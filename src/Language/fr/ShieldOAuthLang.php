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
    'unknown'  => 'Erreur inconnue!',
    'Callback' => [
        'oauth_class_not_set' => 'Une erreur s’est produite, il semble que la classe OAuth n’est pas définie.',
        'anti_forgery'        => 'Votre demande a été détectée comme erronée. Nous sommes désolés!',
    ],

    // ShieldOAuthButton in views
    'other'       => 'Autre',
    'login_by'    => 'Connectez-vous avec : ',
    'register_by' => 'Inscrivez-vous avec : ',

    // Errors List For all OAuth
    'Github' => [
        'github'    => 'GitHub',
        'not_allow' => 'Vous ne pouvez pas vous connecter ou vous inscrire avec GitHub maintenant!',
    ],
    'Google' => [
        'google'    => 'Google',
        'not_allow' => 'Vous ne pouvez pas vous connecter ou vous inscrire avec Google maintenant!',

    ],
    // 'Yahoo' => [
    //     'yahoo'     => 'Yahoo',
    //     'not_allow' => "Vous ne pouvez pas vous connecter ou vous inscrire avec Yahoo maintenant!",

    // ],
];
