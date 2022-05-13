<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<style type="text/css">
	.dvcenter{
    height:auto; 
    margin:0 auto; 
    margin-top: 250px;
    border:1px solid blue;
	}

	.form{
	    border:1px solid red;
	    width:30%; 
	    margin:0 auto;
	    text-align: center;
	}
</style>
<body>
<br>
	<div class="dvcenter">
		<form class="form" method="POST" action="checklogin.php">
			<h3>Usuario: </h3>
			<input type="number" name="user">
			
			<h3>Contraseña: </h3>
			<input type="password" name="password">
			<br><br>
			<button type="submit">Ingresar</button>
		</form>
	</div>
</body>
</html>