<?php

$servername = "localhost";
$dbname = "egeSchedule";
$username = "scheduler";
$password = "ZxcAsdQwe";

$opt = [
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
  ];

try {
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, $opt);
	    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
   		echo "Connection failed: " . $e->getMessage();
    }

$conn = null;
?>