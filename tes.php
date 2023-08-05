<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">


  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">
    <title>Show/Hide Password</title>
</head>
<body>
<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
								<div class="password-toggle-btn position-absolute" onclick="togglePasswordVisibility()" style="right: 10px; top: 50%; transform: translate(0, -50%);">
									<span class="password-toggle-icon mr-3" id="password-toggle-icon">
										<i class="fa fa-eye-slash"></i>
									</span>
								</div>
							
							</div>, 


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
