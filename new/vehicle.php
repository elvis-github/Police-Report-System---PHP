<?php
    include '../partials/header.php';

    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }

    require_once '../connection/connection.php';
    if(isset($_POST["submit"])){
        if(isset($_POST["owner"])){
            echo '<h1>Owner Entered</h1>';
            $sql = "SELECT People_ID 
                    FROM people 
                    WHERE People_ID = " . $_POST["owner"];
        } else {
            $sql = "INSERT INTO vehicle (Vehicle_type, Vehicle_colour, Vehicle_licence)
            VALUES ('".$_POST["vehicleType"]."','".$_POST["color"]."','".$_POST["licence"]."')";
            if($pdo->query($sql)){
                unset($pdo);
                header("location: ../views/vehicles.php");
                exit;
            } else {
                echo '<h1>An error has occurred</h1>';
            }
        }
    }
    
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
                    <label>Owner</label><a class="ml-1 badge badge-success" href="../new/person.php">Add New Person</a>
                    <select class="d-block">
                        <option selected>Choose...</option>
                        <?php
                            $stmt = $pdo->query("SELECT People_ID, People_name, People_licence
                                                FROM people");
                            while($row = $stmt->fetch()){
                                echo '<option value="' . $row->People_ID.'">' . $row->People_name . ' (' . $row->People_licence . ')</option>';
                            }
                            unset($stmt);
                            unset($pdo);
                        ?>   
                    </select>

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