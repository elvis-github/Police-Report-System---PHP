<?php
    $host       = 'localhost:3307';
    $user       = 'root';
    $password   = '123456';
    $dbname     = 'police_report_system';

    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    $stmt = $pdo->query('SELECT * FROM incident');
    while($row = $stmt->fetch()){
        // var_dump($row);
        echo $row->Incident_Report . '<br>';
    }
?>