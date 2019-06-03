@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">GO BACK</a>
    <h1>{{$post->title}}</h1>
   
        <div class="well">
            <p>{{$post->title}}</p>
            <p>{!!$post->body!!}</p>
            <p>{{$post->created_at}}</p>
            <hr>
        </div>
        <div class="d-flex justify-content-between">
                <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => ''])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('DELETE', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        </div>


        @endsection