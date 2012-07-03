#!/usr/bin/perl

use strict;
use warnings;
use version; our $VERSION = qv('1.0');
use Perl::Critic;

while ( my $file = shift ) {
    my $r = print "ANALISYS OF '$file'\n\n";

    # gentle | stern | harsh | cruel | brutal
    my $critic = Perl::Critic->new( -severity => 'brutal' );
    my @violations = $critic->critique($file);

    $r = print @violations;
}
