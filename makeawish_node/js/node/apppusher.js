var express = require('express');
var app = express();
//var io = require('socket.io')(app.listen(8080));
var five = require('johnny-five');
var led;
var board = "";

var Pusher = require('pusher');
var client = require('pusher-client');

var socket = new client('7d5f75a6e8d507102cdb', { cluster: "eu" });
var my_channel = socket.subscribe('blow_a_wish');
socket.bind('send_wish',
  function(data) {
    console.log(data);
  }
);


app.listen(8080);

