#!/usr/bin/perl -w

#
# FABIO CICERCHIA - STYLING EXERCISES JUST FOR FUN
# Copyright (C) 2012. All Rights reserved.
#

use strict;

/**
 *
 * @author
 * @copyright
 * @license
 * @method
 * @package
 */
class MyResume
{
    // {{{ properties - configurable
    /**
     * @property string
     */
    protected $actionDefault = 'show';

    /**
     * @property integer
     */
    protected $cacheTimeout = 86400; // 24 * 60 * 60

    /**
     * @property boolean
     */
    protected $filterOutput = true;

    /**
     * @property array
     */
    protected $formatAllowed = array();

    /**
     * @property array
     */
    protected $abbreviation = array();

    /**
     * @property string
     */
    protected $formatDefault = 'html5';

    /**
     * @property array
     */
    protected $i18nAllowed = array('it', 'en');

    /**
     * @property string
     */
    protected $i18nDefault = 'en';

    /**
     * @property string
     */
    protected $xmlFile = 'data/xml/resume.%s.xml';

    /**
     * @property string
     */
    protected $xslFile = 'aggregate.%s_%s.xsl';
    // }}}

    // {{{ properties - unconfigurable
    /**
     * @property string
     */
    protected $actionCurrent = null;

    /**
     * @property string
     */
    protected $baseUrl = null;

    /**
     * @property string
     */
    protected $contentType = null;

    /**
     * @property string
     */
    protected $formatCurrent = null;

    /**
     * @property string
     */
    protected $i18nCurrent = null;

    /**
     * @property array
     */
    protected $formatsCompressed = array(
            'atom',
            'rss091',
            'rss092',
            'rss1',
            'rss2',
            'vcard'
            );

    /**
     * @property array
     */
    protected $request = array(
            'action' => null,
            'bot'    => null,
            'expand' => null,
            'f'      => null,
            'format' => null,
            'lang'   => null
            );

    /**
     * @property boolean
     */
    protected $versionCompressed = null;

    /**
     * @property boolean
     */
    protected $versionMobile = null;
    // }}}

    // {{{ __construct
    /**
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->setRequest($_GET);

        $this->actionCurrent = $this->request['action'] ?: $this->actionDefault;
        $this->formatCurrent = $this->request['format'] ?: $this->formatDefault;
        $this->versionMobile = $this->mobile_device_detect(true, false, true,
                                                           true, true, true,
                                                           true);

        if ($this->formatCurrent == $this->formatDefault)
        {
            if ($this->versionMobile)
            {
                $this->formatCurrent = 'print';
            }
            elseif (isset($_SERVER['HTTP_USER_AGENT']) &&
                    (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8') !== false ||
                    strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7') !== false))
            {
                $this->formatCurrent = 'xhtml';
            }
        }

        if (in_array($this->formatCurrent, array('xhtml', 'print')))
        {
            $this->request['bot'] = 1;
        }

        $this->versionCompressed = !empty($this->request['bot']) ||
                                   $this->versionMobile;
        if (in_array($this->formatCurrent, $this->formatsCompressed))
        {
            $this->versionCompressed = true;
        }

        $this->formatAllowed = parse_ini_file(__DIR__ . '/data/formats.ini');
        $this->abbreviation  = parse_ini_file(__DIR__ . '/data/abbr.ini');

        $this->i18nCurrent     = $this->i18nDefault;
        if (in_array($this->request['lang'], $this->i18nAllowed))
        {
            $this->i18nCurrent = $this->request['lang'];
        }

        $this->contentType     = $this->formatAllowed['xml'];
        if ($this->versionCompressed &&
            isset($this->formatAllowed[$this->formatCurrent]))
        {
            $this->contentType = $this->formatAllowed[$this->formatCurrent];
            if ($this->formatCurrent == 'print' && $this->versionMobile)
            {
                $this->contentType = 'application/xhtml+xml';
            }
        }

        $this->xmlFile = sprintf($this->xmlFile, $this->i18nCurrent);
        $this->xslFile = sprintf($this->xslFile, $this->formatCurrent,
                                 $this->i18nCurrent);

        $tmp = str_replace($_SERVER['DOCUMENT_ROOT'], '',
                           dirname($_SERVER['SCRIPT_FILENAME']));
        $this->baseUrl = str_replace('//', '/', '/' . $tmp . '/');
        if ($this->baseUrl == $_SERVER['DOCUMENT_ROOT'])
        {
            $this->baseUrl = '/';
        }
    }
    // }}}

    // {{{ show
    /**
     * @access public
     * @return void
     */
    public function show()
    {
        echo $this->executeAction($this->actionCurrent);
    }
    // }}}

    // {{{ executeAction
    /**
     * @access protected
     * @param  string $action
     * @return string
     */
    protected function executeAction($action = null)
    {
        if (is_null($action))
        {
            $action = $this->actionDefault;
        }

        $methodToCall = 'action' . ucfirst($action);
        if (!method_exists($this, $methodToCall))
        {
            $methodToCall = 'action404';
        }

        return $this->$methodToCall();
    }
    // }}}

    // {{{ actionShow
    /**
     * @access protected
     * @return string
     */
    protected function actionShow() {
        $filemtime = filemtime(__DIR__ . '/' . $this->xmlFile);

        $is_xml = in_array($this->formatCurrent, $this->formatsCompressed);

        // http://stackoverflow.com/questions/2086712/http-if-none-match-and-if-modified-since-and-304-clarification-in-php
        if ($is_xml && array_key_exists('HTTP_IF_MODIFIED_SINCE', $_SERVER)) {
            $if_modified_since = strtotime(preg_replace('/;.*$/', '', $_SERVER['HTTP_IF_MODIFIED_SINCE']));
            if ($if_modified_since >= $filemtime) {
                header('HTTP/1.0 304 Not Modified');
                exit;
            }
        }

        $format = 'r';
        if ($this->formatCurrent == 'atom')
        {
            $format = 'Y-m-d\TH:i:s\Z';
        }

        $filters = array(
                '%%XSL_FILE%%'      => $this->xslFile,
                '%%BASE%%'          => $this->baseUrl,
                '%%LAST_MODIFIED%%' => date($format, $filemtime)
                );
        $content = file_get_contents(__DIR__ . '/' . $this->xmlFile);
        $content = str_replace(array_keys($filters), $filters, $content);

        if ($this->versionCompressed)
        {
            $file = __DIR__ . '/data/xsl/' . $this->xslFile;
            if (!file_exists($file)) {
                header('Location: /');
                exit;
            }
            $content = $this->transform($content, file_get_contents($file));
        }
        if ($this->filterOutput) {
            $content = str_replace("\n", ' ', $content);
            $content = preg_replace('#([ \t]+|<!--.+?-->)#', ' ', $content);
        }

        if ($this->versionCompressed && $this->filterOutput)
        {
            $body = preg_replace('#.*(<body[ >].+</body>).*#', '\1', $content);
            //$body = preg_replace('#([, >])(' . implode('|', array_keys($this->abbreviation)) . ')([<" ])#eU', '("\\1<abbr title=\"" . $this->abbreviation[\'\\2\'] . "\">\\2</abbr>\\3")', $body);

            if ($this->versionMobile) {
                $content = preg_replace('#<time class="dtend".*>#U', ' - ',
                                        $content);
                $regex = '</?(?:time|abbr).*>|<(.+)></\1>' .
                         '| item(?:type|prop|scope)=".+"| lang=".+"';
                $content = preg_replace('#(?:' . $regex . ')#U', '', $content);
            }
            $content = preg_replace('#\*(.+)\*#U', '<strong>\1</strong>',
                                    $content);
            $content = preg_replace('#>(\d{4}-\d{2}-\d{2}|\d{2}-\d{2}-\d{4})<#e',
                                    '">" . date($format, strtotime("\1")) . "<"', $content);

            if ($this->i18nCurrent == 'en')
            {
                $content = str_replace('Sun, 09 Feb 1986 00:00:00 +0100', '1986-02-09', $content);
            }
            else
            {
                $content = str_replace('Sun, 09 Feb 1986 00:00:00 +0100', '09-02-1986', $content);
            }
        }

        if (!$is_xml) {
            header('Content-Type: ' . $this->contentType . '; charset=utf-8');
            header('Cache-Control: max-age=' . $this->cacheTimeout .
                   ', must-revalidate');
            header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + $this->cacheTimeout));
        } else {
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s \G\M\T', filemtime(__DIR__ . '/' . $this->xmlFile)));
        }

        header('Content-Language: ' . $this->i18nCurrent);
        if ($this->formatCurrent == 'vcard') {
            header('Content-Disposition: attachment; ' .
                   'filename=Fabio_Cicerchia.vcf');
        }

        return $content;
    }
    // }}}

    // {{{ transform
    /**
     * @access protected
     * @param  string $xml
     * @param  string $xsl
     * @return string
     */
    protected function transform($xml, $xsl)
    {
        $xsl = str_replace('href="i18n.',   'href="' . dirname(__FILE__) .
               '/data/xsl/i18ns/', $xsl);
        $xsl = str_replace('href="format.', 'href="' . dirname(__FILE__) .
               '/data/xsl/formats/', $xsl);

        $xslt = new XSLTProcessor();
        $xslt->importStylesheet(simplexml_load_string($xsl));

        return $xslt->transformToXml(new SimpleXMLElement($xml));
    }
    // }}}

    // {{{ actionMinify
    /**
     * @access protected
     * @return void
     */
    protected function actionMinify()
    {
        $tmp   = explode(',', $this->request['f']);
        $files = '';
        $last_modified = time();
        foreach($tmp as $file) {
            $mtime         = filemtime("media/$file");
            $last_modified = ($last_modified < $mtime)
                             ? $mtime
                             : $last_modified;
            $files        .= $this->baseUrl . "media/$file,";
        }
        $files = substr($files, 0, -1);

        $ext = preg_replace('/.*\./', '', $files);
        $mime = 'text/plain';
        if ($ext == 'css') $mime = 'text/css';
        if ($ext == 'js')  $mime = 'application/javascript';

        header("Content-Type: $mime");
        header("Last-Modified: " . date('r', $last_modified));

        $file = "http://" . $_SERVER['HTTP_HOST'] . $this->baseUrl .
                "minify/index.php?f=$files";
        $content = file_get_contents($file);
        return $content;
    }
    // }}}

    // {{{ action404
    /**
     * @access protected
     * @return void
     */
    protected function action404()
    {
        header('HTTP/1.0 404 Not Found');
        header('Location: /');
        exit;
    }
    // }}}

    // {{{ setRequest
    /**
     * @access protected
     * @param  array $get
     * @return void
     */
    protected function setRequest($get)
    {
        $allowed_keys = array_keys($this->request);

        foreach($get as $key => $value)
        {
            if (in_array($key, $allowed_keys))
            {
                $value = trim(htmlentities(strip_tags($value)));
                if (!empty($value))
                {
                    $this->request[$key] = $value;
                }
            }
        }
    }
    // }}}

    // {{{ mobile_device_detect
    /**
     * @access protected
     * @param  boolean $iphone
     * @param  boolean $ipad
     * @param  boolean $android
     * @param  boolean $opera
     * @param  boolean $blackberry
     * @param  boolean $palm
     * @param  boolean $windows
     * @see    http://detectmobilebrowsers.mobi
     * @return boolean
     */
    protected function mobile_device_detect($iphone = true, $ipad = true,
                                            $android = true, $opera = true,
                                            $blackberry = true, $palm = true,
                                            $windows = true)
    {
        $mobile_browser = false;
        $ua             = !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $accept         = !empty($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '';

        $browsers = parse_ini_file(__DIR__ . '/data/browsers.ini', true);
        $all = explode("', '", substr($browsers['mobile']['all'], 1, -1));
        $all = array_combine($all, $all);

        $palm = 'pre\/|palm os|palm|hiptop|avantgo|plucker|xiino|blazer|elaine';
        $win_smart = 'iris|3g_t|windows ce|opera mobi|windows ce; smartphone;' .
                     '|windows ce; iemobile';

        switch(true) {
            case (preg_match('/ipad/i', $ua));
                $mobile_browser = $ipad;
                $status = 'Apple iPad';
                break;

            case (preg_match('/ipod/i', $ua) ||
                  preg_match('/iphone/i', $ua));
                $mobile_browser = $iphone;
                $status = 'Apple';
                break;

            case (preg_match('/android/i', $ua));
                $mobile_browser = $android;
                $status = 'Android';
                break;

            case (preg_match('/opera mini/i', $ua));
                $mobile_browser = $opera;
                $status = 'Opera';
                break;

            case (preg_match('/blackberry/i', $ua));
                $mobile_browser = $blackberry;
                $status = 'Blackberry';
                break;

            case (preg_match('/(' . $palm . ')/i', $ua));
                $mobile_browser = $palm;
                $status = 'Palm';
                break;

            case (preg_match('/(' . $win_smart . ')/i', $ua));
                $mobile_browser = $windows;
                $status = 'Windows Smartphone';
                break;

            case (preg_match('/(' . $browsers['mobile']['list'] . ')/i', $ua));
                $mobile_browser = true;
                $status = 'Mobile matched on piped preg_match';
                break;

            case ((strpos($accept, 'text/vnd.wap.wml') > 0) ||
                  (strpos($accept, 'application/vnd.wap.xhtml+xml') > 0));
                $mobile_browser = true;
                $status = 'Mobile matched on content accept header';
                break;

            case (isset($_SERVER['HTTP_X_WAP_PROFILE']) ||
                  isset($_SERVER['HTTP_PROFILE']));
                $mobile_browser = true;
                $status = 'Mobile matched on profile headers being set';
                break;

            case (in_array(strtolower(substr($ua, 0, 4)), $all));
                $mobile_browser = true;
                $status = 'Mobile matched on in_array';
                break;

            default;
                $mobile_browser = false;
                $status = 'Desktop / full capability browser';
                break;
        }

        return $mobile_browser;
    }
    // }}}
}

$resume = new MyResume();
$resume->show();
