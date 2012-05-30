<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4

 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage EntryPoint
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 * @version    XXX
 */

namespace FabioCicerchia\Api\Service;

/**
 * TODO: Message
 *
 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage EntryPoint
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 * @version    XXX
 */
class EntryPoint
{
    // {{{ PROPERTIES
    /**
     * @var array $services TODO: Message
     */
    protected $services = ['information', 'education', 'experience', 'skill', 'language'];
    // }}}

    // {{{ getServices
    /**
     * Message
     *
     * @api
     * @return array TODO: Message
     * @see    FabioCicerchia\Api\Service\EntryPoint::$services TODO: Message
     * @throw
     */
    public function getServices()
    {
        return $this->services;
    }
    // }}}
}
