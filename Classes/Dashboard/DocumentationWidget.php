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

namespace TemplateModern\Dashboard;

use Parsedown;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

class DocumentationWidget implements WidgetInterface {

    private WidgetConfigurationInterface $configuration;
    private StandaloneView $view;
    private array $options;

    public function __construct(WidgetConfigurationInterface $configuration, StandaloneView $view, array $options = []) {
        $this->configuration = $configuration;
        $this->view = $view;
        $this->options = $options;
    }

    public function renderWidgetContent(): string
    {
        $path = ExtensionManagementUtility::extPath('template_modern') . "Classes";
        include_once("$path/lib/Parsedown.php");

        $abs = GeneralUtility::getFileAbsFileName("EXT:template_modern/Documentation");
        $arr = [];
        $dirs = $this->getDirContents($abs, $arr);

        $data = "<ul>";
        $md = new Parsedown();

        $arr = [];
        $imgs = $this->getDirContents("$abs/Images", $arr);
        $base64Img = [];
        foreach($imgs as $img) {
            $binaryData = file_get_contents($img);
            $base64Data = base64_encode($binaryData);
            $base64Img["Images/".basename($img)] = $base64Data;
        }

        $counter = 1;
        foreach ($dirs as $item) {
            if(str_ends_with($item, ".md")) {
                $name = str_replace(".md", "", basename($item));
                $content = $md->text(file_get_contents($item));

                foreach($base64Img as $key => $value) {
                    $content = str_replace("../$key","data:image/jpeg;base64,$value", $content);
                    $content = str_replace($key,"data:image/jpeg;base64,$value", $content);
                }

                $icon = "<typo3-backend-tree-node-toggle class='treelist-control collapsed' data-bs-toggle='collapse' data-bs-target='#collapse-list-$counter' aria-expanded='false'><typo3-backend-icon size='small' identifier='actions-chevron-right'></typo3-backend-icon></typo3-backend-tree-node-toggle>";

                $data .= "<li>$icon<span class='treelist-group treelist-group-monospace'><span class='treelist-label'>$name</span></span><div id='collapse-list-$counter' class='treelist-collapse collapse'>$content</div></li>";
                $counter++;
            }
        }
        $data .= "</ul>";

        $this->view->setTemplateRootPaths(["EXT:template_modern/Resources/Private/Templates"]);
        $this->view->assignMultiple([
            'configuration' => $this->configuration,
            'options' => $this->options,
            'files' => $data,
        ]);
        return $this->view->render("Widget/Documentation");
    }

    public function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
