<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Skill</title>
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
        $skill_name = $_POST["skill_name"];

        // SQL update query for the Skill table
        $sql = "UPDATE skill 
                SET skill_name=?
                WHERE skill_id=?";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $skill_name, $skill_id);

        if ($stmt->execute()) {
            // Skill updated successfully
            echo '<div class="alert alert-success mt-3" role="alert">Skill updated successfully.</div>';
            // Add a button to jump back to the skill list page
            echo '<a class="btn btn-primary mt-3" href="skill_list.php">Back to Skill List</a>';
        } else {
            // Error occurred
            echo '<div class="alert alert-danger mt-3" role="alert">Error updating skill: ' . $stmt->error . '</div>';
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
