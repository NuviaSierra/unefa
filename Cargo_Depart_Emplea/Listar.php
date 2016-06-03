<?php session_start(); // Iniciamos la sesion?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Site SIDSECUN</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" src="../conexion/jquery-1.5.2.min.js"></script>
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
//************************************************************************************
function llenar_combos(valor){
if(valor!=""){
    var http=new getHTTPObject()
    enviar="valor="+valor+"&Operacion="+tipo+"&tim="+new Date().getTime()
    Dir="../Cargo_Depart_Emplea/Prueba.php"+"?"+enviar
	//alert(Dir)
    http.onreadystatechange = function(){
	if(http.readyState==4){
	  resultado = http.responseText.split("@")
	 //alert(resultado)
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
	  id[-1]="" 	
	  for(r=-1;r<cuanto;r++){		
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
    comb.options[ind]=new Option("--SELECCIONE--","")
    comb.disabled=true
  }
}
//***************************************************************************************
  function inf_infrae(){
  valor=document.getElementById("nucleo").value
    if(valor!=""){
    comb=document.getElementById("infrae")
      for(i=comb.length;i>-1;i--)
      comb.options[i]=null
    tipo="Consultar1"
      if(valor!="")
      {
      llenar_combos(valor)
      }
	}
	else{
	document.getElementById("infrae").disabled=true
	document.getElementById("infrae").value=""
	document.getElementById("depart").disabled=true
	document.getElementById("depart").value=""
    document.getElementById("cargo_emp").disabled=true
	document.getElementById("cargo_emp").value=""
	document.getElementById("ci").disabled=true
	document.getElementById("ci").value=""
	}
  }
//***************************************************************************************
  function dept_emp(){
    if(document.getElementById("infrae").value!=""){
	comb=document.getElementById("depart")
      for(i=comb.length;i>-1;i--)
      comb.options[i]=null
    tipo="Consultar3"
      if(valor!="")
      {
      llenar_combos(valor)
      }
	}
	else{
    document.getElementById("depart").disabled=true
	document.getElementById("depart").value=""
	document.getElementById("cargo_emp").disabled=true
	document.getElementById("cargo_emp").value=""
    document.getElementById("ci").disabled=true
	document.getElementById("ci").value=""
	}
  }
//***************************************************************************************
  function carg_dept_emp(){
    if(document.getElementById("depart").value!=""){
	document.getElementById("ci").disabled=false
	depa_id=document.getElementById("depart")
	comb=document.getElementById("cargo_emp")
      for(i=comb.length;i>-1;i--)
      comb.options[i]=null
    tipo="Consultar2"
	valor=depa_id.value
      if(valor!="")
      {
      llenar_combos(valor)
      }
	}
	else{
    document.getElementById("cargo_emp").disabled=true
	document.getElementById("cargo_emp").value=""
	document.getElementById("ci").disabled=true
	document.getElementById("ci").value=""
	}
  }
//**************************************************************************************
  function modif_carg_dept_emp(){
    if(document.getElementById("depart").value!=""){
	depa_id=document.getElementById("depart")
	comb=document.getElementById("cargo_emp")
      for(i=comb.length;i>-1;i--)
      comb.options[i]=null
    tipo="Consultar2"
	valor=depa_id.value
      if(valor!="")
      {
      llenar_combos(valor)
      }
	}
	else{
    document.getElementById("cargo_emp").disabled=true
	document.getElementById("cargo_emp").value=""
	}
  }
//**************************************************************************************
  function busc_carg(){
    if(document.getElementById("cargo_emp").value!=""){
    document.form.opc.value=1
    document.form.submit()
	}
	else{
	alert("DEBE SELECCIONAR UN CARGO PARA LA BÚSQUEDA")
	return false
	}
  }
//**************************************************************************************
  function busc_carg_ced(){
    if(document.getElementById("ci").value!=""){
    document.form.opc.value=2
    document.form.submit()
	}
	else{
	alert("DEBE AGREGAR UNA CÉDULA PARA LA BÚSQUEDA")
	return false
	}
  }
//**************************************************************************************
  function elim(){
  document.form.opc.value=3
  document.form.submit()
  }
  function modif(){
  document.form.opc.value=4
  document.form.submit()
  }
//**************************************************************************************
  function elim_boton(){
  $("#agregar").remove()
  $("#agr_botones").css("display","block")
  }
//**************************************************************************************
  function Modificar(){
  document.form.opc.value=5
  document.form.submit()
  }
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
  include("../Clases/class.carg_dept_emp.php");
  $NuevoCde = new carg_dept_emp();
  $NuevoCde->conec_BD();
  $NuevoCde->conectar_BD();
  include ("../Clases/class.plantilla.php");
  $Plantilla = new plantilla("","","");  
  $idper=$_SESSION["idper"];
  $ci=$_SESSION["ci"];
if($_SESSION["ci"]!=""){?>
<body bgcolor="#a9c3e8" leftmargin="0" rightmargin="0" topmargin="0">
  <form action="Listar.php" method="post" enctype="multipart/form-data" name="form">
      <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="1" width="10%">&nbsp;</td>
        <td colspan="1" width="80%">
          <table width="850px" height="25px" border="0" align="center" cellspacing="0" cellpadding="0">
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
                <table border="0" align="center" cellpadding="0" cellspacing="0" style="width: 850px; text-align: center; margin-left: auto; margin-right: auto;">
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr>
                    <td width="100%">
                      <?php
                      if(!isset($_POST[opc])){
					  ?>
					  <table style="width: 750px; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bgcolor="#ffffff">
					    <tr>
					      <td colspan="5" bgcolor="#000066"><span class="Estilo1">:: LISTAR CARGO-DEPARTAMNTO-EMPLEADO</span></td>
                        </tr>
					    <tr>
                        <input type="hidden" id="opc" name="opc">
                        <?php 
						$nucleo=$NuevoCde->nucleo($_SESSION["ci"]);
						?>
					      <td width="14%"><div align="right" class="Estilo9">N&uacute;clo:</div></td>
					      <td width="32%"><div align="left">
					        <select id="nucleo" name="nucleo" style="font-size:9px; width:170px;" onchange="inf_infrae()"> 
					          <option value="">--SELECCIONE--</option>
					        <?php
							while($ext_nucleo=$NuevoCde->ConsultarCualquiera($nucleo)){
                            ?>
					          <option value="<?php echo $ext_nucleo->nuc_id;?>" ><?php echo $ext_nucleo->nuc_nom;?></option>
					        <?php 	
							}
                            ?>
				            </select>
				          </div></td>
					      <td width="19%"><div align="right" class="Estilo9">Infraestructura:</div></td>
					      <td width="35%" colspan="2"><div align="left">
					        <select id="infrae" name="infrae" style="font-size:9px; width:170px;" onchange="dept_emp()" disabled="disabled"> 
					          <option value="">--SELECCIONE--</option>
				            </select>
				          </div></td>
				        </tr>
                        <tr>
                          <td><div align="right" class="Estilo9">Departamento:</div></td>
                          <td><div align="left">
                            <select id="depart" name="depart" style="font-size:9px; width:170px;" onchange="carg_dept_emp()" disabled="disabled">
                              <option value="">--SELECCIONE--</option>
                            </select>
                          </div></td>
                          <td><div align="right" class="Estilo9">Cargo:</div></td>
                          <td colspan="2"><div align="left">
                            <select id="cargo_emp" name="cargo_emp" style="font-size:9px; width:170px;" disabled="disabled">
                              <option value="">--SELECCIONE--</option>
                            </select>
                          <img src="../Imagenes/a_buspeq1.gif" alt="Buscar" width="20" height="20" style="cursor:pointer;" onclick=" return busc_carg()"/></div></td>
                        </tr>
                        <tr>
                          <td colspan="2"><div align="right" class="Estilo9">C&eacute;dula:</div></td>
                          <td colspan="3"><div align="left">
                            <input type="text" id="ci" name="ci" style="font-size:9px; width:170px;" disabled="disabled">
                          <img src="../Imagenes/a_buspeq1.gif" width="20" height="20" style="cursor:pointer;" onclick="busc_carg_ced()"/></div></td>
                        </tr>
                      </table>
                      <?php 
                      }
					  if($_POST[opc]==1){
					  ?>
                      <input type="hidden" id="opc" name="opc">
                      <input type="hidden" id="inf_emp" name="inf_emp">
                      <table style="width: 1000px; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bgcolor="#ffffff">
                        <tr>
                          <td bgcolor="#000066"><div align="center" class="Estilo1">C&Eacute;DULA</div></td>
                          <td bgcolor="#000066"><div align="center" class="Estilo1">NOMBRE </div></td>
                          <td bgcolor="#000066"><div align="center" class="Estilo1">APELLIDO</div></td>
                          <td width="22%" bgcolor="#000066"><div align="center" class="Estilo1">DEPARTAMENTO</div></td>
                          <td width="22%" bgcolor="#000066"><div align="center" class="Estilo1">CARGO</div></td>
                        </tr>
						<?php
						$cargo_emp=$NuevoCde->cargo_emp($_POST[infrae],$_POST[cargo_emp],$_POST[depart]);
						while($ext_cargo_emp=$NuevoCde->ConsultarCualquiera($cargo_emp)){
						?>
                        <tr>
                          <td><div align="left" style="font-size:9px; width:100px;">
                          <input type="radio" id="inf_car_emp" name="inf_car_emp" value="<?php echo $ext_cargo_emp->ci_emp."*".$_POST[infrae]."*".$_POST[nucleo]."*".$_POST[depart]."*".$_POST[cargo_emp];?>" onclick="elim_boton()"><?php echo $ext_cargo_emp->ci_emp;?></div></td>
                          <td><div align="left" style="font-size:9px; width:170px;"><?php echo $ext_cargo_emp->no1." ".$ext_cargo_emp->no2;?></div></td>
                          <td><div align="left" style="font-size:9px; width:170px;"><?php echo $ext_cargo_emp->ap1." ".$ext_cargo_emp->ap2;?></div></td>
                          <td><div align="left" style="font-size:9px; width:170px;"><?php echo $ext_cargo_emp->depa_nom;?></div></td>
                        <td><div align="left" style="font-size:9px; width:170px;"><?php echo $ext_cargo_emp->car_nom;?></div></td>  
                        </tr>
                        <?php
						  }
						?>
                        <tr>
                          <td colspan="5">
                            <center><table border="0">
                              <tr>
                                <td><input type="button" id="agregar" name="agregar" value="Agregar" class="Boton" onclick="location.href='Agregar.php?inf_id=<?php echo $_POST[infrae];?>&nuc_id=<?php echo $_POST[nucleo];?>&dep=<?php echo $_POST[depart];?>&car=<?php echo $_POST[cargo_emp];?>'">
                                </td>
                                  <td id="agr_botones" style="display:none"><input type="button" id="modificar" name="modificar" value="Modificar" class="Boton" onclick="modif()">&nbsp;<input type="button" id="eliminar" name="eliminar" class="Boton" value="Eliminar" onclick="elim()">
                                </td>
                                <td><input type="button" id="cancelar" name="cancelar" class="Boton" value="Cancelar" onclick="location.href='Listar.php'">
                                </td>
                              </tr>
                            </table></center>
                          </td>
                        </tr>
                      </table>
                        <?php
						} 
						else{
					      if($_POST[opc]==2){
					    ?>
                        <input type="hidden" id="opc" name="opc">
                        <input type="hidden" id="inf_emp" name="inf_emp">
                        <table style="width: 1000px; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bgcolor="#ffffff">
                          <tr>
                            <td bgcolor="#000066"><div align="center" class="Estilo1">C&Eacute;DULA</div></td>
                            <td bgcolor="#000066"><div align="center" class="Estilo1">NOMBRE </div></td>
                            <td bgcolor="#000066"><div align="center" class="Estilo1">APELLIDO</div></td>
                            <td width="22%" bgcolor="#000066"><div align="center" class="Estilo1">DEPARTAMENTO</div></td>
                            <td width="22%" bgcolor="#000066"><div align="center" class="Estilo1">CARGO</div></td>
                          </tr>
						  <?php
						  $cargo_emp=$NuevoCde->cargo_emp_cedu($_POST[infrae],$_POST[ci],$_POST[depart]);
						    while($ext_cargo_emp=$NuevoCde->ConsultarCualquiera($cargo_emp)){
						  ?>
                          <tr>
                            <td><div align="left" style="font-size:9px; width:100px;"><input type="radio" id="inf_car_emp" name="inf_car_emp" value="<?php echo $ext_cargo_emp->ci_emp."*".$_POST[infrae]."*".$_POST[nucleo]."*".$_POST[depart]."*".$ext_cargo_emp->car_id;?>" onclick="elim_boton()"><?php echo $ext_cargo_emp->ci_emp;?>
                            </div></td>
                            <td><div align="left" style="font-size:9px; width:170px;"><?php echo $ext_cargo_emp->no1." ".$ext_cargo_emp->no2;?></div></td>
                            <td><div align="left" style="font-size:9px; width:170px;"><?php echo $ext_cargo_emp->ap1." ".$ext_cargo_emp->ap2;?></div></td>
                            <td><div align="left" style="font-size:9px; width:170px;"><?php echo $ext_cargo_emp->depa_nom;?></div></td>
                            <td><div align="left" style="font-size:9px; width:170px;"><?php echo $ext_cargo_emp->car_nom;?></div></td>  
                          </tr>
                            <?php
						    }
						    ?>
                          <tr>
                            <td colspan="5">
                              <center><table border="0">
                                <tr>
                                  <td><input type="button" id="agregar" name="agregar" class="Boton" value="Agregar" onclick="location.href='Agregar.php?inf_id=<?php echo $_POST[infrae];?>&nuc_id=<?php echo $_POST[nucleo];?>&ci_emp=<?php echo $_POST[ci];?>&dep=<?php echo $_POST[depart];?>'">
                                  </td>
                                  <td id="agr_botones" style="display:none"><input type="button" id="modificar" name="modificar" value="Modificar" class="Boton" onclick="modif()">&nbsp;<input type="button" id="eliminar" name="eliminar" class="Boton" value="Eliminar" onclick="elim()">
                                  </td>
                                  <td><input type="button" id="cancelar" name="cancelar" class="Boton" value="Cancelar" onclick="location.href='Listar.php'">
                                  </td>
                                </tr>
                              </table></center>
                            </td>
                          </tr>
                        </table>
                          <?php
						  }
						  if($_POST[opc]==3){
						  $elim=$NuevoCde->eliminar($_POST[inf_car_emp]);
						  }
						  if($_POST[opc]==4){
						  ?>
                          <input type="hidden" id="opc" name="opc">
                          <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bgcolor="#ffffff">
					    <tr>
					      <td colspan="8" bgcolor="#000066"><span class="Estilo1">::  MODIFICAR CARGO-EMPLEADO</span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><div align="center" class="Estilo9">Cargo Actual</div></td>
                          <td colspan="2"><div align="center" class="Estilo9">Cargo Nuevo</div></td>
                        </tr>
                        <tr>
                        <?php 
						$inf_emp=explode("*",$_POST[inf_car_emp]);//ci_emp."*".inf_id."*".nuc_id."*".depa_id."*".car_id
						$nucleo=$NuevoCde->val_nuc($inf_emp[2]);
						$ext_val_nuc=$NuevoCde->ConsultarCualquiera($nucleo);
						$infrae=$NuevoCde->val_inf($inf_emp[1]);
						$ext_val_inf=$NuevoCde->ConsultarCualquiera($infrae);
						?>
                          <td width="25%" height="36"><div align="right" class="Estilo9">N&uacute;cleo:</div></td>
                          <td width="24%"><div align="left">
                          <select id="nuc_id" name="nuc_id" style="font-size:9px; width:170px;" disabled="disabled">
                            <option><?php echo $ext_val_nuc->nuc_nom;?></option>
                          </select></div></td>
                          <td width="25%"><div align="right" class="Estilo9">
                            <div align="right" class="Estilo9">N&uacute;cleo:</div>
                          </div></td>
                          <?php 
						  $nucleo=$NuevoCde->nucleo($_SESSION["ci"]);
						  ?>
                          <td width="26%"><div align="left" class="Estilo9">
                            <select id="nucleo" name="nucleo" style="font-size:9px; width:170px;" onchange="inf_infrae()" >
							  <option value="">--SELECCIONE--</option>
                            <?php
							while($ext_nucleo=$NuevoCde->ConsultarCualquiera($nucleo)){
                            ?>
					          <option value="<?php echo $ext_nucleo->nuc_id;?>" ><?php echo $ext_nucleo->nuc_nom;?></option>
					        <?php 	
							}
                            ?>
                            </select>   
                          </div></td>
                        </tr>
                        <tr>
                          <td width="25%"><div align="right" class="Estilo9">Infraestructura:</div></td>
                          <td width="24%"><div align="left">
                          <input type="hidden" id="inf_id_act" name="inf_id_act" value="<?php echo $inf_emp[1];?>">
                            <select id="inf_id" name="inf_id" style="font-size:9px; width:170px;" disabled="disabled">
                              <option><?php echo $ext_val_inf->inf_nom;?></option>
                            </select>
                          </div></td>
                          <td width="25%"><div align="right" class="Estilo9">
                            <div align="right" class="Estilo9">Infraestructura:</div>
                          </div></td>
                          <td width="26%"><div align="left">
                            <select id="infrae" name="infrae" style="font-size:9px; width:170px;" onchange="dept_emp()" disabled="disabled">
                              <option value="">--SELECCIONE--</option>
                            </select>
                          </div></td>
                        </tr>
                        <tr>
                          <td width="25%"><div align="right" class="Estilo9">Departamento:</div></td>
                          <?php $depart=$NuevoCde->val_dept();?>
                          <td width="24%"><div align="left">
                          <input type="hidden" id="depa_id_act" name="depa_id_act" value="<?php echo $inf_emp[3];?>">
                            <select id="depa_id" name="depa_id" style="font-size:9px; width:170px;" disabled="disabled">
                              <option value="">--SELECCIONE--</option>
                              <?php while($ext_depart=$NuevoCde->ConsultarCualquiera($depart)){?>
                              <option value="<?php echo $ext_depart->depa_id;?>" <?php if($ext_depart->depa_id==$inf_emp[3]) echo "selected='selected'";?>><?php echo $ext_depart->depa_nom;?></option>
                              <?php }?>
                            </select>
                          </div></td>
                          <td width="25%"><div align="right" class="Estilo9">
                            <div align="right" class="Estilo9">Departamento:</div>
                          </div></td>
                          <td width="26%"><div align="left">
                            <div align="left">
                              <select id="depart" name="depart" style="font-size:9px; width:170px;" onchange="modif_carg_dept_emp()" disabled="disabled">
                                <option value="">--SELECCIONE--</option>
                              </select>
                            </div>
                          </div></td>
                        </tr>
                        <tr>
                          <td width="25%"><div align="right" class="Estilo9">Cargo:</div></td>
                          <?php $cargo=$NuevoCde->asig_cargo($inf_emp[3]);?>
                          <td width="24%"><div align="left">
                          <input type="hidden" id="car_id_act" name="car_id_act" value="<?php echo $inf_emp[4];?>">
                              <select id="car_id" name="car_id" style="font-size:9px; width:170px;" disabled="disabled">
                                <option value="">--SELECCIONE--</option>
                                <?php while($ext_cargo=$NuevoCde->ConsultarCualquiera($cargo)){?>
                                <option value="<?php echo $ext_cargo->car_id;?>" <?php if($ext_cargo->car_id==$inf_emp[4]) echo "selected='selected'";?>><?php echo $ext_cargo->car_nom;?></option>
                                <?php }?>
                              </select>
                            </div></td>
                          <td width="25%"><div align="right" class="Estilo9">
                            <div align="right" class="Estilo9">Cargo:</div>
                          </div></td>
                          <td width="26%"><div align="left">
                            <select id="cargo_emp" name="cargo_emp" style="font-size:9px; width:170px;" disabled="disabled">
                              <option value="">--SELECCIONE--</option>
                            </select>
                          </div></td>
                        </tr>
                        <tr>
                          <td colspan="2"><div align="right" class="Estilo9">C&eacute;dula:</div></td>
                          <td colspan="2"><div align="left">
                          <input type="hidden" id="ci_emp" name="ci_emp" value="<?php echo $inf_emp[0];?>">
                          <input type="text" id="ci" name="ci" style="font-size:9px; width:170px;" value="<?php echo $inf_emp[0];?>" disabled="disabled"></div></td>
                        </tr>
                        <tr>
                          <td colspan="4"><div align="center"><input type="submit" id="guardar" name="guardar" value="Guardar" class="Boton" onclick="Modificar()">&nbsp;<input type="button" id="cancelar" name="cancelar" class="Boton" value="Cancelar" onclick="location.href='Listar.php'"></div></td>
                        </tr>
                      </table>
                          <?php
						  }
						  if($_POST[opc]==5){
						  $NuevoCde->modificar($_POST[inf_id_act],$_POST[car_id_act],$_POST[depa_id_act],$_POST[ci_emp],$_POST[infrae],$_POST[cargo_emp],$_POST[depart]);
						  }
						}
                        ?>
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
  }
  else{
  echo "<script>alert('SU SESIÓN HA SIDO CERRADA');</script>";
  echo "<script>setTimeout(\"location.href='../'\");</script>";
  }?> 
</body>
</html>