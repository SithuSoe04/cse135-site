#!/usr/bin/perl
use CGI;
use CGI::Session;
use strict;
use warnings;

my $cgi = CGI->new;
my $sid = $cgi->cookie('CGISESSID') || undef;
my $session = new CGI::Session("driver:File", $sid, {Directory=>"/tmp"});

print $cgi->header(-type => 'text/html');

my $saved = $session->param('persistent_data') || "<em>No data found in session.</em>";

print <<HTML;
<!DOCTYPE html>
<html>
<head><title>Perl Session 2</title></head>
<body>
    <h1>Perl State Management - Page 2</h1>
    <div style="border: 2px solid #8e44ad; padding: 20px; background: #f4ecf7;">
        <strong>Data retrieved from Perl Session:</strong> $saved
    </div>
    <p><a href="perl-session-1.pl">Back to Page 1</a></p>
</body>
</html>
HTML