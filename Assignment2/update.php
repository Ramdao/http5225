
<!-- for admin update park data -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
</head>
<body>
    <h2>Update Ecological Record</h2>

  <?php
    include( 'includes/database.php' );


    if (!$connect) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    // Get the record ID from URL
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $query = "SELECT * FROM ecological WHERE id = $id";
        $result = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($result);
    }

    // Handle form submission for update
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $year = mysqli_real_escape_string($connect, $_POST['year']);
        $province = mysqli_real_escape_string($connect, $_POST['province']);
        $national_park = mysqli_real_escape_string($connect, $_POST['national_park']);
        $ecosystem = mysqli_real_escape_string($connect, $_POST['ecosystem']);
        $integrity_status = mysqli_real_escape_string($connect, $_POST['integrity_status']);
        $integrity_trend = mysqli_real_escape_string($connect, $_POST['integrity_trend']);

        // Update query
        $update_query = "UPDATE ecological 
                         SET `YEAR` = '$year', 
                             `Province or territory` = '$province', 
                             `National park` = '$national_park', 
                             `Ecosystem type` = '$ecosystem', 
                             `Ecological integrity status` = '$integrity_status', 
                             `Ecological integrity trend` = '$integrity_trend' 
                         WHERE id = $id";

        if (mysqli_query($connect, $update_query)) {
            echo "<p style='color: green;'>Record updated successfully.</p>";
            echo "<a href='list.php'>Back to Home</a>";
            exit();
        } else {
            echo "<p style='color: red;'>Error updating record: " . mysqli_error($connect) . "</p>";
        }
    }

    mysqli_close($connect);
    ?>

    <form action="" method="POST">
        <label>Year:</label> 
        <input type="text" name="year" value="<?php echo $row['YEAR']; ?>" required><br><br>

        <label>Province or Territory:</label> 
        <input type="text" name="province" value="<?php echo $row['Province or territory']; ?>" required><br><br>

        <label>National Park:</label> 
        <input type="text" name="national_park" value="<?php echo $row['National park']; ?>" required><br><br>

        <label>Ecosystem Type:</label> 
        <input type="text" name="ecosystem" value="<?php echo $row['Ecosystem type']; ?>" required><br><br>

        <label>Ecological Integrity Status:</label> 
        <input type="text" name="integrity_status" value="<?php echo $row['Ecological integrity status']; ?>" required><br><br>

        <label>Ecological Integrity Trend:</label> 
        <input type="text" name="integrity_trend" value="<?php echo $row['Ecological integrity trend']; ?>" required><br><br>

        <input type="submit" value="Update Record">
    </form>

    <br>
    <a href="list.php">Back to Home</a>
</body>
</html>
