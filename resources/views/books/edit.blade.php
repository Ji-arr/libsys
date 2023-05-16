@extends('layouts.layout')
<style>
    .content-container {
        padding: 0 50px 50px 50px;
    }
    Form {
        width: 70%;
        margin: 50px auto;
    }
    .btn-default {
        background: red !important;
        color: white !important;
    }
    .btn-default:hover {
        background: rgb(90, 10, 10) !important;
    }
    .content-container h1{
        text-align: center;
    }
</style>
    @section('contents')
        <div class="content-container">
                    <h1>Edit Book</h1>

            {!! Form::open(['action' => ['App\Http\Controllers\BookController@update', $book->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
        <hr>
                {{Form::hidden('_method', 'PUT')}}
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                <a href="/books/{{$book->id}}" class="btn btn-default">Cancel</a>

            {!! Form::close() !!}
        </div>
 
    @endsection