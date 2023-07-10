<?php
require_once 'config.php';

// Define variables and initialize with empty values
$name = $phone_number = $password = $confirm_password = '';
$name_err = $phone_number_err = $password_err = $confirm_password_err = '';

// Process the form data when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate phone_number
    if (empty(trim($_POST['phone_number']))) {
        $phone_number_err = 'Please enter a phone number.';
    } else {
        // Prepare a select statement
        $sql = 'SELECT user_id FROM users WHERE phone_number = ?';

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 's', $param_phone_number);

            // Set parameters
            $param_phone_number = trim($_POST['phone_number']);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store the result
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $phone_number_err = 'This phone number is already taken.';
                } else {
                    $phone_number = trim($_POST['phone_number']);
                }
            } else {
                echo 'Oops! Something went wrong. Please try again later.';
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter a password.';
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = 'Password must have at least 5 characters.';
    } else {
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if (empty(trim($_POST['confirm_password']))) {
        $confirm_password_err = 'Please confirm the password.';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password != $confirm_password) {
            $confirm_password_err = 'Password did not match.';
        }
    }
	
	$name=$_POST['name'];

    // Check input errors before inserting into the database
    if ( empty($name_err) && empty($phone_number_err) && empty($password_err) && empty($confirm_password_err)) {
        // Prepare an insert statement
        $sql = 'INSERT INTO users (name, phone_number, password) VALUES (?, ?, ?)';

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 'sss', $param_name, $param_phone_number, $param_password);

            // Set parameters
			$param_name = $name;
            $param_phone_number = $phone_number;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to the login page
                header('location: registration_sucess.php');
            } else {
                echo 'Oops! Something went wrong. Please try again later.';
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="logo">
        <img src="logo.png" alt="Logo" class="rounded mx-auto d-block">
    </div>
	<br>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
			<div>
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>">
                <span><?php echo $name_err; ?></span>
            </div>
            <div>
                <label>Phone Number</label>
                <input type="text" name="phone_number" value="<?php echo $phone_number; ?>">
                <span><?php echo $phone_number_err; ?></span>
            </div>
            <div>
                <label>Choose new password</label>
                <input type="password" name="password" value="<?php echo $password; ?>">
                <span><?php echo $password_err; ?></span>
            </div>
            <div>
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                <span><?php echo $confirm_password_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Submit">
                <input type="reset" value="Reset">
            </div>
            <p>Already have an account? <a href="index.php">Login here</a>.</p>
        </form>
    </div>
</body>

</html>
