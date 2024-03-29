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

class NegUnary extends AbstractUnary
{
    public function operator(Compiler $compiler)
    {
        $compiler->raw('-');
    }
}

class_alias('TwigKagg\Node\Expression\Unary\NegUnary', 'TwigKagg_Node_Expression_Unary_Neg');
