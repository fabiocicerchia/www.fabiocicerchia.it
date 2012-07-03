<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   Code
 * @package    FabioCicerchia\Api
 * @subpackage TwigExtension
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
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
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */
class TwigExtension extends \Twig_Extension
{
    // {{{ getName
    /**
     * Returns the name of the extension.
     *
     * @return stringThe extension name.
     */
    public function getName()
    {
        return 'FabioCicerchia';
    }
    // }}}

    // {{{ getFilters
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
    // }}}

    // {{{ customDate
    /**
     * Converts a date to the given format.
     * Workaround to avoid the problem of missing DateTime classes.
     *
     * <pre>
     *   {{ post.published_at|custom_date("m/d/Y") }}
     * </pre>
     *
     * @param int|string $date   A date.
     * @param string     $format A format.
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
    // }}}

    // {{{ pregReplace
    /**
     * Just the preg_replace.
     *
     * <pre>
     *   {{ post.title|preg_replace("/Hello/", "World") }}
     * </pre>
     *
     * @param mixed   $subject     The string or an array with strings to search and replace.
     * @param mixed   $pattern     The pattern to search for. It can be either a string or an array with strings.
     * @param mixed   $replacement The string or an array with strings to replace.
     * @param integer $limit       The maximum possible replacements for each pattern in each subject string.
     *
     * @return mixed The result of the preg_replace.
     */
    public function pregReplace($subject, $pattern, $replacement, $limit = -1)
    {
        return preg_replace($pattern, $replacement, $subject, $limit);
    }
    // }}}
}
