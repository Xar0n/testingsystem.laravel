<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\CheckUser;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

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
    protected $redirectTo = '/admin_panel/users/add';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

	public function register(CheckUser $request)
	{
		event(new Registered($user = $this->create($request->all())));

		$this->guard()->login($user);

		return $this->registered($request, $user)
			?: redirect($this->redirectPath());
	}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
			'name' => $data['name'],
			'surname' => $data['surname'],
			'patronymic' => $data['patronymic'],
			'city' => $data['city'],
			'group_id' => $data['group_id'],
        ]);
    }
}
