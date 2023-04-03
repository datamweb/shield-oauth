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

namespace Datamweb\ShieldOAuth\Commands\Generators;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\GeneratorTrait;

class NewShieldOauthGenerator extends BaseCommand
{
    use GeneratorTrait;

    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'ShieldOAuth';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'make:oauth';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Adds new OAuth to Shield OAuth.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'make:oauth [<name>] [options]';

    /**
     * The Command's Arguments
     *
     * @var array<string, string>
     */
    protected $arguments = [
        'name' => 'The name of the new OAuth without the `OAuth` suffix. The `OAuth` suffix will be automatically added for you.',
    ];

    /**
     * The Command's Options
     *
     * @var array<string, string>
     */
    protected $options = [
        '-f' => 'Force overwrite existing file.',
    ];

    /**
     * Actually execute a command.
     */
    public function run(array $params): void
    {
        $this->component = 'Library';
        $this->directory = 'Libraries/ShieldOAuth';
        $this->template  = 'newoauth.tpl.php';

        // @TODO execute() is deprecated in CI v4.3.0.
        $this->execute($params); // @phpstan-ignore-line suppress deprecated error.
    }
}
