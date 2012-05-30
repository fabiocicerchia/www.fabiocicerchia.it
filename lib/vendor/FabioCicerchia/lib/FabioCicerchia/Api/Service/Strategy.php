<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4

 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage Strategy
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 * @version    XXX
 */

namespace FabioCicerchia\Api\Service;

use FabioCicerchia\Api;

/**
 * TODO: Message
 *
 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage Strategy
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 * @version    XXX
 */
class Strategy implements \FabioCicerchia\Api\StrategyInterface
{
    // {{{ PROPERTIES
    /**
     * @var object $_strategy TODO: Message
     */
    private $_strategy = null;
    // }}}

    // {{{ __construct
    /**
     * TODO: Message
     *
     * @param  string $service_name TODO: Message
     * @param  object $db_handle TODO: Message
     *
     * @api
     * @return void TODO: Message
     * @see    http://example.com/my/bar Documentation of Foo.
     * @see    FabioCicerchia\Api\Service\Strategy::$_strategy TODO: Message
     * @throw UnexpectedValueException
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
     * TODO: Message
     *
     * @api
     * @return array TODO: Message
     * @see    FabioCicerchia\Api\Service\Strategy::$_strategy TODO: Message
     * @see    FabioCicerchia\Api\Service\*::getData() TODO: Message
     */
    public function getData()
    {
        return $this->_strategy->getData();
    }
    // }}}
}
