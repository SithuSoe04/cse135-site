#!/usr/bin/node

const querystring = require('querystring');
const url = require('url');

const method = process.env.REQUEST_METHOD || 'GET';
const query = querystring.parse(process.env.QUERY_STRING || '');

// 1. Handle CLEAR action
if (query.action === 'clear') {
    process.stdout.write("Set-Cookie: saved_data=; Path=/; Expires=Thu, 01 Jan 1970 00:00:00 GMT\n");
    process.stdout.write("Location: state-node.js\n\n");
    process.exit();
}

// 2. Handle SAVE action (POST)
if (method === 'POST') {
    let body = '';
    process.stdin.on('data', chunk => { body += chunk; });
    process.stdin.on('end', () => {
        const params = querystring.parse(body);
        const data = params.data || '';
        process.stdout.write(`Set-Cookie: saved_data=${encodeURIComponent(data)}; Path=/; HttpOnly\n`);
        process.stdout.write("Location: state-node.js\n\n");
        process.exit();
    });
} else {
    // 3. Display Entry UI
    process.stdout.write("Content-Type: text/html\n\n");
    process.stdout.write(`<!DOCTYPE html>
<html>
<head><title>Node State Entry</title></head>
<body>
    <h1>NodeJS State Management - Entry</h1>
    <form method="POST">
        <label>Enter information to save in Cookie:</label><br>
        <input type="text" name="data" placeholder="e.g., Team Member Name">
        <button type="submit">Save to Cookie</button>
    </form>
    <hr>
    <p><a href="state-view-node.js">Go to the second screen to see if data persists</a></p>
</body>
</html>`);
}