@extends('layouts.backend')

@section('title', 'Trang quản trị')

@section('content')
  <form class="file-upload">
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

        <!-- Social media detail -->
        <div class="row mb-5 gx-5">
            <div class="col-xxl-12 mb-12 mb-xxl-0">
                <div class="bg-secondary-soft px-4 py-5 rounded">
                    <div class="row g-3">
                        <h4 class="mb-4 mt-0">Danh sách dữ liệu</h4>
                    </div> <!-- Row END -->

                    <div class="container mb-4 mt-0">
                        <form class="frm_search" action="" method="GET">
                            <div class="row ">
                                <div class="col">
                                    {{-- <label class="form-label">Tìm kiếm theo từ khóa</label> --}}
                                    <input type="text" class="form-control" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '';?>" placeholder="Từ khóa tìm kiếm" >
                                </div>
                                <div class="col">
                                    {{-- <label class="form-label">.</label> --}}
                                    <input type="submit" class="btn btn-primary form-control" name="btnSearch" value="Tìm kiếm" style="width:100px">
                                </div>
                            </div>
                        </form>
                    </div> <!-- Row END -->



                    <div class="container mt-12">
                        <a href="/admin/add" class="btn btn-primary btn-md mb-4">Thêm mới</a>

                        <div class="table-responsive">
                            <table class="table table-bordered" style="width:2000px">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>STT</th>
                                    <th>Người dùng</th>
                                    <th style="width:300px">Tiêu đề</th>
                                    <th style="width:500px">Mô tả</th>
                                    <th>Slug</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($listProfiles))
                                    @foreach($listProfiles as $key => $row)
                                    <?php

                                    // echo '<pre>';
                                    // var_dump($listProfiles);
                                    // die('sdf2');
                                    $createdAt = date_create($row['created_at']);
                                    $updatedAt = date_create($row['updated_at']);
                                    $id = $row['profiles_id'];
                                    ?>
                                        <tr>
                                            <td class="text-center"><a href="{{ asset("admin/edit/$id") }}" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                              </svg></a></td>
                                            <td>{{ $key + 1  }}</td>
                                            <td>{{ $row['name'] }}</td>
                                            <td>{{ $row['title'] }}</td>
                                            <td>{{ substr($row['description'],0,255) }} </td>
                                            <td>{{ $row['slug'] }}</td>
                                            <td>{{ date_format($createdAt,"d/m/Y H:i:s"); }}</td>
                                            <td>{{ date_format($updatedAt,"d/m/Y H:i:s"); }}</td>
                                            <td>{{ $row['del_flag'] == 0 ? 'Hiển thị' : 'Đã xóa' }}</td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            </table>
                        </div>
                        </div>

                </div>
            </div>
        </div> <!-- Row END -->

    </form> <!-- Form END -->
@stop
