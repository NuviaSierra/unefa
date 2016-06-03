<?php
/* 
CLASE BITACORA
CREADA POR: COORDINACION DE INNOVACIONES EDUCATIVAS Y TECNOLOGICAS UNEFA TÁCHIRA
ING. GRATELLY GARZA MORILLO
FECHA DE CREACIÓN: 17/02/2010
OBJETIVO: VALIDAR BITACORA
*/


/* DECLARACIÓN DE LA CLASE */
class bitaco extends conec_BD
{
   var $ope;
   var $tab;
   var $det;

  
/* FUNCIÓN CONSTRUCTORA */  
   function bitaco($op,$ta,$pe,$ci,$ip,$de)
   {
       $bita= new conec_BD();
		$this->conexion=$bita->conectar_BD();
		$this->ope=$op;
		$this->tab=$ta;
		$this->per=$pe;
		$this->ciu=$ci;
		$this->dip=$ip;
		$this->det=$de;
   }
	
function buscar_ope_id($o)
{
	$sql="select ope_id from operac where ope_nom='$o'";
 	$result=mysql_query($sql,$this->conexion);
    $row=mysql_fetch_array($result); 
			if ($result)
			   return $row[0];
			else
			   return false;
}

function buscar_tabla($t)
{
	$sql="SELECT tab_id FROM tabla WHERE tab_nom = '$t'";
 	$result=mysql_query($sql,$this->conexion);
    $row=mysql_fetch_array($result); 
			if ($result)
			   return $row[0];
			else
			   return false;
}

function guardar_bitaco()
	{
		$fecha_hora_TS = date("Y-m-d h:i:s");    
		$sql="INSERT INTO bitaco (bit_fej, ope_id, tab_id, per_id, ci_usu, bit_ip, bit_det) VALUES ('$fecha_hora_TS','$this->ope', '$this->tab','$this->per','$this->ciu','$this->dip',upper('$this->det'))"; 
	//	echo $sql;
	    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
	}
	
function buscar_ope($per,$tab)
{	$sql="SELECT * FROM perfil_usuari WHERE ci_usu='$_SESSION[ci]' AND peu_sta='1' and per_id='$_SESSION[idoper]'";
 	$result=mysql_query($sql,$this->conexion);
	$n=mysql_num_rows($result);
	if($n>0){
	  $sql="SELECT * FROM tab_ope WHERE per_id ='$per' AND tab_id ='$tab' and tab_ope_sta='1'";
 	  $result=mysql_query($sql,$this->conexion);
	  $n=mysql_num_rows($result);
	  //echo $sql;
	  if($n>0)
		return $result;
	  else
		return 'false';
	}
	else
	  return 'false';
}	
}// fin de la clase
?>
