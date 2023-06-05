<?php require_once('auth.php') ?>
<?php require_once('vendor/autoload.php') ?>
<?php

  // Set the parameter values
  $client_id = '1020136124385-4ufvv79pge22e96j5c0fkijleqo567vh.apps.googleusercontent.com';
  $redirect_uri = 'http://localhost/auth/test.php';
  $scope = 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email';
  $response_type = 'code';

  // Build the authorization URL with the parameter values
  $authUrl = 'https://accounts.google.com/o/oauth2/v2/auth'
      . '?client_id=' . urlencode($client_id)
      . '&redirect_uri=' . urlencode($redirect_uri)
      . '&scope=' . urlencode($scope)
      . '&response_type=' . urlencode($response_type);

  // Initialize cURL session
  $ch = curl_init();

  // Set cURL options
  curl_setopt($ch, CURLOPT_URL, $authUrl);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // Execute the cURL request
  $response = curl_exec($ch);

  // Check for errors
  if (curl_errno($ch)) {
      $error = curl_error($ch);
      // Handle the error as needed
       echo "cURL Error: " . $error;
  }

  // Close the cURL resource
  curl_close($ch);

  // Handle the response
  if ($response) {
;
  } else {

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
                        <input type="email" name="email">
                    </div>
                    <div class="input-group">
                        <label>Password:</label>
                        <input type="password" name="password">
                    </div>
                    <div class="input-group">
                        <button type="submit" class="login-button">Login</button>
                    </div>
                    <div class="separator">
                        <span>or</span>
                    </div>
                </form>
                <div class="input-group">
                    <a style="text-decoration:none" href="<?php echo $authUrl?>">
                        <button class="google-button">
                            <i class="fa-brands fa-google"></i> Sign in with Google
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </body>

</html>