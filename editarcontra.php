<?php
  include_once("settings/settings.inc.php");
  $conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
  $db = @mysql_select_db(SQL_DB, $conexion) or die(mysql_error());
  session_start();
  if (isset($_SESSION['tipo'])) {
    if ($_SESSION['tipo']==1) {
      if (isset($_POST['contra'])) {
      $idcontra=$_POST['contraid'];
        if (isset($_SESSION["idusr"])) {
        $spl1="UPDATE usuarios SET password='".$_POST['contra']."' WHERE id='".$_POST['contraid']."';";
        $editcontra=mysql_query($spl1, $conexion) or die (mysql_error());
        header("location:editarusuarios.php");
        }
      }
      if (isset($_GET['contra'])) {
        $idcontra=$_GET['contra'];
        $conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
        @mysql_select_db(SQL_DB, $conexion) or die(mysql_error());
        $sql2= "SELECT * FROM usuarios where id='".$idcontra."';";
        $rs_pass= mysql_query($sql2, $conexion) or die (mysql_error());
        $rs_contra= mysql_fetch_array($rs_pass);
        $contra=$rs_contra['password'];
        $contraid=$rs_contra['id'];
      }
      else {
      $contra="";
      $contraid=0;
      }
    }
  }
 ?>
<!DOCTYPE HTML>
<META CHARSET="UTF-8">
<html>
  <head>
<title>Fix it</title></head>
    <!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
  <body>

   <div class="container">
      <!--barra de paginas-->
      <ul class="nav nav-tabs" role="tablist">
        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
        <li class="active"><a href="">Cambiar Contraseña</a></li>
         <li><a href="nuevotema.php">Nuevo Tema</a></li>
        <li><a href="editarusuarios.php">Editar Usuarios</a></li>
        <li><a href="cerrar.php">Salir</a></li>
      </ul>
      <div class="row">
      <form action="editarcontra.php" method="post" name="password" class="form-horizontal" role="form">
        <div class="form-group">
          <label for="txtcon" class="col-sm-3 control-label">Contraseña Pasada:</label>
          <div class="col-sm-2">
            <input type="hidden" name="contraid" value="<?php echo $contraid; ?>">
            <input type="text" name="contra" id="contra" class="form-control" value="<?php echo $contra; ?>">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-5">
            <button type="submit" value="Areglar" class="btn btn-default">Enviar</button>
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