<?php
    include '../partials/header.php';

    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }

    require_once '../connection/connection.php';
    $nameVal = $confirmPasswordErr = $newPasswordVal = $newPasswordErr = '';

    // if(isset($_POST["submit"])){
    //     $nameVal = $_POST["name"];
    //     $addrVal = $_POST["address"];
    //     $licenceVal = $_POST["licence"];

    //     // Check if officer has added a full name
    //     if(!preg_match("/^[a-zA-z]*[ ][a-zA-z]+$/", $_POST["name"])){
    //         $nameErr = "Please enter a full name";
    //     }

    //     // Check if address is correct format       
    //     if(!preg_match("/^[0-9]*[ ]{1}[a-zA-Z]*[ ]{1}[a-zA-z]*[,]{1}[ ]{1}[a-zA-Z]*$/", $_POST["address"])){
    //         $addrErr = "Incorrect address format. Please match the following format: StreetNumber StreetAdress, CityName. Example: 6774 Wandering Way, Norcross";
    //     }

    //     //Check if licence is correct format
    //     $_POST["licence"] = strtoupper($_POST["licence"]);
    //     if(verifyLicence($_POST["licence"])){
    //         echo 'Verified Licence';

    //         // SQL statement to insert into People Table
    //         $sql = "INSERT INTO people (People_name, People_address, People_licence)
    //         VALUES ('".$_POST["name"]."','".$_POST["address"]."','".$_POST["licence"]."')";
    //         if($pdo->query($sql)){
    //             unset($pdo);
    //             header("location: ../views/people.php");
    //             exit;
    //         } 
    //     }
    // }

    // function verifyLicence($str){
    //     if(strlen($str) != 16){
    //         $GLOBALS['licenceErr'] = 'Licence length is incorrect. Must be 16 Characters in Length!'; // Length is incorrect
    //         return false;
    //     } else {
    //         $startIndex = strpos($_POST["name"], ' ') + 1;
    //         $endIndex = strlen($_POST["name"]);
    //         $substrEndIndex = $endIndex - $startIndex;
    //         if(substr($str, 0, $substrEndIndex) != strtoupper(substr($_POST["name"], $startIndex))){
    //             $GLOBALS['licenceErr'] = 'Licence format is incorrect. Must be last name followed by alphanumeric characters for a total length of 16'; // Licence format is incorrect'
    //         } else {
    //             return true;
    //         }
    //     }
    // }
    
?>
    <div class="container">
        <div class="mt-3">
            <h1>Add New Officer</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> 
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required="required" class="form-control" value="<?php echo $nameVal ?>">
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="newPassword" class="form-control" value="<?php echo $newPasswordVal; ?>">
                    <span class="d-block text-danger"><?php echo $newPasswordErr; ?></span>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control">
                    <span class="d-block text-danger"><?php echo $confirmPasswordErr; ?></span>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="admin" class="form-control" value="true">
                    <label class="form-check-label">Admin Status</label>
                </div>
                <div class="form-group mt-2">
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    <a class="btn btn-link" href="../views/main.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>


<?php
    include '../partials/footer.php'
?>