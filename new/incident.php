<?php
    include '../partials/header.php';

    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }

    require_once '../connection/connection.php';
    $vehicle = $person = $date = $statement = $offense = '';
    $editStatus = false;
    
    if(isset($_GET['edit'])){
        $editStatus = true;
        echo '<h1>Hi There</h1>';
        $id = $_GET['edit'];
        
        $stmt = $pdo->query("SELECT * FROM incident WHERE Incident_ID=$id");
        if($stmt->rowCount() == 1){
            $row = $stmt->fetch();
            print_r($row);
            $vehicle = $row->Vehicle_ID;
            $person = $row->People_ID;
            $date = $row->Incident_Date;
            $statement = $row->Incident_Report;
            $offense = $row->Offence_ID;
        } 
        
    }

    if(isset($_POST["submit"])){
        
        // SQL statement to insert into People Table
        $sql = "INSERT INTO 
                incident (Vehicle_ID, People_ID, Incident_Date, Incident_Report, Offence_ID)
                VALUES ('".$_POST["vehicle"]."',
                        '".$_POST["suspect"]."',
                        '".$_POST["date"]."',
                        '".$_POST["statement"]."',
                        '".$_POST["offense"]."')";
        if($pdo->query($sql)){
            unset($pdo);
            header("location: ../views/incidents.php");
            exit;
        }
    }
    
?>
    <div class="container">
        <div class="mt-3">
            <?php 
                ($editStatus ? $h1Msg = 'Edit Incident' : $h1Msg = 'Add New Incident');
                echo '<h1>'.$h1Msg.'</h1>';
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> 
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" required="required" class="form-control" value="<?php echo $date ?>">
                </div>
                <div class="form-group">
                    <label>Statement</label>
                    <input type="text" name="statement" required="required" class="form-control" value="<?php echo $statement ?>">
                </div>
                <div class="form-group">
                    <label>Vehicle</label><a class="ml-1 badge badge-success" href="../new/vehicle.php">Add New Vehicle</a>
                    <select name="vehicle" class="d-block w-25" required>
                        <option value="">Choose...</option>
                        <?php
                            $stmt = $pdo->query("SELECT Vehicle_ID, Vehicle_type, Vehicle_licence
                                                FROM vehicle");
                            while($row = $stmt->fetch()){
                                echo '<option value="' . $row->Vehicle_ID.'">' . $row->Vehicle_type . ' (' . $row->Vehicle_licence . ')</option>';
                            }
                        ?>   
                    </select>
                </div>
                <div class="form-group">
                    <label>Suspect</label><a class="ml-1 badge badge-success" href="../new/person.php">Add New Person</a>
                    <select name="suspect" class="d-block w-25" required>
                        <option value="">Choose...</option>
                        <?php
                            $stmt = $pdo->query("SELECT People_ID, People_name, People_licence
                                                FROM people");
                            while($row = $stmt->fetch()){
                                echo '<option value="' . $row->People_ID.'">' . $row->People_name . ' (' . $row->People_licence . ')</option>';
                            }
                        ?>   
                    </select>
                </div>
                <div class="form-group">
                    <label>Offense</label>
                    <select name="offense" class="d-block w-25" required>
                        <option value="">Choose...</option>
                        <?php
                            $stmt = $pdo->query("SELECT Offence_ID, Offence_description
                                                FROM offence");
                            while($row = $stmt->fetch()){
                                echo '<option value="' . $row->Offence_ID.'">' . $row->Offence_ID . '. ' . $row->Offence_description . '</option>';
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