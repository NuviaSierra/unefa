<?php session_start();
class expediente extends conec_BD
{
    var $exp_id='';
    var $min_id='';
    var $ci_emp='';
    var $ci_est='';
    var $exp_pdp='';
    var $exp_pcd='';
    var $exp_ftc='';
    var $exp_pic='';
	var $exp_fcp='';
    var $exp_fcc='';
	var $exp_fod='';
    var $exp_ocs='';
    var $exp_fnt='';
	var $exp_nc9='';
	var $exp_nc5='';
	var $exp_pna='';
    var $exp_ide='';
    var $exp_fen='';
    var $exp_ubi='';
    var $exp_sta='';
    var $exp_rus='';
	var $exp_fre='';
	var $exp_mre='';
	var $exp_nre='';
	var $exp_obs='';
	var $res='';
	var $resp='';
	var $exp_ccm='';
//******************************************************************
//$_POST[mod_id],$_POST[reg_id],$_POST[esp_id],$_POST[coh_id],$todo
  function expediente($exp_id,$min_id,$ci_emp,$ci_est,$exp_pdp,$exp_pcd,$exp_ftc,$exp_pic,$exp_fcp,$exp_fcc,$exp_fod,$exp_ocs,$exp_fnt,$exp_nc9,$exp_nc5,$exp_pna,$exp_ide,$exp_fen,$exp_ubi,$exp_sta,$exp_rus){
    $this->exp_id=$exp_id;
    $this->min_id=$min_id;
    $this->ci_emp=$ci_emp;
    $this->ci_est=$ci_est;
    $this->exp_pdp=$exp_pdp;
    $this->exp_pcd=$exp_pcd;
    $this->exp_ftc=$exp_ftc;
    $this->exp_pic=$exp_pic;
    $this->exp_fcp=$exp_fcp;
    $this->exp_fcc=$exp_fcc;
	$this->exp_fod=$exp_fod;	
    $this->exp_ocs=$exp_ocs;
    $this->exp_fnt=$exp_fnt;
    $this->exp_nc9=$exp_nc9;
    $this->exp_nc5=$exp_nc5;
    $this->exp_pna=$exp_pna;
	$this->exp_ide=$exp_ide;
	$this->exp_fen=$exp_fen;
	$this->exp_ubi=$exp_ubi;
	$this->exp_sta=$exp_sta;
	$this->exp_rus=$exp_rus;
	$this->exp_ccm=$exp_ccm;
  }
//******************************************************************
                           //$_POST[mod_id],$_POST[reg_id],$_POST[esp_id],$_POST[coh_id],$_POST[pen_top],$_POST[pac_id],$_POST[ci_est],$_POST[sol],$_POST[fso],$todo_retiro,$todo_inclusion,$todo_cambio
  function Asignar_valores($exp_id,$min_id,$ci_emp,$ci_est,$exp_pdp,$exp_pcd,$exp_ftc,$exp_pic,$exp_fcp,$exp_fcc,$exp_fod,$exp_ocs,$exp_fnt,$exp_nc9,$exp_nc5,$exp_pna,$exp_ide,$exp_fen,$exp_ubi,$exp_sta,$exp_rus,$exp_fre,$exp_mre,$exp_nre,$exp_obs,$exp_ccm){
    $this->exp_id=$this->ConvertirMayuscula($exp_id);
	if($min_id=='') $min_id=0;
    $this->min_id=$min_id;
    $this->ci_emp=$_SESSION[ci];  //cedula del usuario
    $this->ci_est=$ci_est;
	if($exp_pdp=='') $exp_pdp=0;
    $this->exp_pdp=$exp_pdp;
	if($exp_pcd=='') $exp_pcd=0;
    $this->exp_pcd=$exp_pcd;
	if($exp_ftc=='') $exp_ftc=0;
    $this->exp_ftc=$exp_ftc;
	if($exp_pic=='') $exp_pic=0;
    $this->exp_pic=$exp_pic;
	if($exp_fcp=='') $exp_fcp=0;
    $this->exp_fcp=$exp_fcp;
	if($exp_fcc=='') $exp_fcc=0;
    $this->exp_fcc=$exp_fcc;
	if($exp_fod=='') $exp_fod=0;
	$this->exp_fod=$exp_fod;
	if($exp_ocs=='') $exp_ocs=0;
    $this->exp_ocs=$exp_ocs;
	if($exp_fnt=='') $exp_fnt=0;
    $this->exp_fnt=$exp_fnt;
	if($exp_nc9=='') $exp_nc9=0;
    $this->exp_nc9=$exp_nc9;
	if($exp_nc5=='') $exp_nc5=0;
    $this->exp_nc5=$exp_nc5;
	if($exp_pna=='') $exp_pna=0;
    $this->exp_pna=$exp_pna;
	if($exp_ccm=='') $exp_ccm=0;
    $this->exp_ccm=$exp_ccm;
	$this->exp_fen=$this->fechaMySql($exp_fen)." 00:00:00";  //modificar a mysql
	$this->exp_ubi=$this->ConvertirMayuscula($exp_ubi);
	$this->exp_sta=$exp_sta;
	$this->exp_rus=$exp_rus;
	if($exp_fre=='') $this->exp_fre='';
	else $this->exp_fre=$this->fechaMySql($exp_fre)." 00:00:00";  //modificar a mysql
	if($exp_mre=='') $exp_mre=0;
	$this->exp_mre=$exp_mre;
	if($exp_nre=='') $exp_nre=0;
	$this->exp_nre=$exp_nre;
	$this->exp_obs=$this->ConvertirMayuscula($exp_obs);
  }
//******************************************************************
  function Buscar_Periodo($ci_est){
    $this->ci_est=$ci_est;
/*	echo "<script>alert('Cedula $this->ci_est');</script>";*/
    $res=$this->OperacionCualquiera("SELECT DISTINCT(A.pac_id) AS 'pac_id', B.pac_nom AS 'pac_nom' FROM detins A, pacade B WHERE A.pac_id=B.pac_id AND det_sta='1' AND ci_est='$this->ci_est' ORDER BY B.pac_ffin DESC");
    return $res;
  }
//******************************************************************
  function Buscar_Periodo2($ci_est){
    $this->ci_est=$ci_est;
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
/*	echo "<script>alert('Cedula $this->ci_est');</script>";*/
    $res=$this->OperacionCualquiera("SELECT DISTINCT(A.pac_id) AS 'pac_id', B.pac_nom AS 'pac_nom' FROM detins A, pacade B WHERE A.pac_id=B.pac_id AND det_sta='1' AND ci_est='$this->ci_est' AND A.pac_id!='$this->pac_id' ORDER BY B.pac_ffin DESC");
    return $res;
  }
//******************************************************************
  function Buscar_Estudi($valor){
    $id="";
	$des="";
	$cuantos=0;
	$this->ci_est=$valor;
	$_SESSION[ci_est]=$valor;
/*  echo "<script>alert('SELECT A.ap1 AS ap1, A.ap2 AS ap2, A.ap3 AS ap3, A.no1 AS no1, A.no2 AS no2, A.no3 AS no3, B.mod_id AS mod_id, C.mod_nom AS mod_nom, B.reg_id AS reg_id, D.reg_nom AS reg_nom, B.esp_id AS esp_id, E.esp_nom AS esp_nom, B.coh_id AS coh_id, F.coh_nom AS coh_nom FROM persona A, matric B, modali C, regimen D, especi E, cohort F WHERE A.ci=$this->ci_est AND A.ci=B.ci AND B.mod_id=C.mod_id AND B.reg_id=D.reg_id AND B.esp_id=E.esp_id AND B.coh_id=F.coh_id AND B.matr_sta=1 AND B.matr_tip=0');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT A.ap1 AS 'ap1', A.ap2 AS 'ap2', A.ap3 AS 'ap3', A.no1 AS 'no1', A.no2 AS 'no2', A.no3 AS 'no3', B.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', B.reg_id AS 'reg_id', D.reg_nom AS 'reg_nom', B.esp_id AS 'esp_id', E.esp_nom AS 'esp_nom', B.coh_id AS 'coh_id', F.coh_nom AS 'coh_nom', B.pen_top AS 'pen_top', G.pen_muc AS 'pen_muc' FROM persona A, matric B, modali C, regimen D, especi E, cohort F, pensum G WHERE A.ci='$this->ci_est' AND A.ci=B.ci AND B.mod_id=C.mod_id AND B.reg_id=D.reg_id AND B.esp_id=E.esp_id AND B.coh_id=F.coh_id AND B.mod_id=G.mod_id AND B.reg_id=G.reg_id AND B.esp_id=G.esp_id AND B.coh_id=G.coh_id AND B.pen_top=G.pen_top AND B.matr_sta='1' AND B.matr_tip='0'");
	$estudi=$this->ConsultarCualquiera($resp);
    $ap=$estudi->ap1." ".$estudi->ap2." ".$estudi->ap3;
    $nom=$estudi->no1." ".$estudi->no2." ".$estudi->no3;
	$this->res=$ap."@".$nom."@".$estudi->mod_id."@".$estudi->mod_nom."@".$estudi->reg_id."@".$estudi->reg_nom."@".$estudi->esp_id."@".$estudi->esp_nom."@".$estudi->coh_id."@".$estudi->coh_nom."@".$estudi->pen_top."@".$estudi->pen_muc;
$_SESSION[mod_id]=$estudi->mod_id;
$_SESSION[reg_id]=$estudi->reg_id;
$_SESSION[coh_id]=$estudi->coh_id;
$_SESSION[esp_id]=$estudi->esp_id;
$_SESSION[pen_top]=$estudi->pen_top;
	return $this->res;
  }
//******************************************************************
  function Buscar_Estudi_Reglamento($valor){
    $id="";
	$des="";
	$cuantos=0;
	$this->ci_est=$valor;
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
/*  echo "<script>alert('SELECT A.ap1 AS ap1, A.ap2 AS ap2, A.ap3 AS ap3, A.no1 AS no1, A.no2 AS no2, A.no3 AS no3, B.mod_id AS mod_id, C.mod_nom AS mod_nom, B.reg_id AS reg_id, D.reg_nom AS reg_nom, B.esp_id AS esp_id, E.esp_nom AS esp_nom, B.coh_id AS coh_id, F.coh_nom AS coh_nom FROM persona A, matric B, modali C, regimen D, especi E, cohort F WHERE A.ci=$this->ci_est AND A.ci=B.ci AND B.mod_id=C.mod_id AND B.reg_id=D.reg_id AND B.esp_id=E.esp_id AND B.coh_id=F.coh_id AND B.matr_sta=1 AND B.matr_tip=0');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT * FROM apli_reg WHERE ci_est='$this->ci_est' AND pac_id ='$this->pac_id'");	
	return $resp;
  }
//******************************************************************
  function Buscar_Pacade(){
    $num_filas='';
	$hoy=date("Y-m-d");
	//SELECT DATEDIFF( '2011-03-19 00:00:00', `pac_fin` ) AS 'fin', DATEDIFF( `pac_ffin` , '2011-03-19 00:00:00' ) AS 'ffi' FROM pacade WHERE `pac_sta` = '1'
	$fecha=$hoy." 00:00:00";
    $respuesta=$this->OperacionCualquiera("SELECT pac_id, pac_nom FROM pacade WHERE DATEDIFF('$fecha',pac_fin)>=0 AND DATEDIFF(pac_ffin,'$fecha')>=0 AND pac_sta='1' ORDER BY pac_ffin DESC");
	$pacade=$this->ConsultarCualquiera($respuesta);
//    $num_filas=$this->NumFilas();
    return $pacade;
  }
//******************************************************************
  function Buscar_Exp_Estudi($valor){
    $resp=$this->OperacionCualquiera("SELECT * FROM expedi WHERE ci_est='$valor' AND exp_sta='1'");
	$estudi=$this->ConsultarCualquiera($resp);
	return $estudi;
  }
//******************************************************************
  function Listado_min(){
    $resp=$this->OperacionCualquiera("SELECT * FROM modali_ing WHERE min_sta='1'");
	return $resp;
  }
//******************************************************************
  function Listado_nuc(){
    $resp=$this->OperacionCualquiera("SELECT * FROM nucleo WHERE nuc_sta='1'");
	return $resp;
  }
//******************************************************************
  function Procesar_Expediente(){
    $ultimo_id="";
    $estudi=$this->Buscar_Exp_Estudi($this->ci_est);
	if($estudi->exp_id!=""){ //MODIFICO EL EXPEDIENTE
/*      echo "<script>alert('UPDATE expedi set min_id=$this->min_id, exp_pdp=$this->exp_pdp, exp_pcd=$this->exp_pcd, exp_ftc=$this->exp_ftc, exp_pic=$this->exp_pic, exp_fcp=$this->exp_fcp, exp_fcc=$this->exp_fcc, exp_fod=$this->exp_fod, exp_ocs=$this->exp_ocs, exp_fnt=$this->exp_fnt, exp_nc9=$this->exp_nc9, exp_nc5=$this->exp_nc5, exp_pna=$this->exp_pna, exp_ubi=$this->exp_ubi, exp_rus=$this->exp_rus, exp_fre=$this->exp_fre, exp_mre=$this->exp_mre, exp_nre=$this->exp_nre, exp_obs=$this->exp_obs where ci_est=$this->ci_est AND exp_sta=1');</script>";*/
      $resp=$this->OperacionCualquiera("UPDATE expedi set min_id='$this->min_id', exp_pdp='$this->exp_pdp', exp_pcd='$this->exp_pcd', exp_ftc='$this->exp_ftc', exp_pic='$this->exp_pic', exp_fcp='$this->exp_fcp', exp_fcc='$this->exp_fcc', exp_fod='$this->exp_fod', exp_ocs='$this->exp_ocs', exp_fnt='$this->exp_fnt', exp_nc9='$this->exp_nc9', exp_nc5='$this->exp_nc5', exp_pna='$this->exp_pna', exp_ubi='$this->exp_ubi', exp_rus='$this->exp_rus', exp_fre='$this->exp_fre', exp_mre='$this->exp_mre', exp_nre='$this->exp_nre', exp_obs='$this->exp_obs', exp_ccm='$this->exp_ccm' where ci_est='$this->ci_est' AND exp_sta='1'");	  
	}
	else{  //INSERTO EXPEDIENTE
/*	  echo "<script>alert('INSERT INTO expedi (exp_id,min_id,ci_emp,ci_est,exp_pdp,exp_pcd,exp_ftc,exp_pic,exp_fcp,exp_fcc,exp_fod,exp_ocs,exp_fnt,exp_nc9,exp_nc5,exp_pna,exp_fen,exp_ubi,exp_sta,exp_rus,exp_fre,exp_mre,exp_nre,exp_obs) VALUES ($this->exp_id,$this->min_id,$this->ci_emp,$this->ci_est,$this->exp_pdp,$this->exp_pcd,$this->exp_ftc,$this->exp_pic,$this->exp_fcp,$this->exp_fcc,$this->exp_fod,$this->exp_ocs,$this->exp_fnt,$this->exp_nc9,$this->exp_nc5,$this->exp_pna,$this->exp_fen,$this->exp_ubi,$this->exp_sta,$this->exp_rus,$this->exp_fre,$this->exp_mre,$this->exp_nre,$this->exp_obs)');</script>";*/
	  $resp=$this->OperacionCualquiera("INSERT INTO expedi (exp_id,min_id,ci_emp,ci_est,exp_pdp,exp_pcd,exp_ftc,exp_pic,exp_fcp,exp_fcc,exp_fod,exp_ocs,exp_fnt,exp_nc9,exp_nc5,exp_pna,exp_fen,exp_ubi,exp_sta,exp_rus,exp_fre,exp_mre,exp_nre,exp_obs,exp_ccm) VALUES ('$this->exp_id','$this->min_id','$this->ci_emp','$this->ci_est','$this->exp_pdp','$this->exp_pcd','$this->exp_ftc','$this->exp_pic','$this->exp_fcp','$this->exp_fcc','$this->exp_fod','$this->exp_ocs','$this->exp_fnt','$this->exp_nc9','$this->exp_nc5','$this->exp_pna','$this->exp_fen','$this->exp_ubi','$this->exp_sta','$this->exp_rus','$this->exp_fre','$this->exp_mre','$this->exp_nre','$this->exp_obs','$this->exp_ccm')");
	  $ultimo_id = mysql_insert_id();
	}
	$expe=$this->filas_afectadas($resp);
/*echo "<script>alert('CAMBIO $cambio');</script>";*/
    if($expe>0){	
	  if($ultimo_id==""){
        $accion='MODIFICAR';
	    $ultimo_id=$this->exp_id;
	  }
	  else{
        $accion='INSERTAR';
	  }
      $Operacion="PROCESAR EXPEDIENTE ".$ultimo_id." ID=".$this->exp_id.", min_id=".$this->min_id.", ci_emp=".$this->ci_emp.", ci_est=".$this->ci_est.", pdp=".$this->exp_pdp.", pcd=".$this->exp_pcd.", ftc=".$this->exp_ftc.", pic=".$this->exp_pic.", fcp=".$this->exp_fcp.", fcc=".$this->exp_fcc.", fod=".$this->exp_fod.", ocs=".$this->exp_ocs.", fnt=".$this->exp_fnt.", nc9=".$this->exp_nc9.", nc5=".$this->exp_nc5.", pna=".$this->exp_pna.", fen=".$this->exp_fen.", ubi=".$this->exp_ubi.", sta=".$this->exp_sta.", rus=".$this->exp_rus.", fre=".$this->exp_fre.", mre=".$this->exp_mre.", nre=".$this->exp_nre.", obs=".$this->exp_obs.", ccm=".$this->exp_ccm;
      $this->guardar_accion($accion,"expedi",$Operacion);
    }
	return $expe;
  }
}?>