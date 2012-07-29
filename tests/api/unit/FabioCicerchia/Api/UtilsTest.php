<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * Copyright 2012 Fabio Cicerchia.
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
 * @category   Test
 * @package    FabioCicerchia\Api
 * @subpackage UtilsTest
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 * @since      File available since Release 0.1
 */

use \FabioCicerchia\Api\Utils;

require_once LIB_PATH . 'Api/Utils.php';

/**
 * The Utils Test class.
 *
 * @category   Test
 * @package    FabioCicerchia\Api
 * @subpackage Utils
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 * @since      File available since Release 0.1
 */
class UtilsTest extends PHPUnit_Framework_TestCase
{
    // {{{ testGetCurrentLanguage
    /**
     * Test method "getCurrentLanguage" with real Accept HTTP Header.
     *
     * @return void
     */
    public function testGetCurrentLanguage()
    {
        $db_language = ['it' => 'it_IT', 'en' => 'en_GB'];
        $string      = 'da, en-gb;q=0.8, en;q=0.7';
        $this->assertEquals('en', Utils::getCurrentLanguage($db_language, $string));

        $db_language = ['it' => 'it_IT', 'en' => 'en_GB'];
        $string      = 'da, it-it;q=0.8, en;q=0.7';
        $this->assertEquals('it', Utils::getCurrentLanguage($db_language, $string));

        $db_language = ['da' => 'da_DK', 'en' => 'en_GB'];
        $string      = 'da, it-it;q=0.8, en;q=0.7';
        $this->assertEquals('da', Utils::getCurrentLanguage($db_language, $string));
    }
    // }}}

    // {{{ testConvertForI18n
    /**
     * Test method "convertForI18n".
     *
     * @return void
     */
    public function testConvertForI18n()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
    // }}}
}
