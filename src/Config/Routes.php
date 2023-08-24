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

use CodeIgniter\Router\RouteCollection;
use Datamweb\ShieldOAuth\Config\ShieldOAuthConfig;
use Datamweb\ShieldOAuth\Libraries\Basic\ShieldOAuth;

/**
 * @var RouteCollection $routes
 */
$routes->group('oauth', ['namespace' => '\Datamweb\ShieldOAuth\Controllers'], static function ($routes): void {
    /** @var ShieldOAuth $shieldOAuthLib */
    $shieldOAuthLib = service('ShieldOAuth');

    $routes->addPlaceholder('allOAuthList', $shieldOAuthLib->allOAuth());
    $routes->get('(:allOAuthList)', 'OAuthController::redirectOAuth/$1');

    /** @var ShieldOAuthConfig $config */
    $config = config('ShieldOAuthConfig');

    $routes->get($config->call_back_route, 'OAuthController::callBack');
});
