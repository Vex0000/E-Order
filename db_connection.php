<?php

require 'vendor/autoload.php'; 

$uri = "mongodb+srv://<username>:<password>@cluster0.mongodb.net/<dbname>?retryWrites=true&w=majority";  
$client = new MongoDB\Client($uri); 

$db = $client->eorder;  

$collection = $db->eorder; 

echo "Connected to MongoDB successfully!";

?>
