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
{{-- <script src="dist/js/prefixfree.min.js"></script> --}}

</head>

<body>

  <div id="logo"> 
  <h1><i> STARK INDUSTRIES</i></h1>
</div> 
<section class="stark-login">

  <form action="{{'/login'}}" method="POST">	
    @csrf
    <div id="fade-box">
      
        <h2 style="color:#000">Đăng nhập</h2>
        <input type="text" name="username" id="username" placeholder="Username" required>
        <input type="password" placeholder="Password" required>

          <button>Log In</button> 
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