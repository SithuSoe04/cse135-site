#!/usr/bin/env node

console.log('Content-Type: text/html; charset=utf-8\n');

let html = `<!DOCTYPE html>
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
        <tr><td colspan="2"><strong>CGI Environment</strong></td></tr>`;

// Add all environment variables
Object.keys(process.env).sort().forEach(key => {
    html += `<tr><td>${key}</td><td>${process.env[key]}</td></tr>`;
});

html += `
    </table>
</body>
</html>`;

console.log(html);
