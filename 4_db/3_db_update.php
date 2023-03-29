<?php
    session_start();
?>
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
   
   if(isset($_SESSION["error"])){
        echo $_SESSION["error"];
        unset($_SESSION["error"]);
   }
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
                <td><a href="./3_db_update.php?updteUserId=$user[id]">Edytuj</a></td>
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
   if(isset($_GET["deleted"])){
        if ($_GET["deleted"] != 0){
                echo "<br>Usunieto uzytkownika o id  $_GET[deleted]";
                echo "<br";
        }else{
                echo "<br>Nie usunieto uzytkownika.";
                echo "<br>";
        }
    }
   if (isset($_GET["addUserForm"])){
    echo <<< ADDUSERFORM
        <h4><h4>Dodawanie użytkownika</h4>
        <form action="../scripts/add_user.php" method="post">
            Imię:<br>
            <input type="text" name="firstName" placeholder="Podaj imię" autofocus><br><br>
            Nazwisko:<br>
            <input type="text" name="lastName" placeholder="Podaj nazwisko"><br><br>
            Miasto:<br>
            <select name = "city_id">
        ADDUSERFORM;
            $sql = "SELECT * from cities";
            $result = $conn->query($sql);
            while($city = $result->fetch_assoc()){
                echo <<< CITY
                    <option value="$city[id]"> $city[city]</option>    
                CITY;
            }
        echo <<< ADDUSERFORM
            </select>
            <br>
            <br>
            <input type="date" name="birthday"> Data urodzenia<br><br>
            <br>
            <input type="submit" value="Dodaj użytkownika">
            </form>

        ADDUSERFORM;
   }else{
    echo "<br>";
    echo "<br>";
    echo'<a href="./3_db_update.php?addUserForm=1">Dodaj użytkownika</a>';
   }

   if (isset($_GET["updateUserId"])){
        echo <<< UPDATEUSER
            <h4>Aktualizacja użytkownika</h4>
        UPDATEUSER;
   }
   ?>
   
   
</body>
</html>