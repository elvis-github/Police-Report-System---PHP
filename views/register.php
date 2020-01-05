<?php
    include '../partials/header.php'
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