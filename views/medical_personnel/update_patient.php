<?php

require_once "../../database/DatabaseMySQL.php";
require_once "../../models/Patient.php";
session_start();

$db = DatabaseMySQL::connect();

$user = new Patient($db);

$id = $_POST['id'];
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

$user->update($id,$name, $last_name, $age, $height, $weight, $gender, $blood_type, $birth_date, $emergency_name, $emergency_phone);

header("location: dashboard.php");

?>