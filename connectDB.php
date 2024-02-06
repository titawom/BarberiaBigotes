<?php

use Aws\DynamoDb\DynamoDbClient;

/*$credentials = new Aws\Credentials\Credentials('your-access-key-id', 'your-secret-access-key');

$dynamoDb = new DynamoDbClient([
    'region' => 'your-region',
    'version' => 'latest',
    'credentials' => $credentials
]); */

$servername = "localhost";
$username = "root";
$password = "root";

$pdo=new PDO("mysql:host=$servername;port=3306;dbname=BookStore",$username, $password);
