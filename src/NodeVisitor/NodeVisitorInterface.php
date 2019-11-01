<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TwigKagg\NodeVisitor;

use TwigKagg\Environment;

/**
 * Interface for node visitor classes.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface NodeVisitorInterface
{
    /**
     * Called before child nodes are visited.
     *
     * @return \TwigKagg_NodeInterface The modified node
     */
    public function enterNode(\TwigKagg_NodeInterface $node, Environment $env);

    /**
     * Called after child nodes are visited.
     *
     * @return \TwigKagg_NodeInterface|false|null The modified node or null if the node must be removed
     */
    public function leaveNode(\TwigKagg_NodeInterface $node, Environment $env);

    /**
     * Returns the priority for this visitor.
     *
     * Priority should be between -10 and 10 (0 is the default).
     *
     * @return int The priority level
     */
    public function getPriority();
}

class_alias('TwigKagg\NodeVisitor\NodeVisitorInterface', 'TwigKagg_NodeVisitorInterface');

// Ensure that the aliased name is loaded to keep BC for classes implementing the typehint with the old aliased name.
class_exists('TwigKagg\Environment');
