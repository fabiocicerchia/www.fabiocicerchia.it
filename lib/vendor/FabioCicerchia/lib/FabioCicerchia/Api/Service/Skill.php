<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * Copyright 2012 - 2013 Fabio Cicerchia.
 *
 * Permission is hereby granted, free of  charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction,  including without limitation the rights
 * to use,  copy, modify,  merge, publish,  distribute, sublicense,  and/or sell
 * copies  of the  Software,  and to  permit  persons to  whom  the Software  is
 * furnished to do so, subject to the following conditions:
 *
 * The above  copyright notice and this  permission notice shall be  included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE  IS PROVIDED "AS IS",  WITHOUT WARRANTY OF ANY  KIND, EXPRESS OR
 * IMPLIED,  INCLUDING BUT  NOT LIMITED  TO THE  WARRANTIES OF  MERCHANTABILITY,
 * FITNESS FOR A  PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO  EVENT SHALL THE
 * AUTHORS  OR COPYRIGHT  HOLDERS  BE LIABLE  FOR ANY  CLAIM,  DAMAGES OR  OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * PHP Version 5.4
 *
 * @category   Code
 * @package    FabioCicerchia\Api\Service
 * @subpackage Skill
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 - 2013 Fabio Cicerchia.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 * @since      File available since Release 0.1
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
 * @copyright  2012 - 2013 Fabio Cicerchia. All Rights reserved.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 * @since      File available since Release 0.1
 */
class Skill extends \FabioCicerchia\Api\ServiceAbstract
{
    // {{{ Properties - Protected ==============================================
    /**
     * The name of the collection.
     *
     * @var string $collectionName
     */
    protected $collectionName = 'skill';
    // }}} =====================================================================

    // {{{ Methods - Protected =================================================
    // {{{ Method: elaborateData -----------------------------------------------
    /**
     * Modify if needed the data.
     *
     * ### General Information #################################################
     *
     * @param array $data The data.
     *
     * @see   FabioCicerchia\Api\ServiceAbstract::elaborateData()
     * @since Version 0.1
     *
     * @return array
     */
    protected function elaborateData(array $data)
    {
        $data = parent::elaborateData($data);

        // Retrieve the list of skill with its "months" value.
        $skillsWithMonths = [];
        if ($this->getCollection() instanceof \Doctrine\MongoDB\Collection) {
            $skillsWithMonths = $this->getSkillWithMonths();

            // Attach the months value to main data.
            foreach ($data as $key => $item) {
                foreach ($item['list'] as $subkey => $elem) {
                    $monthKey = isset($elem['name']['en_GB']) === true
                                ? $elem['name']['en_GB']
                                : $elem['name'];

                    if (isset($skillsWithMonths[$monthKey]) === false) {
                        $skillsWithMonths[$monthKey] = 0;
                    }

                    $data[$key]['list'][$subkey]['months'] = $skillsWithMonths[$monthKey];
                }
            }
        }

        return ['entities' => $data, 'tags' => $skillsWithMonths];
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: getSkillWithMonths ------------------------------------------
    /**
     * Retrieve a list of skill with its months value.
     *
     * ### General Information #################################################
     *
     * @return array
     */
    protected function getSkillWithMonths()
    {
        $skillsWithMonths = [];

        $experience = new Experience($this->getCollection()->getDatabase());
        foreach ($experience->getData()['entities'] as $entity) {
            $this->parseSkillValues($entity, $skillsWithMonths);
            if (isset($entity['projects']) === true) {
                foreach ($entity['projects'] as $project) {
                    $this->parseSkillValues($project, $skillsWithMonths);
                }
            }
        }

        return $skillsWithMonths;
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: parseSkillValues --------------------------------------------
    /**
     * Retrieve the "months" value inside an array.
     *
     * ### General Information #################################################
     *
     * @param array $entity The array to parse.
     * @param array $data   The skill container.
     *
     * @return void
     */
    protected function parseSkillValues(array $entity, array &$data)
    {
        $availableKeys = ['methodologies', 'techniques', 'technologies', 'tools'];

        foreach ($availableKeys as $key) {
            if (isset($entity[$key]) === true) {
                foreach ($entity[$key] as $elementKey => $elementValue) {
                    $value = isset($elementValue['months']) === true
                             ? intval($elementValue['months'])
                             : 0;

                    if (isset($data[$elementKey]) === false) {
                        $data[$elementKey] = 0;
                    }

                    $data[$elementKey] += $value;
                }
            }
        }
    }
    // }}} ---------------------------------------------------------------------
    // }}} =====================================================================
}
