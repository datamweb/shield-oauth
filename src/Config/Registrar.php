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

namespace Datamweb\ShieldOAuth\Config;

use Datamweb\ShieldOAuth\Views\Decorators\ShieldOAuth;

class Registrar
{
    /**
     * --------------------------------------------------------------------------
     * Shield OAuth Decorator
     * --------------------------------------------------------------------------
     * Register the ShieldOAuth decorator.
     *
     * @see https://codeigniter.com/user_guide/outgoing/view_decorators.html
     *
     * @return array<string, list<string>>
     */
    public static function View(): array
    {
        return [
            'decorators' => [
                ShieldOAuth::class,
            ],
        ];
    }

    /**
     * Register the ShieldOAuth make:oauth generator template.
     */
    public static function Generators(): array
    {
        return [
            'views' => [
                'make:oauth' => 'Datamweb\ShieldOAuth\Commands\Generators\Views\newoauth.tpl.php',
            ],
        ];
    }
}
