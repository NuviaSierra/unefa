<?php
/* 
CLASE COHORTE ACADEMICO
CREADA POR: COORDINACION DE INNOVACIONES EDUCATIVAS Y TECNOLOGICAS UNEFA TÁCHIRA
ING. GRATELLY GARZA MORILLO
FECHA DE CREACIÓN: 30/01/2010
OBJETIVO: VALIDAR COHORTES ACADÉMICOS
*/


/* DECLARACIÓN DE LA CLASE */
class cohorte extends conec_BD
{
   var $nom;
   var $des;
   var $sta;
   var $cod;

  
/* FUNCIÓN CONSTRUCTORA */  
   function cohorte($co,$no,$de,$st)
   {
       $coho= new conec_BD();
		$this->conexion=$coho->conectar_BD();
		$this->cod=$co;
		$this->nom=$no;
		$this->des=$de;
		$this->sta=$st;
	}
	

function buscar_existe()
{
	$sql="select * from cohort where coh_id='$this->cod' and coh_nom='$this->nom and coh_obs='$this->des'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
		return 'true';
}
	
function guardar_cohorte()
	{
		    
		$sql="INSERT INTO cohort(coh_id, coh_nom, coh_obs) VALUES ('$this->cod', '$this->nom', '$this->des')"; 
	    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
	}
	
	
function modificar_coh($id)
{
	$sql="UPDATE cohort SET coh_nom='$this->nom', coh_obs='$this->des' where coh_id='$id'"; 
    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
}

/* FUNCIÓN PARA VISUALIZAR UN LISTADO DE LOS COHORTES EXISTENTES */  		
	function ver_coh($bus,$br)
	{
	if(($br=='1') or ($br=='') or ($br=='0'))
		$br="where coh_sta='1'";
	if($br=='2')
		$br="where coh_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql="SELECT coh_id, coh_nom, coh_obs FROM cohort $br order by coh_id desc";
	else
		$sql="SELECT coh_id, coh_nom, coh_obs FROM cohort where coh_nom like '%$bus%' and coh_sta='1' order by coh_id desc";
	
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
		{ 		
		   $HTML.='<table width="600" border="1" cellpadding="1" cellspacing="1" align="center">
			  <tr class="Encab_rep">
				<td width="50"><div align="left">Código</div></td>
				<td width="150"><div align="left">Cohortes Existentes</div></td>
				<td width="400"><div align="left">Observaciones</div></td>
			  </tr>';

		   while ($row = mysql_fetch_row($result))
		   {
			$cadena=implode('/*',$row);
			$HTML.='<tr>
				<td width="50" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')" class="Texto" align="left">'.$row[0].'</td>
				<td width="150" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')" class="Texto" align="left">'.$row[1].'</td>
				<td width="400" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')" class="Texto" align="left">'.$row[2].'</td>
				</tr>';
			}
       	  $HTML.='</table>';
		  return $HTML;
		}
		else
		return false;
	} // fin de funcion ver cohortes
function eliminar($id)
{
	$sql="UPDATE cohort SET coh_sta='0' where coh_id='$id'";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			   return true;
		else
			   return false;
	
}	
}// fin de la clase
?>