@extends('layouts.layout')
<title>{{('books') }}</title>
<style>
    .flex-container{
            width: 100%;
            height: auto;
            display: flex;
            flex-flow: wrap;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-top: 50px;
    }
    .flex-box {
        margin: 10px;
        position: relative;
        height: 300px;
        width: 200px;
        border-radius: 5px;
        text-align: center;
        cursor: pointer;
        box-shadow: 0 14px 28px rgba(0,0,0,0.22);
    }
    .flex-box:hover{
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.23);
        transform: translate(0px, -8px);
    }
    .flex-container a:hover {
        color: white;
    }
    .flex-container a {
        color: black;
        text-decoration: none;   
    }

    .flex-box h4 {
        word-wrap: break-word;
        margin: 5;
        --max-lines: 1;
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: var(--max-lines);
    }
    .flex-box h6 {
        word-wrap: break-word;
        margin: 5;
    }
    .flex-box small {
        position: absolute;
        bottom: 0px;
        left: 0px;
        right: 0px;
    }
    
    .search-box {
        position: relative;
        max-width: 450px;
        margin:auto;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
    }
    .search-box input{
        position: relative;
        width: 100%;
        height: 55px;
        padding: 0  60px 0 20px;
        border-radius: 50px;
        border: solid black 1px;

    }
    .search-box button{
        background: rgb(75, 204, 107);
        position: absolute;
        padding: 6px;
        top: 5px;
        right: 5px;
        height: 45px;
        width: 70px;
        align-items: center;
        border-radius: 50px;
        color: white;
        font-size: 20px;
        border: none !important;
    }
    .search-box button:hover{
        background: rgb(10, 173, 51);
    }
    .paginator {
        margin: 50px auto; 
        left: 40px;
        height: 50px;
        width: 200px;
        position: relative;
    }
    .flex-container .cutoff-text {
        --max-lines: 4;
        display: -webkit-box;
        overflow: hidden;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: var(--max-lines);
    }
    @keyframes color-animation { 
        0% { 
        background: #ad1457; 
        } 
        50% { 
        background: #6a1b9a; 
        }  
        100% { 
        background: #bbdefb 
        } 
    }

</style>
    @section('contents')

        <form class="search-box" action="{{url('search')}}" method="GET">

            <input type="text" placeholder="Search" name="query">
            <button class="btn btn-default" type="submit" style="font-weight: bold;">Go</button>
        </form>    
        <div class="flex-container">

            @if (count($books) > 0)
                @foreach ($books as $book)
               
               <div class="flex-box" style="background:{{$book->color}}; text-decoration:none;">
                <a href="/books/{{$book->id}}">
                    <img style="width:90%; height:50%; margin-top:10px;" src="/storage/book_images/{{$book->book_image}}" alt="Image">
                    <div class="cutoff-text">
                        <h4 style="font-weight: bold;">{{$book->title}}</h4>
              
                            <h6>{!!$book->author!!}</h6>
                        </div>
                        <small> Posted {{$book->created_at}}</small>
                    </div>
                </a>
                @endforeach 
            @else
            <h3 style="margin-top: 50px; margin-left:50px; color:#81858c">No Books found</h3>
            @endif      

        </div>
        <div class="paginator">
            {{$books->links()}};
        </div>


    @endsection