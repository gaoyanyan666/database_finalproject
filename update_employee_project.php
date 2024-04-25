<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee Project</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <?php
    include "db_connection.php";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $emp_proj_id = $_POST["emp_proj_id"];
        $employee_id = $_POST["employee_id"];
        $project_id = $_POST["project_id"];

        // SQL update query for the Employee_Project table
        $sql = "UPDATE employee_project 
                SET employee_id=?, project_id=?
                WHERE emp_proj_id=?";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $employee_id, $project_id, $emp_proj_id);

        if ($stmt->execute()) {
            // Employee project updated successfully
            echo '<div class="alert alert-success mt-3" role="alert">Employee project updated successfully.</div>';
            // Add a button to jump back to the employee project list page
            echo '<a class="btn btn-primary mt-3" href="emp_proj_list.php">Back to Employee Project List</a>';
        } else {
            // Error occurred
            echo '<div class="alert alert-danger mt-3" role="alert">Error updating employee project: ' . $stmt->error . '</div>';
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
    ?>
</div>

</body>
</html>

