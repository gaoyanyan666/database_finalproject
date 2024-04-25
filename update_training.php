<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Training</title>
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
        $trainingName = $_POST["training_name"];
        $trainingDescription = $_POST["training_description"];
        $trainingDate = $_POST["training_date"];
        $durationHours = $_POST["duration_hours"];
        $employeeID = $_POST["employee_id"];

        // SQL update query for the Training table
        $sql = "UPDATE training 
                SET training_name=?, training_description=?, training_date=?, duration_hours=?, employee_id=?
                WHERE training_id=?";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $trainingName, $trainingDescription, $trainingDate, $durationHours, $employeeID, $id);

        if ($stmt->execute()) {
            // Training updated successfully
            echo '<div class="alert alert-success mt-3" role="alert">Training updated successfully.</div>';
            // Add a button to jump back to the training list page
            echo '<a class="btn btn-primary mt-3" href="training_list.php">Back to Training List</a>';
        } else {
            // Error occurred
            echo '<div class="alert alert-danger mt-3" role="alert">Error updating training: ' . $stmt->error . '</div>';
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
