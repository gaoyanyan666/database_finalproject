<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
   <div class="container my-5">
        <h2>List of Projects</h2>
        <a class="btn btn-primary" href="proj_create.php" role="button">New Project</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>Project ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connection.php';

                $sql = "SELECT * FROM project";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['project_id']}</td>
                            <td>{$row['project_name']}</td>
                            <td>{$row['project_description']}</td>
                            <td>{$row['start_date']}</td>
                            <td>{$row['end_date']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='project_edit.php?project_id={$row['project_id']}'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='project_delete.php?project_id={$row['project_id']}' onclick='return confirm(\"Are you sure you want to delete this project?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No projects found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
