# FABIO CICERCHIA - WEBSITE
Link: <http://www.fabiocicerchia.it>  

## Description

Run the command `./console help` to see the available options.

**Additional information**
There are some special files:

  - `LICENCE`: The project's _licence details_.
  - `CHANGELOG`: The project _list of changes_, as developer-readable.
  - `AUTHORS`: The project's _authors_.
  - `BUGS`: The instruction to _report a bug_ or to see the list.
  - `TODO`: The To-Do list of _pending activities and tasks_.

## Specification
The list of _project's specification_ is available on the GitHub's wiki:

  - [Specification: General](https://github.com/fabiocicerchia/fabiocicerchia.github.com/wiki/Specification:-General)
  - [Specification: Api](https://github.com/fabiocicerchia/fabiocicerchia.github.com/wiki/Specification:-Api)
  - [Specification: Site](https://github.com/fabiocicerchia/fabiocicerchia.github.com/wiki/Specification:-Site)
  - [Specification: Script](https://github.com/fabiocicerchia/fabiocicerchia.github.com/wiki/Specification:-Script)
  - [Specification: Console](https://github.com/fabiocicerchia/fabiocicerchia.github.com/wiki/Specification:-Console)
  - [Specification: Stream](https://github.com/fabiocicerchia/fabiocicerchia.github.com/wiki/Specification:-Stream)

## Documentation

Different kind of documentation will be available (after generating it):

  - **Source Code Documentation**  
    Generated from the _PHP_, _Perl_ and _Python_ source code to know more about
    the source code and how it works.  
    Available under `/docs/` after launching the command `./console docs`

  - **Source Code Analysis Reporting**  
    Generated from the _PHP_, _Perl_ and _Python_ source code. Providing
    detailed information about _code coverage_, _static code analysis_ (SLOC,
    cyclomatic complexity, code duplication, coding standard violation),
    _testing logs_, _security test_.  
    Available under `/report/` after launching the command `./console sca`

## Installing

In order to prepare the environment there's a dedicated task with the console:

    ./console install

additionally exists `./console run dependencies` to verify which _dependencies_
are satisfied or not.

After the installation phase the command `./console init` SHOULD be launched to
initialise the git submodules and then download them, download the external
dependencies based on `composer.phar` and import the Mongo DB into the local
server.

## Testing

Just run the following command to run the tests:

    ./console tests

## Continuous Integration

The CI service is provided by [Travis CI](http://travis-ci.org).  
Each build is totally public and available at:

<http://travis-ci.org/fabiocicerchia/fabiocicerchia.github.com/builds>

Currently this is the status of the last build:
[![Build Status](https://secure.travis-ci.org/fabiocicerchia/fabiocicerchia.github.com.png)](http://travis-ci.org/fabiocicerchia/fabiocicerchia.github.com)

## Deploying

TBW

## Licensing
Copyright 2012 Fabio Cicerchia.

The project is released under the MIT licence available herebelow or at
<http://www.opensource.org/licenses/MIT>.

> Permission is hereby  granted, free of charge, to any  person obtaining a copy
> of this software and associated  documentation files (the "Software"), to deal
> in the Software  without restriction, including without  limitation the rights
> to  use, copy,  modify, merge,  publish, distribute,  sublicense, and/or  sell
> copies  of  the Software,  and  to  permit persons  to  whom  the Software  is
> furnished to do so, subject to the following conditions:
>
> The above copyright notice and this permission notice shall be included in all
> copies or substantial portions of the Software.
>
> THE SOFTWARE  IS PROVIDED "AS  IS", WITHOUT WARRANTY  OF ANY KIND,  EXPRESS OR
> IMPLIED,  INCLUDING BUT  NOT  LIMITED TO  THE  WARRANTIES OF  MERCHANTABILITY,
> FITNESS FOR  A PARTICULAR PURPOSE AND  NONINFRINGEMENT. IN NO EVENT  SHALL THE
> AUTHORS  OR COPYRIGHT  HOLDERS  BE  LIABLE FOR  ANY  CLAIM,  DAMAGES OR  OTHER
> LIABILITY, WHETHER IN AN ACTION OF  CONTRACT, TORT OR OTHERWISE, ARISING FROM,
> OUT OF OR IN CONNECTION WITH THE SOFTWARE  OR THE USE OR OTHER DEALINGS IN THE
> SOFTWARE.