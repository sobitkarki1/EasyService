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
				 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
				<script>
					$(document).ready(function() {
						$('#rating').on('input change', function() {
							$('#selected-rating').text($(this).val());
						});
					});
				</script>
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
							<!-- HTML code for service.php -->
							<?php echo '<a href="book_process.php?service_id=' . $service_id . '" class="btn btn-danger mt-3">Book Now</a>'; ?>
							<p><span> You can also call above phone number and manually arange. <span></p>
							
                        </div>
                    </div>
					<div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Reviews</h5>
							<?php
require_once("config.php");

// Retrieve the service ID from the URL parameter or any other source
$service_id = $_GET['id']; // Assuming the service ID is passed via the URL parameter

// Query to retrieve the reviews for the specified service ID
$query = "SELECT * FROM review WHERE service_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $service_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if there are reviews for the service
if (mysqli_num_rows($result) > 0) {
    // Display the reviews
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Review ID: " . $row['review_id'] . "<br>";
        echo "Comment: " . $row['review_comment'] . "<br>";
        echo "Rating: " . $row['review_rating'] . "<br>";
        echo "<br>";
    }
} else {
    echo "No reviews found for this service.";
}

// Close the statement
mysqli_stmt_close($stmt);

// Close the connection
mysqli_close($conn);
?>

							
							
                        </div>
                    </div>
					<div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add a Review</h5>
							<form action="review_process.php" method="POST">
      <div class="form-group">
        <label for="rating">Rating:</label>
        <input type="range" class="form-control-range" id="rating" name="rating" min="1" max="5" step="0.5">
		<div id="selected-rating">3</div>
      </div>
      <div class="form-group">
        <label for="comment">Comment:</label>
        <textarea class="form-control" id="comment" name="comment" rows="5"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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
} else {
    echo "<h2>Booked Successfully!</h2>";
}
?>
