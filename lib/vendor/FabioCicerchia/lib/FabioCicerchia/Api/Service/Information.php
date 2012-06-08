<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage Information
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */

namespace FabioCicerchia\Api\Service;

use FabioCicerchia\Api;

/**
 * The Information Service.
 *
 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage Information
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */
class Information extends \FabioCicerchia\Api\ServiceAbstract
{
    // {{{ PROPERTIES
    /**
     * @var string $collectionName The name of the collection.
     */
    protected $collectionName = 'information';
    // }}}

    // {{{ execDataQuery
    /**
     * Retrieve all the documents from a collection.
     *
     * @internal
     * @return array
     * @see    https://github.com/doctrine/mongodb/blob/master/lib/Doctrine/MongoDB/Cursor.php
     * @see    FabioCicerchia\Api\ServiceAbstract::$_collection The Collection Handle.
     */
    protected function execDataQuery()
    {
        return $this->getCollection()
                    ->find()->sort(['date.end' => 'desc'])->toArray();
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
        $data = parent::elaborateData($data);

        $keys     = array_keys($data);
        $main_key = array_shift($keys);

        $data = ['entities' => $data, 'main_key' => $main_key];

        return $data;
    }
    // }}}
}
