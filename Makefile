#
# FABIO CICERCHIA - WEBSITE
# Copyright (C) 2012. All Rights reserved.
#

RM=rm -rf
MKDIR=mkdir -p
CP=cp -r
CHMOD=chmod
ECHO=@echo
LN=ln -s

PECL=-pecl
PEAR=-pear
PHPUNIT=phpunit
PHPCS=phpcs -s -v
PHPMD=phpmd
PHPLOC=phploc
PHPCPD=phpcpd
PDEPEND=pdepend
PHPCB=phpcb
DOCBLOX=docblox
MSGFMT=msgfmt

PEAR_INSTALL_FLAGS=--alldeps

CURRENTDIR=.
SOURCEDIR=$(CURRENTDIR)/apps/api/

################################################################################
# GENERAL ACTIONS
################################################################################

all: .info test sca

.info:
	$(ECHO) "--------------------------------------------------------------------------------"
	$(ECHO) "FABIO CICERCHIA - WEBSITE"
	$(ECHO) "--------------------------------------------------------------------------------"

install-environment: install-bcompiler install-imagick install-phpunit install-docblox install-pdepend install-phpmd install-phpcs

test:
	$(ECHO) "RUN THE TESTS"
	$(PHPUNIT)

sca: run-phpcs run-phpmd run-phploc run phpcpd run-pdepend run-phpcb

################################################################################
# SPECIFIC ACTIONS
################################################################################

install-bcompiler:
	$(PECL) install bcompiler

install-imagick:
	$(PECL) install imagick

install-phpunit:
	$(PEAR) channel-discover pear.phpunit.de
	$(PEAR) install $(PEAR_INSTALL_FLAGS) phpunit/PHPUnit phpunit/PHP_CodeBrowser phpunit/PHP_CodeCoverage phpunit/phpcov phpunit/phpcpd phpunit/phploc

install-docblox:
	$(PEAR) channel-discover pear.docblox-project.org
	$(PEAR) install $(PEAR_INSTALL_FLAGS) docblox/DocBlox

install-pdepend:
	#$(PEAR) channel-discover pear.pdepend.org
	#$(PEAR) install $(PEAR_INSTALL_FLAGS) pdepend/PHP_Depend-beta

install-phpmd:
	#$(PEAR) channel-discover pear.phpmd.org
	#$(PEAR) install $(PEAR_INSTALL_FLAGS) phpmd/PHP_PMD

install-phpcs:
	$(PEAR) install $(PEAR_INSTALL_FLAGS) PHP_CodeSniffer-1.3.2

run-phpcs:
	$(PHPCS) --standard="$(CURRENTDIR)/lib/PHPCS/ruleset.xml" "$(SOURCEDIR)"

run-phpmd:
	#$(PHPMD) "$(SOURCEDIR)" xml codesize,design,naming,unusedcode --reportfile "$(REPORTDIR)/cli/log/phpmd.xml"

run-phploc:
	$(PHPLOC) "$(SOURCEDIR)"

run-phpcpd:
	#$(PHPCPD) --log-pmd "$(REPORTDIR)/cli/log/phpcpd.xml" "$(SOURCEDIR)" > "$(REPORTDIR)/cli/cli.duplications.txt"

run-pdepend:
	#$(PDEPEND) --jdepend-chart="$(REPORTDIR)/cli/cli.pdepend-chart.svg" --overview-pyramid="$(REPORTDIR)/cli/cli.pdepend-pyramid.svg" --jdepend-xml="$(REPORTDIR)/cli/log/pdepend.xml" "$(SOURCEDIR)"

run-phpcb:
	#$(PHPCB) --log="$(REPORTDIR)/cli/log" --source="$(SOURCEDIR)" --output="$(REPORTDIR)/cli/code_browser"

