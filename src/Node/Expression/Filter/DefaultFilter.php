<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TwigKagg\Node\Expression\Filter;

use TwigKagg\Compiler;
use TwigKagg\Node\Expression\ConditionalExpression;
use TwigKagg\Node\Expression\ConstantExpression;
use TwigKagg\Node\Expression\FilterExpression;
use TwigKagg\Node\Expression\GetAttrExpression;
use TwigKagg\Node\Expression\NameExpression;
use TwigKagg\Node\Expression\Test\DefinedTest;
use TwigKagg\Node\Node;

/**
 * Returns the value or the default value when it is undefined or empty.
 *
 *  {{ var.foo|default('foo item on var is not defined') }}
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class DefaultFilter extends FilterExpression
{
    public function __construct(\TwigKagg_NodeInterface $node, ConstantExpression $filterName, \TwigKagg_NodeInterface $arguments, $lineno, $tag = null)
    {
        $default = new FilterExpression($node, new ConstantExpression('default', $node->getTemplateLine()), $arguments, $node->getTemplateLine());

        if ('default' === $filterName->getAttribute('value') && ($node instanceof NameExpression || $node instanceof GetAttrExpression)) {
            $test = new DefinedTest(clone $node, 'defined', new Node(), $node->getTemplateLine());
            $false = \count($arguments) ? $arguments->getNode(0) : new ConstantExpression('', $node->getTemplateLine());

            $node = new ConditionalExpression($test, $default, $false, $node->getTemplateLine());
        } else {
            $node = $default;
        }

        parent::__construct($node, $filterName, $arguments, $lineno, $tag);
    }

    public function compile(Compiler $compiler)
    {
        $compiler->subcompile($this->getNode('node'));
    }
}

class_alias('TwigKagg\Node\Expression\Filter\DefaultFilter', 'TwigKagg_Node_Expression_Filter_Default');
