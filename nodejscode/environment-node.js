const express = require('express');
const router = express.Router();

router.get('/environment-node', (req, res) => {
    let html = `
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Environment Variables - NodeJS</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
    </style>
</head>
<body>
    <h1>Environment Variables - NodeJS</h1>
    <table>
        <tr>
            <th>Variable</th>
            <th>Value</th>
        </tr>
    `;
    
    // Add request headers
    html += '<tr><td colspan="2"><strong>Request Headers</strong></td></tr>';
    for (const [key, value] of Object.entries(req.headers)) {
        html += `<tr><td>${key}</td><td>${value}</td></tr>`;
    }
    
    // Add process environment
    html += '<tr><td colspan="2"><strong>Process Environment</strong></td></tr>';
    for (const [key, value] of Object.entries(process.env)) {
        html += `<tr><td>${key}</td><td>${value}</td></tr>`;
    }
    
    html += `
    </table>
</body>
</html>
    `;
    
    res.send(html);
});

module.exports = router;
