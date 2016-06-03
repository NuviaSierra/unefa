<?php
  require("../Clases/class.conexion.php");
  include("../Clases/class.porcentaje.php");
  $clave=explode('*',$_GET[usu]);
  $NuevoHor = new porcentaje("","","","","","","",$clave[0],"","","","","","");
  $NuevoHor->conec_BD();
  $NuevoHor->conectar_BD();
    if($_GET["Operacion"]=="BuscarDoc"){
      $NuevoHor->Buscar_Docen($_GET["valor"]);
      echo $NuevoHor->res;
    }
	else{
	  if($_GET["Operacion"]=="ListadoInfrae"){
      $NuevoHor->Listado_Infraestructura_Nucleo($_GET["valor"]);	 
      echo $NuevoHor->res;
	  }
	}
?>