<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage Experience
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */

namespace FabioCicerchia\Api\Service;

use FabioCicerchia\Api;

/**
 * The Experience Service.
 *
 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage Experience
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */
class Experience extends \FabioCicerchia\Api\ServiceAbstract
{
    // {{{ PROPERTIES
    /**
     * @var string $collectionName The name of the collection.
     */
    protected $collectionName = 'experience';
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
        $data = ['entities' => $data];

        return $data;
    }
    // }}}
}
