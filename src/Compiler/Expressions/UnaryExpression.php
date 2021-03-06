<?php declare(strict_types = 1);
/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/artister
 */

namespace Artister\System\Compiler\Expressions;

use Artister\System\Compiler\ExpressionVisitor;

class UnaryExpression extends Expression
{
    public string $Name;
    public Expression $Operand;

    public function __construct(string $name, Expression $operand)
    {
        $this->Name = $name;
        $this->Operand = $operand;
    }

    public function accept(ExpressionVisitor $visitor)
    {
        $visitor->visitUnary($this);
    }
}