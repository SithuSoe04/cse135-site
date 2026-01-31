#!/usr/bin/node

const response = {
    team: 'Team Phyo Thant, Sithu Soe',
    language: 'NodeJS',
    datetime: new Date().toISOString(),
    ip_address: process.env.REMOTE_ADDR || 'Unknown'
};

console.log('Content-Type: application/json\n');
console.log(JSON.stringify(response, null, 2));
