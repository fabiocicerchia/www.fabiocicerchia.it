<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   Code
 * @package    FabioCicerchia
 * @subpackage TestCase
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */

namespace FabioCicerchia;

// pear channel-discover pear.bovigo.org
// pear install bovigo/vfsStream-beta
require_once 'vfsStream/vfsStream.php';
require_once 'PHP/Timer.php';

/**
 * The TestCase class for every Test.
 *
 * @category   Code
 * @package    FabioCicerchia
 * @subpackage TestCase
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * The object's instance.
     *
     * @var object
     */
    protected $object = null;

    /**
     * The max value for the running time.
     * @var integer
     */
    protected $maxRunningTime = 0;

    /**
     * The Virtual Root.
     *
     * @var vfsStreamDirectory
     */
    private $_vfs_root;

    /**
     * The Virtual Root path.
     *
     * @var string
     */
    private $vfs_root_path;

    /**
     * Constructs a test case with the given name.
     *
     * @param  string $name
     * @param  array  $data
     * @param  string $dataName
     *
     * @return void
     */
    public function __construct($name = NULL, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * setUp
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $className = get_class($this);

        $this->_root         = \vfsStream::setup($className);
        $this->vfs_root_path = \vfsStream::url($className) . DIRECTORY_SEPARATOR;
    }

    /**
     * tearDown
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->output(PHP_EOL . str_repeat('#', 80) . PHP_EOL);
    }

    /**
     * output
     * Prints human-readable information about a variable, only if the debug is
     * enabled.
     *
     * @param mixed $value The value to print.
     *
     * @return void
     */
    public function output($value)
    {
        if ($this->isDebug() === true) {
            print PHP_EOL;
            print_r($value);
            print PHP_EOL;
        }
    }

    /**
     * isDebug
     * Check the PHPUnit's debug flag to enable the debug mode.
     *
     * @return boolean The value of the PHPUnit debug.
     */
    final public function isDebug()
    {
        return in_array('--debug', $_SERVER['argv']) === true;
    }

    /**
     * retrieveMethod
     * Change the visibility of a method to use it directly.
     *
     * @param string $object The object's instance.
     * @param string $name   The method to retrieve.
     *
     * @return \ReflectionMethod The method.
     */
    protected function retrieveMethod($object, $name)
    {
        $this->_checkReflectionCompability();

        $class  = new \ReflectionClass(get_class($object));
        $method = $class->getMethod($name);

        $method->setAccessible(true);

        return $method;
    }

    /**
     * _checkReflectionCompability
     * Check if the current PHP version support the method ReflectionMethod::setAccessible.
     *
     * @return void
     */
    private function _checkReflectionCompability()
    {
        $phpVer = PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION . '.' . PHP_RELEASE_VERSION;
        if (version_compare($phpVer, '5.3.2') < 0) {
            $message = 'The current PHP version (%s) doesn\'t support the "ReflectionMethod::setAccessible" method.';
            $this->markTestSkipped(sprintf($message, $phpVer));
        }
    }

    /**
     * callMethod
     * Call a method, changing the visibility.
     *
     * @param string $method The method to call.
     * @param array  $params The parameters to pass.
     *
     * @return mixed The results from the method.
     */
    final protected function _callMethod($method, array $params = array())
    {
        $method = $this->retrieveMethod($this->object, $method);

        return $method->invokeArgs($this->object, $params);
    }

    /**
     * retrieveProperty
     * Change the visibility of a property to use it directly.
     *
     * @param string $object The object instance.
     * @param string $name   The property to retrieve.
     *
     * @return \ReflectionProperty The property.
     */
    protected function retrieveProperty($object, $name)
    {
        $this->_checkReflectionCompability();

        $class    = new \ReflectionClass(get_class($object));
        $property = $class->getProperty($name);

        $property->setAccessible(true);

        return $property;
    }

    /**
     * getProperty
     * Get the value of a property, changing the visibility.
     *
     * @param string $name The property to get.
     *
     * @return mixed The value of the property.
     */
    final protected function getProperty($name)
    {
        $property = $this->retrieveProperty($this->object, $name);

        return $property->getValue($this->object);
    }

    /**
     * setProperty
     * Set the value of a property, changing the visibility.
     *
     * @param string $name  The property to change.
     * @param mixed  $value The value.
     *
     * @return void
     */
    final protected function setProperty($name, $value)
    {
        $property = $this->retrieveProperty($this->object, $name);

        return $property->setValue($this->object, $value);
    }

    /**
     * pass
     * Just the opposite of PHPUnit_Framework_Assert::fail()
     *
     * @param $message The message.
     *
     * @return void
     */
    final public function pass($message = 'Test passed')
    {
        self::assertThat(null, self::anything(), $message);
    }

    /**
     * Override to run the test and assert its state.
     *
     * @return mixed
     * @throws RuntimeException
     */
    final protected function runTest()
    {
        \PHP_Timer::start();
        parent::runTest();
        $time = \PHP_Timer::stop();

        if ($this->maxRunningTime != 0 &&
            $time > $this->maxRunningTime) {
            $this->fail(
              sprintf(
                'expected running time: <= %s but was: %s',

                $this->maxRunningTime,
                $time
              )
            );
        }
    }

    /**
     * setMaxRunningTime
     *
     * @param integer $maxRunningTime
     *
     * @throws InvalidArgumentException
     * @since Method available since Release 2.3.0
     * @deprecated 3.3 No available used.
     */
    final public function setMaxRunningTime($maxRunningTime)
    {
        if (is_integer($maxRunningTime) &&
            $maxRunningTime >= 0) {
            $this->maxRunningTime = $maxRunningTime;
        } else {
            throw new \InvalidArgumentException;
        }
    }

    /**
     * getMaxRunningTime
     *
     * @return integer
     * @since Method available since Release 2.3.0
     * @deprecated 3.3 No longer available.
     */
    final public function getMaxRunningTime()
    {
        return $this->maxRunningTime;
    }
}
