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
use CodeIgniter\CLI\CLI;
use CodeIgniter\CLI\GeneratorTrait;
use CodeIgniter\Shield\Commands\Setup\ContentReplacer;

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
        '--force' => 'Force overwrite existing file.',
    ];

    /**
     * Path to the app folder
     *
     * @var string
     */
    protected $distPath = APPPATH;

    /**
     * The ContentReplacer class
     */
    protected ContentReplacer $replacer;

    /**
     * Actually execute a command.
     */
    public function run(array $params): int
    {
        // The name param is required
        if (empty($params[0])) {
            CLI::error('Please enter the name of the OAuth.', 'light_gray', 'red');

            return 1;
        }

        $this->replacer = new ContentReplacer();

        $this->component     = 'Library';
        $this->directory     = 'Libraries\ShieldOAuth';
        $this->template      = 'newoauth.tpl.php';
        $this->classNameLang = 'CLI.generator.className.library';
        $this->setHasClassName(false);

        // Disable the suffix option
        $this->setEnabledSuffixing(false);

        // The proper class name should contain the `OAuth` suffix if it doesn't exist
        $class = str_ireplace('oauth', 'OAuth', $params[0]);
        if (strpos($class, 'OAuth') === false) {
            $class .= 'OAuth';
        }

        $params[0] = $class;

        // ShieldOAuthConfig file must be present
        if ($this->updateConfig($class) !== 0) {
            CLI::error('ShieldOAuthConfig.php does not exist. Please run `php spark make:oauthconfig` first.', 'light_gray', 'red');

            return 1;
        }

        // @TODO execute() is deprecated in CI v4.3.0.
        $this->execute($params); // @phpstan-ignore-line suppress deprecated error.

        return 0;
    }

    /**
     * Add new OAuth to ShieldOAuthConfig.
     *
     * @param string $className
     */
    private function updateConfig($className): int
    {
        // Check that the config file exists
        $file = 'Config/ShieldOAuthConfig.php';
        if (! is_file($this->distPath . $file)) {
            return 1;
        }

        // Create the new config items to be added
        $oauthKey  = strtolower(str_replace('OAuth', '', $className));
        $oauthName = ucfirst(str_replace('OAuth', '', $className));
        $code      = "'{$oauthKey}' => [
            'client_id' => 'Get it from {$oauthName}',
            'client_secret' => 'Get it from {$oauthName}',

            'allow_login' => true,
        ],";

        // Setup the process of adding the code to the config file
        $pattern = '/(' . preg_quote('public array $oauthConfigs = [', '/') . ')/u';
        $replace = '$1' . "\n        " . $code;

        // Add the code
        $this->add($file, $code, $pattern, $replace);

        return 0;
    }

    /**
     * @param string $code Code to add.
     * @param string $file Relative file path like 'Controllers/BaseController.php'.
     */
    protected function add(string $file, string $code, string $pattern, string $replace): void
    {
        $path      = $this->distPath . $file;
        $cleanPath = clean_path($path);

        $content = file_get_contents($path);

        $output = $this->replacer->add($content, $code, $pattern, $replace);

        if ($output === true) {
            CLI::error("  Skipped {$cleanPath}. It has already been updated.");

            return;
        }
        if ($output === false) {
            CLI::error("  Error checking {$cleanPath}.");

            return;
        }

        if (write_file($path, $output)) {
            CLI::write(CLI::color('  Updated: ', 'green') . $cleanPath);
        } else {
            CLI::error("  Error updating {$cleanPath}.");
        }
    }
}
