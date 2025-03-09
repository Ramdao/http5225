
<!-- for admin update user data -->
<?php
include('includes/database.php');
session_start();

// Check if user ID is provided
if (!isset($_GET['id'])) {
    die("Invalid request.");
}

$user_id = intval($_GET['id']);

// Fetch user data
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($connect, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}

// Handle form submission
if (isset($_POST['update'])) {
    $first = mysqli_real_escape_string($connect, $_POST['first']);
    $last = mysqli_real_escape_string($connect, $_POST['last']);
    $is_admin = mysqli_real_escape_string($connect, $_POST['is_admin']);

    // If password is provided, hash it
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET first='$first', last='$last', password='$password', is_admin='$is_admin' WHERE id=$user_id";
    } else {
        $update_query = "UPDATE users SET first='$first', last='$last', is_admin='$is_admin' WHERE id=$user_id";
    }

    if (mysqli_query($connect, $update_query)) {
        echo "<script>alert('User updated successfully!'); window.location.href = 'listUsers.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
    <a href="list.php">Back Home</a>
    <a href="index.php">Logout</a>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        <label>First Name:</label>
        <input type="text" name="first" value="<?php echo htmlspecialchars($user['first']); ?>" required>

        <label>Last Name:</label>
        <input type="text" name="last" value="<?php echo htmlspecialchars($user['last']); ?>" required>

        <label>Email:</label>
        <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>

        <label>New Password (leave blank to keep current password):</label>
        <input type="password" name="password">

        <label>Admin Status:</label>
        <select name="is_admin">
            <option value="No" <?php echo ($user['is_admin'] === 'No') ? 'selected' : ''; ?>>No</option>
            <option value="Yes" <?php echo ($user['is_admin'] === 'Yes') ? 'selected' : ''; ?>>Yes</option>
        </select>

        <button type="submit" name="update">Update User</button>
    </form>
</body>
</html>
