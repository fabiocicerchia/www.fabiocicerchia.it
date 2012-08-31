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

set :stages, ['demo', 'production']
set :default_stage, 'demo'

require 'capistrano/ext/multistage'

after 'deploy', 'app:init_env'
after 'deploy', 'app:clean_cache'

namespace :app do

# {{{ Task: init_env -----------------------------------------------------------
task :init_env do
  if (exists?(':install'))
    run "cd #{current_path}; ./console install php"
    run "cd #{current_path}; ./console install perl"
    run "cd #{current_path}; ./console install cpanm"
    run "cd #{current_path}; ./console install mongo"
    run "cd #{current_path}; ./console install phpmongo"
    run "cd #{current_path}; ./console install apache_modules"
    run "cd #{current_path}; ./console install perl_modules"
  end
  run "cd #{current_path}; ./console init"
  run "cd #{current_path}; ./console config"
  run "cd #{current_path}; ./console run compile_gettext"
end
# }}} --------------------------------------------------------------------------

# {{{ Task: clean_cache --------------------------------------------------------
task :clean_cache do
  run "rm -rf #{current_path}/cache/apache/*"
  run "rm -rf #{current_path}/cache/api/*"
  run "rm -rf #{current_path}/cache/stream/*"
  run "rm -rf #{current_path}/tmp/*"
end
# }}} --------------------------------------------------------------------------

# {{{ Task: console ------------------------------------------------------------
task :console do
    run "cd #{current_path}; ./console #{arg1} #{arg2}"
end
# }}} --------------------------------------------------------------------------

end