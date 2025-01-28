<!doctype html>
<html>
    <head>
        <title>PHP If Statements</title> 
    </head>
    <body>

        <h1>PHP If Statements</h1> 

        <p>Use PHP echo and variables to output the following link information, use if statements to make sure everything outputs correctly:</p>

        <?php

        // **************************************************
        // Do not edit this code

        // Generate a random number (1, 2, or 3)
        $randomNumber = ceil(rand(1,3));

        // Display the random number
        echo '<p>The random number is '.$randomNumber.'.</p>';

        // Based on the random number PHP will define four variables and fill them with information about Codecademy, W3Schools, or MDN
        
        // The random number is 1, so use Codecademy
        if ($randomNumber == 1)
        {

            $linkName = 'Codecademy';
            $linkURL = 'https://www.codecademy.com/';
            $linkImage = '';
            $linkDescription = 'Learn to code interactively, for free.';

        }

        // The random number is 2, so use W3Schools
        elseif ($randomNumber == 2)
        {

            $linkName = '';
            $linkURL = 'https://www.w3schools.com/';
            $linkImage = 'w3schools.png';
            $linkDescription = 'W3Schools is optimized for learning, testing, and training.';

        }

        // The random number is 3, so use MDN
        else
        {

            $linkName = 'Mozilla Developer Network';
            $linkURL = 'https://www.codecademy.com/';
            $linkImage = 'mozilla.png';
            $linkDescription = 'The Mozilla Developer Network (MDN) provides information about Open Web technologies.';

        }

        // **************************************************

        // Beginning of the exercise, place all of your PHP code here
        // Upload this page (or use your localhost) and refresh the page, the h2 below will change
        
        if($linkName === ""){
          echo '<h2>'.$linkURL.'</h2>';
          echo '<a href= "'. $linkURL . '">'. $linkURL . '</a>';
          echo '<img src="'. $linkImage .'"/>';
        } else if($linkImage === ""){
          echo '<h2>'.$linkURL.'</h2>';
          echo '<a href= "'. $linkURL . '">'. $linkURL . '</a>';
        }
        else{
          echo '<h2>'.$linkURL.'</h2>';
          echo '<a href= "'. $linkURL . '">'. $linkName . '</a>';
          echo '<img src="'. $linkImage .'"/>';
        }

        
        
        


        ?>

        <hr>
        <h1> Challange 1 </h1>

        <?php 
        
        $hour = ceil(rand(1,24));
        echo $hour;

        if ($hour > 5 && $hour < 9 ){
          echo '<p> Breakfast: "Bananas, Apples, and Oats" </p>';
        } else if ($hour > 12 && $hour <14){
          echo '<p> Lunch: "Fish, Chicken, and Vegetables" </p>';
        } else if ($hour> 19 && $hour<21){
          echo '<p> Dinner: "Steak, Carrots, and Broccoli" </p>';
        } else {
          echo '<p> Not fed </p>';

        }

        

        
        
        ?>

        <h1> Challange 2 </h1>

        <?php

           $rand = ceil(rand(1,100));
           echo $rand;

           if ($rand % 3 == 0 && $rand % 5 == 0){
            echo ' FizzBuzz';
           } else if ($rand % 3 == 0){
            echo " Fizz";
           } else if ($rand % 5 == 0) {
            echo ' Buzz';
           }
          

        ?>
      
    </body>
</html>