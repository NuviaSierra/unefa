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

function llenar_combos(valor){
if(valor!=""){
    var http=new getHTTPObject()
    enviar="valor="+valor+"&cual="+cual[1]+"&Operacion="+tipo+"&tim="+new Date().getTime()
    Dir="../Cambios_Reingreso/Prueba.php"+"?"+enviar
    http.onreadystatechange = function(){
	if(http.readyState==4){
	  resultado = http.responseText.split("@")
	  des=resultado[1].split("*")
	  id=resultado[0].split("*")
	  cuanto=resultado[2]
	  if(cuanto>=1)
	    comb.disabled=false
	  else
	    comb.disabled=true
	  for(i=comb.length;i>-1;i--)
		comb.options[i]=null
	  j=0
	  ind=0	
	  des[-1]="-SELECCIONE-"  	
	  for(r=-1;r<id.length;r++){				
		comb.options[ind]=new Option(des[r],id[r])
		comb.options[ind].title=des[r]
		ind++ 
	  }	
	}
    }
  http.open("GET",Dir, true)
  http.send(null)
  }
  else{
    comb.options[ind]=new Option("-SELECCIONE-","")
    comb.disabled=true
  }
}
//***************************************************************************************
function Buscar_Combo(nom){
  cual=nom.split("*")
  valor=document.getElementById(cual[0]).value
  comb=document.getElementById(cual[1])
  for(i=comb.length;i>-1;i--)
	comb.options[i]=null
  if(cual[1]=="reg_id_sol"){
    tipo="Consultar1"
    comb1=document.getElementById("esp_id_sol")
	comb1.disabled=true
  }
  else{ 
    if(cual[1]=="esp_id_sol"){
    tipo="Consultar2"
	comb1=document.getElementById("coh_id_sol")
	comb1.disabled=true
	mod="mod_id_sol"
	valor=valor+"*"+document.getElementById(mod).value
    }
    if(cual[1]=="coh_id_sol"){
	tipo="Consultar3"
	comb1=document.getElementById("pen_top_sol");
    comb1.disabled=true;
	mod="mod_id_sol"
	reg="reg_id_sol"
	valor=valor+"*"+document.getElementById(reg).value+"*"+document.getElementById(mod).value
    }
    if(cual[1]=="pen_top_sol"){
	tipo="Consultar4"
	mod="mod_id_sol"
	reg="reg_id_sol"
	esp="esp_id_sol"
	valor=valor+"*"+document.getElementById(esp).value+"*"+document.getElementById(reg).value+"*"+document.getElementById(mod).value
    }
    if(cual[1]=="inf_id_sol"){
    tipo="Consultar5"
	mod="mod_id_sol"
	reg="reg_id_sol"
	esp="esp_id_sol"
	valor=document.getElementById(esp).value+"*"+document.getElementById(reg).value+"*"+document.getElementById(mod).value
    }
  }
  if(valor!="")
  {
  llenar_combos(valor)
  }
}
//***************************************************************************************
function Buscar_Combo_esp(nom){
  cual=nom.split("*")
  valor=document.getElementById(cual[0]).value
  comb=document.getElementById(cual[1])
  for(i=comb.length;i>-1;i--)
	comb.options[i]=null
  if(cual[1]=="esp_id_sol"){
    tipo="Consultar6"
	inf=document.getElementById("dat_esp")
	val_inf=inf.value.split("*")
	reg=document.getElementById("reg_id_sol")
    comb1=document.getElementById("pen_top_sol")
	comb1.disabled=true
	valor=val_inf[0]+"*"+reg.value+"*"+val_inf[1]+"*"+val_inf[2]+"*"+val_inf[3]
   }
   else{
     if(cual[1]=="pen_top_sol"){
	 tipo="Consultar7"
	 inf=document.getElementById("dat_esp")
	 val_inf=inf.value.split("*")
	 reg=document.getElementById("reg_id_sol")
	 esp=document.getElementById("esp_id_sol")
	 valor=val_inf[0]+"*"+reg.value+"*"+esp.value+"*"+val_inf[3]
	 }
   }
  if(valor!=""){
  llenar_combos(valor)  
  }
}
//***************************************************************************************
function Buscar_Combo_carre(nom){
  cual=nom.split("*")
  valor=document.getElementById(cual[0]).value
  comb=document.getElementById(cual[1])
  for(i=comb.length;i>-1;i--)
	comb.options[i]=null
  if(cual[1]=="reg_id_sol"){
    tipo="Consultar8"
	esp_nom=document.getElementById("esp_nom_act")
    comb1=document.getElementById("esp_id_sol")
	comb1.disabled=true
	valor=valor+"*"+esp_nom.value
  }
  else{
    if(cual[1]=="esp_id_sol"){
	tipo="Consultar9"
    array=document.getElementById("data_princ").value
	esp_id_act=array.split("*")	
	comb1=document.getElementById("coh_id_sol")
	comb1.disabled=true
	mod="mod_id_sol"
	esp_nom=document.getElementById("esp_nom_act")
	valor=document.getElementById(mod).value+"*"+valor+"*"+esp_nom.value+"*"+esp_id_act[2]
	//alert(valor)
    }
	if(cual[1]=="coh_id_sol"){
	tipo="Consultar3"
	comb1=document.getElementById("pen_top_sol");
    comb1.disabled=true;
	mod="mod_id_sol"
	reg="reg_id_sol"
	valor=valor+"*"+document.getElementById(reg).value+"*"+document.getElementById(mod).value
	}
	if(cual[1]=="pen_top_sol"){
	tipo="Consultar4"
	mod="mod_id_sol"
	reg="reg_id_sol"
	esp="esp_id_sol"
	valor=valor+"*"+document.getElementById(esp).value+"*"+document.getElementById(reg).value+"*"+document.getElementById(mod).value
    }
    if(cual[1]=="inf_id_sol"){
    tipo="Consultar5"
	mod="mod_id_sol"
	reg="reg_id_sol"
	esp="esp_id_sol"
	valor=document.getElementById(esp).value+"*"+document.getElementById(reg).value+"*"+document.getElementById(mod).value
    }
  }
    if(valor!=""){
    llenar_combos(valor)
	}
}
//***************************************************************************************
function Buscar_Combo_reg(nom){
  cual=nom.split("*")
  valor=document.getElementById(cual[0]).value
  comb=document.getElementById(cual[1])
  for(i=comb.length;i>-1;i--)
	comb.options[i]=null
  if(cual[1]=="esp_id_sol"){
  tipo="Consultar10"
  data=document.getElementById("data_princ").value.split("*")
  valor=data[1]+"*"+valor+"*"+data[2]
	if(valor!=""){
    var http=new getHTTPObject()
    enviar="valor="+valor+"&cual="+cual[1]+"&Operacion="+tipo+"&tim="+new Date().getTime()
    Dir="../Cambios_Reingreso/Prueba.php"+"?"+enviar
    http.onreadystatechange = function(){
	  if(http.readyState==4){
	  resultado = http.responseText.split("@")
	  des=resultado[1].split("*")
	  id=resultado[0].split("*")
	  cuanto=resultado[2]
	  comb.disabled=false
	    for(i=comb.length;i>-1;i--)
	    comb.options[i]=null
	    ind=0	  	
		comb.options[0]=new Option("-SELECCIONE-","")
		comb.options[1]=new Option(des[0],id[0])
	    }
      }
    http.open("GET",Dir, true)
    http.send(null)
    }
  }
  else{
  tipo="Consultar4"
  mod="mod_id_sol"
  reg="reg_id_sol"
  esp="esp_id_sol"
  coh="coh_id_sol"
  valor=document.getElementById(coh).value+"*"+document.getElementById(esp).value+"*"+document.getElementById(reg).value+"*"+document.getElementById(mod).value
    if(valor!=""){
	llenar_combos(valor)
	}
  } 
}
//***************************************************************************************
function confirmar(){
opcion=document.getElementById("opcion")
  switch(opcion.value){
	case "camb_car":
	mod_id=document.getElementById("mod_id_sol")
	reg_id=document.getElementById("reg_id_sol")
	esp_id=document.getElementById("esp_id_sol")
	coh_id=document.getElementById("coh_id_sol")
	pen_top=document.getElementById("pen_top_sol")
	inf_id=document.getElementById("inf_id_sol")
	fec_sol=document.getElementById("fec_sol")
	num_sol=document.getElementById("num_sol")
	if(fec_sol.value=="" || num_sol.value=="" || mod_id.value=="" || reg_id.value=="" || esp_id.value=="" || coh_id.value=="" || inf_id.value=="" || pen_top.value=="" || inf_id.value=="undefined" ){
	  alert("DEBE LLENAR Y SELECCIONAR TODOS LOS CAMPOS")
	  return false  
	 }
	break	 
	case "camb_esp":
	reg_id=document.getElementById("reg_id_sol")
	esp_id=document.getElementById("esp_id_sol")
	pen_top=document.getElementById("pen_top_sol")
	fec_sol=document.getElementById("fec_sol")
	num_sol=document.getElementById("num_sol")
	if(fec_sol.value=="" || num_sol.value=="" || reg_id.value=="" || pen_top.value==""  || esp_id.value=="" || pen_top.value=="undefined"){
	  alert("DEBE LLENAR Y SELECCIONAR TODOS LOS CAMPOS")
	  return false  
	 }
	break	 
	case "camb_reg":
	reg_id=document.getElementById("reg_id_sol")
	esp_id=document.getElementById("esp_id_sol")
	pen_top=document.getElementById("pen_top_sol")
	fec_sol=document.getElementById("fec_sol")
	num_sol=document.getElementById("num_sol")
	if(fec_sol.value=="" || num_sol.value=="" || reg_id.value=="" || pen_top.value=="" || esp_id.value=="" || pen_top.value=="undefined"){
	  alert("DEBE LLENAR Y SELECCIONAR TODOS LOS CAMPOS")
	  return false  
	 }
	break	 
	case "equiv_est":
	mod_id=document.getElementById("mod_id_sol")
	reg_id=document.getElementById("reg_id_sol")
	esp_id=document.getElementById("esp_id_sol")
	coh_id=document.getElementById("coh_id_sol")
	pen_top=document.getElementById("pen_top_sol")
	inf_id=document.getElementById("inf_id_sol")
	fec_sol=document.getElementById("fec_sol")
	num_sol=document.getElementById("num_sol")
	if(fec_sol.value=="" || num_sol.value=="" || mod_id.value=="" || reg_id.value=="" || esp_id.value=="" || coh_id.value=="" || inf_id.value=="" || pen_top.value=="" || inf_id.value=="undefined" ){
	  alert("DEBE LLENAR Y SELECCIONAR TODOS LOS CAMPOS")
	  return false  
	 }
	break
    case "const":
	mod_id=document.getElementById("mod_id_sol")
	reg_id=document.getElementById("reg_id_sol")
	esp_id=document.getElementById("esp_id_sol")
	coh_id=document.getElementById("coh_id_sol")
	pen_top=document.getElementById("pen_top_sol")
	if(mod_id.value=="" || reg_id.value=="" || esp_id.value=="" || pen_top.value=="" || coh_id.value=="" || pen_top.value=="undefined"){
	  alert("DEBE SELECCIONAR TODOS LOS CAMPOS")
	  return false  
	 }
	break
	default:
	fec_sol=document.getElementById("fec_sol")
	num_sol=document.getElementById("num_sol")
	if(fec_sol.value=="" || num_sol.value==""){
	alert("DEBE LLENAR TODOS LOS CAMPOS")
	  return false 
	}
  break	   
  }
}
//***************************************************************************************
</script>
</head>
<!-- link calendar files  -->
	<script language="JavaScript" src="../Funciones/calendario/calendar_us.js"></script>
	<link rel="stylesheet" href="../Funciones/calendario/calendar.css">
<script src='../Funciones/funcion.validar.js'></script>
<body bgcolor="#a9c3e8" leftmargin="0" rightmargin="0" topmargin="0">
<?php
  $_SESSION["ci"];
  include("../Funciones/cascadas.css");
  include("../Funciones/funciones.php");
  require("../Clases/class.conexion.php");
  include("../Clases/class.menus.php");
  $NuevoMenu = new menus("","","","","");
  $NuevoMenu->conec_BD();
  $NuevoMenu->conectar_BD();
  include ("../Clases/class.plantilla.php");
  $Plantilla = new plantilla("","","");
  include ("../Clases/class.cambio_reingreso.php");
  $NuevoCamb=new camb();
  $NuevoCamb->conec_BD();
  $NuevoCamb->conectar_BD();
  $ci_est=$_POST["ci_estud"];
  $opcion=$_POST["opcion"];
if($_SESSION['ci']!=""){
  if(!isset($_POST[data_princ]) && $opcion=="const"){
    if($NuevoCamb->busc_alum_equiv($ci_est)==0){
	echo "<script>alert('EL ESTUDIANTE NO POSEE EQUIVALENCIAS EN SU MATRICULA ACTIVA')
	location.href='Opciones.php?opcion=$opcion'</script>";
	}  
  }
if(!isset($_POST[data_princ])){ 
  $resp=$NuevoCamb->busc_alum($ci_est);
  $data=$NuevoCamb->ConsultarCualquiera($resp); 
  $consul_inf_id=$NuevoCamb->inf_id_alum($ci_est,$data->matr_sta);
  $inf_id=$NuevoCamb->ConsultarCualquiera($consul_inf_id);	
	if($NuevoCamb->NumFilas1($resp)==0){
	echo "<script language='javascript'>alert('EL ESTUDIANTE NO TIENE NINGUNA MATRICULA')
	location.href='Opciones.php'</script>";
	}
?>
  <form action="agre_camb_soli.php" method="post" enctype="multipart/form-data" name="form">
      <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="1" width="10%">&nbsp;</td>
        <td colspan="1" width="80%">
          <table width="750px" height="25px" border="0" align="center" cellspacing="0" cellpadding="0">
          <?php $menu_princ=$NuevoMenu->menu_principal('4201');//($_GET[ayu]); 
		  echo $menu_princ;?>
		    <input name="ayu" id="ayu" type="hidden" value="<?php echo "".$_GET[ayu]; ?>">
          </table>
		</td>
        <td colspan="1" width="10%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" width="100%">
		  <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="1" width="100%"><div id="container2">
                <table style="width: 800px; text-align: center; margin-left: auto; margin-right: auto;" border="0" cellpadding="0" cellspacing="0" align="center">
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr>
                    <td width="100%">
					  <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bgcolor="#ffffff">
					    <tr><td colspan="4" bgcolor="#000066"><span class="Estilo1">:: AGREGAR Y PROCESAR SOLICITUD DEL ESTUDIANTE</span></td></tr>
						<tr>
						  <td colspan="2" bgcolor="#FFFFFF"><div align="right" class="Estilo9">C&eacute;dula del Estudiante:</div></td>
						  <td colspan="2" bgcolor="#FFFFFF"><div align="left"><input type="text" id="ci_estud" name="ci_estud" value="<?php echo $ci_est;?>" style="font-size:9px; width:170px;" disabled="disabled"></div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF" width="24%"><div align="right" class="Estilo9">Apellidos:</div></td>
						  <td bgcolor="#FFFFFF" width="26%"><div align="left" class="Estilo9"><input type="text" id="ape" name="ape" value="<?php echo $data->ap1." ".$data->ap2;?>" style="font-size:9px; width:170px;" disabled="disabled"/></div></td>
						  <td bgcolor="#FFFFFF" width="23%"><div align="right" class="Estilo9">Nombres:</div></td>
						  <td bgcolor="#FFFFFF" width="27%"><div align="left" class="Estilo9"><input type="text" id="nom" name="nom" value="<?php echo $data->no1." ".$data->no2;?>" style="font-size:9px; width:170px;" disabled="disabled"/></div></td>
						</tr>
						<tr>
						  <td bgcolor="#FFFFFF" width="24%"><div align="right" class="Estilo9">Modalidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF" width="26%"><div align="left" class="Estilo9"><input type="text" id="mod_id" name="mod_nom" value="<?php echo $data->mod_nom;?>" style="font-size:9px; width:170px;" disabled="disabled"/></div></td>
						  <td bgcolor="#FFFFFF" width="23%"><div align="right" class="Estilo9">R&eacute;gimen Acad&eacute;mico:</div></td>
						  <td bgcolor="#FFFFFF" width="27%"><div align="left" class="Estilo9"><input type="text" id="reg_id" name="reg_nom" value="<?php echo $data->reg_nom;?>" style="font-size:9px; width:170px;" disabled="disabled"/></div></td>
						</tr>
						<tr>
						  <td bgcolor="#FFFFFF" width="24%"><div align="right" class="Estilo9">Especialidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF" width="26%"><div align="left" class="Estilo9"><input type="text" id="esp_id" name="esp_nom" value="<?php echo $data->esp_nom?>" style="font-size:9px; width:170px;" disabled="disabled"/></div></td>
						  <td bgcolor="#FFFFFF" width="23%"><div align="right" class="Estilo9">Cohorte Acad&eacute;mico:</div></td>
						  <td bgcolor="#FFFFFF" width="27%"><div align="left" class="Estilo9"><input type="text" id="coh_id" name="coh_nom" value="<?php echo $data->coh_nom?>" style="font-size:9px; width:170px;" disabled="disabled"/></div></td>
						</tr>
					    <tr>
					      <td colspan="2" bgcolor="#FFFFFF" class="Estilo9"><div align="right">Tipo de Pensum:</div></td>
					      <td colspan="2" bgcolor="#FFFFFF" class="Estilo9"><div align="left"><input type="text" id="tip_pensum" name="tip_pensum" value="<?php if($data->pen_top==0) echo "PASANTIAS"; else echo "TRABAJO ESPECIAL DE GRADO";?>" style="font-size:9px; width:170px;" disabled="disabled"></div></td>
                          <input type="hidden" id="data_princ" name="data_princ" value="<?php echo $ci_est."*".$data->mod_id."*".$data->esp_id."*".$data->coh_id."*".$data->reg_id."*".$data->pen_top."*".$data->matr_sta."*".$inf_id->inf_id;?>">
				        </tr>
                        
                        <?php
                        switch ($opcion){
//********************************CAMBIO DE CARRERA***********************************************
						  case "camb_car":
						?>
                          <input type="hidden" id="opcion" name="opcion" value="<?php echo $opcion;?>">
                          <input type="hidden" id="esp_nom_act" name="esp_nom_act" value="<?php echo $data->esp_nom;?>">
						    <tr>
					      <td colspan="4" bgcolor="#000066"><span class="Estilo1">CAMBIO DE CARRERA</span></td></tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Fecha de la Solicitud:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><input type="text" id="fec_sol" name="fec_sol" style="font-size:9px; width:170px;"></div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">N&ordm; de la Solicitud:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><input type="text" id="num_sol" name="num_sol" style="font-size:9px; width:170px;"></div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Modalidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><select id="mod_id_sol" name="mod_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo_carre('mod_id_sol*reg_id_sol')">
                            <option value="">-SELECCIONE-</option>
                            <?php
							  $NuevoCamb->List_modali_carre($data->esp_nom);
							  while($array=$NuevoCamb->Consultar()){
							    echo "<option value=\"$array->mod_id\" title=\"$array->mod_nom\">$array->mod_nom</option>";
							  }
						    ?>
                          </select></div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">R&eacute;gimen Acad&eacute;mico:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><select id="reg_id_sol" name="reg_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo_carre('reg_id_sol*esp_id_sol')" disabled="disabled">
                            <option value="">-SELECCIONE-</option>  
                          </select></div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Especialidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><select id="esp_id_sol" name="esp_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo_carre('esp_id_sol*coh_id_sol')" disabled="disabled">
                            <option value="">-SELECCIONE-</option>
                          </select></div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Cohorte Acad&eacute;mico:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><select id="coh_id_sol" name="coh_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo_carre('coh_id_sol*pen_top_sol')" disabled="disabled">
                            <option value="">-SELECCIONE-</option>
                          </select></div></td>
					    </tr>
						<tr><td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Tipo de Pensum:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="pen_top_sol" name="pen_top_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo_carre('pen_top_sol*inf_id_sol')" disabled="disabled">
						      <option value="">-SELECCIONE-</option>
						      </select>
					      </div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Infraestructura:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"> <select id="inf_id_sol" name="inf_id_sol" style="font-size:9px; width:170px;" disabled="disabled">
						      <option value="">-SELECCIONE-</option>
						      </select></div></td>
					    </tr>
						<tr>
						  <td colspan="2" bgcolor="#FFFFFF"><div align="right" class="Estilo9">Observaci&oacute;n:</div></td>
						  <td colspan="2" bgcolor="#FFFFFF"><div align="left" class="Estilo9">
						    <textarea id="observ" name="observ" cols="50" rows="3"></textarea>
					      </div></td>
					    </tr>
                        <?php
						  break;
//******************************CAMBIO DE ESPECIALIDAD*****************************
						  case "camb_esp":
						?>
                        <input type="hidden" id="opcion" name="opcion" value="<?php echo $opcion;?>">
                        <input type="hidden" id="dat_esp" name="dat_esp" value="<?php echo $data->mod_id."*".$data->esp_id."*".$data->esp_nom."*".$data->coh_id;?>">
						  <tr>
					      <td colspan="4" bgcolor="#000066"><span class="Estilo1">CAMBIO DE ESPECIALIDAD</span></td></tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Fecha de la Solicitud:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><input type="text" id="fec_sol" name="fec_sol" style="font-size:9px; width:170px;"></div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">N&ordm; de la Solicitud:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><input type="text" id="num_sol" name="num_sol" style="font-size:9px; width:170px;"></div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Modalidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="mod_id_sol" name="mod_id_sol" style="font-size:9px; width:170px;" disabled="disabled">
						      <option value="<?php echo $data->mod_id;?>"><?php echo $data->mod_nom?></option>
                            </select>
					      </div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">R&eacute;gimen Acad&eacute;mico:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="reg_id_sol" name="reg_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo_esp('reg_id_sol*esp_id_sol')">
						      <option value="">-SELECCIONE-</option>
						      <?php
                                $pasar=$data->mod_id."*".$data->esp_id."*".$data->esp_nom."*".$data->coh_id;
							    $reg_especi=$NuevoCamb->Buscar_reg_especi($pasar);
							    $valor=explode("@",$reg_especi);
							    $reg_id_camb=explode("*",$valor[0]);
							    $reg_nom_camb=explode("*",$valor[1]);
							      for($i=0;$i<$valor[2];$i++){
							      echo "<option value='$reg_id_camb[$i]'>$reg_nom_camb[$i]</option>";  
							      }
                                ?>
						      </select>
					      </div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Especialidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="esp_id_sol" name="esp_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo_esp('esp_id_sol*pen_top_sol')" disabled="disabled">
						      <option value="">-SELECCIONE-</option>
						      </select>
					      </div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Cohorte Acad&eacute;mico:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="coh_id_sol" name="coh_id_sol" style="font-size:9px; width:170px;" disabled="disabled">
						      <option value="<?php echo $data->coh_id;?>"><?php echo $data->coh_nom;?></option>
						      </select>
					      </div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Tipo de Pensum:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="pen_top_sol" name="pen_top_sol" style="font-size:9px; width:170px;" disabled="disabled">
						      <option value="">-SELECCIONE-</option>
						      </select>
					      </div></td>
                          <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Observaci&oacute;n:</div></td>
                          <td bgcolor="#FFFFFF"><div align="left" class="Estilo9">
                            <textarea id="observ" name="observ" cols="20" rows="5"></textarea>
                          </div></td>
					    </tr>
						<?php
						  break;
//**********************CAMBIO DE REGIMEN*****************************************
                          case "camb_reg":
						?>
                        <input type="hidden" id="opcion" name="opcion" value="<?php echo $opcion;?>">
                        <tr>
					      <td colspan="4" bgcolor="#000066"><span class="Estilo1">CAMBIO DE REGIMEN</span></td></tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Fecha de la Solicitud:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><input type="text" id="fec_sol" name="fec_sol" style="font-size:9px; width:170px;"></div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">N&ordm; de la Solicitud:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><input type="text" id="num_sol" name="num_sol" style="font-size:9px; width:170px;"></div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Modalidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="mod_id_sol" name="mod_id_sol" style="font-size:9px; width:170px;" disabled="disabled">
						      <option value="<?php echo $data->mod_id;?>"><?php echo $data->mod_nom?></option>
						      </select>
					      </div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">R&eacute;gimen Acad&eacute;mico:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="reg_id_sol" name="reg_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo_reg('reg_id_sol*esp_id_sol')">
						      <option value="">-SELECCIONE-</option>
						      <?php 
							$pasar=$data->mod_id."*".$data->reg_id;
							$regimen=$NuevoCamb->Buscar_regimen($pasar);
							$valor=explode("@",$regimen);
							$reg_id_camb=explode("*",$valor[0]);
							$reg_nom_camb=explode("*",$valor[1]);
							  for($i=0;$i<$valor[2];$i++){
							  echo "<option value='$reg_id_camb[$i]'>$reg_nom_camb[$i]</option>";  
							  }
							?>
						      </select>
					      </div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Especialidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="esp_id_sol" name="esp_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo_reg('reg_id_sol*pen_top_sol')" disabled="disabled">
						      <option value="">-SELECCIONE-</option>
						      </select>
					      </div></td>
                          <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Cohorte Acad&eacute;mico:</div></td>
                          <td bgcolor="#FFFFFF"><div align="left">
                            <select id="coh_id_sol" name="coh_id_sol" style="font-size:9px; width:170px;" disabled="disabled">
                              <option value="<?php echo $data->coh_id;?>"><?php echo $data->coh_nom;?></option>
                            </select>
                          </div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Tipo de Pensum:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="pen_top_sol" name="pen_top_sol" style="font-size:9px; width:170px;" disabled="disabled">
						      <option value="">-SELECCIONE-</option>
						      </select>
					      </div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Observaci&oacute;n:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left" class="Estilo9">
						    <textarea id="observ" name="observ" cols="20" rows="5"></textarea>
					      </div></td>
					    </tr>
						<?php
						  break;  
//**************************************EQUIVALENCIAS************************************************* 
                          case "equiv_est":
						?>
                        <input type="hidden" id="opcion" name="opcion" value="<?php echo $opcion;?>">  
						    <tr>
					      <td colspan="4" bgcolor="#000066"><span class="Estilo1">EQUIVALENCIAS</span></td></tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Fecha de la Solicitud:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><input type="text" id="fec_sol" name="fec_sol" style="font-size:9px; width:170px;"></div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">N&ordm; de la Solicitud:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><input type="text" id="num_sol" name="num_sol" style="font-size:9px; width:170px;"></div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Modalidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><select id="mod_id_sol" name="mod_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo('mod_id_sol*reg_id_sol');">
                            <option value="">-SELECCIONE-</option>
                            <?php
							  $NuevoCamb->List_modali();
							  while($array=$NuevoCamb->Consultar()){
							    echo "<option value=\"$array->mod_id\" title=\"$array->mod_nom\">$array->mod_nom</option>";
							  }
						    ?>
                          </select></div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">R&eacute;gimen Acad&eacute;mico:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><select id="reg_id_sol" name="reg_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo('reg_id_sol*esp_id_sol')" disabled="disabled">
                            <option value="">-SELECCIONE-</option>  
                          </select></div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Especialidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><select id="esp_id_sol" name="esp_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo('esp_id_sol*coh_id_sol')" disabled="disabled">
                            <option value="">-SELECCIONE-</option>
                          </select></div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Cohorte Acad&eacute;mico:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><select id="coh_id_sol" name="coh_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo('coh_id_sol*pen_top_sol')" disabled="disabled">
                            <option value="">-SELECCIONE-</option>
                          </select></div></td>
					    </tr>
						<tr><td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Tipo de Pensum:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="pen_top_sol" name="pen_top_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo('pen_top_sol*inf_id_sol')" disabled="disabled">
						      <option value="">-SELECCIONE-</option>
						      </select>
					      </div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Infraestructura:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"> <select id="inf_id_sol" name="inf_id_sol" style="font-size:9px; width:170px;" disabled="disabled">
						      <option value="">-SELECCIONE-</option>
						      </select></div></td>
					    </tr>
						<tr>
						  <td colspan="2" bgcolor="#FFFFFF"><div align="right" class="Estilo9">Observaci&oacute;n:</div></td>
						  <td colspan="2" bgcolor="#FFFFFF"><div align="left" class="Estilo9">
						    <textarea id="observ" name="observ" cols="50" rows="3"></textarea>
					      </div></td>
					    </tr>
                          <?php
						  break;
//**************************************REINGRESO****************************						  
                          case "rein_est":
						?>
                        <input type="hidden" id="opcion" name="opcion" value="<?php echo $opcion;?>">
                          <tr>
					      <td colspan="4" bgcolor="#000066">REINGRESO</td></tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Fecha de la Solicitud:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><input type="text" id="fec_sol" name="fec_sol" style="font-size:9px; width:170px;"></div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">N&ordm; de la Solicitud:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><input type="text" id="num_sol" name="num_sol" style="font-size:9px; width:170px;"></div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Modalidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="mod_id_sol" name="mod_id_sol" style="font-size:9px; width:170px;" disabled="disabled">
						      <option value="<?php echo $data->mod_id;?>"><?php echo $data->mod_nom;?></option>
					        </select>
					      </div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">R&eacute;gimen Acad&eacute;mico:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="reg_id_sol" name="reg_id_sol" style="font-size:9px; width:170px;" disabled="disabled">
						      <option value="<?php echo $data->reg_id;?>"><?php echo $data->reg_nom;?></option>
   					        </select>
					      </div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Especialidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="esp_id_sol" name="esp_id_sol" style="font-size:9px; width:170px;" disabled="disabled">
						      <option value="<?php echo $data->esp_id;?>"><?php echo $data->esp_nom;?></option>
					        </select>
					      </div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Cohorte Acad&eacute;mico:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="coh_id_sol" name="coh_id_sol" style="font-size:9px; width:170px;" disabled="disabled">
						      <option value="<?php echo $data->coh_id;?>"><?php echo $data->coh_nom;?></option>
						    </select>
					      </div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Tipo de Pensum:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left">
						    <select id="pen_top_sol" name="pen_top_sol" style="font-size:9px; width:170px;">
						      <option value="">-SELECCIONE-</option>
						      <?php
                              $cons_pen_top=$NuevoCamb->busc_tip_pen($data->mod_id,$data->reg_id,$data->esp_id,$data->coh_id);	
							  while($pen_top=$NuevoCamb->ConsultarCualquiera($cons_pen_top)){  
							  echo "<option value='$pen_top->pen_top'>";if($pen_top->pen_top==0) echo "PASANTIAS </option>"; else echo "TRABAJO ESPECIAL DE GRADO </option>";
							  }
							  ?>
						      </select>
					      </div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Observaci&oacute;n:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left" class="Estilo9">
						    <textarea id="observ" name="observ" cols="20" rows="5"></textarea>
					      </div></td>
					    </tr>
						<?php
						break;
//********************************CONSTANCIA DE EQUIVALENCIAS**********************
						default:
						?>
                          <input type="hidden" id="opcion" name="opcion" value="<?php echo $opcion;?>">
                          <input type="hidden" id="esp_nom_act" name="esp_nom_act" value="<?php echo $data->esp_nom;?>">
						    <tr>
					      <td colspan="4" bgcolor="#000066"><span class="Estilo1">CONSTANCIA DE EQUIVALENCIAS</span></td></tr>
					    <tr>
						      <td colspan="4" bgcolor="#FFFFFF"><div align="center">PENSUM ANTERIOR</div></td>
				        </tr>
					    <tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Modalidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><select id="mod_id_sol" name="mod_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo('mod_id_sol*reg_id_sol')">
                            <option value="">-SELECCIONE-</option>
                            <?php
							  $NuevoCamb->List_modali_carre($data->esp_nom);
							  while($array=$NuevoCamb->Consultar()){
							    echo "<option value=\"$array->mod_id\" title=\"$array->mod_nom\">$array->mod_nom</option>";
							  }
						    ?>
                          </select></div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">R&eacute;gimen Acad&eacute;mico:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><select id="reg_id_sol" name="reg_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo('reg_id_sol*esp_id_sol')" disabled="disabled">
                            <option value="">-SELECCIONE-</option>  
                          </select></div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Especialidad Acad&eacute;mica:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><select id="esp_id_sol" name="esp_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo('esp_id_sol*coh_id_sol')" disabled="disabled">
                            <option value="">-SELECCIONE-</option>
                          </select></div></td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Cohorte Acad&eacute;mico:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left"><select id="coh_id_sol" name="coh_id_sol" style="font-size:9px; width:170px;" onChange="Buscar_Combo('coh_id_sol*pen_top_sol')" disabled="disabled">
                            <option value="">-SELECCIONE-</option>
                          </select></div></td>
					    </tr>
						<tr>
						  <td bgcolor="#FFFFFF">&nbsp;</td>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Tipo de Pensum:</div></td>
                          <td><div align="left">
                            <select id="pen_top_sol" name="pen_top_sol" style="font-size:9px; width:170px;" disabled="disabled">
                              <option value="">-SELECCIONE-</option>
                            </select>
                          </div></td>
                          <td>&nbsp;</td>
					    </tr>
                        <?php
						break;
						}
						?>
						<tr>
					      <td bgcolor="#FFFFFF" colspan="4" height="25px">
						    <input name="Aceptar" type="submit" class="Boton" value="Aceptar" onclick="return confirmar()">
						    <input name="Cancelar" type="button" class="Boton" value="Cancelar" onClick="location.href='Opciones.php'">
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
<?php
}
else{
$_SESSION["ci"];
  switch($_POST[opcion]){
	  
    case "camb_car";
	$data=explode("*",$_POST[data_princ]);
	$NuevoCamb->busc_inf_alum($_POST[data_princ],$_POST[inf_id_sol]);
	$cambio="CAMB CARRERA";
	$NuevoCamb->activ_matric($_POST[data_princ],$_POST[mod_id_sol],$_POST[reg_id_sol],$_POST[esp_id_sol],$_POST[coh_id_sol],$_POST[pen_top_sol],$_POST[fec_sol],$_POST[num_sol],$cambio,$_POST[observ],$_SESSION["ci"]);
	//$NuevoCamb->desact_detins($data[0],$data[1],$data[4],$data[2],$data[3],$data[5],$data[6]);
	$NuevoCamb->rev_expedi($data[0],$data[2],$_POST[esp_id_sol],$cambio);	
	
	echo "<script language='javascript'>alert('CAMBIO DE CARRERA REALIZADO DE FORMA SATISFACTORIA')
	location.href='Opciones.php?opcion=$_POST[opcion]'</script>";
	break;	 
	
	case "camb_esp":
	$data=explode("*",$_POST[data_princ]);
	$cambio="CAMB ESPEC";
	/*echo "<script>alert('$_POST[observ]')</script>";*/
	$NuevoCamb->activ_matric($_POST[data_princ],$data[1],$_POST[reg_id_sol],$_POST[esp_id_sol],$data[3],$_POST[pen_top_sol],$_POST[fec_sol],$_POST[num_sol],$cambio,$_POST[observ],$_SESSION["ci"]);
	//$NuevoCamb->desact_detins($data[0],$data[1],$data[4],$data[2],$data[3],$data[5],$data[6]);
	$NuevoCamb->camb_detins_esp($_POST[data_princ],$_POST[reg_id_sol],$_POST[esp_id_sol],$_POST[pen_top_sol],$_POST[fec_sol],$_POST[num_sol],$cambio,$_POST[observ],$_SESSION["ci"]);
	$NuevoCamb->rev_expedi($data[0],$data[2],$_POST[esp_id_sol],$cambio);
	echo "<script language='javascript'>alert('CAMBIO DE ESPECIALIDAD REALIZADO DE FORMA SATISFACTORIA')
	location.href='Opciones.php?opcion=$_POST[opcion]'</script>";
	break;
	
	case "camb_reg":
	$data=explode("*",$_POST[data_princ]);
	$cambio="CAMB REGIMEN";
	$NuevoCamb->activ_matric($_POST[data_princ],$data[1],$_POST[reg_id_sol],$_POST[esp_id_sol],$data[3],$_POST[pen_top_sol],$_POST[fec_sol],$_POST[num_sol],$cambio,$_POST[observ],$_SESSION["ci"]); 
	$NuevoCamb->camb_detins_regi_reing($_POST[data_princ],$_POST[reg_id_sol],$_POST[esp_id_sol],$_POST[pen_top_sol],$_POST[fec_sol],$_POST[num_sol],$cambio,$_POST[observ],$_SESSION["ci"]);
	$NuevoCamb->rev_expedi($data[0],$data[2],$_POST[esp_id_sol],$cambio);
	echo "<script language='javascript'>alert('CAMBIO DE REGIMEN REALIZADO DE FORMA SATISFACTORIA')
	location.href='Opciones.php?opcion=$_POST[opcion]'</script>";
	break;
	
	case "equiv_est":
	$data=explode("*",$_POST[data_princ]);
	$cambio="EQUIVALENCIA";
	$NuevoCamb->realiz_equiv($_POST[data_princ],$_POST[mod_id_sol],$_POST[reg_id_sol],$_POST[esp_id_sol],$_POST[coh_id_sol],$_POST[pen_top_sol],$_POST[fec_sol],$_POST[num_sol],$cambio,$_POST[observ],$_SESSION["ci"],$_POST[inf_id_sol]);
	$menu_princ=$NuevoMenu->menu_principal('4201');//($_GET[ayu]); 
    echo $menu_princ
	?>
    <input name="ayu" id="ayu" type="hidden" value="<?php echo "".$_GET[ayu]; ?>">
	<?php
    $data_princ=$data[0]."*".$_POST[mod_id_sol]."*".$_POST[esp_id_sol]."*".$_POST[coh_id_sol]."*".$_POST[reg_id_sol]."*".$_POST[pen_top_sol];
	$data_sol=$data[1]."*".$data[4]."*".$data[2]."*".$data[3]."*".$data[5];
	?>
    <form id="constan" name="constan" method="post" action="Reporte/Constancia_equiv.php" target="_blank">
    <input type="hidden" id="data_princ" name="data_princ" value="<?php echo $data_princ;?>">
    <input type="hidden" id="data_sol" name="data_sol" value="<?php echo $data_sol;?>">
    
    <?php 
	$alum=$NuevoCamb->busc_alum($data[0]);
	$ext_alum=$NuevoCamb->ConsultarCualquiera($alum);
	$nuc_carre=$NuevoCamb->busc_nucleo_carrera($data[0],$_POST[mod_id_sol],$_POST[reg_id_sol],$_POST[esp_id_sol],$_POST[coh_id_sol],$_POST[pen_top_sol]);
	$ext_nuc_carre=$NuevoCamb->ConsultarCualquiera($nuc_carre);
	$mod_coh_nom_act=$NuevoCamb->busc_mod_coh_nom($data[0],$_POST[mod_id_sol],$_POST[reg_id_sol],$_POST[esp_id_sol],$_POST[coh_id_sol],$_POST[pen_top_sol],"valor");
	$ext_mod_coh_nom_act=$NuevoCamb->ConsultarCualquiera($mod_coh_nom_act);
	$mod_coh_nom_ant=$NuevoCamb->busc_mod_coh_nom($data[0],$data[1],$data[4],$data[2],$data[3],$data[5],"valor1");
	$ext_mod_coh_nom_ant=$NuevoCamb->ConsultarCualquiera($mod_coh_nom_ant);
	$tam="1000px";
	?>
    <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="1" width="10%">&nbsp;</td>
        <td colspan="1" width="80%">
          <table width="750px" height="25px" border="0" align="center" cellspacing="0" cellpadding="0">
<?php
  $menu_princ=$NuevoMenu->menu_principal('4201');//($_GET[ayu]);
  echo $menu_princ;?>
		    <input name="ayu" id="ayu" type="hidden" value="<?php echo "".$_GET[ayu]; ?>">
          </table>
		</td>
        <td colspan="1" width="10%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" width="100%">
		  <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="1" width="100%"><div id="container2">
                <table width="794" border="0" align="center" cellpadding="0" cellspacing="0" style="width: 750px; text-align: center; margin-left: auto; margin-right: auto;">
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr>
                    <td width="100%">
					  <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bgcolor="#ffffff">
					    <tr>
					      <td width="49%" colspan="8" bgcolor="#000066"><span class="Estilo1">::  EQUIVALENCIAS INTERNAS</span>
                          </td>
                        </tr>
                        <tr>
					      <td>
                      <center><table table style="width: 800px; text-align: center; margin-left: auto; margin-right: auto;" border="0" cellpadding="0" cellspacing="0" align="center">
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="84"><div align="right"><img src="../IMAG/Escudo.png" width="72" height="89"></div></td>
                          <td><center>
                          <font size="2"><b>UNIVERSIDAD NACIONAL EXPERIMENTAL POLITÉCNICA</b></font>
                          </center>
                          <center>
                          <font size="2"><b>DE LA FUERZA ARMADA</b></font>
                          </center>
                          <center>
                          <div align="left"></div>
                          <font size="2"><b>U.N.E.F.A</b></font>
                          </center>
                          <center>
                          <font size="2"><b>VICERRECTORADO ACADÉMICO</b></font>
                          </center>
                          <p>
                          <font size="4"><b><center>ANÁLISIS DE ASIGNATURAS EQUIVALENTES INTERNAS</center></b></font></td>
                        </tr>
                        <tr>
                          <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="5">
                            <table style="width: <?php echo $tam;?>; text-align: center; margin-left: auto; margin-right: auto; font-size:9px;" border="1" cellpadding="0" cellspacing="0" align="center">
                            <?php $dias=time();
                            $fecha=date("d/m/Y",$dias);?>
                              <tr>
                                <td><b><center>Cédula (1)</center></b></td>
                                <td><b><center>Nombres (2)</center></b></td>
                                <td><b><center>Apellidos (3)</center></b></td>   
                                <td><b><center>Núcleo (4)</center></b></td>
                                <td><b><center>Carrera (5)</center></b></td> 
                                <td><b><center>Fecha (6)</center></b></td>
                              </tr>
                              <tr>
                                <td><center><?php echo $data[0];?></center></td>
                                <td><center><?php echo $ext_alum->no1." ".$alum->no2;?></center></td>
                                <td><center><?php echo $ext_alum->ap1." ".$alum->ap2;?></center></td>
                                <td><center><?php echo $ext_nuc_carre->nuc_nom;?></center></td>
                                <td><center><?php echo $ext_nuc_carre->esp_nom;?></center></td> 
                                <td><center><?php echo $fecha;?></center></td>
                              </tr>
                              <tr>
                                <td colspan="6">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2"><b><center>Asignatura  ( modalidad <?php echo strtolower($ext_mod_coh_nom_act->mod_nom." ".$ext_mod_coh_nom_act->coh_nom);?> )</center></b></td>
                                <td colspan="2"><b><center>Asignatura Equivalente  ( modalidad <?php echo strtolower($ext_mod_coh_nom_ant->mod_nom." ".$ext_mod_coh_nom_ant->coh_nom);?> )</center></b></td>
                                <td width="66"><b><center>Recomendación (11)</center></b></td> 
                                <td width="110"><b><center>OBS. (12)</center></b></td>
                              </tr>
                              <tr>
                                <td width="59"><center>Código (7)</center></td>
                                <td width="124"><center>Asignatura (8)</center></td>
                                <td width="124"><center>Denominación (9)</center></td>
                                <td width="59"><center>Código (10)</center></td>
                                <td><center>&nbsp;</center></td> 
                                <td><center>&nbsp;</center></td>
                              </tr>
                              <?php 
			                  $bus_asi_cod_detins=$NuevoCamb->consul_asi_cod($data_princ);
			                  while($ext_bus_asi_cod_detins=$NuevoCamb->ConsultarCualquiera($bus_asi_cod_detins)){
			                  $bus_asi_cod_eq=$NuevoCamb->consul_asi_cod_eq($data_princ,$data[1],$data[4],$data[2],$data[3],$data[5],$ext_bus_asi_cod_detins->asi_cod);
			                  $cont=0;
			                  $row=1;
			                    if($NuevoCamb->NumFilas1($bus_asi_cod_eq)>1)
			                    $row=$NuevoCamb->NumFilas1($bus_asi_cod_eq);
		                      ?>
                              <tr>
                                <td rowspan="<?php echo $row;?>"><?php echo $ext_bus_asi_cod_detins->asi_cod;?></td>
                                <td rowspan="<?php echo $row;?>"><?php echo $ext_bus_asi_cod_detins->asi_nom;?></td>
                                <?php while($ext_bus_asi_cod_eq=$NuevoCamb->ConsultarCualquiera($bus_asi_cod_eq)){
			                    $consul_nom_asi_eq=$NuevoCamb->consul_nom_asi_cod($data_princ,$data[1],$data[4],$data[2],$data[3],$data[5],$ext_bus_asi_cod_eq->asi_cod_eq);
			                    $ext_consul_nom_asi_eq=$NuevoCamb->ConsultarCualquiera($consul_nom_asi_eq);
			                    $obs=$NuevoCamb->observ($data[0]);
			                    $ext_obs=$NuevoCamb->ConsultarCualquiera($obs);
			                      if($cont==0){?>
                                    <td><?php echo $ext_consul_nom_asi_eq->asi_nom; $cont++;?></td>
                                    <td><?php echo $ext_consul_nom_asi_eq->asi_cod;?></td>
                                    <td>APROBAR</td>
                                    <td><?php echo $ext_obs->his_des;?></td>
                                  </tr>
                                  <?php
				                  }
			                      else{
				                  ?>
                                  <tr>
                                    <td><?php echo $ext_consul_nom_asi_eq->asi_nom; $cont++;?></td>
                                    <td><?php echo $ext_consul_nom_asi_eq->asi_cod;?></td>
                                    <td>APROBAR</td>
                                    <td>&nbsp;</td>
                                  </tr>
                                  <?php 
				                  }
			                    }
			                  }
			                  ?>
                            </table>
                          </td>  
                        </tr>
                        <tr>
                          <td colspan="5">&nbsp;</td>
                        </tr>
                      </table></center>
                      <div align="center">Desea imprimir este pdf???&nbsp;&nbsp;<input type="radio" id="print" name="print" onclick='form.submit()'>Si&nbsp;&nbsp;<input type="radio" id="print" name="print" onclick="location.href='Opciones.php?opcion=<?php echo $_POST[opcion];?>'">No</div>
                    </td>
			      </tr>
                </table>
			  </td>
		    </tr>
			<tr><td width="51%">&nbsp;</td></tr>
			<tr><td width="51%">&nbsp;</td></tr>
		    <tr>
              <td colspan="3">
                <table style="width: 100%;" border="0" align="left" cellpadding="0" cellspacing="0">
                       <?php $scroll_fin=$Plantilla->table_scroll_fin();
                        echo $scroll_fin;?>
                </table>
              </td>
            </tr>
		  </table>
        </table>
      </table>     
    </form>
	<?php
	break;
	
	case rein_est:
	$data=explode("*",$_POST[data_princ]);
	$cambio="REINGRESO";
	$NuevoCamb->activ_matric($_POST[data_princ],$data[1],$data[4],$data[2],$data[3],$_POST[pen_top_sol],$_POST[fec_sol],$_POST[num_sol],$cambio,$_POST[observ],$_SESSION["ci"]); 
	  if($_POST[pen_top_sol]!=$data[5]){
	  $NuevoCamb->camb_detins_regi_reing($_POST[data_princ],$data[4],$data[2],$_POST[pen_top_sol],$_POST[fec_sol],$_POST[num_sol],$cambio,$_POST[observ],$_SESSION["ci"]);
	  }
	$NuevoCamb->rev_expedi($data[0],$data[2],$_POST[esp_id_sol],$cambio);
	echo "<script language='javascript'>alert('REINGRESO REALIZADO DE FORMA SATISFACTORIA')
	location.href='Opciones.php?opcion=$_POST[opcion]'</script>";
	break; 
	
	default:
	$menu_princ=$NuevoMenu->menu_principal('4201');//($_GET[ayu]); 
    echo $menu_princ
	?>
    <input name="ayu" id="ayu" type="hidden" value="<?php echo "".$_GET[ayu]; ?>">
	<?php
    $data=explode("*",$_POST[data_princ]);
	$check_matric=$NuevoCamb->check_mat($data[0],$_POST[mod_id_sol],$_POST[reg_id_sol],$_POST[esp_id_sol],$_POST[coh_id_sol],$_POST[pen_top_sol]);
	$data_sol=$_POST[mod_id_sol]."*".$_POST[reg_id_sol]."*".$_POST[esp_id_sol]."*".$_POST[coh_id_sol]."*".$_POST[pen_top_sol];
	if($NuevoCamb->NumFilas1($check_matric)>0){
	?>
    <form id="constan" name="constan" method="post" action="Reporte/Constancia_equiv.php" target="_blank">
    <input type="hidden" id="data_princ" name="data_princ" value="<?php echo $_POST[data_princ];?>">
    <input type="hidden" id="data_sol" name="data_sol" value="<?php echo $data_sol;?>">
    
    <?php 
	$alum=$NuevoCamb->busc_alum($data[0]);
	$ext_alum=$NuevoCamb->ConsultarCualquiera($alum);
	$nuc_carre=$NuevoCamb->busc_nucleo_carrera($data[0],$data[1],$data[4],$data[2],$data[3],$data[5]);
	$ext_nuc_carre=$NuevoCamb->ConsultarCualquiera($nuc_carre);
	$mod_coh_nom_act=$NuevoCamb->busc_mod_coh_nom($data[0],$data[1],$data[4],$data[2],$data[3],$data[5],"valor");
	$ext_mod_coh_nom_act=$NuevoCamb->ConsultarCualquiera($mod_coh_nom_act);
	$mod_coh_nom_ant=$NuevoCamb->busc_mod_coh_nom($data[0],$_POST[mod_id_sol],$_POST[reg_id_sol],$_POST[esp_id_sol],$_POST[coh_id_sol],$_POST[pen_top_sol],"valor1");
	$ext_mod_coh_nom_ant=$NuevoCamb->ConsultarCualquiera($mod_coh_nom_ant);
	$tam="1000px";
	?>
    <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="1" width="10%">&nbsp;</td>
        <td colspan="1" width="80%">
          <table width="750px" height="25px" border="0" align="center" cellspacing="0" cellpadding="0">
<?php
  $menu_princ=$NuevoMenu->menu_principal('4201');//($_GET[ayu]);
  echo $menu_princ;?>
		    <input name="ayu" id="ayu" type="hidden" value="<?php echo "".$_GET[ayu]; ?>">
          </table>
		</td>
        <td colspan="1" width="10%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" width="100%">
		  <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="1" width="100%"><div id="container2">
                <table width="794" border="0" align="center" cellpadding="0" cellspacing="0" style="width: 750px; text-align: center; margin-left: auto; margin-right: auto;">
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr>
                    <td width="100%">
					  <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bgcolor="#ffffff">
					    <tr>
					      <td width="49%" colspan="8" bgcolor="#000066"><span class="Estilo1">::  EQUIVALENCIAS INTERNAS</span>
                          </td>
                        </tr>
                        <tr>
					      <td>
                      <center><table table style="width: 800px; text-align: center; margin-left: auto; margin-right: auto;" border="0" cellpadding="0" cellspacing="0" align="center">
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="84"><div align="right"><img src="../IMAG/Escudo.png" width="72" height="89"></div></td>
                          <td><center>
                          <font size="2"><b>UNIVERSIDAD NACIONAL EXPERIMENTAL POLITÉCNICA</b></font>
                          </center>
                          <center>
                          <font size="2"><b>DE LA FUERZA ARMADA</b></font>
                          </center>
                          <center>
                          <font size="2"><b>U.N.E.F.A</b></font>
                          </center>
                          <center>
                          <font size="2"><b>VICERRECTORADO ACADÉMICO</b></font>
                          </center>
                          <p>
                          <font size="4"><b><center>ANÁLISIS DE ASIGNATURAS EQUIVALENTES INTERNAS</center></b></font></td>
                        </tr>
                        <tr>
                          <td colspan="5">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="5">
                            <table style="width: <?php echo $tam;?>; text-align: center; margin-left: auto; margin-right: auto; font-size:9px;" border="1" cellpadding="0" cellspacing="0" align="center">
                            <?php $dias=time();
                            $fecha=date("d/m/Y",$dias);?>
                              <tr>
                                <td><b><center>Cédula (1)</center></b></td>
                                <td><b><center>Nombres (2)</center></b></td>
                                <td><b><center>Apellidos (3)</center></b></td>   
                                <td><b><center>Núcleo (4)</center></b></td>
                                <td><b><center>Carrera (5)</center></b></td> 
                                <td><b><center>Fecha (6)</center></b></td>
                              </tr>
                              <tr>
                                <td><center><?php echo $data[0];?></center></td>
                                <td><center><?php echo $ext_alum->no1." ".$alum->no2;?></center></td>
                                <td><center><?php echo $ext_alum->ap1." ".$alum->ap2;?></center></td>
                                <td><center><?php echo $ext_nuc_carre->nuc_nom;?></center></td>
                                <td><center><?php echo $ext_nuc_carre->esp_nom;?></center></td> 
                                <td><center><?php echo $fecha;?></center></td>
                              </tr>
                              <tr>
                                <td colspan="6">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2"><b><center>Asignatura  ( modalidad <?php echo strtolower($ext_mod_coh_nom_act->mod_nom." ".$ext_mod_coh_nom_act->coh_nom);?> )</center></b></td>
                                <td colspan="2"><b><center>Asignatura Equivalente  ( modalidad <?php echo strtolower($ext_mod_coh_nom_ant->mod_nom." ".$ext_mod_coh_nom_ant->coh_nom);?> )</center></b></td>
                                <td width="66"><b><center>Recomendación (11)</center></b></td> 
                                <td width="110"><b><center>OBS. (12)</center></b></td>
                              </tr>
                              <tr>
                                <td width="59"><center>Código (7)</center></td>
                                <td width="124"><center>Asignatura (8)</center></td>
                                <td width="124"><center>Denominación (9)</center></td>
                                <td width="59"><center>Código (10)</center></td>
                                <td><center>&nbsp;</center></td> 
                                <td><center>&nbsp;</center></td>
                              </tr>
                              <?php 
			                  $bus_asi_cod_detins=$NuevoCamb->consul_asi_cod($_POST[data_princ]);
			                  while($ext_bus_asi_cod_detins=$NuevoCamb->ConsultarCualquiera($bus_asi_cod_detins)){
			                  $bus_asi_cod_eq=$NuevoCamb->consul_asi_cod_eq($_POST[data_princ],$_POST[mod_id_sol],$_POST[reg_id_sol],$_POST[esp_id_sol],$_POST[coh_id_sol],$_POST[pen_top_sol],$ext_bus_asi_cod_detins->asi_cod);
			                  $cont=0;
			                  $row=1;
			                    if($NuevoCamb->NumFilas1($bus_asi_cod_eq)>1)
			                    $row=$NuevoCamb->NumFilas1($bus_asi_cod_eq);
		                      ?>
                              <tr>
                                <td rowspan="<?php echo $row;?>"><?php echo $ext_bus_asi_cod_detins->asi_cod;?></td>
                                <td rowspan="<?php echo $row;?>"><?php echo $ext_bus_asi_cod_detins->asi_nom;?></td>
                              <?php while($ext_bus_asi_cod_eq=$NuevoCamb->ConsultarCualquiera($bus_asi_cod_eq)){
			                  $consul_nom_asi_eq=$NuevoCamb->consul_nom_asi_cod($_POST[data_princ],$_POST[mod_id_sol],$_POST[reg_id_sol],$_POST[esp_id_sol],$_POST[coh_id_sol],$_POST[pen_top_sol],$ext_bus_asi_cod_eq->asi_cod_eq);
			                  $ext_consul_nom_asi_eq=$NuevoCamb->ConsultarCualquiera($consul_nom_asi_eq);
			                  $obs=$NuevoCamb->observ($data[0]);
			                  $ext_obs=$NuevoCamb->ConsultarCualquiera($obs);
			                    if($cont==0){?>
                                  <td><?php echo $ext_consul_nom_asi_eq->asi_nom; $cont++;?></td>
                                  <td><?php echo $ext_consul_nom_asi_eq->asi_cod;?></td>
                                  <td>APROBAR</td>
                                  <td><?php echo $ext_obs->his_des;?></td>
                                </tr>
                                <?php
				                }
			                    else{
				                ?>
                                <tr>
                                  <td><?php echo $ext_consul_nom_asi_eq->asi_nom; $cont++;?></td>
                                  <td><?php echo $ext_consul_nom_asi_eq->asi_cod;?></td>
                                  <td>APROBAR</td>
                                  <td>&nbsp;</td>
                                </tr>
                                <?php 
				                }
			                  }
			                }
			                ?>
                            </table>
                          </td>  
                        </tr>
                        <tr>
                          <td colspan="5">&nbsp;</td>
                        </tr>
                      </table></center>
                      <div align="center">Desea imprimir este pdf???&nbsp;&nbsp;<input type="radio" id="print" name="print" onclick='form.submit()'>Si&nbsp;&nbsp;<input type="radio" id="print" name="print" onclick="location.href='Opciones.php?opcion=<?php echo $_POST[opcion];?>'">No</div>  
                    </td>
			      </tr>
                </table>
			  </td>
		    </tr>
			<tr><td width="51%">&nbsp;</td></tr>
			<tr><td width="51%">&nbsp;</td></tr>
		    <tr>
              <td colspan="3">
                <table style="width: 100%;" border="0" align="left" cellpadding="0" cellspacing="0">
                       <?php $scroll_fin=$Plantilla->table_scroll_fin();
                        echo $scroll_fin;?>
                </table>
              </td>
            </tr>
		  </table>
        </table>
      </table>     
    </form>
	<?php
	break;
    }
	else{
	echo "<script>alert('EL PENSUM SOLICITADO NO ESTA ASOCIADO AL ESTUDIANTE')
	location.href='opciones.php?opcion=$_POST[opcion]'</script>";
	}
  }
}
}
else{
echo "<script>alert('SU SESIÓN HA SIDO CERRADA');</script>";
echo "<script>setTimeout(\"location.href='../'\");</script>";
}
?>
</body>
</html>