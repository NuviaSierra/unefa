<?php
  require("../Clases/class.conexion.php");
  include("../Clases/class.cambio_reingreso.php");
  $NuevoCamb = new camb("","","","","","","");
  $NuevoCamb->conec_BD();
  $NuevoCamb->conectar_BD();
  switch($_GET["Operacion"]){
    case "Consultar1":
       $NuevoCamb->Buscar_Campos1($_GET["valor"],$_GET["cual"]);
       echo $NuevoCamb->res;
	   break;
	case "Consultar2":
       $NuevoCamb->Buscar_Campos2($_GET["valor"],$_GET["cual"]);
       echo $NuevoCamb->res;
	   break;
	case "Consultar3":
       $NuevoCamb->Buscar_Campos3($_GET["valor"],$_GET["cual"]);
       echo $NuevoCamb->res;
	   break;
	case "Consultar4":
       $NuevoCamb->Buscar_Campos4($_GET["valor"],$_GET["cual"]);
       echo $NuevoCamb->res;
	   break;
	case "Consultar5":
	   $NuevoCamb->Buscar_Campos5($_GET["valor"],$_GET["cual"]);
       echo $NuevoCamb->res;
	   break;
	case "Consultar6":
       $NuevoCamb->Buscar_Campos6($_GET["valor"],$_GET["cual"]);
	   echo $NuevoCamb->res;
	   break;
	case "Consultar7":
       $NuevoCamb->Buscar_Campos7($_GET["valor"],$_GET["cual"]);
       echo $NuevoCamb->res;
	   break;
	 case "Consultar8":
       $NuevoCamb->Buscar_Campos8($_GET["valor"],$_GET["cual"]);
	   echo $NuevoCamb->res;
	   break;  
	 case "Consultar9":
       $NuevoCamb->Buscar_Campos9($_GET["valor"],$_GET["cual"]);
	   echo $NuevoCamb->res;
	   break;  
	 case "Consultar10":
	   $NuevoCamb->Buscar_Campos10($_GET["valor"],$_GET["cual"]);
	   echo $NuevoCamb->res;
	   break;
  }
?>