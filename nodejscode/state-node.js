const express = require('express');
const router = express.Router();
const os = require('os');

function getClientIP(req) {
    return req.headers['x-forwarded-for'] || 
           req.connection.remoteAddress || 
           req.socket.remoteAddress ||
           (req.connection.socket ? req.connection.socket.remoteAddress : null);
}

router.all('/echo-node', (req, res) => {
    const method = req.method;
    const contentType = req.headers['content-type'] || '';
    const dateTime = new Date().toISOString();
    const ipAddress = getClientIP(req);
    const userAgent = req.headers['user-agent'] || 'Unknown';
    const hostname = os.hostname();
    
    let receivedData = null;
    
    if (method === 'GET') {
        receivedData = req.query;
    } else {
        receivedData = req.body;
    }
    
    res.json({
        language: 'NodeJS (Express)',
        method: method,
        content_type: contentType,
        hostname: hostname,
        datetime: dateTime,
        user_agent: userAgent,
        ip_address: ipAddress,
        received_data: receivedData
    });
});

module.exports = router;