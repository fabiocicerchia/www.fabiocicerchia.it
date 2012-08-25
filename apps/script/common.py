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

# TODO: Run PEP8 & PYLINT.

from __future__ import print_function
import urllib
import re
from lxml import etree
# http://lxml.de/parsing.html

BASE_URL = 'http://demo.fabiocicerchia.it'

pages = {
    'api': {
        'root':        '/',
        'information': '/information',
        'education':   '/education',
        'experience':  '/experience',
        'skill':       '/skill',
        'language':    '/language'
    },
    'site': {
        'url_hp': {
            'EN - Homepage (HTML5)': '/',
            'IT - Homepage (HTML5)': '/it',
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
    },
    'css': {
        'css': '/minified/css',
    },
    'js': {
        'js': '/minified/js',
    }
}

# {{{ Function: retrieve_url_content ------------------------------------------
def retrieve_url_content(http_method, remote_url, params):
    """Retrieve the content of an URL that could be called in two ways (GET or
    POST) sending eventually some data.

    Keyword arguments:
    http_method    -- HTTP Method to use (GET or POST).
    remote_url     -- The remote URL that validates the URL.
    params         -- The param list, could be sent via GET or POST.

    Return value:
    a string, that contain the URL response."""

    if (http_method == 'GET'):
        data = urllib.urlopen(remote_url).read()
    else:
        data = urllib.urlopen(remote_url, params).read()

    return data
# }}} -------------------------------------------------------------------------

# {{{ Function: validate ------------------------------------------------------
def validate(http_method, remote_url, params, page, match,
             excepted_value='.*', match_reverse=False):
    """Validate an URL calling the defined web site validator,
    passing some data to it.

    Keyword arguments:
    http_method    -- HTTP Method to use (GET or POST).
    remote_url     -- The remote URL that validates the URL.
    params         -- The param list, could be sent via GET or POST.
    page           -- The current page that needs validation.
    match          -- The RegExp to match the "excepted_value" inside the HTML
                      response.
    excepted_value -- The excepted value to consider an answer good or not.
    match_reverse  -- The flag that means "if the excepted value is not
                      matched". This behavious is useful to exclude from the
                      match, for example, an error string.

    Return value:
    a string, that contain the response of validation."""

    page   = urllib.quote(BASE_URL + page)
    params = params.replace('%25URI%25', page)

    if (http_method == 'GET'):
        remote_url = remote_url + '%s' % params

    data = retrieve_url_content(http_method, remote_url, params)

    parser = etree.XMLParser(ns_clean=False, resolve_entities=False,
                             recover=True)
    tree = etree.fromstring(data, parser)

    elements = tree.xpath(match)
    text     = ''.join(elements)
    match    = re.match(excepted_value, text, re.DOTALL)

    status = (match != None)

    if (match_reverse):
        status = not status

    if status:
        return 'OK'
    else:
        return 'FAIL' + ' > Check this out to: ' + remote_url
# }}} -------------------------------------------------------------------------