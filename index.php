<?php
#index
  session_start();
  include_once("settings/settings.inc.php");
  if (isset($_SESSION['tipo']))
      $tipo = $_SESSION['tipo'];
  else
      $tipo = 0;
  
  if (isset($_GET['eliminartema'])){
    $conexion = @mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
    $db =@ mysql_select_db(SQL_DB, $conexion) or die();
    $sql="DELETE FROM temas WHERE id ='".$_GET['eliminartema']."'";
    $eliminartema=@mysql_query($sql,$conexion);
  }
   if (isset($_GET['eliminarcomentario'])){
    $conexion = @mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
    $db =@ mysql_select_db(SQL_DB, $conexion) or die();
    $sql="DELETE FROM comentarios WHERE id ='".$_GET['eliminarcomentario']."'";
    $eliminarcomentario=@mysql_query($sql,$conexion);
  }
?>
<!DOCTYPE html>
<META CHARSET="UTF-8">
<html>
  <head>
    <title>Blog de German y Petit </title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <srcript src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <?php 
        echo "<table>";
        echo "<tr>";
        if (isset($_SESSION["nombre"])){
          echo "<td coldspan =4><p align='right'>Hola-".$_SESSION["nombre"];
          echo "<a href='cerrar.php'>--|Salir|--</a>";
          #otra celda
          if($tipo==1){
            echo "<a href='nuevotema.php'>--|New Tema|--</a>"; 
            echo "<a href='editarusuarios.php'>--|Edit User|--</a></p></td>";
            echo "</tr>";
          }
        }
        else{
          echo "<tr>";
          echo "<td coldspan =4><p align='right'><a href='login.php'>Iniciar Sesion|</a>"; 
          echo "<a href='registro.php'>|Registarse|</a></p></td>";
          echo "</tr>";
         }
        echo "</table>";
      ?>  
      <h1>BLOG Super overpower</h1>
      <?php
        $conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
        $db =@mysql_select_db(SQL_DB, $conexion) or die(mysql_error());
        $sql="select temas.*, usuarios.nombre from temas, usuarios where temas.id_usuario = usuarios.id order by id desc";
        $temas=@mysql_query($sql,$conexion);
        echo "<table>";
        while  ($tema =@mysql_fetch_array($temas)){
        echo "<tr>";
        echo"<td><h1>".$tema['titulo']."</h1></td>"; 
        echo"<td><h5>".$tema['fecha_pub']."</h5></td>";
        echo"<td><h3>".$tema['nombre']."</h3></td>";
        echo"</tr>";
        echo "<tr>";
        echo "<td>".$tema['contenido']."</td>";
        echo "</tr>";
        echo "<tr>";
          if ($tipo==1) {
          echo "<td><a href='editartema.php?editar=".$tema['id']."'>Editar Tema</a></td>";
          #sql DELETE
          echo"<td><a href='index.php?eliminartema=".$tema['id']."'>Eliminar Tema</a></td>";
           }
        echo "<td><a href='like.php'>|Like|</a></p></td>";
        echo "</tr>";
        $sql1  = "SELECT comentarios.*, usuarios.nombre from comentarios, temas, usuarios " . 
        "where comentarios.id_usuario = usuarios.id and comentarios.id_tema = temas.id and comentarios.id_tema =". $tema['id'];
        $comentarios = mysql_query($sql1,$conexion);
        while ($comentario=@mysql_fetch_array($comentarios)){
          echo "<tr>";  
          echo"<td><h3 align='left'>".$comentario['nombre']."</h3></td>";
          echo"<td><h5 align='center'>".$comentario['fecha_pub']."</h5></td>";
          echo"</tr>";
          echo"<tr>";
          echo"<td>".$comentario['comentario']."</td>";
            if ($tipo==1 OR $tipo==2){
              echo "<td><a href='editarcomentarios.php?contenido=".$comentario['id']."'>Editar Comentario</a></td>";
              #sql DELETE
              echo"<td><a href='index.php?eliminarcomentario=".$comentario['id']."'>Eliminar Comentario</a></td>";
            } 
              echo "</tr>";  
        }
        echo "<tr>";  
        echo "<td> <a href='nuevocomentario.php?id_tema=".$tema['id']."'>Agregar Comentario</a></td>";
        echo "</tr>";  
        }
        echo "</table>";
        @mysql_close($conexion);
      ?>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>