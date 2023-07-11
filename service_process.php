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
}

// Close the database connection
mysqli_close($conn);
?>
