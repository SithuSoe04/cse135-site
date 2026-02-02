#!/usr/bin/perl
use CGI;
use CGI::Session;
use strict;
use warnings;

# 1. Initialize CGI and Session
my $cgi = CGI->new;
my $sid = $cgi->cookie('CGISESSID') || undef;
my $session = new CGI::Session("driver:File", $sid, {Directory=>"/tmp"});

# 2. Handle Logic BEFORE Printing Headers
if ($cgi->request_method() eq 'POST') {
    if ($cgi->param('clear')) {
        # Clear the session on the server and expire the cookie
        $session->delete();
        $session->flush();
        my $cookie = $cgi->cookie(-name=>'CGISESSID', -value=>'', -expires=>'-1d');
        print $cgi->redirect(-uri=>'perl-session-1.pl', -cookie=>$cookie);
        exit;
    } elsif ($cgi->param('user_data')) {
        # Save data to session
        $session->param('persistent_data', $cgi->param('user_data'));
    }
}

# 3. Output Headers
my $cookie = $cgi->cookie(CGISESSID => $session->id);
print $cgi->header(-type => 'text/html', -cookie => $cookie);

# 4. Display UI
print <<HTML;
<!DOCTYPE html>
<html>
<head><title>Perl Session 1</title></head>
<body>
    <h1>Perl State Management - Page 1</h1>
    
    <form method="POST">
        <label>Enter information to save:</label><br>
        <input type="text" name="user_data" placeholder="e.g., Team Member Name">
        <button type="submit">Save to Session</button>
    </form>

    <hr>
    <p><a href="perl-session-2.pl">Go to Page 2 to see if data persists</a></p>

    <form method="POST">
        <input type="hidden" name="clear" value="1">
        <button type="submit" style="color:red;">Clear Perl Session</button>
    </form>
</body>
</html>
HTML