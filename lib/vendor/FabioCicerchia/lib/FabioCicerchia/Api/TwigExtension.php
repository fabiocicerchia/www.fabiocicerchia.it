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
 * @package    FabioCicerchia\Api
 * @subpackage TwigExtension
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 * @since      File available since Release 0.1
 */

namespace FabioCicerchia\Api;

/**
 * Some extensions to Twig.
 *
 * @category   Code
 * @package    FabioCicerchia\Api
 * @subpackage TwigExtension
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 * @since      File available since Release 0.1
 */
class TwigExtension extends \Twig_Extension
{
    // {{{ Methods - Public ====================================================
    // {{{ Method: customDate --------------------------------------------------
    /**
     * Converts a date to the given format.
     * Workaround to avoid the problem of missing DateTime classes.
     *
     * <pre>
     *   {{ post.published_at|custom_date("d/m/Y") }}
     * </pre>
     *
     * @param integer|string $date   A date.
     * @param string         $format A format.
     *
     * @return string The formatter date.
     */
    public function customDate($date, $format = null)
    {
        date_default_timezone_set('UTC');

        $timestamp = strtotime($date);

        if ($date instanceOf \MongoDate) {
            $timestamp = $date->sec;
        }

        return date($format, $timestamp);
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: pregReplace -------------------------------------------------
    /**
     * Just the preg_replace.
     *
     * <pre>
     *   {{ post.title|preg_replace("/Hello/", "World") }}
     * </pre>
     *
     * @param mixed   $subject     The string or an array with strings to search
     *                             and replace.
     * @param mixed   $pattern     The pattern to search for. It can be either
     *                             a string or an array with strings.
     * @param mixed   $replacement The string or array with strings to replace.
     * @param integer $limit       The maximum possible replacements for each
     *                             pattern in each subject string.
     *
     * @return mixed The result of the preg_replace.
     */
    public function pregReplace($subject, $pattern, $replacement, $limit = -1)
    {
        return preg_replace($pattern, $replacement, $subject, $limit);
    }
    // }}} ---------------------------------------------------------------------
    // }}} =====================================================================

    // {{{ Methods - Getter ====================================================
    // {{{ Method: getFilters --------------------------------------------------
    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of tests.
     */
    public function getFilters()
    {
        return [
            'custom_date'  => new \Twig_Filter_Method($this, 'customDate'),
            'preg_replace' => new \Twig_Filter_Method($this, 'pregReplace'),
        ];
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: getName -----------------------------------------------------
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name.
     */
    public function getName()
    {
        return 'FabioCicerchia';
    }
    // }}} ---------------------------------------------------------------------
    // }}} =====================================================================
}
