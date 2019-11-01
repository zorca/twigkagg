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

/**
 * Enables usage of the deprecated TwigKagg\Extension\AbstractExtension::initRuntime() method.
 *
 * Explicitly implement this interface if you really need to implement the
 * deprecated initRuntime() method in your extensions.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface InitRuntimeInterface
{
}

class_alias('TwigKagg\Extension\InitRuntimeInterface', 'TwigKagg_Extension_InitRuntimeInterface');
