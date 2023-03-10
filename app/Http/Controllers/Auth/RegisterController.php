<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Session;
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

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return ModelsUser::create([
            'name' => $data['name'],
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'del_flag' => 0,
            'role'=> 0 // 1: quy???n admin cao nh???t, 0: user b??nh th?????ng
        ]);
    }

    public function getRegister() {
    	return view('auth/register');
    }

    public function postRegister(Request $request) {
        // Ki???m tra d??? li???u v??o
    	$allRequest  = $request->all();	

    	$validator = $this->validator_login($allRequest);
     
    	if ($validator->fails()) {
    		// D??? li???u v??o kh??ng th???a ??i???u ki???n s??? th??ng b??o l???i
    		return redirect('admin/register')->withErrors($validator)->withInput();
    	} else {   
    		// D??? li???u v??o h???p l??? s??? th???c hi???n t???o ng?????i d??ng d?????i csdl
    		if( $this->create($allRequest)) {
    			// Insert th??nh c??ng s??? hi???n th??? th??ng b??o
    			Session::flash('success', '????ng k?? th??nh vi??n th??nh c??ng!');
    			return redirect('admin/register');
    		} else {
    			// Insert th???t b???i s??? hi???n th??? th??ng b??o l???i
    			Session::flash('error', '????ng k?? th??nh vi??n th???t b???i!');
    			return redirect('admin/register');
    		}
    	}
    }

    public function getRegisterHome() {
    	return view('auth/register');
    }

    public function postRegisterHome(Request $request) {
        // Ki???m tra d??? li???u v??o
    	$allRequest  = $request->all();	

        
    	$validator = $this->validator_login($allRequest);
     
        Session::flash('flag_register', true);
    	if ($validator->fails()) {
    		// D??? li???u v??o kh??ng th???a ??i???u ki???n s??? th??ng b??o l???i
    		return redirect('/register')->withErrors($validator)->withInput();
    	} else {   
    		// D??? li???u v??o h???p l??? s??? th???c hi???n t???o ng?????i d??ng d?????i csdl
    		if( $this->create($allRequest)) {
    			// Insert th??nh c??ng s??? hi???n th??? th??ng b??o
    			Session::flash('success', '????ng k?? t??i kho???n th??nh c??ng!');
    			return redirect('/register');
    		} else {
    			// Insert th???t b???i s??? hi???n th??? th??ng b??o l???i
    			Session::flash('error', '????ng k?? t??i kho???n th???t b???i!');
    			return redirect('/register');
    		}
    	}
    }

    protected function validator_login(array $data)
    {
    	return Validator::make($data,
    		[
    			'name' => 'required|string|max:255',
                'fullname' => 'required|string|max:255',
    			'email' => 'required|string|email|max:255|unique:users',
    			'password' => 'required|string|min:6|confirmed',
    		],
    		[
    			'name.required' => 'T??n t??i kho???n l?? tr?????ng b???t bu???c',
    			'name.max' => 'T??n t??i kho???n kh??ng qu?? 255 k?? t???',
                'fullname.required' => 'H??? v?? t??n l?? tr?????ng b???t bu???c',
    			'fullname.max' => 'H??? v?? t??n kh??ng qu?? 255 k?? t???',
    			'email.required' => 'Email l?? tr?????ng b???t bu???c',
    			'email.email' => 'Email kh??ng ????ng ?????nh d???ng',
    			'email.max' => 'Email kh??ng qu?? 255 k?? t???',
    			'email.unique' => 'Email ???? t???n t???i',
    			'password.required' => 'M???t kh???u l?? tr?????ng b???t bu???c',
    			'password.min' => 'M???t kh???u ph???i ch???a ??t nh???t 8 k?? t???',
    			'password.confirmed' => 'X??c nh???n m???t kh???u kh??ng ????ng',
    		]
    	);
    }

}
