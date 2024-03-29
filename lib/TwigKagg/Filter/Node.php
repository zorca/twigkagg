<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

@trigger_error('The TwigKagg_Filter_Node class is deprecated since version 1.12 and will be removed in 2.0. Use \TwigKagg\TwigFilter instead.', E_USER_DEPRECATED);

/**
 * Represents a template filter as a node.
 *
 * Use \TwigKagg\TwigFilter instead.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since 1.12 (to be removed in 2.0)
 */
class TwigKagg_Filter_Node extends TwigKagg_Filter
{
    protected $class;

    public function __construct($class, array $options = [])
    {
        parent::__construct($options);

        $this->class = $class;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function compile()
    {
    }
}
