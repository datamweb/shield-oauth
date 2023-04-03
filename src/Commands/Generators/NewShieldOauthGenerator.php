<?php

namespace Datamweb\ShieldOAuth\Commands\Generators;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
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
     * @var array
     */
    protected $arguments = [
        'name' => 'The name of the new OAuth without the `OAuth` suffix. The `OAuth` suffix will be automatically added for you.'
    ];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [
        '--force'     => 'Force overwrite existing file.',
    ];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $this->component = 'Library';
        $this->directory = 'Libraries/ShieldOAuth';
        $this->template  = 'newoauth.tpl.php';

        // @TODO execute() is deprecated in CI v4.3.0.
        $this->execute($params); // @phpstan-ignore-line suppress deprecated error.
    }
}
