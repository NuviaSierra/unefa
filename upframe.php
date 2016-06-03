<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Site SIDSECUN</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script>
 function navegar(cual){
// alert "hola "+document.form.id.value;
   if(cual==1){
     pagina= "http://www.unefatachira.net/moodle/";
   }
   else{
	 if(cual==2){
       pagina= "http://www.unefatachira.net/portal/";		 
	 }
	 else{
	   if(cual==3){
         pagina= "http://aplicaciones.unefa.edu.ve/secretaria/modulo/Ms34mun3Pr4Pr/";
	   }
	   else{
		 if(cual==4){
		   pagina= "http://www.unefa.edu.ve/portal/calendario.php";
		 }
		 else{
		   if(cual==5){
		     pagina= "http://www.unefa.edu.ve/portal/radio/";
		   }
		   /*else{
		     if(cual==6){
		       pagina= "http://unefatachira.net.ve/evaluacion/";
		     }
		     else{
		       if(cual==7){		       
			     pagina= "http://www.unefa.edu.ve/portal/plantilla.php?4tr1c4s1=%20422";
		       }
		       else{
		         if(cual==8){		       
			       pagina= "http://aplicaciones.unefa.edu.ve/vac/modules/Sc3PrRd0Un4/";
		         }
		         else{
			       pagina= "http://www.unefa.edu.ve/portal/plantilla.php?4tr1c4s1=%205";
			     }
			   }
			 }
		   }*/
		 }
	   }
	 }
   }
     var ventana = self;
     ventana.opener = self;
     ventaH = screen.height;
     ventaW = screen.width;
     window.open(pagina, "" , "fullscreen=0 ,toolbar=0 ,location=0 , status=0 , menubar=0 , scrollbars=1 , resizable=0, width= "+ventaW+", height="+ventaH+", false");
 }
</script>
</head>
<?php
  include("Funciones/cascadas.css");?>
<body bgcolor="#a9c3e8" leftmargin="0" rightmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<table width="100%" height="20" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" bordercolor="#333">
  <tr height="100%"><td width="100%">
    <table width="100%" height="100%" border="1">
            <tr>
              <td style="background-color:#000066; border-color:#333" height="15" width="20%" align="center" class="Estilo24"><label>Enlaces de Inter&eacute;s</label></td>
              <td style="background-color:#FFF" width="80%" height="15" align="center">
              <table cellpadding="0" cellspacing="0"><tr>
                <td><a onClick="navegar(1);" style="cursor:pointer"><img src="Imagenes/icon_moodle.png" alt="Aula Virtual T&aacute;chira" name="AV" width="70" height="48" id="AV" title="Aula Virtual T&aacute;chira"></a></td>
                <td><a onClick="navegar(2);" style="cursor:pointer"><img src="Imagenes/icon_unefa.png" name="UT" id="UT" title="P&aacute;gina UNEFA T&aacute;chira"></a></td>
                <td><a onClick="navegar(3);" style="cursor:pointer"><img src="Imagenes/icon_nota.png" name="NC" id="NC" title="Notas CINU"></a></td>
                <td><a onClick="navegar(4);" style="cursor:pointer"><img src="Imagenes/icon_calendario.png" alt="Calendario UNEFA" name="CU" width="48" height="48" id="CU" title="Calendario UNEFA"></a></td>
                <td><a onClick="navegar(5);" style="cursor:pointer"><img src="Imagenes/icon_radio.png" alt="Radio UNEFA" name="RU" id="RU" title="Radio unefa"></a></td>
              </tr></table>
              </td>
            </tr>
     </table>
   </td>
   </tr>
</table>
</body>
</html>