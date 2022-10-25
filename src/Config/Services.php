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

    public static function ShieldOAuth($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('ShieldOAuth');
        }

        return new ShieldOAuth(new ShieldOAuthConfig());
    }
}
