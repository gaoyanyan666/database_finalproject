<?php
include "db_connection.php";

// Check if EmployeeID is set in the request
if(isset($_GET["employee_id"])) {
    // Get the EmployeeID from the request
    $id = $_GET["employee_id"];

    // SQL query to delete an employee record
    $sql = "DELETE FROM employee WHERE employee_id=?";

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
        // Redirect to the employee.php page after successful deletion
        header("Location: emp_list.php");
        exit(); // Stop further execution
    } else {
        // Display an error message if the deletion fails
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // If EmployeeID is not set in the request, display an error message
    echo "employee_id is not set.";
}

// Close the database connection
$conn->close();
?>
