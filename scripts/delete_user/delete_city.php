<?php
    require_once("../connect.php");
    $sql = "DELETE FROM `users` WHERE `users`.`id` = $_GET[deleteCity]";
    $conn->query($sql);
   // echo $conn->affected_rows;
   $deleted_city = 0;
   if ($conn->affected_rows != 0){
        //echo "Usunieto rekord";
        $deleted_city = $_GET['deleteCity'];
   }else{
        //echo "Nie usunieto rekordu";
        $deleted_city = 0;
   }
   header("location: ../../4_db/4_db.php?deleted_city=$deleted_city");
?>