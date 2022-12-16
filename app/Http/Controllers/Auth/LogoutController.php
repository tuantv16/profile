<?php
     namespace App\Http\Controllers\Auth;
     use Illuminate\Http\Request;
     use App\Http\Controllers\Controller;
     use Illuminate\Support\Facades\Auth;
     use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
     {
         public function __construct() {
             $this->middleware('auth');
         }

         public function logout(Request $request) {
            // xóa session
            // if (Session::has('email')) {
            //     $request->session()->forget(['email']);
            //     $request->session()->flush();
            // }
             Auth::logout();
             return redirect('login');
         }
     }
?>