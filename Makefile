#
# FABIO CICERCHIA - WEBSITE
# Copyright (C) 2012. All Rights reserved.
#

# SYSTEM COMMANDS
SUDO=sudo

APT=$(SUDO) apt-get
CD=cd
CHMOD=chmod
CP=cp -r
CURL=curl
ECHO=@echo
GIT=git
LN=ln -s
MKDIR=mkdir -p
RM=rm -rf
WGET=wget

# CUSTOM COMMANDS
A2ENMOD=$(SUDO) a2enmod
MSGFMT=msgfmt
PDEPEND=pdepend
PEAR=$(SUDO) pear
PECL=$(SUDO) pecl
PHP=php
PHPCB=phpcb
PHPCPD=phpcpd
PHPCS=phpcs -s -v
PHPDOC=phpdoc
PHPLOC=phploc
PHPMD=phpmd
PHPUNIT=phpunit

# FLAGS
PEAR_INSTALL_FLAGS=--alldeps
SUPPRESS_OUTPUT=>> /dev/null

# DIRECTORIES
CURRENTDIR=.
API_APP_SOURCEDIR=$(CURRENTDIR)/apps/api/
API_LIB_SOURCEDIR=$(CURRENTDIR)/lib/vendor/FabioCicerchia/Api/
API_TEST_SOURCEDIR=$(CURRENTDIR)/test/api/

################################################################################
# GENERAL ACTIONS
################################################################################

all: info test sca

info:
	$(ECHO) "--------------------------------------------------------------------------------"
	$(ECHO) "FABIO CICERCHIA - WEBSITE"
	$(ECHO) "--------------------------------------------------------------------------------"

init-environment:
	$(ECHO) "RUN THE TESTS"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(WGET) http://meyerweb.com/eric/tools/css/reset/reset.css -O web/media/css/reset.css
	$(WGET) http://silex.sensiolabs.org/get/silex.phar -O apps/api/silex.phar
	$(GIT) submodule init
	$(GIT) submodule update
	$(CD) lib/vendor/mongodb
	$(CURL) -s http://getcomposer.org/installer | $(PHP)
	$(PHP) composer.phar install

install-environment: install-php54 install-imagick install-phpunit install-phpcb install-phpcc install-phpcov install-phpcpd install-phploc install-phpdoc2 install-pdepend install-phpmd install-phpcs install-phpmongo

config-environment: config-apache

test:
	$(ECHO) "RUN THE TESTS"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PHPUNIT)

sca: run-phpcs run-phpmd run-phploc run phpcpd run-pdepend run-phpcb

################################################################################
# SPECIFIC ACTIONS
################################################################################

install-php54:
	$(ECHO) "INSTALLING PHP 5.4"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(SUDO) add-apt-repository ppa:ondrej/php5
	$(APT) update
	$(APT) upgrade
	$(APT) dist-upgrade

install-imagick:
	$(ECHO) "INSTALLING IMAGICK"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PECL) install imagick

install-phpunit:
	$(ECHO) "INSTALLING PHPUNIT"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PEAR) channel-discover pear.phpunit.de $(SUPPRESS_OUTPUT)
	$(PEAR) install $(PEAR_INSTALL_FLAGS) phpunit/PHPUnit

install-phpcb:
	$(ECHO) "INSTALLING PHP_CODE_BROWSER"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PEAR) channel-discover pear.phpunit.de $(SUPPRESS_OUTPUT)
	$(PEAR) install $(PEAR_INSTALL_FLAGS) phpunit/PHP_CodeBrowser

install-phpcc:
	$(ECHO) "INSTALLING PHP_CODE_COVERAGE"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PEAR) channel-discover pear.phpunit.de $(SUPPRESS_OUTPUT)
	$(PEAR) install $(PEAR_INSTALL_FLAGS) phpunit/PHP_CodeCoverage

install-phpcov:
	$(ECHO) "INSTALLING PHPCOV"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PEAR) channel-discover pear.phpunit.de $(SUPPRESS_OUTPUT)
	$(PEAR) install $(PEAR_INSTALL_FLAGS) phpunit/phpcov

install-phpcpd:
	$(ECHO) "INSTALLING PHPCPD"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PEAR) channel-discover pear.phpunit.de $(SUPPRESS_OUTPUT)
	$(PEAR) install $(PEAR_INSTALL_FLAGS) phpunit/phpcpd

install-phploc:
	$(ECHO) "INSTALLING PHPLOC"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PEAR) channel-discover pear.phpunit.de $(SUPPRESS_OUTPUT)
	$(PEAR) install $(PEAR_INSTALL_FLAGS) phpunit/phploc

install-phpdoc2:
	$(ECHO) "INSTALLING PHPDOCUMENTOR2"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PEAR) channel-discover pear.phpdoc.org$(SUPPRESS_OUTPUT)
	$(PEAR) install $(PEAR_INSTALL_FLAGS) phpdoc/phpDocumentor-alpha
	$(APT) install graphviz

install-pdepend:
	$(ECHO) "INSTALLING PHP_DEPEND"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PEAR) channel-discover pear.pdepend.org $(SUPPRESS_OUTPUT)
	$(PEAR) install $(PEAR_INSTALL_FLAGS) pdepend/PHP_Depend-beta

install-phpmd:
	$(ECHO) "INSTALLING PHPMD"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PEAR) channel-discover pear.phpmd.org $(SUPPRESS_OUTPUT)
	$(PEAR) install $(PEAR_INSTALL_FLAGS) phpmd/PHP_PMD

install-phpcs:
	$(ECHO) "INSTALLING PHP_CodeSniffer"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PEAR) install $(PEAR_INSTALL_FLAGS) PHP_CodeSniffer-1.3.2

install-phpmongo:
	$(ECHO) "INSTALLING PHP MONGODB"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PECL) install mongo

config-apache:
	$(ECHO) "CONFIGURING APACHE"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(A2ENMOD) speling
	$(A2ENMOD) mod-security
	$(A2ENMOD) actions
	$(A2ENMOD) rewrite
	$(A2ENMOD) perl
	$(A2ENMOD) cache
	$(A2ENMOD) disk_cache
	$(A2ENMOD) mem_cache
	$(A2ENMOD) expires
	$(A2ENMOD) php5

run-phpcs:
	$(ECHO) "RUNNING PHP_CodeSniffer"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PHPCS) --standard="$(CURRENTDIR)/lib/PHPCS/ruleset.xml" "$(API_APP_SOURCEDIR)"

run-phpmd:
	$(ECHO) "RUNNING PHPMD"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PHPMD) "$(API_APP_SOURCEDIR)" xml codesize,design,naming,unusedcode --reportfile "$(REPORTDIR)/api/logs/phpmd_app.xml"
	$(PHPMD) "$(API_LIB_SOURCEDIR)" xml codesize,design,naming,unusedcode --reportfile "$(REPORTDIR)/api/logs/phpmd_lib.xml"
	$(PHPMD) "$(API_TEST_SOURCEDIR)" xml codesize,design,naming,unusedcode --reportfile "$(REPORTDIR)/api/logs/phpmd_test.xml"

run-phploc:
	$(ECHO) "RUNNING PHPLOC"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PHPLOC) --log-xml "$(REPORTDIR)/api/logs/phploc_app.xml" "$(API_APP_SOURCEDIR)"
	$(PHPLOC) --log-xml "$(REPORTDIR)/api/logs/phploc_lib.xml" "$(API_LIB_SOURCEDIR)"
	$(PHPLOC) --log-xml "$(REPORTDIR)/api/logs/phploc_test.xml" "$(API_TEST_SOURCEDIR)"

run-phpcpd:
	$(ECHO) "RUNNING PHPCPD"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PHPCPD) --log-pmd "$(REPORTDIR)/api/logs/phpcpd_app.xml" "$(API_APP_SOURCEDIR)" > "$(REPORTDIR)/api/logs/duplications_app.txt"
	$(PHPCPD) --log-pmd "$(REPORTDIR)/api/logs/phpcpd_lib.xml" "$(API_LIB_SOURCEDIR)" > "$(REPORTDIR)/api/logs/duplications_lib.txt"
	$(PHPCPD) --log-pmd "$(REPORTDIR)/api/logs/phpcpd_test.xml" "$(API_TEST_SOURCEDIR)" > "$(REPORTDIR)/api/logs/duplications_test.txt"

run-pdepend:
	$(ECHO) "RUNNING PHP_DEPEND"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PDEPEND) --jdepend-chart="$(REPORTDIR)/api/pdepend-chart_app.svg" --overview-pyramid="$(REPORTDIR)/api/pdepend-pyramid_app.svg" --jdepend-xml="$(REPORTDIR)/api/log/pdepend_app.xml" "$(API_APP_SOURCEDIR)"
	$(PDEPEND) --jdepend-chart="$(REPORTDIR)/api/pdepend-chart_lib.svg" --overview-pyramid="$(REPORTDIR)/api/pdepend-pyramid_lib.svg" --jdepend-xml="$(REPORTDIR)/api/log/pdepend_lib.xml" "$(API_LIB_SOURCEDIR)"
	$(PDEPEND) --jdepend-chart="$(REPORTDIR)/api/pdepend-chart_test.svg" --overview-pyramid="$(REPORTDIR)/api/pdepend-pyramid_test.svg" --jdepend-xml="$(REPORTDIR)/api/log/pdepend_test.xml" "$(API_TEST_SOURCEDIR)"

run-phpcb:
	$(ECHO) "RUNNING PHP_CODE_BROWSER"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PHPCB) --log="$(REPORTDIR)/api/logs/" --source="$(API_APP_SOURCEDIR)" --output="$(REPORTDIR)/api/code_browser/app"
	$(PHPCB) --log="$(REPORTDIR)/api/logs/" --source="$(API_LIB_SOURCEDIR)" --output="$(REPORTDIR)/api/code_browser/lib"
	$(PHPCB) --log="$(REPORTDIR)/api/logs/" --source="$(API_TEST_SOURCEDIR)" --output="$(REPORTDIR)/api/code_browser/test"

run-phpdoc:
	$(ECHO) "RUNNING PHPDOCUMENTOR"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PHPDOC)
