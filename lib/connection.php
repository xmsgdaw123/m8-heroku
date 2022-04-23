<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
//connect to DB
$conn = new mysqli($_ENV['dbhost'],$_ENV['dbuser'],$_ENV['dbpass'],$_ENV['dbname']);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}