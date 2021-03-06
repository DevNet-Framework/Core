<?php declare(strict_types = 1);
/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/artister
 */

namespace Artister\System\Exceptions;

use Exception;

class FileException extends Exception
{
    public static function fileNotFound() : self
    {
        return new self('No resource available; cannot tell position');
    }
}