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
# RUN ACTIONS
################################################################################

# {{{ run_check_accessibility() ------------------------------------------------
run_check_accessibility() {
    print_subheader "RUNNING CHECK ACCESSIBILITY"

    python $SCRIPT_APP_SOURCEDIR/check_accessibility.py

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ run_check_validation() ---------------------------------------------------
run_check_validation() {
    print_subheader "RUNNING CHECK VALIDATION"

    python $SCRIPT_APP_SOURCEDIR/check_validation.py

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ run_benchmark() ----------------------------------------------------------
run_benchmark() {
    print_subheader "RUNNING BENCHMARK"

    python $SCRIPT_APP_SOURCEDIR/benchmark.py

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ run_todo() ---------------------------------------------------------------
run_todo() {
    print_subheader "GENERATING TODO"

    DIR=$2

    horizontal_line > $ROOTDIR/TODO
    echo "TODO LIST" >> $ROOTDIR/TODO
    horizontal_line >> $ROOTDIR/TODO

    for FILE in $(find $DIR -name "*.*"); do
        OLDIFS=$IFS
        IFS=$'\n'

        RES=$(egrep -rni "TODO" $FILE)
        RES=$(echo "$RES" | sed -r "s/([0-9]+):.*TODO[^0-9a-z]*(.)?/\1: \U\2/i")
        RES=$(echo "$RES" | sed -r "s/([0-9]+):\s*(.+?)\s*/\2 (line \1)/")

        if [ -n "$RES" ]; then
            echo -en "\nFile: $FILE\n" >> $ROOTDIR/TODO
            horizontal_line >> $ROOTDIR/TODO

            for MATCH in $RES; do
                LINE=$(echo "$MATCH" | sed -r "s/^  /<No Message> /")
                LINE=$(echo -n "  - $LINE" | fold -sw 80 | sed -r "s/^/    /")
                LINE=$(echo "$LINE" | sed -r "s/^ {6}- /  - /")

                echo -ne "\n$LINE" >> $ROOTDIR/TODO
            done

            echo >> $ROOTDIR/TODO
        fi

        IFS=$OLDIFS
    done

    echo "done"
}
# }}} --------------------------------------------------------------------------

# {{{ run_changelog() ----------------------------------------------------------
run_changelog() {
    print_subheader "GENERATING CHANGELOG"

    python $ROOTDIR/lib/vendor/git2changelog/git2changelog.py > $ROOTDIR/CHANGELOG

    echo "done"
}
# }}} --------------------------------------------------------------------------

# {{{ _ver_cmp_1() -------------------------------------------------------------
# Compare with one element of version components
_ver_cmp_1() {
  [[ $1 == $2 ]] && return 0
  [[ $1 > $2 ]] && return 1
  [[ $1 < $2 ]] && return 2
  # This should not be happening
  exit 1
}
# }}} --------------------------------------------------------------------------

# {{{ ver_cmp() ----------------------------------------------------------------
ver_cmp() {
  A=${1//./ }
  B=${2//./ }
  i=0
  while (( i < ${#A[@]} )) && (( i < ${#B[@]})); do
    _ver_cmp_1 "${A[i]}" "${B[i]}"
    result=$?
    [[ $result =~ [12] ]] && return $result
    let i++
  done
  # Which has more, then it is the newer version
  _ver_cmp_1 "${#A[i]}" "${#B[i]}"
  return $?
}

# {{{ run_dependencies() -------------------------------------------------------
run_dependencies() {
    print_subheader "CALCULATING DEPENDIENCIES"

    declare -a commands=('cat' 'curl' 'cut' 'dirname' 'egrep' 'find' 'fold' \
            'sed' 'seq' 'wc' 'wget' 'xargs');

    for i in "${commands[@]}"; do
        echo -en "Checking '${TXTCYN}$i${TXTRST}'... "
        EXISTS=$(which $i)
        if [ -n "$EXISTS" ]; then
            echo -e "${TXTGRN}yes${TXTRST}"
        else
            echo -e "${TXTRED}no${TXTRST}"
        fi
    done

    # --------------------------------------------------------------------------

    declare -A versions=(['apache2']='2.2.22' ['cap']='2.12.0', \
            ['git']='1.7.9.5' ['git flow']='0.4.1' ['mongo']='2.0.4' \
            ['php']='5.4' ['perl']='5.14.2' ['python']='2.7');

    for i in "${!versions[@]}"; do
        echo -en "Checking '${TXTCYN}$i v${versions[$i]}${TXTRST}'... "
        EXISTS=$(whereis $i)
        if [ -n "$EXISTS" ]; then
            echo -en "${TXTGRN}yes${TXTRST}"
        else
            echo -en "${TXTRED}no${TXTRST}"
        fi
        PRG=$(whereis $i | cut -d " " -f 2 | head -n 1)
        PIECES=$(echo $i | tr ' ' '\n' | wc -l)

        if [ $PIECES -gt 1 ]; then
            PRG=$(dirname $PRG)"/$i"
        fi
        VERSION=$($PRG --version 2>&1 | \
                egrep "([0-9]+\.)+([0-9]+\.?)+(-?[a-z]+[0-9]*)?" | \
                sed -r "s/.*[^0-9\.](([0-9]+\.)([0-9]+\.?)+(-?[a-z]+[0-9]*)?).*/\1/")
        if [ -z "$VERSION" ]; then
            VERSION=$($PRG -V 2>&1 | \
                    egrep "([0-9]+\.)+([0-9]+\.?)+(-?[a-z]+[0-9]*)?" | \
                    sed -r "s/.*[^0-9\.](([0-9]+\.)([0-9]+\.?)+(-?[a-z]+[0-9]*)?).*/\1/")
        fi
        if [ -z "$VERSION" ]; then
            VERSION=$($PRG version 2>&1 | \
                    egrep "([0-9]+\.)+([0-9]+\.?)+(-?[a-z]+[0-9]*)?" | \
                    sed -r "s/.*[^0-9\.](([0-9]+\.)([0-9]+\.?)+(-?[a-z]+[0-9]*)?).*/\1/")
        fi

        ver_cmp "$VERSION" "${versions[$i]}"
        if [ $? -eq 2 ]; then
            echo -e " ${TXTYLW}but lower version ($VERSION)${TXTRST}"
        else
            echo ""
        fi
    done

    # --------------------------------------------------------------------------

    declare -a modules=('actions' 'cache' 'disk_cache' 'expires' 'headers' \
            'mem_cache' 'php5' 'perl' 'rewrite' 'security2' 'speling');

    APACHE2CTL=$(whereis apache2ctl | cut -d " " -f 2 | head -n 1)
    for i in "${modules[@]}"; do
        echo -en "Checking '${TXTCYN}Apache Module $i${TXTRST}'... "
        EXISTS=$($APACHE2CTL -M 2>&1 | grep "${i}_module")
        if [ -n "$EXISTS" ]; then
            echo -e "${TXTGRN}yes${TXTRST}"
        else
            echo -e "${TXTRED}no${TXTRST}"
        fi
    done

    # --------------------------------------------------------------------------
    # TODO: Check PEAR/PECL.
    echo -en "Checking '${TXTCYN}PHP Depend v1.0.7${TXTRST}'... "
    echo -e "${TXTYLW}TODO${TXTRST}"
    echo -en "Checking '${TXTCYN}PHP Mess Detector v1.3.3${TXTRST}'... "
    echo -e "${TXTYLW}TODO${TXTRST}"
    echo -en "Checking '${TXTCYN}PHP Mongo v1.2.10${TXTRST}'... "
    echo -e "${TXTYLW}TODO${TXTRST}"
    echo -en "Checking '${TXTCYN}PHP XDebug v2.2.0${TXTRST}'... "
    echo -e "${TXTYLW}TODO${TXTRST}"
    echo -en "Checking '${TXTCYN}PHPUnit v3.6.11${TXTRST}'... "
    echo -e "${TXTYLW}TODO${TXTRST}"
    echo -en "Checking '${TXTCYN}PHP_CodeBrowser v1.0.2${TXTRST}'... "
    echo -e "${TXTYLW}TODO${TXTRST}"
    echo -en "Checking '${TXTCYN}PHP_CodeCoverage v1.1.2${TXTRST}'... "
    echo -e "${TXTYLW}TODO${TXTRST}"
    echo -en "Checking '${TXTCYN}PHP_CodeSniffer v1.3.4${TXTRST}'... "
    echo -e "${TXTYLW}TODO${TXTRST}"

    # --------------------------------------------------------------------------

    declare -a modules2=('Data::Dumper' 'Date::Format' 'Devel::Cover' \
            'Digest::MD5' 'File::Basename' 'File::Spec' 'LWP' 'POSIX' \
            'Perl::Critic' 'Pod::Coverage' 'Template' 'Test::More' 'XML::Simple');
    for i in "${modules2[@]}"; do
        echo -en "Checking '${TXTCYN}Perl Module $i${TXTRST}'... "
        EXISTS=$(perl -M$i -e 'print "\$$i::VERSION\n";' 2>&1 | grep "Can't locate")
        if [ -z "$EXISTS" ]; then
            echo -e "${TXTGRN}yes${TXTRST}"
        else
            echo -e "${TXTRED}no${TXTRST}"
        fi
    done

    # --------------------------------------------------------------------------

    declare -a modules3=('future' 'lxml' 're' 'time' 'urllib');
    for i in "${modules3[@]}"; do
        echo -en "Checking '${TXTCYN}Python Module $i${TXTRST}'... "
        EXISTS=$(pip freeze 2>&1 | grep "$i")
        if [ -n "$EXISTS" ]; then
            echo -e "${TXTGRN}yes${TXTRST}"
        else
            echo -e "${TXTRED}no${TXTRST}"
        fi
    done

    # ------------------------------------------------------------------------------

    declare -a commands2=('add-apt-repository' 'apt-get' 'cover' 'cpanminus' \
            'nikto' 'pdepend' 'pear' 'pecl' 'pep8' 'perltidy' 'phpcb' 'phpcov' \
            'phpcpd' 'phpcs' 'phpdoc' 'phploc' 'phpmd' 'phpunit' 'pylint');

    for i in "${commands2[@]}"; do
        echo -en "Checking '${TXTCYN}$i${TXTRST}'... "
        EXISTS=$(which $i)
        if [ -n "$EXISTS" ]; then
            echo -e "${TXTGRN}yes${TXTRST}"
        else
            echo -e "${TXTRED}no${TXTRST}"
        fi
    done
}
# }}} --------------------------------------------------------------------------

# {{{ run_generate_gettext() ---------------------------------------------------
run_generate_gettext() {
    print_subheader "GENERATING GETTEXT"

    CURR_DATE=$(date +%Y-%m-%d\ %H:%M%z)

    echo "#"
    echo "# FABIO CICERCHIA - WEBSITE"
    echo "#"
    echo "# Copyright 2012 - 2013 Fabio Cicerchia."
    echo "#"
    echo "# Permission is hereby  granted, free of charge, to any  person obtaining a copy"
    echo "# of this software and associated  documentation files (the \"Software\"), to deal"
    echo "# in the Software  without restriction, including without  limitation the rights"
    echo "# to  use, copy,  modify, merge,  publish, distribute,  sublicense, and/or  sell"
    echo "# copies  of  the Software,  and  to  permit persons  to  whom  the Software  is"
    echo "# furnished to do so, subject to the following conditions:"
    echo "#"
    echo "# The above copyright notice and this permission notice shall be included in all"
    echo "# copies or substantial portions of the Software."
    echo "#"
    echo "# THE SOFTWARE  IS PROVIDED \"AS  IS\", WITHOUT WARRANTY  OF ANY KIND,  EXPRESS OR"
    echo "# IMPLIED,  INCLUDING BUT  NOT  LIMITED TO  THE  WARRANTIES OF  MERCHANTABILITY,"
    echo "# FITNESS FOR  A PARTICULAR PURPOSE AND  NONINFRINGEMENT. IN NO EVENT  SHALL THE"
    echo "# AUTHORS  OR COPYRIGHT  HOLDERS  BE  LIABLE FOR  ANY  CLAIM,  DAMAGES OR  OTHER"
    echo "# LIABILITY, WHETHER IN AN ACTION OF  CONTRACT, TORT OR OTHERWISE, ARISING FROM,"
    echo "# OUT OF OR IN CONNECTION WITH THE SOFTWARE  OR THE USE OR OTHER DEALINGS IN THE"
    echo "# SOFTWARE."
    echo "#"
    echo ""
    echo "msgid \"\""
    echo "msgstr \"\""
    echo "\"Project-Id-Version: 0.2\\n\""
    echo "\"Report-Msgid-Bugs-To: info@fabiocicerchia.it\\n\""
    echo "\"POT-Creation-Date: $CURR_DATE\\n\""
    echo "\"PO-Revision-Date: $CURR_DATE\\n\""
    echo "\"Last-Translator: Fabio Cicerchia <info@fabiocicerchia.it>\\n\""
    echo "\"Language-Team: LANGUAGE <info@fabiocicerchia.it>\\n\""
    echo "\"Language: \\n\""
    echo "\"MIME-Version: 1.0\\n\""
    echo "\"Content-Type: text/plain; charset=UTF-8\\n\""
    echo "\"Content-Transfer-Encoding: 8bit\\n\""
    echo ""

    OLDIFS=$IFS
    IFS=$'\n'

    LINES=$(egrep -rn "\[% FILTER gettext %\].+\[% END %\]" \
          $SITE_APP_SOURCEDIR/view/ | \
          sed -r "s/(.+):(.+):.*?\[% FILTER gettext %\](.+)\[% END %\].*/\3\t\1:\2/" | sort)
    PREVIOUS_LABEL=''

    for LINE in $LINES; do
        LABEL=$(echo "$LINE" | sed -r "s/\t.+//")

        if [ "$LABEL" != "$PREVIOUS_LABEL" ]; then
            echo "msgid \"$LABEL\""
            echo "msgstr \"\""
            echo ""
        fi

        PREVIOUS_LABEL=$LABEL
    done

    IFS=$OLDIFS

    echo "done"
}
# }}} --------------------------------------------------------------------------

# {{{ run_compile_gettext() ----------------------------------------------------
run_compile_gettext() {
    print_subheader "COMPILING GETTEXT"

    FILES_PO=$(find $SITE_APP_SOURCEDIR/locale -name "*.po" -type f)
    for FILE_PO in $FILES_PO; do
        msgfmt -c $FILE_PO -o ${FILE_PO%.po}.mo
    done

    echo "done"
}
# }}} --------------------------------------------------------------------------

# {{{ run_authors() ------------------------------------------------------------
run_authors() {
    print_subheader "GENERATING AUTHORS"

    git log --pretty="%aN <%aE>" | sort -u > $ROOTDIR/AUTHORS

    echo "done"
}
# }}} --------------------------------------------------------------------------

# {{{ run_nikto() --------------------------------------------------------------
run_nikto() {
    print_subheader "RUNNING NIKTO"

    sudo nikto -update
    nikto -C all -nocache -evasion 1,2,3,4,5,6 -h http://demo.fabiocicerchia.it \
          -o $REPORTDIR/site/logs/nikto.html -Format html -nossl \
          -Tuning 0,1,2,3,4,5,6,7,8,9,a,b,c,x

    echo "done"
}
# }}} --------------------------------------------------------------------------
