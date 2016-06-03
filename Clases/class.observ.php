<?php
/* 

CLASE OBSERVACIONESS
CREADA POR: COORDINACION DE INNOVACIONES EDUCATIVAS Y TECNOLOGICAS UNEFA TÁCHIRA
ING. GRATELLY GARZA MORILLO/Ing. Victor E. Gutierrez C.
FECHA DE CREACIÓN: 10/02/2010
OBJETIVO: OBSERVACIONES UTILIZADAS EN LA INSCRIPCIONES
*/

/* DECLARACIÓN DE LA CLASE */
class proces extends conec_BD
{
   var $des;
   var $sta;
   var $cod;

  
  
/* FUNCIÓN CONSTRUCTORA */  
   function proces($co,$no,$st)
   {
       $proc= new conec_BD();
		$this->conexion=$proc->conectar_BD();
		$this->cod=$co;
		$this->des=$no;
		$this->sta=$st;
	}
	

	
function buscar_existe()
{
	$sql="select * from observ where obs_id='$this->cod' and obs_des='$this->des'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
		return 'true';
}
	
function guardar_proces()
	{
		$sql="INSERT INTO observ (obs_id, obs_des) VALUES (upper('$this->cod'), upper('$this->des'))"; 
	    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
	}
	
	
function modificar_pro($id)
{
	$sql="UPDATE observ SET obs_des=upper('$this->des') where obs_id='$id'"; 
    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
}


/* FUNCIÓN PARA VISUALIZAR UN LISTADO DE LOS TIPOS DE PROCESOS EXISTENTES */  		
	function ver_pro($bus,$br,$pag)
{
	$reg=$br;//linea a agregar

	if (!$pag) //if a agregar
	{ 
    	$inicio=0; 
    	$pag=1; 
	} 
	else
	{ 
    	$inicio = ($pag - 1) * 5; 
    } 
	//fin de codigo para paginar
	if(($br=='1') or ($br=='') or ($br=='0'))
		$br="where obs_sta='1'";
	if($br=='2')
		$br="where obs_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql1="SELECT obs_id, obs_des FROM observ $br order by obs_id desc";
	else
		$sql1="SELECT obs_id, obs_des FROM observ where obs_des like '%$bus%' and obs_sta='1' order by obs_id desc";
	//Agregar	
		$result1=mysql_query($sql1,$this->conexion);
		$num_total_registros = mysql_num_rows($result1);
		$cant_pag=ceil($num_total_registros/5); 	
		mysql_free_result($result1); 
	   $br=$reg;
	///////
	
	if(($br=='1') or ($br=='') or ($br=='0'))
		$br="where obs_sta='1'";
	if($br=='2')
		$br="where obs_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql="SELECT obs_id, obs_des FROM observ $br order by obs_id desc limit ".$inicio.","."5";
	else
		$sql="SELECT obs_id, obs_des FROM observ where obs_des like '%$bus%' and obs_sta='1' order by obs_id desc limit ".$inicio.","."5"; 
	
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
		{ 		
		   $HTML.='<table width="550" border="1" cellpadding="1" cellspacing="1" align="center" bgcolor="#FFFFFF">
			  <tr bgcolor="#000066" class="Estilo22">
				<td width="50"><div align="left">Código</div></td>
				<td width="500"><div align="left">Descripción</div></td>

			  </tr>';

			  
		   while ($row = mysql_fetch_row($result))
		   {
			$cadena=implode('/*',$row);
			$HTML.='<tr>
				<td width="50" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')" class="Texto" align="left">'.$row[0].'</td>
				<td width="500" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')" class="Texto" align="left">'.$row[1].'</td>

				</tr>';
			}
		//agregar
			 $HTML.='<tr>
			  <td align="center" id="imp" colspan="3"><span class="Etiqueta">Total de Registros: '.$num_total_registros.'</span></td></tr></table>';
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
							$HTML.=" <a href='observ.php?pagina=".$i."**".$reg."'>" .$i. "</a>";}
      			}
				$HTML.='</div>';
			  }
			//fin de codigo para paginar
		  return $HTML;
		}
		else
		return false;
	} 	

function eliminar($id)
{
	$sql="UPDATE observ SET obs_sta='0' where obs_id='$id'";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			   return true;
		else
			   return false;
	
}
  function Listado_proces()
  {
		$sql="SELECT * FROM observ WHERE obs_sta='1' order by obs_des";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			  return $result;
		else
			  return 'false';
  }	
}// fin de la clase
?>