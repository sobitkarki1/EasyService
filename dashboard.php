<?php
require_once("config.php");

// Check if the user is logged in
if (!isset($_SESSION["phone_number"])) {
  header("Location: index.php");
  exit();
}

// Retrieve user information from the database
$phone_number = $_SESSION["phone_number"];
$sql = "SELECT * FROM users WHERE phone_number = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $phone_number);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
  $user = mysqli_fetch_assoc($result);
  $user_id = $user['user_id'];
} else {
  // User not found
  header("Location: index.php");
  exit();
}

// Close the statement
mysqli_stmt_close($stmt);

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css"> 
  <link rel="stylesheet" href="bootstrap.min.css">

</head>
<body>
  <div class="container">
    <h2 class="welcome">Welcome, <?php echo $user["name"]; ?>!</h2>
	<h3> Select service provider:</h3>
	<h4> Plumber </h4>
	<h4> Electrician </h4>
	<h4> Home Painter </h4>
    <br>
	<div>
        <div> Your phone number is <?php echo htmlspecialchars($user['phone_number']); ?></div>
        <div> You created your profile in <?php echo htmlspecialchars($user['signed_up']); ?></div>
		<div> <a href="add_service.php"> Provide service. </a> <div>
    </div>
	<br>
    <a href="logout.php" class="btn btn-secondary">Logout</a>
    
  </div>
</body>
</html>
