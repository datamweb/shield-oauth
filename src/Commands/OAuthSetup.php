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

namespace Datamweb\ShieldOAuth\Commands;

use CodeIgniter\Shield\Commands\Setup;
use CodeIgniter\Shield\Commands\Setup\ContentReplacer;

class OAuthSetup extends Setup
{
    /**
     * The group the command is lumped under
     * when listing commands.
     */
    protected string $group = 'ShieldOAuth';

    /**
     * The Command's name
     */
    protected string $name = 'make:oauthconfig';

    /**
     * the Command's short description
     */
    protected string $description = 'Generate file ShieldOAuthConfig in path APPPATH\Config.';

    /**
     * the Command's usage
     */
    protected string $usage = 'make:oauthconfig';

    /**
     * the Command's Arguments
     */
    protected array $arguments = [];

    /**
     * the Command's Options
     *
     * @var array<string, string>
     */
    protected array $options = [
        '-f' => 'Force overwrite ALL existing files in destination.',
    ];

    /**
     * The path to `Datamweb\ShieldOAuth\` src directory.
     *
     * @var string
     */
    protected $sourcePath;

    protected string $distPath = APPPATH;
    private ContentReplacer $replacer;

    /**
     * Displays the help for the spark cli script itself.
     */
    public function run(array $params): void
    {
        $this->replacer = new ContentReplacer();

        $this->sourcePath = __DIR__ . '/../';

        $file     = 'Config/ShieldOAuthConfig.php';
        $replaces = [
            'namespace Datamweb\ShieldOAuth\Config;' => 'namespace Config;',
            'use CodeIgniter\\Config\\BaseConfig;'   => 'use Datamweb\ShieldOAuth\Config\ShieldOAuthConfig as OAuthConfig;',
            'extends BaseConfig'                     => 'extends OAuthConfig',
        ];

        $this->copyAndReplace($file, $replaces);
    }

    /**
     * @param string $file     Relative file path like 'Config/ShieldOAuthConfig.php'.
     * @param array  $replaces [search => replace]
     */
    protected function copyAndReplace(string $file, array $replaces): void
    {
        $path = "{$this->sourcePath}/{$file}";

        $content = file_get_contents($path);

        $content = $this->replacer->replace($content, $replaces);

        $this->writeFile($file, $content);
    }
}
