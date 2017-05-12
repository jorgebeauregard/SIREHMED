<?php

require_once "../../database/DatabaseMySQL.php";
require_once "../../models/Procedures.php";
session_start();

$db = DatabaseMySQL::connect();

$procedure = new Procedures($db);


$procedure_id = $_POST['procedure_id'];
$cause = $_POST['cause'];
$procedure_type = $_POST['procedure_type'];
$observations = $_POST['observations'];
$date_realized = $_POST['date_realized'];

$procedure->update($procedure_id, $cause, $procedure_type, $observations, $date_realized);

header("location: dashboard.php");

?>