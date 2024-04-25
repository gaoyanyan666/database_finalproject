<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee Project</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <?php
    include "db_connection.php";

    // Check if the 'id' parameter is set
    if (isset($_REQUEST["emp_proj_id"])) {
        $emp_proj_id = $_REQUEST["emp_proj_id"];

        // SQL query to select data from the Employee_Project table based on the provided emp_proj_id
        $sql = "SELECT * FROM employee_project WHERE emp_proj_id = ?";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind the parameter to the SQL statement
        $stmt->bind_param("i", $emp_proj_id);

        // Execute the SQL statement
        $stmt->execute();

        // Get the result of the SQL query
        $result = $stmt->get_result();

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Fetch the row as an associative array
            $row = $result->fetch_assoc();
        } else {
            // No entry found with the provided ID
            echo '<div class="alert alert-danger" role="alert">No entry found with the provided ID.</div>';
            exit(); // Stop further execution
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // 'id' parameter is not set
        echo '<div class="alert alert-danger" role="alert">Employee Project ID is not provided.</div>';
        exit(); // Stop further execution
    }
    ?>

    <h2>Edit Employee Project</h2>
    <form action="update_employee_project.php" method="POST">
        <div class="form-group">
            <label for="employeeID">Employee ID:</label>
            <input type="number" class="form-control" id="employeeID" name="employee_id" value="<?php echo $row["employee_id"] ?>">
        </div>
        <div class="form-group">
            <label for="projectID">Project ID:</label>
            <input type="number" class="form-control" id="projectID" name="project_id" value="<?php echo $row["project_id"] ?>">
        </div>
        <input type="hidden" id="emp_proj_id" name="emp_proj_id" value="<?php echo $row["emp_proj_id"] ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>

</body>
</html>
