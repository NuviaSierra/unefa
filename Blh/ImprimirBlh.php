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
     pagina= "Reportes/ImprimirBlh.php?usu="+document.form.id.value;
     var ventana = self;
     ventana.opener = self;
     ventaH = screen.height;
     ventaW = screen.width;
     window.open(pagina, "" , "fullscreen=0 ,toolbar=0 ,location=0 , status=0 , menubar=0 , scrollbars=1 , resizable=0, width= "+ventaW+", height="+ventaH+", false");
 }
//*****************************************************************************************
 function redireccionar()
 {
   document.location.href='Listar.php?ayu='+document.form.ayu.value;
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
  include("../Clases/class.blh.php");
  $NuevoBlh = new blh("","","","");
  $NuevoBlh->conec_BD();
  $NuevoBlh->conectar_BD();
  include ("../Clases/class.plantilla.php");
  $Plantilla = new plantilla("","","");
  $per_id=$_SESSION[idper];
/*  echo "<script>alert('SELECT * FROM tab_ope WHERE per_id=$per_id AND tab_ope_sta=1 AND tab_id=54 AND ope_id=7');</script>";*/
  $res=$NuevoBlh->OperacionCualquiera("SELECT * FROM tab_ope WHERE per_id='$per_id' AND tab_ope_sta='1' AND tab_id='65' AND ope_id='7'");
  $fila=$NuevoBlh->NumFilasCualquiera($res);?>
<body bgcolor="#a9c3e8" leftmargin="0" rightmargin="0" topmargin="0">
  <form action="" method="post" enctype="multipart/form-data" name="form" id="form">
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
						<tr><td colspan="2" bgcolor="#000066"><span class="Estilo1">:: CONSULTAR BLOQUE DE HORA</span></td></tr>
	  <?php
    $NuevoBlh->Buscar_blh($_GET[usu]);
	$array=$NuevoBlh->Consultar(); 
			$accion='CONSULTAR';
		    $Operacion="CONSULTAR EL BLOQUE DE HORA CON ID: ".$_GET[usu].", HORA DE INICIO: ".$array->blh_ini." Y HORA DE FIN: ".$array->blh_fin."";
		    $NuevoBlh->guardar_accion($accion,"dias",$Operacion);?>
	  						<input name="id" id="id" type="hidden" value="<?php echo "".$_GET[usu]; ?>">
						<tr>
						  <td bgcolor="#FFFFFF" width="45%"><div align="right" class="Estilo9">Hora de Inicio:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left" class="Estilo9"><?php echo "".$array->blh_ini;?></div></td>
						</tr>
						<tr>
						  <td bgcolor="#FFFFFF" width="45%"><div align="right" class="Estilo9">Hora de Fin:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left" class="Estilo9"><?php echo "".$array->blh_fin;?></div></td>
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
		  <input name="Aceptar" type="button" class="Boton" value="Aceptar" onClick="Navegar('../Configuracion/Blh.php?viene=Listar')">
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