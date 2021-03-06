<?php declare(strict_types = 1);
/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/artister
 */

namespace Artister\System\Compiler\Expressions;

use Artister\System\Compiler\ExpressionParser;
use Artister\System\Compiler\ExpressionVisitor;
use Closure;

class LambdaExpression extends Expression
{
    public $Body;
    public array $Parameters = [];
    public ?string $ReturnType = null;

    public function __construct($predicate, array $parameters = [], ?string $returnType = null)
    {
        if ($predicate instanceof Expression) {
            $this->Body = $predicate;
            $this->Parameters = $parameters;
            $this->ReturnType = $returnType;

        } else if ($predicate instanceof Closure) {
            $parser = ExpressionParser::getInstance();
            $parser->parse($predicate);
            $this->Body = $parser->getBody();
            $this->Parameters = $parser->getParameters();
            
        } else {
            throw new \Exception("argument 1 must be type of Closure or Expression ");
        }

    }

    public function accept(ExpressionVisitor $visitor)
    {
        $visitor->visitLambda($this);
    }
}