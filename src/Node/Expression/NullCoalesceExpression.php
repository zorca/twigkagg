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
use TwigKagg\Node\Expression\Binary\AndBinary;
use TwigKagg\Node\Expression\Test\DefinedTest;
use TwigKagg\Node\Expression\Test\NullTest;
use TwigKagg\Node\Expression\Unary\NotUnary;
use TwigKagg\Node\Node;

class NullCoalesceExpression extends ConditionalExpression
{
    public function __construct(\Twig_NodeInterface $left, \Twig_NodeInterface $right, $lineno)
    {
        $test = new AndBinary(
            new DefinedTest(clone $left, 'defined', new Node(), $left->getTemplateLine()),
            new NotUnary(new NullTest($left, 'null', new Node(), $left->getTemplateLine()), $left->getTemplateLine()),
            $left->getTemplateLine()
        );

        parent::__construct($test, $left, $right, $lineno);
    }

    public function compile(Compiler $compiler)
    {
        /*
         * This optimizes only one case. PHP 7 also supports more complex expressions
         * that can return null. So, for instance, if log is defined, log("foo") ?? "..." works,
         * but log($a["foo"]) ?? "..." does not if $a["foo"] is not defined. More advanced
         * cases might be implemented as an optimizer node visitor, but has not been done
         * as benefits are probably not worth the added complexity.
         */
        if (\PHP_VERSION_ID >= 70000 && $this->getNode('expr2') instanceof NameExpression) {
            $this->getNode('expr2')->setAttribute('always_defined', true);
            $compiler
                ->raw('((')
                ->subcompile($this->getNode('expr2'))
                ->raw(') ?? (')
                ->subcompile($this->getNode('expr3'))
                ->raw('))')
            ;
        } else {
            parent::compile($compiler);
        }
    }
}

class_alias('TwigKagg\Node\Expression\NullCoalesceExpression', 'Twig_Node_Expression_NullCoalesce');
