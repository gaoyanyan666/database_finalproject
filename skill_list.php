<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
   <div class="container my-5">
        <h2>List of Skills</h2>
        <a class="btn btn-primary" href="skill_create.php" role="button">New Skill</a>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th>Skill ID</th>
                <th>Name</th>

                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php
                include 'db_connection.php';

                $sql = "SELECT * FROM skill";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
                        <tr>
                            <td>{$row['skill_id']}</td>
                            <td>{$row['skill_name']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='skill_edit.php?skill_id={$row['skill_id']}'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='skill_delete.php?skill_id={$row['skill_id']}' onclick='return confirm(\"Are you sure you want to delete this skill?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No skills found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
