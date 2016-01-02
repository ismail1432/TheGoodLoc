<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;
//'Stof\\DoctrineExtensionsBundle' => array($vendorDir . '/stof/doctrine-extensions-bundle'),

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';


AnnotationRegistry::registerLoader(array($loader, 'loadClass'));


return $loader;
