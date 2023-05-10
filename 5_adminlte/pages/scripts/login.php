<?php
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    $_SESSION["error"] = "";
   
   //print_r($_POST);
   foreach($_POST as $key => $value){
        if(empty($value)){
           $errors[] = "Pole <b>$key</b> musi być wypełnione!";
        }
   }
   $error_msg = implode("<br>", $errors);
    if(!empty($errors)){
        header("location: ../index.php?error=".urlencode($error_msg));
        exit();
    }
    if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) != true){
        $error_msg ="Wprowadź poprawny adres email";
        header("location: ../index.php?error=".urlencode($error_msg));
        exit();
    }else
        echo "email: ".$_POST["email"].", hasło: ".$_POST["pass"];
   
}else{
    header("location: ../index.php");
}
