<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

require_once "./connect1.php";
$stmt = $conn->prepare("INSERT INTO `users` (`email`, `city_id`, `firstName`, `lastName`, `birthday`, `password`, `created_at`) VALUES ( ?, ?, ?, ?, ?, ?, current_timestamp());");
//$stmt = $mysqli->prepare("INSERT INTO users VALUES()");
$stmt->bind_param('sissss', $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $_POST["password1"],);
$stmt->execute();
echo $stmt->affected_rows;