<?php

$connect = mysqli_connect( 
    "localhost", // Host
    "root", // Username
    "", // Password
    "cms" // Database
);

mysqli_set_charset( $connect, 'UTF8' );
