<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TwigKagg\Profiler\NodeVisitor;

use TwigKagg\Environment;
use TwigKagg\Node\BlockNode;
use TwigKagg\Node\BodyNode;
use TwigKagg\Node\MacroNode;
use TwigKagg\Node\ModuleNode;
use TwigKagg\Node\Node;
use TwigKagg\NodeVisitor\AbstractNodeVisitor;
use TwigKagg\Profiler\Node\EnterProfileNode;
use TwigKagg\Profiler\Node\LeaveProfileNode;
use TwigKagg\Profiler\Profile;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @final
 */
class ProfilerNodeVisitor extends AbstractNodeVisitor
{
    private $extensionName;

    public function __construct($extensionName)
    {
        $this->extensionName = $extensionName;
    }

    protected function doEnterNode(Node $node, Environment $env)
    {
        return $node;
    }

    protected function doLeaveNode(Node $node, Environment $env)
    {
        if ($node instanceof ModuleNode) {
            $varName = $this->getVarName();
            $node->setNode('display_start', new Node([new EnterProfileNode($this->extensionName, Profile::TEMPLATE, $node->getTemplateName(), $varName), $node->getNode('display_start')]));
            $node->setNode('display_end', new Node([new LeaveProfileNode($varName), $node->getNode('display_end')]));
        } elseif ($node instanceof BlockNode) {
            $varName = $this->getVarName();
            $node->setNode('body', new BodyNode([
                new EnterProfileNode($this->extensionName, Profile::BLOCK, $node->getAttribute('name'), $varName),
                $node->getNode('body'),
                new LeaveProfileNode($varName),
            ]));
        } elseif ($node instanceof MacroNode) {
            $varName = $this->getVarName();
            $node->setNode('body', new BodyNode([
                new EnterProfileNode($this->extensionName, Profile::MACRO, $node->getAttribute('name'), $varName),
                $node->getNode('body'),
                new LeaveProfileNode($varName),
            ]));
        }

        return $node;
    }

    private function getVarName()
    {
        return sprintf('__internal_%s', hash('sha256', $this->extensionName));
    }

    public function getPriority()
    {
        return 0;
    }
}

class_alias('TwigKagg\Profiler\NodeVisitor\ProfilerNodeVisitor', 'TwigKagg_Profiler_NodeVisitor_Profiler');
