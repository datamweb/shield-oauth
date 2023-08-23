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

use CodeIgniter\Config\BaseService;
use Datamweb\ShieldOAuth\Libraries\Basic\ShieldOAuth;

class Services extends BaseService
{
    /**
     * -------------------------------------------------------
     * Service Configuration file
     * -------------------------------------------------------
     * Create and share new class instances
     *
     * More Info @see https://codeigniter.com/user_guide/concepts/services.html
     */
    public static function ShieldOAuth(bool $getShared = true): ShieldOAuth
    {
        if ($getShared) {
            return static::getSharedInstance('ShieldOAuth');
        }

        return new ShieldOAuth();
    }
}
