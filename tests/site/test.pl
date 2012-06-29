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

#    subtest 'Testing method: new' => sub {
#        my $obj = new_ok($class_name);
#        my $res;
#
#        $res = $obj->new();
#
#        pass();
#    };

#    subtest 'Testing method: show' => sub {
#        my $obj = new_ok($class_name);
#        my $res;
#
#        $res = $obj->show();
#
#        pass();
#    };

#    subtest 'Testing method: executeAction' => sub {
#        my $obj = new_ok($class_name);
#        my $res;
#
#        $res = $obj->executeAction();
#        $res = $obj->executeAction('');
#        $res = $obj->executeAction('show');
#        $res = $obj->executeAction('fake');
#
#        pass();
#    };

#    subtest 'Testing method: actionShow' => sub {
#        my $obj = new_ok($class_name);
#        my $res;
#
#        $res = $obj->actionShow();
#
#        pass();
#    };

#    subtest 'Testing method: elaborateData' => sub {
#        my $obj = new_ok($class_name);
#        my $res;
#
#        $res = $obj->elaborateData();
#        $res = $obj->elaborateData('');
#        $res = $obj->elaborateData('fake');
#        $res = $obj->elaborateData({});
#        $res = $obj->elaborateData({}); # real structure
#
#        pass();
#    };

#    subtest 'Testing method: action404' => sub {
#        my $obj = new_ok($class_name);
#        my $res;
#
#        $res = $obj->action404();
#
#        pass();
#    };

#    subtest 'Testing method: setRequest' => sub {
#        my $obj = new_ok($class_name);
#        my $res;
#
#        $res = $obj->setRequest();
#
#        pass();
#    };

#    subtest 'Testing method: callAPI' => sub {
#        my $obj = new_ok($class_name);
#        my $res;
#
#        $res = $obj->callAPI();
#        $res = $obj->callAPI('');
#        $res = $obj->callAPI('', '');
#        $res = $obj->callAPI('/', '');
#        $res = $obj->callAPI('/api', '');
#        $res = $obj->callAPI('/api/root', 'it');
#        $res = $obj->callAPI('/api/skill', 'it');
#
#        pass();
#    };

#    subtest 'Testing method: retrieveXML' => sub {
#        my $obj = new_ok($class_name);
#        my $res;
#
#        # TODO: CHANGE AND NOT USE INSIDE callAPI.
#        $res = $obj->retrieveXML();
#        $res = $obj->retrieveXML('');
#        $res = $obj->retrieveXML('', '');
#        $res = $obj->retrieveXML('/', '');
#        $res = $obj->retrieveXML('/api', '');
#        $res = $obj->retrieveXML('/api/root', 'it');
#        $res = $obj->retrieveXML('/api/skill', 'it');
#
#        pass();
#    };

#    subtest 'Testing method: in_array' => sub {
#        my $obj = new_ok($class_name);
#        my $res;
#
#        $res = $obj->in_array(); # array, string
#
#        pass();
#    };
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

    pass('Functional Testing');
};
