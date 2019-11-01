<?php

namespace TwigKagg\Tests\Node\Expression\Binary;

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use TwigKagg\Node\Expression\Binary\OrBinary;
use TwigKagg\Node\Expression\ConstantExpression;
use TwigKagg\Test\NodeTestCase;

class OrTest extends NodeTestCase
{
    public function testConstructor()
    {
        $left = new ConstantExpression(1, 1);
        $right = new ConstantExpression(2, 1);
        $node = new OrBinary($left, $right, 1);

        $this->assertEquals($left, $node->getNode('left'));
        $this->assertEquals($right, $node->getNode('right'));
    }

    public function getTests()
    {
        $left = new ConstantExpression(1, 1);
        $right = new ConstantExpression(2, 1);
        $node = new OrBinary($left, $right, 1);

        return [
            [$node, '(1 || 2)'],
        ];
    }
}
