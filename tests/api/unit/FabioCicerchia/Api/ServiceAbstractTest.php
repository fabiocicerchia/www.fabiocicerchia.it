<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   Test
 * @package    FabioCicerchia\Api
 * @subpackage ServiceAbstract
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */

$base_path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';
require_once $base_path . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'FabioCicerchia' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'FabioCicerchia' . DIRECTORY_SEPARATOR . 'Api' . DIRECTORY_SEPARATOR . 'ServiceAbstract.php';
require_once $base_path . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'FabioCicerchia' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'FabioCicerchia' . DIRECTORY_SEPARATOR . 'TestCase.php';

/**
 * The Abstract class for every Service.
 *
 * @category   Test
 * @package    FabioCicerchia\Api
 * @subpackage ServiceAbstract
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */
class ServiceAbstractTest extends FabioCicerchia\TestCase
{
    // {{{ testRunEmptyData
    /**
     * Test method "run" with empty data.
     *
     * @return void
     */
    public function testRunEmptyData()
    {
        $stub = $this->getMockBuilder('FabioCicerchia\Api\ServiceAbstract')
                     ->setMethods(['getRawData', 'elaborateData'])
                     ->disableOriginalConstructor()
                     ->getMock();

        $stub->expects($this->any())
             ->method('getRawData')
             ->will($this->returnValue([]));

        $stub->expects($this->any())
             ->method('elaborateData')
             ->will($this->returnArgument(0));

        $stub->run();

        $this->assertEquals([], $stub->getData());
    }
    // }}}

    // {{{ testGetDataReturnCorrectValue
    /**
     * Test method "getData" and check if return the correct value.
     *
     * @return void
     */
    public function testGetDataReturnCorrectValue()
    {
        $stub = $this->getMockForAbstractClass('FabioCicerchia\Api\ServiceAbstract', [], '', false);

        $this->assertEquals([], $stub->getData());
        $this->assertInternalType('array', $stub->getData());
    }
    // }}}

    // {{{ testGetCollectionReturnCorrectValue
    /**
     * Test method "getCollection" and check if return the correct value.
     *
     * @return void
     */
    public function testGetCollectionReturnCorrectValue()
    {
        $stub = $this->getMockForAbstractClass('FabioCicerchia\Api\ServiceAbstract', [], '', false);

        $this->assertEquals(null, $stub->getCollection());
    }
    // }}}
}
