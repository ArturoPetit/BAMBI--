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
		<div class="container">
			<!--barra de paginas-->
			<ul class="nav nav-tabs" role="tablist">
			<li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
			<li class="active"><a href="">Editar Tema</a></li>
			<li><a href="nuevotema.php">Nuevo Tema</a></li>
			<li><a href="editarusuarios.php">Editar Usuarios</a></li>
			<li><a href="cerrar.php">Salir</a></li>
			</ul>
		 <div class="row">
	      <form action="editarcomentarios.php" method="post" name="comentario" class="form-horizontal" role="form">

			<input type="hidden" name="iddecomentario" value="<?php echo $iddecomentario; ?>">

	        <div class="form-group">
	          <label for="txtcon" class="col-sm-2 control-label">Contenido del Tema:</label>
	          <div class="col-sm-7">
	            <textarea class="form-control" name="contenido" id="contenido" rows="3" <?php echo $contenido; ?>></textarea>
	          </div>
	        </div>
	        <div class="form-group">
	          <div class="col-sm-offset-8 col-sm-10">
	            <button type="submit" value="Comentar" class="btn btn-default">Enviar</button>
	          </div>
	        </div>
	        </form>
	      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>