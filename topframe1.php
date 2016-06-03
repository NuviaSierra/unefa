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
 <body leftmargin="0" rightmargin="0" topmargin="0" topmargin="0" bgcolor="#FFFFFF">
<?php
if (empty($_POST)) { ?>
<form action="topframe1.php" method="post" enctype="multipart/form-data" name="form">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
    <tr>
      <td width="10%" align="right" class="Estilo7">Usuario:&nbsp;</td>
      <td width="10%" align="left"><input name="login" type="text" class="Estilo5" size="15" maxlength="25"></td>
      <td width="10%" align="right"><span class="Estilo7">Contrase&ntilde;a:&nbsp;</span></td>
      <td width="10%" align="left"><input name="passwo" type="password" class="Estilo5" size="10" maxlength="8" onChange="Buscar_Proceso(this)"></td>
            <td width="10%" align="left"><span class="Estilo7"><a href="Pregunta_Secreta/camb_contra.php" target="mainFrame" style="font-size:10px">Olvido su Contrase&ntilde;a</a></span></td>
	  <td width="10%" align="right"><span class="Estilo7">Perfil:&nbsp;</span></td>
      <td width="10%" align="left"><select name="perfil" style="max-width: 5px" disabled>
        <option>-SELECCIONE-</option>
      </select></td>
      <td width="15%" align="right"><span class="Estilo7">Ingrese el c&oacute;digo:</span></td>
      <td width="5%" align="right"><img src="securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>"></td>
      <td width="10%" align="left"><input name="code" type="text" class="Estilo5" size="5" maxlength="4"></td>
      <td width="10%" align="center"><input name="Enviar" type="submit" class="Boton" value="Iniciar Sesi&oacute;n"><input name="action" class="Boton" type="hidden" value="checkdata"></td>
    </tr>
  </table>
</form>
<?php
} else { //form is posted
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
          $resul=1;
          $resul=$Usu->guardar_accion("INSERTAR","bitaco","INICIAR SESION");
          if($resul==1){?>
          <script>
            var msg = 'Bienvenido ' + '<?php echo $_SESSION[nomper]." ".$_SESSION[usuario]; ?>' + '!!!';
            parent.topFrame1.location="presentacion.php";
            parent.mainFrame.location='Menu/menu_princ.php';
            alert(msg);
          </script>
        <?php }
        }
        else{
		  $_SESSION['idoper']="";
		  $_SESSION['ci']="";
		  $_SESSION['idper']="";
		  $_SESSION['passwo']="";
		  if($permi==1){
          echo "<script>alert('ERROR. CONTRASEÑA O LOGIN INCORRECTO O SU ESTADO ES INACTIVO');</script>";
		  echo "<script> parent.topFrame1.location='topframe1.php';</script>";
		  }
        }
      }
      else{
		  $_SESSION['idoper']="";
		  $_SESSION['ci']="";
		  $_SESSION['idper']="";
		  $_SESSION['passwo']="";
        echo "<script>alert('ERROR. DEBE LLENAR LOS CAMPOS DE LOGIN, CONTRASEÑA Y/O PERFIL');</script>";
	  }
		  echo "<script> parent.topFrame1.location='topframe1.php';</script>";
  } else {
		  $_SESSION['idoper']="";
		  $_SESSION['ci']="";
		  $_SESSION['idper']="";
		  $_SESSION['passwo']="";
    echo "<script> alert('ERROR. EL CODIGO DE LA IMAGEN INGRESADO ES INCORRECTO');</script>";
	echo "<script> parent.topFrame1.location='topframe1.php';</script>";
  }
}?>
</body>
</html>