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
      <!n--<link de regreso>-->
      <table>
        <tr>
         <td align='right'><a href='index.php'>BLOG Super overpower</a></td>
        </tr>
      </table>
      <?php
      echo"<form action='nuevotema.php' method='post' name='nuevotema'><br>";
        echo "<table>";
          echo "<tr><td><b>Nuevo Tema</b></td></tr>";
          echo "<tr>";
            echo"<td><label>Tema : <input name='txttema' type='text'  id='txttema' value='' ></td>";
          echo "</tr>";
          echo "<tr>";
            echo "<td><label>Contenido : <textarea name='txtcon'></textarea></td>"; 
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
  }
  else
    header('location:index.php')
?>