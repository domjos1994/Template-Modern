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

namespace DominicJoas;

use Exception;
use Imagick;
use ImagickException;
use Tinify\Tinify;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Resource\Exception\ExistingTargetFileNameException;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use function Tinify\fromBuffer;

class Helper {

    /**
     * Compresses images if the settings for tinify are enabled
     * in the plugin configuration
     * @param $event
     * @return void
     */
    public static function compressIfEnabled($event): void {
        $enabled = Helper::findConstants("tinify.enabled");
        $key = Helper::findConstants("tinify.key");

        if($enabled) {
            Helper::initTinify();
            Tinify::setKey($key);

            Helper::compress($event->getFile());

            $title = Helper::getString("locallang.xlf", "tinify.success.title");
            $msg = Helper::getString("locallang.xlf", "tinify.success.msg");
            Helper::genMessage($title, $msg, "i");
        }
    }

    /**
     * Compresses Images with tinify.
     * Need to set the Api-Key before
     * and initialize tinify.
     * @see Helper::initTinify()
     * @param FileInterface $file
     * @return void
     */
    public static function compress(FileInterface $file): void {
        try {
            $source = fromBuffer($file->getContents());
            $file->setContents($source->toBuffer());
        } catch (Exception $ex) {
            Helper::genMessage("Error compress image!", $ex->getMessage(), "e");
        }
    }

    /**
     * Compresses Images with tinify.
     * Need to set the Api-Key before
     * and initialize tinify.
     * @see Helper::initTinify()
     * @param FileInterface $file
     * @param ResourceStorage $storage
     * @param ConnectionPool $pool
     * @return void
     */
    public static function compressAndRename(FileInterface $file, ResourceStorage $storage, ConnectionPool $pool): void {
        try {
            $source = fromBuffer($file->getContents());
            $identifier =
                str_replace(
                    ".".$file->getExtension(),
                    "_tinify.".$file->getExtension(),
                    $file->getName()
                );

            $folder = $storage->getFolder($storage->getFolderIdentifierFromFileIdentifier($file->getIdentifier()));
            $newFile = $storage->copyFile($file, $folder, $identifier);
            $newFile->setContents($source->toBuffer());

            Helper::renameReference($file->getIdentifier(), $newFile->getIdentifier(), $pool);
        } catch (Exception $ex) {
            Helper::genMessage("Error compress image!", $ex->getMessage() . $ex->getLine(), "e");
        }
    }

    private static function renameReference($identifier, $newIdentifier, ConnectionPool $pool): void {
        try {
            $queryBuilder = $pool->getQueryBuilderForTable('sys_file')->select("*")->from("sys_file");
            $queryBuilder = $queryBuilder->where("identifier='". $identifier ."' or identifier='". $newIdentifier ."'");
            $result = $queryBuilder->executeQuery();
            $array = [];
            $i = 0;
            while ($row = $result->fetchAssociative()) {
                $array[$i] = $row["uid"];
                $i++;
            }

            $queryBuilder = $pool->getQueryBuilderForTable("sys_file_reference")->update("sys_file_reference");
            $queryBuilder = $queryBuilder->where("uid_local=$array[0]")->set("uid_local", $array[1]);
            $queryBuilder->executeStatement();
        } catch (Exception $ex) {
            Helper::genMessage("Error compress image!", $ex->getMessage() . $ex->getLine(), "e");
        }
    }

    /**
     * Compresses images if the settings for tinify are enabled
     * in the plugin configuration
     * @param FileInterface $file
     * @param ResourceStorage $storage
     * @param ConnectionPool $pool
     * @return void
     */
    public static function compressAndRenameIfEnabled(FileInterface $file, ResourceStorage $storage, ConnectionPool $pool): void {
        $enabled = Helper::findConstants("tinify.enabled");
        $key = Helper::findConstants("tinify.key");

        if($enabled) {
            Helper::initTinify();
            Tinify::setKey($key);

            Helper::compressAndRename($file, $storage, $pool);
        }
    }

    /**
     * Initialize Tinify
     * @return void
     */
    public static function initTinify(): void {
        try {
            $path = ExtensionManagementUtility::extPath('domjos_modern') . "Classes";
            require_once($path . "/lib/Tinify/Exception.php");
            require_once($path . "/lib/Tinify/ResultMeta.php");
            require_once($path . "/lib/Tinify/Result.php");
            require_once($path . "/lib/Tinify/Source.php");
            require_once($path . "/lib/Tinify/Client.php");
            require_once($path . "/lib/Tinify.php");
        } catch (Exception $ex) {
            Helper::genMessage("Error initialize Tinify!", $ex->getMessage(), "e");
        }
    }

    /**
     * Finds a constant in the plugin-settings
     * @param $key
     * @return mixed|string
     */
    public static function findConstants($key): mixed {
        try {
            $utility = GeneralUtility::makeInstance(
                ExtensionConfiguration::class
            );
            $extension = $utility->get("domjos_modern");

            $current = $extension;
            foreach(explode(".", $key) as $item) {
                $current = $current[$item];
            }
            return $current;
        } catch (Exception $ex) {
            Helper::genMessage("Error finding constants!", $ex->getMessage(), "e");
        }
        return "";
    }

    /**
     * @param $file
     * @param $extension
     * @param int $compression_quality
     * @return bool
     * @throws ImagickException
     * @throws ExistingTargetFileNameException
     */
    public static function webpConvert2($file, File $fileObject, Folder $folder, ConnectionPool $pool, $extension, int $compression_quality = 80): bool {
        // check if file exists
        if (!file_exists($file)) {
            return false;
        }
        $file_type = exif_imagetype($file);
        $output_file =  str_replace(".$extension",".webp",$file);
        if (file_exists($output_file)) {
            return $output_file;
        }
        if (function_exists('imagewebp')) {
            switch ($file_type) {
                case '1': //IMAGETYPE_GIF
                    $image = imagecreatefromgif($file);
                    break;
                case '2': //IMAGETYPE_JPEG
                    $image = imagecreatefromjpeg($file);
                    break;
                case '3': //IMAGETYPE_PNG
                    $image = imagecreatefrompng($file);
                    imagepalettetotruecolor($image);
                    imagealphablending($image, true);
                    imagesavealpha($image, true);
                    break;
                case '6': // IMAGETYPE_BMP
                    $image = imagecreatefrombmp($file);
                    break;
                case '15': //IMAGETYPE_Webp
                    return false;
                case '16': //IMAGETYPE_XBM
                    $image = imagecreatefromxbm($file);
                    break;
                default:
                    return false;
            }
            // Save the image
            $result = imagewebp($image, $output_file, $compression_quality);
            if (false === $result) {
                return false;
            }
            // Free up memory
            imagedestroy($image);

            // Todo Add reference
//            $factory = GeneralUtility::makeInstance(ResourceFactory::class);
//            $file = $factory->getDefaultStorage()->addFile($output_file, $folder);
//            Helper::renameReference($fileObject->getIdentifier(), $file->getIdentifier(), $pool);

            return $output_file;
        } elseif (class_exists('Imagick')) {
            $image = new Imagick();
            $image->readImage($file);
            if ($file_type == "3") {
                $image->setImageFormat('webp');
                $image->setImageCompressionQuality($compression_quality);
                $image->setOption('webp:lossless', 'true');
            }
            $image->writeImage($output_file);
            return $output_file;
        }
        return false;
    }

    /**
     * Generates a Message
     * @param String $title
     * @param String $msg
     * @param string $status (error, info, warning, notice, ok) or (e, i, w, n, ok)
     * @return void
     */
    public static function genMessage(String $title, String $msg, string $status): void {
        if($title == null && $msg == null) {
            return;
        } else {
            if($title == null) {
                $title = $msg;
            } else if($msg == null) {
                $msg = $title;
            }
        }

        $type = match (trim(strtolower($status))) {
            "error", "e" => ContextualFeedbackSeverity::ERROR,
            "notice", "n" => ContextualFeedbackSeverity::NOTICE,
            "warning", "w" => ContextualFeedbackSeverity::WARNING,
            "ok" => ContextualFeedbackSeverity::OK,
            default => ContextualFeedbackSeverity::INFO,
        };

        $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
        $messageQueue = $flashMessageService->getMessageQueueByIdentifier();
        $message = GeneralUtility::makeInstance(FlashMessage::class, $msg, $title, $type, true);
        $messageQueue->addMessage($message);
    }

    /**
     * Get Localized string
     * @param String $fileName (container.xlf or locallang.xlf)
     * @param String $key
     * @return string|null
     */
    public static function getString(String $fileName, String $key): ?string {
        return LocalizationUtility::translate("LLL:EXT:template_modern/Resources/Private/Language/$fileName:" . $key, "template_modern");
    }
}
