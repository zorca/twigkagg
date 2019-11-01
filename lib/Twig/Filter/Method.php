<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use TwigKagg\Extension\ExtensionInterface;

@trigger_error('The TwigKagg_Filter_Method class is deprecated since version 1.12 and will be removed in 2.0. Use \TwigKagg\TwigFilter instead.', E_USER_DEPRECATED);

/**
 * Represents a method template filter.
 *
 * Use \TwigKagg\TwigFilter instead.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since 1.12 (to be removed in 2.0)
 */
class TwigKagg_Filter_Method extends TwigKagg_Filter
{
    protected $extension;
    protected $method;

    public function __construct(ExtensionInterface $extension, $method, array $options = [])
    {
        $options['callable'] = [$extension, $method];

        parent::__construct($options);

        $this->extension = $extension;
        $this->method = $method;
    }

    public function compile()
    {
        return sprintf('$this->env->getExtension(\'%s\')->%s', \get_class($this->extension), $this->method);
    }
}
