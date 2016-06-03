<?php
  require("../Clases/class.conexion.php");
  include("../Clases/class.carg_dept_emp.php");
  $NuevoCde = new carg_dept_emp("","","","","","","");
  $NuevoCde->conec_BD();
  $NuevoCde->conectar_BD();
  switch($_GET["Operacion"]){
    case "Consultar1":
    $NuevoCde->infrae($_GET["valor"]);
    echo $NuevoCde->res;
	break;
	
	case "Consultar2":
    $NuevoCde->cargo($_GET["valor"]);
    echo $NuevoCde->res;
	break;
	
	case "Consultar3":
    $NuevoCde->depart($_GET["valor"]);
    echo $NuevoCde->res;
	break;
  }
?>