<?php session_start();
require_once('../../fpdf/fpdf.php');
define('FPDF_FONTPATH','../../fpdf/font/');
require("../../Clases/class.conexion.php");
include("../../Clases/class.cambio_reingreso.php");
$NuevoCamb = new camb("","","","","","","","");
$NuevoCamb->conec_BD();
$NuevoCamb->conectar_BD();
$data=explode("*",$_POST[data_princ]);
$data_sol=explode("*",$_POST[data_sol]);
$cel_x=250;
$cel_y=5;
$cel_y_linea=3;
$tam_cuerp=6;
class PDF extends FPDF
{
  function Header()
  {  
  $NuevoCamb = new camb("","","","","","","","");
  $NuevoCamb->conec_BD();
  $NuevoCamb->conectar_BD();
  $data=explode("*",$_POST[data_princ]);
  $data_sol=explode("*",$_POST[data_sol]);
  $alum=$NuevoCamb->busc_alum($data[0]);
  $ext_alum=$NuevoCamb->ConsultarCualquiera($alum);
  $nuc_carre=$NuevoCamb->busc_nucleo_carrera($data[0],$data[1],$data[4],$data[2],$data[3],$data[5]);
  $ext_nuc_carre=$NuevoCamb->ConsultarCualquiera($nuc_carre);
  $mod_coh_nom_act=$NuevoCamb->busc_mod_coh_nom($data[0],$data[1],$data[4],$data[2],$data[3],$data[5],"valor");
  $ext_mod_coh_nom_act=$NuevoCamb->ConsultarCualquiera($mod_coh_nom_act);
  $mod_coh_nom_ant=$NuevoCamb->busc_mod_coh_nom($data[0],$data_sol[0],$data_sol[1],$data_sol[2],$data_sol[3],$data_sol[4],"valor1");
  $ext_mod_coh_nom_ant=$NuevoCamb->ConsultarCualquiera($mod_coh_nom_ant);
  $dias=time();
  $fecha=date("d/m/Y",$dias);
  $cel_x=250;
  $cel_y=5;
  $tam=9;
  $tam_cuerp=6;
  $this->SetFont('Arial','B',$tam);
  $this->Image('../../IMAG/Escudo.JPG',68,15,15,20); 
  $this->Cell($cel_x,$cel_y,utf8_decode('UNIVERSIDAD NACIONAL EXPERIMENTAL POLITÉCNICA'),0,0,'C'); 
  $this->Ln(3);
  $this->Cell($cel_x,$cel_y,'DE LA FUERZA ARMADA',0,0,'C'); 
  $this->Ln(3);
  $this->Cell($cel_x,$cel_y,'U.N.E.F.A',0,0,'C'); 
  $this->Ln(3);
  $this->Cell($cel_x,$cel_y,utf8_decode('VICERRECTORADO ACADÉMICO'),0,0,'C'); 
  $this->Ln(5);
  $this->Cell($cel_x,12,utf8_decode('ANÁLISIS DE ASIGNATURAS EQUIVALENTES INTERNAS'),0,0,'C');
  $this->Ln(10);
  $this->SetFont('Arial','B',$tam_cuerp);
  $this->Cell($cel_x/14,$cel_y,utf8_decode('Cédula (1)'),1,0,'C');
  $this->Cell($cel_x/4,$cel_y,'Nombres (2)',1,0,'C');
  $this->Cell($cel_x/4,$cel_y,'Apellidos (3)',1,0,'C');
  $this->Cell($cel_x/9,$cel_y,utf8_decode('Núcleo (4)'),1,0,'C');
  $this->Cell($cel_x/4,$cel_y,'Carrera (5)',1,0,'C');
  $this->Cell($cel_x/14,$cel_y,'Fecha (6)',1,0,'C');
  $this->Ln();
  $this->SetFont('Arial','',$tam_cuerp);
  $this->Cell($cel_x/14,$cel_y,$data[0],1,0,'C');
  $this->Cell($cel_x/4,$cel_y,$ext_alum->no1." ".$alum->no2,1,0,'C');
  $this->Cell($cel_x/4,$cel_y,$ext_alum->ap1." ".$alum->ap2,1,0,'C');
  $this->Cell($cel_x/9,$cel_y,$ext_nuc_carre->nuc_nom,1,0,'C');
  $this->Cell($cel_x/4,$cel_y,$ext_nuc_carre->esp_nom,1,0,'C');
  $this->Cell($cel_x/14,$cel_y,$fecha,1,0,'C');
  $this->Ln(8);
  $this->SetFont('Arial','B',$tam_cuerp);
  $this->Cell(85,$cel_y,'Asignatura ( modalidad '.strtolower($ext_mod_coh_nom_act->mod_nom." ".$ext_mod_coh_nom_act->coh_nom).')',1,0,'C');
  $this->Cell(85,$cel_y,'Asignatura Equivalente  ( modalidad '.strtolower($ext_mod_coh_nom_ant->mod_nom." ".$ext_mod_coh_nom_ant->coh_nom).')',1,0,'C');
  $this->Cell(30,$cel_y,utf8_decode('Recomendación (11)'),1,0,'C');
  $this->Cell(51,$cel_y,'OBS. (12)',1,0,'C');
  $this->Ln();
  $this->Cell(20,$cel_y,utf8_decode('Código (7)'),1,0,'C');
  $this->Cell(65,$cel_y,'Asignatura (8)',1,0,'C');
  $this->Cell(65,$cel_y,utf8_decode('Denominación'),1,0,'C');
  $this->Cell(20,$cel_y,utf8_decode('Código'),1,0,'C');
  $this->Cell(30,$cel_y,'',1,0,'C');
  $this->Cell(51,$cel_y,'',1,0,'C');
  $this->Ln();
  }
  function Footer()
  {
  $this->SetY(-15);
  $this->SetFont('Arial','',8);
  $this->Cell(40,5,'VAC-DA-EQUIV.FOM.003',0,0,'L');
  $this->Cell(180,5,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
  }
}
#####################CUERPO DEL PDF##################################
  //if($_GET["resp"]!=""){
  $pdf = new PDF('L','mm','Letter');
  $pdf->SetTopMargin(15);
  $pdf->SetLeftMargin(15);
  $pdf->SetRightMargin(15);
  $pdf->SetAutoPageBreak("true",30);
  $pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf->SetFont('Arial','',$tam_cuerp);
  $bus_asi_cod_detins=$NuevoCamb->consul_asi_cod($_POST[data_princ]);
  while($ext_bus_asi_cod_detins=$NuevoCamb->ConsultarCualquiera($bus_asi_cod_detins)){
  $bus_asi_cod_eq=$NuevoCamb->consul_asi_cod_eq($_POST[data_princ],$data_sol[0],$data_sol[1],$data_sol[2],$data_sol[3],$data_sol[4],$ext_bus_asi_cod_detins->asi_cod);
  $cont=0;
  $row=1;
    if($NuevoCamb->NumFilas1($bus_asi_cod_eq)>1)
	$row=$NuevoCamb->NumFilas1($bus_asi_cod_eq);
  $pdf->Cell(20,$cel_y*$row,$ext_bus_asi_cod_detins->asi_cod,1,0,'C');
  $pdf->Cell(65,$cel_y*$row,$ext_bus_asi_cod_detins->asi_nom,1,0,'C');
    while($ext_bus_asi_cod_eq=$NuevoCamb->ConsultarCualquiera($bus_asi_cod_eq)){
	$consul_nom_asi_eq=$NuevoCamb->consul_nom_asi_cod($_POST[data_princ],$data_sol[0],$data_sol[1],$data_sol[2],$data_sol[3],$data_sol[4],$ext_bus_asi_cod_eq->asi_cod_eq);
	$ext_consul_nom_asi_eq=$NuevoCamb->ConsultarCualquiera($consul_nom_asi_eq);
	$obs=$NuevoCamb->observ($data[0]);
	$ext_obs=$NuevoCamb->ConsultarCualquiera($obs);
	  if($cont==0){
	  $pdf->Cell(65,$cel_y,$ext_consul_nom_asi_eq->asi_nom,1,0,'C');
	  $pdf->Cell(20,$cel_y,$ext_consul_nom_asi_eq->asi_cod,1,0,'C');
	  $pdf->Cell(30,$cel_y,'APROBAR',1,0,'C');
      $pdf->Cell(51,$cel_y,$ext_obs->his_des,1,0,'C');
	  $pdf->Ln();
	  $cont++;
	  }
	  else{
	  $pdf->Cell(20,$cel_y,'',0,0,'C');
	  $pdf->Cell(65,$cel_y,'',0,0,'C');
	  $pdf->Cell(65,$cel_y,$ext_consul_nom_asi_eq->asi_nom,1,0,'C');
	  $pdf->Cell(20,$cel_y,$ext_consul_nom_asi_eq->asi_cod,1,0,'C');
	  $pdf->Cell(30,$cel_y,'APROBAR',1,0,'C');
      $pdf->Cell(51,$cel_y,$ext_obs->his_des,1,0,'C');
	  $cont++;
	  $pdf->Ln();
	  }
	}
  }
  $pdf->Ln(30);
  $pdf->SetFont('Arial','B',$tam_cuerp);
  $pdf->Cell(20,$cel_y,'','0',0,'C');
  $pdf->Cell(($cel_x/3)-20,$cel_y,'ESTUDIANTE','T',0,'C');
  $pdf->Cell(10,$cel_y,'','0',0,'C');
  $pdf->Cell(($cel_x/3)-20,$cel_y,'JEFE DE DEPARTAMENTO DE CARRERA','T',0,'C');
  $pdf->Cell(10,$cel_y,'','0',0,'C');
  $pdf->Cell(($cel_x/3)-20,$cel_y,utf8_decode('DR. JUAN MANUEL GONZÁLEZ'),'T',0,'C');
  $pdf->Cell(20,$cel_y,'','0',0,'C');
  $pdf->Ln(3);
  $pdf->Cell(20,$cel_y,'','0',0,'C');
  $pdf->Cell(($cel_x/3)-20,$cel_y,'',0,0,'C');
  $pdf->Cell(10,$cel_y,'','0',0,'C');
  $pdf->Cell(($cel_x/3)-20,$cel_y,'',0,0,'C');
  $pdf->Cell(10,$cel_y,'','0',0,'C');
  $pdf->Cell(($cel_x/3)-20,$cel_y,utf8_decode('JEFE DE DIVISIÓN ACADÉMICA'),0,0,'C');
  $pdf->Cell(20,$cel_y,'','0',0,'C');
  $pdf->Output();
  //}
?>