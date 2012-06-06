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
abstract class ServiceAbstract
{
    // {{{ PROPERTIES
    /**
     * @var \Doctrine\MongoDB\Collection $_collection The Collection Handle.
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
     * @param  \Doctrine\MongoDB\Database $db_handle The Database Handle
     *
     * @internal
     * @return void
     * @see    https://github.com/doctrine/mongodb/blob/master/lib/Doctrine/MongoDB/Database.php
     * @see    FabioCicerchia\Api\ServiceAbstract::$_collection The Collection Handle.
     */
    protected function setDatabase(\Doctrine\MongoDB\Database $db_handle)
    {
        $this->_collection = $db_handle->selectCollection($this->collection_name);
    }
    // }}}

    // {{{ execDataQuery
    /**
     * Retrieve all the documents from a collection.
     *
     * @internal
     * @return \Doctrine\MongoDB\Cursor
     * @see    https://github.com/doctrine/mongodb/blob/master/lib/Doctrine/MongoDB/Cursor.php
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
        if ($data instanceOf \Doctrine\MongoDB\Cursor) {
            $data = $data->toArray();
        } elseif (is_array($data) !== true) {
            $data = (array)$data;
        }

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
     * @return \Doctrine\MongoDB\Collection
     * @see    FabioCicerchia\Api\ServiceAbstract::$_collection The Collection Handle.
     */
    public function getCollection()
    {
        return $this->_collection;
    }
    // }}}
}
