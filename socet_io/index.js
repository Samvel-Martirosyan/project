const express = require('express');
const http = require('http');
const {Server} = require("socket.io");
const app = express();
const server = http.createServer(app);
const config = require('./config');
const io = new Server(server, {
    cors: {
        origin: config.siteUrl
    }
});

const user = {};

io.on('connection', function(socket){
    user[socket.id] = 1;

    socket.on('disconnect', function(data){
        delete user[socket.id];
    });
});

server.listen(8082, () => {
    console.log('server running');
});


