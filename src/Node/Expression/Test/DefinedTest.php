<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TwigKagg\Node\Expression\Test;

use TwigKagg\Compiler;
use TwigKagg\Error\SyntaxError;
use TwigKagg\Node\Expression\ArrayExpression;
use TwigKagg\Node\Expression\BlockReferenceExpression;
use TwigKagg\Node\Expression\ConstantExpression;
use TwigKagg\Node\Expression\FunctionExpression;
use TwigKagg\Node\Expression\GetAttrExpression;
use TwigKagg\Node\Expression\NameExpression;
use TwigKagg\Node\Expression\TestExpression;

/**
 * Checks if a variable is defined in the current context.
 *
 *    {# defined works with variable names and variable attributes #}
 *    {% if foo is defined %}
 *        {# ... #}
 *    {% endif %}
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class DefinedTest extends TestExpression
{
    public function __construct(\Twig_NodeInterface $node, $name, \Twig_NodeInterface $arguments = null, $lineno)
    {
        if ($node instanceof NameExpression) {
            $node->setAttribute('is_defined_test', true);
        } elseif ($node instanceof GetAttrExpression) {
            $node->setAttribute('is_defined_test', true);
            $this->changeIgnoreStrictCheck($node);
        } elseif ($node instanceof BlockReferenceExpression) {
            $node->setAttribute('is_defined_test', true);
        } elseif ($node instanceof FunctionExpression && 'constant' === $node->getAttribute('name')) {
            $node->setAttribute('is_defined_test', true);
        } elseif ($node instanceof ConstantExpression || $node instanceof ArrayExpression) {
            $node = new ConstantExpression(true, $node->getTemplateLine());
        } else {
            throw new SyntaxError('The "defined" test only works with simple variables.', $lineno);
        }

        parent::__construct($node, $name, $arguments, $lineno);
    }

    protected function changeIgnoreStrictCheck(GetAttrExpression $node)
    {
        $node->setAttribute('ignore_strict_check', true);

        if ($node->getNode('node') instanceof GetAttrExpression) {
            $this->changeIgnoreStrictCheck($node->getNode('node'));
        }
    }

    public function compile(Compiler $compiler)
    {
        $compiler->subcompile($this->getNode('node'));
    }
}

class_alias('TwigKagg\Node\Expression\Test\DefinedTest', 'Twig_Node_Expression_Test_Defined');
