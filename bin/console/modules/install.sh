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
    sudo pear channel-discover $1 || handle_errors $?

    return $?
}

install_gitflow() {
    print_subheader "INSTALLING GIT FLOW"
    git clone --recursive git://github.com/nvie/gitflow.git || handle_errors $?
    sudo make install || handle_errors $?

    return $?
}

install_gitextras() {
    print_subheader "INSTALLING GIT EXTRAS"
    curl https://raw.github.com/visionmedia/git-extras/master/bin/git-extras | INSTALL=y sh || handle_errors $?

    return $?
}

install_php() {
    print_subheader "INSTALLING PHP"
    #TODO: FIXME
    echo "Please run manually this commands:"
    echo "sudo add-apt-repository ppa:ondrej/php5"
    echo "sudo apt-get update"
    echo "sudo apt-get upgrade"
    echo "sudo apt-get dist-upgrade"

    return 1
}

install_imagick() {
    print_subheader "INSTALLING IMAGICK"
    #TODO: FIXME
    echo "Please run manually this commands:"
    echo "sudo pecl install imagick"

    return 1
}

install_phpunit() {
    print_subheader "INSTALLING PHPUNIT"
    pear_add_channel "pear.phpunit.de"
    sudo pear install --alldeps phpunit/PHPUnit || handle_errors $?

    return $?
}

install_phpcb() {
    print_subheader "INSTALLING PHP_CODE_BROWSER"
    pear_add_channel "pear.phpunit.de"
    sudo pear install --alldeps phpunit/PHP_CodeBrowser || handle_errors $?

    return $?
}

install_phpcc() {
    print_subheader "INSTALLING PHP_CODE_COVERAGE"
    pear_add_channel "pear.phpunit.de"
    sudo pear install --alldeps phpunit/PHP_CodeCoverage || handle_errors $?

    return $?
}

install_phpcov() {
    print_subheader "INSTALLING PHPCOV"
    pear_add_channel "pear.phpunit.de"
    sudo pear install --alldeps phpunit/phpcov || handle_errors $?

    return $?
}

install_phpcpd() {
    print_subheader "INSTALLING PHPCPD"
    pear_add_channel "pear.phpunit.de"
    sudo pear install --alldeps phpunit/phpcpd || handle_errors $?

    return $?
}

install_phploc() {
    print_subheader "INSTALLING PHPLOC"
    pear_add_channel "pear.phpunit.de"
    sudo pear install --alldeps phpunit/phploc || handle_errors $?

    return $?
}

install_phpdoc2() {
    print_subheader "INSTALLING PHPDOCUMENTOR2"
    pear_add_channel "pear.phpdoc.org"
    sudo pear install --alldeps phpdoc/phpDocumentor-alpha || handle_errors $?
    sudo apt-get install graphviz || handle_errors $?

    return $?
}

install_pdepend() {
    print_subheader "INSTALLING PHP_DEPEND"
    pear_add_channel "pear.pdepend.org"
    sudo pear install --alldeps pdepend/PHP_Depend-beta || handle_errors $?

    return $?
}

install_phpmd() {
    print_subheader "INSTALLING PHPMD"
    pear_add_channel "pear.phpmd.org"
    sudo pear install --alldeps phpmd/PHP_PMD || handle_errors $?

    return $?
}

install_phpcs() {
    print_subheader "INSTALLING PHP_CodeSniffer"
    sudo pear install --alldeps PHP_CodeSniffer-1.3.2 || handle_errors $?

    return $?
}

install_phpmongo() {
    print_subheader "INSTALLING PHP MONGODB"
    sudo pecl install mongo || handle_errors $?

    return $?
}

install_perl_modules() {
    print_subheader "INSTALLING PERL MODULES"
    sudo cpan install Data::Dumper || handle_errors $?
    sudo cpan install Date::Format || handle_errors $?
    sudo cpan install Devel::Cover || handle_errors $?
    sudo cpan install Digest::MD5 || handle_errors $?
    sudo cpan install File::Basename || handle_errors $?
    sudo cpan install File::Spec || handle_errors $?
    sudo cpan install LWP || handle_errors $?
    sudo cpan install POSIX || handle_errors $?
    sudo cpan install Pod::Coverage || handle_errors $?
    sudo cpan install Template || handle_errors $?
    sudo cpan install Test::More || handle_errors $?
    sudo cpan install XML::Simple || handle_errors $?
    cd /tmp/
    svn co http://guest@perlcritic.tigris.org/svn/perlcritic/trunk/distributions/Perl-Critic/ --password guest || handle_errors $?
    cd Perl-Critic
    perl Makefile.PL || handle_errors $?
    make || handle_errors $?
    make test || handle_errors $?
    sudo make install || handle_errors $?

    return $?
}

install_pychecker() {
    print_subheader "INSTALLING PYCHECKER"
    sudo apt-get install pychecker || handle_errors $?

    return $?
}

install_pylint() {
    print_subheader "INSTALLING PYLINT"
    sudo apt-get install pylint || handle_errors $?

    return $?
}

install_pep8() {
    print_subheader "INSTALLING PEP8"
    sudo apt-get install pep8 || handle_errors $?

    return $?
}

install_capistrano() {
    print_subheader "INSTALLING CAPISTRANO"
    sudo apt-get install gem || handle_errors $?
    sudo gem install capistrano || handle_errors $?
    sudo gem install capistrano-ext || handle_errors $?

    return $?
}
