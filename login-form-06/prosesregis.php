<?php

require '../admins/functions.php';

global $conn;

$name = $_POST["name"];
$email = stripslashes($_POST["email"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]);
$password2 = mysqli_real_escape_string($conn, $_POST["password2"]);

// Cek apakah email sudah ada di database
$query = "SELECT * FROM `customer` WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<script> 
            alert('Alamat email sudah digunakan. Gunakan email lain.');window.location='register.php'
          </script>";
    return false;
}

//cek confirm password
if ($password !== $password2) {
    echo "<script> 
            alert('Konfirmasi password salah');window.location='register.php'
            </script>";
    return false;
}

$code = md5($email . date('Y-m-d H:i:s'));

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
    $mail->setFrom('tesaja@gmail.com', 'Shoppers');
    $mail->addAddress($email, $name); //Add a recipient
    // $mail->addAddress('ellen@example.com'); //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz'); //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Verifikasi akun Shoppers';
    $mail->Body = 'Hi!' . $name . ',terimaksih telah mendaftar.<br> <a href="http://p3.test/login-form-06/verifikasi.php?code='.$code.'">Silahkan verifikasi email Anda untuk login</a>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if ($mail->send()) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $conn->query("INSERT INTO `customer` VALUES (NULL,NULL,'$name','$email','$password',0,'$code',NULL)");
        echo "<script>alert('Registrasi Berhasil, silahkan cek email untuk verifikasi akun Anda');window.location='index.php'</script>";
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



?>