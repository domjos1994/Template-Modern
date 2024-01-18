# Domjos-Modern
A modern fluid based Typo3-Template.
The Template is using Bootstrap 5.

## How to install
The installation of the Template is described [here](Documentation/Installation.md).

## Features

- [multiple Backend-Layout (One - Three Columns with header)](Documentation/Content/Layout.md)
- [Background-Image for Header](Documentation/Content/Layout.md#header)
- [Background-Slider for Whole web-page (Page-Resources)](Documentation/Content/Slider.md)
- [Breadcrumb](Documentation/Menu/breadcrumb.md)
- [Footer-Menu](Documentation/Menu/footer.md)
  - [Sub Menu](Documentation/Menu/footer.md#1-enable-footer-menu)
  - [Contact-Bar](Documentation/Menu/footer.md#2-options)
- multiple Content-Elements (*)
    - Text with Background Image
    - Text with Background-Video
    - Bootstrap-Card
    - Bootstrap-Slider
    - Multiple Columns
    - Gallery
    - Card-Gallery
    - Accordion
- Download-Area
- [Multi-Language-Support](Documentation/Menu/language.md)
- [News and Events (*)](Documentation/ExtensionNeeded/News.md)
- [Search (*)](Documentation/ExtensionNeeded/Search.md)
- [compress images on upload and replace with tinify](Documentation/External/tinify.md)
- [Tasks to compress with tinify and generate Webp-Images](Documentation/ExtensionNeeded/Tasks.md)
- [contact-form](Documentation/Features/form.md)

(*) Extension needed

## Technical Documentation
The technical Documentation is [here](Documentation/Technical/index.md).

## Preview
Want to have a Preview of the Template?<br/>
Go to the <a href="https://domjos-modern.domjos-test.de" title="Demo-Site">Demo-Site</a>.

## Extensions Needed
- <a href="https://extensions.typo3.org/extension/container" title="Container Content Elements" target="_blank">Container Content Elements</a>
- <a href="https://extensions.typo3.org/extension/content_defender" title="Content Defender" target="_blank">Content Defender</a>
- <a href="https://extensions.typo3.org/extension/news" title="News system" target="_blank">News system</a>
- <a href="https://extensions.typo3.org/extension/eventnews" title="News events" target="_blank">News events</a>

## Notice
Include webp to image-file-extensions:
```
$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'] = 'gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai,svg,webp';
```

## License Header
Copyright (c) Domjos 2023<br/>
This file is part of Domjos-Modern.<br/>
Domjos-Modern is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.<br/>
Domjos-Modern is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.<br/>
You should have received a copy of the GNU General Public License along with Foobar. If not, see http://www.gnu.org/licenses/.