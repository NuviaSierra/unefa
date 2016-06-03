<?php
/* 
CLASE INSTITUCION EDUCATIVA
CREADA POR: COORDINACION DE INNOVACIONES EDUCATIVAS Y TECNOLOGICAS UNEFA TÁCHIRA
ING. GRATELLY GARZA MORILLO-Ing. Victor E. Gutierrez C.
FECHA DE CREACIÓN: 04/02/2010
OBJETIVO: VALIDAR INSTITUCION EDUCATIVA
*/


/* DECLARACIÓN DE LA CLASE */
class instit extends conec_BD
{
   var $nom;
   var $des;
   var $sta;
   var $cod;

  
/* FUNCIÓN CONSTRUCTORA */  
   function instit($co,$no,$de,$st)
   {
       $inst= new conec_BD();
		$this->conexion=$inst->conectar_BD();
		$this->cod=$co;
		$this->nom=$no;
		$this->des=$de;
		$this->sta=$st;
	}
	

function buscar_existe()
{
	$sql="select * from instit where ins_id='$this->cod' and ins_nom='$this->nom' and ins_des='$this->des'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
		return 'true';
}
	
function guardar_instit()
	{
		    
		$sql="INSERT INTO instit (ins_id, ins_nom, ins_des) VALUES (upper('$this->cod'), upper('$this->nom'), upper('$this->des'))"; 
	    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
	}
	
	
function modificar_instit($id)
{
	$sql="UPDATE instit SET ins_nom=upper('$this->nom'), ins_des=upper('$this->des') where ins_id='$id'"; 
	$sql;
    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
}

 /* FUNCIÓN PARA VISUALIZAR UN LISTADO DE LOS INSTITUCIONES EDUCATIVAS */  		
function ver_instit($bus,$br,$pag)
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
		$br="where ins_sta='1'";
	if($br=='2')
		$br="where ins_sta='0'";
	if($br=='3')
		$br="";		 

	if ($bus=='')
		$sql1="SELECT ins_id, ins_nom, ins_des FROM instit $br order by ins_nom";
	else
		$sql1="SELECT ins_id, ins_nom, ins_des FROM instit where ins_nom like '%$bus%' and ins_sta='1' order by ins_nom";
	//Agregar	
		$result1=mysql_query($sql1,$this->conexion);
		$num_total_registros = mysql_num_rows($result1);
		$cant_pag=ceil($num_total_registros/10); 	
		mysql_free_result($result1); 
	   $br=$reg;
	///////

	if(($br=='1') or ($br=='') or ($br=='0'))
		$br="where ins_sta='1'";
	if($br=='2')
		$br="where ins_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql="SELECT ins_id, ins_nom, ins_des FROM instit $br order by ins_nom limit ".$inicio.","."10";
	else
		$sql="SELECT ins_id, ins_nom, ins_des FROM instit where ins_nom like '%$bus%' and ins_sta='1' order by ins_nom limit ".$inicio.","."10";
	
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
		{ 		
		   $HTML.='<table width="600" border="1" cellpadding="1" cellspacing="1" align="center" bgcolor="#FFFFFF">
			  <tr bgcolor="#000066" class="Estilo22">
				<td width="50"><div align="left">Código</div></td>
				<td width="400"><div align="left">Nombre</div></td>
				<td width="150"><div align="left">Descripción</div></td>
			  </tr>';

		   while ($row = mysql_fetch_row($result))
		   { 
			$cadena=implode('/*',$row);
			if ($row[2]=='')
				$vacio='-';
			else
				$vacio=$row[2];
			$HTML.='<tr>
				<td width="50" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$row[0].'</td>
				<td width="400" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$row[1].'</td>
				<td width="150" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$vacio.'</td>
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
							$HTML.=" <a href='instit.php?pagina=".$i."**".$reg."'>" .$i. "</a>";}
      			}
				$HTML.='</div>';
			  }
			//fin de codigo para paginar
		  return $HTML;
		}
		else
		return false;
} // fin de funcion ver Componenetes Militares

function eliminar_instit($id)
{
	$sql="UPDATE instit SET ins_sta='0' where ins_id='$id'";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			   return true;
		else
			   return false;
	
}
  function Listado_instit()
  {
		$sql="SELECT * FROM instit WHERE ins_sta='1' order by ins_nom";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			  return $result;
		else
			  return 'false';
  }	
}// fin de la clase
?>