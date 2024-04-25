<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Department</title>
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
        $id = $_POST["department_id"];
        $name = $_POST["department_name"];
        $location = $_POST["department_location"];

        // SQL update query for the Department table
        $sql = "UPDATE department 
                SET department_name=?, department_location=?
                WHERE department_id=?";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $location, $id);

        if ($stmt->execute()) {
            // Department updated successfully
            echo '<div class="alert alert-success mt-3" role="alert">Department updated successfully.</div>';
            // Add a button to jump back to the department list page
            echo '<a class="btn btn-primary mt-3" href="dep_list.php">Back to Department List</a>';
        } else {
            // Error occurred
            echo '<div class="alert alert-danger mt-3" role="alert">Error updating department: ' . $stmt->error . '</div>';
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
