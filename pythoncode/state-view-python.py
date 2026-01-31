#!/usr/bin/python3
import os
import http.cookies

# 1. Load Cookie from environment
cookie = http.cookies.SimpleCookie()
cookie_string = os.environ.get('HTTP_COOKIE', '')
if cookie_string:
    cookie.load(cookie_string)

saved_data = cookie.get('saved_data')

# 2. Display HTML
print("Content-Type: text/html\n")
print(f"""<!DOCTYPE html>
<html>
<head><title>Python State View</title></head>
<body>
    <h1>Python State Management - View</h1>
    <div style="border: 2px solid #2980b9; padding: 20px;">
        <strong>Data retrieved from Cookie:</strong> 
        {saved_data.value if saved_data else "No data found."}
    </div>
    <p><a href="state-python.py">Return to Entry Screen</a></p>
    <p><a href="state-python.py?action=clear" style="color: red;">Clear Cookie</a></p>
</body>
</html>""")