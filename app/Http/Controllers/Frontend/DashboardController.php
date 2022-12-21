<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
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

        $dataInputs = $request->all();
        $profileId = isset($dataInputs['profile_id']) ? (int)$dataInputs['profile_id'] : '';
        $keysearch = isset($dataInputs['keysearch']) ? $dataInputs['keysearch'] : '';
       
        $users = User::all()->toArray();

        $userLoginId = Auth::user()->id;
        $memberId = $request->member;
        if (empty($memberId) && empty($keysearch)) {
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
            'profiles.mime',
            'profiles.original_filename',
            'profiles.filename',
            'profiles.slug',
            'profiles.created_at',
            'profiles.updated_at',
            'profiles.del_flag'
          )
          //->where('profiles.user_id', (int)$memberId)
          ->where(function($query) use ($memberId, $keysearch, $profileId, $userLoginId)  {
                if(!empty($memberId)) {
                    $query->where('profiles.user_id', $memberId);
                    // Phân quyền. Trường hợp tài khoản không phải là login thì sẽ không xem được những câu hỏi bảo mật (check box bảo mật) đã được cài đặt trong phần quản trị.
                    if ($userLoginId != 1) { //id = 1: là admin
                        $query->where('profiles.security', '<>' , 1); // 1: bảo mật, 0: không bảo mật
                    }    
                }

                // Tìm kiếm theo id hồ sơ
                if(!empty($profileId)) {
                    $query->where('profiles.id', $profileId);
                }

                // Tìm kiếm theo từ khóa
                if(!empty($keysearch)) {
                    $query->where('profiles.title', 'LIKE', '%'.$keysearch.'%');
                }


                
            })
          ->where('profiles.del_flag', 0)
          ->get();

        $listTitles = Profile::where('profiles.user_id', $memberId)->get();
        //$listTitles = $listTitles->toArray();
      
        $listTitlesEncode = json_encode($listTitles, JSON_UNESCAPED_UNICODE);
        // echo '<pre>';
        // var_dump($listTitlesEncode);
        // die('dfsd');
        return view('dashboard', [
            'users' => $users,
            'dataProfiles' => $dataProfiles,
            'listTitles' => $listTitles,
            'listTitlesEncode' => $listTitlesEncode
        ]);
    }


}
