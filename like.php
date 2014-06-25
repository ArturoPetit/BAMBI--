<?php
#ME GUSTA
  session_start();
  include_once("settings/settings.inc.php");
  $conexion=@mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
  $db = @mysql_select_db(SQL_DB, $conexion) or die(mysql_error());
  if (isset($_SESSION["idusr"])) {
    if (isset($_GET['id_megusta'])) {
    $megusta=$_GET['id_megusta'];
    $conexion = mysql_connect(SQL_HOST, SQL_USER, SQL_PWD);
    $DB = mysql_select_db(SQL_DB, $conexion) or die();
    $sql_like = "SELECT megusta FROM megusta where id='".$megusta."';";
    $rs_like = @mysql_query($sql_like, $conexion) or die(mysql_error());
    $total_megusta = @mysql_num_rows($rs_like);
    $total_megusta= mysql_fetch_array($rs_like);
    $id_megusta=$total_megusta['plus'];
    $idlike=$total_megusta['id'];
      if (total_megusta==0) {
      $update="INSERT INTO `megusta`(`id_usuarios`, `id_tema`, `megusta`) VALUES ('$idusr','".$id_tema."','1')";
      $editarcomentario=mysql_query($update, $conexion) or die (mysql_error());
      header("location:index.php");
      } 
    }
  }
  else {
  $id_megusta="";
  $idlike=0;
  }
?>