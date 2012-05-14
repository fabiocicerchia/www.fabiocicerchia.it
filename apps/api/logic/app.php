<?php

/**
 *
 * FABIO CICERCHIA - WEBSITE
 * Copyright (C) 2012. All Rights reserved.
 *
 */

// -----------------------------------------------------------------------------
// INIT SILEX & SETUP SOME STUFF -----------------------------------------------
// -----------------------------------------------------------------------------
require_once __DIR__ . '/../silex.phar';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

require_once __DIR__ . '/bootstrap.php';

// -----------------------------------------------------------------------------
// ERROR HANDLING --------------------------------------------------------------
// -----------------------------------------------------------------------------
$app->error(function (\Exception $e, $code) {
    return new Response($e->getMessage(), $code);
});

// -----------------------------------------------------------------------------
// ROUTE ROOT ------------------------------------------------------------------
// -----------------------------------------------------------------------------
$app->get('/', function() use($app) {
    $routes = array_keys($app['routes']->all());
    $content = $app['twig']->render('root.twig', array('routes' => $routes));

    $response = new Response($content);
    $response->headers->set('Content-type', 'application/atom+xml');
    $response->setCache(array(
        'max_age'  => 10,
        's_maxage' => 10
    ));

    return $response;
})->method('GET')->bind('root');

// -----------------------------------------------------------------------------
// ROUTE INFORMATION -----------------------------------------------------------
// -----------------------------------------------------------------------------
$app->get('/information', function() use($app) {
    $coll = $app['mongodb']->selectDatabase('curriculum')->selectCollection('information');
    $entries = $coll->find()->toArray();

    $main_key = array_slice(array_keys($entries), 0, 1);
    $content = $app['twig']->render('information.twig', array('entry' => $entries[$main_key[0]], 'main_key' => $main_key[0]));

    $response = new Response($content);
    $response->headers->set('Content-type', 'application/atom+xml');
    $response->setCache(array(
        'max_age'  => 10,
        's_maxage' => 10
    ));

    return $response;
})->method('GET')->bind('information');

// -----------------------------------------------------------------------------
// ROUTE EDUCATION -------------------------------------------------------------
// -----------------------------------------------------------------------------
$app->get('/education', function() use($app) {
    $coll = $app['mongodb']->selectDatabase('curriculum')->selectCollection('education');
    $entries = $coll->find()->sort(array('date.end' => 'desc'))->toArray();

    $content = $app['twig']->render('education.twig', array('entries' => $entries));

    $response = new Response($content);
    $response->headers->set('Content-type', 'application/atom+xml');
    $response->setCache(array(
        'max_age'  => 10,
        's_maxage' => 10
    ));

    return $response;
})->method('GET')->bind('education');

// -----------------------------------------------------------------------------
// ROUTE EXPERIENCE ------------------------------------------------------------
// -----------------------------------------------------------------------------
$app->get('/experience', function() use($app) {
    $coll = $app['mongodb']->selectDatabase('curriculum')->selectCollection('experience');
    $entries = $coll->find()->sort(array('date.end' => 'desc'))->toArray();

    $content = $app['twig']->render('experience.twig', array('entries' => $entries));

    $response = new Response($content);
    $response->headers->set('Content-type', 'application/atom+xml');
    $response->setCache(array(
        'max_age'  => 10,
        's_maxage' => 10
    ));

    return $response;
})->method('GET')->bind('experience');

// -----------------------------------------------------------------------------
// ROUTE SKILL -----------------------------------------------------------------
// -----------------------------------------------------------------------------
$app->get('/skill', function() use($app) {
    $coll = $app['mongodb']->selectDatabase('curriculum')->selectCollection('skill');
    $entries = $coll->find()->toArray();

    $new_entries = array();
    foreach($entries as $entry) {
        $main_key = implode('', array_slice(array_keys($entry), 1, 1)); // TODO: set a key like "type" => "methodologies|techniques"
        foreach($entry[$main_key] as $name => $item) {
            $new_entries[$main_key]['_id'] = (string)$entry['_id'];
            $new_entries[$main_key][$item['proficiency']][] = $name;
        }
    }

    $content = $app['twig']->render('skill.twig', array('entries' => $new_entries));

    $response = new Response($content);
    $response->headers->set('Content-type', 'application/atom+xml');
    $response->setCache(array(
        'max_age'  => 10,
        's_maxage' => 10
    ));

    return $response;
})->method('GET')->bind('skill');

// -----------------------------------------------------------------------------
// ROUTE LANGUAGE --------------------------------------------------------------
// -----------------------------------------------------------------------------
$app->get('/language', function() use($app) {
    $coll = $app['mongodb']->selectDatabase('curriculum')->selectCollection('language');
    $entries = $coll->find()->toArray();

    $content = $app['twig']->render('language.twig', array('entries' => $entries));

    $response = new Response($content);
    $response->headers->set('Content-type', 'application/atom+xml');
    $response->setCache(array(
        'max_age'  => 10,
        's_maxage' => 10
    ));

    return $response;
})->method('GET')->bind('language');

return $app;
