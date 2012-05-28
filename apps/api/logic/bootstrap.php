<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category  API
 * @package   API
 * @author    Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright 2012 Fabio Cicerchia. All Rights reserved.
 * @license   TBD <http://www.fabiocicerchia.it>
 * @link      http://www.fabiocicerchia.it
 */

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;

// TODO: MAKE THIS DINAMICAL
$app['debug'] = true;

$silexExtDirectory = __DIR__ . '/../../../lib/vendor/Silex-Extensions/src';
$app['autoloader']->registerNamespace('SilexExtension', $silexExtDirectory);

// -----------------------------------------------------------------------------
// TWIG PROVIDER ---------------------------------------------------------------
// -----------------------------------------------------------------------------
$options = [
    'twig.path'       => __DIR__ . '/../view',
    'twig.class_path' => __DIR__ . '/../../../lib/vendor/Twig/lib',
];
$twigServiceProvider = new TwigServiceProvider();
$app->register($twigServiceProvider, $options);

$md5_filter = new Twig_Filter_Function('md5');
$app['twig']->addFilter('md5', $md5_filter);

// -----------------------------------------------------------------------------
// URL GENERATOR PROVIDER ------------------------------------------------------
// -----------------------------------------------------------------------------
$urlGeneratorServiceProvider = new UrlGeneratorServiceProvider();
$app->register($urlGeneratorServiceProvider);

// -----------------------------------------------------------------------------
// HTTP CACHE PROVIDER ---------------------------------------------------------
// -----------------------------------------------------------------------------
$options = [
    'http_cache.cache_dir' => __DIR__ . '/../../../cache/api/',
];
$httpCacheServiceProvider = new HttpCacheServiceProvider();
$app->register($httpCacheServiceProvider, $options);

// -----------------------------------------------------------------------------
// MONGODB PROVIDER ------------------------------------------------------------
// -----------------------------------------------------------------------------
$options = [
    'mongodb.class_path' => __DIR__ . '/../../../lib/vendor/mongodb/lib',
    'mongodb.connection' => [
        'server'       => 'mongodb://localhost',
        'options'      => [],
        'eventmanager' => function($eventmanager) {
        }
    ]
];
$mongoDbExtension = new SilexExtension\MongoDbExtension();
$app->register($mongoDbExtension, $options);
