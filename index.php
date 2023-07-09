<?php
require_once("config.php");
// Check if the user is logged in
if (isset($_SESSION["phone_number"])) {
  header("Location: dashboard.php");
  exit();
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $phone_number = $_POST["phone_number"];
  $password = $_POST["password"];
  // Prepare SQL statement
  $sql = "SELECT * FROM users WHERE phone_number = '$phone_number'";
  // Execute the SQL statement
  $result = mysqli_query($conn, $sql);
  // Check if a row is found
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    // Verify the password
    if (password_verify($password, $row["password"])) {
      // Successful login
      $_SESSION["phone_number"] = $phone_number; // Store phone_number number in session variable
      header("Location: dashboard.php"); // Redirect to dashboard page
      exit();
    } else {
      // Invalid password
      $errorMessage = 'Invalid phone number or password. Please try again.';
    }
  } else {
    // User not found
    $errorMessage = 'User not found. Please try again.';
  }
  // Close the result set
  mysqli_free_result($result);
}
// Close the connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bootstrap.min.css">
  
</head>
<body>
  
<div class="logo">
  <img src="logo.png" alt="Logo" class="rounded mx-auto d-block">
</div>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">Login</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
              <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" placeholder="Enter your Phone Number" name="phone_number">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
              </div>
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
						
            <div>
              <span class="font-weight-bold">
                <a href="register.php">Register for a new account!</a>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="jquery.min.js"></script>
  <script src="popper.min.js"></script>
  <script src="bootstrap.min.js"></script>
</body>
</html>