<?php require_once('auth.php') ?>
<?php require_once('vendor/autoload.php') ?>
<?php


// Google API Client
$gclient = new Google_Client();

$gclient->setAuthConfig('config.json');
$gclient->setRedirectUri('http://localhost/auth/login.php');


$gclient->addScope('email');
$gclient->addScope('profile');

if(isset($_GET['code'])){

    $token = $gclient->fetchAccessTokenWithAuthCode($_GET['code']);

    if(!isset($token['error'])){

        $gclient->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        $gservice = new Google_Service_Oauth2($gclient);

        $udata = $gservice->userinfo->get();
        
        $_SESSION['userData'] = $udata;

        foreach($udata as $k => $v){
            $_SESSION['login_'.$k] = $v;
        }
        $_SESSION['ucode'] = $_GET['code'];

        header('location: ./');
        exit;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://kit.fontawesome.com/4e25ff9c4f.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Login</h2>
      <form>
        <div class="input-group">
          <label>Email:</label>
          <input type="email" name="email" required>
        </div>
        <div class="input-group">
          <label>Password:</label>
          <input type="password" name="password" required>
        </div>
        <div class="input-group">
          <button type="submit" class="login-button">Login</button>
        </div>
        <div class="separator">
          <span>or</span>
        </div>
        <div class="input-group">
        <a style="text-decoration: none;" href="<?= $gclient->createAuthUrl() ?>">
          <button type="button" class="google-button">  
            <i class="fa-brands fa-google"></i> Sign in with Google
          </button>
        </a>
         
        </div>
      </form>
    </div>
  </div>
</body>
</html>
