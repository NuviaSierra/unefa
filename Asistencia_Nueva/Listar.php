<?php session_start(); // Iniciamos la sesion?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Site SIDSECUN</title>
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
function Selecc_pacade(){
  ci_doc=document.getElementById("ci_doc").value;
  pacade=document.getElementById("pacade").value;
  if(ci_doc!="" && pacade!=""){
    formulario = document.forms["form"];
    formulario.submit();
  }
  else{
    alert("LO SIENTO DEBE DE SELECCIONAR EL PERÍODO ACADÉMICO E INGRESAR EL NÚMERO DE CEDULA DEL DOCENTE QUE SE DESEA BUSCAR");
  }
}
//***************************************************************************************
function Sel_Infrae(nom){
//  alert("----"+nom+"-----");
  valor=nom.value;
  usu=document.getElementById("pacade").value;
  ci_doc=document.getElementById("ci_doc").value;
  comb=document.getElementById("infrae");
  for(i=comb.length;i>-1;i--)
	comb.options[i]=null
//  alert("-"+valor+"-");
  if(valor!=""){
    var http=new getHTTPObject()
	tipo="ListadoInfrae";
    enviar="valor="+valor+"&usu="+usu+"&Operacion="+tipo+"&ci_doc="+ci_doc+"&tim="+new Date().getTime()
    Dir="../Horario_Nuevo/Prueba.php"+"?"+enviar
    http.onreadystatechange = function(){
	if(http.readyState==4){
	  resultado = http.responseText.split("@");
//	  alert(resultado);
	  id=resultado[0].split("*");
	  nom=resultado[1].split("*");
	  cuanto=resultado[2];
//  alert(cuanto);
	  if(cuanto>=1)
	    comb.disabled=false;
	  else
	    comb.disabled=true;
	  for(i=comb.length;i>-1;i--)
		comb.options[i]=null
	  j=0
	  ind=0;	
	  nom[-1]="-Todas-";
	  id[-1]="";
	  for(r=-1;r<cuanto;r++){				
		comb.options[ind]=new Option(nom[r],id[r])
		comb.options[ind].title=nom[r];
		ind++ 
	  }	
	}
    }
  http.open("GET",Dir, true);
  http.send(null);
  }
  else{
    comb.options[0]=new Option("--TODAS--","")
    comb.disabled=true;
  }
}
//***************************************************************************************
function Buscar_Asignatura(){
  formulario = document.forms["form"];
  formulario.submit();
}
//***************************************************************************************
function redireccionar(){
  document.location.href='Agregar.php?pacade='+document.form.pacade.value+'&ci_doc='+document.form.ci_doc.value+'&suma_total_horas='+document.form.suma_total_horas.value+'&ayu='+document.form.ayu.value;
}
//***************************************************************************************
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
  if($_GET[pacade]!=''){
	$pac_id=$_GET[pacade];
	$ci_doc=$_SESSION[ci];
  }
  else{
    if($_GET[usu]==''){
	  $clave=explode("*",$_POST[id]);
	  $pac_id=$_GET[pacade]=$_POST[pacade];
	  $ci_doc=$_SESSION[ci];
	}
	else{
	  $clave=explode("*",$_GET[usu]);
	  $pac_id=$clave[0];
	  $ci_doc=$_SESSION[ci];
	}
  }
/*echo "<script>alert('DOCENTE: $ci_doc, PACADE: $pac_id');</script>";*/
  $NuevoHor = new nota("","","","","","","",$pac_id,"","","","","","");
  $NuevoHor->conec_BD();
  $NuevoHor->conectar_BD();
  include ("../Clases/class.plantilla.php");
    $Plantilla = new plantilla("","","");
    $bandCon=0;
    $bandMod=0;
	$columna=4;//2
  if($_POST[asi_nom]!="" && $_POST[asi_nom]!="unsigned"){
    $asi_nom=$_GET[asi_nom]=$_POST[asi_nom];
  }
  if($_POST[nucleo]!="" && $_POST[nucleo]!="unsigned"){
/*echo "<script>alert('ENTRE NUCLEO');</script>";*/
    $nucleo=$_GET[nucleo]=$_POST[nucleo];
    $infrae=$_GET[infrae]=$_POST[infrae];
  }
  else{
/*echo "<script>alert('ENTRE NO NUCLEO');</script>";*/
    if($_GET[usu]==''){
/*echo "<script>alert('ENTRE USU');</script>";*/
      $nucleo=$_GET[nucleo]="";
      $infrae=$_GET[infrae]="";
	}
	else{
/*echo "<script>alert('ENTRE NO USU');</script>";*/
//	  $clave=explode("*",$_GET[usu]);
	  $nucleo=$_GET[nucleo]=$clave[2];
      $infrae=$_GET[infrae]=$clave[1];
	  $asi_nom=$_GET[asi_nom]=$clave[3];
	}
  }
  if($pac_id=="undefined"){
    $pac_id="";
	$ci_doc="";
  }
/*echo "<script>alert('DOCENTE: $ci_doc, PACADE: $pac_id');</script>";*/
  $id=$pac_id."*".$infrae."*".$nucleo."*".$asi_nom."*".$ci_doc."*".$suma_total_horas;
/*echo "<script>alert('NUCLEO: $nucleo=$clave[2]=$_GET[nucleo], INFRAE: $infrae=$clave[1]=$_GET[infrae], usu $_GET[usu], $pac_id, $id');</script>";*/
	$idper=$_SESSION[idper];
	$ci_doc=$ci=$_SESSION[ci];
	$entre=0;
	$bandRep=$bandRepM=$bandRepC=$bandConN=$bandModN=0;
		$dias=time();
		$fecha=date("Y-m-d",$dias);
		$hoy=$fecha." 00:00:00";
		$res_fcn=$NuevoHor->OperacionCualquiera("SELECT * FROM fe_ci_no WHERE pac_id='$pac_id' AND fcn_ni3<='$hoy'");
	    $fcn=$NuevoHor->NumFilasCualquiera($res_fcn);
/*		echo "<script>alert('SELECT * FROM fe_ci_no WHERE pac_id=$pac_id AND fcn_ni3<=$hoy');</script>";
		echo "<script>alert('FILAS $fcn');</script>";*/
		if($fcn>0){
	      $bandRep=1;
		}
/*    $res=$NuevoHor->OperacionCualquiera("SELECT * FROM tab_ope WHERE per_id='$idper' AND tab_ope_sta='1' AND tab_id IN ('69')");
	while($array=$NuevoHor->ConsultarCualquiera($res)){	
	  if($array->ope_id=='2'){*/
	    $bandConN=1; $columna++;
/*	    if($bandRep!=0){ $bandRepC=1; $columna++;}
	  }
	  if($array->ope_id=='3'){
		if($bandRep==0){ 
		$bandModN=1; $columna++;}
		else{ $bandRepM=1; $columna++;}
	  }
	}*/?>
<body bgcolor="#a9c3e8" leftmargin="0" rightmargin="0" topmargin="0">
  <form action="Listar.php" method="post" enctype="multipart/form-data" name="form">
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
			<input id="ci_doc" name="ci_doc" type="hidden" value="<?php echo "".$ci_doc;?>"/>
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
                        <tr><td colspan="<?php echo "".$columna;?>" bgcolor="#000066"><span class="Estilo1">:: ACTA DE ASISTENCIA DE LA(S) ASIGNATURA(S) ASOCIADA(S)</span></td></tr>
<?php
if($pac_id=="" || $pac_id=="unsigned"){?>
						<tr><td colspan="<?php echo "".$columna;?>">
						  <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;">
  						    <tr>
						      <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Per&iacute;odo Acad&eacute;mico:</div></td>
						      <td bgcolor="#FFFFFF"><div align="left" class="Estilo2">
						        <select id="pacade" name="pacade">
							      <option value="">--SELECCIONE--</option>
							      <?php
							      $res=$NuevoHor->Buscar_Periodo();
							      while($array=$NuevoHor->ConsultarCualquiera($res)){?>
							      <option value="<?php echo "".$array->pac_id;?>" <?php if($pac_id==$array->pac_id) echo "selected";?>><?php echo "".$array->pac_nom;?></option>
							<?php }?>
							    </select>
							  <img src="../Imagenes/p_buspeq1.gif" height="20px" width="20px" onClick="Selecc_pacade()"></div></td>
						    </tr>
						  </table>
						</td></tr>
<?php 
/*echo "<script>alert('pacade $pac_id');</script>";*/
}
else{
  $pac_nom=$NuevoHor->Buscar_pacade1($pac_id); 
  $dat_doc=$NuevoHor->Buscar_docente1($ci_doc);
  if($dat_doc->nombre==""){
    echo "<script>alert('LO SIENTO NUMERO DE CEDULA NO ENCONTRADO O SE ENCUENTRA INHABILITADO');</script>";
    echo "<script>setTimeout(\"location.href='../Doc/ActaAsistencia_Nueva.php?ayu=".$_POST[ayu]."&viene=Listar'\");</script>";	
  }
  else{
   $info_resp=$NuevoHor->Buscar_docente_matricula($ci_doc);?>
						<tr><td colspan="<?php echo "".$columna;?>">
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
                        <tr><td colspan="<?php echo "".$columna;?>"><span align="center" class="Estilo9">DATOS DEL DOCENTE</span></td></tr>
						<tr><td colspan="<?php echo "".$columna;?>">
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
      <?php
      if(!isset($_GET[pg]))
        $pg = 0; // $pg es la pagina actual
      else
        $pg=$_GET[pg];
      $siguiente=$pg+1;
      $atras=$pg-1;
      $cantidad=5; // cantidad de resultados por pagina
      $inicial = $pg * $cantidad;
      if(!isset($_GET[nucleo]) || ($_GET[nucleo]=='' && $_GET[infrae]=='')){
        $nucleo=0;
        $infrae=0;
        $total=$NuevoHor->Contar_horario_Todas($ci_doc);
        $r=$NuevoHor->Listado_horario_Todas($inicial,$cantidad,$ci_doc); 
/*echo "<script>alert('ENTRE CUANTO: $total');</script>";*/
      }
      else{ 
        if($_GET[infrae]=='' && $_GET[nucleo]!=''){
          $total=$NuevoHor->Contar_horario_Nucleo_Todas($_GET[nucleo],$ci_doc);
          $r=$NuevoHor->Listado_horario_Nucleo_Todas($_GET[nucleo],$inicial,$cantidad,$ci_doc);
        }
        else{
          $total=$NuevoHor->Contar_horario_Nucleo_Infrae($_GET[nucleo],$_GET[infrae],$ci_doc);
          $r=$NuevoHor->Listado_horario_Nucleo_Infrae($_GET[nucleo],$_GET[infrae],$inicial,$cantidad,$ci_doc);
        }
      }
	  if($total>=1){
	    $cuantos=0;
	    if($bandMod==1) $cuantos++;
	    if($bandEli==1) $cuantos++;
	    if($bandCon==1) $cuantos++;
	    $datos=intval($columna-$cuantos);?>
						<tr><td colspan="<?php echo "".$columna;?>">
						  <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;">
  						    <tr>
						      <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Nucleo:</div></td>
						      <td bgcolor="#FFFFFF"><div align="left" class="Estilo2">
						        <select id="nucleo" name="nucleo" onChange="Sel_Infrae(this);">
						          <option value="">--TODOS--</option>
							      <?php
						            $resp=$NuevoHor->Listado_Nucleo($ci_doc);
							        while($array=$NuevoHor->ConsultarCualquiera($resp)){?>
						          <option value="<?php echo "".$array->nuc_id;?>" <?php if($nucleo==$array->nuc_id) echo "selected";?>><?php echo "".$array->nuc_nom;?></option>
							      <?php }?>
						        </select>
							  </div></td>
						      <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Sede:</div></td>
						      <td bgcolor="#FFFFFF"><div align="left" class="Estilo2">
						        <select id="infrae" name="infrae" <?php if($nucleo=="") echo "disabled";?>>
						          <option value="">--TODAS--</option>
								  <?php if($nucleo!=""){
								  $resp=$NuevoHor->Listado_Infrae($nucleo,$ci_doc);
							      while($array=$NuevoHor->ConsultarCualquiera($resp)){?>
						          <option value="<?php echo "".$array->inf_id;?>" <?php if($infrae==$array->inf_id) echo "selected";?>><?php echo "".$array->inf_nom;?></option>
								  <?php }
								  }?>
						        </select>
							  </div></td>
							  <td bgcolor="#FFFFFF" height="25px">
							     <input name="Buscar" type="submit" class="Boton" value="Buscar">
							  </td>
						    </tr>
						  </table>
						</td></tr>						
						<?php 
						$col_lis=$columna;
						if($bandModN==1){ $col_lis=$col_lis-1;}
						if($bandConN==1){ $col_lis=$col_lis-1;}
						if($bandRepM==1){ $col_lis=$col_lis-1;}
						if($bandRepC==1){ $col_lis=$col_lis-1;}
						?>
						<tr>
						  <td colspan="<?php echo "".$col_lis;?>">
						    <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;">
							  <tr>
                                <td bgcolor="#FFFFFF" width="100%"><span align="center" class="Estilo9">LISTADO DE SECCIONES ASOCIADAS AL DOCENTE</span></td>
							  </tr>
							</table>
						  </td>
		<?php if($bandConN==1){ ?>  
                          <td bgcolor="#FFFFFF"><span align="center" class="Estilo9">CONSULTAR ACTA</span></td>

		                  <?php }?>
                        </tr>
		<?php
		  $suma_total_horas=0;
	      while($array=$NuevoHor->ConsultarCualquiera($r)){
		    $th=$NuevoHor->Buscar_materia_pensum_todas_tip_horario($array->hor_id,$ci_doc);
			$tip_hora="";
			$sum_horas=0;
			while($ar_th=$NuevoHor->ConsultarCualquiera($th)){
			  if($tip_hora==""){
			    if($ar_th->hor_tpl==0){
		    	  $tip_hora='T='.$ar_th->can_t;
				  $sum_horas=$sum_horas+$ar_th->can_t;
				}
				else{
				  if($ar_th->hor_tpl==1){
		    	    $tip_hora='P='.$ar_th->can_p;
				    $sum_horas=$sum_horas+$ar_th->can_p;
				  }
				  else{
				    if($ar_th->hor_tpl==2){
		    	      $tip_hora='L='.$ar_th->can_l;
				      $sum_horas=$sum_horas+$ar_th->can_l;
				    }
				    else{
				      $tip_hora='NINGUNA';
				      $sum_horas=$sum_horas;
					}
				  }
				}
			  }
			  else{
		    	if($ar_th->hor_tpl==0){
			      $tip_hora=$tip_hora.', T='.$ar_th->can_t;
				  $sum_horas=$sum_horas+$ar_th->can_t;
				}
				else{
				  if($ar_th->hor_tpl==1){
		        	$tip_hora=$tip_hora.', P='.$ar_th->can_p;
				    $sum_horas=$sum_horas+$ar_th->can_p;
				  }
				  else{
				    $tip_hora=$tip_hora.', L='.$ar_th->can_l;
				    $sum_horas=$sum_horas+$ar_th->can_l;
				  }
				}		  
			  }
			}
			$suma_total_horas=$suma_total_horas+$sum_horas;?>
                        <tr>
						  <td colspan="	<?php echo "".$col_lis;?>">
						    <table border="1" bordercolor="#000066" style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;">
			                  <tr>
                                <td width="10%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Nucleo</div></td>
                                <td width="10%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Sede</div></td>
                                <td width="25%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Asignatura</div></td>
                                <td width="10%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Secci&oacute;n</div></td>
                                <td width="10%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Tipo de Hora</div></td>
                                <td width="5%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Modalidad</div></td>
                                <td width="5%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Pensum</div></td>
                                <td width="25%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">Especialidad</div></td>
                                <td width="5%" nowrap bgcolor="#9BB9FF"><div align="center" class="Estilo9">R&eacute;gimen</div></td>
							  </tr>
			<?php
			$ase_id="";
	        $result=$NuevoHor->Buscar_materia_pensum_todas($array->hor_id,$ci_doc);
    	    while($ar=$NuevoHor->ConsultarCualquiera($result)){
			  if($ase_id=="") $ase_id=$ar->ase_id;
/*			  echo "<script>alert('$ase_id');</script>";*/
			  $elec_nom="";
			  if($ar->ele_nom!='NINGUNA'){
			    $elec=explode("(",$ar->ele_nom);
				$elec_nom=" (".$elec[0].")";
			  }?>
  						      <tr>		
						        <td bgcolor="#FFFFFF" width="10%"><div align="left" class="Estilo2"><?php echo "".$ar->nuc_nom;?></div></td>
						        <td bgcolor="#FFFFFF" width="10%"><div align="left" class="Estilo2"><?php echo "".$ar->inf_nom;?></div></td>
						        <td bgcolor="#FFFFFF" width="25%"><div align="left" class="Estilo2"><?php echo "".$ar->asigna."".$elec_nom;?></div></td>
						        <td bgcolor="#FFFFFF" width="10%"><div align="left" class="Estilo2"><?php echo "".$ar->sec_nom;?></div></td>
						        <td bgcolor="#FFFFFF" width="10%"><div align="left" class="Estilo2"><?php echo "".$tip_hora;?></div></td>
						        <td bgcolor="#FFFFFF" width="5%"><div align="left" class="Estilo2"><?php echo "".$ar->mod_nom;?></div></td>
						        <td bgcolor="#FFFFFF" width="5%"><div align="left" class="Estilo2"><?php echo "".$ar->coh_nom;?></div></td>
						        <td bgcolor="#FFFFFF" width="25%"><div align="left" class="Estilo2"><?php echo "".$ar->esp_nom;?></div></td>
						        <td bgcolor="#FFFFFF" width="5%"><div align="left" class="Estilo2"><?php echo "".$ar->reg_nom;?></div></td>
						      </tr>
        	<?php
			}?>			
							</table>
						  </td>
			<?php
			if($bandConN==1){?>
						  <td bgcolor="#FFFFFF" width="10%"><div align="center"><img src="../Imagenes/folder-setup.gif" width="30" height="30" style="cursor:pointer;" onClick="Opciones_SubMen('../Doc/ActaAsistencia_Nueva.php','Consultar','3','<?php echo "".$pac_id."*".$ci_doc."*".$array->hor_id."*".$ase_id."*".$suma_total_horas;?>')"/></div></td>
			<?php 
			}?>
						</tr>
	      <?php
    	  }
	      if($total>($inicial+$cantidad)){
    	    $pages = intval($total / $cantidad);// Imprimiendo los resultados
		    if($pages==0) $pages=$pages+1;
		    $dec=floatval($total / $cantidad);
		    $num=explode(".",$dec);
		    $int=intval($num[1]);
		    if($int>0) $pages=$pages+1;
	      }
		  else{
	 	    $pages=intval($total / $cantidad) + 1;
		    if($pages!=0) $pages=$pages-1;
	      }?>
						<tr>
						  <td bgcolor="#FFFFFF" colspan="<?php echo "".$columna;?>" width="100%" height="25px" align="center">
  <?php
    echo ("<p align=\"left\"><font face=Arial size=2 color=0000FF><b>Cantidad de Horas del Docente $suma_total_horas </b></font></p><p align=\"right\"><font face=Arial size=2 color=0000FF><b>Cantidad de Secciones del Docente $total </b></font></p><hr  width=\"50%\" align=\"center\" size=\"0\">");
	      if($pg <> 0){
	        $url = $pg - 1;
	        echo "<a href='../Doc/ActaAsistencia_Nueva.php?viene=Listar&pg=".$url."&nucleo=".$nucleo."&infrae=".$infrae."&pacade=".$pac_id."&cod_asi=".$cod_asi."&usu=".$id."&ci_doc=".$ci_doc."'>Anterior</a>&nbsp;";
	      }
	      else echo " ";
		  if($pages==0) echo"<font face=Arial size=2 color=001111><b>&nbsp;P&aacute;gina&nbsp;</b></font>";
	      else echo"<font face=Arial size=2 color=001111><b>&nbsp;P&aacute;ginas&nbsp;</b></font>";
	      if($pages!=0){
      		for($i = 0; $i<$pages; $i++){
	 	  	  $ppage=$i+1;
		  $modulo=floatval($i/30);
		  $num_mod=explode(".",$modulo);
/*		  echo "<script>alert('$modulo $i');</script>";*/
		      if(intval($num_mod[1])==intval(0) && intval($num_mod[0])>intval(0)){ echo "<br>";}
        	  if($i == $pg) echo "<font face=Arial size=2 color=0000FF><b>&nbsp;$ppage&nbsp;</b></font>";
        	  else echo "&nbsp;<a href='../Doc/ActaAsistencia_Nueva.php?viene=Listar&pg=".$i."&nucleo=".$nucleo."&infrae=".$infrae."&pacade=".$pac_id."&cod_asi=".$cod_asi."&usu=".$id."&ci_doc=".$ci_doc."'>".$ppage."</a>&nbsp;";
      		}
    	  }
    	  else{
	        for($i = 0; $i<($pages+1); $i++){
	    	  $ppage=$i+1;
		  $modulo=floatval($i/30);
		  $num_mod=explode(".",$modulo);
/*		  echo "<script>alert('$modulo $i');</script>";*/
		      if(intval($num_mod[1])==intval(0) && intval($num_mod[0])>intval(0)){ echo "<br>";}
	    	  if($i == $pg) echo "<font face=Arial size=2 color=0000FF><b>&nbsp;$ppage&nbsp;</b></font>";
        	  else echo "&nbsp;<a href='../Doc/ActaAsistencia_Nueva.php?viene=Listar&pg=".$i."&nucleo=".$nucleo."&infrae=".$infrae."&pacade=".$pac_id."&cod_asi=".$cod_asi."&usu=".$id."&ci_doc=".$ci_doc."'>".$ppage."</a>&nbsp;";
      		}
    	  }
    	  if($pg < $pages){
      		$url = $pg + 1;
      		echo "&nbsp;<a href='../Doc/ActaAsistencia_Nueva.php?viene=Listar&pg=".$url."&nucleo=".$nucleo."&infrae=".$infrae."&pacade=".$pac_id."&cod_asi=".$cod_asi."&usu=".$id."&ci_doc=".$ci_doc."'>Siguiente</a>";
    	  }
    	  else echo " ";
    	  echo "</hr>";?>
						  </td>
						</tr>
	 	<?php
	    }
	    else{
	    echo "<script>alert('LO SIENTO NO POSEE SECCIONES ASOCIADAS PARA EL PERÍODO ACADÉMICO SELECCIONADO QUE SE EVALUEN DE MANERA CUANTITATIVA');</script>";
	    }
	  }
	}?>
						<tr>
						  <td bgcolor="#FFFFFF" colspan="<?php echo "".$columna;?>" width="100%" height="25px">
	        <input name="suma_total_horas" id="suma_total_horas" type="hidden" value="<?php echo "".$suma_total_horas;?>">
<?php if($pac_id!="" && $pac_id!="unsigned"){?>
							<input name="Volver" type="button" class="Boton" value="Volver" onClick="Navegar('../Doc/ActaAsistencia_Nueva.php?viene=Listar')">
<?php }?>
							<input name="Cancelar" type="button" class="Boton" value="Cancelar" onClick="Navegar('../Menu/menu_princ.php')">
						  </td>
						</tr>
                      </table>
				   </td>
				 </tr>
				 <tr><td width="100%">&nbsp;</td></tr>
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
</body>
<?php
}
else{
echo "<script>alert('SU SESIÓN HA SIDO CERRADA');</script>";
echo "<script>setTimeout(\"location.href='../'\");</script>";
}
?>
</html>