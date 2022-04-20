<?php
	session_start();
	include 'lib/con.php';

	//preparing statement
	$stmt=$conn->prepare("UPDATE tasks SET completed=1 WHERE user=? AND id=?");
	$stmt->bind_param("ii",$_SESSION['id'],$_GET['task']);
	$stmt->execute();
	$stmt->close();
	header('Location:list.php');
	exit;
