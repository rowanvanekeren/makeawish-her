var blowawish = angular.module("blowawish",[]).controller("wishAngController", function ($scope, $http) {
    $scope.submitWish = function(){
        var req = {
            method: 'POST',
            url: './save_wish',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              /* 'Content-Type': 'application/x-www-form-urlencoded'*/
            },
           data: {
               name: $scope.wishFormName,
               wish: $scope.wishFormWish
           }
        };

        $http(req).then(function(data){

            console.log(data);
        }

        );
    }

});

blowawish.controller("micStreamAngController", function ($scope, $http) {
$scope.initMic = function() {
    var canCalibrate = false;
    var takeAverage = false;
    var avgArray = [];
    var marginCounter = 0;
    var blowOverlayClass = '.blowdiv';
    var counterID = '#calCounter';
    var presetInpID = "#preset_number";
    var cookiename = 'micPreset';
    var cookievalue = [];
    var maxMicPeak = 0;
    var micPeakOffset = 20;
    var globalAverage = 0;
    var cookieIsSet = false;

   $scope.calibration = function() {
        if (canCalibrate) {
            avgArray = [];
            var count = 3;
            var counter = setInterval(function () {
                if (count != 0) {

                    $(counterID).html(count);
                    count--;
                } else {
                    $(counterID).html("GO!");
                    clearInterval(counter);
                    takeAverage = true;

                }
            }, 1000);

        } else {
        console.log('stream error please refresh page');
        }

    };
    $scope.initCookie= function(){
        var getCookies = document.cookie.split(';');

        getCookies.forEach(function(item, index, arr){

            if(item.indexOf(cookiename) !== -1){
                cookievalue = decodeURIComponent(item).split(/=|&/);
                maxMicPeak = parseInt(cookievalue[2]);
                cookieIsSet = true;
            }


        });
    };
    $scope.initCookie();

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
                console.log('audiostream open');
                var values = 0;

                var length = array.length;
                for (var i = 0; i < length; i++) {
                    values += array[i];
                }

                var average = values / length;
                globalAverage = average;

                $(blowOverlayClass).css('margin-top', marginCounter +"%");
                console.log(globalAverage);
                console.log((maxMicPeak - micPeakOffset));

                if(cookieIsSet && globalAverage > (maxMicPeak - micPeakOffset)) {

                        marginCounter = marginCounter - 2;

                }
                if (takeAverage) {
                    avgArray.push(average);

                    setTimeout(function () {
                        takeAverage = false;

                        var total = 0;
                        var avgLength = avgArray.length;
                        var avg = 0;
                        for (var i = 0; i < avgLength; i++) {
                            total += avgArray[i];
                        }

                        avg = total / avgLength;

                        $(counterID).html(avg);
                        $(presetInpID).val(Math.floor(avg));

                    }, 2000)
                }

            }

        }
        , errorCallback);

    function errorCallback() {
        alert('something went wrong');
    }

};




});