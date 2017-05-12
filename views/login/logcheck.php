<?php

ini_set('display_errors',1);

require_once "../../database/DatabaseMySQL.php";

session_start();

$e=$_POST['email'];
$p=($_POST['password']);

echo($e);

$db = DatabaseMySQL::connect();
$user = new User($db);
$user->setEmail($e);
$usertype = $user->get();


$dbh = new DatabaseMySQL();

    if(isset($_POST['login'])){
            $query = $dbh->prepare('SELECT * from users WHERE email = ? AND password = ?');
            $query->bindParam(1,$e,PDO::PARAM_STR);
            $query->bindParam(2,$p,PDO::PARAM_STR);
            $query->execute();

            $count = $query->rowCount();
            $dbh->close();
            
            if($count > 0){
                $_SESSION['email'] = $_POST['email'];
                if($usertype->type==0){
                    header("location:../student/index.php");
                }
                else if($usertype->type==1){
                    header("location:../professor/index.php");
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