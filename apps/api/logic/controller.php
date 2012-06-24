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

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FabioCicerchia\Api\Service\EntryPoint;
use FabioCicerchia\Api\Service\Strategy;
use FabioCicerchia\Api\Utils;

// -----------------------------------------------------------------------------
// SETUP SOME STUFF ------------------------------------------------------------
// -----------------------------------------------------------------------------
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
    $response->headers->set('Content-Language', 'en');

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
    // MimeType
    $mime_type = $app['debug'] === true
                 ? 'application/xml'
                 : 'application/vnd.ads+xml;v=1.0';

    // DB
    $database = $app['mongodb']->selectDatabase('curriculum');

    // Business Logic
    $entryPoint = new EntryPoint();

    $data = [
        'routes'    => $entryPoint->getServices(),
        'mime_type' => $mime_type,
        'api_name'  => 'entry point'
    ];

    // Rendering
    $content  = $app['twig']->render('root.twig', $data);

    // Response
    $response = new Response($content);
    $response->headers->set('Content-Type',     $data['mime_type']);
    $response->headers->set('Content-Language', 'en');

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
        throw new \InvalidArgumentException('The parameter $api_name must be a string.');
    }

    // DB
    $database = $app['mongodb']->selectDatabase('curriculum');

    // Business Logic
    try {
        $service = new Strategy($api_name, $database);
    } catch (UnexpectedValueException $e) {
        $app->abort(404, 'The API ' . $api_name. ' does not exist.');
    }

    $data = $service->getData();
    $data['api_name'] = $api_name;

    // Response
    $response = new Response();
    if ($app['debug'] === false) {
        $firstRecord  = $data['entities'][array_keys($data['entities'])[0]];
        $lastModified = isset($firstRecord['date'])
                        ? $firstRecord['date']['end']->sec
                        : filemtime(__DIR__ . '/../../../db/mongo-curriculum.js');
        $response->setPublic();
        $response->setMaxAge(28800);
        $response->setSharedMaxAge(28800);
        $response->setETag(md5(serialize($data)));
        $response->headers->set('Last-Modified', date('r', $lastModified));
    }

    if ($response->isNotModified($app['request']) === false) {
        // MimeType
        $mime_type = $app['debug'] === true
                     ? 'application/xml'
                     : 'application/vnd.ads+xml;v=1.0';
        $response->headers->set('Content-Type', $mime_type);

        // Language
        $current_lang        = 'en';
        $available_languages = [$current_lang => $current_lang];
        $accept_language     = $app['request']->headers->get('accept-language');
        if (empty($accept_language) === false) {
            $db_languages = $database->selectCollection('language')
                                     ->find([], ['code' => true])->toArray();

            foreach($db_languages as $language_code) {
                $short_lang = substr($language_code['code'], 0, strpos($language_code['code'], '_'));
                $available_languages[$short_lang] = $language_code['code'];
            }

            $current_lang = Utils::getCurrentLanguage($available_languages, $accept_language);
        }
        $response->headers->set('Content-Language', $current_lang);

        $data['entities'] = Utils::convertForI18n($data['entities'], $available_languages[$current_lang]);

        // Rendering
        $content = $app['twig']->render($api_name . '.twig', $data);
        $response->setContent($content);
    }

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
    $response->headers->set('Content-Language', 'en');

    return $response;
};
