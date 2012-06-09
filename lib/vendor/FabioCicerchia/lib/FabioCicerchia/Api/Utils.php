<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category   API
 * @package    FabioCicerchia\Api
 * @subpackage Utils
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */

namespace FabioCicerchia\Api;

/**
 * The Utils class.
 *
 * @category   API
 * @package    FabioCicerchia\Api
 * @subpackage Utils
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 */
class Utils
{
    // {{{ getCurrentLanguage
    /**
     * Return the current language based on the available languages and on
     * the HTTP Accept-Language header.
     *
     * @param array  $available_languages The available languages.
     * @param string $accepted_language   The string of HTTP Accept-Language.
     *
     * @api
     * @return string
     * @see    FabioCicerchia\Api\Utils::httpPriorityOrder()
     * @see    FabioCicerchia\Api\Utils::retrieveCurrentLanguage()
     */
    public static function getCurrentLanguage(array $available_languages, $accept_language)
    {
        if (is_string($accept_language) === false) {
            throw new \InvalidArgumentException('The parameter $accept_language must be a string.');
        }

        $accept_language    = preg_replace('/([a-z]{2})-([a-z]{2})/', '\1', $accept_language);
        $accepted_languages = self::httpPriorityOrder($accept_language);
        $current_lang       = self::retrieveCurrentLanguage(array_keys($available_languages), $accepted_languages);

        return $current_lang;
    }
    // }}}

    // {{{ retrieveCurrentLanguage
    /**
     * Return the current language based on the available languages and on
     * the HTTP Accept-Language header.
     *
     * @param array  $available The available languages.
     * @param string $accepted  The string of HTTP Accept-Language.
     *
     * @internal
     * @return string
     */
    protected static function retrieveCurrentLanguage(array $available, array $accepted) {
        foreach($accepted as $language) {
            if (array_search($language, $available) !== false) {
                return $language;
            }
        }

        return $available[0];
    }
    // }}}

    // {{{ httpPriorityOrder
    /**
     * Return an array based on the priority of the HTTP header [RFC2616].
     *
     * @param string $string The string of HTTP Header.
     *
     * @internal
     * @return array
     * @see    FabioCicerchia\Api\Utils::httpCustomSorting()
     */
    protected static function httpPriorityOrder($string)
    {
        if (is_string($string) === false) {
            throw new \InvalidArgumentException('The parameter $string must be a string.');
        }

        $string = preg_replace('/ +/', '', $string);
        $string = preg_replace('/([^,]+),/', '\1;q=1.0,', $string . ',');
        $string = preg_replace('/(;q=[0-9\.]+);q=[0-9\.]+/', '\1', substr($string, 0, -1));
        $tokens = explode(',', $string);

        $values = [];
        foreach($tokens as $idx => $token) {
            list($mimetype, $priority) = preg_split('/;q=/', $token);
            array_push($values, $priority . ' ' . $idx . ' ' . $mimetype);
        }

        usort($values, ['\\FabioCicerchia\\Api\\Utils', 'httpCustomSorting']);

        foreach($values as $idx => $value) {
            $values[$idx] = preg_replace('/.+ ([^ ]+)(?:;level=.+)?$/U', '\1', $value);
        }

        return array_unique($values);
    }
    // }}}

    // {{{ httpCustomSorting
    /**
     * Sort the array based on the priority of the HTTP header [RFC2616].
     *
     * @param string $a The first element.
     * @param string $b The second element.
     *
     * @internal
     * @return integer
     */
    protected static function httpCustomSorting($a, $b)
    {
        if (is_string($a) === false) {
            throw new \InvalidArgumentException('The parameter $a must be a string.');
        }

        if (is_string($b) === false) {
            throw new \InvalidArgumentException('The parameter $b must be a string.');
        }

        list($a_priority, $a_order, $a_value) = explode(' ', $a);
        list($b_priority, $b_order, $b_value) = explode(' ', $b);

        // first check on priority value
        if ($a_priority !== $b_priority) {
            return strcmp($b_priority, $a_priority);
        }

        // second check on level existence
        $a_match = strpos($a_value, 'level=') !== false;
        $b_match = strpos($b_value, 'level=') !== false;
        if ($a_match || $b_match) {
            return strcmp($b_match, $a_match);
        }

        // third check on level value
        $a_level = (float)preg_replace('/.*level=(\d+)$/', '\1', $a_value);
        $b_level = (float)preg_replace('/.*level=(\d+)$/', '\1', $b_value);
        if ($a_level !== $b_level) {
            return strcmp($a_level, $b_level);
        }

        // fourth check on star values
        if (strpos($a_value, '*') !== false || strpos($b_value, '*') !== false) {
            return strcmp($b_value, $a_value);
        }

        // last check on the order value
        return strcmp($a_order, $b_order);
    }
    // }}}

    // {{{ convertForI18n
    /**
     * Return a clean array with all the data converted for the specified language.
     *
     * @param array  $data     The data.
     * @param string $language The language.
     *
     * @api
     * @return array
     */
    public static function convertForI18n(array $data, $language) {
        if (is_string($language) === false) {
            throw new \InvalidArgumentException('The parameter $language must be a string.');
        }

        if (isset($data[$language])) {
            return $data[$language];
        }

        foreach($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = self::convertForI18n($value, $language);
            }
        }

        return $data;
    }
    // }}}
}
