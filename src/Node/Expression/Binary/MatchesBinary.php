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

class MatchesBinary extends AbstractBinary
{
    public function compile(Compiler $compiler)
    {
        $compiler
            ->raw('preg_match(')
            ->subcompile($this->getNode('right'))
            ->raw(', ')
            ->subcompile($this->getNode('left'))
            ->raw(')')
        ;
    }

    public function operator(Compiler $compiler)
    {
        return $compiler->raw('');
    }
}

class_alias('TwigKagg\Node\Expression\Binary\MatchesBinary', 'TwigKagg_Node_Expression_Binary_Matches');
