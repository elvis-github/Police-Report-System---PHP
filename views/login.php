<?php
    include '../partials/header.php'
?>
<div class="container">
    <div class="text-center mt-3">
        <h1>Police Reporting System - Login</h1>
        <form class=mt-3 action="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="text" name="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
            
        </form>
        <a href="../index.php">Back to Home</a>
    </div>
</div>
<?php
    include '../partials/footer.php'
?>