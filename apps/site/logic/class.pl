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
use Template; # NOTICE: MISSING MODULE
use File::Basename;
use XML::Simple; # NOTICE: MISSING MODULE
use LWP;

# {{{ new
############################################
# Usage      : FabioCicerchia::Site->new()
# Purpose    : Defaults for 'new'
# Returns    : A hash of defaults
# Parameters : none
# Throws     : no exceptions
# Comments   : No corresponding attribute,
#            : gathers data from each
#            : attr_def attribute
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

    my $data = {
        'root'        => $self->retrieveXML('/',            $self->{'i18nCurrent'}),
        'information' => $self->retrieveXML('/information', $self->{'i18nCurrent'}),
        'education'   => $self->retrieveXML('/education',   $self->{'i18nCurrent'}),
        'experience'  => $self->retrieveXML('/experience',  $self->{'i18nCurrent'}),
        'skill'       => $self->retrieveXML('/skill',       $self->{'i18nCurrent'}),
        'language'    => $self->retrieveXML('/language',    $self->{'i18nCurrent'})
    };

    $data = $self->elaborateData($data);

    my $vars = {
        'HTTP_HOST' => $ENV{'HTTP_HOST'},
        'data'      => $data
    };

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
# Parameters : String $url, String $language.
# Throws     : No exceptions.
# See Also   : $self->callAPI()
sub retrieveXML
{
    my ($self, $url, $language) = @_;

    my $response = $self->callAPI($url, $language);
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

    return $simple->XMLin($response->content());
}
# }}}
