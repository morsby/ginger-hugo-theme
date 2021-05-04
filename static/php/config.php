<?php 
# Configure the database
$db = new PDO('mysql:host=mysql51.unoeuro.com;dbname=gingerdolls_dk_db', 'gingerdolls_dk', '954jmoVSa1');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$password_hash = '$2y$10$LF41OyCJfMEH97hQ2utzruh8tsjZbC7Dw75THfRpSqP3ajFvfWGsO';
?>