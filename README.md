# FABIO CICERCHIA - WEBSITE
Copyright (C) 2012. All Rights reserved.  
License   TBD <http://www.fabiocicerchia.it>  
Link      http://www.fabiocicerchia.it  

## General
Here below there's the list of the all technologies, libraries, tools, coding
standards and application design used to design and develop the global
architecture of the web site.  
That list doesn't include the more specific elements that, instead, has been
described in the properly section.

### Coding Standards
These are the coding standards respected in the code:
 * TBW

### Application Design
These are the application design models applied:
 * TBW

### Scripting, Markup & Styling Language
These are the scripting, markup and styling languages involved:
 * TBW

### NoSQL Database
These are the NoSQL databases involved:
 * MongoDB v2.0.4 - [Home](http://www.mongodb.org/) | [Docs](http://docs.mongodb.org/manual/)

### Web Server
These are the web servers involved:
 * Apache v2.2.22 - [Home](http://httpd.apache.org/) | [Docs](http://httpd.apache.org/docs/2.2/)

### Libraries
These are the libraries used:
 * Apache Modules
  * Actions - [Docs](http://httpd.apache.org/docs/2.2/mod/mod_actions.html)
  * Cache - [Docs](http://httpd.apache.org/docs/2.2/mod/mod_cache.html)
  * Disk Cache - [Docs](http://httpd.apache.org/docs/2.2/mod/mod_disk_cache.html)
  * Expires - [Docs](http://httpd.apache.org/docs/2.2/mod/mod_expires.html)
  * Headers - [Docs](http://httpd.apache.org/docs/2.2/mod/mod_headers.html)
  * Mem Cache - [Docs](http://httpd.apache.org/docs/2.2/mod/mod_mem_cache.html)
  * PHP v5 - [Docs]()
  * Perl v2.0.5 - [Home](http://perl.apache.org/) | [Docs](http://perl.apache.org/docs/index.html)
  * Rewrite - [Docs](http://httpd.apache.org/docs/2.2/mod/mod_rewrite.html)
  * Security - [Home](http://www.modsecurity.org/) | [Docs](http://www.modsecurity.org/documentation/)
  * Speling - [Docs](http://httpd.apache.org/docs/2.2/mod/mod_speling.html)

### Tools
These are the tools used:
 * GIT v1.7.9.5 - [Home](http://git-scm.com/) | [Docs](http://git-scm.com/documentation)
 * Makefile

---

## API
Here below there's the list of the all technologies, libraries, tools, coding
standards and application design used to design and develop the REST API
Service that provide the data to the Web Site.  
That list doesn't include the generic elements that, instead, has been
described in the properly section.

### Coding Standards
These are the coding standards respected in the code:
 * PHP Framework Interop Group Standards
  * PSR-0 - [Docs](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
  * PSR-1 - [Docs](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md)
  * PSR-2 - [Docs](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)

### Application Design
These are the application design models applied:
 * Design Pattern
  * Strategy - [Docs](http://www.dofactory.com/Patterns/PatternStrategy.aspx)
 * Namespace - [Docs](http://php.net/manual/en/language.namespaces.php)
 * SPL - [Docs](http://uk.php.net/manual/en/book.spl.php)
  * InvalidArgumentException - [Docs](http://php.net/manual/en/class.invalidargumentexception.php)
  * UnexpectedValueException - [Docs](http://uk.php.net/manual/en/class.unexpectedvalueexception.php)

### Scripting, Markup & Styling Language
These are the scripting, markup and styling languages involved:
 * PHP v5.4 - [Home](http://www.php.net/) | [Docs](http://www.php.net/manual/en/)

### NoSQL Database
These are the NoSQL databases involved:
 * MongoDB v2.0.4 - [Home](http://www.mongodb.org/) | [Docs](http://docs.mongodb.org/manual/)

### Protocols & Specification
These are the specifications that has been respected:
 * HTTP/1.1 (RFC2616) - [Docs](http://www.ietf.org/rfc/rfc2616.txt)
 * REST

### Libraries
These are the external libraries used:
 * PHP Modules
  * Mongo v1.2.10 - [Docs](http://php.net/manual/en/book.mongo.php)
  * XDebug v2.2.0 - [Home](http://xdebug.org/) | [Docs](http://xdebug.org/docs/)
 * Doctrine - MongoDB Abstraction Layer - [Home](http://www.doctrine-project.org/) | [Docs](http://docs.doctrine-project.org/projects/doctrine-mongodb-odm/en/latest/)
 * Silex - [Home](http://silex.sensiolabs.org/) | [Docs](http://silex.sensiolabs.org/documentation)
  * HttpCacheService - [Docs](http://silex.sensiolabs.org/doc/providers/http_cache.html)
  * Twig - [Home](http://twig.sensiolabs.org/) | [Docs](http://twig.sensiolabs.org/documentation)
 * Silex-Extension - [Home](https://github.com/fate/Silex-Extensions)
  * MongoDbExtension

### Tools
These are the tools used:
 * PHPUnit v3.6.11 - [Home](http://www.phpunit.de/) | [Docs](http://www.phpunit.de/manual/3.6/en/index.html)
 * PHP_CodeBrowser v1.0.2 - [Home](https://github.com/Mayflower/PHP_CodeBrowser)
 * PHP_CodeCoverage v1.1.2 - [Home](https://github.com/sebastianbergmann/php-code-coverage)
 * PHP_Code_Sniffer v1.3.4 - [Home](http://pear.php.net/package/PHP_CodeSniffer/) | [Docs](http://pear.php.net/package/PHP_CodeSniffer/docs)
 * PHP Depend v1.0.7 - [Home](http://pdepend.org/) | [Docs](http://pdepend.org/documentation/getting-started.html)
 * PHP Mess Detector v1.3.3 - [Home](http://phpmd.org/) | [Docs](http://phpmd.org/documentation/index.html)
 * phpDocumentor v2.0.0a3 - [Home](http://www.phpdoc.org/) | [Docs](http://www.phpdoc.org/docs/latest/index.html)
 * phpcov v1.0.0 - [Home](https://github.com/sebastianbergmann/phpcov)
 * phpcpd v1.3.5 - [Home](https://github.com/sebastianbergmann/phpcpd)
 * phploc v1.6.4 - [Home](https://github.com/sebastianbergmann/phploc)

---

## Site
Here below there's the list of the all technologies, libraries, tools, coding
standards and application design used to design and develop the Web Site
that read the data from the REST API Service.  
That list doesn't include the generic elements that, instead, has been
described in the properly section.

### Coding Standards
These are the coding standards respected in the code:
 * TBW

### Application Design
These are the application design models applied:
 * TBW

### Scripting, Markup & Styling Language
These are the scripting, markup and styling languages involved:
 * Perl v5.14.2 - [Home](http://www.perl.org/) | [Docs](http://perldoc.perl.org/)
 * HTML v5 - [Docs](http://www.w3.org/TR/html5/)
 * CSS v3 - [Docs](http://www.w3.org/TR/CSS/)

### Protocols & Specification
These are the specifications that has been respected:
 * Atom Syndication (RFC4287) - [Docs](http://www.ietf.org/rfc/rfc4287.txt)
 * RSS 0.91 - [Docs](http://backend.userland.com/stories/rss091)
 * RSS 0.92 - [Docs](http://backend.userland.com/stories/rss092)
 * RSS 1.0 - [Docs](http://web.resource.org/rss/1.0/spec)
 * RSS 2.0 - [Docs](http://cyber.law.harvard.edu/rss/rss.html)
 * vCard v2.1 - [Docs](http://www.imc.org/pdi/vcard-21.txt)

### Libraries
These are the external libraries used:
 * OWASP - Core Rule Set v2.2.3 - [Home](https://www.owasp.org/index.php/Category:OWASP_ModSecurity_Core_Rule_Set_Project)
 * Twitter Bootstrap v2.0.4 - [Home](http://twitter.github.com/bootstrap/)
 * Perl Modules
  * Data::Dumper - [Docs](http://search.cpan.org/~smueller/Data-Dumper-2.131/Dumper.pm)
  * Date::Format - [Docs](http://search.cpan.org/~gbarr/TimeDate-1.20/lib/Date/Format.pm)
  * Devel::Cover - [Docs](http://search.cpan.org/~pjcj/Devel-Cover-0.89/lib/Devel/Cover.pm)
  * Digest::MD5 - [Docs](http://search.cpan.org/~gaas/Digest-MD5-2.52/MD5.pm)
  * File::Basename - [Docs](http://search.cpan.org/~rjbs/perl-5.16.0/lib/File/Basename.pm)
  * File::Spec - [Docs](http://search.cpan.org/~kjalb/File-Spec/Spec.pm)
  * LWP - [Docs](http://search.cpan.org/~gaas/libwww-perl-6.04/lib/LWP.pm)
  * POSIX - [Docs](http://search.cpan.org/~rjbs/perl-5.16.0/ext/POSIX/lib/POSIX.pod)
  * Perl::Critic - [Home](http://perlcritic.tigris.org/)
  * Pod::Coverage - [Docs](http://search.cpan.org/~rclamp/Pod-Coverage-0.22/lib/Pod/Coverage.pm)
  * Template - [Home](http://template-toolkit.org/) | [Docs](http://template-toolkit.org/docs/index.html)
  * Test::More - [Docs](http://search.cpan.org/~mschwern/Test-Simple-0.98/lib/Test/More.pm)
  * XML::Simple - [Docs](http://search.cpan.org/~grantm/XML-Simple-2.20/lib/XML/Simple.pm)

### Tools
These are the tools used:
 * Google Minify v2.1.5 - [Home](http://code.google.com/p/minify/) | [Docs](http://code.google.com/p/minify/wiki/UserGuide)
 * perltidy v20120619 - [Home](http://perltidy.sourceforge.net) | [Docs](http://perltidy.sourceforge.net/perltidy.html)

### SEO
These are the SEO enhancements implemented:
 * Dublin Core Metadata - [Home](http://dublincore.org/) | [Docs](http://dublincore.org/specifications/)
 * Microdata - [Home](http://schema.org/) | [Docs](http://www.w3.org/TR/microdata/)
 * Microformat - [Home](http://microformats.org/wiki/Main_Page)
  * hCalendar 1.0 - [Docs](http://microformats.org/wiki/hcalendar)
  * hCard 1.0 - [Docs](http://microformats.org/wiki/hcard)
  * hResume - [Docs](http://microformats.org/wiki/hresume)
  * rel="home" - [Docs](http://microformats.org/wiki/rel-home)
  * rel="nofollow" - [Docs](http://microformats.org/wiki/rel-nofollow)
  * XFN - [Home](http://gmpg.org/xfn/)

---

## Script
TBW
That list doesn't include the generic elements that, instead, has been
described in the properly section.

### Coding Standards
These are the coding standards respected in the code:
 * TBW

### Application Design
These are the application design models applied:
 * TBW

### Scripting, Markup & Styling Language
These are the scripting, markup and styling languages involved:
 * TBW

### Libraries
These are the external libraries used:
 * TBW

### Tools
These are the tools used:
 * TBW

---

## Stream
TBW
That list doesn't include the generic elements that, instead, has been
described in the properly section.

### Coding Standards
These are the coding standards respected in the code:
 * TBW

### Application Design
These are the application design models applied:
 * TBW

### Scripting, Markup & Styling Language
These are the scripting, markup and styling languages involved:
 * TBW

### Libraries
These are the external libraries used:
 * TBW

### Tools
These are the tools used:
 * TBW
