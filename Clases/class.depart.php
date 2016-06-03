<?php
/* 
CLASE 	DEPARTAMENTO
CREADA POR: COORDINACION DE INNOVACIONES EDUCATIVAS Y TECNOLOGICAS UNEFA TÁCHIRA
ING. GRATELLY GARZA MORILLO
FECHA DE CREACIÓN: 08/02/2010
OBJETIVO: VALIDAR DEPARTAMENTO
*/


/* DECLARACIÓN DE LA CLASE */
class depart extends conec_BD
{
   var $nom;
   var $des;
   var $sta;
   var $cod;
   var $tip;
  
/* FUNCIÓN CONSTRUCTORA */  
   function depart($co,$no,$de,$st,$tp)
   {
       $depa= new conec_BD();
		$this->conexion=$depa->conectar_BD();
		$this->cod=$co;
		$this->nom=$no;
		$this->des=$de;
		$this->sta=$st;
		$this->tip=$tp;
	}
	

function buscar_existe()
{
	$sql="select * from depart where depa_id='$this->cod' and depa_nom='$this->nom' and depa_des='$this->des'  and depa_tip='$this->tip'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
		return 'true';
}
	
function guardar_depart()
	{
		    
		$sql="INSERT INTO depart (depa_id, depa_nom, depa_des, depa_tip) VALUES (upper('$this->cod'), upper('$this->nom'), upper('$this->des'), upper('$this->tip'))"; 
	    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
	}
	
	
function modificar_dep($id)
{
	$sql="UPDATE depart SET depa_nom=upper('$this->nom'), depa_des=upper('$this->des'), depa_tip=upper('$this->tip') where depa_id='$id'"; 
    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
}

/* FUNCIÓN PARA VISUALIZAR UN LISTADO DE LOS DEPARTAMENTOS EXISTENTES */  		

function ver_dep($bus,$br,$pag)
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
		$br="where depa_sta='1'";
	if($br=='2')
		$br="where depa_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql1="SELECT depa_id, depa_nom, depa_des, depa_tip FROM depart $br order by depa_nom";
	else
		$sql1="SELECT depa_id, depa_nom, depa_des, depa_tip FROM depart where depa_nom like '%$bus%' and depa_sta='1' order by depa_nom";
	//Agregar	
		$result1=mysql_query($sql1,$this->conexion);
		$num_total_registros = mysql_num_rows($result1);
		$cant_pag=ceil($num_total_registros/10); 	
		mysql_free_result($result1); 
	   $br=$reg;
	///////
	if(($br=='1') or ($br=='') or ($br=='0'))
		$br="where depa_sta='1'";
	if($br=='2')
		$br="where depa_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql="SELECT depa_id, depa_nom, depa_des, depa_tip FROM depart $br order by depa_nom limit ".$inicio.","."10";
	else
		$sql="SELECT depa_id, depa_nom, depa_des, depa_tip FROM depart where depa_nom like '%$bus%' and depa_sta='1' order by depa_nom limit ".$inicio.","."10";
	
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
							$HTML.=" <a href='depart.php?pagina=".$i."**".$reg."'>" .$i. "</a>";}
      			}
				$HTML.='</div>';
			  }
			//fin de codigo para paginar
		  return $HTML;
		}
		else
		return false;
	} // fin de funcion ver Departamentos
function eliminar($id)
{
	$sql="UPDATE depart SET depa_sta='0' where depa_id='$id'";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			   return true;
		else
			   return false;
	
}
  function Listado_depart()
  {
		$sql="SELECT depa_nom,depa_des,IF( depa_tip = '1', 'Académico', 'Administrativo') FROM depart WHERE depa_sta='1' order by depa_nom";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			  return $result;
		else
			  return 'false';
  }	
  
     	function combo_dep()
	{
	   	$sql="SELECT depa_id, depa_nom from depart where depa_sta='1' order by depa_nom";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
		{
		   $HTML='';
		   while ($row = mysql_fetch_row($result))
		   {
			$HTML.='<option value="'.$row[0].'">'.$row[1].'</option>';
			}
		  return $HTML;
		}
		else
		return false;
	} 
  
  
}// fin de la clase
?>
