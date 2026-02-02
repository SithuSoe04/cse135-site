#!/usr/bin/perl
use strict;
use warnings;
use CGI;
use JSON;
use Socket; 

# 1. Capture Environment Variables
my $method       = $ENV{'REQUEST_METHOD'} || 'GET';
my $content_type = $ENV{'CONTENT_TYPE'} || '';
my $ip_address   = $ENV{'REMOTE_ADDR'} || 'Unknown';
my $user_agent   = $ENV{'HTTP_USER_AGENT'} || 'Unknown'; 
my $hostname     = `hostname` || 'Unknown';
chomp($hostname);
my $date_time    = scalar localtime();

my $received_data;

# 2. Handle Data Retrieval (Logic remains the same)
if ($method eq 'GET') {
    my $query_string = $ENV{'QUERY_STRING'} || '';
    my $cgi = CGI->new($query_string);
    $received_data = { $cgi->Vars };
} else {
    my $raw_input = "";
    my $content_length = $ENV{'CONTENT_LENGTH'} || 0;
    if ($content_length > 0) {
        read(STDIN, $raw_input, $content_length);
    }

    if ($content_type =~ /application\/json/i) {
        eval { $received_data = decode_json($raw_input); };
        if ($@) { $received_data = { raw => $raw_input, error => "Invalid JSON" }; }
    } else {
        my $cgi = CGI->new($raw_input);
        $received_data = { $cgi->Vars };
    }
}

# 3. Construct Response Hash
my %response = (
    language      => "Perl",
    method        => $method,
    content_type  => $content_type,
    hostname      => $hostname,
    datetime      => $date_time,
    user_agent    => $user_agent, 
    ip_address    => $ip_address,
    received_data => $received_data
);

# 4. Mandatory CGI Header and Pretty-Printed Output
print "Content-Type: application/json\n\n";

my $json_text = JSON->new->utf8->pretty->encode(\%response);
print $json_text;