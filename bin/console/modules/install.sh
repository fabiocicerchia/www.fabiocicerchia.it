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

# {{{ pear_add_channel() -------------------------------------------------------
pear_add_channel() {
    sudo pear -q channel-discover $1

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_gitflow() --------------------------------------------------------
install_gitflow() {
    print_subheader "INSTALLING GIT FLOW"

    git clone -q --recursive git://github.com/nvie/gitflow.git /tmp/gitflow
    cd /tmp/gitflow
    sudo make install

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_gitextras() ------------------------------------------------------
install_gitextras() {
    print_subheader "INSTALLING GIT EXTRAS"

    git clone -q --recursive git://github.com/visionmedia/git-extras.git \
        /tmp/git-extras
    cd /tmp/git-extras
    sudo make install

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_php() ------------------------------------------------------------
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
# }}} --------------------------------------------------------------------------

# {{{ install_mongo() ----------------------------------------------------------
install_mongo() {
    print_subheader "INSTALLING MONGODB"

    if [ -z "$TRAVIS_CI" ]; then
        sudo apt-get -q install mongodb
    else
        echo "SKIPPED"
    fi

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_imagick() --------------------------------------------------------
install_imagick() {
    print_subheader "INSTALLING IMAGICK"

    sudo apt-get -q install php5-imagick

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_phpunit() --------------------------------------------------------
install_phpunit() {
    print_subheader "INSTALLING PHPUNIT"

    pear_add_channel "pear.phpunit.de"
    sudo pear -q install --alldeps phpunit/PHPUnit

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_phpcb() ----------------------------------------------------------
install_phpcb() {
    print_subheader "INSTALLING PHP_CODE_BROWSER"

    if [ -z "$TRAVIS_CI" ]; then
        pear_add_channel "pear.phpunit.de"
        sudo pear -q install --alldeps phpunit/PHP_CodeBrowser
    else
        echo "SKIPPED"
    fi

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_phpcc() ----------------------------------------------------------
install_phpcc() {
    print_subheader "INSTALLING PHP_CODE_COVERAGE"

    pear_add_channel "pear.phpunit.de"
    sudo pear -q install --alldeps phpunit/PHP_CodeCoverage

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_phpcov() ---------------------------------------------------------
install_phpcov() {
    print_subheader "INSTALLING PHPCOV"

    pear_add_channel "pear.phpunit.de"
    sudo pear -q install --alldeps phpunit/phpcov

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_phpcpd() ---------------------------------------------------------
install_phpcpd() {
    print_subheader "INSTALLING PHPCPD"

    pear_add_channel "pear.phpunit.de"
    sudo pear -q install --alldeps phpunit/phpcpd

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_phploc() ---------------------------------------------------------
install_phploc() {
    print_subheader "INSTALLING PHPLOC"

    pear_add_channel "pear.phpunit.de"
    sudo pear -q install --alldeps phpunit/phploc

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_phpdoc2() --------------------------------------------------------
install_phpdoc2() {
    print_subheader "INSTALLING PHPDOCUMENTOR2"

    pear_add_channel "pear.phpdoc.org"
    sudo pear -q install --alldeps phpdoc/phpDocumentor-alpha
    sudo apt-get -q install graphviz

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_pdepend() --------------------------------------------------------
install_pdepend() {
    print_subheader "INSTALLING PHP_DEPEND"

    if [ -z "$TRAVIS_CI" ]; then
        pear_add_channel "pear.pdepend.org"
        sudo pear -q install --alldeps pdepend/PHP_Depend-beta
    else
        echo "SKIPPED"
    fi

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_phpmd() ----------------------------------------------------------
install_phpmd() {
    print_subheader "INSTALLING PHPMD"

    if [ -z "$TRAVIS_CI" ]; then
        pear_add_channel "pear.phpmd.org"
        sudo pear -q install --alldeps phpmd/PHP_PMD
    else
        echo "SKIPPED"
    fi

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_phpcs() ----------------------------------------------------------
install_phpcs() {
    print_subheader "INSTALLING PHP_CodeSniffer"

    sudo pear -q install --alldeps PHP_CodeSniffer-1.3.2

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_phpmongo() -------------------------------------------------------
install_phpmongo() {
    print_subheader "INSTALLING PHP MONGODB"

    sudo pecl -q install mongo

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_perl_modules() ---------------------------------------------------
install_perl_modules() {
    print_subheader "INSTALLING PERL MODULES"

    sudo cpanm -n --installdeps install Data::Dumper
    sudo cpanm -n --installdeps install Date::Format
    sudo cpanm -n --installdeps install Date::Manip
    sudo cpanm -n --installdeps install Devel::Cover
    sudo cpanm -n --installdeps install Digest::MD5
    sudo cpanm -n --installdeps install File::Basename
    sudo cpanm -n --installdeps install File::Spec
    sudo cpanm -n --installdeps install Locale::TextDomain
    sudo cpanm -n --installdeps install LWP
    sudo cpanm -n --installdeps install Perl::Critic
    sudo cpanm -n --installdeps install Pod::Coverage
    sudo cpanm -n --installdeps install POSIX
    sudo cpanm -n --installdeps install Readonly
    sudo cpanm -n --installdeps install Template
    sudo cpanm -n --installdeps install Test::More
    sudo cpanm -n --installdeps install XML::Simple
    sudo cpanm -n install Data::Dumper
    sudo cpanm -n install Date::Format
    sudo cpanm -n install Date::Manip
    sudo cpanm -n install Devel::Cover
    sudo cpanm -n install Digest::MD5
    sudo cpanm -n install File::Basename
    sudo cpanm -n install File::Spec
    sudo cpanm -n install Locale::TextDomain
    sudo cpanm -n install LWP
    sudo cpanm -n install Perl::Critic
    sudo cpanm -n install Pod::Coverage
    sudo cpanm -n install POSIX
    sudo cpanm -n install Readonly
    sudo cpanm -n install Template
    sudo cpanm -n install Test::More
    sudo cpanm -n install XML::Simple

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_pychecker() ------------------------------------------------------
install_pychecker() {
    print_subheader "INSTALLING PYCHECKER"

    sudo apt-get -q install pychecker

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_pylint() ---------------------------------------------------------
install_pylint() {
    print_subheader "INSTALLING PYLINT"

    sudo apt-get -q install pylint

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_pep8() -----------------------------------------------------------
install_pep8() {
    print_subheader "INSTALLING PEP8"

    sudo apt-get -q install pep8

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_epydoc() ---------------------------------------------------------
install_epydoc() {
    print_subheader "INSTALLING EPYDOC"

    sudo apt-get -q install python-epydoc

    return $?
}
# }}} --------------------------------------------------------------------------

# {{{ install_capistrano() -----------------------------------------------------
install_capistrano() {
    print_subheader "INSTALLING CAPISTRANO"

    sudo apt-get -q install gem
    sudo gem install -q capistrano
    sudo gem install -q capistrano-ext

    return $?
}
# }}} --------------------------------------------------------------------------