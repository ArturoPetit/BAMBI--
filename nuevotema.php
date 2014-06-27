<?php 
#NUEVO TEMA
  session_start();
  include_once("settings/settings.inc.php");
  if (isset($_SESSION['tipo'])) {
    $tipousr = $_SESSION['tipo'];
    $idusr = $_SESSION["idusr"];
    if ($tipousr==1) {  // SOLO EL ASMINISTRADOR PUEDE HACER ESTO
        if (isset($_POST['txttema'])) {
          $tema = $_POST["txttema"];
          $contenido = $_POST["txtcon"];
          $conexion = @mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
          $db =@ mysql_select_db(SQL_DB, $conexion) or die();
          $sql="INSERT INTO temas (titulo, contenido, id_usuario) value('$tema','$contenido','$idusr')";
          $usrs=@mysql_query($sql,$conexion);
         header('location:index.php');
        }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Nuevo Tema</title>
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
        <li class="active"><a href="">Nuevo Tema</a></li>
        <li><a href="nuevotema.php">Nuevo Tema</a></li>
        <li><a href="editarusuarios.php">Editar Usuarios</a></li>
        <li><a href="cerrar.php">Salir</a></li>
      </ul>
      <div class="row">
      <form action="nuevotema.php" method="post" name="nuevotema" class="form-horizontal" role="form">
        <div class="form-group">
          <label for="txttema" class="col-sm-2 control-label">Nuevo Tema:</label>
          <div class="col-sm-7">
            <input type="text" name="txttema" id="txttema" class="form-control" placeholder="Titulo">
          </div>
        </div>
        <div class="form-group">
          <label for="txtcon" class="col-sm-2 control-label">Contenido:</label>
          <div class="col-sm-7">
            <textarea class="form-control" name="txtcon" rows="3"></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-8 col-sm-10">
            <button type="submit" class="btn btn-default">Enviar</button>
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

<?php 
    }
  }
  else
    header('location:index.php')
?>