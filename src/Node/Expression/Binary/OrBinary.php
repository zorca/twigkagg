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

class OrBinary extends AbstractBinary
{
    public function operator(Compiler $compiler)
    {
        return $compiler->raw('||');
    }
}

class_alias('TwigKagg\Node\Expression\Binary\OrBinary', 'TwigKagg_Node_Expression_Binary_Or');
