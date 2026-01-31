import json
import os
from datetime import datetime

team_name = "Your Team Name"
language = "Python"
date_time = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
ip_address = os.environ.get('REMOTE_ADDR', 'Unknown')

response = {
    'team': team_name,
    'language': language,
    'datetime': date_time,
    'ip_address': ip_address
}

print("Content-Type: application/json\n")
print(json.dumps(response, indent=2))