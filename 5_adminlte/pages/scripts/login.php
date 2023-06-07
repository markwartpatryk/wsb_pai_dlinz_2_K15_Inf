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
   
    if(!empty($errors)){
        $error_msg = implode("<br>", $errors);
        header("location: ../index.php?error=".urlencode($error_msg));
        exit();
    }
    if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) != true){
        $error_msg ="Wprowadź poprawny adres email";
        header("location: ../index.php?error=".urlencode($error_msg));
        exit();
    }else
        echo "email: ".$_POST["email"].", hasło: ".$_POST["pass"];

require_once "./connect1.php";
$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s", $_POST["email"]);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows != 0){
    $user = $result->fetch_assoc();

    $user_id = $user["id"];
    $address_ip = $_SERVER["REMOTE_ADDR"];

    //print_r($user);
    if(password_verify($_POST["pass"], $user["password"])){
        $_SESSION["logged"]["firstName"] = $user["firstName"];
        $_SESSION["logged"]["lastName"] = $user["lastName"];
        $_SESSION["logged"]["role_id"] = $user["role_id"];
        $_SESSION["logged"]["session_id"] = session_id();

        //logi

        $stmt = $conn->prepare("INSERT INTO `logi` (`user_id`, `status`, `address_ip`) VALUES (?, '1', ?);");
        $stmt->bind_param("is", $user_id, $address_ip);
        $stmt->execute();
        
        //print_r($_SESSION["logged"]);
        header("location: ../logged.php");
        exit();
    }else{
        $_SESSION["error"] = "Błędny login lub hasło!";
        echo "<script>history.back();</script>";
        exit();
    
    }

}else{
    $_SESSION["error"] = "Błędny login lub hasło!";
    echo "<script>history.back();</script>";
    exit();
}
    
   
}else{
    header("location: ../index.php");
}
