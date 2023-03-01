<?php
    $firstname = "Janusz";
    $lastname = "Nowak";
    echo "Imię i nazwisko: $firstname  $lastname<br>";
    echo 'Imię i nazwisko: $firstname  $lastname<br>';

    
    echo <<< DATA
    <hr>
    Imię: $firstname<br>
    Nazwisko: $lastname
    <br>
    DATA;

    $data1 =  <<< DATA1
    <hr>
    Imię: $firstname<br>
    Nazwisko: $lastname
    <br>
    DATA1;

    echo $data1;

    $bin = 0b1010;
    echo $bin; //10
    echo "<br>";
    $oct = 0101;
    echo $oct; //65
    echo "<br>";
    $hex = 0x1A;
    echo $hex; //26
    echo "<br>";
    echo PHP_VERSION;
    echo "<br>";
    $x=1;
    $y=1.0;

    echo gettype($x);
    echo "<br>";
    echo gettype($y);
    echo "<br>";

    if ($x===$y) {
        echo "Identyczne";
    }else{
        echo "Różne";
    }
?>