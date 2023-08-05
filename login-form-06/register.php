

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
              <h3>Register</h3>
              <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
            </div>
            <form action="prosesregis.php" method="post">
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="name">

              </div>
              <div class="form-group first">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">

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
              <div class="form-group last mb-3">
                <label for="password">Confirm Password</label>
                <input type="password" class="form-control" id="password2" name="password2"  required>
								<div class="password2-toggle-btn position-absolute" onclick="togglePassword2Visibility()" style="right: 10px; top: 50%; transform: translate(0, -50%);">
									<span class="password2-toggle-icon mr-3" id="password2-toggle-icon">
										<i class="fa fa-eye-slash"></i>
									</span>
								</div>
                
              </div>
              

              
              
              <input type="submit" value="Register" class="btn btn-block btn-primary" name="registercustomer">
              <input type="button" value="Back" class="btn btn-block btn-danger" onclick="window.location='index.php'">
              
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
<script>
  function togglePassword2Visibility() {
		const password2Input = document.getElementById('password2');
		const password2ToggleIcon = document.getElementById('password2-toggle-icon');

		if (password2Input.type === 'password') {
			password2Input.type = 'text';
			password2ToggleIcon.innerHTML = '<i class="fa fa-eye"></i>';
		} else {
			password2Input.type = 'password';
			password2ToggleIcon.innerHTML = '<i class="fa fa-eye-slash"></i>';
		}
	}
</script>
  </body>
</html>