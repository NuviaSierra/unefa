<?php session_start(); // Iniciamos la sesion?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Menu Principal</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!--
//******************************************************************
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//******************************************************************
//-->
</script>
</head>
<script src='../Funciones/funcion.validar.js'></script>
<?php
  include("Funciones/cascadas.css");
  include("Funciones/funciones.php");
  require("Clases/class.conexion.php");
  include("Clases/class.menus.php");
  $NuevoMenu = new menus("","","","","");
  $NuevoMenu->conec_BD();
  $NuevoMenu->conectar_BD();
  include ("Clases/class.plantilla.php");
  $Plantilla = new plantilla("","","");
  $_SESSION['rif']="";
$ci=$_SESSION["ci"];
$per_id=$_SESSION["idper"];
include("Menu/estilos_menu_princ.css");
//require_once("../conexion/bd.php");
$base = new conec_BD(); $conexion=$base->conectar_BD();
$base1 = new conec_BD(); $conexion1=$base1->conectar_BD();
//$base = new conec_BD();  $base->conec_BD();
//$base1 = new conec_BD();  $base1->conec_BD();
$base->consulta("select no1,no2,no3,ap1,ap2,ap3,tmo,usu_cor,fot from persona per,perfil_usuari pu,perfil,usuari usu where per.ci='".$ci."' && per.sta=1 && usu.ci=per.ci && usu_sta=1 && per.ci=pu.ci_usu && pu.peu_sta=1 && pu.per_id='".$per_id."' && pu.per_id=perfil.per_id && perfil.per_sta=1",$conexion);
$info=$base->extraer();
$base->consulta("select * from dir_hon where ci='".$ci."' && hon_sta=1 && hon_tip=1",$conexion);
$dhon=$base->extraer();
/*echo "<script>alert('$ci, $per_id, $info[ap1]');</script>";*/
  if($per_id==4){
/*$base1->consultar("select esp_nom,reg_nom,mod_nom,coh_nom from persona per,perfil_usuari pu,perfil,matric mat,especi esp,regimen reg,modali,cohort where per.ci='".$ci."' && per.sta=1 && per.ci=pu.ci_usu && pu.peu_sta=1 && pu.per_id=$per_id && pu.per_id=perfil.per_id && perfil.per_sta=1 && per.ci=mat.ci && mat.matr_sta=1 && mat.matr_tip=0 && mat.esp_id=esp.esp_id && esp.esp_sta=1 && mat.reg_id=reg.reg_id && reg_sta=1 && mat.mod_id=modali.mod_id && modali.mod_sta=1 && mat.coh_id=cohort.coh_id && cohort.coh_sta=1");*/
    $base1->consulta("SELECT DISTINCT(D.coh_nom), B.reg_nom, C.esp_nom, A.mod_nom  FROM matric E, modali A, regimen B, especi C, cohort D WHERE E.ci='$ci' AND E.matr_tip='0' AND E.matr_sta='1' AND E.mod_id=A.mod_id AND E.reg_id=B.reg_id AND E.esp_id=C.esp_id AND E.coh_id=D.coh_id ORDER BY A.mod_nom,B.reg_nom,C.esp_nom,D.coh_nom",$conexion1);
  }
  else{
	if($per_id==3/*3*/){
/*$base1->consultar("select inf_nom,esp_nom,reg_nom,mod_nom,coh_nom from persona per,perfil_usuari pu,perfil,estudi_infrae_matric eim,infrae inf,especi esp,regimen reg,modali,cohort where per.ci='".$ci."' && per.sta=1 && per.ci=pu.ci_usu && pu.peu_sta=1 && pu.per_id=$per_id && pu.per_id=perfil.per_id && perfil.per_sta=1 && per.ci=eim.ci && eim.eim_sta=1 && eim.eim_tip=1 && eim.esp_id=esp.esp_id && esp.esp_sta=1 && eim.reg_id=reg.reg_id && reg_sta=1 && eim.mod_id=modali.mod_id && modali.mod_sta=1 && eim.coh_id=cohort.coh_id && cohort.coh_sta=1 && eim.inf_id=inf.inf_id && inf.inf_sta=1");*/
      $base1->consulta("SELECT DISTINCT(D.coh_nom), B.reg_nom, C.esp_nom, A.mod_nom, F.inf_nom FROM estudi_infrae_matric E, modali A, regimen B, especi C, cohort D, infrae F WHERE E.ci='$ci' AND (E.eim_tip='1' OR E.eim_tip='2') AND E.eim_sta='1' AND E.mod_id=A.mod_id AND E.reg_id=B.reg_id AND E.esp_id=C.esp_id AND E.coh_id=D.coh_id AND E.inf_id=F.inf_id ORDER BY F.inf_nom,A.mod_nom,B.reg_nom,C.esp_nom,D.coh_nom",$conexion1);
    }
    else{ 
      if($per_id==2 || $per_id==6 /*6*/){
/*$base1->consultar("select inf_nom,esp_nom,reg_nom,mod_nom,coh_nom from persona per,perfil_usuari pu,perfil,matric mat,estudi_infrae_matric eim,infrae inf,especi esp,regimen reg,modali,cohort where per.ci='".$ci."' && per.sta=1 && per.ci=pu.ci_usu && pu.peu_sta=1 && pu.per_id=$per_id && pu.per_id=perfil.per_id && perfil.per_sta=1 && per.ci=mat.ci && mat.matr_sta=1 && mat.ci=eim.ci && mat.esp_id=eim.esp_id && mat.reg_id=eim.reg_id && mat.mod_id=eim.mod_id && mat.coh_id=eim.coh_id && mat.pen_top=eim.pen_top && eim.eim_sta=1 && eim.eim_tip=2 && eim.esp_id=esp.esp_id && esp.esp_sta=1 && eim.reg_id=reg.reg_id && reg_sta=1 && eim.mod_id=modali.mod_id && modali.mod_sta=1 && eim.coh_id=cohort.coh_id && cohort.coh_sta=1 && eim.inf_id=inf.inf_id && inf.inf_sta=1");*/
        $base1->consulta("SELECT DISTINCT(D.coh_nom), B.reg_nom, C.esp_nom, A.mod_nom FROM matric E, modali A, regimen B, especi C, cohort D WHERE E.ci='$ci' AND (E.matr_obs LIKE 'COORDINADOR%' OR E.matr_obs LIKE 'ADMINISTRADOR%') AND E.matr_tip='1' AND E.matr_sta='1' AND E.mod_id=A.mod_id AND E.reg_id=B.reg_id AND E.esp_id=C.esp_id AND E.coh_id=D.coh_id ORDER BY A.mod_nom,B.reg_nom,C.esp_nom,D.coh_nom",$conexion1);
      }
    }
  }
  ?>
<body bgcolor="#a9c3e8" leftmargin="0" rightmargin="0" topmargin="0" topmargin="0">
  <form action="menu_princ.php" method="post" enctype="multipart/form-data" name="form">
    <table width="100%" height="100%" border="0" align="left" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="1" width="10%">&nbsp;</td>
        <td colspan="1" width="80%">
          <table width="862px" height="25px" border="0" align="left" cellspacing="0" cellpadding="0">
            <?php
              $menu_princ=$NuevoMenu->menu_principal("1");
              echo $menu_princ;?>
          </table>
        </td>
        <td colspan="1" width="10%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" width="100%">
          <?php
            $scroll_ini=$Plantilla->table_scroll_ini('menu_princ');
            echo $scroll_ini;?>
      <tr>
                <td colspan="5" width="100%" bgcolor="#000066"><span class="Estilo1">:: BIENVENIDO AL SISTEMA INTEGRADO DE LA DIVISIÓN DE SECRETARIA UNEFA-TÁCHIRA "SIDSECUN"</span></td>
      </tr>
              <tr bgcolor="#FFFF99">
                <td width="100%" colspan="5" align="justify"><span class="Estilo17"> <br>SE LE INFORMA A TODOS LOS USUARIOS QUE DEBEN:<br>
				&ndash; Ingresar a Actualizar Datos en el men&uacute; Mantenimiento; si no naci&oacute; en el Estado T&aacute;chira por favor en las datos de nacimiento colocar los datos de habitaci&oacute;n; debido a que en el sistema no se ha cargado la data de las parroquias de todos los estados.</br>
				<br>&ndash; Ingresar a Modificar la contraseña en el men&uacute; Mantenimiento -> Usuario.</br></span></td>
              </tr>
            <?php 
			  if($per_id==4){?>
             <tr bgcolor="#990000">
                <td width="100%" colspan="5"align="justify"><span class="Estilo16"> SE LE INFORMA A LOS ESTUDIANTES:
                <br>
				&ndash; Los estudiantes que tengan algún inconveniente con la inclusión, retiro o cambio de secci&oacute;n entregada a la Divisi&oacute;n de Secretar&iacute;a v&iacute;a e-mail para el proceso de Inscripci&oacute;n 1-2014 por favor dirigirse con el respectivo coordinador.</br>
				<br>
				&ndash; <em><strong>REGLAMENTO DE TRANSICIÓN,</strong></em> según orden administrativa No. 1171 del 16/11/2009 expresa:</br>
				</p>
                  <ul>
                    <li><em><strong>Art&iacute;culo 5: </strong></em>El estudiante parainscribir una asignatura que no tiene prelaciones, antes deber&aacute; tener aprobadas todas las asignaturas sin prelaciones que contemple el plan de estudios en semestres anteriores.</li>
                    <li><strong><em>Art&iacute;culo 7:</em></strong> El estudiante que repruebe alguna asignatura despues de haberla cursado en tres (3) oportunidades, ser&aacute; suspendido por el lapso de un (1) semestre, a cuyo t&eacute;rmino pordr&aacute; solicitar el reingreso al semestre en el cual se encuentre(n) la(s) asignatura(s) pendiente(s), de menor orden en la cadena de prelaciones.</li>
                    <li><strong><em>Art&iacute;culo 8: </em></strong>El estudiante podr&aacute; inscribir en cada per&iacute;odo acad&eacute;mico, hasta un m&aacute;ximo de dos (2) asignaturas reprobadas, adem&aacute;s de las asignaturas regulares que correspondan seg&uacute;n el plan de estudio, siempre que concurran las siguientes condiciones:
                      <ol>
                        <li>No se cursen las asignaturas reprobadas, conjuntamente con asignaturas que las prelen, a&uacute;n cuando se oferten regularmente en el semestre.</li>
                        <li>Exista un m&iacute;nimo de quince (15) estudiantes que soliciten la inscripci&oacute;n correspondiente.</li>
                        <li>Disponibilidad del personal docente para dictar la(s) asignatura (s).</li>
                        <li>Disponibilidad de planta f&iacute;sica.</li>
                        <li>Disponibilidad por parte de las instituciones u organizaciones ajenas a la Universidad, para el desarrollo de clases pr&aacute;cticas o de laboratorio, en caso de ser requerido para la implementaci&oacute;n de la asignatura.</li>
                      </ol>
                      En caso contrario, el estudiante deber&aacute; esperar para inscribir la(s) asignatura(s) cuando sean ofertadas para la siguiente cohorte.</li>
                  </ul></span></td>
      </tr>
              <?php
			  }?>
              <tr bgcolor="#FFFFFF"><!--ojo montar los datos de la persona despues de este TR-->
                <td width="105" height="33"><div alritaign="right"><b>Nombres:</b></div></td>
                <td width="181"><div align="left"><?php echo $info['no1']." ".$info['no2']." ".$info['no3'];?></div></td>
                <td width="125"><div align="right"><b>Teléfono:</b></div></td>
                <td width="191"><div align="left"><?php echo $dhon['hon_tha'];?></div></td>
                <td width="158" rowspan="3"><img src="<?php echo $info['fot'];?>" alt="" width="95" height="95"></td>
                </tr>
              <tr bgcolor="#FFFFFF"><!--ojo montar los datos de la persona despues de este TR-->
                <td height="33"><div align="right"><b>Apellidos:</b></div></td>
                <td><div align="left"><?php echo $info['ap1']." ".$info['ap2']." ".$info['ap3'];?></div></td>
                <td><div align="right"><b>Celular:</b></div></td>
                <td><div align="left"><?php echo $info['tmo'];?></div></td>
                </tr>
              <tr>
                <td height="33" colspan="2"><div align="right"><b>Correo:</b></div></td>
                <td colspan="2"><div align="left"><?php echo $info['usu_cor'];?></div></td>
              </tr>
              <tr bgcolor="#FFFFFF">
                <td colspan="5">
<?php 
			  if($per_id==4){
			?>
            <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bordercolor="#777A4B" bgcolor="#ffffff">
              <tr>
                <td colspan="4" width="100%" bgcolor="#000066"><span class="Estilo1">CARRERA</span></td>
              </tr>
			  <tr>
                <td><div align="center"><b>Modalidad</b></div></td>
                <td><div align="center"><b>R&eacute;gimen</b></div></td>
                <td><div align="center"><b>Especialidad</b></div></td>
                <td><div align="center"><b>Pensum</b></div></td>
              </tr>
              <?php 
			    while($info=$base1->extraer()){
			  ?>
              <tr>
				<td><div align="left"><?php echo $info['mod_nom'];?></div></td>
				<td><div align="left"><?php echo $info['reg_nom'];?></div></td>
				<td><div align="left"><?php echo $info['esp_nom'];?></div></td>
                <td><div align="left"><?php echo $info['coh_nom'];?></div></td>
              </tr>  
              <?php
			    }
			  ?>
            </table>	  
            <?php 
			  }
			  else{
			   if($per_id==3/*3*/){?>
            <table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bordercolor="#777A4B" bgcolor="#ffffff">
              <tr>
                <td colspan="5" width="100%" bgcolor="#000066"><span class="Estilo1">CARGO DOCENTE</span></td>
              </tr>
			  <tr>
                <td><div align="center"><b>Infraestructura</b></div></td>
                <td><div align="center"><b>Modalidad</b></div></td>
                <td><div align="center"><b>R&eacute;gimen</b></div></td>
                <td><div align="center"><b>Especialidad</b></div></td>
                <td><div align="center"><b>Pensum</b></div></td>
              </tr>
              <?php 
			    while($info=$base1->extraer()){
			  ?>
              <tr>
				<td><div align="left"><?php echo $info['inf_nom'];?></div></td>
				<td><div align="left"><?php echo $info['mod_nom'];?></div></td>
				<td><div align="left"><?php echo $info['reg_nom'];?></div></td>
				<td><div align="left"><?php echo $info['esp_nom'];?></div></td>
                <td><div align="left"><?php echo $info['coh_nom'];?></div></td>
              </tr>  
              <?php
			    }
			  ?>
            </table>	  
            <?php
			  }
			   else{
			     if($per_id==2 || $per_id==6/*6*/){
			?>
			<table style="width: 100%; text-align: center; margin-left: auto; margin-right: auto;" height="100%" border="1" align="left" cellpadding="6" cellspacing="2" bordercolor="#777A4B" bgcolor="#ffffff">
              <tr>
                <td colspan="4" width="100%" bgcolor="#000066"><span class="Estilo1">CARGO COORDINADOR</span></td>
              </tr>
			  <tr>
                <td><div align="center"><b>Modalidad</b></div></td>
                <td><div align="center"><b>R&eacute;gimen</b></div></td>
                <td><div align="center"><b>Especialidad</b></div></td>
                <td><div align="center"><b>Pensum</b></div></td>
              </tr>
              <?php 
			    while($info=$base1->extraer()){
			  ?>
              <tr>
				<td><div align="left"><?php echo $info['mod_nom'];?></div></td>
				<td><div align="left"><?php echo $info['reg_nom'];?></div></td>
				<td><div align="left"><?php echo $info['esp_nom'];?></div></td>
                <td><div align="left"><?php echo $info['coh_nom'];?></div></td>
              </tr>  
              <?php
			    }
			  ?>
            </table>
            <?php
			    }
			   }
			  }
			?>
                </td>
              </tr>
          <?php $scroll_fin=$Plantilla->table_scroll_fin();
            echo $scroll_fin;?>
        </td>
      </tr>
    </table>
  </form>
</body>
</html>