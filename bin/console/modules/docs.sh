#!/bin/bash
#
# FABIO CICERCHIA - WEBSITE
#
# Copyright 2012 - 2013 Fabio Cicerchia.
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
# DOCS ACTIONS
################################################################################

# {{{ doc_php() ----------------------------------------------------------------
doc_php() {
    print_subheader "RUNNING PHPDOCUMENTOR"

    cd $DOCDIR
    phpdoc -t ./api -d $API_APP_SOURCEDIR -d $API_LIB_SOURCEDIR \
           -d $API_TEST_SOURCEDIR --force --sourcecode --parseprivate

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ doc_perl() ---------------------------------------------------------------
doc_perl() {
    print_subheader "RUNNING POD"

    pod2html $SITE_APP_SOURCEDIR/logic/class.pl > $DOCDIR/site/class.html

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ doc_python() -------------------------------------------------------------
doc_python() {
    print_subheader "RUNNING EPYDOC"

    epydoc --html --show-private --show-imports --show-sourcecode \
           $SCRIPT_APP_SOURCEDIR/*.py -o $DOCDIR/script

    return $?
}
# }}} --------------------------------------------------------------------------
