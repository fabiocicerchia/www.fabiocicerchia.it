#!/usr/bin/perl -w
#
# FABIO CICERCHIA - WEBSITE
#
# Copyright 2012 Fabio Cicerchia.
#
# Permission is hereby  granted, free of charge, to any  person obtaining a copy
# of this software and associated  documentation files (the "Software"), to deal
# in the Software  without restriction, including without  limitation the rights
# to  use, copy,  modify, merge,  publish, distribute,  sublicense, and/or  sell
# copies  of  the Software,  and  to  permit persons  to  whom  the Software  is
# furnished to do so, subject to the following conditions:
#
# The above copyright notice and this permission notice shall be included in all
# copies or substantial portions of the Software.
#
# THE SOFTWARE  IS PROVIDED "AS  IS", WITHOUT WARRANTY  OF ANY KIND,  EXPRESS OR
# IMPLIED,  INCLUDING BUT  NOT  LIMITED TO  THE  WARRANTIES OF  MERCHANTABILITY,
# FITNESS FOR  A PARTICULAR PURPOSE AND  NONINFRINGEMENT. IN NO EVENT  SHALL THE
# AUTHORS  OR COPYRIGHT  HOLDERS  BE  LIABLE FOR  ANY  CLAIM,  DAMAGES OR  OTHER
# LIABILITY, WHETHER IN AN ACTION OF  CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE  OR THE USE OR OTHER DEALINGS IN THE
# SOFTWARE.
#
# Perl Version 5
#
# Category: Code
# Package:  Site
# Author:   Fabio Cicerchia <info@fabiocicerchia.it>
# License:  MIT <http://www.opensource.org/licenses/MIT>
# Link:     http://www.fabiocicerchia.it
#

use strict;
use warnings;
use version; our $VERSION = qv('1.0');
use Test::More qw(no_plan);
use Devel::Cover;
use File::Basename;
use File::Spec;
use FileHandle;

# Check the files
do File::Spec->rel2abs(dirname(__FILE__)) . '/../../apps/site/logic/class.pl';

# Check the requirements
require_ok('Data::Dumper');
require_ok('Date::Format');
require_ok('Date::Manip');
require_ok('Devel::Cover');
require_ok('Digest::MD5');
require_ok('File::Basename');
require_ok('File::Spec');
require_ok('Locale::TextDomain');
require_ok('LWP');
require_ok('POSIX');
require_ok('Perl::Critic');
require_ok('Pod::Coverage');
require_ok('Template');
require_ok('Test::More');
require_ok('XML::Simple');

my $class_name = 'FabioCicerchiaSite';

# to make STDOUT flush immediately, simply set the variable this can be useful
# if you are writing to STDOUT in a loop many times the buffering will cause
# unexpected output results.
$| = 1;

subtest 'Unit Testing' => sub {
    can_ok( $class_name, qw(action404) );
    can_ok( $class_name, qw(action_show) );
    can_ok( $class_name, qw(call_api) );
    can_ok( $class_name, qw(elaborate_data) );
    can_ok( $class_name, qw(execute_action) );
    can_ok( $class_name, qw(get_data) );
    can_ok( $class_name, qw(get_item_data) );
    can_ok( $class_name, qw(gettext) );
    can_ok( $class_name, qw(new) );
    can_ok( $class_name, qw(retrieve_xml) );
    can_ok( $class_name, qw(set_request) );
    can_ok( $class_name, qw(show) );
};

# TODO: Refactor this code below.
# TODO: Disable the output printing
# TODO: Add the functional tests for "atom", "rss*", "vcard".
subtest 'Functional Testing' => sub {
    local %ENV = (
        'SCRIPT_NAME',
        '/index.pl',
        'SERVER_NAME',
        'fabiocicerchia.it',
        'SERVER_ADMIN',
        '[no address given]',
        'HTTP_ACCEPT_ENCODING',
        'gzip, deflate',
        'HTTP_CONNECTION',
        'keep-alive',
        'REQUEST_METHOD',
        'GET',
        'HTTP_ACCEPT',
        'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'SCRIPT_FILENAME',
        '/var/www/fabiocicerchia.it/web/index.pl',
        'SERVER_SOFTWARE',
        'Apache/2.2.22 (Ubuntu)',
        'TZ',
        'Europe/London',
        'QUERY_STRING',
        q{},
        'REMOTE_PORT',
        '60403',
        'HTTP_USER_AGENT',
'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:13.0) Gecko/20100101 Firefox/13.0.1',
        'SERVER_PORT',
        '80',
        'SERVER_SIGNATURE',
        q{},
        'HTTP_ACCEPT_LANGUAGE',
        'en-gb,en;q=0.5',
        'REMOTE_ADDR',
        '127.0.0.1',
        'SERVER_PROTOCOL',
        'HTTP/1.1',
        'MOD_PERL_API_VERSION',
        '2',
        'PATH',
        '/usr/local/bin:/usr/bin:/bin',
        'REQUEST_URI',
        q{/},
        'GATEWAY_INTERFACE',
        'CGI/1.1',
        'SERVER_ADDR',
        '127.0.0.1',
        'DOCUMENT_ROOT',
        '/var/www/fabiocicerchia.it/web',
        'HTTP_HOST',
        'fabiocicerchia.github',
        'MOD_PERL',
        'mod_perl/2.0.5',
        'UNIQUE_ID',
        'T@lcSX8AAQEAAAc3AV4AAAAC',
    );

    my $obj = new_ok($class_name);

    open (STDOUT, '>> /dev/null');
    STDOUT->autoflush(1);
    $obj->show();
    close(STDOUT);

    local %ENV = (
        'SCRIPT_NAME',
        '/index.pl',
        'REQUEST_METHOD',
        'GET',
        'HTTP_ACCEPT',
        'text/html,application/xhtml+xml,application/xml,q=0.9,*/*,q=0.8',
        'SCRIPT_FILENAME',
        '/home/fabio/Web/fabiocicerchia.github.com/web/index.pl',
        'SERVER_SOFTWARE',
        'Apache/2.2.22 (Ubuntu)',
        'QUERY_STRING',
        'format=rss2',
        'REMOTE_PORT',
        '50192',
        'HTTP_USER_AGENT',
'Mozilla/5.0 (X11, Ubuntu, Linux x86_64, rv:13.0) Gecko/20100101 Firefox/13.0.1',
        'SERVER_SIGNATURE',
        q{},
        'REDIRECT_QUERY_STRING',
        'format=rss2',
        'REDIRECT_TZ',
        'Europe/London',
        'HTTP_ACCEPT_LANGUAGE',
        'en-gb,en,q=0.5',
        'PATH',
        '/usr/local/bin:/usr/bin:/bin',
        'MOD_PERL_API_VERSION',
        '2',
        'GATEWAY_INTERFACE',
        'CGI/1.1',
        'DOCUMENT_ROOT',
        '/home/fabio/Web/fabiocicerchia.github.com/web',
        'UNIQUE_ID',
        'T-DCcH8AAQEAACbMOxMAAAAG',
        'SERVER_NAME',
        'fabiocicerchia.github',
        'HTTP_ACCEPT_ENCODING',
        'gzip, deflate',
        'SERVER_ADMIN',
        '[no address given]',
        'HTTP_CONNECTION',
        'keep-alive',
        'REDIRECT_URL',
        '/rss',
        'TZ',
        'Europe/London',
        'REDIRECT_UNIQUE_ID',
        'T-DCcH8AAQEAACbMOxMAAAAG',
        'SERVER_PORT',
        '80',
        'REDIRECT_STATUS',
        '200',
        'REMOTE_ADDR',
        '127.0.0.1',
        'SERVER_PROTOCOL',
        'HTTP/1.1',
        'REQUEST_URI',
        '/rss',
        'SERVER_ADDR',
        '127.0.0.1',
        'HTTP_HOST',
        'fabiocicerchia.github',
        'MOD_PERL',
        'mod_perl/2.0.5',
    );

    $obj = new_ok($class_name);

    open (STDOUT, '>> /dev/null');
    STDOUT->autoflush(1);
    $obj->show();
    close(STDOUT);

    pass('Functional Testing');
};
