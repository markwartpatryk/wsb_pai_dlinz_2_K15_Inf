<?php
session_start();
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";
foreach ($_POST as $key => $value)
{
    if (empty($value)){
        $_SESSION["error"] = "Wypełnij wszystkie pola!";
        echo "<script>history.back()</script>";
        exit();
    }   
    
    if($_POST["email1"]!=$_POST["email2"]){
        $_SESSION["error"] = "Podane adresy email różnią się od siebie!";
        echo "<script>history.back()</script>";
        exit();
    }
//duplikacja adresu email

    if($_POST["password1"]!=$_POST["password2"]){
        $_SESSION["error"] = "Podane hasła różnią się od siebie!";
        echo "<script>history.back()</script>";
        exit();
    }
    

    
    if(!isset($_POST["terms"])){
        $_SESSION["error"] = "Zaakceptuj regulamin!";
        echo "<script>history.back()</script>";
        exit();
    }
}
require_once "./connect1.php";
$stmt = $conn->prepare("INSERT INTO `users` (`email`, `city_id`, `firstName`, `lastName`, `birthday`, `password`, `created_at`) VALUES ( ?, ?, ?, ?, ?, ?, current_timestamp());");
$pass = password_hash('$_POST["password1"]', PASSWORD_ARGON2ID);
//$stmt = $mysqli->prepare("INSERT INTO users VALUES()");
$stmt->bind_param('sissss', $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $pass);

$stmt->execute();
//echo $stmt->affected_rows;
if($conn->affected_rows == 1){
    
    $_SESSION["success"] = "Prawidłowo dodano użytownika  $_POST[firstName] $_POST[lastName]";
    
}else{
    
    $_SESSION["error"] = "Nie dodano użytkownika";
}

header("location: ../register.php");