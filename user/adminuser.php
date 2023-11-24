<?php
include('../connection/config.php');

// Fetch all users
$sql = "SELECT id, username, email FROM user";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>



<h2>User</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td><a href='profile.php?id=" . urlencode($row['id']) . "'>Profile</a> | <a href='activity.php?id=" . urlencode($row['id']) . "'>Activity</a> | <a href='settings.php?id=" . urlencode($row['id']) . "'>Settings</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No users found</td></tr>";
    }
    ?>

</table>

</body>
</html>
