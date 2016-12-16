@extends('layouts.layout')

@section('content')
<div>
    @foreach($wishes as $wish)
        {{$wish->name}}
    @endforeach

        {{ $wishes->links() }}
</div>
@endsection