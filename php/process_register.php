<?php
include "../inc/head.inc.php";
include "../inc/nav.inc.php";

$fname = $lname = $email = $pwd = $pwd_confirm = $hashed_pwd = "";
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


/*
* Helper function to write the member data to the database.
*/
function saveMemberToDB()
{
    global $fname, $lname, $email, $hashed_pwd, $errorMsg, $success;
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
            $stmt = $conn->prepare("INSERT INTO world_of_pets_members
(fname, lname, email, password) VALUES (?, ?, ?, ?)");
            // Bind & execute the query statement:
            $stmt->bind_param("ssss", $fname, $lname, $email, $hashed_pwd);
            if (!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " .
                    $stmt->error;
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
    global $fname, $lname, $email, $pwd, $pwd_confirm, $hashed_pwd, $errorMsg, $success;

    // --- A & D. Validate Required Fields & Sanitize Non-Password Inputs ---
    //0. First Name (Sanitise)
    if (!empty($_POST["fname"])) {
    $fname = sanitize_input($_POST["fname"]);
    } else {
        $fname = "";
    }

    // 1. Last Name (Required & Sanitize)
    if (empty($_POST["lname"])) {
        $errorMsg .= "Last Name is required.<br>";
        $success = false;
    } else {
        $lname = sanitize_input($_POST["lname"]);
    }

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

    // 4. Confirm Password (Required)
    if (empty($_POST["pwd_confirm"])) {
        $errorMsg .= "Confirmation Password is required.<br>";
        $success = false;
    } else {
        $pwd_confirm = $_POST["pwd_confirm"];
    }



    // 5. Agreement (Required)
    if (!isset($_POST["agree"])) {
        $errorMsg .= "You must agree to the terms and conditions.<br>";
        $success = false;
    }

    // --- C. Check Password Match (Only if password fields were provided and validation has not failed yet) ---
    if ($success && !empty($pwd) && !empty($pwd_confirm) && $pwd !== $pwd_confirm) {
        $errorMsg .= "Passwords do not match.<br>";
        $success = false;
    }

    // --- D. Hash Password (Only if all checks passed) ---
    if ($success) {
        // Hash the password for secure storage using password_hash()
        $hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

        // TODO: In a real application, you would insert the user data ($fname, $lname, $email, $hashed_pwd) into a database here.
    }

    saveMemberToDB();
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
            <h4 class="alert-heading">Registration Successful!</h4>
            <p>Thank you for signing up, <?php echo htmlspecialchars($fname) . " " . htmlspecialchars($lname); ?>!</p>
        </div>
        <a href="/#" class="btn btn-primary">Log-in</a>
    <?php

    } else {
        // --- 4.10 Presentable and Informative Error Message ---
    ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Oops!</h4>
            <p>We detected the following issues with your submission:</p>
            <p class="mb-0"><?php echo $errorMsg; ?></p>
        </div>
        <a href="./register.php" class="btn btn-danger">Return to Sign Up</a>
    <?php
    }
    ?>
</main>

<?php
include "../inc/footer.inc.php";
?>