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
            <button class="btn btn-outline-primary">View Incidents</button>
            <button class="btn btn-outline-success">Add New Incident</button>
        </div>
        <div class="btn-group mb-3">
            <button class="btn btn-outline-primary">View Vehicles</button>
            <button class="btn btn-outline-success">Add New Vehicle</button>
        </div>
        <div class="btn-group mb-3">
            <button class="btn btn-outline-primary">View People</button>
            <button class="btn btn-outline-success">Add New Person</button>
        </div>
    </section>
</div>

<?php
    include '../partials/footer.php'
?>