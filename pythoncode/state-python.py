#!/usr/bin/python3
import os
import sys
import urllib.parse
import http.cookies
from datetime import datetime

# 1. Handle POST request to save data
method = os.environ.get('REQUEST_METHOD', 'GET')
if method == 'POST':
    content_length = int(os.environ.get('CONTENT_LENGTH', 0))
    post_data = sys.stdin.read(content_length)
    params = dict(urllib.parse.parse_qsl(post_data))
    
    if 'data' in params:
        # Create cookie
        cookie = http.cookies.SimpleCookie()
        cookie['saved_data'] = params['data']
        cookie['saved_data']['path'] = '/'
        
        # Redirect back to this page to show it saved
        print(cookie.output())
        print("Location: state-python.py\n")
        sys.exit()

# 2. Display HTML
print("Content-Type: text/html\n")
print(f"""<!DOCTYPE html>
<html>
<head><title>Python State Entry</title></head>
<body>
    <h1>Python State Management - Entry</h1>
    <form method="POST">
        <label>Enter information to save in Cookie:</label><br>
        <input type="text" name="data" placeholder="e.g., Team Member Name">
        <button type="submit">Save to Cookie</button>
    </form>
    <hr>
    <p><a href="state-view-python.py">Go to the second screen to see if data persists</a></p>
</body>
</html>""")