#!/usr/bin/perl -w
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
# Perl Version 5
#
# Category: Code
# Package:  Site
# Author:   Fabio Cicerchia <info@fabiocicerchia.it>
# License:  MIT <http://www.opensource.org/licenses/MIT>
# Link:     http://www.fabiocicerchia.it
#

package FabioCicerchiaSite;

use strict;
use warnings;
use version; our $VERSION = qv('1.0');
use Data::Dumper;
use Date::Format;
use Digest::MD5;
use File::Basename;
use Locale::TextDomain('messages', dirname(__FILE__) . '/../locale/');
use LWP;
use POSIX qw(mktime :locale_h);
use Template;
use XML::Simple;
use Template::Filters;
# TODO: Reduce external libs.

# {{{ Method: action404 --------------------------------------------------------
# Usage      : FabioCicerchiaSite->action404()
# Purpose    : Print a 404 error.
# Returns    : Nothing, just printing.
# Parameters : None.
# Throws     : No exceptions.
# TODO: Write a test to cover this
sub action404 {
    my $self = shift;

    my $r = print "HTTP/1.1 404 Not Found\n\n";
    $r = print "Location: /\n\n";

    return;
}
# }}} --------------------------------------------------------------------------

# {{{ Method: action_show ------------------------------------------------------
# Usage      : FabioCicerchiaSite->action_show()
# Purpose    : The "show" action.
# Returns    : Nothing, just printing.
# Parameters : None.
# Throws     : No exceptions.
# See Also   : $self->get_data()
#            : $ENV{'HTTP_HOST'}
#            : $self->{'contentType'}
#            : $self->{'formatCurrent'}
sub action_show {
    my $self = shift;

    my ($data, $last_modified, $etag, $language) = $self->get_data();

    my @langTokens = split /,/smx, $language;
    if (scalar(@langTokens) > 1) {
        $language = $langTokens[0];
        $language =~ s/-(..)$/_\U$1/smx;

        # TODO: Remove this ugly workaround.
        if ($language == 'en_EN') {
            $language = 'en_GB';
        }
    }

    my $gettextLanguage = $language . '.utf8';
    $ENV{'LANG'} = $gettextLanguage;
    $ENV{'LANGUAGE'} = $gettextLanguage;
    $ENV{'LC_ALL'} = $gettextLanguage;
    setlocale(LC_ALL, $gettextLanguage);

    my $vars = {
        'HTTP_HOST'     => $ENV{'HTTP_HOST'},
        'data'          => $data,
        'last_modified' => $last_modified,
        'language'      => $language
    };

    # http://template-toolkit.org/docs/modules/Template/Filters.html#CONFIGURATION_OPTIONS
    my $filters = Template::Filters->new({
        FILTERS => {
            'gettext' => \&gettext
        },
    });

    # TODO: IMPLEMENT IF NOT MODIFIED
    my $r;
    $r = print 'Cache-Control: public, max-age=28800, smax-age=28800' . "\n";
    $r = print 'Last-Modified: '
      . time2str( '%a, %d %b %Y %H:%M:%S GMT', $last_modified ) . "\n";
    $r = print 'ETag: "' . $etag . q{"} . "\n";
    $r =
        print 'Content-Type: '
      . $self->{'contentType'}
      . '; charset=UTF-8' . "\n";
    $r = print 'Content-Language: ' . $language . "\n";
    $r = print "\n";

    # http://template-toolkit.org/docs/tutorial/Web.html
    my $template = Template->new(
        INCLUDE_PATH => [ dirname(__FILE__) . '/../view' ],
        EVAL_PERL    => 1,
        LOAD_FILTERS => [ $filters ],
    );

    $template->process( $self->{'formatCurrent'} . '.tmpl', $vars );

    return q{};
}
# }}} --------------------------------------------------------------------------

# {{{ Method: call_api ---------------------------------------------------------
# Usage      : FabioCicerchiaSite->call_api()
# Purpose    : Call an URL and return its content.
# Returns    : String, the output of the URL.
# Parameters : String $url, String $language.
# Throws     : No exceptions.
# See Also   : $ENV{'HTTP_HOST'}
sub call_api {
    my ( $self, $url, $language ) = @_;

    my $browser = LWP::UserAgent->new();
    $browser->timeout(10);
    $browser->default_header( 'Accept-Language' => $language );
    $browser->default_header( 'Accept' => 'application/vnd.ads+xml;v=1.0' );

    return $browser->get( 'http://' . $ENV{'HTTP_HOST'} . '/api.php' . $url );
}
# }}} --------------------------------------------------------------------------

# {{{ Method: elaborate_data ---------------------------------------------------
# Usage      : FabioCicerchiaSite->elaborate_data()
# Purpose    : Change the data.
# Returns    : An Hash, the input hash but modified.
# Parameters : Hash $data.
# Throws     : No exceptions.
sub elaborate_data {
    my ( $self, $data ) = @_;

    my $tmp;
    my $values;

    # Cycle over each skill...
    foreach my $key ( keys $data->{'skill'}->{'entity'} ) {
        $tmp    = {};
        $values = $data->{'skill'}->{'entity'}->[$key]->{'content'}->{'skills'};

        # ... and over each element ...
        foreach my $key2 ( keys $values ) {
            my $item = $values->[$key2];

            # ... then create an array that has as key the "level" value ...
            if ( !exists( $tmp->{ $item->{'level'} } ) ) {
                $tmp->{ $item->{'level'} } = [];
            }

            # ... and as children the "title" values.
            push $tmp->{ $item->{'level'} }, $item->{'title'}->{'content'};
        }

        $data->{'skill'}->{'entity'}->[$key]->{'content'}->{'skills'} = $tmp;
    }

    return $data;
}
# }}} --------------------------------------------------------------------------

# {{{ Method: get_data ---------------------------------------------------------
# Usage      : FabioCicerchiaSite->get_data()
# Purpose    : Retrieve the data from the API.
# Returns    : Array.
# Parameters : None.
# Throws     : No exceptions.
# See Also   : $self->{'i18nCurrent'}
#            : $self->elaborate_data()
sub get_data {
    my $self = shift;

    my $ctx     = Digest::MD5->new;
    my $data    = {};
    my $last_ts = 0;
    my $hash    = q{};
    my $url;
    my $lang;

    my @api_list = qw( root information education experience skill language );

  API:
    foreach my $api (@api_list) {
        $url = $api eq 'root' ? q{} : $api;

        # Retrieve the data from the API for the current route using
        # "i18nCurrent" as language.
        my @response =
          $self->get_item_data( q{/} . $url, $self->{'i18nCurrent'} );
        my ( $curr_data, $curr_ts, $curr_hash, $curr_lang ) = @{ $response[0] };

        # Add the response to the final array
        $data->{$api} = $curr_data;
        $hash = defined $curr_hash ? ( $hash . $curr_hash ) : $hash;
        $lang = defined $curr_lang ? $curr_lang             : $lang;

        #print "#$curr_ts#"; # TODO: investigate why doesn't work.
        if ( defined $curr_ts && $curr_ts > $last_ts ) {
            # TODO: Write a test to cover this
            $last_ts = $curr_ts;
        }
    }
    $ctx->add($hash);

    # Elaborate the data.
    $data = $self->elaborate_data($data);

    my @return = ($data, $last_ts, $ctx->hexdigest, $lang);
    return @return;

    return [ $data, $last_ts, $ctx->hexdigest, $lang ];
}
# }}} --------------------------------------------------------------------------

# {{{ Method: get_item_data ----------------------------------------------------
# Usage      : FabioCicerchiaSite->get_data()
# Purpose    : Retrieve the data from the API.
# Returns    : Array.
# Parameters : String $url, String $language.
# Throws     : No exceptions.
# See Also   : $self->call_api()
#            : $self->retrieve_xml()
sub get_item_data {
    my ( $self, $url, $language ) = @_;

    my %mon2num =
      qw(jan 1 feb 2 mar 3 apr 4 may 5 jun 6 jul 7 aug 8 sep 9 oct 10 nov 11 dec 12);
    my $ctx = Digest::MD5->new;
    my $ts  = 0;

    my $response      = $self->call_api( $url, $language );
    my $data          = $self->retrieve_xml( $response->content() );
    my $last_modified = q{};
    if ( defined( $response->headers()->{'last-modified'} ) ) {
        # TODO: Write a test to cover this
        $last_modified = $response->headers()->{'last-modified'};
    }

    if ( $last_modified ne q{} ) {
        # TODO: Write a test to cover this
        my ( $wday, $day, $month, $year, $hour, $min, $sec ) =
          split /[\s:]/smx, $last_modified;
        # TODO: Write a test to cover this
        $ts = POSIX::mktime(
            $sec, $min, $hour, $day,
            $mon2num{ lc $month } - 1,
            $year - 1900
        );
    }

    my $lang = $response->headers()->{'content-language'};
    $lang =~ s/.*,([^,]+)$/$1/smx;
    if (length($lang) == 2) {
        $lang .= '_' . uc($lang);
    }

    $ctx->add( $response->content() );

    return [
        $data,           $ts,
        $ctx->hexdigest, $lang
    ];
}
# }}} --------------------------------------------------------------------------

# {{{ Method: gettext ----------------------------------------------------------
# Usage      : FabioCicerchiaSite->gettext()
# Purpose    : Translate a label with gettext.
# Returns    : A string, the translated label.
# Parameters : A string, the label.
# Throws     : No exceptions.
# See Also   : __()
sub gettext {
    my $text = shift;

    return __($text);
}
# }}} --------------------------------------------------------------------------

# {{{ Method: execute_action ---------------------------------------------------
# Usage      : FabioCicerchiaSite->execute_action()
# Purpose    : Execute a custom & dynamical action.
# Returns    : A string, the output that will be printed.
# Parameters : A string, the action name.
# Throws     : No exceptions.
# See Also   : $self->action_*()
#            : $self->action404()
sub execute_action {
    my ( $self, $action ) = @_;

    my $method_to_call = 'action_' . $action;
    if ( !$self->can($method_to_call) ) {
        # TODO: Write a test to cover this
        $method_to_call = 'action404';
    }

    return $self->$method_to_call();
}
# }}}

# {{{ Method: new --------------------------------------------------------------
# Usage      : FabioCicerchiaSite->new()
# Purpose    : Generate a new instance.
# Returns    : Self.
# Parameters : None.
# Throws     : No exceptions.
# See Also   : $self->{'actionCurrent'}
#            : $self->{'actionDefault'}
#            : $self->{'request'}
#            : $self->{'formatAllowed'}
#            : $self->{'formatCurrent'}
#            : $self->{'i18nDefault'}
#            : $self->{'i18nCurrent'}
#            : $ENV{'HTTP_ACCEPT_LANGUAGE'}
sub new {
    my $class = shift;
    my $self  = {
        'actionCurrent' => undef,
        'actionDefault' => 'show',
        'contentType'   => 'text/html',
        'formatAllowed' => {
            'html5'  => 'text/html',
            'rss091' => 'application/rss+xml',
            'rss092' => 'application/rss+xml',
            'rss1'   => 'application/rss+xml',
            'rss2'   => 'application/rss+xml',
            'atom'   => 'application/atom+xml',
            'vcard'  => 'text/x-vcard'
        },
        'formatCurrent' => undef,
        'formatDefault' => 'html5',
        'i18nCurrent'   => undef,
        'i18nDefault'   => 'en',
        'request'       => {
            'action' => undef,
            'format' => undef,
            'lang'   => undef
        }
    };
    bless $self, $class;

    $self->set_request();

    # Set the current action by default to "show".
    $self->{'actionCurrent'} = $self->{'actionDefault'};
    # Then use the value from the request if exists.
    if ( defined( $self->{'request'}{'action'} ) ) {
        $self->{'actionCurrent'} = $self->{'request'}{'action'};
    }

    # Set the current format by default to "html5".
    $self->{'formatCurrent'} = $self->{'formatDefault'};
    # Then use the value from the request if exists ...
    if ( defined( $self->{'request'}{'format'} ) ) {
        # ... filtering the values not authorised.
        if (
            grep { $_ eq $self->{'request'}{'format'} }
            keys $self->{'formatAllowed'}
          )
        {
            $self->{'formatCurrent'} = $self->{'request'}{'format'};
        }
    }

    # Set the current content type by default to "text/html".
    $self->{'contentType'} = $self->{'contentType'};
    # Then use the value based on the current format,
    if ( defined( $self->{'formatAllowed'}{ $self->{'formatCurrent'} } ) ) {
        $self->{'contentType'} =
          $self->{'formatAllowed'}{ $self->{'formatCurrent'} };
    }

    # Set the current language by default to "en".
    $self->{'i18nCurrent'} = $self->{'i18nDefault'};
    # Then use the value from the request or from the http header if exists.
    if ( defined( $self->{'request'}{'lang'} ) ) {
        $self->{'i18nCurrent'} = $self->{'request'}{'lang'};
    }
    elsif ( defined $ENV{'HTTP_ACCEPT_LANGUAGE'} ) {
        $self->{'i18nCurrent'} = $ENV{'HTTP_ACCEPT_LANGUAGE'};
    }

    return $self;
}
# }}} --------------------------------------------------------------------------

# {{{ Method: retrieve_xml -----------------------------------------------------
# Usage      : FabioCicerchiaSite->retrieve_xml()
# Purpose    : Retrieve XML from an URL.
# Returns    : XML::Simple object.
# Parameters : String $content.
# Throws     : No exceptions.
# See Also   : None.
sub retrieve_xml {
    my ( $self, $content ) = @_;

    my $simple = XML::Simple->new(
        'KeepRoot'   => 0,
        'KeyAttr'    => [],
        'ForceArray' => ['entity', 'project'],
        'GroupTags'  => {
            'activities'    => 'activity',
            'activities'    => 'activity',
            'methodologies' => 'methodology',
            'projects'      => 'project',
            'skills'        => 'skill',
            'techniques'    => 'technique',
            'technologies'  => 'technology',
            'tools'         => 'tool'
        }
    );

    return $simple->XMLin($content);
}
# }}} --------------------------------------------------------------------------

# {{{ Method: set_request ------------------------------------------------------
# Usage      : FabioCicerchiaSite->set_request()
# Purpose    : Set the main parameters for the request.
# Returns    : Nothing.
# Parameters : None.
# Throws     : No exceptions.
# See Also   : $self->{'request'}
#            : $ENV{'QUERY_STRING'}
sub set_request {
    my $self = shift;

    my @allowed_keys = keys $self->{'request'};

    my %get_params = ();

    # Get the slitted elements (key=value) from the query string.
    my @pairs = split /&/smx, $ENV{'QUERY_STRING'};
    foreach my $pair (@pairs) {
        # For each element slit again to key & value.
        my ( $name, $value ) = split /=/smx, $pair;

        # Start cleaning the values removing url encoding.
        $name  =~ tr/+/ /;
        $name  =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/egsmx;
        $value =~ tr/+/ /;
        $value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/egsmx;

        $get_params{$name} = $value;
    }

    while ( my ( $key, $value ) = each %get_params ) {
        if ( grep { $_ eq $key } @allowed_keys ) {
            $self->{'request'}{$key} = $value;
        }
    }

    return;
}
# }}} --------------------------------------------------------------------------

# {{{ Method: show -------------------------------------------------------------
# Usage      : FabioCicerchiaSite->show()
# Purpose    : Run the required action.
# Returns    : Nothing, just printing.
# Parameters : None.
# Throws     : No exceptions.
# See Also   : $self->{'actionCurrent'}
#            : $self->execute_action()
sub show {
    my $self = shift;

    my $output = $self->execute_action( $self->{'actionCurrent'} );
    if ( defined $output ) {
        my $r = print $output;
    }

    return;
}
# }}} --------------------------------------------------------------------------

# TODO: Generate pod.
# TODO: Test::Pod.
# TODO: Test::Pod::Coverage.
__END__

=head1 FABIOCICERCHIASITE

=head2 NAME

FabioCicerchiaSite - The Fabio Cicerchia's website class

=head2 VERSION

This documentation refers to package <FabioCicerchiaSite> version 0.1.

=head2 SYNOPSIS

    my $resume = FabioCicerchiaSite->new();
    $resume->show();

=head2 REQUIRED ARGUMENTS

No arguments are required. You need just few ENV variables:

=over

=item *
HTTP_HOST

=item *
QUERY_STRING

=item *
HTTP_ACCEPT_LANGUAGE

=back

Are needed also the following variables from the querystring:

=over

=item * action

=item * format

=item * lang

=back

=head2 DESCRIPTION

This  package analyse  some parameters  from the  environment and  from the  URL
querystring to build and execute the  proper custom & dynamical action (could be
a 404 page or a show action to view the HTML output).

The data  used to show  the information  is retrieved from  a REST API  (the XML
response will be converted in an object).

=head2 SUBROUTINES/METHODS

A separate section listing the public components of the module's interface.
These normally consist of either subroutines that may be exported, or methods
that may be called on objects belonging to the classes that the module provides.
Name the section accordingly.

In an object-oriented module, this section should begin with a sentence of the
form "An object of this class represents...", to give the reader a high-level
context to help them understand the methods that are subsequently described.

=over

=item * C<FabioCicerchiaSite-E<gt>action404()>

Print a 404 error.

=item * C<FabioCicerchiaSite-E<gt>action_show()>

The "show" action.

=item * C<FabioCicerchiaSite-E<gt>call_api()>

Call an URL and return its content.

=item * C<FabioCicerchiaSite-E<gt>elaborate_data()>

Change the data.

=item * C<FabioCicerchiaSite-E<gt>execute_action()>

Execute a custom & dynamical action.

=item * C<FabioCicerchiaSite-E<gt>get_data()>

Retrieve the multiple data from the API.

=item * C<FabioCicerchiaSite-E<gt>get_data_item()>

Retrieve the data from the API.

=item * C<FabioCicerchiaSite-E<gt>get_data_item()>

Translate a label with gettext.

=item * C<FabioCicerchiaSite-E<gt>new()>

Generate a new instance.

=item * C<FabioCicerchiaSite-E<gt>retrieve_xml()>

Retrieve XML from an URL.

=item * C<FabioCicerchiaSite-E<gt>set_request()>

Set the main parameters for the request.

=item * C<FabioCicerchiaSite-E<gt>show()>

Run the required action.

=back

=head2 DEPENDENCIES

This is the list of all the other modules that this module relies upon:

=over

=item * Date::Format

Date formating subroutines.

=item * DateTime

A date and time object.

=item * Digest::MD5

Perl interface to the MD5 Algorithm.

=item * File::Basename

Parse file paths into directory, filename and suffix.

=item * LWP

The World-Wide Web library for Perl.

=item * POSIX

Perl interface to IEEE Std 1003.1.

=item * Template

Front-end module to the Template Toolkit.

=item * XML::Simple

Easily read/write XML (esp config files).

=back

=head2 AUTHOR

Fabio Cicerchia <info@fabiocicerchia.it>

=head2 LICENCE AND COPYRIGHT

Copyright 2012 Fabio Cicerchia.

Permission is hereby  granted, free of charge, to any  person obtaining a copy
of this software and associated  documentation files (the "Software"), to deal
in the Software  without restriction, including without  limitation the rights
to  use, copy,  modify, merge,  publish, distribute,  sublicense, and/or  sell
copies  of  the Software,  and  to  permit persons  to  whom  the Software  is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE  IS PROVIDED "AS  IS", WITHOUT WARRANTY  OF ANY KIND,  EXPRESS OR
IMPLIED,  INCLUDING BUT  NOT  LIMITED TO  THE  WARRANTIES OF  MERCHANTABILITY,
FITNESS FOR  A PARTICULAR PURPOSE AND  NONINFRINGEMENT. IN NO EVENT  SHALL THE
AUTHORS  OR COPYRIGHT  HOLDERS  BE  LIABLE FOR  ANY  CLAIM,  DAMAGES OR  OTHER
LIABILITY, WHETHER IN AN ACTION OF  CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE  OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

=cut
