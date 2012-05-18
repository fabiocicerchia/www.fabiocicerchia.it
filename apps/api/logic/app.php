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

// -----------------------------------------------------------------------------
// INIT SILEX & SETUP SOME STUFF -----------------------------------------------
// -----------------------------------------------------------------------------
require_once __DIR__ . '/../silex.phar';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

require_once __DIR__ . '/bootstrap.php';

$allowed_api = array(
    'information',
    'education',
    'experience',
    'language',
    'skill'
);

// -----------------------------------------------------------------------------
// ERROR HANDLING --------------------------------------------------------------
// -----------------------------------------------------------------------------
$error = function (\Exception $e, $code) {
    $response = new Response($e->getMessage(), $code);

    return $response;
};
$app->error($error);

// -----------------------------------------------------------------------------
// ROUTE ROOT ------------------------------------------------------------------
// -----------------------------------------------------------------------------
$root = function() use($app, $allowed_api) {
    $custom_map = function($value) {
        return md5($value);
    };
    $md5_mapping = array_map($custom_map, $allowed_api);
    $routes      = array_combine($md5_mapping, $allowed_api);

    $data    = array('routes'  => $routes);
    $content = $app['twig']->render('root.twig', $data);

    $response = new Response($content);
    $response->headers->set('Content-type', 'application/xml');

    return $response;
};
$app->get('/', $root)->method('GET')->bind('root');

// -----------------------------------------------------------------------------
// ROUTE API -------------------------------------------------------------------
// -----------------------------------------------------------------------------
$education = function($api_name) use($app, $allowed_api) {
    if (in_array($allowed_api, $api_name) === false) {
        $app->abort(404, "The API $api_name does not exist.");
    }

    $database = $app['mongodb']->selectDatabase('curriculum');
    $coll     = $database->selectCollection($api_name);
    $entries  = $coll->find()->sort(array('date.end' => 'desc'))->toArray();

    // NOTICE: CUSTOM CODE FOR SKILL API
    if ($api_name === 'skill') {
        $new_entries = array();

        foreach ($entries as $entry) {
            // TODO: set a key like "type" => "methodologies|techniques"
            $main_key = implode('', array_slice(array_keys($entry), 1, 1));

            foreach ($entry[$main_key] as $name => $item) {
                $new_entries[$main_key]['_id'] = strval($entry['_id']);
                $new_entries[$main_key][$item['proficiency']][] = $name;
            }
        }

        $entries = $new_entries;
    }

    $data = array('entries' => $entries);

    // NOTICE: CUSTOM CODE FOR INFORMATION API
    if ($api_name === 'information') {
        $main_key = array_slice(array_keys($entries), 0, 1);
        $data['main_key'] = $main_key[0];
    }

    $content = $app['twig']->render($api_name . '.twig', $data);

    $response = new Response($content);
    $response->headers->set('Content-type', 'application/atom+xml');

    return $response;
};
$app->get('/{api_name}', $education)->assert('api_name', '[a-z]+')
    ->method('GET')->bind('api');

// -----------------------------------------------------------------------------
// ROUTE SERVICE EXPRESSION SYNTAX ---------------------------------------------
// -----------------------------------------------------------------------------
$service_expression_syntax = function() use($app) {
    $content  = array_map($custom_map, $allowed_api);
    $response = new Response($content);
    $response->headers->set('Content-type', 'text/plain');

    return $response;
};
$app->get('/service-expression-syntax', $service_expression_syntax)
    ->method('GET')->bind('service_expression_syntax');

// -----------------------------------------------------------------------------
// RETURN APP ------------------------------------------------------------------
// -----------------------------------------------------------------------------
return $app;
