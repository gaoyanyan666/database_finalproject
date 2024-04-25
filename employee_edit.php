 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <?php
    include "db_connection.php";

    // Check if the 'id' parameter is set
    if (isset($_REQUEST["employee_id"])) {
        $employee_id = $_REQUEST["employee_id"];

        // SQL query to select data from the Employee table based on the provided employee_id
        $sql = "SELECT * FROM employee WHERE employee_id = ?";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind the parameter to the SQL statement
        $stmt->bind_param("i", $employee_id);

        // Execute the SQL statement
        $stmt->execute();

        // Get the result of the SQL query
        $result = $stmt->get_result();

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Fetch the row as an associative array
            $row = $result->fetch_assoc();
        } else {
            // No employee found with the provided ID
            echo '<div class="alert alert-danger" role="alert">No employee found with the provided ID.</div>';
            exit(); // Stop further execution
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // 'id' parameter is not set
        echo '<div class="alert alert-danger" role="alert">Employee ID is not provided.</div>';
        exit(); // Stop further execution
    }
    ?>

    <h2>Edit Employee</h2>
    <form action="update_employee.php" method="POST">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="employee_name" value="<?php echo $row["employee_name"] ?>">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="employee_email" value="<?php echo $row["employee_email"] ?>">
    </div>
    <div class="form-group">
        <label for="hireDate">Hire Date:</label>
        <input type="date" class="form-control" id="hireDate" name="hire_date" value="<?php echo $row["hire_date"] ?>">
    </div>
    <div class="form-group">
        <label for="position">Position:</label>
        <input type="text" class="form-control" id="position" name="job_title" value="<?php echo $row["job_title"] ?>">
    </div>
    <div class="form-group">
        <label for="departmentID">Department ID:</label>
        <input type="number" class="form-control" id="departmentID" name="department_id" value="<?php echo $row["department_id"] ?>">
    </div>
    <input type="hidden" id="id" name="id" value="<?php echo $row["employee_id"] ?>">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>

</body>
</html>
