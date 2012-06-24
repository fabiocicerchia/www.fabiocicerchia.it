<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   Code
 * @package    FabioCicerchia\Api\Service
 * @subpackage Strategy
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
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
 * @license    TBD <http://www.fabiocicerchia.it>
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
     * @param  string                     $service_name The name of the service.
     * @param  \Doctrine\MongoDB\Database $db_handle    The Database Handle.
     *
     * @api
     * @return void
     * @see    http://www.php.net/manual/en/class.unexpectedvalueexception.php
     * @see    FabioCicerchia\Api\Service\Strategy::$strategy The instance of Service.
     * @throw  UnexpectedValueException
     */
    public function __construct($service_name, \Doctrine\MongoDB\Database $db_handle)
    {
        if (is_string($service_name) === false) {
            throw new \InvalidArgumentException('The parameter $service_name must be a string.');
        }

        $class = '\\FabioCicerchia\\Api\\Service\\' . ucfirst($service_name);

        try {
            $this->strategy = new $class($db_handle);
        } catch (Exception $e) {
            throw new UnexpectedValueException($e->getMessage(), $e->getCode());
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
