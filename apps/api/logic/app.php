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
// INIT SILEX ------------------------------------------------------------------
// -----------------------------------------------------------------------------
require_once __DIR__ . '/../silex.phar';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

require __DIR__ . '/bootstrap.php';
require __DIR__ . '/controller.php';

use FabioCicerchia\Api\Service\EntryPoint;
use FabioCicerchia\Api\Service\Strategy;
use FabioCicerchia\Api\Utils;

// -----------------------------------------------------------------------------
// ERROR HANDLING --------------------------------------------------------------
// -----------------------------------------------------------------------------

if (empty($closures['error']) === true
    || is_callable($closures['error']) === false
) {
    throw new DomainException('The closure "error" must be defined!');
}
$app->error($closures['error']);

// -----------------------------------------------------------------------------
// ROUTE ROOT ------------------------------------------------------------------
// -----------------------------------------------------------------------------

if (empty($closures['root']) === true
    || is_callable($closures['root']) === false
) {
    throw new DomainException('The closure "root" must be defined!');
}
$app->get('/', $closures['root'])->method('GET')->bind('root');

// -----------------------------------------------------------------------------
// ROUTE API -------------------------------------------------------------------
// -----------------------------------------------------------------------------

if (empty($closures['api']) === true
    || is_callable($closures['api']) === false
) {
    throw new DomainException('The closure "api" must be defined!');
}
$app->get('/{api_name}', $closures['api'])->assert('api_name', '[a-z]+')
    ->method('GET')->bind('api');

// -----------------------------------------------------------------------------
// ROUTE API DEFINITION SYNTAX -------------------------------------------------
// -----------------------------------------------------------------------------

if (empty($closures['api_definition_syntax']) === true
    || is_callable($closures['api_definition_syntax']) === false
) {
    throw new DomainException('The closure "api_definition_syntax" must be defined!');
}
$app->get('/api-definition-syntax', $closures['api_definition_syntax'])
    ->method('GET')->bind('api_definition_syntax');

// -----------------------------------------------------------------------------
// RETURN APP ------------------------------------------------------------------
// -----------------------------------------------------------------------------
return $app;
