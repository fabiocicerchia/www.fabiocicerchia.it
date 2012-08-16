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
# INSTALL ACTIONS
################################################################################

pear_add_channel() {
    sudo pear -q channel-discover $1 || handle_errors $?

    return $?
}

install_gitflow() {
    print_subheader "INSTALLING GIT FLOW"
    git clone -q --recursive git://github.com/nvie/gitflow.git /tmp/gitflow || handle_errors $?
    cd /tmp/gitflow || handle_errors $?
    sudo make install || handle_errors $?

    return $?
}

install_gitextras() {
    print_subheader "INSTALLING GIT EXTRAS"
    git clone -q --recursive git://github.com/visionmedia/git-extras.git /tmp/git-extras || handle_errors $?
    cd /tmp/git-extras || handle_errors $?
    sudo make install || handle_errors $?

    return $?
}

install_php() {
    print_subheader "INSTALLING PHP"
    if [ -z "$TRAVIS_CI" ]; then
        sudo add-apt-repository ppa:ondrej/php5
        sudo apt-get -q update
        sudo apt-get -q upgrade
        sudo apt-get -q dist-upgrade
    else
        echo "SKIPPED"
    fi

    return 1
}

install_mongo() {
    print_subheader "INSTALLING MONGODB"
    if [ -z "$TRAVIS_CI" ]; then
        sudo apt-get -q install mongodb || handle_errors $?
    else
        echo "SKIPPED"
    fi

    return $?
}

install_imagick() {
    print_subheader "INSTALLING IMAGICK"
    sudo apt-get -q install php5-imagick || handle_errors $?

    return $?
}

install_phpunit() {
    print_subheader "INSTALLING PHPUNIT"
    pear_add_channel "pear.phpunit.de"
    sudo pear -q install --alldeps phpunit/PHPUnit || handle_errors $?

    return $?
}

install_phpcb() {
    print_subheader "INSTALLING PHP_CODE_BROWSER"
    pear_add_channel "pear.phpunit.de"

    if [ -z "$TRAVIS_CI" ]; then
        sudo pear -q install --alldeps phpunit/PHP_CodeBrowser || handle_errors $?
    else
        echo "SKIPPED"
    fi

    return $?
}

install_phpcc() {
    print_subheader "INSTALLING PHP_CODE_COVERAGE"
    pear_add_channel "pear.phpunit.de"
    sudo pear -q install --alldeps phpunit/PHP_CodeCoverage || handle_errors $?

    return $?
}

install_phpcov() {
    print_subheader "INSTALLING PHPCOV"
    pear_add_channel "pear.phpunit.de"
    sudo pear -q install --alldeps phpunit/phpcov || handle_errors $?

    return $?
}

install_phpcpd() {
    print_subheader "INSTALLING PHPCPD"
    pear_add_channel "pear.phpunit.de"
    sudo pear -q install --alldeps phpunit/phpcpd || handle_errors $?

    return $?
}

install_phploc() {
    print_subheader "INSTALLING PHPLOC"
    pear_add_channel "pear.phpunit.de"
    sudo pear -q install --alldeps phpunit/phploc || handle_errors $?

    return $?
}

install_phpdoc2() {
    print_subheader "INSTALLING PHPDOCUMENTOR2"
    pear_add_channel "pear.phpdoc.org"
    sudo pear -q install --alldeps phpdoc/phpDocumentor-alpha || handle_errors $?
    sudo apt-get -q install graphviz || handle_errors $?

    return $?
}

install_pdepend() {
    print_subheader "INSTALLING PHP_DEPEND"
    pear_add_channel "pear.pdepend.org"

    if [ -z "$TRAVIS_CI" ]; then
        sudo pear -q install --alldeps pdepend/PHP_Depend-beta || handle_errors $?
    else
        echo "SKIPPED"
    fi

    return $?
}

install_phpmd() {
    print_subheader "INSTALLING PHPMD"
    pear_add_channel "pear.phpmd.org"

    if [ -z "$TRAVIS_CI" ]; then
        sudo pear -q install --alldeps phpmd/PHP_PMD || handle_errors $?
    else
        echo "SKIPPED"
    fi

    return $?
}

install_phpcs() {
    print_subheader "INSTALLING PHP_CodeSniffer"
    sudo pear -q install --alldeps PHP_CodeSniffer-1.3.2 || handle_errors $?

    return $?
}

install_phpmongo() {
    print_subheader "INSTALLING PHP MONGODB"
    sudo pecl -q install mongo || handle_errors $?

    return $?
}

install_perl_modules() {
    print_subheader "INSTALLING PERL MODULES"
    sudo cpanm -n --installdeps install Data::Dumper || handle_errors $?
    sudo cpanm -n --installdeps install Date::Format || handle_errors $?
    sudo cpanm -n --installdeps install Date::Manip || handle_errors $?
    sudo cpanm -n --installdeps install Devel::Cover || handle_errors $?
    sudo cpanm -n --installdeps install Digest::MD5 || handle_errors $?
    sudo cpanm -n --installdeps install File::Basename || handle_errors $?
    sudo cpanm -n --installdeps install File::Spec || handle_errors $?
    sudo cpanm -n --installdeps install Locale::TextDomain || handle_errors $?
    sudo cpanm -n --installdeps install LWP || handle_errors $?
    sudo cpanm -n --installdeps install POSIX || handle_errors $?
    sudo cpanm -n --installdeps install Perl::Critic || handle_errors $?
    sudo cpanm -n --installdeps install Pod::Coverage || handle_errors $?
    sudo cpanm -n --installdeps install Template || handle_errors $?
    sudo cpanm -n --installdeps install Test::More || handle_errors $?
    sudo cpanm -n --installdeps install XML::Simple || handle_errors $?
    sudo cpanm -n install Data::Dumper || handle_errors $?
    sudo cpanm -n install Date::Format || handle_errors $?
    sudo cpanm -n install Date::Manip || handle_errors $?
    sudo cpanm -n install Devel::Cover || handle_errors $?
    sudo cpanm -n install Digest::MD5 || handle_errors $?
    sudo cpanm -n install File::Basename || handle_errors $?
    sudo cpanm -n install File::Spec || handle_errors $?
    sudo cpanm -n install Locale::TextDomain || handle_errors $?
    sudo cpanm -n install LWP || handle_errors $?
    sudo cpanm -n install POSIX || handle_errors $?
    sudo cpanm -n install Perl::Critic || handle_errors $?
    sudo cpanm -n install Pod::Coverage || handle_errors $?
    sudo cpanm -n install Template || handle_errors $?
    sudo cpanm -n install Test::More || handle_errors $?
    sudo cpanm -n install XML::Simple || handle_errors $?

    return $?
}

install_pychecker() {
    print_subheader "INSTALLING PYCHECKER"
    sudo apt-get -q install pychecker || handle_errors $?

    return $?
}

install_pylint() {
    print_subheader "INSTALLING PYLINT"
    sudo apt-get -q install pylint || handle_errors $?

    return $?
}

install_pep8() {
    print_subheader "INSTALLING PEP8"
    sudo apt-get -q install pep8 || handle_errors $?

    return $?
}

install_epydoc() {
    print_subheader "INSTALLING EPYDOC"
    sudo apt-get -q install python-epydoc || handle_errors $?

    return $?
}

install_capistrano() {
    print_subheader "INSTALLING CAPISTRANO"
    sudo apt-get -q install gem || handle_errors $?
    sudo gem install -q capistrano || handle_errors $?
    sudo gem install -q capistrano-ext || handle_errors $?

    return $?
}
