<?php

// $host = 'sql100.infinityfree.com';
// $db = 'if0_37197927_focusflow';
// $user = 'if0_37197927';
// $pass = 'hNcC5h7vxJUdX';

$host = 'localhost';
$db = 'focusflow';
$user = 'root';
$pass = '';

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);