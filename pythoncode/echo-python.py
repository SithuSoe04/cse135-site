#!/usr/bin/env python3
import sys
import os
import json
import urllib.parse

# 1. Required CGI Headers
print("Content-Type: text/plain")  # Or text/html based on your preference
print("Cache-Control: no-cache")
print("\n")  # End of headers

def main():
    method = os.environ.get("REQUEST_METHOD", "GET")
    content_type = os.environ.get("CONTENT_TYPE", "")
    content_length = int(os.environ.get("CONTENT_LENGTH", 0))

    data_received = {}

    # Handle GET Request
    if method == "GET":
        query_string = os.environ.get("QUERY_STRING", "")
        data_received = urllib.parse.parse_qs(query_string)

    # Handle POST/PUT/DELETE Request
    elif content_length > 0:
        raw_body = sys.stdin.read(content_length)
        
        # Check if incoming data is JSON
        if "application/json" in content_type:
            try:
                data_received = json.loads(raw_body)
            except json.JSONDecodeError:
                print("Error: Invalid JSON body.")
                return
        # Otherwise assume URL-encoded (application/x-www-form-urlencoded)
        else:
            parsed_data = urllib.parse.parse_qs(raw_body)
            # parse_qs puts everything in lists; flatten them for simple echo
            data_received = {k: v[0] if len(v) == 1 else v for k, v in parsed_data.items()}

    # Output the Echo results
    if not data_received:
        print("No data received.")
    else:
        print(f"Method: {method}")
        print(f"Content-Type: {content_type}")
        print("-" * 20)
        for key, value in data_received.items():
            print(f"{key}: {value}")

if __name__ == "__main__":
    main()