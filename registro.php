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
   <div class="container">
    <!--barra de paginas-->
    <ul class="nav nav-tabs" role="tablist">
      <li><a href="index.php"><span class="glyphicon glyphicon-home"></span></a></li>
      <li><a href="login.php">Login</a></li>
      <li class="active"><a href="">Registro</a></li>
    </ul>

      <div class="row">
        <div class="col-md-4">
         <h4><?php echo $mensaje; ?></h4>            
        </div>
        <div class="col-md-4">
         <h3>Registro</h3>
        </div>
        <div class="col-md-4"></div>
      </div>

    <div class="row">
        <form action="registro.php" method="post" name="registro" class="form-horizontal" role="form">
          <div class="form-group">
            <label for="txtnombre" class="col-sm-3 control-label">Nombre:</label> 
            <div class="col-sm-3">
              <input type="text" name="txtnombre" id="txtnombre" class="form-control" placeholder="Nombre">
            </div>
          </div>
          <div class="form-group">
            <label for="txtusuario" class="col-sm-3 control-label">Usuario:</label> 
            <div class="col-sm-3">
              <input type="text" name="txtusuario" id="txtusuario" class="form-control" placeholder="Usuario">
            </div>
          </div>
          <div class="form-group">
            <label for="txtpass" class="col-sm-3 control-label">Password:</label>
            <div class="col-sm-3">
              <input type="password" class="form-control" name="txtpass" id="password" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-5 col-sm-10">
              <button type="submit" class="btn btn-info">Enviar</button>
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