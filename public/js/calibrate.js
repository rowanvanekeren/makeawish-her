
var canCalibrate = false;
var takeAverage = false;
var avgArray = [];
function calibration(){
    if(canCalibrate){
        avgArray = [];
        var count = 3;
        var counter = setInterval(function(){
            if(count != 0) {

                $('#calCounter').html(count);
                count--;
            }else{
                $('#calCounter').html("GO!");
                clearInterval(counter);
                console.log('cleared');
                takeAverage = true;

            }
        },1000);

    }else{

    }

}
$( document ).ready(function() {

    console.log('loaded first');
    if (!navigator.getUserMedia) {
        navigator.getUserMedia = navigator.getUserMedia
            || navigator.webkitGetUserMedia
            || navigator.mozGetUserMedia
            || navigator.msGetUserMedia;
    }

    navigator.getUserMedia({audio: true, video: true}, function (stream) {

            console.log('loaded sec');
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
            javascriptNode.onaudioprocess = function () {
                canCalibrate = true;
                var array = new Uint8Array(analyser.frequencyBinCount);
                analyser.getByteFrequencyData(array);

                var values = 0;

                var length = array.length;
                for (var i = 0; i < length; i++) {
                    values += array[i];
                }

                var average = values / length;

                if(takeAverage){
                    avgArray.push(average);
                    console.log('blow');
                    setTimeout(function(){
                        takeAverage = false;

                        var total = 0;
                        var avgLength = avgArray.length;
                        var avg = 0;
                        for (var i = 0; i < avgLength; i++) {
                            total += avgArray[i];
                        }

                         avg = total / avgLength;
                        console.log('done');
                        $('#calCounter').html(avg);
                        $('#preset_number').val(Math.floor(avg));

                    },2000)
                }
            }

        }
        , errorCallback);

    function errorCallback() {
        alert('something went wrong');
    }


});

