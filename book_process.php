<?php
require_once("config.php");



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Validate and sanitize the inputs
    $service_id = $_GET["service_id"] ?? "";
    $booking_status = "Pending";

    // Insert the booking data into the database
    $query = "INSERT INTO booking (service_id, booking_status) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "is", $service_id, $booking_status);

    if (mysqli_stmt_execute($stmt)) {
        // Booking added successfully
        echo "Booking added successfully!";
    } else {
        // Error occurred while adding booking
        echo "Error occurred while adding booking: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($conn);
?>
