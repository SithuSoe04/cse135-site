#!/usr/bin/python3
import sys
import os
import json
import urllib.parse
from datetime import datetime

# Mandatory CGI Headers
print("Content-Type: text/plain")
print("Cache-Control: no-cache")
print("\n")

def main():
    # 1. Collect the specific Metadata requested by the Professor
    method = os.environ.get("REQUEST_METHOD", "GET")
    content_type = os.environ.get("CONTENT_TYPE", "")
    content_length = int(os.environ.get("CONTENT_LENGTH", 0))
    
    hostname = os.environ.get("HTTP_HOST", "N/A")
    user_agent = os.environ.get("HTTP_USER_AGENT", "N/A")
    remote_ip = os.environ.get("REMOTE_ADDR", "N/A")
    current_time = datetime.now().strftime("%Y-%m-%d %H:%M:%S")

    # 2. Parse the Data (Supporting GET, POST, PUT, DELETE and JSON)
    data_received = {}

    if method == "GET":
        query_string = os.environ.get("QUERY_STRING", "")
        data_received = urllib.parse.parse_qs(query_string)
    elif content_length > 0:
        raw_body = sys.stdin.read(content_length)
        if "application/json" in content_type:
            try:
                data_received = json.loads(raw_body)
            except:
                data_received = {"error": "Invalid JSON body"}
        else:
            # Standard x-www-form-urlencoded
            parsed = urllib.parse.parse_qs(raw_body)
            data_received = {k: v[0] if len(v) == 1 else v for k, v in parsed.items()}

    # 3. Output as required by the assignment
    print(f"--- SERVER METADATA ---")
    print(f"Hostname: {hostname}")
    print(f"Date/Time: {current_time}")
    print(f"User Agent: {user_agent}")
    print(f"IP Address: {remote_ip}")
    print(f"HTTP Method: {method}")
    
    print(f"\n--- ECHO DATA ---")
    if not data_received:
        print("No data was submitted.")
    else:
        for key, value in data_received.items():
            print(f"{key}: {value}")

if __name__ == "__main__":
    main()