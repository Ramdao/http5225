<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    // Function to fetch user data from the JSONPlaceholder API
    function getUsers() {
        $url = "https://jsonplaceholder.typicode.com/users";
        $data = file_get_contents($url);
        return json_decode($data, true);
        }
        // Get the list of users
        $users = getUsers();
        for ($i = 0; $i < count($users); $i++) {
            echo "Name: " . $users[$i]['name'] . "<br>";
            echo "Username: " . $users[$i]['username'] . "<br>";
            echo 'Email: <a href="mailto:' . $users[$i]['email'] . '">' . $users[$i]['email'] . '</a><br>';
            echo "Street: " . $users[$i]['address']['street'] . "<br>";
            echo "City: " . $users[$i]['address']['city'] . "<br>";
            echo "Suite: " . $users[$i]['address']['suite'] . "<br>";
            echo "Zipcode: " . $users[$i]['address']['zipcode'] . "<br>";
        
            $lat = $users[$i]['address']['geo']['lat'];
            $lng = $users[$i]['address']['geo']['lng'];
        
            // Uncomment if you want to show latitude and longitude
            // echo "Latitude: " . $lat . "<br>";
            // echo "Longitude: " . $lng . "<br>";
        
            // Uncomment if you want to display a map image
            // $osm_url = "https://static-maps.yandex.ru/1.x/?ll=$lng,$lat&size=400,400&z=14&l=map&pt=$lng,$lat,pm2rdl";
            // echo "Location Map:<br>";
            // echo "<img src='$osm_url' alt='Location Map'>";
        
            echo "<hr>";
        }
            

        ?>
        
      
        
?>
</body>
</html>