<?php session_start();
class oferta extends conec_BD
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
	var $ase_cma;
//******************************************************************
//$_POST[mod_id],$_POST[reg_id],$_POST[esp_id],$_POST[coh_id],$todo
  function oferta($pac_id, $coh_id, $mod_id, $reg_id, $esp_id, $pen_top, $asi_cod, $sec_id, $ele_cod, $ci_emp, $sta, $ase_p11, $ase_p12, $ase_p21, $ase_p22, $ase_p31, $ase_p32, $ase_pla){
    $this->pac_id=$pac_id;
    $this->coh_id=$coh_id;
    $this->mod_id=$mod_id;
    $this->reg_id=$reg_id;
    $this->esp_id=$esp_id;
    $this->pen_top=$pen_top;
    $this->asi_cod=$asi_cod;
    $this->sec_id=$sec_id;
    $this->ele_cod=$ele_cod;
    $this->ci=$_SESSION['ci'];
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
  function Contar_oferta_Todas(){
    $num_filas='';
/*	echo "<script>alert('SELECT B.pac_id AS pac_id, B.coh_id AS coh_id, B.mod_id AS mod_id, B.reg_id AS reg_id, B.esp_id AS esp_id, B.pen_top AS pen_top, B.capi_tpl AS capi_tpl, B.asi_cod AS asi_cod, B.asi_nom AS asi_nom, B.asi_cba AS asi_cba, B.nuc_id AS nuc_id, B.inf_id AS inf_id, A.remi_tca AS remi_tca FROM reg_esp_mod_infrae AS A LEFT JOIN (SELECT D.pac_id AS pac_id, D.coh_id AS coh_id, D.mod_id AS mod_id, D.reg_id AS reg_id, D.esp_id AS esp_id, D.pen_top AS pen_top, D.capi_tpl AS capi_tpl, F.asi_cod AS asi_cod, F.asi_nom AS asi_nom, F.asi_cba AS asi_cba, E.nuc_id AS nuc_id', G.inf_id AS 'inf_id' FROM coo_asi_pac_inf D, asigna F, nucleo E, infrae G WHERE D.capi_sta='1' AND F.asi_sta='1' AND D.asi_cod=F.asi_cod AND D.esp_id=F.esp_id AND D.reg_id=F.reg_id AND D.mod_id=F.mod_id AND D.coh_id=F.coh_id AND D.pen_top=F.pen_top AND D.inf_id=G.inf_id AND G.nuc_id=E.nuc_id AND E.nuc_sta='1' AND G.inf_sta='1' AND D.inf_id IN (SELECT DISTINCT(C.inf_id) FROM estudi_infrae C, reg_esp_mod_infrae D, reg_esp_mod E, matric G WHERE C.inf_id = D.inf_id AND C.est_inf_ffi = '0000-00-00 00:00:00' AND D.mod_id = E.mod_id AND D.esp_id = E.esp_id AND D.reg_id = E.reg_id AND D.remi_sta = '1' AND E.rem_sta = '1' AND G.mod_id = E.mod_id AND G.esp_id = E.esp_id AND G.reg_id =E.reg_id AND G.matr_tip = '1' AND G.matr_sta = '1' AND C.ci = '$this->ci') AND D.pac_id='$this->pac_id' AND D.ci='$this->ci') AS B ON A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.mod_id=B.mod_id AND A.inf_id=B.inf_id WHERE A.remi_sta='1' AND B.pac_id IS NOT NULL GROUP BY B.nuc_id,B.inf_id,B.mod_id,B.esp_id,B.reg_id,B.coh_id,B.asi_cod');</script>";*/
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT B.pac_id AS 'pac_id', B.coh_id AS 'coh_id', B.mod_id AS 'mod_id', B.reg_id AS 'reg_id', B.esp_id AS 'esp_id', B.pen_top AS 'pen_top', B.capi_tpl AS 'capi_tpl', B.asi_cod AS 'asi_cod', B.asi_nom AS 'asi_nom', B.asi_cba AS 'asi_cba', B.nuc_id AS 'nuc_id', B.inf_id AS 'inf_id', A.remi_tca AS 'remi_tca' FROM reg_esp_mod_infrae AS A LEFT JOIN (SELECT D.pac_id AS 'pac_id', D.coh_id AS 'coh_id', D.mod_id AS 'mod_id', D.reg_id AS 'reg_id', D.esp_id AS 'esp_id', D.pen_top AS 'pen_top', D.capi_tpl AS 'capi_tpl', F.asi_cod AS 'asi_cod', F.asi_nom AS 'asi_nom', F.asi_cba AS 'asi_cba', E.nuc_id AS 'nuc_id', G.inf_id AS 'inf_id' FROM coo_asi_pac_inf D, asigna F, nucleo E, infrae G WHERE D.capi_sta='1' AND F.asi_sta='1' AND D.asi_cod=F.asi_cod AND D.esp_id=F.esp_id AND D.reg_id=F.reg_id AND D.mod_id=F.mod_id AND D.coh_id=F.coh_id AND D.pen_top=F.pen_top AND D.inf_id=G.inf_id AND G.nuc_id=E.nuc_id AND E.nuc_sta='1' AND G.inf_sta='1' AND D.inf_id IN (SELECT DISTINCT(C.inf_id) FROM estudi_infrae C, reg_esp_mod_infrae D, reg_esp_mod E, matric G WHERE C.inf_id = D.inf_id AND C.est_inf_ffi = '0000-00-00 00:00:00' AND D.mod_id = E.mod_id AND D.esp_id = E.esp_id AND D.reg_id = E.reg_id AND D.remi_sta = '1' AND E.rem_sta = '1' AND G.mod_id = E.mod_id AND G.esp_id = E.esp_id AND G.reg_id =E.reg_id AND G.matr_tip = '1' AND G.matr_sta = '1' AND C.ci = '$this->ci') AND D.pac_id='$this->pac_id' AND D.ci='$this->ci') AS B ON A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.mod_id=B.mod_id AND A.inf_id=B.inf_id WHERE A.remi_sta='1' AND B.pac_id IS NOT NULL GROUP BY B.nuc_id,B.inf_id,B.mod_id,B.esp_id,B.reg_id,B.coh_id,B.asi_cod");
    $num_filas=$this->NumFilas();	/*echo "<script>alert('FILAS: $num_filas');</script>";*/
    return $num_filas;
  }

//******************************************************************
  function Contar_oferta(){
    $num_filas='';
/*	echo "<script>alert('$this->pac_id, $this->ci');</script>";*/
/*	echo "<script>alert('SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS asi_cod, A.esp_id AS esp_id, A.reg_id AS reg_id, A.mod_id AS mod_id, A.coh_id AS coh_id, A.pen_top AS pen_top, A.inf_id AS inf_id, C.nuc_id AS nuc_id, A.pac_id AS pac_id, A.ci AS ci FROM coo_asi_pac_inf A, infrae B, nucleo C WHERE A.pac_id = $this->pac_id AND A.ci = $this->ci AND A.capi_sta = 1 AND B.inf_sta = 1 AND C.nuc_sta = 1 AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = $this->pac_id AND A.ase_sta = 1 GROUP BY A.ase_id');</script>";*/
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS 'asi_cod', A.esp_id AS 'esp_id', A.reg_id AS 'reg_id', A.mod_id AS 'mod_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', A.inf_id AS 'inf_id', C.nuc_id AS 'nuc_id', A.pac_id AS 'pac_id', A.ci AS 'ci', D.sec_id AS 'sec_id' FROM coo_asi_pac_inf A, infrae B, nucleo C, seccio D WHERE A.pac_id = '$this->pac_id' AND A.ci = '$this->ci' AND A.capi_sta = '1' AND B.inf_sta = '1' AND C.nuc_sta = '1' AND D.sec_sta='1' AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id AND D.inf_id=A.inf_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = '$this->pac_id' AND A.ase_sta = '1' AND B.sec_id=A.sec_id GROUP BY A.ase_id");
    $num_filas=$this->NumFilas();	/*echo "<script>alert('FILAS: $num_filas');</script>";*/
    return $num_filas;
  }
//******************************************************************
  function Contar_oferta_nucleo($nuc_id){
    $num_filas='';
/*	echo "<script>alert('SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS asi_cod, A.esp_id AS esp_id, A.reg_id AS reg_id, A.mod_id AS mod_id, A.coh_id AS coh_id, A.pen_top AS pen_top, A.inf_id AS inf_id, C.nuc_id AS nuc_id, A.pac_id AS pac_id, A.ci AS ci FROM coo_asi_pac_inf A, infrae B, nucleo C WHERE A.pac_id = $this->pac_id AND A.ci = $this->ci AND A.capi_sta = 1 AND B.inf_sta = 1 AND C.nuc_sta = 1 AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = $this->pac_id AND A.ase_sta = 1 AND B.nuc_id=$nuc_id GROUP BY A.ase_id');</script>";*/
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS 'asi_cod', A.esp_id AS 'esp_id', A.reg_id AS 'reg_id', A.mod_id AS 'mod_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', A.inf_id AS 'inf_id', C.nuc_id AS 'nuc_id', A.pac_id AS 'pac_id', A.ci AS 'ci', D.sec_id AS 'sec_id' FROM coo_asi_pac_inf A, infrae B, nucleo C, seccio D WHERE A.pac_id = '$this->pac_id' AND A.ci = '$this->ci' AND A.capi_sta = '1' AND B.inf_sta = '1' AND C.nuc_sta = '1' AND D.sec_sta='1' AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id AND D.inf_id=A.inf_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = '$this->pac_id' AND A.ase_sta = '1' AND B.sec_id=A.sec_id AND B.nuc_id='$nuc_id' GROUP BY A.ase_id");
    $num_filas=$this->NumFilas();	/*echo "<script>alert('FILAS: $num_filas');</script>";*/
    return $num_filas;
  }
//******************************************************************
  function Contar_oferta_nucleo_infrae($nuc_id,$inf_id){
    $num_filas='';
/*	echo "<script>alert('SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS asi_cod, A.esp_id AS esp_id, A.reg_id AS reg_id, A.mod_id AS mod_id, A.coh_id AS coh_id, A.pen_top AS pen_top, A.inf_id AS inf_id, C.nuc_id AS nuc_id, A.pac_id AS pac_id, A.ci AS ci FROM coo_asi_pac_inf A, infrae B, nucleo C WHERE A.pac_id = $this->pac_id AND A.ci = $this->ci AND A.capi_sta = 1 AND B.inf_sta = 1 AND C.nuc_sta = 1 AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = $this->pac_id AND A.ase_sta = 1 AND B.nuc_id=$nuc_id AND B.inf_id=$inf_id GROUP BY A.ase_id');</script>";*/
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS 'asi_cod', A.esp_id AS 'esp_id', A.reg_id AS 'reg_id', A.mod_id AS 'mod_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', A.inf_id AS 'inf_id', C.nuc_id AS 'nuc_id', A.pac_id AS 'pac_id', A.ci AS 'ci', D.sec_id AS 'sec_id' FROM coo_asi_pac_inf A, infrae B, nucleo C, seccio D WHERE A.pac_id = '$this->pac_id' AND A.ci = '$this->ci' AND A.capi_sta = '1' AND B.inf_sta = '1' AND C.nuc_sta = '1' AND D.sec_sta='1' AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id AND D.inf_id=A.inf_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = '$this->pac_id' AND A.ase_sta = '1' AND B.sec_id=A.sec_id AND B.nuc_id='$nuc_id' AND B.inf_id='$inf_id' GROUP BY A.ase_id");
    $num_filas=$this->NumFilas();	/*echo "<script>alert('FILAS: $num_filas');</script>";*/
    return $num_filas;
  }
//******************************************************************
  function Contar_oferta_asigna($asi_nom){
    $num_filas='';
    $this->Operacion("SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS 'asi_cod', A.esp_id AS 'esp_id', A.reg_id AS 'reg_id', A.mod_id AS 'mod_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', A.inf_id AS 'inf_id', C.nuc_id AS 'nuc_id', A.pac_id AS 'pac_id', A.ci AS 'ci', E.sec_id AS 'sec_id' FROM coo_asi_pac_inf A, infrae B, nucleo C, asigna D, seccio E WHERE A.asi_cod = D.asi_cod AND A.esp_id = D.esp_id AND A.reg_id = D.reg_id AND A.mod_id = D.mod_id AND A.coh_id = D.coh_id AND A.pen_top = D.pen_top AND D.asi_nom LIKE ('%$asi_nom%') AND A.pac_id = '$this->pac_id' AND A.ci = '$this->ci' AND A.capi_sta = '1' AND B.inf_sta = '1' AND C.nuc_sta = '1' AND D.asi_sta='1' AND E.sec_sta='1' AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id AND E.inf_id=A.inf_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = '$this->pac_id' AND A.ase_sta = '1' AND B.sec_id=A.sec_id GROUP BY A.ase_id");
    $num_filas=$this->NumFilas();	/*echo "<script>alert('FILAS: $num_filas');</script>";*/
    return $num_filas;
  }
//******************************************************************
  function Contar_oferta_nucleo_asigna($asi_nom,$nuc_id){
    $num_filas='';
/*	echo "<script>alert('SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS asi_cod, A.esp_id AS esp_id, A.reg_id AS reg_id, A.mod_id AS mod_id, A.coh_id AS coh_id, A.pen_top AS pen_top, A.inf_id AS inf_id, C.nuc_id AS nuc_id, A.pac_id AS pac_id, A.ci AS ci FROM coo_asi_pac_inf A, infrae B, nucleo C WHERE A.pac_id = $this->pac_id AND A.ci = $this->ci AND A.capi_sta = 1 AND B.inf_sta = 1 AND C.nuc_sta = 1 AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = $this->pac_id AND A.ase_sta = 1 AND B.nuc_id=$nuc_id GROUP BY A.ase_id');</script>";*/
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS 'asi_cod', A.esp_id AS 'esp_id', A.reg_id AS 'reg_id', A.mod_id AS 'mod_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', A.inf_id AS 'inf_id', C.nuc_id AS 'nuc_id', A.pac_id AS 'pac_id', A.ci AS 'ci', E.sec_id AS 'sec_id' FROM coo_asi_pac_inf A, infrae B, nucleo C, asigna D, seccio E WHERE A.asi_cod = D.asi_cod AND A.esp_id = D.esp_id AND A.reg_id = D.reg_id AND A.mod_id = D.mod_id AND A.coh_id = D.coh_id AND A.pen_top = D.pen_top AND D.asi_nom LIKE ('%$asi_nom%') AND A.pac_id = '$this->pac_id' AND A.ci = '$this->ci' AND A.capi_sta = '1' AND B.inf_sta = '1' AND C.nuc_sta = '1' AND E.sec_sta='1' AND D.asi_sta='1' AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id AND E.inf_id=A.inf_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = '$this->pac_id' AND A.ase_sta = '1' AND B.sec_id=A.sec_id AND B.nuc_id='$nuc_id' GROUP BY A.ase_id");
    $num_filas=$this->NumFilas();	/*echo "<script>alert('FILAS: $num_filas');</script>";*/
    return $num_filas;
  }
//******************************************************************
  function Contar_oferta_nucleo_infrae_asigna($asi_nom,$nuc_id,$inf_id){
    $num_filas='';
/*	echo "<script>alert('SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS asi_cod, A.esp_id AS esp_id, A.reg_id AS reg_id, A.mod_id AS mod_id, A.coh_id AS coh_id, A.pen_top AS pen_top, A.inf_id AS inf_id, C.nuc_id AS nuc_id, A.pac_id AS pac_id, A.ci AS ci FROM coo_asi_pac_inf A, infrae B, nucleo C WHERE A.pac_id = $this->pac_id AND A.ci = $this->ci AND A.capi_sta = 1 AND B.inf_sta = 1 AND C.nuc_sta = 1 AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = $this->pac_id AND A.ase_sta = 1 AND B.nuc_id=$nuc_id AND B.inf_id=$inf_id GROUP BY A.ase_id');</script>";*/
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS 'asi_cod', A.esp_id AS 'esp_id', A.reg_id AS 'reg_id', A.mod_id AS 'mod_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', A.inf_id AS 'inf_id', C.nuc_id AS 'nuc_id', A.pac_id AS 'pac_id', A.ci AS 'ci', E.sec_id AS 'sec_id' FROM coo_asi_pac_inf A, infrae B, nucleo C, asigna D, seccio E WHERE A.asi_cod = D.asi_cod AND A.esp_id = D.esp_id AND A.reg_id = D.reg_id AND A.mod_id = D.mod_id AND A.coh_id = D.coh_id AND A.pen_top = D.pen_top AND D.asi_nom LIKE ('%$asi_nom%') AND A.pac_id = '$this->pac_id' AND A.ci = '$this->ci' AND A.capi_sta = '1' AND B.inf_sta = '1' AND C.nuc_sta = '1' AND D.asi_sta='1' AND E.sec_sta='1' AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id AND E.inf_id=A.inf_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = '$this->pac_id' AND A.ase_sta = '1' AND B.sec_id=A.sec_id AND B.nuc_id='$nuc_id' AND B.inf_id='$inf_id' GROUP BY A.ase_id");
    $num_filas=$this->NumFilas();	/*echo "<script>alert('FILAS: $num_filas');</script>";*/
    return $num_filas;
  }
//******************************************************************
  function Listado_oferta_asigna($asi_nom,$inicial,$cantidad){
/*    echo "<script>alert('SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS asi_cod, A.esp_id AS esp_id, A.reg_id AS reg_id, A.mod_id AS mod_id, A.coh_id AS coh_id, A.pen_top AS pen_top, A.inf_id AS inf_id, C.nuc_id AS nuc_id, A.pac_id AS pac_id, A.ci AS ci FROM coo_asi_pac_inf A, infrae B, nucleo C WHERE A.pac_id = $this->pac_id AND A.ci = $this->ci AND A.capi_sta = 1 AND B.inf_sta = 1 AND C.nuc_sta = 1 AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = $this->pac_id AND A.ase_sta = 1 GROUP BY A.ase_id LIMIT $cantidad OFFSET $inicial');</script>";*/
    $resultado=$this->Operacion("SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS 'asi_cod', A.esp_id AS 'esp_id', A.reg_id AS 'reg_id', A.mod_id AS 'mod_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', A.inf_id AS 'inf_id', C.nuc_id AS 'nuc_id', A.pac_id AS 'pac_id', A.ci AS 'ci', E.sec_id AS 'sec_id' FROM coo_asi_pac_inf A, infrae B, nucleo C, asigna D, seccio E WHERE A.asi_cod = D.asi_cod AND A.esp_id = D.esp_id AND A.reg_id = D.reg_id AND A.mod_id = D.mod_id AND A.coh_id = D.coh_id AND A.pen_top = D.pen_top AND D.asi_nom LIKE ('%$asi_nom%') AND A.pac_id = '$this->pac_id' AND A.ci = '$this->ci' AND A.capi_sta = '1' AND B.inf_sta = '1' AND C.nuc_sta = '1' AND D.asi_sta='1' AND E.sec_sta='1' AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id AND E.inf_id=A.inf_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = '$this->pac_id' AND A.ase_sta = '1' AND B.sec_id=A.sec_id GROUP BY A.ase_id LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_oferta_nucleo_asigna($asi_nom,$nuc_id,$inicial,$cantidad){
/*    echo "<script>alert('SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS asi_cod, A.esp_id AS esp_id, A.reg_id AS reg_id, A.mod_id AS mod_id, A.coh_id AS coh_id, A.pen_top AS pen_top, A.inf_id AS inf_id, C.nuc_id AS nuc_id, A.pac_id AS pac_id, A.ci AS ci FROM coo_asi_pac_inf A, infrae B, nucleo C WHERE A.pac_id = $this->pac_id AND A.ci = $this->ci AND A.capi_sta = 1 AND B.inf_sta = 1 AND C.nuc_sta = 1 AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = $this->pac_id AND A.ase_sta = 1 AND B.nuc_id=$nuc_id GROUP BY A.ase_id LIMIT $cantidad OFFSET $inicial');</script>";*/
    $resultado=$this->Operacion("SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS 'asi_cod', A.esp_id AS 'esp_id', A.reg_id AS 'reg_id', A.mod_id AS 'mod_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', A.inf_id AS 'inf_id', C.nuc_id AS 'nuc_id', A.pac_id AS 'pac_id', A.ci AS 'ci', E.sec_id AS 'sec_id' FROM coo_asi_pac_inf A, infrae B, nucleo C, asigna D, seccio E WHERE A.asi_cod = D.asi_cod AND A.esp_id = D.esp_id AND A.reg_id = D.reg_id AND A.mod_id = D.mod_id AND A.coh_id = D.coh_id AND A.pen_top = D.pen_top AND D.asi_nom LIKE ('%$asi_nom%') AND A.pac_id = '$this->pac_id' AND A.ci = '$this->ci' AND A.capi_sta = '1' AND B.inf_sta = '1' AND C.nuc_sta = '1' AND D.asi_sta='1' AND E.sec_sta='1' AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id AND E.inf_id=A.inf_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = '$this->pac_id' AND A.ase_sta = '1' AND B.sec_id=A.sec_id AND B.nuc_id='$nuc_id' GROUP BY A.ase_id LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_oferta_nucleo_infrae_asigna($asi_nom,$nuc_id,$inf_id,$inicial,$cantidad){
/*  echo "<script>alert('SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS asi_cod, A.esp_id AS esp_id, A.reg_id AS reg_id, A.mod_id AS mod_id, A.coh_id AS coh_id, A.pen_top AS pen_top, A.inf_id AS inf_id, C.nuc_id AS nuc_id, A.pac_id AS pac_id, A.ci AS ci FROM coo_asi_pac_inf A, infrae B, nucleo C WHERE A.pac_id = $this->pac_id AND A.ci = $this->ci AND A.capi_sta = 1 AND B.inf_sta = 1 AND C.nuc_sta = 1 AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = $this->pac_id AND A.ase_sta = 1 AND B.nuc_id=$nuc_id AND B.inf_id=$inf_id GROUP BY A.ase_id LIMIT $cantidad OFFSET $inicial');</script>";*/
    $resultado=$this->Operacion("SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS 'asi_cod', A.esp_id AS 'esp_id', A.reg_id AS 'reg_id', A.mod_id AS 'mod_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', A.inf_id AS 'inf_id', C.nuc_id AS 'nuc_id', A.pac_id AS 'pac_id', A.ci AS 'ci', E.sec_id AS 'sec_id' FROM coo_asi_pac_inf A, infrae B, nucleo C, asigna D, seccio E WHERE A.asi_cod = D.asi_cod AND A.esp_id = D.esp_id AND A.reg_id = D.reg_id AND A.mod_id = D.mod_id AND A.coh_id = D.coh_id AND A.pen_top = D.pen_top AND D.asi_nom LIKE ('%$asi_nom%') AND A.pac_id = '$this->pac_id' AND A.ci = '$this->ci' AND A.capi_sta = '1' AND B.inf_sta = '1' AND C.nuc_sta = '1' AND D.asi_sta='1' AND E.sec_sta='1' AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id AND E.inf_id=A.inf_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = '$this->pac_id' AND A.ase_sta = '1' AND B.sec_id=A.sec_id AND B.nuc_id='$nuc_id' AND B.inf_id='$inf_id' GROUP BY A.ase_id LIMIT $cantidad OFFSET $inicial");
    return $resultado;
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
  function Buscar_coordinador($ci){
/*      echo "<script>alert('SELECT concat(A.ap1, ,A.ap2, ,A.no1, ,A.no2) AS nombre, B.usu_cor AS correo, A.tmo AS telf FROM persona A, usuari B WHERE A.ci=B.ci AND A.ci=$ci AND A.sta=1');</script>";*/
    $res=$this->Operacion("SELECT concat(A.ap1,' ',A.ap2,' ',A.no1,' ',A.no2) AS 'nombre', B.usu_cor AS 'correo', A.tmo AS 'telf' FROM persona A, usuari B WHERE A.ci=B.ci AND A.ci='$ci' AND A.sta='1'");
	$array=$this->ConsultarCualquiera($res);
	return $array;
  }

//******************************************************************
function Buscar_coordi_matricula(){
    $resp=$this->OperacionCualquiera("SELECT DISTINCT(D.coh_nom) AS 'coh_nom', B.reg_nom AS 'reg_nom', C.esp_nom AS 'esp_nom', A.mod_nom AS 'mod_nom', F.inf_nom AS 'inf_nom' FROM matric E, modali A, regimen B, especi C, cohort D, infrae F WHERE E.ci='$this->ci' AND E.matr_tip!='0' AND E.matr_sta='1' AND E.mod_id=A.mod_id AND E.reg_id=B.reg_id AND E.esp_id=C.esp_id AND E.coh_id=D.coh_id AND F.inf_id IN (SELECT inf_id FROM estudi_infrae WHERE ci= '$this->ci'
AND est_inf_ffi= '0000-00-00 00:00:00') ORDER BY F.inf_nom,A.mod_nom,B.reg_nom,C.esp_nom,D.coh_nom");
	return $resp;
}
//******************************************************************
  function Listado_oferta($inicial,$cantidad){
/*    echo "<script>alert('SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS asi_cod, A.esp_id AS esp_id, A.reg_id AS reg_id, A.mod_id AS mod_id, A.coh_id AS coh_id, A.pen_top AS pen_top, A.inf_id AS inf_id, C.nuc_id AS nuc_id, A.pac_id AS pac_id, A.ci AS ci FROM coo_asi_pac_inf A, infrae B, nucleo C WHERE A.pac_id = $this->pac_id AND A.ci = $this->ci AND A.capi_sta = 1 AND B.inf_sta = 1 AND C.nuc_sta = 1 AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = $this->pac_id AND A.ase_sta = 1 GROUP BY A.ase_id LIMIT $cantidad OFFSET $inicial');</script>";*/
    $resultado=$this->Operacion("SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS 'asi_cod', A.esp_id AS 'esp_id', A.reg_id AS 'reg_id', A.mod_id AS 'mod_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', A.inf_id AS 'inf_id', C.nuc_id AS 'nuc_id', A.pac_id AS 'pac_id', A.ci AS 'ci', D.sec_id AS 'sec_id' FROM coo_asi_pac_inf A, infrae B, nucleo C, seccio D WHERE A.pac_id = '$this->pac_id' AND A.ci = '$this->ci' AND A.capi_sta = '1' AND B.inf_sta = '1' AND C.nuc_sta = '1' AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id AND D.inf_id=A.inf_id AND D.sec_sta='1') AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = '$this->pac_id' AND A.ase_sta = '1' AND B.sec_id=A.sec_id GROUP BY A.ase_id LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_oferta_nucleo($nuc_id,$inicial,$cantidad){
/*    echo "<script>alert('SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS asi_cod, A.esp_id AS esp_id, A.reg_id AS reg_id, A.mod_id AS mod_id, A.coh_id AS coh_id, A.pen_top AS pen_top, A.inf_id AS inf_id, C.nuc_id AS nuc_id, A.pac_id AS pac_id, A.ci AS ci FROM coo_asi_pac_inf A, infrae B, nucleo C WHERE A.pac_id = $this->pac_id AND A.ci = $this->ci AND A.capi_sta = 1 AND B.inf_sta = 1 AND C.nuc_sta = 1 AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = $this->pac_id AND A.ase_sta = 1 AND B.nuc_id=$nuc_id GROUP BY A.ase_id LIMIT $cantidad OFFSET $inicial');</script>";*/
    $resultado=$this->Operacion("SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS 'asi_cod', A.esp_id AS 'esp_id', A.reg_id AS 'reg_id', A.mod_id AS 'mod_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', A.inf_id AS 'inf_id', C.nuc_id AS 'nuc_id', A.pac_id AS 'pac_id', A.ci AS 'ci', D.sec_id AS 'sec_id' FROM coo_asi_pac_inf A, infrae B, nucleo C, seccio D WHERE A.pac_id = '$this->pac_id' AND A.ci = '$this->ci' AND A.capi_sta = '1' AND B.inf_sta = '1' AND C.nuc_sta = '1' AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id AND D.inf_id=A.inf_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = '$this->pac_id' AND A.ase_sta = '1' AND B.sec_id=A.sec_id AND B.nuc_id='$nuc_id' GROUP BY A.ase_id LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_oferta_nucleo_infrae($nuc_id,$inf_id,$inicial,$cantidad){
/*  echo "<script>alert('SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS asi_cod, A.esp_id AS esp_id, A.reg_id AS reg_id, A.mod_id AS mod_id, A.coh_id AS coh_id, A.pen_top AS pen_top, A.inf_id AS inf_id, C.nuc_id AS nuc_id, A.pac_id AS pac_id, A.ci AS ci FROM coo_asi_pac_inf A, infrae B, nucleo C WHERE A.pac_id = $this->pac_id AND A.ci = $this->ci AND A.capi_sta = 1 AND B.inf_sta = 1 AND C.nuc_sta = 1 AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = $this->pac_id AND A.ase_sta = 1 AND B.nuc_id=$nuc_id AND B.inf_id=$inf_id GROUP BY A.ase_id LIMIT $cantidad OFFSET $inicial');</script>";*/
    $resultado=$this->Operacion("SELECT A.ase_id, A.asi_cod FROM asigna_seccio AS A RIGHT JOIN (SELECT A.asi_cod AS 'asi_cod', A.esp_id AS 'esp_id', A.reg_id AS 'reg_id', A.mod_id AS 'mod_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', A.inf_id AS 'inf_id', C.nuc_id AS 'nuc_id', A.pac_id AS 'pac_id', A.ci AS 'ci', D.sec_id AS 'sec_id' FROM coo_asi_pac_inf A, infrae B, nucleo C, seccio D WHERE A.pac_id = '$this->pac_id' AND A.ci = '$this->ci' AND A.capi_sta = '1' AND B.inf_sta = '1' AND C.nuc_sta = '1' AND A.inf_id = B.inf_id AND B.nuc_id = C.nuc_id AND D.inf_id=A.inf_id) AS B ON A.asi_cod = B.asi_cod AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.mod_id = B.mod_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.pac_id = B.pac_id WHERE A.pac_id = '$this->pac_id' AND A.ase_sta = '1' AND B.sec_id=A.sec_id AND B.nuc_id='$nuc_id' AND B.inf_id='$inf_id' GROUP BY A.ase_id LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Nucleo(){
    $resultado=$this->Operacion("SELECT DISTINCT (A.nuc_id) AS 'nuc_id', A.nuc_nom AS 'nuc_nom' FROM nucleo A, infrae B WHERE A.nuc_sta = '1' AND A.nuc_id = B.nuc_id AND B.inf_id IN (SELECT DISTINCT(C.inf_id) FROM estudi_infrae C, reg_esp_mod_infrae D, reg_esp_mod E, matric G WHERE C.inf_id = D.inf_id AND C.est_inf_ffi = '0000-00-00 00:00:00' AND D.mod_id = E.mod_id AND D.esp_id = E.esp_id AND D.reg_id = E.reg_id AND D.remi_sta = '1' AND E.rem_sta = '1' AND G.mod_id = E.mod_id AND G.esp_id = E.esp_id AND G.reg_id =E.reg_id AND G.matr_tip = '1' AND G.matr_sta = '1' AND C.ci = '$this->ci') order by A.nuc_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Infrae($nuc_id){
    $resultado=$this->OperacionCualquiera("SELECT B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom' FROM nucleo A, infrae B WHERE A.nuc_sta = '1' AND A.nuc_id = B.nuc_id AND B.inf_id IN (SELECT C.inf_id FROM estudi_infrae C, reg_esp_mod_infrae D, reg_esp_mod E, matric G WHERE C.inf_id = D.inf_id AND C.est_inf_ffi = '0000-00-00 00:00:00' AND D.mod_id = E.mod_id AND D.esp_id = E.esp_id AND D.reg_id = E.reg_id AND D.remi_sta = '1' AND E.rem_sta = '1' AND G.mod_id = E.mod_id AND G.esp_id = E.esp_id AND G.reg_id =E.reg_id AND G.matr_tip = '1' AND G.matr_sta = '1' AND C.ci = '$this->ci') AND A.nuc_id='$nuc_id' order by A.nuc_nom,B.inf_nom DESC");
	return $resultado;
  }
//******************************************************************
  function Listado_Infraestructura_Nucleo($nuc_id){
    $id=$nom="";
    $cuantos=0;
	$this->ci=$_SESSION['ci'];
    $resp=$this->OperacionCualquiera("SELECT B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom' FROM nucleo A, infrae B WHERE A.nuc_sta = '1' AND A.nuc_id = B.nuc_id AND B.inf_id IN (SELECT C.inf_id FROM estudi_infrae C, reg_esp_mod_infrae D, reg_esp_mod E, matric G WHERE C.inf_id = D.inf_id AND C.est_inf_ffi = '0000-00-00 00:00:00' AND D.mod_id = E.mod_id AND D.esp_id = E.esp_id AND D.reg_id = E.reg_id AND D.remi_sta = '1' AND E.rem_sta = '1' AND G.mod_id = E.mod_id AND G.esp_id = E.esp_id AND G.reg_id =E.reg_id AND G.matr_tip = '1' AND G.matr_sta = '1' AND C.ci = '$this->ci') AND A.nuc_id='$nuc_id' order by A.nuc_nom,B.inf_nom DESC");
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
  function Buscar_estudiante_oferta_todas($lista,$lista2){
/*      echo "<script>alert('SELECT B.ci AS ci_est, B.ap1 AS ap1, B.ap2 AS ap2, B.ap3 AS ap3, B.no1 AS no1, B.no2 AS no2, B.no3  AS no3 FROM persona B, usuari A WHERE A.ci=B.ci AND A.usu_sta=1 AND B.sta=1 AND A.ci IN ($lista2) ORDER BY B.ap1, B.ap2, B.ap3, B.no1, B.no2, B.no3, B.ci');</script>";*/
	  $res=$this->Operacion("SELECT B.ci AS 'ci_est', UPPER(B.ap1) AS 'ap1', UPPER(B.ap2) AS 'ap2', UPPER(B.ap3) AS 'ap3', UPPER(B.no1) AS 'no1', UPPER(B.no2) AS 'no2', UPPER(B.no3)  AS 'no3', UPPER(B.tmo) AS 'tmo', UPPER(A.usu_cor) as 'usu_cor' FROM persona B, usuari A WHERE A.ci=B.ci AND A.usu_sta='1' AND B.sta='1' AND A.ci IN ($lista) ORDER BY B.ap1, B.ap2, B.ap3, B.no1, B.no2, B.no3, B.ci");
	return $res;
  }
//******************************************************************
  function Buscar_oferta_todas($ase_id){
/*      echo "<script>alert('SELECT C.nuc_nom AS nuc_nom, D.inf_nom AS inf_nom, CONCAT(B.asi_cod, ,B.asi_nom) AS asigna, E.sec_nom AS sec_nom, F.mod_nom AS mod_nom, I.coh_nom AS coh_nom, G.esp_nom AS esp_nom, H.reg_nom AS reg_nom, J.ele_nom AS ele_nom FROM asigna_seccio A, asigna B, nucleo C, infrae D, seccio E, modali F, especi G, regimen H, cohort I, electi J WHERE A.ase_id=$ase_id AND A.ele_cod=J.ele_cod AND A.mod_id=B.mod_id AND B.mod_id=F.mod_id AND A.esp_id=B.esp_id AND B.esp_id=G.esp_id AND A.reg_id=B.reg_id AND B.reg_id=H.reg_id AND A.coh_id=B.coh_id AND B.coh_id=I.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=E.sec_id AND E.inf_id=D.inf_id AND D.nuc_id=C.nuc_id AND A.ase_sta=1 AND B.asi_sta=1 AND C.nuc_sta=1 AND D.inf_sta=1 AND E.sec_sta=1 AND F.mod_sta=1 AND G.esp_sta=1 AND H.reg_sta=1 AND I.coh_sta=1 GROUP BY C.nuc_id,D.inf_id,A.mod_id,A.esp_id,A.reg_id,A.coh_id,A.asi_cod,B.asi_nom,A.sec_id');</script>";*/
/*    $res=$this->Operacion("SELECT C.nuc_nom AS 'nuc_nom', D.inf_nom AS 'inf_nom', CONCAT(B.asi_cod,' ',B.asi_nom) AS 'asigna', E.sec_nom AS 'sec_nom', F.mod_nom AS 'mod_nom', I.coh_nom AS 'coh_nom', G.esp_nom AS 'esp_nom', H.reg_nom AS 'reg_nom', J.ele_nom AS 'ele_nom' FROM asigna_seccio A, asigna B, nucleo C, infrae D, seccio E, modali F, especi G, regimen H, cohort I, electi J WHERE A.ase_id='$ase_id' AND A.ele_cod=J.ele_cod AND A.mod_id=B.mod_id AND B.mod_id=F.mod_id AND A.esp_id=B.esp_id AND B.esp_id=G.esp_id AND A.reg_id=B.reg_id AND B.reg_id=H.reg_id AND A.coh_id=B.coh_id AND B.coh_id=I.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=E.sec_id AND E.inf_id=D.inf_id AND D.nuc_id=C.nuc_id AND A.ase_sta='1' AND B.asi_sta='1' AND C.nuc_sta='1' AND D.inf_sta='1' AND E.sec_sta='1' AND F.mod_sta='1' AND G.esp_sta='1' AND H.reg_sta='1' AND I.coh_sta='1' GROUP BY C.nuc_id,D.inf_id,A.mod_id,A.esp_id,A.reg_id,A.coh_id,A.asi_cod,B.asi_nom,A.sec_id");*/
	  $res=$this->Operacion("SELECT A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom', B.nuc_nom AS 'nuc_nom', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', CONCAT(A.asi_cod,' ',A.asi_nom) AS 'asigna', B.sec_id AS 'sec_id', B.sec_nom AS 'sec_nom', B.mod_id AS 'mod_id', B.mod_nom AS 'mod_nom', B.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', B.esp_id AS 'esp_id', B.esp_nom AS 'esp_nom', B.reg_id AS 'reg_id', B.reg_nom AS 'reg_nom', B.ele_cod AS 'ele_cod', B.ele_nom AS 'ele_nom', B.ase_tev AS 'ase_tev', B.ase_pte AS 'ase_pte', B.ase_pla AS 'ase_pla', B.ase_cma AS 'ase_cma', B.ci_doc1 AS 'ci_doc1', B.ci_doc2 AS 'ci_doc2' FROM asigna AS A RIGHT JOIN(SELECT B.mod_id AS 'mod_id',F.mod_nom AS 'mod_nom', B.esp_id AS 'esp_id', G.esp_nom AS 'esp_nom', B.reg_id AS 'reg_id', H.reg_nom AS 'reg_nom', B.coh_id AS 'coh_id', I.coh_nom AS 'coh_nom', B.pen_top AS 'pen_top', B.asi_cod AS 'asi_cod', B.sec_id AS 'sec_id', E.sec_nom AS 'sec_nom', B.ase_id AS 'ase_id', C.nuc_nom AS 'nuc_nom', C.nuc_id AS 'nuc_id', D.inf_nom AS 'inf_nom', D.inf_id AS 'inf_id', J.ele_cod AS 'ele_cod', J.ele_nom AS 'ele_nom', B.ase_tev AS 'ase_tev', B.ase_pte AS 'ase_pte', B.ase_pla AS 'ase_pla', B.ase_cma AS 'ase_cma', B.ci_emp AS 'ci_doc1', B.ci_doc_pol AS 'ci_doc2' FROM asigna_seccio B, nucleo C, infrae D, seccio E, modali F, especi G, regimen H, cohort I, electi J WHERE B.ele_cod=J.ele_cod AND B.mod_id=F.mod_id AND B.esp_id=G.esp_id AND B.reg_id=H.reg_id AND B.coh_id=I.coh_id AND B.sec_id=E.sec_id AND E.inf_id=D.inf_id AND D.nuc_id=C.nuc_id AND B.ase_sta='1' AND C.nuc_sta='1' AND D.inf_sta='1' AND E.sec_sta='1' AND F.mod_sta='1' AND G.esp_sta='1' AND H.reg_sta='1' AND I.coh_sta='1' AND B.ase_id='$ase_id') AS B ON A.mod_id=B.mod_id AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod WHERE A.asi_sta='1' GROUP BY B.nuc_id,B.inf_id,A.mod_id,A.esp_id,A.reg_id,A.coh_id,A.asi_cod,A.asi_nom,B.sec_id");
	return $res;
  }
//******************************************************************
  function Listado_asignatura_todas(){
    $resultado=$this->Operacion("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D WHERE A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND B.ci='$this->ci' AND B.pac_id='$this->pac_id' GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom ORDER BY A.asi_nom,A.asi_cod,D.nuc_nom,C.inf_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_asignatura_nucleo($nuc_id){
    $resultado=$this->Operacion("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D WHERE A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND D.nuc_id='$nuc_id' AND B.ci='$this->ci' AND B.pac_id='$this->pac_id' GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom ORDER BY A.asi_nom,A.asi_cod,D.nuc_nom,C.inf_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_asignatura_nucleo_infrae($nuc_id,$inf_id){
    $resultado=$this->Operacion("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D WHERE A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND D.nuc_id='$nuc_id' AND C.inf_id='$inf_id' AND B.ci='$this->ci' AND B.pac_id='$this->pac_id' GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom ORDER BY A.asi_nom,A.asi_cod,D.nuc_nom,C.inf_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_asignatura_todas1($asi_nom){
    $resultado=$this->Operacion("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D WHERE A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND A.asi_nom LIKE ('%$asi_nom%') AND B.ci='$this->ci' AND B.pac_id='$this->pac_id' GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom ORDER BY A.asi_nom,A.asi_cod,D.nuc_nom,C.inf_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_asignatura_nucleo1($asi_nom,$nuc_id){
    $resultado=$this->Operacion("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D WHERE A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND D.nuc_id='$nuc_id' AND A.asi_nom LIKE ('%$asi_nom%') AND B.ci='$this->ci' AND B.pac_id='$this->pac_id' GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom ORDER BY A.asi_nom,A.asi_cod,D.nuc_nom,C.inf_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_asignatura_nucleo_infrae1($asi_nom,$nuc_id,$inf_id){
    $resultado=$this->Operacion("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D WHERE A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND D.nuc_id='$nuc_id' AND C.inf_id='$inf_id' AND A.asi_nom LIKE ('%$asi_nom%') AND B.ci='$this->ci' AND B.pac_id='$this->pac_id' GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom ORDER BY A.asi_nom,A.asi_cod,D.nuc_nom,C.inf_nom");
    return $resultado;
  }
//******************************************************************
  function Buscar_asigna($inf_id,$asi_cod,$asi_nom){
    $respuesta=$this->OperacionCualquiera("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D WHERE A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND C.inf_id='$inf_id' AND A.asi_nom LIKE ('$asi_nom') AND A.asi_cod='$asi_cod' AND B.ci='$this->ci' AND B.pac_id='$this->pac_id' GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom");
	
	echo "<script>alert('SELECT D.nuc_id AS nuc_id, D.nuc_nom AS nuc_nom, C.inf_id AS inf_id, C.inf_nom AS inf_nom, A.asi_cod AS asi_cod,A.asi_nom AS asi_nom FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D WHERE A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND A.asi_sta=1 AND B.capi_sta=1 AND C.inf_sta=1 AND D.nuc_sta=1 AND C.inf_id=$inf_id AND A.asi_nom LIKE ($asi_nom) AND A.asi_cod=$asi_cod AND B.ci=$this->ci AND B.pac_id=$this->pac_id GROUP BY D.nuc_id,C.inf_id,A.asi_cod,A.asi_nom');</script>";
	
	$array=$this->ConsultarCualquiera($respuesta);
    return $array;
  }
//******************************************************************
  function Buscar_asigna_pensum($inf_id,$asi_cod,$asi_nom){
    $respuesta=$this->OperacionCualquiera("SELECT D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom', A.mod_id AS 'mod_id', E.mod_nom AS 'mod_nom', A.esp_id AS 'esp_id', F.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', G.reg_nom AS 'reg_nom', A.coh_id AS 'coh_id', H.coh_nom AS 'coh_nom' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D, modali E, especi F, regimen G, cohort H WHERE A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND B.mod_id=E.mod_id AND A.esp_id=B.esp_id AND B.esp_id=F.esp_id AND A.reg_id=B.reg_id AND B.reg_id=G.reg_id AND A.coh_id=B.coh_id AND B.coh_id=H.coh_id AND A.pen_top=B.pen_top AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND C.inf_id='$inf_id' AND A.asi_nom LIKE ('$asi_nom') AND A.asi_cod='$asi_cod' AND B.ci='$this->ci' AND B.pac_id='$this->pac_id' GROUP BY D.nuc_id,C.inf_id,A.mod_id,A.esp_id,A.reg_id,A.coh_id,A.asi_cod,A.asi_nom");
    return $respuesta;
  }
//******************************************************************
  function Buscar_asigna_pensum1($inf_id,$asi_cod,$asi_nom,$mod_id,$esp_id,$reg_id,$coh_id){
/*  echo "<script>alert('SELECT I.tip_nom AS tip_nom, A.asi_lab AS asi_lab, A.asi_cht AS asi_cht, A.asi_chp AS asi_chp A.asi_chl AS asi_chl, D.nuc_id AS nuc_id, D.nuc_nom AS nuc_nom, C.inf_id AS inf_id, C.inf_nom AS inf_nom, A.asi_cod AS asi_cod, A.asi_nom AS asi_nom, A.mod_id AS mod_id, E.mod_nom AS mod_nom, A.esp_id AS esp_id, F.esp_nom AS esp_nom, A.reg_id AS reg_id, G.reg_nom AS reg_nom, A.coh_id AS coh_id, H.coh_nom AS coh_nom FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D, modali E, especi F, regimen G, cohort H, tipoma I WHERE A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND B.mod_id=E.mod_id AND A.esp_id=B.esp_id AND B.esp_id=F.esp_id AND A.reg_id=B.reg_id AND B.reg_id=G.reg_id AND A.coh_id=B.coh_id AND B.coh_id=H.coh_id AND A.pen_top=B.pen_top AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND A.tip_id=I.tip_id AND I.tip_sta=1 AND A.asi_sta=1 AND B.capi_sta=1 AND C.inf_sta=1 AND D.nuc_sta=1 AND C.inf_id=$inf_id AND A.asi_nom LIKE ($asi_nom) AND A.asi_cod=$asi_cod AND A.mod_id=$mod_id AND A.esp_id=$esp_id AND A.reg_id=$reg_id AND A.coh_id=$coh_id GROUP BY D.nuc_id,C.inf_id,A.mod_id,A.esp_id,A.reg_id,A.coh_id,A.asi_cod,A.asi_nom');</script>";*/
    $respuesta=$this->OperacionCualquiera("SELECT I.tip_nom AS 'tip_nom', A.asi_lab AS 'asi_lab', A.asi_cht AS 'asi_cht', A.asi_chp AS 'asi_chp', A.asi_chl AS 'asi_chl', D.nuc_id AS 'nuc_id', D.nuc_nom AS 'nuc_nom', C.inf_id AS 'inf_id', C.inf_nom AS 'inf_nom', A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom', A.mod_id AS 'mod_id', E.mod_nom AS 'mod_nom', A.esp_id AS 'esp_id', F.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', G.reg_nom AS 'reg_nom', A.coh_id AS 'coh_id', H.coh_nom AS 'coh_nom', I.tip_oma AS 'tip_oma' FROM asigna AS A, coo_asi_pac_inf B, infrae C, nucleo D, modali E, especi F, regimen G, cohort H, tipoma I WHERE A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND B.mod_id=E.mod_id AND A.esp_id=B.esp_id AND B.esp_id=F.esp_id AND A.reg_id=B.reg_id AND B.reg_id=G.reg_id AND A.coh_id=B.coh_id AND B.coh_id=H.coh_id AND A.pen_top=B.pen_top AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND A.tip_id=I.tip_id AND I.tip_sta='1' AND A.asi_sta='1' AND B.capi_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND C.inf_id='$inf_id' AND A.asi_nom LIKE ('$asi_nom') AND A.asi_cod='$asi_cod' AND A.mod_id='$mod_id' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.coh_id='$coh_id' AND B.ci='$this->ci' AND B.pac_id='$this->pac_id' GROUP BY D.nuc_id,C.inf_id,A.mod_id,A.esp_id,A.reg_id,A.coh_id,A.asi_cod,A.asi_nom");
	$array=$this->ConsultarCualquiera($respuesta);
    return $array;
  }
//******************************************************************
  function Buscar_asigna_pensum2($asi_cod,$asi_nom,$mod_id,$esp_id,$reg_id,$coh_id){
/*  echo "<script>alert('SELECT pen_top FROM asigna WHERE asi_nom LIKE ($asi_nom) AND asi_cod=$asi_cod AND mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND coh_id=$coh_id AND asi_sta=1');</script>";*/
    $respuesta=$this->OperacionCualquiera("SELECT pen_top FROM asigna WHERE asi_nom LIKE ('$asi_nom') AND asi_cod='$asi_cod' AND mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND coh_id='$coh_id' AND asi_sta='1' GROUP BY pen_top");
    return $respuesta;
  }
//******************************************************************
  function Listado_complementaria_pensum(){
/*    echo "<script>alert('SELECT A.ele_cod AS ele_cod, B.ele_nom AS ele_nom FROM electi_pensum A, electi B WHERE A.elp_sta=1 AND A.mod_id IN ($mod_id) AND A.esp_id IN ($esp_id) AND A.reg_id IN ($reg_id) AND A.coh_id IN ($coh_id) AND A.ele_cod=B.ele_cod GROUP BY A.ele_cod ORDER BY B.ele_nom');</script>";*/
    $res=$this->OperacionCualquiera("SELECT * FROM deport WHERE dep_sta='1' ORDER BY dep_nom");
    return $res;
  }
//******************************************************************
  function Listado_electi_pensum($mod_id,$esp_id,$reg_id,$coh_id){
/*    echo "<script>alert('SELECT A.ele_cod AS ele_cod, B.ele_nom AS ele_nom FROM electi_pensum A, electi B WHERE A.elp_sta=1 AND A.mod_id IN ($mod_id) AND A.esp_id IN ($esp_id) AND A.reg_id IN ($reg_id) AND A.coh_id IN ($coh_id) AND A.ele_cod=B.ele_cod GROUP BY A.ele_cod ORDER BY B.ele_nom');</script>";*/
    $res=$this->OperacionCualquiera("SELECT A.ele_cod AS 'ele_cod', B.ele_nom AS 'ele_nom' FROM electi_pensum A, electi B WHERE A.elp_sta='1' AND A.mod_id IN ('$mod_id') AND A.esp_id IN ('$esp_id') AND A.reg_id IN ('$reg_id') AND A.coh_id IN ('$coh_id') AND A.ele_cod=B.ele_cod GROUP BY A.ele_cod ORDER BY B.ele_nom");
    return $res;
  }
//******************************************************************
  function Listado_electi_pensum1($ele_cod,$ele_cod_prob){
/*    echo "<script>alert('SELECT ele_cod, ele_nom FROM electi WHERE ele_cod IN ($ele_cod_prob) GROUP BY ele_cod ORDER BY ele_nom');</script>";*/
    $res=$this->OperacionCualquiera("SELECT ele_cod, ele_nom FROM electi WHERE ele_cod IN ($ele_cod) GROUP BY ele_cod ORDER BY ele_nom");
    return $res;
  }
//******************************************************************
  function Buscar_asigna_seccion($asi_cod,$mod_id,$esp_id,$reg_id,$coh_id,$inf_id){ 
/*  echo "<script>alert('SELECT A.sec_id FROM asigna_seccio A, seccio B, infrae C WHERE A.mod_id IN ($mod_id) AND A.reg_id IN ($reg_id) AND A.esp_id IN ($esp_id) AND A.coh_id IN ($coh_id) AND A.asi_cod IN ($asi_cod) AND A.pac_id=$this->pac_id AND C.inf_id IN ($inf_id)  AND A.ase_sta=1 AND A.sec_id=B.sec_id AND B.inf_id=C.inf_id AND B.sec_sta=1 AND C.inf_sta=1 GROUP BY A.sec_id GROUP BY sec_id');</script>";*/
    $res=$this->OperacionCualquiera("SELECT A.sec_id FROM asigna_seccio A, seccio B, infrae C WHERE A.mod_id IN ('$mod_id') AND A.reg_id IN ('$reg_id') AND A.esp_id IN ('$esp_id') AND A.coh_id IN ('$coh_id') AND A.asi_cod IN ('$asi_cod') AND A.pac_id='$this->pac_id' AND C.inf_id IN ('$inf_id') AND A.ase_sta='1' AND A.sec_id=B.sec_id AND B.inf_id=C.inf_id AND B.sec_sta='1' AND C.inf_sta='1' GROUP BY A.sec_id");
	return $res;
  }
//******************************************************************
  function Buscar_asigna_seccio_insertada($asi_cod,$mod_id,$esp_id,$reg_id,$coh_id,$pen_top,$sec_id,$ele_cod){
    $res=$this->OperacionCualquiera("SELECT sec_id FROM asigna_seccio WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND asi_cod='$asi_cod' AND pac_id='$this->pac_id' AND sec_id='$sec_id' AND ele_cod='$ele_cod'");
    $num_filas=$this->NumFilasCualquiera($res);	
/*	if($asi_cod=='ADG-34224' || $asi_cod=='ADG-34223') echo "<script>alert('FILAS: $num_filas');</script>";*/
    return $num_filas;
  }
//******************************************************************
  function Listado_seccion($inf_id,$sec_id,$lis_sec_prob){ 
    if($sec_id!=""){ 
/*  echo "<script>alert('SELECT C.sec_id AS sec_id, C.sec_nom AS sec_nom, B.inf_id AS inf_id, B.inf_nom AS inf_nom FROM infrae B, seccio C WHERE B.inf_id=$inf_id AND B.inf_id=C.inf_id AND B.inf_sta=1 AND C.sec_sta=1 AND C.sec_id NOT IN ($lis_sec_prob) ORDER BY B.inf_nom,C.sec_nom');</script>";*/
    $res=$this->OperacionCualquiera("SELECT C.sec_id AS 'sec_id', C.sec_nom AS 'sec_nom', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom' FROM infrae B, seccio C WHERE B.inf_id='$inf_id' AND B.inf_id=C.inf_id AND B.inf_sta='1' AND C.sec_sta='1' AND C.sec_id NOT IN ($sec_id) ORDER BY B.inf_nom,C.sec_nom");
	}
	else{ 
/*  echo "<script>alert('SELECT C.sec_id AS sec_id, C.sec_nom AS sec_nom, B.inf_id AS inf_id, B.inf_nom AS inf_nom FROM infrae B, seccio C WHERE B.inf_id=C.inf_id AND B.inf_sta=1 AND C.sec_sta=1 ORDER BY B.inf_nom,C.sec_nom');</script>";*/
    $res=$this->OperacionCualquiera("SELECT C.sec_id AS 'sec_id', C.sec_nom AS 'sec_nom', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom' FROM infrae B, seccio C WHERE B.inf_id='$inf_id' AND B.inf_id=C.inf_id AND B.inf_sta='1' AND C.sec_sta='1' ORDER BY B.inf_nom,C.sec_nom");	
	}
	return $res;
  }
//******************************************************************
  function Listado_Inscritos($asi_cod,$mod_id,$esp_id,$reg_id,$coh_id,$sec_id){ 
/*  echo "<script>alert('SELECT COUNT(*) AS cant_ins FROM detins WHERE mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND coh_id=$coh_id AND asi_cod=$asi_cod AND sec_id=$sec_id AND det_sta=1 AND pac_id=$this->pac_id GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id');</script>";*/
    $res=$this->OperacionCualquiera("SELECT ci_est, esp_id, coh_id FROM detins WHERE mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND coh_id='$coh_id' AND asi_cod='$asi_cod' AND sec_id='$sec_id' AND det_sta='1' AND pac_id='$this->pac_id'");
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