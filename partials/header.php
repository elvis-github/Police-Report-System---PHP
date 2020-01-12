<?php
    require_once  $_SERVER['DOCUMENT_ROOT'] . '/connection/connection.php';
    $fileName = basename($_SERVER["SCRIPT_FILENAME"], '.php');
    if($fileName != 'index' && $fileName != 'main' && $fileName !='password'){
        session_start();
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Police Report System</title>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand mr-auto" href="../index.php">Police Reporting System</a>
    <div id="navItems ml-auto">
        <ul class="navbar-nav ">
            <?php
                if(isset($_SESSION["loggedIn"])){
                    echo '
                        <li class="nav-item">
                            <span class="navbar-text text-light">Hello ' . $_SESSION["username"] . '</span>
                        </li>
            
                        <li class="nav-item">
                            <a class="nav-link" href="../connection/logout.php">Sign Out</a>
                        </li>';
                }
            ?>
        </ul>
    </div>
</nav>




