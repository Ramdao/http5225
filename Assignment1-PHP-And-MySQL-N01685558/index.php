<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<h1>Pokemon Card Collection</h1>
<?php 
    // Connection string
    $connect = mysqli_connect('localhost', 'u674708469_ramdao', 'PokeBase1234', 'u674708469_pokemon');

    if (!$connect) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    // Query to select card details and join with generations table
    $query = "SELECT 
                pc.`Card Name`, 
                pc.`Set`, 
                g.`Generation Name`,
                pc.`Generation`,
                pc.`PSA10 Value(USD)`, 
                pc.`Image URL`
              FROM pokemon_cards pc
              JOIN generations g ON pc.`Set` = g.`Generation Name`";

    $result = mysqli_query($connect, $query);

    if ($result) {
        // Start table
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>
                <th>Card Name</th>
                <th>Generation</th>
                <th>Set</th>
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

            // Make Set clickable and link to generation_info.php with 'generation' parameter
            echo "<tr>
                    <td>{$row['Card Name']}</td>
                    <td>{$row['Generation']}</td>
                    <td><a href='generation_info.php?generation=" . urlencode($row['Set']) . "'>{$row['Set']}</a></td>
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
