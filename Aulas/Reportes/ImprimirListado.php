<?php session_start();
  require_once('../../Funciones/Clases PDF/class.ezpdf.php');
  require("../../Clases/class.conexion.php");
  include("../../Clases/class.aula.php");
  $NuevoAul = new aula("","","","","");
  $NuevoAul->conec_BD();
  $NuevoAul->conectar_BD();
			$accion='DESCARGAR';
		    $Operacion="DESCARGAR LISTADO DE AULAS";	
		    $NuevoAul->guardar_accion($accion,"aulas",$Operacion);
  $pdf =& new Cezpdf('LETTER','');
  $pdf->selectFont('../../Funciones/Clases PDF/fonts/Times-Roman.afm');
  $pdf->ezSetCmMargins('3','1','2','2');
  $Ti="LISTADO DE AULAS";
  $datacreator = array ('Title'=>$Ti,'Author'=>$_SESSION[usuario],'Subject'=>'LISTA DE AULAS','Creator'=>'nusi243@hotmail.com','Producer'=>'Ing. Nuvia Sierra');
  $pdf->addInfo($datacreator);
  $pdf->ezStartPageNumbers(550,700,8,'right','',1);
  $pdf->addJpegFromFile('../../Imagenes/BanerGrande.jpg',5,715,600,70);
  $txttit= "\n\n\n<b>LISTADO DE AULAS</b>\n\n\n";
  $pdf->ezText($txttit,14,array('justification'=>'center'));
  $optEnca = array('showLines'=>0, 'shaded'=>1, 'xOrientation'=>'center', 'width'=>400, 'fontSize'=>11, 'rowGap'=>2);
  $tituEncabezado = array('Columna1'=>'<b>NUCLEO</b>', 'Columna2' =>'<b>INFRAESTRUCTURA</b>', 'Columna3' =>'<b>AULA</b>');
  if(!isset($_GET[nucleo]) || ($_GET[nucleo]=='' && $_GET[infrae]=='')){
    $nucleo=0;
	$infrae=0;
    $total=$NuevoAul->Contar_aula_Todas();
    $NuevoAul->Listado_aula_Todas(0,$total);
  }
  else{  
    if($_GET[infrae]=='' && $_GET[nucleo]!=''){
	  $total=$NuevoAul->Contar_aula_Nucleo_Todas($_GET[nucleo]);
      $NuevoAul->Listado_aula_Nucleo_Todas($_GET[nucleo],0,$total);
	}
	else{
      $total=$NuevoAul->Contar_aula_Nucleo_Infrae($_GET[nucleo],$_GET[infrae]);
      $NuevoAul->Listado_aula_Nucleo_Infrae($_GET[nucleo],$_GET[infrae],0,$total);
	}
  }  
  while($array=$NuevoAul->Consultar()){
    $DaEncabezado[] = array_merge(array('Columna1'=>''.$array->nuc_nom.''),array('Columna2'=>''.$array->inf_nom.''),array('Columna3'=>''.$array->aul_nom.''));
  }
  $pdf->ezTable($DaEncabezado, $tituEncabezado, '', $optEnca);
  $pdf->ezText("\n\n\n\n", 14);
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
  header("Content-Disposition: attachment; filename=\"LISTADO DE AULAS.pdf\"");?>