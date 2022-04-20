<?php
	session_start();
	require 'lib/con.php';

	//preparing statement
	if(!empty($_POST)){
		if(!(empty($_POST['desc'])) && !(empty($_POST['dates']))){
			$desc = htmlspecialchars($_POST['desc']);
			$dates=htmlspecialchars($_POST['dates']);
			//$data=date("Y-m-d h:m:s", strtotime($dates));
			//completar entrada
			$sql="INSERT INTO tasks(descr,data, completed,user) VALUES (?,?,0,?)";

			try{
				$stmt=$conn->prepare($sql);
				var_dump($conn->error_list);
				$stmt->bind_param("sss",$desc,$dates,$_SESSION['id']);

				if ($stmt->execute()){
					$stmt->close();
					header('Location:list.php');
					exit;
				}else{
					header('Location:add.php');
					exit;
				}
			}catch(Exception $e){
				echo $e->message;
			}


	}
}
?>
<!DOCTYPE html>
<html lang="ca">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/entry.css">
	<title>TODO</title>
</head>
<body class="container-fluid">
	<header>
		<div class="jumbotron text-center" >
  			<h1>TODO</h1>
  			<p>Register your task <?= $_SESSION['email']; ?></p>
  		</div>
  		<nav class="navbar navbar-default">
  		<ul class="nav navbar-nav"><li class="active"><a href="list.php">Back</a></li></ul></nav>
	</header>
	<form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
		<div class="form-group">
			Descripció<input class="form-control" type="text" name="desc">
			Data<input class="form-control" type="datetime-local" name="dates">
		</div>
		<input type="submit" value="Add">
	</form>
</body>
</html>
