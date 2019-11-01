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

use TwigKagg\Node\Expression\AssignNameExpression;
use TwigKagg\Node\Expression\ConstantExpression;
use TwigKagg\Node\Expression\NameExpression;
use TwigKagg\Node\Node;
use TwigKagg\Node\PrintNode;
use TwigKagg\Node\SetNode;
use TwigKagg\Node\TextNode;
use TwigKagg\Test\NodeTestCase;

class SetTest extends NodeTestCase
{
    public function testConstructor()
    {
        $names = new Node([new AssignNameExpression('foo', 1)], [], 1);
        $values = new Node([new ConstantExpression('foo', 1)], [], 1);
        $node = new SetNode(false, $names, $values, 1);

        $this->assertEquals($names, $node->getNode('names'));
        $this->assertEquals($values, $node->getNode('values'));
        $this->assertFalse($node->getAttribute('capture'));
    }

    public function getTests()
    {
        $tests = [];

        $names = new Node([new AssignNameExpression('foo', 1)], [], 1);
        $values = new Node([new ConstantExpression('foo', 1)], [], 1);
        $node = new SetNode(false, $names, $values, 1);
        $tests[] = [$node, <<<EOF
// line 1
\$context["foo"] = "foo";
EOF
        ];

        $names = new Node([new AssignNameExpression('foo', 1)], [], 1);
        $values = new Node([new PrintNode(new ConstantExpression('foo', 1), 1)], [], 1);
        $node = new SetNode(true, $names, $values, 1);
        $tests[] = [$node, <<<EOF
// line 1
ob_start(function () { return ''; });
echo "foo";
\$context["foo"] = ('' === \$tmp = ob_get_clean()) ? '' : new Markup(\$tmp, \$this->env->getCharset());
EOF
        ];

        $names = new Node([new AssignNameExpression('foo', 1)], [], 1);
        $values = new TextNode('foo', 1);
        $node = new SetNode(true, $names, $values, 1);
        $tests[] = [$node, <<<EOF
// line 1
\$context["foo"] = ('' === \$tmp = "foo") ? '' : new Markup(\$tmp, \$this->env->getCharset());
EOF
        ];

        $names = new Node([new AssignNameExpression('foo', 1), new AssignNameExpression('bar', 1)], [], 1);
        $values = new Node([new ConstantExpression('foo', 1), new NameExpression('bar', 1)], [], 1);
        $node = new SetNode(false, $names, $values, 1);
        $tests[] = [$node, <<<EOF
// line 1
list(\$context["foo"], \$context["bar"]) = ["foo", {$this->getVariableGetter('bar')}];
EOF
        ];

        return $tests;
    }
}
