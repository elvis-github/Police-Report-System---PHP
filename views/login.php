<?php
    include '../partials/header.php';
    session_start();

    //Check if the officer is already logged in, if yes, then redirect him to incidents page
    if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true){
        header("location: incidents.php");
        exit;
    }

    require_once "../connection/connection.php";

    $username = $password = "";
    $usernameError = $passwordError = "";

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Check if the username is empty
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(empty(trim($_POST["username"]))){
                $usernameError = "Please enter a username";
            } else {
                $username = trim($_POST["username"]);
            }
        }

        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $passwordError = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }

        // Validation
        if(empty($usernameError) && empty($passwordError)){
            //Select Statement
            $sql = "SELECT officer_id, username, password FROM officers WHERE username = :username";
            if($stmt = $pdo->prepare($sql)){
                //Bind variables to the prepared statement as parameters
                $stmt->bindParam(":username", $paramUsername, PDO::PARAM_STR);
                
                // Set parameters
                $paramUsername = trim($_POST["username"]);

                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // CHeck if username exists, if yes, then verify the password
                    if($stmt->rowCount() == 1){
                        if($row = $stmt->fetch()){
                            $id = $row->officer_id;
                            $username = $row->username;
                            $dbPassword = $row->password;
                            if($dbPassword == $password){
                                session_start();

                                // Store data in session variables
                                $_SESSION["loggedIn"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;

                                // Redirect user to incidents page
                                header("location: incidents.php");
                            } else {
                                // Display an error message if password is not valid
                                $passwordError = "The password you entered was not valid.";
                            }
                        }
                    } else {
                        // Display an error message if username doesn't exist
                        $usernameError = "No account found with that username.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            unset($stmt);
        }
        unset($pdo);
    }
?>
<div class="container">
    <div class="text-center mt-3">
        <h1>Police Reporting System - Login</h1>
        <form class=mt-3 action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group <?php echo (!empty($usernameError)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
                <span class="d-block"><?php echo $usernameError; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($passwordError)) ? 'has-error' : ''; ?>">
                <input type="text" name="password" placeholder="Password">
                <span class="d-block"><?php echo $passwordError; ?></span>
            </div>
            <button type="submit" class="btn btn-outline-success mb-2">Submit</button>
            
        </form>
        <a href="../index.php">Back to Home</a>
    </div>
</div>
<?php
    include '../partials/footer.php'
?>