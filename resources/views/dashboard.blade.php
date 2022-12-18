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
        <script src="{{ asset('js/dashboard.js') }}"></script>

    </head>

<body>

<div class="container">
<div class="row">
		<div class="col-12">
			<div class="navbar">
				@if (Auth::check())
					<h4>Xin chào: {{ Auth::user()->fullname}}</h4>
				@endif
				<a href="{{ asset('/logout') }}">Đăng xuất</a>
			</div>
			<div class="page_administrators">
				<a href="/admin"> >> Trang quản trị</a>
			</div>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @if (!empty($users))
                        @foreach ($users as $member)
                        {{-- <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button> --}}
                        <button data-user_id="{{$member['id']}}" class="member nav-link {{ isset($_GET['member']) && $member['id'] == $_GET['member']  ? 'active' : ''}}" id="nav-home{{$member['id'] }}-tab" data-bs-toggle="tab" data-bs-target="#nav-home{{$member['id'] }}" type="button" role="tab" aria-controls="nav-home{{$member['id'] }}" aria-selected="true">{{$member['fullname']}}</button>
                        @endforeach
                    @endif
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="container-fluid">
                    <div class="row" style="margin-top: 15px">
                        @if (!empty($dataProfiles))
                            @foreach ($dataProfiles as $profile)

                                    <div class="col-lg-6">
                                        <div class="box-flex">
                                            <div class="info-text">
                                                <h5> {{$profile['title']}} </h5>
                                                <p> {{$profile['description'] }}</p>
                                            </div>
                                            <div class="info-image">
                                                <?php
                                                    $images = URL::asset("/uploads/icon-upload-default.png");
                                                    if (!empty($profile["original_filename"])) {
                                                        $images = asset('profile_uploads/'.$profile["original_filename"]);
                                                    }
                                                ?>
                                                    <a href="#">
                                                        <img id="imgFileUpload" name="profile_pic" src="{{ $images }}" value=""
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="click to upload image"
                                                        class="profile_pic rspimg shadow-sm bg-white rounded"
                                                        data-toggle="tooltip" data-placement="top" title="Click To Upload image" style="width: 80%" height="80%">
                                                    </a>
                                            </div>
                                        </div>
                                    </div>


                            @endforeach
                        @endif
                    </div>
                </div>
              </div>

			<!-- Form START -->
			<form class="file-upload" style="display: none">
				<div class="row mb-5 gx-5">
					<!-- Contact detail -->
					<div class="col-xxl-8 mb-5 mb-xxl-0">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0">Contact detail</h4>
								<!-- First Name -->
								<div class="col-md-6">
									<label class="form-label">First Name *</label>
									<input type="text" class="form-control" placeholder="" aria-label="First name" value="Scaralet">
								</div>
								<!-- Last name -->
								<div class="col-md-6">
									<label class="form-label">Last Name *</label>
									<input type="text" class="form-control" placeholder="" aria-label="Last name" value="Doe">
								</div>
								<!-- Phone number -->
								<div class="col-md-6">
									<label class="form-label">Phone number *</label>
									<input type="text" class="form-control" placeholder="" aria-label="Phone number" value="(333) 000 555">
								</div>
								<!-- Mobile number -->
								<div class="col-md-6">
									<label class="form-label">Mobile number *</label>
									<input type="text" class="form-control" placeholder="" aria-label="Phone number" value="+91 9852 8855 252">
								</div>
								<!-- Email -->
								<div class="col-md-6">
									<label for="inputEmail4" class="form-label">Email *</label>
									<input type="email" class="form-control" id="inputEmail4" value="example@homerealty.com">
								</div>
								<!-- Skype -->
								<div class="col-md-6">
									<label class="form-label">Skype *</label>
									<input type="text" class="form-control" placeholder="" aria-label="Phone number" value="Scaralet D">
								</div>
							</div> <!-- Row END -->
						</div>
					</div>
					<!-- Upload profile -->
					<div class="col-xxl-4">
						<div class="bg-secondary-soft px-4 py-5 rounded">
							<div class="row g-3">
								<h4 class="mb-4 mt-0">Upload your profile photo</h4>
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


			</form> <!-- Form END -->
		</div>
	</div>
	</div>

</body>

</html>
