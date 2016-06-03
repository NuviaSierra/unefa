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
function Sel_Infrae(nom){
//  alert("----"+nom+"-----");
  valor=nom.value;
  comb=document.getElementById("infrae");
  for(i=comb.length;i>-1;i--)
	comb.options[i]=null
//  alert("-"+valor+"-");
  if(valor!=""){
    var http=new getHTTPObject()
	tipo="ListadoInfrae";
    enviar="valor="+valor+"&Operacion="+tipo+"&tim="+new Date().getTime()
    Dir="../Aulas/Prueba.php"+"?"+enviar
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
</script>
<script>
 function imprimir(){
   nucleo=document.getElementById("nucleo").value;
   infrae=document.getElementById("infrae").value;
     pagina= "../Aulas/Reportes/ImprimirListado.php?nucleo="+nucleo+"&infrae="+infrae+"";
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
  include("../Clases/class.aula.php");
  $NuevoAul = new aula("","","","","");
  $NuevoAul->conec_BD();
  $NuevoAul->conectar_BD();
  include ("../Clases/class.plantilla.php");
  $Plantilla = new plantilla("","","");  
    $bandAgr=0;
    $bandCon=0;
    $bandMod=0;
    $bandEli=0;
    $bandLis=0;
    $bandImp=0;
    $bandDes=0;
	$columna=3;//2
  if($_POST[nucleo]!="" || $_POST[nucleo]!="unsigned"){
    $nucleo=$_GET[nucleo]=$_POST[nucleo];
    $infrae=$_GET[infrae]=$_POST[infrae];
/*	echo "<script>alert('NUCLEO: $nucleo, INFRAE: $infrae');</script>";*/
  }
  else{    
    if($_GET[usu]==''){
      $nucleo=$_GET[nucleo]="";
      $infrae=$_GET[infrae]="";
	}
	else{
	  $nucleo=$clave[1];
      $infrae=$clave[0];
	}
  }
  $id=$infrae."*".$nucleo;
	$idper=$_SESSION[idper];
	$ci=$_SESSION[ci];
    $res=$NuevoAul->OperacionCualquiera("SELECT * FROM tab_ope WHERE per_id='$idper' AND tab_ope_sta='1' AND tab_id IN ('70')");
	while($array=$NuevoAul->ConsultarCualquiera($res)){
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
			<input name="ayu" id="ayu" type="hidden" value="<?php echo "".$_GET[ayu];?>">
			<input name="id" id="id" type="hidden" value="<?php echo "".$id;?>">
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
                        <tr><td colspan="<?php echo $columna;?>" bgcolor="#000066"><span class="Estilo1">:: LISTADO DE AULAS</span></td></tr>
						<tr><td colspan="<?php echo $columna;?>">
						  <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;">
  						    <tr>						
						      <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Nucleo:</div></td>
						      <td bgcolor="#FFFFFF"><div align="left" class="Estilo2">
						        <select id="nucleo" name="nucleo" onChange="Sel_Infrae(this);">
						          <option value="">--TODOS--</option>
							      <?php
						            $resp=$NuevoAul->Listado_Nucleo();
							        while($array=$NuevoAul->ConsultarCualquiera($resp)){?>
						          <option value="<?php echo "".$array->nuc_id;?>" <?php if($nucleo==$array->nuc_id) echo "selected";?>><?php echo "".$array->nuc_nom;?></option>
							      <?php }?>
						        </select>
							  </div></td>
						      <td bgcolor="#FFFFFF"><div align="right" class="Estilo9">Infraestructura:</div></td>
						      <td bgcolor="#FFFFFF"><div align="left" class="Estilo2">
						        <select id="infrae" name="infrae" <?php if($nucleo=="") echo "disabled";?>>
						          <option value="">--TODAS--</option>
								  <?php if($nucleo!=""){
								  $resp=$NuevoAul->Listado_Infrae($nucleo);
							      while($array=$NuevoAul->ConsultarCualquiera($resp)){?>
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
  if(!isset($_GET[pg]))
    $pg = 0; // $pg es la pagina actual
  else
    $pg=$_GET[pg];
  $siguiente=$pg+1;
  $atras=$pg-1;
  $cantidad=10; // cantidad de resultados por pagina
  $inicial = $pg * $cantidad;
  if(!isset($_GET[nucleo]) || ($_GET[nucleo]=='' && $_GET[infrae]=='')){
    $nucleo=0;
	$infrae=0;
    $total=$NuevoAul->Contar_aula_Todas();
    $NuevoAul->Listado_aula_Todas($inicial,$cantidad);
  }
  else{  
    if($_GET[infrae]=='' && $_GET[nucleo]!=''){
	  $total=$NuevoAul->Contar_aula_Nucleo_Todas($_GET[nucleo]);
      $NuevoAul->Listado_aula_Nucleo_Todas($_GET[nucleo],$inicial,$cantidad);
	}
	else{
      $total=$NuevoAul->Contar_aula_Nucleo_Infrae($_GET[nucleo],$_GET[infrae]);
      $NuevoAul->Listado_aula_Nucleo_Infrae($_GET[nucleo],$_GET[infrae],$inicial,$cantidad);
	}
  }
  if($total>($inicial+$cantidad))
    $pages = intval($total / $cantidad) + 1;// Imprimiendo los resultados
  else{
	$pages=intval($total / $cantidad) + 1;
	if($pages!=0)
	  $pages=$pages-1;
  }?>
                        <tr>
                          <td bgcolor="#FFFFFF" width="50%"><div align="center" class="Estilo9">Nucleo</div></td>
                          <td bgcolor="#FFFFFF" width="50%"><div align="center" class="Estilo9">Infraestructura</div></td>
                          <td bgcolor="#FFFFFF" width="50%"><div align="center" class="Estilo9">Aula</div></td>
  <?php if($bandMod==1){?>
                          <td bgcolor="#FFFFFF" width="20%"><div align="center" class="Estilo9">Modificar Datos</div></td>
  <?php } if($bandEli==1){?>
   						  <td bgcolor="#FFFFFF" width="15%"><div align="center" class="Estilo9">Eliminar</div></td>
  <?php } if($bandCon==1){?>
						  <td bgcolor="#FFFFFF" width="15%"><div align="center" class="Estilo9">Consultar</div></td>
  <?php } ?> 
                        </tr>
  <?php 
  while($array=$NuevoAul->Consultar()){?>
                        <tr>
						  <td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$array->nuc_nom;?></div></td>
						  <td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$array->inf_nom;?></div></td>
						  <td bgcolor="#FFFFFF" width="20%"><div align="left" class="Estilo2"><?php echo "".$array->aul_nom;?></div></td>
  <?php if($bandMod==1){?>
						  <td bgcolor="#FFFFFF" width="15%"><div align="center"><img src="../Imagenes/folder-setup.gif" width="30" height="30" style="cursor:pointer;" onClick="Opciones_SubMen('../Configuracion/Aula.php','Modificar','3','<?php echo "".$array->aul_id;?>')"/></div></td>
  <?php } if($bandEli==1){?>
						  <td bgcolor="#FFFFFF" width="15%"><div align="center"><img src="../Imagenes/Recycle Bin Full_ico_4.gif" width="32" height="32" style="cursor:pointer;" onClick="Opciones_SubMen('../Configuracion/Aula.php','Eliminar','3','<?php echo "".$array->aul_id;?>')"/></div></td>
  <?php } if($bandCon==1){?>
						  <td bgcolor="#FFFFFF" width="15%"><div align="center"><img src="../Imagenes/XP2_12.gif" width="31" height="30" style="cursor:pointer;" onClick="Opciones_SubMen('../Configuracion/Aula.php','ImprimirAula','3','<?php echo "".$array->aul_id;?>')"/></div></td>
    <?php } if($bandOpe==1){?>
						  <td bgcolor="#FFFFFF" width="5%"><div align="center"><img src="../Imagenes/icon_win98_3.gif" width="28" height="28" style="cursor:pointer;" onClick="Opciones_SubMen('../Configuracion/Aula.php','Operacion','3','<?php echo "".$array->aul_id;?>')"/></div></td>
  <?php } ?>
						</tr>
  <?php } ?>
						<tr nowrap=off align="center">
						  <td bgcolor="#FFFFFF" colspan="<?php echo $columna;?>" width="100%" height="25px" align="center">
  <?php
  echo ("<p align=\"right\"><font face=Arial size=2 color=0000FF><b>Cantidad de Aulas $total </b></font></p><hr  width=\"50%\" align=\"center\" size=\"0\">");
  if($pg <> 0){
    $url = $pg - 1;
    echo "<a href='../Configuracion/Aula.php?viene=Listar&pg=".$url."&nucleo=".$nuc."&infrae=".$infrae."&usu=".$id."'>Anterior</a>&nbsp;";
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
	    echo "&nbsp;<a href='../Configuracion/Aula.php?viene=Listar&pg=".$i."&nucleo=".$nuc."&infrae=".$infrae."&usu=".$id."'>".$ppage."</a>&nbsp;";
    }
  }
  else{
    for($i = 0; $i<($pages+1); $i++){
	  $ppage=$i+1;
	  if($i == $pg)
	    echo "<font face=Arial size=2 color=0000FF><b>&nbsp;$ppage&nbsp;</b></font>";
      else
	    echo "&nbsp;<a href='../Configuracion/Aula.php?viene=Listar&pg=".$i."&nucleo=".$nuc."&infrae=".$infrae."&usu=".$id."'>".$ppage."</a>&nbsp;";
    }
  }
  if($pg < $pages){
    $url = $pg + 1;
    echo "&nbsp;<a href='../Configuracion/Aula.php?viene=Listar&pg=".$url."&nucleo=".$nuc."&infrae=".$infrae."&usu=".$id."'>Siguiente</a>";
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
						    <input name="Agregar" type="submit" class="Boton" value="Agregar Aula" onClick="Opciones_SubMen('../Configuracion/Aula.php','Agregar','3','')">
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
