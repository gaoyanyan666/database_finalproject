<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Projects</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
   <div class="container my-5">
        <h2>List of Employee Projects</h2>
        <a class="btn btn-primary" href="emp_proj_create.php" role="button">New Employee Project</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>Employee Project ID</th>
                <th>Employee ID</th>
                <th>Project ID</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connection.php';

                $sql = "SELECT * FROM employee_project";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['emp_proj_id']}</td>
                            <td>{$row['employee_id']}</td>
                            <td>{$row['project_id']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='employee_project_edit.php?emp_proj_id={$row['emp_proj_id']}'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='employee_project_delete.php?emp_proj_id={$row['emp_proj_id']}' onclick='return confirm(\"Are you sure you want to delete this employee project?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No employee projects found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
