<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<script>
 function navegar(cual){
// alert "hola "+document.form.id.value;
   if(cual==1){
     pagina= "http://aplicaciones.unefa.edu.ve/secretaria/modules/Sc3PrPd0Un3_1z0Is/";
   }
   else{
	 if(cual==2){
       pagina= "http://aplicaciones.unefa.edu.ve/secretaria/modules/Sc3PrPd0Un3_1z0Is/inscripcion.php";		 
	 }
	 else{
	   if(cual==3){
         pagina= "http://aplicaciones.unefa.edu.ve/secretaria/modules/Sc3PrPd0Un3_1z0Is/inscripcion.php";
	   }
	   else{
		 if(cual==4){
		   pagina= "http://aplicaciones.unefa.edu.ve/secretaria/modulo/Ms34mun3Pr4Pr/";
		 }
		 else{
		   if(cual==5){
		     pagina= "http://aplicaciones.unefa.edu.ve/secretaria/modules/mdes_C0ns/modulo/notas/";
		   }
		   else{
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
		           if(cual==9){		       
			         pagina= "http://www.unefa.edu.ve/portal/plantilla.php?4tr1c4s1=%205";
		           }
		           else{
			         pagina= "http://www.unefa.edu.ve";
			       }			       
			     }
			   }
			 }
		   }
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
<head>
<title>Site SIDSECUN</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head><link href='http://fonts.googleapis.com/css?family=Oleo+Script+Swash+Caps' rel='stylesheet' type='text/css'>
<style>

body {
	background-image: url(bg.jpg);
	font-family:Arial, Helvetica, sans-serif;
}
h3 {
    font-family: 'Oleo Script Swash Caps', cursive;
    text-align: center;
    font-size: 45px;
    text-shadow: -1px 5px 0 rgba(255, 255, 255, 0.6), 0 2px 0 rgba(0, 0, 0, 0.7);
    color: #788e87;
}

/*--- Damos las dimensiones a la lista altura y anchura
y aplicamos una perspectiva de 500px, y centramos
la lista en el documento con el margin ---- */
ul {
	height: 100px;
    margin: 10px auto;
    perspective: 700px;
    -webkit-perspective: 700px;
    -moz-perspective: 700px;
    -ms-perspective: 700px;
    -o-perspective: 700px;
    width: 985px;
}

/*---- Aplicamos color a los item de la lista que seran las cajas,
los mostramos uno al lado del otro con inline-block, margin y box-sizing,
aplicamos una transformación en el eje Y de 45º y una transición para dar
la elegancia al evento cada propiedad con sus prefijos de autores, por si algo pasa
 igual le damos un alto a las cajas y padding ----*/
ul li {
	background-color: #222;
    display: inline-block;
    margin-right: -10px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -o-box-sizing: border-box;
    height: 100px;
    list-style: none;
    text-align: center;
	transform: rotateY(45deg);
    -webkit-transform: rotateY(45deg);
    -moz-transform: rotateY(45deg);
    -o-transform: rotateY(45deg);
    transition: all ease .5s;
    -webkit-transition: all ease .5s;
    -moz-transition: all ease .5s;
    -o-transition: all ease .5s;
    padding: 10px;
    position: relative;
    width: 112px;
    z-index: 45;
}

/*--- Estilos para el parrafo que esta dentro de las cajas ---*/
li p {
	color:#ddd;
	font-size: .9em;
	margin: 4px 0 13px;
}

/*--- Estilos para el boton que lleva a los detalles del producto,
 aplicamos el fondo del boton en el estado inactivo y otras opciones
 para lograr la apariencia de botones en css, pr ultimo aplicamos una
 transición al color de fondo para cuando cambie de estado y aplicamos los estilos para 
 el estado hover.---*/
 ul li a.boton {
    background-color: #222222;
    border-radius: 2px 2px 2px 2px;
    bottom: 5px;
    color: #FFFFFF;
    font-size: 1em;
    padding: 0.5em;
    right: 5px;
    text-align: center;
    text-decoration: none;
    transition: background-color 1s ease 0s;
	-webkit-transition: background-color 1s ease 0s;
	-moz-transition: background-color 1s ease 0s;
	-o-transition: background-color 1s ease 0s;
}
 ul li a.boton:hover {
   color: #222222;
}


/*--- Damos un ancho a la imagen que se encuentra dentro de la caja y 
la altura sera relativa a su anchura ---*/
ul li img {
    height: auto !important;
    width: 93px !important;
}

/*--- Ahora nos referimos a los items de la lista y su compartamiento tanto en el estado pasivo como en el hover,
utilizamos la pseudo class nth-child, first-child, last-child para aplicar las rotaciones y posiciones adecuadas, tambien aplicamos
estilos al boton que tenemos como enlace. ---*/
 ul li:nth-child(5) {
    background-color: #222222;
    transform: rotateY(0deg) scale(1.22);
	-webkit-transform: rotateY(0deg) scale(1.22);
	-moz-transform: rotateY(0deg) scale(1.22);
	-o-transform: rotateY(0deg) scale(1.22);
    z-index: 45;
}
 ul li:nth-child(5) a.boton {
    background-color: #0099CC;
}
 ul li:nth-child(5) ~ li {
    transform: rotateY(-45deg);
	-webkit-transform: rotateY(-45deg);
	-ms-transform: rotateY(-45deg);
	-o-transform: rotateY(-45deg);
	-moz-transform: rotateY(-45deg);
}
 ul li:last-child,  ul li:first-child {
    z-index: 60;
}
 ul:hover li:not(:hover) {
    background-color: #111111;
    transform: rotateY(45deg);
	-webkit-transform: rotateY(45deg);
	-o-transform: rotateY(45deg);
	-moz-transform: rotateY(45deg);
	-ms-transform: rotateY(45deg);
}
 ul:hover li a.boton {
    background-color: #222222;
}
 ul li:hover,  ul li:first-child:hover,  ul li:nth-child(3) ~ li:hover {
	 background-color: #222;
	 transform: rotateY(0) scale(1.22);
     -webkit-transform: rotateY(0) scale(1.22);
     -moz-transform: rotateY(0) scale(1.22);
     -ms-transform: rotateY(0) scale(1.22);
     -o-transform: rotateY(0) scale(1.22);
     z-index: 50;
}
 ul:hover li:hover a.boton {
    background-color: #0099CC;
}
 ul:hover li:hover ~ li {
    transform: rotateY(-45deg);
	-webkit-transform: rotateY(-45deg);
	-ms-transform: rotateY(-45deg);
	-o-transform: rotateY(-45deg);
	-moz-transform: rotateY(-45deg);
}
</style>
<body background="" leftmargin="0" rightmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" background="" bgcolor="#FFFFFF">
  <tr style="background-color:#01257B">
    <td height="120" align="center"><a onClick="navegar(10);" style="cursor:pointer"><img alt="P&Aacute;GINA CENTRAL DE LA UNEFA" src="Imagenes/Banner_Izquierdo.jpg" width="342" height="120" title="P&Aacute;GINA CENTRAL DE LA UNEFA"></a></td>
    <td width="100%" height="120">
      <ul>
        <li>
          <a onClick="navegar(1);" style="cursor:pointer"><img alt="Censo de Inter&eacute;s Hacia las Oportunidades de Estudio" src="Coverflow/Censo_Interes.jpg" target="_blank" title="Censo de Inter&eacute;s Hacia las Oportunidades de Estudio"></a>
        </li>
        <li>
          <a onClick="navegar(2);" style="cursor:pointer"><img alt="Inscripci&oacute;n Repitientes CINU" src="Coverflow/Inscripcion_CINU_Repitientes.jpg" title="Inscripci&oacute;n Repitientes CINU"></a>
        </li>
        <li>
          <a onClick="navegar(3);" style="cursor:pointer"><img alt="Inscripci&oacute; Nuevo Ingreso" src="Coverflow/Inscripcion_12015_Nuevo_ingreso.jpg" title="Inscripci&oacute;n Nuevo Ingreso"></a>
        </li>
        <li>
          <a onClick="navegar(4);" style="cursor:pointer"><img alt="Carga de Notas CINU UNEFA Central" src="Coverflow/Carga_Notas_CINU.jpg" title="Carga de Notas CINU UNEFA Central"></a>
        </li>
        <li>
          <a onClick="navegar(5);" style="cursor:pointer"><img alt="Constancia de Estudio UNEFA Central" src="Coverflow/Constancia_Estudio_UNEFA_Central.jpg" title="Constancia de Estudio UNEFA Central"></a>
        </li>
        <li>
          <a onClick="navegar(6);" style="cursor:pointer"><img alt="Evaluar Docente UNEFA T&aacute;chira" src="Coverflow/evaluar.jpg" title="Evaluar Docente UNEFA T&aacute;chira"></a>
        </li>
        <li>
          <a onClick="navegar(7);" style="cursor:pointer"><img alt="Proceso de Evaluaci&oacute;n Desempe&ntilde;o Docente UNEFA Central" src="Coverflow/Proceso_Evaluacion_Docente_UNEFA_Central.jpg" title="Proceso de Evaluaci&oacute;n Desempe&ntilde;o Docente UNEFA Central"></a>
        </li>
        <li>
          <a onClick="navegar(8);" style="cursor:pointer"><img alt="Actualizaci&oacute;n De Datos Docentes" src="Coverflow/Actualizacion_Datos_Docente.jpg"  title="Actualizaci&oacute;n De Datos Docentes"></a>
        </li>
        <li>
          <a onClick="navegar(9);" style="cursor:pointer"><img alt="Tabla Aranceles" src="Coverflow/Tabla_Aranceles_UNEFA_Central.jpg" title="Tabla De Aranceles"></a>
        </li>
      </ul>
    </td>
  </tr>
</table>
</body>
</html>