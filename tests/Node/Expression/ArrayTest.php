<?php

namespace TwigKagg\Tests\Node\Expression;

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use TwigKagg\Node\Expression\ArrayExpression;
use TwigKagg\Node\Expression\ConstantExpression;
use TwigKagg\Test\NodeTestCase;

class ArrayTest extends NodeTestCase
{
    public function testConstructor()
    {
        $elements = [new ConstantExpression('foo', 1), $foo = new ConstantExpression('bar', 1)];
        $node = new ArrayExpression($elements, 1);

        $this->assertEquals($foo, $node->getNode(1));
    }

    public function getTests()
    {
        $elements = [
            new ConstantExpression('foo', 1),
            new ConstantExpression('bar', 1),

            new ConstantExpression('bar', 1),
            new ConstantExpression('foo', 1),
        ];
        $node = new ArrayExpression($elements, 1);

        return [
            [$node, '["foo" => "bar", "bar" => "foo"]'],
        ];
    }
}
