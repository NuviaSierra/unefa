<?php session_start(); // Iniciamos la sesion?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Menu Principal</title>
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
//***************************************************************************************
function Consult_Matricula(){
  parent.mainFrame.location='Menu/Consultar_Matricula.php';
}
//***************************************************************************************
function Actualizar_Datos(){
  parent.mainFrame.location='Persona/actualizar.php';
}
//***************************************************************************************
</script>
</head>
<?php
  include("Funciones/cascadas.css");
  include("Funciones/funciones.php");
  require("Clases/class.conexion.php");
  include("Clases/class.usuario.php");
  $Usu = new usuario('','','','');
  $Usu->conec_BD();
  $Usu->conectar_BD();  
  $ci=$_SESSION['ci'];
  $per_id=$_SESSION['idper'];
  $RES=$Usu->OperacionCualquiera("SELECT no1,no2,no3,ap1,ap2,ap3,tmo,hon_tha,usu_cor,fot from persona per,perfil_usuari pu,perfil,dir_hon dir,usuari usu WHERE per.ci='".$ci."' && per.sta=1 && dir.ci=per.ci && hon_tip=1 && hon_sta=1 && usu.ci=per.ci && usu_sta=1 && per.ci=pu.ci_usu && pu.peu_sta=1 && pu.per_id='".$per_id."' && pu.per_id=perfil.per_id && perfil.per_sta=1");
  $valor_usu=$Usu->ConsultarCualquiera($RES);?>
<body leftmargin="0" rightmargin="0" topmargin="0" topmargin="0" bgcolor="#a9c3e8" style="width:100%; height:100%">
<form action="presentacion.php" method="post" enctype="multipart/form-data" name="form" style="width:100%; height:100%">
  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr height="100%"><td width="100%">
      <table width="27%" height="100%" border="1">
        <tr style="background-color:#000066; border-color:#333" height="5%"><td>
          <table width="100%" height="90%">
            <tr><td align="center" class="Estilo24"><label>Usuario</label></td></tr>
          </table>
        </td></tr><?php $foto=explode("../",$valor_usu->fot);?>
        <tr style="background-color:#FFFFFF; border-color:#333" height="40%"><td>
          <table width="100%"  height="100%" style="background-color:#a9c3e8" align="center">
            <tr align="center">
              <td width="100%" align="center" class="Estilo7" colspan="2"><img src="<?php echo ''.$foto[1];?>" alt="" width="95" height="95"></td>
             </tr><tr align="center">
              <td width="100%" align="center" class="Estilo7" colspan="2"><?php echo ''.$valor_usu->ap1.' '.$valor_usu->ap2.' '.$valor_usu->no1.' '.$valor_usu->no2;?></td>
             </tr>
          <tr>
	        <td width="100%" align="center" class="Estilo7" colspan="2"><?php echo ''.$_SESSION['nomper'];?></td>
          </tr>
          <tr>
            <td width="50%" align="left"><span class="Estilo7">E-mail:</span></td>
            <td width="50%" align="left"><?php  echo ''.$valor_usu->usu_cor;?></td>
          </tr>
          <tr>
            <td width="50%" align="left"><span class="Estilo7">Tel&eacute;fono M&oacute;vil:</span></td>
            <td width="50%" align="left"><?php  echo ''.$valor_usu->tmo;?></td>
          </tr>
          <tr>
            <td width="50%" align="center"><input name="Actualizar" type="submit" class="Boton" value="Actualizar Datos" style="background-color:#00F; color:#FFF; border-color:#333" onClick="Actualizar_Datos();"><input name="action" class="Boton" type="hidden" value="checkdata"></td>
            <td width="50%" align="center"><input name="Matricula" type="submit" class="Boton" value="Consultar Matr&iacute;cula" style="background-color:#00F; color:#FFF; border-color:#333" onClick="Consult_Matricula();"></td>
          </tr></table>
        </td></tr>
        <!--
    <tr style="background-color:#000066; border-color:#333" height="30%"><td>
      <table width="100%" height="100%">
        <tr><td align="center" class="Estilo24"><label>Cambiar Contrase&ntilde;a</label></td></tr></table>
    </td></tr>
    <tr style="background-color:#a9c3e8; border-color:#333" height="20%"><td width="100%">
          <table width="100%" height="100%">
           <tr>
      <td width="41%" align="left" class="Estilo7">Actual:&nbsp;</td>
      <td width="59%" align="left"><input name="cont_act" type="text" class="Estilo5" size="15" maxlength="25"></td>
    </tr>
    <tr>
      <td width="41%" align="left"><span class="Estilo7">Nueva:&nbsp;</span></td>
      <td width="59%" align="left"><input name="cont_nue" type="text" class="Estilo5" size="15" maxlength="8" onChange="Enviar_email(this);"></td>
    </tr>
    <tr>
      <td width="41%" align="left"><span class="Estilo7">Confirmar:&nbsp;</span></td>
      <td width="59%" align="left"><input name="cont_nue_conf" type="text" class="Estilo5" size="15" maxlength="8" onChange="Enviar_email(this);"></td>
    </tr>     
          <tr>
            <td colspan="2" align="center"><input name="Enviar" type="submit" class="Boton" value="Restablecer" style="background-color:#00F; color:#FFF; border-color:#333"><input name="action" class="Boton" type="hidden" value="checkdata"></td>
          </tr></table>
        </td></tr>
!-->               
    <tr style="background-color:#000066; border-color:#333" height="5%"><td>
      <table width="100%" height="100%">
        <tr><td align="center" class="Estilo24"><label>Cont&aacute;ctanos</label></td></tr></table>
    </td></tr>
    <tr style="background-color:#a9c3e8; border-color:#333" height="60%"><td width="100%">
          <table width="100%" height="100%">
<!--           <tr>
      <td width="100%" align="left" class="Estilo7">Sede CANTV Pueblo Nuevo, Edif. 1 Piso 2 San Cristóbal Edo. Táchira</td>
    </tr>
!-->    
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Ingenier&iacute;a Civil&nbsp;<span class="Estilo11"><a href="mailto:secretariaingcivil@gmail.com"><img src="Imagenes/email13.gif" alt=""></td>
    </tr>
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Ingenier&iacute;a El&eacute;ctrica&nbsp;<span class="Estilo11"><a href="mailto:secretariaingelectrica@gmail.com"><img src="Imagenes/email13.gif"  alt=""></td>
    </tr>
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Ingenier&iacute;a en Sistemas&nbsp;<span class="Estilo11"><a href="mailto:secretariaingsistemas@gmail.com"><img src="Imagenes/email13.gif"  alt=""></td>
    </tr>
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Licenciatura en Administraci&oacute;n Gesti&oacute;n Municipal&nbsp;<span class="Estilo11"><a href="mailto:secretarialagm@gmail.com"><img src="Imagenes/email13.gif"  alt=""></td>
    </tr>
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Licenciatura en Econom&iacute;a Social&nbsp;<span class="Estilo11"><a href="mailto:@secretariaeconomiasgmail.com"><img src="Imagenes/email13.gif"  alt=""></td>
    </tr>
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Licenciatura en Turismo&nbsp;<span class="Estilo11"><a href="mailto:divsecretariaturismo@gmail.com"><img src="Imagenes/email13.gif"  alt=""></td>
    </tr>
    <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Extensi&oacute;n la Fr&iacute;a&nbsp;<span class="Estilo11"><a href="mailto:lili14546@gmail.com"><img src="Imagenes/email13.gif"  alt=""></td>
    </tr>
           <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Registro y Control de Estudio&nbsp;<span class="Estilo11"><a href="mailto:registroycontrol.tachira@gmail.com"><img src="Imagenes/email13.gif"  alt=""></td>
    </tr>
           <tr>
      <td width="100%" align="left" style="font-size:14px">Administrador del SIDSECUN&nbsp;<span class="Estilo11"><a href="mailto:sidsecun.unefa.tachira@gmail.com"><img src="Imagenes/email13.gif"  alt=""></td>
    </tr>
           <tr>
      <td width="100%" align="left" face="Arial Black, Gadget, sans-serif" style="font-size:14px">Secretario(a) Núcleo Táchira&nbsp;<span class="Estilo11"><a href="mailto:yccm22@gmail.com"><img src="Imagenes/email13.gif" alt=""></td>
    </tr>
  </table>
        </td></tr>
  </table>
</form>
</body>
</html>