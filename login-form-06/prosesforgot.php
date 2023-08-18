<?php

require '../admins/functions.php';

global $conn;

$email = stripslashes($_POST["email"]);

// Cek apakah email sudah ada di database
$query = "SELECT * FROM `customer` WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 0) {
    echo "<script> 
            alert('Alamat email tidak ditemukan');window.location='forgotpass.php'
          </script>";
    exit; // Ganti return false menjadi exit untuk keluar dari script.
}

// Ambil data pengguna dari hasil query
$userData = mysqli_fetch_assoc($result);

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF; //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'valent14206@gmail.com'; //SMTP username
    $mail->Password = 'mykxuxigusujzooo'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('shoppers@gmail.com', 'Shoppers');
    $mail->addAddress($email, $userData["name"]); // Add a recipient using the fetched data from the query
    // $mail->addAddress('ellen@example.com'); //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz'); //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Ganti Password';
    $mail->Body = 'Hi! ' . $userData["name"] . ', ini adalah tautan untuk ganti password akun Anda.<br> <a href="http://p3.test/login-form-06/changepass.php?email=' . $email . '">Change Password</a>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if ($mail->send()) {
        echo "<script>alert('Email ganti password sudah terkirim lewat email');window.location='index.php'</script>";
    } else {
        echo "<script>alert('Gagal mengirim email ganti password');window.location='index.php'</script>";
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
