<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   Code
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
 * @category   Code
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
     * The name of the collection.
     *
     * @var string $collectionName
     */
    protected $collectionName = 'skill';
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
