var blowawish = angular.module("blowawish", []);

blowawish.service('CanBlow', function(){
    var canBlow = {
        bool: false
    };

    return {
        getBool: function () {
            return canBlow.bool;
        },
        setBool: function (bool) {
            canBlow.bool = bool;
        }
    };
});

    blowawish.controller("wishAngController", function ($scope, $http, CanBlow) {
        var wishConfirmClass = '.wish-confirm';
        $scope.submitWish = function () {
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

        $http(req).then(function (data) {

                console.log(data.data);
                if(data.data[0] == 'succes'){
                    $scope.closeWishEnter = true;
                    $scope.wishName = data.data[1];
                    $scope.wishText = data.data[2];
                }else if(data.data[0] == 'error'){
                    $scope.wishError = true;
                    $scope.wishErrorText = data.data[1];
                }
            }
        );
    };
    $scope.enableBlow = function () {
        CanBlow.setBool(true);

        $scope.postToInsta();

    };
        $scope.postToInsta = function(){

                html2canvas($("#insta_image"), {
                    onrendered: function(canvas) {
                        theCanvas = canvas;
                        /* document.body.appendChild(canvas);*/
                        var data = theCanvas.toDataURL('image/jpeg');
                        $http.post('./saveInstaImage',{

                            image: data

                        }).then(function(data){
                            console.log(data.data)
                        });
                        // Convert and download as image
                        /* Canvas2Image.saveAsPNG(canvas);*/
                       /* $(".test_image").append(canvas);*/

                        // Clean up
                        //document.body.removeChild(canvas);
                    }

            });
        };
});

blowawish.controller("InstaAngController", function ($scope, $http, CanBlow) {


});

blowawish.controller("micStreamAngController", function ($scope, $http, CanBlow) {
    var calibrating = false;
    var streamOpen = false;
    var takeAverage = false;
    var avgArray = [];
    var marginCounter = 0;
    var blowOverlayClass = '.blowdiv';
    var wishEndClass = '.wish-end';
    var counterID = '#calCounter';
    var presetInpID = "#preset_number";
    var cookiename = 'micPreset';
    var cookievalue = [];
    var maxMicPeak = 0;
    var micPeakOffset = 20;
    var globalAverage = 0;
    var cookieIsSet = false;
    var pushEnabled = false;
    var countTryStream = 0;

    var blowSpeed = 10; //speed for counter blowing
    var counterEnd = -200; // at this point pusher is fired

    var canBlow = false;

    $scope.$watch(function () { return CanBlow.getBool(); }, function (newValue, oldValue) {
        if (newValue !== oldValue) {
            console.log('test');
            $scope.blowingEnabled = true;
            $(blowOverlayClass).fadeIn();

            $(wishEndClass).fadeIn(3000);
            canBlow = true;

        }
    });



    $scope.initWish = function () {
        calibrating = false;
        openStream();
        $scope.initCookie();
        function checkStatus() {
            if (cookieIsSet && streamOpen) {
                console.log('cookie is set and stream is open');
            } else {
                if (countTryStream <= 4) {
                    countTryStream++;

                    setTimeout(function () {
                        if(!cookieIsSet && !streamOpen){
                            console.log('retry stream and init cookie');
                            openStream();
                            checkStatus();
                        }else if(!cookieIsSet && streamOpen){
                            console.log('retry init cookie');
                            checkStatus();
                        }else if(!streamOpen && cookieIsSet){
                            console.log('retry stream');
                            openStream();
                            checkStatus();
                        }
                    }, 100);
                } else {
                    if(!cookieIsSet && !streamOpen){
                        console.log('init cookie and stream failed');
                        $scope.cookieError = true;

                    }else if(!cookieIsSet && streamOpen){
                        console.log('init cookie failed');
                        $scope.cookieError = true;


                    }else if(!streamOpen && cookieIsSet){
                        console.log('opening stream failed');
                    }
                }
            }
        }

        checkStatus();


    };
    $scope.initCalibrate = function () {
        calibrating = true;
        $scope.initCookie();
        openStream();

    };

    $scope.calibration = function () {


        function calibrate() {

            if (streamOpen) {
                console.log('stream is open');
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
                setTimeout(function () {
                    if (countTryStream <= 3) {
                        countTryStream++;
                        openStream();
                        calibrate();
                    } else {
                        console.log('stream opening failed');
                    }
                }, 100);
                console.log('retry stream');
            }

        }

        calibrate();
    };
    $scope.initCookie = function () {
        var getCookies = document.cookie.split(';');
        getCookies.forEach(function (item, index, arr) {
            if (item.indexOf(cookiename) !== -1) {
                cookievalue = decodeURIComponent(item).split(/=|&/);
                maxMicPeak = parseInt(cookievalue[2]);
                cookieIsSet = true;
                $scope.cookieError = false;

                console.log(cookievalue);
            }
        });
    };
    $scope.activatePusher = function () {
        var req = {
            method: 'POST',
            url: './pusher',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                /* 'Content-Type': 'application/x-www-form-urlencoded'*/
            },
            data: {
                name: $scope.wishFormName
            }
        };

        $http(req).then(function (data) {

                console.log(data);
            }
        );

    };


    function openStream() {
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
                javascriptNode.onaudioprocess = function () {
                    streamOpen = true;

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

                    $(blowOverlayClass).css('margin-top', marginCounter + "%");
                    /*   console.log(globalAverage);
                     console.log((maxMicPeak - micPeakOffset));*/

                    if (cookieIsSet && globalAverage > (maxMicPeak - micPeakOffset) && !pushEnabled && !calibrating && canBlow) {
                        console.log('blow counter working');
                        marginCounter = marginCounter - blowSpeed;
                        if (marginCounter < counterEnd) {
                            pushEnabled = true;
                            console.log('pusher activated');
                            $scope.activatePusher();
                            $scope.wishSend = true;
                        }

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

                };


            }
            , errorCallback);

        function errorCallback() {
            alert('something went wrong');
        }
    }


});
