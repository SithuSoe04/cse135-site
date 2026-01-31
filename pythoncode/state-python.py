#!/usr/bin/python3
import os
import sys
import urllib.parse
import http.cookies
from datetime import datetime

# 1. Handle CLEAR action via GET parameter
query_string = os.environ.get('QUERY_STRING', '')
query_params = dict(urllib.parse.parse_qsl(query_string))

if query_params.get('action') == 'clear':
    clear_cookie = http.cookies.SimpleCookie()
    clear_cookie['saved_data'] = ''
    clear_cookie['saved_data']['path'] = '/'
    # Set expiration to the past to delete it
    clear_cookie['saved_data']['expires'] = 'Thu, 01 Jan 1970 00:00:00 GMT'
    
    print(clear_cookie.output())
    print("Location: state-python.py\n")
    sys.exit()

# 2. Handle SAVE action via POST
method = os.environ.get('REQUEST_METHOD', 'GET')
if method == 'POST':
    content_length = int(os.environ.get('CONTENT_LENGTH', 0))
    post_data = sys.stdin.read(content_length)
    params = dict(urllib.parse.parse_qsl(post_data))
    
    if 'data' in params:
        cookie = http.cookies.SimpleCookie()
        cookie['saved_data'] = params['data']
        cookie['saved_data']['path'] = '/'
        
        print(cookie.output())
        print("Location: state-python.py\n")
        sys.exit()

# 3. Display Entry UI
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