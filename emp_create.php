<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Employee</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="departmentID" class="form-label">Department ID</label>
                <input type="number" class="form-control" id="departmentID" name="departmentID">
            </div>
            <div class="mb-3">
                <label for="employeeName" class="form-label">Employee Name</label>
                <input type="text" class="form-control" id="employeeName" name="employeeName" required>
            </div>
            <div class="mb-3">
                <label for="employeeEmail" class="form-label">Employee Email</label>
                <input type="email" class="form-control" id="employeeEmail" name="employeeEmail">
            </div>
            <div class="mb-3">
                <label for="hireDate" class="form-label">Hire Date</label>
                <input type="date" class="form-control" id="hireDate" name="hireDate">
            </div>
            <div class="mb-3">
                <label for="jobTitle" class="form-label">Job Title</label>
                <input type="text" class="form-control" id="jobTitle" name="jobTitle">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="emp_list.php" role="button">Back</a>
        </form>
    </div>

    <?php
    // Include the database connection file
    include "db_connection.php";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $departmentID = $_POST["departmentID"];
        $employeeName = $_POST["employeeName"];
        $employeeEmail = $_POST["employeeEmail"];
        $hireDate = $_POST["hireDate"];
        $jobTitle = $_POST["jobTitle"];

        // SQL insert query
        $sql = "INSERT INTO Employee (department_id, employee_name, employee_email, hire_date, job_title) 
                VALUES (?, ?, ?, ?, ?)";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $departmentID, $employeeName, $employeeEmail, $hireDate, $jobTitle);

        if ($stmt->execute()) {
            // Employee added successfully
            echo '<div class="alert alert-success mt-3" role="alert">New employee added successfully.</div>';
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

