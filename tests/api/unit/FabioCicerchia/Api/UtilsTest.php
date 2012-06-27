<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   Test
 * @package    FabioCicerchia\Api
 * @subpackage Utils
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */

require_once __DIR__ . '/../../../../../lib/vendor/FabioCicerchia/lib/FabioCicerchia/Api/Utils.php';

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
        $this->assertEquals('en', \FabioCicerchia\Api\Utils::getCurrentLanguage($db_language, $string));

        $db_language = ['it' => 'it_IT', 'en' => 'en_GB'];
        $string      = 'da, it-it;q=0.8, en;q=0.7';
        $this->assertEquals('it', \FabioCicerchia\Api\Utils::getCurrentLanguage($db_language, $string));

        $db_language = ['da' => 'da_DK', 'en' => 'en_GB'];
        $string      = 'da, it-it;q=0.8, en;q=0.7';
        $this->assertEquals('da', \FabioCicerchia\Api\Utils::getCurrentLanguage($db_language, $string));
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
