<?php
	session_start();
	include 'lib/con.php';

	//preparing statement
	$stmt=$conn->prepare("DELETE FROM tasks WHERE id=?");
	$stmt->bind_param("i",$_GET['task']);
	$stmt->execute();
	$stmt->close();
	header('Location:list.php');
