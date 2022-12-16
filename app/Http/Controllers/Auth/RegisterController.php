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
            'role'=> 0 // 1: quyền admin cao nhất, 0: user bình thường
        ]);
    }

    public function getRegister() {
    	return view('auth/register');
    }

    public function postRegister(Request $request) {
        // Kiểm tra dữ liệu vào
    	$allRequest  = $request->all();	

    	$validator = $this->validator_login($allRequest);
     
    	if ($validator->fails()) {
    		// Dữ liệu vào không thỏa điều kiện sẽ thông báo lỗi
    		return redirect('admin/register')->withErrors($validator)->withInput();
    	} else {   
    		// Dữ liệu vào hợp lệ sẽ thực hiện tạo người dùng dưới csdl
    		if( $this->create($allRequest)) {
    			// Insert thành công sẽ hiển thị thông báo
    			Session::flash('success', 'Đăng ký thành viên thành công!');
    			return redirect('admin/register');
    		} else {
    			// Insert thất bại sẽ hiển thị thông báo lỗi
    			Session::flash('error', 'Đăng ký thành viên thất bại!');
    			return redirect('admin/register');
    		}
    	}
    }

    public function getRegisterHome() {
    	return view('auth/register');
    }

    public function postRegisterHome(Request $request) {
        // Kiểm tra dữ liệu vào
    	$allRequest  = $request->all();	

        
    	$validator = $this->validator_login($allRequest);
     
        Session::flash('flag_register', true);
    	if ($validator->fails()) {
    		// Dữ liệu vào không thỏa điều kiện sẽ thông báo lỗi
    		return redirect('/register')->withErrors($validator)->withInput();
    	} else {   
    		// Dữ liệu vào hợp lệ sẽ thực hiện tạo người dùng dưới csdl
    		if( $this->create($allRequest)) {
    			// Insert thành công sẽ hiển thị thông báo
    			Session::flash('success', 'Đăng ký tài khoản thành công!');
    			return redirect('/register');
    		} else {
    			// Insert thất bại sẽ hiển thị thông báo lỗi
    			Session::flash('error', 'Đăng ký tài khoản thất bại!');
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
    			'name.required' => 'Tên tài khoản là trường bắt buộc',
    			'name.max' => 'Tên tài khoản không quá 255 ký tự',
                'fullname.required' => 'Họ và tên là trường bắt buộc',
    			'fullname.max' => 'Họ và tên không quá 255 ký tự',
    			'email.required' => 'Email là trường bắt buộc',
    			'email.email' => 'Email không đúng định dạng',
    			'email.max' => 'Email không quá 255 ký tự',
    			'email.unique' => 'Email đã tồn tại',
    			'password.required' => 'Mật khẩu là trường bắt buộc',
    			'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
    			'password.confirmed' => 'Xác nhận mật khẩu không đúng',
    		]
    	);
    }

}
