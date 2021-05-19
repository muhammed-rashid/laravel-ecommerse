@extends('layouts.frontent-layout')
@section('content')
 <div class="container">
<div class="col-md-6 col-md-offset-3 mt-5 mb-5">
    <div class="card" width="100%">

        <div class="card-body">
          <h5 class="card-title">Email Verification</h5>
     
          <p class="card-text">An Email Is sended to Your account Please verify to continue</p>
         <form id="resend-form">
            @csrf
            <a href="" id="resend">Resend Verification Email</a>
         </form>
        </div>
      </div>    


</div>     

</div>  
@endsection
@section('scripts')
<script src ="{{asset('js/frontent/auth/userhandler.js')}}"></script>
    
@endsection