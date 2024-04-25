<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
   <div class="container my-5">
        <h2>List of Trainings</h2>
        <a class="btn btn-primary" href="training_create.php" role="button">New Training</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>Training ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Duration (hours)</th>
                <th>Employee ID</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connection.php';

                $sql = "SELECT * FROM training";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['training_id']}</td>
                            <td>{$row['training_name']}</td>
                            <td>{$row['training_description']}</td>
                            <td>{$row['training_date']}</td>
                            <td>{$row['duration_hours']}</td>
                            <td>{$row['employee_id']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='training_edit.php?training_id={$row['training_id']}'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='training_delete.php?training_id={$row['training_id']}' onclick='return confirm(\"Are you sure you want to delete this training?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No trainings found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
