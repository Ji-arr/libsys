@extends('layouts.layout')
<title>{{ 'Accounts' }}</title>

<style>
    .content-container {
        padding: 0 50px 50px 50px;
    }
    .flex-container{
            height: auto;
            display: flex;
            flex-flow: wrap;
            justify-content: center;
            position: relative;
            margin-top: 50px;
    }
    .flex-box {
        margin: 10px 10px 10px 30px;
        flex-flow: wrap;
        position: relative;
        align-items: center;
        height: 100px;
        width: auto;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0 14px 28px rgba(0,0,0,0.22);
        position: relative;
        display: flex;
    }
    .flex-box a{
      text-decoration:none;
      display: inline;
    }
    .role-container{
        border-radius:50%;
        background:black;
        margin: 5px;
        height: 90px;
        width: 90px;
        float: left;
        padding: 15px;
    }
    .role-container h1{
        -webkit-text-stroke: .5px #ffffff;
        color: black;
        font-size: 50px;
        text-align: center;
    }
    .name-container{
        float: left;
        margin: 5px; 
        padding: 5px;
        margin-top:15px;
        min-width: 200px;
        color:black;
    }
</style>
    @section('contents')
      <div class="content-container">

      <div class="flex-container">

          @if (count($Users) > 0)
              @foreach ($Users as $User)
             
             <div class="flex-box">
              <a href="accounts/{{$User->id}}">
                  <div class="cutoff-text">
                        <div class="role-container">
                            @If($User->role == 1)
                            <h1 style="font-weight: bold;">A</h1>
                            @else
                            <h1 style="font-weight: bold;">C</h1>
                            @endif
                        </div>
                        <div class="name-container">
                            <h5 style="font-weight: bold;">{{$User->name}}</h5>
                            <small style="font-weight: bold;">ID: {{$User->id}}</small><br>
                            <small style="font-weight: bold;">{{$User->email}}</small>
                        </div>
                    </div>

                  </div>
              </a>
              @endforeach 
          @else
          <h3 style="margin-top: 50px; margin-left:50px; color:#81858c">No record found</h3>
          @endif      

      </div>
      <div class="paginator">
          {{$Users->links()}};
      </div>
      </div>
    @endsection