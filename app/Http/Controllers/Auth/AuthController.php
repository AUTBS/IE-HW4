<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
//        $code = $data['CaptchaCode'];
//
//
//        if( !captcha_validate($code))
//            return Validator::make($data,[
//                    'temp' => 'required'
//                ]);


        $validator = Validator::make($data, [
           'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6'
        //    ,'CaptchaCode' => 'required'
        ]);
//        if ($validator->fails()) {
//            return Redirect::to('/login')
//                ->withErrors($validator);
//        }else
            return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        if(Input::hasfile('image')){
            $image = Input::file('image');
            $upload = base_path().'\\public\\photo';
            $filename = rand(1111111,9999999).'.jpg';
            $image->move($upload, $filename);
        }else
            $filename = "de.jpg";

        $now = Carbon::now();
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['lastname'],
            'image'=>$filename,
            'email' => $data['email'],
            'online' => $now,
            'password' => bcrypt($data['password']),
        ]);
    }


}
