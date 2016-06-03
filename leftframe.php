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
}
//***************************************************************************************
function Buscar_Proceso(nom){
  valor1=nom.value
  valor2=document.form.login.value
  comb=document.form.perfil
  for(i=comb.length;i>-1;i--)
	comb.options[i]=null
//  alert("-"+valor2+"-"+valor1)
  if(valor1!="" && valor2!=""){
//  alert("- ENTRE -")
//  x_Buscar_Combo_Respo(valor,Mostrar_Combo_cb)
    var http=new getHTTPObject()
    tipo="Consultar"
	valor=valor2;
    enviar="valor="+valor+"&Operacion="+tipo+"&tim="+new Date().getTime()
    Dir="prueba.php"+"?"+enviar
//	alert("-"+Dir+"-")
    http.onreadystatechange = function(){
//	alert("-"+http.readyState+"-")
	if(http.readyState==4){
	  resultado = http.responseText.split("@");
//	  alert(http.responseText)
	  id=resultado[0].split("*")
	  des=resultado[1].split("*")
	  cuanto=resultado[2]
      ind=0;
	  if(cuanto==1){
	    comb.disabled=false;
	    comb.options[0]=new Option(id[0],des[0]);
	  }
	  else{
	    comb.disabled=false;
	    for(i=0;i<cuanto;i++){
		  comb.options[i]=new Option(id[i],des[i]);
		  ind++;
	    }
	  }
	  comb.options[0].selected=true;
	}
	else
	  comb.options[0]=new Option("--Seleccione--","");
    }
  http.open("GET",Dir, true);
  http.send(null);
  }
  else
    comb.options[0]=new Option("--Seleccione--","");
}
//**************************************************************************************
</script>
</head>
<?php
  include("Funciones/cascadas.css");?>
 <body leftmargin="0" rightmargin="0" topmargin="0" topmargin="0" bgcolor="#ffffff" marginwidth="0" style="width:100%">
<?php
if (empty($_POST)) { ?>
<form action="leftframe.php" method="post" enctype="multipart/form-data" name="form" style="width:100%">
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr height="100%"><td width="100%">
      <table width="100%" height="100%" border="1">
        <tr style="background-color:#000066; border-color:#333" height="5%"><td>
          <table width="100%" height="100%">
            <tr><td align="center" class="Estilo24"><label>Iniciar Sesión</label></td></tr>
          </table>
        </td></tr>
        <tr style="background-color:#ffffff; border-color:#333" height="40%"><td>
          <table width="100%"  height="100%" style="background-color:#a9c3e8">
            <tr>
              <td width="70%" align="left" class="Estilo7">Usuario:&nbsp;</td>
              <td colspan="2" width="30%" align="left"><input name="login" type="text" class="Estilo5" size="15" maxlength="25" height="15px"></td>
             </tr>
             <tr>
            <td width="70%" align="left"><span class="Estilo7">Contrase&ntilde;a:&nbsp;</span></td>
            <td colspan="2" width="30%" align="left"><input name="passwo" type="password" class="Estilo5" size="15" maxlength="8" onChange="Buscar_Proceso(this)" height="15px"></td>
          </tr>
          <tr>
	        <td width="70%" align="left"><span class="Estilo7">Perfil:&nbsp;</span></td>
            <td colspan="2" width="30%" align="left"><select name="perfil" disabled>
              <option>-SELECCIONE-</option>
            </select></td>
          </tr>
          <tr>
            <td width="70%" align="left"><span class="Estilo7">Ingrese el c&oacute;digo:</span></td>
            <td width="5%" align="right"><img src="securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>"></td>
            <td width="25%" align="left"><input name="code" type="text" class="Estilo5" size="5" maxlength="4" height="15px"></td>
          </tr>
          <tr>
            <td colspan="3" align="center"><input name="Enviar" type="submit" class="Boton" value="Iniciar Sesi&oacute;n" style="background-color:#00F; color:#FFF; border-color:#333"><input name="action" class="Boton" type="hidden" value="checkdata"></td>
          </tr></table>
        </td></tr>
    <tr style="background-color:#000066; border-color:#333" height="5%"><td>
      <table width="100%" height="100%">
        <tr><td align="center" class="Estilo24"><label>Olvido su Contrase&ntilde;a</label></td></tr></table>
    </td></tr>
    <tr style="background-color:#a9c3e8; border-color:#333" height="20%"><td width="100%">
          <table width="100%" height="100%">
           <tr>
      <td width="60%" align="left" class="Estilo7">Usuario:&nbsp;</td>
      <td width="40%" align="left"><input name="usua" type="text" class="Estilo5" size="15" maxlength="25" height="15px"></td>
    </tr>
    <tr>
      <td width="60%" align="left"><span class="Estilo7">E-mail:&nbsp;</span></td>
      <td width="40%" align="left"><input name="email" type="text" class="Estilo5" size="15" maxlength="8" onChange="Enviar_email(this);" height="15px"></td>
    </tr>   
          <tr>
            <td colspan="2" align="center"><input name="Enviar" type="submit" class="Boton" value="Restablecer" style="background-color:#00F; color:#FFF; border-color:#333"><input name="action" class="Boton" type="hidden" value="checkdata"></td>
          </tr></table>
        </td></tr>
   <tr style="background-color:#000066; border-color:#333" height="5%"><td>
      <table width="100%" height="100%">
        <tr><td align="center" class="Estilo24"><label>Cont&aacute;ctanos</label></td></tr></table>
    </td></tr>
    <tr style="background-color:#a9c3e8; border-color:#333" height="30%"><td width="100%">
          <table width="100%" height="100%">
<!--           <tr>
      <td width="100%" align="left" class="Estilo7">Sede CANTV Pueblo Nuevo, Edif. 1 Piso 2 San Cristóbal Edo. Táchira</td>
    </tr>
!-->    
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Ingenier&iacute;a Civil&nbsp;<span class="Estilo11"><a href="mailto:secretariaingcivil@gmail.com"><img src="Imagenes/email13.gif"  alt=""></span></td>
    </tr>
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Ingenier&iacute;a El&eacute;ctrica&nbsp;<span class="Estilo11"><a href="mailto:secretariaingelectrica@gmail.com"><img src="Imagenes/email13.gif"  alt=""></span></td>
    </tr>
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Ingenier&iacute;a en Sistemas&nbsp;<span class="Estilo11"><a href="mailto:secretariaingsistemas@gmail.com"><img src="Imagenes/email13.gif"  alt=""></span></td>
    </tr>
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Licenciatura en Administraci&oacute;n Gesti&oacute;n Municipal&nbsp;<span class="Estilo11"><a href="mailto:secretarialagm@gmail.com"><img src="Imagenes/email13.gif"  alt=""></span></td>
    </tr>
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Licenciatura en Econom&iacute;a Social&nbsp;<span class="Estilo11"><a href="mailto:@secretariaeconomiasgmail.com"><img src="Imagenes/email13.gif"  alt=""></span></td>
    </tr>
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Licenciatura en Turismo&nbsp;<span class="Estilo11"><a href="mailto:divsecretariaturismo@gmail.com"><img src="Imagenes/email13.gif"  alt=""></span></td>
    </tr>
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Extensi&oacute;n la Fr&iacute;a&nbsp;<span class="Estilo11"><a href="mailto:lili14546@gmail.com"><img src="Imagenes/email13.gif"  alt=""></span></td>
    </tr>
           <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Registro y Control de Estudio&nbsp;<span class="Estilo11"><a href="mailto:registroycontrol.tachira@gmail.com"><img src="Imagenes/email13.gif"  alt=""></span></td>
    </tr>
           <tr>
      <td width="100%" align="left" style="font-size:14px">Administrador del SIDSECUN&nbsp;<span class="Estilo11"><a href="mailto:sidsecun.unefa.tachira@gmail.com"><img src="Imagenes/email13.gif"  alt=""></span></td>
    </tr>
           <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Secretario(a) Núcleo Táchira&nbsp;<span class="Estilo11"><a href="mailto:yccm22@gmail.com"><img src="Imagenes/email13.gif" alt=""></span></td>
    </tr>
  </table>
</form>
<?php
}
else { //form is posted
  include("securimage.php");
  $img = new Securimage();
  $valid = $img->check($_POST['code']);
  if($valid == true) {
    $perfil=$_POST['perfil'];
    if($_POST['login']!="" && $_POST['passwo']!="" && $_POST['perfil']!=""){
	  include("Funciones/funciones.php");
	  require("Clases/class.conexion.php");
	  include("Clases/class.usuario.php");
	  $_SESSION['ci']=$_POST['login'];
	  $_SESSION['idper']=$_SESSION['idoper']=$_POST['perfil'];
	  $_SESSION['passwo']=$_POST['passwo'];
      $Usu = new usuario('','','','');
      $Usu->conec_BD();
      $Usu->conectar_BD();
      $enc=$Usu->Comprobar_Pass();
	  $perf_enc=$Usu->Buscar_Perf_Usu();
	  $permi=1;
//		$permi=$Usu->Comprobar_Permiso();
/*echo "<script>alert('$ci');</script>";*/
      if($enc!=0 AND $permi==1 && $perf_enc==1){
		if($_POST['login']!=$_POST['passwo']){
          $resul=1;
          $resul=$Usu->guardar_accion("INSERTAR","bitaco","INICIAR SESION");
          if($resul==1){?>
          <script>
            var msg = 'Bienvenido ' + '<?php echo $_SESSION[nomper]." ".$_SESSION[usuario]; ?>' + '!!!';
            parent.leftFrame.location="presentacion.php";
            parent.mainFrame.location='Menu/menu_princ.php';
            alert(msg);
          </script>
        <?php
          }	  
	    }
	    else{
          $resul=$Usu->guardar_accion("INSERTAR","bitaco","USUARIO Y CLAVE IGUALES");
	      $_SESSION['idoper']="";
	      $_SESSION['ci']="";
	      $_SESSION['idper']="";
	      $_SESSION['passwo']="";
          echo "<script> alert('LO SIENTO SU CUENTA HA SIDO BLOQUEADA DEBIDO A QUE TIENE COMO CLAVE SU NUMERO DE CEDULA, POR FAVOR REALICE EL PROCEDIMIENTO PARA DESBLOQUERLO QUE SE ENCUENTRA EN EL SEGMENTO DE NOTIFICACIONES.');</script>";
	      echo "<script> parent.leftFrame.location='leftframe.php';</script>";
	    }
      }
      else{
		$_SESSION['idoper']="";
		$_SESSION['ci']="";
		$_SESSION['idper']="";
		$_SESSION['passwo']="";
		if($permi==1){
          echo "<script>alert('ERROR. CONTRASEÑA O LOGIN INCORRECTO O SU ESTADO ES INACTIVO');</script>";
	      echo "<script> parent.leftFrame.location='leftframe.php';</script>";
		}
      }
    }
    else{
	  $_SESSION['idoper']="";
	  $_SESSION['ci']="";
	  $_SESSION['idper']="";
	  $_SESSION['passwo']="";
      echo "<script>alert('ERROR. DEBE LLENAR LOS CAMPOS DE LOGIN, CONTRASEÑA Y/O PERFIL');</script>";
	  echo "<script> parent.leftFrame.location='leftframe.php';</script>";
    }
  }
  else {
	$_SESSION['idoper']="";
	$_SESSION['ci']="";
	$_SESSION['idper']="";
	$_SESSION['passwo']="";
    echo "<script> alert('ERROR. EL CODIGO DE LA IMAGEN INGRESADO ES INCORRECTO');</script>";
	echo "<script> parent.leftFrame.location='leftframe.php';</script>";
  }
}?>
</body>
</html>