<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TwigKagg\Extension;

use TwigKagg\Profiler\NodeVisitor\ProfilerNodeVisitor;
use TwigKagg\Profiler\Profile;

class ProfilerExtension extends AbstractExtension
{
    private $actives = [];

    public function __construct(Profile $profile)
    {
        $this->actives[] = $profile;
    }

    public function enter(Profile $profile)
    {
        $this->actives[0]->addProfile($profile);
        array_unshift($this->actives, $profile);
    }

    public function leave(Profile $profile)
    {
        $profile->leave();
        array_shift($this->actives);

        if (1 === \count($this->actives)) {
            $this->actives[0]->leave();
        }
    }

    public function getNodeVisitors()
    {
        return [new ProfilerNodeVisitor(\get_class($this))];
    }

    public function getName()
    {
        return 'profiler';
    }
}

class_alias('TwigKagg\Extension\ProfilerExtension', 'TwigKagg_Extension_Profiler');
