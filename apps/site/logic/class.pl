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
use DateTime;
use Digest::MD5;
use File::Basename;
use LWP;
use POSIX qw(mktime);
use Template;
use XML::Simple;

# {{{ new
### CLASS METHOD ###########################
# Usage      : FabioCicerchia::Site->new()
# Purpose    : Generate a new instance.
# Returns    : Self.
# Parameters : None.
# Throws     : No exceptions.
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

    $self->{'actionCurrent'} = $self->{'actionDefault'};
    if ( defined( $self->{'request'}{'action'} ) ) {
        $self->{'actionCurrent'} = $self->{'request'}{'action'};
    }

    $self->{'formatCurrent'} = $self->{'formatDefault'};
    if ( defined( $self->{'request'}{'format'} ) ) {
        if (
            grep { $_ eq $self->{'request'}{'format'} }
            keys $self->{'formatAllowed'}
          )
        {
            $self->{'formatCurrent'} = $self->{'request'}{'format'};
        }
    }

    $self->{'contentType'} = $self->{'contentType'};
    if ( defined( $self->{'formatAllowed'}{ $self->{'formatCurrent'} } ) ) {
        $self->{'contentType'} =
          $self->{'formatAllowed'}{ $self->{'formatCurrent'} };
    }

    $self->{'i18nCurrent'} = $self->{'i18nDefault'};
    if ( defined( $self->{'request'}{'lang'} ) ) {
        $self->{'i18nCurrent'} = $self->{'request'}{'lang'};
    }
    elsif ( defined $ENV{'HTTP_ACCEPT_LANGUAGE'} ) {
        $self->{'i18nCurrent'} = $ENV{'HTTP_ACCEPT_LANGUAGE'};
    }

    return $self;
}

# }}}

# {{{ set_request
### CLASS METHOD ###########################
# Usage      : FabioCicerchia::Site->set_request()
# Purpose    : Set the main parameters for the request.
# Returns    : Nothing.
# Parameters : None.
# Throws     : No exceptions
sub set_request {
    my $self = shift;

    my @allowed_keys = keys $self->{'request'};

    my %get_params = ();
    my @pairs = split /&/smx, $ENV{'QUERY_STRING'};
    foreach my $pair (@pairs) {
        my ( $name, $value ) = split /=/smx, $pair;
        $name  =~ tr/+/ /;
        $name  =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/egsmx;
        $value =~ tr/+/ /;
        $value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/egsmx;
        $get_params{$name} = $value;
    }

    while ( my ( $key, $value ) = each %get_params ) {
        if ( grep { $_ eq $key } @allowed_keys ) {
            $self->{request}{$key} = $value;
        }
    }

    return;
}

# }}}

# {{{ show
### CLASS METHOD ###########################
# Usage      : FabioCicerchia::Site->show()
# Purpose    : Run the required action.
# Returns    : Nothing, just printing.
# Parameters : None.
# Throws     : No exceptions.
# See Also   : $self->execute_action()
sub show {
    my $self = shift;

    my $output = $self->execute_action( $self->{'actionCurrent'} );
    if ( defined $output ) {
        my $r = print $output;
    }

    return;
}

# }}}

# {{{ execute_action
### CLASS METHOD ###########################
# Usage      : FabioCicerchia::Site->execute_action()
# Purpose    : Execute a custom & dynamical action.
# Returns    : A string, the output that will be printed.
# Parameters : A string, the action name.
# Throws     : No exceptions.
sub execute_action {
    my ( $self, $action ) = @_;

    my $method_to_call = 'action_' . $action;
    if ( !$self->can($method_to_call) ) {
        $method_to_call = 'action404';
    }

    return $self->$method_to_call();
}

# }}}

# {{{ action404
### CLASS METHOD ###########################
# Usage      : FabioCicerchia::Site->action404()
# Purpose    : Print a 404 error.
# Returns    : Nothing, just printing.
# Parameters : None.
# Throws     : No exceptions.
sub action404 {
    my $self = shift;

    my $r = print "HTTP/1.1 404 Not Found\n\n";
    $r = print "Location: /\n\n";

    return;
}

# }}}

# {{{ action_show
### CLASS METHOD ###########################
# Usage      : FabioCicerchia::Site->action_show()
# Purpose    : The "show" action.
# Returns    : Nothing, just printing.
# Parameters : None.
# Throws     : No exceptions.
# See Also   : $self->retrieve_xml()
sub action_show {
    my $self = shift;

    my $general_data  = $self->get_data();
    my $data          = $general_data->[0];
    my $last_modified = $general_data->[1];
    my $etag          = $general_data->[2];
    my $language      = $general_data->[3];

    my $vars = {
        'HTTP_HOST'     => $ENV{'HTTP_HOST'},
        'data'          => $data,
        'last_modified' => $last_modified,
        'language'      => $language
    };

    #TODO: IMPLEMENT IF NOT MODIFIED
    my $r = print 'Cache-Control: public, max-age=28800, smax-age=28800' . "\n";
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
    my $template =
      Template->new( INCLUDE_PATH => [ dirname(__FILE__) . '/../view' ] );

    $template->process( $self->{'formatCurrent'} . '.tmpl', $vars );

    return q{};
}

# }}}

# {{{ get_data
### CLASS METHOD ###########################
# Usage      : FabioCicerchia::Site->get_data()
# Purpose    : Retrieve the data from the API.
# Returns    : Array.
# Parameters : None.
# Throws     : No exceptions.
# See Also   : $self->get_item_data()
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

        my @response =
          $self->get_item_data( q{/} . $url, $self->{'i18nCurrent'} );
        my ( $curr_data, $curr_ts, $curr_hash, $curr_lang ) = @{ $response[0] };

        $data->{$api} = $curr_data;
        $hash = defined $curr_hash ? ( $hash . $curr_hash ) : $hash;
        $lang = defined $curr_lang ? $curr_lang             : $lang;

        if ( defined $curr_ts && $curr_ts > $last_ts ) {
            $last_ts = $curr_ts;
        }
    }
    $ctx->add($hash);

    $data = $self->elaborate_data($data);

    return [ $data, $last_ts, $ctx->hexdigest, $lang ];
}

# }}}

# {{{ elaborate_data
### CLASS METHOD ###########################
# Usage      : FabioCicerchia::Site->elaborate_data()
# Purpose    : Change the data.
# Returns    : An Hash, the input hash but modified.
# Parameters : Hash $data.
# Throws     : No exceptions.
sub elaborate_data {
    my ( $self, $data ) = @_;

    my $tmp;
    my $values;
    foreach my $key ( keys $data->{'skill'}->{'entity'} ) {
        $tmp    = {};
        $values = $data->{'skill'}->{'entity'}->[$key]->{'content'}->{'skills'};
        foreach my $key2 ( keys $values ) {
            my $item = $values->[$key2];
            if ( !exists( $tmp->{ $item->{'level'} } ) ) {
                $tmp->{ $item->{'level'} } = [];
            }
            push $tmp->{ $item->{'level'} }, $item->{'title'}->{'content'};
        }
        $data->{'skill'}->{'entity'}->[$key]->{'content'}->{'skills'} = $tmp;
    }

    return $data;
}

# }}}

# {{{ get_item_data
### CLASS METHOD ###########################
# Usage      : FabioCicerchia::Site->get_data()
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
        $last_modified = $response->headers()->{'last-modified'};
    }

    if ( $last_modified ne q{} ) {
        my ( $wday, $day, $month, $year, $hour, $min, $sec ) =
          split /[\s:]/smx, $last_modified;
        $ts = POSIX::mktime(
            $sec, $min, $hour, $day,
            $mon2num{ lc $month } - 1,
            $year - 1900
        );
    }

    $ctx->add( $response->content() );

    return [
        $data,           $ts,
        $ctx->hexdigest, $response->headers()->{'content-language'}
    ];
}

# }}}

# {{{ retrieve_xml
### CLASS METHOD ###########################
# Usage      : FabioCicerchia::Site->retrieve_xml()
# Purpose    : Retrieve XML from an URL.
# Returns    : XML::Simple object.
# Parameters : String $content.
# Throws     : No exceptions.
# See Also   : $self->call_api()
sub retrieve_xml {
    my ( $self, $content ) = @_;

    my $simple = XML::Simple->new(
        'KeepRoot'   => 0,
        'KeyAttr'    => [],
        'ForceArray' => ['entity'],
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

# }}}

# {{{ call_api
### CLASS METHOD ###########################
# Usage      : FabioCicerchia::Site->call_api()
# Purpose    : Call an URL and return its content.
# Returns    : String, the output of the URL.
# Parameters : String $url, String $language.
# Throws     : No exceptions.
sub call_api {
    my ( $self, $url, $language ) = @_;

    my $browser = LWP::UserAgent->new();
    $browser->timeout(10);
    $browser->default_header( 'Accept-Language' => $language );
    $browser->default_header( 'Accept' => 'application/vnd.ads+xml;v=1.0' );

    return $browser->get( 'http://' . $ENV{'HTTP_HOST'} . '/api.php' . $url );
}

# }}}
