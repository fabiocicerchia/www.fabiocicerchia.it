<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   Code
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
 * @category   Code
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
     * The name of the collection.
     *
     * @var string $collectionName
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
        $part1 = $this->getCollection()
                     ->find(array('date.end' => array('$exists' => false)))
                     ->sort(['date.start' => 'desc'])->toArray();

        $part2 = $this->getCollection()
                     ->find(array('date.end' => array('$exists' => true)))
                     ->sort(['date.end' => 'desc'])->toArray();

        return array_merge($part1, $part2);
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
