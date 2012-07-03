#!/usr/bin/perl -w
#
# FABIO CICERCHIA - WEBSITE
#
# Perl Version 5
#
# @category  Code
# @package   Site
# @author    Fabio Cicerchia <info@fabiocicerchia.it>
# @copyright 2012 Fabio Cicerchia. All Rights reserved.
# @license   TBD <http://www.fabiocicerchia.it>
# @link      http://www.fabiocicerchia.it
#

use strict;
use warnings;
use version; our $VERSION = qv('1.0');
use File::Basename;

do( dirname(__FILE__) . '/class.pl' );

my $resume = FabioCicerchiaSite->new();
$resume->show();
