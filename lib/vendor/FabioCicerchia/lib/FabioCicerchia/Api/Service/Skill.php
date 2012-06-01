<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage Skill
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */

namespace FabioCicerchia\Api\Service;

use FabioCicerchia\Api;

/**
 * The Skill Service.
 *
 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage Skill
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */
class Skill extends \FabioCicerchia\Api\ServiceAbstract
{
    // {{{ PROPERTIES
    /**
     * @var string $collection_name The name of the collection.
     */
    protected $collection_name = 'skill';
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
