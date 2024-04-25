<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <?php
    include "db_connection.php";

    // Check if the 'id' parameter is set
    if (isset($_REQUEST["project_id"])) {
        $project_id = $_REQUEST["project_id"];

        // SQL query to select data from the Project table based on the provided project_id
        $sql = "SELECT * FROM project WHERE project_id = ?";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind the parameter to the SQL statement
        $stmt->bind_param("i", $project_id);

        // Execute the SQL statement
        $stmt->execute();

        // Get the result of the SQL query
        $result = $stmt->get_result();

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Fetch the row as an associative array
            $row = $result->fetch_assoc();
        } else {
            // No project found with the provided ID
            echo '<div class="alert alert-danger" role="alert">No project found with the provided ID.</div>';
            exit(); // Stop further execution
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // 'id' parameter is not set
        echo '<div class="alert alert-danger" role="alert">Project ID is not provided.</div>';
        exit(); // Stop further execution
    }
    ?>

    <h2>Edit Project</h2>
    <form action="update_project.php" method="POST">
        <div class="form-group">
            <label for="projectName">Project Name:</label>
            <input type="text" class="form-control" id="projectName" name="project_name" value="<?php echo $row["project_name"] ?>">
        </div>
        <div class="form-group">
            <label for="projectDescription">Project Description:</label>
            <textarea class="form-control" id="projectDescription" name="project_description"><?php echo $row["project_description"] ?></textarea>
        </div>
        <div class="form-group">
            <label for="startDate">Start Date:</label>
            <input type="date" class="form-control" id="startDate" name="start_date" value="<?php echo $row["start_date"] ?>">
        </div>
        <div class="form-group">
            <label for="endDate">End Date:</label>
            <input type="date" class="form-control" id="endDate" name="end_date" value="<?php echo $row["end_date"] ?>">
        </div>
        <input type="hidden" id="id" name="id" value="<?php echo $row["project_id"] ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html>
