<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TwigKagg\Node\Expression\Binary;

use TwigKagg\Compiler;

class StartsWithBinary extends AbstractBinary
{
    public function compile(Compiler $compiler)
    {
        $left = $compiler->getVarName();
        $right = $compiler->getVarName();
        $compiler
            ->raw(sprintf('(is_string($%s = ', $left))
            ->subcompile($this->getNode('left'))
            ->raw(sprintf(') && is_string($%s = ', $right))
            ->subcompile($this->getNode('right'))
            ->raw(sprintf(') && (\'\' === $%2$s || 0 === strpos($%1$s, $%2$s)))', $left, $right))
        ;
    }

    public function operator(Compiler $compiler)
    {
        return $compiler->raw('');
    }
}

class_alias('TwigKagg\Node\Expression\Binary\StartsWithBinary', 'TwigKagg_Node_Expression_Binary_StartsWith');
