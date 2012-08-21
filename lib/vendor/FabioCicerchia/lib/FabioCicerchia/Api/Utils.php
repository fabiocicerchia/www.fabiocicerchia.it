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
 * @subpackage Utils
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 * @since      File available since Release 0.1
 */

// TODO: Run PHP-CS-Fixer.

namespace FabioCicerchia\Api;

/**
 * The Utils class.
 *
 * @category   Code
 * @package    FabioCicerchia\Api
 * @subpackage Utils
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 * @since      File available since Release 0.1
 */
class Utils
{
    // {{{ Methods - Public ====================================================
    // {{{ Method: convertForI18n ----------------------------------------------
    /**
     * Return a clean array with all the data converted for the specified
     * language.
     *
     * @param array  $data     The data.
     * @param string $language The language.
     *
     * @throws \InvalidArgumentException The parameter $language must be a
     *                                   string.
     * @since  Version 0.1
     *
     * @return array
     */
    public static function convertForI18n(array $data, $language)
    {
        if (is_string($language) === false) {
            $message = 'The parameter $language must be a string.';
            throw new \InvalidArgumentException($message);
        }

        if (isset($data[$language]) === true) {
            return $data[$language];
        }

        foreach ($data as $key => $value) {
            if (is_array($value) === true) {
                $data[$key] = self::convertForI18n($value, $language);
            }
        }

        return $data;
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: getCurrentLanguage ------------------------------------------
    /**
     * Return the current language based on the available languages and on
     * the HTTP Accept-Language header.
     *
     * @param array  $available_languages The available languages.
     * @param string $accept_language     The string of HTTP Accept-Language.
     *
     * @see    FabioCicerchia\Api\Utils::httpPriorityOrder()
     * @see    FabioCicerchia\Api\Utils::retrieveCurrentLanguage()
     * @throws \InvalidArgumentException The parameter $accept_language must be
     *                                   a string.
     * @since  Version 0.1
     *
     * @return string
     */
    public static function getCurrentLanguage(
        array $available_languages,
        $accept_language
    ) {
        if (is_string($accept_language) === false) {
            $message = 'The parameter $accept_language must be a string.';
            throw new \InvalidArgumentException($message);
        }

        $regex       = '/([a-z]{2})-([a-z]{2})/';
        $accept_lang = preg_replace($regex, '\1', $accept_language);
        $languages   = self::httpPriorityOrder($accept_lang);

        $list_keys    = array_keys($available_languages);
        $current_lang = self::retrieveCurrentLanguage($list_keys, $languages);

        return $current_lang;
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: getLanguage -------------------------------------------------
    /**
     * Retrieve the language based on the HTTP header "Accept-Language" and the
     * value in the DB.
     *
     * @param \Silex\Application         $app      The Silex Application instance.
     * @param \Doctrine\MongoDB\Database $database The MongoDB Database instance.
     *
     * @see    FabioCicerchia\Api\Utils::getCurrentLanguage()
     * @since  Version 0.1
     *
     * @return string
     */
    public static function getLanguage(
        \Silex\Application $app,
        \Doctrine\MongoDB\Database $database
    ) {
        $current_lang        = 'en';
        $available_languages = [$current_lang => $current_lang];
        $accept_language     = $app['request']->headers->get('accept-language');
        if (empty($accept_language) === false) {
            $db_languages = $database->selectCollection('language')
                                     ->find([], ['code' => true])->toArray();

            foreach ($db_languages as $language_code) {
                $short_lang = preg_replace('/_.+/', '', $language_code['code']);
                $available_languages[$short_lang] = $language_code['code'];
            }

            $current_lang = self::getCurrentLanguage(
                $available_languages,
                $accept_language
            );
        }

        return [$current_lang, $available_languages[$current_lang]];
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: getLastModified ---------------------------------------------
    /**
     * Retrieve the timestamp of the last modified date.
     *
     * @param array $data The data.
     *
     * @since Version 0.1
     *
     * @return integer
     */
    public static function getLastModified(array $data)
    {
        $firstRecord  = $data['entities'][array_keys($data['entities'])[0]];
        if (isset($firstRecord['date']) === true) {
            if (isset($firstRecord['date']['end']) === true) {
                $time = $firstRecord['date']['end']->sec;
            } elseif (isset($firstRecord['date']['start']) === true) {
                $time = $firstRecord['date']['start']->sec;
            }
        }

        $mongodb_file = ROOT_PATH . 'db/mongo-curriculum.js';
        $lastModified = isset($time) === true
                        ? $time
                        : filemtime($mongodb_file);
        $lastModified = gmdate('D, d M Y H:i:s', $lastModified) . ' GMT';

        return $lastModified;
    }
    // }}} ---------------------------------------------------------------------
    // }}} =====================================================================

    // {{{ Methods - Protected =================================================
    // {{{ Method: httpCustomSorting -------------------------------------------
    /**
     * Sort the array based on the priority of the HTTP header [RFC2616].
     *
     * @param string $a The first element.
     * @param string $b The second element.
     *
     * @throws \InvalidArgumentException The parameters $a or $b must be a
     *                                   string.
     * @since  Version 0.1
     *
     * @return integer
     */
    protected static function httpCustomSorting($a, $b)
    {
        if (is_string($a) === false) {
            $message = 'The parameter $a must be a string.';
            throw new \InvalidArgumentException($message);
        }

        if (is_string($b) === false) {
            $message = 'The parameter $b must be a string.';
            throw new \InvalidArgumentException($message);
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
        if ($a_match === true || $b_match === true) {
            return strcmp($b_match, $a_match);
        }

        // third check on level value
        $a_level = (float)preg_replace('/.*level=(\d+)$/', '\1', $a_value);
        $b_level = (float)preg_replace('/.*level=(\d+)$/', '\1', $b_value);
        if ($a_level !== $b_level) {
            return strcmp($a_level, $b_level);
        }

        // fourth check on star values
        if (strpos($a_value, '*') !== false
            || strpos($b_value, '*') !== false
        ) {
            return strcmp($b_value, $a_value);
        }

        // last check on the order value
        return strcmp($a_order, $b_order);
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: httpPriorityOrder -------------------------------------------
    /**
     * Return an array based on the priority of the HTTP header [RFC2616].
     *
     * @param string $string The string of HTTP Header.
     *
     * @throws \InvalidArgumentException The parameter $string must be a string.
     * @since  Version 0.1
     *
     * @return array
     */
    protected static function httpPriorityOrder($string)
    {
        if (is_string($string) === false) {
            $message = 'The parameter $string must be a string.';
            throw new \InvalidArgumentException($message);
        }

        $string = preg_replace('/ +/', '', $string);
        $string = preg_replace('/([^,]+),/', '\1;q=1.0,', $string . ',');
        $string = substr($string, 0, -1); // Remove the trailing comma.
        $string = preg_replace('/(;q=[\d\.]+);q=[\d\.]+/', '\1', $string);
        $tokens = explode(',', $string);

        $values = [];
        foreach ($tokens as $idx => $token) {
            list($mimetype, $priority) = preg_split('/;q=/', $token);
            array_push($values, $priority . ' ' . $idx . ' ' . $mimetype);
        }

        usort($values, ['\\FabioCicerchia\\Api\\Utils', 'httpCustomSorting']);

        foreach ($values as $idx => $value) {
            $regex        = '/.+ ([^ ]+)(?:;level=.+)?$/U';
            $values[$idx] = preg_replace($regex, '\1', $value);
        }

        return array_merge(array_unique($values));
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: retrieveCurrentLanguage -------------------------------------
    /**
     * Return the current language based on the available languages and on
     * the HTTP Accept-Language header.
     *
     * @param array $available The available languages.
     * @param array $accepted  The string of HTTP Accept-Language.
     *
     * @since Version 0.1
     *
     * @return string
     */
    protected static function retrieveCurrentLanguage(
        array $available,
        array $accepted
    ) {
        foreach ($accepted as $language) {
            if (array_search($language, $available) !== false) {
                return $language;
            }
        }

        return $available[0];
    }
    // }}} ---------------------------------------------------------------------
    // }}} =====================================================================
}