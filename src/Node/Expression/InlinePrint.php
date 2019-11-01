<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TwigKagg\Node\Expression;

use TwigKagg\Compiler;
use TwigKagg\Node\Node;

/**
 * @internal
 */
final class InlinePrint extends AbstractExpression
{
    public function __construct(Node $node, $lineno)
    {
        parent::__construct(['node' => $node], [], $lineno);
    }

    public function compile(Compiler $compiler)
    {
        $compiler
            ->raw('print (')
            ->subcompile($this->getNode('node'))
            ->raw(')')
        ;
    }
}
