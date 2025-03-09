<?php
include('includes/database.php');
session_start();

if (isset($_POST['register'])) { // Match the name attribute of the button
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

    // Execute the query
    if( mysqli_query($connect, $query)){
        header("Location: listUsers.php");
    };
      
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <a href="listUsers.php">Back to User list</a>
</head>
<body>
    <?php if (isset($_SESSION['error'])) { ?>
        <script>alert("<?php echo $_SESSION['error']; ?>");</script>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>

    <?php if (isset($_SESSION['success'])) { ?>
        <script>alert("<?php echo $_SESSION['success']; ?>");</script>
        <?php unset($_SESSION['success']); ?>
    <?php } ?>

    <form method="POST" action="createUser.php">
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

        <button type="submit" name="register">Create</button>
    </form>
</body>
</html>
