#!/usr/bin/perl -w

#
# FABIO CICERCHIA - WEBSITE
# Copyright (C) 2012. All Rights reserved.
#

use strict;
use warnings;
use Test::More qw(no_plan);
use Devel::Cover;
use File::Basename;
use File::Spec;

# Check the requirements
require_ok('Data::Dumper');
require_ok('Date::Format');
require_ok('Devel::Cover');
require_ok('Digest::MD5');
require_ok('File::Basename');
require_ok('File::Spec');
require_ok('HTTP::Cache::Transparent');
require_ok('LWP');
require_ok('POSIX');
require_ok('Pod::Coverage');
require_ok('Template');
require_ok('Test::More');
require_ok('XML::Simple');

# Check the files
do File::Spec->rel2abs(dirname(__FILE__)) . '/../../apps/site/logic/class.pl';
#do (dirname(__FILE__) . '/../../apps/site/logic/controller.pl');

my $class_name = "FabioCicerchiaSite";

subtest 'Unit Testing' => sub {
    can_ok($class_name, qw(new));
    can_ok($class_name, qw(show));
    can_ok($class_name, qw(executeAction));
    can_ok($class_name, qw(actionShow));
    can_ok($class_name, qw(elaborateData));
    can_ok($class_name, qw(action404));
    can_ok($class_name, qw(setRequest));
    can_ok($class_name, qw(callAPI));
    can_ok($class_name, qw(retrieveXML));
    can_ok($class_name, qw(getData));
    can_ok($class_name, qw(getItemData));
};

subtest 'Functional Testing' => sub {
    local %ENV = (
        'SCRIPT_NAME',          '/index.pl',
        'SERVER_NAME',          'fabiocicerchia.it',
        'SERVER_ADMIN',         '[no address given]',
        'HTTP_ACCEPT_ENCODING', 'gzip, deflate',
        'HTTP_CONNECTION',      'keep-alive',
        'REQUEST_METHOD',       'GET',
        'HTTP_ACCEPT',          'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
        'SCRIPT_FILENAME',      '/var/www/fabiocicerchia.it/web/index.pl',
        'SERVER_SOFTWARE',      'Apache/2.2.22 (Ubuntu)',
        'TZ',                   'Europe/London',
        'QUERY_STRING',         '',
        'REMOTE_PORT',          '60403',
        'HTTP_USER_AGENT',      'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:13.0) Gecko/20100101 Firefox/13.0.1',
        'SERVER_PORT',          '80',
        'SERVER_SIGNATURE',     '',
        'HTTP_ACCEPT_LANGUAGE', 'en-gb,en;q=0.5',
        'REMOTE_ADDR',          '127.0.0.1',
        'SERVER_PROTOCOL',      'HTTP/1.1',
        'MOD_PERL_API_VERSION', '2',
        'PATH',                 '/usr/local/bin:/usr/bin:/bin',
        'REQUEST_URI',          '/',
        'GATEWAY_INTERFACE',    'CGI/1.1',
        'SERVER_ADDR',          '127.0.0.1',
        'DOCUMENT_ROOT',        '/var/www/fabiocicerchia.it/web',
        'HTTP_HOST',            'fabiocicerchia.github',
        'MOD_PERL',             'mod_perl/2.0.5',
        'UNIQUE_ID',            'T@lcSX8AAQEAAAc3AV4AAAAC'
    );

    my $obj = new_ok($class_name);
    $obj->show();

    local %ENV = (
        'SCRIPT_NAME',           '/index.pl',
        'REQUEST_METHOD',        'GET',
        'HTTP_ACCEPT',           'text/html,application/xhtml+xml,application/xml,q=0.9,*/*,q=0.8',
        'SCRIPT_FILENAME',       '/home/fabio/Web/fabiocicerchia.github.com/web/index.pl',
        'SERVER_SOFTWARE',       'Apache/2.2.22 (Ubuntu)',
        'QUERY_STRING',          'format=rss2',
        'REMOTE_PORT',           '50192',
        'HTTP_USER_AGENT',       'Mozilla/5.0 (X11, Ubuntu, Linux x86_64, rv:13.0) Gecko/20100101 Firefox/13.0.1',
        'SERVER_SIGNATURE',      '',
        'REDIRECT_QUERY_STRING', 'format=rss2',
        'REDIRECT_TZ',           'Europe/London',
        'HTTP_ACCEPT_LANGUAGE',  'en-gb,en,q=0.5',
        'PATH',                  '/usr/local/bin:/usr/bin:/bin',
        'MOD_PERL_API_VERSION',  '2',
        'GATEWAY_INTERFACE',     'CGI/1.1',
        'DOCUMENT_ROOT',         '/home/fabio/Web/fabiocicerchia.github.com/web',
        'UNIQUE_ID',             'T-DCcH8AAQEAACbMOxMAAAAG',
        'SERVER_NAME',           'fabiocicerchia.github',
        'HTTP_ACCEPT_ENCODING',  'gzip, deflate',
        'SERVER_ADMIN',          '[no address given]',
        'HTTP_CONNECTION',       'keep-alive',
        'REDIRECT_URL',          '/rss',
        'TZ',                    'Europe/London',
        'REDIRECT_UNIQUE_ID',    'T-DCcH8AAQEAACbMOxMAAAAG',
        'SERVER_PORT',           '80',
        'REDIRECT_STATUS',       '200',
        'REMOTE_ADDR',           '127.0.0.1',
        'SERVER_PROTOCOL',       'HTTP/1.1',
        'REQUEST_URI',           '/rss',
        'SERVER_ADDR',           '127.0.0.1',
        'HTTP_HOST',             'fabiocicerchia.github',
        'MOD_PERL',              'mod_perl/2.0.5',
    );

    $obj = new_ok($class_name);
    $obj->show();

    pass('Functional Testing');
};
