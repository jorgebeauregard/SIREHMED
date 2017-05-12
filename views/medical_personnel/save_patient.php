<?php

require_once "../../database/DatabaseMySQL.php";
require_once "../../models/Patient.php";
require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

session_start();

$db = DatabaseMySQL::connect();

$user = new Patient($db);


$email = $_POST['email'];
$password = $_POST['password'];
$name = $_POST['name'];
$last_name = $_POST['last_name'];
$age = $_POST['age'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$gender = $_POST['gender'];
$blood_type = $_POST['blood_type'];
$birth_date = $_POST['birth_date'];
$emergency_name = $_POST['emergency_name'];
$emergency_phone = $_POST['emergency_phone'];




$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'blurdischarger@gmail.com';
$mail->Password = 'gcjskvlhirsnlywe';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('blurdischarger@gmail.com', 'Your pwd is');
$mail->addAddress($email, $username);
$mail->addReplyTo('blurdischarger@gmail.com', 'Hola!');

$mail->Subject = 'your pwd is';
$mail->Body    = 'Your pwd is:'.$password;

if(!$mail->send()) {
	$_SESSION['error'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
} else {
	$_SESSION['success'] = 'A message has been sent to your email, please verify your account';
	header("Location:home.php");
}                    


$user->save($email, $password, 1, $name, $last_name, $age, $height, $weight, $gender, $blood_type, $birth_date, $emergency_name, $emergency_phone);

header("location: dashboard.php");

?>