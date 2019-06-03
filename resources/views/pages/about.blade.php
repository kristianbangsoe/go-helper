@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    <p>{{$info}}</p>

    @if(count($lists) > 0) 
        <ul>
            @foreach($lists as $list)
            <li>{{$list}}</li>
            @endforeach
        </ul>
    @endif
@endsection