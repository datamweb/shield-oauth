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

namespace Datamweb\ShieldOAuth\Database\Migrations;

use CodeIgniter\Database\Migration;
use Datamweb\ShieldOAuth\Config\ShieldOAuthConfig;

class ShieldOAuth extends Migration
{
    private string $first_name;
    private string $last_name;
    private string $avatar;

    public function __construct()
    {
        parent::__construct();

        /** @var ShieldOAuthConfig $config */
        $config           = config('ShieldOAuthConfig');
        $this->first_name = $config->usersColumnsName['first_name'];
        $this->last_name  = $config->usersColumnsName['last_name'];
        $this->avatar     = $config->usersColumnsName['avatar'];
    }

    public function up(): void
    {
        $fields = [
            $this->first_name => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            $this->last_name => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            $this->avatar => [
                'type'       => 'VARCHAR',
                'constraint' => '1000',
                'null'       => true,
            ],
        ];

        $this->forge->addColumn('users', $fields);
    }

    public function down(): void
    {
        $fields = [
            $this->first_name,
            $this->last_name,
            $this->avatar,
        ];

        $this->forge->dropColumn('users', $fields);
    }
}
