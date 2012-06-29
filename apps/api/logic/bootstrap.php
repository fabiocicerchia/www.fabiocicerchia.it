<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category  Api
 * @package   Api
 * @author    Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright 2012 Fabio Cicerchia. All Rights reserved.
 * @license   TBD <http://www.fabiocicerchia.it>
 * @link      http://www.fabiocicerchia.it
 */

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;

// -----------------------------------------------------------------------------
// DEBUG FLAG ------------------------------------------------------------------
// -----------------------------------------------------------------------------
$app['debug'] = false;

// -----------------------------------------------------------------------------
// REGISTERING NAMESPACES ------------------------------------------------------
// -----------------------------------------------------------------------------
$silexExtDirectory = __DIR__ . '/../../../lib/vendor/Silex-Extensions/src';
$app['autoloader']->registerNamespace('SilexExtension', $silexExtDirectory);

$customDirectory = __DIR__ . '/../../../lib/vendor/FabioCicerchia/lib';
$app['autoloader']->registerNamespace('FabioCicerchia', $customDirectory);

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
$app['twig']->addExtension(new FabioCicerchia\Api\TwigExtension($app));

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
        'eventmanager' => function ($eventmanager) {
        }
    ]
];
$mongoDbExtension = new SilexExtension\MongoDbExtension();
$app->register($mongoDbExtension, $options);
