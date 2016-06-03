<?php
/* 

CLASE TIPOS DE PROCESOS
CREADA POR: COORDINACION DE INNOVACIONES EDUCATIVAS Y TECNOLOGICAS UNEFA TÁCHIRA
ING. GRATELLY GARZA MORILLO/Ing. Victor E. Gutierrez C.
FECHA DE CREACIÓN: 10/02/2010
OBJETIVO: VALIDAR TIPOS DE PROCESOS
*/

/* DECLARACIÓN DE LA CLASE */
class proces extends conec_BD
{
   var $nom;
   var $fin;
   var $ffi;   
   var $sta;
   var $cod;

  
  
/* FUNCIÓN CONSTRUCTORA */  
   function proces($co,$no,$fin,$ffi,$st)
   {
       $proc= new conec_BD();
		$this->conexion=$proc->conectar_BD();
		$this->cod=$co;
		$this->nom=$no;
		$this->fin=$fin;
		$this->ffi=$ffi;
		$this->sta=$st;
	}
	

	
function buscar_existe()
{
	$sql="select * from proces where pro_id='$this->cod' and pro_nom='$this->nom'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
		return 'true';
}
	
function guardar_proces()
	{
		    
		$sql="INSERT INTO proces (pro_id, pro_nom) VALUES (upper('$this->cod'), upper('$this->nom'))"; 
	    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
	}
	
	
function modificar_pro($id)
{
	$sql="UPDATE proces SET pro_nom=upper('$this->nom'), pro_fin='$this->fin', pro_ffi='$this->ffi' where pro_id='$id'"; 
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
    	$inicio = ($pag - 1) * 10; 
    } 
	//fin de codigo para paginar
	if(($br=='1') or ($br=='') or ($br=='0'))
		$br="where pro_sta='1'";
	if($br=='2')
		$br="where pro_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql1="SELECT pro_id, pro_nom, pro_fin, pro_ffi FROM proces $br order by pro_nom";
	else
		$sql1="SELECT pro_id, pro_nom, pro_fin, pro_ffi FROM proces where pro_nom like '%$bus%' and pro_sta='1' order by pro_nom";
	//Agregar	
		$result1=mysql_query($sql1,$this->conexion);
		$num_total_registros = mysql_num_rows($result1);
		$cant_pag=ceil($num_total_registros/10); 	
		mysql_free_result($result1); 
	   $br=$reg;
	///////
	
	if(($br=='1') or ($br=='') or ($br=='0'))
		$br="where pro_sta='1'";
	if($br=='2')
		$br="where pro_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql="SELECT pro_id, pro_nom, pro_fin, pro_ffi FROM proces $br order by pro_nom limit ".$inicio.","."10";
	else
		$sql="SELECT pro_id, pro_nom, pro_fin, pro_ffi FROM proces where pro_nom like '%$bus%' and pro_sta='1' order by pro_nom limit ".$inicio.","."10"; 
	
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
		{ 		
		   $HTML.='<table width="450" border="1" cellpadding="1" cellspacing="1" align="center" bgcolor="#FFFFFF">
			  <tr bgcolor="#000066" class="Estilo22">
				<td width="50"><div align="left">Código</div></td>
				<td width="400"><div align="left">Nombre</div></td>
				<td width="50"><div align="left">Fecha de Inicio</div></td>
				<td width="400"><div align="left">Fecha De Fin</div></td>
			  </tr>';

			  
		   while ($row = mysql_fetch_row($result))
		   {
			$fin=$this->fechaNormal($row[2]);
			$ffi=$this->fechaNormal($row[3]);
			$cadena=$row[0]."/*".$row[1]."/*".$fin."/*".$ffi;
			$HTML.='<tr>
				<td width="10%" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$row[0].'</td>
				<td width="40%" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$row[1].'</td>
				<td width="25%" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$fin.'</td>
				<td width="25%" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$ffi.'</td>
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
							$HTML.=" <a href='proces.php?pagina=".$i."**".$reg."'>" .$i. "</a>";}
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
	$sql="UPDATE proces SET pro_sta='0' where pro_id='$id'";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			   return true;
		else
			   return false;
	
}
  function Listado_proces()
  {
		$sql="SELECT * FROM proces WHERE pro_sta='1' order by pro_nom";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			  return $result;
		else
			  return 'false';
  }	
}// fin de la clase
?>