<?php

namespace TwigKagg\Tests\Node\Expression\PHP53;

$env = new \TwigKagg\Environment(new \TwigKagg\Loader\ArrayLoader([]));
$env->addFunction(new \TwigKagg\TwigFunction('anonymous', function () {}));

return $env;
