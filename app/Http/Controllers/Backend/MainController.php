<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Profile;
class MainController extends Controller
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

    public function index() {
        //$data = Profile::all()->toArray();

        $data = DB::table('profiles')
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
        ->leftJoin('users', 'profiles.user_id', '=', 'users.id')
        ->where('profiles.del_flag',0)
        //->orderBy('post.id','DESC')
        ->get();
        $data = $data->toArray();
        $listProfiles = array_map(function($row) {
            return (array) $row;
        },$data);
        
        // echo '<pre>';
        // var_dump($listProfiles);
        // die('sfd2');
        return view('backend.main', [
            'listProfiles' => $listProfiles
        ]);
    }

    public function add(Request $request , $id = '') {
        $method = $request->method();
        if ($request->isMethod('post')) {
            $now = new \DateTime();
            $messages = [
                'image' => 'Định dạng không cho phép',
                'max' => 'Kích thước file quá lớn',
                'mimes' => 'Định dạng file không đúng (file phải có phần mở rộng là jpeg,png,jpg,gif,svg)'
            ];

            $validator = Validator::make($request->all(), [ // <---
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],$messages);

            if ($validator->fails()) {
                // Dữ liệu vào không thỏa điều kiện sẽ thông báo lỗi
                return redirect('admin/add')->withErrors($validator)->withInput();
            } else {  
                $dataInserts = [];
                $mime = $originalFilename = $filename = '';
                if(!empty($request->file('profile_image'))) {   //nếu tồn tại chọn file ảnh
                    $infoImages = $request->file('profile_image');
                    $extension = $infoImages->getClientOriginalExtension();
                    $nameImage = $infoImages->getClientOriginalName();
                   
                    Storage::disk('public')->put($infoImages->getFilename().'.'.$extension,  File::get($infoImages));
                    Storage::disk('public')->put($nameImage,  File::get($infoImages));

                    $mime = $infoImages->getClientMimeType();
                    $originalFilename = $infoImages->getClientOriginalName();
                    $filename = $infoImages->getFilename().'.'.$extension;
                }
                $dataInserts = [
                    'title'             => $request->title,
                    'description'       => $request->description,
                    'mime'              => $mime,
                    'original_filename' => $originalFilename,
                    'filename'          => $filename,
                    'user_id'           => $request->user_id,
                    'slug'              => $request->slug,
                    'security'          => $request->security,
                    "created_at"        => $now,
                    "updated_at"        => $now,
                    "del_flag"           => 0
                    
                ];
                $result = Profile::create($dataInserts);
                
                if ($result) {
                    $request->session()->flash('success', 'Cập nhật dữ liệu thành công!');
                    return redirect('admin');
                }
            }
        } else {
            return view('backend.profiles.add', []);
        }
        
        
    }

    public function edit(Request $request , $profileId = '') {
        $data = DB::table('profiles')
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
            'profiles.security', 
            'profiles.created_at', 
            'profiles.updated_at', 
            'profiles.del_flag'
        )
        ->leftJoin('users', 'profiles.user_id', '=', 'users.id')
        ->where('profiles.id', (int)$profileId)
        //->orderBy('post.id','DESC')
        ->first();
        $data = (array) $data;

        $fileNameImage = !empty($data['filename']) ? storage_path('app/public/profile_uploads/'.$data['filename']) : '';
        $method = $request->method();
        return view('backend.profiles.edit', [
            'data' => $data,
            'fileNameImage' => $fileNameImage
        ]);
        
        
        
    }

    public function update(Request $request) {
        if ($request->isMethod('post')) {
            $profileId = (int)$request->id;
            $curTime = new \DateTime();
            $messages = [
                'image' => 'Định dạng không cho phép',
                'max' => 'Kích thước file quá lớn',
                'mimes' => 'Định dạng file không đúng (file phải có phần mở rộng là jpeg,png,jpg,gif,svg)'
            ];

            $validator = Validator::make($request->all(), [ // <---
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],$messages);

            if ($validator->fails()) {
                // Dữ liệu vào không thỏa điều kiện sẽ thông báo lỗi
                return redirect('admin/edit')->withErrors($validator)->withInput();
            } else {  
                $dataUpdates = [
                    "title"               => $request->title,
                    "description"         => $request->description,
                    "slug"                => $request->slug,
                    //"updated_at"          => $curTime,
                    'security'             => !empty($request->security) ? 1 : 0,
                ];

                $delFlag = $request->flag_del_image;
                if(!empty($request->file('profile_image'))) {   //nếu tồn tại chọn file ảnh
                    $infoImages = $request->file('profile_image');
                    $extension = $infoImages->getClientOriginalExtension();
                    $nameImage = $infoImages->getClientOriginalName();
                    Storage::disk('public')->put($infoImages->getFilename().'.'.$extension,  File::get($infoImages));
                    Storage::disk('public')->put($nameImage,  File::get($infoImages));

                    $dataUpdates['mime'] = $infoImages->getClientMimeType();
                    $dataUpdates['original_filename'] = $infoImages->getClientOriginalName();
                    $dataUpdates['filename'] =  $infoImages->getFilename().'.'.$extension; 
                }

                if ($delFlag == 1) { // trường hợp xóa ảnh
                    $dataUpdates['mime'] = '';
                    $dataUpdates['original_filename'] = '';
                    $dataUpdates['filename'] =  ''; 
                }

                // đang làm chức năng xóa ảnh
            
                // echo '<pre>';
                // var_dump($profileId);
                // var_dump($dataUpdates);
                // die('thuc hien');
                $result = DB::table('profiles')
                ->where("id", (int)$profileId)
                ->update($dataUpdates);
             
                if ($result) {
                    $request->session()->flash('success', 'Cập nhật dữ liệu thành công!');
                    return redirect('admin');
                } else {
                    $request->session()->flash('error', 'Đã có lỗi xảy ra');
                    return redirect('admin/edit/'.$profileId);
                }
            }
        }
    }

}