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
  $Plantilla = new plantilla("","","");?>
<body bgcolor="#a9c3e8" leftmargin="0" rightmargin="0" topmargin="0">
  <?php
  if(isset($_GET[usu])){
  ?>
  <form action="Eliminar.php" method="post" enctype="multipart/form-data" name="form">
    <input name="ayu" id="ayu" type="hidden" value="<?php echo "".$_GET[ayu]; ?>">
    <input name="id" id="id" type="hidden" value="<?php echo "".$_GET[usu]; ?>">
      <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="1" width="10%">&nbsp;</td>
        <td colspan="1" width="80%">
          <table width="862px" height="25px" border="0" align="center" cellspacing="0" cellpadding="0">
<?php
  $menu_princ=$NuevoMenu->menu_principal('4202');//($_GET[ayu]);
  echo $menu_princ;
/*      echo "<script>alert('id: $_GET[usu]');</script>";*/
    $NuevoAul->Buscar_aula($_GET[usu]);
	$array=$NuevoAul->Consultar();?>
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
  						<tr><td colspan="2" bgcolor="#000066"><span class="Estilo1">:: ELIMINAR AULA</span></td></tr>
						<tbody id="CUERPOTAB">
						<input name="id" id="id" type="hidden" value="<?php echo "".$_GET[usu]; ?>">
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
						    <td bgcolor="#FFFFFF" width="50%"><div align="right" class="Estilo9">Seguro que desea eliminar este Registro???</div></td>
						    <td bgcolor="#FFFFFF" width="50%"><div align="left" class="Estilo9">
							  <font color="#666666" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><label><input name="accion" type="radio" value="S">SI</label></strong></font>&nbsp;
                              <font color="#666666" size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong><input type="radio" name="accion" value="N" checked>NO</strong></font>&nbsp;
							</td>
						  </tr>
						  <tr>
						    <td bgcolor="#FFFFFF" colspan="2" width="100%" height="25px">
							  <input name="Aceptar" type="submit" class="Boton" value="Aceptar">
							</td>
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
  <?php
  }
  else{
	$error=0;
    if($_POST[accion]!="N"){
	  $NuevoAul->Asignar_valores($_POST[id],$_POST[infrae],$_POST[nombre],$_POST[ubic],"0");
      if($NuevoAul->Eliminar_aula()>0){
		echo "<script>alert('SE HA ELIMINADO EL AULA SATISFACTORIAMENTE');</script>";
			$accion='ELIMINAR';
		    $Operacion="ELIMINAR EL AULA CON ID: ".$_POST[id]." Y EL NOMBRE: ".$_POST[nombre]."";	
		    $NuevoAul->guardar_accion($accion,"aulas",$Operacion);
	  }
	  else{
		echo "<script>alert('LO SIENTO EL AULA NO SE HA PODIDO ELIMINAR');</script>";
		$error=1;
	  }
	}
	if($error==1)
      echo "<script>setTimeout(\"location.href='../Aulas/Eliminar.php?ayu=".$_POST[ayu]."&usu=".$_POST[id]."'\");</script>";
	else
      echo "<script>setTimeout(\"location.href='../Configuracion/Aula.php?ayu=".$_POST[ayu]."&viene=Listar'\");</script>";	
  }?>
</body>
</html>