<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee Project</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Employee Project</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="employeeID" class="form-label">Employee ID</label>
                <input type="number" class="form-control" id="employeeID" name="employeeID" required>
            </div>
            <div class="mb-3">
                <label for="projectID" class="form-label">Project ID</label>
                <input type="number" class="form-control" id="projectID" name="projectID" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="emp_proj_list.php" role="button">Back</a>
        </form>
    </div>

    <?php
    // Include the database connection file
    include "db_connection.php";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $employeeID = $_POST["employeeID"];
        $projectID = $_POST["projectID"];

        // SQL insert query
        $sql = "INSERT INTO Employee_Project (employee_id, project_id) VALUES (?, ?)";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $employeeID, $projectID);

        if ($stmt->execute()) {
            // Employee project added successfully
            echo '<div class="alert alert-success mt-3" role="alert">New employee project added successfully.</div>';
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
