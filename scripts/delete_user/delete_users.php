<?php
    require_once("../connect.php");
    $sql = "DELETE FROM `users` WHERE `users`.`id` = $_GET[deleteUserId]";
    $conn->query($sql);
   // echo $conn->affected_rows;
   $deleted = 0;
   if ($conn->affected_rows != 0){
        //echo "Usunieto rekord";
        $deleted = $_GET['deleteUserId'];
   }else{
        //echo "Nie usunieto rekordu";
        $deleted = 0;
   }
   header("location: ../../4_db/3_db_update.php?deleted=$deleted");
?>

