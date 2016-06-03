<?php session_start();
require_once('../../fpdf/fpdf.php');
require("../../Clases/class.conexion.php");
include("../../Clases/class.nota.php");
  $clave=explode("*",$_GET[usu]);
  //$array2->hor_id."*".$infrae."*".$pac_id."*".$asi_cod."*".$asi_nom
  $hor_id=$clave[0];
  $pac_id=$clave[2];
  $infrae=$clave[1];
  $asi_cod=$clave[3];
  $asi_nom=$clave[4];
  $dbh_tip=0;
  $NuevoHor = new nota("","",$asi_cod,"","","","",$pac_id,"","","","",$infrae,"");
  $NuevoHor->conec_BD();
  $NuevoHor->conectar_BD();
if($_GET[usu]!="")//si ya selecciono fecha y no es vacia
{
  $res_asi=$NuevoHor->OperacionCualquiera("SELECT DISTINCT(asi_cod), asi_cht, asi_chp, asi_chl FROM asigna WHERE asi_cod='$asi_cod' AND asi_nom='$asi_nom'");
    $asigna=$NuevoHor->ConsultarCualquiera($res_asi);
    $teo=$asigna->asi_cht;
    $pra=$asigna->asi_chp;
    $lab=$asigna->asi_chl;
	$cant_teo=0;
	$cant_pra=0;
	$cant_lab=0;
	$selec_pensum=0;
	$selec_dbh=0;
	$selec_aula=0;
/*	echo "<script>alert(' OJO $cant_teo,$cant_pra,$cant_lab ');</script>";*/
    $resultado=$NuevoHor->Listado_Infrae_Nucleo($infrae);
	$array=$NuevoHor->ConsultarCualquiera($resultado);
	$pac_nom=$NuevoHor->Buscar_pacade1($pac_id);
  $accion='DESCARGAR';
  $Operacion="REPARACION NOTAS: PACADE=".$pac_id." ASI=".$asi_cod." HOR_ID=".$hor_id;
  $NuevoHor->guardar_accion($accion,"detins",$Operacion);
  $ci="";
/*  echo "<script>alert('SELECT DISTINCT (A.esp_id) AS esp_id, A.ci AS ci, B.esp_nom AS esp_nom, A.reg_id AS reg_id, E.reg_nom AS reg_nom, A.mod_id AS mod_id, C.mod_nom AS mod_nom, A.coh_id AS coh_id, D.coh_nom AS coh_nom, A.pac_id AS pac_id, A.sec_id AS sec_id, F.sec_nom AS sec_nom, A.hor_id AS hor_id FROM horario A, especi B, modali C, cohort D, regimen E, seccio F WHERE A.esp_id=B.esp_id AND A.mod_id=C.mod_id AND A.coh_id=D.coh_id AND A.reg_id=E.reg_id AND A.sec_id=F.sec_id AND A.hor_sta =1 AND F.inf_id =$infrae AND A.pac_id = $pac_id AND hor_id=$hor_id');</script>";*/
  $pdf=new FPDF("L","mm","LEGAL");
  $result=$NuevoHor->OperacionCualquiera("SELECT DISTINCT (A.esp_id) AS esp_id, A.ci AS 'ci', B.esp_nom AS esp_nom, A.reg_id AS reg_id, E.reg_nom AS reg_nom, A.mod_id AS mod_id, C.mod_nom AS mod_nom, A.coh_id AS coh_id, D.coh_nom AS coh_nom, A.pac_id AS pac_id, A.sec_id AS sec_id, F.sec_nom AS sec_nom, A.hor_id AS hor_id FROM horario A, especi B, modali C, cohort D, regimen E, seccio F WHERE A.esp_id=B.esp_id AND A.mod_id=C.mod_id AND A.coh_id=D.coh_id AND A.reg_id=E.reg_id AND A.sec_id=F.sec_id AND A.hor_sta = '1' AND F.inf_id = '$infrae' AND A.pac_id = '$pac_id' AND hor_id='$hor_id'");
	  $selec_pensum=$NuevoHor->NumFilasCualquiera($result);
	  $lis_alum="";
	  $lis_alum1="";
      while($array2=$NuevoHor->ConsultarCualquiera($result)){
	    if($ci==""){
		  $ci=$array2->ci;
		  $contar=$NuevoHor->OperacionCualquiera("SELECT COUNT(hor_tpl) AS teo FROM horario WHERE dbh_tip='$dbh_tip' AND pac_id='$pac_id' AND hor_id='$hor_id' AND hor_sta='1' AND ci='$ci' AND hor_tpl='0'");
	      $cuan=$NuevoHor->ConsultarCualquiera($contar);
	      $cant_teo=$cuan->teo;
		  $contar=$NuevoHor->OperacionCualquiera("SELECT COUNT(hor_tpl) AS pra FROM horario WHERE dbh_tip='$dbh_tip' AND pac_id='$pac_id' AND hor_id='$hor_id' AND hor_sta='1' AND ci='$ci' AND hor_tpl='1'");
	      $cuan=$NuevoHor->ConsultarCualquiera($contar);
	      $cant_pra=$cuan->pra;
	      $contar=$NuevoHor->OperacionCualquiera("SELECT COUNT(hor_tpl) AS lab FROM horario WHERE dbh_tip='$dbh_tip' AND pac_id='$pac_id' AND hor_id='$hor_id' AND hor_sta='1' AND ci='$ci' AND hor_tpl='2'");
	      $cuan=$NuevoHor->ConsultarCualquiera($contar);
	      $cant_lab=$cuan->lab;
		  $res_ase=$NuevoHor->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE esp_id='$array2->esp_id' AND mod_id='$array2->mod_id' AND coh_id='$array2->coh_id' AND reg_id='$array2->reg_id' AND sec_id='$array2->sec_id' AND pac_id='$pac_id' AND asi_cod='$asi_cod' AND ci_emp='$ci' AND ase_sta='1'");
		  $arr_ase=$NuevoHor->ConsultarCualquiera($res_ase);
		  $res_fec=$NuevoHor->OperacionCualquiera("SELECT * FROM fe_ci_no WHERE pac_id='$pac_id'");
		  $arr_fec=$NuevoHor->ConsultarCualquiera($res_fec);
/*		  echo "<script>alert('f11 $arr_ase->ase_f11');</script>";*/
		  $result_doc=$NuevoHor->OperacionCualquiera("SELECT * FROM persona WHERE ci='$ci'");
          $array_doc=$NuevoHor->ConsultarCualquiera($result_doc);
		  $ap_nom=strtoupper($array_doc->ap1." ".$array_doc->ap2." ".$array_doc->ap3.", ".$array_doc->no1." ".$array_doc->no2." ".$array_doc->no3);
	}$lis_alum="";
/*	echo "<script>alert('SELECT ci_est FROM detins WHERE esp_id=$array2->esp_id AND mod_id=$array2->mod_id AND coh_id=$array2->coh_id AND reg_id=$array2->reg_id AND sec_id=$array2->sec_id AND pac_id=$pac_id AND asi_cod=$asi_cod AND det_sta=1');</script>";*/
	$res_alu=$NuevoHor->OperacionCualquiera("SELECT ci_est, det_nla, det_con, det_nre, obs_id FROM detins WHERE esp_id='$array2->esp_id' AND mod_id='$array2->mod_id' AND coh_id='$array2->coh_id' AND reg_id='$array2->reg_id' AND sec_id='$array2->sec_id' AND pac_id='$pac_id' AND asi_cod='$asi_cod' AND det_sta='1' AND obs_id!='10'");
    while($arr_alu=$NuevoHor->ConsultarCualquiera($res_alu)){
	  $enc=0;
	  $i=0;
	  while($i<=20 && $enc==0){
	    if($i<10) $n="0".$i; else $n=$i;
		$nota=md5($n);
		if($arr_alu->det_nla==$nota)
	      $enc=1;
		$i++;
	  }
	  $i=$i-1;
	  if($i>=10 && (($arr_alu->det_con==1 && $arr_alu->det_nre!='') || $arr_alu->det_con==0)){
        if($lis_alum==""){
          $lis_alum="'".$arr_alu->ci_est."'";
  		  $lis_alum1="".$arr_alu->ci_est."";
	    }
	    else{
	      $lis_alum=$lis_alum.",'".$arr_alu->ci_est."'";
		  $lis_alum1=$lis_alum1.",".$arr_alu->ci_est."";
	    }
	  }
	}
	if($lis_alum!=""){
	$pdf->AddPage();
/*  echo "<script>alert('SELECT * FROM asigna_seccio WHERE esp_id=$array2->esp_id AND mod_id=$array2->mod_id AND coh_id=$array2->coh_id AND reg_id=$array2->reg_id AND sec_id=$array2->sec_id AND pac_id=$pac_id AND asi_cod=$asi_cod AND ci_emp=$ci AND ase_sta=1');</script>";*/
	$res_ase=$NuevoHor->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE esp_id='$array2->esp_id' AND mod_id='$array2->mod_id' AND coh_id='$array2->coh_id' AND reg_id='$array2->reg_id' AND sec_id='$array2->sec_id' AND pac_id='$pac_id' AND asi_cod='$asi_cod' AND ci_emp='$ci' AND ase_sta='1'");
	$arr_ase=$NuevoHor->ConsultarCualquiera($res_ase);
/*	  echo "<script>alert('SELECT asi_mod, asi_cuc FROM asigna WHERE esp_id=$array2->esp_id AND mod_id=$array2->mod_id AND coh_id=$array2->coh_id AND reg_id=$array2->reg_id AND asi_cod=$asi_cod AND asi_nom=$asi_nom AND asi_sta=1');</script>";*/
	$res_asig=$NuevoHor->OperacionCualquiera("SELECT asi_mod, asi_cuc FROM asigna WHERE esp_id='$array2->esp_id' AND mod_id='$array2->mod_id' AND coh_id='$array2->coh_id' AND reg_id='$array2->reg_id' AND asi_nom='$asi_nom' AND asi_cod='$asi_cod' AND asi_sta='1'");
	$arr_asig=$NuevoHor->ConsultarCualquiera($res_asig);
    $pdf->Image('../../Imagenes/BanerGrande.jpg',75,8,200,25);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetFont('Arial');  // Estilo Regular
    $pdf->Ln(25);
    $pdf->SetFont('Arial','B',12); $pdf->Cell(0,4,'ACTA DE REPARACIÓN',0,1,'C');
    $pdf->Ln(4);
    $pdf->SetFont('Arial','B',9); $pdf->Cell(20,5,'',0,0,'L'); $pdf->Cell(30,5,'NUCLEO: ',0,0,'L'); 
    $pdf->SetFont('Arial','',9); $pdf->Cell(30,5,strtoupper($array->nuc_nom),0,0,'L'); 
    $pdf->SetFont('Arial','B',9); $pdf->Cell(20,5,'',0,0,'L'); $pdf->Cell(30,5,'SEDE: ',0,0,'L'); 
    $pdf->SetFont('Arial','',9); $pdf->Cell(50,5,strtoupper($array->inf_nom),0,0,'L'); 
    $pdf->SetFont('Arial','B',9); $pdf->Cell(30,5,'',0,0,'L'); $pdf->Cell(40,5,'PERÍODO ACADÉMICO: ',0,0,'L'); 
    $pdf->SetFont('Arial','',9); $pdf->Cell(20,5,strtoupper($pac_nom),0,1,'L');
	$ap_nom=$array_doc->ap1." ".$array_doc->ap2." ".$array_doc->ap3.", ".$array_doc->no1." ".$array_doc->no2." ".$array_doc->no3;
    $pdf->SetFont('Arial','B',9); $pdf->Cell(20,5,'',0,0,'L'); $pdf->Cell(30,5,'CÓDIGO: ',0,0,'L');
    $pdf->SetFont('Arial','',9); $pdf->Cell(30,5,strtoupper($asi_cod),0,0,'L');
    $pdf->SetFont('Arial','B',9); $pdf->Cell(20,5,'',0,0,'L'); $pdf->Cell(30,5,'ASIGNATURA: ',0,0,'L');
    $pdf->SetFont('Arial','',9); $pdf->Cell(50,5,strtoupper($asi_nom),0,0,'L');
    $pdf->SetFont('Arial','B',9); $pdf->Cell(30,5,'',0,0,'L'); $pdf->Cell(40,5,'U.C.: ',0,0,'L');
    $pdf->SetFont('Arial','',9); $pdf->Cell(20,5,strtoupper($arr_asig->asi_cuc),0,1,'L');
    $pdf->SetFont('Arial','B',9); $pdf->Cell(20,5,'',0,0,'L'); $pdf->Cell(30,5,$array2->mod_nom,0,0,'L');
    $pdf->SetFont('Arial','',9); $pdf->Cell(30,5,strtoupper($arr_asig->asi_mod),0,0,'L');
    $pdf->SetFont('Arial','B',9); $pdf->Cell(20,5,'',0,0,'L'); $pdf->Cell(30,5,'COHORTE: ',0,0,'L');
    $pdf->SetFont('Arial','',9); $pdf->Cell(50,5,strtoupper($array2->coh_nom),0,0,'L');
    $pdf->SetFont('Arial','B',9); $pdf->Cell(30,5,'',0,0,'L'); $pdf->Cell(40,5,'RÉGIMEN: ',0,0,'L');
    $pdf->SetFont('Arial','',9); $pdf->Cell(20,5,strtoupper($array2->reg_nom),0,1,'L');
    $pdf->SetFont('Arial','B',9); $pdf->Cell(20,5,'',0,0,'L'); $pdf->Cell(30,5,'ESPECIALIDAD: ',0,0,'L');
    $pdf->SetFont('Arial','',9); $pdf->Cell(130,5,strtoupper($array2->esp_nom),0,0,'L');
    $pdf->SetFont('Arial','B',9); $pdf->Cell(30,5,'',0,0,'L'); $pdf->Cell(40,5,'SECCIÓN: ',0,0,'L');
    $pdf->SetFont('Arial','',9); $pdf->Cell(50,5,strtoupper($array2->sec_nom),0,1,'L');
	$pdf->SetFont('Arial','B',9); $pdf->Cell(20,5,'',0,0,'L'); $pdf->Cell(55,5,'DOCUMENTO DE IDENTIFICACIÓN: ',0,0,'L');
	$pdf->SetFont('Arial','',9); $pdf->Cell(5,5,strtoupper($ci),0,0,'L');
	$pdf->SetFont('Arial','B',9); $pdf->Cell(20,5,'',0,0,'L'); $pdf->Cell(50,5,'APELLIDO(S) Y NOMBRE(S): ',0,0,'L');
	$pdf->SetFont('Arial','',9); $pdf->Cell(50,5,strtoupper($ap_nom),0,1,'L');
	$pdf->Ln(2);
    $pdf->SetFont('Arial','B',8);
	$pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102); $pdf->Cell(5,5,"No",1,0,'C',true);
	$pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102); $pdf->Cell(15,5,"CEDULA",1,0,'C',true);
    $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(60,5,"APELLIDO(S) Y NOMBRE(S)",1,0,'C',true);
    $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(40,5,"NOTA FINAL",1,0,'C',true);
    $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(40,5,"NOTA DE REPARACIÓN",1,0,'C',true);
    $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(40,5,"NOTA DEFINITIVA",1,0,'C',true);
    $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(60,5,"NOTA EN LETRA",1,0,'C',true);
    $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(60,5,"OBSERVACIÓN",1,1,'C',true);
/*	  echo "<script>alert('SELECT ci, concat(ap1, ,ap2,, ,no1, ,no2) AS ape FROM persona WHERE ci IN($lis_alum1) AND sta=1 ORDER BY ap1,ap2,no1,no2,ci');</script>";*/
	$res_pers=$NuevoHor->OperacionCualquiera("SELECT ci, concat(ap1,' ',ap2,', ',no1,' ',substr(no2,1,1),'.') AS ape FROM persona WHERE ci IN($lis_alum) AND sta='1' ORDER BY ap1,ap2,no1,no2,ci");
    $k=1;
    $pdf->SetTextColor(0,0,0);
	while($arr_pers=$NuevoHor->ConsultarCualquiera($res_pers)){
	  $let="";
	  $res_detins=$NuevoHor->OperacionCualquiera("SELECT * FROM detins WHERE pac_id='$pac_id' AND asi_cod='$asi_cod' AND det_sta='1' AND ci_est='$arr_pers->ci'");
	  $arr_det=$NuevoHor->ConsultarCualquiera($res_detins);
	  $enc=0;
	  $i=1;
	  while($i<=20 && $enc==0){
  	    if($i<10) $n="0".$i; else $n=$i;
  		  $nota=md5($n);
		if($arr_det->det_nla==$nota)
		  $enc=1;
		$i++;
	  }
	  $i=$i-1;
	  if($i>=10 && (($arr_det->det_con==1 && $arr_det->det_nre!='') || $arr_det->det_con==0)){
	    if($arr_det->det_nre!="")
		  $imp=$arr_det->det_nre;
		else
		  $imp=$arr_det->det_nfi;
		$cond=$arr_det->obs_id;
		$let=$NuevoHor->ConvertirLetra($imp);
		$res_obs=$NuevoHor->OperacionCualquiera("SELECT * FROM observ WHERE obs_id='$cond'");
		$arr_obs=$NuevoHor->ConsultarCualquiera($res_obs);
	    $pdf->SetFont('Arial','',8);
        $pdf->Cell(5,5,$k,1,0,'C');
        $pdf->Cell(15,5,$arr_pers->ci,1,0,'C');
        $pdf->Cell(60,5,strtoupper($arr_pers->ape),1,0,'L');
        $pdf->Cell(40,5,$arr_det->det_nfi,1,0,'C');
        $pdf->Cell(40,5,$arr_det->det_nre,1,0,'C');
        $pdf->Cell(40,5,$arr_det->det_nde,1,0,'C');
        $pdf->Cell(60,5,$let,1,0,'C');
        $pdf->Cell(60,5,$arr_obs->obs_des,1,1,'C');
	    $k++;
	  }
  	}
    $pdf->Ln(20);
    $dias=time();
    $HORA=date("H:i:s",$dias);
    $FECHA=date("d/m/Y",$dias);	
    $pdf->Cell(30,5,'',0,0,'L');$pdf->SetFont('Arial','B',10); $pdf->Cell(125,5,'_______________________________',0,0,'C');
    $pdf->Cell(30,5,'',0,0,'L');$pdf->SetFont('Arial','B',10); $pdf->Cell(125,5,'_______________________________',0,1,'C');
	$pdf->Cell(30,5,'',0,0,'L');$pdf->SetFont('Arial','B',10); $pdf->Cell(125,5,'FIRMA DEL DOCENTE',0,0,'C');
    $pdf->Cell(30,5,'',0,0,'L');$pdf->SetFont('Arial','B',10); $pdf->Cell(125,5,'FIRMA DEL COORDINADOR',0,1,'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial','B',10); $pdf->Cell(150,5,'IMPRESO POR:',0,0,'R');
    $pdf->SetFont('Arial','I',8);  $pdf->Cell(40,5,$_SESSION[usuario],0,0,'L');
    $pdf->Cell(25,5,'',0,0,'L');$pdf->SetFont('Arial','B',10); $pdf->Cell(50,5,'FECHA Y HORA DE IMPRESION:',0,0,'R'); 
    $pdf->SetFont('Arial','I',8);  $pdf->Cell(40,5,$FECHA." ".$HORA,0,1,'L');
	}
  }
  $pdf->Output();
}?>