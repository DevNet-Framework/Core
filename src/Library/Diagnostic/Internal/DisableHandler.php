<?php declare(strict_types = 1);
/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/artister
 */

namespace Artister\System\Diagnostic\Internal;

use Artister\System\Diagnostic\IDebugHandler;
use Throwable;

class DisableHandler implements IDebugHandler
{
    public function handle(Throwable $error) : void
    {
        $code = $error->getCode();
        $message = $error->getMessage();

        if ($code < 400 || $code > 599)
        {
            $code = 500;
        }
        
        header("HTTP/1.0 $code $message");
    }
}