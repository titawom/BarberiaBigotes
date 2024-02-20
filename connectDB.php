<?php

//object(Aws\Result)#101 (1) { ["data":"Aws\Result":private]=> array(4) { ["Items"]=> array(3) { [0]=> array(3) { ["location"]=> array(1) { ["S"]=> string(9) "Barcelona" } ["air_quality"]=> array(1) { ["N"]=> string(2) "79" } ["timestamp"]=> array(1) { ["N"]=> string(10) "1707383293" } } [1]=> array(3) { ["location"]=> array(1) { ["S"]=> string(7) "Sevilla" } ["air_quality"]=> array(1) { ["N"]=> string(2) "61" } ["timestamp"]=> array(1) { ["N"]=> string(10) "1707383293" } } [2]=> array(3) { ["location"]=> array(1) { ["S"]=> string(6) "Madrid" } ["air_quality"]=> array(1) { ["N"]=> string(2) "81" } ["timestamp"]=> array(1) { ["N"]=> string(10) "1707383293" } } } ["Count"]=> int(3) ["ScannedCount"]=> int(3) ["@metadata"]=> array(4) { ["statusCode"]=> int(200) ["effectiveUri"]=> string(40) "https://dynamodb.us-east-1.amazonaws.com/" ["headers"]=> array(7) { ["server"]=> string(6) "Server" ["date"]=> string(29) "Mon, 19 Feb 2024 11:12:32 GMT" ["content-type"]=> string(26) "application/x-amz-json-1.0" ["content-length"]=> string(3) "294" ["connection"]=> string(5) "close" ["x-amzn-requestid"]=> string(52) "7IEIC5V1SFCDB8FQKTSV4151RJVV4KQNSO5AEMVJF66Q9ASUAAJG" ["x-amz-crc32"]=> string(10) "1994467687" } ["transferStats"]=> array(1) { ["http"]=> array(1) { [0]=> array(0) { } } } } } }
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);
require 'vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;

$data = 'object(Aws\Result)#101 (1) { ["data":"Aws\Result":private]=> array(4) { ["Items"]=> array(3) { [0]=> array(3) { ["location"]=> array(1) { ["S"]=> string(9) "Barcelona" } ["air_quality"]=> array(1) { ["N"]=> string(2) "79" } ["timestamp"]=> array(1) { ["N"]=> string(10) "1707383293" } } [1]=> array(3) { ["location"]=> array(1) { ["S"]=> string(7) "Sevilla" } ["air_quality"]=> array(1) { ["N"]=> string(2) "61" } ["timestamp"]=> array(1) { ["N"]=> string(10) "1707383293" } } [2]=> array(3) { ["location"]=> array(1) { ["S"]=> string(6) "Madrid" } ["air_quality"]=> array(1) { ["N"]=> string(2) "81" } ["timestamp"]=> array(1) { ["N"]=> string(10) "1707383293" } } } ["Count"]=> int(3) ["ScannedCount"]=> int(3) ["@metadata"]=> array(4) { ["statusCode"]=> int(200) ["effectiveUri"]=> string(40) "https://dynamodb.us-east-1.amazonaws.com/" ["headers"]=> array(7) { ["server"]=> string(6) "Server" ["date"]=> string(29) "Mon, 19 Feb 2024 11:12:32 GMT" ["content-type"]=> string(26) "application/x-amz-json-1.0" ["content-length"]=> string(3) "294" ["connection"]=> string(5) "close" ["x-amzn-requestid"]=> string(52) "7IEIC5V1SFCDB8FQKTSV4151RJVV4KQNSO5AEMVJF66Q9ASUAAJG" ["x-amz-crc32"]=> string(10) "1994467687" } ["transferStats"]=> array(1) { ["http"]=> array(1) { [0]=> array(0) { } } } } } }';
//$credentials = new Aws\Credentials\Credentials('AKIAVRUVPLSAN5IGHVVN', '7WGKhW6mDTm3xW7BuwE2hjo8MHsQv3RGcdgkYvaS');

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