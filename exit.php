<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title>Cerrar Sesion</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
  <?php
    require("Clases/class.conexion.php");
    include("Clases/class.usuario.php");
    $NuevaSesion = new usuario("","","","","","","","");
    $NuevaSesion->conec_BD();
    $NuevaSesion->conectar_BD();
	$accion='INSERTAR';
    $Operacion="CERRAR SESION";	
    //$Tabla= "$_SESSION[ci]";//mysql_insert_id();
    $NuevaSesion->guardar_accion($accion,"bitaco",$Operacion);?>
  <body background="Imagenes/Fondo1.png" leftmargin="0" topmargin="0" rightmargin="0">
    <script>
      var msg = 'Hasta Luego ' + '<?php echo $_SESSION[desper]; ?>' + '!!!';
      alert(msg);
      parent.leftFrame.location='leftframe.php';
      parent.mainFrame.location='Centro.php';
    </script>
  </body>
  <?php
    $NuevaSesion->Limpiar();
    session_destroy();?>
</html>