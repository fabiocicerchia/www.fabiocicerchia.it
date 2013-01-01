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
# Category: Config
# Package:  Generic
# Author:   Fabio Cicerchia <info@fabiocicerchia.it>
# License:  MIT <http://www.opensource.org/licenses/MIT>
# Link:     http://www.fabiocicerchia.it
#

set :application,   "Fabio Cicerchia - Website"
set :domain,        "www.fabiocicerchia.it"
set :deploy_to,     "/var/www/fabiocicerchia/"
set :document_root, "/var/www/fabiocicerchia/current/web/"

set :scm,                   :git
set :repository,            "git://github.com/fabiocicerchia/fabiocicerchia.github.com.git"
set :branch,                "master"
set :git_enable_submodules, 1
set :deploy_via,            :remote_cache

set :user,        "capistrano"
set :use_sudo,    false
set :ssh_options, {:forward_agent => true}
ssh_options[:port] = 1986
default_run_options[:pty] = true

role :app, domain
role :web, domain
role :db,  domain, :primary => true
