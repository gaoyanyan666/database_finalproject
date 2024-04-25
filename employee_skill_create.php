<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee Skill</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Employee Skill</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="employeeID" class="form-label">Employee ID</label>
                <input type="number" class="form-control" id="employeeID" name="employeeID" required>
            </div>
            <div class="mb-3">
                <label for="skillID" class="form-label">Skill ID</label>
                <input type="number" class="form-control" id="skillID" name="skillID" required>
            </div>
            <div class="mb-3">
                <label for="proficiencyLevel" class="form-label">Proficiency Level</label>
                <input type="number" class="form-control" id="proficiencyLevel" name="proficiencyLevel" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="emp_skill_list.php" role="button">Back</a>
        </form>
    </div>

    <?php
    // Include the database connection file
    include "db_connection.php";

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $employeeID = $_POST["employeeID"];
        $skillID = $_POST["skillID"];
        $proficiencyLevel = $_POST["proficiencyLevel"];
        $description = $_POST["description"];

        // SQL insert query
        $sql = "INSERT INTO Employee_Skill (employee_id, skill_id, proficiency_level, description) 
                VALUES (?, ?, ?, ?)";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiis", $employeeID, $skillID, $proficiencyLevel, $description);

        if ($stmt->execute()) {
            // Employee skill added successfully
            echo '<div class="alert alert-success mt-3" role="alert">New employee skill added successfully.</div>';
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
