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
 * @category   Code
 * @package    Api
 * @subpackage App
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FabioCicerchia\Api\Service\EntryPoint;
use FabioCicerchia\Api\Service\Strategy;
use FabioCicerchia\Api\Utils;

// -----------------------------------------------------------------------------
// INIT SILEX ------------------------------------------------------------------
// -----------------------------------------------------------------------------
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'silex.phar';

$app = new Silex\Application();

require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'controller.php';

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
    $message = 'The closure "api_definition_syntax" must be defined!';
    throw new DomainException($message);
}
$app->get('/api-definition-syntax', $closures['api_definition_syntax'])
    ->method('GET')->bind('api_definition_syntax');

// -----------------------------------------------------------------------------
// RETURN APP ------------------------------------------------------------------
// -----------------------------------------------------------------------------
return $app;
