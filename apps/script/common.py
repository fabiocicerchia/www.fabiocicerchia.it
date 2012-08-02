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
import re
from lxml import etree
# http://lxml.de/parsing.html

# {{{ Function: retrieveUrlContent --------------------------------------------
# Usage      : FabioCicerchia::Site->new()
# Purpose    : Generate a new instance.
# Returns    : Self.
# Parameters : None.
# Throws     : No exceptions.
# TODO: Change above
def retrieveUrlContent(http_method, remote_url, params):
    # TODO: add documentation
    if (http_method == 'GET'):
        data = urllib.urlopen(remote_url + '%s' % params).read()
    else:
        data = urllib.urlopen(remote_url, params).read()

    return data
# }}} -------------------------------------------------------------------------

# {{{ Function: validate ------------------------------------------------------
# Usage      : FabioCicerchia::Site->new()
# Purpose    : Generate a new instance.
# Returns    : Self.
# Parameters : None.
# Throws     : No exceptions.
# TODO: Change above
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
    """

    # TODO: Convert to a dynamic value.
    page = urllib.quote('http://www.fabiocicerchia.it' + page)
    params = params.replace('%25URI%25', page)

    data = retrieveUrlContent(http_method, remote_url, params)

    parser = etree.XMLParser(ns_clean=False, resolve_entities=False,
                             recover=True)
    tree = etree.fromstring(data, parser)

    elements = tree.xpath(match)
    text = ''.join(elements)
    match = re.match(excepted_value, text, re.DOTALL)

    status = (match != None)

    # TODO: remove this if
    if match_reverse:
        status = not status

    if status:
        return 'OK' # TODO: Convert to a dynamic value.
    else:
        return 'FAIL' + ' > Check this out to: ' + remote_url # TODO: Convert to a dynamic value.
# }}} -------------------------------------------------------------------------
