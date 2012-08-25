<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * Copyright 2012 Fabio Cicerchia.
 *
 * Permission is hereby granted, free of  charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction,  including without limitation the rights
 * to use,  copy, modify,  merge, publish,  distribute, sublicense,  and/or sell
 * copies  of the  Software,  and to  permit  persons to  whom  the Software  is
 * furnished to do so, subject to the following conditions:
 *
 * The above  copyright notice and this  permission notice shall be  included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE  IS PROVIDED "AS IS",  WITHOUT WARRANTY OF ANY  KIND, EXPRESS OR
 * IMPLIED,  INCLUDING BUT  NOT LIMITED  TO THE  WARRANTIES OF  MERCHANTABILITY,
 * FITNESS FOR A  PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO  EVENT SHALL THE
 * AUTHORS  OR COPYRIGHT  HOLDERS  BE LIABLE  FOR ANY  CLAIM,  DAMAGES OR  OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * PHP Version 5.4
 *
 * @category  Api
 * @package   Api
 * @author    Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright 2012 Fabio Cicerchia.
 * @license   MIT <http://www.opensource.org/licenses/MIT>
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
 * @param \Exception $e    The Exception instance.
 * @param integer    $code The exception code.
 *
 * @uses Silex\Application $app The Silex Application instance.
 *
 * @since Version 0.1
 *
 * @return Response|null
 */
$closures['error'] = function (\Exception $e, $code) use ($app) {
    if ($app['debug'] === true) {
        return;
    }

    $message  = 'Error, you are unauthorised to know more about this.';
    $response = new Response($message, $code);
    $response->headers->set('Content-Language', 'en');

    return $response;
};

// -----------------------------------------------------------------------------
// ROUTE ROOT ------------------------------------------------------------------
// -----------------------------------------------------------------------------
/**
 * Root - Closure.
 *
 * @link  https://github.com/doctrine/mongodb/blob/master/lib/Doctrine/MongoDB/Cursor.php
 * @see   FabioCicerchia\Api\Service\EntryPoint::getServices()
 * @see   Symfony\Component\HttpFoundation\Response
 * @uses  Silex\Application $app The Silex Application instance.
 * @since Version 0.1
 *
 * @return Response
 */
$closures['root'] = function () use ($app) {
    // MimeType
    $availableMimeTypes = [
        'application/vnd.ads+xml;v=1.0',
        'application/xml',
        'application/json'
    ];
    $requestedMimeType = [];
    if (isset($_SERVER['HTTP_ACCEPT']) === true) {
        $requestedMimeType = Utils::httpPriorityOrder($_SERVER['HTTP_ACCEPT']);
    }
    $mimeType = Utils::retrieveCurrentValue($availableMimeTypes, $requestedMimeType);

    // DB
    $database = $app['mongodb']->selectDatabase('curriculum');

    // Business Logic
    $entryPoint = new EntryPoint();

    $data = [
        'routes'    => $entryPoint->getServices(),
        'mime_type' => $mimeType,
        'api_name'  => 'entry point',
        'email'     => $database->selectCollection('information')->find()
                                 ->getNext()['contacts']['email']
    ];

    // Rendering
    $content = $app['twig']->render('root.twig', $data);
    $content = Utils::transform($content, $mimeType);

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
 * @param string $apiName The API name retrieved from URL.
 *
 * @link  http://www.php.net/manual/en/class.invalidargumentexception.php
 * @link  http://www.php.net/manual/en/class.unexpectedvalueexception.php
 * @see   FabioCicerchia\Api\Service\Strategy::getData()
 * @see   Symfony\Component\HttpFoundation\Response::setMaxAge()
 * @see   Symfony\Component\HttpFoundation\Response::setSharedMaxAge()
 * @see   Symfony\Component\HttpFoundation\Response::setETag()
 * @see   Symfony\Component\HttpFoundation\Response::isNotModified()
 * @see   Symfony\Component\HttpFoundation\Response::setContent()
 * @uses  Silex\Application $app The Silex Application instance.
 * @since Version 0.1
 *
 * @return Response
 */
$closures['api'] = function ($apiName) use ($app) {
    if (is_string($apiName) === false) {
        $message = 'The parameter $apiName must be a string.';
        throw new \InvalidArgumentException($message);
    }

    // DB
    $database = $app['mongodb']->selectDatabase('curriculum');

    // Business Logic
    try {
        $service = new Strategy($apiName, $database);
    } catch (UnexpectedValueException $e) {
        $app->abort(404, 'The API ' . $apiName. ' does not exist.');
    }

    $data = $service->getData();
    $data['api_name'] = $apiName;

    // Response
    // TODO: Less code here below...
    $response = new Response();
    if ($app['debug'] === false) {
        $lastModified = Utils::getLastModified($data);

        $response->setMaxAge(28800);
        // This set the cache to public.
        $response->setSharedMaxAge(28800);
        $response->setETag(md5(serialize($data)));
        $response->headers->set('Last-Modified', $lastModified);
    }

    // TODO: Less code here below...
    if ($response->isNotModified($app['request']) === false) {
        // MimeType
        $availableMimeTypes = [
            'application/vnd.ads+xml;v=1.0',
            'application/xml',
            'application/json'
        ];
        $requestedMimeType = [];
        if (isset($_SERVER['HTTP_ACCEPT']) === true) {
            $requestedMimeType = Utils::httpPriorityOrder($_SERVER['HTTP_ACCEPT']);
        }
        $mimeType = Utils::retrieveCurrentValue($availableMimeTypes, $requestedMimeType);

        $response->headers->set('Content-Type', $mimeType);

        // Language
        list($currentLang, $toLang) = Utils::getLanguage($app, $database);
        $response->headers->set('Content-Language', $currentLang);

        $data['entities'] = Utils::convertForI18n($data['entities'], $toLang);
        $data['email']    = $database->selectCollection('information')
                                     ->find()->getNext()['contacts']['email'];

        // Rendering
        $content = $app['twig']->render($apiName . '.twig', $data);
        $content = Utils::transform($content, $mimeType);

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
 * @see   Symfony\Component\HttpFoundation\Response
 * @uses  Silex\Application $app The Silex Application instance.
 * @since Version 0.1
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