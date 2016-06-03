<?php session_start();
  require_once('../../fpdf/fpdf.php');
  require("../../Clases/class.conexion.php");
  include("../../Clases/class.nota_nueva.php");
  $_SESSION[usu_id]=$_GET[usu];
  $clave=explode("*",$_GET[usu]);
  $pac_id=$clave[0];
  $ci_doc=$clave[1];
  $hor_id=$clave[2];
  $ase_id=$clave[3];
  $nucleo="";
  $infrae="";
  $dbh_tip=0;
  $NuevoHor = new nota("","","","","","","",$pac_id,"","","","","","");
  $NuevoHor->conec_BD();
  $NuevoHor->conectar_BD();
  if($_SESSION[ci]!="")//si ya selecciono fecha y no es vacia
  {
    $ci=$ci_doc;
    $pac_nom=$NuevoHor->Buscar_pacade1($pac_id);
    $info_resp=$NuevoHor->Buscar_docente_matricula($ci_doc);
    $dat_doc=$NuevoHor->Buscar_docente1($ci_doc);
    $accion='DESCARGAR';
    $Operacion="NOTAS: PACADE=".$pac_id." ASI=".$asi_cod." HOR_ID=".$hor_id;
    $NuevoHor->guardar_accion($accion,"detins",$Operacion);
    $pdf=new FPDF("L","mm","LEGAL");
    $h_t=0;
	$h_p=0;
	$h_l=0;
	$lab_pra=0;
	$num=0;
	$selec_pensum=0;
	$selec_dbh=0;
	$selec_aula=0;
	$cant_ins=0;
	$result=$NuevoHor->Buscar_oferta_todas($ase_id);
	$cant_sec_sel=$NuevoHor->NumFilasCualquiera($result);
/*	echo "<script>alert('NUMERO DE FILAS $cant_sec_sel ase_id: $lis_sec');</script>";*/
    if($cant_sec_sel!=0){
	  $encontre=0;
	  while($array_asi=$NuevoHor->ConsultarCualquiera($result)){
	    if($lab_pra==0 && $array_asi->asi_lab!='0'){
	      $lab_pra=1;
	    }
	    if($h_t==0 && $array_asi->asi_cht!='0'){
	      $h_t=$array_asi->asi_cht;
	    }
	    if($h_p==0 && $array_asi->asi_chp!='0'){
	      $h_p=$array_asi->asi_chp;
		}
		if($h_l==0 && $array_asi->asi_chl!='0'){
		  $h_l=$array_asi->asi_chl;
		}
		if($infrae==""){
		  $infrae=$array_asi->inf_id;
		}
		$inf_id=$array_asi->inf_id;
		$asi_cod=$array_asi->asi_cod;
		$asi_nom=$array_asi->asi_nom;
		$mod_id=$array_asi->mod_id;
		$esp_id=$array_asi->esp_id;
		$reg_id=$array_asi->reg_id;
		$coh_id=$array_asi->coh_id;
		$sec_id=$array_asi->sec_id;
		$ele_nom=explode("(",$array_asi->ele_nom);
		if($array_asi->ele_nom=='NINGUNA')
		  $asigna=$array_asi->asi_nom;
		else
		  $asigna=$array_asi->asi_nom." ".$ele_nom[0];
		$contar_ins=$NuevoHor->Contar_Inscritos($asi_cod,$mod_id,$esp_id,$reg_id,$coh_id,$sec_id);
		$cant_ins=intval($cant_ins)+intval($contar_ins);
		if($contar_ins>0){
		  if($encontre==0){
/*		  echo "<script>alert('SELECT A.asd_tpl, A.ci_doc, B.mod_id, B.esp_id, B.reg_id, B.coh_id, B.pen_top, B.asi_cod, B.sec_id, B.ci_emp, B.ci_doc_pol, B.pac_id, B.asi_nom, B.asi_lab, B.asi_chp, B.asi_cht, B.asi_chl, A.asd_p11, A.asd_p12, A.asd_p13, A.asd_p21, A.asd_p22, A.asd_p23, A.asd_p31, A.asd_p32, A.asd_p33, A.asd_f11, A.asd_f12, A.asd_f13, A.asd_f21, A.asd_f22, A.asd_f23, A.asd_f31, A.asd_f32, A.asd_f33, B.ase_pte, B.ase_pla FROM asigna_seccio_docent AS A RIGHT JOIN (SELECT C.mod_id, C.esp_id, C.reg_id, C.coh_id, C.pen_top, C.asi_cod, C.sec_id, C.ci_emp, C.ci_doc_pol, C.pac_id, D.asi_nom, D.asi_lab, D.asi_chp, D.asi_cht, D.asi_chl, C.ase_pte, C.ase_pla, C.ase_id FROM asigna_seccio C, asigna D WHERE C.ase_id=$ase_id AND (C.ci_emp=$ci OR C.ci_doc_pol=$ci) AND C.ase_sta=1 AND C.mod_id=D.mod_id AND C.coh_id=D.coh_id AND C.pen_top=D.pen_top AND C.esp_id=D.esp_id AND C.reg_id=D.reg_id AND C.asi_cod=D.asi_cod AND D.asi_sta=1) AS B ON A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.asd_sta=1 AND (B.ci_emp=A.ci_doc OR B.ci_doc_pol=A.ci_doc) GROUP BY B.ase_id');</script>";*/
		    $resul_seccio=$NuevoHor->OperacionCualquiera("SELECT A.asd_tpl AS 'asd_tpl', A.ci_doc AS 'ci_doc', B.mod_id AS 'mod_id', B.esp_id AS 'esp_id', B.reg_id AS 'reg_id', B.coh_id AS 'coh_id', B.pen_top AS 'pen_top', B.asi_cod AS 'asi_cod', B.sec_id AS 'sec_id', B.ci_emp AS 'ci_emp', B.ci_doc_pol AS 'ci_doc_pol', B.pac_id AS 'pac_id', B.asi_nom AS 'asi_nom', B.asi_lab AS 'asi_lab', B.asi_chp AS 'asi_chp', B.asi_cht AS 'asi_cht', B.asi_chl AS 'asi_chl', A.asd_p11 AS 'asd_p11', A.asd_p12 AS 'asd_p12', A.asd_p13 AS 'asd_p13', A.asd_p21 AS 'asd_p21', A.asd_p22 AS 'asd_p22', A.asd_p23 AS 'asd_p23', A.asd_p31 AS 'asd_p31', A.asd_p31 AS 'asd_p31', A.asd_p33 AS 'asd_p33', A.asd_f11 AS 'asd_f11', A.asd_f12 AS 'asd_f12', A.asd_f13 AS 'asd_f13', A.asd_f21 AS 'asd_f21', A.asd_f22 AS 'asd_f22', A.asd_f23 AS 'asd_f23', A.asd_f31 AS 'asd_f31', A.asd_f32 AS 'asd_f32', A.asd_f33 AS 'asd_f33', B.ase_pte AS 'ase_pte', B.ase_pla AS 'ase_pla' FROM asigna_seccio_docent AS A RIGHT JOIN (SELECT C.mod_id, C.esp_id, C.reg_id, C.coh_id, C.pen_top, C.asi_cod, C.sec_id, C.ci_emp, C.ci_doc_pol, C.pac_id, D.asi_nom, D.asi_lab, D.asi_chp, D.asi_cht, D.asi_chl, C.ase_pte, C.ase_pla, C.ase_id FROM asigna_seccio C, asigna D WHERE C.ase_id='$ase_id' AND (C.ci_emp='$ci' OR C.ci_doc_pol='$ci') AND C.ase_sta='1' AND C.mod_id=D.mod_id AND C.coh_id=D.coh_id AND C.pen_top=D.pen_top AND C.esp_id=D.esp_id AND C.reg_id=D.reg_id AND C.asi_cod=D.asi_cod AND D.asi_sta='1') AS B ON A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.asd_sta='1' AND (B.ci_emp=A.ci_doc OR B.ci_doc_pol=A.ci_doc) AND A.ci_doc='$ci' AND A.pac_id='$pac_id' GROUP BY B.ase_id");
		    $Fila=$NuevoHor->NumFilasCualquiera($resul_seccio);
/*  echo "<script>alert('FILAS: $Fila');</script>";*/
		    $sec_array=$NuevoHor->ConsultarCualquiera($resul_seccio);
		    $por_teo=$sec_array->ase_pte;
		    $por_lab=$sec_array->ase_pla;
		    $nom2="";
            $doc_teo="";
		    if(intval($sec_array->ase_pte)==intval('100')){
		      $cual=1;
              $doc_teo=1;
		    }
		    else{
		      if(intval($sec_array->ci_doc_pol)==intval($sec_array->ci_emp) || intval($sec_array->asd_tpl)==4 || intval($sec_array->asd_tpl)==5 || intval($sec_array->asd_tpl)==6 || (intval($sec_array->asd_tpl)==3 && intval($sec_array->asi_lab)==1)){
		        $cual=2;
                $doc_teo=1;
		      }
		      else{
		        $cual=3;
				if(intval($sec_array->ci_doc)==intval($sec_array->ci_emp))
	              $doc_teo=1;
         	    else
	              $doc_teo=0;
		      }
		    }
		    if(intval($sec_array->asd_tpl)==intval(0)){
								    $columnas=1;
		      $nom="TEORÍA";
/*	if(intval($sec_array->ci_doc)==intval('82021694')) echo "<script>alert('cual $cual!=1 $h_p==0');</script>";*/
		  	  if($cual!=1){ $nom0="TEO"; $nom1="TEOR&Iacute;A"; 
		        if($h_p==0){$nom2="LABORATORIO"; $nom3="LAB";}
		  	    else{$nom2="PRÁCTICA"; $nom3="PRA";}
		  	  }
		    }
		    else{
		      if(intval($sec_array->asd_tpl)==intval(1)){
								    $columnas=1;
		  	    $nom="PR&Aacute;CTICA";
		  	    if($cual!=1){
		  	      if($h_t==0){$nom0="PRA"; $nom1="PRÁCTICA"; $nom2="LABORATORIO"; $nom3="LAB";}
		  		  else{
		  		    $nom0="TEO"; $nom1="TEORÍA"; $nom2="PRÁCTICA"; $nom3="PRA";
		  		  }
		  	    }
		  	  }
		  	  else{
		  	    if(intval($sec_array->asd_tpl)==intval(2)){
								    $columnas=1;
		  	      $nom="LABORATORIO";
		  	      if($cual!=1){ 
		  		    if($h_p==0){$nom0="TEO"; $nom1="TEORÍA";}
		  		    else{
		  		      $nom0="TEO/PRA"; $nom1="TEORÍA Y PRÁCTICA";
		  		    }
		  		    $nom2="LABORATORIO"; $nom3="LAB";
		  	      }	
		  	    }
		  	    else{
		  	      if(intval($sec_array->asd_tpl)==intval(3)){
								    $columnas=2;
		  	        $nom="TEORÍA Y PRÁCTICA";
		  		    if($cual==2){ $nom0="TEO"; $nom1="TEOR&Iacute;A"; $nom2="PR&Aacute;CTICA"; $nom3="PRA";}
		  	      }
		  		  else{
		  		    if(intval($sec_array->asd_tpl)==intval(4)){
								    $columnas=2;
		  	          $nom="TEORÍA Y LABORATORIO";
		  		      if($cual==2){ $nom0="TEO"; $nom1="TEORÍA"; $nom2="LABORATORIO"; $nom3="LAB";}
		  	        }
		  		    else{
		  		      if(intval($sec_array->asd_tpl)==intval(5)){
								    $columnas=3;
		  	            $nom="TEORÍA, PRÁCTICA Y LABORATORIO";
		    	  	    if($cual==2){ $nom0="TEO-PRAC"; $nom1="TEORÍA Y PRÁCTICA"; $nom2="LABORATORIO"; $nom3="LAB";} 
		  	          }
		  			  else{
								    $columnas=2;
		  	            $nom="PRÁCTICA Y LABORATORIO";
		  			    if($cual==2){ $nom0="PRAC"; $nom1="PRÁCTICA"; $nom2="LABORATORIO"; $nom3="LAB";}
		  			  }
		  	        }	
		  	      }
		  	    }
		  	  }
		    }
		    $encontre=1;
/*			echo "<script>alert('FECHAS $sec_array->asd_f11, $sec_array->asd_f12, $sec_array->asd_f13, $sec_array->asd_f21, $sec_array->asd_f22, $sec_array->asd_f23, $sec_array->asd_f31, $sec_array->asd_f32, $sec_array->asd_f33');</script>";*/
		    if($sec_array->asd_f11!="") $fech11=$NuevoHor->fechaNormal($sec_array->asd_f11); else $fech11="";
            if($sec_array->asd_f12!="") $fech12=$NuevoHor->fechaNormal($sec_array->asd_f12); else $fech12="";
		    if($sec_array->asd_f13!="") $fech13=$NuevoHor->fechaNormal($sec_array->asd_f13); else $fech13="";
		    if($sec_array->asd_f21!="") $fech21=$NuevoHor->fechaNormal($sec_array->asd_f21); else $fech21="";
		    if($sec_array->asd_f22!="") $fech22=$NuevoHor->fechaNormal($sec_array->asd_f22); else $fech22="";
		    if($sec_array->asd_f23!="") $fech23=$NuevoHor->fechaNormal($sec_array->asd_f23); else $fech23="";
		    if($sec_array->asd_f31!="") $fech31=$NuevoHor->fechaNormal($sec_array->asd_f31); else $fech31="";
		    if($sec_array->asd_f32!="") $fech32=$NuevoHor->fechaNormal($sec_array->asd_f32); else $fech32="";
		    if($sec_array->asd_f33!="") $fech33=$NuevoHor->fechaNormal($sec_array->asd_f33); else $fech33="";
/*			echo "<script>alert('FECHAS A NORMAL $fech11, $sfech12, $fech13, $fech21, $sfech22, $fech23, $fech31, $sfech32, $fech33');</script>";*/
		  }
	      $pdf->AddPage();
          $pdf->Image('../../Imagenes/BanerGrande.jpg',78,2,200,25);
          $pdf->SetFont('Arial','B',10);
          $pdf->SetFont('Arial');  // Estilo Regular
          $pdf->Ln(19);
          $pdf->SetFont('Arial','B',10); $pdf->Cell(0,4,utf8_decode('ACTA DE INASISTENCIA'." ".$nom),0,1,'C');
          $pdf->Ln(1);
          $pdf->SetFont('Arial','B',8); $pdf->Cell(20,4,'',0,0,'L'); $pdf->Cell(30,4,utf8_decode('NUCLEO: '),0,0,'L'); 
          $pdf->SetFont('Arial','',8); $pdf->Cell(30,4,strtoupper($array_asi->nuc_nom),0,0,'L'); 
          $pdf->SetFont('Arial','B',8); $pdf->Cell(20,4,'',0,0,'L'); $pdf->Cell(30,4,utf8_decode('SEDE: '),0,0,'L'); 
          $pdf->SetFont('Arial','',8); $pdf->Cell(50,4,strtoupper($array_asi->inf_nom),0,0,'L'); 
          $pdf->SetFont('Arial','B',8); $pdf->Cell(30,4,'',0,0,'L'); $pdf->Cell(40,4,utf8_decode('PERÍODO ACADÉMICO: '),0,0,'L'); 
          $pdf->SetFont('Arial','',8); $pdf->Cell(20,4,strtoupper($pac_nom),0,0,'L');
          $pdf->SetFont('Arial','B',8); $pdf->Cell(20,4,'',0,0,'L'); $pdf->Cell(20,4,utf8_decode('RÉGIMEN: '),0,0,'L');
          $pdf->SetFont('Arial','',8); $pdf->Cell(30,4,strtoupper($array_asi->reg_nom),0,1,'L');
		  
          $pdf->SetFont('Arial','B',8); $pdf->Cell(20,4,'',0,0,'L'); $pdf->Cell(30,4,utf8_decode('CÓDIGO: '),0,0,'L');
          $pdf->SetFont('Arial','',8); $pdf->Cell(30,4,strtoupper($asi_cod),0,0,'L');
          $pdf->SetFont('Arial','B',8); $pdf->Cell(20,4,'',0,0,'L'); $pdf->Cell(30,4,utf8_decode('ASIGNATURA: '),0,0,'L');
          $pdf->SetFont('Arial','',8); $pdf->Cell(50,4,strtoupper($asigna),0,0,'L');
          $pdf->SetFont('Arial','B',8); $pdf->Cell(30,4,'',0,0,'L'); $pdf->Cell(40,4,utf8_decode('U.C.:        '),0,0,'R');
          $pdf->SetFont('Arial','',8); $pdf->Cell(20,4,strtoupper($array_asi->asi_cuc),0,0,'L');
          $pdf->SetFont('Arial','B',8); $pdf->Cell(20,4,'',0,0,'L'); $pdf->Cell(20,4,$array_asi->mod_nom,0,0,'L');
          $pdf->SetFont('Arial','',8); $pdf->Cell(30,4,strtoupper($array_asi->asi_mod),0,1,'L');
		  
          $pdf->SetFont('Arial','B',8); $pdf->Cell(20,4,'',0,0,'L'); $pdf->Cell(30,4,utf8_decode('ESPECIALIDAD: '),0,0,'L');
          $pdf->SetFont('Arial','',8); $pdf->Cell(130,4,strtoupper($array_asi->esp_nom),0,0,'L');
          $pdf->SetFont('Arial','B',8); $pdf->Cell(30,4,'',0,0,'L'); $pdf->Cell(40,4,utf8_decode('SECCIÓN:        '),0,0,'R');
          $pdf->SetFont('Arial','',8); $pdf->Cell(20,4,strtoupper($array_asi->sec_nom),0,0,'L');
          $pdf->SetFont('Arial','B',8); $pdf->Cell(20,4,'',0,0,'L'); $pdf->Cell(20,4,utf8_decode('COHORTE: '),0,0,'L');
          $pdf->SetFont('Arial','',8); $pdf->Cell(30,4,strtoupper($array_asi->coh_nom),0,1,'L');
		  
          $pdf->SetFont('Arial','B',8); $pdf->Cell(20,4,'',0,0,'L'); $pdf->Cell(55,4,utf8_decode('DOCUMENTO DE IDENTIFICACIÓN: '),0,0,'L');
          $pdf->SetFont('Arial','',8); $pdf->Cell(5,4,strtoupper($ci_doc),0,0,'L');
          $pdf->SetFont('Arial','B',8); $pdf->Cell(20,4,'',0,0,'L'); $pdf->Cell(50,4,utf8_decode('APELLIDO(S) Y NOMBRE(S): '),0,0,'L');
          $pdf->SetFont('Arial','',8); $pdf->Cell(50,4,strtoupper($dat_doc->nombre),0,1,'L');
          $pdf->Ln(1);
      $pdf->SetFont('Arial','B',8);
      $pdf->Cell(1,4,'',0,0,'L');
	  $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102); $pdf->Cell(5,4,"",0,0,'C');
	  $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102); $pdf->Cell(15,4,"",0,0,'C');
      $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(60,4,"",0,0,'C');
      $resP_PSEM=$NuevoHor->OperacionCualquiera("SELECT * FROM pacade WHERE pac_id='$pac_id' AND pac_sta='1'");
      $pacade_sem=$NuevoHor->ConsultarCualquiera($resP_PSEM);
	  $tot_sem=$pacade_sem->pac_sem;
/*	  $columnas=2;
	  if($sec_array->asi_lab=='1')
	    $columnas=3;*/
	  $ancho=$columnas*5;
	  $TOT_DIAS=$columnas*$tot_sem;
	  $sem=1;
	  while($sem<=$tot_sem){
	    $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell($ancho,4,"S".$sem."",1,0,'C',true); 
	    $sem++;
	  }
 	  $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(25,4,"",0,1,'C');
      $pdf->Cell(1,4,'',0,0,'L');
	  $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102); $pdf->Cell(5,4,utf8_decode("No"),1,0,'C',true);
	  $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102); $pdf->Cell(15,4,utf8_decode("CEDULA"),1,0,'C',true);
      $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(60,4,utf8_decode("APELLIDO(S) Y NOMBRE(S)"),1,0,'C',true);
	  $sem=1;
	  while($sem<=$tot_sem){
		if(intval($sec_array->asd_tpl)==intval(0)){
        $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(5,4,"T",1,0,'C',true);
		}
		else{
		  if(intval($sec_array->asd_tpl)==intval(1)){
            $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(5,4,"P",1,0,'C',true);
		  }
		  else{
		    if(intval($sec_array->asd_tpl)==intval(2)){
              $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(5,4,"L",1,0,'C',true);
		    }
		    else{
		      if(intval($sec_array->asd_tpl)==intval(3)){
                $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(5,4,"T",1,0,'C',true);
                $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(5,4,"P",1,0,'C',true);
		      }
		      else{
		        if(intval($sec_array->asd_tpl)==intval(4)){
                  $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(5,4,"T",1,0,'C',true);
                  $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(5,4,"L",1,0,'C',true);
		        }
		        else{
		          if(intval($sec_array->asd_tpl)==intval(5)){
                    $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(5,4,"T",1,0,'C',true);
                    $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(5,4,"P",1,0,'C',true);
                    $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(5,4,"L",1,0,'C',true);
		          }
		          else{
		            if(intval($sec_array->asd_tpl)==intval(6)){
                      $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(5,4,"P",1,0,'C',true);
                      $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(5,4,"L",1,0,'C',true);
		            }
			      }
			    }
			  }
			}
		  }
		}
	    $sem++;
	  }
 	  $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(0,0,102);$pdf->Cell(45,4,utf8_decode("OBSERVACIÓN"),1,1,'C',true);

          $res_pers=$NuevoHor->OperacionCualquiera("SELECT C.ci AS 'ci', UPPER(CONCAT(C.ap1,' ',INSERT(MID(C.ap2,1,1),2,100,'.'),', ',C.no1,' ',INSERT(MID(C.no2,1,1),2,100,'.'))) AS 'ape', A.det_n11 AS 'det_n11', A.det_n12 AS 'det_n12', A.det_n13 AS 'det_n13', A.det_n21 AS 'det_n21', A.det_n22 AS 'det_n22', A.det_n23 AS 'det_n23', A.det_n31 AS 'det_n31', A.det_n32 AS 'det_n32', A.det_n33 AS 'det_n33', A.det_nte AS 'det_nte', A.det_npl11 AS 'det_npl11', A.det_npl12 AS 'det_npl12', A.det_npl13 AS 'det_npl13', A.det_npl21 AS 'det_npl21', A.det_npl22 AS 'det_npl22', A.det_npl23 AS 'det_npl23', A.det_npl31 AS 'det_npl31', A.det_npl32 AS 'det_npl32', A.det_npl33 AS 'det_npl33', A.det_nla AS 'det_nla', A.det_nfi AS 'det_nfi', A.det_nre AS 'det_nre', A.det_nde AS 'det_nde', A.det_con AS 'det_con', A.obs_id AS 'obs_id', A.det_id AS 'det_id' FROM detins A, matric B, persona C WHERE A.asi_cod='$asi_cod' AND A.mod_id='$mod_id' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.coh_id='$coh_id' AND A.sec_id='$sec_id' AND A.pac_id='$pac_id' AND A.ci_est=B.ci AND B.ci=C.ci AND A.mod_id=B.mod_id AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top  AND B.matr_tip='0' AND A.det_sta='1' AND B.matr_sta='1' AND C.sta='1' ORDER BY ape,C.ci");
          $num_alu=$NuevoHor->NumFilasCualquiera($res_pers);
          $pdf->SetTextColor(0,0,0);	
		  $k=1;	  
		  while($arr_det=$NuevoHor->ConsultarCualquiera($res_pers)){
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(1,4,'',0,0,'L');
        $pdf->Cell(5,4,$k,1,0,'C');
        $pdf->Cell(15,4,$arr_det->ci,1,0,'C');
        $pdf->Cell(60,4,strtoupper($arr_det->ape),1,0,'L');
	    $sem=1;
		$num_dias=1;
	    while($num_dias<=$TOT_DIAS){
          $pdf->Cell(5,4," ",1,0,'C');
	      $num_dias++;
	    }
	    if($arr_det->obs_id=='10'){
		  $res_obs=$NuevoHor->OperacionCualquiera("SELECT * FROM observ WHERE obs_id='$arr_det->obs_id'");
          $arr_obs=$NuevoHor->ConsultarCualquiera($res_obs);
 	      $pdf->SetTextColor(255,255,255); $pdf->SetFillColor(153,0,0); $pdf->Cell(45,4,$arr_obs->obs_des,1,1,'L',true);
	    }
	    else{
	      $pdf->SetTextColor(0,0,0); $pdf->SetFillColor(255,255,255); $pdf->Cell(45,4," ",1,1,'C');
	    }		  
	        $k++;
  	      }  
        $pdf->Ln(8);
        $dias=time();
        $HORA=date("H:i:s",$dias);
        $FECHA=date("d/m/Y",$dias);
        $pdf->Cell(30,4,'',0,0,'L');$pdf->SetFont('Arial','B',10); $pdf->Cell(60,4,'_______________________________',0,0,'C');
        $pdf->Cell(30,5,'',0,0,'L');$pdf->SetFont('Arial','B',10); $pdf->Cell(80,5,'_______________________________',0,0,'C');
        $pdf->Cell(30,6,'',0,0,'L');$pdf->SetFont('Arial','B',10); $pdf->Cell(60,6,'',0,1,'C');
        $pdf->Cell(30,4,'',0,0,'L');$pdf->SetFont('Arial','B',10); $pdf->Cell(60,4,utf8_decode('FIRMA DEL DOCENTE'),0,0,'C');
        $pdf->Cell(30,5,'',0,0,'L');$pdf->SetFont('Arial','B',10); $pdf->Cell(80,5,utf8_decode('FIRMA DEL COORDINADOR'),0,0,'C');
        $pdf->Cell(30,6,'',0,0,'L');$pdf->SetFont('Arial','B',10); $pdf->Cell(60,6,utf8_decode('SELLO DE LA DIVISIÓN ACADÉMICA'),0,1,'C');
        $pdf->Ln(2);
        $pdf->SetFont('Arial','B',8); $pdf->Cell(175,4,utf8_decode('IMPRESO POR:'),0,0,'R');
        $pdf->SetFont('Arial','I',8);  $pdf->Cell(40,4,$_SESSION[usuario],0,0,'L');
        $pdf->Cell(25,4,'',0,0,'L');$pdf->SetFont('Arial','B',8); $pdf->Cell(50,4,utf8_decode('FECHA Y HORA DE IMPRESION:'),0,0,'R'); 
        $pdf->SetFont('Arial','I',8);  $pdf->Cell(40,4,$FECHA." ".$HORA,0,1,'L');
		}
      }
    }
    $pdf->Output();
  }?>