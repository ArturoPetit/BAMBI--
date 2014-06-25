<?php
#VALIDAR LOGIN
$usuarios = $_POST["txtusuario"];
$password = $_POST["txtpass"];
include_once("settings/settings.inc.php");
$conexion= mysql_connect (SQL_HOST,SQL_USER,SQL_PWD);
$db=mysql_select_db(SQL_DB,$conexion) or die (MySQL_error());
$sql_usuarios = "select * from usuarios where usuarios = '$usuarios'";
$rs_usuarios = mysql_query($sql_usuarios, $conexion) or die(mysql_error());
$total_usuarios = mysql_num_rows($rs_usuarios);
if($total_usuarios==1) {
  $row_usuarios = mysql_fetch_array($rs_usuarios);
  if($row_usuarios["password"] == $password) {
    session_start();
    $t = getdate();
      $fecha = date("Y-m-d" , $t[0]);
    $_SESSION["idusr"] = $row_usuarios["id"];
    $_SESSION["usuarios"] = $row_usuarios["usuarios"];
    $_SESSION["nombre"] = $row_usuarios ["nombre"];
    $_SESSION["tipo"] = $row_usuarios ["tipo"];
    $_SESSION["fecha"] = $fecha;
    header("location:index.php");
  } else { 
    header("location:login.php?error=2");
  }
}
else {
  header("location:login.php?error=1"); 
}
?>