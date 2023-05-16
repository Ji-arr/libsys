<style>
.message-container {
    position: absolute;
    margin-top:60px;
    left: 500;
    right: 500;
    text-align: center;
    z-index: 1;
    -webkit-animation: cssAnimation 5s forwards; 
}
@-webkit-keyframes cssAnimation {
    0%   {opacity: 1;}
    90%  {opacity: 1;}
    100% {opacity: 0;}
}
</style>
    <div class="message-container">
        
        @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
        @endif

        @if(session('success'))

            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif


        @if(session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>