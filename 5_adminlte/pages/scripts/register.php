<?php

function sanitizeInput(&$input){
    $input = stripslashes($input);
    $input = htmlentities($input);
    $input = trim($input);
    return $input;
}


//echo $_POST["firstName"]." ==> " .sanitizeInput($_POST["firstName"]).",ilość znaków: " .strlen($_POST["firstName"]);


if($_SERVER["REQUEST_METHOD"]== "POST"){
    
    session_start();
    require_once "./connect1.php";
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $required_fields =["firstName", "lastName", "email1", "email2", "password1", "password2", "birthday", "city_id", "gender"];
    $errors = [];
    // foreach($required_fields as $key => $value){   
    //     echo "$key = $value<br>";
    // }
    
    foreach ($required_fields as $value)
    {
        if (empty($_POST[$value])){
            $errors[] = "Pole <b>$value</b> jest wymagane!";
        }
    }  

    if(!empty($errors)){
        $_SESSION["error"] = implode("<br>", $errors);
        echo "<script>history.back()</script>";
        exit();
    }

    if($_POST["email1"]!=$_POST["email2"]){
        $errors[] = "Podane adresy email różnią się od siebie!";
    }

    if($_POST["additional_email1"]!=$_POST["additional_email2"]){
        $errors[] = "Dodatkowe adresy email różnią się od siebie!";
    }else{
        if(empty($_POST["additional_email1"])){
            $_POST["additional_email1"] = NULL;
            
        }
    }

    if($_POST["password1"]!=$_POST["password2"]){
        $errors[] = "Podane hasła różnią się od siebie!";
    }else{
        if(!preg_match('/^(?=.*[a-z])(?=>*[A-Z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/', $_POST["password1"]) && !empty($_POST["password1"])){
            $errors[] = "Podane hasło nie spełnia wymagań!";
        }
    }

    if(!isset($_POST["gender"])){
        $errors[] ="Wybierz płeć";
    }
    
    if(!isset($_POST["terms"])){
        $errors[] = "Zatwierdź regulamin!";
    }

    if(!empty($errors)){
        $_SESSION["error"] = implode("<br>", $errors);
        echo "<script>history.back()</script>";
        exit();
    }

    //duplikacja adresu email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt -> bind_param("s",$_POST["email1"]);
    $stmt ->execute();
    $result =$stmt->get_result();
    if ($result->num_rows !=0) {
    $errors[] = "Adres email $_POST[email1] jest już zajęty";
    echo "<script>history.back();</script>";
    exit();
    }

    if ($_POST["gender"]=="w") {
        $gender = "woman";
        $avatar = "../img/woman.png";
    } else {
        $gender = "man";
        $avatar = "../img/man.png";
    }

    foreach($_POST as $key => $value){
        if(!$_POST["password1"] && !$_POST["password2"]){
            sanitizeInput($_POST["$key"]);
        }
    }

$stmt = $conn->prepare("INSERT INTO `users` (`email`, `additional_email`, `city_id`, `firstName`, `lastName`, `birthday`, `gender`, `avatar`, `password`, `created_at`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, current_timestamp());");
$pass = password_hash($_POST["password1"], PASSWORD_ARGON2ID);
//$stmt = $mysqli->prepare("INSERT INTO users VALUES()");
$stmt->bind_param('ssissssss', $_POST["email1"], $_POST["additional_email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $gender, $avatar, $pass);

$stmt->execute();
//echo $stmt->affected_rows;

if($conn->affected_rows == 1){
    
    $_SESSION["success"] = "Prawidłowo dodano użytownika  $_POST[firstName] $_POST[lastName]";
    header("location: ../index.php");
    exit();
    
}else{
    
    $errors[] = "Nie dodano użytkownika";
}

}

header("location: ../register.php");