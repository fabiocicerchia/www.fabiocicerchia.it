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
# COLORS
################################################################################
TXTBLK='\e[0;30m' # Black - Regular
TXTRED='\e[0;31m' # Red
TXTGRN='\e[0;32m' # Green
TXTYLW='\e[0;33m' # Yellow
TXTBLU='\e[0;34m' # Blue
TXTPUR='\e[0;35m' # Purple
TXTCYN='\e[0;36m' # Cyan
TXTWHT='\e[0;37m' # White
BLDBLK='\e[1;30m' # Black - Bold
BLDRED='\e[1;31m' # Red
BLDGRN='\e[1;32m' # Green
BLDYLW='\e[1;33m' # Yellow
BLDBLU='\e[1;34m' # Blue
BLDPUR='\e[1;35m' # Purple
BLDCYN='\e[1;36m' # Cyan
BLDWHT='\e[1;37m' # White
UNKBLK='\e[4;30m' # Black - Underline
UNDRED='\e[4;31m' # Red
UNDGRN='\e[4;32m' # Green
UNDYLW='\e[4;33m' # Yellow
UNDBLU='\e[4;34m' # Blue
UNDPUR='\e[4;35m' # Purple
UNDCYN='\e[4;36m' # Cyan
UNDWHT='\e[4;37m' # White
BAKBLK='\e[40m'   # Black - Background
BAKRED='\e[41m'   # Red
BAKGRN='\e[42m'   # Green
BAKYLW='\e[43m'   # Yellow
BAKBLU='\e[44m'   # Blue
BAKPUR='\e[45m'   # Purple
BAKCYN='\e[46m'   # Cyan
BAKWHT='\e[47m'   # White
TXTRST='\e[0m'    # Text Reset

################################################################################
# UTILITY ACTIONS
################################################################################
horizontal_line() {
    printf "%$(tput cols)s\n" | tr ' ' '-'

    return $?
}

print_header() {
    echo -e "\n$BLDWHT$1$TXTRST"
    horizontal_line

    return $?
}

print_subheader() {
    echo -e "$BLDBLK>>> $1$TXTRST"

    return $?
}

call_subroutines() {
    SUBROUTINES=$(egrep -r "$1" $CURRENT_PATH/modules/ | cut -d: -f2 | sed -r "s/\(\).*//")
    for SUBROUTINE in $SUBROUTINES; do
        echo -en $UNDYLW$SUBROUTINE$TXTRST
        NUM_SPC=$(( $(tput cols) - ${#SUBROUTINE} - 8 ))
        printf "%${NUM_SPC}s"

        echo
        $SUBROUTINE 2>&1
        STATUS=$?
        #RES=$($SUBROUTINE 2>&1)
        #STATUS=0
        #if [ -f /tmp/status.out ]; then
        #    STATUS=$(cat /tmp/status.out)
        #    rm /tmp/status.out
        #fi

        #print_status $STATUS $RES
    done

    return $STATUS
}

handle_errors() {
    # http://fvue.nl/wiki/Bash:_Error_handling
    echo -n "$1" > /tmp/status.out

    if [ $STOP_ON_ERROR -eq 1 -a $1 -gt 0 ]; then
        horizontal_line
        echo -e "${BLDRED}Exit with code: $1$TXTRST"
        horizontal_line
        exit $1
    fi

    return $?
}

print_status() {
    if [ "$1" == "0" ]; then
        echo -e "[$BLDGRN  OK  $TXTRST]"
        return 0;
    fi

    echo -e "[$BLDRED FAIL $TXTRST]"

    if [ $SILENT -eq 0 ]; then
        OLDIFS=$IFS
        IFS=$'\n'
        for LINE in $RES; do
            echo $LINE
        done
        IFS=$OLDIFS
        echo
    fi

    if [ $STOP_ON_ERROR -eq 1 ]; then
        exit $1
    fi

    return $1
}

################################################################################
# MAIN ACTIONS
################################################################################
all() {
    test
    sca
    docs

    return $?
}

config() {
    print_header "CONFIGURE THE ENVIRONMENT"

    if [ -n "$2" ]; then
        SUBROUTINE="config_$2"
        EXISTS=$(declare -f "$SUBROUTINE" | wc -l)
        if [ $EXISTS -gt 0 ]; then
            $SUBROUTINE
        fi
    else
        call_subroutines "^config_"
    fi

    return $?
}

docs() {
    print_header "GENERATE THE DOCUMENTATION"

    if [ -n "$2" ]; then
        SUBROUTINE="doc_$2"
        EXISTS=$(declare -f "$SUBROUTINE" | wc -l)
        if [ $EXISTS -gt 0 ]; then
            $SUBROUTINE
        fi
    else
        call_subroutines "^doc_"
    fi

    return $?
}

init() {
    print_header "INITIALISE THE ENVIRONMENT"
    git submodule init
    git submodule update
    export COMPOSER_VENDOR_DIR=lib/vendor
    curl -s http://getcomposer.org/installer | php
    php composer.phar install
    mongo localhost/curriculum $CURRENT_PATH/../../db/mongo-curriculum.js

    return $?
}

install() {
    print_header "INSTALL THE ENVIRONMENT"

    if [ -n "$2" ]; then
        SUBROUTINE="install_$2"
        EXISTS=$(declare -f "$SUBROUTINE" | wc -l)
        if [ $EXISTS -gt 0 ]; then
            $SUBROUTINE
        fi
    else
        call_subroutines "^install_"
    fi

    return $?
}

run() {
    if [ -n "$2" ]; then
        SUBROUTINE="run_$2"
        EXISTS=$(declare -f "$SUBROUTINE" | wc -l)
        if [ $EXISTS -gt 0 ]; then
            $SUBROUTINE || handle_errors $?
        fi
    else
        print_header "RUN THE SCRIPTS"
        call_subroutines "^run_"
    fi

    return $?
}

sca() {
    print_header "ANALISE THE CODE"

    if [ -n "$2" ]; then
        SUBROUTINE="sca_$2"
        EXISTS=$(declare -f "$SUBROUTINE" | wc -l)
        if [ $EXISTS -gt 0 ]; then
            $SUBROUTINE
        fi
    else
        call_subroutines "^sca_"
    fi

    return $?
}

test() {
    print_header "RUN THE TESTS"

    if [ -n "$2" ]; then
        SUBROUTINE="test_$2"
        EXISTS=$(declare -f "$SUBROUTINE" | wc -l)
        if [ $EXISTS -gt 0 ]; then
            $SUBROUTINE
        fi
    else
        call_subroutines "^test_"
    fi

    return $?
}

help() {

    echo
    echo -e "${BLDWHT}USAGE:$TXTRST"
    echo -e "$0 [${TXTPUR}OPTIONS$TXTRST] ${TXTCYN}ACTION$TXTRST\n"
    echo -e "${BLDWHT}Available options:$TXTRST"
    echo -e "    $TXTPUR-s$TXTRST                Stop the execution on error"
    echo -e "    $TXTPUR-q$TXTRST                Quiet mode\n"
    echo -e "${BLDWHT}Available actions:$TXTRST"
    echo -e "    ${TXTCYN}all$TXTRST                  Simply call the following actions: test, sca, docs."
    echo -e "    ${TXTCYN}config$TXTRST [${TXTBLU}subaction${TXTRST}]   Configure the environment."
    SUBROUTINES=$(egrep -r "^config_" $CURRENT_PATH/modules/ | cut -d: -f2 | sed -r "s/\(\).*/,/" | sed -r "s/config_//"  | tr '\n' ' ' | sed -r "s/, $//")
    echo -en "             ${TXTYLW}Subactions${TXTRST}: "
    echo "$SUBROUTINES." | fold -sw 55 | sed ':a;N;$!ba;s/\n/\n                         /g'
    echo -e "    ${TXTCYN}deploy$TXTRST [${TXTBLU}subaction${TXTRST}]   Script to deploy the applications."
    SUBROUTINES=$(egrep -r "^deploy_" $CURRENT_PATH/modules/ | cut -d: -f2 | sed -r "s/\(\).*/,/" | sed -r "s/deploy_//" | sed -r "s/,/,/"  | tr '\n' ' ' | sed -r "s/, $//")
    echo -en "             ${TXTYLW}Subactions${TXTRST}: "
    echo "$SUBROUTINES." | fold -sw 55 | sed ':a;N;$!ba;s/\n/\n                         /g'
    echo -e "    ${TXTCYN}docs$TXTRST [${TXTBLU}subaction${TXTRST}]     Generate the documentation."
    SUBROUTINES=$(egrep -r "^doc_" $CURRENT_PATH/modules/ | cut -d: -f2 | sed -r "s/\(\).*/,/" | sed -r "s/doc_//"  | tr '\n' ' ' | sed -r "s/, $//")
    echo -en "             ${TXTYLW}Subactions${TXTRST}: "
    echo "$SUBROUTINES." | fold -sw 55 | sed ':a;N;$!ba;s/\n/\n                         /g'
    echo -e "    ${TXTCYN}help$TXTRST                 The help."
    echo -e "    ${TXTCYN}init$TXTRST                 Initialise the environment."
    echo -e "    ${TXTCYN}install$TXTRST [${TXTBLU}subaction${TXTRST}]  Install all the dependencies."
    SUBROUTINES=$(egrep -r "^install_" $CURRENT_PATH/modules/ | cut -d: -f2 | sed -r "s/\(\).*/,/" | sed -r "s/install_//"  | tr '\n' ' ' | sed -r "s/, $//")
    echo -en "             ${TXTYLW}Subactions${TXTRST}: "
    echo "$SUBROUTINES." | fold -sw 55 | sed ':a;N;$!ba;s/\n/\n                         /g'
    echo -e "    ${TXTCYN}run$TXTRST [${TXTBLU}script${TXTRST}]         Launch multiple scripts."
    echo -e "    ${TXTCYN}sca$TXTRST [${TXTBLU}subaction${TXTRST}]      Analise the code."
    SUBROUTINES=$(egrep -r "^sca_" $CURRENT_PATH/modules/ | cut -d: -f2 | sed -r "s/\(\).*/,/" | sed -r "s/sca_//"  | tr '\n' ' ' | sed -r "s/, $//")
    echo -en "             ${TXTYLW}Subactions${TXTRST}: "
    echo "$SUBROUTINES." | fold -sw 55 | sed ':a;N;$!ba;s/\n/\n                         /g'
    echo -e "    ${TXTCYN}test$TXTRST [${TXTBLU}subaction${TXTRST}]     Test the code."
    SUBROUTINES=$(egrep -r "^test_" $CURRENT_PATH/modules/ | cut -d: -f2 | sed -r "s/\(\).*/,/" | sed -r "s/test_//"  | tr '\n' ' ' | sed -r "s/, $//")
    echo -en "             ${TXTYLW}Subactions${TXTRST}: "
    echo "$SUBROUTINES." | fold -sw 55 | sed ':a;N;$!ba;s/\n/\n                         /g'

    return $?
}
