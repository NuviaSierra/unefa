<?php
/* 
CLASE Deporte
CREADA POR: COORDINACION DE INNOVACIONES EDUCATIVAS Y TECNOLOGICAS UNEFA TÁCHIRA
ING. Victor E.Gutierrez C.
FECHA DE CREACIÓN: 02/02/2010
OBJETIVO: Maestro Deport
*/


/* DECLARACIÓN DE LA CLASE */
class deport extends conec_BD
{
   var $cod;
   var $nom;
   var $des;
   var $niv;
   var $sta;
	
  
/* FUNCIÓN CONSTRUCTORA */  
   function deport($co,$no,$de,$ni,$st)
   {
       $dep= new conec_BD();
		$this->conexion=$dep->conectar_BD();
		$this->cod=$co;
		$this->nom=$no;
		$this->des=$de;
		$this->niv=$ni;
		$this->sta=$st;
	}
	

function buscar_existe()
{
	$sql="select * from deport where dep_id='$this->cod' and dep_nom='$this->nom' and dep_des='$this->des'and dep_niv='$this->niv'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
		return 'true';
}
	
function guardar()
	{
		    
		$sql="INSERT INTO deport (dep_id, dep_nom, dep_des, dep_niv) VALUES (upper('$this->cod'), upper('$this->nom'), upper('$this->des'), upper('$this->niv'))"; 
	    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
	}
	
	
function modificar($id)
{
	$sql="UPDATE deport SET dep_nom=upper('$this->nom'), dep_des=upper('$this->des'), dep_niv=upper('$this->niv') where dep_id='$id'"; 
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
		$br="where dep_sta='1'";
	if($br=='2')
		$br="where dep_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql1="SELECT dep_id, dep_nom, dep_des, dep_niv FROM deport $br order by dep_nom";
	else
		$sql1="SELECT dep_id, dep_nom, dep_des, dep_niv FROM deport where dep_nom like '%$bus%' and dep_sta='1' order by dep_nom";
	//Agregar	
		$result1=mysql_query($sql1,$this->conexion);
		$num_total_registros = mysql_num_rows($result1);
		$cant_pag=ceil($num_total_registros/10); 	
		mysql_free_result($result1); 
	   $br=$reg;
	///////
	if(($br=='1') or ($br=='') or ($br=='0'))
		$br="where dep_sta='1'";
	if($br=='2')
		$br="where dep_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql="SELECT dep_id, dep_nom, dep_des, dep_niv FROM deport $br order by dep_nom limit ".$inicio.","."10";
	else
		$sql="SELECT dep_id, dep_nom, dep_des, dep_niv FROM deport where dep_nom like '%$bus%' and dep_sta='1' order by dep_nom limit ".$inicio.","."10";
	
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
							$HTML.=" <a href='deport.php?pagina=".$i."**".$reg."'>" .$i. "</a>";}
      			}
				$HTML.='</div>';
			  }
			//fin de codigo para paginar
		  return $HTML;
		}
		else
		return false;
	} // fin de funcion ver deportes
	
function eliminar($id)
{
	$sql="UPDATE deport SET dep_sta='0' where dep_id='$id'";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			   return true;
		else
			   return false;
	
}
  function Listado()
  {
		$sql="SELECT * FROM deport WHERE dep_sta='1' order by dep_nom";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			  return $result;
		else
			  return 'FALSE';
  }	
}// fin de la clase
?>