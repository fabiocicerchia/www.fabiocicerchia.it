<?php

/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5
 *
 * @category  API
 * @package   API
 * @author    Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright 2012 Fabio Cicerchia. All Rights reserved.
 * @license   TBD <http://www.fabiocicerchia.it>
 * @link      http://www.fabiocicerchia.it
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
/**
 * Error Lambda Function
 *
 * @param Exception $e    DESCRIPTION
 * @param integer   $code DESCRIPTION
 *
 * @return Response
 */
$error = function (\Exception $e, $code) {
    $response = new Response($e->getMessage(), $code);

    return $response;
};
$app->error($error);

// -----------------------------------------------------------------------------
// ROUTE ROOT ------------------------------------------------------------------
// -----------------------------------------------------------------------------
/**
 * Root Lambda Function
 *
 * @param Silex\Application $app
 * @param array             $allowed_api
 *
 * @return Response
 */
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
/**
 * API Lambda Function
 *
 * @param string            $api_name
 * @param Silex\Application $app
 * @param array             $allowed_api
 *
 * @return Response
 */
$api = function($api_name) use($app, $allowed_api) {
    if (in_array($allowed_api, $api_name) === false) {
        $app->abort(404, "The API $api_name does not exist.");
    }

    $database = $app['mongodb']->selectDatabase('curriculum');
    $coll     = $database->selectCollection($api_name);
    $entries  = $coll->find()->sort(array('date.end' => 'desc'))->toArray(); // TODO: CHECK THE SORT

    // NOTICE: CUSTOM CODE FOR SKILL API
    if ($api_name === 'skill') {
        $entries = elaborateSkillEntries($entries);
    }

    $data = array('entries' => $entries);

    // NOTICE: CUSTOM CODE FOR INFORMATION API
    if ($api_name === 'information') {
        $data['main_key'] = array_shift(array_keys($entries), 0, 1));
    }

    $content = $app['twig']->render($api_name . '.twig', $data);

    $response = new Response($content);
    $response->headers->set('Content-type', 'application/atom+xml');

    return $response;
};

/**
 * elaborateSkillEntries
 *
 * @param array $entries
 *
 * @return array
 */
function elaborateSkillEntries($entries)
{
    $new_entries = array();

    foreach ($entries as $entry) {
        // TODO: set a key like "type" => "methodologies|techniques"
        $main_key = array_shift(array_slice(array_keys($entry), 1, 1));

        foreach ($entry[$main_key] as $name => $item) {
            $new_entries[$main_key]['_id'] = strval($entry['_id']);
            $new_entries[$main_key][$item['proficiency']][] = $name;
        }
    }

    return $new_entries;
}

$app->get('/{api_name}', $api)->assert('api_name', '[a-z]+')
    ->method('GET')->bind('api');

// -----------------------------------------------------------------------------
// ROUTE SERVICE EXPRESSION SYNTAX ---------------------------------------------
// -----------------------------------------------------------------------------
/**
 * Service Expression Syntax Lambda Function
 *
 * @param Silex\Application $app
 *
 * @return Response
 */
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
