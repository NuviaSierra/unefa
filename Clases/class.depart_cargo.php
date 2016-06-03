<?php
/* 
CLASE 	DEPARTAMENTO & CARGOS
CREADA POR: COORDINACION DE INNOVACIONES EDUCATIVAS Y TECNOLOGICAS UNEFA TÁCHIRA
ING. GRATELLY GARZA MORILLO
FECHA DE CREACIÓN: 27/02/2011
OBJETIVO: VALIDAR DEPARTAMENTO &CARGOS
*/


/* DECLARACIÓN DE LA CLASE */
class depcar extends conec_BD
{
   var $idd;
   var $idc;
  
/* FUNCIÓN CONSTRUCTORA */  
   function depcar($id,$ic)
   {
       $depc= new conec_BD();
		$this->conexion=$depc->conectar_BD();
		$this->idd=$id;
		$this->idc=$ic;
	}
	

function buscar_existe()
{
	$sql="select * from depart_cargo where depa_id='$this->idd' and car_id='$this->idc'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
		return 'true';
}
	
function guardar_depcar()
	{
		    
		$sql="INSERT INTO depart_cargo (depa_id, car_id) VALUES ('$this->idd', '$this->idc')"; 
	    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
	}
	
	
function modificar_depc($depa,$cara)
{
	$sql="UPDATE depart_cargo SET depa_id='$this->idd', car_id='$this->idc' where depa_id='$depa' and car_id='$cara'"; 
    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
}

/* FUNCIÓN PARA VISUALIZAR UN LISTADO DE LOS DEPARTAMENTOS Y CARGOS EXISTENTES */  		

function ver_depcar($pag,$i)
{
	if (!$pag) //if a agregar
	{ 
    	$inicio=0; 
    	$pag=1; 
	} 
	else
	{ 
    	$inicio = ($pag - 1) * 10; 
    } 
	//fin de codigo para paginar
	
	if ($i=='0' || $i=='')
			$a='';
		else
	     	$a="and depart_cargo.depa_id = '$i'";
			
		$sql1="SELECT depart_cargo.depa_id, depart_cargo.car_id, depa_nom, car_nom FROM depart,cargo, depart_cargo where 
		depart_cargo.depa_id= depart.depa_id and depart_cargo.car_id=cargo.car_id $a order by depa_nom";

	//Agregar	
		$result1=mysql_query($sql1,$this->conexion);
		$num_total_registros = mysql_num_rows($result1);
		$cant_pag=ceil($num_total_registros/10); 	
		mysql_free_result($result1); 
	///////
	if ($i=='0')
			$a='';
		else
	     	$a="and depart_cargo.depa_id = '$i'";
			
		$sql="SELECT depart_cargo.depa_id, depart_cargo.car_id, depa_nom, car_nom FROM depart,cargo, depart_cargo where 
		depart_cargo.depa_id= depart.depa_id and depart_cargo.car_id=cargo.car_id $a order by depa_nom limit ".$inicio.","."10";

		$result=mysql_query($sql,$this->conexion);
		if ($result) 
		{ 		
		   $HTML.='<table width="600" border="1" cellpadding="1" cellspacing="1" align="center" bgcolor="#FFFFFF">
			  <tr bgcolor="#000066" class="Estilo22">
				<td width="300"><div align="left">Departamento</div></td>
				<td width="300"><div align="left">Cargo</div></td>
			  </tr>';
		   while ($row = mysql_fetch_row($result))
		   {
			$cadena=implode('/*',$row);
			$HTML.='<tr>
				<td width="300" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')" align="left">'.$row[2].'</td>
				<td width="300" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')" align="left">'.$row[3].'</td>
				</tr>';
			}
			//agregar
			 $HTML.='<tr>
			  <td align="center" id="imp" colspan="2"><span class="Etiqueta">Total de Registros: '.$num_total_registros.'</span></td></tr></table>';
		 //codigo para paginar 
		  if ($cant_pag > 1)
			  { $HTML.='<div align="center">';
    			for ($i=1;$i<=$cant_pag;$i++)
				{ 
       				if ($pag == $i) 
          				//si muestro el índice de la página actual, no coloco enlace 
          				$HTML.=$pag . " ";
       				else 
          				//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 
          				{	
							$HTML.=" <a href='depart_cargo.php?pagina=".$i."'>" .$i. "</a>";}
      			}
				$HTML.='</div>';
			  }
			//fin de codigo para paginar
		  return $HTML;
		}
		else
		return false;
	} // fin de funcion ver Departamentos
function eliminar($dep, $car)
{
	$sql="DELETE FROM depart_cargo where depa_id='$dep' and car_id='$car'";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			   return true;
		else
			   return false;
	
}
  function Listado_depart_cargo()
  {
		$sql="SELECT depa_nom, car_nom FROM depart,cargo, depart_cargo where 
		depart_cargo.depa_id= depart.depa_id and depart_cargo.car_id=cargo.car_id order by depa_nom, car_nom";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			  return $result;
		else
			  return 'false';
  }	
}// fin de la clase
?>

