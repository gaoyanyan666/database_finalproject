<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
   <div class="container my-5">
        <h2>List of Departments</h2>
        <a class="btn btn-primary" href="dep_create.php" role="button">New Department</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>Department ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection script
                include 'db_connection.php';

                // SQL query to retrieve departments
                $sql = "SELECT * FROM department";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['department_id']}</td>
                            <td>{$row['department_name']}</td>
                            <td>{$row['department_location']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='dep_edit.php?department_id={$row['department_id']}'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='dep_delete.php?department_id={$row['department_id']}' onclick='return confirm(\"Are you sure you want to delete this department?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No departments found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
