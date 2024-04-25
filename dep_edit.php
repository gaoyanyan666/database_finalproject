<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Department</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <?php
    include "db_connection.php";

    // Check if the 'id' parameter is set
    if (isset($_REQUEST["department_id"])) {
        $department_id = $_REQUEST["department_id"];

        // SQL query to select data from the Department table based on the provided department_id
        $sql = "SELECT * FROM department WHERE department_id = ?";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind the parameter to the SQL statement
        $stmt->bind_param("i", $department_id);

        // Execute the SQL statement
        $stmt->execute();

        // Get the result of the SQL query
        $result = $stmt->get_result();

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Fetch the row as an associative array
            $row = $result->fetch_assoc();
        } else {
            // No department found with the provided ID
            echo '<div class="alert alert-danger" role="alert">No department found with the provided ID.</div>';
            exit(); // Stop further execution
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // 'id' parameter is not set
        echo '<div class="alert alert-danger" role="alert">Department ID is not provided.</div>';
        exit(); // Stop further execution
    }
    ?>

    <h2>Edit Department</h2>
    <form action="update_department.php" method="POST">
    <div class="form-group">
        <label for="departmentName">Department Name:</label>
        <input type="text" class="form-control" id="departmentName" name="department_name" value="<?php echo $row["department_name"] ?>">
    </div>
    <div class="form-group">
        <label for="departmentLocation">Location:</label>
        <input type="text" class="form-control" id="departmentLocation" name="department_location" value="<?php echo $row["department_location"] ?>">
    </div>
    <input type="hidden" id="departmentId" name="department_id" value="<?php echo $row["department_id"] ?>">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>

</body>
</html>
