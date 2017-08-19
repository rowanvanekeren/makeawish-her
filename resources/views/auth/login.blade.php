@extends('layouts.wish')

@section('content')

<style>
      .login-form{
          position: relative;
          top:30%;
          margin: 0 auto;
          width: 300px;
          text-align: center;
          font-family: arial,sans-serif;
      }

    .form-group input{
        height: 40px;
        padding: 5px;
        width: 100%;
        margin-top: 15px;
    }
    .form-group{

        display:block;
        width: auto;
    }
    .submit-login{
        width: 100%;
        margin-top: 15px;
        height: 40px;
        background-color: #6b47af; /* Green */
        border: none;
        color: white;

        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }
</style>


<div class=" login-form">
    <div class="">
        <h1 style="color:white;">Login</h1>
        <form class="form-horizontal  " role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
{{--            <label for="name" class="col-md-4 control-label">Naam</label>--}}

                <div class="col-md-12">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  required autofocus placeholder="Naam">

                    @if ($errors->has('name'))
                    <span class="help">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              {{--  <label for="password" class="col-md-4 control-label">Paswoord</label>--}}

                <div class="col-md-12">
                    <input id="password" type="password" class="form-control" name="password" required placeholder="Paswoord">

                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            @if ($errors->has('notexist'))
            <span class="help-block">
                <strong>{{ $errors->first('notexist') }}</strong>
            </span>
            @endif


            <div class="form-group">
                <div class="col-md-12 ">
                    <button type="submit " class=" btn-theme-1" style="width: 100%;">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>  
</div>

@endsection