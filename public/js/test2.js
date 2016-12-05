/*if (!navigator.getUserMedia) {
 navigator.getUserMedia = navigator.getUserMedia
 || navigator.webkitGetUserMedia
 || navigator.mozGetUserMedia
 || navigator.msGetUserMedia;
 }

 if (navigator.getUserMedia) {
 navigator.getUserMedia({audio: true}, function (e) {
 // what goes here?
 }, function (e) {
 alert('Error capturing audio.');
 });
 } else {
 alert('getUserMedia not supported in this browser.');
 }*/
var globalAvarage;
$( document ).ready(function() {

    if (!navigator.getUserMedia) {
        navigator.getUserMedia = navigator.getUserMedia
            || navigator.webkitGetUserMedia
            || navigator.mozGetUserMedia
            || navigator.msGetUserMedia;
    }

    navigator.getUserMedia({audio: true, video: true}, function (stream) {
            window.AudioContext = window.AudioContext ||
                window.webkitAudioContext;

            var audioContext = new AudioContext();

            /*audioContext = new webkitAudioContext();*/
            analyser = audioContext.createAnalyser();
            microphone = audioContext.createMediaStreamSource(stream);
            var javascriptNode = audioContext.createScriptProcessor(2048, 1, 1);

            analyser.smoothingTimeConstant = 0.3;
            analyser.fftSize = 1024;

            microphone.connect(analyser);
            analyser.connect(javascriptNode);
            javascriptNode.connect(audioContext.destination);

            //canvasContext = $("#canvas")[0].getContext("2d");
           var bar = $("#bars");
        /*    canvasContext = canvasContext.getContext("2d");*/

            javascriptNode.onaudioprocess = function () {
                var array = new Uint8Array(analyser.frequencyBinCount);
                analyser.getByteFrequencyData(array);
              /*  console.log(array);*/
                var values = 0;

                var length = array.length;
                for (var i = 0; i < length; i++) {
                    values += array[i];
                }

                var average = values / length;

             /*   console.log(average);*/
                globalAvarage = average;
                bar.css('height',average + "px" );

                if(average > 100){
                    $('#testh1').html('blaasss');
                }
                else{
                    $('#testh1').html(average);
                }
            /*    canvasContext.clearRect(0, 0, 60, 130);
                canvasContext.fillStyle = '#00ff00';
                canvasContext.fillRect(0, 130 - average, 25, 130);*/
            }

        }
        , errorCallback);

    function errorCallback() {
        alert('something went wrong');
    }


});

function getAverageMic(){

}
