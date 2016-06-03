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
//***************************************************************************************
function Activar(nom){
  obj=document.getElementById(nom);
  obj.disabled=false;
}
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
	  nom[-1]="-Seleccione-";	
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
    comb.options[ind]=new Option("--SELECCIONE--","")
    comb.disabled=true;
  }
}
//***************************************************************************************
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
<body bgcolor="#a9c3e8">
  <?php
/*    echo "<script>alert('ENTRE A AGREGAR');</script>";*/
  if(!isset($_POST[nombre])){
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
					    <tr><td colspan="2" bgcolor="#000066"><span class="Estilo1">:: AGREGAR AULA</span></td></tr>
						<tr>						
						  <td bgcolor="#FFFFFF" width="50%"><div align="right" class="Estilo9">Nucleo</div></td>
						  <td bgcolor="#FFFFFF" width="50%"><div align="left" class="Estilo2">
						  <select id="nucleo" name="nucleo" onChange="Sel_Infrae(this);">
						    <option value="">--SELECCIONE--</option>
							<?php 
						      $resp=$NuevoAul->Listado_Nucleo();
							while($array=$NuevoAul->ConsultarCualquiera($resp)){
/*							echo "<script>alert('$array->asi_cod, $array->asi_nom');</script>";*/
							?>
						    <option value="<?php echo "".$array->nuc_id;?>"><?php echo "".$array->nuc_nom;?></option>
							<?php }?>
						  </select>
						  <img src="../Imagenes/Obligatorio.png" width="9" height="8"></div></td>
						</tr>
						<tr>
						  <td bgcolor="#FFFFFF" width="50%"><div align="right" class="Estilo9">Infraestructura</div></td>
						  <td bgcolor="#FFFFFF" width="50%"><div align="left" class="Estilo2">
						  <select id="infrae" name="infrae" onChange="Activar('nombre')" disabled>
						    <option value="">--SELECCIONE--</option>
						  </select>
						  <img src="../Imagenes/Obligatorio.png" width="9" height="8"></div></td>
						</tr>
						<tr>
						  <td bgcolor="#FFFFFF" width="45%"><div align="right" class="Estilo9">Nombre del Aula:</div></td>
						  <td bgcolor="#FFFFFF"><div align="left" class="Estilo9">
							<input name="nombre" id="nombre" type="text" size="30" maxlength="35" onBlur="validarTextoNumGui(this)" value="" onChange="Activar('ubic')" disabled><img src="../Imagenes/Obligatorio.png" width="9" height="8">
						  </div></td>
						</tr>
						<tr>
						  <td bgcolor="#FFFFFF" width="50%"><div align="right" class="Estilo9">Ubicaci&oacute;n del Aula:</div></td>
						  <td bgcolor="#FFFFFF" width="50%"><div align="left" class="Estilo9"><textarea name="ubic" id="ubic" onBlur="validarTextoNumGui(this)" cols="23" disabled><?php echo "".$array->aul_ubic;?></textarea><img src="../Imagenes/Obligatorio.png" width="9" height="8"></div></td>
						</tr>
					    <tr>
						  <td bgcolor="#FFFFFF" colspan="2" width="100%" height="25px">
							<input name="Aceptar" type="submit" class="Boton" value="Aceptar">
							<input name="Cancelar" type="button" class="Boton" value="Cancelar" onClick="Navegar('../Configuracion/Aula.php?viene=Listar&accion=Agregar')">
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
    if($_POST[ubic]!="" && $_POST[nombre]!="" && $_POST[nucleo]!="" && $_POST[infrae]!=""){
	  $NuevoAul->Asignar_valores('',$_POST[infrae],$_POST[nombre],$_POST[ubic],"1");
	  if($NuevoAul->Buscar_Nombre()==0)
      {
	    $resp=$NuevoAul->Buscar_Nombre3();
		$NumFilas=$NuevoAul->NumFilasCualquiera($resp); 
/*	    echo "<script>alert('$NumFilas');</script>";	*/
  	    if($NumFilas==0){
		  if($ultimo=$NuevoAul->Agregar_aula()>0){
		    echo "<script>alert('SE HA AGREGADO EL AULA SATISFACTORIAMENTE');</script>";	
			  $accion='INSERTAR';
		      $Operacion="AGREGAR EL AULA CON ID: ".$ultimo." Y EL NOMBRE: ".$_POST[nombre]."";	
		      $NuevoAul->guardar_accion($accion,"aulas",$Operacion);
		    $agre=1;
		  }
		  else
		    echo "<script>alert('LO SIENTO EL AULA NO SE HA PODIDO AGREGAR');</script>";
		}
		else{
		  $array=$NuevoAul->ConsultarCualquiera($resp);
		  if($NuevoAul->Modificar_aula2($array->aul_id)>0){
		    echo "<script>alert('SE HA AGREGADO EL AULA SATISFACTORIAMENTE');</script>";	
			$accion='MODIFICAR';
		    $Operacion="MODIFICAR EL AULA CON ID: ".$array->aul_id." Y EL NOMBRE: ".$_POST[nombre]."";	
		    $NuevoAul->guardar_accion($accion,"aulas",$Operacion);
		    $agre=1;
	      }
	      else{
		     echo "<script>alert('LO SIENTO EL AULA NO SE HA PODIDO AGREGAR');</script>";
	      }
		}		
	  }
	  else
	    echo "<script>alert('LO SIENTO EL AULA YA HA SIDO INGRESADO PARA LA INFRAESTRUCTURA SELECCIONADA');</script>";	  
	}
	else{
	  echo "<script>alert('LO SIENTO EXISTEN CAMPOS VACIOS QUE SON OBLIGATORIOS');</script>";
	}
	if($agre==0)
      echo "<script>setTimeout(\"location.href='../Aulas/Agregar.php?ayu=".$_POST[ayu]."'\");</script>";
	else
      echo "<script>setTimeout(\"location.href='../Configuracion/Aula.php?ayu=".$_POST[ayu]."&viene=Listar'\");</script>";
  }?>
</body>
</html>