<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Skills</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
   <div class="container my-5">
        <h2>List of Employee Skills</h2>
        <a class="btn btn-primary" href="employee_skill_create.php" role="button">New Employee Skill</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>Employee Skill ID</th>
                <th>Employee ID</th>
                <th>Skill ID</th>
                <th>Proficiency Level</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connection.php';

                $sql = "SELECT * FROM employee_skill";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['emp_skill_id']}</td>
                            <td>{$row['employee_id']}</td>
                            <td>{$row['skill_id']}</td>
                            <td>{$row['proficiency_level']}</td>
                            <td>{$row['description']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='employee_skill_edit.php?emp_skill_id={$row['emp_skill_id']}'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='employee_skill_delete.php?emp_skill_id={$row['emp_skill_id']}' onclick='return confirm(\"Are you sure you want to delete this employee skill?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No employee skills found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
