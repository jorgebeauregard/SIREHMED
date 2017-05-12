<?php

require_once "../../database/DatabaseMySQL.php";
require_once "../../models/Procedures.php";
session_start();

$db = DatabaseMySQL::connect();

$procedure = new Procedures($db);

$patient_id = $_POST['patient_id'];
$cause = $_POST['cause'];
$procedure_type = $_POST['procedure_type'];
$observations = $_POST['observations'];
$doctor_id = $_POST['doctor_id'];
$date_realized = $_POST['date_realized'];

$procedure->save($patient_id, $cause, $procedure_type, $observations, $doctor_id, $date_realized);

header("location: dashboard.php");

?>