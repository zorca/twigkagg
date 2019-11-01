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

use TwigKagg\RuntimeLoader\FactoryRuntimeLoader;

class FactoryRuntimeLoaderTest extends \PHPUnit\Framework\TestCase
{
    public function testLoad()
    {
        $loader = new FactoryRuntimeLoader(['stdClass' => '\TwigKagg\Tests\getRuntime']);

        $this->assertInstanceOf('stdClass', $loader->load('stdClass'));
    }

    public function testLoadReturnsNullForUnmappedRuntime()
    {
        $loader = new FactoryRuntimeLoader();

        $this->assertNull($loader->load('stdClass'));
    }
}

function getRuntime()
{
    return new \stdClass();
}
