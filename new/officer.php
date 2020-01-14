<?php
    include '../partials/header.php';

    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }

    require_once '../connection/connection.php';
    var_dump($pdo);
    $nameVal = $confirmPassword = $confirmPasswordErr = $newPassword = $newPasswordErr = '';

    if(isset($_POST["submit"])){
        $nameVal = $_POST["username"];
        (isset($_POST["admin"]) ? $admin = 1 : $admin = 0);
        // Validate new password
        if(empty(trim($_POST["newPassword"]))){
            $newPasswordErr = "Please enter the new password.";     
        } elseif(strlen(trim($_POST["newPassword"])) < 6){
            $newPasswordErr = "Password must have atleast 6 characters.";
        } else{
            $newPassword = trim($_POST["newPassword"]);
        }

        // Validate confirm password
        if(empty(trim($_POST["confirmPassword"]))){
            $confirmPasswordErr = "Please confirm the password.";
        } else{
            $confirmPassword = trim($_POST["confirmPassword"]);
            if(empty($newPasswordErr) && ($newPassword != $confirmPassword)){
                $confirmPasswordErr = "Password did not match.";
            }
        }
        // Check input errors before updating the database
        if(empty($newPasswordErr) && empty($confirmPasswordErr)){
            echo '<h1>No Errors</h1>';
            // Prepare an insert statement
            $sql = "INSERT INTO
                    officers(username, password, is_admin)
                    VALUES(?, ?, ?)";
            var_dump($sql);
            var_dump($pdo);
            if($stmt = $pdo->prepare($sql)){
                echo '<h1>Entered prepare</h1>';
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(1, $nameVal);
                $stmt->bindParam(2, $newPassword);
                $stmt->bindParam(3, $admin);
                                           
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // Account added successfully. Redirect to login page
                    header("location: ../views/main.php");
                    exit();
                } else{
                    echo "<h1>Oops! Something went wrong. Please try again later.</h1>";
                }
            } else {
                echo "<h1>Oops! Something went wrong preparing. Please try again later.</h1>";
            }
        
        // Close statement
        unset($stmt);
    }
    unset($pdo);
}
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
                    <input type="password" name="newPassword" class="form-control" value="<?php echo $newPassword; ?>">
                    <span class="d-block text-danger"><?php echo $newPasswordErr; ?></span>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control">
                    <span class="d-block text-danger"><?php echo $confirmPasswordErr; ?></span>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="admin" class="form-control" value="1">
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