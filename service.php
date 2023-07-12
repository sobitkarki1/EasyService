<?php
// Check if the request method is GET and the "id" parameter is provided
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $service_id = $_GET["id"];

    require "config.php";

    $sql = "SELECT s.*, u.* 
        FROM service AS s
        JOIN users AS u ON s.user_id = u.user_id
        WHERE s.service_id = $service_id";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Fetch the row as an associative array
            $row = mysqli_fetch_assoc($result);
            ?>
            <html>
            <head>
                <title>Service Details</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
            </head>
            <body>
                <div class="container">
                    <h2>Service Details</h2>
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">Name: <?php echo $row["name"]; ?></p>
                            <p class="card-text">Qualification: <?php echo $row["qualification"]; ?></p>
                            <p class="card-text">Description: <?php echo $row["description"]; ?></p>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Provider Information</h5>
                            <p class="card-text">Name: <?php echo $row["name"]; ?></p>
                            <p class="card-text">Phone Number: <?php echo $row["phone_number"]; ?></p>
                        </div>
                    </div>
					
					<div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Booking</h5>
							<a href="book_process.php" class="btn btn-danger mt-3"> Book Now </a>
							<p><span> You can also call above phone number and manually arange. <span></p>
							
                        </div>
                    </div>
					<div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reviews</h5>
							<p class="card-text">No reviews yet.</p>
							
							
                        </div>
                    </div>
					
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "No results found for the provided service ID.";
        }
    } else {
        echo "Error executing the query: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "<h2>Invalid format provided.</h2>";
}
?>
