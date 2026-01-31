#!/usr/bin/python3
import json
import os
from datetime import datetime

team_name = "Sithu Soe and Phyo thant"
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