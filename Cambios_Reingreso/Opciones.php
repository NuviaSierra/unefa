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
//************************************************************************************
function habilitar(){
opc=document.getElementById("opcion")
ci_estud=document.getElementById("ci_estud")
  if(opc.value!=""){
  ci_estud.disabled=false
  ci_estud.focus()
  }
  else{
  ci_estud.disabled=true
  ci_estud.value=""
  }
}
//***************************************************************************************
function validar(){
opc=document.getElementById("opcion")
ci_estud=document.getElementById("ci_estud")
  if(opc.value=="" || ci_estud.value==""){
  opc.value=""
  ci_estud.disabled=true
  ci_estud.value=""
  return false
  }
}
//***************************************************************************************
</script>
</head>
<!-- link calendar files  -->
	<script language="JavaScript" src="../Funciones/calendario/calendar_us.js"></script>
	<link rel="stylesheet" href="../Funciones/calendario/calendar.css">
<script src='../Funciones/funcion.validar.js'></script>
<?php
  require("../Clases/class.conexion.php");
  include("../Funciones/cascadas.css");
  include("../Funciones/funciones.php");
  include("../Clases/class.menus.php");
  $NuevoMenu = new menus("","","","","");
  $NuevoMenu->conec_BD();
  $NuevoMenu->conectar_BD();
  include ("../Clases/class.plantilla.php");
  $Plantilla = new plantilla("","","");
/*  echo "<script>alert('Cedula $ci_est');</script>";*/
   if($_SESSION['ci']!=""){?>
<body bgcolor="#a9c3e8" leftmargin="0" rightmargin="0" topmargin="0">
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
					    <tr>
					      <td colspan="3" bgcolor="#000066"><span class="Estilo1">:: CAMBIOS SOLICITADOS DEL ESTUDIANTE</span></td></tr>
					    <tr>
						  <td width="50%" colspan="2" class="Estilo9"><div align="right">Cambios a Realizar:</div></td>
						  <td><div align="left"><select id="opcion" name="opcion" onchange="habilitar()" style="font-size:9px; width:170px;">
                            <option value="" <?php if(!isset($_GET["opcion"])) echo "selected='selected'";?>>-SELECCIONE-</option>
                            <option value="camb_car" <?php if(isset($_GET["opcion"]) and $_GET["opcion"]=="camb_car") echo "selected='selected'";?>>CAMBIO DE CARRERA</option>
                            <option value="camb_esp" <?php if(isset($_GET["opcion"]) and $_GET["opcion"]=="camb_esp") echo "selected='selected'"; ?>>CAMBIO DE ESPECIALIDAD</option>
                            <option value="camb_reg" <?php if(isset($_GET["opcion"]) and $_GET["opcion"]=="camb_reg") echo "selected='selected'"; ?>>CAMBIO DE RÉGIMEN</option>
                            <option value="const" <?php if(isset($_GET["opcion"]) and $_GET["opcion"]=="const") echo "selected='selected'"; ?>>CONSTANCIA DE EQUIVALENCIAS</option>
                            <option value="equiv_est" <?php if(isset($_GET["opcion"]) and $_GET["opcion"]=="equiv_est") echo "selected='selected'"; ?>>EQUIVALENCIAS DEL ESTUDIANTE</option>
                            <option value="rein_est" <?php if(isset($_GET["opcion"]) and $_GET["opcion"]=="rein_est") echo "selected='selected'"; ?>>REINGRESO</option>
                          </select></div></td>
						</tr>
					    <tr>
						  <td colspan="2" class="Estilo9"><div align="right">C&eacute;dula del Estudiante:</div></td>
						  <td><div align="left">
					      <input type="text" id="ci_estud" name="ci_estud" style="font-size:9px; width:170px;" <?php if(!isset($_GET["opcion"])) echo "disabled='disabled'";?>>
						  </div>						    <div align="left"></div></td>
						  <?php if(isset($_GET["opcion"])) echo "<script>document.getElementById('ci_estud').focus()</script>";?>
					    </tr>
                        <tr>
					      <td bgcolor="#FFFFFF" colspan="3" height="25">
						    <input name="Aceptar" type="submit" class="Boton" value="Aceptar" onclick="return validar()">
						    <input name="Cancelar" type="button" class="Boton" value="Cancelar" onClick="location.href='../Menu/menu_princ.php'">
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
  echo "<script>alert('SU SESIÓN HA SIDO CERRADA');</script>";
  echo "<script>setTimeout(\"location.href='../'\");</script>";
  }
  ?>
</body>
</html>