#!/bin/bash
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
# Bash Shell
#
# Category: Code
# Package:  Console
# Author:   Fabio Cicerchia <info@fabiocicerchia.it>
# License:  MIT <http://www.opensource.org/licenses/MIT>
# Link:     http://www.fabiocicerchia.it
#

################################################################################
# DIRECTORIES
################################################################################
RELATIVE_CURRENT_PATH=`dirname $0`
ABSOLUTE_CURRENT_PATH=`cd $RELATIVE_CURRENT_PATH; pwd`
CURRENTDIR=$ABSOLUTE_CURRENT_PATH
ROOTDIR=$CURRENTDIR"/../.."
API_APP_SOURCEDIR=$ROOTDIR/apps/api
API_LIB_SOURCEDIR=$ROOTDIR/lib/vendor/FabioCicerchia/lib/FabioCicerchia/Api
API_TEST_SOURCEDIR=$ROOTDIR/tests/api
SITE_APP_SOURCEDIR=$ROOTDIR/apps/site
SITE_TEST_SOURCEDIR=$ROOTDIR/tests/site
SCRIPT_APP_SOURCEDIR=$ROOTDIR/apps/script
SCRIPT_TEST_SOURCEDIR=$ROOTDIR/tests/script
REPORTDIR=$ROOTDIR/report
