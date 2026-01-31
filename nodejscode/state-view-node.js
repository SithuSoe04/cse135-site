#!/usr/bin/node

const cookieHeader = process.env.HTTP_COOKIE || '';
let savedData = "No data found.";

if (cookieHeader) {
    const cookies = cookieHeader.split(';').reduce((acc, cookie) => {
        const [key, value] = cookie.trim().split('=');
        acc[key] = value;
        return acc;
    }, {});
    if (cookies.saved_data) savedData = decodeURIComponent(cookies.saved_data);
}

process.stdout.write("Content-Type: text/html\n\n");
process.stdout.write(`<!DOCTYPE html>
<html>
<head><title>Node State View</title></head>
<body>
    <h1>NodeJS State Management - View</h1>
    <div style="border: 2px solid #27ae60; padding: 20px; background: #f9f9f9;">
        <strong>Data retrieved from Cookie:</strong> ${savedData}
    </div>
    <p><a href="state-node.js">Return to Entry Screen</a></p>
    <p><a href="state-node.js?action=clear" style="color: red;">Clear Cookie</a></p>
</body>
</html>`);