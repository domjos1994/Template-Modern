<?php
/*
 * Copyright (c) Domjos 2023
 *
 * This file is part of Domjos-Modern.
 * Domjos-Modern is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 * Domjos-Modern is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with Foobar. If not, see http://www.gnu.org/licenses/.
 */

use DomjosModern\Routing\Aspect\StaticMonthMapper;
use DomjosModern\Routing\Aspect\StaticDayMapper;
use DomjosModern\Routing\Aspect\StaticYearMapper;
use Psr\Log\LogLevel as LogLevelAlias;
use TYPO3\CMS\Core\Log\LogLevel;
use TYPO3\CMS\Core\Log\Writer\SyslogWriter;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

// Register mapper for news
$GLOBALS['TYPO3_CONF_VARS']['SYS']['routing']['aspects']['StaticMonthMapper'] = StaticMonthMapper::class;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['routing']['aspects']['StaticDayMapper'] = StaticDayMapper::class;
$GLOBALS['TYPO3_CONF_VARS']['SYS']['routing']['aspects']['StaticYearMapper'] = StaticYearMapper::class;

// rich text editor
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['domjos_modern'] = 'EXT:domjos_modern/Configuration/RTE/DomjosModern.yaml';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['DomjosModern\Tasks\TinifyTask'] = array(
    'extension' => "domjos_modern",
    'title' => 'LLL:EXT:domjos_modern/Resources/Private/Language/locallang.xlf:tinify.task.title',
    'description' => 'LLL:EXT:domjos_modern/Resources/Private/Language/locallang.xlf:tinify.task.description',
);
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['DomjosModern\Tasks\WebpTask'] = array(
    'extension' => "domjos_modern",
    'title' => 'LLL:EXT:domjos_modern/Resources/Private/Language/locallang.xlf:webp.task.title',
    'description' => 'LLL:EXT:domjos_modern/Resources/Private/Language/locallang.xlf:webp.task.description',
);

$GLOBALS['TYPO3_CONF_VARS']['LOG']['DominicJoas']['domjos_modern']['TinifyTask']['writerConfiguration'] = [
    // Configuration for ERROR level log entries
    LogLevelAlias::INFO => [
        // Add a FileWriter
        SysLogWriter::class => [],
    ],
];

ExtensionManagementUtility::addTypoScriptSetup(trim('
    module.tx_form {
        settings {
            yamlConfigurations {
                110 = EXT:domjos_modern/Configuration/Form/Setup.yaml
            }
        }
    }
    plugin.tx_form {
        settings {
            yamlConfigurations {
                110 = EXT:domjos_modern/Configuration/Form/Setup.yaml
            }
        }
    }
'));