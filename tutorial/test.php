<?php
    $dsn = "mysql:host=localhost;dbname=somecooldb";
    $username = "root";
    $password = "123456";

    try{
        $db = new PDO($dsn, $username, $password);
        echo "You have connected!";
    }catch(PDOException $e){
        $errorMessage = $e->getMessage();
        echo $errorMessage;
        exit();
    }

    $stmt = $db->query("SELECT * FROM people");
    while($row = $stmt->fetch()){
        echo $row['name']."<br />\n";
    }
?>