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
    socket.on('send-username', function (data) {
        users[socket.id] = data;
        io.sockets.emit('users', { users, userId: socket.id})
    })

    socket.on('message', function (data) {
        Object.assign(messages, data)

        io.to(Object.keys(data)[0]).emit("message", data)
    })

    socket.on('disconnect', function(data){
        delete users[socket.id];
        io.sockets.emit('users', users)
    });
});

server.listen(8082, () => {
    console.log('server running');
});


