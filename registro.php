<?php
  $mensaje = "Registrate we ";
  if (isset($_POST['txtpass'])) {
    $usuario = $_POST['txtusuario'];
    $password = $_POST['txtpass'];
    $nombre = $_POST['txtnombre'];
    if (strlen($usuario)==0 OR strlen($password)==0 OR strlen($nombre)==0) {
      $mensaje = "defina bien los datos...";  
    }
    else{
      include_once("settings/settings.inc.php");
      $conexion = mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
      $DB = mysql_select_db(SQL_DB, $conexion) or die();
      $sql_usuarios = "SELECT * FROM usuarios WHERE usuarios ='.$usuarios.'";
      $rs_usuarios = mysql_query($sql_usuarios, $conexion) or die(mysql_error());
      $total_usuarios = mysql_num_rows($rs_usuarios);
      if($total_usuarios==0){
        $sql_agregar= "INSERT INTO usuarios (nombre, usuarios, password, tipo) VALUES ('".$nombre."', '".$usuario."', '".$password."', '3');";
        $rs_agregar = mysql_query($sql_agregar, $conexion) or die(mysql_error());         
        header("location:login.php?error=4"); 
        if (isset($_GET["error"])) {
          $error=$_GET ["error"];
          if ($error <> ""){
            switch ($error) {
              case '1':
                $mensaje= "Su registro no se pudo completar correctamente =S, tenemos a los monos trabajando";
                break;
              header("location:registro.php?error=1");  
            }
          }       
        }
      }
        else {
          $error ="";
        }
    }
  }
?>
<!DOCTYPE html>
<META CHARSET="UTF-8">
<html>
  <head>
    <title>Inicio de sesion</title>
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
    <table border='0' width=90% align='center'>
        <tr>
        <td align='right'><a href='index.php'>BLOG Super overpower</a></td>
        </tr>
        </table>
    <table border="1"> 
      <form action="registro.php" method="post" name="registro"><br>
        <tr><td><h2>Registro<h2></td></tr> 
        <tr><td><?php echo $mensaje; ?></td><tr>    
        <tr><td><label>usuario<input name="txtusuario" type="text"  id="txtusuario" value="" ></td></tr>
        <tr><td><label>nombre<input name="txtnombre" type="text" id="txtnombre" value="" ></td></tr>
        <tr><td><label>password<input name="txtpass" type="password" id="password"  value=""></td></tr>
        <tr><td><input type="submit" value="Enviar"> </td></tr>
      </form> 
    </table>
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>