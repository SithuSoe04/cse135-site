const express = require('express');
const router = express.Router();

function getClientIP(req) {
    return req.headers['x-forwarded-for'] || 
           req.connection.remoteAddress || 
           req.socket.remoteAddress ||
           (req.connection.socket ? req.connection.socket.remoteAddress : null);
}

router.get('/hello-json-node', (req, res) => {
    res.json({
        team: 'Your Team Name',
        language: 'NodeJS (Express)',
        datetime: new Date().toISOString(),
        ip_address: getClientIP(req)
    });
});

module.exports = router;
