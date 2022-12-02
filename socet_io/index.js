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

const users = {};
const messages = {};

io.on('connection', function(socket){
    users[socket.id] = 1;

    socket.on('message', function (data) {
        Object.assign(messages, data)

        io.sockets.emit('message', data)
    })

    socket.on('disconnect', function(data){
        delete users[socket.id];
    });
});

server.listen(8082, () => {
    console.log('server running');
});


