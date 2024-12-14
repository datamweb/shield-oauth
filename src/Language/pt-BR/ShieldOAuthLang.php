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
    'unknown'  => 'Erro desconhecido!',
    'Callback' => [
        'oauth_class_not_set' => 'Ocorreu um erro, parece que a classe OAuth não está configurada.',
        'anti_forgery'        => 'Sua solicitação foi detectada como falsa. Pedimos desculpas!',
        'account_not_found'   => 'Não há nenhuma conta registrada com o e-mail "{0}".',
        'access_denied'       => 'Autenticação cancelada! Você recusou as permissões de {0}.',
    ],

    // ShieldOAuthButton in views
    'other'       => 'Outro',
    'login_by'    => 'Entrar com: ',
    'register_by' => 'Registrar com: ',

    // Errors List For all OAuth
    'Github' => [
        'github'    => 'GitHub',
        'not_allow' => 'Agora você não pode entrar ou se registrar com o GitHub!',
    ],
    'Google' => [
        'google'    => 'Google',
        'not_allow' => 'Agora você não pode entrar ou se registrar com o Google!',
    ],
    // 'Yahoo' => [
    //     'yahoo'     => 'Yahoo',
    //     'not_allow' => 'Agora você não pode entrar ou se registrar com o Yahoo!',

    // ],
];
