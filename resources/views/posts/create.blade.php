@extends('layouts.app')

@section('content')
<div class="mt-5 bg-white p-5 item box">

    <h2>Opret opgave</h2>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST']) !!}
        <div class="form-group mt-3">
            {{Form::label('category', 'Vælg kategori')}}
            <select name="category" id="category" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach 
            </select>
        </div>
        <div class="form-group">
            {{Form::label('title', 'Overskrift')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Beskrivelse af opgaven')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body text'])}}
        </div>

        {{Form::submit('Slå opgave op', ['class' => 'btn btn-primary'])}}

    {!! Form::close() !!}

</div>
@endsection




