#!/usr/bin/node

const querystring = require('querystring');
const os = require('os');

const method = process.env.REQUEST_METHOD || 'GET';
const contentType = process.env.CONTENT_TYPE || '';
const dateTime = new Date().toISOString();
const ipAddress = process.env.REMOTE_ADDR || 'Unknown';
const userAgent = process.env.HTTP_USER_AGENT || 'Unknown';
const hostname = os.hostname();

const queryString = process.env.QUERY_STRING || '';
let receivedData = {};

if (queryString) {
    receivedData = querystring.parse(queryString);
}

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
