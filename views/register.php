<?php
    include '../partials/header.php';
    include '../connection/connection.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        } else {
            $sql = "SELECT Officer_ID
                    FROM officers
                    WHERE username = :username";
            if($stmt = $pdo->prepare($sql)){
                $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                $param_username = trim($_POST["username"]);
                if($stmt->execute()){
                    if($stmt->rowCount() == 1){
                        $username_err = "This username is already taken.";
                    } else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "OOPS! Something went wrong. Please try again later.";
                }
                unset($stmt);
            }
        }
    }
?>
<div class="container">
    <div class="text-center mt-3">
        <h1>Police Reporting System - Register</h1>
        <form class=mt-3 action="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="text" name="firstName" placeholder="First Name">
            </div>
            <div class="form-group">
                <input type="text" name="lastName" placeholder="Last Name">
            </div>
            <div class="form-group">
                <input type="text" name="auth" placeholder="Auth Code">
            </div>
            <button class="btn btn-outline-success mb-2">Submit</button>
        </form>
        <a href="../index.php">Back to Home</a>
    </div>
</div>
<?php
    include '../partials/footer.php'
?>