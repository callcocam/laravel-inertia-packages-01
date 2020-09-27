<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Call\Facades\Call;
use Call\Models\Form\Fields\Input;
use Call\Models\Form\Form;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View|\Call\Response
     */
    public function showRegistrationForm()
    {
        $form = Form::make('column',
            [
                'name'=>Input::make('Full Name','name')
                    ->get(),
                'email'=>Input::make('E-Mail Address','email')->type('email')
                    ->get(),
                'password'=>Input::make('Password')->type('password')->get(),
                'password_confirmation'=>Input::make('Password Confirmation','password_confirmation')->type('password')->get(),
                'terms'=>Input::make('Accept terms','terms')->type('checkbox')
                    ->option('yes','yes')
                    ->option('no','no')
                    ->get()
            ]
        )->attribute('action',route('register'))->getArrayCopy();

        return Call::setRootView('layouts.auth')->render("Auth/Register") ->with($form);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        return Redirect::route('admin');
    }
}
