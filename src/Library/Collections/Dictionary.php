<?php declare(strict_types = 1);
/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/artister
 */

namespace Artister\System\Collections;

use ArrayAccess;
use Artister\System\Type;
use Artister\System\Exceptions\ArrayException;

class Dictionary implements ArrayAccess, IDictionary
{
    use \Artister\System\Collections\ArrayTrait;
    use \Artister\System\Extension\ExtensionTrait;

    public function __construct(string $keyType, string $valueType)
    {
        if ($keyType != Type::Integer && $keyType != Type::String)
        {
            throw ArrayException::keyConstraint();
        }

        $this->GenericType = new Type(self::class, new Type($keyType), new Type($valueType));
    }

    public function add($key, $value) : void
    {
        $this->offsetSet($key, $value);
    }

    public function contains($key): bool
    {
        return isset($this->Array[$key]) ? true : false;
    }

    public function remove($key) : void
    {
        if (isset($this->Array[$key])) {
            unset($this->Array[$key]);
        }
    }

    public function getValue($key)
    {
        return $this->Array[$key] ?? null; 
    }

    public function clear() : void
    {
        $this->Array = [];
    }

    public function getType() : Type
    {
        return $this->GenericType;
    }

    public function toArray() : array
    {
        return $this->Array;
    }
}