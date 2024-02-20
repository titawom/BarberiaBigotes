<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);
require 'vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;


$dynamoDb = new DynamoDbClient([
    'region' => 'us-east-1',
    'version' => 'latest',
    'credentials' => $credentials
]); 

$result = $dynamoDb->scan([
    'ExpressionAttributeNames' => [
        '#LT' => 'location',
        '#TS' => 'timestamp',
        '#TP' => 'temperature',
        '#AQ' => 'air_quality'
    ], 
    'ProjectionExpression' => '#LT, #TS, #TP, #AQ',
    'TableName' => 'bigotes_iot_table',
]);


//$servername = "localhost";
$servername = "bookstore.choo822ssh3e.us-east-1.rds.amazonaws.com";
$username = "ubuntu";
$password = "ubuntuubuntu";
//$username = "root";
//$password = "root";

$pdo=new PDO("mysql:host=$servername;port=3306;dbname=BookStore",$username, $password);