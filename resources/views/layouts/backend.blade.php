<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Màn hình dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>Iron Man Login Form - CodePen</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
        <link rel="stylesheet"  href="{{ asset('/css/dashboard.css') }}">
		<link rel="stylesheet"  href="{{ asset('/css/style.css') }}">
		<script src="{{ asset('js/jquery361.min.js') }}"></script>
		@yield('javascript')
    </head>

<body>
<div class="container">
    <div class="row">
		<div class="navbar">
			@if (Auth::check())
				<h4>Xin chào: {{ Auth::user()->fullname}}</h4>
			@endif
			<a href="{{ asset('/logout') }}">Đăng xuất</a>
		</div>
		<div class="col-12">
            <div class="my-5">
				<h3><b>@yield('title')</b></h3>
			</div>
			

            @yield('content')

			<!-- Form START -->
			{{-- <form class="file-upload">
				<div class="row mb-5 gx-5">
					<!-- Contact detail -->
					<div class="col-xxl-8 mb-5 mb-xxl-0">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0">Nhập thông tin</h4>
								<!-- First Name -->
                                <div class="col-md-12">
									<label class="form-label">Lựa chọn Người dùng</label>
                                    <select class="form-control" style="width:200px">
                                        <option value="1">Tuấn tv</option>
                                        <option value="2">Điệp</option>
                                        <option value="2">Cam</option>
                                    </select>
								</div>
								<div class="col-md-12">
									<label class="form-label">Tiêu đề *</label>
									<input type="text" class="form-control" name="title" placeholder="" aria-label="First name" value="">
								</div>
								<!-- Last name -->
								<div class="col-md-12">
									<label class="form-label">Mô tả *</label>
									<textarea type="text" class="form-control" name="description" placeholder="" aria-label="Last name" value="Doe"> </textarea>
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
									<!-- Image upload -->
									<div class="square position-relative display-2 mb-3">
										<i class="fas fa-fw fa-user position-absolute top-50 start-50 translate-middle text-secondary"></i>
									</div>
									<!-- Button -->
									<input type="file" id="customFile" name="file" hidden="">
									<label class="btn btn-success-soft btn-block" for="customFile">Upload</label>
									<button type="button" class="btn btn-danger-soft">Remove</button>
									<!-- Content -->
									<p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Minimum size 300px x 300px</p>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- Row END -->

				<!-- Social media detail -->
				<div class="row mb-5 gx-5">
					<div class="col-xxl-12 mb-12 mb-xxl-0">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0">Danh sách dữ liệu</h4>
							</div> <!-- Row END -->

                            <div class="container mt-12">
                                <button type="button" class="btn btn-primary btn-lg">Thêm mới</button>
                                <p>The .table-responsive class adds a scrollbar to the table when needed:</p>
                                
                                <div class="table-responsive">
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th>#</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Age</th>
                                        <th>City</th>
                                        <th>Country</th>
                                        <th>Sex</th>
                                        <th>Example</th>
                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>1</td>
                                        <td>Anna</td>
                                        <td>Pitt</td>
                                        <td>35</td>
                                        <td>New York</td>
                                        <td>USA</td>
                                        <td>Female</td>
                                        <td>Yes</td>
                                    
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>

						</div>
					</div>

					
				</div> <!-- Row END -->
				<!-- button -->
				<div class="gap-3 d-md-flex justify-content-md-end text-center">
					<button type="button" class="btn btn-danger btn-lg">Delete profile</button>
					<button type="button" class="btn btn-primary btn-lg">Update profile</button>
				</div>
			</form> <!-- Form END --> --}}
		</div>
	</div>
</div>

</body>

</html>