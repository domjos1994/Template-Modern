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

use B13\Container\Tca\ContainerConfiguration;
use B13\Container\Tca\Registry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

$lang = 'LLL:EXT:template_modern/Resources/Private/Language/container.xlf';
$icons = 'EXT:template_modern/Resources/Public/Icons';

// add preview-Renderer
$GLOBALS['TCA']["tt_content"]['ctrl']["textpic"]['previewRenderer'] = TemplateModern\PreviewRenderer\PreviewRenderer::class;

GeneralUtility::makeInstance(Registry::class)->configureContainer(
    (
        new ContainerConfiguration(
            '1col-with-header', // CType
            $lang . ':cce.1col.bg.title', // label
            $lang . ':cce.1col.bg.description', // description
            [
                [
                    ['name' => $lang . ':cce.1col.bgo.header', 'colPos' => 200, 'colspan' => 2, 'maxitems' => 1, 'allowed' => ['CType' => 'image']]
                ],
                [
                    ['name' => $lang . ':cce.1col.bgo.content', 'colPos' => 201, 'colspan' => 2]
                ]
            ] // grid configuration
        )
    )
    ->setIcon("$icons/container-1col.svg")
    ->setGroup('tm_layout')
);

GeneralUtility::makeInstance(Registry::class)->configureContainer(
    (
    new ContainerConfiguration(
        '2col-with-header', // CType
        $lang . ':cce.2col.bg.title', // label
        $lang . ':cce.2col.bg.description', // description
        [
            [
                ['name' => $lang . ':cce.1col.bgo.header', 'colPos' => 200, 'colspan' => 2, 'maxitems' => 1, 'allowed' => ['CType' => 'image']]
            ],
            [
                ['name' => $lang . ':cce.3col.bg.content1', 'colPos' => 201],
                ['name' => $lang . ':cce.3col.bg.content2', 'colPos' => 202]
            ]
        ] // grid configuration
    )
    )
        ->setIcon("$icons/container-2col.svg")
        ->setGroup('tm_layout')
);

GeneralUtility::makeInstance(Registry::class)->configureContainer(
    (
        new ContainerConfiguration(
            '3col-with-header', // CType
            $lang . ':cce.3col.bg.title', // label
            $lang . ':cce.3col.bg.description', // description
            [
                [
                    ['name' => $lang . ':cce.1col.bgo.header', 'colPos' => 200, 'colspan' => 3, 'maxitems' => 1, 'allowed' => ['CType' => 'image']]
                ],
                [
                    ['name' => $lang . ':cce.3col.bg.content1', 'colPos' => 201],
                    ['name' => $lang . ':cce.3col.bg.content2', 'colPos' => 202],
                    ['name' => $lang . ':cce.3col.bg.content3', 'colPos' => 203]
                ]
            ] // grid configuration
        )
    )
    ->setIcon("$icons/container-3col.svg")
    ->setGroup('tm_layout')
);

GeneralUtility::makeInstance(Registry::class)->configureContainer(
    (
    new ContainerConfiguration(
        'card', // CType
        $lang . ':cce.card.title', // label
        $lang . ':cce.card.description', // description
        [
            [
                ['name' => $lang . ':cce.card.header', 'colPos' => 200, 'allowed' => ['CType' => 'image']]
            ],
            [
                ['name' => $lang . ':cce.card.content', 'colPos' => 201]
            ],
            [
                ['name' => $lang . ':cce.card.footer', 'colPos' => 202]
            ]
        ] // grid configuration
    )
    )
        ->setIcon("$icons/card.svg")
        ->setGroup('tm_content')
);

GeneralUtility::makeInstance(Registry::class)->configureContainer(
(
    new ContainerConfiguration(
        'bento_item', // CType
        $lang . ':cce.bento.title', // label
        $lang . ':cce.bento.description', // description
        [
            [
                ['name' => $lang . ':cce.bento.header', 'colPos' => 200, 'allowed' => ['CType' => 'image']]
            ],
            [
                ['name' => $lang . ':cce.bento.content', 'colPos' => 201]
            ]
        ] // grid configuration
    )
  )
        ->setIcon("$icons/card.svg")
        ->setGroup('tm_content')
);

GeneralUtility::makeInstance(Registry::class)->configureContainer(
    (
        new ContainerConfiguration(
            'bg-video', // CType
            $lang . ':cce.video.bg.title', // label
            $lang . ':cce.video.bg.description', // description
            [
                [
                    ['name' => $lang . ':cce.video.bg.video', 'colPos' => 200, 'allowed' => ['CType' => 'textmedia']]
                ],
                [
                    ['name' => $lang . ':cce.video.bg.content', 'colPos' => 201]
                ]
            ] // grid configuration
        )
    )
    ->setIcon("$icons/video.svg")
    ->setGroup('tm_content')
);

GeneralUtility::makeInstance(Registry::class)->configureContainer(
    (
        new ContainerConfiguration(
            'slider', // CType
            $lang . ':cce.slider.title', // label
            $lang . ':cce.slider.description', // description
            [
                [
                    ['name' => $lang . ':cce.slider.content', 'colPos' => 200, 'allowed' => ['CType' => 'textpic, image']]
                ]
            ] // grid configuration
        )
    )
    ->setIcon("$icons/slider.svg")
    ->setGroup('tm_content')
);

GeneralUtility::makeInstance(Registry::class)->configureContainer(
    (
    new ContainerConfiguration(
        'horizontal-gallery', // CType
        $lang . ':cce.horizontal-gallery.title', // label
        $lang . ':cce.horizontal-gallery.description', // description
        [
            [
                ['name' => $lang . ':cce.horizontal-gallery.content', 'colPos' => 200, 'allowed' => ['CType' => 'image']]
            ]
        ] // grid configuration
    )
    )
        ->setIcon("$icons/gallery.svg")
        ->setGroup('tm_content')
);

GeneralUtility::makeInstance(Registry::class)->configureContainer(
    (
        new ContainerConfiguration(
            'tab-pane',
            $lang . ':cce.tab_pane.title', // label
            $lang . ':cce.tab_pane.description', // description
            [
                [
                    ['name' => $lang . ':cce.tab_pane.tab1', 'colPos' => 100, 'allowed' => ['CType' => 'header']],
                    ['name' => $lang . ':cce.tab_pane.tab2', 'colPos' => 101, 'allowed' => ['CType' => 'header']],
                    ['name' => $lang . ':cce.tab_pane.tab3', 'colPos' => 102, 'allowed' => ['CType' => 'header']]
                ],
                [
                    ['name' => $lang . ':cce.tab_pane.content', 'colPos' => 200],
                    ['name' => $lang . ':cce.tab_pane.content', 'colPos' => 201],
                    ['name' => $lang . ':cce.tab_pane.content', 'colPos' => 202]
                ]

            ] // grid configuration
        )
    )
    ->setIcon("$icons/tab_pane.svg")
    ->setGroup('tm_content')
);

GeneralUtility::makeInstance(Registry::class)->configureContainer(
    (
    new ContainerConfiguration(
        'accordion',
        $lang . ':cce.accordion.title', // label
        $lang . ':cce.accordion.description', // description
        [
            [
                ['name' => $lang . ':cce.tab_pane.content', 'colPos' => 100, 'allowed' => ['CType' => 'text,textpic,textmedia']],
            ]

        ] // grid configuration
    )
    )
        ->setIcon("$icons/accordion.svg")
        ->setGroup('tm_content')
);

ExtensionManagementUtility::addTCAcolumns('tt_content', [
    'template_modern_bg_color' => [
        'exclude' => 0,
        'label' => $lang . ':cce.bg',
        'config' => [
            'type' => 'input',
            'renderType' => 'colorpicker',
        ],
    ],
    'template_modern_gallery_height' => [
        'exclude' => 0,
        'label' => $lang . ':cce.horizontal-gallery.height',
        'config' => [
            'type' => 'input',
            'renderType' => 'number',
        ],
    ],
]);

$GLOBALS['TCA']['tt_content']['types']['tab-pane']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,template_modern_bg_color,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';
$GLOBALS['TCA']['tt_content']['types']['1col-with-header']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['tab-pane']['showitem'];
$GLOBALS['TCA']['tt_content']['types']['2col-with-header']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['tab-pane']['showitem'];
$GLOBALS['TCA']['tt_content']['types']['3col-with-header']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['tab-pane']['showitem'];
$GLOBALS['TCA']['tt_content']['types']['slider']['showitem'] = $GLOBALS['TCA']['tt_content']['types']['tab-pane']['showitem'];
$GLOBALS['TCA']['tt_content']['types']['horizontal-gallery']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,template_modern_gallery_height,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';

ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:template_modern/Resources/Private/Language/custom_ce.xlf:banner.title',
        'template_modern_banner',
        "$icons/banner.png"
    ],
    'textmedia',
    'after'
);

$GLOBALS['TCA']['tt_content']['types']['template_modern_banner'] = [
    'previewRenderer' => \TemplateModern\EventListener\BannerPreviewRenderer::class,
    'showitem' => '
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
               --palette--;;general,
               pi_flexform,
            --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
               --palette--;;hidden,
               --palette--;;access,
         ',
    'columnsOverrides' => [
        'bodytext' => [
            'config' => [
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
            ],
        ],
    ],
];

ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:template_modern/Configuration/FlexForms/ContentElements/banner.xml',
    'template_modern_banner'
);

