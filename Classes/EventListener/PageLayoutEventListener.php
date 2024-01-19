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

namespace TemplateModern\EventListener;

use TYPO3\CMS\Backend\View\Event\AfterSectionMarkupGeneratedEvent;

final class PageLayoutEventListener
{
    public function __invoke(AfterSectionMarkupGeneratedEvent $event): void
    {
        $event->setContent("<div class='t3-page-ce-footer'>Anzahl: " . count($event->getRecords()) . "</div>");
    }
}
