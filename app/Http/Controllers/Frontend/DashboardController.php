<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
class DashboardController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $users = User::all()->toArray();

        $memberId = $request->member;
        if (empty($memberId)) {
            $memberId = 1;
            // redirect sang tab Admin Trần Văn Tuấn id = 1
            return redirect('?member='.$memberId);
        }

        $dataProfiles = User::leftJoin('profiles', function($join) {
            $join->on('users.id', '=', 'profiles.user_id');
          })
          ->select(
            'users.id as user_id',
            'profiles.id as profiles_id',
            'users.name as name',
            'profiles.title',
            'profiles.description',
            'profiles.slug',
            'profiles.created_at',
            'profiles.updated_at',
            'profiles.del_flag'
          )
          ->where('profiles.user_id', (int)$memberId)
          ->where('profiles.del_flag', 0)
          ->get();

        return view('dashboard', [
            'users' => $users,
            'dataProfiles' => $dataProfiles
        ]);
    }

}
