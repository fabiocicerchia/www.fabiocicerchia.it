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

// TODO: 100% Internal Coverage.
// TODO: 100% Overall Coverage.

use \FabioCicerchia\Api\Utils;

require_once TEST_LIB_PATH . 'Api/Utils.php';

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
class UtilsTest extends FabioCicerchia\TestCase
{
    // {{{ Methods - Public ====================================================
    // {{{ Method: provideLanguages --------------------------------------------
    /**
     * Language provider. The first key is mapping of "available" langs, the
     * second one is HTTP header "Accept" and the last one is the final value
     * that should match as best option suitable.
     *
     * @return array
     */
    public function provideLanguages()
    {
        return [
            // Set #0 ----------------------------------------------------------
            [
                ['it' => 'it_IT', 'en' => 'en_GB'],
                'da, en-gb;q=0.8, en;q=0.7',
                'en'
            ],
            // Set #1 ----------------------------------------------------------
            [
                ['it' => 'it_IT', 'en' => 'en_GB'],
                'da, it-it;q=0.8, en;q=0.7',
                'it'
            ],
            // Set #2 ----------------------------------------------------------
            [
                ['da' => 'da_DK', 'en' => 'en_GB'],
                'da, it-it;q=0.8, en;q=0.7',
                'da'
            ],
            // Set #3 ----------------------------------------------------------
            [
                ['da' => 'da_DK', 'en' => 'en_GB'],
                'da;q=0.8, it-it;q=0.8, en;q=0.7',
                'da'
            ],
            // Set #4 ----------------------------------------------------------
            [
                ['da' => 'da_DK', 'en' => 'en_GB'],
                'it-it;q=0.8',
                'da'
            ],
        ];
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: provideDataToConvert ----------------------------------------
    /**
     * Data provider. The first key is the input data to parse, the second one
     * is language value to use and the last one is the expected output.
     *
     * @return array
     */
    public function provideDataToConvert()
    {
        return [
            // Set #0 ----------------------------------------------------------
            [
                ['aaa' => 1, 'blabla' => ['en_GB' => 0, 'it_IT' => 1]],
                'en_GB',
                ['aaa' => 1, 'blabla' => 0],
            ],
            // Set #1 ----------------------------------------------------------
            [
                ['aaa' => 1, 'blabla' => ['en_GB' => 0, 'it_IT' => 1]],
                'it_IT',
                ['aaa' => 1, 'blabla' => 1],
            ],
            // Set #2 ----------------------------------------------------------
            [
                ['aaa' => 1, 'blabla' => ['en_GB' => 0, 'it_IT' => 1]],
                'da',
                ['aaa' => 1, 'blabla' => ['en_GB' => 0, 'it_IT' => 1]],
            ],
        ];
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: provideFakeData ---------------------------------------------
    /**
     * Data provider. The first key is the input data to parse, the second one
     * is the expected output as extracted timestamp.
     *
     * @return array
     */
    public function provideFakeData()
    {
        $mongoDate = new MongoDate;

        return [
            // Set #0 ----------------------------------------------------------
            [
                ['entities' => ['first' => ['date' => 'aaaa']]],
                gmdate('D, d M Y H:i:s', filemtime(__DIR__ . '/../../../../../db/mongo-curriculum.js')) . ' GMT'
            ],
            // Set #1 ----------------------------------------------------------
            [
                ['entities' => ['first' => ['date' => ['start' => 0, 'end' => $mongoDate]]]],
                gmdate('D, d M Y H:i:s', $mongoDate->sec) . ' GMT'
            ],
            // Set #2 ----------------------------------------------------------
            [
                ['entities' => ['first' => ['date' => ['start' => $mongoDate]]]],
                gmdate('D, d M Y H:i:s', $mongoDate->sec) . ' GMT'
            ],
        ];
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: providePrioritisedString ------------------------------------
    /**
     * Provide a list of prioritised string.
     *
     * @return array
     */
    public function providePrioritisedString()
    {
        return [
            // Set #0 ----------------------------------------------------------
            [
                'text/plain; q=0.5, text/html, text/x-dvi; q=0.8, text/x-c',
                ['text/html', 'text/x-c', 'text/x-dvi', 'text/plain']
            ],
            // Set #1 ----------------------------------------------------------
            [
                '*/*, text/html, text/html;level=1',
                ['text/html', '*/*']
            ],
            // Set #2 ----------------------------------------------------------
            [
                'text/*, text/html, text/html;level=1',
                ['text/html', 'text/*']
            ],
            // Set #3 ----------------------------------------------------------
            [
                'text/*, text/html, text/html;level=1, */*',
                ['text/html', 'text/*', '*/*']
            ],
            // Set #4 ----------------------------------------------------------
            [
                'text/*, text/html, text/html;level=2, text/html;level=1, */*',
                ['text/html', 'text/*', '*/*']
            ],
            // Set #5 ----------------------------------------------------------
            [
                'text/*, text/plain;level=2, text/html, text/html;level=2, text/html;level=1, */*',
                ['text/html', 'text/plain', 'text/*', '*/*']
            ],
            // Set #6 ----------------------------------------------------------
            [
                'text/*;q=0.3, text/html;q=0.7, text/html;level=1, text/html;level=2;q=0.4, */*;q=0.5',
                ['text/html', '*/*', 'text/*']
            ],
            // Set #7 ----------------------------------------------------------
            [
                'iso-8859-5, unicode-1-1;q=0.8',
                ['iso-8859-5', 'unicode-1-1']
            ],
            // Set #8 ----------------------------------------------------------
            [
                'compress, gzip',
                ['compress', 'gzip']
            ],
            // Set #9 ----------------------------------------------------------
            [
                '*',
                ['*']
            ],
            // Set #10 ----------------------------------------------------------
            [
                'compress;q=0.5, gzip;q=1.0',
                ['gzip', 'compress']
            ],
            // Set #11 ----------------------------------------------------------
            [
                'gzip;q=1.0, identity; q=0.5, *;q=0',
                ['gzip', 'identity', '*']
            ],
            // Set #12 ----------------------------------------------------------
            [
                'da, en-gb;q=0.8, en;q=0.7',
                ['da', 'en-gb', 'en']
            ],
        ];
    }

    // {{{ Method: testGetCurrentLanguage --------------------------------------
    /**
     * Test method "getCurrentLanguage" with real Accept HTTP Header.
     *
     * @param array  $db_language The input data.
     * @param string $string      The languages to use.
     * @param string $value       The expected output.
     *
     * @dataProvider provideLanguages
     *
     * @since Version 0.1
     *
     * @return void
     */
    public function testGetCurrentLanguage(array $db_language, $string, $value)
    {
        $this->assertEquals($value, Utils::getCurrentLanguage($db_language, $string));
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testGetCurrentLanguageWithWrongValue ------------------------
    /**
     * Test method "getCurrentLanguage" using wrong values.
     *
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The parameter $accept_language must be a string.
     *
     * @since Version 0.1
     *
     * @return void
     */
    public function testGetCurrentLanguageWithWrongValue()
    {
        Utils::getCurrentLanguage(array(), null);
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testConvertForI18n ------------------------------------------
    /**
     * Test method "convertForI18n".
     *
     * @param array  $input    The input data.
     * @param string $language The language to use.
     * @param array  $output   The expected output.
     *
     * @dataProvider provideDataToConvert
     *
     * @since Version 0.1
     *
     * @return void
     */
    public function testConvertForI18n(array $input, $lang, array $output)
    {
        $this->assertEquals($output, Utils::convertForI18n($input, $lang));
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testConvertForI18nWithWrongValue ----------------------------
    /**
     * Test method "convertForI18n" using wrong values.
     *
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The parameter $language must be a string.
     *
     * @since Version 0.1
     *
     * @return void
     */
    public function testConvertForI18nWithWrongValue()
    {
        Utils::convertForI18n(array(), null);
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testGetLastModified -----------------------------------------
    /**
     * Test method "getLastModified".
     *
     * @param array  $input  The input data.
     * @param string $output The output data.
     *
     * @dataProvider provideFakeData
     *
     * @since Version 0.1
     *
     * @return void
     */
    public function testGetLastModified(array $input, $output)
    {
        $this->assertEquals($output, Utils::getLastModified($input));
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testHttpPriorityOrder ---------------------------------------
    /**
     * Test method "httpPriorityOrder".
     *
     * @param string $input  The input data.
     * @param array  $output The output data.
     *
     * @dataProvider providePrioritisedString
     *
     * @since Version 0.1
     *
     * @return void
     */
    public function testHttpPriorityOrder($input, array $output)
    {
        $method = $this->retrieveMethod(new Utils, 'httpPriorityOrder');

        $this->assertEquals($output, $method->invokeArgs(new Utils, array($input)));
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testHttpPriorityOrderWithWrongValue -------------------------
    /**
     * Test method "httpPriorityOrder" using wrong values.
     *
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage The parameter $string must be a string.
     *
     * @since Version 0.1
     *
     * @return void
     */
    public function testHttpPriorityOrderWithWrongValue()
    {
        $method = $this->retrieveMethod(new Utils, 'httpPriorityOrder');
        $method->invokeArgs(new Utils, array(array()));
    }
    // }}} ---------------------------------------------------------------------
    // }}} =====================================================================
}