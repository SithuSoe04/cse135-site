#!/usr/bin/node

const querystring = require('querystring');
const os = require('os');

const method = process.env.REQUEST_METHOD || 'GET';
const contentType = process.env.CONTENT_TYPE || '';
const dateTime = new Date().toISOString();
const ipAddress = process.env.REMOTE_ADDR || 'Unknown';
const userAgent = process.env.HTTP_USER_AGENT || 'Unknown';
const hostname = os.hostname();

let receivedData = {};

if (method === 'GET') {
    const queryString = process.env.QUERY_STRING || '';
    if (queryString) {
        receivedData = querystring.parse(queryString);
    }
} else {
    // Read from stdin for POST, PUT, DELETE
    let body = '';
    process.stdin.setEncoding('utf8');
    
    process.stdin.on('data', chunk => {
        body += chunk;
    });
    
    process.stdin.on('end', () => {
        if (body) {
            if (contentType.includes('application/json')) {
                try {
                    receivedData = JSON.parse(body);
                } catch (e) {
                    receivedData = { raw: body };
                }
            } else {
                receivedData = querystring.parse(body);
            }
        }
        
        outputResponse();
    });
}

if (method === 'GET') {
    outputResponse();
}

function outputResponse() {
    const response = {
        language: 'NodeJS',
        method: method,
        content_type: contentType,
        hostname: hostname,
        datetime: dateTime,
        user_agent: userAgent,
        ip_address: ipAddress,
        received_data: receivedData
    };
    
    console.log('Content-Type: application/json\n');
    console.log(JSON.stringify(response, null, 2));
}
