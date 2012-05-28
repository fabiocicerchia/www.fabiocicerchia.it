#
# FABIO CICERCHIA - WEBSITE
# Copyright (C) 2012. All Rights reserved.
#

# SYSTEM COMMANDS
RM=rm -rf
MKDIR=mkdir -p
CP=cp -r
CHMOD=chmod
ECHO=@echo
LN=ln -s
WGET=wget
GIT=git
SUDO=sudo

# CUSTOM COMMANDS
PHP=php
PECL=$(SUDO) pecl
PEAR=$(SUDO) pear
PHPUNIT=phpunit
PHPCS=phpcs -s -v
PHPMD=phpmd
PHPLOC=phploc
PHPCPD=phpcpd
PDEPEND=pdepend
PHPCB=phpcb
MSGFMT=msgfmt
A2ENMOD=$(SUDO) a2enmod

# FLAGS
PEAR_INSTALL_FLAGS=--alldeps
SUPPRESS_OUTPUT=>> /dev/null

# DIRECTORIES
CURRENTDIR=.
SOURCEDIR=$(CURRENTDIR)/apps/api/

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
	cd lib/vendor/mongodb
	curl -s http://getcomposer.org/installer | $(PHP)
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
	$(SUDO) apt-get update
	$(SUDO) apt-get upgrade
	$(SUDO) apt-get dist-upgrade

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

# TODO: ADD CHANNEL-DISCOVER
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
	$(A2ENMOD) speling mod-security actions rewrite perl cache disk_cache mem_cache expires php5

# TODO: ADD CHANNEL-DISCOVER
run-phpcs:
	$(ECHO) "RUNNING PHP_CodeSniffer"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PHPCS) --standard="$(CURRENTDIR)/lib/PHPCS/ruleset.xml" "$(SOURCEDIR)"

run-phpmd:
	$(ECHO) "RUNNING PHPMD"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PHPMD) "$(SOURCEDIR)" xml codesize,design,naming,unusedcode --reportfile "$(REPORTDIR)/api/logs/phpmd.xml"

run-phploc:
	$(ECHO) "RUNNING PHPLOC"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PHPLOC) --log-xml "$(REPORTDIR)/api/logs/phploc.xml" "$(SOURCEDIR)"

run-phpcpd:
	$(ECHO) "RUNNING PHPCPD"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PHPCPD) --log-pmd "$(REPORTDIR)/api/logs/phpcpd.xml" "$(SOURCEDIR)" > "$(REPORTDIR)/api/logs/duplications.txt"

run-pdepend:
	$(ECHO) "RUNNING PHP_DEPEND"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PDEPEND) --jdepend-chart="$(REPORTDIR)/api/cli.pdepend-chart.svg" --overview-pyramid="$(REPORTDIR)/api/cli.pdepend-pyramid.svg" --jdepend-xml="$(REPORTDIR)/api/log/pdepend.xml" "$(SOURCEDIR)"

run-phpcb:
	$(ECHO) "RUNNING PHP_CODE_BROWSER"
	$(ECHO) "--------------------------------------------------------------------------------"
	$(PHPCB) --log="$(REPORTDIR)/api/logs/" --source="$(SOURCEDIR)" --output="$(REPORTDIR)/api/code_browser"

run-phpdoc:
	$(ECHO) "RUNNING PHPDOCUMENTOR"
	$(ECHO) "--------------------------------------------------------------------------------"
	phpdoc -d "$(SOURCEDIR)" -t "$(REPORTDIR)/docs/api"

