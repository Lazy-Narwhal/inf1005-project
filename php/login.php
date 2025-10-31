<!DOCTYPE html>
<html lang="en">

<?php
include "inc/head.inc.php"
?>

<body>
    <?php
    include "inc/nav.inc.php";
    ?>
    <main class="container">
        <h1>Member Login</h1>
        <p>
            Not a member? 
            <a href="/register.php"> Signup now</a>.
        </p>
        <form action="process_login.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input required maxlength="45" type="email" id="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input required type="password" id="pwd" name="pwd" class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </main>
    <?php
    include "inc/footer.inc.php";
    ?>
</body>