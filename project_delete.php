<?php
include "db_connection.php";

// Check if department_id is set in the request
if(isset($_GET["project_id"])) {
    // Get the department_id from the request
    $id = $_GET["project_id"];

    // SQL query to delete a department record
    $sql = "DELETE FROM project WHERE project_id=?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        // If preparing the statement fails, show an error
        die("Error: " . $conn->error);
    }

    // Bind the parameter
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // Redirect to the dep_list.php page after successful deletion
        header("Location: proj_list.php");
        exit(); // Stop further execution
    } else {
        // Display an error message if the deletion fails
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // If department_id is not set in the request, display an error message
    echo "project_id is not set.";
}

// Close the database connection
$conn->close();
?>
