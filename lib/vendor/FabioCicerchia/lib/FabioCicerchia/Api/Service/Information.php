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
 * @subpackage Information
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 - 2013 Fabio Cicerchia.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 * @since      File available since Release 0.1
 */

namespace FabioCicerchia\Api\Service;

use FabioCicerchia\Api;

/**
 * The Information Service.
 *
 * @category   Code
 * @package    FabioCicerchia\Api\Service
 * @subpackage Information
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 - 2013 Fabio Cicerchia. All Rights reserved.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 * @since      File available since Release 0.1
 */
class Information extends \FabioCicerchia\Api\ServiceAbstract
{
    // {{{ Properties - Protected ==============================================
    /**
     * The name of the collection.
     *
     * @var string $collectionName
     */
    protected $collectionName = 'information';
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
        return ['entities' => parent::elaborateData($data)];
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: execDataQuery -----------------------------------------------
    /**
     * Retrieve all the documents from a collection.
     *
     * ### General Information #################################################
     *
     * @link  https://github.com/doctrine/mongodb/blob/master/lib/Doctrine/MongoDB/Cursor.php
     * @see   FabioCicerchia\Api\ServiceAbstract::getCollection() The Collection Handle.
     * @since Version 0.1
     *
     * @return array
     */
    protected function execDataQuery()
    {
        // TODO: No coverage for this line.
        return $this->getCollection()
                    ->find()->sort(['date.end' => 'desc'])->toArray();
    }
    // }}} ---------------------------------------------------------------------
    // }}} =====================================================================
}
