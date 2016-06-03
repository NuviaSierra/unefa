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
//**************************************************************************************
  function busc_carg(){
  document.form.opc.value=1;
  document.form.submit();
  }
//**************************************************************************************
  function hab_cedula(){
    if(document.getElementById("cargo").value!=""){
    document.getElementById("ci_emp").disabled=false
	document.getElementById("ci_emp").focus()
	}
	else{
	document.getElementById("ci_emp").disabled=true
	document.getElementById("ci_emp").value=""
	}
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
  <?php if(!isset($_POST[ci_emp])){?>
  <form action="Agregar.php" method="post" enctype="multipart/form-data" name="form">
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
                      <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bgcolor="#ffffff">
					    <tr>
					      <td width="49%" colspan="8" bgcolor="#000066"><span class="Estilo1">::  AGREGAR CARGO-EMPLEADO</span>
                          </td>
                        </tr>
                        <?php 
						$nucleo=$NuevoCde->val_nuc($_GET[nuc_id]);
						$ext_val_nuc=$NuevoCde->ConsultarCualquiera($nucleo);
						$infrae=$NuevoCde->val_inf($_GET[inf_id]);
						$ext_val_inf=$NuevoCde->ConsultarCualquiera($infrae);
						?>
                        <tr>
                          <td><div align="right" class="Estilo9">Núcleo:</div></td>
                          <td><div align="left">
                          <input type="hidden" id="infrae" name="infrae" value="<?php echo $_GET[inf_id];?>">
                            <input type="text" id="nuc_id" name="nuc_id" value="<?php echo $ext_val_nuc->nuc_nom;?>" style="font-size:9px; width:170px;" disabled="disabled">
                          </div></td>
                          <td><div align="right" class="Estilo9">Infraestructura:</div></td>
                          <td><div align="left">
                            <input type="text" id="inf_id" name="inf_id" value="<?php echo $ext_val_inf->inf_nom;?>" style="font-size:9px; width:170px;" disabled="disabled">
                          </div></td>
                        </tr>
                        <tr>
                          <td><div align="right" class="Estilo9">Departamento:</div></td>
                          <?php $depart=$NuevoCde->val_dept();?>
                          <td><div align="left">
                          <input type="hidden" id="depart" name="depart" value="<?php echo $_GET[dep];?>">
                            <select id="dep_id" name="dep_id" style="font-size:9px; width:170px;" disabled="disabled">
                              <option value="">--SELECCIONE--</option>
                              <?php while($ext_depart=$NuevoCde->ConsultarCualquiera($depart)){?>
                              <option value="<?php echo $ext_depart->depa_id;?>" <?php if($_GET[dep]==$ext_depart->depa_id) echo "selected='selected'";?>><?php echo $ext_depart->depa_nom;?></option>
                              <?php }?>
                            </select>
                          </div></td>
                          <?php if($_GET[ci_emp]==""){?>
                          <td><div align="right" class="Estilo9">Cargo:</div></td>
                          <?php $cargo=$NuevoCde->asig_cargo($_GET[dep]);?>
                          <td>
                            <div align="left">
                              <select id="car_id" name="car_id" style="font-size:9px; width:170px;" disabled="disabled">
                                <option value="">--SELECCIONE--</option>
                                <?php while($ext_cargo=$NuevoCde->ConsultarCualquiera($cargo)){?>
                                <option value="<?php echo $ext_cargo->car_id;?>" <?php if($_GET[car]==$ext_cargo->car_id) echo "selected='selected'";?>><?php echo $ext_cargo->car_nom;?></option>
                                <?php }?>
                              </select>
                              <input type="hidden" id="cargo" name="cargo" value="<?php echo $_GET[car];?>">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><div align="right" class="Estilo9">C&eacute;dula:</div></td>
                          <td colspan="2"><div align="left">
                            <input type="text" id="ci_emp" name="ci_emp" style="font-size:9px; width:170px;">
                          </div></td>
                        </tr>
                        <tr>
                          <td colspan="4"><div align="center" class="boton">
                            <input type="submit" id="agregar" name="agregar" class="Boton" value="Agregar">&nbsp;<input type="button" id="cancelar" name="cancelar" class="Boton" value="Cancelar" onclick="location.href='Listar.php'">
                          </div></td>
                        </tr>
                          <?php 
						  }
						  else{
						  ?>
						  <td><div align="right" class="Estilo9">Cargo:</div></td>
                          <?php $cargo=$NuevoCde->asig_cargo($_GET[dep]);?>
                          <td>
                            <div align="left">
                              <select id="cargo" name="cargo" style="font-size:9px; width:170px;">
                                <option value="">--SELECCIONE--</option>
                                <?php while($ext_cargo=$NuevoCde->ConsultarCualquiera($cargo)){?>
                                <option value="<?php echo $ext_cargo->car_id;?>"><?php echo $ext_cargo->car_nom;?></option>
                                <?php }?>
                              </select>
                          </div></td>
                        </tr>
                        <tr>
                          <td colspan="2"><div align="right" class="Estilo9">C&eacute;dula:</div></td>
                          <td colspan="2"><div align="left">
                            <input type="hidden" id="ci_emp" name="ci_emp" value="<?php echo $_GET["ci_emp"]?>">
                            <input type="text" id="ci" name="ci" style="font-size:9px; width:170px;" value="<?php echo $_GET["ci_emp"];?>" disabled="disabled">
                          </div></td>
                        </tr>
                        <tr>
                          <td colspan="4"><div align="center" class="boton">
                            <input type="submit" id="agregar" name="agregar" class="Boton" value="Agregar">&nbsp;<input type="button" id="cancelar" name="cancelar" class="Boton" value="Cancelar" onclick="location.href='Listar.php'">
                          </div></td>
                        </tr>
						  <?php
                          }
                          ?>
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
  }
  else{
  $NuevoCde->agregar_cde($_POST[infrae],$_POST[cargo],$_POST[depart],$_POST[ci_emp]);
  }
}
else{
echo "<script>alert('SU SESIÓN HA SIDO CERRADA');</script>";
echo "<script>setTimeout(\"location.href='../'\");</script>";
}?> 
</body>
</html>