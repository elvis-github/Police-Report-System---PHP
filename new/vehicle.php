<?php
    include '../partials/header.php';

    if(!isset($_SESSION["loggedIn"])){
        header("location: ../index.php");
        exit;
    }

    require_once '../connection/connection.php';
?>
    <div class="container">
        <div class="mt-3">
            <h1>Add New Vehicle</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> 
                <div class="form-group">
                    <label>Make & Model</label>
                    <input type="text" name="vehicleType" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label>Colour</label>
                    <input type="text" name="color" class="form-control">
                </div>
                <div class="form-group">
                    <label>Licence</label>
                    <input type="text" name="owner" class="form-control">
                </div>
                <div class="form-group">
                    <label>Owner</label>
                    <input type="text" name="owner" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <a class="btn btn-link" href="../views/main.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>


<?php
    include '../partials/footer.php'
?>