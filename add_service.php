<!DOCTYPE html>
<html>
<head>
  <title>Add Service Form</title>
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>Add Service</h2>
    <form action="service_process.php" method="POST">
	  <div class="form-group">
        <label for="Bussiness E-mail">Bussiness E-mail:</label>
        <input type="text" class="form-control" id="email" name="eamil">
	  </div>
      <div class="form-group">
        <label for="serviceCategory">Service Category:</label>
        <select class="form-control" id="serviceCategory" name="serviceCategory" required>
          <option value="">Select Category</option>
          <?php
          require_once 'config.php';

          // Fetch service categories from the database
          $query = "SELECT * FROM service_category";
          $result = $conn->query($query);

          if ($result) {
              while ($category = $result->fetch_assoc()) {
                  echo '<option value="' . $category['category_id'] . '">' . ucwords($category['category_name']) . '</option>';
              }
              $result->free();
          } else {
              die('Error occurred while fetching categories: ' . $db->error);
          }

          // Close the database connection
          $conn->close();
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="serviceName">Qualification:</label>
        <input type="text" class="form-control" id="qualification" name="qualification" required>
		<span> Mention any experience, educational qualification or formal training. </span>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
		
		<span>Mention description of service you provide.</span>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
	
	<a href="dashboard.php" class="btn btn-danger mt-3">Back</a>
  </div>
</body>
</html>
