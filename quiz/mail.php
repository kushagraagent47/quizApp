<?php
include_once ("socketlabs-php-master/InjectionApi/src/includes.php");
include 'db.php';
//or if using composer: include_once ('./vendor/autoload.php'); 

use Socketlabs\SocketLabsClient;
use Socketlabs\Message\BasicMessage;
use Socketlabs\Message\EmailAddress;


$client = new SocketLabsClient(30059, "Sk5d2ZPr3m9TJe8o4X7H"); //Your SocketLabs ServerId and Injection API key
 
$message = new BasicMessage(); 
$query = "SELECT * FROM users";
	$results = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($results)) {
    $email = $row['email'];
    $password = $row['password'];
    
$message->subject = "INNOWIZZ";
$message->htmlBody = '<html><body> Hey ' . $email . ' Your login id is ' . $email . ' And password is ' . $password . '"> </body></html>';
$message->plainTextBody = "This is the Plain Text Body of my message.";

$message->from = new EmailAddress("ISTE@mrits.in");

//A basic message supports up to 50 recipients and supports several different ways to add recipients
$message->addToAddress($email); //Add a To address by passing the email address
 
$response = $client->send($message);

    }
?>