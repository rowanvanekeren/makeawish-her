///////////////////////////////////////////////////
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    if (n > x.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = x.length
    }
    ;
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    x[slideIndex - 1].style.display = "block";
}

$('#insta_image').click(function(){

    html2canvas($("#insta_image"), {
    height: $('.polaroid-big').css('height').replace(/[^-\d\.]/g, ''),
   /*width: $('.polaroid-big').css('width').replace(/[^-\d\.]/g, ''),*/
        onrendered: function (canvas) {
            theCanvas = canvas;

            var data = theCanvas.toDataURL('image/jpeg');
            window.open(data);
        }

    });
});
//////////////////////////////////////////////////////////
var xpos;
var ypos;
//This method runs when your page is load.
$(document).ready(function () {
    // filter stuff
    var prevImgClass = '.preview-img';
    var wishTextClass = '#mainText';
    var nameTextClass = '#footerText';
    var arrowRight = '&#9654';
    var arrowDown ='&#9660';
    $('#main-text').draggable().resizable();
    $('#footer-text').draggable().resizable();
/*    $("#hueFilter").slider({
        max: 360,
        slide: function( event, ui ) {
            console.log(ui.value);
            $(prevImgClass).css('filter', 'hue-rotate('+ ui.value + 'deg)' );
        }
    });*/
    $("#opacityFilter").slider({
        max: 100,
        value: 100,
        slide: function( event, ui ) {
            var opacity = ui.value / 100;
            $(prevImgClass).css('opacity', opacity );
        }
    });
    $("#nameTextBoldness").slider({
        max: 1000,
        step: 100,
        slide: function( event, ui ) {

           $(nameTextClass).css('font-weight', ui.value);
        }
    });
    $("#wishTextBoldness").slider({
        max: 1000,
        step: 100,
        slide: function( event, ui ) {

            $(wishTextClass).css('font-weight', ui.value);
        }
    });

    $("#wishTextSize").slider({
        max: 100,
        slide: function( event, ui ) {
            $(wishTextClass).css('font-size', ui.value);
        }
    });
    $("#nameTextSize").slider({
        max: 100,
        slide: function (event, ui) {
            $(nameTextClass).css('font-size', ui.value);
        }

    } );

    $('.options-wrapper-wish').click(function () {

        if($('.options-content-wish').hasClass('hidden')){
            $('.options-wrapper-wish span').html(arrowDown);
        }else{
            $('.options-wrapper-wish span').html(arrowRight);
        }
        $('.options-content-wish').toggleClass('hidden');
    });
    $('.options-wrapper-name').click(function () {

        if($('.options-content-name').hasClass('hidden')){
            $('.options-wrapper-name span').html(arrowDown);
        }else{
            $('.options-wrapper-name span').html(arrowRight);
        }
        $('.options-content-name').toggleClass('hidden');
    });

    $('#nameTextColor').change(function(){

        $(nameTextClass).css('color', $('#nameTextColor').val());
    })
    $('#wishTextColor').change(function(){

        $(wishTextClass).css('color', $('#wishTextColor').val());
    })

    $('#nameTextAlign').change(function(){
        $(nameTextClass).css('text-align', $('#nameTextAlign').find(":selected").val());
    });
    $('#wishTextAlign').change(function(){
        $(wishTextClass).css('text-align', $('#wishTextAlign').find(":selected").val());
    });
    $('#wishTextFont').change(function(){
        $(wishTextClass).css('font-family', $('#wishTextFont').find(":selected").val());
    });
    $('#nameTextFont').change(function(){
        $(nameTextClass).css('font-family', $('#nameTextFont').find(":selected").val());
    });


});
particlesJS.load('particles-js', 'particlesjs-config.json', function() {
    console.log('callback - particles.js config loaded');
});
/////////////////////////////////////////////////////////
var blowawish = angular.module("blowawish", []);

blowawish.service('CanBlow', function () {
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
    $scope.dragWish = "voer je wens in";
    $scope.dragName = "voer je naam in";
    function triggerPolaroidAnimation() {
        var animationClass = 'polaroid-taken';
        var polaroidClass = '.polaroid';
        if ($(polaroidClass).hasClass(animationClass)) {
            $(polaroidClass).removeClass(animationClass);
            $(polaroidClass).addClass(animationClass);
        } else {
            $(polaroidClass).addClass(animationClass);
        }
    }

    $scope.projectInput = function (input) {
        var selectedInput = input;
        console.log(input);
        if (input == 0) {
            var wishInput = $scope.wishFormWish;
            var WishOutput = $scope.dragWish;
            $scope.dragWish = wishInput
            $scope.$evalAsync();


        } else if (input = 1) {
            console.log($scope.wishFormName);
            var nameInput = $scope.wishFormName;
            var nameOutput = $scope.dragName;
            $scope.dragName = nameInput;
            $scope.$evalAsync();
        }

    };


    $scope.backToSelect = function () {
        $scope.previewConfirmationSection = false;
        $scope.uploadImgSection = false;
    };
    $scope.proceedToWish = function () {
        $scope.previewConfirmationSection = false;
        $scope.uploadImgSection = true;
        $scope.showImageEditScreen = true;
    };
    $scope.selectAlternativeImage = function (event) {
        $scope.loading = true;

        var imgSrc = event.currentTarget.src;
        $('.preview-img').attr('src', imgSrc);
        $('.preview-img').on('load', function () {
            setTimeout(function () {
                $scope.previewConfirmationSection = true;
                $scope.uploadImgSection = true;

                triggerPolaroidAnimation();
                $scope.loading = false;
                $scope.$apply();
            }, 200);

        });
    };
    $scope.selectImage = function () {
        console.log('clicked');
        var imgInput = '#upload-image';
        $(imgInput).click();
        $(imgInput).change(function () {

            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                //no match
                console.log('no match');
            } else {
                console.log('match');
                var form_data = new FormData(); // Creating object of FormData class
                form_data.append("image", file);// Appending parameter named file with properties of file_field to form_data
                $scope.loading = true;
                $scope.$apply();
                postFileImg(form_data);
            }

        });
    };

    function postFileImg(form_data) {

        $.ajax({
            type: 'POST',
            processData: false, // important
            contentType: false, // important
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: form_data,
            url: './save_image',
            dataType: 'json',
            // in PHP you can call and process file in the same way as if it was submitted from a form:
            // $_FILES['input_file_name']
            success: function (jsonData) {
                console.log('testte');
                $('.preview-img').attr('src', jsonData);
                $('.preview-img').on('load', function () {
                    setTimeout(function () {
                        $scope.previewConfirmationSection = true;
                        $scope.uploadImgSection = true;
                        $scope.$apply();
                        triggerPolaroidAnimation();
                        $scope.loading = false;
                    }, 200);

                });


            }

        });
    }

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
                if (data.data[0] == 'succes') {
                    $scope.closeWishEnter = true;
                    $scope.wishName = data.data[1];
                    $scope.wishText = data.data[2];

                    CanBlow.setBool(true);
                    $scope.postToInsta();
                } else if (data.data[0] == 'error') {
                    $scope.wishError = true;
                    $scope.wishErrorText = data.data[1];
                }
            }
        );
    };
    $scope.enableBlow = function () {


    };

    $scope.toggleWishWindow = function () {
        $scope.previewConfirmationSection = false;
        $scope.uploadImgSection = true;
        $scope.showImageEditScreen = false;
        $scope.stepSection = true;
    };

    $scope.postToInsta = function () {

        $scope.toggleWishWindow();
        particlesJS.load('particles-js', 'particlesjs-config-up.json', function() {
            console.log('callback - particles.js config loaded');
        });
        pJSDom[0]["pJS"]['particles']['move']['speed'] = 40;
        $('#insta_image').css('margin-top', '0');
        $('#insta_image').css('margin-bottom', '0');
        $('#main-text').css('border', 'none');
        $('#footer-text').css('border', 'none');
        $('.ui-icon').css('display', 'none');

        html2canvas($("#insta_image"), {
            height: $('.polaroid-big').css('height').replace(/[^-\d\.]/g, ''),
            onrendered: function (canvas) {
                theCanvas = canvas;
                /* document.body.appendChild(canvas);*/
                var data = theCanvas.toDataURL('image/jpeg');
                $http.post('./saveInstaImage', {

                    image: data

                }).then(function (data) {
                   if(data.data != null){
                       $scope.savedImage = data.data;
                   }
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

    $scope.$watch(function () {
        return CanBlow.getBool();
    }, function (newValue, oldValue) {

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
                        if (!cookieIsSet && !streamOpen) {
                            console.log('retry stream and init cookie');
                            openStream();
                            checkStatus();
                        } else if (!cookieIsSet && streamOpen) {
                            console.log('retry init cookie');
                            checkStatus();
                        } else if (!streamOpen && cookieIsSet) {
                            console.log('retry stream');
                            openStream();
                            checkStatus();
                        }
                    }, 100);
                } else {
                    if (!cookieIsSet && !streamOpen) {
                        console.log('init cookie and stream failed');
                        $scope.cookieError = true;

                    } else if (!cookieIsSet && streamOpen) {
                        console.log('init cookie failed');
                        $scope.cookieError = true;


                    } else if (!streamOpen && cookieIsSet) {
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
    $scope.redirectToEnd = function () {
        window.location = "./end/" + $scope.wishName + '/' + $scope.wishText;
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
                    console.log(globalAverage);
                    if(Math.floor(globalAverage) > 20){
                        pJSDom[1]["pJS"]['particles']['move']['speed'] = Math.floor(globalAverage) / 5;
                    }

                    $(blowOverlayClass).css('margin-top', marginCounter + "%");
                    /*   console.log(globalAverage);
                     console.log((maxMicPeak - micPeakOffset));*/

                    if (cookieIsSet && globalAverage > (maxMicPeak - micPeakOffset) && !pushEnabled && !calibrating && canBlow) {
                        console.log('blow counter working');
                        marginCounter = marginCounter - blowSpeed;
                        if (marginCounter < counterEnd) {
                        /*    pushEnabled = true;
                            console.log('pusher activated');
                            $scope.activatePusher();
                            $scope.wishSend = true;
                            $scope.redirectToEnd();*/

                            // wel weer aanzetten!!!!!!
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
