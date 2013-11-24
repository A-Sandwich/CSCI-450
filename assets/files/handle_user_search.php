<?php
include "db_connect.php";
$search_string = '%'.$_GET['search'].'%';
$user_search_query = $mysqli->prepare("SELECT id, username, email FROM users WHERE email LIKE '$search_string' ");
$user_search_query->execute();
$user_search_query->bind_result($id, $username, $email);
$user_stuff = array();
$users = array();
while($user_search_query->fetch()){
	$user_stuff[0]=$id;
	$user_stuff[1]=$username;
	$user_stuff[2]=$email;
	$users[] = $user_stuff;
}
foreach($users as $u) {
	echo '<a href="#" style="text-decoration:none;">';
	foreach($u as $i) {
		echo $i . ' ';
	}
	echo '</a><br>';
}
?>