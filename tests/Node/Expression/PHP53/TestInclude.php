<?php

namespace TwigKagg\Tests\Node\Expression\PHP53;

$env = new \TwigKagg\Environment(new \TwigKagg\Loader\ArrayLoader([]));
$env->addTest(new \TwigKagg\TwigTest('anonymous', function () {}));

return $env;
