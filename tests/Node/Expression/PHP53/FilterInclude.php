<?php

namespace TwigKagg\Tests\Node\Expression\PHP53;

$env = new \TwigKagg\Environment(new \TwigKagg\Loader\ArrayLoader([]));
$env->addFilter(new \TwigKagg\TwigFilter('anonymous', function () {}));

return $env;
