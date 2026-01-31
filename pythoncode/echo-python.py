#!/usr/bin/python3
import sys
import os
import json
import urllib.parse
from datetime import datetime
import socket

method = os.environ.get('REQUEST_METHOD', 'GET')
content_type = os.environ.get('CONTENT_TYPE', '')
date_time = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
ip_address = os.environ.get('REMOTE_ADDR', 'Unknown')
user_agent = os.environ.get('HTTP_USER_AGENT', 'Unknown')
hostname = socket.gethostname()

received_data = None

if method == 'GET':
    query_string = os.environ.get('QUERY_STRING', '')
    if query_string:
        received_data = dict(urllib.parse.parse_qsl(query_string))
    else:
        received_data = {}
elif method in ['POST', 'PUT', 'DELETE']:
    if 'application/json' in content_type:
        raw_input = sys.stdin.read()
        if raw_input:
            try:
                received_data = json.loads(raw_input)
            except:
                received_data = {'raw': raw_input}
        else:
            received_data = {}
    else:
        # x-www-form-urlencoded
        raw_input = sys.stdin.read()
        if raw_input:
            received_data = dict(urllib.parse.parse_qsl(raw_input))
        else:
            received_data = {}

response = {
    'language': 'Python',
    'method': method,
    'content_type': content_type,
    'hostname': hostname,
    'datetime': date_time,
    'user_agent': user_agent,
    'ip_address': ip_address,
    'received_data': received_data
}

print("Content-Type: application/json\n")
print(json.dumps(response, indent=2))