<?php session_start(); // Iniciamos la sesion?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Sistema de Gesti&oacute;n de Pasto Voisin</title>
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
<script src='Funciones/funcion.validar.js'></script>
<script>
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
  function Limpiar_Session(){
    var http=new getHTTPObject()
    //document.getElementById("cargando").style.display='block';
    valor='0';
    tipo="Limpiar";
    enviar="valor="+valor+"&Operacion="+tipo+"&tim="+new Date().getTime()
    Dir="prueba.php"+"?"+enviar
    http.onreadystatechange = function(){
      if(http.readyState==4){
        resultado = http.responseText;
      }
    }
    http.open("GET",Dir, true);
    http.send(null);
  }
//***************************************************************************************
  function Buscar_Proceso(nom){
    //alert ('Operacion '+nom);
    if(nom=='Agregar_ci'){
      ci=document.form.ci.value;
      nacio=document.form.nacion.value;
      valor=nacio+"*"+ci+"";
    }
    else{
      if(nom=='Asignar_preg'){
        preg=document.form.presec.value;
        resp=document.form.ressec.value;
        valor=preg+"*"+resp;
      }
      else{
        pass1=document.form.passwo1.value;
        pass2=document.form.passwo2.value;
        valor=pass1+"*"+pass2;
      }
    }
    //alert(""+valor);
    if(valor!=""){
      var http=new getHTTPObject();
      //document.getElementById("cargando").style.display='block';
      tipo=nom;
      enviar="valor="+valor+"&Operacion="+tipo+"&tim="+new Date().getTime();
      Dir="prueba.php"+"?"+enviar;
      http.onreadystatechange = function(){
        if(http.readyState==4){
          resultado = http.responseText;
          alert('res '+resultado);
          if(nom=='Agregar_ci'){
            if(resultado=='1')
              setTimeout("location.href='Olvidar.php?viene=Asignar_preg'");
            else{
              if(resultado=='0')
                alert('ERROR EL CAMPO DEL NUMERO DE CEDULA DE IDENTIDAD ESTA VACIO');
              else
                alert('ERROR. CEDULA DE IDENTIDAD NO ENCONTRADA');
              setTimeout("location.href='Olvidar.php'");
            }
          }
          else{
            if(nom=='Asignar_preg'){
              if(resultado=='1')
                setTimeout("location.href='Olvidar.php?viene=Asignar_pass'");
              else{
                if(resultado=='0')
                  alert('ERROR. LA RESPUESTA SECRETA ES INCORRECTA');
                else
                  alert('ERROR EL CAMPO DE LA RESPUESTA SECRETA ESTA VACIO');
                setTimeout("location.href='Olvidar.php?viene=Asignar_preg'");
              }
            }
            else{
              if(resultado=='1'){
                alert('EL PASSWORD HA SIDO MODIFICADO SATISFACTORIAMENTE');
                setTimeout("location.href='Centro.php'");
              }
              else{
                if(resultado=='0')
                  alert('ERROR. LA RECTIFICACION DEL PASSWORD ES INCORRECTA');
                else{
                  if(resultado=='')
                    alert('ERROR. ALGUNO O AMBOS DE LOS CAMPOS DE PASSWORD ESTA VACIO');
                  else
                    alert('ERROR EL PASSWORD NO HA SIDO MODIFICADO');
                }
                setTimeout("location.href='Olvidar.php?viene=Asignar_pass'");
              }
            }
          }
        }
      }
      http.open("GET",Dir, true);
      http.send(null);
    }
  }
</script>
<?php
  include("Funciones/cascadas.css");
  require("Clases/class.conexion.php");
  include ("Clases/class.plantilla.php");
  $Plantilla = new plantilla("","","");
  include("Clases/class.usuario.php");
  $NuevoUsu = new usuario("","","","","","","","");
  $NuevoUsu->conec_BD();
  $NuevoUsu->conectar_BD();?>
<body background="Imagenes/Fondo1.png" leftmargin="0" rightmargin="0" topmargin="0" topmargin="0">
  <form action="Olvidar.php" method="post" enctype="multipart/form-data" name="form">
    <?php
      $scroll_ini=$Plantilla->table_scroll_ini('Olvidar');
      echo $scroll_ini;?>
      <tr>
        <td colspan="2" bgcolor="#777A4B"><span class="Estilo1">:: &iquest;OLVIDO SU CONTRASE&Ntilde;A?</span></td>
      </tr>
      <?php
        if(!isset($_GET["viene"])){?>
          <tr>
            <td bgcolor="#FFF8E5" width=\"60%"><div align="right">Por favor ingrese la nacionalidad y el n&uacute;mero de su c&eacute;dula de identidad:&nbsp;</div></td>
            <td bgcolor="#FFF8E5" width="50%"><div align="left">
              <select name="nacion" id="nacion" size="1">
                <option value="V">V</option>
                <option value="E">E</option>
              </select>&nbsp;
              <input name="ci" id="ci" type="text" size="20" maxlength="10" onBlur="validarCedula(this)">
            </div></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#FFF8E5" width="100%" align="center">
			  <input type="button" name="aceptar" id="aceptar" value="Aceptar" onclick="Buscar_Proceso('Agregar_ci')"></td>
          </tr>
        <?php }
        else{
          if($_GET["viene"]=='Asignar_preg'){
			$Tod=explode("*",$_SESSION['nacid']);
			$usuario=$NuevoUsu->Buscar_Preg_Usua();
			$nacion=$Tod[0];
			$ci=$Tod[1];
			if($usuario!=""){?>
			<tr>
              <td bgcolor="#FFF8E5" width="60%"><div align="right">C&eacute;dula de Identidad:&nbsp;</div></td>
              <td bgcolor="#FFF8E5" width="50%"><div align="left"><?php echo "".$nacion."-".$ci."";?></div></td>
            </tr>
            <tr>
              <td bgcolor="#FFF8E5" width="50%" align="right">Usuario:&nbsp;</td>
              <td bgcolor="#FFF8E5" width="50%" align="left">&nbsp;<?php echo "".$usuario->VAR_NOM."";?></td>
            </tr>
            <tr>
              <td bgcolor="#FFF8E5" width="50%" align="right">&iquest;<?php echo "".$usuario->VAR_PSE."";?>?:&nbsp;</td>
              <td bgcolor="#FFF8E5" width="50%" align="left">
			    <input name="ressec" id="ressec" size="20" maxlength="50" type="password" onBlur="validarTextoNum(this)">
			    <input name="presec" id="presec" type="hidden" value="<?php echo "".$usuario->VAR_PSE."";?>">
			  </td>
            </tr>
            <tr>
              <td colspan="2" bgcolor="#FFF8E5" width="100%" align="center">
			    <input type="button" name="aceptar" id="aceptar" value="Aceptar" onclick="Buscar_Proceso('Asignar_preg')">
			  </td>
            </tr>
			<?php
			}
			else
			  echo "<script>alert('CEDULA DE IDENTIDAD NO ENCONTRADA');</script>";
          }
          else{
			$Tod=explode("*",$_SESSION['nacid']);
			$usuario=$NuevoUsu->Buscar_Logi_Usua();
			$nacion=$Tod[0];
			$ci=$Tod[1];
			if($usuario!=""){?>
			<tr>
              <td bgcolor="#FFF8E5" width="60%"><div align="right">C&eacute;dula de Identidad:&nbsp;</div></td>
              <td bgcolor="#FFF8E5" width="50%"><div align="left"><?php echo "".$nacion."-".$ci."";?></div></td>
            </tr>
            <tr>
              <td bgcolor="#FFF8E5" width="50%" align="right">Usuario:&nbsp;</td>
              <td bgcolor="#FFF8E5" width="50%" align="left">&nbsp;<?php echo "".$usuario->VAR_NOM."";?></td>
            </tr>
            <tr>
              <td bgcolor="#FFF8E5" width="50%" align="right">Login:&nbsp;</td>
              <td bgcolor="#FFF8E5" width="50%" align="left">&nbsp;<?php echo "".$usuario->VAR_LOG."";?></td>
            </tr>
            <tr>
              <td bgcolor="#FFF8E5" width="50%" align="right">Ingrese Nuevo Password:&nbsp;</td>
              <td bgcolor="#FFF8E5" width="50%" align="left">
			    <input name="passwo1" id="passwo1" size="20" maxlength="20" type="password" onBlur="validarTextoNumPass(this)">
			  </td>
            </tr>
            <tr>
              <td bgcolor="#FFF8E5" width="50%" align="right">Rectifique el Nuevo Password:&nbsp;</td>
              <td bgcolor="#FFF8E5" width="50%" align="left">
			    <input name="passwo2" id="passwo2" size="20" maxlength="20" type="password" onBlur="validarTextoNumPass(this)">
			  </td>
            </tr>
            <tr>
              <td colspan="2" bgcolor="#FFF8E5" width="100%" align="center">
			    <input type="button" name="aceptar" id="aceptar" value="Aceptar" onclick="Buscar_Proceso('Asignar_pass')">
			  </td>
            </tr>
			<?php
			}
			else
			  echo "<script>alert('CEDULA DE IDENTIDAD NO ENCONTRADA');</script>";
          }
        }
      $scroll_fin=$Plantilla->table_scroll_fin();
      echo $scroll_fin;?>
  </form>
</body>
</html>