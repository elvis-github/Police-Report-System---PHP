<?php
    include '../partials/header.php';

    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }

    require_once '../connection/connection.php';
    if(isset($_POST["submit"])){
        $sql = "INSERT INTO vehicle (Vehicle_type, Vehicle_colour, Vehicle_licence)
        VALUES ('".$_POST["vehicleType"]."','".$_POST["color"]."','".$_POST["licence"]."')";
        if($pdo->query($sql)){
            echo '<h1>Inserted Successfully</h1>';
            unset($pdo);
            header("location: ../views/vehicles.php");
            exit;
        } else {
            echo '<h1>An error has occurred</h1>';
        }
    }
    unset($pdo);
?>
    <div class="container">
        <div class="mt-3">
            <h1>Add New Vehicle</h1>
            <form action="" method="POST"> 
                <div class="form-group">
                    <label>Make & Model</label>
                    <input type="text" name="vehicleType" required="required" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label>Colour</label>
                    <input type="text" name="color" required="required" class="form-control">
                </div>
                <div class="form-group">
                    <label>Licence</label>
                    <input type="text" name="licence" required="required" class="form-control">
                </div>
                <div class="form-group">
                    <label>Owner</label>
                    <input type="text" name="owner" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    <a class="btn btn-link" href="../views/main.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>


<?php
    include '../partials/footer.php'
?>