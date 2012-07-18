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
# Package:  Site
# Author:   Fabio Cicerchia <info@fabiocicerchia.it>
# License:  MIT <http://www.opensource.org/licenses/MIT>
# Link:     http://www.fabiocicerchia.it
#

from __future__ import print_function
import urllib
import re
from lxml import etree
# http://lxml.de/parsing.html

def validate(http_method, remote_url, params, page, match,
             excepted_value='.*', match_reverse=False):
    page = urllib.quote('http://www.fabiocicerchia.it' + page)
    params = params.replace('%25URI%25', page)

    if (http_method == 'GET'):
        remote_url = remote_url + '%s' % params
        data = urllib.urlopen(remote_url).read()
    else:
        data = urllib.urlopen(remote_url, params).read()

    parser = etree.XMLParser(ns_clean=False, resolve_entities=False,
                             recover=True)
    tree   = etree.fromstring(data, parser)

    elements = tree.xpath(match)
    text  = ''.join(elements)
    match = re.match(excepted_value, text, re.DOTALL)

    status = (match != None)

    if match_reverse:
        status = not status

    if status:
        return 'OK'
    else:
        return 'FAIL' + ' > Check this out to: ' + remote_url

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

print('=' * 80)
print(' CHECK VALIDATION')
print('=' * 80)

print('Validate W3C:')
for k, v in pages['url_hp'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({
        'uri': '%URI%',
        'charset': '(detect automatically)',
        'doctype': 'Inline',
        'group': 0,
        'user-agent': 'W3C_Validator/1.2'
    })
    xpath  = './/*[@id="form"]//*[text()="Result:"]/following-sibling::*[1]/text()'
    res    = validate('GET', 'http://validator.w3.org/check?', url_param, v,
                      xpath, '.*Passed.*')

    print(res)

print('Validate CSS 3:')
for k, v in pages['css'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({
        'uri': '%URI%',
        'profile': 'css3',
        'usermedium': 'all',
        'warning': 2,
        'vextwarning': '',
        'lang': 'en'
    })
    xpath  = './/*[@id="results_container"]//*[local-name()="div"]/*[local-name()="h3"]/text()'
    res    = validate('GET', 'http://jigsaw.w3.org/css-validator/validator?',
                      url_param, v, xpath,
                      '.*Congratulations! No Error Found\..*')

    print(res)

print('Validate CSS 2.1:')
for k, v in pages['css'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({
        'uri': '%URI%',
        'profile': 'css21',
        'usermedium': 'all',
        'warning': 2,
        'vextwarning': '',
        'lang': 'en'
    })
    xpath  = './/*[@id="results_container"]//*[local-name()="div"]/*[local-name()="h3"]/text()'
    res    = validate('GET', 'http://jigsaw.w3.org/css-validator/validator?',
                      url_param, v, xpath,
                      '.*Congratulations! No Error Found\..*')

    print(res)

print('Validate CSS 2:')
for k, v in pages['css'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({
        'uri': '%URI%',
        'profile': 'css2',
        'usermedium': 'all',
        'warning': 2,
        'vextwarning': '',
        'lang': 'en'
    })
    xpath  = './/*[@id="results_container"]//*[local-name()="div"]/*[local-name()="h3"]/text()'
    res    = validate('GET', 'http://jigsaw.w3.org/css-validator/validator?',
                      url_param, v, xpath,
                      '.*Congratulations! No Error Found\..*')

    print(res)

print('Validate CSS Mobile:')
for k, v in pages['css'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({
        'uri': '%URI%',
        'profile': 'mobile',
        'usermedium': 'all',
        'warning': 2,
        'vextwarning': '',
        'lang': 'en'
    })
    xpath  = './/*[@id="results_container"]//*[local-name()="div"]/*[local-name()="h3"]/text()'
    res    = validate('GET', 'http://jigsaw.w3.org/css-validator/validator?',
                      url_param, v, xpath,
                      '.*Congratulations! No Error Found\..*')

    print(res)

print('Validate Feed:')
for k, v in pages['feed'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({'url': '%URI%'})
    xpath  = './/*[@id="main"]//*[local-name()="h2"]/text()'
    res    = validate('GET', 'http://validator.w3.org/feed/check.cgi?',
                      url_param, v, xpath, '.*Congratulations!.*')

    print(res)

print('Validate HTTP Headers:')
for k, v in pages['url_hp'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({'uri': '%URI%'})
    xpath  = './/*[@class="bad msg"]/text()'
    res    = validate('GET', 'http://redbot.org/?', url_param, v, xpath, '.+',
                      True)

    print(res)
for k, v in pages['feed'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({'uri': '%URI%'})
    xpath  = './/*[@class="bad msg"]/text()'
    res    = validate('GET', 'http://redbot.org/?', url_param, v, xpath, '.+',
                      True)

    print(res)

# When call the right URL using urllib this is the response of the page:
# Servlet has thrown exception:java.lang.NullPointerException
#print('Validate Mobile:')
#for k, v in pages['url_hp'].iteritems():
#    print('    ' + k + ': ', end='')
#
#    url_param = urllib.urlencode({'docAddr': '%URI%', 'async': 'false'})
#    xpath  = './/*[text() = "mobileOK score: "]/..//text()'
#    res    = validate('GET', 'http://validator.w3.org/mobile/check?',
#                      url_param, v, xpath, '.*mobileOK score.+9[0-9]%.*')
#
#    print(res)

print('Validate Semantics:')
for k, v in pages['url_hp'].iteritems():
    print('    ' + k + ': ', end='')

    url_param = urllib.urlencode({'url': '%URI%', 'view': 'cse'})
    xpath  = './/*[@id="form"]//*[text()="Result:"]/following-sibling::*[1]/text()'
    res    = validate('GET',
                      'http://www.google.com/webmasters/tools/richsnippets?',
                      url_param, v, xpath, '.*Errors:.*', True)

    print(res)

# This takes a while, it worth?
#print('Validate Links:')
#for k, v in pages['url_hp'].iteritems():
#    print('    ' + k + ': ', end='')
#
#    url_param = urllib.urlencode({
#        'uri': '%URI%',
#        'summary': 'on',
#        'hide_type': 'all',
#        'depth': '',
#        'check': 'Check'
#    })
#    xpath  = './/*[@id="form"]//*[text()="Result:"]/following-sibling::*[1]/text()'
#    res    = validate('GET', 'http://validator.w3.org/checklink?', url_param,
#                      v, xpath, '.*Passed.*')
#
#    print(res)
#for k, v in pages['feed'].iteritems():
#    print('    ' + k + ': ', end='')
#
#    url_param = urllib.urlencode({
#        'uri': '%URI%',
#        'summary': 'on',
#        'hide_type': 'all',
#        'depth': '',
#        'check': 'Check'
#    })
#    xpath  = './/*[@id="form"]//*[text()="Result:"]/following-sibling::*[1]/text()'
#    res    = validate('GET', 'http://validator.w3.org/checklink?', url_param,
#                      v, xpath, '.*Passed.*')
#
#    print(res)
