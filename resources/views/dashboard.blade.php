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

		<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

        <script src="{{ asset('js/dashboard.js') }}"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
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
			<?php if (Auth::user()->id == 1) { ?>
				<div class="page_administrators">
					<a href="/admin"> >> Trang quản trị</a>
				</div>
			<?php } ?>

			<div class="container mb-4 mt-0">
				<form class="frm_dashboard" action="" method="GET">
					<input type="hidden" name="member" value="<?php echo isset($_GET['member']) ? $_GET['member'] : '';?>"/>
					<div class="row ">
						<div class="col-3" style="margin-bottom:15px">
							 <label class="form-label">Tìm kiếm theo tiêu đề</label>
							<select class="form-select" name="profile_id" id="list_titles" data-placeholder="Tìm kiếm theo tiêu đề">
                                <?php
								$profileId = !empty($_GET['profile_id']) ? $_GET['profile_id'] : '';
                                if (!empty($listTitles)) :
									echo '<option></option>';
                                    foreach ($listTitles as $item) :?>
                                        <option value="<?php echo $item['id']; ?>" <?php echo $profileId == $item['id'] ? 'selected' : ''; ?>><?php echo $item['title'];?></option>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
						</div>	
					</div>

					<div class="row ">
						<div class="col">
							<label class="form-label">Tìm kiếm theo từ khóa</label>
							<input type="text" class="form-control" name="keysearch" value="<?php echo isset($_GET['keysearch']) ? $_GET['keysearch'] : '';?>" placeholder="Từ khóa tìm kiếm" >
						</div>
						<div class="col">
							<label class="form-label" style="color: white">.</label>
							<input type="submit" class="btn btn-primary form-control" id="btnFilter" value="Tìm kiếm" style="width:100px">
						</div>
					</div>
				</form>
			</div> <!-- Row END -->

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
               
                  
                        @if (!empty($dataProfiles))
						<div class="wrap-layout box-item">
                            @foreach ($dataProfiles as $profile)	
								 <div class="wrap-layout__item">
									<div class="info-text">
										<div class="box-proccess">
											<a href="javascript:void(0)" class="status_icon show_info d-none">
												<span class="material-symbols-outlined">
												lock
												</span>
											</a>
											<a href="javascript:void(0)" class="status_icon hide_info">
												<span class="material-symbols-outlined">
													visibility
													</span>
											</a>
										</div>
										<h5> {{$profile['title']}}  <span style="font-size: 13px">- ID: {{$profile['profiles_id']}}</span></h5>
										<div class="description"> *********** </div>
										<div class="description_hidden" style="display: none">
											<div class="content_hidden">
											<?php 
												if (strlen($profile['description']) > 225) {
													echo substr($profile['description'], 0, 225). '...';
												} else {
													$arrDescriptions = explode("\n",$profile['description']);
													echo '<ul>';
													foreach($arrDescriptions as $str) {
														echo '<li>'.$str.'</li>';
													}
													echo '</ul>';
												}
												?>
											</div>
										</div>
										<span style="display: none" class="show-full-text">{{ $profile['description'] }}</span>
									</div>
									<div class="info-image">
										<?php
											$images = URL::asset("/uploads/icon-upload-default.png");
											if (!empty($profile["original_filename"])) {
												$images = asset('profile_uploads/'.$profile["original_filename"]);
											}
										?>
											<a href="#" class="image-detail">
												<img id="imgFileUpload" name="profile_pic" src="{{ $images }}" value=""
												data-toggle="tooltip" data-placement="top"
												title="click to upload image"
												class="profile_pic rspimg shadow-sm bg-white rounded"
												data-toggle="tooltip" data-placement="top" title="Click To Upload image" style="width: 100%" height="120px">
											</a>
									</div>
								 </div>
                                   
                            @endforeach
						</div>
                        @endif
                   
               
              </div>

			  <button id="modalImage" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewImage" style="display: none">
				Open modal
			  </button>
			  <div class="modal" id="viewImage">
				<div class="modal-dialog modal-xl">
				  <div class="modal-content">
					<!-- Modal body -->
					<div class="modal-body">
					  <img id="imgPopup" style="width:100%" src="https://iaslinks.org/wp-content/uploads/2021/11/vai-tro-cua-thien-nhien.jpg" />
					</div>
			  
			  
				  </div>
				</div>
			  </div>
		</div>
	</div>
	</div>

	
</body>

</html>

<script>
	
		// const titles = <?php echo $listTitlesEncode ?>;

		// $('.list_titles').select2( {
		// 	theme: 'bootstrap-5'
		// });

		// $('.list_titles').select2({
		// 	data: titles
		// });

		// $('#list_titles' ).select2( {
		// 	theme: "bootstrap-5",
		// 	width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
		// 	placeholder: $( this ).data( 'placeholder' ),
		// 	allowClear: true
		// });

		$( '#list_titles' ).select2( {
			theme: "bootstrap-5",
			width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
			//placeholder: $( this ).data( 'placeholder' ),
		} );
	
</script>
