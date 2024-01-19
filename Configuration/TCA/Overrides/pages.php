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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

call_user_func(function() {
    $extensionKey = 'template_modern';

    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/TCAdefaults.tsconfig',
        'Default-Values'
    );
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/TCEForm.tsconfig',
        'Replace Layout and other fields'
    );
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/ContentElement/Categories.tsconfig',
        'Rename Categories'
    );
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/ContentElement/ce.tsconfig',
        'Custom Content-Elements'
    );
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/BackendLayouts/OneColumns.tsconfig',
        '1 Column'
    );
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/BackendLayouts/OneColumnNoHeader.tsconfig',
        '1 Column without Header'
    );
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/BackendLayouts/TwoColumns.tsconfig',
        '2 Column'
    );
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/BackendLayouts/TwoColumnsNoHeader.tsconfig',
        '2 Columns without Header'
    );
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/BackendLayouts/TwoColumnsMain.tsconfig',
        '2 Column with Main-Area'
    );
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/BackendLayouts/TwoColumnsMainNoHeader.tsconfig',
        '2 Columns with Main-Area without Header'
    );
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/BackendLayouts/ThreeColumns.tsconfig',
        '3 Column'
    );
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/BackendLayouts/ThreeColumnsNoHeader.tsconfig',
        '3 Columns without Header'
    );
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/BackendLayouts/ThreeColumnsMain.tsconfig',
        '3 Columns with Main-Area'
    );
    ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/PageTSConfig/BackendLayouts/ThreeColumnsMainNoHeader.tsconfig',
        '3 Columns with Main-Area without Header'
    );
});
