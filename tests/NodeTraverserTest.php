<?php

namespace TwigKagg\Tests;

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use TwigKagg\Environment;
use TwigKagg\Node\Node;
use TwigKagg\NodeTraverser;
use TwigKagg\NodeVisitor\NodeVisitorInterface;

class NodeTraverserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @group legacy
     */
    public function testNodeIsNullWhenTraversing()
    {
        $env = new Environment($this->createMock('\TwigKagg\Loader\LoaderInterface'));
        $traverser = new NodeTraverser($env, [new IdentityVisitor()]);
        $n = new Node([new Node([]), null, new Node([])]);
        $this->assertCount(3, $traverser->traverse($n));
    }
}

class IdentityVisitor implements NodeVisitorInterface
{
    public function enterNode(\TwigKagg_NodeInterface $node, Environment $env)
    {
        return $node;
    }

    public function leaveNode(\TwigKagg_NodeInterface $node, Environment $env)
    {
        return $node;
    }

    public function getPriority()
    {
        return 0;
    }
}
