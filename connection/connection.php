<?php
    $host       = 'localhost:3307';
    $user       = 'root';
    $password   = '123456';
    $dbname     = 'police_report_system';
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

    try{
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (PDOException $e){
        echo '<p class="text-center">An error has occurred: <br>' . $e->getMessage() . '</p>';
        exit();
    }
?>