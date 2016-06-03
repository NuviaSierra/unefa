<?php
/* 
CLASE Pais
CREADA POR: COORDINACION DE INNOVACIONES EDUCATIVAS Y TECNOLOGICAS UNEFA TÁCHIRA
ING. GRATELLY GARZA MORILLO
FECHA DE CREACIÓN: 02/02/2010
OBJETIVO: VALIDAR COMPONENTE MILITAR
*/


/* DECLARACIÓN DE LA CLASE */
class pais extends conec_BD
{
   var $nom;
   var $des;
   var $sta;
   var $cod;
   var $nac;
	
  
/* FUNCIÓN CONSTRUCTORA */  
   function pais($co,$no,$de,$st,$na)
   {
       $pai= new conec_BD();
		$this->conexion=$pai->conectar_BD();
		$this->cod=$co;
		$this->nom=$no;
		$this->des=$de;
		$this->sta=$st;
        $this->nac=$na;
	}
	

function buscar_existe()
{
	$sql="select * from pais where pai_id='$this->cod' and pai_nom='$this->nom' and pai_des='$this->des'and pai_nac='$this->nac'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
		return 'true';
}
	
function guardar_com()
	{
		    
		$sql="INSERT INTO pais (pai_id, pai_nom, pai_des,pai_nac) VALUES (upper('$this->cod'), upper('$this->nom'), upper('$this->des'), upper('$this->nac'))"; 
	    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
	}
	
	
function modificar_com($id)
{
	$sql="UPDATE pais SET pai_nom=upper('$this->nom'), pai_des=upper('$this->des'), pai_nac=upper('$this->nac') where pai_id='$id'"; 
    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
}

/* FUNCIÓN PARA VISUALIZAR UN LISTADO DE LOS COMPONENTE MILITAR EXISTENTES */  		
function ver_com($bus,$br,$pag)
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
		$br="where pai_sta='1'";
	if($br=='2')
		$br="where pai_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql1="SELECT pai_id, pai_nom, pai_des,pai_nac FROM pais $br order by pai_nom";
	else
		$sql1="SELECT pai_id, pai_nom, pai_des,pai_nac FROM pais where pai_nom like '%$bus%' and pai_sta='1' order by pai_nom";
	//Agregar	
		$result1=mysql_query($sql1,$this->conexion);
		$num_total_registros = mysql_num_rows($result1);
		$cant_pag=ceil($num_total_registros/10); 	
		mysql_free_result($result1); 
	   $br=$reg;
	///////
	if(($br=='1') or ($br=='') or ($br=='0'))
		$br="where pai_sta='1'";
	if($br=='2')
		$br="where pai_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql="SELECT pai_id, pai_nom, pai_des,pai_nac FROM pais $br order by pai_nom limit ".$inicio.","."10";
	else
		$sql="SELECT pai_id, pai_nom, pai_des,pai_nac FROM pais where pai_nom like '%$bus%' and pai_sta='1' order by pai_nom limit ".$inicio.","."10";	
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
		{ 		
		   $HTML.='<table width="600" border="1" cellpadding="1" cellspacing="1" align="center" bgcolor="#FFFFFF">
			  <tr bgcolor="#000066" class="Estilo22">
				<td width="50"><div align="left">Código</div></td>
				<td width="300"><div align="left">Nombre</div></td>
				<td width="100"><div align="left">Descripción</div></td>
				<td width="200"><div align="left">Nac.</div></td>

			  </tr>';

		   while ($row = mysql_fetch_row($result))
		   {
			$cadena=implode('/*',$row);
			$HTML.='<tr>
				<td width="50" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$row[0].'</td>
				<td width="300" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$row[1].'</td>
				<td width="100" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">-'.$row[2].'</td>
				<td width="200" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$row[3].'</td>
				</tr>';
			}			//agregar
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
							$HTML.=" <a href='pais.php?pagina=".$i."**".$reg."'>" .$i. "</a>";}
      			}
				$HTML.='</div>';
			  }
			//fin de codigo para paginar
		  return $HTML;
		}
		else
		return false;
	}  // fin de funcion ver Componenetes Militares
function eliminar($id)
{
	$sql="UPDATE pais SET pai_sta='0' where pai_id='$id'";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			   return true;
		else
			   return false;
	
}
  function Listado_pais()
  {
		$sql="SELECT * FROM pais WHERE pai_sta='1' order by pai_nom";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			  return $result;
		else
			  return 'FALSE';
  }	
  
  	function combo_pai()
	{
	   	$sql="SELECT pai_id, pai_nom from pais where pai_sta='1' order by pai_nom";
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