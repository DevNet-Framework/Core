<?php declare(strict_types = 1);
/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/artister
 */

namespace Artister\System\Collections;

use Artister\System\Type;
use Artister\System\StringBuilder;
use Artister\System\Exceptions\ErrorMessageExtension;
use Artister\System\Exceptions\TypeException;

trait ArrayTrait
{
    protected array $Array  = [];

    abstract public function getType() : Type;

    /** 
     * set to the array an element with the provided key and value.
     */
    public function offsetSet($key, $value)
    {
        $genericType = $this->getType();
        $result = $genericType->validateArguments($key ?? 0, $value);

        switch ($result)
        {
            case 1:
                $message = new StringBuilder();
                $message->invalidKeyType(get_class($this), Type::Integer);
                throw new TypeException($message->__toString());
                break;
        }

        if ($key != null)
        {
            $this->Array[$key] = $value;
        }
        else
        {
            $this->Array[] = $value;
        }
    }

    /**
     * check if the array contains an element with the specified key
     */
    public function offsetExists($key) : bool
    {
        return isset($this->Array[$key]);
    }

    /**
     * Gets the element associated with the specified key
     */
    public function offsetGet($key)
    {
        return $this->Array[$key] ?? null;
    }

    /**
     * unset an element associated with the specified key
     */
    public function offsetUnset($key)
    {
        unset($this->Array[$key]);
    }

    /**
     * return the size of the array
     */
    public function getLength() : int
    {
        return count($this->Array);
    }

    /** 
     * reverse the order of the array items
     */
    public function reverse() : ArrayList
    {
        array_reverse($this->Array);
        return $this;
    }

    /**
     * return Iterable collection of values
     */
    public function getIterator() : Enumerator
    {
        return new Enumerator($this->Array);
    }
}