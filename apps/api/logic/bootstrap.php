<?php

/**
 *
 * FABIO CICERCHIA - STYLING EXERCISES JUST FOR FUN
 * Copyright (C) 2012. All Rights reserved.
 *
 */

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'       => __DIR__ . '/../view',
    'twig.class_path' => __DIR__ . '/../../../lib/vendor/Twig/lib',
));

$app['autoloader']->registerNamespace('SilexExtension', __DIR__ . '/../../lib/vendor/Silex-Extension/src');

$app->register(new SilexExtension\MongoDbExtension(), array(
    'mongodb.class_path' => __DIR__ . '/../../lib/vendor/mongodb/lib',
    'mongodb.connection' => array(
        'server'       => 'mongodb://mysecretuser:mysecretpassw@localhost',
        'options'      => array(),
        'eventmanager' => function($eventmanager) {}
    )
));
