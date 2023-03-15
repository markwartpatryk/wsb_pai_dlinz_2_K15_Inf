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
   $sql = "SELECT * FROM users inner join cities on users.city_id = cities.id";
   $result = $conn->query($sql);
   echo <<< USERSTABLE
   <table>
   <tr>
       <th>Imię</th>
       <th>Nazwisko</th>
       <th>Data_Urodzenia</th>
       <th>Miasto</th>
    </tr>
   USERSTABLE;
   while($user = $result->fetch_assoc()){
    echo <<< USERS
        <tr>
            <td>$user[firstName]</td>
            <td>$user[lastName]</td>
            <td>$user[birthday]</td>
            <td>$user[city]</td>
        </tr>
    USERS;
   }
   echo "</table>"
   ?>
</body>
</html>