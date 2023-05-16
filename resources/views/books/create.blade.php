@extends('layouts.layout')
<style>
    Form {
        width: 50%;
        margin: 50px auto;
    }
    h1 {
        text-align: center
    }
    .content-container {
        padding: 0 50px 50px 50px;
    }
</style>
    @section('contents')
        <div class="content-container">
                    <h1>Post Book</h1>

            {!! Form::open(['action' => 'App\Http\Controllers\BookController@store' , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('title', 'Title')}}
                {{Form::text('title', '',['class' => 'form-control', 'placeholder' => 'Title'])}}
                </div>
                <div class="form-group">
                    {{Form::label('author', 'Author')}}
                {{Form::text('author', '',['class' => 'form-control', 'placeholder' => 'Author'])}}
                </div>
                <div class="form-group">
                    {{Form::label('description', 'Description')}}
                {{Form::textarea('description', '',['class' => 'form-control', 'placeholder' => 'Description Text'])}}
                </div>
                <div class="form-group">
                    {{Form::label('quantity', 'Quantity')}}
                {{Form::text('quantity', '',['class' => 'form-control', 'placeholder' => 'Quantity'])}}
                </div>
                <hr>
                <div class="form-group">
                    {{Form::file('book_image')}}
                </div>        
                <br>
                <hr>
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        
        </div>
    @endsection