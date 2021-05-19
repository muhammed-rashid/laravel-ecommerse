@extends('layouts.frontent-layout')
@section('content')
 <div class="container">
     <div class="row">

     
<div class="col-md-6 col-md-offset-3 mt-5 mb-5">
    <div class="card" width="100%">

        <div class="card-body">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h5 class="card-title">Forgot Password</h5>
          <hr>
          <p class="error-show"></p>
         <form id="forgot-form" class="form-group" method="POST" action="/forgot-password">
            @csrf
           <input type="email" placeholder="Enter Your Email Adress" name="email" class="form-control" required/>
           
           
           <input type="submit" value="Send Verification Email" class="site-btn mt-5" id="forgot_password">
           
         </form>
    </div>
</div>
          
      

</div>     
</div>
</div>  
@endsection
@section('scripts')
<script src ="{{asset('js/frontent/auth/userhandler.js')}}"></script>
    
@endsection