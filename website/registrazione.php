<?php 
include_once("include/config.php");

$user=$_POST['user'];

if($user['password'] == $user['password_confirmation']) if(addUser($user['username'],$user['email'],
$user['password'], $user['mac'])){
	mailto($user['email']);
	    header("Refresh: 5;URL=login.php");
}
else{
	
	header("location:login.php");
	}
	
	?>
	
