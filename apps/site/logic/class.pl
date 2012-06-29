#!/usr/bin/perl -w
#
# FABIO CICERCHIA - WEBSITE
#
# Perl Version 5
#
# @category  Code
# @package   Site
# @author    Fabio Cicerchia <info@fabiocicerchia.it>
# @copyright 2012 Fabio Cicerchia. All Rights reserved.
# @license   TBD <http://www.fabiocicerchia.it>
# @link      http://www.fabiocicerchia.it
#

package FabioCicerchiaSite;

use strict;
use warnings;
use Data::Dumper;
use Date::Format;
use DateTime;
use Digest::MD5;
use File::Basename;
use HTTP::Cache::Transparent;
use LWP;
use POSIX qw(mktime);
use Template;
use XML::Simple;

# {{{ new
############################################
# Usage      : FabioCicerchia::Site->new()
# Purpose    : Generate a new instance.
# Returns    : Self.
# Parameters : None.
# Throws     : No exceptions.
sub new
{
    my $class = shift;
    my $self = {
        'actionCurrent'     => undef,
        'actionDefault'     => 'show',
        'baseUrl'           => undef,
        'cacheTimeout'      => 86400, # 24 * 60 * 60
        'contentType'       => 'text/html',
        'filterOutput'      => 1,
        'formatCurrent'     => undef,
        'formatDefault'     => 'html5',
        'i18nAllowed'       => ['it', 'en'],
        'i18nCurrent'       => undef,
        'i18nDefault'       => 'en',
        'request'           => {
            'action' => undef,
            'expand' => undef,
            'f'      => undef,
            'format' => undef,
            'lang'   => undef
        },
    };
    bless $self, $class;

    $self->setRequest();

    $self->{'actionCurrent'} = defined($self->{'request'}{'action'})
                               ? $self->{'request'}{'action'}
                               : $self->{'actionDefault'};

    $self->{'formatCurrent'} = defined($self->{'request'}{'format'})
                               ? $self->{'request'}{'format'}
                               : $self->{'formatDefault'};

    $self->{'i18nCurrent'} = defined($self->{'request'}{'lang'})
                             ? $self->{'request'}{'lang'}
                             : defined($ENV{'HTTP_ACCEPT_LANGUAGE'})
                               ? $ENV{'HTTP_ACCEPT_LANGUAGE'}
                               : $self->{'i18nDefault'};

    my $tmp = dirname($ENV{'SCRIPT_FILENAME'});
    $tmp =~ s/$ENV{'DOCUMENT_ROOT'}//x;
    $self->{'baseUrl'} = '/' . $tmp . '/';
    $self->{'baseUrl'} =~ s/\/\//\//gx;
    if ($self->{'baseUrl'} eq $ENV{'DOCUMENT_ROOT'}) {
        $self->{'baseUrl'} = '/';
    }

    return $self;
}
# }}}

# {{{ show
############################################
# Usage      : FabioCicerchia::Site->show()
# Purpose    : Run the required action.
# Returns    : Nothing, just printing.
# Parameters : None.
# Throws     : No exceptions.
# See Also   : $self->executeAction()
sub show
{
    my $self = shift;

    my $output = $self->executeAction($self->{'actionCurrent'});
    if (defined($output)) {
        print $output;
    }

    return;
}
# }}}

# {{{ executeAction
############################################
# Usage      : FabioCicerchia::Site->executeAction()
# Purpose    : Execute a custom & dynamical action.
# Returns    : A string, the output that will be printed.
# Parameters : A string, the action name.
# Throws     : No exceptions.
sub executeAction
{
    my ($self, $action) = @_;

    my $methodToCall = 'action' . ucfirst($action);
    if (!$self->can($methodToCall)) {
        $methodToCall = 'action404';
    }

    return $self->$methodToCall();
}
# }}}

# {{{ actionShow
############################################
# Usage      : FabioCicerchia::Site->actionShow()
# Purpose    : The "show" action.
# Returns    : Nothing, just printing.
# Parameters : None.
# Throws     : No exceptions.
# See Also   : $self->retrieveXML()
sub actionShow
{
    my $self = shift;

    my $data = $self->getData();
    my $vars = {
        'HTTP_HOST' => $ENV{'HTTP_HOST'},
        'data'      => $data->[0]
    };

    #TODO: IMPLEMENT IF NOT MODIFIED
    print "Cache-Control: public, max-age=28800, smax-age=28800\n";
    print "Last-Modified: " . time2str("%a, %d %b %Y %H:%M:%S GMT", $data->[1]) . "\n";
    print "ETag: \"" . $data->[2] . "\"\n";
    print "Content-Type: " . $self->{'contentType'} . "; charset=UTF-8\n";
    print "Content-Language: " . $self->{'i18nCurrent'} . "\n";
    print "\n";

    # http://template-toolkit.org/docs/tutorial/Web.html
    my $template = Template->new(
        INCLUDE_PATH => [dirname(__FILE__) . '/../view']
    );

    $template->process('index.tmpl', $vars);

    return "";
}
# }}}

# {{{ elaborateData
############################################
# Usage      : FabioCicerchia::Site->elaborateData()
# Purpose    : Change the data.
# Returns    : An Hash, the input hash but modified.
# Parameters : Hash $data.
# Throws     : No exceptions.
sub elaborateData
{
    my ($self, $data) = @_;

    my $tmp;
    my $values;
    foreach my $key (keys $data->{'skill'}->{'entity'}) {
        $tmp = {};
        $values = $data->{'skill'}->{'entity'}->[$key]->{'content'}->{'skills'};
        foreach my $key2 (keys $values) {
            my $item = $values->[$key2];
            if (!exists($tmp->{$item->{'level'}})) {
                $tmp->{$item->{'level'}} = [];
            }
            push $tmp->{$item->{'level'}}, $item->{'title'}->{'content'};
        }
        $data->{'skill'}->{'entity'}->[$key]->{'content'}->{'skills'} = $tmp;
    }

    return $data;
}
# }}}

# {{{ action404
############################################
# Usage      : FabioCicerchia::Site->action404()
# Purpose    : Print a 404 error.
# Returns    : Nothing, just printing.
# Parameters : None.
# Throws     : No exceptions.
sub action404
{
    my $self = shift;

    print "HTTP/1.1 404 Not Found\n\n";
    print "Location: /\n\n";

    return;
}
# }}}

# {{{ setRequest
############################################
# Usage      : FabioCicerchia::Site->setRequest()
# Purpose    : Set the main parameters for the request.
# Returns    : Nothing.
# Parameters : None.
# Throws     : No exceptions
sub setRequest
{
    my $self = shift;

    my @allowed_keys = keys $self->{'request'};

    my %get_params = ();
    my @pairs = split(/&/x, $ENV{'QUERY_STRING'});
    foreach my $pair (@pairs) {
        my ($name, $value) = split(/=/x, $pair);
        $name =~ tr/+/ /;
        $name =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/egx;
        $value =~ tr/+/ /;
        $value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/egx;
        $get_params{$name} = $value;
    }

    while (my ($key, $value) = each(%get_params)) {
        if (grep { $_ eq $key } @allowed_keys) {
            $self->{request}{$key} = $value;
        }
    }

    return;
}
# }}}

# {{{ callAPI
############################################
# Usage      : FabioCicerchia::Site->callAPI()
# Purpose    : Call an URL and return its content.
# Returns    : String, the output of the URL.
# Parameters : String $url, String $language.
# Throws     : No exceptions.
sub callAPI
{
    my ($self, $url, $language) = @_;

    HTTP::Cache::Transparent::init({
        BasePath => "/home/fabio/Web/fabiocicerchia.github.com/cache/site", # TODO: CHANGE
        MaxAge   => 8 * 24,
        NoUpdate => 15 * 60,
    });

    my $browser = LWP::UserAgent->new();
    $browser->timeout(10);
    $browser->default_header('Accept-Language' => $language);
    $browser->default_header('Accept' => 'application/vnd.ads+xml;v=1.0');

    my $host = exists($ENV{'HTTP_HOST'})
               ? $ENV{'HTTP_HOST'}
               : 'fabiocicerchia.github'; # TODO: CHANGE THIS

    return $browser->get('http://' . $host . '/api.php' . $url);
}
# }}}

# {{{ retrieveXML
############################################
# Usage      : FabioCicerchia::Site->retrieveXML()
# Purpose    : Retrieve XML from an URL.
# Returns    : XML::Simple object.
# Parameters : String $content.
# Throws     : No exceptions.
# See Also   : $self->callAPI()
sub retrieveXML
{
    my ($self, $content) = @_;

    my $simple   = XML::Simple->new(
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

# {{{ getData
############################################
# Usage      : FabioCicerchia::Site->getData()
# Purpose    : Retrieve the data from the API.
# Returns    : Array.
# Parameters : None.
# Throws     : No exceptions.
# See Also   : $self->getItemData()
sub getData
{
    my $self = shift;

    my $ctx = Digest::MD5->new;
    my $data    = {};
    my $last_ts = 0;
    my $hash;
    my $response;
    my $url;

    my @api_list = ('root', 'information', 'education', 'experience', 'skill', 'language');

    API:
    foreach my $api (@api_list) {
        $url = $api eq 'root' ? '' : $api;

        $response     = $self->getItemData('/' . $url, $self->{'i18nCurrent'});
        $data->{$api} = $response->[0];
        $hash         = $hash . $response->[2];

        if ($response->[1] > $last_ts) {
            $last_ts = $response->[1];
        }
    }
    $ctx->add($hash);

    $data = $self->elaborateData($data);

    return [$data, $last_ts, $ctx->hexdigest];
}
# }}}

# {{{ getItemData
############################################
# Usage      : FabioCicerchia::Site->getData()
# Purpose    : Retrieve the data from the API.
# Returns    : Array.
# Parameters : String $url, String $language.
# Throws     : No exceptions.
# See Also   : $self->callAPI()
#            : $self->retrieveXML()
sub getItemData
{
    my ($self, $url, $language) = @_;

    my %mon2num = qw(jan 1 feb 2 mar 3 apr 4 may 5 jun 6 jul 7 aug 8 sep 9 oct 10 nov 11 dec 12);
    my $ctx = Digest::MD5->new;
    my $ts = 0;

    my $response      = $self->callAPI($url, $language);
    my $data          = $self->retrieveXML($response->content());
    my $last_modified = defined($response->headers()->{'last-modified'})
                        ? $response->headers()->{'last-modified'}
                        : "";
    if ($last_modified ne "") {
        my @date = split(/[\s:]/x, $last_modified);
        $ts      = POSIX::mktime($date[6], $date[5], $date[4], $date[1], $mon2num{lc $date[2]} - 1, $date[3] - 1900);
    }

    $ctx->add($response->content());

    return [$data, $ts, $ctx->hexdigest];
}
# }}}
