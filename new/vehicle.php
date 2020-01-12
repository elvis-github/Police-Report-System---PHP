<?php
    include '../partials/header.php';

    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }

    require_once '../connection/connection.php';
?>
    <div class="container">
        <div class="text-center mt-3">
            <h1>Add New Vehicle</h1>
            
            <a class="btn btn-sm btn-primary mt-2" href="main.php">Go Back To Main</a>
        </div>
    </div>


<?php
    include '../partials/footer.php'
?>