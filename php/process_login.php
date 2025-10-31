<?php
include "inc/head.inc.php";
include "inc/nav.inc.php";

$email = $pwd = "";
$errorMsg = "";
$success = true;

/*
 * Helper function that sanitises input
 */
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function authenticateUser()
{
    global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;
    // Create database connection.
    $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config) {
        $errorMsg = "Failed to read database config file.";
        $success = false;
    } else {
        $conn = new mysqli(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['dbname']
        );
        // Check connection
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            // Prepare the statement:
            $stmt = $conn->prepare("SELECT * FROM world_of_pets_members WHERE email=?");
            // Bind & execute the query statement:
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                // Note that email field is unique, so should only have one row.
                $row = $result->fetch_assoc();
                $fname = $row["fname"];
                $lname = $row["lname"];
                $pwd_hashed = $row["password"];
                // Check if the password matches:
                if (!password_verify($_POST["pwd"], $pwd_hashed)) {
                    // Don’t tell hackers which one was wrong, keep them guessing...
                    $errorMsg = "Email not found or password doesn't match...";
                    $success = false;
                }
            } else {
                $errorMsg = "Email not found or password doesn't match...";
                $success = false;
            }
            $stmt->close();
        }
        $conn->close();
    }
}



/*
 * Main function to validate and process the form data.
 */
function validate_and_process_form()
{
    global $email, $pwd, $errorMsg, $success;

    // --- A & D. Validate Required Fields & Sanitize Non-Password Inputs ---

    // --- 2. Email (Required, Sanitize, & Validate Format) ---
    if (empty($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    } else {
        // Sanitize email
        $email = sanitize_input($_POST["email"]);

        // B. Check to make sure e-mail address is well-formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.<br>";
            $success = false;
        }
    }

    // 3. Password (Required)
    if (empty($_POST["pwd"])) {
        $errorMsg .= "Password is required.<br>";
        $success = false;
    } else {
        $pwd = $_POST["pwd"];
    }
    
    authenticateUser();
}


// Execute validation
validate_and_process_form();
?>

<main class="container py-5">
    <?php
    // The result presentation relies solely on this block below, which uses Bootstrap.
    if ($success) {
        // --- 4.10 Presentable and Informative Success Message ---
    ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Login Successful!</h4>
            <p>Welcome back, <?php echo htmlspecialchars($fname) . " " . htmlspecialchars($lname); ?>.</p>
        </div>  
        <a href="/#" class="btn btn-primary">Log-in</a>
    <?php

    } else {
        // --- 4.10 Presentable and Informative Error Message ---
    ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Oops!</h4>
            <p>The following errors were detected:</p>
            <p class="mb-0"><?php echo $errorMsg; ?></p>
        </div>
        <a href="/login.php" class="btn btn-danger">Return to Login</a>
    <?php
    }
    ?>
</main>

<?php
include "inc/footer.inc.php";
?>