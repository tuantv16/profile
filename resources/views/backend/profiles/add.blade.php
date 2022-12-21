@extends('layouts.backend')

@section('title', 'Thêm dữ liệu')

@section('javascript')
    <script src="{{ asset('js/profiles/add.js') }}"></script>
@stop

@section('sidebar')
    @@parent

    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    <form class="file-upload" action="" method="POST" enctype="multipart/form-data">
        @if ( Session::has('success') )
            <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            </div>
        @endif

        @if ( Session::has('error') )
    	<div class="alert alert-danger alert-dismissible" role="alert">
    		<strong>{{ Session::get('error') }}</strong>
    	</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @csrf
        <div class="row mb-5 gx-5">
            <!-- Contact detail -->
            <div class="col-xxl-8 mb-5 mb-xxl-0">
                <div class="bg-secondary-soft px-4 py-5 rounded">
                    <div class="row g-3">
                        <h4 class="mb-4 mt-0">Nhập thông tin</h4>
                        <!-- First Name -->
                        <div class="col-md-12">
                            <label class="form-label">Lựa chọn Người dùng</label>
                            <select class="form-control" name="user_id" style="width:200px">
                                @if (!empty($users))
                                    @foreach($users as $row)
                                        <option value="{{ $row['id']}}">{{ $row['fullname']}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Tiêu đề *</label>
                            <input type="text" class="form-control" name="title" placeholder="" aria-label="First name" value="" required>
                        </div>
                        <!-- Last name -->
                        <div class="col-md-12">
                            <label class="form-label">Mô tả *</label>
                            <textarea type="text" class="form-control" name="description" placeholder="" aria-label="Last name" value="Doe" required> </textarea>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" name="slug" placeholder="" aria-label="First name" value="">
                        </div>

                        <div class="col-md-12">
                            <input type="checkbox" id="security" name="security" value="1">
                            <label for="security"> Bảo mật</label><br>
                        </div>
                    </div> <!-- Row END -->
                </div>
            </div>
            <!-- Upload profile -->
            <div class="col-xxl-4">
                <div class="bg-secondary-soft px-4 py-5 rounded">
                    <div class="row g-3">
                        <h4 class="mb-4 mt-0">Upload hình ảnh đính kèm</h4>
                        <div class="text-center">
                            <input type="hidden" id="image_default" value="{{ URL::asset("/uploads/icon-upload-default.png") }}" />
                            <!-- Image upload -->
                            <div class="square position-relative display-2 mb-3">
                                <a href="#">
                                    <img id="imgFileUpload" name="profile_pic" src="{{URL::asset("/uploads/icon-upload-default.png")}}" value=""
                                     data-toggle="tooltip" data-placement="top"
                                     title="click to upload image"
                                     class="profile_pic rspimg shadow-sm bg-white rounded"
                                     data-toggle="tooltip" data-placement="top" title="Click To Upload image" style="width: 100%" height="100%">
                                </a>
                            </div>
                            <!-- Button -->
                            <label class="btn btn-success-soft btn-block" for="profileImage">Upload</label>
                            <input type="file" class="" name="profile_image" id="profileImage" hidden/> <!--   -->

                            <button type="button" class="btn btn-danger-soft" id="removeImage">Remove</button>
                            <!-- Content -->
                            <p class="text-muted mt-3 mb-0"><span class="me-1">Lưu ý:</span>Kích cỡ tối đa 2048KB ~ 2MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-md-flex text-center">
                <button type="submit" class="btn btn-primary btn-md">Lưu thông tin</button>
            </div>
        </div> <!-- Row END -->


    </form>
@stop
