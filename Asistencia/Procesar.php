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
//--------------------------------------
function ConvertirLet(num){
//alert('numero '+num);
  let="";
  if(num!=""){
    if(num==1)
	  let="UNO";
    if(num==2)
	  let="DOS";
    if(num==3)
	  let="TRES";
    if(num==4)
	  let="CUATRO";
    if(num==5)
	  let="CINCO";
    if(num==6)
	  let="SEIS";
    if(num==7)
	  let="SIETE";
    if(num==8)
	  let="OCHO";
    if(num==9)
	  let="NUEVE";
    if(num==10)
	  let="DIEZ";
    if(num==11)
	  let="ONCE";
    if(num==12)
	  let="DOCE";
    if(num==13)
	  let="TRECE";
    if(num==14)
	  let="CATORCE";
    if(num==15)
	  let="QUINCE";
    if(num==16)
	  let="DIECISEIS";
    if(num==17)
	  let="DIECISIETE";
    if(num==18)
	  let="DIECIOCHO";
    if(num==19)
	  let="DIECINUEVE";
    if(num==20)
	  let="VEINTE";
  }
  return let;
}
//--------------------------------------
function Cambiar_por(obj){
// alert(" ENTRE ");
  cual=obj.name.split("n");
  num=cual[1].split("*");
  val=obj.value;
  p="p"+num[0];
  cam="p"+cual[1];
// alert(" "+p+" "+cam);
  if(val=="NP")
    total="";
  else{
    por=document.getElementById(p).value;
    if(parseInt(val)==0){
      val1=obj.value.split("0");
      val=val1[1];
    }
    total=parseInt(val)*parseInt(por)/parseInt(100);
  }
  pra=10;
  min_teo=10;
  //SUMAR LA TEORIA, SACAR DEFINITIVA Y LA LETRA
  document.getElementById(cam).value=total;
  cant_lab=document.getElementById("cant_lab").value;
  cant_teo=document.getElementById("cant_teo").value;
//   alert(" "+p+" "+cam+" can_lab"+cant_lab);
  p11="p11*"+num[1];  p12="p12*"+num[1];  p13="p13*"+num[1];
  p21="p21*"+num[1];  p22="p22*"+num[1];  p23="p23*"+num[1];
  p31="p31*"+num[1];  p32="p32*"+num[1];  p33="p33*"+num[1];
  vp11="p11";  vp12="p12";  vp13="p13";
  vp21="p21";  vp22="p22";  vp23="p23";
  vp31="p31";  vp32="p32";  vp33="p33";
  o_p11=document.getElementById(p11).value; if(o_p11=="") o_p11=0;
  o_p12=document.getElementById(p12).value; if(o_p12=="") o_p12=0;
  o_p13=document.getElementById(p13).value; if(o_p13=="") o_p13=0;
  o_p21=document.getElementById(p21).value; if(o_p21=="") o_p21=0;
  o_p22=document.getElementById(p22).value; if(o_p22=="") o_p22=0;
  o_p23=document.getElementById(p23).value; if(o_p23=="") o_p23=0;
  o_p31=document.getElementById(p31).value; if(o_p31=="") o_p31=0;
  o_p32=document.getElementById(p32).value; if(o_p32=="") o_p32=0;
  o_p33=document.getElementById(p33).value; if(o_p33=="") o_p33=0;
  v_p11=document.getElementById(vp11).value; if(v_p11=="") v_p11=0;
  v_p12=document.getElementById(vp12).value; if(v_p12=="") v_p12=0;
  v_p13=document.getElementById(vp13).value; if(v_p13=="") v_p13=0;
  v_p21=document.getElementById(vp21).value; if(v_p21=="") v_p21=0;
  v_p22=document.getElementById(vp22).value; if(v_p22=="") v_p22=0;
  v_p23=document.getElementById(vp23).value; if(v_p23=="") v_p23=0;
  v_p31=document.getElementById(vp31).value; if(v_p31=="") v_p31=0;
  v_p32=document.getElementById(vp32).value; if(v_p32=="") v_p32=0;
  v_p33=document.getElementById(vp33).value; if(v_p33=="") v_p33=0;
  //alert("p11 "+o_p11+" p12: "+o_p12+" p13: "+o_p13+" p21 "+o_p21+" p22: "+o_p22+" p23: "+o_p23+" p31 "+o_p31+" p32: "+o_p32+" p33: "+o_p33);
  sum=parseFloat(o_p11)+parseFloat(o_p12)+parseFloat(o_p13)+parseFloat(o_p21)+parseFloat(o_p22)+parseFloat(o_p23)+parseFloat(o_p31)+parseFloat(o_p32)+parseFloat(o_p33);
  vsum=parseFloat(v_p11)+parseFloat(v_p12)+parseFloat(v_p13)+parseFloat(v_p21)+parseFloat(v_p22)+parseFloat(v_p23)+parseFloat(v_p31)+parseFloat(v_p32)+parseFloat(v_p33);
  var def;
//  	alert(" "+cant_lab+" HELLO");
  if(cant_lab>0 && cant_teo>0){
    total=parseFloat(0);
    teoria="teo*"+num[1];
	pla="pla*"+num[1];
	vpla="pla";
	o_pla=document.getElementById(pla).value; if(o_pla=="") o_pla=0;
	v_pla=document.getElementById(vpla).value; if(v_pla=="") v_pla=0;
	NOT=(parseFloat(1)*parseFloat(v_pla))/parseFloat(100);
    comp_lab=parseFloat(o_pla);
	compa_lab=parseFloat(comp_lab)*parseFloat(1)/parseFloat(NOT);
	compa_pra=parseFloat(sum);
    pra=parseFloat(compa_pra)*parseFloat(100)/parseFloat(vsum);
	min_lab=parseFloat(10);
	min_teo=parseFloat(10);
/*	compa_lab=parseFloat(o_pla);
	compa_pra=parseFloat(sum);
	pra=parseFloat(compa_pra)*parseFloat(100)/parseFloat(vsum);
	min_lab=parseFloat(10)*v_pla/100;
	min_teo=parseFloat(10)*vsum/100;*/
//	alert(" "+NOT+" "+comp_lab+" "+compa_lab+" "+compa_pra+" "pra+" HELLO");
//		alert("LAB>=MIN "+compa_lab+">= "+min_lab+" ");
	if(parseFloat(compa_lab)>=parseFloat(min_lab)){
//		alert("SINO pra>=MIN "+pra+">= "+min_teo+" ");
	  if(parseFloat(pra)>=parseFloat(min_teo)){
	    total=parseFloat(comp_lab)+parseFloat(compa_pra);
	  }
	  else{
//		alert("SINO pra>=MIN "+pra+">= "+compa_lab+" ");
	    if(parseFloat(pra)>=parseFloat(compa_lab)){
		  total=parseFloat(compa_lab);
		}
		else{
//		alert("SINO pra>=compa_lab "+pra+" ");
		  total=parseFloat(pra);
		}
	  }
	}
	else{
//		alert("SINO LAB>=MIN "+pra+">= "+compa_lab+" ");
	  if(parseFloat(pra)>=parseFloat(compa_lab)){
		total=parseFloat(compa_lab);
	  }
	  else{
//		alert("SINO pra>=compa_lab "+pra+" ");
	    total=parseFloat(pra);
	  }
	}
	document.getElementById(teoria).value=parseFloat(sum);
	teo=parseFloat(sum);
//			alert("TOTAL "+total+" ");
	def=Math.round(parseFloat(total));
  }
  else{
    def=Math.round(parseFloat(sum));
  }
  if(def<1){
    def=1;
  }
  if(def==10 && cant_lab>0 && parseFloat(pra)<parseFloat(min_teo))
    def=10-1;
  //alert("DEFINITIVA "+def+" SUMA: "+sum);
  let=ConvertirLet(parseInt(def));
  defini="def*"+num[1];
  letra="let*"+num[1];
  document.getElementById(defini).value=parseInt(def);
  document.getElementById(letra).value=let;
  document.getElementById(letra).title=let;
// alert(""+val+" "+por+" "+total);   
}
//--------------------------------------
function Validar_Formulario2(){
//alert('ENTRE A VALIDAR FORM 2');
  formulario = document.forms["form"];
  formulario.submit();
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
  //$array2->hor_id."*".$infrae."*".$pac_id."*".$asi_cod."*".$asi_nom
  $hor_id=$clave[0];
  $pac_id=$clave[2];
  $infrae=$clave[1];
  $asi_cod=$clave[3];
  $asi_nom=$clave[4];
  $pensum_sionalum=0;
  $dbh_tip=0;
  $NuevoHor = new nota("","",$asi_cod,"","","","",$pac_id,"","","","",$infrae,"");
  $NuevoHor->conec_BD();
  $NuevoHor->conectar_BD();
  include ("../Clases/class.plantilla.php");
  $Plantilla = new plantilla("","","");?>
<body bgcolor="#a9c3e8" leftmargin="0" rightmargin="0" topmargin="0">
<?php if(!isset($_POST[Aceptar]) &&  !isset($_POST[id])){?>
  <form action="Procesar.php" method="post" enctype="multipart/form-data" name="form" id="form">
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
/*  	echo "<script>alert('$infrae,$asi_cod,$asi_nom,$hor_id,$ci');</script>";*/
    $res_asi=$NuevoHor->OperacionCualquiera("SELECT DISTINCT(asi_cod), asi_cht, asi_chp, asi_chl FROM asigna WHERE asi_cod='$asi_cod' AND asi_nom='$asi_nom'");
    $asigna=$NuevoHor->ConsultarCualquiera($res_asi);
    $teo=$asigna->asi_cht;
    $pra=$asigna->asi_chp;
    $lab=$asigna->asi_chl;
	$cant_teo=0;
	$cant_pra=0;
	$cant_lab=0;
	$selec_pensum=0;
	$selec_dbh=0;
	$selec_aula=0;
/*	echo "<script>alert(' OJO $cant_teo,$cant_pra,$cant_lab ');</script>";*/
    $resultado=$NuevoHor->Listado_Infrae_Nucleo($infrae);
	$array=$NuevoHor->ConsultarCualquiera($resultado);
	$pac_nom=$NuevoHor->Buscar_pacade1($pac_id);?>
      <tr>
        <td colspan="3" width="100%">
    	  <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="1" width="100%"><div id="container2">
                <table style="width: 1150px; text-align: center; margin-left: auto; margin-right: auto; margin-center: auto;" border="0" cellpadding="0" cellspacing="0" align="center">
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr>
                    <td width="100%">
			    	  <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;" border="1" bordercolor="#777A4B" bgcolor="#ffffff">
						<tr><td colspan="4" bgcolor="#000066"><span class="Estilo1">:: PROCESAR ACTAS DE NOTAS POR ASIGNATURA Y PENSUM PARA EL PER&Iacute;ODO ACAD&Eacute;MICO <?php echo "".$pac_nom;?></span></td></tr>
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
<?php
      $ci="";
	  $result=$NuevoHor->OperacionCualquiera("SELECT DISTINCT (A.esp_id) AS esp_id, A.ci AS 'ci', B.esp_nom AS esp_nom, A.reg_id AS reg_id, E.reg_nom AS reg_nom, A.mod_id AS mod_id, C.mod_nom AS mod_nom, A.coh_id AS coh_id, D.coh_nom AS coh_nom, A.pac_id AS pac_id, A.sec_id AS sec_id, F.sec_nom AS sec_nom, A.hor_id AS hor_id FROM horario A, especi B, modali C, cohort D, regimen E, seccio F WHERE A.esp_id=B.esp_id AND A.mod_id=C.mod_id AND A.coh_id=D.coh_id AND A.reg_id=E.reg_id AND A.sec_id=F.sec_id AND A.hor_sta = '1' AND F.inf_id = '$infrae' AND A.pac_id = '$pac_id' AND hor_id='$hor_id'");
	  $selec_pensum=$NuevoHor->NumFilasCualquiera($result);
	  $lis_alum="";
	  $lis_alum1="";
      while($array2=$NuevoHor->ConsultarCualquiera($result)){
	    if($ci==""){
		  $ci=$array2->ci;
		  $contar=$NuevoHor->OperacionCualquiera("SELECT COUNT(hor_tpl) AS teo FROM horario WHERE dbh_tip='$dbh_tip' AND pac_id='$pac_id' AND hor_id='$hor_id' AND hor_sta='1' AND ci='$ci' AND hor_tpl='0'");
	      $cuan=$NuevoHor->ConsultarCualquiera($contar);
	      $cant_teo=$cuan->teo;
		  $contar=$NuevoHor->OperacionCualquiera("SELECT COUNT(hor_tpl) AS pra FROM horario WHERE dbh_tip='$dbh_tip' AND pac_id='$pac_id' AND hor_id='$hor_id' AND hor_sta='1' AND ci='$ci' AND hor_tpl='1'");
	      $cuan=$NuevoHor->ConsultarCualquiera($contar);
	      $cant_pra=$cuan->pra;
	      $contar=$NuevoHor->OperacionCualquiera("SELECT COUNT(hor_tpl) AS lab FROM horario WHERE dbh_tip='$dbh_tip' AND pac_id='$pac_id' AND hor_id='$hor_id' AND hor_sta='1' AND ci='$ci' AND hor_tpl='2'");
	      $cuan=$NuevoHor->ConsultarCualquiera($contar);
	      $cant_lab=$cuan->lab;
		  $res_ase=$NuevoHor->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE esp_id='$array2->esp_id' AND mod_id='$array2->mod_id' AND coh_id='$array2->coh_id' AND reg_id='$array2->reg_id' AND sec_id='$array2->sec_id' AND pac_id='$pac_id' AND asi_cod='$asi_cod' AND ci_emp='$ci' AND ase_sta='1'");
		  $arr_ase=$NuevoHor->ConsultarCualquiera($res_ase);
		  $res_fec=$NuevoHor->OperacionCualquiera("SELECT * FROM fe_ci_no WHERE pac_id='$pac_id'");
		  $arr_fec=$NuevoHor->ConsultarCualquiera($res_fec);
/*		  echo "<script>alert('f11 $arr_ase->ase_f11');</script>";*/
		  $result_doc=$NuevoHor->OperacionCualquiera("SELECT * FROM persona WHERE ci='$ci'");
          $array_doc=$NuevoHor->ConsultarCualquiera($result_doc);
		  $ap_nom=strtoupper($array_doc->ap1." ".$array_doc->ap2." ".$array_doc->ap3.", ".$array_doc->no1." ".$array_doc->no2." ".$array_doc->no3);?>
						<tr>
					      <td bgcolor="#FFFFFF" width="20%"><div align="right" class="Estilo9">Documento de Identificaci&oacute;n del Docente:</div></td>
					      <td bgcolor="#FFFFFF" width="30%" align="char"><div align="left" class="Estilo2"><?php echo "".$ci;?></div></td>
					      <td bgcolor="#FFFFFF" width="20%"><div align="right" class="Estilo9">Apellido(s) y Nombre(s) del Docente:</div></td>
					      <td bgcolor="#FFFFFF" width="30%"><div align="left" class="Estilo2"><?php echo "".$ap_nom;?></div></td>
						</tr>
	                    <tr><td colspan="4" bgcolor="#000066"><span class="Estilo18">LISTADO DE HORARIO DE SECCIONES POR LA ASIGNATURA SELECCIONADA</span></td></tr>
						<tr>
						  <td colspan="4">
						    <table style="width: 100%; text-align: center;" border="1">
							  <tr>
							    <td bgcolor="#FFFFFF" width="20%"><div align="center" class="Estilo9">MODALIDAD</div></td>
							    <td bgcolor="#FFFFFF" width="20%"><div align="center" class="Estilo9">R&Eacute;GIMEN</div></td>
							    <td bgcolor="#FFFFFF" width="30%"><div align="center" class="Estilo9">ESPECIALIDAD</div></td>
							    <td bgcolor="#FFFFFF" width="15%"><div align="center" class="Estilo9">COHORTE</div></td>
							    <td bgcolor="#FFFFFF" width="15%"><div align="center" class="Estilo9">SECCI&Oacute;N</div></td>
							  </tr>		  
<?php
		}
/*echo "<script>alert('SELECT ci_est FROM detins WHERE esp_id=$array2->esp_id AND mod_id=$array2->mod_id AND coh_id=$array2->coh_id AND reg_id=$array2->reg_id AND sec_id=$array2->sec_id AND pac_id=$pac_id AND asi_cod=$asi_cod AND det_sta=1');</script>";*/
		$res_alu=$NuevoHor->OperacionCualquiera("SELECT ci_est FROM detins WHERE esp_id='$array2->esp_id' AND mod_id='$array2->mod_id' AND coh_id='$array2->coh_id' AND reg_id='$array2->reg_id' AND sec_id='$array2->sec_id' AND pac_id='$pac_id' AND asi_cod='$asi_cod' AND det_sta='1'");
		$NUM_alu=$NuevoHor->NumFilasCualquiera($res_alu);
/*echo "<script>alert('$NUM_alu==0 && $selec_pensum==1, $pensum_sionalum');</script>";*/
if($NUM_alu==0){
$pensum_sionalum++;
}
		if($selec_pensum==$pensum_sionalum){
		  echo "<script>alert('LO SIENTO ESTA SECCIÓN NO TIENE ALUMNOS INSCRITOS');</script>";
          echo "<script>setTimeout(\"location.href='../Doc/Notas.php?ayu=".$_POST[ayu]."&viene=Modificar&usu=".$pac_id."*".$infrae."*".$asi_cod."*".$asi_nom."'\");</script>";
		}
		else{
		while($arr_alu=$NuevoHor->ConsultarCualquiera($res_alu)){
		  if($lis_alum==""){
		    $lis_alum="'".$arr_alu->ci_est."'";
			$lis_alum1="".$arr_alu->ci_est."";
		  }
		  else{
		    $lis_alum=$lis_alum.",'".$arr_alu->ci_est."'";
			$lis_alum1=$lis_alum1.",".$arr_alu->ci_est."";
	      }
		}
		}
		/*echo "<script>alert(' LISTA DE ALUMNOS INSCRITOS $lis_alum1');</script>";*/
	    $nom=$array2->mod_id."*".$array2->reg_id."*".$array2->esp_id."*".$array2->coh_id."*".$array2->sec_id;?>
							  <tr>
								<td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2">
								<?php echo "".$array2->mod_nom;?>
								<input type="checkbox" name="<?php echo "PENSUM*".$nom;?>" id="<?php echo "PENSUM".$nom;?>" value="<?php echo "".$nom;?>" onChange="Cambiar_cant_pensum(this);" style="visibility:hidden"></div></td>
								<td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$array2->reg_nom;?></div></td>
								<td bgcolor="#FFFFFF" width="30%"><div align="left" class="Estilo2"><?php echo "".$array2->esp_nom;?></div></td>
								<td bgcolor="#FFFFFF" width="15%"><div align="left" class="Estilo2"><?php echo "".$array2->coh_nom;?></div></td>
								<td bgcolor="#FFFFFF" width="15%"><div align="left" class="Estilo2"><?php echo "".$array2->sec_nom;?></div></td>
							  </tr>
	  <?php
	  }?>
							</table>
						  </td>
						</tr>
						<tr><td colspan="4" bgcolor="#000066"><span class="Estilo18">ACTA DE NOTAS</span></td></tr>
						<tr>
						  <td align="center" colspan="4">
						    <table align="center" width="100%" border="1">
							  <tr>
							    <td bgcolor="#FFFFFF" rowspan="3" width="5%"><div align="center" class="Estilo9">CEDULA</div></td>
							    <td bgcolor="#FFFFFF" rowspan="3" width="30%"><div align="center" class="Estilo9">APELLIDO(S) Y NOMBRE(S)</div></td>
								<td colspan="6" bgcolor="#FFFFFF" width="15%"><div align="center" class="Estilo9">PRIMER CORTE</div></td>
								<td colspan="6" bgcolor="#FFFFFF" width="15%"><div align="center" class="Estilo9">SEGUNDO CORTE</div></td>
								<td colspan="6" bgcolor="#FFFFFF" width="15%"><div align="center" class="Estilo9">TERCER CORTE</div></td>
								<?php if($cant_lab>0 && $cant_teo>0){?>
								<td rowspan="3" bgcolor="#FFFFFF" width="5%" title="SUMA DE TEORIA"><div align="center" class="Estilo9">TEO</div></td>
								<td rowspan="2" colspan="2" bgcolor="#FFFFFF" width="10%"><div align="center" class="Estilo9">LABORATORIO</div></td>
								<?php }?>
                                <td rowspan="3" bgcolor="#FFFFFF" width="5%" title="DEFINITIVA"><div align="center" class="Estilo9">DEF</div></td>
                                <td rowspan="3" bgcolor="#FFFFFF" width="5%"><div align="center" class="Estilo9">LETRAS</div></td>
							  </tr>
							  <?php
	                            $hoy=date("Y-m-d");
								$enc_11=$enc_12=$enc_13=$enc_21=$enc_22=$enc_23=$enc_31=$enc_32=$enc_33=0;
	                            $fecha=$hoy." 00:00:00";
								$fechahoy=strtotime($fecha);
								  if($arr_ase->ase_f11!=""){ $fech1=$NuevoHor->fechaNormal($arr_ase->ase_f11);
								    $fechano1=strtotime($arr_ase->ase_f11);
									if($fechano1>$fechahoy)
									  $enc_11=1;
								  }
								  else $fech1="";
								  if($arr_ase->ase_f12!=""){ $fech2=$NuevoHor->fechaNormal($arr_ase->ase_f12); 
								    $fechano2=strtotime($arr_ase->ase_f12);
									if($fechano2>$fechahoy)
									  $enc_12=1;
								  }
								  else $fech2="";
								  if($arr_ase->ase_f13!=""){ $fech3=$NuevoHor->fechaNormal($arr_ase->ase_f13); 
								    $fechano3=strtotime($arr_ase->ase_f13);
									if($fechano3>$fechahoy)
									  $enc_13=1;
								  }
								  else $fech3="";
/*								  echo "<script>alert('$fechahoy, $fechano1, $fechano2, $fechano3');</script>"*/;
							  ?>
							  <tr>
							    <td colspan="2" bgcolor="#FFFFFF"><div align="center" class="Estilo9"><?php echo "".$fech1;?><input type="hidden" value="<?php echo "".$arr_ase->ase_f11;?>" name="f11" id="f11"></div></td>
								<td colspan="2" bgcolor="#FFFFFF"><div align="center" class="Estilo9"><?php echo "".$fech2;?><input type="hidden" value="<?php echo "".$arr_ase->ase_f12;?>" name="f12" id="f12"></div></td>
								<td colspan="2" bgcolor="#FFFFFF"><div align="center" class="Estilo9"><?php echo "".$fech3;?><input type="hidden" value="<?php echo "".$arr_ase->ase_f13;?>" name="f13" id="f13"></div></td>
								<?php
								  if($arr_ase->ase_f21!=""){ $fech1=$NuevoHor->fechaNormal($arr_ase->ase_f21);
								    $fechano1=strtotime($arr_ase->ase_f21);
									if($fechano1>$fechahoy)
									  $enc_21=1;
								  }
								  else $fech1="";
								  if($arr_ase->ase_f22!=""){ $fech2=$NuevoHor->fechaNormal($arr_ase->ase_f22);
								    $fechano2=strtotime($arr_ase->ase_f22);
									if($fechano2>$fechahoy)
									  $enc_22=1;
								  }
								  else $fech2="";
								  if($arr_ase->ase_f23!=""){ $fech3=$NuevoHor->fechaNormal($arr_ase->ase_f23);
								    $fechano3=strtotime($arr_ase->ase_f23);
									if($fechano3>$fechahoy)
									  $enc_23=1;
								  }
								  else $fech3="";?>
							    <td colspan="2" bgcolor="#FFFFFF"><div align="center" class="Estilo9"><?php echo "".$fech1;?><input type="hidden" value="<?php echo "".$arr_ase->ase_f21;?>" name="f21" id="f21"></div></td>
								<td colspan="2" bgcolor="#FFFFFF"><div align="center" class="Estilo9"><?php echo "".$fech2;?><input type="hidden" value="<?php echo "".$arr_ase->ase_f22;?>" name="f22" id="f22"></div></td>
								<td colspan="2" bgcolor="#FFFFFF"><div align="center" class="Estilo9"><?php echo "".$fech3;?><input type="hidden" value="<?php echo "".$arr_ase->ase_f23;?>" name="f23" id="f23"></div></td>
								<?php
								  if($arr_ase->ase_f31!=""){ $fech1=$NuevoHor->fechaNormal($arr_ase->ase_f31);
								    $fechano1=strtotime($arr_ase->ase_f31);
									if($fechano1>$fechahoy)
									  $enc_31=1;
								  }
								  else $fech1="";
								  if($arr_ase->ase_f32!=""){ $fech2=$NuevoHor->fechaNormal($arr_ase->ase_f32);
								    $fechano2=strtotime($arr_ase->ase_f32);
									if($fechano2>$fechahoy)
									  $enc_32=1;
								  }
								  else $fech2="";
								  if($arr_ase->ase_f33!=""){ $fech3=$NuevoHor->fechaNormal($arr_ase->ase_f33);
								    $fechano3=strtotime($arr_ase->ase_f33);
									if($fechano3>$fechahoy)
									  $enc_33=1;
								  }
								  else $fech3="";?>
							    <td colspan="2" bgcolor="#FFFFFF"><div align="center" class="Estilo9"><?php echo "".$fech1;?><input type="hidden" value="<?php echo "".$arr_ase->ase_f31;?>" name="f31" id="f31"></div></td>
								<td colspan="2" bgcolor="#FFFFFF"><div align="center" class="Estilo9"><?php echo "".$fech2;?><input type="hidden" value="<?php echo "".$arr_ase->ase_f32;?>" name="f32" id="f32"></div></td>
								<td colspan="2" bgcolor="#FFFFFF"><div align="center" class="Estilo9"><?php echo "".$fech3;?><input type="hidden" value="<?php echo "".$arr_ase->ase_f33;?>" name="f33" id="f33"></div></td>
							  </tr>
							  <tr>
							    <td align="center" title="PRUEBA CORTA" bgcolor="#99CCFF"><div align="center" class="Estilo9">PC</div></td>
								<td align="center"><div align="center" class="Estilo9"><?php echo "".$arr_ase->ase_p11."%";?><input type="hidden" value="<?php echo "".$arr_ase->ase_p11;?>" name="p11" id="p11"></div></td>
							    <td align="center" title="PRUEBA PARCIAL" bgcolor="#CCFF99"><div align="center" class="Estilo9">PP</div></td>
								<td align="center"><div align="center" class="Estilo9"><?php echo "".$arr_ase->ase_p12."%";?><input type="hidden" value="<?php echo "".$arr_ase->ase_p12;?>" name="p12" id="p12"></div></td>
							    <td align="center" title="PRUEBA DEL AULA VIRTUAL" bgcolor="#FFFF99"><div align="center" class="Estilo9">AV</div></td>
								<td align="center"><div align="center" class="Estilo9"><?php echo "".$arr_ase->ase_p13."%";?><input type="hidden" value="<?php echo "".$arr_ase->ase_p13;?>" name="p13" id="p13"></div></td>
							    <td align="center" title="PRUEBA CORTA" bgcolor="#99CCFF"><div align="center" class="Estilo9">PC</div></td>
								<td align="center"><div align="center" class="Estilo9"><?php echo "".$arr_ase->ase_p21."%";?><input type="hidden" value="<?php echo "".$arr_ase->ase_p21;?>" name="p21" id="p21"></div></td>
							    <td align="center" title="PRUEBA PARCIAL" bgcolor="#CCFF99"><div align="center" class="Estilo9">PP</div></td>
								<td align="center"><div align="center" class="Estilo9"><?php echo "".$arr_ase->ase_p22."%";?><input type="hidden" value="<?php echo "".$arr_ase->ase_p22;?>" name="p22" id="p22"></div></td>
							    <td align="center" title="PRUEBA DEL AULA VIRTUAL" bgcolor="#FFFF99"><div align="center" class="Estilo9">AV</div></td>
								<td align="center"><div align="center" class="Estilo9"><?php echo "".$arr_ase->ase_p23."%";?><input type="hidden" value="<?php echo "".$arr_ase->ase_p23;?>" name="p23" id="p23"></div></td>
							    <td align="center" title="PRUEBA CORTA" bgcolor="#99CCFF"><div align="center" class="Estilo9">PC</div></td>
								<td align="center"><div align="center" class="Estilo9"><?php echo "".$arr_ase->ase_p31."%";?><input type="hidden" value="<?php echo "".$arr_ase->ase_p31;?>" name="p31" id="p31"></div></td>
							    <td align="center" title="PRUEBA PARCIAL" bgcolor="#CCFF99"><div align="center" class="Estilo9">PP</div></td>
								<td align="center"><div align="center" class="Estilo9"><?php echo "".$arr_ase->ase_p32."%";?><input type="hidden" value="<?php echo "".$arr_ase->ase_p32;?>" name="p32" id="p32"></div></td>
							    <td align="center" title="PRUEBA DEL AULA VIRTUAL" bgcolor="#FFFF99"><div align="center" class="Estilo9">AV</div></td>
								<td align="center"><div align="center" class="Estilo9"><?php echo "".$arr_ase->ase_p33."%";?><input type="hidden" value="<?php echo "".$arr_ase->ase_p33;?>" name="p33" id="p33"></div></td>
								<?php if($cant_lab>0 && $cant_teo>0){?>								
							    <td align="center" title="PRUEBA DE LABORATORIO" bgcolor="#FFCCFF"><div align="center" class="Estilo9">LAB</div></td>
								<td align="center"><div align="center" class="Estilo9"><?php echo "".$arr_ase->ase_pla."%";?><input type="hidden" value="<?php echo "".$arr_ase->ase_pla;?>" name="pla" id="pla"></div></td>
								<?php }?>
							  </tr>
							  <?php
							  $blo="";
/*echo "<script>alert('SELECT ci, concat(ap1, ,ap2, ,no1, ,no2) AS ape FROM persona WHERE ci IN($lis_alum1) AND sta=1 ORDER BY ap1,ap2,no1,no2,ci');</script>";*/
							  $res_pers=$NuevoHor->OperacionCualquiera("SELECT ci, concat(ap1,' ',ap2,', ',no1,' ',no2) AS ape FROM persona WHERE ci IN($lis_alum) AND sta='1' ORDER BY ap1,ap2,no1,no2,ci");
							  $k=1;
							  $num_alu=$NuevoHor->NumFilasCualquiera($res_pers);
/*							  echo "<script>alert('OJO $num_alu');</script>";*/
							  if($num_alu==0){
		  echo "<script>alert('LO SIENTO ESTA SECCIÓN NO TIENE ALUMNOS INSCRITOS');</script>";
          echo "<script>setTimeout(\"location.href='../Doc/Notas.php?ayu=".$_POST[ayu]."&viene=Modificar&usu=".$pac_id."*".$infrae."*".$asi_cod."*".$asi_nom."'\");</script>";							  
							  }
							  while($arr_pers=$NuevoHor->ConsultarCualquiera($res_pers)){
							    $sum=(float) 0.0;
								$let="";
							    $res_detins=$NuevoHor->OperacionCualquiera("SELECT * FROM detins WHERE pac_id='$pac_id' AND asi_cod='$asi_cod' AND det_sta='1' AND ci_est='$arr_pers->ci'");
								$arr_det=$NuevoHor->ConsultarCualquiera($res_detins);?>
							  <tr>
								<td align="center"><div align="left" class="Estilo2"><?php echo "".$arr_pers->ci;?></div></td>
								<td align="center"><div align="left" class="Estilo2"><?php echo "".strtoupper($arr_pers->ape);?></div></td>								
								<?php
                                $fechano=strtotime($arr_fec->fcn_ni1);
								$bloc="";
								$c=$_SESSION[ci];
								if($fechahoy>=$fechano){//&& ($c!='11112911' && $c!='11976831' &&  $c!='7244961' &&  $c!='12227175' &&  $c!='10163903' &&  $c!='5219806' &&  $c!='12630221' &&  $c!='11106827' &&  $c!='11500512' &&  $c!='16229342')){
								  $bloc="disabled";
								}
								$block="";
								if($enc_11==1)
								  $block="disabled";								
								$blo="";
								if($bloc!="" || $block!="")
								  $blo="disabled";
/*echo "<script>alert('$fechahoy>=$fechano, $blo, $arr_fec->fcn_ni1');</script>";*/?>
								<td align="center" bgcolor="#99CCFF"><div align="center" class="Estilo9">
								  <select name="<?php echo "n11*".$k;?>" id="<?php echo "n11*".$k;?>" <?php echo "".$blo;?> onChange="Cambiar_por(this);" style="size:9px; font-size:9px">
								    <?php
								$por="";
/*echo "<script>alert('$arr_det->det_n11, $arr_det->det_n12, $arr_det->det_n13,$arr_det->det_n21, $arr_det->det_n22, $arr_det->det_n23,$arr_det->det_n31, $arr_det->det_n32, $arr_det->det_n33');</script>";*/
								$i=1;
								if($arr_det->det_n11==""){
									$por=(1*$arr_ase->ase_p11)/100;
									$sum=$sum+$por;?>
									<option value="01">01</option>
									<?php }
								$i=1;
								while(20>=$i){
								  if($i<=9) $n="0".$i; else $n="".$i;
								  $nota=md5($n);
								  if($arr_det->det_n11==$nota){
								    $por=($i*$arr_ase->ase_p11)/100;
									$sum=$sum+$por;
									/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
								  }
								  if($i!=1 || $arr_det->det_n11!=""){?>
								    <option  value="<?php echo "".$n;?>" <?php if($arr_det->det_n11==$nota) echo "selected";?>><?php echo "".$n;?></option>
							    <?php
								  }
								  $i++;
								}
								?>
								  </select>
								</div></td>
								<td align="center"><div align="center" class="Estilo9"><input type="text" value="<?php echo "".$por;?>" name="<?php echo "p11*".$k;?>" id="<?php echo "p11*".$k;?>" size="4" style="font-size:9px;" readonly maxlength="6"></div></td>
								<?php								
								$block="";
								if($enc_12==1)
								  $block="disabled";								
								$blo="";
								if($bloc!="" || $block!="")
								  $blo="disabled";
								?>
								<td align="center" bgcolor="#CCFF99"><div align="center" class="Estilo9">
								  <select name="<?php echo "n12*".$k;?>" id="<?php echo "n12*".$k;?>" <?php echo "".$blo;?>  onChange="Cambiar_por(this);" style="size:9px; font-size:9px;">
								    <?php
								$por="";
								if($arr_det->det_n12==""){
									$por=(1*$arr_ase->ase_p12)/100;
									$sum=$sum+$por;?>
									<option value="01">01</option>
									<?php }
								$i=1;
								while(20>=$i){
								  if($i<=9) $n="0".$i; else $n="".$i;
								  $nota=md5($n);
								  if($arr_det->det_n12==$nota){
								    $por=$i*$arr_ase->ase_p12/100;									
									$sum=$sum+$por;
								  }
								  if($i!=1 || $arr_det->det_n12!=""){?>
								    <option  value="<?php echo "".$n;?>" <?php if($arr_det->det_n12==$nota) echo "selected";?>><?php echo "".$n;?></option>
							    <?php
								  }
								  $i++;
								}
								?>
								  </select>
								</div></td>
								<td align="center"><div align="center" class="Estilo9"><input type="text" value="<?php echo "".$por;?>" name="<?php echo "p12*".$k;?>" id="<?php echo "p12*".$k;?>" size="4" style="font-size:9px;" readonly maxlength="6"></div></td>
								<?php								
								$block="";
								if($enc_13==1)
								  $block="disabled";								
								$blo="";
								if($bloc!="" || $block!="")
								  $blo="disabled";
								?>
								<td align="center" bgcolor="#FFFF99"><div align="center" class="Estilo9">
								  <select name="<?php echo "n13*".$k;?>" id="<?php echo "n13*".$k;?>" <?php echo "".$blo;?> onChange="Cambiar_por(this);" style="size:9px; font-size:9px;">
								    <?php
								$por="";
								if($arr_det->det_n13==""){
									$por=(1*$arr_ase->ase_p13)/100;
									$sum=$sum+$por;?>
									<option value="01">01</option>
									<?php }
								$i=1;
								while(20>=$i){
								  if($i<=9) $n="0".$i; else $n="".$i;
								  $nota=md5($n);
								  if($arr_det->det_n13==$nota){
								    $por=$i*$arr_ase->ase_p13/100;									
									$sum=$sum+$por;
								  }
								  if($i!=1 || $arr_det->det_n13!=""){?>
								    <option  value="<?php echo "".$n;?>" <?php if($arr_det->det_n13==$nota) echo "selected";?>><?php echo "".$n;?></option>
							    <?php
								  }
								  $i++;
								}
								?>
								  </select>
								</div></td>
								<td align="center"><div align="center" class="Estilo9"><input type="text" value="<?php echo "".$por;?>" name="<?php echo "p13*".$k;?>" id="<?php echo "p13*".$k;?>" size="4" style="font-size:9px;" maxlength="6" readonly></div></td>
								<?php
                                $fechano=strtotime($arr_fec->fcn_ni2);
								$bloc="";
								if($fechahoy>=$fechano){
								  $bloc="disabled";
								}	
								$block="";
								if($enc_21==1)
								  $block="disabled";								
								$blo="";
								if($bloc!="" || $block!="")
								  $blo="disabled";
/*echo "<script>alert('$fechahoy>=$fechano, $blo, $arr_fec->fcn_ni2');</script>";*/?>
								<td align="center" bgcolor="#99CCFF"><div align="center" class="Estilo9">
								  <select name="<?php echo "n21*".$k;?>" id="<?php echo "n21*".$k;?>" <?php echo "".$blo;?> onChange="Cambiar_por(this);" style="size:9px; font-size:9px;">
								    <?php
								$por="";
								if($arr_det->det_n21==""){
								  $por=(1*$arr_ase->ase_p21)/100;
								  $sum=$sum+$por;?>
									<option value="01">01</option>
								<?php }
								$i=1;
								while(20>=$i){
								  if($i<=9) $n="0".$i; else $n="".$i;
								  $nota=md5($n);
								  if($arr_det->det_n21==$nota){
								    $por=$i*$arr_ase->ase_p21/100;									
									$sum=$sum+$por;
								  }
								  if($i!=1 || $arr_det->det_n21!=""){?>
								    <option  value="<?php echo "".$n;?>" <?php if($arr_det->det_n21==$nota) echo "selected";?>><?php echo "".$n;?></option>
							    <?php
								  }
								  $i++;
								}
								?>
								  </select>
								</div></td>
								<td align="center"><div align="center" class="Estilo9"><input type="text" value="<?php echo "".$por;?>" name="<?php echo "p21*".$k;?>" id="<?php echo "p21*".$k;?>" size="4" style="font-size:9px;" maxlength="6" readonly></div></td>
								<?php
								$block="";
								if($enc_22==1)
								  $block="disabled";								
								$blo="";
								if($bloc!="" || $block!="")
								  $blo="disabled";
								?>
								<td align="center" bgcolor="#CCFF99"><div align="center" class="Estilo9">
								  <select name="<?php echo "n22*".$k;?>" id="<?php echo "n22*".$k;?>" <?php echo "".$blo;?> onChange="Cambiar_por(this);" style="size:9px; font-size:9px;">
								    <?php
								$por="";
								 if($arr_det->det_n22==""){
									$por=(1*$arr_ase->ase_p22)/100;
									$sum=$sum+$por;?>
									<option value="01">01</option>
									<?php }
								$i=1;
								while(20>=$i){
								  if($i<=9) $n="0".$i; else $n="".$i;
								  $nota=md5($n);
								  if($arr_det->det_n22==$nota){
								    $por=$i*$arr_ase->ase_p22/100;									
									$sum=$sum+$por;
								  }
								  if($i!=1 || $arr_det->det_n22!=""){?>
								    <option  value="<?php echo "".$n;?>" <?php if($arr_det->det_n22==$nota) echo "selected";?>><?php echo "".$n;?></option>
							    <?php
								}
								  $i++;
								}
								?>
								  </select>
								</div></td>
								<td align="center"><div align="center" class="Estilo9"><input type="text" value="<?php echo "".$por;?>" name="<?php echo "p22*".$k;?>" id="<?php echo "p22*".$k;?>" size="4" style="font-size:9px;" maxlength="6" readonly></div></td>
								<?php							
								$block="";
								if($enc_23==1)
								  $block="disabled";								
								$blo="";
								if($bloc!="" || $block!="")
								  $blo="disabled";
								?>
								<td align="center" bgcolor="#FFFF99"><div align="center" class="Estilo9">
								  <select name="<?php echo "n23*".$k;?>" id="<?php echo "n23*".$k;?>" <?php echo "".$blo;?> onChange="Cambiar_por(this);" style="size:9px; font-size:9px;">
								    <?php
								$por="";
								if($arr_det->det_n23==""){
									$por=(1*$arr_ase->ase_p23)/100;
									$sum=$sum+$por;?>
									<option value="01">01</option>
									<?php }
								$i=1;
								while(20>=$i){
								  if($i<=9) $n="0".$i; else $n="".$i;
								  $nota=md5($n);
								  if($arr_det->det_n23==$nota){
								    $por=$i*$arr_ase->ase_p23/100;									
									$sum=$sum+$por;
								  }
								  if($i!=1 || $arr_det->det_n23!=""){?>
								    <option  value="<?php echo "".$n;?>" <?php if($arr_det->det_n23==$nota) echo "selected";?>><?php echo "".$n;?></option>
							    <?php
								  }
								  $i++;
								}
								?>
								  </select>
								</div></td>
								<td align="center"><div align="center" class="Estilo9"><input type="text" value="<?php echo "".$por;?>" name="<?php echo "p23*".$k;?>" id="<?php echo "p23*".$k;?>" size="4" style="font-size:9px;" maxlength="6" readonly></div></td>								
								<?php
                                $fechano=strtotime($arr_fec->fcn_ni3);
								$bloc="";
								if($fechahoy>=$fechano){
								  $bloc="disabled";
								}
								$block="";
								if($enc_31==1)
								  $block="disabled";								
								$blo="";
								if($bloc!="" || $block!="")
								  $blo="disabled";
/*echo "<script>alert('$fechahoy>=$fechano, $blo, $arr_fec->fcn_ni3');</script>";*/?>
								<td align="center" bgcolor="#99CCFF"><div align="center" class="Estilo9">
								  <select name="<?php echo "n31*".$k;?>" id="<?php echo "n31*".$k;?>" <?php echo "".$blo;?> onChange="Cambiar_por(this);" style="size:9px; font-size:9px;">
								    <?php
								$por="";
								if($arr_det->det_n31==""){
									$por=(1*$arr_ase->ase_p31)/100;
									$sum=$sum+$por;?>
									<option value="01">01</option>
									<?php }
								$i=1;
								while(20>=$i){
								  if($i<=9) $n="0".$i; else $n="".$i;
								  $nota=md5($n);
								  if($arr_det->det_n31==$nota){
								    $por=$i*$arr_ase->ase_p31/100;									
									$sum=$sum+$por;
								  }
								  if($i!=1 || $arr_det->det_n31!=""){?>
								    <option  value="<?php echo "".$n;?>" <?php if($arr_det->det_n31==$nota) echo "selected";?>><?php echo "".$n;?></option>
							    <?php
								  }
								  $i++;
								}
								?>
								  </select>
								</div></td>
								<td align="center"><div align="center" class="Estilo9"><input type="text" value="<?php echo "".$por;?>" name="<?php echo "p31*".$k;?>" id="<?php echo "p31*".$k;?>" size="4" style="font-size:9px;" maxlength="6" readonly></div></td>
								<?php						
								$block="";
								if($enc_32==1)
								  $block="disabled";								
								$blo="";
								if($bloc!="" || $block!="")
								  $blo="disabled";
								?>
								<td align="center" bgcolor="#CCFF99"><div align="center" class="Estilo9">
								  <select name="<?php echo "n32*".$k;?>" id="<?php echo "n32*".$k;?>" <?php echo "".$blo;?>  onChange="Cambiar_por(this);" style="size:9px; font-size:9px;">
								    <?php
								$por="";
								 if($arr_det->det_n32==""){
									$por=(1*$arr_ase->ase_p32)/100;
									$sum=$sum+$por;?>
									<option value="01">01</option>
									<?php }
								$i=1;
								while(20>=$i){
								  if($i<=9) $n="0".$i; else $n="".$i;
								  $nota=md5($n);
								  if($arr_det->det_n32==$nota){
								    $por=$i*$arr_ase->ase_p32/100;									
									$sum=$sum+$por;
								  }
								  if($i!=1 || $arr_det->det_n32!=""){?>
								    <option  value="<?php echo "".$n;?>" <?php if($arr_det->det_n32==$nota) echo "selected";?>><?php echo "".$n;?></option>
							    <?php
								  }
								  $i++;
								}
								?>
								  </select>
								</div></td>
								<td align="center"><div align="center" class="Estilo9"><input type="text" value="<?php echo "".$por;?>" name="<?php echo "p32*".$k;?>" id="<?php echo "p32*".$k;?>" size="4" style="font-size:9px;" maxlength="6" readonly></div></td>
								<?php						
								$block="";
								if($enc_33==1)
								  $block="disabled";								
								$blo="";
								if($bloc!="" || $block!="")
								  $blo="disabled";
								?>
								<td align="center" bgcolor="#FFFF99"><div align="center" class="Estilo9">
								  <select name="<?php echo "n33*".$k;?>" id="<?php echo "n33*".$k;?>" <?php echo "".$blo;?> onChange="Cambiar_por(this);" style="size:9px; font-size:9px;">
								    <?php
								$por="";
								if($arr_det->det_n33==""){
									$por=(1*$arr_ase->ase_p33)/100;
									$sum=$sum+$por;?>
									<option value="01">01</option>
									<?php }
								$i=1;
								while(20>=$i){
								  if($i<=9) $n="0".$i; else $n="".$i;
								  $nota=md5($n);
								  if($arr_det->det_n33==$nota){
								    $por=$i*$arr_ase->ase_p33/100;									
									$sum=$sum+$por;
								  }
								  if($i!=1 || $arr_det->det_n33!=""){?>
								    <option  value="<?php echo "".$n;?>" <?php if($arr_det->det_n33==$nota) echo "selected";?>><?php echo "".$n;?></option>
							    <?php
								  }
								  $i++;
								}
								?>
								  </select>
								</div></td>
								<td align="center"><div align="center" class="Estilo9"><input type="text" value="<?php echo "".$por;?>" name="<?php echo "p33*".$k;?>" id="<?php echo "p33*".$k;?>" size="4" style="font-size:9px;" maxlength="6" readonly></div></td>
								<?php if($cant_lab>0 && $cant_teo>0){?>
								<td align="center"><div align="center" class="Estilo9"><input type="text" value="<?php echo "".$sum;?>" name="<?php echo "teo*".$k;?>" id="<?php echo "teo*".$k;?>" maxlength="6" size="4" style="font-size:9px;" readonly></div></td>
							    <td align="center" bgcolor="#FFCCFF"><div align="center" class="Estilo9">
								<select name="<?php echo "nla*".$k;?>" id="<?php echo "nla*".$k;?>" <?php echo "".$blo;?> onChange="Cambiar_por(this);" style="size:9px; font-size:9px;">
                                <?php
								$por="";
								if($arr_det->det_nla==""){
								  $por=(1*$arr_ase->ase_pla)/100;
								  $sum=$sum+$por;?>
									<option value="01">01</option>
									<?php }
								$i=1;
								while(20>=$i){
								  if($i<=9) $n="0".$i; else $n="".$i;
								  $nota=md5($n);
								  if($arr_det->det_nla==$nota){
								    $por=$i*$arr_ase->ase_pla/100;									
									$sum=$sum+$por;
								  }
								  if($i!='1' || $arr_det->det_nla!=""){?>
								    <option  value="<?php echo "".$n;?>" <?php if($arr_det->det_nla==$nota) echo "selected";?>><?php echo "".$n;?></option>
							    <?php
								  }
								  $i++;
								}
								?>
								  </select>
								</div></td>
								<td align="center"><div align="center" class="Estilo9"><input type="text" value="<?php echo "".$por;?>" name="<?php echo "pla*".$k;?>" id="<?php echo "pla*".$k;?>" maxlength="6" size="4" style="font-size:9px;" readonly></div></td>
								<?php }
								if($cant_lab>0 && $cant_teo>0){								
								$compa_lab2=(float) $por;
								$compa_pra2=(float) $sum;
								$pra2=$compa_pra2-$compa_lab2;
	                            $min_lab2=(float) ((10*$arr_ase->ase_pla)/100);
	                            $min_teo2=(float) ((10*($arr_ase->ase_p11+$arr_ase->ase_p12+$arr_ase->ase_p13+$arr_ase->ase_p21+$arr_ase->ase_p22+$arr_ase->ase_p23+$arr_ase->ase_p31+$arr_ase->ase_p32+$arr_ase->ase_p33))/100);
								$NOT=(float) (1*$arr_ase->ase_pla)/100;
								$comp_lab=(float) $por;
								$compa_lab=($comp_lab*1)/$NOT;
								$compa_pra=(float) $sum;
								$pra=((($compa_pra-$comp_lab)*100)/($arr_ase->ase_p11+$arr_ase->ase_p12+$arr_ase->ase_p13+$arr_ase->ase_p21+$arr_ase->ase_p22+$arr_ase->ase_p23+$arr_ase->ase_p31+$arr_ase->ase_p32+$arr_ase->ase_p33));
	                            $min_lab=10;//(float) ((10*$arr_ase->ase_pla)/100);
	                            $min_teo=10;//(float) ((10*($arr_ase->ase_p11+$arr_ase->ase_p12+$arr_ase->ase_p13+$arr_ase->ase_p21+$arr_ase->ase_p22+$arr_ase->ase_p23+$arr_ase->ase_p31+$arr_ase->ase_p32+$arr_ase->ase_p33))/100);
								if($compa_lab>=$min_lab){
								  if($pra>=$min_teo && $pra2>=$min_teo2){
								    $def=round($sum);
                                    if($def<1){
								      $def=1;
								    }
								    $let=$NuevoHor->ConvertirLetra($def);  
								  }
								  else{
								    if($pra>=$compa_lab){
									  $def=round($compa_lab);
									  if($def<1){
								        $def=1;
								      }
								      $let=$NuevoHor->ConvertirLetra($def);  
									}
									else{
									  $def=round($pra);
									  if($def==10)
									    $def=10-1;
									  if($def<1){
								        $def=1;
								      }
								      $let=$NuevoHor->ConvertirLetra($def);  
									}
								  }
								}
								else{
								  if($pra>=$compa_lab){
									$def=round($compa_lab);
									if($def<1){
								      $def=1;
								    }
								    $let=$NuevoHor->ConvertirLetra($def);  
								  }
								  else{
									$def=round($pra);
									  if($def==10)
									    $def=10-1;
									if($def<1){
								      $def=1;
								    }
								    $let=$NuevoHor->ConvertirLetra($def);  
								  }
								}
								}
								else{
								  $def=round($sum);
								  $let=$NuevoHor->ConvertirLetra($def); 
								}
								?>
								<td align="center"><div align="center" class="Estilo9"><input type="text" value="<?php echo "".$def;?>" name="<?php echo "def*".$k;?>" id="<?php echo "def*".$k;?>" maxlength="2" size="2" style="font-size:9px;" readonly></div></td>
								<td align="center"><div align="center" class="Estilo9"><input type="text" value="<?php echo "".$let;?>" name="<?php echo "let*".$k;?>" id="<?php echo "let*".$k;?>" maxlength="10" size="7" title="<?php echo "".$let;?>" style="font-size:9px;" readonly></div></td>
							  </tr>
							  <?php	
							  $k++;
							  }
							  ?>
							</table>
						  </td>
						</tr>
						<?php if($arr_ase->ase_p33==""){
						  echo "<script>alert('LO SIENTO DEBE DE PROCESAR PRIMERO LOS PORCENTAJES DE EVALUACIÓN DE ESTA(S) SECCIÓN(ES) SELECCIONADA(S)');</script>";
                          echo "<script>setTimeout(\"location.href='../Doc/Notas.php?ayu=".$_POST[ayu]."&viene=Modificar&usu=".$pac_id."*".$infrae."*".$asi_cod."*".$asi_nom."'\");</script>";
						}?>
						<tr>
						  <td bgcolor="#FFFFFF" colspan="4" width="100%" height="25px">
						    <input name="Aceptar" id="Aceptar" type="button" class="Boton" value="Aceptar" onClick="Validar_Formulario2();">
							<input name="Cancelar" type="button" class="Boton" value="Cancelar" onClick="Navegar('../Doc/Notas.php?viene=Modificar&usu=<?php echo "".$pac_id."*".$infrae."*".$asi_cod."*".$asi_nom;?>')">
						  </td>
						</tr>	
					  </table>
					</td>
	  <input name="cant_teo" id="cant_teo" type="hidden" value="<?php echo "".$cant_teo;?>">
	  <input name="cant_pra" id="cant_pra" type="hidden" value="<?php echo "".$cant_pra;?>">
      <input name="cant_lab" id="cant_lab" type="hidden" value="<?php echo "".$cant_lab;?>">
      <input name="id" id="id" type="hidden" value="<?php echo "".$_GET[usu];?>">
	  <input name="selec_pensum" id="selec_pensum" type="hidden" value="<?php echo "".$selec_pensum;?>">
	  <input name="selec_dbh" id="selec_dbh" type="hidden" value="<?php echo "".$selec_dbh;?>">
	  <input name="selec_aula" id="selec_aula" type="hidden" value="<?php echo "".$selec_aula;?>">
	  <input name="teo" id="teo" type="hidden" value="<?php echo "".$teo;?>">
	  <input name="pra" id="pra" type="hidden" value="<?php echo "".$pra;?>">
	  <input name="lab" id="lab" type="hidden" value="<?php echo "".$lab;?>">
      <input name="docente" id="docente" type="hidden" value="<?php echo "".$ci;?>">
      <input name="lis_alum" id="lis_alum" type="hidden" value="<?php echo "".$lis_alum;?>">
      <input name="lis_alum1" id="lis_alum1" type="hidden" value="<?php echo "".$lis_alum1;?>">
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
  <?php
  }
  else{  
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
    $clave=explode("*",$_POST[id]);
  //$array2->hor_id."*".$infrae."*".$pac_id."*".$asi_cod."*".$asi_nom
    $hor_id=$clave[0];
    $pac_id=$clave[2];
    $infrae=$clave[1];
    $asi_cod=$clave[3];
    $asi_nom=$clave[4];
    $dbh_tip=0;
	$c=$_SESSION[ci];
	$obj_lab=$_POST["cant_lab"];
	$ci=$_POST[docente];
	$lis_alum1=$_POST["lis_alum1"];
	$lis=explode(",",$lis_alum1);
	$p=0;
	$lis_alum="";
	while($lis[$p]!=""){
	  if($lis_alum=="")
	    $lis_alum="'".$lis[$p]."'";
	  else
	    $lis_alum="".$lis_alum.",'".$lis[$p]."'";
	  $p++;
	}
/*	echo "<script>alert('$ci, $pac_id, $infrae, $hor_id, $asi_cod, $asi_nom, $lis_alum1');</script>";*/
    $hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
	$fechahoy=strtotime($fecha);
    $res_fec=$NuevoHor->OperacionCualquiera("SELECT * FROM fe_ci_no WHERE pac_id='$pac_id'");
	$arr_fec=$NuevoHor->ConsultarCualquiera($res_fec);
/*	    echo "<script>alert('SELECT ci, concat(ap1, ,ap2,, ,no1, ,no2) AS ape FROM persona WHERE ci IN($lis_alum1) AND sta=1 ORDER BY ap1,ap2,no1,no2,ci');</script>";*/
	$res_pers=$NuevoHor->OperacionCualquiera("SELECT ci, concat(ap1,' ',ap2,', ',no1,' ',no2) AS ape FROM persona WHERE ci IN($lis_alum) AND sta='1' ORDER BY ap1,ap2,no1,no2,ci");
    $k=1;
	while($arr_pers=$NuevoHor->ConsultarCualquiera($res_pers)){
	  /*  echo "<script>alert('ENTRE');</script>";*/
	  $res_detins=$NuevoHor->OperacionCualquiera("SELECT * FROM detins WHERE pac_id='$pac_id' AND asi_cod='$asi_cod' AND det_sta='1' AND ci_est='$arr_pers->ci'");
	  $arr_det=$NuevoHor->ConsultarCualquiera($res_detins);
	  $fechano=strtotime($arr_fec->fcn_ni1);
	  $bloc="";
	  if($fechahoy>=$fechano){
		$bloc="disabled";
	  }
	  if($bloc==""){
		$val="n11*".$k;
		$n11=$_POST[$val];
	    if($_POST[$val]!="" && $_POST[$val]!="NP")
          $obj_n11=md5($_POST[$val]);
		else{
		  if($_POST[$val]!="NP")
		    $obj_n11=$arr_det->det_n11;
           else
		     $obj_n11="";
		}
		$val="n12*".$k;
		$n12=$_POST[$val];
	    if($_POST[$val]!="" && $_POST[$val]!="NP")
          $obj_n12=md5($_POST[$val]);
		else{
		  if($_POST[$val]!="NP" )
		    $obj_n12=$arr_det->det_n12;
		  else
		    $obj_n12="";
		}
		$val="n13*".$k;
		$n13=$_POST[$val];
	    if($_POST[$val]!=""&& $_POST[$val]!="NP")
          $obj_n13=md5($_POST[$val]);
		else{
		  if($_POST[$val]!="NP")
		    $obj_n13=$arr_det->det_n13;
          else
		    $obj_n13="";
		}
/*	    echo "<script>alert('$obj_n11, $obj_n12, $obj_n13');</script>";*/
	    $res_ase=$NuevoHor->OperacionCualquiera("UPDATE detins SET det_n11='$obj_n11', det_n12='$obj_n12', det_n13='$obj_n13' WHERE pac_id='$pac_id' AND asi_cod='$asi_cod' AND det_sta='1' AND ci_est='$arr_pers->ci'");
	    $num_filas=$NuevoHor->filas_afectadas($res_ase);
	    if($num_filas>0){
		  $i=1;
		  $det_n11="";
		  $det_n12="";
		  $det_n13="";
		  while(20>=$i){
		    if($i<=9) $n="0".$i; else $n="".$i;
			$nota=md5($n);
			if($arr_det->det_n11==$nota)
			  $det_n11=$n;
			if($arr_det->det_n12==$nota)
			  $det_n12=$n;
			if($arr_det->det_n13==$nota)
			  $det_n13=$n;
		    $i++;
		  }
	      $mod++;
	      $accion='MODIFICAR';
          $Operacion="NOTAS PRIMER CORTE; ANTES= N11: ".$det_n11." N12: ".$det_n12." N13: ".$det_n13."; CAMBIADAS= N11: ".$n11." N12: ".$n12." N13: ".$n13.", PACADE=".$pac_id." ASI=".$asi_cod." EST=".$arr_pers->ci;
	      $NuevoHor->guardar_accion($accion,"detins",$Operacion);		
	    }
	  }
	  $fechano=strtotime($arr_fec->fcn_ni2);
	  $bloc="";
	  if($fechahoy>=$fechano){
		$bloc="disabled";
	  }
	  if($bloc==""){
		$val="n21*".$k;
		$n21=$_POST[$val];
	    if($_POST[$val]!="" && $_POST[$val]!="NP")
          $obj_n21=md5($_POST[$val]);
		else{
		  if($_POST[$val]!="NP")
		    $obj_n21=$arr_det->det_n21;
          else
		    $obj_n21="";
		}
		$val="n22*".$k;
		$n22=$_POST[$val];
	    if($_POST[$val]!="" && $_POST[$val]!="NP")
          $obj_n22=md5($_POST[$val]);
		else{
		  if($_POST[$val]!="NP")
		    $obj_n22=$arr_det->det_n22;
          else
		    $obj_n22="";
		}
		$val="n23*".$k;
		$n23=$_POST[$val];
	    if($_POST[$val]!="" && $_POST[$val]!="NP")
          $obj_n23=md5($_POST[$val]);
		else{
		  if($_POST[$val]!="NP")
		    $obj_n23=$arr_det->det_n23;
          else
		    $obj_n23="";
		}
/*	    echo "<script>alert('$n21, $obj_n21, $n22, $obj_n22, $n23, $obj_n23');</script>";*/
		$num_filas=0;
		$res_ase="";
	    $res_ase=$NuevoHor->OperacionCualquiera("UPDATE detins SET det_n21='$obj_n21', det_n22='$obj_n22', det_n23='$obj_n23' WHERE pac_id='$pac_id' AND asi_cod='$asi_cod' AND det_sta='1' AND ci_est='$arr_pers->ci'");
	    $num_filas=$NuevoHor->filas_afectadas($res_ase);
	    if($num_filas>0){
		  $i=1;
		  $det_n21="";
		  $det_n22="";
		  $det_n23="";
		  while(20>=$i){
		    if($i<=9) $n="0".$i; else $n="".$i;
			$nota=md5($n);
			if($arr_det->det_n21==$nota)
			  $det_n21=$n;
			if($arr_det->det_n22==$nota)
			  $det_n22=$n;
			if($arr_det->det_n23==$nota)
			  $det_n23=$n;
		    $i++;
		  }
	      $mod++;
	      $accion='MODIFICAR';
          $Operacion="NOTAS SEGUNDO CORTE; ANTES= N21: ".$det_n21." N22: ".$det_n22." N23: ".$det_n23."; CAMBIADAS= N21: ".$n21." N22: ".$n22." N23: ".$n23.", PACADE=".$pac_id." ASI=".$asi_cod." EST=".$arr_pers->ci;
	      $NuevoHor->guardar_accion($accion,"detins",$Operacion);
	    }
	  }
	  $fechano=strtotime($arr_fec->fcn_ni3);
	  $bloc="";
	  if($fechahoy>=$fechano){
		$bloc="disabled";
	  }
	  if($bloc==""){
		$val="n31*".$k;
		$n31=$_POST[$val];
	    if($_POST[$val]!="" && $_POST[$val]!="NP")
          $obj_n31=md5($_POST[$val]);
		else{
		  if($_POST[$val]!="NP")
		    $obj_n31=$arr_det->det_n31;
          else
		    $obj_n31="";
		}
		$val="n32*".$k;
		$n32=$_POST[$val];
	    if($_POST[$val]!="" && $_POST[$val]!="NP")
          $obj_n32=md5($_POST[$val]);
		else{
		  if($_POST[$val]!="NP")
		    $obj_n32=$arr_det->det_n32;
          else
		    $obj_n32="";
		}	    
		$val="n33*".$k;
		$n33=$_POST[$val];
	    if($_POST[$val]!="" && $_POST[$val]!="NP")
          $obj_n33=md5($_POST[$val]);
		else{
		  if($_POST[$val]!="NP")
		    $obj_n33=$arr_det->det_n33;
          else
		    $obj_n33="";
		}
/*	    echo "<script>alert('$obj_n31, $obj_n32, $obj_n33');</script>";*/
        $obj_nla="";
        if($obj_lab>0){
		  $val="nla*".$k;
		  $nla=$_POST[$val];
	      if($_POST[$val]!="" && $_POST[$val]!="NP")
            $obj_nla=md5($_POST[$val]);
		  else
		    $obj_nla=$arr_det->det_nla;
		}
		$def_v="def*".$k;
		$def=$_POST[$def_v];
	    $apro=0;
		if($def>=10){
		  $apro=1;
		}
		$num_filas=0;
		$res_ase="";
	    $res_ase=$NuevoHor->OperacionCualquiera("UPDATE detins SET det_n31='$obj_n31', det_n32='$obj_n32', det_n33='$obj_n33', det_nla='$obj_nla', det_nfi='$def', det_nde='$def', det_con='$apro' WHERE pac_id='$pac_id' AND asi_cod='$asi_cod' AND det_sta='1' AND ci_est='$arr_pers->ci'");
	    $num_filas=$NuevoHor->filas_afectadas($res_ase);
	    if($num_filas>0){
		  $i=1;
		  $det_n31="";
		  $det_n32="";
		  $det_n33="";
		  $det_nla="";
		  while(20>=$i){
		    if($i<=9) $n="0".$i; else $n="".$i;
			$nota=md5($n);
			if($arr_det->det_n31==$nota)
			  $det_n31=$n;
			if($arr_det->det_n32==$nota)
			  $det_n32=$n;
			if($arr_det->det_n33==$nota)
			  $det_n33=$n;
			if($arr_det->det_nla==$nota)
			  $det_nla=$n;
		    $i++;
		  }
	      $mod++;
	      $accion='MODIFICAR';
          $Operacion="NOTAS TERCER CORTE; ANTES= N31: ".$det_n31." N32: ".$det_n32." N33: ".$det_n33." NLA: ".$det_nla." FIN: ".$arr_det->det_nfi." CON_APR: ".$arr_det->det_con."; CAMBIADAS= N31: ".$n31." N32: ".$n32." N33: ".$n33." NLA: ".$nla." FIN= ".$def." CON_APR:".$apro.", PACADE=".$pac_id." ASI=".$asi_cod." EST=".$arr_pers->ci;
	      $NuevoHor->guardar_accion($accion,"detins",$Operacion);
	    }
	  }
	  else{
	    $def_v="def*".$k;
		$def=$_POST[$def_v];
	    $apro=0;
		if($def>=10){
		  $apro=1;
		}
	    $res_ase=$NuevoHor->OperacionCualquiera("UPDATE detins SET det_nfi='$def', det_nde='$def', det_con='$apro' WHERE pac_id='$pac_id' AND asi_cod='$asi_cod' AND det_sta='1' AND ci_est='$arr_pers->ci'");
	    $num_filas=$NuevoHor->filas_afectadas($res_ase);
		if($num_filas>0){
	      $mod++;
	      $accion='MODIFICAR';
          $Operacion="NOTAS FINAL; ANTES= FIN: ".$arr_det->det_nfi." CON_APR: ".$arr_det->det_con."; CAMBIADAS= FIN: ".$def." CON_APR:".$apro.", PACADE=".$pac_id." ASI=".$asi_cod." EST=".$arr_pers->ci;
	      $NuevoHor->guardar_accion($accion,"detins",$Operacion);
		}
	  }
	  $k++;
	}
	if($mod==0){
	  echo "<script>alert('LO SIENTO NO SE HA REALIZADO NINGÚN CAMBIO EN EL ACTA DE NOTAS');</script>";
	}
	else{
      echo "<script>alert('SE HAN PROCESADO LOS CAMBIOS EN EL ACTA DE NOTAS SATISFACTORIAMENTE');</script>";
	}
    echo "<script>setTimeout(\"location.href='../Doc/Notas.php?ayu=".$_POST[ayu]."&viene=Procesar&usu=".$_POST[id]."'\");</script>";
  }?>
</body>