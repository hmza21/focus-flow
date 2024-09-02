<?php

# Server credentials
$host = 'localhost';
$db = 'focusflow';
$user = 'hamza';
$pass = '0619';

# XAMPP localhost credentials
// $host = 'localhost';
// $db = 'focusflow';
// $user = 'root';
// $pass = '';

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
