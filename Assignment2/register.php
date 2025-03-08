<?php
include('includes/database.php');
session_start();

if (isset($_POST['register'])) {
    // Securely get form data
    $first = mysqli_real_escape_string($connect, $_POST['first']);
    $last = mysqli_real_escape_string($connect, $_POST['last']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = md5($_POST['password']); 

    $is_admin = 'No'; // Default to 'No'
    $dateadded = date('Y-m-d H:i:s'); // Current timestamp

    // Insert into database
    $query = "INSERT INTO users (first, last, email, password, is_admin, dateAdded) 
              VALUES ('$first', '$last', '$email', '$password', '$is_admin', '$dateadded')";
    
    if (mysqli_query($connect, $query)) {
        $_SESSION['success'] = "Registration successful! You can now log in.";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Error: " . mysqli_error($connect);
        header("Location: register.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
</head>
<body>
    <?php if (isset($_SESSION['error'])) { ?>
        <script>alert("<?php echo $_SESSION['error']; ?>");</script>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>
    
    <form method="POST" action="register.php">
        <label>First Name:</label>
        <input type="text" name="first" required>

        <label>Last Name:</label>
        <input type="text" name="last" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <!-- Hidden Fields -->
        <input type="hidden" name="is_admin" value="No">
        <input type="hidden" name="dateAdded" value="<?php echo date('Y-m-d H:i:s'); ?>">

        <button type="submit" name="register">Register</button>
    </form>
</body>
</html>
