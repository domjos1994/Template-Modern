<?php
/*
 * Copyright (c) Domjos 2023
 *
 * This file is part of Domjos-Modern.
 * Domjos-Modern is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 * Domjos-Modern is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with Foobar. If not, see https://www.gnu.org/licenses/.
 */

namespace TemplateModern\Tasks;

use Exception;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Scheduler\Task\AbstractTask;
use DominicJoas\Helper;

class WebpTask extends AbstractTask
{

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(): bool
    {
        $resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);
        $resourceStorage = $resourceFactory->getDefaultStorage();
        $rootFolder = $resourceStorage->getRootLevelFolder();
        $files = $this->getAllFiles($rootFolder, $resourceStorage);

        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $path = ExtensionManagementUtility::extPath('template_modern') . "Classes";
        require_once($path . "/Helper.php");

        foreach($files as $identifier => $file) {
            try {
                $fileData = $resourceStorage->getFileByIdentifier($identifier);
                $path =  $_SERVER["DOCUMENT_ROOT"] . "/" . $fileData->getPublicUrl();

                Helper::webpConvert2(
                    $path, $file, $rootFolder, $connectionPool, $fileData->getExtension(), 90
                );
            } catch (Exception $ex) {
                Helper::genMessage("Exception", $ex->getMessage(), "e");
            }
        }

        return true;
    }

    private function getAllFiles(Folder $folder, ResourceStorage $storage, $result = []): Array {
        try {
            $files = $storage->getFilesInFolder($folder);
            foreach($files as  $file) {
                if($file->isImage() && !str_ends_with($file->getExtension(), "webp")) {
                    $identifier =
                        str_replace(
                            ".".$file->getExtension(),
                            ".webp",
                            $file->getIdentifier()
                        );
                    if(!$storage->hasFile($identifier)) {
                        $result[$file->getIdentifier()] = $file;
                    }
                }
            }
        } catch (InsufficientFolderAccessPermissionsException) {}

        $folders = $storage->getFoldersInFolder($folder);
        foreach ($folders as $folder) {
            $result = $this->getAllFiles($folder, $storage, $result);
        }

        return $result;
    }
}
