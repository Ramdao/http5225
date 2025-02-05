<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 

        // Connection string
        $connect = mysqli_connect('localhost', 'root', '', 'colors');

        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }
        
        $query = "SELECT `Name`, `Hex` FROM colors"; // Assuming 'Hex' is the column storing the hex color codes
        $result = mysqli_query($connect, $query);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $colorName = $row['Name'];
            $hexColor = $row['Hex'];
        
            echo '<div style="height: 100px; width: 100%; background-color:' . htmlspecialchars($hexColor, ENT_QUOTES) . '; display: flex; justify-content: center; align-items: center; color: white; font-size: 20px; font-weight: bold;">' . htmlspecialchars($colorName, ENT_QUOTES) . '</div>';
        }

    ?>
    
</body>
     
</html>