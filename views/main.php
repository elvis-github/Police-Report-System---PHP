<?php
    include '../partials/header.php';
    session_start();

    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }
    require_once '../connection/connection.php';

    echo '<h1>Hello ' . $_SESSION["username"] . '!</h1>';
    unset($pdo);
?>

<?php
    include '../partials/footer.php'
?>