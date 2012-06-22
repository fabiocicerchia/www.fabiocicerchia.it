#!/usr/bin/perl -w
#
# FABIO CICERCHIA - WEBSITE
#
# Perl Version 5
#
# @category  Site
# @package   Site
# @author    Fabio Cicerchia <info@fabiocicerchia.it>
# @copyright 2012 Fabio Cicerchia. All Rights reserved.
# @license   TBD <http://www.fabiocicerchia.it>
# @link      http://www.fabiocicerchia.it
#

#use strict;
use warnings;
use Template; # NOTICE: MISSING MODULE
use File::Basename;
use XML::Simple; # NOTICE: MISSING MODULE
use Data::Dumper;
use LWP;

############################################
# Usage      : Config::Auto->get_defaults( )
# Purpose    : Defaults for 'new'
# Returns    : A hash of defaults
# Parameters : none
# Throws     : no exceptions
# Comments   : No corresponding attribute,
#            : gathers data from each
#            : attr_def attribute
# See Also   : $self->set_default( )
sub callAPI {
    my ($url, $language) = @_;

    my $browser = LWP::UserAgent->new();
    $browser->timeout(10);
    $browser->default_header('Accept-Language' => $language);
    $browser->default_header('Accept' => 'application/vnd.ads+xml;v=1.0');

    return $browser->get('http://' . $ENV{'HTTP_HOST'} . '/api.php' . $url);
}

sub retrieveXML {
    my $response = callAPI(@_);
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

my $current_lang = exists($ENV{'language'})
                   ? $ENV{'language'}
                   : $ENV{'HTTP_ACCEPT_LANGUAGE'};

my $data = {
    'root'        => retrieveXML('/',            $current_lang),
    'information' => retrieveXML('/information', $current_lang),
    'education'   => retrieveXML('/education',   $current_lang),
    'experience'  => retrieveXML('/experience',  $current_lang),
    'skill'       => retrieveXML('/skill',       $current_lang),
    'language'    => retrieveXML('/language',    $current_lang)
};

my $tmp, $values;
foreach $key (keys $data->{'skill'}->{'entity'}) {
    $tmp = {};
    $values = $data->{'skill'}->{'entity'}->[$key]->{'content'}->{'skills'};
    foreach $key2 (keys $values) {
        $item = $values->[$key2];
        if (!exists($tmp->{$item->{'level'}})) {
            $tmp->{$item->{'level'}} = [];
        }
        push $tmp->{$item->{'level'}}, $item->{'title'}->{'content'};
    }
    $data->{'skill'}->{'entity'}->[$key]->{'content'}->{'skills'} = $tmp;
}

my $file = 'index.tmpl';
my $template = Template->new(
    INCLUDE_PATH => [dirname(__FILE__) . '/../view']
);
my $vars = {
    'HTTP_HOST' => $ENV{'HTTP_HOST'},
    'data'      => $data
};

# http://template-toolkit.org/docs/tutorial/Web.html
print "Content-Type: text/html\n\n";

#print Dumper($data);
$template->process($file, $vars) || die $template->error();

__END__

=head1 NAME
<application name> – <One-line description of application's purpose>

=head1 VERSION
The initial template usually just has:
This documentation refers to <application name> version 0.0.1.

=head1 USAGE
    # Brief working invocation example(s) here showing the most common usage(s)
    # This section will be as far as many users ever read,
    # so make it as educational and exemplary as possible.

=head1 REQUIRED ARGUMENTS
A complete list of every argument that must appear on the command line.
when the application is invoked, explaining what each of them does, any
restrictions on where each one may appear (i.e., flags that must appear
before or after filenames), and how the various arguments and options
may interact (e.g., mutual exclusions, required combinations, etc.)
If all of the application's arguments are optional, this section
may be omitted entirely.

=head1 OPTIONS
A complete list of every available option with which the application
can be invoked, explaining what each does, and listing any restrictions,
or interactions.
If the application has no options, this section may be omitted entirely.

=head1 DESCRIPTION
A full description of the application and its features.
May include numerous subsections (i.e., =head2, =head3, etc.).

=head1 DIAGNOSTICS
A list of every error and warning message that the application can generate
(even the ones that will "never happen"), with a full explanation of each
problem, one or more likely causes, and any suggested remedies. If the
application generates exit status codes (e.g., under Unix), then list the exit
status associated with each error.

=head1 CONFIGURATION AND ENVIRONMENT
A full explanation of any configuration system(s) used by the application,
including the names and locations of any configuration files, and the
meaning of any environment variables or properties that can be set. These
descriptions must also include details of any configuration language used.
(See also “Configuration Files” in Chapter 19.)
