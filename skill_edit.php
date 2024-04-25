<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Skill</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <?php
    include "db_connection.php";

    // Check if the 'id' parameter is set
    if (isset($_REQUEST["skill_id"])) {
        $skill_id = $_REQUEST["skill_id"];

        // SQL query to select data from the Skill table based on the provided skill_id
        $sql = "SELECT * FROM skill WHERE skill_id = ?";

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);

        // Bind the parameter to the SQL statement
        $stmt->bind_param("i", $skill_id);

        // Execute the SQL statement
        $stmt->execute();

        // Get the result of the SQL query
        $result = $stmt->get_result();

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Fetch the row as an associative array
            $row = $result->fetch_assoc();
        } else {
            // No skill found with the provided ID
            echo '<div class="alert alert-danger" role="alert">No skill found with the provided ID.</div>';
            exit(); // Stop further execution
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // 'id' parameter is not set
        echo '<div class="alert alert-danger" role="alert">Skill ID is not provided.</div>';
        exit(); // Stop further execution
    }
    ?>

    <h2>Edit Skill</h2>
    <form action="update_skill.php" method="POST">
        <div class="form-group">
            <label for="skillName">Skill Name:</label>
            <input type="text" class="form-control" id="skillName" name="skill_name" value="<?php echo $row["skill_name"] ?>">
        </div>
        <input type="hidden" id="id" name="id" value="<?php echo $row["skill_id"] ?>">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html>
