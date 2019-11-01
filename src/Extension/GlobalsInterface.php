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
 * Enables usage of the deprecated TwigKagg\Extension\AbstractExtension::getGlobals() method.
 *
 * Explicitly implement this interface if you really need to implement the
 * deprecated getGlobals() method in your extensions.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface GlobalsInterface
{
}

class_alias('TwigKagg\Extension\GlobalsInterface', 'Twig_Extension_GlobalsInterface');
