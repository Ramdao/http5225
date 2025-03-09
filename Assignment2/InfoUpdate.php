<?php
session_start();
include('includes/database.php');

if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

$user_id = $_GET['id'] ?? $_SESSION['id']; 
$is_admin = $_SESSION['is_admin'] === 'Yes';

if (!$is_admin && $_SESSION['id'] != $user_id) {
    die("Unauthorized access.");
}

// Fetch user data
$query = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first = mysqli_real_escape_string($connect, $_POST['first']);
    $last = mysqli_real_escape_string($connect, $_POST['last']);
    $password = !empty($_POST['password']) ? md5($_POST['password']) : $user['password'];
    $is_admin = $is_admin ? $_POST['is_admin'] : $user['is_admin']; // Only admins can update is_admin

    $update_query = "UPDATE users SET first=?, last=?, password=?, is_admin=? WHERE id=?";
    $stmt = mysqli_prepare($connect, $update_query);
    mysqli_stmt_bind_param($stmt, "ssssi", $first, $last, $password, $is_admin, $user_id);
    mysqli_stmt_execute($stmt);

    // Update session variables after successful update
    $_SESSION['first'] = $first;
    $_SESSION['last'] = $last;

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>
    <a href="dashboard.php">Back to Users</a>
    
    <form method="POST">
        <label>First Name:</label>
        <input type="text" name="first" value="<?php echo htmlspecialchars($user['first']); ?>" required>

        <label>Last Name:</label>
        <input type="text" name="last" value="<?php echo htmlspecialchars($user['last']); ?>" required>

        <label>Email:</label>
        <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>

        <label>New Password (leave blank to keep current password):</label>
        <input type="password" name="password">

        <?php if ($is_admin) { ?>
            <label>Admin Status:</label>
            <select name="is_admin">
                <option value="No" <?php echo ($user['is_admin'] === 'No') ? 'selected' : ''; ?>>No</option>
                <option value="Yes" <?php echo ($user['is_admin'] === 'Yes') ? 'selected' : ''; ?>>Yes</option>
            </select>
        <?php } ?>

        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
