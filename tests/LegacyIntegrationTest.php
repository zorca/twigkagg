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

use TwigKagg\Extension\AbstractExtension;
use TwigKagg\Test\IntegrationTestCase;

class LegacyIntegrationTest extends IntegrationTestCase
{
    public function getExtensions()
    {
        return [
            new LegacyTwigTestExtension(),
        ];
    }

    public function getFixturesDir()
    {
        return __DIR__.'/LegacyFixtures/';
    }

    public function getTests($name, $legacyTests = false)
    {
        if (!$legacyTests) {
            return [['', '', '', [], '', []]];
        }

        return parent::getTests($name, true);
    }
}

class LegacyTwigTestExtension extends AbstractExtension
{
    public function getTests()
    {
        return [
            'multi word' => new \TwigKagg_Test_Method($this, 'is_multi_word'),
        ];
    }

    public function is_multi_word($value)
    {
        return false !== strpos($value, ' ');
    }

    public function getName()
    {
        return 'legacy_integration_test';
    }
}
