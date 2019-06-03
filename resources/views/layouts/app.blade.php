<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="{{url('manifest.json')}}">
    

    <!-- Page browser style -->
    <link rel="apple-touch-icon" sizes="57x57" href="assets/fav/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/fav/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/fav/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/fav/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/fav/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/fav/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/fav/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/fav/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/fav/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="assets/fav/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/fav/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/fav/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800" rel="stylesheet"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

<script>
        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
          console.log('statusChangeCallback');
          console.log(response);
          // The response object is returned with a status field that lets the
          // app know the current login status of the person.
          // Full docs on the response object can be found in the documentation
          // for FB.getLoginStatus().
          if (response.status === 'connected') {
            // Logged into your app and Facebook.
            testAPI();
          } else {
            // The person is not logged into your app or we are unable to tell.
            document.getElementById('status').innerHTML = 'Please log ' +
              'into this app.';
          }
        }
      
        // This function is called when someone finishes with the Login
        // Button.  See the onlogin handler attached to it in the sample
        // code below.
        function checkLoginState() {
          FB.getLoginStatus(function(response) {
            statusChangeCallback(response, {scope:'email, user_likes'});
          });
        }
      
        window.fbAsyncInit = function() {
          FB.init({
            appId      : '2163538977296328',
            cookie     : true,
            xfbml      : true,
            version    : 'v3.1'
          });
      
          // Now that we've initialized the JavaScript SDK, we call 
          // FB.getLoginStatus().  This function gets the state of the
          // person visiting this page and can return one of three states to
          // the callback you provide.  They can be:
          //
          // 1. Logged into your app ('connected')
          // 2. Logged into Facebook, but not your app ('not_authorized')
          // 3. Not logged into Facebook and can't tell if they are logged into
          //    your app or not.
          //
          // These three cases are handled in the callback function.
      
          FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
          });

      
        };
      
        // Load the SDK asynchronously
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "https://connect.facebook.net/da_DK/sdk.js";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      
        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
        function testAPI() {
          console.log('Welcome!  Fetching your information.... ');
          FB.api('/me', { locale: 'da_DK', fields: 'email,name,birthday,hometown,education,gender,website,work' }, function(response) {
            console.log('Successful login for: ' + response.name);
            console.log(response.email);
            console.log(response.birthday);
            console.log(response.hometown);
            console.log(response.gender);
            document.getElementById('status').innerHTML =
              'Thanks for logging in, ' + response.name + '!';
            document.getElementById('user').setAttribute('src', 'http://graph.facebook.com/' + response.id + '/picture?type=large'); 
          });
          
        }

      </script>
      
      <!--
        Below we include the Login Button social plugin. This button uses
        the JavaScript SDK to present a graphical Login button that triggers
        the FB.login() function when clicked.
      -->

</head>
<body>
    <div id="app">     
        <main class="pb-4">
            @include('inc.navbar')
               
  
            <div class="container">
                @include('inc.messages')
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>


<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button> 
<img id="user" src="" alt="">
<div id="status">
</div>