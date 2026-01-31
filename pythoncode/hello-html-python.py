import os
from datetime import datetime

team_name = "Your Team Name"
language = "Python"
date_time = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
ip_address = os.environ.get('REMOTE_ADDR', 'Unknown')

print("Content-Type: text/html\n")
print(f"""<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hello HTML - Python</title>
</head>
<body>
    <h1>Hello from {team_name}!</h1>
    <p><strong>Language:</strong> {language}</p>
    <p><strong>Generated at:</strong> {date_time}</p>
    <p><strong>Your IP Address:</strong> {ip_address}</p>
</body>
</html>""")
