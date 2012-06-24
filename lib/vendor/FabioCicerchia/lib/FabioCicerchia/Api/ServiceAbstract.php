<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   Code
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
 * @category   Code
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
     * @var \Doctrine\MongoDB\Collection $collection The Collection Handle.
     */
    private $collection = null;

    /**
     * @var string $collectionName The name of the collection.
     */
    protected $collectionName = null;

    /**
     * @var array $data The data.
     */
    protected $data = [];
    // }}}

    // {{{ __construct
    /**
     * The constructor.
     *
     * @param  \Doctrine\MongoDB\Database $db_handle The Database Handle.
     *
     * @internal
     * @return void
     * @see    FabioCicerchia\Api\ServiceAbstract::setDatabase() Executed to set up the database handle.
     * @see    FabioCicerchia\Api\ServiceAbstract::run()         Launch the main task.
     */
    public function __construct(\Doctrine\MongoDB\Database $db_handle)
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
     * @see    FabioCicerchia\Api\ServiceAbstract::$collection The Collection Handle.
     */
    protected function setDatabase(\Doctrine\MongoDB\Database $db_handle)
    {
        $this->collection = $db_handle->selectCollection($this->collectionName);
    }
    // }}}

    // {{{ execDataQuery
    /**
     * Retrieve all the documents from a collection.
     *
     * @internal
     * @return array
     * @see    https://github.com/doctrine/mongodb/blob/master/lib/Doctrine/MongoDB/Cursor.php
     * @see    FabioCicerchia\Api\ServiceAbstract::$collection The Collection Handle.
     */
    protected function execDataQuery()
    {
        return $this->collection->find()->toArray();
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
     * @param array $data The data.
     *
     * @internal
     * @return array
     */
    protected function elaborateData(array $data)
    {
        return $data;
    }
    // }}}

    // {{{ run
    /**
     * Launch the main task.
     *
     * @api
     * @return void
     * @see    FabioCicerchia\Api\ServiceAbstract::getRawData()    Retrieve data from the collection and manipulate it.
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
     * Getter for $collection.
     *
     * @api
     * @return \Doctrine\MongoDB\Collection
     * @see    FabioCicerchia\Api\ServiceAbstract::$collection The Collection Handle.
     */
    public function getCollection()
    {
        return $this->collection;
    }
    // }}}

    // {{{ getCollectionName
    /**
     * Getter for $collectionName.
     *
     * @api
     * @return string
     * @see    FabioCicerchia\Api\ServiceAbstract::$collectionName The name of the collection.
     */
    public function getCollectionName()
    {
        return $this->collectionName;
    }
    // }}}
}
