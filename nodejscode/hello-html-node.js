const os = require('os');

const teamName = 'Phyo Thant, Sithu Soe';
const language = 'NodeJS';
const dateTime = new Date().toISOString();
const ipAddress = process.env.REMOTE_ADDR || 'Unknown';

console.log('Content-Type: text/html; charset=utf-8\n');
console.log(`<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hello HTML - NodeJS</title>
</head>
<body>
    <h1>Hello from ${teamName}!</h1>
    <p><strong>Language:</strong> ${language}</p>
    <p><strong>Generated at:</strong> ${dateTime}</p>
    <p><strong>Your IP Address:</strong> ${ipAddress}</p>
</body>
</html>`);
