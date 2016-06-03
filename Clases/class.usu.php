<?php
/* 
CLASE USUARIO
CREADA POR: COORDINACION DE INNOVACIONES EDUCATIVAS Y TECNOLOGICAS UNEFA TÁCHIRA
ING. GRATELLY GARZA MORILLO
FECHA DE CREACIÓN: 22/02/2010
OBJETIVO: USUARIO
*/

/* DECLARACIÓN DE LA CLASE */
class usuari extends conec_BD
{
   var $ced;
   var $per;
  
/* FUNCIÓN CONSTRUCTORA */  
   function usuari($ce,$pe)
   {
       $tipo= new conec_BD();
		$this->conexion=$tipo->conectar_BD();
		$this->ced=$ce;
		$this->per=$pe;
   }

function buscar_existe()
{
	$sql="select no1, no2, ap1, ap2 from persona where ci='$this->ced' and sta='1'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
	  {
	    $cadena=$row[0].'**'.$row[1].'**'.$row[2].'**'.$row[3];
		 return $cadena;
	  }
	  else
		return 'false'; 

}
function buscar_ced($id)
{
	$sql="select no1,ap1,ci from persona where ci='$id' and sta='1'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
	  {
	    $cadena=$row[0].'**'.$row[1].'**'.$row[2];
		 return $cadena;
	  }
	  else
		return 'false'; 

}

function buscar_perfil($id)
{
	$sql="SELECT per_id FROM perfil_usuari WHERE ci_usu = '$id' AND peu_sta = '1'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
	  {
	    $cadena=$row[0];
		 return $cadena;
	  }
	  else
		return 'false';
}

function existe_perfil($id, $perf)
{
	$sql="SELECT * FROM perfil_usuari WHERE ci_usu = '$id' AND per_id = '$perf'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0){
	  $sql="SELECT * FROM perfil_usuari WHERE ci_usu = '$id' AND per_id = '$perf' AND peu_sta='0'"; 
	  $result=mysql_query($sql,$this->conexion);
	  $row=mysql_fetch_array($result); 
	  $n=mysql_num_rows($result);
		if($n>0){
		$sql="UPDATE perfil_usuari SET peu_sta='1' WHERE ci_usu = '$id' AND per_id = '$perf'";
		$result=mysql_query($sql,$this->conexion);
		echo "<script>alert('Perfil Activado Exitosamente')</script>";
		}
		else
		return true;
	  }
	  else
		return false; 

}
function si_queda_perf($id)
{
	 $sql="SELECT * FROM perfil_usuari WHERE ci_usu = '$id'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
		 return true;
	  else
		return false;
}

function buscar_clave()
{
	$sql="SELECT usu_pas FROM usuari WHERE ci = '$this->ced' AND usu_sta = '1'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
	  {
	    $cadena=$row[0];
		 return $cadena;
	  }
	  else
		return 'false'; 

}
function mod_perfil($perfil, $cedu)
{
	$sql="UPDATE perfil_usuari SET per_id='$perfil' where ci_usu='$cedu'"; 
    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return 'false';
}
function modif_clave($clave, $cedu)
{
	$sql="UPDATE usuari SET usu_pas='$clave' where ci= '$cedu'"; 
    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return 'false';
}

function activar_usuario($id)
{
		$sql="UPDATE usuari SET usu_sta='1' where ci= '$id'"; 
    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return 'false';
}

function ins_perusu($perfi,$cedu)
	{
		    
		$sql="INSERT INTO perfil_usuari (per_id, ci_usu, peu_sta) VALUES ('$perfi', '$cedu', '1')";
	    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
	}
	
/* FUNCIÓN PARA VISUALIZAR UN LISTADO DE LOS USUARIOS*/  		
	function ver_usu($perf,$pag)
{
	$reg=$perf;//linea a agregar

	if (!$pag) 
	{ 
    	$inicio=0; 
    	$pag=1; 
	} 
	else
	{ 
    	$inicio = ($pag - 1) * 10; 
    } 


	if ($perf=='0')
		$sql1="SELECT no1, no2, ap1, ap2, ci FROM persona WHERE sta = '1' AND ci NOT IN (SELECT DISTINCT perfil_usuari.ci_usu
FROM perfil_usuari) ORDER BY no1";
	if ($perf>'0')
		$sql1="SELECT no1, no2, ap1, ap2, ci, per_id FROM persona, perfil_usuari where sta='1' and peu_sta='1' and ci=ci_usu and per_id='$perf' order by no1";
		$result1=mysql_query($sql1,$this->conexion);
		$num_total_registros = mysql_num_rows($result1);
		$cant_pag=ceil($num_total_registros/10); 	
		mysql_free_result($result1); 
	   $br=$reg;
	///////

 
	if ($perf=='0')
		$sql="SELECT no1, no2, ap1, ap2, ci FROM persona WHERE sta = '1' AND ci NOT IN (SELECT DISTINCT perfil_usuari.ci_usu
FROM perfil_usuari) ORDER BY no1 limit ".$inicio.","."10";
	if ($perf>'0')
		$sql="SELECT no1, no2, ap1, ap2, ci, per_id FROM persona, perfil_usuari where sta='1'  and peu_sta='1'
				and ci=ci_usu and per_id='$perf' order by no1 limit ".$inicio.","."10";
	
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
		{ 		
		   $HTML.='<table width="700" border="1" cellpadding="1" cellspacing="1" align="center" bgcolor="#FFFFFF">
			  <tr bgcolor="#000066" class="Estilo22">
				<td width="100"><div align="left">Cédula</div></td>
				<td width="150"><div align="left">1er. Nombre</div></td>
				<td width="150"><div align="left">2do. Nombre</div></td>
				<td width="150"><div align="left">1er Apellido</div></td>
				<td width="150"><div align="left">2do. Apellido</div></td>
			</tr>';

		   while ($row = mysql_fetch_row($result))
		   {
			$cadena=implode('/*',$row);
			$HTML.='<tr>
				<td width="100" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')" class="Texto" align="left">'.$row[4].'</td>
				<td width="150" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')" class="Texto" align="left">'.$row[0].'</td>
				<td width="150" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')" class="Texto" align="left">'.$row[1].'-</td>
				<td width="150" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')" class="Texto" align="left">'.$row[2].'</td>
				<td width="150" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')" class="Texto" align="left">'.$row[3].'-</td>
				</tr>';
			}
			//agregar
			 $HTML.='<tr>
			  <td align="center" id="imp" colspan="5"><span class="Etiqueta">Total de Registros: '.$num_total_registros.'</span></td></tr></table>';
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
							$HTML.=" <a href='Usuario.php?pagina=".$i."**".$reg."'>" .$i. "</a>";}
      			}
				$HTML.='</div>';
			  }
			//fin de codigo para paginar
		  return $HTML;
		}
		else
		return false;
	} // fin de funcion ver Componenetes Militares
	
function eliminar_usu($id)
{
	$sql="UPDATE usuari SET usu_sta='0' where ci='$id'";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			   return true;
		else
			   return false;
	
}

function eliminar_per($id,$perfi)
{
	$sql="UPDATE perfil_usuari SET peu_sta='0' where ci_usu='$id' and per_id='$perfi'";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			   return true;
		else
			   return false;
	
}

function combo_per()
	{
	   	$sql="SELECT per_id, per_nom from perfil where per_sta='1' order by per_nom";
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
function combo_per1($ci)
	{
	   	$sql="SELECT A.per_id AS per_id, A.per_nom AS per_nom FROM perfil A, perfil_usuari B WHERE A.per_sta='1' AND A.per_id=B.per_id AND B.ci_usu='$ci' AND B.peu_sta='1' ORDER BY per_nom";
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