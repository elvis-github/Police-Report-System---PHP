<?php
    include '../partials/header.php';

    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }

    require_once '../connection/connection.php';
    
    // if(isset($_POST["submit"])){
    //     // SQL statement to insert into People Table
    //     $sql = "INSERT INTO people (People_name, People_address, People_licence)
    //     VALUES ('".$_POST["name"]."','".$_POST["address"]."','".$_POST["licence"]."')";
    //     if($pdo->query($sql)){
    //         unset($pdo);
    //         header("location: ../views/people.php");
    //         exit;
    //     }
    // }  
?>
    <div class="container">
        <div class="mt-3">
            <h1>Add New Fine</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> 
                <div class="form-group">
                    <label>Fine Amount</label>
                    <input type="text" name="amount" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Fine Points</label>
                    <input type="text" name="points" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Incident</label><a class="ml-1 badge badge-success" href="../new/incident.php">Add New Incident</a>
                    <select name="incident" class="d-block" required>
                        <option value="">Choose...</option>
                        <?php
                            $stmt = $pdo->query("SELECT Incident_ID, Incident_Date, Incident_Report, Offence_ID
                                                FROM incident");
                            while($row = $stmt->fetch()){
                                echo '<option value="' . $row->Incident_ID.'">(' . $row->Incident_Date . ') ' . $row->Incident_Report . 
                                ' (Offence ID #' . $row->Offence_ID . ')</option>';
                            }
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