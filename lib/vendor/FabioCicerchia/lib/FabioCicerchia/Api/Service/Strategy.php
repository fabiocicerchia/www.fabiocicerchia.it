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
 * @package    FabioCicerchia\Api\Service
 * @subpackage Strategy
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 */

namespace FabioCicerchia\Api\Service;

use FabioCicerchia\Api;

/**
 * The Strategy Pattern applied.
 *
 * @category   Code
 * @package    FabioCicerchia\Api\Service
 * @subpackage Strategy
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 */
class Strategy implements \FabioCicerchia\Api\StrategyInterface
{
    // {{{ PROPERTIES
    /**
     * The instance of Service.
     *
     * @var object $strategy
     */
    private $strategy = null;
    // }}}

    // {{{ __construct
    /**
     * The constructor.
     *
     * @param string                     $service_name The name of the service.
     * @param \Doctrine\MongoDB\Database $db_handle    The Database Handle.
     *
     * @api
     * @see    http://www.php.net/manual/en/class.unexpectedvalueexception.php
     * @see    FabioCicerchia\Api\Service\Strategy::$strategy The instance of Service.
     * @throws \InvalidArgumentException The parameter $service_name must be a string.
     * @throws \UnexpectedValueException The message will be the message of every Exception catched.
     * @return void
     */
    public function __construct($service_name, \Doctrine\MongoDB\Database $db_handle)
    {
        if (is_string($service_name) === false) {
            $message = 'The parameter $service_name must be a string.';
            throw new \InvalidArgumentException($message);
        }

        $class = '\\FabioCicerchia\\Api\\Service\\' . ucfirst($service_name);

        try {
            $this->strategy = new $class($db_handle);
        } catch (\Exception $e) {
            throw new \UnexpectedValueException($e->getMessage(), $e->getCode());
        }
    }
    // }}}

    // {{{ getData
    /**
     * Retrieve the data from the Service.
     *
     * @api
     * @return array
     * @see    FabioCicerchia\Api\Service\Strategy::$strategy The instance of Service.
     * @see    FabioCicerchia\Api\Service\*::getData()         Getter for $data.
     */
    public function getData()
    {
        return $this->strategy->getData();
    }
    // }}}
}
