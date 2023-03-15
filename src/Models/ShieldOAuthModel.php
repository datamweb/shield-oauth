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

namespace Datamweb\ShieldOAuth\Models;

use CodeIgniter\Shield\Models\UserModel;

class ShieldOAuthModel extends UserModel
{
    protected function initialize(): void
    {
        parent::initialize();
        // Merge properties with parent
        $this->allowedFields = array_merge($this->allowedFields, [
            config('ShieldOAuthConfig')->usersColumnsName['first_name'],
            config('ShieldOAuthConfig')->usersColumnsName['last_name'],
            config('ShieldOAuthConfig')->usersColumnsName['avatar'],
        ]);
    }
}
