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

# TODO: http://www.w3.org/2005/MWI/BPWG/Group/TaskForces/Checker/
# TODO: http://www.sidar.org/hera/
# TODO: YSlow
# TODO: Page Speed

print('CHECK VALIDATION')

###############################################################################
# Web Site Validation of: Homepage
###############################################################################
print('Validate W3C:')
for k, v in pages['site']['url_hp'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = 'uri=%URI%&charset=(detect automatically)&doctype=Inline'
    url_param += '&group=0&user-agent=W3C_Validator/1.2'
    xpath = './/*[@id="form"]//*[text()="Result:"]/'
    xpath += 'following-sibling::*[1]/text()'

    res = validate('GET', 'http://validator.w3.org/check?', url_param, v,
                   xpath, '.*Passed.*')

    print(res)

###############################################################################
# Web Site Validation of: CSS v3
###############################################################################
print('Validate CSS 3:')
for k, v in pages['css'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = 'uri=%URI%&profile=css3&usermedium=all&warning=2&vextwarning=&'
    url_param += 'lang=en'
    xpath = './/*[@id="results_container"]//*[local-name()="div"]/'
    xpath += '*[local-name()="h3"]/text()'

    res = validate('GET', 'http://jigsaw.w3.org/css-validator/validator?',
                   url_param, v, xpath,
                   '.*Congratulations! No Error Found\..*')

    print(res)

###############################################################################
# Web Site Validation of: CSS v2.1
###############################################################################
print('Validate CSS 2.1:')
for k, v in pages['css'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = 'uri=%URI%&profile=css21&usermedium=all&warning=2&vextwarning='
    url_param += '&lang=en'
    xpath = './/*[@id="results_container"]//*[local-name()="div"]/'
    xpath += '*[local-name()="h3"]/text()'

    res = validate('GET', 'http://jigsaw.w3.org/css-validator/validator?',
                   url_param, v, xpath,
                   '.*Congratulations! No Error Found\..*')

    print(res)

###############################################################################
# Web Site Validation of: CSS v2
###############################################################################
print('Validate CSS 2:')
for k, v in pages['css'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = 'uri=%URI%&profile=css2&usermedium=all&warning=2&vextwarning=&'
    url_param += 'lang=en'
    xpath = './/*[@id="results_container"]//*[local-name()="div"]/'
    xpath += '*[local-name()="h3"]/text()'

    res = validate('GET', 'http://jigsaw.w3.org/css-validator/validator?',
                   url_param, v, xpath,
                   '.*Congratulations! No Error Found\..*')

    print(res)

###############################################################################
# Web Site Validation of: CSS vMobile
###############################################################################
print('Validate CSS Mobile:')
for k, v in pages['css'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = 'uri=%URI%&profile=mobile&usermedium=all&warning=2'
    url_param += 'vextwarning=&lang=en'
    xpath = './/*[@id="results_container"]//*[local-name()="div"]/'
    xpath += '*[local-name()="h3"]/text()'

    res = validate('GET', 'http://jigsaw.w3.org/css-validator/validator?',
                   url_param, v, xpath,
                   '.*Congratulations! No Error Found\..*')

    print(res)

###############################################################################
# Web Site Validation of: Feed
###############################################################################
print('Validate Feed:')
for k, v in pages['site']['feed'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({'url': '%URI%'})
    xpath = './/*[@id="main"]//*[local-name()="h2"]/text()'

    res = validate('GET', 'http://validator.w3.org/feed/check.cgi?',
                   url_param, v, xpath, '.*Congratulations!.*')

    print(res)

###############################################################################
# Web Site Validation of: HTTP Header
###############################################################################
print('Validate HTTP Headers:')
for k, v in pages['site']['url_hp'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({'uri': '%URI%'})
    xpath = './/*[@class="bad msg"]/text()'

    res = validate('GET', 'http://redbot.org/?', url_param, v, xpath, '.+',
                   True)

    print(res)

for k, v in pages['site']['feed'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({'uri': '%URI%'})
    xpath = './/*[@class="bad msg"]/text()'

    res = validate('GET', 'http://redbot.org/?', url_param, v, xpath, '.+',
                   True)

    print(res)

###############################################################################
# Web Site Validation of: Semantics
###############################################################################
print('Validate Semantics:')
for k, v in pages['site']['url_hp'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({'url': '%URI%', 'html': ''})

    xpath = './/*[@id="extracted-data-google"]/*[local-name()="div"][2]//text()'

    res = validate('GET',
                   'http://www.google.com/webmasters/tools/richsnippets?',
                   url_param, v, xpath, '.*No data detected.*', True)

    print(res)

###############################################################################
# Web Site Validation of: Links
###############################################################################
print('Validate Links:')
for k, v in pages['site']['url_hp'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = 'uri=%URI%&summary=on&hide_type=all&depth=&check=Check'
    xpath = './/*[@id="main"]//text()'

    res = validate('GET', 'http://validator.w3.org/checklink?', url_param,
                   v, xpath, '.*Valid anchors.*')

    print(res)

for k, v in pages['site']['feed'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = 'uri=%URI%&summary=on&hide_type=all&depth=&check=Check'
    xpath = './/*[@id="main"]//text()'

    res = validate('GET', 'http://validator.w3.org/checklink?', url_param,
                   v, xpath, '.*Valid anchors.*')

    print(res)
