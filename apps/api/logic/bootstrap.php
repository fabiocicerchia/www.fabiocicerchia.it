<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category  Api
 * @package   Api
 * @author    Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright 2012 Fabio Cicerchia. All Rights reserved.
 * @license   TBD <http://www.fabiocicerchia.it>
 * @link      http://www.fabiocicerchia.it
 * @version   XXX
 */

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;

// -----------------------------------------------------------------------------
// DEBUG FLAG ------------------------------------------------------------------
// -----------------------------------------------------------------------------
$app['debug'] = $_SERVER['HTTP_HOST'] === 'www.fabiocicerchia.it' ? false : true;

// -----------------------------------------------------------------------------
// REGISTERING NAMESPACES ------------------------------------------------------
// -----------------------------------------------------------------------------
$silexExtDirectory = __DIR__ . '/../../../lib/vendor/Silex-Extensions/src';
$app['autoloader']->registerNamespace('SilexExtension', $silexExtDirectory);

$customDirectory = __DIR__ . '/../../../lib/vendor/FabioCicerchia/lib';
$app['autoloader']->registerNamespace('FabioCicerchia', $customDirectory);

// -----------------------------------------------------------------------------
// TWIG PROVIDER ---------------------------------------------------------------
// -----------------------------------------------------------------------------
$options = [
    'twig.path'       => __DIR__ . '/../view',
    'twig.class_path' => __DIR__ . '/../../../lib/vendor/Twig/lib',
];
$twigServiceProvider = new TwigServiceProvider();
$app->register($twigServiceProvider, $options);

// TODO: MOVE THIS
/**
 * Converts a date to the given format.
 * Workaround to avoid the problem of missing DateTime classes
 *
 * <pre>
 *   {{ post.published_at|custom_date("m/d/Y") }}
 * </pre>
 *
 * @param DateTime|DateInterval|string $date     A date
 * @param string                       $format   A format
 * @param DateTimeZone|string          $timezone A timezone
 *
 * @return string The formatter date
 */
function twig_custom_date_filter($date, $format = null, $timezone = null)
{
    date_default_timezone_set('UTC');
    return date($format, strtotime($date));
}

// TODO: MOVE THIS
/**
 * Print the localized value.
 *
 * <pre>
 *   {{ localized_value|i18n("en") }}
 * </pre>
 *
 * @param mixed                        $value    A localized value
 * @param string                       $language A language
 *
 * @return string The formatter date
 */
function twig_i18n_filter($value, $language)
{
    if (is_array($value) === true) {
        if (array_key_exists($language, $value) === true) {
            return $value[$language];
        }

        return $value['en'];
    }

    return $value;
}

$md5_filter = new Twig_Filter_Function('md5');
$app['twig']->addFilter('md5', $md5_filter);
$custom_date_filter = new Twig_Filter_Function('twig_custom_date_filter');
$app['twig']->addFilter('custom_date', $custom_date_filter);
$i18n_filter = new Twig_Filter_Function('twig_i18n_filter');
$app['twig']->addFilter('i18n', $i18n_filter);

// -----------------------------------------------------------------------------
// URL GENERATOR PROVIDER ------------------------------------------------------
// -----------------------------------------------------------------------------
$urlGeneratorServiceProvider = new UrlGeneratorServiceProvider();
$app->register($urlGeneratorServiceProvider);

// -----------------------------------------------------------------------------
// HTTP CACHE PROVIDER ---------------------------------------------------------
// -----------------------------------------------------------------------------
$options = [
    'http_cache.cache_dir' => __DIR__ . '/../../../cache/api/',
];
$httpCacheServiceProvider = new HttpCacheServiceProvider();
$app->register($httpCacheServiceProvider, $options);

// -----------------------------------------------------------------------------
// MONGODB PROVIDER ------------------------------------------------------------
// -----------------------------------------------------------------------------
$options = [
    'mongodb.class_path' => __DIR__ . '/../../../lib/vendor/mongodb/lib',
    'mongodb.connection' => [
        'server'       => 'mongodb://localhost',
        'options'      => [],
        'eventmanager' => function($eventmanager) {
        }
    ]
];
$mongoDbExtension = new SilexExtension\MongoDbExtension();
$app->register($mongoDbExtension, $options);
