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

namespace TwigKagg\Node\Expression\Unary;

use TwigKagg\Compiler;
use TwigKagg\Node\Expression\AbstractExpression;

abstract class AbstractUnary extends AbstractExpression
{
    public function __construct(\TwigKagg_NodeInterface $node, $lineno)
    {
        parent::__construct(['node' => $node], [], $lineno);
    }

    public function compile(Compiler $compiler)
    {
        $compiler->raw(' ');
        $this->operator($compiler);
        $compiler->subcompile($this->getNode('node'));
    }

    abstract public function operator(Compiler $compiler);
}

class_alias('TwigKagg\Node\Expression\Unary\AbstractUnary', 'TwigKagg_Node_Expression_Unary');
