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
# LOADING SCRIPTS
################################################################################
CURRENT_PATH="${BASH_SOURCE[0]}";
# Modifier "h": is it a file exists and is a symbolic link?
if [ -h "$CURRENT_PATH" ]; then
    while [ -h "$CURRENT_PATH" ]; do
        CURRENT_PATH=$(readlink "$CURRENT_PATH")
    done
fi
CURRENT_PATH=$(dirname "$CURRENT_PATH")
CURRENT_PATH=$(cd "$CURRENT_PATH"; pwd)
source $CURRENT_PATH/config.sh
source $CURRENT_PATH/common.sh

MODULES=$(find $CURRENT_PATH/modules -name "*.sh" -type f)
for MODULE in $MODULES; do
    source $MODULE
done

################################################################################
# PARAMETERS ELABORATION
################################################################################
STOP_ON_ERROR=0
SILENT=0
HAS_OPTIONS=0
while getopts "sq" OPTION
do
    HAS_OPTIONS=1
    case $OPTION in
        s)
            STOP_ON_ERROR=1
            ;;
        q)
            SILENT=1
            ;;
    esac
done

SUBROUTINE=$1
if [ $HAS_OPTIONS -eq 1 ]; then
    SUBROUTINE=$2
fi
IS_VALID=$(echo $SUBROUTINE | egrep "^[a-z]+$" | wc -l)
SUBROUTINE_EXISTS=$(declare -F | cut -d " " -f 3 | grep "^$SUBROUTINE$")

################################################################################
# RUN
################################################################################
print_header "CONSOLE"
print_subheader "Copyright: 2012 Fabio Cicerchia"
print_subheader "License:   MIT"
print_subheader "Website:   http://www.fabiocicerchia.it"

# TODO: Use "-n $SUBROUTINE".
if [ "$SUBROUTINE" != "" -a $IS_VALID -eq 1 ]; then
    $SUBROUTINE $@
    exit $?
# TODO: Use "-n $SUBROUTINE".
elif [ "$SUBROUTINE" != "" ]; then
    if [ $IS_VALID -eq 0 ]; then
        echo "You can't call the action called '$SUBROUTINE'."
    # TODO: Use "-n $SUBROUTINE".
    elif [ "$SUBROUTINE" != "" ]; then
        echo "Doesn't exists an action called '$SUBROUTINE'."
    fi
fi

help
exit 1
