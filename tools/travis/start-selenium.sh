#!/bin/bash

# @file tools/travis/start-selenium.sh
#
# Copyright (c) 2014-2019 Simon Fraser University
# Copyright (c) 2010-2019 John Willinsky
# Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
#
# Script to install and start a Selenium server.
#

set -xe

export DISPLAY=":99.0" # Travis init script for xvfb specifies this

mkdir screenshots

# Start Selenium server.
wget -q -O selenium.jar http://selenium-release.storage.googleapis.com/2.53/selenium-server-standalone-2.53.1.jar
nohup java -jar selenium.jar -forcedBrowserMode *firefox -browserSessionReuse -log selenium-output &

# Wait for Selenium to start
until wget -O - -q "http://localhost:4444/selenium-server/driver/?cmd=testComplete" | grep -e "^OK$"; do sleep 1; done
