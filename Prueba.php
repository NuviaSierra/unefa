<?php
  require("Clases/class.conexion.php");
  include("Clases/class.usuario.php");
  $Usu = new usuario("","","","");
  $Usu->conec_BD();
  $Usu->conectar_BD();
  if($_GET["Operacion"]=="Consultar"){
    $row=$Usu->Asignar_Perfil_Usu($_GET["valor"]);
    echo $row;
  }
  else
    $Usu->Limpiar($_GET["valor"]);
?>