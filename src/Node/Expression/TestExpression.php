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
use TwigKagg\TwigTest;

class TestExpression extends CallExpression
{
    public function __construct(\TwigKagg_NodeInterface $node, $name, \TwigKagg_NodeInterface $arguments = null, $lineno)
    {
        $nodes = ['node' => $node];
        if (null !== $arguments) {
            $nodes['arguments'] = $arguments;
        }

        parent::__construct($nodes, ['name' => $name], $lineno);
    }

    public function compile(Compiler $compiler)
    {
        $name = $this->getAttribute('name');
        $test = $compiler->getEnvironment()->getTest($name);

        $this->setAttribute('name', $name);
        $this->setAttribute('type', 'test');
        $this->setAttribute('thing', $test);
        if ($test instanceof TwigTest) {
            $this->setAttribute('arguments', $test->getArguments());
        }
        if ($test instanceof \TwigKagg_TestCallableInterface || $test instanceof TwigTest) {
            $this->setAttribute('callable', $test->getCallable());
        }
        if ($test instanceof TwigTest) {
            $this->setAttribute('is_variadic', $test->isVariadic());
        }

        $this->compileCallable($compiler);
    }
}

class_alias('TwigKagg\Node\Expression\TestExpression', 'TwigKagg_Node_Expression_Test');
