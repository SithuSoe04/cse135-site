#!/usr/bin/node

const querystring = require('querystring');
const fs = require('fs');
const path = require('path');

// Simple file-based session storage
const sessionDir = '/tmp/nodejs-sessions';
if (!fs.existsSync(sessionDir)) {
    fs.mkdirSync(sessionDir, { recursive: true });
}

// Get or create session ID from cookie
const cookieHeader = process.env.HTTP_COOKIE || '';
let sessionId = null;

const cookies = cookieHeader.split(';').reduce((acc, cookie) => {
    const [key, value] = cookie.trim().split('=');
    if (key) acc[key] = value;
    return acc;
}, {});

sessionId = cookies['nodejs-session-id'];

if (!sessionId) {
    sessionId = Date.now().toString(36) + Math.random().toString(36).substr(2);
}

const sessionFile = path.join(sessionDir, sessionId + '.json');

// Read session data
let sessionData = { savedData: null, savedAt: null };
if (fs.existsSync(sessionFile)) {
    try {
        sessionData = JSON.parse(fs.readFileSync(sessionFile, 'utf8'));
    } catch (e) {}
}

const method = process.env.REQUEST_METHOD || 'GET';
const queryString = process.env.QUERY_STRING || '';
const query = querystring.parse(queryString);

// Handle POST
if (method === 'POST') {
    let body = '';
    process.stdin.setEncoding('utf8');
    
    process.stdin.on('data', chunk => {
        body += chunk;
    });
    
    process.stdin.on('end', () => {
        const postData = querystring.parse(body);
        
        if (postData.data) {
            sessionData.savedData = postData.data;
            sessionData.savedAt = new Date().toISOString();
            fs.writeFileSync(sessionFile, JSON.stringify(sessionData));
        }
        
        // Redirect
        console.log('Status: 303 See Other');
        console.log(`Set-Cookie: nodejs-session-id=${sessionId}; Path=/; Max-Age=86400`);
        console.log(`Location: ${process.env.SCRIPT_NAME || '/nodejscode/state-node.js'}\n`);
    });
    
    return;
}

// Handle clear action
if (query.action === 'clear') {
    sessionData = { savedData: null, savedAt: null };
    fs.writeFileSync(sessionFile, JSON.stringify(sessionData));
    
    console.log('Status: 303 See Other');
    console.log(`Set-Cookie: nodejs-session-id=${sessionId}; Path=/; Max-Age=86400`);
    console.log(`Location: ${process.env.SCRIPT_NAME || '/nodejscode/state-node.js'}\n`);
    return;
}

// Display page
console.log(`Set-Cookie: nodejs-session-id=${sessionId}; Path=/; Max-Age=86400`);
console.log('Content-Type: text/html; charset=utf-8\n');

let html = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>State Demo - NodeJS</title>
</head>
<body>
    <h1>State Management Demo - NodeJS (File-based Sessions)</h1>
    
    <h2>Save Data</h2>
    <form method="POST">
        <label for="data">Enter data to save:</label><br>
        <input type="text" id="data" name="data" size="50"><br><br>
        <button type="submit">Save</button>
    </form>
    
    <h2>Current Saved Data</h2>`;

if (sessionData.savedData) {
    html += `
    <p><strong>Data:</strong> ${sessionData.savedData}</p>
    <p><strong>Saved at:</strong> ${sessionData.savedAt}</p>
    <a href="?action=clear">Clear Data</a>`;
} else {
    html += `<p>No data saved yet.</p>`;
}

html += `
</body>
</html>`;

console.log(html);
