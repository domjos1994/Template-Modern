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

use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;

return [
    'newspaper' => [
        'provider' => BitmapIconProvider::class,
        // The source bitmap file
        'source' => 'EXT:template_modern/Resources/Public/Icons/newspaper.png',
    ],
    'banner_icon' => [
        'provider' => BitmapIconProvider::class,
        // The source bitmap file
        'source' => 'EXT:template_modern/Resources/Public/Icons/banner.png',
    ],
    'extension_icon' => [
        'provider' => BitmapIconProvider::class,
        // The source bitmap file
        'source' => 'EXT:template_modern/Resources/Public/Icons/Extension.png',
    ],
];
