<?php

ini_set('display_errors',1);

require_once "../../database/DatabaseMySQL.php";
require_once "../../models/Patient.php";

session_start();

$e=$_POST['email'];
$p=($_POST['password']);


$db = DatabaseMySQL::connect();
$user = new Patient($db);
$user->setEmail($e);
$usertype = $user->getLogInInfo();

    if(isset($_POST['email'])){
            $query = $db->prepare('SELECT * from users WHERE email = ? AND password = ?');
            $query->bindParam(1,$e,PDO::PARAM_STR);
            $query->bindParam(2,$p,PDO::PARAM_STR);
            $query->execute();

            $count = $query->rowCount();

            if($count > 0){
                $_SESSION['email'] = $_POST['email'];
                if($usertype->permit==0){
                    header("location:../student/index.php");
                }
                else if($usertype->permit==1){
                    header("location:../patient/dashboard.html");
                }
                else{
                    header("location:../admin/index.php");
                }
            }
            else{
                header('location:wrongcredentials.php'); 
            }       
    }
    else{
  
    }
?>