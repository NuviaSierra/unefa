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
</script>
<script>
 function imprimir(){
// alert "hola "+document.form.id.value;
     pagina= "Reportes/ImprimirAul.php?usu="+document.getElementById("id").value;
     var ventana = self;
     ventana.opener = self;
     ventaH = screen.height;
     ventaW = screen.width;
     window.open(pagina, "" , "fullscreen=0 ,toolbar=0 ,location=0 , status=0 , menubar=0 , scrollbars=1 , resizable=0, width= "+ventaW+", height="+ventaH+", false");
 }
//*****************************************************************************************
 function redireccionar()
 {
   document.location.href='Listar.php?ayu='+document.getElementById("ayu").value;
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
  include("../Clases/class.aula.php");
  $NuevoAul = new aula("","","","","");
  $NuevoAul->conec_BD();
  $NuevoAul->conectar_BD();
  include ("../Clases/class.plantilla.php");
  $Plantilla = new plantilla("","","");
  $per_id=$_SESSION[idper];
/*  echo "<script>alert('SELECT * FROM tab_ope WHERE per_id=$per_id AND tab_ope_sta=1 AND tab_id=54 AND ope_id=7');</script>";*/
  $res=$NuevoAul->OperacionCualquiera("SELECT * FROM tab_ope WHERE per_id='$per_id' AND tab_ope_sta='1' AND tab_id='70' AND ope_id='7'");
  $fila=$NuevoAul->NumFilasCualquiera($res);?>
<body bgcolor="#a9c3e8" leftmargin="0" rightmargin="0" topmargin="0">
  <form action="ImprimirAula.php" method="post" enctype="multipart/form-data" name="form" id="form">
      <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="1" width="10%">&nbsp;</td>
        <td colspan="1" width="80%">
          <table width="862px" height="25px" border="0" align="center" cellspacing="0" cellpadding="0">
<?php
  $menu_princ=$NuevoMenu->menu_principal('4203');//($_GET[ayu]);
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
                <table style="width: 850px; text-align: center; margin-left: auto; margin-right: auto; margin-center: auto;" border="0" cellpadding="0" cellspacing="0" align="center">
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr><td height="5">&nbsp;</td></tr>
                  <tr>
                    <td width="100%">
					  <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bordercolor="#777A4B" bgcolor="#ffffff">
						<tr><td colspan="2" bgcolor="#000066"><span class="Estilo1">:: CONSULTAR AULA</span></td></tr>
	  <?php
    $NuevoAul->Buscar_aula($_GET[usu]);
	$array=$NuevoAul->Consultar();
			$accion='CONSULTAR';
		    $Operacion="CONSULTAR EL AULA CON ID: ".$array->aul_id." Y EL NOMBRE: ".$array->aul_nom."";
		    $NuevoAul->guardar_accion($accion,"aulas",$Operacion);?>
	  						<input name="id" id="id" type="hidden" value="<?php echo "".$array->aul_id; ?>">
						  <tr>						
					      <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Nucleo:</div></td>
					      <td bgcolor="#FFFFFF"><div align="left" class="Estilo2">
					        <select id="nucleo" name="nucleo" disabled="disabled">
					          <option value="">--SELECCIONE--</option>
						      <?php
					            $resp=$NuevoAul->Listado_Nucleo();
						        while($array2=$NuevoAul->ConsultarCualquiera($resp)){?>
					          <option value="<?php echo "".$array2->nuc_id;?>" <?php if($array2->nuc_id==$array->nuc_id) echo "selected";?>><?php echo "".$array2->nuc_nom;?></option>
						      <?php }?>
					        </select>
						  </div></td>
						</tr>
						<tr>
						  <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Infraestructura:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left" class="Estilo2">
						    <select id="infrae" name="infrae" disabled="disabled">
						      <option value="">--SELECCIONE--</option>
							  <?php
								$resp=$NuevoAul->Listado_Infrae($array->nuc_id);
							    while($array2=$NuevoAul->ConsultarCualquiera($resp)){?>
						      <option value="<?php echo "".$array2->inf_id;?>" <?php if($array2->inf_id==$array->inf_id) echo "selected";?>><?php echo "".$array2->inf_nom;?></option>
							  <?php
							  }?>
						    </select>
						  </div></td>
						</tr>
						<tr>
						  <td bgcolor="#FFFFFF" width="45%"><div align="right" class="Estilo9">Nombre del Aula:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left" class="Estilo9">
							<input name="nombre" id="nombre" type="text" size="30" maxlength="35" onBlur="validarTextoNumGui(this)" value="<?php echo "".$array->aul_nom;?>" disabled="disabled">
						  </div></td>
						</tr>
						<tr>
						  <td bgcolor="#FFFFFF" width="50%"><div align="right" class="Estilo9">Ubicaci&oacute;n del Aula:</div></td>
						  <td bgcolor="#FFFFFF" width="50%"><div align="left" class="Estilo9"><textarea name="ubic" id="ubic" onBlur="validarTextoNum(this)" cols="23" disabled="disabled"><?php echo "".$array->aul_ubi;?></textarea></div></td>
						</tr>
						<tr>
<?php if($fila>'0'){?>
		<td bgcolor="#FFFFFF" width="50%"><div align="right" class="Estilo9">Desea imprimir en pdf este registro???</div></td>
		<td bgcolor="#FFFFFF" width="50%"><div align="left" class="Estilo9">
		  <font color="#666666" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><label><input name="accion" id="accion" type="radio" value="S" onClick="imprimir()">SI</label>&nbsp;
		  <label><input type="radio" name="accion" id="accion" value="N" onClick="redireccionar()">NO</label></strong></font>
		</td>
<?php } else{?>
		<td bgcolor="#FFFFFF" colspan="2" width="100%" height="25px">
		  <input name="Aceptar" type="button" class="Boton" value="Aceptar" onClick="Navegar('../Configuracion/Aula.php?viene=Listar')">
		</td>
<?php }?>
						  </tr>
						</tbody>
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
</html>