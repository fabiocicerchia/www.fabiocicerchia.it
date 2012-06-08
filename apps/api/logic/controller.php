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

// -----------------------------------------------------------------------------
// SETUP SOME STUFF ------------------------------------------------------------
// -----------------------------------------------------------------------------

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FabioCicerchia\Api\Service\EntryPoint;
use FabioCicerchia\Api\Service\Strategy;
use FabioCicerchia\Api\Utils;

$closures = [];

// -----------------------------------------------------------------------------
// ERROR HANDLING --------------------------------------------------------------
// -----------------------------------------------------------------------------

/**
 * Error - Closure.
 *
 * @param Exception $e    The Exception instance.
 * @param integer   $code The exception code.
 *
 * @return Response
 */
$closures['error'] = function (\Exception $e, $code) use ($app) {
    if ($app['debug'] === true) {
        return;
    }

    $response = new Response($e->getMessage(), $code);
    $response->headers->set('Content-Language', 'en_GB');

    return $response;
};

// -----------------------------------------------------------------------------
// ROUTE ROOT ------------------------------------------------------------------
// -----------------------------------------------------------------------------

/**
 * Root - Closure.
 *
 * @param Silex\Application $app The Silex Application instance.
 *
 * @return Response
 */
$closures['root'] = function () use ($app) {
    $mime_type = $app['debug'] === true
                 ? 'application/xml'
                 : 'application/vnd.ads+xml;v=1.0';

    $database = $app['mongodb']->selectDatabase('curriculum');

    $entryPoint = new EntryPoint();

    $data = [
        'routes'    => $entryPoint->getServices(),
        'mime_type' => $mime_type,
        'api_name'  => 'entry point'
    ];

    $content  = $app['twig']->render('root.twig', $data);
    $response = new Response($content);
    $response->headers->set('Content-Type',     $data['mime_type']);
    $response->headers->set('Content-Language', 'en_GB');

    return $response;
};

// -----------------------------------------------------------------------------
// ROUTE API -------------------------------------------------------------------
// -----------------------------------------------------------------------------

/**
 * API - Closure.
 *
 * @param string            $api_name The API name retrieved from URL.
 * @param Silex\Application $app      The Silex Application instance.
 *
 * @return Response
 */
$closures['api'] = function ($api_name) use ($app) {
    if (is_string($api_name) === false) {
        throw new InvalidArgumentException('The parameter $api_name must be a string.');
    }

    $database = $app['mongodb']->selectDatabase('curriculum');

    try {
        $service = new Strategy($api_name, $database);
    } catch (UnexpectedValueException $e) {
        $app->abort(404, 'The API ' . $api_name. ' does not exist.');
    }

    $data = $service->getData();
    $data['api_name'] = $api_name;

    $accept_language  = $app['request']->headers->get('accept-language');
    $db_languages     = $database->selectCollection('language')
                                 ->find([], ['code' => true])->toArray();
    foreach($db_languages as $language_code) {
        $short_lang = substr($language_code['code'], 0, strpos($language_code['code'], '_'));
        $available_languages[$short_lang] = $language_code['code'];
    }
    $current_lang     = Utils::getCurrentLanguage($available_languages, $accept_language);
    $data['entities'] = Utils::convertForI18n($data['entities'], $current_lang);

    $mime_type = $app['debug'] === true
                 ? 'application/xml'
                 : 'application/vnd.ads+xml;v=1.0';

    $content  = $app['twig']->render($api_name . '.twig', $data);
    $response = new Response($content);
    $response->headers->set('Content-Type',     $mime_type);
    $response->headers->set('Content-Language', $current_lang);

    return $response;
};

// -----------------------------------------------------------------------------
// ROUTE API DEFINITION SYNTAX -------------------------------------------------
// -----------------------------------------------------------------------------

/**
 * API Definition Syntax - Closure.
 *
 * @param Silex\Application $app The Silex Application instance.
 *
 * @return Response
 */
$closures['api_definition_syntax'] = function () use ($app) {
    $content  = $app['twig']->render('api-definition-syntax.twig');
    $response = new Response($content);
    $response->headers->set('Content-Type',     'text/plain');
    $response->headers->set('Content-Language', 'en_GB');

    return $response;
};
