<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage EntryPoint
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */

namespace FabioCicerchia\Api\Service;

/**
 * The EntryPoint.
 *
 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage EntryPoint
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */
class EntryPoint
{
    // {{{ PROPERTIES
    /**
     * @var array $services The list of active services.
     */
    protected $services = ['information', 'education', 'experience', 'skill', 'language'];
    // }}}

    // {{{ getServices
    /**
     * Getter for $services.
     *
     * @api
     * @return array
     * @see    FabioCicerchia\Api\Service\EntryPoint::$services The list of active services.
     * @throw
     */
    public function getServices()
    {
        return $this->services;
    }
    // }}}
}
