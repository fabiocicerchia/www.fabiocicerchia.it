<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   API
 * @package    FabioCicerchia\Api
 * @subpackage ServiceAbstract
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */

namespace FabioCicerchia\Api;

/**
 * The Abstract class for every Service.
 *
 * @category   API
 * @package    FabioCicerchia\Api
 * @subpackage ServiceAbstract
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */
abstract class ServiceAbstract implements ServiceInterface
{
    // {{{ PROPERTIES
    /**
     * @var object $_collection The Collection Handle.
     */
    private $_collection = null;

    /**
     * @var string $collection_name The name of the collection.
     */
    protected $collection_name = null;

    /**
     * @var array $data The data.
     */
    protected $data = [];
    // }}}

    // {{{ __construct
    /**
     * The constructor.
     *
     * @param  object $db_handle The Database Handle.
     *
     * @internal
     * @return void
     * @see    FabioCicerchia\Api\ServiceAbstract::setDatabase() Executed to set up the database handle.
     * @see    FabioCicerchia\Api\ServiceAbstract::run()         Launch the main task.
     */
    public function __construct($db_handle)
    {
        $this->setDatabase($db_handle);
        $this->run();
    }
    // }}}

    // {{{ setDatabase
    /**
     * Executed to set up the database handle.
     *
     * @param  object $db_handle The Database Handle
     *
     * @internal
     * @return void
     * @see    http://example.com/my/bar Documentation of Foo. // TODO: LINK FOR MONGO
     * @see    FabioCicerchia\Api\ServiceAbstract::$_collection The Collection Handle.
     */
    protected function setDatabase($db_handle)
    {
        $this->_collection = $db_handle->selectCollection($this->collection_name);
    }
    // }}}

    // {{{ execDataQuery
    /**
     * Retrieve all the documents from a collection.
     *
     * @internal
     * @return <Type> TODO: Message
     * @see    http://example.com/my/bar Documentation of Foo. // TODO: LINK FOR MONGO
     * @see    FabioCicerchia\Api\ServiceAbstract::$_collection The Collection Handle.
     */
    protected function execDataQuery()
    {
        return $this->_collection->find();
    }
    // }}}

    // {{{ getRawData
    /**
     * Retrieve the data from the collection and manipulate it.
     *
     * @internal
     * @return array
     * @see    FabioCicerchia\Api\ServiceAbstract::execDataQuery() Retrieve all the documents from a collection.
     */
    protected function getRawData()
    {
        $data = $this->execDataQuery();

        return $data;
    }
    // }}}

    // {{{ elaborateData
    /**
     * Modify if needed the data.
     *
     * @param  object $data The data.
     *
     * @internal
     * @return array
     */
    protected function elaborateData($data)
    {
        $data = is_array($data) === true ? $data : $data->toArray();

        return $data;
    }
    // }}}

    // {{{ run
    /**
     * Launch the main task.
     *
     * @api
     * @return void
     * @see    FabioCicerchia\Api\ServiceAbstract::getRawData()    Retrieve the data from the collection and manipulate it.
     * @see    FabioCicerchia\Api\ServiceAbstract::elaborateData() Modify if needed the data.
     * @see    FabioCicerchia\Api\ServiceAbstract::$data           The data.
     * @throw
     */
    public function run()
    {
        $data = $this->getRawData();

        $this->data = $this->elaborateData($data);
    }
    // }}}

    // {{{ getData
    /**
     * Getter for $data.
     *
     * @api
     * @return array
     * @see    FabioCicerchia\Api\ServiceAbstract::$data The data.
     */
    public function getData()
    {
        return $this->data;
    }
    // }}}

    // {{{ getCollection
    /**
     * Getter for $_collection.
     *
     * @api
     * @return object
     * @see    FabioCicerchia\Api\ServiceAbstract::$_collection The Collection Handle.
     */
    public function getCollection()
    {
        return $this->_collection;
    }
    // }}}
}
