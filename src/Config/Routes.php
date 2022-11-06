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

$routes->group('oauth', ['namespace' => '\Datamweb\ShieldOAuth\Controllers'], static function ($routes): void {
    $routes->addPlaceholder('allOAuthList', service('ShieldOAuth')->allOAuth());
    $routes->get('(:allOAuthList)', 'OAuthController::redirectOAuth/$1');

    $routes->get(config('ShieldOAuthConfig')->call_back_route, 'OAuthController::callBack');
});
