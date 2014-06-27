<?php
#LOGIN
  $mensaje = "  Bienvenido! ";
  if (isset($_GET["error"])) {
    $error=$_GET ["error"];
    if ($error <> ""){
      switch ($error) {
        case '1':
          $mensaje= "El usuario no existe!";
          break;
        case '2':
          $mensaje= "La contrasea no existe!";
          break;  
        case '3':
          $mensaje= "Debe logearse para poder entrar!";
          break;  
        case '4':
          $mensaje= "Se ha registrado correctamente como categoria NOOB  , gracias. Ahora debe logearse para poder usar el blog ";
          break;            
      }
    }
  } else {
    $error ="";
  }
?>

<!DOCTYPE html>
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
        <li class="active"><a href="">Login</a></li>
        <li><a href="registro.php">Registro</a></li>
      </ul>

      <div class="row">
        <div class="col-md-4">
         <h4><?php echo $mensaje; ?></h4>            
        </div>
        <div class="col-md-4">
         <h3>Inicio de Sesion</h3>
        </div>
        <div class="col-md-4"></div>
      </div>

    <div class="row">
        <form action="validarlogin.php" method="post" name="login" class="form-horizontal" role="form">
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