<?php

namespace TemplateModern\EventListener;

use TYPO3\CMS\Backend\Preview\PreviewRendererInterface;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Core\Utility\GeneralUtility;

readonly class BannerPreviewRenderer implements PreviewRendererInterface
{

    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        return $this->renderFlexFormSub($item);
    }

    public function renderPageModulePreviewHeader(GridColumnItem $item): string
    {
        return $this->renderFlexFormSub($item);
    }

    public function renderPageModulePreviewFooter(GridColumnItem $item): string
    {
        return $this->renderFlexFormSub($item);
    }

    public function wrapPageModulePreview(string $previewHeader, string $previewContent, GridColumnItem $item): string
    {
        return $this->renderFlexFormMain($item);
    }

    private function renderFlexFormMain(GridColumnItem $item)
    {
        $ffContent = GeneralUtility::xml2array($item->getRecord()["pi_flexform"]);
        $data = $ffContent["data"]["main"]["lDEF"];
        $title = $data["title"]["vDEF"];
        $sub = $data["subtitle"]["vDEF"];

        return "<h2>$title</h2><p>$sub</p>";
    }

    private function renderFlexFormSub(GridColumnItem $item)
    {
        $ffContent = GeneralUtility::xml2array($item->getRecord()["pi_flexform"]);
        $data = $ffContent["data"]["main"]["lDEF"];
        $image = $data["image"]["vDEF"];
        $color = $data["color"]["vDEF"];
        $bg_color = $data["background_color"]["vDEF"];

        return "Image: $image, color: $color, background: $bg_color";
    }
}