<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Training</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <?php
    include "db_connection.php";

    // Check if the 'training_id' parameter is set
    if (isset($_REQUEST["training_id"])) {
        $training_id = $_REQUEST["training_id"];

        // SQL query to select data from the Training table based on the provided training_id
        $sql = "SELECT * FROM training WHERE training_id = ?";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind the parameter to the SQL statement
        $stmt->bind_param("i", $training_id);

        // Execute the SQL statement
        $stmt->execute();

        // Get the result of the SQL query
        $result = $stmt->get_result();

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Fetch the row as an associative array
            $row = $result->fetch_assoc();
        } else {
            // No training found with the provided ID
            echo '<div class="alert alert-danger" role="alert">No training found with the provided ID.</div>';
            exit(); // Stop further execution
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // 'training_id' parameter is not set
        echo '<div class="alert alert-danger" role="alert">Training ID is not provided.</div>';
        exit(); // Stop further execution
    }
    ?>

    <h2>Edit Training</h2>
    <form action="update_training.php" method="POST">
        <div class="form-group">
            <label for="name">Training Name:</label>
            <input type="text" class="form-control" id="name" name="training_name" value="<?php echo $row["training_name"] ?>">
        </div>
        <div class="form-group">
            <label for="description">Training Description:</label>
            <textarea class="form-control" id="description" name="training_description"><?php echo $row["training_description"] ?></textarea>
        </div>
        <div class="form-group">
            <label for="date">Training Date:</label>
            <input type="date" class="form-control" id="date" name="training_date" value="<?php echo $row["training_date"] ?>">
        </div>
        <div class="form-group">
            <label for="duration">Duration (hours):</label>
            <input type="number" class="form-control" id="duration" name="duration_hours" value="<?php echo $row["duration_hours"] ?>">
        </div>
        <div class="form-group">
            <label for="employeeID">Employee ID:</label>
            <input type="number" class="form-control" id="employeeID" name="employee_id" value="<?php echo $row["employee_id"] ?>">
        </div>
        <input type="hidden" id="id" name="id" value="<?php echo $row["training_id"] ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html>
