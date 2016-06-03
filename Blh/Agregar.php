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
  include("../Clases/class.blh.php");
  $NuevoBlh = new blh("","","","");
  $NuevoBlh->conec_BD();
  $NuevoBlh->conectar_BD();
  include ("../Clases/class.plantilla.php");
  $Plantilla = new plantilla("","","");?>
<body bgcolor="#a9c3e8">
  <?php
/*    echo "<script>alert('ENTRE A AGREGAR');</script>";*/
  if(!isset($_POST[h_ini])){
      /*echo "<script>alert('ENTRE a los datos);</script>";*/?>
  <form action="Agregar.php" method="post" enctype="multipart/form-data" name="form">
      <table width="100%" height="100%" border="0" align="center" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="1" width="10%">&nbsp;</td>
        <td colspan="1" width="80%">
          <table width="750px" height="25px" border="0" align="center" cellspacing="0" cellpadding="0">
<?php
  $menu_princ=$NuevoMenu->menu_principal('4204');//($_GET[ayu]);
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
			    <table style="width: 750px; text-align: center; margin-left: auto; margin-right: auto; margin-center: auto;" border="0" cellpadding="0" cellspacing="0" align="center">
				  <tr><td height="5">&nbsp;</td></tr>
				  <tr><td height="5">&nbsp;</td></tr>
				  <tr>
					<td width="100%">
					  <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bgcolor="#ffffff">
					    <tr><td colspan="2" bgcolor="#000066"><span class="Estilo1">:: AGREGAR BLOQUE DE HORAS</span></td></tr>
						<tr>
						  <td bgcolor="#FFFFFF" width="45%"><div align="right" class="Estilo9">Hora de Inicio:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left" class="Estilo9">
							<select id="h_ini" name="h_ini">
							<option value="">hh</option>
							<?php 
							$i=0;
							for($i=0;$i<24;$i++){?>
							  <option value="<?php if($i<10) echo "0".$i; else echo "".$i;?>"><?php if($i<10) echo "0".$i; else echo "".$i;?></option>
							<?php }?>
							</select>
							<select id="m_ini" name="m_ini">
							<option value="">mm</option>
							<?php 
							$i=0;
							for($i=0;$i<60;$i+=5){?>
							  <option value="<?php if($i<10) echo "0".$i; else echo "".$i;?>"><?php if($i<10) echo "0".$i; else echo "".$i;?></option>
							<?php }?>
							</select>
							<img src="../Imagenes/Obligatorio.png" width="9" height="8">
						  </div></td>
						</tr>
						<tr>
						  <td bgcolor="#FFFFFF" width="45%"><div align="right" class="Estilo9">Hora de Fin:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left" class="Estilo9">
							<select id="h_fin" name="h_fin">
							<option value="">hh</option>
							<?php 
							$i=0;
							for($i=0;$i<24;$i++){?>
							  <option value="<?php if($i<10) echo "0".$i; else echo "".$i;?>"><?php if($i<10) echo "0".$i; else echo "".$i;?></option>
							<?php }?>
							</select>
							<select id="m_fin" name="m_fin">
							<option value="">mm</option>
							<?php 
							$i=0;
							for($i=0;$i<60;$i+=5){?>
							  <option value="<?php if($i<10) echo "0".$i; else echo "".$i;?>"><?php if($i<10) echo "0".$i; else echo "".$i;?></option>
							<?php }?>
							</select>
							<img src="../Imagenes/Obligatorio.png" width="9" height="8">
						  </div></td>
						</tr>
					    <tr>
						  <td bgcolor="#FFFFFF" colspan="2" width="100%" height="25px">
							<input name="Aceptar" type="submit" class="Boton" value="Aceptar">
							<input name="Cancelar" type="button" class="Boton" value="Cancelar" onClick="Navegar('../Configuracion/Blh.php?viene=Listar&accion=Agregar')">
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
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
    $agre=0;
    if($_POST[h_ini]!="" && $_POST[m_ini]!="" && $_POST[h_fin]!="" && $_POST[m_fin]!="" ){
	  $ini=$_POST[h_ini].":".$_POST[m_ini].":00";
	  $fin=$_POST[h_fin].":".$_POST[m_fin].":00";
	  $NuevoBlh->Asignar_valores("",$ini,$fin,"1");
	  if($NuevoBlh->Buscar_Blh_Ini_Fin()==0)
      {
	    if($NuevoBlh->Buscar_Blh_Ini_Fin1()==0){
  	      if($ultimo=$NuevoBlh->Agregar_blh()>0){
		    $agre=1;
		  }
		}
		else{
	      $array=$NuevoBlh->Consultar();
		  $ultimo=$array->blh_id;
/*		  echo "<script>alert('CODIGO $ultimo');</script>";*/
		  if($NuevoBlh->Agregar_blh1($ultimo)>0){
		    $agre=1;
		  }
		}
		if($agre==1){
		   echo "<script>alert('SE HA AGREGADO EL BLOQUE DE HORA SATISFACTORIAMENTE');</script>";	
			$accion='INSERTAR';
		    $Operacion="AGREGAR EL BLOQUE DE HORA CON ID: ".$ultimo.", HORA DE INICIO: ".$ini." Y HORA DE FIN: ".$fin."";	
		    $NuevoBlh->guardar_accion($accion,"blo_hor",$Operacion);
		}
		else{
		  echo "<script>alert('LO SIENTO EL BLOQUE DE HORA NO SE HA PODIDO AGREGAR');</script>";
		}		  
	  }
	  else
	    echo "<script>alert('LO SIENTO EL BLOQUE DE HORA YA HA SIDO INGRESADO');</script>";	  
	}
	else{
	  echo "<script>alert('LO SIENTO EXISTEN CAMPOS VACIOS QUE SON OBLIGATORIOS');</script>";
	}
	if($agre==0)
      echo "<script>setTimeout(\"location.href='../Blh/Agregar.php?ayu=".$_POST[ayu]."'\");</script>";
	else
      echo "<script>setTimeout(\"location.href='../Configuracion/Blh.php?ayu=".$_POST[ayu]."&viene=Listar'\");</script>";	  
	  
  }?>
</body>
</html>