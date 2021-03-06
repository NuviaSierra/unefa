<?php session_start();
  require_once('../../Funciones/Clases PDF/class.ezpdf.php');
  require("../../Clases/class.conexion.php");
  include("../../Clases/class.blh.php");
  $NuevoBlh = new blh("","","","");
  $NuevoBlh->conec_BD();
  $NuevoBlh->conectar_BD();
  $pdf =& new Cezpdf('LETTER','');
  $pdf->selectFont('../../Funciones/Clases PDF/fonts/Times-Roman.afm');
  $pdf->ezSetCmMargins('3','1','2','2');
  if($_GET[usu]!="")//si ya selecciono fecha y no es vacia
  {
    $NuevoBlh->Buscar_blh($_GET[usu]);
	$array=$NuevoBlh->Consultar();
	$id=$array->blh_id;
	$ini=$array->blh_ini;
	$fin=$array->blh_fin;
			$accion='DESCARGAR';
		    $Operacion="DESCARGAR LA FICHA DEL BLOQUE DE HORA CON ID: ".$id.", HORA DE INICIO: ".$ini." Y HORA DE FIN: ".$fin."";
		    $NuevoBlh->guardar_accion($accion,"blo_hor",$Operacion);
    $Ti="FICHA DEL BLOQUE DE HORA";
    $datacreator = array ('Title'=>$Ti,'Author'=>$_SESSION[usuario],'Subject'=>'FICHA DEL BLOQUE DE HORA','Creator'=>'nusi243@hotmail.com','Producer'=>'Ing. Nuvia Sierra');
    $pdf->addInfo($datacreator);
    $pdf->ezStartPageNumbers(550,700,8,'right','',1);
    $pdf->addJpegFromFile('../../Imagenes/BanerGrande.jpg',5,715,600,70);
    $txttit= "\n\n\n\n\n<b>FICHA DEL BLOQUE DE HORA</b>\n\n\n";
    $pdf->ezText($txttit,14,array('justification'=>'center'));
    $optEnca = array('showLines'=>0, 'shaded'=>1, 'xOrientation'=>'center', 'width'=>400, 'fontSize'=>11, 'rowGap'=>2);
	$tituEncabezado = array('Columna1'=>'<b></b>', 'Columna2' =>'');
    $DaEncabezado[] = array_merge(array('Columna1'=>'<b>HORA DE INICIO: </b>'),array('Columna2'=>''.$ini.''));
    $DaEncabezado[] = array_merge(array('Columna1'=>'<b>HORA DE FIN: </b>'),array('Columna2'=>''.$fin.''));
	$pdf->ezTable($DaEncabezado, $tituEncabezado, '', $optEnca);
    $pdf->ezText("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", 14);
	$opt = array('showLines'=>0, 'shaded'=>0, 'xOrientation'=>'right', 'width'=>300, 'fontSize'=>7, 'rowGap'=>1);
	$tituEnca = array('Columna1'=>'<b></b>', 'Columna2' =>'');
    $DaEnca[] = array_merge(array('Columna1'=>'<b>IMPRESO POR: </b>'),array('Columna2'=>$_SESSION[usuario]));
  $dias=time();
    $HORA=date("H:i:s",$dias);
	$FECHA=date("d/m/Y",$dias);
    $DaEnca[] = array_merge(array('Columna1'=>'<b>FECHA DE IMPRESION: </b>'),array('Columna2'=>$FECHA));
    $DaEnca[] = array_merge(array('Columna1'=>'<b>HORA DE IMPRESION: </b>'),array('Columna2'=>$HORA));
	$pdf->ezTable($DaEnca, $tituEnca, '', $opt);
    $pdf->ezStream();
    header("Content-Disposition: attachment; filename=\"FICHA DEL BLOQUE DE HORA $id.pdf\"");
  }?>