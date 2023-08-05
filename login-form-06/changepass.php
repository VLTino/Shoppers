<?php
require '../admins/functions.php';
$email = $_GET["email"];

if (isset($_POST["change"])) {
  if (changepass($_POST)) {
    echo "<script>
      alert('password berhasil diubah');
      window.location = 'index.php';

      </script>";
  } else {
    echo "<script>
      alert('password gagal diubah');
      window.location = 'index.php';
      </script>";
  }
}
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

  <title>Forgot Password</title>
</head>

<body>


  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('../images/men.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="mb-4">
              <h3>Change Password</h3>
              <p class="mb-4">Ganti Password Anda</p>
            </div>
            <form action="#" method="post">
              <div class="form-group first">
                <label for="username">Change Password</label>
                <input type="password" class="form-control" id="password1" name="password1"  required>
								<div class="password1-toggle-btn position-absolute" onclick="togglePassword1Visibility()" style="right: 10px; top: 50%; transform: translate(0, -50%);">
									<span class="password1-toggle-icon mr-3" id="password1-toggle-icon">
										<i class="fa fa-eye-slash"></i>
									</span>
								</div>

              </div>
              <div class="form-group first">
                <label for="pass2">Confirm Password</label>
                <input type="password" class="form-control" id="password2" name="password2"  required>
								<div class="password2-toggle-btn position-absolute" onclick="togglePassword2Visibility()" style="right: 10px; top: 50%; transform: translate(0, -50%);">
									<span class="password2-toggle-icon mr-3" id="password2-toggle-icon">
										<i class="fa fa-eye-slash"></i>
									</span>
								</div>

              </div>

<input type="hidden" name="email" id="" value="<?= $email ?>">
              <div class="d-flex mb-5 align-items-center">



                <!-- <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>  -->
              </div>

              <input type="submit" value="Change" class="btn btn-block btn-primary" name="change">





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
	function togglePassword1Visibility() {
		const passwordInput = document.getElementById('password1');
		const passwordToggleIcon = document.getElementById('password1-toggle-icon');

		if (passwordInput.type === 'password') {
			passwordInput.type = 'text';
			passwordToggleIcon.innerHTML = '<i class="fa fa-eye"></i>';
		} else {
			passwordInput.type = 'password';
			passwordToggleIcon.innerHTML = '<i class="fa fa-eye-slash"></i>';
		}
	}
</script>
  <script>
	function togglePassword2Visibility() {
		const passwordInput = document.getElementById('password2');
		const passwordToggleIcon = document.getElementById('password2-toggle-icon');

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