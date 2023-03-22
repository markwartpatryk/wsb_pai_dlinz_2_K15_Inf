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
   $sql = "SELECT users.id, users.firstName, users.lastName, users.birthday, cities.city, states.state, countries.country FROM users inner join cities on users.city_id = cities.id
   inner join states on cities.state_id = states.id
   inner join countries on states.country_id = countries.id";
   $result = $conn->query($sql);
   echo <<< USERSTABLE
   <table>
   <tr>
       <th>Imię</th>
       <th>Nazwisko</th>
       <th>Data_Urodzenia</th>
       <th>Miasto</th>
       <th>Województwo</th>
       <th>Państwo</th>
       <th>Usun</th>
    </tr>
   USERSTABLE;

   if($result->num_rows > 0){
    while($user = $result->fetch_assoc()){
        echo <<< USERS
            <tr>
                <td>$user[firstName]</td>
                <td>$user[lastName]</td>
                <td>$user[birthday]</td>
                <td>$user[city]</td>
                <td>$user[state]</td>
                <td>$user[country]</td>
                <td><a href="../scripts/delete_user/delete_users.php?deleteUserId=$user[id]">Usun</a></td>
            </tr>
        USERS;
       }
   }else{
    echo <<< USERS
    <tr>
        <td colspan = '7'> Brak danych w tabeli</td>
        
    </tr>
    USERS;
   }
  
   echo "</table>";
   if ($_GET["deleted"] != 0){
        echo "<br>Usunieto uzytkownika o id  $_GET[deleted]";
   }else{
        echo "<br>Nie usunieto uzytkownika.";
   }
   ?>
   
</body>
</html>