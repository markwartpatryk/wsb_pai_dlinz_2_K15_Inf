<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dolaczanie</title>
</head>
<body>
    <h4>Początek strony</h4>
    <?php
        include "./scripts/lista.php";
        include_once "./scripts/lista.php";

        require "./scripts/lista.php";
        require_once "./scripts/lista.php";
    ?>
    <h4>Koniec strony</h4>
    
</body>
</html>