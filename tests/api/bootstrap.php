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
 * @category  Test
 * @package   Api
 * @author    Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright 2012 Fabio Cicerchia.
 * @license   MIT <http://www.opensource.org/licenses/MIT>
 * @link      http://www.fabiocicerchia.it
 */

if (defined('DIR_SEP') === false) {
    define('DIR_SEP', DIRECTORY_SEPARATOR);
}

if (defined('ROOT_PATH') === false) {
    define('ROOT_PATH',  __DIR__ . DIR_SEP . '..' . DIR_SEP . '..' . DIR_SEP);
}

if (defined('VENDOR_PATH') === false) {
    define('VENDOR_PATH', ROOT_PATH . DIR_SEP . 'lib' . DIR_SEP . 'vendor' . DIR_SEP);
}

if (defined('LIB_PATH') === false) {
    $path = VENDOR_PATH . 'FabioCicerchia' . DIR_SEP . 'lib' . DIR_SEP . 'FabioCicerchia';
    define('LIB_PATH', $path . DIR_SEP);
}

if (defined('SILEX_FILE') === false) {
    define('SILEX_FILE', ROOT_PATH . 'apps' . DIR_SEP . 'api' . DIR_SEP . 'silex.phar');
}
