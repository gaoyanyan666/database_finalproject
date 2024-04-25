<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Department</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Department</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="mb-3">
        <label for="departmentName" class="form-label">Department Name</label>
        <input type="text" class="form-control" id="departmentName" name="departmentName" required>
    </div>
    <div class="mb-3">
        <label for="Location" class="form-label">Location</label>
        <input type="text" class="form-control" id="Location" name="Location">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a class="btn btn-secondary" href="dep_list.php" role="button">Back</a>
</form>

    </div>

    <?php
    // Include the database connection file
    include "db_connection.php";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $departmentName = $_POST["departmentName"];
        $Location = $_POST["Location"];

        // SQL insert query
        $sql = "INSERT INTO department (department_name, department_location) VALUES (?, ?)";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $departmentName, $Location);

        if ($stmt->execute()) {
            // Department added successfully
            echo '<div class="alert alert-success mt-3" role="alert">New department added successfully.</div>';
        } else {
            // Error occurred
            echo '<div class="alert alert-danger mt-3" role="alert">Error: ' . $sql . "<br>" . $conn->error . '</div>';
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
