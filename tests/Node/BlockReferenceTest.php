<?php

namespace TwigKagg\Tests\Node;

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use TwigKagg\Node\BlockReferenceNode;
use TwigKagg\Test\NodeTestCase;

class BlockReferenceTest extends NodeTestCase
{
    public function testConstructor()
    {
        $node = new BlockReferenceNode('foo', 1);

        $this->assertEquals('foo', $node->getAttribute('name'));
    }

    public function getTests()
    {
        return [
            [new BlockReferenceNode('foo', 1), <<<EOF
// line 1
\$this->displayBlock('foo', \$context, \$blocks);
EOF
            ],
        ];
    }
}
