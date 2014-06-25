<?php
	include_once("settings/settings.inc.php");
	$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
	$db = @mysql_select_db(SQL_DB, $conexion) or die(mysql_error());
		session_start();
	if (isset($_POST['contenido'])) {
		$idcomentario=$_POST['iddecomentario'];
		if (isset($_SESSION["idusr"])) {
					$update="UPDATE comentarios SET comentario='".$_POST['contenido']."' WHERE id='".$_POST['iddecomentario']."';";
					$editarcomentario=mysql_query($update, $conexion) or die (mysql_error());
					header("location:index.php");
				}
			}
			
	
	//Editar un Cometario
	if (isset($_GET['contenido'])) {
		$idcomentario=$_GET['contenido'];
		$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
		@mysql_select_db(SQL_DB, $conexion) or die(mysql_error());
		$sql_editar= "SELECT * FROM comentarios where id='".$idcomentario."';";
		$editarcom1= mysql_query($sql_editar, $conexion) or die (mysql_error());
		$editarcom= mysql_fetch_array($editarcom1);
		$contenido=$editarcom['comentario'];
		$iddecomentario=$editarcom['id'];
	}
	else {
		$contenido="";
		$iddecomentario=0;
	}
 ?>
<!DOCTYPE HTML>
<META CHARSET="UTF-8">
<html>
	<head>
		<title>editar comentario</title>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<form action="editarcomentarios.php" method="POST" name="comentario">	
		<table>			
			<tr><td>Editar comentario</td></tr>
				<tr><td><input type="hidden" name="iddecomentario" value="<?php echo $iddecomentario; ?>"></td></tr>
				<tr><td><textarea name="contenido" id="contenido" cols="70" rows="3" placeholder="Presiona para insertar tu texto o contenido"><?php echo $contenido; ?></textarea></td></tr>
				<tr><td align="center"><input type="submit" value="Comentar"></td></tr>
			</table>
		</form>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
	</body>
</html>
<form action="">