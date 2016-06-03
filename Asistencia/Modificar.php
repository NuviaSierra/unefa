<?php session_start(); // Iniciamos la sesion?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>SIDSECUN</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
//************************************************************************************
function getHTTPObject(){
  var xmlhttp=false;
  try{
    // Creacion del objeto AJAX para navegadores no IE
    xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
  }catch(e){
    try{
	  // Creacion del objet AJAX para IE
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
    }
    catch(E){ xmlhttp=false;}
  }
  if(!xmlhttp && typeof XMLHttpRequest!='undefined'){ xmlhttp=new XMLHttpRequest();}
  return xmlhttp;
}//fin function
//---------------------------------------
function Selec_cant_pensum(obj){
//alert('ENTRE ');
  if(obj.name=='MOD_H'){
    obj2=document.getElementById("MOD_D");
    obj3=document.getElementById("ELI_H");
  }
  else{
    if(obj.name=='MOD_D'){
      obj2=document.getElementById("MOD_H");
      obj3=document.getElementById("ELI_H");
	}
	else{
      obj2=document.getElementById("MOD_H");
      obj3=document.getElementById("MOD_D");	  
	}
  }
  obj2.checked=false;
  obj3.checked=false;
//alert('SALIR ');
}
//---------------------------------------
</script>
</head>
<script src='../Funciones/funcion.validar.js'></script>
<?php
  include("../Funciones/cascadas.css");
  include("../Funciones/funciones.php");
  require("../Clases/class.conexion.php");
  include("../Clases/class.menus.php");
  $NuevoMenu = new menus("","","","","");
  $NuevoMenu->conec_BD();
  $NuevoMenu->conectar_BD();
  include("../Clases/class.nota.php");
  $clave=explode("*",$_GET[usu]);
  $pac_id=$clave[0];
  $infrae=$clave[1];
  $asi_cod=$clave[2];
  $asi_nom=$clave[3];
  $dbh_tip=0;
  $ci=$_SESSION[ci];
  $NuevoHor = new nota("","",$asi_cod,"","","","",$pac_id,"","","","",$infrae,"");
  $NuevoHor->conec_BD();
  $NuevoHor->conectar_BD();
  include ("../Clases/class.plantilla.php");
  $Plantilla = new plantilla("","","");?>
<body bgcolor="#a9c3e8" leftmargin="0" rightmargin="0" topmargin="0">
  <form action="Modificar.php" method="post" enctype="multipart/form-data" name="form" id="form">
    <table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10%" height="19" colspan="1">&nbsp;</td>
        <td colspan="1" width="80%">
          <table width="862px" height="25px" border="0" align="center" cellspacing="0" cellpadding="0">
<?php
    $menu_princ=$NuevoMenu->menu_principal('4105');//($_GET[ayu]);
    echo $menu_princ;?>
        	<input name="ayu" id="ayu" type="hidden" value="<?php echo "".$_GET[ayu];?>">
          </table>
	    </td>
      </tr>
<?php
/*  	echo "<script>alert('$infrae,$asi_cod,$asi_nom');</script>";*/
    $res_asi=$NuevoHor->OperacionCualquiera("SELECT DISTINCT(asi_cod), asi_cht, asi_chp, asi_chl FROM asigna WHERE asi_cod='$asi_cod' AND asi_nom='$asi_nom'");
    $asigna=$NuevoHor->ConsultarCualquiera($res_asi);
/*	echo "<script>alert(' OJO $cant_teo,$cant_pra,$cant_lab ');</script>";*/
    $resultado=$NuevoHor->Listado_Infrae_Nucleo($infrae);
	$array=$NuevoHor->ConsultarCualquiera($resultado);
	$pac_nom=$NuevoHor->Buscar_pacade1($pac_id);?>
      <tr>
        <td colspan="3" width="100%">
    	  <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="1" width="100%"><div id="container2">
                <table style="width: 950px; text-align: center; margin-left: auto; margin-right: auto; margin-center: auto;" border="0" cellpadding="0" cellspacing="0" align="center">
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr>
                    <td width="100%">
			    	  <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;" border="1" bordercolor="#777A4B" bgcolor="#ffffff">
						<tr><td colspan="4" bgcolor="#000066"><span class="Estilo1">:: ACTAS DE ASISTENCIA DE EVALUACI&Oacute;N DEL PER&Iacute;ODO ACAD&Eacute;MICO <?php echo "".$pac_nom;?></span></td></tr>
  						<tr>					
					      <td bgcolor="#FFFFFF" width="20%"><div align="right" class="Estilo9">Nucleo:</div></td>
					      <td bgcolor="#FFFFFF" width="30%"><div align="left" class="Estilo2"><?php echo "".$array->nuc_nom;?></div></td>
					      <td bgcolor="#FFFFFF" width="20%"><div align="right" class="Estilo9">Infraestructura:</div></td>
					      <td bgcolor="#FFFFFF" width="30%"><div align="left" class="Estilo2"><?php echo "".$array->inf_nom;?></div></td>
						</tr> 
						<tr>
					      <td bgcolor="#FFFFFF" width="20%"><div align="right" class="Estilo9">Asignatura:</div></td>
					      <td bgcolor="#FFFFFF" width="30%" align="char"><div align="left" class="Estilo2"><?php echo "".$asi_nom;?></div></td>
					      <td bgcolor="#FFFFFF" width="20%"><div align="right" class="Estilo9">C&oacute;digo de la Asignatura:</div></td>
					      <td bgcolor="#FFFFFF" width="30%"><div align="left" class="Estilo2"><?php echo "".$asi_cod;?></div></td>
						</tr>
	                    <tr><td colspan="4" bgcolor="#000066"><span class="Estilo18">LISTADO DE HORARIO DE SECCIONES POR LA ASIGNATURA SELECCIONADA</span></td></tr>
						<tr>
						  <td colspan="4">
						    <table style="width: 100%; text-align: center;" border="1">
							  <tr>
							    <td bgcolor="#FFFFFF" width="14%"><div align="center" class="Estilo9">MODALIDAD</div></td>
							    <td bgcolor="#FFFFFF" width="14%"><div align="center" class="Estilo9">R&Eacute;GIMEN</div></td>
							    <td bgcolor="#FFFFFF" width="20%"><div align="center" class="Estilo9">ESPECIALIDAD</div></td>
							    <td bgcolor="#FFFFFF" width="10%"><div align="center" class="Estilo9">COHORTE</div></td>
							    <td bgcolor="#FFFFFF" width="10%"><div align="center" class="Estilo9">SECCI&Oacute;N</div></td>
							    <td bgcolor="#FFFFFF" width="8%"><div align="center" class="Estilo9">CONSULTAR ACTA</div></td>
							  </tr>
<?php
/*  	  echo "<script>alert('$infrae,$asi_cod,$asi_nom');</script>";*/
	  $result=$NuevoHor->OperacionCualquiera("SELECT DISTINCT (A.esp_id) AS esp_id, B.esp_nom AS esp_nom, A.reg_id AS reg_id, E.reg_nom AS reg_nom, A.mod_id AS mod_id, C.mod_nom AS mod_nom, A.coh_id AS coh_id, D.coh_nom AS coh_nom, A.pac_id AS pac_id, A.sec_id AS sec_id, F.sec_nom AS sec_nom, A.hor_id AS hor_id FROM horario A, especi B, modali C, cohort D, regimen E, seccio F WHERE A.esp_id=B.esp_id AND A.mod_id=C.mod_id AND A.coh_id=D.coh_id AND A.reg_id=E.reg_id AND A.sec_id=F.sec_id AND A.hor_sta = '1' AND F.inf_id = '$infrae' AND A.pac_id = '$pac_id' AND A.asi_cod='$asi_cod' AND A.ci='$ci' ORDER BY A.hor_id");
	  $pri=0;
	  $fil=$NuevoHor->NumFilasCualquiera($result);
	  if($fil==0){?>
	                          <tr>
								<td bgcolor="#FFFFFF" colspan="7"><div align="center" class="Estilo2">LO SIENTO NO EXISTEN HORARIOS DE SECCIONES CARGADOS PARA LA ASIGNATURA SELECCIONADA COMO DOCENTE</div></td>
							   </tr>
	  <?php
	  }
/*  	  echo "<script>alert('CANT $fil');</script>";*/
      while($array2=$NuevoHor->ConsultarCualquiera($result)){
	    $nom=$array2->mod_id."*".$array2->reg_id."*".$array2->esp_id."*".$array2->coh_id."*".$array2->sec_id;
/*		echo "<script>alert('$pri, $nom');</script>";*/
		if($pri==0){
		  $h_id=$array2->hor_id;
		  $contar=$NuevoHor->OperacionCualquiera("SELECT DISTINCT (esp_id), reg_id, mod_id, coh_id, pac_id, sec_id FROM horario WHERE hor_id = '$h_id' AND hor_sta = '1' AND pac_id = '$pac_id' AND ci='$ci'");
		  $pri_to=$NuevoHor->NumFilasCualquiera($contar);
		}
		else
		{
		  $h_id_ant=$h_id;
		  $h_id=$array2->hor_id;
/*		echo "<script>alert('$h_id_ant!=$array2->hor_id');</script>";*/
		}
		if($pri!=0){
/*		echo "<script>alert('$h_id_ant!=$array2->hor_id');</script>";*/
		  if($h_id_ant!=$array2->hor_id){
		    $pri=0;
			$contar=$NuevoHor->OperacionCualquiera("SELECT DISTINCT (esp_id), reg_id, mod_id, coh_id, pac_id, sec_id FROM horario WHERE hor_id = '$h_id' AND hor_sta = '1' AND pac_id = '$pac_id'");
		    $pri_to=$NuevoHor->NumFilasCualquiera($contar);
		  }
		}?>
							  <tr>
								<td bgcolor="#FFFFFF" width="14%"><div align="left" class="Estilo2">
								<?php echo "".$array2->mod_nom;?>
								<input type="checkbox" name="<?php echo "PENSUM*".$nom;?>" id="<?php echo "PENSUM".$nom;?>" value="<?php echo "".$nom;?>" onChange="Cambiar_cant_pensum(this);" style="visibility:hidden"></div></td>
								<td bgcolor="#FFFFFF" width="14%"><div align="left" class="Estilo2"><?php echo "".$array2->reg_nom;?></div></td>
								<td bgcolor="#FFFFFF" width="25%"><div align="left" class="Estilo2"><?php echo "".$array2->esp_nom;?></div></td>
								<td bgcolor="#FFFFFF" width="10%"><div align="left" class="Estilo2"><?php echo "".$array2->coh_nom;?></div></td>
								<td bgcolor="#FFFFFF" width="10%"><div align="left" class="Estilo2"><?php echo "".$array2->sec_nom;?></div></td>
							  <?php if($pri==0){?>
								<td rowspan="<?php echo "".$pri_to;?>"><img src="../Imagenes/XP2_12.gif" width="32" height="32" style="cursor:pointer;" onClick="Opciones_SubMen('../Doc/ActaAsistencia.php','ImprimirAsistencia','3','<?php echo "".$array2->hor_id."*".$infrae."*".$pac_id."*".$asi_cod."*".$asi_nom;?>')"/></td>
							  <?php }?>
							  </tr>
	  <?php
	    $pri++;
	  }?>
							</table>
						  </td>
						</tr>
						<tr>
						  <td bgcolor="#FFFFFF" colspan="4" width="100%" height="25px">
							<input name="Cancelar" type="button" class="Boton" value="Volver" onClick="Navegar('../Doc/ActaAsistencia.php?viene=Listar&usu=<?php echo "".$pac_id;?>')">
						  </td>
						</tr>
	
					  </table>
					</td>
				  </tr>
			     <tr><td width="100%">&nbsp;</td></tr>
		         <tr>
                   <td width="100%" colspan="3">
                     <table style="width: 100%;" border="0" align="left" cellpadding="0" cellspacing="0">
                       <?php $scroll_fin=$Plantilla->table_scroll_fin();
                        echo $scroll_fin;?>
                      </table>
                    </td>
                  </tr>
		        </table>
              </div></td>
            </tr>
          </table>
        <td height="18"></td>		
      </tr>
    </table>
  </form>
</body>