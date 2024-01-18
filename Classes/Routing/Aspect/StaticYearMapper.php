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

namespace DomjosModern\Routing\Aspect;

use Countable;
use Exception;
use InvalidArgumentException;
use TYPO3\CMS\Core\Routing\Aspect\StaticMappableAspectInterface;

class StaticYearMapper implements StaticMappableAspectInterface, Countable {
    /**
     * @var array
     */
    protected array $settings;


    /**
     * @param array $settings
     * @throws InvalidArgumentException
     */
    public function __construct(array $settings) {
        $this->settings = $settings;
    }

    public function count(): int {
        return 12;
    }

    public function generate(string $value): ?string {
        return $this->respondWhenInRange($value);
    }

    public function resolve(string $value): ?string {
        return $this->respondWhenInRange($value);
    }

    /**
     * @param string $value
     * @return string|null
     */
    protected function respondWhenInRange(string $value): ?string {
        try {
            $data = (int) $value;

            if($data <= 2060 && $data >= 1970) {
                return $data;
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }
}