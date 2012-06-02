<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
*
 * @category   API
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
 * @category   API
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
     * @var object $_strategy The instance of Service.
     */
    private $_strategy = null;
    // }}}

    // {{{ __construct
    /**
     * The constructor.
     *
     * @param  string $service_name The name of the service.
     * @param  object $db_handle    The Database Handle.
     *
     * @api
     * @return void
     * @see    http://www.php.net/manual/en/class.unexpectedvalueexception.php
     * @see    FabioCicerchia\Api\Service\Strategy::$_strategy The instance of Service.
     * @throw  UnexpectedValueException
     */
    public function __construct($service_name, $db_handle)
    {
        $className = '\\FabioCicerchia\\Api\\Service\\' . ucfirst($service_name);

        try {
            $this->_strategy = new $className($db_handle);
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
     * @see    FabioCicerchia\Api\Service\Strategy::$_strategy The instance of Service.
     * @see    FabioCicerchia\Api\Service\*::getData()         Getter for $data.
     */
    public function getData()
    {
        return $this->_strategy->getData();
    }
    // }}}
}
