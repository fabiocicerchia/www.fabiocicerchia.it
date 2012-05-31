<?php

namespace FabioCicerchia\Api;

class TwigExtension extends \Twig_Extension
{
    public function getName() {
        return "FabioCicerchia";
    }

    public function getFilters() {
        return array(
            "custom_date" => new \Twig_Filter_Method($this, "custom_date"),
            "i18n"        => new \Twig_Filter_Method($this, "i18n")
        );
    }

    /**
     * Converts a date to the given format.
     * Workaround to avoid the problem of missing DateTime classes
     *
     * <pre>
     *   {{ post.published_at|custom_date("m/d/Y") }}
     * </pre>
     *
     * @param int|string $date     A date
     * @param string     $format   A format
     * @param string     $timezone A timezone
     *
     * @return string The formatter date
     */
    public function custom_date($date, $format = null, $timezone = null)
    {
        date_default_timezone_set('UTC');
        return date($format, strtotime($date));
    }

    /**
     * Print the localized value.
     *
     * <pre>
     *   {{ localized_value|i18n("en") }}
     * </pre>
     *
     * @param mixed  $value    A localized value
     * @param string $language A language
     *
     * @return string The formatter date
     */
    public function i18n($value, $language)
    {
        if (is_array($value) === true) {
            if (array_key_exists($language, $value) === true) {
                return $value[$language];
            }

            return $value['en'];
        }

        return $value;
    }
}
