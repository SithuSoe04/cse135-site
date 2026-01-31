import os
import sys
import urllib.parse
import http.cookies
import json
from datetime import datetime, timedelta

# Parse cookies
cookie = http.cookies.SimpleCookie()
cookie_string = os.environ.get('HTTP_COOKIE', '')
if cookie_string:
    cookie.load(cookie_string)

# Get saved data from cookie
saved_data = cookie.get('saved_data')
saved_at = cookie.get('saved_at')

# Handle POST request (save data)
method = os.environ.get('REQUEST_METHOD', 'GET')
query_string = os.environ.get('QUERY_STRING', '')
query_params = dict(urllib.parse.parse_qsl(query_string))

if method == 'POST':
    content_length = int(os.environ.get('CONTENT_LENGTH', 0))
    if content_length > 0:
        post_data = sys.stdin.read(content_length)
        params = dict(urllib.parse.parse_qsl(post_data))
        
        if 'data' in params:
            # Set cookie with data
            new_cookie = http.cookies.SimpleCookie()
            new_cookie['saved_data'] = params['data']
            new_cookie['saved_data']['path'] = '/'
            new_cookie['saved_at'] = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
            new_cookie['saved_at']['path'] = '/'
            
            print(new_cookie.output())
            print("Location: state-python.py\n")
            sys.exit()

# Handle clear action
if query_params.get('action') == 'clear':
    # Clear cookies by setting expiration to the past
    clear_cookie = http.cookies.SimpleCookie()
    clear_cookie['saved_data'] = ''
    clear_cookie['saved_data']['path'] = '/'
    clear_cookie['saved_data']['expires'] = 'Thu, 01 Jan 1970 00:00:00 GMT'
    clear_cookie['saved_at'] = ''
    clear_cookie['saved_at']['path'] = '/'
    clear_cookie['saved_at']['expires'] = 'Thu, 01 Jan 1970 00:00:00 GMT'
    
    print(clear_cookie.output())
    print("Location: state-python.py\n")
    sys.exit()

# Display HTML
print("Content-Type: text/html\n")
print(f"""<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>State Demo - Python</title>
</head>
<body>
    <h1>State Management Demo - Python (Cookies)</h1>
    
    <h2>Save Data</h2>
    <form method="POST">
        <label for="data">Enter data to save:</label><br>
        <input type="text" id="data" name="data" size="50"><br><br>
        <button type="submit">Save</button>
    </form>
    
    <h2>Current Saved Data</h2>""")

if saved_data and saved_data.value:
    print(f"""    <p><strong>Data:</strong> {saved_data.value}</p>
    <p><strong>Saved at:</strong> {saved_at.value if saved_at else 'Unknown'}</p>
    <a href="state-python.py?action=clear">Clear Data</a>""")
else:
    print("""    <p>No data saved yet.</p>""")

print("""</body>
</html>""")