<?php
    include '../partials/header.php';

    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }

    require_once '../connection/connection.php';
    $nameVal = $nameErr= $addrVal = $licenceErr = '';

    if(isset($_POST["submit"])){
        $nameVal = $_POST["name"];
        $addrVal = $_POST["address"];

        if(!preg_match("/^[a-zA-z]*[ ][a-zA-z]+$/", $_POST["name"])){
            $nameErr = "Please enter a full name";
        }
        //Assign values for text inputs below
        

        //Check if licence is correct format
        $_POST["licence"] = strtoupper($_POST["licence"]);
        if(verifyLicence($_POST["licence"])){
            echo 'Verified Licence';

            // SQL statement to insert into People Table
            $sql = "INSERT INTO people (People_name, People_address, People_licence)
            VALUES ('".$_POST["name"]."','".$_POST["address"]."','".$_POST["licence"]."')";
            if($pdo->query($sql)){
                unset($pdo);
                header("location: ../views/people.php");
                exit;
            } 
        }
    }

    function verifyLicence($str){
        if(strlen($str) != 16){
            $GLOBALS['licenceErr'] = 'Licence length is incorrect. Must be 16 Characters in Length!'; // Length is incorrect
            return false;
        } else {
            $startIndex = strpos($_POST["name"], ' ') + 1;
            $endIndex = strlen($_POST["name"]);
            $substrEndIndex = $endIndex - $startIndex;
            if(substr($str, 0, $substrEndIndex) != strtoupper(substr($_POST["name"], $startIndex))){
                $GLOBALS['licenceErr'] = 'Licence format is incorrect. Must be last name followed by alphanumeric characters for a total length of 16'; // Licence format is incorrect'
            } else {
                return true;
            }
        }
    }
    
?>
    <div class="container">
        <div class="mt-3">
            <h1>Add New Person</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> 
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" required="required" class="form-control" value="<?php echo $nameVal ?>">
                    <span class="d-block text-danger"><?php echo $nameErr; ?></span>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" required="required" class="form-control" value="<?php echo $addrVal ?>">
                </div>
                <div class="form-group">
                    <label>Person's Licence</label>
                    <input type="text" name="licence" required="required" class="form-control">
                    <span class="d-block text-danger"><?php echo $licenceErr; ?></span>
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