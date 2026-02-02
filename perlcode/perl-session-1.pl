#!/usr/bin/perl
use CGI;
use CGI::Session;
use strict;
use warnings;

# Initialize Session and CGI
# Note: Ensure /tmp is writable for the File driver
my $session = new CGI::Session("driver:File", undef, {Directory=>"/tmp"});
my $cgi = CGI->new;

# Handle POST data to save to session
if ($cgi->request_method() eq 'POST') {
    my $user_data = $cgi->param('user_data');
    if ($user_data) {
        $session->param('persistent_data', $user_data);
    }
}

# Create session cookie and output header
my $cookie = $cgi->cookie(CGISESSID => $session->id);
print $cgi->header(-type => 'text/html', -cookie => $cookie);

# Display UI
print <<HTML;
<!DOCTYPE html>
<html>
<head><title>Perl Session 1</title></head>
<body>
    <h1>Perl State Management - Page 1</h1>
    <form method="POST">
        <label>Enter information to save in Perl Session:</label><br>
        <input type="text" name="user_data" placeholder="e.g., Team Member Name">
        <button type="submit">Save to Session</button>
    </form>
    <hr>
    <h3>Current Session Content:</h3>
    <p>
HTML

my $saved = $session->param('persistent_data');
print $saved ? $saved : "No data saved yet.";

print <<HTML;
    </p>
    <p><a href="perl-session-2.pl">Go to Page 2 to see if data persists</a></p>
</body>
</html>
HTML