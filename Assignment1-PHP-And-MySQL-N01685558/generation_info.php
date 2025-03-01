<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generation Info</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>


    <h1>Generation Information</h1>

    <?php
    // Database connection
    $connect = mysqli_connect('localhost', 'u674708469_ramdao', 'PokeBase1234', 'u674708469_pokemon');

    if (!$connect) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    if (isset($_GET['generation'])) {
        // Get the 'generation' parameter from the URL
        $generation_name = mysqli_real_escape_string($connect, $_GET['generation']);

        // Query to get generation info from the 'generations' table based on the set name (generation)
        $query = "SELECT * FROM generations WHERE `Generation Name` = '$generation_name'";
        $result = mysqli_query($connect, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            echo "<h2>{$row['Generation Name']}</h2>";
            echo "<p><strong>Start Year:</strong> {$row['Start Year']}</p>";
            echo "<p><strong>End Year:</strong> {$row['End Year']}</p>";
            echo "<p><strong>Key Features:</strong> {$row['Key Features']}</p>";
            echo "<p><strong>Popular Cards:</strong> {$row['Popular Cards (5)']}</p>";
            
            // If there are related cards to show, display them in a table
            echo "<table>";
            echo "<tr><th>Card Name</th><th>Image</th></tr>";
            
            // Example query to fetch cards related to this generation
            $card_query = "SELECT `Card Name`, `Image URL` FROM pokemon_cards WHERE `Set` = '{$row['Generation Name']}'";
            $card_result = mysqli_query($connect, $card_query);

            while ($card = mysqli_fetch_assoc($card_result)) {
                echo "<tr>
                        <td>{$card['Card Name']}</td>
                        <td><img src='{$card['Image URL']}' alt='Pokemon Card'></td>
                    </tr>";
            }
            
            echo "</table>";

        } else {
            echo "<p>No information found for this generation.</p>";
        }
    } else {
        echo "<p>No generation selected.</p>";
    }

    mysqli_close($connect);
    ?>

    <a href="index.php">Back to Card Collection</a>


</body>
</html>
