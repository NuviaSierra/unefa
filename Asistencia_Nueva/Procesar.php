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
//***************************************************************************************
//--------------------------------------
function ConvertirLet(num){
//alert('numero '+num);
  let="";
  if(num!=""){
    if(parseInt(num)==parseInt(1))
	  let="UNO";
    if(parseInt(num)==parseInt(2))
	  let="DOS";
    if(parseInt(num)==parseInt(3))
	  let="TRES";
    if(parseInt(num)==parseInt(4))
	  let="CUATRO";
    if(parseInt(num)==parseInt(5))
	  let="CINCO";
    if(parseInt(num)==parseInt(6))
	  let="SEIS";
    if(parseInt(num)==parseInt(7))
	  let="SIETE";
    if(parseInt(num)==parseInt(8))
	  let="OCHO";
    if(parseInt(num)==parseInt(9))
	  let="NUEVE";
    if(parseInt(num)==parseInt(10))
	  let="DIEZ";
    if(parseInt(num)==parseInt(11))
	  let="ONCE";
    if(parseInt(num)==parseInt(12))
	  let="DOCE";
    if(parseInt(num)==parseInt(13))
	  let="TRECE";
    if(parseInt(num)==parseInt(14))
	  let="CATORCE";
    if(parseInt(num)==parseInt(15))
	  let="QUINCE";
    if(parseInt(num)==parseInt(16))
	  let="DIECISEIS";
    if(parseInt(num)==parseInt(17))
	  let="DIECISIETE";
    if(parseInt(num)==parseInt(18))
	  let="DIECIOCHO";
    if(parseInt(num)==parseInt(19))
	  let="DIECINUEVE";
    if(parseInt(num)==parseInt(20))
	  let="VEINTE";
  }
  return let;
}
//--------------------------------------
function Cambiar_inas(obj){
  //alert(" ENTRE ");
  cual=obj.name.split("*");
  val=obj.value;
  Obj_Obs="Obs*"+cual[2];
  htotal_L=document.getElementById("htotal_L").value;
  document.getElementById(Obj_Obs).value="";
  //alert(" valor: "+val);
  asi_lab=document.getElementById("asi_lab").value; 
  CANT_INA_T=document.getElementById("CANT_INA_T").value; 
//  alert("CANT_INA_T="+CANT_INA_T);
  por_per_mat=document.getElementById("por_per_mat").value;
//  alert("por_per_mat="+por_per_mat);
  ilab_per_mat=document.getElementById("ilab_per_mat").value; 
//  alert("ilab_per_mat="+ilab_per_mat);
  obj_CANT_INA="CANT_INA*"+cual[2];
  CANT_INA=document.getElementById(obj_CANT_INA).value;  
//  alert("CANT_INA="+CANT_INA);
  obj_CANT_INA_lab="CANT_INA_lab*"+cual[2];
  CANT_INA_lab=document.getElementById(obj_CANT_INA_lab).value;
//  alert("CANT_INA_lab="+CANT_INA_lab);
  if(cual[0]=='T'){
    OBJ_ANT_T="TANT*"+cual[1]+"*"+cual[2];
	CANT_INA=parseInt(CANT_INA)-parseInt(document.getElementById(OBJ_ANT_T).value);
//	alert("en teoria CANT_INA="+CANT_INA);
    document.getElementById(OBJ_ANT_T).value=val;
  }
  else{
    if(cual[0]=='P'){
      OBJ_ANT_P="PANT*"+cual[1]+"*"+cual[2];
	  CANT_INA=parseInt(CANT_INA)-parseInt(document.getElementById(OBJ_ANT_P).value);
//	alert("en practica CANT_INA="+CANT_INA);
	  document.getElementById(OBJ_ANT_P).value=val;
    }
    else{
	  if(asi_lab==1){
        OBJ_ANT_L="LANT*"+cual[1]+"*"+cual[2];
	    CANT_INA=parseInt(CANT_INA)-parseInt(document.getElementById(OBJ_ANT_L).value);
	    if(parseInt(val)<parseInt(htotal_L) && parseInt(document.getElementById(OBJ_ANT_L).value)==parseInt(htotal_L)){
		  CANT_INA_lab=parseInt(CANT_INA_lab)-parseInt(1);
	    }
	    else{
		  if(parseInt(document.getElementById(OBJ_ANT_L).value)<htotal_L){
		    if(val==htotal_L){
  		      CANT_INA_lab=parseInt(CANT_INA_lab)+parseInt(1);
			}
		  }
	    }
//		alert("en laboratorio CANT_INA="+CANT_INA);
	    document.getElementById(obj_CANT_INA_lab).value=CANT_INA_lab;
	    document.getElementById(OBJ_ANT_L).value=val;
	  }
    }
  }
  document.getElementById(obj_CANT_INA).value=CANT_INA=parseInt(CANT_INA)+parseInt(val);
//  alert("aumentado CANT_INA="+CANT_INA);
  POR_INA=CANT_INA*100/CANT_INA_T;
//  alert(""+POR_INA+"<25 && "+CANT_INA_lab+"<2");
  if(POR_INA<25 && CANT_INA_lab<2){
    document.getElementById(Obj_Obs).style.backgroundColor="#FFFFFF";
	document.getElementById(Obj_Obs).style.color="#000000";
  }
  else{
    document.getElementById(Obj_Obs).style.backgroundColor="#FF0000";
	document.getElementById(Obj_Obs).style.color="#FFFFFF";
  }

  if(asi_lab==1)
    OBS="Inasistencias: "+POR_INA+"% Inasistencia al Laboratorio: "+CANT_INA_lab;
  else
    OBS="Inasistencias: "+POR_INA+"%";
//  alert("OBS="+OBS);
  document.getElementById(Obj_Obs).value=OBS;
// alert(""+val+" "+por+" "+total);   
}
//--------------------------------------
function Validar_Formulario2(){
//alert('ENTRE A VALIDAR FORM 2');
  formulario = document.forms["form"];
  formulario.submit();
}
//--------------------------------------
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
  include("../Clases/class.nota_nueva.php");
  if($_SESSION['ci']!=""){
	$clave=explode("*",$_GET[usu]);
	$pac_id=$clave[0];
	$ci_doc=$clave[1];
	$hor_id=$clave[2];
	$ase_id=$clave[3];
    $nucleo="";
    $infrae="";
	$dbh_tip=0;
  $pensum_sionalum=0;
  $por_per_mat=25;
  $ilab_per_mat=2;
  $dbh_tip=0;
/*echo "<script>alert('DOCENTE: $ci_doc, PACADE: $pac_id');</script>";*/
  $NuevoHor = new nota("","","","","","","",$pac_id,"","","","","","");
  $NuevoHor->conec_BD();
  $NuevoHor->conectar_BD();
  include ("../Clases/class.plantilla.php");
    $Plantilla = new plantilla("","","");
	$columna=4;//2
/*echo "<script>alert('ENTRE NUCLEO');</script>";*/
  if($pac_id=="undefined"){
    $pac_id="";
	$ci_doc="";
  }
	$idper=$_SESSION[idper];
	$ci_doc=$ci=$_SESSION[ci];
	$entre=0;?>
<body bgcolor="#a9c3e8" leftmargin="0" rightmargin="0" topmargin="0">
  <?php
/*  echo "<script>alert('B BOTON: $_POST[Siguiente] $_POST[Aceptar]');</script>";*/
  if(!isset($_POST[Aceptar]) && $_POST[Aceptar]!="1"){
  ?>
  <form action="Procesar.php" method="post" enctype="multipart/form-data" name="form">
      <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="1" width="10%">&nbsp;</td>
        <td colspan="1" width="80%">
          <table width="800px" height="25px" border="0" align="center" cellspacing="0" cellpadding="0">
<?php
  $menu_princ=$NuevoMenu->menu_principal('42');//($_GET[ayu]);
  echo $menu_princ;?>
			<input name="ayu" id="ayu" type="hidden" value="<?php echo "".$_GET[ayu];?>">
			<input name="id" id="id" type="hidden" value="<?php echo "".$id;?>">
          </table>
		</td>
        <td colspan="1" width="10%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" width="100%">
		  <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="1" width="100%"><div id="container2">
                <table style="width: 800px; text-align: center; margin-left: auto; margin-right: auto; margin-center: auto;" border="0" cellpadding="0" cellspacing="0" align="center">
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr>
                    <td width="100%">
                      <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bordercolor="#777A4B" bgcolor="#ffffff">
                        <tr><td colspan="<?php echo $columna;?>" bgcolor="#000066"><span class="Estilo1">:: PROCESAR INASISTENCIA POR HORARIOS</span></td></tr>
  <?php
    $pac_nom=$NuevoHor->Buscar_pacade1($pac_id);
  $info_resp=$NuevoHor->Buscar_docente_matricula($ci_doc);
  $dat_doc=$NuevoHor->Buscar_docente1($ci_doc);?>
						<tr><td colspan="<?php echo $columna;?>">
						  <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;">
  						    <tr>
						      <td bgcolor="#FFFFFF" width="50%"><div align="right" class="Estilo9">Per&iacute;odo Acad&eacute;mico:</div></td>
						      <td bgcolor="#FFFFFF" width="50%"><div align="left" class="Estilo2">
						        <input type="text" id="pac_nom" name="pac_nom" value="<?php echo "".$pac_nom;?>" readonly="true"/>
								<input type="hidden" id="pacade" name="pacade" value="<?php echo "".$pac_id;?>"/>
							  </div></td>
						    </tr>
						  </table>
						</td></tr>							
                        <tr><td colspan="<?php echo $columna;?>"><span align="center" class="Estilo9">DATOS DEL DOCENTE</span></td></tr>
						<tr><td colspan="<?php echo $columna;?>">
						  <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto; border:#0033CC;">
							<tr>
						      <td bgcolor="#FFFFFF" width="25%"><div align="right" class="Estilo9">Cedula del Docente:</div></td>
						      <td bgcolor="#FFFFFF" width="25%"><div align="left" class="Estilo2">
						        <input type="text" id="ci_doc" name="ci_doc" value="<?php echo "".$ci_doc;?>" readonly="true"/>
							  </div></td>
						      <td bgcolor="#FFFFFF" width="25%"><div align="right" class="Estilo9">Apellidos y Nombres:</div></td>
						      <td bgcolor="#FFFFFF" width="25%"><div align="left" class="Estilo2">
						        <input type="text" id="ap_nom" name="ap_nom" size="35" value="<?php echo "".$dat_doc->nombre;?>" readonly="true"/>
							  </div></td>
						    </tr>
						  </table>
						</td></tr>
						<tr><td colspan="<?php echo $columna;?>"><div align="center" class="Estilo9">LISTADO DE ASIGNATURAS POR ESPECIALIDAD Y PENSUM</div></td></tr>
						<tr>
						  <td colspan="<?php echo $columna;?>">
						    <table border="1" bordercolor="#000066" style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;">
							  <tr>
                                <td width="10%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Nucleo</div></td>
                                <td width="10%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Sede</div></td>
                                <td width="5%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Modalidad</div></td>
                                <td width="25%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Especialidad</div></td>
                                <td width="5%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">R&eacute;gimen</div></td>
                                <td width="5%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Pensum</div></td>
                                <td width="25%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Asignatura</div></td>
                                <td width="10%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Secci&oacute;n</div></td>
                                <td width="5%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Inscritos</div></td>
							  </tr>
       <?php
/*		 echo "<script>alert('ase_id: $lis_sec');</script>";*/
	   if($ase_id!=""){
		 $h_t=0;
		 $h_p=0;
		 $h_l=0;
		 $lab_pra=0;
		 $num=0;
	     $selec_pensum=0;
	     $selec_dbh=0;
	     $selec_aula=0;
		 $cant_ins=0;
	     $result=$NuevoHor->Buscar_oferta_todas($ase_id);
		 $cant_sec_sel=$NuevoHor->NumFilasCualquiera($result);
/*		 echo "<script>alert('NUMERO DE FILAS $cant_sec_sel ase_id: $lis_sec');</script>";*/
         if($cant_sec_sel!=0){
		   while($array_asi=$NuevoHor->ConsultarCualquiera($result)){
		                                                //$inf_id,$asi_cod,$asi_nom,$mod_id,$esp_id,$reg_id,$coh_id,$sec_id
		     if($lab_pra==0 && $array_asi->asi_lab!='0'){
		       $lab_pra=1;
		     }
		     if($h_t==0 && $array_asi->asi_cht!='0'){
		       $h_t=$array_asi->asi_cht;
		     }
		     if($h_p==0 && $array_asi->asi_chp!='0'){
			   $h_p=$array_asi->asi_chp;
		     }
		     if($h_l==0 && $array_asi->asi_chl!='0'){
			   $h_l=$array_asi->asi_chl;
		     }
		     if($infrae==""){
		       $infrae=$array_asi->inf_id;
		     }
			 $inf_id=$array_asi->inf_id;
			 $asi_cod=$array_asi->asi_cod;
			 $asi_nom=$array_asi->asi_nom;
			 $mod_id=$array_asi->mod_id;
			 $esp_id=$array_asi->esp_id;
			 $reg_id=$array_asi->reg_id;
			 $coh_id=$array_asi->coh_id;
			 $sec_id=$array_asi->sec_id;
			 $ele_nom=explode("(",$array_asi->ele_nom);
			 if($array_asi->ele_nom=='NINGUNA')
			   $asigna=$array_asi->asi_nom;
			 else
			   $asigna=$array_asi->asi_nom." ".$ele_nom[0];
			 $contar_ins=$NuevoHor->Contar_Inscritos($asi_cod,$mod_id,$esp_id,$reg_id,$coh_id,$sec_id);
			 $cant_ins=intval($cant_ins)+intval($contar_ins);?>
									<tr>
						       		  <td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$array_asi->nuc_nom;?></div></td>
						       		  <td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$array_asi->inf_nom;?></div></td>
						       		  <td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$array_asi->mod_nom;?></div></td>
						        	  <td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$array_asi->esp_nom;?></div></td>
						        	  <td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$array_asi->reg_nom;?></div></td>
						        	  <td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$array_asi->coh_nom;?></div></td>
						       	 	  <td bgcolor="#FFFFFF" width="40%"><div align="left" class="Estilo2"><?php echo "".$asigna;?></div></td>
						        	  <td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$array_asi->sec_nom;?></div></td>
						        	  <td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$contar_ins;?></div></td>
									</tr>
<?php
			  }?>
	   <?php
	       }
	   }?>
	        <input name="infrae" id="infrae" type="hidden" value="<?php echo "".$infrae;?>">
							</table>
						  </td>
						</tr>
<?php 
/*echo "<script>alert('DETECTANDO ERROR EN 1');</script>";*/
		  $res_fec=$NuevoHor->OperacionCualquiera("SELECT * FROM fe_ci_no WHERE pac_id='$pac_id'");
		  $arr_fec=$NuevoHor->ConsultarCualquiera($res_fec);
/*echo "<script>alert('DETECTANDO ERROR EN 2');</script>";*/
/*		  echo "<script>alert('SELECT A.asd_tpl, A.ci_doc, B.mod_id, B.esp_id, B.reg_id, B.coh_id, B.pen_top, B.asi_cod, B.sec_id, B.ci_emp, B.ci_doc_pol, B.pac_id, B.asi_nom, B.asi_lab, B.asi_chp, B.asi_cht, B.asi_chl, A.asd_p11, A.asd_p12, A.asd_p13, A.asd_p21, A.asd_p22, A.asd_p23, A.asd_p31, A.asd_p32, A.asd_p33, A.asd_f11, A.asd_f12, A.asd_f13, A.asd_f21, A.asd_f22, A.asd_f23, A.asd_f31, A.asd_f32, A.asd_f33, B.ase_pte, B.ase_pla FROM asigna_seccio_docent AS A RIGHT JOIN (SELECT C.mod_id, C.esp_id, C.reg_id, C.coh_id, C.pen_top, C.asi_cod, C.sec_id, C.ci_emp, C.ci_doc_pol, C.pac_id, D.asi_nom, D.asi_lab, D.asi_chp, D.asi_cht, D.asi_chl, C.ase_pte, C.ase_pla, C.ase_id FROM asigna_seccio C, asigna D WHERE C.ase_id=$ase_id AND (C.ci_emp=$ci OR C.ci_doc_pol=$ci) AND C.ase_sta=1 AND C.mod_id=D.mod_id AND C.coh_id=D.coh_id AND C.pen_top=D.pen_top AND C.esp_id=D.esp_id AND C.reg_id=D.reg_id AND C.asi_cod=D.asi_cod AND D.asi_sta=1) AS B ON A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.asd_sta=1 AND (B.ci_emp=A.ci_doc OR B.ci_doc_pol=A.ci_doc) GROUP BY B.ase_id');</script>";*/
  $resul=$NuevoHor->OperacionCualquiera("SELECT A.asd_tpl, A.ci_doc, B.mod_id, B.esp_id, B.reg_id, B.coh_id, B.pen_top, B.asi_cod, B.sec_id, B.ci_emp, B.ci_doc_pol, B.pac_id, B.asi_nom, B.asi_lab, B.asi_chp, B.asi_cht, B.asi_chl, A.asd_p11, A.asd_p12, A.asd_p13, A.asd_p21, A.asd_p22, A.asd_p23, A.asd_p31, A.asd_p32, A.asd_p33, A.asd_f11, A.asd_f12, A.asd_f13, A.asd_f21, A.asd_f22, A.asd_f23, A.asd_f31, A.asd_f32, A.asd_f33, B.ase_pte, B.ase_pla FROM asigna_seccio_docent AS A RIGHT JOIN (SELECT C.mod_id, C.esp_id, C.reg_id, C.coh_id, C.pen_top, C.asi_cod, C.sec_id, C.ci_emp, C.ci_doc_pol, C.pac_id, D.asi_nom, D.asi_lab, D.asi_chp, D.asi_cht, D.asi_chl, C.ase_pte, C.ase_pla, C.ase_id FROM asigna_seccio C, asigna D WHERE C.ase_id='$ase_id' AND (C.ci_emp='$ci' OR C.ci_doc_pol='$ci') AND C.ase_sta='1' AND C.mod_id=D.mod_id AND C.coh_id=D.coh_id AND C.pen_top=D.pen_top AND C.esp_id=D.esp_id AND C.reg_id=D.reg_id AND C.asi_cod=D.asi_cod AND D.asi_sta='1') AS B ON A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.asd_sta='1' AND (B.ci_emp=A.ci_doc OR B.ci_doc_pol=A.ci_doc) AND A.ci_doc='$ci' AND A.pac_id='$pac_id' GROUP BY B.ase_id");
  $Fila=$NuevoHor->NumFilasCualquiera($resul);
/*  echo "<script>alert('FILAS: $Fila');</script>";*/
  $sec_array=$NuevoHor->ConsultarCualquiera($resul);
  $por_teo=$sec_array->ase_pte;
  $por_lab=$sec_array->ase_pla;
  $nom2="";
  $doc_teo="";
if(intval($sec_array->ase_pte)==intval('100')){
  $cual=1;
  $doc_teo=1;
}
else{
  if(intval($sec_array->ci_doc_pol)==intval($sec_array->ci_emp) || intval($sec_array->asd_tpl)==4 || intval($sec_array->asd_tpl)==5 || intval($sec_array->asd_tpl)==6 || (intval($sec_array->asd_tpl)==3 && intval($sec_array->asi_lab)==1)){
	$doc_teo=1;
    $cual=2;
  }
  else{
    $cual=3;
	if(intval($sec_array->ci_doc)==intval($sec_array->ci_emp))
	  $doc_teo=1;
	else
	  $doc_teo=0;
  }
}
/*if(intval($sec_array->ci_doc)==intval('4205419')) echo "<script>alert('TEORIA: $doc_teo && cual=$cual && ase_id=$ase_id');</script>";*/
/*if(intval($sec_array->ci_doc)==intval('82021694')) echo "<script>alert('asd_tpl $sec_array->asd_tpl');</script>";*/
  if(intval($sec_array->asd_tpl)==intval(0)){
    $nom="TEOR&Iacute;A";
/*	if(intval($sec_array->ci_doc)==intval('82021694')) echo "<script>alert('cual $cual!=1 $h_p==0');</script>";*/
	if($cual!=1){ $nom0="TEO"; $nom1="TEOR&Iacute;A"; 
	  if($h_p==0){$nom2="LABORATORIO"; $nom3="LAB";}
	  else{$nom2="PRACTICA"; $nom3="PRA";}
	}
 }
 else{
    if(intval($sec_array->asd_tpl)==intval(1)){
	  $nom="PR&Aacute;CTICA";
	  if($cual!=1){
	    if($h_t==0){$nom0="PRA"; $nom1="PR&Aacute;CTICA"; $nom2="LABORATORIO"; $nom3="LAB";}
		else{
		  $nom0="TEO"; $nom1="TEOR&Iacute;A"; $nom2="PR&Aacute;CTICA"; $nom3="PRA";
		}
	  }
	}
	else{
	  if(intval($sec_array->asd_tpl)==intval(2)){
	    $nom="LABORATORIO";
/*	if(intval($sec_array->ci_doc)==intval('82021694')) echo "<script>alert('cual $cual!=1 $h_p==0');</script>";*/
	    if($cual!=1){ 
		  if($h_p==0){$nom0="TEO"; $nom1="TEOR&Iacute;A";}
		  else{
		    $nom0="TEO/PRA"; $nom1="TEOR&Iacute;A Y PRACTICA";
		  }
		  $nom2="LABORATORIO"; $nom3="LAB";
	    }	
	  }
	  else{
	    if(intval($sec_array->asd_tpl)==intval(3)){
	      $nom="TEOR&Iacute;A Y PR&Aacute;CTICA";
		  if($cual==2){ $nom0="TEO"; $nom1="TEOR&Iacute;A"; $nom2="PR&Aacute;CTICA"; $nom3="PRA";}
	    }
		else{
		  if(intval($sec_array->asd_tpl)==intval(4)){
	        $nom="TEOR&Iacute;A Y LABORATORIO";
		    if($cual==2){ $nom0="TEO"; $nom1="TEOR&Iacute;A"; $nom2="LABORATORIO"; $nom3="LAB";}
	      }
		  else{
		    if(intval($sec_array->asd_tpl)==intval(5)){
	          $nom="TEOR&Iacute;A, PR&Aacute;CTICA Y LABORATORIO";
			  if($cual==2){ $nom0="TEO-PRAC"; $nom1="TEOR&Iacute;A Y PR&Aacute;CTICA"; $nom2="LABORATORIO"; $nom3="LAB";}
	        }
			else{
	          $nom="PR&Aacute;CTICA Y LABORATORIO";
			  if($cual==2){ $nom0="PRAC"; $nom1="PR&Aacute;CTICA"; $nom2="LABORATORIO"; $nom3="LAB";}
			}
	      }	
	    }
	  }
	}
  }
?>
<input name="cual" id="cual" type="hidden" value="<?php echo "".$cual;?>">
<input name="doc_teo" id="doc_teo" type="hidden" value="<?php echo "".$doc_teo;?>">

						<tr><td colspan="4" bgcolor="#000066"><span class="Estilo18">ACTA DE INASISTENCIA <?php echo "".$nom;?></span></td></tr>
						<tr>
						  <td align="center" colspan="4">
						    <table align="center" width="100%" border="1">
							  <tr>
							    <td bgcolor="#FFFFFF" rowspan="2" width="5%"><div align="center" class="Estilo9">CEDULA</div></td>
							    <td bgcolor="#FFFFFF" rowspan="2" width="30%"><div align="center" class="Estilo9">APELLIDO(S) Y NOMBRE(S)</div></td>
								<?php
								$sem=1;
/*echo "<script>alert('DETECTANDO ERROR EN 3');</script>";*/
/*								echo "<script>alert('SELECT * FROM pacade WHERE pac_id=$pac_id AND pac_sta=1');</script>";*/
								$resP_PSEM=$NuevoHor->OperacionCualquiera("SELECT * FROM pacade WHERE pac_id='$pac_id' AND pac_sta='1'");
		                        $pacade_sem=$NuevoHor->ConsultarCualquiera($resP_PSEM);
/*echo "<script>alert('DETECTANDO ERROR EN 4');</script>";*/
/*								echo "<script>alert('SELECT DISTINCT dia_id,hor_tpl from horario where esp_id=$esp_id AND mod_id=$mod_id AND coh_id=$coh_id AND reg_id=$reg_id AND sec_id=$sec_id AND pac_id=$pac_id AND asi_cod=$asi_cod AND dbh_tip=0 && ci=$ci AND hor_sta=1 order by dia_id');</script>";*/
								$tot_sem=$pacade_sem->pac_sem;
/*								echo "<script>alert('$sem<=$tot_sem');</script>";*/
								$columnas=2;
								if($sec_array->asi_lab=='1'){
								  $columnas=3;
								  $htotal_L=$sec_array->asi_chl;
								}
								while($sem<=$tot_sem){?>
								<td colspan="<?php echo "".$columnas;?>" bgcolor="#FFFFFF"><div align="center" class="Estilo9">S<?php echo $sem;?></div></td>
								<?php $sem++;
								}
								$TOT_DIAS=$columnas*$tot_sem;
								$ancho=intval(70/$TOT_DIAS);?>
								<td bgcolor="#FFFFFF" rowspan="2" width="25%"><div align="center" class="Estilo9">OBSERVACI&Oacute;N</div></td>
							  </tr>
							  <tr>
							    <?php
								$sem=1;
								while($sem<=$tot_sem){
								?>
							    <td bgcolor="#FFFFFF" width="<?php echo "".$ancho."%";?>"><div align="center" class="Estilo9">T</div></td>
							    <td bgcolor="#FFFFFF" width="<?php echo "".$ancho."%";?>"><div align="center" class="Estilo9">P</div></td>
								<?php if($sec_array->asi_lab=='1'){?>
							    <td bgcolor="#FFFFFF" width="<?php echo "".$ancho."%";?>"><div align="center" class="Estilo9">L</div></td>
								<?php }
								$sem++;
								}
								?>
							  </tr>							
							  <?php
							  $blo="";
/*echo "<script>alert('SELECT A.asd_tpl, A.ci_doc, B.mod_id, B.esp_id, B.reg_id, B.coh_id, B.pen_top, B.asi_cod, B.sec_id, B.pac_id, B.ci, UPPER(B.ape), B.det_n11, B.det_n12, B.det_n13, B.det_n21, B.det_n22, B.det_n23, B.det_n31, B.det_n32, B.det_n33, B.det_npl11, B.det_npl12, B.det_npl13, B.det_npl21, B.det_npl22, B.det_npl23,B.det_npl31, B.det_npl32, B.det_npl33, B.det_nla, B.det_nfi, B.det_nde, B.det_con, B.det_nte FROM asigna_seccio_docent AS A RIGHT JOIN (SELECT C.mod_id, C.esp_id, C.reg_id, C.coh_id, C.pen_top, C.asi_cod, C.sec_id, C.ci_emp, C.ci_doc_pol, C.pac_id, C.ase_id, F.ci, CONCAT(F.ap1, ,F.ap2,, ,F.no1, ,F.no2) AS ape, E.det_n11, E.det_n12, E.det_n13, E.det_n21, E.det_n22, E.det_n23,E.det_n31, E.det_n32, E.det_n33, E.det_npl11, E.det_npl12, E.det_npl13, E.det_npl21, E.det_npl22, E.det_npl23, E.det_npl31, E.det_npl32, E.det_npl33, E.det_nla, E.det_nfi, E.det_nde, E.det_con, E.det_nte FROM asigna_seccio C, asigna D, detins E, persona F, matric G WHERE C.ase_id=$ase_id AND (C.ci_emp=$ci OR C.ci_doc_pol=$ci) AND C.ase_sta=1 AND C.mod_id=D.mod_id AND C.coh_id=D.coh_id AND C.pen_top=D.pen_top AND C.esp_id=D.esp_id AND C.reg_id=D.reg_id AND C.asi_cod=D.asi_cod AND D.asi_sta=1 AND C.mod_id=E.mod_id AND C.coh_id=E.coh_id AND C.pen_top=E.pen_top AND C.esp_id=E.esp_id AND C.reg_id=E.reg_id AND C.asi_cod=E.asi_cod AND C.sec_id=E.sec_id AND C.pac_id=E.pac_id AND E.det_sta=1 AND E.ci_est=F.ci AND F.sta=1 AND C.mod_id=G.mod_id AND C.coh_id=G.coh_id AND C.pen_top=G.pen_top AND C.esp_id=G.esp_id AND C.reg_id=G.reg_id AND E.ci_est=G.ci AND G.matr_tip=0 AND G.matr_sta=1) AS B ON A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.asd_sta=1 AND (B.ci_emp=A.ci_doc OR B.ci_doc_pol=A.ci_doc) ORDER BY B.ape,B.ci');</script>";*/
/*echo "<script>alert('DETECTANDO ERROR EN 5 $pac_id, $ase_id, $ci');</script>";*/
							  $res_pers=$NuevoHor->OperacionCualquiera("SELECT A.asd_tpl AS 'asd_tpl', A.ci_doc AS 'ci_doc', B.mod_id AS 'mod_id', B.esp_id AS 'esp_id', B.reg_id AS 'reg_id', B.coh_id AS 'coh_id', B.pen_top AS 'pen_top', B.asi_cod AS 'asi_cod', B.sec_id AS 'sec_id', B.pac_id AS 'pac_id', B.ci AS 'ci', B.ape AS 'ape', B.det_n11 AS 'det_n11', B.det_n12 AS 'det_n12', B.det_n13 AS 'det_n13', B.det_n21 AS 'det_n21', B.det_n22 AS 'det_n22', B.det_n23 AS 'det_n23', B.det_n31 AS 'det_n31', B.det_n32 AS 'det_n32', B.det_n33 AS 'det_n33', B.det_npl11 AS 'det_npl11', B.det_npl12 AS 'det_npl12', B.det_npl13 AS 'det_npl13', B.det_npl21 AS 'det_npl21', B.det_npl22 AS 'det_npl22', B.det_npl23 AS 'det_npl23', B.det_npl31 AS 'det_npl31', B.det_npl32 AS 'det_npl32', B.det_npl33 AS 'det_npl33', B.det_nla AS 'det_nla', B.det_nfi AS 'det_nfi', B.det_nde AS 'det_nde', B.det_con AS 'det_con', B.det_nte AS 'det_nte', B.obs_id AS 'obs_id', B.det_id AS 'det_id' FROM asigna_seccio_docent AS A RIGHT JOIN (SELECT C.mod_id, C.esp_id, C.reg_id, C.coh_id, C.pen_top, C.asi_cod, C.sec_id, C.ci_emp, C.ci_doc_pol, C.pac_id, C.ase_id, F.ci, UPPER(CONCAT(F.ap1,' ',F.ap2,', ',F.no1,' ',F.no2)) AS ape, E.det_n11, E.det_n12, E.det_n13, E.det_n21, E.det_n22, E.det_n23,E.det_n31, E.det_n32, E.det_n33, E.det_npl11, E.det_npl12, E.det_npl13, E.det_npl21, E.det_npl22, E.det_npl23,E.det_npl31, E.det_npl32, E.det_npl33, E.det_nla, E.det_nfi, E.det_nde, E.det_con, E.det_nte, E.obs_id AS 'obs_id', E.det_id AS 'det_id' FROM asigna_seccio C, asigna D, detins E, persona F, matric G WHERE C.ase_id='$ase_id' AND (C.ci_emp='$ci' OR C.ci_doc_pol='$ci') AND C.ase_sta='1' AND C.mod_id=D.mod_id AND C.coh_id=D.coh_id AND C.pen_top=D.pen_top AND C.esp_id=D.esp_id AND C.reg_id=D.reg_id AND C.asi_cod=D.asi_cod AND D.asi_sta='1' AND C.mod_id=E.mod_id AND C.coh_id=E.coh_id AND C.pen_top=E.pen_top AND C.esp_id=E.esp_id AND C.reg_id=E.reg_id AND C.asi_cod=E.asi_cod AND C.sec_id=E.sec_id AND C.pac_id=E.pac_id AND E.det_sta='1' AND E.ci_est=F.ci AND F.sta='1' AND C.mod_id=G.mod_id AND C.coh_id=G.coh_id AND C.pen_top=G.pen_top AND C.esp_id=G.esp_id AND C.reg_id=G.reg_id AND E.ci_est=G.ci AND G.matr_tip='0' AND G.matr_sta='1') AS B ON A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.pac_id='$pac_id' AND A.asd_sta='1' AND (B.ci_emp=A.ci_doc OR B.ci_doc_pol=A.ci_doc) AND A.ci_doc='$ci' GROUP BY B.ci ORDER BY B.ape,B.ci");
							  $num_alu=$NuevoHor->NumFilasCualquiera($res_pers);
/*echo "<script>alert('DETECTANDO ERROR EN 6');</script>";*/
/*							  echo "<script>alert('OJO $num_alu');</script>";*/
							  if($num_alu==0){
		  echo "<script>alert('LO SIENTO ESTA SECCIÓN NO TIENE ALUMNOS INSCRITOS');</script>";
          echo "<script>setTimeout(\"location.href='../Doc/Inasistencias_Nueva.php?ayu=".$_POST[ayu]."&viene=Listar&usu=".$pac_id."'\");</script>";							  
							  }
							  $k=1;
							  while($arr_pers=$NuevoHor->ConsultarCualquiera($res_pers)){
							    $ci_est=$arr_pers->ci;
							    $sum=(float) 0.0;
								$let="";?>
							  <tr>
							    <input type="hidden" id="<?php echo "obs_id*".$ci_est;?>" name="<?php echo "obs_id*".$ci_est;?>" value="<?php echo "".$arr_pers->obs_id;?>">
								<td align="center"><div align="left" class="Estilo2"><?php echo "".$ci_est;?></div></td>
								<td align="center"><div align="left" class="Estilo2"><?php echo "".strtoupper($arr_pers->ape);?></div></td>
								<?php 
								$num_dias=1;
								$sem=1;
								$CANT_INA=0;
								$CANT_INA_lab=0;
								$CANT_INA_T=($sec_array->asi_chp+$sec_array->asi_cht+$sec_array->asi_chl)*$tot_sem;
/*echo "<script>alert('ancho $ancho');</script>";*/
								while($sem<=$tot_sem){
								  $cant_I_T=0;
								  $cant_I_P=0;
								  $cant_I_L=0;
/*echo "<script>alert('DETECTANDO ERROR EN 7');</script>";*/
								  $RES_inas=$NuevoHor->OperacionCualquiera("SELECT * FROM inasis WHERE pac_id='$pac_id' AND det_id='$arr_pers->det_id' AND sem_nom='$sem' AND ina_tpl='0'");
								  $filas_I=$NuevoHor->NumFilasCualquiera($RES_inas);
/*echo "<script>alert('DETECTANDO ERROR EN 8');</script>";*/
								  if($filas_I!=0){
								    $inas=$NuevoHor->ConsultarCualquiera($RES_inas);
									$cant_I_T=$inas->ina_can;?>
									<input type="hidden" id="<?php echo "inaT*".$sem."*".$k;?>" name="<?php echo "inaT*".$sem."*".$k;?>" value="<?php echo "".$inas->ina_id;?>">
									<?php
								  }
/*echo "<script>alert('DETECTANDO ERROR EN 9');</script>";*/
								  $RES_inas=$NuevoHor->OperacionCualquiera("SELECT * FROM inasis WHERE pac_id='$pac_id' AND det_id='$arr_pers->det_id' AND sem_nom='$sem' AND ina_tpl='1'");
								  $filas_I=$NuevoHor->NumFilasCualquiera($RES_inas);
/*echo "<script>alert('DETECTANDO ERROR EN 10');</script>";*/
								  if($filas_I!=0){
								    $inas=$NuevoHor->ConsultarCualquiera($RES_inas);
									$cant_I_P=$inas->ina_can;?>
									<input type="hidden" id="<?php echo "inaP*".$sem."*".$k;?>" name="<?php echo "inaP*".$sem."*".$k;?>" value="<?php echo "".$inas->ina_id;?>">
									<?php
								  }
								?>
							    <td <?php if(($sem%2)==0){ ?>bgcolor="#95CAFF" <?php }else{?> bgcolor="#FFFFFF" <?php }?> width="<?php echo "".$ancho."%";?>"><div align="center" class="Estilo2">
								<select title="Semana <?php echo $sem;?>" name="<?php echo "T*".$sem."*".$k;?>" id="<?php echo "T*".$sem."*".$k;?>" onChange="Cambiar_inas(this);" style="size:9px; font-size:9px">
								<?php
								$i=0;
								while($i<=$sec_array->asi_cht){?>
								  <option value="<?php echo "".$i;?>" <?php if($cant_I_T==$i) echo "selected";?>><?php echo "".$i;?></option>
								<?php 
								  $i++;
								}
								?>
								</select><input type="hidden" id="<?php echo "TANT*".$sem."*".$k;?>" name="<?php echo "TANT*".$sem."*".$k;?>" value="<?php echo "".$cant_I_T;?>">
								</div></td>																
							    <td <?php if(($sem%2)==0){ ?>bgcolor="#95CAFF" <?php }else{?> bgcolor="#FFFFFF" <?php }?> width="<?php echo "".$ancho."%";?>"><div align="center" class="Estilo2">
								<select title="Semana <?php echo $sem;?>" name="<?php echo "P*".$sem."*".$k;?>" id="<?php echo "P*".$sem."*".$k;?>" onChange="Cambiar_inas(this);" style="size:9px; font-size:9px">
								<?php
								$i=0;
								while($i<=$sec_array->asi_chp){?>
								  <option value="<?php echo "".$i;?>" <?php if($cant_I_P==$i) echo "selected";?>><?php echo "".$i;?></option>
								<?php
								  $i++;
								}
								?>
								</select><input type="hidden" id="<?php echo "PANT*".$sem."*".$k;?>" name="<?php echo "PANT*".$sem."*".$k;?>" value="<?php echo "".$cant_I_P;?>">
								</div></td>
								<?php if($sec_array->asi_lab=='1'){
/*echo "<script>alert('DETECTANDO ERROR EN 11');</script>";*/
								  $RES_inas=$NuevoHor->OperacionCualquiera("SELECT * FROM inasis WHERE pac_id='$pac_id' AND det_id='$arr_pers->det_id' AND sem_nom='$sem' AND ina_tpl='2'");
								  $filas_I=$NuevoHor->NumFilasCualquiera($RES_inas);
/*echo "<script>alert('DETECTANDO ERROR EN 12');</script>";*/
								  if($filas_I!=0){
								    $inas=$NuevoHor->ConsultarCualquiera($RES_inas);
									$cant_I_L=$inas->ina_can;
									if($cant_I_L>0)
									  $CANT_INA_lab++;?>
									<input type="hidden" id="<?php echo "inaL*".$sem."*".$k;?>" name="<?php echo "inaL*".$sem."*".$k;?>" value="<?php echo "".$inas->ina_id;?>">
									<?php
								  }
								  if($cual==2){
								    $disab='';
									$blo_ina=0;
								  }
								  else{
								    if($cual==3){
								      if($doc_teo==1){
								        $disab='disabled';
									    $blo_ina=1;
								      }
								      else{
								        $disab='';
									    $blo_ina=0;
								      }
									}
									else{
									  $disab='';
									  $blo_ina=0;
									}
								  }
								  ?><input type="hidden" id="<?php echo "Bloque_inaL*".$sem."*".$k;?>" name="<?php echo "Bloque_inaL*".$sem."*".$k;?>" value="<?php echo "".$blo_ina;?>">
								<td <?php if(($sem%2)==0){ ?>bgcolor="#95CAFF" <?php }else{?> bgcolor="#FFFFFF" <?php }?> width="<?php echo "".$ancho."%";?>"><div align="center" class="Estilo2">
								<select title="Semana <?php echo $sem;?>" name="<?php echo "L*".$sem."*".$k;?>" id="<?php echo "L*".$sem."*".$k;?>" onChange="Cambiar_inas(this);" style="size:9px; font-size:9px" <?php echo "".$disab;?>>
								<?php
								$i=0;
								while($i<=$sec_array->asi_chl){?>
								  <option value="<?php echo "".$i;?>" <?php if($cant_I_L==$i) echo "selected";?>><?php echo "".$i;?></option>
								<?php
								  $i++;
								}
								?>
								</select><input type="hidden" id="<?php echo "LANT*".$sem."*".$k;?>" name="<?php echo "LANT*".$sem."*".$k;?>" value="<?php echo "".$cant_I_L;?>">
								</div></td>
								<?php
								  }
								  $CANT_INA=$CANT_INA+$cant_I_T+$cant_I_P+$cant_I_L;
								  $sem++;
								}
								$POR_INA=$CANT_INA*100/$CANT_INA_T;
								$mensaje_imprimir="Inasistencias: ".$POR_INA."%";
								if($sec_array->asi_lab=='1'){  
								  $mensaje_imprimir=$mensaje_imprimir." Inasistencia al Laboratorio: ".$CANT_INA_lab;
								}
								?>
								<td><div align="center" class="Estilo2"><input type="text" id="<?php echo "Obs*".$k;?>" name="<?php echo "Obs*".$k;?>" value="<?php echo "".$mensaje_imprimir;?>" readonly="true" <?php if(floatval($POR_INA)<floatval(25) && floatval($CANT_INA_lab)<floatval(2)) echo "style=\"background-color:#FFFFFF; color:#000000\""; else echo "style=\"background-color:#FF0000; color:#FFFFFF\"";?>></div></td>
								<input type="hidden" id="<?php echo "det*".$k;?>" name="<?php echo "det*".$k;?>" value="<?php echo "".$arr_pers->det_id;?>">
								<input type="hidden" id="<?php echo "CANT_INA*".$k;?>" name="<?php echo "CANT_INA*".$k;?>" value="<?php echo "".$CANT_INA;?>">
								<input type="hidden" id="<?php echo "CANT_INA_lab*".$k;?>" name="<?php echo "CANT_INA_lab*".$k;?>" value="<?php echo "".$CANT_INA_lab;?>">
							  </tr>
							  <?php	
							    $k++;
							  }
							  ?>
							</table>
						  </td>
						</tr>
						<tr>
						  <td bgcolor="#FFFFFF" colspan="4" width="100%" height="25px">
							<input type="hidden" id="Aceptar" name="Aceptar" value="0">
						    <input name="Siguiente" id="Siguiente" type="button" class="Boton" value="Aceptar" onClick="Validar_Formulario2();">
							<input name="Cancelar" type="button" class="Boton" value="Cancelar" onClick="Navegar('../Doc/Inasistencias_Nueva.php?viene=Listar&usu=<?php echo "".$pac_id;?>')">
						  </td>
						</tr>	
					  </table>
					</td>

					          <input name="htotal_L" id="htotal_L" type="hidden" value="<?php echo "".$htotal_L;?>">
							  <input name="id" id="id" type="hidden" value="<?php echo "".$_GET[usu];?>">
							  <input type="hidden" id="pac_id" name="pac_id" value="<?php echo "".$pac_id;?>">
							  <input type="hidden" id="CANT_ALUMN" name="CANT_ALUMN" value="<?php echo "".$k;?>">
							  <input type="hidden" id="CANT_SEMA" name="CANT_SEMA" value="<?php echo "".$tot_sem;?>">
							  <input type="hidden" id="CANT_INA_T" name="CANT_INA_T" value="<?php echo "".$CANT_INA_T;?>">
							  <input type="hidden" id="por_per_mat" name="por_per_mat" value="<?php echo "".$por_per_mat;?>">
							  <input type="hidden" id="ilab_per_mat" name="ilab_per_mat" value="<?php echo "".$ilab_per_mat;?>">
							  <input type="hidden" id="asi_lab" name="asi_lab" value="<?php echo "".$sec_array->asi_lab;?>">
							  
	  <input name="ase_id" id="ase_id" type="hidden" value="<?php echo "".$ase_id;?>">
      <input name="id" id="id" type="hidden" value="<?php echo "".$_GET[usu];?>">
      <input name="cual" id="cual" type="hidden" value="<?php echo "".$cual;?>">
      <input name="lab_pra" id="lab_pra" type="hidden" value="<?php echo "".$lab_pra;?>">
      <input name="por_teo" id="por_teo" type="hidden" value="<?php echo "".$por_teo;?>">
      <input name="por_lab" id="por_lab" type="hidden" value="<?php echo "".$por_lab;?>">
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
        </td>
      </tr>
    </table>
  </form>  
  <?php }
  else{
    $ase_id=$_POST[ase_id];
	$c=$ci=$_SESSION[ci];
	$cual=$_POST[cual];
	$pac_id=$_POST[pacade];
    $lab_pra=$_POST["lab_pra"];
    $por_teo=$_POST["por_teo"];
    $por_lab=$_POST["por_lab"];
	$doc_teo=$_POST["doc_teo"];
	$blo1="";
	$blo2="";
	$blo3="";
	$mod=0;
    $k=1;
    $hoy=date("Y-m-d");
/*	if(intval($ci)==intval('4205419')) echo "<script>alert('VALORES $cual; $por_teo; $por_lab; $doc_teo');</script>";*/
    $fecha=$hoy." 00:00:00";
    $fechahoy=strtotime($fecha);
	$res_fec=$NuevoHor->OperacionCualquiera("SELECT * FROM fe_ci_no WHERE pac_id='$pac_id'");
	$arr_fec=$NuevoHor->ConsultarCualquiera($res_fec);
    $fechapo=strtotime($arr_fec->fcn_ni1);
	if($fechahoy>=$fechapo && $fechapo!="" && $fechapo!=0)
	  $blo1="disabled";
    $fechapo=strtotime($arr_fec->fcn_ni2);
	if($fechahoy>=$fechapo && $fechapo!="" && $fechapo!=0)
	  $blo2="disabled";
    $fechapo=strtotime($arr_fec->fcn_ni3);
	if($fechahoy>=$fechapo && $fechapo!="" && $fechapo!=0)
	  $blo3="disabled";
/*    if(intval($ci)==intval('4205419')) echo "<script>alert('BLOQUE $blo1; $blo2; $blo3');</script>";*/
	
	$tot_sem=$_POST["CANT_SEMA"];
	$CANT_INA_T=$_POST["CANT_INA_T"];
/*	echo "<script>alert('tot_sem=$_POST[CANT_SEMA], CANT_INA_T=$_POST[CANT_INA_T], $_POST[CANT_ALUMN]');</script>";*/
	while($k<$_POST["CANT_ALUMN"]){
	  $sem=1;
	  $nom_det_id="det*".$k;
	  $det_id=$_POST[$nom_det_id];
	  $nom_cant_ina="CANT_INA*".$k;
	  $CANT_INA=$_POST[$nom_cant_ina];
	  $nom_cant_ina_lab="CANT_INA_lab*".$k;
	  $CANT_INA_lab=$_POST[$nom_cant_ina_lab];
  	  while($sem<=$tot_sem){
	    $nom_inaT="T*".$sem."*".$k;
		$nom_inaP="P*".$sem."*".$k;
		$nom_inaL="L*".$sem."*".$k;
		$nom_Bloque_inaL="Bloque_inaL".$sem."*".$k;
		$inaT=$_POST[$nom_inaT];
		$inaP=$_POST[$nom_inaP];
		$Bloque_inaL=$_POST[$nom_Bloque_inaL];	
		//-----TEORÍA-----//	
/*	echo "<script>alert('SELECT * FROM inasis WHERE pac_id=$pac_id AND det_id=$det_id AND sem_nom=$sem AND ina_tpl=0');</script>";*/
	    $RES_inas=$NuevoHor->OperacionCualquiera("SELECT * FROM inasis WHERE pac_id='$pac_id' AND det_id='$det_id' AND sem_nom='$sem' AND ina_tpl='0'");
        $filas_I=$NuevoHor->NumFilasCualquiera($RES_inas);
	    if($filas_I!=0){
		  $con_inas=$NuevoHor->ConsultarCualquiera($RES_inas);
		  if($con_inas->ina_can!=$inaT){
		    $res_ase=$NuevoHor->OperacionCualquiera("UPDATE inasis SET ina_can='$inaT' WHERE pac_id='$pac_id' AND det_id='$det_id' AND sem_nom='$sem' AND ina_tpl='0'");
	        $num_filas=$NuevoHor->filas_afectadas($res_ase);
			if($num_filas>0){
	          $mod++;
	          $accion='MODIFICAR';
              $Operacion="Inasistencias: pac_id=".$pac_id.", det_id=".$det_id.", sem_nom=".$sem."; ina_tpl=0; ina_ant=".$con_inas->ina_can."; ina_act=".$inaT;
	          $NuevoHor->guardar_accion($accion,"inasis",$Operacion);
		    }
		  }
		}
		else{
/*	echo "<script>alert('ENTRE: ');</script>";*/
		  $res_ase=$NuevoHor->OperacionCualquiera("INSERT INTO inasis (det_id,pac_id,sem_nom,ina_tpl,ina_can) VALUES ('$det_id','$pac_id','$sem','0','$inaT')");
	      $num_filas=$NuevoHor->filas_afectadas($res_ase);
		  if($num_filas>0){
	        $mod++;
	        $accion='INSERTAR';
            $Operacion="Inasistencias: pac_id=".$pac_id.", det_id=".$det_id.", sem_nom=".$sem."; ina_tpl=0; ina_ant=".$con_inas->ina_can."; ina_act=".$inaT;
	        $NuevoHor->guardar_accion($accion,"inasis",$Operacion);
		  }		  
		}
		//-----PRÁCTICA-----//
	    $RES_inas=$NuevoHor->OperacionCualquiera("SELECT * FROM inasis WHERE pac_id='$pac_id' AND det_id='$det_id' AND sem_nom='$sem' AND ina_tpl='1'");
        $filas_I=$NuevoHor->NumFilasCualquiera($RES_inas);
	    if($filas_I!=0){
		  $con_inas=$NuevoHor->ConsultarCualquiera($RES_inas);
		  if($con_inas->ina_can!=$inaP){
		    $res_ase=$NuevoHor->OperacionCualquiera("UPDATE inasis SET ina_can='$inaP' WHERE pac_id='$pac_id' AND det_id='$det_id' AND sem_nom='$sem' AND ina_tpl='1'");
	        $num_filas=$NuevoHor->filas_afectadas($res_ase);
			if($num_filas>0){
	          $mod++;
	          $accion='MODIFICAR';
              $Operacion="Inasistencias: pac_id=".$pac_id.", det_id=".$det_id.", sem_nom=".$sem."; ina_tpl=1; ina_ant=".$con_inas->ina_can."; ina_act=".$inaP;
	          $NuevoHor->guardar_accion($accion,"inasis",$Operacion);
		    }
		  }
		}
		else{
		  $res_ase=$NuevoHor->OperacionCualquiera("INSERT INTO inasis (det_id,pac_id,sem_nom,ina_tpl,ina_can) VALUES ('$det_id','$pac_id','$sem','1','$inaP')");
	      $num_filas=$NuevoHor->filas_afectadas($res_ase);
		  if($num_filas>0){
	        $mod++;
	        $accion='INSERTAR';
            $Operacion="Inasistencias: pac_id=".$pac_id.", det_id=".$det_id.", sem_nom=".$sem."; ina_tpl=1; ina_ant=0; ina_act=".$inaP;
	        $NuevoHor->guardar_accion($accion,"inasis",$Operacion);
		  }		  
		}
		//-----LABORATORIO-----//
		if($_POST["asi_lab"]==1 && $Bloque_inaL!=0){
		  $inaL=$_POST[$nom_inaL];
	      $RES_inas=$NuevoHor->OperacionCualquiera("SELECT * FROM inasis WHERE pac_id='$pac_id' AND det_id='$det_id' AND sem_nom='$sem' AND ina_tpl='2'");
          $filas_I=$NuevoHor->NumFilasCualquiera($RES_inas);
	      if($filas_I!=0){
		    $con_inas=$NuevoHor->ConsultarCualquiera($RES_inas);
		    if($con_inas->ina_can!=$inaL){
		      $res_ase=$NuevoHor->OperacionCualquiera("UPDATE inasis SET ina_can='$inaL' WHERE pac_id='$pac_id' AND det_id='$det_id' AND sem_nom='$sem' AND ina_tpl='2'");
	          $num_filas=$NuevoHor->filas_afectadas($res_ase);
			  if($num_filas>0){
	            $mod++;
	            $accion='MODIFICAR';
                $Operacion="Inasistencias: pac_id=".$pac_id.", det_id=".$det_id.", sem_nom=".$sem."; ina_tpl=2; ina_ant=".$con_inas->ina_can."; ina_act=".$inaL;
	            $NuevoHor->guardar_accion($accion,"inasis",$Operacion);
		      }
		    }
		  }
		  else{
		    $res_ase=$NuevoHor->OperacionCualquiera("INSERT INTO inasis (det_id,pac_id,sem_nom,ina_tpl,ina_can) VALUES ('$det_id','$pac_id','$sem','2','$inaL')");
	        $num_filas=$NuevoHor->filas_afectadas($res_ase);
		    if($num_filas>0){
	          $mod++;
	          $accion='INSERTAR';
              $Operacion="Inasistencias: pac_id=".$pac_id.", det_id=".$det_id.", sem_nom=".$sem."; ina_tpl=2; ina_ant=0; ina_act=".$inaL;
	          $NuevoHor->guardar_accion($accion,"inasis",$Operacion);
		    }
		  }
		}
		$sem++;
	  }		
	  $POR_INA=$CANT_INA*100/$CANT_INA_T;
      $res_deti=$NuevoHor->OperacionCualquiera("SELECT * FROM detins WHERE pac_id='$pac_id' AND det_id='$det_id'");
	  $arrat_det=$NuevoHor->ConsultarCualquiera($res_deti);
	  $num_filas=0;
	  if($POR_INA>=25 || $CANT_INA_lab>=2){
	    if($arrat_det->obs_id!='10'){
	      $res_ase=$NuevoHor->OperacionCualquiera("UPDATE detins SET obs_id='10',det_con='0' WHERE pac_id='$pac_id' AND det_id='$det_id'");
	      $num_filas=$NuevoHor->filas_afectadas($res_ase);
		}
	  }
	  else{
	    if($arrat_det->obs_id=='10'){
/*	  	  echo "<script>alert('ENTRE');</script>";*/
	      $res_ase=$NuevoHor->OperacionCualquiera("UPDATE detins SET obs_id='1' WHERE pac_id='$pac_id' AND det_id='$det_id'");
		  $num_filas=$NuevoHor->filas_afectadas($res_ase);
		}
	  }
	  if($num_filas>0){
        $mod++;
        $accion='MODIFICAR';
        $Operacion="Observación de detins: det_id=".$det_id.", obs_ant=".$obs_ant."; obs_act=".$obs_act."";
        $NuevoHor->guardar_accion($accion,"detins",$Operacion);
	  }
	  $k++;
	}
	if($mod==0){
	  echo "<script>alert('LO SIENTO NO SE HA REALIZADO NINGÚN CAMBIO DE INASISTENCI EN LA SECCIÓN SELECCIONADA POR FAVOR VERIFIQUE LOS DATOS');</script>";	  
	}
	else{
      echo "<script>alert('SE HAN PROCESADO LOS CAMBIO DE INASISTENCIA EN LA SECCIÓN SELECCIONADA PERO SE LE AGRADECE QUE VERIFIQUE LOS CAMBIOS');</script>";
	}
    echo "<script>setTimeout(\"location.href='../Doc/Inasistencias_Nueva.php?ayu=".$_POST[ayu]."&viene=Listar&usu=".$_POST[pac_id]."'\");</script>";
  }?>
</body>
<?php
}
else{
echo "<script>alert('SU SESIÓN HA SIDO CERRADA');</script>";
echo "<script>setTimeout(\"location.href='../'\");</script>";
}
?>
</html>