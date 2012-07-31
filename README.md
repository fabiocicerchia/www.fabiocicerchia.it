# FABIO CICERCHIA - WEBSITE
Copyright (C) 2012. All Rights reserved.  
License   MIT <http://www.opensource.org/licenses/MIT>  
Link      http://www.fabiocicerchia.it  

## 1. General
Here below there's the list of the all technologies, libraries, tools, coding
standards and application design used to design and develop the global
architecture of the web site.  
That list doesn't include the more specific elements that, instead, has been
described in the properly section.

### 1.1. Coding Standards
These are the coding standards respected in the code:

 * Code Layout
    * Brackets & Indent Style
        * Classes, methods and functions: Allman - [Article](http://en.wikipedia.org/wiki/Indent_style#Allman_style)
        * Whatever else: K&R variant 1TBS - [Article](http://en.wikipedia.org/wiki/Indent_style#Variant:_1TBS)
        * Tabulation width of 4 spaces
    * Naming Conventions
        * Classes: PascalCase - [Article](http://c2.com/cgi/wiki?PascalCase)
        * Methods and functions: camelCase - [Article](http://en.wikipedia.org/wiki/CamelCase)
        * Properties and variables: underscore
    * No trailing spaces
    * Right-hand comparison
    * Avoiding Hungarian Notation - [Article](http://msdn.microsoft.com/en-us/library/aa260976%28VS.60%29.aspx)
 * Coding Techniques
    * Defensive Programming - [Article](http://en.wikipedia.org/wiki/Defensive_programming)
    * DRY (Don't Repeat Yourself) - [Article](http://programmer.97things.oreilly.com/wiki/index.php/Don%27t_Repeat_Yourself)
    * KISS (Keep It Simple Stupid) - [Article](http://people.apache.org/~fhanik/kiss.html)
    * YAGNI (You Aren't Gonna Need It) - [Article](http://c2.com/xp/YouArentGonnaNeedIt.html)
 * Documentation
    * Algorithmic Documentation (Use full-line comments to explain the algorithm.)
    * Elucidating Documentation (Use end-of-line comments to point out subtleties and oddities.)
 * Testing
    * Unit testing - [Article](http://www.extremeprogramming.org/rules/unittests.html)
    * Functional testing - [Article](http://en.wikipedia.org/wiki/Functional_testing)
    * Code Coverage - [Article](http://www.bullseye.com/coverage.html)
 * File Format
    * File encoding UTF-8 (RFC3629) without BOM. - [Doc](http://tools.ietf.org/rfc/rfc3629.txt)
    * Line length between 80 and no more than 100 characters. - [Article](http://lkml.indiana.edu/hypermail/linux/kernel/1202.0/01847.html)
    * LF (Line feed, '\n', 0x0A, 10 in decimal) as End Of Line.
    * No empty line as End Of File.

### 1.2. Application Design
These are the application design models that has been applied:

 * Git Flow - [Doc](http://nvie.com/posts/a-successful-git-branching-model/)

### 1.3. Scripting, Markup & Styling Language
These are the scripting, markup and styling languages that has been involved:

 * TBW

### 1.4. NoSQL Database
These are the NoSQL databases that has been involved:

 * MongoDB v2.0.4 - [Home](http://www.mongodb.org/) | [Doc](http://docs.mongodb.org/manual/)

### 1.5. Web Server
These are the web servers involved:

 * Apache v2.2.22 - [Home](http://httpd.apache.org/) | [Doc](http://httpd.apache.org/docs/2.2/)

### 1.6. Libraries
These are the libraries that has been used:

 * Apache Modules
    * Actions - [Doc](http://httpd.apache.org/docs/2.2/mod/mod_actions.html)
    * Cache - [Doc](http://httpd.apache.org/docs/2.2/mod/mod_cache.html)
    * Disk Cache - [Doc](http://httpd.apache.org/docs/2.2/mod/mod_disk_cache.html)
    * Expires - [Doc](http://httpd.apache.org/docs/2.2/mod/mod_expires.html)
    * Headers - [Doc](http://httpd.apache.org/docs/2.2/mod/mod_headers.html)
    * Mem Cache - [Doc](http://httpd.apache.org/docs/2.2/mod/mod_mem_cache.html)
    * PHP v5
    * Perl v2.0.5 - [Home](http://perl.apache.org/) | [Doc](http://perl.apache.org/docs/index.html)
    * Rewrite - [Doc](http://httpd.apache.org/docs/2.2/mod/mod_rewrite.html)
    * Security - [Home](http://www.modsecurity.org/) | [Doc](http://www.modsecurity.org/documentation/)
    * Speling - [Doc](http://httpd.apache.org/docs/2.2/mod/mod_speling.html)

### 1.7. Tools
These are the tools that has been used:

 * Capistrano v2.12.0 - [Repo](https://github.com/capistrano/capistrano)
 * Git Extras - [Repo](https://github.com/visionmedia/git-extras)
 * Git Flow v0.4.1 - [Repo](https://github.com/nvie/gitflow)
 * Git v1.7.9.5 - [Home](http://git-scm.com/) | [Doc](http://git-scm.com/documentation)

---

## 2. API
Here below there's the list of the all technologies, libraries, tools, coding
standards and application design used to design and develop the REST API
Service that provide the data to the Web Site.  
That list doesn't include the generic elements that, instead, has been
described in the properly section.

### 2.1. Coding Standards
These are the coding standards respected in the code:

 * PHP Framework Interop Group Standards
    * PSR-0 - [Doc](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
    * PSR-1 - [Doc](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
    * PSR-2 - [Doc](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)

### 2.2. Application Design
These are the application design models that has been applied:

 * Design Pattern
    * Strategy - [Doc](http://www.dofactory.com/Patterns/PatternStrategy.aspx)
 * Namespace - [Doc](http://php.net/manual/en/language.namespaces.php)
 * SPL - [Doc](http://uk.php.net/manual/en/book.spl.php)
    * InvalidArgumentException - [Doc](http://php.net/manual/en/class.invalidargumentexception.php)
    * UnexpectedValueException - [Doc](http://uk.php.net/manual/en/class.unexpectedvalueexception.php)

### 2.3. Scripting, Markup & Styling Language
These are the scripting, markup and styling languages that has been involved:

 * PHP v5.4 - [Home](http://www.php.net/) | [Doc](http://www.php.net/manual/en/)

### 2.4. NoSQL Database
These are the NoSQL databases that has been involved:

 * MongoDB v2.0.4 - [Home](http://www.mongodb.org/) | [Doc](http://docs.mongodb.org/manual/)

### 2.5.Protocols & Specification
These are the specifications that has been respected:

 * HTTP/1.1 (RFC2616) - [Doc](http://www.ietf.org/rfc/rfc2616.txt)
 * REST

### 2.6. Libraries
These are the external libraries that has been used:

 * PHP Modules
    * Mongo v1.2.10 - [Doc](http://php.net/manual/en/book.mongo.php)
    * XDebug v2.2.0 - [Home](http://xdebug.org/) | [Doc](http://xdebug.org/docs/)
 * Doctrine - MongoDB Abstraction Layer - [Home](http://www.doctrine-project.org/) | [Doc](http://docs.doctrine-project.org/projects/doctrine-mongodb-odm/en/latest/)
 * Silex - [Home](http://silex.sensiolabs.org/) | [Doc](http://silex.sensiolabs.org/documentation)
    * HttpCacheService - [Doc](http://silex.sensiolabs.org/doc/providers/http_cache.html)
    * Twig - [Home](http://twig.sensiolabs.org/) | [Doc](http://twig.sensiolabs.org/documentation)
 * Silex-Extension - [Home](https://github.com/fate/Silex-Extensions)
    * MongoDbExtension

### 2.7. Tools
These are the tools that has been used:

 * PHPUnit v3.6.11 - [Home](http://www.phpunit.de/) | [Doc](http://www.phpunit.de/manual/3.6/en/index.html)
 * PHP_CodeBrowser v1.0.2 - [Repo](https://github.com/Mayflower/PHP_CodeBrowser)
 * PHP_CodeCoverage v1.1.2 - [Repo](https://github.com/sebastianbergmann/php-code-coverage)
 * PHP_Code_Sniffer v1.3.4 - [Home](http://pear.php.net/package/PHP_CodeSniffer/) | [Doc](http://pear.php.net/package/PHP_CodeSniffer/docs)
 * PHP Depend v1.0.7 - [Home](http://pdepend.org/) | [Doc](http://pdepend.org/documentation/getting-started.html)
 * PHP Mess Detector v1.3.3 - [Home](http://phpmd.org/) | [Doc](http://phpmd.org/documentation/index.html)
 * phpDocumentor v2.0.0a3 - [Home](http://www.phpdoc.org/) | [Doc](http://www.phpdoc.org/docs/latest/index.html)
 * phpcov v1.0.0 - [Repo](https://github.com/sebastianbergmann/phpcov)
 * phpcpd v1.3.5 - [Repo](https://github.com/sebastianbergmann/phpcpd)
 * phploc v1.6.4 - [Repo](https://github.com/sebastianbergmann/phploc)

---

## 3. Site
Here below there's the list of the all technologies, libraries, tools, coding
standards and application design used to design and develop the Web Site
that read the data from the REST API Service.  
That list doesn't include the generic elements that, instead, has been
described in the properly section.

### 3.1. Coding Standards
These are the coding standards respected in the code:

 * All the standard present in the book "Perl Best Practices" by Damian Conway,
   respecting the Perl::Critic with the level "brutal".

### 3.2. Application Design
These are the application design models that has been applied:

 * TBW

### 3.3. Scripting, Markup & Styling Language
These are the scripting, markup and styling languages that has been involved:

 * Perl v5.14.2 - [Home](http://www.perl.org/) | [Doc](http://perldoc.perl.org/)
 * HTML v5 - [Doc](http://www.w3.org/TR/html5/)
 * CSS v3 - [Doc](http://www.w3.org/TR/CSS/)

### 3.4. Protocols & Specification
These are the specifications that has been respected:

 * Atom Syndication (RFC4287) - [Doc](http://www.ietf.org/rfc/rfc4287.txt)
 * RSS 0.91 - [Doc](http://backend.userland.com/stories/rss091)
 * RSS 0.92 - [Doc](http://backend.userland.com/stories/rss092)
 * RSS 1.0 - [Doc](http://web.resource.org/rss/1.0/spec)
 * RSS 2.0 - [Doc](http://cyber.law.harvard.edu/rss/rss.html)
 * Sitemaps XML v0.9 - [Home](http://www.sitemaps.org) | [Doc](http://www.sitemaps.org/protocol.html)
 * vCard v2.1 - [Doc](http://www.imc.org/pdi/vcard-21.txt)

### 3.5. Libraries
These are the external libraries that has been used:

 * OWASP - Core Rule Set v2.2.3 - [Home](https://www.owasp.org/index.php/Category:OWASP_ModSecurity_Core_Rule_Set_Project)
 * Twitter Bootstrap v2.0.4 - [Home](http://twitter.github.com/bootstrap/)
 * Perl Modules
    * Data::Dumper - [Doc](http://search.cpan.org/~smueller/Data-Dumper-2.131/Dumper.pm)
    * Date::Format - [Doc](http://search.cpan.org/~gbarr/TimeDate-1.20/lib/Date/Format.pm)
    * Devel::Cover - [Doc](http://search.cpan.org/~pjcj/Devel-Cover-0.89/lib/Devel/Cover.pm)
    * Digest::MD5 - [Doc](http://search.cpan.org/~gaas/Digest-MD5-2.52/MD5.pm)
    * File::Basename - [Doc](http://search.cpan.org/~rjbs/perl-5.16.0/lib/File/Basename.pm)
    * File::Spec - [Doc](http://search.cpan.org/~kjalb/File-Spec/Spec.pm)
    * LWP - [Doc](http://search.cpan.org/~gaas/libwww-perl-6.04/lib/LWP.pm)
    * POSIX - [Doc](http://search.cpan.org/~rjbs/perl-5.16.0/ext/POSIX/lib/POSIX.pod)
    * Perl::Critic - [Home](http://perlcritic.tigris.org/)
    * Pod::Coverage - [Doc](http://search.cpan.org/~rclamp/Pod-Coverage-0.22/lib/Pod/Coverage.pm)
    * Template - [Home](http://template-toolkit.org/) | [Doc](http://template-toolkit.org/docs/index.html)
    * Test::More - [Doc](http://search.cpan.org/~mschwern/Test-Simple-0.98/lib/Test/More.pm)
    * XML::Simple - [Doc](http://search.cpan.org/~grantm/XML-Simple-2.20/lib/XML/Simple.pm)

### 3.6. Tools
These are the tools that has been used:

 * Google Minify v2.1.5 - [Home](http://code.google.com/p/minify/) | [Doc](http://code.google.com/p/minify/wiki/UserGuide)
 * perltidy v20120619 - [Home](http://perltidy.sourceforge.net) | [Doc](http://perltidy.sourceforge.net/perltidy.html)

### 3.7. SEO
These are the SEO enhancements that has been implemented:

 * Dublin Core Metadata - [Home](http://dublincore.org/) | [Doc](http://dublincore.org/specifications/)
 * Microdata - [Home](http://schema.org/) | [Doc](http://www.w3.org/TR/microdata/)
 * Microformat - [Home](http://microformats.org/wiki/Main_Page)
    * hCalendar 1.0 - [Doc](http://microformats.org/wiki/hcalendar)
    * hCard 1.0 - [Doc](http://microformats.org/wiki/hcard)
    * hResume - [Doc](http://microformats.org/wiki/hresume)
    * rel="home" - [Doc](http://microformats.org/wiki/rel-home)
    * rel="nofollow" - [Doc](http://microformats.org/wiki/rel-nofollow)
    * XFN - [Home](http://gmpg.org/xfn/)

---

## 4. Script
Here below there's the list of the all technologies, libraries, tools, coding
standards and application design used to design and develop the utility
scripts.  
That list doesn't include the generic elements that, instead, has been
described in the properly section.

### 4.1. Coding Standards
These are the coding standards respected in the code:

 * All the standard defined in the PEP8 document.

### 4.2. Application Design
These are the application design models that has been applied:

 * TBW

### 4.3. Scripting, Markup & Styling Language
These are the scripting, markup and styling languages that has been involved:

 * Python 2.7 - [Home](http://www.python.org/) | [Doc](http://www.python.org/doc/)

### 4.4. Libraries
These are the external libraries that has been used:

 * Python Libraries
    * urllib - [Doc](http://docs.python.org/library/urllib.html)
    * time - [Doc](http://docs.python.org/library/time.html)
    * re - [Doc](http://docs.python.org/library/re.html)
    * lxml - [Home](http://lxml.de/)
    * future - [Doc](http://docs.python.org/library/__future__.html)

### 4.5. Tools
These are the tools that has been used:

 * pylint v0.25.0 - [Home](http://www.logilab.org/project/pylint)
 * pep8 v0.6.1 - [Doc](http://www.python.org/dev/peps/pep-0008/)

---

## 5. Console
Here below there's the list of the all technologies, libraries, tools, coding
standards and application design used to design and develop the console tool
to build the environment, run custom commands, and so on.  
That list doesn't include the generic elements that, instead, has been
described in the properly section.

### 4.1. Coding Standards
These are the coding standards respected in the code:

 * TBW

### 4.2. Application Design
These are the application design models that has been applied:

 * TBW

### 4.3. Scripting, Markup & Styling Language
These are the scripting, markup and styling languages that has been involved:

 * Bash Shell

### 4.4. Libraries
These are the external libraries that has been used:

 * TBW

### 4.5. Tools
These are the tools that has been used:

 * Internal Tools:
    * cat
    * cd
    * curl
    * cut
    * declare
    * dirname
    * egrep
    * find
    * fold
    * getopts
    * sed
    * seq
    * source
    * wc
    * wget
    * xargs

 * External Tools:
    * a2enmod
    * add-apt-repository
    * apt-get
    * cover
    * cpan
    * git
    * pdepend
    * pear
    * pecl
    * pep8
    * perl
    * phpcb
    * phpcpd
    * phpcs
    * phpdoc
    * phploc
    * phpmd
    * phpunit
    * pychecker
    * pylint
    * python

---

## 6. Stream
TBW
That list doesn't include the generic elements that, instead, has been
described in the properly section.

### 6.1. Coding Standards
These are the coding standards respected in the code:

 * TBW

### 6.2. Application Design
These are the application design models that has been applied:

 * TBW

### 6.3. Scripting, Markup & Styling Language
These are the scripting, markup and styling languages that has been involved:

 * TBW

### 6.4. Libraries
These are the external libraries that has been used:

 * TBW

### 6.5. Tools
These are the tools used:

 * TBW
