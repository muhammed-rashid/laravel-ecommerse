@extends('layouts.frontent-layout')
@section('content')
 <div class="container">
<div class="col-md-6 col-md-offset-3 mt-5 mb-5">
    <div class="card" width="100%">

        <div class="card-body">
         
          <h5 class="card-title">Reset Password</h5>
          <hr>
          <div class="error-show"></div>
         



         <form method="POST" action="/reset-password" id="reset_password">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
              <label for="exampleInputEmail1 "class="small-labl">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
             
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1 " class="small-labl">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="password" name="password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="small-labl">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm password" name="password_confirmation">
              </div>
            
            <button type="submit" class="site-btn " id="reset_password_button">Reset Password</button>
          </form>




        </div>
      </div>    


</div>     

</div>  
@endsection
@section('scripts')
<script src ="{{asset('js/frontent/auth/userhandler.js')}}"></script>
    
@endsection