<?php
include '../partials/header.php';
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true){
    header("location: ../views/main.php");
    exit;
}
 
// Include config file
require_once "../connection/connection.php";
 
// Define variables and initialize with empty values
$newPassword = $confirmPassword = "";
$newPasswordErr = $confirmPasswordErr = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
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
        // Prepare an update statement
        $sql = "UPDATE officers SET password = :password WHERE officer_id = :id";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
            
            // Set parameters
            $param_password = $newPassword;
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: ../index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>
 

    <div class="container mt-3">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($newPasswordErr)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="newPassword" class="form-control" value="<?php echo $newPassword; ?>">
                <span class="d-block text-danger"><?php echo $newPasswordErr; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirmPasswordErr)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirmPassword" class="form-control">
                <span class="d-block text-danger"><?php echo $confirmPasswordErr; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="../views/main.php">Cancel</a>
            </div>
        </form>
    </div>    

<?php
    include '../partials/footer.php';
?>