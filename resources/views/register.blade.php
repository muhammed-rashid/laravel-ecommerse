@extends('layouts.frontent-layout')
@section('content')

 <!-- Register Section Begin -->
 <div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="register-form">
                    <h2>Register</h2>
                    <div class="error-show">
                     





                    </div>
                    <form action="/register" method="POST" name="registration-form" id="registration-form">
                        @csrf
                        <div class="group-input">
                            <label for="username">Email Address *</label>
                            <input type="email" id="email" name="email" placeholder="John@mail.com">
                        </div>
                        <div class="group-input">
                            <label for="con-pass">Mobile</label>
                            <input type="text" id="con-pass" name="phone" placeholder="+910000000000">
                        </div>
                        <div class="group-input">
                            <label for="pass">Password </label>
                            <input type="text" id="pass" name="password" placeholder="Enter Your password">
                        </div>
                        
                        <div class="group-input">
                            <label for="con-pass">Confirm Password</label>
                            <input type="text" id="con-pass" name="confirm_password" placeholder="confirm password">
                        </div>
                        <button type="submit" class="site-btn register-btn">REGISTER</button>
                    </form>
                    <div class="switch-login">
                        <a href="/login" class="or-login">Or Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
@endsection
@section('scripts')
<script src={{ asset('js/frontent/auth/userhandler.js') }}></script>
    
@endsection