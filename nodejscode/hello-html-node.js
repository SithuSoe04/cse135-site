const express = require('express');
const router = express.Router();

function getClientIP(req) {
    return req.headers['x-forwarded-for'] || 
           req.connection.remoteAddress || 
           req.socket.remoteAddress ||
           (req.connection.socket ? req.connection.socket.remoteAddress : null);
}

router.get('/hello-html-node', (req, res) => {
    const teamName = 'Your Team Name';
    const language = 'NodeJS (Express)';
    const dateTime = new Date().toISOString();
    const ipAddress = getClientIP(req);
    
    res.send(`
<!DOCTYPE html>
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
</html>
    `);
});

module.exports = router;