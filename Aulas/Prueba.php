<?php
  require("../Clases/class.conexion.php");
  include("../Clases/class.aula.php");
  $NuevoAul = new aula("","","","","");
  $NuevoAul->conec_BD();
  $NuevoAul->conectar_BD();
    if($_GET["Operacion"]=="ListadoEstudiante"){
      $NuevoAul->Buscar_Estudi($_GET["valor"]);
      echo $NuevoAul->res;
    }
	else{
	  if($_GET["Operacion"]=="ListadoInfrae"){
      $NuevoAul->Listado_Infraestructura_Nucleo($_GET["valor"]);	 
      echo $NuevoAul->res;
	  }
	}
?>