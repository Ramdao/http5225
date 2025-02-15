<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Pokemon Card Collection Table</h1>
    <?php 
        // Connection string
        $connect = mysqli_connect('localhost', 'root', '', 'pokemon');

        if (!$connect) {
            die("Connection Failed: " . mysqli_connect_error());
        }

        // Query to select card details
        $query = "SELECT `Card Name`, `Set`, `Generation`, `PSA10 Value(USD)`, `Image URL` FROM pokemon_cards";
        $result = mysqli_query($connect, $query);

        if ($result) {
            // Start table
            echo "<table border='1' cellpadding='10' cellspacing='0'>";
            echo "<tr>
                    <th>Card Name</th>
                    <th>Set</th>
                    <th>Generation</th>
                    <th>PSA10 Value (USD)</th>
                    <th>Image</th>
                </tr>";

            // Loop through results and populate table rows
            while ($row = mysqli_fetch_assoc($result)) {
                $psa_value = (float) $row['PSA10 Value(USD)']; // Ensure it's a number

                // Apply color based on value
                $color_class = '';
                if ($psa_value >= 10000) {
                    $color_class = 'orangered';
                } elseif ($psa_value >= 1000) {
                    $color_class = 'yellow';
                }

                echo "<tr>
                        <td>{$row['Card Name']}</td>
                        <td>{$row['Set']}</td>
                        <td>{$row['Generation']}</td>
                        <td class='$color_class'>\${$row['PSA10 Value(USD)']}</td>
                        <td><img src='{$row['Image URL']}' alt='Pokemon Card' width='100'></td>
                    </tr>";
            }

            echo "</table>"; // End table
        } else {
            echo "Query Failed: " . mysqli_error($connect);
        }

        // Close the connection
        mysqli_close($connect);
        ?>
</body>
</html>