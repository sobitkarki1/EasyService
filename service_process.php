<?php
require_once 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the inputs
    $serviceCategory = $_POST['serviceCategory'] ?? '';
    $serviceName = $_POST['serviceName'] ?? '';
    $description = $_POST['description'] ?? '';

    // Perform further validation if required
    // ...

    // Insert the service data into the database
    $query = "INSERT INTO service (service_name, description, category_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssi', $serviceName, $description, $serviceCategory);

    if (mysqli_stmt_execute($stmt)) {
        // Service added successfully
        echo "Service added successfully!";
    } else {
        // Error occurred while adding service
        echo "Error occurred while adding service: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
	
	// Now lets fill service_provider table
	$phone = $_SESSION["phone_number"] ?? '';
	$email = $POST["email"] ?? '';
	$provider_name = $_SESSION["name"];
	$user_id = $_SESSION["user_id"];
	
	$query = "INSERT INTO service_provider (phone, email, provider_name, user_id)
				VALUES (?, ?, ?, ?);";
	$stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssi', $phone, $email, $provider_name, $user_id);
	
	if (mysqli_stmt_execute($stmt)) {
        // Service added successfully
        echo "Congrats you became a service provider!";
    } else {
        // Error occurred while adding service
        echo "Error occurred while adding as service_provider: " . mysqli_error($conn);
    }
	

	
}

// Close the database connection
mysqli_close($conn);
?>
