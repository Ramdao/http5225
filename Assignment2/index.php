<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="register.php">Add New User</a>
<?php 
session_start();
include('includes/database.php');

if (isset($_POST['email'])) {
    // Secure query to prevent SQL Injection
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result)) {
        $record = mysqli_fetch_assoc($result);

        // Store user details in session
        $_SESSION['id'] = $record['id'];
        $_SESSION['email'] = $record['email'];
        $_SESSION['is_admin'] = $record['is_admin']; // Assuming 'is_admin' column exists

        // Redirect based on admin status
        if ($record['is_admin'] === 'Yes') {
            header('Location: list.php'); // Redirect to admin page
        } else {
            header('Location: dashboard.php'); // Redirect to user page
        }
        exit();
    } else {
        $_SESSION['error'] = "Invalid email or password!";
        header('Location: index.php'); // Redirect back to login page
        exit();
    }
}
?>

<div style="max-width: 400px; margin:auto">

  <form method="post">

    <label for="email">Email:</label>
    <input type="text" name="email" id="email">

    <br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password">

    <br>

    <input type="submit" value="Login">

  </form>
  
</div>

    
</body>
</html>