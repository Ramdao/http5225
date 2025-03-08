<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Record</title>
</head>
<body>
    <h2>Add New Ecological Record</h2>

    <?php
    // Connection string
    $connect = mysqli_connect('localhost', 'root', '', 'parks');

    if (!$connect) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $year = mysqli_real_escape_string($connect, $_POST['year']);
        $province = mysqli_real_escape_string($connect, $_POST['province']);
        $national_park = mysqli_real_escape_string($connect, $_POST['national_park']);
        $ecosystem = mysqli_real_escape_string($connect, $_POST['ecosystem']);
        $integrity_status = mysqli_real_escape_string($connect, $_POST['integrity_status']);
        $integrity_trend = mysqli_real_escape_string($connect, $_POST['integrity_trend']);

        // Insert query
        $query = "INSERT INTO ecological (`YEAR`, `Province or territory`, `National park`, `Ecosystem type`, `Ecological integrity status`, `Ecological integrity trend`) 
                  VALUES ('$year', '$province', '$national_park', '$ecosystem', '$integrity_status', '$integrity_trend')";

        if (mysqli_query($connect, $query)) {
            echo "<p style='color: green;'>Record added successfully.</p>";
        } else {
            echo "<p style='color: red;'>Error adding record: " . mysqli_error($connect) . "</p>";
        }
    }

    mysqli_close($connect);
    ?>

    <form action="" method="POST">
        <label>Year:</label> 
        <input type="text" name="year" required><br><br>

        <label>Province or Territory:</label> 
        <input type="text" name="province" required><br><br>

        <label>National Park:</label> 
        <input type="text" name="national_park" required><br><br>

        <label>Ecosystem Type:</label> 
        <input type="text" name="ecosystem" required><br><br>

        <label>Ecological Integrity Status:</label> 
        <input type="text" name="integrity_status" required><br><br>

        <label>Ecological Integrity Trend:</label> 
        <input type="text" name="integrity_trend" required><br><br>

        <input type="submit" value="Add Record">
    </form>

    <br>
    <a href="list.php">Back to Home</a>
</body>
</html>
