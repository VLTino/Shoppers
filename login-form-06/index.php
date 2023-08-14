<?php 
session_start();
if(isset($_SESSION["login"])){
    header("Location: ../index.php");
    exit;
}

require '../admins/functions.php';

require_once 'vendor/autoload.php';

// init configuration
$clientID = '726349655970-nliaoe7endndtv0m0kfthup1iv4qujgn.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/p3/login-form-06/index.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

if(isset($_POST["login"])){
  $email = $_POST ["email"];
  $password = $_POST ["password"];

  $result = mysqli_query($conn, "SELECT * FROM customer WHERE email = '$email'") ;

  // cek email
  if(mysqli_num_rows($result) === 1 ) {
      $row = mysqli_fetch_assoc($result);

      // cek apakah akun sudah diverifikasi (verifikasi == 1)
      if ($row["verifikasi"] == 1) {
          // cek password 
          if (password_verify($password, $row["password"])){
              // cek session
              $_SESSION["login"] = true ; 
              $_SESSION["email"] = $email; 
              $_SESSION["password"] = $password; 
              header("Location: ../index.php");
              exit;
          } else {
              // Password salah
              echo "<script> 
                      alert('Password salah')
                    </script>";
          }
      } else {
          // Akun belum diverifikasi
          echo "<script> 
                  alert('Akun belum diverifikasi')
                </script>";
      }
  } else {
      // Email tidak ditemukan
      echo "<script> 
              alert('Email tidak ditemukan')
            </script>";
  }
}else if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);

  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $userinfo = [
    'email' => $google_account_info['email'],
    'full_name' => $google_account_info['givenName'],
    'verifiedEmail' => $google_account_info['verifiedEmail'],
    'token' => $google_account_info['id'],
  ];

  $sql = "SELECT * FROM `customer` WHERE `email` = '{$userinfo['email']}'";
  $result = mysqli_query($conn,$sql);
  if (mysqli_num_rows($result) > 0) {
    $_SESSION["login"] = true ; 
    $_SESSION["email"] = $userinfo['email']; 
    $_SESSION["password"] = " "; 
    header("Location: ../index.php");
              exit;
  }else{
    $sql = "INSERT INTO `customer` VALUES (NULL,NULL,'{$userinfo['full_name']}','{$userinfo['email']}',' ','{$userinfo['verifiedEmail']}','{$userinfo['token']}',NULL)";
    $result = mysqli_query($conn,$sql);
    $_SESSION["login"] = true ; 
    $_SESSION["email"] = $userinfo['email']; 
    $_SESSION["password"] = " "; 
    header("Location: ../index.php");
              exit;

  }


  
} 
// else {
//   echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
// }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Login #6</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('../images/men.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="mb-4">
              <h3>Sign In</h3>
              <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
            </div>
            <form action="#" method="post">
              <div class="form-group first">
                <label for="username">Gmail</label>
                <input type="text" class="form-control" id="username" name="email" required>

              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"  required>
								<div class="password-toggle-btn position-absolute" onclick="togglePasswordVisibility()" style="right: 10px; top: 50%; transform: translate(0, -50%);">
									<span class="password-toggle-icon mr-3" id="password-toggle-icon">
										<i class="fa fa-eye-slash"></i>
									</span>
								</div>
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
              
                 
                
                <span class="ml-auto"><a href="forgotpass.php" class="forgot-pass">Forgot Password</a></span> 
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary" name="login">
              
              <span class="d-block text-center my-4 text-muted">— or —</span>
              
              <div class="social-login">
                <a href="<?= $client->createAuthUrl() ?>" class="google btn d-flex justify-content-center align-items-center">
                  <span class="icon-google mr-3"></span> Login with Google
                </a>
              </div>
              
              <input type="button" value="Register" class="btn btn-block btn-dark" onclick="window.location='register.php'">
              
            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
	function togglePasswordVisibility() {
		const passwordInput = document.getElementById('password');
		const passwordToggleIcon = document.getElementById('password-toggle-icon');

		if (passwordInput.type === 'password') {
			passwordInput.type = 'text';
			passwordToggleIcon.innerHTML = '<i class="fa fa-eye"></i>';
		} else {
			passwordInput.type = 'password';
			passwordToggleIcon.innerHTML = '<i class="fa fa-eye-slash"></i>';
		}
	}
</script>
  </body>
</html>