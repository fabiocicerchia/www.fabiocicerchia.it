<?php

/**
 *
 * FABIO CICERCHIA - WEBSITE
 * Copyright (C) 2012. All Rights reserved.
 *
 */

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __DIR__ . '/../view',
    'twig.class_path' => __DIR__ . '/../../../lib/vendor/Twig/lib',
));

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new Silex\Provider\HttpCacheServiceProvider(), array(
    'http_cache.cache_dir' => __DIR__.'/cache/',
));

$app['autoloader']->registerNamespace('SilexExtension', __DIR__ . '/../../../lib/vendor/Silex-Extensions/src');

$app->register(new SilexExtension\MongoDbExtension(), array(
    'mongodb.class_path' => __DIR__ . '/../../../lib/vendor/mongodb/lib',
    'mongodb.connection' => array(
        'server'       => 'mongodb://localhost',
        'options'      => array(),
        'eventmanager' => function($eventmanager) {}
    )
));
