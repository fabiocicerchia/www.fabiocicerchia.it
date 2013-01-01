#!/usr/bin/env python
#
# FABIO CICERCHIA - WEBSITE
#
# Copyright 2012 - 2013 Fabio Cicerchia.
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
from common import *
from time import time

BASE_URL = 'http://www.fabiocicerchia.it'

# {{{ Function: get_execution_time --------------------------------------------
def get_execution_time(url):
    """Measure the execution time to fetch a URL.

    Keyword arguments:
    url -- The remote URL that validates the URL.

    Return value:
    a string, that contain the response of validation."""

    start = time()
    retrieve_url_content('GET', url, '')
    end = time()

    return (end - start)
# }}} -------------------------------------------------------------------------

# {{{ Function: get_average_execution_time ------------------------------------
def get_average_execution_time(url):
    """Measure 5 times the execution time to fetch a URL, then discard the best
    and the worst and return the average.

    Keyword arguments:
    url -- The remote URL that validates the URL.

    Return value:
    a float, the average execution time."""

    etime = [
        get_execution_time(url),
        get_execution_time(url),
        get_execution_time(url),
        get_execution_time(url),
        get_execution_time(url)
    ]

    return round((sum(etime) - min(etime) - max(etime)) / 3, 5)
# }}} -------------------------------------------------------------------------

# {{{ Function: run -----------------------------------------------------------
def run(key, elements):
    """Cycle over each element then print some information and execute the
    function get_average_execution_time.

    Keyword arguments:
    key      -- A string that identify the elements.
    elements -- An array with the list of the pages to check."""

    print(key.upper())
    for subk, subv in elements.iteritems():
        spaces = (25 - len(subk)) * ' '
        print('    ' + subk + ':' + spaces, end='')
        print(get_average_execution_time(BASE_URL + subv), end='')
        print(' sec')
# }}} -------------------------------------------------------------------------

# Main ------------------------------------------------------------------------
if __name__ == "__main__":
    run('API',       pages['api'])
    run('Web pages', pages['site']['url_hp'])
    run('Feeds',     pages['site']['feed'])
    run('CSS',       pages['css'])
    run('JS',        pages['js'])
