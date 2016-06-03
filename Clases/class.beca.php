<?php
/* 
CLASE Beca
CREADA POR: COORDINACIÓN DE INNOVACIONES EDUCATIVAS Y TECNOLOGICAS UNEFA TÁCHIRA
ING. VICTOR GUTIERREZ CRUZ
FECHA DE CREACIÓN: 02/02/2010
OBJETIVO: VALIDAR Beca
*/


/* DECLARACIÓN DE LA CLASE */
class beca extends conec_BD
{
   var $nom;
   var $des;
   var $sta;
   var $cod;
   var $ins;
   var $tip;
	
  
/* FUNCIÓN CONSTRUCTORA */  
   function beca($co,$no,$de,$st,$in,$ti)
   {
       $bec= new conec_BD();
		$this->conexion=$bec->conectar_BD();
		$this->cod=$co;
		$this->nom=$no;
		$this->des=$de;
		$this->sta=$st;
       	$this->ins=$in;
		$this->tip=$ti;
	}
	

function buscar_existe()
{
	$sql="select * from beca where bec_id='$this->cod' and bec_nom='$this->nom' and bec_des='$this->des'and bec_ins='$this->ins'and bec_tip='$this->tip'"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	  if($n>0)
		return 'true';
}
	
function guardar_com()
	{
		    
		$sql="INSERT INTO beca (bec_id, bec_nom, bec_des,bec_ins,bec_tip) VALUES (upper('$this->cod'), upper('$this->nom'), upper('$this->des'), upper('$this->ins'), upper('$this->tip'))"; 
	    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
	}
	
	
function modificar_com($id)
{
	$sql="UPDATE beca SET bec_nom=upper('$this->nom'), bec_des=upper('$this->des'), bec_ins=upper('$this->ins'), bec_tip=upper('$this->tip') where bec_id='$id'"; 
    $result=mysql_query($sql,$this->conexion);
			if ($result)
			   return true;
			else
			   return false;
}

/* FUNCIÓN PARA VISUALIZAR UN LISTADO DE LA PANTALLA */  		
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
		$br="where bec_sta='1'";
	if($br=='2')
		$br="where bec_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql1="SELECT bec_id, bec_nom, bec_des,bec_ins,bec_tip FROM beca $br order by bec_nom";
	else
		$sql1="SELECT bec_id, bec_nom, bec_des,bec_ins,bec_tip FROM beca where bec_nom like '%$bus%' and bec_sta='1' order by bec_nom";
	//Agregar	
		$result1=mysql_query($sql1,$this->conexion);
		$num_total_registros = mysql_num_rows($result1);
		$cant_pag=ceil($num_total_registros/10); 	
		mysql_free_result($result1); 
	   $br=$reg;
	///////
	if(($br=='1') or ($br=='') or ($br=='0'))
		$br="where bec_sta='1'";
	if($br=='2')
		$br="where bec_sta='0'";
	if($br=='3')
		$br="";		 
	if ($bus=='')
		$sql="SELECT bec_id, bec_nom, bec_des,bec_ins,bec_tip,IF( bec_tip = '1', 'Interna', 'Externa')  FROM beca $br order by bec_nom limit ".$inicio.","."10";
	else
		$sql="SELECT bec_id, bec_nom, bec_des,bec_ins,bec_tip,IF( bec_tip = '1', 'Interna', 'Externa')  FROM beca where bec_nom like '%$bus%' and bec_sta='1' order by bec_nom limit ".$inicio.","."10";
	
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
		{ 		
		   $HTML.='<table width="650" border="1" cellpadding="1" cellspacing="1" align="center" bgcolor="#FFFFFF">
			  <tr bgcolor="#000066" class="Estilo22">
				<td width="50"><div align="left">Código</div></td>
				<td width="350"><div align="left">Nombre</div></td>
				<td width="150"><div align="left">Institución</div></td>
				<td width="50"><div align="left">Tipo</div></td>
			  </tr>';

		   while ($row = mysql_fetch_row($result))
		   {
			$cadena=implode('/*',$row);
			$HTML.='<tr>
				<td width="50" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$row[0].'</td>
				<td width="350" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$row[1].'</td>
				<td width="150" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">-'.$row[3].'</td>
				<td width="50" class="Estilo2" style="cursor:hand" onClick="ver_modif('."'".$cadena."'".')"  align="left">'.$row[5].'</td>				
				</tr>';
			}
			//agregar
			 $HTML.='<tr>
			  <td align="center" id="imp" colspan="4"><span class="Etiqueta">Total de Registros: '.$num_total_registros.'</span></td></tr></table>';
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
							$HTML.=" <a href='beca.php?pagina=".$i."**".$reg."'>" .$i. "</a>";}
      			}
				$HTML.='</div>';
			  }
			//fin de codigo para paginar
		  return $HTML;
		}
		else
		return false;
	}  // fin de funcion ver 
	
function eliminar($id)
{
	$sql="UPDATE beca SET bec_sta='0' where bec_id='$id'";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			   return true;
		else
			   return false;
	
}
  function Listado_Beca()
  {
		$sql="SELECT bec_nom,bec_des,bec_ins, IF( bec_tip = '1', 'Interna', 'Externa') FROM beca WHERE bec_sta='1' order by bec_nom";
		$result=mysql_query($sql,$this->conexion);
		if ($result) 
			  return $result;
		else
			  return 'FALSE';
  }	
}// fin de la clase
?>