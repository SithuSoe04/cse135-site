const express = require('express');
const session = require('express-session');

const app = express();
const PORT = 3000;

// Middleware
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.use(session({
    secret: 'cse135-secret-key',
    resave: false,
    saveUninitialized: false,
    cookie: { maxAge: 24 * 60 * 60 * 1000 } // 24 hours
}));

// Import routes
const helloHtml = require('./hello-html-node');
const helloJson = require('./hello-json-node');
const environment = require('./environment-node');
const echo = require('./echo-node');
const state = require('./state-node');

// Use routes
app.use('/node', helloHtml);
app.use('/node', helloJson);
app.use('/node', environment);
app.use('/node', echo);
app.use('/node', state);

// Start server
app.listen(PORT, () => {
    console.log(`NodeJS Express server running on port ${PORT}`);
});
