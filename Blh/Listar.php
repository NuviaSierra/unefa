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
</script>
<script>
 function imprimir(){
     pagina= "../Blh/Reportes/ImprimirListado.php";
     var ventana = self;
     ventana.opener = self;
     ventaH = screen.height;
     ventaW = screen.width;
     window.open(pagina, "" , "fullscreen=0 ,toolbar=0 ,location=0 , status=0 , menubar=0 , scrollbars=1 , resizable=0, width= "+ventaW+", height="+ventaH+", false");
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
    $bandAgr=0;
    $bandCon=0;
    $bandMod=0;
    $bandEli=0;
    $bandLis=0;
    $bandImp=0;
    $bandDes=0;
	$columna=2;//2
	$idper=$_SESSION[idper];
	$ci=$_SESSION[ci];
    $res=$NuevoBlh->OperacionCualquiera("SELECT * FROM tab_ope WHERE per_id='$idper' AND tab_ope_sta='1' AND tab_id IN ('65')");
	while($array=$NuevoBlh->ConsultarCualquiera($res)){
	  if($array->ope_id=='1'){ $bandAgr=1;}
	  if($array->ope_id=='2'){ $bandCon=1; $columna++;}
	  if($array->ope_id=='3'){ $bandMod=1; $columna++;}
	  if($array->ope_id=='4'){ $bandEli=1; $columna++;}
	  if($array->ope_id=='5'){ $bandLis=1; $columna++;}
	  if($array->ope_id=='6'){ $bandImp=1;}
	  if($array->ope_id=='7'){ $bandDes=1;}
	}?>
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
                        <tr><td colspan="<?php echo $columna;?>" bgcolor="#000066"><span class="Estilo1">:: LISTADO DE BLOQUE DE HORAS</span></td></tr>
  <?php
  if(!isset($_GET[pg]))
    $pg = 0; // $pg es la pagina actual
  else
    $pg=$_GET[pg];
  $siguiente=$pg+1;
  $atras=$pg-1;
  $cantidad=10; // cantidad de resultados por pagina
  $inicial = $pg * $cantidad;
  $total=$NuevoBlh->Mysql_num_rows($NuevoBlh->select_tabla_where("blo_hor","blh_sta","1"));
  $NuevoBlh->Listado_blh($inicial,$cantidad);
  if($total>($inicial+$cantidad))
    $pages = intval($total / $cantidad) + 1;// Imprimiendo los resultados
  else{
	$pages=intval($total / $cantidad) + 1;
	if($pages!=0)
	  $pages=$pages-1;
  }?>
                        <tr>
                          <td bgcolor="#FFFFFF" width="50%"><div align="center" class="Estilo9">Hora de Inicio</div></td>
                          <td bgcolor="#FFFFFF" width="50%"><div align="center" class="Estilo9">Hora de Fin</div></td>
  <?php if($bandMod==1){?>
                          <td bgcolor="#FFFFFF" width="20%"><div align="center" class="Estilo9">Modificar Datos</div></td>
  <?php } if($bandEli==1){?>
   						  <td bgcolor="#FFFFFF" width="15%"><div align="center" class="Estilo9">Eliminar</div></td>
  <?php } if($bandCon==1){?>
						  <td bgcolor="#FFFFFF" width="15%"><div align="center" class="Estilo9">Consultar</div></td>
  <?php } ?> 
                        </tr>
  <?php 
  while($array=$NuevoBlh->Consultar()){?>
                        <tr>
						  <td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$array->blh_ini;?></div></td>
						  <td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$array->blh_fin;?></div></td>
  <?php if($bandMod==1){?>
						  <td bgcolor="#FFFFFF" width="15%"><div align="center"><img src="../Imagenes/folder-setup.gif" width="30" height="30" style="cursor:pointer;" onClick="Opciones_SubMen('../Configuracion/Blh.php','Modificar','3','<?php echo "".$array->blh_id;?>')"/></div></td>
  <?php } if($bandEli==1){?>
						  <td bgcolor="#FFFFFF" width="15%"><div align="center"><img src="../Imagenes/Recycle Bin Full_ico_4.gif" width="32" height="32" style="cursor:pointer;" onClick="Opciones_SubMen('../Configuracion/Blh.php','Eliminar','3','<?php echo "".$array->blh_id;?>')"/></div></td>
  <?php } if($bandCon==1){?>
						  <td bgcolor="#FFFFFF" width="15%"><div align="center"><img src="../Imagenes/XP2_12.gif" width="31" height="30" style="cursor:pointer;" onClick="Opciones_SubMen('../Configuracion/Blh.php','ImprimirBlh','3','<?php echo "".$array->blh_id;?>')"/></div></td>
    <?php } if($bandOpe==1){?>
						  <td bgcolor="#FFFFFF" width="5%"><div align="center"><img src="../Imagenes/icon_win98_3.gif" width="28" height="28" style="cursor:pointer;" onClick="Opciones_SubMen('../Configuracion/Blh.php','Operacion','3','<?php echo "".$array->blh_id;?>')"/></div></td>
  <?php } ?>
						</tr>
  <?php } ?>
						<tr nowrap=off align="center">
						  <td bgcolor="#FFFFFF" colspan="<?php echo $columna;?>" width="100%" height="25px" align="center">
  <?php
  echo ("<p align=\"right\"><font face=Arial size=2 color=0000FF><b>Cantidad de Bloque de Horas $total </b></font></p><hr  width=\"50%\" align=\"center\" size=\"0\">");
  if($pg <> 0){
    $url = $pg - 1;
    echo "<a href='../Configuracion/Blh.php?viene=Listar&pg=".$url."'>Anterior</a>&nbsp;";
  }
  else
    echo " ";
  if($pages==0)
    echo"<font face=Arial size=2 color=001111><b>&nbsp;P&aacute;gina&nbsp;</b></font>";
  else
    echo"<font face=Arial size=2 color=001111><b>&nbsp;P&aacute;ginas&nbsp;</b></font>";
  if($pg==0 && $pages!=0){
    for($i = 0; $i<$pages; $i++){
	  $ppage=$i+1;
      if($i == $pg)
	    echo "<font face=Arial size=2 color=0000FF><b>&nbsp;$ppage&nbsp;</b></font>";
      else
	    echo "&nbsp;<a href='../Configuracion/Blh.php?viene=Listar&pg=".$i."'>".$ppage."</a>&nbsp;";
    }
  }
  else{
    for($i = 0; $i<($pages+1); $i++){
	  $ppage=$i+1;
	  if($i == $pg)
	    echo "<font face=Arial size=2 color=0000FF><b>&nbsp;$ppage&nbsp;</b></font>";
      else
	    echo "&nbsp;<a href='../Configuracion/Blh.php?viene=Listar&pg=".$i."'>".$ppage."</a>&nbsp;";
    }
  }
  if($pg < $pages){
    $url = $pg + 1;
    echo "&nbsp;<a href='../Configuracion/Blh.php?viene=Listar&pg=".$url."'>Siguiente</a>";
  }
  else
    echo " ";
  echo "</hr>";
  ?>
						  </td>
						</tr>
						<tr>
						  <td bgcolor="#FFFFFF" colspan="<?php echo $columna;?>" width="100%" height="25px">
  <?php if($bandAgr==1){?>
						    <input name="Agregar" type="submit" class="Boton" value="Agregar Bloque de Hora" onClick="Opciones_SubMen('../Configuracion/Blh.php','Agregar','3','')">
  <?php } if($bandDes==1){?>
							<input name="Imprimir" type="submit" class="Boton" value="Imprimir Lista" onClick="imprimir()">
  <?php } ?> 
							<input name="Volver" type="button" class="Boton" value="Volver" onClick="Navegar('../Menu/menu_princ.php')">
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
</html>
