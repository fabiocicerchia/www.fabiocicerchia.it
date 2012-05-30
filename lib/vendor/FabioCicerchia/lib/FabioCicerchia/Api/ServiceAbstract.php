<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4

 * @category   API
 * @package    FabioCicerchia\Api
 * @subpackage ServiceAbstract
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 * @version    XXX
 */

namespace FabioCicerchia\Api;

/**
 * TODO: Message
 *
 * @category   API
 * @package    FabioCicerchia\Api
 * @subpackage ServiceAbstract
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 * @version    XXX
 */
abstract class ServiceAbstract implements ServiceInterface
{
    // {{{ PROPERTIES
    /**
     * @var object $_collection TODO: Message
     */
    private $_collection = null;

    /**
     * @var string $collection_name TODO: Message
     */
    protected $collection_name = null;

    /**
     * @var array $data TODO: Message
     */
    protected $data = [];
    // }}}

    // {{{ __construct
    /**
     * TODO: Message
     *
     * @param  object $db_handle TODO: Message
     *
     * @internal
     * @return void TODO: Message
     * @see    FabioCicerchia\Api\ServiceAbstract::setDatabase() TODO: Message
     * @see    FabioCicerchia\Api\ServiceAbstract::run() TODO: Message
     */
    public function __construct($db_handle)
    {
        $this->setDatabase($db_handle);
        $this->run();
    }
    // }}}

    // {{{ setDatabase
    /**
     * TODO: Message
     *
     * @param  object $db_handle TODO: Message
     *
     * @internal
     * @return void TODO: Message
     * @see    http://example.com/my/bar Documentation of Foo.
     * @see    FabioCicerchia\Api\ServiceAbstract::$_collection TODO: Message
     */
    protected function setDatabase($db_handle)
    {
        $this->_collection = $db_handle->selectCollection($this->collection_name);
    }
    // }}}

    // {{{ execDataQuery
    /**
     * TODO: Message
     *
     * @internal
     * @return <Type> TODO: Message
     * @see    http://example.com/my/bar Documentation of Foo.
     * @see    FabioCicerchia\Api\ServiceAbstract::$_collection TODO: Message
     */
    protected function execDataQuery()
    {
        return $this->_collection->find();
    }
    // }}}

    // {{{ getRawData
    /**
     * TODO: Message
     *
     * @internal
     * @return array TODO: Message
     * @see    FabioCicerchia\Api\ServiceAbstract::execDataQuery() TODO: Message
     * @see    FabioCicerchia\Api\ServiceAbstract::elaborateData() TODO: Message
     */
    protected function getRawData()
    {
        $data = $this->execDataQuery();
        $data = $this->elaborateData($data);

        return $data;
    }
    // }}}

    // {{{ elaborateData
    /**
     * TODO: Message
     *
     * @param  object $data TODO: Message
     *
     * @internal
     * @return object TODO: Message
     */
    protected function elaborateData($data)
    {
        return $data;
    }
    // }}}

    // {{{ postElaborateData
    /**
     * TODO: Message
     *
     * @internal
     * @return void
     */
    protected function postElaborateData()
    {
    }
    // }}}

    // {{{ run
    /**
     * TODO: Message
     *
     * @api
     * @return void TODO: Message
     * @see    FabioCicerchia\Api\ServiceAbstract::getRawData() TODO: Message
     * @see    FabioCicerchia\Api\ServiceAbstract::postElaborateData() TODO: Message
     * @see    FabioCicerchia\Api\ServiceAbstract::$data TODO: Message
     * @throw
     */
    public function run()
    {
        $data = $this->getRawData();
        $this->data = is_array($data) === true ? $data : $data->toArray(); // TODO: CHANGE THIS
        $this->postElaborateData();
    }
    // }}}

    // {{{ getData
    /**
     * TODO: Message
     *
     * @api
     * @return array TODO: Message
     * @see    FabioCicerchia\Api\ServiceAbstract::$data TODO: Message
     */
    public function getData()
    {
        return $this->data;
    }
    // }}}

    // {{{ getCollection
    /**
     * TODO: Message
     *
     * @api
     * @return object TODO: Message
     * @see    FabioCicerchia\Api\ServiceAbstract::$_collection TODO: Message
     */
    public function getCollection()
    {
        return $this->_collection;
    }
    // }}}
}
