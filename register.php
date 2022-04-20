<?php
	session_start();
	include 'lib/con.php';
	//preparing statement
	if(!empty($_POST)){
		if(!(empty($_POST['email'])) && !(empty($_POST['passw']))){
			$email = htmlspecialchars($_POST['email']);
			$passw=htmlspecialchars($_POST['passw']);
			$passw2=htmlspecialchars($_POST['passw']);
			//completar entrada
			if($passw==$passw2){
				$sql="INSERT INTO users(email,passw) values(?,?)";

				$stmt=$conn->prepare($sql);
				$stmt->bind_param("ss",$email,$passw);
				if ($stmt->execute()){
					$stmt->close();
					header('Location:entry.php');
					exit;
				}
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
  			<p>Register your user</p>
  		</div>
  		<nav class="navbar navbar-default">
  		<ul class="nav navbar-nav"><li class="active"><a href="entry.php">Home</a></li></ul></nav>
	</header>
	<form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
		<div class="form-group">
			Email<input class="form-control" type="text" name="email">
			Password<input class="form-control" type="password" name="passw">
			Repeat password<input class="form-control" type="password" name="passw2">
		</div>
		<input type="submit" value="Sign up">
	</form>
</body>
</html>
