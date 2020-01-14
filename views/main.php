<?php
    session_start();
    include '../partials/header.php';
    

    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }

    if(!empty($_SESSION['message'])){
        $message = $_SESSION['message'];
        echo '<h2 id="message" class="text-center text-success mt-2">' . $message . '</h2>';
        unset($_SESSION['message']);
    }
?>

<div class="text-center container mt-3">
    <h1>Hello <?php echo $_SESSION["username"]; if($_SESSION["admin"]){echo ' (Administrator)';} ?></h1>
    <section class="btn-group-vertical mt-3">
        <div class="btn-group mb-3">
            <a class="btn btn-outline-primary" href="incidents.php">View Incidents</a>
            <a class="btn btn-outline-success" href="../new/incident.php">Add New Incident</a>
        </div>
        <div class="btn-group mb-3">
            <a class="btn btn-outline-primary" href="vehicles.php">View Vehicles</a>
            <a class="btn btn-outline-success" href="../new/vehicle.php">Add New Vehicle</a>
        </div>
        <div class="btn-group mb-3">
            <a class="btn btn-outline-primary" href="people.php">View People</a>
            <a class="btn btn-outline-success" href="../new/person.php">Add New Person</a>
        </div>
        <?php
            if($_SESSION["admin"]){
                echo '
                <div class="btn-group mb-3">
                    <a class="btn btn-outline-primary" href="../new/fine.php">Add Fines</a>
                    <a class="btn btn-outline-success" href="../new/officer.php">Create Officer</a>
                </div> ';
            }
        ?>
        <a class="btn btn-warning" href="../connection/password.php">Change Password</a>
        <a class="btn btn-danger mt-3" href="../connection/logout.php">Sign Out</a>
    </section>
</div>



<?php
    include '../partials/footer.php'
?>

<script>
    $("#message").delay(2000).fadeOut(3000);
</script>