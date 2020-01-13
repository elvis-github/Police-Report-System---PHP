<?php
    include '../partials/header.php';

    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }

    require_once '../connection/connection.php';
    $licenceErr = '';
    
    if(isset($_POST["submit"])){
        //Check if licence is correct format
        $_POST["licence"] = strtoupper($_POST["licence"]);
        if(verifyLicence($_POST["licence"])){
            // SQL statement to insert into Vehicle Table
            $sql = "INSERT INTO vehicle (Vehicle_type, Vehicle_colour, Vehicle_licence)
            VALUES ('".$_POST["vehicleType"]."','".$_POST["color"]."','".$_POST["licence"]."')";
            if($pdo->query($sql)){
                // Once inserted, check if owner was set
                if(isset($_POST["owner"])){
                    // If Owner is set, add Owner and Vehicle ID to Ownership table
                    echo '<h1>Owner Entered '. $_POST["owner"] . '</h1>';
                    
                    // Retrieve vehicle ID from added Vehicle
                    $sql = 'SELECT Vehicle_ID from vehicle WHERE Vehicle_licence = :licence';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':licence', $paramLicence, PDO::PARAM_STR);
                    $paramLicence = ($_POST["licence"]);
                    $stmt->execute();
                    $row = $stmt->fetch();

                    // Set vehicle ID as a variable
                    $vehicleID = $row->Vehicle_ID;
                    unset($stmt);

                    // Insert People ID and Vehicle ID to Ownership table
                    $sql = "INSERT INTO ownership (People_ID, Vehicle_ID)
                    VALUES ('".$_POST["owner"]."','".$vehicleID."')";
                    $pdo->query($sql);
                    
                }
                unset($pdo);
                header("location: ../views/vehicles.php");
                exit;
            } 
        }
    }

    function verifyLicence($str){
        if(preg_match('/^[A-Z]{2}[0-9]{2}[A-Z]{3}$/', $str)){
            $licenceErr = '';
            return true;
        } else {
            if(strlen($str) != 7){
               $GLOBALS['licenceErr'] = 'Licence length is incorrect. Must be 7 Characters in Length!'; // Length is incorrect
               return false;
            } else { 
                $GLOBALS['licenceErr'] = 'Licence format is incorrect. Must be 2 Alpha characters, 2 Numbers, and 3 Alpha Characters.'; // Licence format is incorrect
                return false;
            }
        }
    }
    
?>
    <div class="container">
        <div class="mt-3">
            <h1>Add New Vehicle</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> 
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
                    <span class="d-block text-danger"><?php echo $licenceErr; ?></span>
                </div>
                <div class="form-group">
                    <label>Owner</label><a class="ml-1 badge badge-success" href="../new/person.php">Add New Person</a>
                    <select name="owner" class="d-block">
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