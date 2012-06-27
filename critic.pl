#!/usr/bin/perl

use Perl::Critic;

my $file = shift;

print "ANALISYS OF '$file'\n\n";

my $critic = Perl::Critic->new(-severity => 'harsh'); # gentle | stern | harsh | cruel | brutal
my @violations = $critic->critique($file);

print @violations;
