<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Project</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Project</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="projectName" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="projectName" name="projectName" required>
            </div>
            <div class="mb-3">
                <label for="projectDescription" class="form-label">Project Description</label>
                <textarea class="form-control" id="projectDescription" name="projectDescription" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="startDate" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="startDate" name="startDate">
            </div>
            <div class="mb-3">
                <label for="endDate" class="form-label">End Date</label>
                <input type="date" class="form-control" id="endDate" name="endDate">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="proj_list.php" role="button">Back</a>
        </form>
    </div>

    <?php
    // Include the database connection file
    include "db_connection.php";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $projectName = $_POST["projectName"];
        $projectDescription = $_POST["projectDescription"];
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];

        // SQL insert query
        $sql = "INSERT INTO Project (project_name, project_description, start_date, end_date) 
                VALUES (?, ?, ?, ?)";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $projectName, $projectDescription, $startDate, $endDate);

        if ($stmt->execute()) {
            // Project added successfully
            echo '<div class="alert alert-success mt-3" role="alert">New project added successfully.</div>';
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
