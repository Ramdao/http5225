
<!-- for admin -->
<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php"); // Redirect to login if not logged in
    exit();
}

include('includes/database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecological Data</title>
</head>
<body>
    <h2>Ecological Data</h2>
    <p>Welcome, <?php echo $_SESSION['email']; ?>!</p>
    <a href="add.php">Add New Record</a>
    <a href="listUsers.php">Users table</a>
    <a href="logout.php">Logout</a> 

    <?php 
    // Handle delete request
    if (isset($_GET['delete_id'])) {
        $delete_id = intval($_GET['delete_id']);
        $delete_query = "DELETE FROM ecological WHERE id = $delete_id";
        mysqli_query($connect, $delete_query);
    }

    // Fetch data
    $query = "SELECT * FROM ecological";
    $result = mysqli_query($connect, $query);

    if ($result) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>
                <th>YEAR</th>
                <th>Province or Territory</th>
                <th>National Park</th>
                <th>Ecosystem Type</th>
                <th>Ecological Integrity Status</th>
                <th>Ecological Integrity Trend</th>
                <th>Action</th>
            </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['YEAR']}</td>
                    <td>{$row['Province or territory']}</td>
                    <td>{$row['National park']}</td>
                    <td>{$row['Ecosystem type']}</td>
                    <td>{$row['Ecological integrity status']}</td>
                    <td>{$row['Ecological integrity trend']}</td>
                    <td>
                        <a href='update.php?id={$row['id']}'>Edit</a> | 
                        <a href='?delete_id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
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
