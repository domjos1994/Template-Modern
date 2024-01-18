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

namespace Tinify;

class Result extends ResultMeta {
    protected $data;

    public function __construct($meta, $data) {
        $this->meta = $meta;
        $this->data = $data;
    }

    public function data() {
        return $this->data;
    }

    public function toBuffer() {
        return $this->data;
    }

    public function toFile($path) {
        return file_put_contents($path, $this->toBuffer());
    }

    public function size() {
        return intval($this->meta["content-length"]);
    }

    public function mediaType() {
        return $this->meta["content-type"];
    }

    public function contentType() {
        return $this->mediaType();
    }
}
