@extends('layouts.layout')
<title>{{ config('app.name') }}</title>
<style>
  #text-animation {
    animation-name: color-animation;
    animation-duration: 5s;
    animation-iteration-count: infinite;
    -webkit-text-stroke: 1px #fff;
    font-size: 100px;  
  } 
  @keyframes color-animation { 
        0% { 
        color: #00D100; 
        } 
        50% { 
        color: #007500; 
        }
        75%{ 
        color: transparent; 
        }
        100%{ 

        color: #00D100; 
        }
        
    }
    .bg-image {     
      background-image: url('{{ asset('images/cvsu.jpg')}}');
      background-color: #cccccc;
      height: 600px;
      margin-top:-50px;
      background-position: center;
      background-attachment: fixed;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
      filter: blur(4px);
      -webkit-filter: blur(4px);
    }
    .textbox {
      position: absolute;
      margin: auto;
      left:0;
      right:0;
      width: 500px;
      top:5%;
      background: rgba(31, 28, 28, 0.6);
      border: 10px double white;
      border-radius: 10%;
      animation-iteration-count: infinite;
      -webkit-border-stroke: 1px #fff;
    }

</style>
@section('contents')
    <div class="asd">
        <div class="bg-image"></div>        

      @if (!Auth::guest())
      <div class="text-secondary px-4 text-center textbox">
        <div class="py-5 textcontainer">
          <h1 id="text-animation">CVSU</h1>
          <h1 class="display-5 fw-bold text-white" style="font-size:40px;">Library System</h1>
        </div>
      </div> 
      @else
        <div class="text-container">
          <div class="text-secondary px-4 text-center textbox">
            <div class="py-5 textcontainer">
              <h1 class="display-5 fw-bold text-white" style="font-size:40px; ">Welcome to</h1>
              <h1 id="text-animation">CVSU</h1>
              <h1 class="display-5 fw-bold text-white" style="font-size:40px;"> Library System</h1>
              <div class="col-lg-3 mx-auto">  
                <div class="d-grid gap-2 d-sm-flex mx-center justify-content-sm-center" style=" position: relative;margin-top:50px;">
                    <a href="/login"><button type="button" class="btn btn-info btn-lg px-4 me-sm-3 fw-bold">Login</button></a>
                    <a href="/register"><button type="button" class="btn btn-dark btn-lg px-3 me-sm-3 fw-bold">Register</button></a>
                </div>
              </div>
            </div>
          </div> 
        </div>
        @endif
      </div>
@endsection