<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Project</title>
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
        $projectName = $_POST["project_name"];
        $projectDescription = $_POST["project_description"];
        $startDate = $_POST["start_date"];
        $endDate = $_POST["end_date"];

        // SQL update query for the Project table
        $sql = "UPDATE project 
                SET project_name=?, project_description=?, start_date=?, end_date=?
                WHERE project_id=?";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $projectName, $projectDescription, $startDate, $endDate, $id);

        if ($stmt->execute()) {
            // Project updated successfully
            echo '<div class="alert alert-success mt-3" role="alert">Project updated successfully.</div>';
            // Add a button to jump back to the project list page
            echo '<a class="btn btn-primary mt-3" href="proj_list.php">Back to Project List</a>';
        } else {
            // Error occurred
            echo '<div class="alert alert-danger mt-3" role="alert">Error updating project: ' . $stmt->error . '</div>';
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
