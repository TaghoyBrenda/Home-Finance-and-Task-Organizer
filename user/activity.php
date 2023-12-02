<?php
include("../connection/config.php");
include("../sidebar.php");

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user activity (replace with your actual activity logic)
    $activity = "User activity for user $userId";

} else {
    echo "User ID not specified";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Activity</title>
</head>
<body>

<h2>User Activity</h2>

<p><?php echo $activity; ?></p>

<p><a href="adminuser.php">Back</a></p>

</body>
</html>
