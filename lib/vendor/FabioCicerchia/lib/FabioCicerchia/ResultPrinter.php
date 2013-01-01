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
 * @package    FabioCicerchia
 * @subpackage ResultPrinter
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 - 2013 Fabio Cicerchia.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 * @since      File available since Release 0.1
 */

namespace FabioCicerchia;

/**
 * The ResultPrinter class for PHPUnit.
 *
 * @category   Code
 * @package    FabioCicerchia
 * @subpackage ResultPrinter
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 - 2013 Fabio Cicerchia. All Rights reserved.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 * @since      File available since Release 0.1
 */
class ResultPrinter extends \PHPUnit_TextUI_ResultPrinter
{
    // {{{ Methods - Protected =================================================
    // {{{ Method: printDefectTrace --------------------------------------------
    /**
     * Print Defect Trace.
     * Just copied by PHPUnit source code.
     *
     * ### General Information #################################################
     *
     * @param \PHPUnit_Framework_TestFailure $defect Instance of TestFailure.
     *
     * @return void
     */
    protected function printDefectTrace(\PHPUnit_Framework_TestFailure $defect)
    {
        parent::printDefectTrace($defect);

        $this->printDetails($defect->thrownException());
        $this->printStackTrace($defect->thrownException()->getTrace());
    }
    // }}} ---------------------------------------------------------------------
    // }}} =====================================================================

    // {{{ Methods - Private ===================================================
    // {{{ Method: printStackTrace ---------------------------------------------
    /**
     * Print the stack trace of an exception.
     *
     * ### General Information #################################################
     *
     * @param  array $trace The exception's trace.
     *
     * @return void
     */
    private function printStackTrace(array $trace)
    {
        $tab = ' ';

        if ($this->colors === true) {
            // Yellow Underlined.
            $this->write("\x1b[4;33m\x1b[2K");
        }
        $this->write('Stack Trace:' . PHP_EOL);
        if ($this->colors === true) {
            // Reset
            $this->write("\x1b[0m\x1b[2K");
        }

        foreach ($trace as $idx => $step) {
            if ($idx === 0) {
                continue;
            }

            if ($this->colors === true) {
                // White Bolded.
                $this->write("\x1b[1;37m");
            }
            $this->write($tab . 'Trace #' . $idx . ':' . PHP_EOL);
            if ($this->colors === true) {
                $this->write("\x1b[0m");
            }

            if (isset($step['file']) === true) {
                $this->write($tab . $tab . $step['file'] . ':' . $step['line'] . PHP_EOL);
            }
            if (isset($step['class']) === true) {
                $details = array();
                foreach ($step['args'] as $param) {
                    $details[] = $this->dump($param);
                }
                $details = '(' . implode(', ', $details) . ')';
                $this->write($tab . $tab . $step['class'] . $step['type'] . $step['function'] . $details . PHP_EOL);
            }
        }
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: dump --------------------------------------------------------
    /**
     * Return a string that represent the variable content.
     *
     * ### General Information #################################################
     *
     * @param  mixed $variable The variable to dump.
     *
     * @return string
     */
    private function dump($variable)
    {
        $type = '<' . strtoupper(gettype($variable)) . '> ';

        if (is_object($variable) === true) {
            return $type . get_class($variable);
        } elseif (is_array($variable) === true) {
            return $type . '[' . count($variable) . ']';
        } elseif (is_bool($variable) === true) {
            return $type . ($variable === true ? 'TRUE' : 'FALSE');
        } else {
            return $type . '"' . strval($variable) . '"';
        }
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: printDetails ------------------------------------------------
    /**
     * Print information about the Exception with additional information.
     *
     * ### General Information #################################################
     *
     * @param  Exception $exception The exception.
     *
     * @return void
     */
    private function printDetails(\Exception $exception)
    {
        $tab = ' ';
        $data = array(
            'Original Exception' => get_class($exception),
            'Exception Message'  => $exception->getMessage(),
            'Exception Code'     => $exception->getCode(),
            'File'               => $exception->getFile(),
            'Line'               => $exception->getLine(),
        );

        if ($this->colors) $this->write("\x1b[4;33m\x1b[2K");
        $this->write('More Details:' . PHP_EOL);
        if ($this->colors) $this->write("\x1b[0m\x1b[2K");

        foreach($data as $desc => $value) {
            if ($this->colors) $this->write("\x1b[1;37m");
            $this->write($tab . str_pad($desc . ':', 20, ' ', STR_PAD_RIGHT));
            if ($this->colors) $this->write("\x1b[0m");
            $this->write($value . PHP_EOL);
        }
    }
    // }}} ---------------------------------------------------------------------
    // }}} =====================================================================

    // {{{ Methods - Special ===================================================
    // {{{ Method: __construct -------------------------------------------------
    /**
     * Constructor.
     *
     * ### General Information #################################################
     *
     * @param mixed   $out
     * @param boolean $verbose
     * @param boolean $colors
     * @param boolean $debug
     *
     * @return void
     */
    public function __construct($out = null, $verbose = false, $colors = false, $debug = false)
    {
        parent::__construct($out, $verbose, true, $debug);
    }
    // }}} ---------------------------------------------------------------------
    // }}} =====================================================================
}
