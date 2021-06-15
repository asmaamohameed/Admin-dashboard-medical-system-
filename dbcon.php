<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;


// FOR LINK FIREBASE WITH THE PROJECT
$factory = (new Factory)
     ->withServiceAccount('survival-project-957eb-firebase-adminsdk-xo3hf-f53a88de46.json')
     ->withDatabaseUri('https://survival-project-957eb-default-rtdb.firebaseio.com/');

// FOR CREATING THE DATABASE
$database = $factory->createDatabase();
// FOR CREATING THE LOGIN
$auth = $factory->createAuth(); 
?>
