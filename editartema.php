<?php
	session_start();
	if ($_SESSION['tipo']==1) {
		include_once("settings/settings.inc.php");
		$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
		@mysql_select_db(SQL_DB, $conexion) or die(mysql_error());
		
		//Editar Temas
		if (isset($_GET['editar'])) {
				$id = $_GET['editar'];
				$sql_temas= "SELECT * FROM temas where id='".$_GET['editar']."';";
				$recordset1= mysql_query($sql_temas, $conexion) or die (mysql_error());
				$recordset= mysql_fetch_array($recordset1);
				$rtitulo= $recordset['titulo'];
				$rcontenido= $recordset['contenido'];
				$id_usuario=$recordset['id_usuario'];
				$rid= $recordset['id'];
		}
		else
		{
			$rtitulo= "";
			$rcontenido= "";
			$id_usuario="";
			$rid= "";
		}
		if (isset($_POST['contenido'])) {
			session_start();
			$tema = $_POST['tema']; 
			$contenido = $_POST['contenido'];
			if ($_POST['idtema'] > 0) {
				$update="UPDATE temas SET titulo='".$tema."', contenido='".$contenido."' WHERE id='".$_POST['idtema']."';";
				$cambiartema=mysql_query($update, $conexion) or die (mysql_error());
				header("location:index.php");
			}
			else{
				$conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
				$db = @mysql_select_db(SQL_DB, $conexion) or die(mysql_error());
				$sql="INSERT INTO temas (id_usuario, titulo, contenido) VALUES ('".$_SESSION['id']."', '".$tema."', '".$contenido."')";
				$registro=mysql_query($sql, $conexion);
				header("location:index.php");
			}	
		}
	}
	else {
		header('location:index.php');
	}
	 ?>
	<!DOCTYPE HTML>
	<META CHARSET="UTF-8">
	<html>
	<head>
			<title>Editar Tema</title>
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
      <form action="editartema.php" method="post" name="comentario" class="form-horizontal" role="form">
        <div class="form-group">
          <label for="txttema" class="col-sm-2 control-label">Titulo del Tema:</label>
          <div class="col-sm-7">

			<input type="hidden" name="idusr" value="<?php echo $id_usuario; ?>">
			<input type="hidden" name="idtema" value="<?php echo $id; ?>">

            <input type="text" name="tema" id="tema" class="form-control" placeholder="Titulo del blog" value="<?php echo $rtitulo; ?>">
          </div>
        </div>
        <div class="form-group">
          <label for="txtcon" class="col-sm-2 control-label">Contenido del Tema:</label>
          <div class="col-sm-7">
            <textarea class="form-control" name="contenido" id="contenido" rows="3" <?php echo $rcontenido; ?>></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-8 col-sm-10">
            <button type="submit" value="Publicar tema" class="btn btn-default">Enviar</button>
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