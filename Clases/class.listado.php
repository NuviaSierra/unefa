<?php session_start();
class listado extends conec_BD
{
    var $pac_id='';
    var $coh_id='';
    var $mod_id='';
    var $reg_id='';
    var $esp_id='';
    var $pen_top='';
    var $asi_cod='';
    var $sec_id='';
    var $ele_cod='';
    var $ci_emp='';
    var $ase_sta='';
    var $ase_p11='';
    var $ase_p12='';
    var $ase_p21='';
    var $ase_p22='';
    var $ase_p31='';
    var $ase_p32='';
    var $ase_pla='';
	var $ase_cma='';
	var $cb='';
//******************************************************************
//$_POST[mod_id],$_POST[reg_id],$_POST[esp_id],$_POST[coh_id],$todo
  function listado($pac_id, $coh_id, $mod_id, $reg_id, $esp_id, $pen_top, $asi_cod, $sec_id, $ele_cod, $ci_emp, $sta, $ase_p11, $ase_p12, $ase_p21, $ase_p22, $ase_p31, $ase_p32, $ase_pla){
    $this->pac_id=$pac_id;
    $this->coh_id=$coh_id;
    $this->mod_id=$mod_id;
    $this->reg_id=$reg_id;
    $this->esp_id=$esp_id;
    $this->pen_top=$pen_top;
    $this->asi_cod=$asi_cod;
    $this->sec_id=$sec_id;
    $this->ele_cod=$ele_cod;
    $this->ci_emp=$ci_emp;
    $this->ase_sta=$sta;
    $this->ase_p11=$ase_p11;
    $this->ase_p12=$ase_p12;
    $this->ase_p21=$ase_p21;
    $this->ase_p22=$ase_p22;
    $this->ase_p31=$ase_p31;
    $this->ase_p32=$ase_p32;
    $this->ase_pla=$ase_pla;
  }
//******************************************************************
  function Listado_infraestructura(){
    $ci=$_SESSION['ci'];
/*	echo "<script>alert('cedula $ci');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.ci AS 'ci', B.inf_nom AS 'inf_nom' FROM estudi_infrae A, infrae B WHERE (A.est_inf_ffi='0000-00-00 00:00:00' OR A.est_inf_ffi='') AND A.ci='$ci' AND B.inf_id=A.inf_id");
    return $resultado;
  }
//******************************************************************
  function Contar_matri(){
    $resultado=$this->Operacion("SELECT DISTINCT(A.esp_id) AS 'esp_id' , A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', D.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom', A.pen_top AS 'pen_top' FROM matric A, cohort B, modali C, especi D, regimen E WHERE A.ci=$_SESSION[ci] AND A.matr_sta='1' AND A.coh_id=B.coh_id AND C.mod_id=A.mod_id AND D.esp_id=A.esp_id AND A.reg_id=E.reg_id ORDER BY B.coh_nom,C.mod_nom,E.reg_nom,D.esp_nom,A.pen_top LIMIT $cantidad OFFSET $inicial");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Contar_matri_lic($pac_id){
  $infrae='';
    $resp=$this->Listado_infraestructura();
	while($inf=$this->ConsultarCualquiera($resp)){
	  if($infrae=='')
	    $infrae="'".$inf->inf_id."'";
	  else
	    $infrae="'".$inf->inf_id."',".$infrae;
	}
    $resultado=$this->Operacion("SELECT DISTINCT(A.esp_id) AS 'esp_id', A.coh_id AS 'coh_id', E.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', F.mod_nom AS 'mod_nom', G.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', H.reg_nom AS 'reg_nom' FROM matric A, asigna_seccio B, seccio C, asigna D, cohort E, modali F, especi G, regimen H WHERE A.esp_id NOT IN('2113D','2126D','2122D','2113N','2126N','2122N') AND A.ci='$_SESSION[ci]' AND A.matr_sta='1' AND A.coh_id=B.coh_id AND B.mod_id=A.mod_id AND B.esp_id=A.esp_id AND A.reg_id=B.reg_id AND B.sec_id=C.sec_id AND C.inf_id IN ($infrae) AND B.asi_cod=D.asi_cod AND D.asi_cba='0' AND B.pac_id='$pac_id' AND A.coh_id=E.coh_id AND F.mod_id=A.mod_id AND G.esp_id=A.esp_id AND A.reg_id=H.reg_id");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_matri_lic($inicial,$cantidad,$pac_id){
  $infrae='';
    $resp=$this->Listado_infraestructura();
	while($inf=$this->ConsultarCualquiera($resp)){
	  if($infrae=='')
	    $infrae="'".$inf->inf_id."'";
	  else
	    $infrae="'".$inf->inf_id."',".$infrae;
	}
    $resultado=$this->Operacion("SELECT DISTINCT(A.esp_id) AS 'esp_id', A.coh_id AS 'coh_id', E.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', F.mod_nom AS 'mod_nom', G.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', H.reg_nom AS 'reg_nom' FROM matric A, asigna_seccio B, seccio C, asigna D, cohort E, modali F, especi G, regimen H WHERE A.esp_id NOT IN('2113D','2126D','2122D','2113N','2126N','2122N') AND A.ci='$_SESSION[ci]' AND A.matr_sta='1' AND A.coh_id=B.coh_id AND B.mod_id=A.mod_id AND B.esp_id=A.esp_id AND A.reg_id=B.reg_id AND B.sec_id=C.sec_id AND C.inf_id IN ($infrae) AND B.asi_cod=D.asi_cod AND D.asi_cba='0' AND B.pac_id='$pac_id' AND A.coh_id=E.coh_id AND F.mod_id=A.mod_id AND G.esp_id=A.esp_id AND A.reg_id=H.reg_id ORDER BY E.coh_nom, F.mod_nom, H.reg_nom, G.esp_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Contar_matri_Ing_CP($pac_id){
  $infrae='';
    $resp=$this->Listado_infraestructura();
	while($inf=$this->ConsultarCualquiera($resp)){
	  if($infrae=='')
	    $infrae="'".$inf->inf_id."'";
	  else
	    $infrae="'".$inf->inf_id."',".$infrae;
	}
    $resultado=$this->Operacion("SELECT DISTINCT(A.esp_id) AS 'esp_id', A.coh_id AS 'coh_id', E.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', F.mod_nom AS 'mod_nom', G.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', H.reg_nom AS 'reg_nom' FROM matric A, asigna_seccio B, seccio C, asigna D, cohort E, modali F, especi G, regimen H WHERE A.esp_id IN('2113D','2126D','2122D','2113N','2126N','2122N') AND A.ci='$_SESSION[ci]' AND A.matr_sta='1' AND A.coh_id=B.coh_id AND B.mod_id=A.mod_id AND B.esp_id=A.esp_id AND A.reg_id=B.reg_id AND B.sec_id=C.sec_id AND C.inf_id IN ($infrae) AND B.asi_cod=D.asi_cod AND D.asi_cba='0' AND B.pac_id='$pac_id' AND A.coh_id=E.coh_id AND F.mod_id=A.mod_id AND G.esp_id=A.esp_id AND A.reg_id=H.reg_id");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_matri_Ing_CP($pac_id){
  $infrae='';
    $resp=$this->Listado_infraestructura();
	while($inf=$this->ConsultarCualquiera($resp)){
	  if($infrae=='')
	    $infrae="'".$inf->inf_id."'";
	  else
	    $infrae="'".$inf->inf_id."',".$infrae;
	}
    $resultado=$this->OperacionCualquiera("SELECT DISTINCT(A.esp_id) AS 'esp_id', A.coh_id AS 'coh_id', E.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', F.mod_nom AS 'mod_nom', G.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', H.reg_nom AS 'reg_nom' FROM matric A, asigna_seccio B, seccio C, asigna D, cohort E, modali F, especi G, regimen H WHERE A.esp_id IN('2113D','2126D','2122D','2113N','2126N','2122N') AND A.ci='$_SESSION[ci]' AND A.matr_sta='1' AND A.coh_id=B.coh_id AND B.mod_id=A.mod_id AND B.esp_id=A.esp_id AND A.reg_id=B.reg_id AND B.sec_id=C.sec_id AND C.inf_id IN ($infrae) AND B.asi_cod=D.asi_cod AND D.asi_cba='0' AND B.pac_id='$pac_id' AND A.coh_id=E.coh_id AND F.mod_id=A.mod_id AND G.esp_id=A.esp_id AND A.reg_id=H.reg_id ORDER BY E.coh_nom, F.mod_nom, H.reg_nom, G.esp_nom");
    return $resultado;
  }
//******************************************************************
  function Contar_matri_Ing_CB($pac_id){
  $infrae='';
    $resp=$this->Listado_infraestructura();
	while($inf=$this->ConsultarCualquiera($resp)){
	  if($infrae=='')
	    $infrae="'".$inf->inf_id."'";
	  else
	    $infrae="'".$inf->inf_id."',".$infrae;
	}
	$ci=$_SESSION[ci];
    $resultado=$this->Operacion("SELECT DISTINCT(A.coh_id) AS 'coh_id', E.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', F.mod_nom AS 'mod_nom', A.reg_id AS 'reg_id', H.reg_nom AS 'reg_nom' FROM matric A, asigna_seccio B, seccio C, asigna D, cohort E, modali F, especi G, regimen H WHERE A.esp_id IN('2113D','2126D','2122D','2113N','2126N','2122N') AND A.ci='$ci' AND A.matr_sta='1' AND A.coh_id=B.coh_id AND B.mod_id=A.mod_id AND B.esp_id=A.esp_id AND A.reg_id=B.reg_id AND B.sec_id=C.sec_id AND C.inf_id IN ($infrae) AND B.asi_cod=D.asi_cod AND D.asi_cba='1' AND B.pac_id='$pac_id' AND A.coh_id=E.coh_id AND F.mod_id=A.mod_id AND G.esp_id=A.esp_id AND A.reg_id=H.reg_id");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_matri_Ing_CB($pac_id){
  $infrae='';
    $resp=$this->Listado_infraestructura();
	while($inf=$this->ConsultarCualquiera($resp)){
	  if($infrae=='')
	    $infrae="'".$inf->inf_id."'";
	  else
	    $infrae="'".$inf->inf_id."',".$infrae;
	}
    $resultado=$this->OperacionCualquiera("SELECT DISTINCT(A.coh_id) AS 'coh_id', E.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', F.mod_nom AS 'mod_nom', A.reg_id AS 'reg_id', H.reg_nom AS 'reg_nom' FROM matric A, asigna_seccio B, seccio C, asigna D, cohort E, modali F, especi G, regimen H WHERE A.esp_id IN('2113D','2126D','2122D','2113N','2126N','2122N') AND A.ci='$_SESSION[ci]' AND A.matr_sta='1' AND A.coh_id=B.coh_id AND B.mod_id=A.mod_id AND B.esp_id=A.esp_id AND A.reg_id=B.reg_id AND B.sec_id=C.sec_id AND C.inf_id IN ($infrae) AND B.asi_cod=D.asi_cod AND D.asi_cba='1' AND B.pac_id='$pac_id' AND A.coh_id=E.coh_id AND F.mod_id=A.mod_id AND G.esp_id=A.esp_id AND A.reg_id=H.reg_id ORDER BY E.coh_nom, F.mod_nom, H.reg_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_matri($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT DISTINCT(A.esp_id) AS 'esp_id', A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', D.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom', A.pen_top AS 'pen_top' FROM matric A, cohort B, modali C, especi D, regimen E WHERE A.ci=$_SESSION[ci] AND A.matr_sta='1' AND A.coh_id=B.coh_id AND C.mod_id=A.mod_id AND D.esp_id=A.esp_id AND A.reg_id=E.reg_id ORDER BY B.coh_nom,C.mod_nom,E.reg_nom,D.esp_nom,A.pen_top LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_matri2(){
    $resultado=$this->Operacion("SELECT DISTINCT(A.esp_id) AS 'esp_id', A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', D.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom', A.pen_top AS 'pen_top' FROM matric A, cohort B, modali C, especi D, regimen E WHERE A.ci=$_SESSION[ci] AND A.matr_sta='1' AND A.coh_id=B.coh_id AND C.mod_id=A.mod_id AND D.esp_id=A.esp_id AND A.reg_id=E.reg_id ORDER BY B.coh_nom,C.mod_nom,E.reg_nom,D.esp_nom,A.pen_top");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $pac_id, $cb, $sta){
/*    echo "<script>alert('$mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $pac_id, $sta');</script>";*/
        $_SESSION[pac_id]=$this->pac_id=$pac_id;
        $_SESSION[coh_id]=$this->coh_id=$coh_id;
        $_SESSION[mod_id]=$this->mod_id=$mod_id;
        $_SESSION[reg_id]=$this->reg_id=$reg_id;
        $_SESSION[esp_id]=$this->esp_id=$esp_id;
        $_SESSION[pen_top]=$this->pen_top=$pen_top;
        $_SESSION[cb]=$this->cb=$cb;		
		$this->sta=1;
/*		echo "<script>alert('$mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $pac_id, $cb, $sta');</script>";*/
  }
//******************************************************************
  function Listado_Asigna_Lic_IngCP(){
  $infrae='';
    $resp=$this->Listado_infraestructura();
	while($inf=$this->ConsultarCualquiera($resp)){
	  if($infrae=='')
	    $infrae="'".$inf->inf_id."'";
	  else
	    $infrae="'".$inf->inf_id."',".$infrae;
	}
    $resultado=$this->OperacionCualquiera("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_nom AS 'asi_nom' FROM asigna A, asigna_seccio B, seccio C WHERE B.sec_id=C.sec_id AND C.inf_id IN($infrae) AND B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id='$this->esp_id' AND B.coh_id='$this->coh_id' AND B.pac_id='$this->pac_id' AND ase_sta='1' AND A.asi_cod=B.asi_cod AND B.mod_id=A.mod_id AND B.reg_id=A.reg_id AND B.esp_id=A.esp_id AND B.coh_id=A.coh_id AND A.asi_cba='0' AND A.asi_sta='1' order by A.asi_mod,A.asi_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Asigna_Ing_CB_Diurno(){
  $infrae='';
  $IMPRIMIR="";
    $resp=$this->Listado_infraestructura();
	while($inf=$this->ConsultarCualquiera($resp)){
	  if($infrae==''){
	    $infrae="'".$inf->inf_id."'";
		$IMPRIMIR=$inf->inf_id;
	  }
	  else{
	    $infrae="'".$inf->inf_id."',".$infrae;
		$IMPRIMIR=$inf->inf_id.", ".$IMPRIMIR;
	  }
	}
/*	echo "<script>alert('$IMPRIMIR, $this->mod_id, $this->reg_id, $this->coh_id, $this->pac_id');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_nom AS 'asi_nom' FROM asigna A, asigna_seccio B, seccio C WHERE B.sec_id=C.sec_id AND C.inf_id IN($infrae) AND B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id IN('2113D','2126D','2122D') AND B.coh_id='$this->coh_id' AND B.pac_id='$this->pac_id' AND ase_sta='1' AND A.asi_cod=B.asi_cod AND B.mod_id=A.mod_id AND B.reg_id=A.reg_id AND B.esp_id=A.esp_id AND B.coh_id=A.coh_id AND A.asi_cba='1' AND A.asi_sta='1' order by A.asi_mod,A.asi_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Asigna_Ing_CB_Nocturno(){
  $infrae='';
    $resp=$this->Listado_infraestructura();
	while($inf=$this->ConsultarCualquiera($resp)){
	  if($infrae=='')
	    $infrae="'".$inf->inf_id."'";
	  else
	    $infrae="'".$inf->inf_id."',".$infrae;
	}
/*	echo "<script>alert('NOCTURNO SELECT DISTINCT(A.asi_cod) AS asi_cod, A.asi_nom AS asi_nom FROM asigna A, asigna_seccio B, seccio C WHERE B.sec_id=C.sec_id AND C.inf_id IN($infrae) AND B.mod_id=$this->mod_id AND B.reg_id=$this->reg_id AND B.esp_id IN(2113N,2126N,2122N) AND B.coh_id=$this->coh_id AND B.pac_id=$this->pac_id AND ase_sta=1 AND A.asi_cod=B.asi_cod AND B.mod_id=A.mod_id AND B.reg_id=A.reg_id AND B.esp_id=A.esp_id AND B.coh_id=A.coh_id AND A.asi_cba=1 AND A.asi_sta=1 order by A.asi_mod,A.asi_nom');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_nom AS 'asi_nom' FROM asigna A, asigna_seccio B, seccio C WHERE B.sec_id=C.sec_id AND C.inf_id IN($infrae) AND B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id IN('2113N','2126N','2122N') AND B.coh_id='$this->coh_id' AND B.pac_id='$this->pac_id' AND ase_sta='1' AND A.asi_cod=B.asi_cod AND B.mod_id=A.mod_id AND B.reg_id=A.reg_id AND B.esp_id=A.esp_id AND B.coh_id=A.coh_id AND A.asi_cba='1' AND A.asi_sta='1' order by A.asi_mod,A.asi_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Alumno_Lic_IngCP($sec_id){
    $resultado=$this->OperacionCualquiera("SELECT A.ci AS 'ci', A.no1 AS 'no1', A.no2 AS 'no2', A.no3 AS 'no3', A.ap1 AS 'ap1', A.ap2 AS 'ap2', A.ap3 AS 'ap3' FROM persona A, detins B WHERE B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id='$this->esp_id' AND B.coh_id='$this->coh_id' AND B.asi_cod='$this->asi_cod' AND B.pac_id='$this->pac_id' AND B.sec_id='$sec_id' AND A.ci=B.ci_est AND B.det_sta='1' AND B.obs_id!='15' order by A.ap1,A.ap2,A.ap3,A.no1,A.no2 DESC");
    return $resultado;
  }
//******************************************************************
  function Listado_Alumno_Ing_CB_Diurno($sec_id){
    $resultado=$this->OperacionCualquiera("SELECT A.ci AS 'ci', A.no1 AS 'no1', A.no2 AS 'no2', A.no3 AS 'no3', A.ap1 AS 'ap1', A.ap2 AS 'ap2', A.ap3 AS 'ap3' FROM persona A, detins B WHERE B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id IN('2113D','2126D','2122D') AND B.coh_id='$this->coh_id' AND B.asi_cod='$this->asi_cod' AND B.pac_id='$this->pac_id' AND B.sec_id='$sec_id' AND A.ci=B.ci_est AND B.det_sta='1' AND B.obs_id!='15' order by A.ap1,A.ap2,A.ap3,A.no1,A.no2 DESC");
    return $resultado;
  }
//******************************************************************
  function Listado_Alumno_Ing_CB_Nocturno($sec_id){
    $resultado=$this->OperacionCualquiera("SELECT A.ci AS 'ci', A.no1 AS 'no1', A.no2 AS 'no2', A.no3 AS 'no3', A.ap1 AS 'ap1', A.ap2 AS 'ap2', A.ap3 AS 'ap3' FROM persona A, detins B WHERE B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id IN('2113N','2126N','2122N') AND B.coh_id='$this->coh_id' AND B.asi_cod='$this->asi_cod' AND B.pac_id='$this->pac_id' AND B.sec_id='$sec_id' AND A.ci=B.ci_est AND B.det_sta='1' AND B.obs_id!='15' order by A.ap1,A.ap2,A.ap3,A.no1,A.no2 DESC");
    return $resultado;
  }
//******************************************************************
  function Listado_Alumno_Lic_IngCP_Not($sec_id){
    $resultado=$this->OperacionCualquiera("SELECT A.ci AS 'ci', concat(A.no1,' ',A.no2) AS 'no', concat(A.ap1,' ',A.ap2) AS 'ap', B.det_n11 AS 'det_n11', B.det_n12 AS 'det_n12', B.det_n13 AS 'det_n13', B.det_n21 AS 'det_n21', B.det_n22 AS 'det_n22', B.det_n23 AS 'det_n23', B.det_n31 AS 'det_n31', B.det_n32 AS 'det_n32', B.det_n33 AS 'det_n33', B.det_di1 AS 'det_di1', B.det_di2 AS 'det_di2', B.det_nla AS 'det_nla', B.det_nfi AS 'det_nfi', B.det_nde AS 'det_nde', B.det_con AS 'det_con', B.esp_id As 'esp_id' FROM persona A, detins B WHERE B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id='$this->esp_id' AND B.coh_id='$this->coh_id' AND B.asi_cod='$this->asi_cod' AND B.pac_id='$this->pac_id' AND B.sec_id='$sec_id' AND A.ci=B.ci_est AND B.det_sta='1' AND B.obs_id!='15' order by B.esp_id,B.sec_id,ap,no,ci ASC");
    return $resultado;
  }
//******************************************************************
  function Listado_Alumno_Ing_CB_Diurno_Not($sec_id){
/*    echo "<script>alert('SELECT A.ci AS ci, concat(A.no1, ,A.no2) AS no, concat(A.ap1, ,A.ap2) AS ap, B.det_n11 AS det_n11, B.det_n12 AS det_n12, B.det_n13 AS det_n13, B.det_n21 AS det_n21, B.det_n22 AS det_n22, B.det_n23 AS det_n23, B.det_n31 AS det_n31, B.det_n32 AS det_n32, B.det_n33 AS det_n33, B.det_di1 AS det_di1, B.det_di2 AS det_di2, B.det_nla AS det_nla, B.det_nfi AS det_nfi, B.det_nde AS det_nde, B.det_con AS det_con FROM persona A, detins B WHERE B.mod_id=$this->mod_id AND B.reg_id=$this->reg_id AND B.esp_id IN(2113D,2126D,2122D) AND B.coh_id=$this->coh_id AND B.asi_cod=$this->asi_cod AND B.pac_id=$this->pac_id AND B.sec_id=$sec_id AND A.ci=B.ci_est AND B.det_sta=1 order by B.esp_id,B.sec_id,ap,no,ci ASC');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT A.ci AS 'ci', concat(A.no1,' ',A.no2) AS 'no', concat(A.ap1,' ',A.ap2) AS 'ap', B.det_n11 AS 'det_n11', B.det_n12 AS 'det_n12', B.det_n13 AS 'det_n13', B.det_n21 AS 'det_n21', B.det_n22 AS 'det_n22', B.det_n23 AS 'det_n23', B.det_n31 AS 'det_n31', B.det_n32 AS 'det_n32', B.det_n33 AS 'det_n33', B.det_di1 AS 'det_di1', B.det_di2 AS 'det_di2', B.det_nla AS 'det_nla', B.det_nfi AS 'det_nfi', B.det_nde AS 'det_nde', B.det_con AS 'det_con', B.esp_id As 'esp_id' FROM persona A, detins B WHERE B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id IN('2113D','2126D','2122D') AND B.coh_id='$this->coh_id' AND B.asi_cod='$this->asi_cod' AND B.pac_id='$this->pac_id' AND B.sec_id='$sec_id' AND A.ci=B.ci_est AND B.det_sta='1' AND B.obs_id!='15' order by B.esp_id,B.sec_id,ap,no,ci ASC");
    return $resultado;
  }
//******************************************************************
  function Listado_Alumno_Ing_CB_Nocturno_Not($sec_id){
    $resultado=$this->OperacionCualquiera("SELECT A.ci AS 'ci', concat(A.no1,' ',A.no2) AS 'no', concat(A.ap1,' ',A.ap2) AS 'ap', B.det_n11 AS 'det_n11', B.det_n12 AS 'det_n12', B.det_n13 AS 'det_n13', B.det_n21 AS 'det_n21', B.det_n22 AS 'det_n22', B.det_n23 AS 'det_n23', B.det_n31 AS 'det_n31', B.det_n32 AS 'det_n32', B.det_n33 AS 'det_n33', B.det_di1 AS 'det_di1', B.det_di2 AS 'det_di2', B.det_nla AS 'det_nla', B.det_nfi AS 'det_nfi', B.det_nde AS 'det_nde', B.det_con AS 'det_con', B.esp_id As 'esp_id' FROM persona A, detins B WHERE B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id IN('2113N','2126N','2122N') AND B.coh_id='$this->coh_id' AND B.asi_cod='$this->asi_cod' AND B.pac_id='$this->pac_id' AND B.sec_id='$sec_id' AND A.ci=B.ci_est AND B.det_sta='1' AND B.obs_id!='15' order by B.esp_id,B.sec_id,ap,no,ci ASC");
    return $resultado;
  }
//******************************************************************
  function Listado_Alumno_Lic_IngCP_Rep($sec_id){
    $resultado=$this->OperacionCualquiera("SELECT A.ci AS 'ci', concat(A.no1,' ',A.no2) AS 'no', concat(A.ap1,' ',A.ap2) AS 'ap', B.det_nla AS 'det_nla', B.det_nfi AS 'det_nfi', B.det_nre AS 'det_nre', B.det_nde AS 'det_nde', B.det_con AS 'det_con', B.esp_id As 'esp_id', B.obs_id AS 'obs_id' FROM persona A, detins B WHERE B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id='$this->esp_id' AND B.coh_id='$this->coh_id' AND B.asi_cod='$this->asi_cod' AND B.pac_id='$this->pac_id' AND B.sec_id='$sec_id' AND A.ci=B.ci_est AND B.det_sta='1' AND B.obs_id!='10' order by B.esp_id,B.sec_id,ap,no,ci ASC");
    return $resultado;
  }
//******************************************************************
  function Listado_Alumno_Ing_CB_Diurno_Rep($sec_id){
/*    echo "<script>alert('SELECT A.ci AS ci, concat(A.no1, ,A.no2) AS no, concat(A.ap1, ,A.ap2) AS ap, B.det_n11 AS det_n11, B.det_n12 AS det_n12, B.det_n13 AS det_n13, B.det_n21 AS det_n21, B.det_n22 AS det_n22, B.det_n23 AS det_n23, B.det_n31 AS det_n31, B.det_n32 AS det_n32, B.det_n33 AS det_n33, B.det_di1 AS det_di1, B.det_di2 AS det_di2, B.det_nla AS det_nla, B.det_nfi AS det_nfi, B.det_nde AS det_nde, B.det_con AS det_con FROM persona A, detins B WHERE B.mod_id=$this->mod_id AND B.reg_id=$this->reg_id AND B.esp_id IN(2113D,2126D,2122D) AND B.coh_id=$this->coh_id AND B.asi_cod=$this->asi_cod AND B.pac_id=$this->pac_id AND B.sec_id=$sec_id AND A.ci=B.ci_est AND B.det_sta=1 order by B.esp_id,B.sec_id,ap,no,ci ASC');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT A.ci AS 'ci', concat(A.no1,' ',A.no2) AS 'no', concat(A.ap1,' ',A.ap2) AS 'ap', B.det_nla AS 'det_nla', B.det_nfi AS 'det_nfi', B.det_nre AS 'det_nre', B.det_nde AS 'det_nde', B.det_con AS 'det_con', B.esp_id As 'esp_id', B.obs_id AS 'obs_id' FROM persona A, detins B WHERE B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id IN('2113D','2126D','2122D') AND B.coh_id='$this->coh_id' AND B.asi_cod='$this->asi_cod' AND B.pac_id='$this->pac_id' AND B.sec_id='$sec_id' AND A.ci=B.ci_est AND B.det_sta='1' AND B.obs_id!='10' order by B.esp_id,B.sec_id,ap,no,ci ASC");
    return $resultado;
  }
//******************************************************************
  function Listado_Alumno_Ing_CB_Nocturno_Rep($sec_id){
    $resultado=$this->OperacionCualquiera("SELECT A.ci AS 'ci', concat(A.no1,' ',A.no2) AS 'no', concat(A.ap1,' ',A.ap2) AS 'ap', B.det_nla AS 'det_nla', B.det_nfi AS 'det_nfi', B.det_nre AS 'det_nre', B.det_nde AS 'det_nde', B.det_con AS 'det_con', B.esp_id As 'esp_id', B.obs_id AS 'obs_id' FROM persona A, detins B WHERE B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id IN('2113N','2126N','2122N') AND B.coh_id='$this->coh_id' AND B.asi_cod='$this->asi_cod' AND B.pac_id='$this->pac_id' AND B.sec_id='$sec_id' AND A.ci=B.ci_est AND B.det_sta='1' AND B.obs_id!='10' order by B.esp_id,B.sec_id,ap,no,ci ASC");
    return $resultado;
  }
//******************************************************************
  function Buscar_Estudi($valor){
    $ci="";
	$cuantos=0;
	$this->pac_id=$_SESSION[pac_id];
    $this->coh_id=$_SESSION[coh_id];
    $this->mod_id=$_SESSION[mod_id];
    $this->reg_id=$_SESSION[reg_id];
    $this->esp_id=$_SESSION[esp_id];
    $this->pen_top=$_SESSION[pen_top];
	$this->asi_cod=$_SESSION[asi_cod];
	$this->cb=$_SESSION[cb];
	$this->sec_id=$valor;
	  if($this->reg_id==3 && $this->cb==1)
        $resp=$this->Listado_Alumno_Ing_CB_Diurno($valor);
	  else{
	    if($this->reg_id==4 && $this->cb==1)
          $resp=$this->Listado_Alumno_Ing_CB_Nocturno($valor);
	    else
          $resp=$this->Listado_Alumno_Lic_IngCP($valor);
	  }
	  while($array=$this->ConsultarCualquiera($resp)){
	    if($ci==""){
	      $ci=$array->ci;
	      $ap1=$array->ap1;
	      $ap2=$array->ap2;
	      $ap3=$array->ap3;
	      $no1=$array->no1;
	      $no2=$array->no2;
	      $no3=$array->no3;
	    }
	    else{
	      $ci=$ci."*".$array->ci;
	      $ap1=$ap1."*".$array->ap1;
	      $ap2=$ap2."*".$array->ap2;
	      $ap3=$ap3."*".$array->ap3;
	      $no1=$no1."*".$array->no1;
	      $no2=$no2."*".$array->no2;
	      $no3=$no3."*".$array->no3;
	    }
	    $cuantos++;
	  }
	$this->res=$ci."@".$ap1."@".$ap2."@".$ap3."@".$no1."@".$no2."@".$no3."@".$cuantos;
	$this->res=$this->ConvertirMayuscula($this->res);
	return $this->res;
  }
//******************************************************************
  function Buscar_Nota($valor){
    $ci="";
	$cuantos=0;
	$this->pac_id=$_SESSION[pac_id];
    $this->coh_id=$_SESSION[coh_id];
    $this->mod_id=$_SESSION[mod_id];
    $this->reg_id=$_SESSION[reg_id];
    $this->esp_id=$_SESSION[esp_id];
    $this->pen_top=$_SESSION[pen_top];
	$this->asi_cod=$_SESSION[asi_cod];
	$this->cb=$_SESSION[cb];
	$this->sec_id=$valor;
	  if($this->reg_id==3 && $this->cb==1){
        $resp=$this->Listado_Alumno_Ing_CB_Diurno_Not($valor);
/*		echo "<script>alert('SELECT * FROM asigna_seccio WHERE esp_id IN(2113D,2122D,2126D) AND mod_id=$this->mod_id AND coh_id=$this->coh_id AND reg_id=$this->reg_id AND sec_id=$this->sec_id AND pac_id=$this->pac_id AND asi_cod=$this->asi_cod AND ase_sta=1');</script>";*/
	    $res_ase=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE esp_id IN('2113D','2122D','2126D') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND ase_sta='1'");
	    $arr_ase=$this->ConsultarCualquiera($res_ase);
/*		echo "<script>alert('SELECT * FROM asigna_seccio WHERE esp_id IN(2113D,2122D,2126D) AND mod_id=$this->mod_id AND coh_id=$this->coh_id AND reg_id=$this->reg_id AND sec_id=$this->sec_id AND pac_id=$this->pac_id AND asi_cod=$this->asi_cod AND ase_sta=1');</script>";*/
	    $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS teo FROM horario WHERE esp_id IN('2113D','2122D','2126D') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='0'");
	    $cuan=$this->ConsultarCualquiera($contar);
	    $cant_teo=$cuan->teo;
		$contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS pra FROM horario WHERE esp_id IN('2113D','2122D','2126D') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='1'");
	    $cuan=$this->ConsultarCualquiera($contar);
	    $cant_pra=$cuan->pra;
	    $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS lab FROM horario WHERE esp_id IN('2113D','2122D','2126D') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='2'");
	      $cuan=$this->ConsultarCualquiera($contar);
	      $cant_lab=$cuan->lab;
	  }
	  else{
	    if($this->reg_id==4 && $this->cb==1){
          $resp=$this->Listado_Alumno_Ing_CB_Nocturno_Not($valor);
	  	  $res_ase=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE esp_id IN('2113N','2122N','2126N') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND ase_sta='1'");
	      $arr_ase=$this->ConsultarCualquiera($res_ase);
	      $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS teo FROM horario WHERE esp_id IN('2113N','2122N','2126N') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='0'");
	      $cuan=$this->ConsultarCualquiera($contar);
	      $cant_teo=$cuan->teo;
		  $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS pra FROM horario WHERE esp_id IN('2113N','2122N','2126N') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='1'");
	      $cuan=$this->ConsultarCualquiera($contar);
	      $cant_pra=$cuan->pra;
	      $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS lab FROM horario WHERE esp_id IN('2113N','2122N','2126N') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='2'");
	      $cuan=$this->ConsultarCualquiera($contar);
	      $cant_lab=$cuan->lab;
		}
	    else{
          $resp=$this->Listado_Alumno_Lic_IngCP_Not($valor);
	  	  $res_ase=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE esp_id='$this->esp_id' AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND ase_sta='1'");
	      $arr_ase=$this->ConsultarCualquiera($res_ase);
  	      $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS teo FROM horario WHERE esp_id='$this->esp_id' AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='0'");
	      $cuan=$this->ConsultarCualquiera($contar);
	      $cant_teo=$cuan->teo;
		  $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS pra FROM horario WHERE esp_id='$this->esp_id' AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='1'");
	      $cuan=$this->ConsultarCualquiera($contar);
	      $cant_pra=$cuan->pra;
	      $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS lab FROM horario WHERE esp_id='$this->esp_id' AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='2'");
	      $cuan=$this->ConsultarCualquiera($contar);
	      $cant_lab=$cuan->lab;
		}
	  }
	  $res_doc=$this->OperacionCualquiera("SELECT * FROM persona WHERE ci='$arr_ase->ci_emp'");
      $arr_doc=$this->ConsultarCualquiera($res_doc);
      $teor="";
      $cond="";
	  $n11="";
      $n12="";
      $n13="";	  
	  $p11="";
	  $p12="";
  	  $p13="";
	  $n21="";
	  $n22="";
  	  $n23="";	  
	  $p21="";
	  $p22="";
  	  $p23="";
	  $n31="";
	  $n32="";
  	  $n33="";	  
	  $p31="";
	  $p32="";
      $p33="";
	  $pla="";
      $nla="";
      $defi="";
	  $letr="";	
	  $esp="";
	  while($array=$this->ConsultarCualquiera($resp)){
        $sum=0;
  	    $no11="00";
	    $no12="00";
	    $no13="00";	  
	    $por11="";
	    $por12="";
  	    $por13="";
	    $no21="00";
	    $no22="00";
  	    $no23="00";
	    $por21="";
	    $por22="";
  	    $por23="";
	    $no31="00";
	    $no32="00";
  	    $no33="00";	  
	    $por31="";
	    $por32="";
        $por33="";
	    $pola="";
        $nola="00";
        $def="";
	    $let="";
/*		echo "<script>alert('$array->det_n11==');</script>";*/
/*		echo "<script>alert('20>=$i && $por11==');</script>";*/
	    if($array->det_n11==""){
		  $por11=(1*$arr_ase->ase_p11)/100;
		  $sum=$sum+$por11;
		  $no11="01";
		}
		$i=1;
		while(20>=$i){
		  if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n11==$nota){
		    $por11=($i*$arr_ase->ase_p11)/100;
			$sum=$sum+$por11;
			/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  if($array->det_n11==$nota && $array->det_n11!="") 
			$no11=$n;
		  $i++;
		}
/*		echo "<script>alert('PORCENTAJE $por11, ($i*$arr_ase->ase_p11)/100');</script>";*/
	    if($array->det_n12==""){
		  $por12=(1*$arr_ase->ase_p12)/100;
		  $sum=$sum+$por12;
		  $no12="01";
		}
		$i=1;
		while(20>=$i){
		  if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n12==$nota){
		    $por12=($i*$arr_ase->ase_p12)/100;
			$sum=$sum+$por12;
			/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  if($array->det_n12==$nota && $array->det_n12!="") 
			$no12=$n;
		  $i++;
		}
	    if($array->det_n13==""){
		  $por13=(1*$arr_ase->ase_p13)/100;
		  $sum=$sum+$por13;
		  $no13="01";
		}
		$i=1;
		while(20>=$i){
		  if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n13==$nota){
		    $por13=($i*$arr_ase->ase_p13)/100;
			$sum=$sum+$por13;
			/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  if($array->det_n13==$nota && $array->det_n13!="") 
			$no13=$n;
		  $i++;
		}
		if($array->det_n21==""){
		  $por21=(1*$arr_ase->ase_p21)/100;
		  $sum=$sum+$por21;
		  $no21="01";
		}
		$i=1;
		while(20>=$i){
		  if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n21==$nota){
		    $por21=($i*$arr_ase->ase_p21)/100;
			$sum=$sum+$por21;
			/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  if($array->det_n21==$nota && $array->det_n21!="") 
			$no21=$n;
		  $i++;
		}
/*		echo "<script>alert('PORCENTAJE $por11, ($i*$arr_ase->ase_p11)/100');</script>";*/
	    if($array->det_n22==""){
		  $por22=(1*$arr_ase->ase_p22)/100;
		  $sum=$sum+$por22;
		  $no22="01";
		}
		$i=1;
		while(20>=$i){
		  if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n22==$nota){
		    $por22=($i*$arr_ase->ase_p22)/100;
			$sum=$sum+$por22;
			/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  if($array->det_n22==$nota && $array->det_n22!="") 
			$no22=$n;
		  $i++;
		}		
	    if($array->det_n23==""){
		  $por23=(1*$arr_ase->ase_p23)/100;
		  $sum=$sum+$por23;
		  $no23="01";
		}
		$i=1;
		while(20>=$i){
		  if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n23==$nota){
		    $por23=($i*$arr_ase->ase_p23)/100;
			$sum=$sum+$por23;
			/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  if($array->det_n23==$nota && $array->det_n23!="") 
			$no23=$n;
		  $i++;
		}
		if($array->det_n31==""){
		  $por31=(1*$arr_ase->ase_p31)/100;
		  $sum=$sum+$por31;
		  $no31="01";
		}
		$i=1;
		while(20>=$i){
		  if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n31==$nota){
		    $por31=($i*$arr_ase->ase_p31)/100;
			$sum=$sum+$por31;
			/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  if($array->det_n31==$nota && $array->det_n31!="") 
			$no31=$n;
		  $i++;
		}
/*		echo "<script>alert('PORCENTAJE $por11, ($i*$arr_ase->ase_p11)/100');</script>";*/
	    if($array->det_n32==""){
		  $por32=(1*$arr_ase->ase_p32)/100;
		  $sum=$sum+$por32;
		  $no32="01";
		}
		$i=1;
		while(20>=$i){
		  if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n32==$nota){
		    $por32=($i*$arr_ase->ase_p32)/100;
			$sum=$sum+$por32;
			/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  if($array->det_n32==$nota && $array->det_n32!="") 
			$no32=$n;
		  $i++;
		}		
	    if($array->det_n33==""){
		  $por23=(1*$arr_ase->ase_p33)/100;
		  $sum=$sum+$por33;
		  $no33="01";
		}
		$i=1;
		while(20>=$i){
		  if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n33==$nota){
		    $por33=($i*$arr_ase->ase_p33)/100;
			$sum=$sum+$por33;
			/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  if($array->det_n33==$nota && $array->det_n33!="") 
			$no33=$n;
		  $i++;
		}
		if($cant_lab>0 && $cant_teo>0){
	      $teo=$sum;
	      $i=1;
	      $pola="";
	      $nola="NP";
	      while(20>=$i && $pola==""){
	        if($i<=9) $n="0".$i; else $n="".$i;
		    $nota=md5($n);
		    if($array->det_nla==$nota){
		      $pola=($i*$arr_ase->ase_pla)/100;
		      $sum=$sum+$pola;
		      $nola=$n;
		  /*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		    }
		    $i++;
	      }
	      if($array->det_nla=="" || $nola=='00'){
		    $pola=(1*$arr_ase->ase_pla)/100;
		    $sum=$sum+$pola;
	        $nola="01";
	      }
        }
	    $def=round($array->det_nfi);
		$let=$this->ConvertirLetra($def);
		$por11=($no11*$arr_ase->ase_p11)/100;
		$por12=($no12*$arr_ase->ase_p12)/100;
		$por13=($no13*$arr_ase->ase_p13)/100;
		$por21=($no21*$arr_ase->ase_p21)/100;
		$por22=($no22*$arr_ase->ase_p22)/100;
		$por23=($no23*$arr_ase->ase_p23)/100;
		$por31=($no31*$arr_ase->ase_p31)/100;
		$por32=($no32*$arr_ase->ase_p32)/100;
		$por33=($no33*$arr_ase->ase_p33)/100;
		if($array->det_con==0)
		  $con="R";
		else
		  $con="A";
	    if($ci==""){
	      $ci=$array->ci;
	      $ap=$array->ap;
	      $no=$array->no;
	      $esp=$array->esp_id;
	      $n11=$no11;
	      $n12=$no12;
	      $n13=$no13;
	      $p11=$por11;
	      $p12=$por12;
	      $p13=$por13;
	      $n21=$no21;
	      $n22=$no22;
	      $n23=$no23;
	      $p21=$por21;
	      $p22=$por22;
	      $p23=$por23;
	      $n31=$no31;
	      $n32=$no32;
	      $n33=$no33;
	      $p31=$por31;
	      $p32=$por32;
	      $p33=$por33;
		  if($cant_lab>0 && $cant_teo>0){
  	        $nla=$nola;
   	        $pla=$pola;
		    $teor=$teo;
	      }
	      $defi=$def;
	      $letr=$let;
	      $cond=$con;
		}
	    else{
	      $ci=$ci."*".$array->ci;
	      $ap=$ap."*".$array->ap;
	      $no=$no."*".$array->no;
	      $esp=$esp."*".$array->esp_id;
	      $n11=$n11."*".$no11;
	      $n12=$n12."*".$no12;
	      $n13=$n13."*".$no13;
	      $p11=$p11."*".$por11;
	      $p12=$p12."*".$por12;
	      $p13=$p13."*".$por13;
	      $n21=$n21."*".$no21;
	      $n22=$n22."*".$no22;
	      $n23=$n23."*".$no23;
	      $p21=$p21."*".$por21;
	      $p22=$p22."*".$por22;
	      $p23=$p23."*".$por23;
	      $n31=$n31."*".$no31;
	      $n32=$n32."*".$no32;
	      $n33=$n33."*".$no33;
	      $p31=$p31."*".$por31;
	      $p32=$p32."*".$por32;
	      $p33=$p33."*".$por33;
		  if($cant_lab>0 && $cant_teo>0){
  	        $nla=$nla."*".$nola;
   	        $pla=$pla."*".$pola;
		    $teor=$teor."*".$teo;
	      }
	      $defi=$defi."*".$def;
	      $letr=$letr."*".$let;
	      $cond=$cond."*".$con;
	    }
	    $cuantos++;
	  }
    if($arr_ase->ase_f11!="") $fech11=$this->fechaNormal($arr_ase->ase_f11); else $fech11="";
    if($arr_ase->ase_f12!="") $fech12=$this->fechaNormal($arr_ase->ase_f12); else $fech12="";
    if($arr_ase->ase_f13!="") $fech13=$this->fechaNormal($arr_ase->ase_f13); else $fech13="";
	if($arr_ase->ase_f21!="") $fech21=$this->fechaNormal($arr_ase->ase_f21); else $fech21="";
    if($arr_ase->ase_f22!="") $fech22=$this->fechaNormal($arr_ase->ase_f22); else $fech22="";
    if($arr_ase->ase_f23!="") $fech23=$this->fechaNormal($arr_ase->ase_f23); else $fech23="";
    if($arr_ase->ase_f31!="") $fech31=$this->fechaNormal($arr_ase->ase_f31); else $fech31="";
    if($arr_ase->ase_f32!="") $fech32=$this->fechaNormal($arr_ase->ase_f32); else $fech32="";
    if($arr_ase->ase_f33!="") $fech33=$this->fechaNormal($arr_ase->ase_f33); else $fech33="";
	$this->res=$ci."@".$ap."@".$no."@".$n11."@".$n12."@".$n13."@".$p11."@".$p12."@".$p13."@".$n21."@".$n22."@".$n23."@".$p21."@".$p22."@".$p23."@".$n31."@".$n32."@".$n33."@".$p31."@".$p32."@".$p33."@".$nla."@".$pla."@".$teor."@".$defi."@".$letr."@".$cond."@".$cuantos."@".$fech11."@".$fech12."@".$fech13."@".$fech21."@".$fech22."@".$fech23."@".$fech31."@".$fech32."@".$fech33."@".$arr_ase->ase_p11."@".$arr_ase->ase_p12."@".$arr_ase->ase_p13."@".$arr_ase->ase_p21."@".$arr_ase->ase_p22."@".$arr_ase->ase_p23."@".$arr_ase->ase_p31."@".$arr_ase->ase_p32."@".$arr_ase->ase_p33."@".$arr_ase->ase_pla."@".$arr_doc->ci."@".$arr_doc->ap1." ".$arr_doc->ap2." ".$arr_doc->no1." ".$arr_doc->no2."@".$cant_lab."@".$cant_teo."@".$esp;
	$this->res=$this->ConvertirMayuscula($this->res);
	return $this->res;
  }
//******************************************************************
  function Buscar_Repa($valor){
	$this->pac_id=$_SESSION[pac_id];
    $this->coh_id=$_SESSION[coh_id];
    $this->mod_id=$_SESSION[mod_id];
    $this->reg_id=$_SESSION[reg_id];
    $this->esp_id=$_SESSION[esp_id];
    $this->pen_top=$_SESSION[pen_top];
	$this->asi_cod=$_SESSION[asi_cod];
	$this->cb=$_SESSION[cb];
	$this->sec_id=$valor;
	if($this->reg_id==3 && $this->cb==1){
      $resp=$this->Listado_Alumno_Ing_CB_Diurno_Rep($valor);
/*	  echo "<script>alert('SELECT * FROM asigna_seccio WHERE esp_id IN(2113D,2122D,2126D) AND mod_id=$this->mod_id AND coh_id=$this->coh_id AND reg_id=$this->reg_id AND sec_id=$this->sec_id AND pac_id=$this->pac_id AND asi_cod=$this->asi_cod AND ase_sta=1');</script>";*/
	  $res_ase=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE esp_id IN('2113D','2122D','2126D') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND ase_sta='1'");
	  $arr_ase=$this->ConsultarCualquiera($res_ase);
	  $res_asi=$this->OperacionCualquiera("SELECT DISTINCT(asi_cod), asi_rep FROM asigna WHERE asi_cod='$this->asi_cod' AND coh_id='$this->coh_id' AND mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id IN('2113D','2122D','2126D') AND pen_top='$this->pen_top'");
      $asigna=$this->ConsultarCualquiera($res_asi);
/*	  echo "<script>alert('SELECT * FROM asigna_seccio WHERE esp_id IN(2113D,2122D,2126D) AND mod_id=$this->mod_id AND coh_id=$this->coh_id AND reg_id=$this->reg_id AND sec_id=$this->sec_id AND pac_id=$this->pac_id AND asi_cod=$this->asi_cod AND ase_sta=1');</script>";*/
	  $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS teo FROM horario WHERE esp_id IN('2113D','2122D','2126D') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='0'");
	  $cuan=$this->ConsultarCualquiera($contar);
	  $cant_teo=$cuan->teo;
	  $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS pra FROM horario WHERE esp_id IN('2113D','2122D','2126D') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='1'");
	  $cuan=$this->ConsultarCualquiera($contar);
	  $cant_pra=$cuan->pra;
	  $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS lab FROM horario WHERE esp_id IN('2113D','2122D','2126D') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='2'");
	  $cuan=$this->ConsultarCualquiera($contar);
	  $cant_lab=$cuan->lab;
	}
	else{
	  if($this->reg_id==4 && $this->cb==1){
        $resp=$this->Listado_Alumno_Ing_CB_Nocturno_Rep($valor);
		$res_ase=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE esp_id IN('2113N','2122N','2126N') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND ase_sta='1'");
	    $arr_ase=$this->ConsultarCualquiera($res_ase);
	    $res_asi=$this->OperacionCualquiera("SELECT DISTINCT(asi_cod), asi_rep FROM asigna WHERE asi_cod='$this->asi_cod' AND coh_id='$this->coh_id' AND mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id IN('2113N','2122N','2126N') AND pen_top='$this->pen_top'");
        $asigna=$this->ConsultarCualquiera($res_asi);
	    $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS teo FROM horario WHERE esp_id IN('2113N','2122N','2126N') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='0'");
	    $cuan=$this->ConsultarCualquiera($contar);
	    $cant_teo=$cuan->teo;
		$contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS pra FROM horario WHERE esp_id IN('2113N','2122N','2126N') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='1'");
	    $cuan=$this->ConsultarCualquiera($contar);
	    $cant_pra=$cuan->pra;
	    $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS lab FROM horario WHERE esp_id IN('2113N','2122N','2126N') AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='2'");
	    $cuan=$this->ConsultarCualquiera($contar);
	    $cant_lab=$cuan->lab;
      }
	  else{
        $resp=$this->Listado_Alumno_Lic_IngCP_Rep($valor);
	    $res_ase=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE esp_id='$this->esp_id' AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND ase_sta='1'");
	    $arr_ase=$this->ConsultarCualquiera($res_ase);
	    $res_asi=$this->OperacionCualquiera("SELECT DISTINCT(asi_cod), asi_rep FROM asigna WHERE asi_cod='$this->asi_cod' AND coh_id='$this->coh_id' AND mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND pen_top='$this->pen_top'");
        $asigna=$this->ConsultarCualquiera($res_asi);
  	    $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS teo FROM horario WHERE esp_id='$this->esp_id' AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='0'");
	    $cuan=$this->ConsultarCualquiera($contar);
	    $cant_teo=$cuan->teo;
		$contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS pra FROM horario WHERE esp_id='$this->esp_id' AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='1'");
	    $cuan=$this->ConsultarCualquiera($contar);
	    $cant_pra=$cuan->pra;
	    $contar=$this->OperacionCualquiera("SELECT COUNT(hor_tpl) AS lab FROM horario WHERE esp_id='$this->esp_id' AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='2'");
	    $cuan=$this->ConsultarCualquiera($contar);
	    $cant_lab=$cuan->lab;
	  }
	}
	$res_doc=$this->OperacionCualquiera("SELECT * FROM persona WHERE ci='$arr_ase->ci_emp'");
    $arr_doc=$this->ConsultarCualquiera($res_doc);
    $cond="";
    $fina="";
    $repa="";
    $defi="";
	$letr="";
	$esp="";
    $ci="";
	$cuantos=0;
	while($array=$this->ConsultarCualquiera($resp)){	
	  $enc=0;
  	  $i=1;
  	  while($i<=20 && $enc==0){
  	    if($i<10) $n="0".$i; else $n=$i;
  		$nota=md5($n);
  		if($array->det_nla==$nota)
  	      $enc=1;
  	    $i++;
  	  }
  	  $i=$i-1;
  	  if($i>=10 && (($array->det_con==1 && $array->det_nre!='' && $array->obs_id!='7' && $array->obs_id!='1') || $array->det_con==0)){  
	    $res_obs=$this->OperacionCualquiera("SELECT * FROM observ WHERE obs_id='$array->obs_id'");
        $arr_obs=$this->ConsultarCualquiera($res_obs);
	    $let=$this->ConvertirLetra($array->det_nde);
	    if($ci==""){
	      $ci=$array->ci;
	      $ap=$array->ap;
	      $no=$array->no;
	      $esp=$array->esp_id;
	      $fina=$array->det_nfi;
	      $repa=$array->det_nre;
  	      $defi=$array->det_nde;
	      $letr=$let;
	      $cond=$arr_obs->obs_des;
	    }
	    else{
	      $ci=$ci."*".$array->ci;
	      $ap=$ap."*".$array->ap;
	      $no=$no."*".$array->no;
	      $esp=$esp."*".$array->esp_id;
	      $fina=$fina."*".$array->det_nfi;
	      $repa=$repa."*".$array->det_nre;
	      $defi=$defi."*".$array->det_nde;
	      $letr=$letr."*".$let;
	      $cond=$cond."*".$arr_obs->obs_des;
	    }
	    $cuantos++;
	  }
	}
	if($asigna->asi_rep==0)
	  $cuantos='-1';
	$this->res=$ci."@".$ap."@".$no."@".$fina."@".$repa."@".$defi."@".$letr."@".$cond."@".$cuantos."@".$arr_doc->ci."@".$arr_doc->ap1." ".$arr_doc->ap2." ".$arr_doc->no1." ".$arr_doc->no2."@".$cant_lab."@".$cant_teo."@".$esp;
	$this->res=$this->ConvertirMayuscula($this->res);
	return $this->res;
  }
//******************************************************************

function ConvertirLetra($num){
/*echo "<script>alert('$num');</script>";*/
  $let="";
  if($num!=""){
    if($num==1)
	  $let="UNO";
    if($num==2)
	  $let="DOS";
    if($num==3)
	  $let="TRES";
    if($num==4)
	  $let="CUATRO";
    if($num==5)
	  $let="CINCO";
    if($num==6)
	  $let="SEIS";
    if($num==7)
	  $let="SIETE";
    if($num==8)
	  $let="OCHO";
    if($num==9)
	  $let="NUEVE";
    if($num==10)
	  $let="DIEZ";
    if($num==11)
	  $let="ONCE";
    if($num==12)
	  $let="DOCE";
    if($num==13)
	  $let="TRECE";
    if($num==14)
	  $let="CATORCE";
    if($num==15)
	  $let="QUINCE";
    if($num==16)
	  $let="DIECISEIS";
    if($num==17)
	  $let="DIECISIETE";
    if($num==18)
	  $let="DIECIOCHO";
    if($num==19)
	  $let="DIECINUEVE";
    if($num==20)
	  $let="VEINTE";
  }
  return $let;
}
//******************************************************************
  function Buscar_pensum($mod_id, $reg_id, $esp_id, $coh_id, $pen_top){
/*  echo "<script>alert('SELECT A.mod_id AS mod_id, B.mod_nom AS mod_nom, A.reg_id AS reg_id, C.reg_nom AS reg_nom, A.esp_id AS esp_id, D.esp_nom AS esp_nom, A.coh_id AS coh_id, E.coh_nom AS coh_nom, A.pen_top AS pen_top, A.pen_mpa AS pen_mpa, A.pen_muc AS pen_muc, A.pen_mpe AS pen_mpe, A.pen_obs AS pen_obs FROM pensum A, modali B, regimen C, especi D, cohort E WHERE A.mod_id=$mod_id AND A.mod_id=B.mod_id AND A.reg_id=$reg_id AND A.reg_id=C.reg_id AND A.esp_id=$esp_id AND A.esp_id=D.esp_id AND A.coh_id=$coh_id AND A.coh_id=E.coh_id AND A.pen_top=$pen_top');</script>";*/
    $this->Operacion("SELECT A.mod_id AS 'mod_id', B.mod_nom AS 'mod_nom', A.reg_id AS 'reg_id', C.reg_nom AS 'reg_nom', A.esp_id AS 'esp_id', D.esp_nom AS 'esp_nom', A.coh_id AS 'coh_id', E.coh_nom AS 'coh_nom', A.pen_top AS 'pen_top', A.pen_mpa AS 'pen_mpa', A.pen_muc AS 'pen_muc', A.pen_mpe AS 'pen_mpe', A.pen_obs AS 'pen_obs' FROM pensum A, modali B, regimen C, especi D, cohort E WHERE A.mod_id='$mod_id' AND A.mod_id=B.mod_id AND A.reg_id='$reg_id' AND A.reg_id=C.reg_id AND A.esp_id='$esp_id' AND A.esp_id=D.esp_id AND A.coh_id='$coh_id' AND A.coh_id=E.coh_id AND A.pen_top='$pen_top'");
  }
//******************************************************************
  function Buscar_Asigna($asi_cod){
    $coh_id=$_SESSION[coh_id];
    $mod_id=$_SESSION[mod_id];
    $reg_id=$_SESSION[reg_id];
    $esp_id=$_SESSION[esp_id];
    $pen_top=$_SESSION[pen_top];
/*  echo "<script>alert('SELECT * FROM asigna WHERE mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND coh_id=$coh_id AND pen_top=$pen_top AND asi_cod=$asi_cod');</script>";*/
    $resultado=$this->Operacion("SELECT * FROM asigna WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND asi_cod='$asi_cod'");
	return $resultado;
  }
//******************************************************************
  function Buscar_Asigna_Ing_CB_Diurno($asi_cod){
    $coh_id=$_SESSION[coh_id];
    $mod_id=$_SESSION[mod_id];
    $reg_id=$_SESSION[reg_id];
    $esp_id=$_SESSION[esp_id];
    $pen_top=$_SESSION[pen_top];
/*  echo "<script>alert('SELECT * FROM asigna WHERE mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND coh_id=$coh_id AND pen_top=$pen_top AND asi_cod=$asi_cod');</script>";*/
    $resultado=$this->Operacion("SELECT * FROM asigna WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id IN('2113D','2126D','2122D') AND coh_id='$coh_id' AND pen_top='$pen_top' AND asi_cod='$asi_cod'");
	return $resultado;
  }
//******************************************************************
  function Buscar_Asigna_Ing_CB_Nocturno($asi_cod){
    $coh_id=$_SESSION[coh_id];
    $mod_id=$_SESSION[mod_id];
    $reg_id=$_SESSION[reg_id];
    $esp_id=$_SESSION[esp_id];
    $pen_top=$_SESSION[pen_top];
/*  echo "<script>alert('SELECT * FROM asigna WHERE mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND coh_id=$coh_id AND pen_top=$pen_top AND asi_cod=$asi_cod');</script>";*/
    $resultado=$this->Operacion("SELECT * FROM asigna WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id IN('2113N','2126N','2122N') AND coh_id='$coh_id' AND pen_top='$pen_top' AND asi_cod='$asi_cod'");
	return $resultado;
  }
//******************************************************************
  function Buscar_Electiva($asi_cod){
	$pac_id=$_SESSION[pac_id];
    $coh_id=$_SESSION[coh_id];
    $mod_id=$_SESSION[mod_id];
    $reg_id=$_SESSION[reg_id];
    $esp_id=$_SESSION[esp_id];
    $pen_top=$_SESSION[pen_top];
/*  echo "<script>alert('SELECT A.mod_id AS mod_id, B.mod_nom AS mod_nom, A.reg_id AS reg_id, C.reg_nom AS reg_nom, A.esp_id AS esp_id, D.esp_nom AS esp_nom, A.coh_id AS coh_id, E.coh_nom AS coh_nom, A.pen_top AS pen_top, A.pen_mpa AS pen_mpa, A.pen_muc AS pen_muc, A.pen_mpe AS pen_mpe, A.pen_obs AS pen_obs FROM pensum A, modali B, regimen C, especi D, cohort E WHERE A.mod_id=$mod_id AND A.mod_id=B.mod_id AND A.reg_id=$reg_id AND A.reg_id=C.reg_id AND A.esp_id=$esp_id AND A.esp_id=D.esp_id AND A.coh_id=$coh_id AND A.coh_id=E.coh_id AND A.pen_top=$pen_top');</script>";*/
    $resultado=$this->Operacion("SELECT B.ele_nom AS 'ele_nom' FROM asigna_seccio A, electi B WHERE A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND asi_cod='$asi_cod' AND pac_id='$pac_id' AND A.ele_cod=B.ele_cod");
	return $resultado;
  }
//******************************************************************
  function Buscar_Seccion($sec_id){
    $this->coh_id=$_SESSION[coh_id];
    $this->mod_id=$_SESSION[mod_id];
    $this->reg_id=$_SESSION[reg_id];
    $this->esp_id=$_SESSION[esp_id];
    $this->pen_top=$_SESSION[pen_top];
/*  echo "<script>alert('SELECT A.mod_id AS mod_id, B.mod_nom AS mod_nom, A.reg_id AS reg_id, C.reg_nom AS reg_nom, A.esp_id AS esp_id, D.esp_nom AS esp_nom, A.coh_id AS coh_id, E.coh_nom AS coh_nom, A.pen_top AS pen_top, A.pen_mpa AS pen_mpa, A.pen_muc AS pen_muc, A.pen_mpe AS pen_mpe, A.pen_obs AS pen_obs FROM pensum A, modali B, regimen C, especi D, cohort E WHERE A.mod_id=$mod_id AND A.mod_id=B.mod_id AND A.reg_id=$reg_id AND A.reg_id=C.reg_id AND A.esp_id=$esp_id AND A.esp_id=D.esp_id AND A.coh_id=$coh_id AND A.coh_id=E.coh_id AND A.pen_top=$pen_top');</script>";*/
    $resultado=$this->Operacion("SELECT * FROM seccio WHERE sec_id='$sec_id'");
	return $resultado;
  }
//******************************************************************
  function Buscar_pensum_CB_Diurno($mod_id, $reg_id, $esp_id, $coh_id, $pen_top){
/*  echo "<script>alert('SELECT A.mod_id AS mod_id, B.mod_nom AS mod_nom, A.reg_id AS reg_id, C.reg_nom AS reg_nom, A.esp_id AS esp_id, D.esp_nom AS esp_nom, A.coh_id AS coh_id, E.coh_nom AS coh_nom, A.pen_top AS pen_top, A.pen_mpa AS pen_mpa, A.pen_muc AS pen_muc, A.pen_mpe AS pen_mpe, A.pen_obs AS pen_obs FROM pensum A, modali B, regimen C, especi D, cohort E WHERE A.mod_id=$mod_id AND A.mod_id=B.mod_id AND A.reg_id=$reg_id AND A.reg_id=C.reg_id AND A.esp_id=$esp_id AND A.esp_id=D.esp_id AND A.coh_id=$coh_id AND A.coh_id=E.coh_id AND A.pen_top=$pen_top');</script>";*/
    $this->Operacion("SELECT A.mod_id AS 'mod_id', B.mod_nom AS 'mod_nom', A.reg_id AS 'reg_id', C.reg_nom AS 'reg_nom', A.esp_id AS 'esp_id', D.esp_nom AS 'esp_nom', A.coh_id AS 'coh_id', E.coh_nom AS 'coh_nom', A.pen_top AS 'pen_top', A.pen_mpa AS 'pen_mpa', A.pen_muc AS 'pen_muc', A.pen_mpe AS 'pen_mpe', A.pen_obs AS 'pen_obs' FROM pensum A, modali B, regimen C, especi D, cohort E WHERE A.mod_id='$mod_id' AND A.mod_id=B.mod_id AND A.reg_id='$reg_id' AND A.reg_id=C.reg_id AND A.esp_id IN('2113D','2126D','2122D') AND A.esp_id=D.esp_id AND A.coh_id='$coh_id' AND A.coh_id=E.coh_id AND A.pen_top='$pen_top'");
  }
//******************************************************************
  function Buscar_pensum_CB_Nocturno($mod_id, $reg_id, $esp_id, $coh_id, $pen_top){
/*  echo "<script>alert('SELECT A.mod_id AS mod_id, B.mod_nom AS mod_nom, A.reg_id AS reg_id, C.reg_nom AS reg_nom, A.esp_id AS esp_id, D.esp_nom AS esp_nom, A.coh_id AS coh_id, E.coh_nom AS coh_nom, A.pen_top AS pen_top, A.pen_mpa AS pen_mpa, A.pen_muc AS pen_muc, A.pen_mpe AS pen_mpe, A.pen_obs AS pen_obs FROM pensum A, modali B, regimen C, especi D, cohort E WHERE A.mod_id=$mod_id AND A.mod_id=B.mod_id AND A.reg_id=$reg_id AND A.reg_id=C.reg_id AND A.esp_id=$esp_id AND A.esp_id=D.esp_id AND A.coh_id=$coh_id AND A.coh_id=E.coh_id AND A.pen_top=$pen_top');</script>";*/
    $this->Operacion("SELECT A.mod_id AS 'mod_id', B.mod_nom AS 'mod_nom', A.reg_id AS 'reg_id', C.reg_nom AS 'reg_nom', A.esp_id AS 'esp_id', D.esp_nom AS 'esp_nom', A.coh_id AS 'coh_id', E.coh_nom AS 'coh_nom', A.pen_top AS 'pen_top', A.pen_mpa AS 'pen_mpa', A.pen_muc AS 'pen_muc', A.pen_mpe AS 'pen_mpe', A.pen_obs AS 'pen_obs' FROM pensum A, modali B, regimen C, especi D, cohort E WHERE A.mod_id='$mod_id' AND A.mod_id=B.mod_id AND A.reg_id='$reg_id' AND A.reg_id=C.reg_id AND A.esp_id IN('2113N','2126N','2122N') AND A.esp_id=D.esp_id AND A.coh_id='$coh_id' AND A.coh_id=E.coh_id AND A.pen_top='$pen_top'");
  }
//******************************************************************
  function Buscar_Secciones($valor){
    $id="";
	$des="";
	$cuantos=0;
	$this->pac_id=$_SESSION[pac_id];
    $this->coh_id=$_SESSION[coh_id];
    $this->mod_id=$_SESSION[mod_id];
    $this->reg_id=$_SESSION[reg_id];
    $this->esp_id=$_SESSION[esp_id];
    $this->pen_top=$_SESSION[pen_top];
	$this->cb=$_SESSION[cb];
	$_SESSION[asi_cod]=$this->asi_cod=$valor;
    $infrae='';
    $resp=$this->Listado_infraestructura();
	while($inf=$this->ConsultarCualquiera($resp)){
	  if($infrae=='')
	    $infrae="'".$inf->inf_id."'";
	  else
	    $infrae="'".$inf->inf_id."',".$infrae;
	}
	  if($this->reg_id=='3' && $this->cb=='1'){
/*	  echo "<script>alert('SELECT DISTINCT(A.sec_id) AS sec_id, A.sec_nom AS sec_nom FROM seccio A, asigna_seccio B WHERE A.sec_id=B.sec_id AND B.mod_id=$this->mod_id AND B.reg_id=$this->reg_id AND B.esp_id IN(2113D,2126D,2122D) AND B.coh_id=$this->coh_id AND B.asi_cod=$this->asi_cod AND B.pac_id=$this->pac_id AND ase_sta=1 AND A.inf_id IN ()');</script>";*/
        $resp=$this->OperacionCualquiera("SELECT DISTINCT(A.sec_id) AS 'sec_id', A.sec_nom AS 'sec_nom', C.inf_nom AS 'inf_nom' FROM seccio A, asigna_seccio B, infrae C WHERE A.inf_id=C.inf_id AND A.sec_id=B.sec_id AND B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id IN('2113D','2126D','2122D') AND B.coh_id='$this->coh_id' AND B.asi_cod='$this->asi_cod' AND B.pac_id='$this->pac_id' AND ase_sta='1' AND A.inf_id IN ($infrae) ORDER BY C.inf_nom, A.sec_nom DESC");
	  }
	  else{
	    if($this->reg_id=='4' && $this->cb=='1')
          $resp=$this->OperacionCualquiera("SELECT DISTINCT(A.sec_id) AS 'sec_id', A.sec_nom AS 'sec_nom', C.inf_nom AS 'inf_nom' FROM seccio A, asigna_seccio B, infrae C WHERE A.inf_id=C.inf_id AND A.sec_id=B.sec_id AND B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id IN('2113N','2126N','2122N') AND B.coh_id='$this->coh_id' AND B.asi_cod='$this->asi_cod' AND B.pac_id='$this->pac_id' AND ase_sta='1' AND A.inf_id IN ($infrae) ORDER BY C.inf_nom, A.sec_nom DESC");
	    else
	      $resp=$this->OperacionCualquiera("SELECT DISTINCT(A.sec_id) AS 'sec_id', A.sec_nom AS 'sec_nom', C.inf_nom AS 'inf_nom' FROM seccio A, asigna_seccio B, infrae C WHERE A.inf_id=C.inf_id AND A.sec_id=B.sec_id AND B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id='$this->esp_id' AND B.coh_id='$this->coh_id' AND B.asi_cod='$this->asi_cod' AND B.pac_id='$this->pac_id' AND ase_sta='1' AND A.inf_id IN ($infrae) ORDER BY C.inf_nom, A.sec_nom DESC");
	  }
	  while($array=$this->ConsultarCualquiera($resp)){
	    if($id==""){
	      $id=$array->sec_id;
	      $des=$array->sec_nom."-".$array->inf_nom;
	    }
	    else{
	      $id=$array->sec_id."*".$id;
	      $des=$array->sec_nom."-".$array->inf_nom."*".$des;
	    }
	    $cuantos++;
	  }
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
}?>