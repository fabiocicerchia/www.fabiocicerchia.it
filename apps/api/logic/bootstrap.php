<?php

/**
 * FABIO CICERCHIA - WEBSITE
 * Copyright (C) 2012. All Rights reserved.
 *
 * PHP Version 5
 *
 * @category API
 * @package  API
 * @author   Fabio Cicerchia <info@fabiocicerchia.it>
 * @license  TBD <http://www.fabiocicerchia.it>
 * @link     http://www.fabiocicerchia.it
 */

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;

$silexExtDirectory = __DIR__ . '/../../../lib/vendor/Silex-Extensions/src';
$app['autoloader']->registerNamespace('SilexExtension', $silexExtDirectory);

// -----------------------------------------------------------------------------
// TWIG PROVIDER ---------------------------------------------------------------
// -----------------------------------------------------------------------------
$options = array(
    'twig.path'       => __DIR__ . '/../view',
    'twig.class_path' => __DIR__ . '/../../../lib/vendor/Twig/lib',
);
$twigServiceProvider = new TwigServiceProvider();
$app->register($twigServiceProvider, $options);
$app['twig']->addFilter('md5', new Twig_Filter_Function('md5'));

// -----------------------------------------------------------------------------
// URL GENERATOR PROVIDER ------------------------------------------------------
// -----------------------------------------------------------------------------
$urlGeneratorServiceProvider = new UrlGeneratorServiceProvider();
$app->register($urlGeneratorServiceProvider);

// -----------------------------------------------------------------------------
// HTTP CACHE PROVIDER ---------------------------------------------------------
// -----------------------------------------------------------------------------
$options = array(
    'http_cache.cache_dir' => __DIR__.'/cache/',
);
$httpCacheServiceProvider = new HttpCacheServiceProvider();
$app->register($httpCacheServiceProvider, $options);

// -----------------------------------------------------------------------------
// MONGODB PROVIDER ------------------------------------------------------------
// -----------------------------------------------------------------------------
$options = array(
    'mongodb.class_path' => __DIR__ . '/../../../lib/vendor/mongodb/lib',
    'mongodb.connection' => array(
        'server'       => 'mongodb://localhost',
        'options'      => array(),
        'eventmanager' => function($eventmanager) {
        }
    )
);
$mongoDbExtension = new SilexExtension\MongoDbExtension();
$app->register($mongoDbExtension, $options);
