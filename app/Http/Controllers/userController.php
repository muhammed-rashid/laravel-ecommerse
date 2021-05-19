<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

use Illuminate\Auth\Events\PasswordReset;

class userController extends Controller
{
    //get register
    public function getRegister()
    {
        if (Auth::check() && Auth::user()->role == "user" && Auth::user()->email_verified_at != null) {
            return redirect('/');
        } else if (Auth::check() && Auth::user()->role == "admin") {
            return redirect('/admin');
        } else {
            return view('register');
        }
    }

    //do register

    public function register(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required|regex:/(91)[0-9]{10}/'
        ]);

        if ($validator->fails()) {
            return response()->Json(array(
                'status' => 'form-val-err',

                'errors' => $validator->getMessageBag()->toArray()
            ));
        }

        $exist = User::where('email', $request->email)->first();
        if ($exist != null) {
            return response()->Json([
                'status' => 'error',
                'message' => 'this email is already exist in our database'
            ]);
        }

        //check two password are same or not
        if ($request->password != $request->confirm_password) {
            return response()->Json([
                'status' => 'error',
                'message' => 'passwords do not match'
            ]);
        }
        if (strlen($request->password) < 6) {
            return response()->Json([
                'status' => 'error',
                'message' => 'passwords must contain atleast 6 lenght '
            ]);
        }

        //hashing password
        $hashed_password = Hash::make($request->password);


        $user = new User();
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = 'user';
        $user->password = $hashed_password;
        $user->save();

        event(new Registered($user));
        $user = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($user) && Auth::user()->role == "user") {
            //return redirect('/email/veri');
            return response()->Json(array(
                'status' => 'success'
            ));
        } else {
            //return redirect('/register');
            return response()->Json(array(
                'status' => 'fail',
                'message' => 'Something went wrong please try again'
            ));
        }
    }


    //get login route
    public function getLogin()
    {
        if (Auth::check() && Auth::user()->role == "user" && Auth::user()->email_verified_at != null) {
            return redirect('/');
        } else if (Auth::check() && Auth::user()->role == "admin") {
            return redirect('/admin');
        } else {
            return view('login');
        }
    }


//forgot password enter here

public function forgot_password(Request $request){
    $validator = \Validator::make($request->all(),[
        'email' => 'required|email'
    ]);

    if($validator->fails()){
        return response()->json(array(
            'status'=>'error',
            'message'=>'A valid email adress is required'
        ));
      
    }
    

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
    ? response()->json(array(
'status'=>'success',
'messages'=>__($status)
    ))
    : response()->json(array(
        'status'=>'error',
        'message'=>__($status)
    ));

}

//resert password post request enter here

public function reset_password(Request $request){
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) use ($request) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();

            $user->setRememberToken(Str::random(60));

            event(new PasswordReset($user));
        }
    );
return $status == Password::PASSWORD_RESET
?response()->json(array(
    'status'=>'success',
    'message'=>__($status)
)):response()->json(array(
    'status'=>'error',
    'message'=>__($status)
));
}
//reset end here

















    //do login
    public function login(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->Json(array(
                'status' => 'error',
                'message' => 'All Field is Required'
            ));
        }
        if (strlen($request->password) < 6) {
            return response()->Json([
                'status' => 'error',
                'message' => 'passwords must contain atleast 6 lenght '
            ]);
        }
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->email_verified_at != null) {
                $request->session()->regenerate();

                //return redirect()->intended('/');
                return response()->Json(array(
                    'status' => 'success',
                    'area' => 'user'
                ));
            } else {
                //return redirect('/email/veri');
                return response()->Json(array(
                    'status' => 'success',
                    'area' => 'not-verified'
                ));
            }
        }

        return response()->Json(array(
            'status' => 'error',
            'message' => 'Credential not match'
        ));
    }


    //do logout
    public function doLogout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
