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

namespace TwigKagg\Node;

use TwigKagg\Compiler;

/**
 * Represents a block node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class BlockNode extends Node
{
    public function __construct($name, \TwigKagg_NodeInterface $body, $lineno, $tag = null)
    {
        parent::__construct(['body' => $body], ['name' => $name], $lineno, $tag);
    }

    public function compile(Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write(sprintf("public function block_%s(\$context, array \$blocks = [])\n", $this->getAttribute('name')), "{\n")
            ->indent()
        ;

        $compiler
            ->subcompile($this->getNode('body'))
            ->outdent()
            ->write("}\n\n")
        ;
    }
}

class_alias('TwigKagg\Node\BlockNode', 'TwigKagg_Node_Block');
