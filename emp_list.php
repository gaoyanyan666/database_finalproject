<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
   <div class="container my-5">
        <h2>List of Employees</h2>
        <a class="btn btn-primary" href="emp_create.php" role="button">New Employee</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Hire Date</th>
                <th>Job Title</th>
                <th>Department ID</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connection.php';

                $sql = "SELECT * FROM employee";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['employee_id']}</td>
                            <td>{$row['employee_name']}</td>
                            <td>{$row['employee_email']}</td>
                            <td>{$row['hire_date']}</td>
                            <td>{$row['job_title']}</td>
                            <td>{$row['department_id']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='employee_edit.php?employee_id={$row['employee_id']}'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='employee_delete.php?employee_id={$row['employee_id']}' onclick='return confirm(\"Are you sure you want to delete this employee?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No employees found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
