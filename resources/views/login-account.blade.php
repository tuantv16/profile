<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - revised login form</title>
  <link rel="stylesheet" href="./dist/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Iron Man Login Form - CodePen</title>
  <style>
    .stark-login form {
        height: 260px;
    }

    .error{
        list-style: none !important;
        color: red !important;
        display: flex;
        margin-left: 10px;
        margin-top: 5px;
        font-size: 14px;
        font-style: italic;
        justify-content:center
    }
</style>

</head>

<body>

  <div id="logo"> 
  <h1><i> STARK INDUSTRIES</i></h1>
</div> 
<section class="stark-login">

  <form action="{{'/login'}}" method="POST">	
    @csrf
    @if ( Session::has('error') )
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong class="error">{{ Session::get('error') }}</strong>
    </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="fade-box">
        <input type="text" name="name" id="name" placeholder="Tên đăng nhập">
        <input type="password" name="password" placeholder="Mật khẩu">

          <button>Đăng nhập</button> 
        </div>
      </form>
      <div class="hexagons">
        
                 <img src="http://i34.photobucket.com/albums/d133/RavenLionheart/NX-Desktop-BG.png" height="768px" width="1366px"/> 
              </div>      
            </section> 

            <div id="circle1">
              <div id="inner-cirlce1">
                <h2> </h2>
              </div>
            </div>

            <ul>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
            </ul>

  <!-- <script src='https://codepen.io/assets/libs/fullpage/jquery.js'></script> -->
  <script src="{{ asset('js/jquery361.min.js') }}"></script>
  {{-- <script src="js/dist/index.js"></script> --}}
  <script  src="{{ asset('./dist/script.js') }}"></script>
</body>

</html>