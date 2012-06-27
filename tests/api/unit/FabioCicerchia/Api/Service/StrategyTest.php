<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   Test
 * @package    FabioCicerchia\Api\Service
 * @subpackage StrategyTest
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * The Skill Test Class.
 * @link       http://www.fabiocicerchia.it
 */

require_once __DIR__ . '/../../../../../../lib/vendor/FabioCicerchia/lib/FabioCicerchia/Api/StrategyInterface.php';
require_once __DIR__ . '/../../../../../../lib/vendor/FabioCicerchia/lib/FabioCicerchia/Api/Service/Strategy.php';

/**
 * The Strategy Test Class.
 *
 * @category   Test
 * @package    FabioCicerchia\Api\Service
 * @subpackage StrategyTest
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */
class StrategyTest extends PHPUnit_Framework_TestCase
{
    // {{{ testGetDataReturnCorrectValue
    /**
     * Test method "getData" return the correct value.
     *
     * @return void
     */
    public function testGetDataReturnCorrectValue()
    {
        $stub = $this->getMockBuilder('FabioCicerchia\Api\Service\Strategy')
                     ->disableOriginalConstructor()
                     ->getMock();

        $this->assertEquals(null, $stub->getData());
    }
    // }}}
}
