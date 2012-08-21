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

// TODO: Run PHP-CS-Fixer.

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

    $message  = $e->getMessage(); // TODO: Remove or restore it?
    $message  = 'Error, you are unauthorised to know more about it.';
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
    $mime_type = $app['debug'] === true // TODO: CamelCase notation.
                 ? 'application/xml'
                 : 'application/vnd.ads+xml;v=1.0';

    // DB
    $database = $app['mongodb']->selectDatabase('curriculum');

    // Business Logic
    $entryPoint = new EntryPoint();

    $data = [
        'routes'    => $entryPoint->getServices(),
        'mime_type' => $mime_type, // TODO: CamelCase notation.
        'api_name'  => 'entry point',
        'email'     => $database->selectCollection('information')->find()
                                 ->getNext()['contacts']['email']
    ];

    // Rendering
    $content  = $app['twig']->render('root.twig', $data);

    // Response
    $response = new Response($content);
    // TODO: Provide different mime-types (XML, JSON, ...)
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
 * @param string $api_name The API name retrieved from URL.
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
$closures['api'] = function ($api_name) use ($app) { // TODO: CamelCase notation.
    if (is_string($api_name) === false) { // TODO: CamelCase notation.
        $message = 'The parameter $api_name must be a string.';
        throw new \InvalidArgumentException($message);
    }

    // DB
    $database = $app['mongodb']->selectDatabase('curriculum');

    // Business Logic
    try {
        $service = new Strategy($api_name, $database); // TODO: CamelCase notation.
    } catch (UnexpectedValueException $e) {
        $app->abort(404, 'The API ' . $api_name. ' does not exist.'); // TODO: CamelCase notation.
    }

    $data = $service->getData();
    $data['api_name'] = $api_name; // TODO: CamelCase notation.

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
        $mime_type = $app['debug'] === true // TODO: CamelCase notation.
                     ? 'application/xml'
                     : 'application/vnd.ads+xml;v=1.0';
        // TODO: Provide different mime-types (XML, JSON, ...)
        $response->headers->set('Content-Type', $mime_type); // TODO: CamelCase notation.

        // Language
        list($current_lang, $to_lang) = Utils::getLanguage($app, $database); // TODO: CamelCase notation.
        $response->headers->set('Content-Language', $current_lang); // TODO: CamelCase notation.

        $data['entities'] = Utils::convertForI18n($data['entities'], $to_lang); // TODO: CamelCase notation.
        $data['email']    = $database->selectCollection('information')
                                     ->find()->getNext()['contacts']['email'];

        // Rendering
        $content = $app['twig']->render($api_name . '.twig', $data); // TODO: CamelCase notation.
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

    // TODO: Provide different mime-types (XML, JSON, ...)
    $response->headers->set('Content-Type',     'text/plain');
    $response->headers->set('Content-Language', 'en');

    return $response;
};
