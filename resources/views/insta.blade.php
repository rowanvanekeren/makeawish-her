@extends('layouts.wish')

@section('content')

<div class="container" ng-controller="InstaAngController" ng-init="initEvets()">
<form method="post" action="postinsta">
    {{ csrf_field() }}
    <input type="submit" name="submit" value="testpostinsta"/>

</form>

<div id="insta_image">
<h1> testtest</h1>

</div>

    <button type="button" id="btnSave"> make img</button>
    <div class="test_image">

    </div>

</div>
@endsection