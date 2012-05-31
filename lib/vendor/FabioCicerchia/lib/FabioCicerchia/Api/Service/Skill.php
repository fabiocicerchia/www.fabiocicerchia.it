<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4

 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage Skill
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 * @version    XXX
 */

namespace FabioCicerchia\Api\Service;

use FabioCicerchia\Api;

/**
 * TODO: Message
 *
 * @category   API
 * @package    FabioCicerchia\Api\Service
 * @subpackage Skill
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 * @version    XXX
 */
class Skill extends \FabioCicerchia\Api\ServiceAbstract
{
    // {{{ PROPERTIES
    /**
     * @var string $collection_name TODO: Message
     */
    protected $collection_name = 'skill';
    // }}}

    // {{{ elaborateData
    /**
     * TODO: Message
     *
     * @internal
     * @return array TODO: Message
     * @see    FabioCicerchia\Api\Service\Skill::elaborateSkillEntities() TODO: Message
     */
    protected function elaborateData($data)
    {
        $data = $this->elaborateSkillEntities($data);

        return $data;
    }
    // }}}

    // {{{ elaborateSkillEntities
    /**
     * TODO: Message
     *
     * @param array $entities The list of the records retrieved.
     *
     * @internal
     * @return array TODO: Message
     */
    protected function elaborateSkillEntities($entities)
    {
        $new_entities = array();

        foreach ($entities as $entry) {
            $new_entities[$entry['name']['en_GB']]['_id'] = $entry['_id'];

            foreach ($entry['list'] as $item) {
                $new_entities[$entry['name']['en_GB']][$item['proficiency']][] = $item['name']; // TODO: fix the lang
            }
        }

        return $new_entities;
    }
    // }}}

    // {{{ postElaborateData
    /**
     * TODO: Message
     *
     * @param  array $data TODO: Message
     *
     * @internal
     * @return void
     */
    protected function postElaborateData()
    {
        $this->data = ['entities' => $this->data];
    }
    // }}}
}
