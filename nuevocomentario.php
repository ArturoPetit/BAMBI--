<?php 
#NUEVO COMENTARIO
  session_start();
  include_once("settings/settings.inc.php");
  if (isset($_GET['id_tema'])) 
    $id_tema=$_GET['id_tema'];
  else
    $id_tema="";
  
  if (isset($_SESSION['tipo'])) {
    $idusr = $_SESSION["idusr"];
    if (isset($_POST['txtcomen'])) {
      $comentario = $_POST["txtcomen"];
      $id_tema=$_POST['id_tema'];
      $conexion = @mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
      $db =@ mysql_select_db(SQL_DB, $conexion) or die();
      $sql="INSERT INTO comentarios (comentario, id_tema, id_usuario) value('$comentario','".$id_tema."','$idusr')";
      $usrs=@mysql_query($sql,$conexion);
     header('location:index.php');
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Nuevo Comentario</title>
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
    echo"<form action='nuevocomentario.php' method='post' name='nuevocomentario'><br>";
    echo "<table>";
    echo "<tr><td><b>Nuevo Comentario</b></td></tr>";

    echo "<tr>";
    echo "<tr><td><input type='hidden' value='".$id_tema."' name='id_tema'></td></tr>";
    echo "</tr>";
    echo "<tr>";
    echo "<td><label>Comentario : <textarea name='txtcomen'></textarea></td>"; 
    echo "</tr>";
    echo "<tr>";
    echo "<tr><td><input type='submit' value='Enviar'></td></tr>";
    echo "</tr>";
    echo "</table>";
    echo "</form>";
    ?>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php 
    }
  else
    header('location:index.php')
?>