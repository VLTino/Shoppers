<?php 
session_start();
if(isset($_SESSION["login"])){
    header("Location: ../index.php");
    exit;
}

require '../admins/functions.php';

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
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

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
                <input type="password" class="form-control" id="password" name="password" required>
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
              
                 
                
                <!-- <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>  -->
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary" name="login">
              
              
              
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
  </body>
</html>