<?php
	include 'lib/con.php';



	if(!empty($_POST)){
		if(!empty($_POST['email']) && !empty($_POST['passw'])){

			$email = htmlspecialchars($_POST['email']);
			$passw=htmlspecialchars($_POST['passw']);

			// comprovar BD

			$sql1="SELECT * FROM users";
			$sql="SELECT id FROM users WHERE email = ? AND  passw = ?";
			try{
			$stmt = $conn->prepare($sql);

			$stmt->bind_param("ss",$email,$passw);

			$stmt->execute();

			//extract $id from user
			$stmt->bind_result($id);

			$stmt->store_result();
			$nrow=$stmt->num_rows;

			$stmt->fetch();

			$stmt->close();
			}catch(Exception $e){
				echo $e->message;
			}
			if($nrow==1){
				//$registers=$res->fetch_array();
				$_SESSION['email']=$email;
				$_SESSION['id']=$id;
				setcookie('email',$email,time()+1800,'/todo','');
				//redirect
				header('Location: /todo/list.php',true,303);
				exit;
				}
				else{
					//redirect
					header('Location:.',true,303);
					exit;
				}
				//
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
<body>

	<div class="container-fluid">
	<header>
		<div class="jumbotron text-center" >
  			<h1>TODO</h1>
  			<p>GEt your list, complete your tasks!</p>
  		</div>
	</header>
	<nav class="navbar navbar-default">
		<ul class="nav navbar-nav">
			<li class="active"><a href="register.php">Sign up</a></li>
		</ul>
	</nav>
		<form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
			<div class="formgroup">
			<label for"email">Email:</label>
			<input type="text" name="email"
			value="<?php
				if (isset($_COOKIE['email'])){
					echo $_COOKIE['email'];
				}
			 ?>" class="form-control">
			<label for="passw">Password</label><input type="password" name="passw" class="form-control">
			<input type="submit" value="Sign in">
			</div>
		</form>
	</div>

</body>
</html>
