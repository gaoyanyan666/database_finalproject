<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Training</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Training</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="trainingName" class="form-label">Training Name</label>
                <input type="text" class="form-control" id="trainingName" name="trainingName" required>
            </div>
            <div class="mb-3">
                <label for="trainingDescription" class="form-label">Training Description</label>
                <textarea class="form-control" id="trainingDescription" name="trainingDescription" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="trainingDate" class="form-label">Training Date</label>
                <input type="date" class="form-control" id="trainingDate" name="trainingDate">
            </div>
            <div class="mb-3">
                <label for="durationHours" class="form-label">Duration Hours</label>
                <input type="number" class="form-control" id="durationHours" name="durationHours" step="0.01">
            </div>
            <div class="mb-3">
                <label for="employeeID" class="form-label">Employee ID</label>
                <input type="number" class="form-control" id="employeeID" name="employeeID">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="training_list.php" role="button">Back</a>
        </form>
    </div>

    <?php
    // Include the database connection file
    include "db_connection.php";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $trainingName = $_POST["trainingName"];
        $trainingDescription = $_POST["trainingDescription"];
        $trainingDate = $_POST["trainingDate"];
        $durationHours = $_POST["durationHours"];
        $employeeID = $_POST["employeeID"];

        // SQL insert query
        $sql = "INSERT INTO Training (training_name, training_description, training_date, duration_hours, employee_id) 
                VALUES (?, ?, ?, ?, ?)";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $trainingName, $trainingDescription, $trainingDate, $durationHours, $employeeID);

        if ($stmt->execute()) {
            // Training added successfully
            echo '<div class="alert alert-success mt-3" role="alert">New training added successfully.</div>';
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
