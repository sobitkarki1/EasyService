<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the inputs
    $comment = $_POST["comment"] ?? "";
    $rating = $_POST["rating"] ?? "";

    // Perform further validation if required
    // ...

    // Insert the review data into the database
    $query = "INSERT INTO review (review_comment, review_rating, service_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sii", $comment, $rating, $service_id);

    if (mysqli_stmt_execute($stmt)) {
        // Review added successfully
        echo "Review added successfully!";
    } else {
        // Error occurred while adding review
        echo "Error occurred while adding review: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the connection
mysqli_close($conn);
?>
