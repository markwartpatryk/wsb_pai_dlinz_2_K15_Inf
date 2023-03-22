<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/table.css">
    <title>Użytkownicy</title>
</head>
<body>
   <h4>Użytkownicy</h4> 
   
   <?php
   require_once "../scripts/connect.php";
   $sql = "SELECT cities.id, cities.city, states.state  FROM cities  
   inner join states on cities.state_id = states.id";
   $result = $conn->query($sql);
   echo <<< USERSTABLE
   <table>
   <tr>
       <th>Id</td>
       <th>Miasto</th>
       <th>Województwo</th>
       <th>Usun</th>
    </tr>
   USERSTABLE;

   if($result->num_rows > 0){
    while($city = $result->fetch_assoc()){
        echo <<< USERS
            <tr>
                <td>$city[id]</td>
                <td>$city[city]</td>
                <td>$city[state]</td>
                <td><a href="../scripts/delete_user/delete_users.php?deleteCity=$city[id]">Usun</a></td>
            </tr>
        USERS;
       }
   }else{
    echo <<< USERS
    <tr>
        <td colspan = '3'> Brak danych w tabeli</td>
        
    </tr>
    USERS;
   }
  
   echo "</table>";
   if ($_GET["deleted"] != 0){
        echo "<br>Usunieto miasto o id  $_GET[deleted]";
   }else{
        echo "<br>Nie usunieto miasta.";
   }
   ?>
   
</body>
</html>