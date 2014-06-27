<!DOCTYPE HTML>
<META CHARSET="UTF-8">
<html>
  <head>
    <title>Control de usuario</title>
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
      <?php 
      #CONTROL DE USUARIOS
        session_start();
        include_once("settings/settings.inc.php");
        if (isset($_SESSION['tipo'])) 
        {
          if ($_SESSION['tipo']==1) {
            ?>
            <!--barra de paginas-->
            <ul class="nav nav-tabs" role="tablist">
              <li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
              <li><a href="nuevotema.php">Nuevo Tema</a></li>
              <li class="active"><a href="">Editar Usuario</a></li>
              <li><a href="cerrar.php">Salir</a></li>
            </ul>

            <?php
            if (isset($_GET['idel']))
            {
              $conexion = @mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
              $db =@ mysql_select_db(SQL_DB, $conexion) or die(); 
              $sql="DELETE FROM usuarios WHERE id ='".$_GET['idel']."'";
              $usrs=@mysql_query($sql,$conexion);
            }
            if (isset($_GET['idus']))
            {
              $conexion = @mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
              $db =@ mysql_select_db(SQL_DB, $conexion) or die();
              $sql="UPDATE usuarios SET `tipo`='".$_GET['tipo']."' WHERE id='".$_GET['idus']."';";
              $usrs=@mysql_query($sql,$conexion);
            }
            
          $conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
          $db =@ mysql_select_db(SQL_DB, $conexion) or die();
          $sql="SELECT * FROM usuarios;";
          $usrs=@mysql_query($sql,$conexion);
          ?>

          <?php
          echo "<table class='table table-bordered' class='table table-hover'>";
          echo "<tr><td><b>Nombre</b></td><td><b>Usuario</b></td><td><b>Tipo</b></td><td colspan='3'><b>Acciones</b></td></tr>";
          while  ($user =@mysql_fetch_array($usrs))
          {
            echo "<tr>";
              echo"<td>".$user['nombre']."</td>"; 
              echo"<td>".$user['usuarios']."</td>";
              echo"<td>".$user['tipo']."</td>";
              echo"<td><a href='editarusuarios.php?idus=".$user['id']."&tipo=1'>Administrador</a> | <a href='editarusuarios.php?idus=".$user['id']."&tipo=2'>Editor</a> | <a href='editarusuarios.php?idus=".$user['id']."&tipo=3'>Registrado</a></td>";
              echo"<td><a href='editarusuarios.php?idel=".$user['id']."'>Delete User</a></td>";
              echo"<td><a href='editarcontra.php?idcontra=".$user['id']."'>Change Password User</a></td>";
            echo"</tr>";
          }
          echo "</table>";
          }
        }
        else {
          header('location:index.php');   
        }
      ?>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>