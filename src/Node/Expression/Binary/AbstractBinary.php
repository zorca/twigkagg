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

namespace TwigKagg\Node\Expression\Binary;

use TwigKagg\Compiler;
use TwigKagg\Node\Expression\AbstractExpression;

abstract class AbstractBinary extends AbstractExpression
{
    public function __construct(\Twig_NodeInterface $left, \Twig_NodeInterface $right, $lineno)
    {
        parent::__construct(['left' => $left, 'right' => $right], [], $lineno);
    }

    public function compile(Compiler $compiler)
    {
        $compiler
            ->raw('(')
            ->subcompile($this->getNode('left'))
            ->raw(' ')
        ;
        $this->operator($compiler);
        $compiler
            ->raw(' ')
            ->subcompile($this->getNode('right'))
            ->raw(')')
        ;
    }

    abstract public function operator(Compiler $compiler);
}

class_alias('TwigKagg\Node\Expression\Binary\AbstractBinary', 'Twig_Node_Expression_Binary');
