<?php

namespace TwigKagg\Tests\Fixtures\errors;

require __DIR__.'/../../../vendor/autoload.php';

use TwigKagg\Environment;
use TwigKagg\Extension\AbstractExtension;
use TwigKagg\Loader\ArrayLoader;
use TwigKagg\TwigFilter;

class BrokenExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('broken', [$this, 'broken']),
        ];
    }

    public function broken()
    {
        die('OOPS');
    }
}

$loader = new ArrayLoader([
    'index.html.twig' => 'Hello {{ "world"|broken }}',
]);
$twig = new Environment($loader, ['debug' => isset($argv[1])]);
$twig->addExtension(new BrokenExtension());

echo $twig->render('index.html.twig');
