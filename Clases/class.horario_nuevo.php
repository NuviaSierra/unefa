<?php session_start();
class horario extends conec_BD
{
 var $pen_top='';
 var $sec_id='';
 var $asi_cod='';
 var $esp_id='';
 var $reg_id='';
 var $mod_id='';
 var $coh_id='';
 var $pac_id='';
 var $aul_id='';
 var $blh_id='';
 var $dia_id='';
 var $dbh_tip='';
 var $hor_com='';
 var $ci='';
 var $inf_id='';
 var $sta='';
//******************************************************************
  function horario($pen_top,$sec_id,$asi_cod,$esp_id,$reg_id,$mod_id,$coh_id,$pac_id,$aul_id,$blh_id,$dia_id,$hor_com,$inf_id,$sta){
    $this->pen_top=$pen_top;
    $this->sec_id=$sec_id;
    $this->asi_cod=$asi_cod;
    $this->esp_id=$esp_id;
    $this->reg_id=$reg_id;
    $this->mod_id=$mod_id;
    $this->coh_id=$coh_id;
    $this->pac_id=$pac_id;
    $this->aul_id=$aul_id;
    $this->blh_id=$blh_id;
    $this->dia_id=$dia_id;
    $this->dbh_tip='0';
    $this->hor_com=$hor_com;
    $this->ci=$_SESSION['ci'];
	$this->inf_id=$inf_id;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_horario_Nucleo_Infrae_asignatura($nuc_id,$inf_id,$asi_cod){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_nom AS 'asi_nom', A.asi_cba AS 'asi_cba', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_id AS 'nuc_id', C.nuc_nom AS 'nuc_nom' FROM asigna A, infrae B, nucleo C, seccio D, asigna_seccio E WHERE C.nuc_id='$nuc_id' AND B.inf_id='$inf_id' AND A.asi_cod=E.asi_cod AND A.asi_cod='$asi_cod' AND E.sec_id=D.sec_id AND B.inf_id=D.inf_id AND B.nuc_id=C.nuc_id AND E.pac_id='$this->pac_id' AND E.ase_sta='1' AND E.ci_emp='$this->ci' AND B.inf_id IN (SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->ci') AND A.asi_cod IN (SELECT DISTINCT(A.asi_cod) FROM asigna_seccio A, matric B WHERE A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.matr_tip='1' AND B.matr_sta='1' AND B.ci='$this->ci' AND A.pac_id='$this->pac_id')");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Contar_horario_Todas($ci_doc){
    $num_filas='';
/*	echo "<script>alert('SELECT hor_id FROM horario as A RIGHT JOIN (SELECT D.pac_id AS pac_id, D.coh_id AS coh_id, D.mod_id AS mod_id, D.reg_id AS reg_id, D.esp_id AS esp_id, D.pen_top AS pen_top, F.asi_cod AS asi_cod, F.sec_id AS sec_id, E.inf_id AS inf_id FROM coo_asi_pac_inf D, seccio E, asigna_seccio F WHERE D.pac_id=$this->pac_id AND D.capi_sta=1 and D.inf_id=E.inf_id AND E.sec_sta=1 AND E.sec_id=F.sec_id AND F.ase_sta=1 AND D.asi_cod=F.asi_cod AND D.esp_id=F.esp_id AND D.reg_id=F.reg_id AND D.mod_id=F.mod_id AND D.coh_id=F.coh_id AND D.pen_top=F.pen_top AND D.pac_id=F.pac_id AND D.ci=$this->ci) as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta=1 AND A.pac_id=$this->pac_id AND A.ci=$ci_doc GROUP BY hor_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id');</script>";*/
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT hor_id FROM horario as A RIGHT JOIN (SELECT D.pac_id AS 'pac_id', D.coh_id AS 'coh_id', D.mod_id AS 'mod_id', D.reg_id AS 'reg_id', D.esp_id AS 'esp_id', D.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id' FROM coo_asi_pac_inf D, seccio E, asigna_seccio F WHERE D.pac_id='$this->pac_id' AND D.capi_sta='1' and D.inf_id=E.inf_id AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND D.asi_cod=F.asi_cod AND D.esp_id=F.esp_id AND D.reg_id=F.reg_id AND D.mod_id=F.mod_id AND D.coh_id=F.coh_id AND D.pen_top=F.pen_top AND D.pac_id=F.pac_id AND D.ci='$this->ci') as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' GROUP BY hor_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id");
    $num_filas=$this->NumFilas();	/*echo "<script>alert('FILAS: $num_filas');</script>";*/
    return $num_filas;
  }
//******************************************************************
  function Contar_horario_Nucleo_Infrae($nuc_id,$inf_id,$ci_doc){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT hor_id FROM horario as A RIGHT JOIN (SELECT D.pac_id AS 'pac_id', D.coh_id AS 'coh_id', D.mod_id AS 'mod_id', D.reg_id AS 'reg_id', D.esp_id AS 'esp_id', D.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id' FROM coo_asi_pac_inf D, seccio E, asigna_seccio F, infrae G WHERE G.inf_id=E.inf_id AND G.nuc_id='$nuc_id' AND G.inf_id='$inf_id' AND D.pac_id='$this->pac_id' AND D.capi_sta='1' and D.inf_id=E.inf_id AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND D.asi_cod=F.asi_cod AND D.esp_id=F.esp_id AND D.reg_id=F.reg_id AND D.mod_id=F.mod_id AND D.coh_id=F.coh_id AND D.pen_top=F.pen_top AND D.pac_id=F.pac_id AND D.ci='$this->ci') as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' GROUP BY hor_id");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Contar_horario_Nucleo_Todas($nuc_id,$ci_doc){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_nom AS 'asi_nom', A.asi_cba AS 'asi_cba', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_id AS 'nuc_id', C.nuc_nom AS 'nuc_nom' FROM asigna A, infrae B, nucleo C, seccio D, asigna_seccio E WHERE C.nuc_id='$nuc_id' AND  A.asi_cod=E.asi_cod AND E.sec_id=D.sec_id AND B.inf_id=D.inf_id AND B.nuc_id=C.nuc_id AND E.pac_id='$this->pac_id' AND E.ase_sta='1' AND E.ci_emp='$this->ci' AND B.inf_id IN (SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->ci') AND A.asi_cod IN (SELECT DISTINCT(A.asi_cod) FROM asigna_seccio A, matric B WHERE A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.matr_tip='1' AND B.matr_sta='1' AND B.ci='$this->ci' AND A.pac_id='$this->pac_id')");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Contar_horario_Nucleo_Todas_asignatura($nuc_id,$asi_cod){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT hor_id FROM horario as A RIGHT JOIN (SELECT D.pac_id AS 'pac_id', D.coh_id AS 'coh_id', D.mod_id AS 'mod_id', D.reg_id AS 'reg_id', D.esp_id AS 'esp_id', D.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id' FROM coo_asi_pac_inf D, seccio E, asigna_seccio F, infrae G WHERE G.inf_id=E.inf_id AND G.nuc_id='$nuc_id' AND D.pac_id='$this->pac_id' AND D.capi_sta='1' and D.inf_id=E.inf_id AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND D.asi_cod=F.asi_cod AND D.esp_id=F.esp_id AND D.reg_id=F.reg_id AND D.mod_id=F.mod_id AND D.coh_id=F.coh_id AND D.pen_top=F.pen_top AND D.pac_id=F.pac_id AND D.ci='$this->ci') as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' GROUP BY hor_id  ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_horario_Nucleo_Infrae_asignatura($nuc_id,$inf_id,$asi_cod){
    $resultado=$this->Operacion("SELECT A.ci_emp AS 'ci_doc', A.ci_doc_pol AS 'ci_doc_aux', A.coh_id AS 'coh_id', A.mod_id AS 'mod_id', A.reg_id AS 'reg_id', A.esp_id AS 'esp_id', A.asi_cod AS 'asi_cod', A.sec_id AS 'sec_id',A.ele_cod AS 'ele_cod', B.coh_nom AS 'coh_nom', B.mod_nom AS 'mod_nom', B.reg_nom AS 'reg_nom', B.esp_nom AS 'esp_nom', B.asi_nom AS 'asi_nom', B.sec_nom AS 'sec_nom', B.ele_nom AS 'ele_nom', B.asi_cht AS 'asi_cht', B.asi_chp AS 'asi_chp', B.asi_chl AS 'asi_chl', B.asi_lab AS 'asi_lab' FROM asigna_seccio as A RIGHT JOIN (SELECT C.pac_id AS 'pac_id', H.coh_nom AS 'coh_nom', E.mod_nom AS 'mod_nom', G.reg_nom AS 'reg_nom', F.esp_nom AS 'esp_nom', D.asi_nom AS 'asi_nom', K.sec_nom AS 'sec_nom', L.ele_nom AS 'ele_nom', D.asi_cht AS 'asi_cht', D.asi_chp AS 'asi_chp', D.asi_chl AS 'asi_chl', D.asi_lab AS 'asi_lab', H.coh_id AS 'coh_id', E.mod_id AS 'mod_id', G.reg_id AS 'reg_id', F.esp_id AS 'esp_id', D.asi_cod AS 'asi_cod', K.sec_id AS 'sec_id', L.ele_cod AS 'ele_cod', D.pen_top AS 'pen_top', I.nuc_nom AS 'nuc_nom', I.nuc_id AS 'nuc_id', J.inf_id AS 'inf_id', J.inf_nom AS 'inf_nom' FROM coo_asi_pac_inf C, asigna D, modali E, especi F, regimen G, cohort H, nucleo I, infrae J, seccio K, electi L, asigna_seccio M WHERE I.nuc_id='$nuc_id' AND J.inf_id='$inf_id' AND C.pac_id='$this->pac_id' AND C.capi_sta='1' AND D.asi_sta='1' AND C.asi_cod=D.asi_cod AND C.pen_top=D.pen_top AND C.esp_id=D.esp_id AND C.reg_id=D.reg_id AND C.mod_id=D.mod_id AND C.coh_id=D.coh_id AND C.pen_top=D.pen_top AND C.ci='$this->ci' AND C.mod_id=E.mod_id AND C.esp_id=F.esp_id AND C.reg_id=G.reg_id AND C.coh_id=H.coh_id AND I.nuc_id=J.nuc_id AND J.inf_id=K.inf_id AND K.sec_id=M.sec_id AND L.ele_cod=M.ele_cod AND M.ase_sta='1' AND C.asi_cod=M.asi_cod AND C.esp_id=M.esp_id AND C.reg_id=M.reg_id AND C.mod_id=M.mod_id AND C.coh_id=M.coh_id AND C.pen_top=M.pen_top AND C.pac_id=M.pac_id AND C.pen_top=M.pen_top AND (M.ci_emp='0' OR M.ci_doc_pol='0')) as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id AND B.nuc_id='$nuc_id' AND B.inf_id='$inf_id' WHERE A.ase_sta='1' AND A.pac_id='$this->pac_id' GROUP BY B.nuc_id, B.inf_id, A.mod_id, A.esp_id, A.reg_id, A.coh_id, A.asi_cod, A.sec_id ORDER BY B.nuc_nom, B.inf_nom, B.asi_nom, B.sec_nom, B.mod_nom, B.esp_nom, B.reg_nom, B.coh_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_horario_Nucleo_Infrae($nuc_id,$inf_id,$inicial,$cantidad, $ci_doc){
    $resultado=$this->Operacion("SELECT hor_id FROM horario as A RIGHT JOIN (SELECT D.pac_id AS 'pac_id', D.coh_id AS 'coh_id', D.mod_id AS 'mod_id', D.reg_id AS 'reg_id', D.esp_id AS 'esp_id', D.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id' FROM coo_asi_pac_inf D, seccio E, asigna_seccio F, infrae G WHERE G.inf_id=E.inf_id AND G.nuc_id='$nuc_id' AND G.inf_id='$inf_id' AND D.pac_id='$this->pac_id' AND D.capi_sta='1' and D.inf_id=E.inf_id AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND D.asi_cod=F.asi_cod AND D.esp_id=F.esp_id AND D.reg_id=F.reg_id AND D.mod_id=F.mod_id AND D.coh_id=F.coh_id AND D.pen_top=F.pen_top AND D.pac_id=F.pac_id AND D.ci='$this->ci') as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' GROUP BY hor_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.mod_id, A.coh_id, A.esp_id, A.reg_id, A.pen_top LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Infrae($nuc_id,$ci_doc){
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' AND A.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->ci') AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND ci = '$ci_doc') order by A.inf_nom DESC");
	return $resultado;
  }
//******************************************************************
  function Listado_Infrae_Nucleo($inf_id){
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom', A.nuc_id AS 'nuc_id', B.nuc_nom AS 'nuc_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND A.inf_id='$inf_id'");
	return $resultado;
  }
//******************************************************************
  function Listado_horario_Nucleo_Todas_asignatura($nuc_id,$ci_doc){
    $resultado=$this->Operacion("SELECT A.ci_emp AS 'ci_doc', A.ci_doc_pol AS 'ci_doc_aux', A.coh_id AS 'coh_id', A.mod_id AS 'mod_id', A.reg_id AS 'reg_id', A.esp_id AS 'esp_id', A.asi_cod AS 'asi_cod', A.sec_id AS 'sec_id',A.ele_cod AS 'ele_cod', B.coh_nom AS 'coh_nom', B.mod_nom AS 'mod_nom', B.reg_nom AS 'reg_nom', B.esp_nom AS 'esp_nom', B.asi_nom AS 'asi_nom', B.sec_nom AS 'sec_nom', B.ele_nom AS 'ele_nom', B.asi_cht AS 'asi_cht', B.asi_chp AS 'asi_chp', B.asi_chl AS 'asi_chl', B.asi_lab AS 'asi_lab' FROM asigna_seccio as A RIGHT JOIN (SELECT C.pac_id AS 'pac_id', H.coh_nom AS 'coh_nom', E.mod_nom AS 'mod_nom', G.reg_nom AS 'reg_nom', F.esp_nom AS 'esp_nom', D.asi_nom AS 'asi_nom', K.sec_nom AS 'sec_nom', L.ele_nom AS 'ele_nom', D.asi_cht AS 'asi_cht', D.asi_chp AS 'asi_chp', D.asi_chl AS 'asi_chl', D.asi_lab AS 'asi_lab', H.coh_id AS 'coh_id', E.mod_id AS 'mod_id', G.reg_id AS 'reg_id', F.esp_id AS 'esp_id', D.asi_cod AS 'asi_cod', K.sec_id AS 'sec_id', L.ele_cod AS 'ele_cod', D.pen_top AS 'pen_top', I.nuc_nom AS 'nuc_nom', I.nuc_id AS 'nuc_id', J.inf_id AS 'inf_id', J.inf_nom AS 'inf_nom' FROM coo_asi_pac_inf C, asigna D, modali E, especi F, regimen G, cohort H, nucleo I, infrae J, seccio K, electi L, asigna_seccio M WHERE I.nuc_id='$nuc_id' AND C.pac_id='$this->pac_id' AND C.capi_sta='1' AND D.asi_sta='1' AND C.asi_cod=D.asi_cod AND C.pen_top=D.pen_top AND C.esp_id=D.esp_id AND C.reg_id=D.reg_id AND C.mod_id=D.mod_id AND C.coh_id=D.coh_id AND C.pen_top=D.pen_top AND C.ci='$this->ci' AND C.mod_id=E.mod_id AND C.esp_id=F.esp_id AND C.reg_id=G.reg_id AND C.coh_id=H.coh_id AND I.nuc_id=J.nuc_id AND J.inf_id=K.inf_id AND K.sec_id=M.sec_id AND L.ele_cod=M.ele_cod AND M.ase_sta='1' AND C.asi_cod=M.asi_cod AND C.esp_id=M.esp_id AND C.reg_id=M.reg_id AND C.mod_id=M.mod_id AND C.coh_id=M.coh_id AND C.pen_top=M.pen_top AND C.pac_id=M.pac_id AND C.pen_top=M.pen_top AND (M.ci_emp='0' OR M.ci_doc_pol='0')) as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id AND B.nuc_id='$nuc_id' WHERE A.ase_sta='1' AND A.pac_id='$this->pac_id' GROUP BY B.nuc_id, B.inf_id, A.mod_id, A.esp_id, A.reg_id, A.coh_id, A.asi_cod, A.sec_id ORDER BY B.nuc_nom, B.inf_nom, B.asi_nom, B.sec_nom, B.mod_nom, B.esp_nom, B.reg_nom, B.coh_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_horario_Nucleo_Todas($nuc_id,$inicial,$cantidad){
    $resultado=$this->Operacion("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_nom AS 'asi_nom', A.asi_cba AS 'asi_cba', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_id AS 'nuc_id', C.nuc_nom AS 'nuc_nom' FROM asigna A, infrae B, nucleo C, seccio D, asigna_seccio E WHERE C.nuc_id='$nuc_id' AND  A.asi_cod=E.asi_cod AND E.sec_id=D.sec_id AND B.inf_id=D.inf_id AND B.nuc_id=C.nuc_id AND E.pac_id='$this->pac_id' AND E.ase_sta='1' AND E.ci_emp='$this->ci' AND B.inf_id IN (SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->ci') AND A.asi_cod IN (SELECT DISTINCT(A.asi_cod) FROM asigna_seccio A, matric B WHERE A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.matr_tip='1' AND B.matr_sta='1' AND B.ci='$this->ci' AND A.pac_id='$this->pac_id')') ORDER BY nuc_nom,inf_nom,asi_nom,asi_cod LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Infraestructura_Nucleo($nuc_id,$ci_doc){
    $id=$nom="";
    $cuantos=0;
	$this->ci=$_SESSION['ci'];
    $resp=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' AND A.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->ci') AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND ci = '$ci_doc') order by A.inf_nom DESC");
    while($array=$this->ConsultarCualquiera($resp)){
	  $cadena=$array->inf_nom;
	  for ($i=0;$i<strlen($cadena);$i++){
        if($cadena[$i]=='Á')
          $cadena[$i]='A';
		else{
		  if($cadena[$i]=='É')
            $cadena[$i]='E';
		  else{
		    if($cadena[$i]=='Í')
              $cadena[$i]='I';
			else{
			  if($cadena[$i]=='Ó')
                $cadena[$i]='O';
			  else{
			    if($cadena[$i]=='Ú')
                  $cadena[$i]='U';
				else{
				  if($cadena[$i]=='Ñ')
                    $cadena[$i]='N';
				}
			  }
			}
		  }	
		}
      } 
	  if($id==""){
	    $id=$array->inf_id;
	    $nom=$cadena;
	  }
	  else{
	    $id=$array->inf_id."*".$id;
	    $nom=$cadena."*".$nom;
	  }
	  $cuantos++;
	}
	$this->res=$id."@".$nom."@".$cuantos;
  }
//******************************************************************
  function Listado_Nucleo($ci_doc){
    $resultado=$this->Operacion("SELECT DISTINCT (A.nuc_id) AS 'nuc_id', A.nuc_nom AS 'nuc_nom' FROM nucleo A, infrae B WHERE A.nuc_sta = '1' AND A.nuc_id = B.nuc_id AND B.inf_id IN (SELECT DISTINCT(C.inf_id) FROM estudi_infrae C, reg_esp_mod_infrae D, reg_esp_mod E, matric G WHERE C.inf_id = D.inf_id AND C.est_inf_ffi = '0000-00-00 00:00:00' AND D.mod_id = E.mod_id AND D.esp_id = E.esp_id AND D.reg_id = E.reg_id AND D.remi_sta = '1' AND E.rem_sta = '1' AND G.mod_id = E.mod_id AND G.esp_id = E.esp_id AND G.reg_id =E.reg_id AND G.matr_tip = '1' AND G.matr_sta = '1' AND C.ci = '$this->ci') AND B.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND ci = '$ci_doc') order by A.nuc_nom");
    return $resultado;
  }
  
  /*
  SELECT C.asi_cod AS 'asi_cod', C.asi_nom AS 'asi_nom', D.inf_id AS 'inf_id', D.inf_nom AS 'inf_nom', E.nuc_id AS 'nuc_id', E.nuc_nom AS 'nuc_nom', F.mod_id AS 'mod_id', F.mod_nom AS 'mod_nom', G.esp_id AS 'esp_id', G.esp_nom AS 'esp_nom', H.reg_id AS 'reg_id', H.reg_nom AS 'reg_nom', I.coh_id AS 'coh_id', I.coh_nom AS 'coh_nom', B.sec_id AS 'sec_id', B.sec_nom AS 'sec_nom' FROM asigna_seccio A, seccio B, asigna C, infrae D, nucleo E, modali F, especi G, regimen H, cohort I WHERE A.pac_id='$this->pac_id' AND A.asi_cod='$asi_cod' AND B.inf_id='$inf_id' AND C.asi_nom='$asi_nom' AND F.mod_id='$mod_id' AND G.esp_id='$esp_id' AND H.reg_id='$reg_id' AND I.coh_id='$coh_id' AND B.sec_id='$sec_id' AND A.sec_id=B.sec_id AND A.asi_cod=C.asi_cod AND A.mod_id=C.mod_id AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND B.inf_id=D.inf_id AND D.nuc_id=E.nuc_id AND A.mod_id=F.mod_id AND A.esp_id=G.esp_id AND A.reg_id=H.reg_id AND A.coh_id=I.coh_id AND A.ase_sta='1' AND B.sec_sta='1' AND C.asi_sta='1' AND D.inf_sta='1' AND E.nuc_sta='1' AND F.mod_sta='1' AND G.esp_sta='1' AND H.reg_sta='1' AND I.coh_sta='1' GROUP BY D.inf_id,F.mod_id,G.esp_id,H.reg_id,I_coh_id,A.asi_cod,C.asi_nom,B.sec_id
  */
//******************************************************************
  function Listado_horario_docente_Todas_asigna_seccio($ci_doc,$inf_id,$asi_cod,$asi_nom){
    //$this->ci=$_SESSION['nacid'];
    $resp=$this->Operacion("SELECT C.pac_id AS 'pac_id', N.coh_nom AS 'coh_nom', N.coh_id AS 'coh_id', N.mod_nom AS 'mod_nom', N.mod_id AS 'mod_id', N.reg_nom AS 'reg_nom', N.reg_id AS 'reg_id', N.esp_nom AS 'esp_nom', N.esp_id AS 'esp_id', N.asi_nom AS 'asi_nom', N.asi_cod AS 'asi_cod', N.asi_cht AS 'asi_cht', N.asi_chp AS 'asi_chp', N.asi_chl AS 'asi_chl', N.asi_lab AS 'asi_lab', N.pen_top AS 'pen_top', N.inf_id AS 'inf_id', N.inf_nom AS 'inf_nom', N.nuc_id AS 'nuc_id', N.nuc_nom AS 'nuc_nom', N.sec_id AS 'sec_id',N.sec_nom AS 'sec_nom' FROM coo_asi_pac_inf C LEFT JOIN (SELECT D.mod_id AS 'mod_id', E.mod_nom AS 'mod_nom', D.esp_id AS 'esp_id', F.esp_nom AS 'esp_nom', D.reg_id AS 'reg_id', G.reg_nom AS 'reg_nom', D.coh_id AS 'coh_id', H.coh_nom AS 'coh_nom', D.pen_top AS 'pen_top', D.asi_cod AS 'asi_cod', D.asi_nom AS 'asi_nom', D.asi_cht AS 'asi_cht', D.asi_chp AS 'asi_chp', D.asi_chl AS 'asi_chl', D.asi_lab AS 'asi_lab', J.inf_id AS 'inf_id', J.inf_nom AS 'inf_nom', I.nuc_id AS 'nuc_id', I.nuc_nom AS 'nuc_nom', L.sec_id AS 'sec_id', L.sec_nom AS 'sec_nom' FROM asigna D, modali E, especi F, regimen G, cohort H, nucleo I, infrae J, estudi_infrae_matric M, asigna_seccio K, seccio L WHERE D.asi_sta='1' AND E.mod_sta='1' AND F.esp_sta='1' AND G.reg_sta='1' AND H.coh_sta='1' AND I.nuc_sta='1' AND J.inf_sta='1' AND K.ase_sta='1' AND L.sec_sta='1' AND M.eim_sta='1' AND M.pen_top=D.pen_top AND M.esp_id=D.esp_id AND M.reg_id=D.reg_id AND M.mod_id=D.mod_id AND M.coh_id=D.coh_id AND M.mod_id=E.mod_id AND M.esp_id=F.esp_id AND M.reg_id=G.reg_id AND M.coh_id=H.coh_id AND M.inf_id=J.inf_id AND J.nuc_id=I.nuc_id AND M.pen_top=K.pen_top AND M.esp_id=K.esp_id AND M.reg_id=K.reg_id AND M.mod_id=K.mod_id AND M.coh_id=K.coh_id AND D.asi_cod=K.asi_cod AND K.sec_id=L.sec_id AND L.inf_id=M.inf_id AND K.pac_id='$this->pac_id' AND M.ci='$ci_doc' AND D.asi_cod='$asi_cod' AND D.asi_nom='$asi_nom' AND J.inf_id='$inf_id') AS N ON C.pen_top=N.pen_top AND C.esp_id=N.esp_id AND C.reg_id=N.reg_id AND C.mod_id=N.mod_id AND C.coh_id=N.coh_id AND C.inf_id=N.inf_id AND C.asi_cod=N.asi_cod WHERE C.pac_id='$this->pac_id' AND C.ci='$this->ci' AND C.capi_sta='1' AND N.mod_id IN (SELECT mod_id FROM modali WHERE mod_sta='1')GROUP BY C.inf_id,N.mod_id,N.esp_id,N.reg_id,N.coh_id,C.asi_cod,N.asi_nom,N.sec_id ORDER BY N.sec_nom,C.inf_id,N.mod_id,N.esp_id,N.reg_id,N.coh_id,C.asi_cod,N.asi_nom ");
    return $resp;
  }
//******************************************************************
  function Listado_asignatura_todas($ci){
    $resultado=$this->Operacion("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D, estudi_infrae_matric E, asigna_seccio F, seccio G WHERE A.asi_cod=B.asi_cod AND B.asi_cod=F.asi_cod AND A.mod_id=B.mod_id AND A.mod_id=F.mod_id AND B.mod_id=E.mod_id AND A.esp_id=B.esp_id AND A.esp_id=F.esp_id AND B.esp_id=E.esp_id AND A.reg_id=B.reg_id AND F.reg_id=A.reg_id AND B.reg_id=E.reg_id AND A.coh_id=B.coh_id AND A.coh_id=F.coh_id AND B.coh_id=E.coh_id AND A.pen_top=B.pen_top AND A.pen_top=F.pen_top AND B.pen_top=E.pen_top AND B.inf_id=C.inf_id and B.inf_id=G.inf_id AND G.sec_id=F.sec_id AND B.inf_id=E.inf_id AND C.nuc_id=D.nuc_id AND B.pac_id=F.pac_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND E.eim_sta='1' AND F.ase_sta='1' AND G.sec_sta='1' AND B.ci='$this->ci' AND E.ci='$ci' AND B.pac_id='$this->pac_id' GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom ORDER BY A.asi_nom,A.asi_cod,D.nuc_nom,C.inf_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_asignatura_nucleo($ci,$nuc_id){
    $resultado=$this->Operacion("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D, estudi_infrae_matric E, asigna_seccio F, seccio G WHERE A.asi_cod=B.asi_cod AND B.asi_cod=F.asi_cod AND A.mod_id=B.mod_id AND A.mod_id=F.mod_id AND B.mod_id=E.mod_id AND A.esp_id=B.esp_id AND A.esp_id=F.esp_id AND B.esp_id=E.esp_id AND A.reg_id=B.reg_id AND F.reg_id=A.reg_id AND B.reg_id=E.reg_id AND A.coh_id=B.coh_id AND A.coh_id=F.coh_id AND B.coh_id=E.coh_id AND A.pen_top=B.pen_top AND A.pen_top=F.pen_top AND B.pen_top=E.pen_top AND B.inf_id=C.inf_id and B.inf_id=G.inf_id AND G.sec_id=F.sec_id AND B.inf_id=E.inf_id AND C.nuc_id=D.nuc_id AND B.pac_id=F.pac_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND E.eim_sta='1' AND F.ase_sta='1' AND G.sec_sta='1' AND B.ci='$this->ci' AND E.ci='$ci' AND B.pac_id='$this->pac_id' AND D.nuc_id='$nuc_id' GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom ORDER BY A.asi_nom,A.asi_cod,D.nuc_nom,C.inf_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_asignatura_nucleo_infrae($ci,$nuc_id,$inf_id){
    $resultado=$this->Operacion("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D, estudi_infrae_matric E, asigna_seccio F, seccio G WHERE A.asi_cod=B.asi_cod AND B.asi_cod=F.asi_cod AND A.mod_id=B.mod_id AND A.mod_id=F.mod_id AND B.mod_id=E.mod_id AND A.esp_id=B.esp_id AND A.esp_id=F.esp_id AND B.esp_id=E.esp_id AND A.reg_id=B.reg_id AND F.reg_id=A.reg_id AND B.reg_id=E.reg_id AND A.coh_id=B.coh_id AND A.coh_id=F.coh_id AND B.coh_id=E.coh_id AND A.pen_top=B.pen_top AND A.pen_top=F.pen_top AND B.pen_top=E.pen_top AND B.inf_id=C.inf_id and B.inf_id=G.inf_id AND G.sec_id=F.sec_id AND B.inf_id=E.inf_id AND C.nuc_id=D.nuc_id AND B.pac_id=F.pac_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND E.eim_sta='1' AND F.ase_sta='1' AND G.sec_sta='1' AND B.ci='$this->ci' AND E.ci='$ci' AND B.pac_id='$this->pac_id' AND D.nuc_id='$nuc_id' AND C.inf_id='$inf_id' GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom ORDER BY A.asi_nom,A.asi_cod,D.nuc_nom,C.inf_nom");
    return $resultado;
  }

//******************************************************************
  function Listado_asignatura_todas1($ci,$asi_nom){
    $resultado=$this->Operacion("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D, estudi_infrae_matric E, asigna_seccio F, seccio G WHERE A.asi_cod=B.asi_cod AND B.asi_cod=F.asi_cod AND A.mod_id=B.mod_id AND A.mod_id=F.mod_id AND B.mod_id=E.mod_id AND A.esp_id=B.esp_id AND A.esp_id=F.esp_id AND B.esp_id=E.esp_id AND A.reg_id=B.reg_id AND F.reg_id=A.reg_id AND B.reg_id=E.reg_id AND A.coh_id=B.coh_id AND A.coh_id=F.coh_id AND B.coh_id=E.coh_id AND A.pen_top=B.pen_top AND A.pen_top=F.pen_top AND B.pen_top=E.pen_top AND B.inf_id=C.inf_id and B.inf_id=G.inf_id AND G.sec_id=F.sec_id AND B.inf_id=E.inf_id AND C.nuc_id=D.nuc_id AND B.pac_id=F.pac_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND E.eim_sta='1' AND F.ase_sta='1' AND G.sec_sta='1' AND B.ci='$this->ci' AND E.ci='$ci' AND B.pac_id='$this->pac_id' AND A.asi_nom LIKE ('%$asi_nom%') GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom ORDER BY A.asi_nom,A.asi_cod,D.nuc_nom,C.inf_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_asignatura_nucleo1($ci,$asi_nom,$nuc_id){
    $resultado=$this->Operacion("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D, estudi_infrae_matric E, asigna_seccio F, seccio G WHERE A.asi_cod=B.asi_cod AND B.asi_cod=F.asi_cod AND A.mod_id=B.mod_id AND A.mod_id=F.mod_id AND B.mod_id=E.mod_id AND A.esp_id=B.esp_id AND A.esp_id=F.esp_id AND B.esp_id=E.esp_id AND A.reg_id=B.reg_id AND F.reg_id=A.reg_id AND B.reg_id=E.reg_id AND A.coh_id=B.coh_id AND A.coh_id=F.coh_id AND B.coh_id=E.coh_id AND A.pen_top=B.pen_top AND A.pen_top=F.pen_top AND B.pen_top=E.pen_top AND B.inf_id=C.inf_id and B.inf_id=G.inf_id AND G.sec_id=F.sec_id AND B.inf_id=E.inf_id AND C.nuc_id=D.nuc_id AND B.pac_id=F.pac_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND E.eim_sta='1' AND F.ase_sta='1' AND G.sec_sta='1' AND B.ci='$this->ci' AND E.ci='$ci' AND B.pac_id='$this->pac_id' AND A.asi_nom LIKE ('%$asi_nom%') AND D.nuc_id='$nuc_id' GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom ORDER BY A.asi_nom,A.asi_cod,D.nuc_nom,C.inf_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_asignatura_nucleo_infrae1($ci,$asi_nom,$nuc_id,$inf_id){
    $resultado=$this->Operacion("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D, estudi_infrae_matric E, asigna_seccio F, seccio G WHERE A.asi_cod=B.asi_cod AND B.asi_cod=F.asi_cod AND A.mod_id=B.mod_id AND A.mod_id=F.mod_id AND B.mod_id=E.mod_id AND A.esp_id=B.esp_id AND A.esp_id=F.esp_id AND B.esp_id=E.esp_id AND A.reg_id=B.reg_id AND F.reg_id=A.reg_id AND B.reg_id=E.reg_id AND A.coh_id=B.coh_id AND A.coh_id=F.coh_id AND B.coh_id=E.coh_id AND A.pen_top=B.pen_top AND A.pen_top=F.pen_top AND B.pen_top=E.pen_top AND B.inf_id=C.inf_id and B.inf_id=G.inf_id AND G.sec_id=F.sec_id AND B.inf_id=E.inf_id AND C.nuc_id=D.nuc_id AND B.pac_id=F.pac_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND E.eim_sta='1' AND F.ase_sta='1' AND G.sec_sta='1' AND B.ci='$this->ci' AND E.ci='$ci' AND B.pac_id='$this->pac_id' AND A.asi_nom LIKE ('%$asi_nom%') AND D.nuc_id='$nuc_id' AND C.inf_id='$inf_id' GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom ORDER BY A.asi_nom,A.asi_cod,D.nuc_nom,C.inf_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_horario_docente_Todas($ci_doc){//REEMPLAZADA LA FUNCIÓN Listado_asignaturaa_todas
    //$this->ci=$_SESSION['nacid'];
    $resp=$this->Operacion("SELECT C.pac_id AS 'pac_id', N.coh_nom AS 'coh_nom', N.coh_id AS 'coh_id', N.mod_nom AS 'mod_nom', N.mod_id AS 'mod_id', N.reg_nom AS 'reg_nom', N.reg_id AS 'reg_id', N.esp_nom AS 'esp_nom', N.esp_id AS 'esp_id', N.asi_nom AS 'asi_nom', N.asi_cod AS 'asi_cod', N.asi_cht AS 'asi_cht', N.asi_chp AS 'asi_chp', N.asi_chl AS 'asi_chl', N.asi_lab AS 'asi_lab', N.pen_top AS 'pen_top', N.inf_id AS 'inf_id', N.inf_nom AS 'inf_nom', N.nuc_id AS 'nuc_id', N.nuc_nom AS 'nuc_nom' FROM coo_asi_pac_inf C LEFT JOIN (SELECT D.mod_id AS 'mod_id', E.mod_nom AS 'mod_nom', D.esp_id AS 'esp_id', F.esp_nom AS 'esp_nom', D.reg_id AS 'reg_id', G.reg_nom AS 'reg_nom', D.coh_id AS 'coh_id', H.coh_nom AS 'coh_nom', D.pen_top AS 'pen_top', D.asi_cod AS 'asi_cod', D.asi_nom AS 'asi_nom', D.asi_cht AS 'asi_cht', D.asi_chp AS 'asi_chp', D.asi_chl AS 'asi_chl', D.asi_lab AS 'asi_lab', J.inf_id AS 'inf_id', J.inf_nom AS 'inf_nom', I.nuc_id AS 'nuc_id', I.nuc_nom AS 'nuc_nom' FROM asigna D, modali E, especi F, regimen G, cohort H, nucleo I, infrae J, estudi_infrae_matric M, asigna_seccio K, seccio L WHERE D.asi_sta='1' AND M.pen_top=D.pen_top AND M.esp_id=D.esp_id AND M.reg_id=D.reg_id AND M.mod_id=D.mod_id AND M.coh_id=D.coh_id AND M.eim_sta='1' AND M.mod_id=E.mod_id AND M.esp_id=F.esp_id AND M.reg_id=G.reg_id AND M.coh_id=H.coh_id AND M.inf_id=J.inf_id AND J.nuc_id=I.nuc_id AND M.pen_top=K.pen_top AND M.esp_id=K.esp_id AND M.reg_id=K.reg_id AND M.mod_id=K.mod_id AND M.coh_id=K.coh_id AND D.asi_cod=K.asi_cod AND K.sec_id=L.sec_id AND L.inf_id=M.inf_id AND K.pac_id='$this->pac_id' AND M.ci='$ci_doc') AS N ON C.pen_top=N.pen_top AND C.esp_id=N.esp_id AND C.reg_id=N.reg_id AND C.mod_id=N.mod_id AND C.coh_id=N.coh_id AND C.inf_id=N.inf_id AND C.asi_cod=N.asi_cod WHERE C.pac_id='$this->pac_id' AND C.ci='$this->ci' AND C.capi_sta='1' AND N.mod_id IN (SELECT mod_id FROM modali WHERE mod_sta='1') GROUP BY C.inf_id,C.asi_cod,N.asi_nom ORDER BY C.inf_id,C.asi_cod,N.asi_nom");
    return $resp;
  }
//******************************************************************
  function Listado_horario_docente_Todas_nucleo($ci_doc,$nuc_id){ //REEMPLAZADA POR LA FUNCIÓN Listado_asignatura_nucleo
    //$this->ci=$_SESSION['nacid'];
    $resp=$this->Operacion("SELECT C.pac_id AS 'pac_id', N.coh_nom AS 'coh_nom', N.coh_id AS 'coh_id', N.mod_nom AS 'mod_nom', N.mod_id AS 'mod_id', N.reg_nom AS 'reg_nom', N.reg_id AS 'reg_id', N.esp_nom AS 'esp_nom', N.esp_id AS 'esp_id', N.asi_nom AS 'asi_nom', N.asi_cod AS 'asi_cod', N.asi_cht AS 'asi_cht', N.asi_chp AS 'asi_chp', N.asi_chl AS 'asi_chl', N.asi_lab AS 'asi_lab', N.pen_top AS 'pen_top', N.inf_id AS 'inf_id', N.inf_nom AS 'inf_nom', N.nuc_id AS 'nuc_id', N.nuc_nom AS 'nuc_nom' FROM coo_asi_pac_inf C LEFT JOIN (SELECT D.mod_id AS 'mod_id', E.mod_nom AS 'mod_nom', D.esp_id AS 'esp_id', F.esp_nom AS 'esp_nom', D.reg_id AS 'reg_id', G.reg_nom AS 'reg_nom', D.coh_id AS 'coh_id', H.coh_nom AS 'coh_nom', D.pen_top AS 'pen_top', D.asi_cod AS 'asi_cod', D.asi_nom AS 'asi_nom', D.asi_cht AS 'asi_cht', D.asi_chp AS 'asi_chp', D.asi_chl AS 'asi_chl', D.asi_lab AS 'asi_lab', J.inf_id AS 'inf_id', J.inf_nom AS 'inf_nom', I.nuc_id AS 'nuc_id', I.nuc_nom AS 'nuc_nom' FROM asigna D, modali E, especi F, regimen G, cohort H, nucleo I, infrae J, estudi_infrae_matric M, asigna_seccio K, seccio L WHERE D.asi_sta='1' AND M.pen_top=D.pen_top AND M.esp_id=D.esp_id AND M.reg_id=D.reg_id AND M.mod_id=D.mod_id AND M.coh_id=D.coh_id AND M.eim_sta='1' AND M.mod_id=E.mod_id AND M.esp_id=F.esp_id AND M.reg_id=G.reg_id AND M.coh_id=H.coh_id AND M.inf_id=J.inf_id AND J.nuc_id=I.nuc_id AND M.pen_top=K.pen_top AND M.esp_id=K.esp_id AND M.reg_id=K.reg_id AND M.mod_id=K.mod_id AND M.coh_id=K.coh_id AND D.asi_cod=K.asi_cod AND K.sec_id=L.sec_id AND L.inf_id=M.inf_id AND K.pac_id='$this->pac_id' AND M.ci='$ci_doc') AS N ON C.pen_top=N.pen_top AND C.esp_id=N.esp_id AND C.reg_id=N.reg_id AND C.mod_id=N.mod_id AND C.coh_id=N.coh_id AND C.inf_id=N.inf_id AND C.asi_cod=N.asi_cod WHERE C.pac_id='$this->pac_id' AND C.ci='$this->ci' AND C.capi_sta='1' AND N.mod_id IN (SELECT mod_id FROM modali WHERE mod_sta='1') AND N.nuc_id='$nuc_id' GROUP BY C.inf_id,C.asi_cod,N.asi_nom  ORDER BY C.inf_id,C.asi_cod,N.asi_nom");
    return $resp;
  }
//******************************************************************
  function Listado_horario_docente_Todas_nucleo_infrae($ci_doc,$nuc_id,$inf_id){ //Reemplazada por la función Listado_asignatura_nucleo_infrae
    //$this->ci=$_SESSION['nacid'];
    $resp=$this->Operacion("SELECT C.pac_id AS 'pac_id', N.coh_nom AS 'coh_nom', N.coh_id AS 'coh_id', N.mod_nom AS 'mod_nom', N.mod_id AS 'mod_id', N.reg_nom AS 'reg_nom', N.reg_id AS 'reg_id', N.esp_nom AS 'esp_nom', N.esp_id AS 'esp_id', N.asi_nom AS 'asi_nom', N.asi_cod AS 'asi_cod', N.asi_cht AS 'asi_cht', N.asi_chp AS 'asi_chp', N.asi_chl AS 'asi_chl', N.asi_lab AS 'asi_lab', N.pen_top AS 'pen_top', N.inf_id AS 'inf_id', N.inf_nom AS 'inf_nom', N.nuc_id AS 'nuc_id', N.nuc_nom AS 'nuc_nom' FROM coo_asi_pac_inf C LEFT JOIN (SELECT D.mod_id AS 'mod_id', E.mod_nom AS 'mod_nom', D.esp_id AS 'esp_id', F.esp_nom AS 'esp_nom', D.reg_id AS 'reg_id', G.reg_nom AS 'reg_nom', D.coh_id AS 'coh_id', H.coh_nom AS 'coh_nom', D.pen_top AS 'pen_top', D.asi_cod AS 'asi_cod', D.asi_nom AS 'asi_nom', D.asi_cht AS 'asi_cht', D.asi_chp AS 'asi_chp', D.asi_chl AS 'asi_chl', D.asi_lab AS 'asi_lab', J.inf_id AS 'inf_id', J.inf_nom AS 'inf_nom', I.nuc_id AS 'nuc_id', I.nuc_nom AS 'nuc_nom' FROM asigna D, modali E, especi F, regimen G, cohort H, nucleo I, infrae J, estudi_infrae_matric M, asigna_seccio K, seccio L WHERE D.asi_sta='1' AND M.pen_top=D.pen_top AND M.esp_id=D.esp_id AND M.reg_id=D.reg_id AND M.mod_id=D.mod_id AND M.coh_id=D.coh_id AND M.eim_sta='1' AND M.mod_id=E.mod_id AND M.esp_id=F.esp_id AND M.reg_id=G.reg_id AND M.coh_id=H.coh_id AND M.inf_id=J.inf_id AND J.nuc_id=I.nuc_id AND M.pen_top=K.pen_top AND M.esp_id=K.esp_id AND M.reg_id=K.reg_id AND M.mod_id=K.mod_id AND M.coh_id=K.coh_id AND D.asi_cod=K.asi_cod AND K.sec_id=L.sec_id AND L.inf_id=M.inf_id AND K.pac_id='$this->pac_id' AND M.ci='$ci_doc') AS N ON C.pen_top=N.pen_top AND C.esp_id=N.esp_id AND C.reg_id=N.reg_id AND C.mod_id=N.mod_id AND C.coh_id=N.coh_id AND C.inf_id=N.inf_id AND C.asi_cod=N.asi_cod WHERE C.pac_id='$this->pac_id' AND C.ci='$this->ci' AND C.capi_sta='1' AND N.mod_id IN (SELECT mod_id FROM modali WHERE mod_sta='1') AND N.nuc_id='$nuc_id' AND N.inf_id='$inf_id' GROUP BY ORDER BY C.inf_id,C.asi_cod,N.asi_nom");
    return $resp;
  }
//******************************************************************
  function Listado_horario_docente_asignatura($ci_doc,$asi_cod){
    //$this->ci=$_SESSION['nacid'];
    $resp=$this->Operacion("SELECT C.pac_id AS 'pac_id', N.coh_nom AS 'coh_nom', N.coh_id AS 'coh_id', N.mod_nom AS 'mod_nom', N.mod_id AS 'mod_id', N.reg_nom AS 'reg_nom', N.reg_id AS 'reg_id', N.esp_nom AS 'esp_nom', N.esp_id AS 'esp_id', N.asi_nom AS 'asi_nom', N.asi_cod AS 'asi_cod', N.asi_cht AS 'asi_cht', N.asi_chp AS 'asi_chp', N.asi_chl AS 'asi_chl', N.asi_lab AS 'asi_lab', N.pen_top AS 'pen_top', N.inf_id AS 'inf_id', N.inf_nom AS 'inf_nom', N.nuc_id AS 'nuc_id', N.nuc_nom AS 'nuc_nom' FROM coo_asi_pac_inf C LEFT JOIN (SELECT D.mod_id AS 'mod_id', E.mod_nom AS 'mod_nom', D.esp_id AS 'esp_id', F.esp_nom AS 'esp_nom', D.reg_id AS 'reg_id', G.reg_nom AS 'reg_nom', D.coh_id AS 'coh_id', H.coh_nom AS 'coh_nom', D.pen_top AS 'pen_top', D.asi_cod AS 'asi_cod', D.asi_nom AS 'asi_nom', D.asi_cht AS 'asi_cht', D.asi_chp AS 'asi_chp', D.asi_chl AS 'asi_chl', D.asi_lab AS 'asi_lab', J.inf_id AS 'inf_id', J.inf_nom AS 'inf_nom', I.nuc_id AS 'nuc_id', I.nuc_nom AS 'nuc_nom' FROM asigna D, modali E, especi F, regimen G, cohort H, nucleo I, infrae J, estudi_infrae_matric M, asigna_seccio K, seccio L WHERE D.asi_sta='1' AND M.pen_top=D.pen_top AND M.esp_id=D.esp_id AND M.reg_id=D.reg_id AND M.mod_id=D.mod_id AND M.coh_id=D.coh_id AND M.eim_sta='1' AND M.mod_id=E.mod_id AND M.esp_id=F.esp_id AND M.reg_id=G.reg_id AND M.coh_id=H.coh_id AND M.inf_id=J.inf_id AND J.nuc_id=I.nuc_id AND M.pen_top=K.pen_top AND M.esp_id=K.esp_id AND M.reg_id=K.reg_id AND M.mod_id=K.mod_id AND M.coh_id=K.coh_id AND D.asi_cod=K.asi_cod AND K.sec_id=L.sec_id AND L.inf_id=M.inf_id AND K.pac_id='$this->pac_id' AND M.ci='$ci_doc') AS N ON C.pen_top=N.pen_top AND C.esp_id=N.esp_id AND C.reg_id=N.reg_id AND C.mod_id=N.mod_id AND C.coh_id=N.coh_id AND C.inf_id=N.inf_id AND C.asi_cod=N.asi_cod WHERE C.pac_id='$this->pac_id' AND C.ci='$this->ci' AND C.capi_sta='1' AND N.mod_id IN (SELECT mod_id FROM modali WHERE mod_sta='1') AND C.asi_cod='$asi_cod' GROUP BY C.inf_id,C.asi_cod,N.asi_nom ORDER BY C.inf_id,C.asi_cod,N.asi_nom");
    return $resp;
  }
//******************************************************************
  function Listado_horario_docente_asignatura_nucleo($ci_doc,$asi_cod,$nuc_id){
    //$this->ci=$_SESSION['nacid'];
    $resp=$this->Operacion("SELECT C.pac_id AS 'pac_id', N.coh_nom AS 'coh_nom', N.coh_id AS 'coh_id', N.mod_nom AS 'mod_nom', N.mod_id AS 'mod_id', N.reg_nom AS 'reg_nom', N.reg_id AS 'reg_id', N.esp_nom AS 'esp_nom', N.esp_id AS 'esp_id', N.asi_nom AS 'asi_nom', N.asi_cod AS 'asi_cod', N.asi_cht AS 'asi_cht', N.asi_chp AS 'asi_chp', N.asi_chl AS 'asi_chl', N.asi_lab AS 'asi_lab', N.pen_top AS 'pen_top', N.inf_id AS 'inf_id', N.inf_nom AS 'inf_nom', N.nuc_id AS 'nuc_id', N.nuc_nom AS 'nuc_nom' FROM coo_asi_pac_inf C LEFT JOIN (SELECT D.mod_id AS 'mod_id', E.mod_nom AS 'mod_nom', D.esp_id AS 'esp_id', F.esp_nom AS 'esp_nom', D.reg_id AS 'reg_id', G.reg_nom AS 'reg_nom', D.coh_id AS 'coh_id', H.coh_nom AS 'coh_nom', D.pen_top AS 'pen_top', D.asi_cod AS 'asi_cod', D.asi_nom AS 'asi_nom', D.asi_cht AS 'asi_cht', D.asi_chp AS 'asi_chp', D.asi_chl AS 'asi_chl', D.asi_lab AS 'asi_lab', J.inf_id AS 'inf_id', J.inf_nom AS 'inf_nom', I.nuc_id AS 'nuc_id', I.nuc_nom AS 'nuc_nom' FROM asigna D, modali E, especi F, regimen G, cohort H, nucleo I, infrae J, estudi_infrae_matric M, asigna_seccio K, seccio L WHERE D.asi_sta='1' AND M.pen_top=D.pen_top AND M.esp_id=D.esp_id AND M.reg_id=D.reg_id AND M.mod_id=D.mod_id AND M.coh_id=D.coh_id AND M.eim_sta='1' AND M.mod_id=E.mod_id AND M.esp_id=F.esp_id AND M.reg_id=G.reg_id AND M.coh_id=H.coh_id AND M.inf_id=J.inf_id AND J.nuc_id=I.nuc_id AND M.pen_top=K.pen_top AND M.esp_id=K.esp_id AND M.reg_id=K.reg_id AND M.mod_id=K.mod_id AND M.coh_id=K.coh_id AND D.asi_cod=K.asi_cod AND K.sec_id=L.sec_id AND L.inf_id=M.inf_id AND K.pac_id='$this->pac_id' AND M.ci='$ci_doc') AS N ON C.pen_top=N.pen_top AND C.esp_id=N.esp_id AND C.reg_id=N.reg_id AND C.mod_id=N.mod_id AND C.coh_id=N.coh_id AND C.inf_id=N.inf_id AND C.asi_cod=N.asi_cod WHERE C.pac_id='$this->pac_id' AND C.ci='$this->ci' AND C.capi_sta='1' AND N.mod_id IN (SELECT mod_id FROM modali WHERE mod_sta='1') AND C.asi_cod='$asi_cod' AND N.nuc_id='$nuc_id' GROUP BY C.inf_id,C.asi_cod,N.asi_nom ORDER BY C.inf_id,C.asi_cod,N.asi_nom");
    return $resp;
  }
//******************************************************************
  function Listado_horario_docente_asignatura_nucleo_infrae($ci_doc,$asi_cod,$nuc_id,$inf_id){
    //$this->ci=$_SESSION['nacid'];
    $resp=$this->Operacion("SELECT C.pac_id AS 'pac_id', N.coh_nom AS 'coh_nom', N.coh_id AS 'coh_id', N.mod_nom AS 'mod_nom', N.mod_id AS 'mod_id', N.reg_nom AS 'reg_nom', N.reg_id AS 'reg_id', N.esp_nom AS 'esp_nom', N.esp_id AS 'esp_id', N.asi_nom AS 'asi_nom', N.asi_cod AS 'asi_cod', N.asi_cht AS 'asi_cht', N.asi_chp AS 'asi_chp', N.asi_chl AS 'asi_chl', N.asi_lab AS 'asi_lab', N.pen_top AS 'pen_top', N.inf_id AS 'inf_id', N.inf_nom AS 'inf_nom', N.nuc_id AS 'nuc_id', N.nuc_nom AS 'nuc_nom' FROM coo_asi_pac_inf C LEFT JOIN (SELECT D.mod_id AS 'mod_id', E.mod_nom AS 'mod_nom', D.esp_id AS 'esp_id', F.esp_nom AS 'esp_nom', D.reg_id AS 'reg_id', G.reg_nom AS 'reg_nom', D.coh_id AS 'coh_id', H.coh_nom AS 'coh_nom', D.pen_top AS 'pen_top', D.asi_cod AS 'asi_cod', D.asi_nom AS 'asi_nom', D.asi_cht AS 'asi_cht', D.asi_chp AS 'asi_chp', D.asi_chl AS 'asi_chl', D.asi_lab AS 'asi_lab', J.inf_id AS 'inf_id', J.inf_nom AS 'inf_nom', I.nuc_id AS 'nuc_id', I.nuc_nom AS 'nuc_nom' FROM asigna D, modali E, especi F, regimen G, cohort H, nucleo I, infrae J, estudi_infrae_matric M, asigna_seccio K, seccio L WHERE D.asi_sta='1' AND M.pen_top=D.pen_top AND M.esp_id=D.esp_id AND M.reg_id=D.reg_id AND M.mod_id=D.mod_id AND M.coh_id=D.coh_id AND M.eim_sta='1' AND M.mod_id=E.mod_id AND M.esp_id=F.esp_id AND M.reg_id=G.reg_id AND M.coh_id=H.coh_id AND M.inf_id=J.inf_id AND J.nuc_id=I.nuc_id AND M.pen_top=K.pen_top AND M.esp_id=K.esp_id AND M.reg_id=K.reg_id AND M.mod_id=K.mod_id AND M.coh_id=K.coh_id AND D.asi_cod=K.asi_cod AND K.sec_id=L.sec_id AND L.inf_id=M.inf_id AND K.pac_id='$this->pac_id' AND M.ci='$ci_doc') AS N ON C.pen_top=N.pen_top AND C.esp_id=N.esp_id AND C.reg_id=N.reg_id AND C.mod_id=N.mod_id AND C.coh_id=N.coh_id AND C.inf_id=N.inf_id AND C.asi_cod=N.asi_cod WHERE C.pac_id='$this->pac_id' AND C.ci='$this->ci' AND C.capi_sta='1' AND N.mod_id IN (SELECT mod_id FROM modali WHERE mod_sta='1') AND C.asi_cod='$asi_cod' AND N.nuc_id='$nuc_id' AND N.inf_id='$inf_id' GROUP BY C.inf_id,C.asi_cod,N.asi_nom ORDER BY C.inf_id,C.asi_cod,N.asi_nom");
    return $resp;
  }
//******************************************************************
  function Listado_horario_Todas($inicial,$cantidad,$ci_doc){
/*  echo "<script>alert('SELECT hor_id FROM horario as A RIGHT JOIN (SELECT D.pac_id AS pac_id, D.coh_id AS coh_id, D.mod_id AS mod_id, D.reg_id AS reg_id, D.esp_id AS esp_id, D.pen_top AS pen_top, F.asi_cod AS asi_cod, F.sec_id AS sec_id, E.inf_id AS inf_id FROM coo_asi_pac_inf D, seccio E, asigna_seccio F WHERE D.pac_id=$this->pac_id AND D.capi_sta=1 and D.inf_id=E.inf_id AND E.sec_sta=1 AND E.sec_id=F.sec_id AND F.ase_sta=1 AND D.asi_cod=F.asi_cod AND D.esp_id=F.esp_id AND D.reg_id=F.reg_id AND D.mod_id=F.mod_id AND D.coh_id=F.coh_id AND D.pen_top=F.pen_top AND D.pac_id=F.pac_id AND D.ci=$this->ci) as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta=1 AND A.pac_id=$this->pac_id AND A.ci=$ci_doc GROUP BY hor_id  ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id LIMIT $cantidad OFFSET $inicial');</script>";*/
    $resultado=$this->Operacion("SELECT hor_id FROM horario as A RIGHT JOIN (SELECT D.pac_id AS 'pac_id', D.coh_id AS 'coh_id', D.mod_id AS 'mod_id', D.reg_id AS 'reg_id', D.esp_id AS 'esp_id', D.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id' FROM coo_asi_pac_inf D, seccio E, asigna_seccio F WHERE D.pac_id='$this->pac_id' AND D.capi_sta='1' and D.inf_id=E.inf_id AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND D.asi_cod=F.asi_cod AND D.esp_id=F.esp_id AND D.reg_id=F.reg_id AND D.mod_id=F.mod_id AND D.coh_id=F.coh_id AND D.pen_top=F.pen_top AND D.pac_id=F.pac_id AND D.ci='$this->ci') as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' GROUP BY hor_id  ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($pen_top,$sec_id,$asi_cod,$esp_id,$reg_id,$mod_id,$coh_id,$pac_id,$aul_id,$blh_id,$dia_id,$hor_com,$inf_id,$sta){
    $this->pen_top=$pen_top;
    $this->sec_id=$sec_id;
    $this->asi_cod=$asi_cod;
    $this->esp_id=$esp_id;
    $this->reg_id=$reg_id;
    $this->mod_id=$mod_id;
    $this->coh_id=$coh_id;
    $this->pac_id=$pac_id;
    $this->aul_id=$aul_id;
    $this->blh_id=$blh_id;
    $this->dia_id=$dia_id;
    $this->dbh_tip='0';
    $this->hor_com=$hor_com;
    $this->ci=$_SESSION['ci'];
	$this->inf_id=$inf_id;
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_Periodo(){
    $this->ci_est=$ci_est;
	$dias=time();
	$fecha=date("Y-m-d H:i:s",$dias);
/*	echo "<script>alert('Cedula $this->ci_est');</script>";*/
    $res=$this->OperacionCualquiera("SELECT pac_id, pac_nom FROM pacade WHERE pac_sta='1' AND DATEDIFF(pac_ffin,'$fecha')>=0 ORDER BY pac_fin DESC");
    return $res;
  }
//******************************************************************
  function Buscar_asigna($inf_id,$asi_cod,$asi_nom){
    $respuesta=$this->OperacionCualquiera("SELECT C.asi_cod AS 'asi_cod', C.asi_nom AS 'asi_nom', D.inf_id AS 'inf_id', D.inf_nom AS 'inf_nom', E.nuc_id AS 'nuc_id', E.nuc_nom AS 'nuc_nom' FROM asigna_seccio A, seccio B, asigna C, infrae D, nucleo E WHERE A.pac_id='$this->pac_id' AND A.asi_cod='$asi_cod' AND B.inf_id='$inf_id' AND C.asi_nom='$asi_nom' AND A.sec_id=B.sec_id AND A.ase_sta='1' AND A.asi_cod=C.asi_cod AND A.mod_id=C.mod_id  AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND B.sec_sta='1' AND B.inf_id=D.inf_id AND C.asi_sta='1' AND D.inf_sta='1' AND D.nuc_id=E.nuc_id AND E.nuc_sta='1' GROUP BY D.inf_id,A.asi_cod,C.asi_nom");
	$array=$this->ConsultarCualquiera($respuesta);
    return $array;
  }
//******************************************************************
  function Buscar_asigna_seccio($inf_id,$asi_cod,$asi_nom,$mod_id,$esp_id,$reg_id,$coh_id,$sec_id){
    $respuesta=$this->OperacionCualquiera("SELECT C.asi_cod AS 'asi_cod', C.asi_nom AS 'asi_nom', D.inf_id AS 'inf_id', D.inf_nom AS 'inf_nom', E.nuc_id AS 'nuc_id', E.nuc_nom AS 'nuc_nom', F.mod_id AS 'mod_id', F.mod_nom AS 'mod_nom', G.esp_id AS 'esp_id', G.esp_nom AS 'esp_nom', H.reg_id AS 'reg_id', H.reg_nom AS 'reg_nom', I.coh_id AS 'coh_id', I.coh_nom AS 'coh_nom', B.sec_id AS 'sec_id', B.sec_nom AS 'sec_nom', C.asi_cht AS 'asi_cht', C.asi_chp AS 'asi_chp', C.asi_chl AS 'asi_chl', C.asi_lab AS 'asi_lab', D.inf_id AS 'inf_id' FROM asigna_seccio A, seccio B, asigna C, infrae D, nucleo E, modali F, especi G, regimen H, cohort I WHERE A.pac_id='$this->pac_id' AND A.asi_cod='$asi_cod' AND B.inf_id='$inf_id' AND C.asi_nom='$asi_nom' AND F.mod_id='$mod_id' AND G.esp_id='$esp_id' AND H.reg_id='$reg_id' AND I.coh_id='$coh_id' AND B.sec_id='$sec_id' AND A.sec_id=B.sec_id AND A.asi_cod=C.asi_cod AND A.mod_id=C.mod_id AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND B.inf_id=D.inf_id AND D.nuc_id=E.nuc_id AND A.mod_id=F.mod_id AND A.esp_id=G.esp_id AND A.reg_id=H.reg_id AND A.coh_id=I.coh_id AND A.ase_sta='1' AND B.sec_sta='1' AND C.asi_sta='1' AND D.inf_sta='1' AND E.nuc_sta='1' AND F.mod_sta='1' AND G.esp_sta='1' AND H.reg_sta='1' AND I.coh_sta='1' GROUP BY D.inf_id,F.mod_id,G.esp_id,H.reg_id,I.coh_id,A.asi_cod,C.asi_nom,B.sec_id");
	$array=$this->ConsultarCualquiera($respuesta);
    return $array;
  }
//******************************************************************
  function Buscar_Pacade(){
    $num_filas='';
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
    $respuesta=$this->OperacionCualquiera("SELECT pac_id FROM pacade WHERE DATEDIFF('$fecha',pac_fin)>=0 AND DATEDIFF(pac_ffin,'$fecha')>=0 AND pac_sta='1'");
	$num_filas=$this->NumFilas();
	
	$pacade=$this->ConsultarCualquiera($respuesta);
//    $num_filas=$this->NumFilas();
    return $pacade->pac_id;
  }
//******************************************************************
  function Buscar_horario($inf_id,$dbh_tip){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND A.dbh_tip='$dbh_tip' AND A.inf_id='$inf_id'");
	return $res;
  }
//******************************************************************
  function Buscar_materia_pensum_horario_con_horario_todas($inf_id,$asi_cod,$asi_nom){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT DISTINCT(F.esp_nom) AS 'esp_nom', F.esp_id AS 'esp_id', G.reg_nom AS 'reg_nom', G.reg_id AS 'reg_id', H.mod_nom AS 'mod_nom', H.mod_id AS 'mod_id', I.coh_nom AS 'coh_nom', I.coh_id AS 'coh_id', B.sec_nom AS 'sec_nom', B.sec_id AS 'sec_id' FROM horario A, seccio B, asigna C, dias D, blo_hor E, especi F, regimen G, modali H, cohort I WHERE A.pac_id='$this->pac_id' AND A.hor_sta='1' AND A.sec_id=B.sec_id AND A.asi_cod=C.asi_cod AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND A.asi_cod='$asi_cod' AND C.asi_nom='$asi_nom' AND B.inf_id='$inf_id' AND A.dia_id=D.dia_id AND A.blh_id=E.blh_id AND A.esp_id=F.esp_id AND A.reg_id=G.reg_id AND A.mod_id=H.mod_id AND A.coh_id=I.coh_id AND B.sec_sta='1' AND C.asi_sta='1' AND D.dia_sta='1' AND E.blh_sta='1' AND F.esp_sta='1' AND G.reg_sta='1' AND H.mod_sta='1' AND I.coh_sta='1'");
	return $res;
  }
//******************************************************************
  function Buscar_materia_pensum_todas($hor_id,$ci_doc){
/*      echo "<script>alert('SELECT B.nuc_nom AS nuc_nom, B.inf_nom AS inf_nom, CONCAT(B.asi_cod, ,B.asi_nom) AS asigna, B.sec_nom AS sec_nom, B.mod_nom AS mod_nom, B.coh_nom AS coh_nom, B.esp_nom AS esp_nom, B.reg_nom AS reg_nom FROM horario as A RIGHT JOIN (SELECT D.pac_id AS pac_id, D.coh_id AS coh_id, D.mod_id AS mod_id, D.reg_id AS reg_id, D.esp_id AS esp_id, D.pen_top AS pen_top, F.asi_cod AS asi_cod, C.asi_nom AS asi_nom, F.sec_id AS sec_id, E.inf_id AS inf_id, E.sec_nom AS sec_nom, G.inf_nom AS inf_nom, H.nuc_nom AS nuc_nom, I.esp_nom AS esp_nom, J.reg_nom AS reg_nom, K.mod_nom AS mod_nom, L.coh_nom AS coh_nom FROM asigna C, coo_asi_pac_inf D, seccio E, asigna_seccio F, infrae G, nucleo H, especi I, regimen J, modali K, cohort L WHERE C.asi_cod=D.asi_cod AND C.esp_id=D.esp_id AND C.reg_id=D.reg_id AND C.mod_id=D.mod_id AND C.coh_id=L.coh_id AND C.pen_top=D.pen_top AND G.inf_id=E.inf_id AND G.nuc_id=H.nuc_id AND I.esp_id=D.esp_id AND J.reg_id=D.reg_id AND K.mod_id=D.mod_id AND L.coh_id=D.coh_id AND D.pac_id=$this->pac_id AND D.capi_sta=1 and D.inf_id=E.inf_id AND E.sec_sta=1 AND E.sec_id=F.sec_id AND F.ase_sta=1 AND D.asi_cod=F.asi_cod AND D.esp_id=F.esp_id AND D.reg_id=F.reg_id AND D.mod_id=F.mod_id AND D.coh_id=F.coh_id AND D.pen_top=F.pen_top AND D.pac_id=F.pac_id AND D.ci=$this->ci) as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta=1 AND A.pac_id=$this->pac_id AND A.ci=$ci_doc AND A.hor_id=$hor_id GROUP BY B.nuc_nom,B.inf_id,B.asi_cod,A.sec_id , A.mod_id, A.coh_id, A.esp_id, A.reg_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id');</script>";*/
    $res=$this->Operacion("SELECT B.nuc_nom AS 'nuc_nom', B.inf_nom AS 'inf_nom', CONCAT(B.asi_cod,' ',B.asi_nom) AS 'asigna', B.sec_nom AS 'sec_nom', B.mod_nom AS 'mod_nom', B.coh_nom AS 'coh_nom', B.esp_nom AS 'esp_nom', B.reg_nom AS 'reg_nom', B.ele_cod AS 'ele_cod', B.ele_nom AS 'ele_nom', B.ase_id AS 'ase_id' FROM horario as A RIGHT JOIN (SELECT D.pac_id AS 'pac_id', D.coh_id AS 'coh_id', D.mod_id AS 'mod_id', D.reg_id AS 'reg_id', D.esp_id AS 'esp_id', D.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', C.asi_nom AS 'asi_nom', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id', E.sec_nom AS 'sec_nom', G.inf_nom AS 'inf_nom', H.nuc_nom AS 'nuc_nom', I.esp_nom AS 'esp_nom', J.reg_nom AS 'reg_nom', K.mod_nom AS 'mod_nom', L.coh_nom AS 'coh_nom',F.ele_cod AS 'ele_cod', M.ele_nom AS 'ele_nom', F.ase_id AS 'ase_id' FROM asigna C, coo_asi_pac_inf D, seccio E, asigna_seccio F, infrae G, nucleo H, especi I, regimen J, modali K, cohort L, electi M WHERE F.ele_cod=M.ele_cod AND C.asi_cod=D.asi_cod AND C.esp_id=D.esp_id AND C.reg_id=D.reg_id AND C.mod_id=D.mod_id AND C.coh_id=L.coh_id AND C.pen_top=D.pen_top AND G.inf_id=E.inf_id AND G.nuc_id=H.nuc_id AND I.esp_id=D.esp_id AND J.reg_id=D.reg_id AND K.mod_id=D.mod_id AND L.coh_id=D.coh_id AND D.pac_id='$this->pac_id' AND D.capi_sta='1' and D.inf_id=E.inf_id AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND D.asi_cod=F.asi_cod AND D.esp_id=F.esp_id AND D.reg_id=F.reg_id AND D.mod_id=F.mod_id AND D.coh_id=F.coh_id AND D.pen_top=F.pen_top AND D.pac_id=F.pac_id AND D.ci='$this->ci') as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' AND A.hor_id='$hor_id' GROUP BY B.nuc_nom,B.inf_id,B.asi_cod,A.sec_id , A.mod_id, A.coh_id, A.esp_id, A.reg_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id");
	return $res;
  }
//******************************************************************
  function Buscar_materia_pensum_todas_tip_horario($hor_id,$ci_doc){
/*      echo "<script>alert('SELECT DISTINCT(F.esp_nom) AS esp_nom, F.esp_id AS esp_id, G.reg_nom AS reg_nom, G.reg_id AS reg_id, H.mod_nom AS mod_nom, H.mod_id AS mod_id, I.coh_nom AS coh_nom, I.coh_id AS coh_id, B.sec_nom AS sec_nom, B.sec_id AS sec_id FROM asigna_seccio A, seccio B, asigna C, dias D, blo_hor E, especi F, regimen G, modali H, cohort I WHERE A.pac_id=$this->pac_id AND A.ase_sta=1 AND A.sec_id=B.sec_id AND A.asi_cod=C.asi_cod AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND A.asi_cod=$asi_cod AND C.asi_nom=$asi_nom AND B.inf_id=$inf_id AND A.esp_id=F.esp_id AND A.reg_id=G.reg_id AND A.mod_id=H.mod_id AND A.coh_id=I.coh_id AND B.sec_sta=1 AND C.asi_sta=1 AND F.esp_sta=1 AND G.reg_sta=1 AND H.mod_sta=1 AND I.coh_sta=1');</script>";*/
    $res=$this->Operacion("SELECT A.hor_tpl AS 'hor_tpl', B.asi_cht AS 'can_t', B.asi_chp AS 'can_p',B.asi_chl AS 'can_l' FROM horario as A RIGHT JOIN (SELECT D.pac_id AS 'pac_id', D.coh_id AS coh_id, D.mod_id AS 'mod_id', D.reg_id AS 'reg_id', D.esp_id AS 'esp_id', D.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', C.asi_nom AS 'asi_nom', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id', E.sec_nom AS 'sec_nom', G.inf_nom AS 'inf_nom', H.nuc_nom AS 'nuc_nom', I.esp_nom AS 'esp_nom', J.reg_nom AS 'reg_nom', K.mod_nom AS 'mod_nom', L.coh_nom AS 'coh_nom', C.asi_cht AS 'asi_cht', C.asi_chp AS 'asi_chp', C.asi_chl AS 'asi_chl' FROM asigna C, coo_asi_pac_inf D, seccio E, asigna_seccio F, infrae G, nucleo H, especi I, regimen J, modali K, cohort L WHERE C.asi_cod=D.asi_cod AND C.esp_id=D.esp_id AND C.reg_id=D.reg_id AND C.mod_id=D.mod_id AND C.coh_id=L.coh_id AND C.pen_top=D.pen_top AND G.inf_id=E.inf_id AND G.nuc_id=H.nuc_id AND I.esp_id=D.esp_id AND J.reg_id=D.reg_id AND K.mod_id=D.mod_id AND L.coh_id=D.coh_id AND D.pac_id='$this->pac_id' AND D.capi_sta='1' and D.inf_id=E.inf_id AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND D.asi_cod=F.asi_cod AND D.esp_id=F.esp_id AND D.reg_id=F.reg_id AND D.mod_id=F.mod_id AND D.coh_id=F.coh_id AND D.pen_top=F.pen_top AND D.pac_id=F.pac_id AND D.ci='$this->ci') as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' AND A.hor_id='$hor_id' GROUP BY A.hor_tpl ORDER BY A.hor_tpl,B.asi_cht,B.asi_chp,B.asi_chl");
	return $res;
  }
//******************************************************************
  function Buscar_materia_pensum_todas2($inf_id,$asi_cod,$asi_nom){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT DISTINCT(F.esp_id) AS 'esp_id', G.reg_id AS 'reg_id', H.mod_id AS 'mod_id', I.coh_id AS 'coh_id', B.sec_id AS 'sec_id', A.pen_top AS 'pen_top' FROM asigna_seccio A, seccio B, asigna C, dias D, blo_hor E, especi F, regimen G, modali H, cohort I WHERE A.pac_id='$this->pac_id' AND A.ase_sta='1' AND A.sec_id=B.sec_id AND A.asi_cod=C.asi_cod AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND A.asi_cod='$asi_cod' AND C.asi_nom='$asi_nom' AND B.inf_id='$inf_id' AND A.esp_id=F.esp_id AND A.reg_id=G.reg_id AND A.mod_id=H.mod_id AND A.coh_id=I.coh_id AND B.sec_sta='1' AND C.asi_sta='1' AND F.esp_sta='1' AND G.reg_sta='1' AND H.mod_sta='1' AND I.coh_sta='1'");
	return $res;
  }
//******************************************************************
  function Buscar_materia_pensum_horario($inf_id,$asi_cod,$asi_nom,$esp_id,$reg_id,$mod_id,$coh_id,$sec_id,$ci){
/*      echo "<script>alert('id: $id');</script>";*/
    $row=0;
    $res=$this->Operacion("SELECT DISTINCT(F.esp_nom) AS 'esp_nom', F.esp_id AS 'esp_id', G.reg_nom AS 'reg_nom', G.reg_id AS 'reg_id', H.mod_nom AS 'mod_nom', H.mod_id AS 'mod_id', I.coh_nom AS 'coh_nom', I.coh_id AS 'coh_id', B.sec_nom AS 'sec_nom', B.sec_id AS 'sec_id' FROM horario A, seccio B, asigna C, dias D, blo_hor E, especi F, regimen G, modali H, cohort I WHERE A.pac_id='$this->pac_id' AND A.hor_sta='1' AND A.sec_id=B.sec_id AND A.asi_cod=C.asi_cod AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND A.asi_cod='$asi_cod' AND C.asi_nom='$asi_nom' AND B.inf_id='$inf_id' AND A.dia_id=D.dia_id AND A.blh_id=E.blh_id AND A.esp_id=F.esp_id AND A.reg_id=G.reg_id AND A.mod_id=H.mod_id AND A.coh_id=I.coh_id AND B.sec_sta='1' AND C.asi_sta='1' AND D.dia_sta='1' AND E.blh_sta='1' AND F.esp_sta='1' AND G.reg_sta='1' AND H.mod_sta='1' AND I.coh_sta='1' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.mod_id='$mod_id' AND A.coh_id='$coh_id' AND A.sec_id='$sec_id' AND A.ci='$ci'");
	$num_fila=$this->NumFilasCualquiera($res);
	if($num_fila>0)
	  $row=1;
	return $row;
  }  
//******************************************************************
  function Buscar_materia_pensum_horario3($inf_id,$asi_cod,$asi_nom,$esp_id,$reg_id,$mod_id,$coh_id,$sec_id){
/*      echo "<script>alert('id: $id');</script>";*/
    $row=0;
    $res=$this->Operacion("SELECT DISTINCT(F.esp_nom) AS 'esp_nom', F.esp_id AS 'esp_id', G.reg_nom AS 'reg_nom', G.reg_id AS 'reg_id', H.mod_nom AS 'mod_nom', H.mod_id AS 'mod_id', I.coh_nom AS 'coh_nom', I.coh_id AS 'coh_id', B.sec_nom AS 'sec_nom', B.sec_id AS 'sec_id', A.hor_id AS hor_id FROM horario A, seccio B, asigna C, dias D, blo_hor E, especi F, regimen G, modali H, cohort I WHERE A.pac_id='$this->pac_id' AND A.hor_sta='1' AND A.sec_id=B.sec_id AND A.asi_cod=C.asi_cod AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND A.asi_cod='$asi_cod' AND C.asi_nom='$asi_nom' AND B.inf_id='$inf_id' AND A.dia_id=D.dia_id AND A.blh_id=E.blh_id AND A.esp_id=F.esp_id AND A.reg_id=G.reg_id AND A.mod_id=H.mod_id AND A.coh_id=I.coh_id AND B.sec_sta='1' AND C.asi_sta='1' AND D.dia_sta='1' AND E.blh_sta='1' AND F.esp_sta='1' AND G.reg_sta='1' AND H.mod_sta='1' AND I.coh_sta='1' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.mod_id='$mod_id' AND A.coh_id='$coh_id' AND A.sec_id='$sec_id'");
	return $res;
  }
//******************************************************************
  function Buscar_docente1($ci){
/*      echo "<script>alert('SELECT concat(A.ap1, ,A.ap2, ,A.no1, ,A.no2) AS nombre, B.usu_cor AS correo, A.tmo AS telf FROM persona A, usuari B WHERE A.ci=B.ci AND A.ci=$ci AND A.sta=1');</script>";*/
    $res=$this->Operacion("SELECT concat(A.ap1,' ',A.ap2,' ',A.no1,' ',A.no2) AS 'nombre', B.usu_cor AS 'correo', A.tmo AS 'telf' FROM persona A, usuari B WHERE A.ci=B.ci AND A.ci='$ci' AND A.sta='1'");
	$array=$this->ConsultarCualquiera($res);
	return $array;
  }
//******************************************************************
  function Buscar_pacade1($pac_id){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT pac_nom FROM pacade WHERE pac_id='$pac_id'");
	$array=$this->ConsultarCualquiera($res);
	return $array->pac_nom;
  }
//******************************************************************
  function Buscar_Blh_Ini_Fin($blh_id, $dia_id){
/*    echo "<script>alert('SELECT * FROM dispon WHERE blh_id=$blh_id AND dia_id=$dia_id AND inf_id=$this->inf_id AND dbh_tip=$this->dbh_tip AND pac_id=$this->pac_id AND ci_emp=$this->ci');</script>";*/
    $this->ci=$_SESSION['ci'];
    $res=$this->Operacion("SELECT * FROM dispon WHERE blh_id='$blh_id' AND dia_id='$dia_id' AND inf_id='$this->inf_id' AND dbh_tip='$this->dbh_tip' AND pac_id='$this->pac_id' AND ci_emp='$this->ci'");
    $num_filas=$this->NumFilas();
/*echo "<script>alert('Filas: $num_filas');</script>";*/
    if($num_filas>0)
      $row=$res;
    return $row;
  }
//******************************************************************
  function Buscar_Blh_Ini_Fin1($blh_id, $dia_id){
/*    echo "<script>alert('SELECT * FROM dispon WHERE blh_id=$blh_id AND dia_id=$dia_id AND inf_id=$this->inf_id AND dbh_tip=$this->dbh_tip AND pac_id=$this->pac_id AND ci_emp=$this->ci');</script>";*/
    $row=0;
	$this->ci=$_SESSION['ci'];
    $res=$this->Operacion("SELECT * FROM dispon WHERE blh_id='$blh_id' AND dia_id='$dia_id' AND inf_id='$this->inf_id' AND dbh_tip='$this->dbh_tip' AND pac_id='$this->pac_id' AND ci_emp='$this->ci'");
    $num_filas=$this->NumFilas();
    /*echo "<script>alert('Filas: $num_filas');</script>";*/
    if($num_filas>0)
      $row=1;
/*    echo "<script>alert('filas1 $row');</script>";*/
    return $row;
  }
//****************************************************************************************************
  function Agregar_Dia_Blo_Inf_Tip($blo,$dia,$sta){
/*    echo "<script>alert('INSERT INTO dispon (pac_id, dia_id, blh_id, inf_id, ci_emp, dbh_tip, dis_sta) VALUES ($this->pac_id,$dia, $blo, $this->inf_id, $this->ci, $this->dbh_tip, $sta)');</script>";*/
	$res=$this->Operacion("INSERT INTO dispon (pac_id, dia_id, blh_id, inf_id, ci_emp, dbh_tip, dis_sta)
						VALUES ('$this->pac_id','$dia', '$blo', '$this->inf_id', '$this->ci', '$this->dbh_tip', '$sta')");
    $num_filas=$this->filas_afectadas($res);
	if($num_filas>0){
	  $accion='INSERTAR';
      $Operacion="DOCENTE: ".$this->ci." INFRAE: ".$this->inf_id." PACADE: ".$this->pac_id." TIPO DE FORMATO: ".$this->dbh_tip." DIA: ".$dia." BLOQUE DE HORA: ".$blo." DISPONIBILIDAD: ".$sta."";	
	  $this->guardar_accion($accion,"dispon",$Operacion);
	}
    return $num_filas;
  }
//******************************************************************
  function Modificar_Dia_Blo_Inf_Tip($blo,$dia,$sta){
/*    echo "<script>alert('UPDATE dispon set dis_sta=$sta WHERE pac_id=$this->pac_id AND dia_id=$dia AND blh_id=$blo AND inf_id=$this->inf AND ci_emp=$this->ci AND dbh_tip=$this->dbh_tip');</script>";*/
    $res=$this->Operacion("UPDATE dispon set dis_sta='$sta' WHERE pac_id='$this->pac_id' AND dia_id='$dia' AND blh_id='$blo' AND inf_id='$this->inf_id' AND ci_emp='$this->ci' AND dbh_tip='$this->dbh_tip'");
    $num_filas=$this->filas_afectadas($res);
	if($num_filas>0){
	  $accion='MODIFICAR';
      $Operacion="DOCENTE: ".$this->ci." INFRAE: ".$this->inf_id." PACADE: ".$this->pac_id." TIPO DE FORMATO: ".$this->dbh_tip." DIA: ".$dia." BLOQUE DE HORA: ".$blo." DISPONIBILIDAD: ".$sta."";	
	  $this->guardar_accion($accion,"dispon",$Operacion);
	}
    return $num_filas;
  }
//******************************************************************
  function Buscar_aula_disponible($inf_id,$dia,$blh,$hor_ini,$hor_fin){
    $res=$this->Operacion("SELECT DISTINCT(A.aul_nom) AS 'aul_nom', A.aul_id AS 'aul_id', A.aul_ubi as 'aul_ubi' FROM aulas A WHERE A.aul_sta='1' AND A.inf_id='$inf_id' AND A.aul_id NOT IN(SELECT DISTINCT(B.aul_id) FROM horario B WHERE B.dia_id='$dia' AND B.blh_id IN (SELECT C.blh_id FROM blo_hor C WHERE C.blh_sta = '1' AND ((C.blh_ini BETWEEN '$hor_ini' AND '$hor_fin') OR (C.blh_fin BETWEEN '$hor_ini' AND '$hor_fin'))) AND B.pac_id='$this->pac_id' AND B.dbh_tip='0' AND B.hor_sta='1')");
	return $res;
  }
//******************************************************************
  function Buscar_Docen($ci){
    $id=$no=$ap=$tm=$cor="";
    $resp=$this->OperacionCualquiera("SELECT A.ci AS ci, concat(A.ap1,' ',A.ap2) AS ap, concat(A.no1,' ', A.no2) AS no, A.tmo AS tm, B.usu_cor AS cor FROM persona A, usuari B WHERE A.ci=B.ci AND A.ci='$ci'");
	$cuantos=$this->NumFilasCualquiera($resp);
/*	echo "<script>alert('$cuantos');</script>";*/
    $array=$this->ConsultarCualquiera($resp);
	$cadena=$array->ap;
	$cadena1=$array->no;
	for ($i=0;$i<strlen($cadena);$i++){
      if($cadena[$i]=='Á')
        $cadena[$i]='A';
	  else{
		if($cadena[$i]=='É')
          $cadena[$i]='E';
		else{
		  if($cadena[$i]=='Í')
            $cadena[$i]='I';
		  else{
			if($cadena[$i]=='Ó')
              $cadena[$i]='O';
			else{
			  if($cadena[$i]=='Ú')
                $cadena[$i]='U';
			  else{
				if($cadena[$i]=='Ñ')
                  $cadena[$i]='N';
			  }
			}
		  }
		}	
	  }
    }
	for ($i=0;$i<strlen($cadena1);$i++){
      if($cadena1[$i]=='Á')
        $cadena1[$i]='A';
	  else{
		if($cadena1[$i]=='É')
          $cadena1[$i]='E';
		else{
		  if($cadena1[$i]=='Í')
            $cadena1[$i]='I';
		  else{
			if($cadena1[$i]=='Ó')
              $cadena1[$i]='O';
			else{
			  if($cadena1[$i]=='Ú')
                $cadena1[$i]='U';
			  else{
				if($cadena1[$i]=='Ñ')
                  $cadena1[$i]='N';
			  }
			}
		  }
		}	
	  }
    }
	$id=$array->ci;
	$ap=$cadena;
	$no=$cadena1;
	$tm=$array->tm;
	$cor=$array->cor;
	$this->res=$id."!".$ap."!".$no."!".$tm."!".$cor."!".$cuantos;
  }
//******************************************************************
function Buscar_docente_matricula($ci){
/*echo "<script>alert('SELECT DISTINCT(D.coh_nom) AS coh_nom, B.reg_nom AS reg_nom, C.esp_nom AS esp_nom, A.mod_nom AS mod_nom, F.inf_nom AS inf_nom FROM estudi_infrae_matric E, modali A, regimen B, especi C, cohort D, infrae F WHERE E.ci=$ci AND (E.eim_tip=1 OR E.eim_tip=2) AND E.eim_sta=1 AND E.mod_id=A.mod_id AND E.reg_id=B.reg_id AND E.esp_id=C.esp_id AND E.coh_id=D.coh_id AND E.inf_id=F.inf_id ORDER BY F.inf_nom,A.mod_nom,B.reg_nom,C.esp_nom,D.coh_nom');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT DISTINCT(D.coh_nom) AS 'coh_nom', B.reg_nom AS 'reg_nom', C.esp_nom AS 'esp_nom', A.mod_nom AS 'mod_nom', F.inf_nom AS 'inf_nom' FROM estudi_infrae_matric E, modali A, regimen B, especi C, cohort D, infrae F WHERE E.ci='$ci' AND (E.eim_tip='1' OR E.eim_tip='2') AND E.eim_sta='1' AND E.mod_id=A.mod_id AND E.reg_id=B.reg_id AND E.esp_id=C.esp_id AND E.coh_id=D.coh_id AND E.inf_id=F.inf_id ORDER BY F.inf_nom,A.mod_nom,B.reg_nom,C.esp_nom,D.coh_nom");
	return $resp;
}
//******************************************************************
function Buscar_asigna_seccio_docent($inf_id,$asi_cod,$asi_nom){
  $resp=$this->OperacionCualquiera("SELECT A.asi_lab AS 'asi_lab' FROM asigna A, asigna_seccio B, seccio D WHERE A.mod_id=B.mod_id AND  A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND B.sec_id=D.sec_id AND A.asi_sta='1' AND B.ase_sta='1' AND D.inf_id='$inf_id' AND A.asi_cod='$asi_cod' AND A.asi_nom='$asi_nom' AND B.pac_id='$this->pac_id'");
  $cuantos=$this->NumFilasCualquiera($resp);
  $array=$this->ConsultarCualquiera($resp);
  if($array->asi_lab=='1')
    $cuantos=$cuantos*2;
  $resp=$this->OperacionCualquiera("SELECT C.ci_doc AS 'ci_doc', C.asd_tpl AS 'asd_tpl' FROM asigna A, asigna_seccio B, asigna_seccio_docent C, seccio D WHERE A.mod_id=B.mod_id AND B.mod_id=C.mod_id AND A.esp_id=B.esp_id AND B.esp_id=C.esp_id AND A.reg_id=B.reg_id AND B.reg_id=C.reg_id AND A.coh_id=B.coh_id AND B.coh_id=C.coh_id AND A.pen_top=B.pen_top AND B.pen_top=C.pen_top AND A.asi_cod=B.asi_cod AND B.asi_cod=C.asi_cod AND B.sec_id=C.sec_id AND C.sec_id=D.sec_id AND B.pac_id=C.pac_id AND B.ase_sta='1' AND A.asi_sta='1' AND D.sec_sta='1' AND C.asd_sta='1' AND D.inf_id='$inf_id' AND A.asi_cod='$asi_cod' AND A.asi_nom='$asi_nom' AND C.pac_id='$this->pac_id'");
  $filas=$this->NumFilasCualquiera($resp);
/*	echo "<script>alert('$cuantos');</script>";*/
  if($cuantos!=$filas){
    $cuantos=0;
  }
  return $cuantos;
}
//******************************************************************
function Buscar_asigna_seccio_docent_sec($inf_id,$mod_id,$esp_id,$reg_id,$coh_id,$asi_cod,$asi_nom,$sec_id,$ci_doc){
  $resp=$this->OperacionCualquiera("SELECT A.asi_lab AS 'asi_lab' FROM asigna A, asigna_seccio B, seccio D WHERE A.mod_id=B.mod_id AND  A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND B.sec_id=D.sec_id AND A.asi_sta='1' AND B.ase_sta='1' AND D.inf_id='$inf_id' AND A.asi_cod='$asi_cod' AND A.asi_nom='$asi_nom' AND B.sec_id='$sec_id' AND B.pac_id='$this->pac_id' AND A.mod_id='$mod_id' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.coh_id='$coh_id'");
  $cuantos=$this->NumFilasCualquiera($resp);
/*  echo "<script>alert(' ANTES $cuantos');</script>";*/
  $array=$this->ConsultarCualquiera($resp);
  if($array->asi_lab=='1')
    $cuantos=$cuantos*2;
/*  echo "<script>alert(' DESPUES $cuantos');</script>";*/
  $resp=$this->OperacionCualquiera("SELECT C.ci_doc AS 'ci_doc', C.asd_tpl AS 'asd_tpl' FROM asigna A, asigna_seccio B, asigna_seccio_docent C, seccio D WHERE A.mod_id=B.mod_id AND B.mod_id=C.mod_id AND A.esp_id=B.esp_id AND B.esp_id=C.esp_id AND A.reg_id=B.reg_id AND B.reg_id=C.reg_id AND A.coh_id=B.coh_id B.coh_id=C.coh_id AND A.pen_top=B.pen_top AND B.pen_top=C.pen_top AND A.asi_cod=B.asi_cod AND B.asi_cod=C.asi_cod AND B.sec_id=C.sec_id AND C.sec_id=D.sec_id AND B.pac_id=C.pac_id AND A.asi_sta='1' AND B.ase_sta='1' AND C.asd_sta='1' AND D.sec_sta='1' AND D.inf_id='$inf_id' AND A.asi_cod='$asi_cod' AND A.asi_nom='$asi_nom' AND C.pac_id='$this->pac_id' AND B.mod_id='$mod_id' AND B.esp_id='$esp_id' AND B.reg_id='$reg_id' AND B.coh_id='$coh_id'");
  $filas=$this->NumFilasCualquiera($resp);
/*	echo "<script>alert('FILAS $filas');</script>";*/
  if($cuantos>$filas){
    $cuantos=0;
  }
  return $cuantos;
}
//******************************************************************
function Buscar_asigna_seccio_docent_sec2($inf_id,$mod_id,$esp_id,$reg_id,$coh_id,$asi_cod,$asi_nom,$sec_id,$ci_doc){
  $resp=$this->OperacionCualquiera("SELECT A.asi_lab AS 'asi_lab' FROM asigna A, asigna_seccio B, seccio D WHERE A.mod_id=B.mod_id AND  A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND B.sec_id=D.sec_id AND A.asi_sta='1' AND B.ase_sta='1' AND D.inf_id='$inf_id' AND A.asi_cod='$asi_cod' AND A.asi_nom='$asi_nom' AND B.sec_id='$sec_id' AND B.pac_id='$this->pac_id' AND A.mod_id='$mod_id' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.coh_id='$coh_id'");
  $cuantos=$this->NumFilasCualquiera($resp);
  $array=$this->ConsultarCualquiera($resp);
  if($array->asi_lab=='1')
    $cuantos=$cuantos*2;
  $resp=$this->OperacionCualquiera("SELECT C.ci_doc AS 'ci_doc', C.asd_tpl AS 'asd_tpl' FROM asigna A, asigna_seccio B, asigna_seccio_docent C, seccio D WHERE A.mod_id=B.mod_id AND B.mod_id=C.mod_id AND A.esp_id=B.esp_id AND B.esp_id=C.esp_id AND A.reg_id=B.reg_id AND B.reg_id=C.reg_id AND A.coh_id=B.coh_id AND B.coh_id=C.coh_id AND A.pen_top=B.pen_top AND B.pen_top=C.pen_top AND A.asi_cod=B.asi_cod AND B.asi_cod=C.asi_cod AND B.sec_id=C.sec_id AND C.sec_id=D.sec_id AND B.pac_id=C.pac_id AND  A.asi_sta='1' AND B.ase_sta='1' AND C.asd_sta='1' AND D.sec_sta='1' AND D.inf_id='$inf_id' AND A.asi_cod='$asi_cod' AND A.asi_nom='$asi_nom' AND C.pac_id='$this->pac_id' AND B.mod_id='$mod_id' AND B.esp_id='$esp_id' AND B.reg_id='$reg_id' AND B.coh_id='$coh_id'");
  $filas=$this->NumFilasCualquiera($resp);
/*	echo "<script>alert('$cuantos');</script>";*/
  if($cuantos!=$filas){
    $cuantos=0;
  }
  return $cuantos;
}
//******************************************************************
  function Listado_oferta_docente($ci,$inf_id,$asi_cod,$asi_nom){
/*    echo "<script>alert('SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS asi_cod, A.esp_id AS esp_id, A.reg_id AS reg_id, A.mod_id AS mod_id, A.coh_id AS coh_id, A.pen_top AS pen_top, A.inf_id AS inf_id, C.nuc_id AS nuc_id, A.pac_id AS pac_id, A.ci AS ci FROM coo_asi_pac_inf A, infrae B, nucleo C WHERE A.pac_id = $this->pac_id AND A.ci = $this->ci AND A.capi_sta = 1 AND B.inf_sta = 1 AND C.nuc_sta = 1 AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = $this->pac_id AND A.ase_sta = 1 GROUP BY A.ase_id LIMIT $cantidad OFFSET $inicial');</script>";*/
    $resultado=$this->Operacion("SELECT A.ase_id AS 'ase_id', B.asi_lab AS 'asi_lab', B.asi_cht AS 'asi_cht', B.asi_chp AS 'asi_chp', B.asi_chl AS 'asi_chl' FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS 'asi_cod', A.esp_id AS 'esp_id', A.reg_id AS 'reg_id', A.mod_id AS 'mod_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', A.inf_id AS 'inf_id', C.nuc_id AS 'nuc_id', A.pac_id AS 'pac_id', A.ci AS 'ci', E.asi_lab AS 'asi_lab', E.asi_cht AS 'asi_cht', E.asi_chp AS 'asi_chp', E.asi_chl AS 'asi_chl' FROM coo_asi_pac_inf A, infrae B, nucleo C, estudi_infrae_matric D, asigna E WHERE A.pac_id = '$this->pac_id' AND A.ci = '$this->ci' AND A.capi_sta = '1' AND B.inf_sta = '1' AND C.nuc_sta = '1' AND D.eim_sta='1' AND E.asi_sta='1' AND A.inf_id = B.inf_id AND A.inf_id=D.inf_id AND B.nuc_id = C.nuc_id AND A.asi_cod=E.asi_cod AND A.esp_id=D.esp_id AND A.esp_id=E.esp_id AND A.reg_id=D.reg_id AND A.reg_id=E.reg_id AND A.mod_id=D.mod_id AND A.mod_id=E.mod_id AND A.coh_id=D.coh_id AND A.coh_id=E.coh_id AND A.pen_top=D.pen_top  AND A.pen_top=E.pen_top AND D.ci='$ci' AND A.inf_id='$inf_id' AND A.asi_cod='$asi_cod' AND E.asi_nom='$asi_nom') AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = '$this->pac_id' AND A.ase_sta = '1' AND ((B.asi_lab=1 AND A.ci_doc_pol='0') OR A.ci_emp='0') GROUP BY A.ase_id");
    return $resultado;
  }

//******************************************************************
  function Buscar_oferta_todas($ase_id){
/*      echo "<script>alert('ase_id: $ase_id');</script>";*/
	  $res=$this->OperacionCualquiera("SELECT A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom', B.nuc_nom AS 'nuc_nom', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', CONCAT(A.asi_cod,' ',A.asi_nom) AS 'asigna', B.sec_id AS 'sec_id', B.sec_nom AS 'sec_nom', B.mod_id AS 'mod_id', B.mod_nom AS 'mod_nom', B.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', B.esp_id AS 'esp_id', B.esp_nom AS 'esp_nom', B.reg_id AS 'reg_id', B.reg_nom AS 'reg_nom', B.ele_nom AS 'ele_nom', B.ase_tev AS 'ase_tev', B.ase_pte AS 'ase_pte', B.ase_pla AS 'ase_pla', B.ase_cma AS 'ase_cma', A.asi_cht AS 'asi_cht', A.asi_chp AS 'asi_chp', A.asi_chl AS 'asi_chl', A.asi_lab AS 'asi_lab', B.doc_teo AS 'doc_teo', B.doc_lab AS 'doc_lab' FROM asigna AS A RIGHT JOIN(SELECT B.mod_id AS 'mod_id',F.mod_nom AS 'mod_nom', B.esp_id AS 'esp_id', G.esp_nom AS 'esp_nom', B.reg_id AS 'reg_id', H.reg_nom AS 'reg_nom', B.coh_id AS 'coh_id', I.coh_nom AS 'coh_nom', B.pen_top AS 'pen_top', B.asi_cod AS 'asi_cod', B.sec_id AS 'sec_id', E.sec_nom AS 'sec_nom', B.ase_id AS 'ase_id', C.nuc_nom AS 'nuc_nom', C.nuc_id AS 'nuc_id', D.inf_nom AS 'inf_nom', D.inf_id AS 'inf_id', J.ele_nom AS 'ele_nom', B.ase_tev AS 'ase_tev', B.ase_pte AS 'ase_pte', B.ase_pla AS 'ase_pla', B.ase_cma AS 'ase_cma', B.ci_emp AS 'doc_teo', B.ci_doc_pol AS 'doc_lab' FROM asigna_seccio B, nucleo C, infrae D, seccio E, modali F, especi G, regimen H, cohort I, electi J, coo_asi_pac_inf K WHERE K.mod_id=F.mod_id AND K.esp_id=G.esp_id AND K.reg_id=H.reg_id AND K.coh_id=I.coh_id AND K.capi_sta='1' AND K.inf_id=D.inf_id AND K.ci='$this->ci' AND K.pac_id=B.pac_id AND B.ele_cod=J.ele_cod AND B.mod_id=F.mod_id AND B.esp_id=G.esp_id AND B.reg_id=H.reg_id AND B.coh_id=I.coh_id AND B.sec_id=E.sec_id AND E.inf_id=D.inf_id AND D.nuc_id=C.nuc_id AND B.ase_sta='1' AND C.nuc_sta='1' AND D.inf_sta='1' AND E.sec_sta='1' AND F.mod_sta='1' AND G.esp_sta='1' AND H.reg_sta='1' AND I.coh_sta='1' AND B.ase_id='$ase_id') AS B ON A.mod_id=B.mod_id AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod WHERE A.asi_sta='1' GROUP BY B.nuc_id,B.inf_id,A.mod_id,A.esp_id,A.reg_id,A.coh_id,A.asi_cod,A.asi_nom,B.sec_id");
	return $res;
  }
//******************************************************************
  function Contar_Inscritos($asi_cod,$mod_id,$esp_id,$reg_id,$coh_id,$sec_id){ 
/*  echo "<script>alert('SELECT COUNT(*) AS cant_ins FROM detins WHERE mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND coh_id=$coh_id AND asi_cod=$asi_cod AND sec_id=$sec_id AND det_sta=1 AND pac_id=$this->pac_id GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id');</script>";*/
    $res=$this->OperacionCualquiera("SELECT COUNT(*) AS 'cant_ins' FROM detins WHERE mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND coh_id='$coh_id' AND asi_cod='$asi_cod' AND sec_id='$sec_id' AND det_sta='1' AND pac_id='$this->pac_id' GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id");
	$array=$this->ConsultarCualquiera($res);
	if($array->cant_ins<=0)
	  $cant_ins=0;
	else
	  $cant_ins=$array->cant_ins;
    return $cant_ins;
  }
//******************************************************************
}?>