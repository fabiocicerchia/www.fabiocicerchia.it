<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   Test
 * @package    FabioCicerchia\Api\Service
 * @subpackage EntryPointTest
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */

require_once __DIR__ . '/../../../../../../lib/vendor/FabioCicerchia/lib/FabioCicerchia/Api/Service/EntryPoint.php';

/**
 * The EntryPoint Test Class.
 *
 * @category   Test
 * @package    FabioCicerchia\Api\Service
 * @subpackage EntryPointTest
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */
class EntryPointTest extends PHPUnit_Framework_TestCase
{
    // {{{ testGetService
    /**
     * Test method "getService".
     *
     * @return void
     */
    public function testGetService()
    {
        $class = new FabioCicerchia\Api\Service\EntryPoint();

        $this->assertInternalType('array', $class->getServices());
    }
    // }}}
}
