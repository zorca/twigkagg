<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TwigKagg\Node\Expression;

use TwigKagg\Compiler;

class ConstantExpression extends AbstractExpression
{
    public function __construct($value, $lineno)
    {
        parent::__construct([], ['value' => $value], $lineno);
    }

    public function compile(Compiler $compiler)
    {
        $compiler->repr($this->getAttribute('value'));
    }
}

class_alias('TwigKagg\Node\Expression\ConstantExpression', 'TwigKagg_Node_Expression_Constant');
