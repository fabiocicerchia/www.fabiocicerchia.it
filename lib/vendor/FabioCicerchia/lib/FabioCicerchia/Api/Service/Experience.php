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
     * @var string $collection_name The name of the collection.
     */
    protected $collection_name = 'experience';
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
        return $this->getCollection()->find()->sort(array('date.end' => 'desc'));
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
        $data = parent::elaborateData($data);
        $data = ['entities' => $data];

        return $data;
    }
    // }}}
}
