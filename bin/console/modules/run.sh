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
# RUN ACTIONS
################################################################################

run_check_accessibility() {
    print_subheader "RUNNING CHECK ACCESSIBILITY"
    python $SCRIPT_APP_SOURCEDIR/check_accessibility.py || handle_errors $?

    return $?
}

run_check_validation() {
    print_subheader "RUNNING CHECK VALIDATION"
    python $SCRIPT_APP_SOURCEDIR/check_validation.py || handle_errors $?

    return $?
}

run_todo() {
    DIR=$2

    for i in `seq 80`; do echo -n "="; done;
    echo -e "\nTODO LIST"
    for i in `seq 80`; do echo -n "="; done
    echo -en "\n"

    for FILE in `find $DIR -name "*.*"`; do
        OLDIFS=$IFS
        IFS=$'\n'

        RES=`egrep -rni "TODO" $FILE`
        RES=`echo "$RES" | sed -r "s/([0-9]+):.*TODO[^0-9a-z]*(.)?/\1: \U\2/i"`
        RES=`echo "$RES" | sed -r "s/([0-9]+): *(.+)/\2 (line \1)/"`

        if [ "$RES" != "" ]; then
            echo -en "\nFile: $FILE\n"
            for i in `seq 80`; do echo -n "-"; done

            for MATCH in $RES; do
                LINE=`echo "$MATCH" | sed -r "s/^  /<No Message> /"`
                LINE=`echo -n "  - $LINE" | fold -sw 80 | sed -r "s/^/    /"`
                LINE=`echo "$LINE" | sed -r "s/^      - /  - /"`

                echo -ne "\n$LINE"
            done

            echo
        fi

        IFS=$OLDIFS
    done
}

run_changelog() {
    for i in `seq 80`; do echo -n "="; done;
    echo -e "\nCHANGELOG"
    for i in `seq 80`; do echo -n "="; done
    echo -en "\n"

    OLDIFS=$IFS
    IFS=$'\n'
    HISTORY=`git log --format="%cd [%h] %s (by %cn <%ce>)" --date=short`
    DATE=""
    for LINE in $HISTORY; do
        NEW_DATE=`echo "$LINE" | cut -d " " -f 1`
        if [ "$NEW_DATE" != "$DATE" ]; then
            echo -e "\n$NEW_DATE"
        fi

        LINE=${LINE/$NEW_DATE /}
        echo " $LINE" | fold -sw 80 | sed -r "s/^/              /" | sed -r "s/^               /    /"

        if [[ "$LINE" =~ "#" ]]; then
            IFS=$' '
            for TOKEN in $LINE; do
                MATCH=`echo "$TOKEN" | grep "#"`
                if [ "$MATCH" != "" ]; then
                    URL="https://github.com/fabiocicerchia/fabiocicerchia.github.com/issues/${MATCH/\#/}"
                    TITLE=`curl $URL 2>&1 | grep '<h2 class="content-title">' | sed -r "s/.*>(.*)<.*/\1/"`
                    echo " Ref: $MATCH $TITLE" | fold -sw 68 | sed -r "s/^/              /" | sed -r "s/^               /              /"
                fi
            done
            IFS=$'\n'
        fi

        DATE=$NEW_DATE
    done
    IFS=$OLDIFS
}
