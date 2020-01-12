<?php
    session_start();
    include '../partials/header.php';
    

    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }
?>

<div class="text-center container mt-3">
    <h1>Hello <?php echo $_SESSION["username"]; ?></h1>
    <section class="btn-group-vertical mt-3">
        <div class="btn-group mb-3">
            <a class="btn btn-outline-primary" href="incidents.php">View Incidents</a>
            <a class="btn btn-outline-success">Add New Incident</a>
        </div>
        <div class="btn-group mb-3">
            <a class="btn btn-outline-primary">View Vehicles</a>
            <a class="btn btn-outline-success">Add New Vehicle</a>
        </div>
        <div class="btn-group mb-3">
            <a class="btn btn-outline-primary">View People</a>
            <a class="btn btn-outline-success">Add New Person</a>
        </div>
    </section>
</div>

<?php
    include '../partials/footer.php'
?>