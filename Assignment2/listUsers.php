
<!-- for admin -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>
    <h2>User Management</h2>
    <a href="createUser.php">Add New User</a>
    <a href="list.php">Back Home</a>
    <?php 
    // Database Connection
    $connect = mysqli_connect('localhost', 'root', '', 'parks');

    if (!$connect) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    // Handle delete request
    if (isset($_GET['delete_id'])) {
        $delete_id = intval($_GET['delete_id']);
        $delete_query = "DELETE FROM users WHERE id = $delete_id";
        mysqli_query($connect, $delete_query);
    }

    // Fetch user data
    $query = "SELECT * FROM users";
    $result = mysqli_query($connect, $query);

    if ($result) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Is Admin</th>
                <th>Date Added</th>
                <th>Action</th>
              </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['first']}</td>
                    <td>{$row['last']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['is_admin']}</td>
                    <td>{$row['dateAdded']}</td>
                    <td>
                        <a href='updateUser.php?id={$row['id']}'>Edit</a> | 
                        <a href='?delete_id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                    </td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "Query Failed: " . mysqli_error($connect);
    }

    mysqli_close($connect);
    ?>
    
</body>
</html>
