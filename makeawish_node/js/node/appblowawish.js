var five = require('johnny-five');
var Pusher = require('pusher');
var board = "";
var setTimeoutProcessing = false;
var enableBoard = false;
var inputsUsed = [8, 9, 10];
var timeOut = 3000;
var Pusher = require('pusher');
var client = require('pusher-client');

var pusher = new Pusher({
  appId: '275644',
  key: '7d5f75a6e8d507102cdb',
  secret: '680b97afa854d0a9fbb9',
  cluster: 'eu',
  encrypted: true
});

var socket = new client('7d5f75a6e8d507102cdb', {
    cluster: "eu"
});

var my_channel = socket.subscribe('blow_a_wish');



board = new five.Board();
board.on("ready", function () {
    
    pusher.trigger(['blow_a_wish'], 'test_event', { message: "hello world" });
    
    
    var relay = new five.Leds([inputsUsed[0], inputsUsed[1], inputsUsed[2]]); // five.leds doesnt allow direct array */
    
    socket.bind('send_wish',
                
        function (data) {
            console.log(data);
            var lastMessageTime = new Date(data.time * 1000);
            var now = new Date();
            var maxTimeout = new Date(now);
            maxTimeout.setSeconds(now.getSeconds() - 30);


            if (typeof data.state !== 'undefined' && typeof inputsUsed[data.pin] !== 'undefined' && lastMessageTime > maxTimeout) {
                var index = inputsUsed.indexOf(data.pin);
                console.log('index = ' + index);

                switch (data.state) {
                case 'on':
                    console.log('on');
                    relay[data.pin].on();
                    break;
                case 'off':
                    console.log('off');
                    relay[data.pin].off();
                    break;
                case 'timeout':
                    console.log('timeout');

                    function caseTimeout() {
                        if (typeof data.ms !== 'undefined' && !setTimeoutProcessing) {
                            relay[data.pin].on();
                            setTimeoutProcessing = true;
                            setTimeout(function () {
                                relay[data.pin].off();
                                setTimeoutProcessing = false;
                            }, data.ms);
                        }
                    }
                    caseTimeout();
                    break;
                }
            } else {
                console.log('pin or state not defined or to much timeout');
            }
        }
    );
});