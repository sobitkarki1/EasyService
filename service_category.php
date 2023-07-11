<?php
require('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $category_id = $_GET['id'];

        // Prepare and execute the query
        $query = "SELECT s.*, u.name, u.phone_number FROM service AS s
                  INNER JOIN users AS u ON s.user_id = u.user_id
                  WHERE s.category_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $category_id);
        $stmt->execute();

        // Fetch and print the results
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            // Print the details of each service
            echo "Service ID: " . $row['service_id'] . "<br>";
            echo "Service Name: " . $row['service_name'] . "<br>";
            echo "Description: " . $row['description'] . "<br>";
            echo "User ID: " . $row['user_id'] . "<br>";
            echo "User Name: " . $row['name'] . "<br>";
            echo "User Phone: " . $row['phone_number'] . "<br>";
            echo "<br>";
        }

        // Close the statement
        $stmt->close();
    }
}
?>
