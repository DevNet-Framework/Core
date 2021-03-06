<?php declare(strict_types = 1);
/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/artister
 */

namespace Artister\System\Collections;

use Iterator;
use Countable;

class Enumerator implements Iterator, Countable
{
    protected array $Array = [];
    protected $Key;

    public function __construct(array $Array = [])
    {
        $this->Array = $Array;
    }

    public function rewind()
    {
        reset($this->Array);
        $this->Key = key($this->Array);
    }

    public function next()
    {
        next($this->Array);
        $this->Key = key($this->Array);
    }

    public function valid()
    {
        return isset($this->Array[$this->Key]);
    }

    public function current()
    {
        return $this->Array[$this->Key] ?? null;
    }

    public function key()
    {
        return $this->Key ?? null;
    }

    public function count() : int
    {
        return count($this->Array);
    }

    public function toArray()
    {
        return $this->Array;
    }
}