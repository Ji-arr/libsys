@extends('layouts.layout')

<script></script>
<style>
    .table-striped{
        margin:5px;
    }
    .content-container {
        padding: 0 50px 50px 50px;
    }
</style>
    @section('contents')
    <div class="content-container">

        <div class="row">
            <div class="panel-body">
                <form class="search-box">
                    <input type="text" placeholder="Search" name="adminsearch" id="adminsearch">
                    <button class="btn btn-default" type="submit">Go</button>
                </form>    
               
                </div>
    
                @if (count($books) > 0)
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Book-ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Description</th>
                        <th scope="col">Operation</th>
                      </tr>
                    </thead>
                    <tbody id="alldata">                  
                        @foreach ($books as $book)
                        <tr>
                            <td >{{$book->id}}</td>
                            <td >{{$book->title}}</td>
                            <td>{{$book->author}}</td>
                            <td>{{$book->description}}</td>
                            <td style="width:130px;">  
                                <div class="flex-con" style="display: flex; grid-gap: 1rem;">
                                    <a href="/books/{{$book->id}}/edit" class="btn btn-default" style="background: green; width: 70px; color:azure;">Edit</a>
                                    <a href="books.delete/{{$book->id}}" class="btn btn-danger" style="background: DE0404; width: 70px; color:azure;">Delete</a>  
                                </div>           
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tbody id="searchdata"></tbody>
                </table>
                @else
                    <h1 style="margin-top: 50px; ">No books found</h1>
                @endif  
                <div class="paginator">
                    {{$books->links()}}
                </div>
            </div>
        </div>

    </div>
  
    @endsection

    @section('scripts')
    <script>
        $(document).ready(function(){
            $('#adminsearch').on('keyup', function(){
                const searchInput = document.getElementById('#adminsearch');
                var query = $(this).val();
                if(query){
                    $('#alldata').hide();
                    $('#searchdata').show();
                }
                else {
                    $('#alldata').show();
                    $('#searchdata').hide();
                }
                $.ajax({
                    url:"{{route('adminSearch')}}",
                    type:'GET',
                    data:{'adminsearch':query},
                    success:function(data){
                        $('#searchdata').html(data);
                    }
                });
            });
        });

    </script>
    @endsection
