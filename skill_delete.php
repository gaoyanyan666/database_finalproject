<?php
include "db_connection.php";

// Check if skill_id is set in the request
if(isset($_GET["skill_id"])) {
    // Get the skill_id from the request
    $id = $_GET["skill_id"];

    // SQL query to delete a skill record
    $sql = "DELETE FROM skill WHERE skill_id=?";

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
        // Redirect to the skill_list.php page after successful deletion
        header("Location: skill_list.php");
        exit(); // Stop further execution
    } else {
        // Display an error message if the deletion fails
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // If skill_id is not set in the request, display an error message
    echo "Skill ID is not set.";
}

// Close the database connection
$conn->close();
?>
