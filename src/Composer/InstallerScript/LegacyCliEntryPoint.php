<?php
declare(strict_types = 1);

namespace Pagemachine\ComposerLegacyCli\Composer\InstallerScript;

/*
 * This file is part of the Pagemachine TYPO3 Composer legacy CLI project.
 */

use Composer\Script\Event;
use Composer\Util\Filesystem;
use TYPO3\CMS\Composer\Plugin\Config;
use TYPO3\CMS\Composer\Plugin\Core\InstallerScript;

/**
 * Entry point for the legacy cli_dispatch.phpsh
 */
class LegacyCliEntryPoint implements InstallerScript
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @param Filesystem|null $filesystem
     */
    public function __construct(Filesystem $filesystem = null)
    {
        $this->filesystem = $filesystem ?: new Filesystem();
    }

    /**
     * Create cli_dispatch.phps entrypoint
     *
     * @param Event $event
     * @return bool
     */
    public function run(Event $event): bool
    {
        $composer = $event->getComposer();
        $pluginConfig = Config::load($composer);
        $rootDir = $pluginConfig->get('root-dir');
        $scriptPath = $rootDir . '/typo3/cli_dispatch.phpsh';

        $autoloadFile = $composer->getConfig()->get('vendor-dir') . '/autoload.php';
        $autoloadPath = $this->filesystem->findShortestPathCode($scriptPath, $autoloadFile);

        $scriptContent = <<<CONTENT
#!/usr/bin/env php
<?php
/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
// Exit early if php requirement is not satisfied.
if (version_compare(PHP_VERSION, '7.0.0', '<')) {
    die('This version of TYPO3 CMS requires PHP 7.0 or above');
}
/**
 * --------------------------------------------------------------------------------
 * NOTE: This entry-point is deprecated since TYPO3 v8 and will be removed in
 * TYPO3 v9. Use the binary located typo3/sysext/core/bin/typo3 instead.
 * --------------------------------------------------------------------------------
 * Command Line Interface module dispatcher
 *
 * This script takes a "cliKey" as first argument and uses that to dispatch
 * the call to a registered script with that key.
 * Valid cliKeys must be registered in
 * \$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['GLOBAL']['cliKeys'].
 */
call_user_func(function () {
    \$classLoader = require $autoloadPath;
    (new \TYPO3\CMS\Backend\Console\Application(\$classLoader))->run();
});
CONTENT;

        $this->filesystem->ensureDirectoryExists(dirname($scriptPath));
        file_put_contents($scriptPath, $scriptContent);
        chmod($scriptPath, 0755);

        return true;
    }
}
