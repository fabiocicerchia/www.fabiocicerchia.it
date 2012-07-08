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
 * @category   Code
 * @package    FabioCicerchia
 * @subpackage TestCase
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 */

namespace FabioCicerchia;

/**
 * The TestCase class for every Test.
 *
 * @category   Code
 * @package    FabioCicerchia
 * @subpackage TestCase
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
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

    // {{{ tearDown
    /**
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
    // }}}

    // {{{ output
    /**
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
            echo PHP_EOL;
            print_r($value);
            echo PHP_EOL;
        }
    }
    // }}}

    // {{{ isDebug
    /**
     * Check the PHPUnit's debug flag to enable the debug mode.
     *
     * @return boolean The value of the PHPUnit debug.
     */
    final public function isDebug()
    {
        return in_array('--debug', $_SERVER['argv']) === true;
    }
    // }}}

    // {{{ retrieveMethod
    /**
     * Change the visibility of a method to use it directly.
     *
     * @param string $object The object's instance.
     * @param string $name   The method to retrieve.
     *
     * @return \ReflectionMethod The method.
     */
    protected function retrieveMethod($object, $name)
    {
        $this->checkReflectionCompability();

        $class  = new \ReflectionClass(get_class($object));
        $method = $class->getMethod($name);

        $method->setAccessible(true);

        return $method;
    }
    // }}}

    // {{{ checkReflectionCompability
    /**
     * Check if the current PHP version support the method ReflectionMethod::setAccessible.
     *
     * @return void
     */
    private function checkReflectionCompability()
    {
        if (version_compare(PHP_VERSION, '5.3.2') < 0) {
            $message  = 'The current PHP version (%s) doesn\'t support the ';
            $message .= '"ReflectionMethod::setAccessible" method.';
            $this->markTestSkipped(sprintf($message, PHP_VERSION));
        }
    }
    // }}}

    // {{{ callMethod
    /**
     * Call a method, changing the visibility.
     *
     * @param string $method The method to call.
     * @param array  $params The parameters to pass.
     *
     * @return mixed The results from the method.
     */
    final protected function callMethod($method, array $params = array())
    {
        $method = $this->retrieveMethod($this->object, $method);

        return $method->invokeArgs($this->object, $params);
    }
    // }}}

    // {{{ retrieveProperty
    /**
     * Change the visibility of a property to use it directly.
     *
     * @param string $object The object instance.
     * @param string $name   The property to retrieve.
     *
     * @return \ReflectionProperty The property.
     */
    protected function retrieveProperty($object, $name)
    {
        $this->checkReflectionCompability();

        $class    = new \ReflectionClass(get_class($object));
        $property = $class->getProperty($name);

        $property->setAccessible(true);

        return $property;
    }
    // }}}

    // {{{ getProperty
    /**
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
    // }}}

    // {{{ setProperty
    /**
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

        $property->setValue($this->object, $value);
    }
    // }}}

    // {{{ pass
    /**
     * Just the opposite of PHPUnit_Framework_Assert::fail().
     *
     * @param string $message The message.
     *
     * @return void
     */
    final public function pass($message = 'Test passed')
    {
        self::assertThat(null, self::anything(), $message);
    }
    // }}}
}
