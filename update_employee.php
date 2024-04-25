<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
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
        $id = $_POST["id"];
        $name = $_POST["employee_name"];
        $email = $_POST["employee_email"];
        $hireDate = $_POST["hire_date"];
        $jobTitle = $_POST["job_title"];
        $departmentID = $_POST["department_id"];

        // SQL update query for the Employee table
        $sql = "UPDATE employee 
                SET employee_name=?, employee_email=?, hire_date=?, job_title=?, department_id=?
                WHERE employee_id=?";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $name, $email, $hireDate, $jobTitle, $departmentID, $id);

        if ($stmt->execute()) {
            // Employee updated successfully
            echo '<div class="alert alert-success mt-3" role="alert">Employee updated successfully.</div>';
            // Add a button to jump back to the employee list page
            echo '<a class="btn btn-primary mt-3" href="emp_list.php">Back to Employee List</a>';
        } else {
            // Error occurred
            echo '<div class="alert alert-danger mt-3" role="alert">Error updating employee: ' . $stmt->error . '</div>';
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
