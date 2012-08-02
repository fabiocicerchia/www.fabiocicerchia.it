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
from common import retrieveUrlContent
from time import time

# {{{ Function: getExecutionTime ----------------------------------------------
# Usage      : FabioCicerchia::Site->new()
# Purpose    : Generate a new instance.
# Returns    : Self.
# Parameters : None.
# Throws     : No exceptions.
# TODO: Change above
def getExecutionTime(url):
    # TODO: add documentation
    start = time()
    content = retrieveUrlContent('GET', url, '')
    end = time()

    return (end - start)
# }}} -------------------------------------------------------------------------

# {{{ Function: getAverageExecutionTime ---------------------------------------
# Usage      : FabioCicerchia::Site->new()
# Purpose    : Generate a new instance.
# Returns    : Self.
# Parameters : None.
# Throws     : No exceptions.
# TODO: Change above
def getAverageExecutionTime(url):
    # TODO: add documentation
    times = [
        getExecutionTime(url),
        getExecutionTime(url),
        getExecutionTime(url),
        getExecutionTime(url),
        getExecutionTime(url)
    ]

    sum = times[0] + times[1] + times[2] + times[3] + times[4]

    return round((sum - min(times) - max(times)) / 3, 5)
# }}} -------------------------------------------------------------------------

# TODO: move to a shared file among the others.
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
        'EN - Homepage (HTML5)': '/',
        'IT - Homepage (HTML5)': '/it',

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
    },
    'css': {
        'bootstrap.min.css':            '/media/css/bootstrap/bootstrap.min.css',
        'bootstrap-responsive.min.css': '/media/css/bootstrap/bootstrap-responsive.min.css',
        'main.css':                     '/media/css/main.css'
    },
    'js': {
        'jquery.js':    '/media/js/jquery.js',
        'bootstrap.js': '/media/js/bootstrap/bootstrap.js',
        'main.js':      '/media/js/main.js'
    }
}

for key, value in pages.iteritems():
    print(key.upper());
    for k, v in value.iteritems():
        spaces = (25 - len(k)) * ' '
        print('    ' + k + ':' + spaces, end='')
        # TODO: Convert to a dynamic value.
        print(getAverageExecutionTime("http://fabiocicerchia.github" + v), end='') # TODO: line length.
        print(' sec')
