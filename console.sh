#!/bin/bash

#
# FABIO CICERCHIA - WEBSITE
# Copyright (C) 2012. All Rights reserved.
#

wget http://meyerweb.com/eric/tools/css/reset/reset.css -O web/media/css/reset.css
wget http://silex.sensiolabs.org/get/silex.phar -O apps/api/silex.phar
git submodule init
git submodule update
cd lib/vendor/mongodb
curl -s http://getcomposer.org/installer | php
php composer.phar install
