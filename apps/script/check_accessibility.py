#!/usr/bin/env python
#
# FABIO CICERCHIA - WEBSITE
#
# Copyright 2012 Fabio Cicerchia.
#
# Permission is hereby granted, free of  charge, to any person obtaining a copy
# of this software  and associated documentation files (the  Software), to deal
# in the Software without restriction,  including without limitation the rights
# to use,  copy, modify,  merge, publish,  distribute, sublicense,  and/or sell
# copies  of the  Software,  and to  permit  persons to  whom  the Software  is
# furnished to do so, subject to the following conditions:
#
# The above  copyright notice and this  permission notice shall be  included in
# all copies or substantial portions of the Software.
#
# THE SOFTWARE  IS PROVIDED "AS IS",  WITHOUT WARRANTY OF ANY  KIND, EXPRESS OR
# IMPLIED,  INCLUDING BUT  NOT LIMITED  TO THE  WARRANTIES OF  MERCHANTABILITY,
# FITNESS FOR A  PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO  EVENT SHALL THE
# AUTHORS  OR COPYRIGHT  HOLDERS  BE LIABLE  FOR ANY  CLAIM,  DAMAGES OR  OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
# SOFTWARE.
#
# Python Version 2.7
#
# Category: Code
# Package:  Script
# Author:   Fabio Cicerchia <info@fabiocicerchia.it>
# License:  MIT <http://www.opensource.org/licenses/MIT>
# Link:     http://www.fabiocicerchia.it
#

from __future__ import print_function
import urllib
from common import validate

pages = {
    'url_hp': {
        'EN - Homepage (HTML5)': '/?bot=1',
        'EN - Homepage (XHTML)': '/xhtml?bot=1',
        'EN - Homepage (PRINT)': '/print?bot=1',
        'IT - Homepage (HTML5)': '/it/?bot=1',
        'IT - Homepage (XHTML)': '/it/xhtml?bot=1',
        'IT - Homepage (PRINT)': '/it/print?bot=1'
    },
    'css': {
        'style.css': '/minified/css/style.css',
        'print.css': '/minified/css/print.css'
    },
    'feed': {
        'EN - RSS 0.91': '/rss091',
        'EN - RSS 0.92': '/rss092',
        'EN - RSS 1.0':  '/rss1',
        'EN - RSS 2.0':  '/rss2',
        'EN - ATOM':     '/atom',
        'IT - RSS 0.91': '/it/rss091',
        'IT - RSS 0.92': '/it/rss092',
        'IT - RSS 1.0':  '/it/rss1',
        'IT - RSS 2.0':  '/it/rss2',
        'IT - ATOM':     '/it/atom'
    }
}

print('CHECK ACCESSIBILITY')

print('Validate Accessibility (BITV 1.0 - Level 2):')
for k, v in pages['url_hp'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({
        'uri': '%URI%',
        'validate_uri': 'Check It',
        'MAX_FILE_SIZE': 52428800,
        'uploadfile': '',
        'pastehtml': '',
        'rpt_format': 1,
        'enable_html_validation': 1
    })
    url_param = url_param + '&radio_gid[]=1&checkbox_gid[]=8'
    xpath = './/*[@id="AC_congrats_msg_for_errors"]/text()'
    res = validate('POST', 'http://achecker.ca/checker/index.php',
                   url_param, v, xpath,
                   '.*Congratulations! No known problems\..*')

    print(res)

print('Validate Accessibility (Section 508):')
for k, v in pages['url_hp'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({
        'uri': '%URI%',
        'validate_uri': 'Check It',
        'MAX_FILE_SIZE': 52428800,
        'uploadfile': '',
        'pastehtml': '',
        'rpt_format': 1,
        'enable_html_validation': 1
    })
    url_param = url_param + '&radio_gid[]=2&checkbox_gid[]=8'
    xpath = './/*[@id="AC_congrats_msg_for_errors"]/text()'
    res = validate('POST', 'http://achecker.ca/checker/index.php',
                   url_param, v, xpath,
                   '.*Congratulations! No known problems\..*')

    print(res)

print('Validate Accessibility (Stanca Act):')
for k, v in pages['url_hp'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({
        'uri': '%URI%',
        'validate_uri': 'Check It',
        'MAX_FILE_SIZE': 52428800,
        'uploadfile': '',
        'pastehtml': '',
        'rpt_format': 1,
        'enable_html_validation': 1
    })
    url_param = url_param + '&radio_gid[]=3&checkbox_gid[]=8'
    xpath = './/*[@id="AC_congrats_msg_for_errors"]/text()'
    res = validate('POST', 'http://achecker.ca/checker/index.php',
                   url_param, v, xpath,
                   '.*Congratulations! No known problems\..*')

    print(res)

print('Validate Accessibility (WCAG 1.0 - Level AAA):')
for k, v in pages['url_hp'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({
        'uri': '%URI%',
        'validate_uri': 'Check It',
        'MAX_FILE_SIZE': 52428800,
        'uploadfile': '',
        'pastehtml': '',
        'rpt_format': 1,
        'enable_html_validation': 1
    })
    url_param = url_param + '&radio_gid[]=6&checkbox_gid[]=8'
    xpath = './/*[@id="AC_congrats_msg_for_errors"]/text()'
    res = validate('POST', 'http://achecker.ca/checker/index.php',
                   url_param, v, xpath,
                   '.*Congratulations! No known problems\..*')

    print(res)

print('Validate Accessibility (WCAG 2.0 - Level AAA):')
for k, v in pages['url_hp'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({
        'uri': '%URI%',
        'validate_uri': 'Check It',
        'MAX_FILE_SIZE': 52428800,
        'uploadfile': '',
        'pastehtml': '',
        'rpt_format': 1,
        'enable_html_validation': 1
    })
    url_param = url_param + '&radio_gid[]=9&checkbox_gid[]=8'
    xpath = './/*[@id="AC_congrats_msg_for_errors"]/text()'
    res = validate('POST', 'http://achecker.ca/checker/index.php',
                   url_param, v, xpath,
                   '.*Congratulations! No known problems\..*')

    print(res)
# TODO: Use http://www.sidar.org/hera/index.php.it ?
