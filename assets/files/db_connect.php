<?php
define("HOST", "localhost"); // The host you want to connect to.
define("USER", "novusgar_db"); // The database username.
define("PASSWORD", "wedontsuck=false"); // The database password. 
define("DATABASE", "novusgar_database"); // The database name.

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE)or die('Could not connect: ' . mysql_error());