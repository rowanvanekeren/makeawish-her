@extends('layouts.wish')

@section('content')

    <div class="container-fluid">

        <!-- DIT MOET ALS LAATSTE KOMEN IN WISH.BLADE.PHP -->
        <div class="col-md-12">

            <div class="col-md-6 col-md-offset-3 end-wrapper">
                <div class="text">
                    <p>See it on Insta!</p>
                </div>

                <!-- LightWidget WIDGET -->
                <div class="title-custom">
                <div class='embedsocial-instagram' data-ref="a5e1041473528a803f7358796d9525ac932840cf" style="color:white !important;">

                </div>
                </div>
                <script>(function (d, s, id) {
                        var js;
                        if (d.getElementById(id)) {
                            return;
                        }
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "https://embedsocial.com/embedscript/in.js";
                        d.getElementsByTagName("head")[0].appendChild(js);
                    }(document, "script", "EmbedSocialInstagramScript"));</script>

            </div>


        </div>


    </div>

@endsection
