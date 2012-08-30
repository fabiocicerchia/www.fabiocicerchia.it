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
do File::Spec->rel2abs( dirname(__FILE__) )
    . '/../../apps/site/logic/class.pl';

# Check the requirements
require_ok('Data::Dumper');
require_ok('Date::Format');
require_ok('Date::Manip');
require_ok('Devel::Cover');
require_ok('Digest::MD5');
require_ok('File::Basename');
require_ok('File::Spec');
require_ok('JSON');
require_ok('Locale::TextDomain');
require_ok('LWP');
require_ok('Perl::Critic');
require_ok('Pod::Coverage');
require_ok('POSIX');
require_ok('Readonly');
require_ok('Template');
require_ok('Test::More');
require_ok('XML::Simple');

my $class_name = 'FabioCicerchiaSite';

# To make STDOUT flush immediately, simply set the variable this can be useful
# if you are writing to STDOUT in a loop many times the buffering will cause
# unexpected output results.
local $| = 1;

subtest 'Unit Testing' => sub {
    can_ok( $class_name, qw(action404) );
    can_ok( $class_name, qw(action_code_snippets) );
    can_ok( $class_name, qw(action_dev) );
    can_ok( $class_name, qw(action_maps) );
    can_ok( $class_name, qw(action_references) );
    can_ok( $class_name, qw(action_show) );
    can_ok( $class_name, qw(call_api) );
    can_ok( $class_name, qw(execute_action) );
    can_ok( $class_name, qw(get_data) );
    can_ok( $class_name, qw(get_item_data) );
    can_ok( $class_name, qw(gettext) );
    can_ok( $class_name, qw(new) );
    can_ok( $class_name, qw(retrieve_xml) );
    can_ok( $class_name, qw(set_request) );
    can_ok( $class_name, qw(show) );
};

subtest 'Functional Testing' => sub {
    my %BASE_ENV = (
        'SCRIPT_NAME',
        '/index.pl',
        'SERVER_NAME',
        'localhost',
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
        '/var/www/fabiocicerchia/current/web/index.pl',
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
        '/var/www/fabiocicerchia/current/web',
        'HTTP_HOST',
        'fabiocicerchia.github',
        'MOD_PERL',
        'mod_perl/2.0.5',
        'UNIQUE_ID',
        'T@lcSX8AAQEAAAc3AV4AAAAC',
    );

    my $res;

    ############################################################################
    # HOMEPAGE
    ############################################################################
    local %ENV = %BASE_ENV;

    my $obj = new_ok($class_name);

    #$res = open STDOUT, '>>', '/dev/null';
    STDOUT->autoflush(1);
    $obj->show();
    #$res = close STDOUT;

    ############################################################################
    # RSS2
    ############################################################################
    local %ENV = %BASE_ENV;
    local $ENV{'QUERY_STRING'}          = 'format=rss2';
    local $ENV{'REDIRECT_QUERY_STRING'} = 'format=rss2';
    local $ENV{'REDIRECT_URL'}          = '/rss2';
    local $ENV{'REQUEST_URI'}           = '/rss2';

    $obj = new_ok($class_name);

    #$res = open STDOUT, '>>', '/dev/null';
    STDOUT->autoflush(1);
    $obj->show();
    #$res = close STDOUT;

    ############################################################################
    # RSS1
    ############################################################################
    local %ENV = %BASE_ENV;
    local $ENV{'QUERY_STRING'}          = 'format=rss1';
    local $ENV{'REDIRECT_QUERY_STRING'} = 'format=rss1';
    local $ENV{'REDIRECT_URL'}          = '/rss1';
    local $ENV{'REQUEST_URI'}           = '/rss1';

    $obj = new_ok($class_name);

    #$res = open STDOUT, '>>', '/dev/null';
    STDOUT->autoflush(1);
    $obj->show();
    #$res = close STDOUT;

    ############################################################################
    # RSS092
    ############################################################################
    local %ENV = %BASE_ENV;
    local $ENV{'QUERY_STRING'}          = 'format=rss092';
    local $ENV{'REDIRECT_QUERY_STRING'} = 'format=rss092';
    local $ENV{'REDIRECT_URL'}          = '/rss092';
    local $ENV{'REQUEST_URI'}           = '/rss092';

    $obj = new_ok($class_name);

    #$res = open STDOUT, '>>', '/dev/null';
    STDOUT->autoflush(1);
    $obj->show();
    #$res = close STDOUT;

    ############################################################################
    # RSS091
    ############################################################################
    local %ENV = %BASE_ENV;
    local $ENV{'QUERY_STRING'}          = 'format=rss091';
    local $ENV{'REDIRECT_QUERY_STRING'} = 'format=rss091';
    local $ENV{'REDIRECT_URL'}          = '/rss091';
    local $ENV{'REQUEST_URI'}           = '/rss091';

    $obj = new_ok($class_name);

    #$res = open STDOUT, '>>', '/dev/null';
    STDOUT->autoflush(1);
    $obj->show();
    #$res = close STDOUT;

    ############################################################################
    # ATOM
    ############################################################################
    local %ENV = %BASE_ENV;
    local $ENV{'QUERY_STRING'}          = 'format=atom';
    local $ENV{'REDIRECT_QUERY_STRING'} = 'format=atom';
    local $ENV{'REDIRECT_URL'}          = '/atom';
    local $ENV{'REQUEST_URI'}           = '/atom';

    $obj = new_ok($class_name);

    #$res = open STDOUT, '>>', '/dev/null';
    STDOUT->autoflush(1);
    $obj->show();
    #$res = close STDOUT;

    ############################################################################
    # VCARD
    ############################################################################
    local %ENV = %BASE_ENV;
    local $ENV{'QUERY_STRING'}          = 'format=vcard';
    local $ENV{'REDIRECT_QUERY_STRING'} = 'format=vcard';
    local $ENV{'REDIRECT_URL'}          = '/vcard';
    local $ENV{'REQUEST_URI'}           = '/vcard';

    $obj = new_ok($class_name);

    #$res = open STDOUT, '>>', '/dev/null';
    STDOUT->autoflush(1);
    $obj->show();
    #$res = close STDOUT;

    ############################################################################
    # CODE-SNIPPETS
    ############################################################################
    local %ENV = %BASE_ENV;
    local $ENV{'QUERY_STRING'}          = 'action=code-snippets';
    local $ENV{'REDIRECT_QUERY_STRING'} = 'action=code-snippets';
    local $ENV{'REDIRECT_URL'}          = '/code-snippets';
    local $ENV{'REQUEST_URI'}           = '/code-snippets';

    $obj = new_ok($class_name);

    #$res = open STDOUT, '>>', '/dev/null';
    STDOUT->autoflush(1);
    $obj->show();
    #$res = close STDOUT;

    ############################################################################
    # REFERENCES
    ############################################################################
    local %ENV = %BASE_ENV;
    local $ENV{'QUERY_STRING'}          = 'action=references';
    local $ENV{'REDIRECT_QUERY_STRING'} = 'action=references';
    local $ENV{'REDIRECT_URL'}          = '/references';
    local $ENV{'REQUEST_URI'}           = '/references';

    $obj = new_ok($class_name);

    #$res = open STDOUT, '>>', '/dev/null';
    STDOUT->autoflush(1);
    $obj->show();
    #$res = close STDOUT;

    ############################################################################
    # MAPS
    ############################################################################
    local %ENV = %BASE_ENV;
    local $ENV{'QUERY_STRING'}          = 'action=maps';
    local $ENV{'REDIRECT_QUERY_STRING'} = 'action=maps';
    local $ENV{'REDIRECT_URL'}          = '/maps';
    local $ENV{'REQUEST_URI'}           = '/maps';

    $obj = new_ok($class_name);

    #$res = open STDOUT, '>>', '/dev/null';
    STDOUT->autoflush(1);
    $obj->show();
    #$res = close STDOUT;

    ############################################################################
    # DEV
    ############################################################################
    local %ENV = %BASE_ENV;
    local $ENV{'QUERY_STRING'}          = 'action=dev';
    local $ENV{'REDIRECT_QUERY_STRING'} = 'action=dev';
    local $ENV{'REDIRECT_URL'}          = '/dev';
    local $ENV{'REQUEST_URI'}           = '/dev';

    $obj = new_ok($class_name);

    #$res = open STDOUT, '>>', '/dev/null';
    STDOUT->autoflush(1);
    $obj->show();
    #$res = close STDOUT;

    ############################################################################
    # 404
    ############################################################################
    local %ENV = %BASE_ENV;
    local $ENV{'QUERY_STRING'}          = 'action=fake';
    local $ENV{'REDIRECT_QUERY_STRING'} = 'action=fake';
    local $ENV{'REDIRECT_URL'}          = q{/};
    local $ENV{'REQUEST_URI'}           = q{/};

    $obj = new_ok($class_name);

    #$res = open STDOUT, '>>', '/dev/null';
    STDOUT->autoflush(1);
    $obj->show();

    #$res = close STDOUT; # Commented to suppress some further error messages.

    pass('Functional Testing');
};