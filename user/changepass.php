<?php
include('../connection/config.php');

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch user details
    $sql = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found";
        exit;
    }
} else {
    echo "User ID not specified";
    exit;
}

// Update password, username, and email if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['new_password'])) {
        $newPassword = $_POST['new_password'];

        // Update password in the database
        $updateSql = "UPDATE users SET password = '$newPassword' WHERE id = $userId";
        if ($conn->query($updateSql) === TRUE) {
            echo "Password updated successfully";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    }
    // Add code to update username and email if needed
}
?>

<!DOCTYPE html>
<html lang="en">

<form method="post" action="" enctype="multipart/form-data">
    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required>
    <input type="submit" value= "Update Password">
    
</form>

<form method="post" action="">
    <input type="submit" >
</form>

<p><a href="adminuser.php">Back</a></p>
</body>
</html>