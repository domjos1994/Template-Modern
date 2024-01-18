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

$EM_CONF[$_EXTKEY] = [
    'title' => 'Modern Domjos-Typo3-Template',
    'description' => 'Modern Domjos-Typo3-Template',
    'category' => 'templates',
    'author' => 'Dominic Joas',
    'author_email' => 'developing@domjos.de',
    'author_company' => 'Domjos',
    'version' => '1.0.1',
    'state' => 'stable',
    'constraints' => [
        'depends' => [
            'typo3' => '11.4.0-12.4.99',
            'fluid_styled_content' => '11.4.0-12.4.99',
            'container' => '2.2.0-2.3.99'
        ],
        'conflicts' => [
        ],
        'suggests' => [
            'content_defender' => '3.4.0-3.4.99',
            'new' => '11.2.0-11.9.99'
        ]
    ],
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1
];