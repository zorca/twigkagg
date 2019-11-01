<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TwigKagg\Node;

/**
 * Represents a node that captures any nested displayable nodes.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface NodeCaptureInterface
{
}

class_alias('TwigKagg\Node\NodeCaptureInterface', 'TwigKagg_NodeCaptureInterface');
