<?php

try {
	$pdo = new PDO('mysql:host=HOST NAME GOES HERE;dbname=DATABASE NAME GOES HERE', 'USERNAME GOES HERE', 'PASSWORD GOES HERE');
} catch (PDOException $e) {
	exit('There was a database error.');
}