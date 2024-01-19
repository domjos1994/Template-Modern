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

use DominicJoas\Helper;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

class TinifyTask extends AbstractTask {

    public function __construct(protected ?LoggerInterface $logger) {
        parent::__construct();
    }

    public function execute(): bool
    {
        $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
        $path = ExtensionManagementUtility::extPath('template_modern') . "Classes";
        require_once($path . "/Helper.php");

        $resourceFactory = GeneralUtility::makeInstance(ResourceFactory::class);
        $resourceStorage = $resourceFactory->getDefaultStorage();
        $rootFolder = $resourceStorage->getRootLevelFolder();
        $data = $this->getAllFiles($rootFolder, $resourceStorage);
        Helper::initTinify();

        $counter = 0;
        foreach($data as $value) {
             Helper::compressAndRenameIfEnabled($value, $resourceStorage, $connectionPool);
             $counter++;
        }

        $item = LocalizationUtility::translate("tinify.task.schedule",  "template_modern");
        $this->logger->info("$item " . $counter);

        return true;
    }

    private function getAllFiles(Folder $folder, ResourceStorage $storage, $result = []): Array {
        try {
            $files = $storage->getFilesInFolder($folder);
            foreach($files as  $file) {
                if($file->isImage() && !str_ends_with($file->getNameWithoutExtension(), "_tinify")) {
                    $identifier =
                        str_replace(
                            ".".$file->getExtension(),
                            "_tinify.".$file->getExtension(),
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
