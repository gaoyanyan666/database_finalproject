<?php
include "db_connection.php";

// Check if emp_proj_id is set in the request
if(isset($_GET["emp_proj_id"])) {
    // Get the emp_proj_id from the request
    $emp_proj_id = $_GET["emp_proj_id"];

    // SQL query to delete an employee project record
    $sql = "DELETE FROM employee_project WHERE emp_proj_id=?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        // If preparing the statement fails, show an error
        die("Error: " . $conn->error);
    }

    // Bind the parameter
    $stmt->bind_param("i", $emp_proj_id);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // Redirect to the employee_project_list.php page after successful deletion
        header("Location: emp_proj_list.php");
        exit(); // Stop further execution
    } else {
        // Display an error message if the deletion fails
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // If emp_proj_id is not set in the request, display an error message
    echo "emp_proj_id is not set.";
}

// Close the database connection
$conn->close();
?>
