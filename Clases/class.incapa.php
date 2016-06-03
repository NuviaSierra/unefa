<?php
/* 

CLASE INCAPACIDADES MOTORAS
CREADA POR: COORDINACION DE INNOVACIONES EDUCATIVAS Y TECNOLOGICAS UNEFA TÁCHIRA
ING. GRATELLY GARZA MORILLO
FECHA DE CREACIÓN: 04/02/2010
OBJETIVO: VALIDAR INCAPACIDADES MOTORAS
*/


/* DECLARACIÓN DE LA CLASE */
class incapa extends conec_BD
{
   var $nom;
   var $des;
   var $sta;
   var $cod;

  
/* FUNCIÓN CONSTRUCTORA */  
   function incapa($co,$no,$de,$st)
   {
       $inca= new conec_BD();
		$this->conexion=$inca->conectar_BD();
		$this->cod=$co;
		$this->nom=$no;
		$this->des=$de;
		$this->sta=$st;
	}
	

function buscar_existe()
{
	$sql="select * from incapa where inc_id='$this->cod' and inc_nom='$this->nom' and inc_des='$this->des'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
		return 'true';
}
	
function guardar_inca()
	{
		    
		$sql="INSERT INTO incapa (inc_id, inc_nom, inc_des) VALUES (upper('$this->cod'), upper('$this->nom'), upper('$this->des'))"; 
	    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
	}
	
	
function modificar_inc($id)
{
	$sql="UPDATE incapa SET inc_nom=upper('$this->nom'), inc_des=upper('$this->des') where inc_id='$id'"; 
    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
}


/* FUNCIÓN PARA VISUALIZAR UN LISTADO DE LOS COMPONENTE MILITAR EXISTENTES */  
function ver_inc($bus,$br,$pag)
{
	$reg=$br;//linea a agregar

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
	if(($br=='1') or ($br=='') or ($br=='0'))
		$br="where inc_sta='1'";
	if($br=='2')
		$br="where inc_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql1="SELECT inc_id, inc_nom, inc_des FROM incapa $br order by inc_nom";
	else
		$sql1="SELECT inc_id, inc_nom, inc_des FROM incapa where inc_nom like '%$bus%' and inc_sta='1' order by inc_nom";
	//Agregar	
		$result1=mysql_query($sql1,$this->conexion);
		$num_total_registros = mysql_num_rows($result1);
		$cant_pag=ceil($num_total_registros/10); 	
		mysql_free_result($result1); 
	   $br=$reg;
	///////
	if(($br=='1') or ($br=='') or ($br=='0'))
		$br="where inc_sta='1'";
	if($br=='2')
		$br="where inc_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql="SELECT inc_id, inc_nom, inc_des FROM incapa $br order by inc_nom limit ".$inicio.","."10";
	else
		$sql="SELECT inc_id, inc_nom, inc_des FROM incapa where inc_nom like '%$bus%' and inc_sta='1' order by inc_nom limit ".$inicio.","."10";
	
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
		{ 		
		   $HTML.='<table width="600" border="1" cellpadding="1" cellspacing="1" align="center" bgcolor="#FFFFFF">
			  <tr bgcolor="#000066" class="Estilo22">
				<td width="50"><div align="left">Código</div></td>
				<td width="350"><div align="left">Nombre</div></td>
				<td width="200"><div align="left">Descripción</div></td>
			  </tr>';
		   while ($row = mysql_fetch_row($result))
		   {
			$cadena=implode('/*',$row);
			$HTML.='<tr>
				<td width="50" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$row[0].'</td>
				<td width="350" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$row[1].'</td>
				<td width="200" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">-'.$row[2].'</td>
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
							$HTML.=" <a href='incapa.php?pagina=".$i."**".$reg."'>" .$i. "</a>";}
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
	$sql="UPDATE incapa SET inc_sta='0' where inc_id='$id'";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			   return true;
		else
			   return false;
	
}
  function Listado_incapa()
  {
		$sql="SELECT * FROM incapa WHERE inc_sta='1' order by inc_nom";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			  return $result;
		else
			  return 'false';
  }	

}// fin de la clase
?>