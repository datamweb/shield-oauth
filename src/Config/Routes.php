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

/**
 * @var CodeIgniter\Router\RouteCollection $routes
 */
$routes->group('oauth', ['namespace' => '\Datamweb\ShieldOAuth\Controllers'], static function ($routes): void {
    /** @var \Datamweb\ShieldOAuth\Libraries\Basic\ShieldOAuth $shieldOAuthLib */
    $shieldOAuthLib = service('ShieldOAuth');

    $routes->addPlaceholder('allOAuthList', $shieldOAuthLib->allOAuth());
    $routes->get('(:allOAuthList)', 'OAuthController::redirectOAuth/$1');

    /** @var \Datamweb\ShieldOAuth\Config\ShieldOAuthConfig $config */
    $config = config('ShieldOAuthConfig');

    $routes->get($config->call_back_route, 'OAuthController::callBack');
});
