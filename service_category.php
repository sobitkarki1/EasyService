<?php
require('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $category_id = $_GET['id'];

        // Prepare and execute the query
        $query = "SELECT s.*, u.name, u.phone_number, c.category_name 
                  FROM service AS s
                  INNER JOIN users AS u ON s.user_id = u.user_id
                  INNER JOIN service_category AS c ON s.category_id = c.category_id
                  WHERE s.category_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $category_id);
        $stmt->execute();

        // Fetch the results
        $result = $stmt->get_result();

        // Check if services are found
        if ($result->num_rows > 0) {
            $category_name = "";
            if ($row = $result->fetch_assoc()) {
                $category_name = $row['category_name'];
            }

            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title><?php echo ucwords($category_name); ?> Services</title>
                <link rel="stylesheet" href="bootstrap.min.css">
            </head>
            <body>
                <div class="container">
                    <h2><?php echo ucwords($category_name); ?> Services</h2>
                    <ul class="list-group">
                        <?php
                        mysqli_data_seek($result, 0); // Reset result pointer to beginning
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <li class="list-group-item">
							
							  <?php echo '<a href="service.php?id=' . $row['service_id'] . '">'; ?>
                                <p>Name: <?php echo $row['name']; ?></p>
                                <p>Phone Number :<?php echo $row['phone_number']; ?></p>
							  </a>
                                <p>Qualification: <?php echo $row['qualification']; ?></p>
                                <p>Description: <?php echo $row['description']; ?></p>
								<div><a href="service.php" class="btn btn-primary">Request Booking</a></div>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </body>
            </html>
            <?php
        } else {
            // No services found
            echo "No services found.";
        }

        // Close the statement
        $stmt->close();
    }
}
?>
