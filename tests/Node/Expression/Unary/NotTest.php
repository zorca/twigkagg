<?php

namespace TwigKagg\Tests\Node\Expression\Unary;

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use TwigKagg\Node\Expression\ConstantExpression;
use TwigKagg\Node\Expression\Unary\NotUnary;
use TwigKagg\Test\NodeTestCase;

class NotTest extends NodeTestCase
{
    public function testConstructor()
    {
        $expr = new ConstantExpression(1, 1);
        $node = new NotUnary($expr, 1);

        $this->assertEquals($expr, $node->getNode('node'));
    }

    public function getTests()
    {
        $node = new ConstantExpression(1, 1);
        $node = new NotUnary($node, 1);

        return [
            [$node, '!1'],
        ];
    }
}
