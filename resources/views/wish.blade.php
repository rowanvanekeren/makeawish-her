@extends('layouts.wish')

@section('content')
    <?php
    $general_errors = new \App\Http\Helpers\general_errors();
    $preset_error = $general_errors->general_errors('cookiePreset');
    ?>
    <div ng-controller="wishAngController" class="container-fluid" >
        <div id="particles-js"></div>
        <div class="row steps" ng-hide="stepSection">
            <div class="col-md-4 col-md-offset-4 step-wrapper">
                <div class="step-section">
                    <div class="step-number">1</div>
                    <div class="step-title">Kies foto</div>
                </div>

                <div class="step-section">
                    <div class="step-number">2</div>
                    <div class="step-title">Bevestig foto</div>
                </div>
                <div class="step-section">
                    <div class="step-number">3</div>
                    <div class="step-title">Bewerk foto</div>
                </div>
                <div class="step-section">
                    <div class="step-number">4</div>
                    <div class="step-title">Verzend!</div>
                </div>
            </div>
        </div>
        <div class="row default-margin" ng-hide="uploadImgSection" >
            <div class="col-md-6 col-md-offset-3">
                <form enctype="multipart/form-data" id="upload_image_form" method="POST">
                    <input type="file" id="upload-image" name="upload_image"/>

                    <div class="center-wrapper">
                        <img id='take-picture-icon' class="take-picture-icon"
                             src="{{ asset('images/icons/camera-icon.png') }}" ng-click="selectImage()"/>
                    </div>
                </form>
                <div class="col-md-12">
                    <div class="seperation-line">
                        <h2><span>Of</span></h2>
                    </div>
                </div>
                <div class="loading-overlay" ng-show="loading">
                    <div>Loading...</div>
                    <div><img src="images/icons/loader.gif"/></div>
                </div>
                <div class="col-md-12">
                    <div class="slideShow">
                        <button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                        @if(isset($bg_images))
                            @foreach($bg_images as $key => $image)

                                <img class="mySlides" src="{{$image}}" ng-click="selectAlternativeImage($event)">

                            @endforeach
                        @endif
                        <button class="w3-button w3-display-right" onclick="plusDivs(+1)">&#10095;</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row default-margin" ng-show="previewConfirmationSection">
            <div class="col-md-12">
                <div class="polaroid">
                    <div>
                        <img class="preview-img" src=""/>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="confirmation-img">
                        <h2>Wil je deze foto gebruiken?</h2>

                        <div>
                            <button class="btn-theme-1" ng-click="backToSelect()">Nee</button>

                            <button class="btn-theme-1" ng-click="proceedToWish()">Ja</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" ng-show="showImageEditScreen">
            <div class="col-md-12">
                <div id="insta_image"  class="polaroid-big ">
                    <div class="inner-polaroid">
                        <img class="preview-img" src=""/>
                    </div>

                    <div id="main-text" class="dynamic-text-main">
                        <p id='mainText' ng-bind="dragWish">Drag me around</p>
                    </div>

                    <div id="footer-text" class="dynamic-text-footer">
                        <p id='footerText'ng-bind="dragName">Drag me around</p>
                    </div>

                </div>
                <div class="settings-area">
                    <form ng-submit="submitWish()">
                        {{ csrf_field() }}
                        <div class="col-md-12 options title-theme-1">
                            <h2>Jouw wens</h2>
                        </div>
                        <input type="text" id="wish" type="text" class="form-control" name="wish"
                               ng-model="wishFormWish" ng-change="projectInput(0)"
                               value="{{ old('wish')}}" autofocus placeholder="Voer hier je wens in"
                               autocomplete="off"
                               maxlength="80" required>
                        <input id="name" type="text" class="form-control" name="name" ng-model="wishFormName"
                               ng-change="projectInput(1)"
                               value="{{ old('name') }}" placeholder="Voer hier ja naam in" autocomplete="off"
                               maxlength="20" required>
                        <div class="col-md-12 options title-theme-1">
                            <h2>Filters</h2>
                        </div>
                        <div class="col-md-12">

                        <div class="col-md-12 options">
                            <p>Filter:Opacity</p>

                            <div id="opacityFilter"></div>
                        </div>
                        </div>
                        <div class="col-md-12 options title-theme-1">
                            <h2>Text Opties</h2>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6 options">
                                <h2>Wens</h2>

                                <div class="col-md-12 options-wrapper-wish">
                                    <p>Opties <span>&#9660</span></p>
                                </div>
                                <div class="col-md-12 options-content-wish">
                                    <p>Text grootte</p>

                                    <div>
                                        <div id="wishTextSize"></div>
                                    </div>
                                    <p>Text dikte</p>

                                    <div>
                                        <div id="wishTextBoldness"></div>
                                    </div>
                                    <p>Text uitlijning</p>

                                    <div>
                                        <select id="wishTextAlign">
                                            <option disabled selected>- Kies optie -</option>
                                            <option value="left">links</option>
                                            <option value="center">midden</option>
                                            <option value="right">rechts</option>
                                        </select>
                                    </div>
                                    <p>Text font</p>
                                    <div>
                                        <select id="wishTextFont">
                                            <option disabled selected>- Kies optie -</option>
                                            <option value="'Helvetica Neue', Helvetica, Arial, sans-serif">Helvetica</option>
                                            <option value="Rockwell">Rockwell</option>
                                            <option value="Impact, Charcoal, sans-serif">Impact</option>
                                            <option value="Brush Script MT, cursive">Script</option>
                                            <option value="Papyrus">Papyrus</option>
                                        </select>
                                    </div>

                                    <p>Text Kleur</p>

                                    <div>
                                        <input id="wishTextColor" type="color" value="#ffffff">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 options">
                                <h2>Naam</h2>

                                <div class="col-md-12 options-wrapper-name">
                                    <p>Opties <span>&#9660</span></p>
                                </div>
                                <div class="col-md-12 options-content-name">

                                    <p>Text grootte</p>

                                    <div>
                                        <div id="nameTextSize"></div>
                                    </div>
                                    <p>Text dikte</p>

                                    <div>
                                        <div id="nameTextBoldness"></div>
                                    </div>
                                    <p>Text uitlijning</p>

                                    <div>
                                        <select id="nameTextAlign">
                                            <option disabled selected>- Kies optie -</option>
                                            <option value="left">links</option>
                                            <option value="center">midden</option>
                                            <option value="right">rechts</option>
                                        </select>
                                    </div>

                                    <p>Text font</p>
                                    <div>
                                        <select id="nameTextFont">
                                            <option disabled selected>- Kies optie -</option>
                                            <option value="'Helvetica Neue', Helvetica, Arial, sans-serif">Helvetica</option>
                                            <option value="Rockwell">Rockwell</option>
                                            <option value="Impact, Charcoal, sans-serif">Impact</option>
                                            <option value="Brush Script MT, cursive">Script</option>
                                            <option value="Papyrus">Papyrus</option>
                                        </select>
                                    </div>

                                    <p>Text Kleur</p>

                                    <div>
                                        <input id="nameTextColor" type="color" value="#ffffff">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('wish'))
                            <span class="help-block">
                                <strong>{{ $errors->first('wish') }}</strong>
                            </span>
                        @endif

                        <button type="submit" class="submit-wish">Verzend wens!</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="" ng-show="closeWishEnter">

        </div>
        <div class="row">
     {{--           <div class="col-md-12 foldImg" style="background-image: url('images/insta/insta-598636e9ee31f.jpg'); width: 500px; height: 500px; position: relative; left: 100px"ng-controller="wishAngController">
                    <img class="" src="images/insta/@{{ savedImage }}"/>
                </div>--}}
        <div class="wish-blow" ng-controller="micStreamAngController" ng-init="initWish()" ng-show="blowingEnabled">
            <img src="{{asset('/images/upload.png')}}" alt="Een pijl dat naar boven wijst." ng-hide="wishSend">

            <div class="blowdiv">
                <div class="blowdiv-inner" style="background-image: url( {{asset('/images/tekstballon-2.png')}} )">
                    <h2>@{{ wishText }}</h2>

                    <p>@{{ wishName }}</p>
                </div>
            </div>

            <div class="text" ng-hide="wishSend">
                <p>Now blow it away!</p>
            </div>

            <div ng-show="cookieError">
                <div class="error">{{$preset_error}}</div>
                <a href="./calibration">Choose preset</a>
            </div>
        </div>
        </div>
    </div>
@endsection

