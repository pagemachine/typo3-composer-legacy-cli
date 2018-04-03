<?php
declare(strict_types = 1);

namespace Pagemachine\ComposerLegacyCli\Composer;

/*
 * This file is part of the Pagemachine TYPO3 Composer legacy CLI project.
 */

use Composer\Script\Event;
use Pagemachine\ComposerLegacyCli\Composer\InstallerScript\LegacyCliEntryPoint;
use TYPO3\CMS\Composer\Plugin\Core\InstallerScriptsRegistration;
use TYPO3\CMS\Composer\Plugin\Core\ScriptDispatcher;

/**
 * Installer script for the TYPO3 Composer setup
 */
class InstallerScripts implements InstallerScriptsRegistration
{
    /**
     * @param Event $event
     * @param ScriptDispatcher $scriptDispatcher
     */
    public static function register(Event $event, ScriptDispatcher $scriptDispatcher)
    {
        $scriptDispatcher->addInstallerScript(new LegacyCliEntryPoint(), 81);
    }
}
