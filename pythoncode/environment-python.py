#!/usr/bin/python3
import os

print("Content-Type: text/html\n")
print("""<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Environment Variables - Python</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
    </style>
</head>
<body>
    <h1>Environment Variables - Python</h1>
    <table>
        <tr>
            <th>Variable</th>
            <th>Value</th>
        </tr>""")

for key, value in sorted(os.environ.items()):
    print(f"""        <tr>
            <td>{key}</td>
            <td>{value}</td>
        </tr>""")

print("""    </table>
</body>
</html>""")