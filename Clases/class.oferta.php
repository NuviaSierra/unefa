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
  function Contar_oferta($pac_id){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM asigna_seccio WHERE ase_sta='1' AND pac_id='$pac_id'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Contar_matri(){
    $resultado=$this->Operacion("SELECT DISTINCT(A.esp_id) AS 'esp_id' , A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', D.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom', A.pen_top AS 'pen_top' FROM matric A, cohort B, modali C, especi D, regimen E WHERE A.ci=$_SESSION[ci] AND A.matr_sta='1' AND A.coh_id=B.coh_id AND C.mod_id=A.mod_id AND D.esp_id=A.esp_id AND A.reg_id=E.reg_id ORDER BY B.coh_nom,C.mod_nom,E.reg_nom,D.esp_nom,A.pen_top LIMIT $cantidad OFFSET $inicial");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_matri($inicial,$cantidad){
/*  echo "<script>alert('SELECT DISTINCT(A.esp_id) AS esp_id, A.coh_id AS coh_id, B.coh_nom AS coh_nom, A.mod_id AS mod_id, C.mod_nom AS mod_nom, D.esp_nom AS esp_nom, A.reg_id AS reg_id, E.reg_nom AS reg_nom, A.pen_top AS pen_top FROM matric A, cohort B, modali C, especi D, regimen E WHERE A.ci=$_SESSION[ci] AND A.matr_sta=1 AND A.coh_id=B.coh_id AND C.mod_id=A.mod_id AND D.esp_id=A.esp_id AND A.reg_id=E.reg_id ORDER BY B.coh_nom,C.mod_nom,E.reg_nom,D.esp_nom,A.pen_top LIMIT $cantidad OFFSET $inicial');</script>";*/
    $resultado=$this->Operacion("SELECT DISTINCT(A.esp_id) AS 'esp_id', A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', D.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom' FROM matric A, cohort B, modali C, especi D, regimen E WHERE A.ci=$_SESSION[ci] AND A.matr_sta='1' AND A.coh_id=B.coh_id AND C.mod_id=A.mod_id AND D.esp_id=A.esp_id AND A.reg_id=E.reg_id ORDER BY B.coh_nom,C.mod_nom,E.reg_nom,D.esp_nom,A.pen_top LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_matri2(){
    $resultado=$this->Operacion("SELECT DISTINCT(A.esp_id) AS 'esp_id', A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', D.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom' FROM matric A, cohort B, modali C, especi D, regimen E WHERE A.ci=$_SESSION[ci] AND A.matr_sta='1' AND A.coh_id=B.coh_id AND C.mod_id=A.mod_id AND D.esp_id=A.esp_id AND A.reg_id=E.reg_id ORDER BY B.coh_nom,C.mod_nom,E.reg_nom,D.esp_nom,A.pen_top");
    return $resultado;
  }
//******************************************************************
  function Listado_asigna($mod_id, $reg_id, $esp_id, $coh_id, $pen_top){
/*  echo "<script>alert('SELECT DISTINCT(A.asi_cod) AS asi_cod, A.asi_mod AS asi_mod, A.asi_nom AS asi_nom, A.asi_cuc AS asi_cuc, A.asi_cht AS asi_cht, A.asi_chp AS asi_chp, A.asi_chl AS asi_chl, A.tip_id, B.tip_nom AS tip_nom, A.asi_cba AS 'asi_cba' FROM asigna A, tipoma B WHERE A.coh_id=$coh_id AND A.mod_id=$mod_id AND A.esp_id=$esp_id AND A.reg_id=$reg_id AND A.asi_sta=1 AND A.tip_id=B.tip_id order by A.pen_top, A.asi_mod, A.asi_nom');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_mod AS 'asi_mod', A.asi_nom AS 'asi_nom', A.asi_cuc AS 'asi_cuc', A.asi_cht AS 'asi_cht', A.asi_chp AS 'asi_chp', A.asi_chl AS 'asi_chl', A.tip_id AS 'tip_id', A.asi_cba AS 'asi_cba', B.tip_nom AS 'tip_nom' FROM asigna A, tipoma B WHERE A.coh_id='$coh_id' AND A.mod_id='$mod_id' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.asi_sta='1' AND A.tip_id=B.tip_id order by A.pen_top, A.asi_mod, A.asi_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_asigna_seccion($mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $pac_id){  
	  $resp=$this->Listado_infraestructura();
	  $inf=$this->ConsultarCualquiera($resp);
/*  echo "<script>alert('SELECT A.asi_cod AS asi_cod, B.asi_nom AS asi_nom, A.sec_id AS sec_id, C.sec_nom AS sec_nom, A.ase_cma AS ase_cma, A.ele_cod AS ele_cod FROM asigna_seccio A, asigna B, seccio C WHERE A.mod_id=$mod_id AND A.reg_id=$reg_id AND A.esp_id=$esp_id AND A.coh_id=$coh_id AND A.asi_cod=$asi_cod AND A.pac_id=$pac_id AND A.asi_cod=B.asi_cod AND A.sec_id=C.sec_id AND ase_sta=1');</script>";*/
    $res=$this->OperacionCualquiera("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_mod AS 'asi_mod', A.asi_nom AS 'asi_nom', A.asi_cuc AS 'asi_cuc', A.asi_cht AS 'asi_cht', A.asi_chp AS 'asi_chp', A.asi_chl AS 'asi_chl', A.asi_cba AS 'asi_cba', A.tip_id AS 'tip_id', B.tip_nom AS 'tip_nom' FROM asigna_seccio D, seccio C, asigna A, tipoma B WHERE A.coh_id='$coh_id' AND A.mod_id='$mod_id' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND D.ase_sta='1' AND A.tip_id=B.tip_id order by A.pen_top, A.asi_mod, A.asi_nom");
	return $res;
  }
//******************************************************************
  function Contar_Ing_Diurno($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id,$sec_id){
  $this->pac_id=$pac_id;
/*  echo "<script>alert('SELECT count(ci_est) AS cantidad FROM detins WHERE asi_cod=$asi_cod AND sec_id=$sec_id AND esp_id IN(2113D,2126D,2122D) AND reg_id=$reg_id AND mod_id=$mod_id AND coh_id=$coh_id AND pac_id=$this->pac_id AND det_sta=1');</script>";*/
    $resultado=$this->Operacion("SELECT count(ci_est) AS 'cant' FROM detins WHERE asi_cod='$asi_cod' AND sec_id='$sec_id' AND esp_id IN('2113D','2126D','2122D') AND reg_id='$reg_id' AND mod_id='$mod_id' AND coh_id='$coh_id' AND pac_id='$this->pac_id' AND det_sta=1");
    return $resultado;
  }
//******************************************************************$mod_id, $reg_id, $esp_id, $coh_id, $pen_top
  function Contar_Ing_Nocturno($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id,$sec_id){
  $this->pac_id=$pac_id;
/*  echo "<script>alert('SELECT count(ci_est) AS cantidad FROM detins WHERE asi_cod=$asi_cod AND sec_id=$sec_id AND esp_id IN(2113N,2126N,2122N) AND reg_id=$reg_id AND mod_id=$mod_id AND coh_id=$coh_id AND pac_id=$this->pac_id AND det_sta=1');</script>";*/
    $resultado=$this->Operacion("SELECT count(ci_est) AS 'cant' FROM detins WHERE asi_cod='$asi_cod' AND sec_id='$sec_id' AND esp_id IN('2113N','2126N','2122N') AND reg_id='$reg_id' AND mod_id='$mod_id' AND coh_id='$coh_id' AND pac_id='$this->pac_id' AND det_sta=1");
    return $resultado;
  }
//******************************************************************
  function Contar_Licenciatura($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id,$sec_id){
  $this->pac_id=$pac_id;
//  if($asi_cod=='02')
/*  echo "<script>alert('SELECT count(ci_est) AS cantidad FROM detins WHERE asi_cod=$asi_cod AND sec_id=$sec_id AND esp_id=$esp_id AND reg_id=$reg_id AND mod_id=$mod_id AND coh_id=$coh_id AND pac_id=$this->pac_id AND det_sta=1');</script>";*/
    $resultado=$this->Operacion("SELECT count(ci_est) AS 'cant' FROM detins WHERE asi_cod='$asi_cod' AND sec_id='$sec_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND mod_id='$mod_id' AND coh_id='$coh_id' AND pac_id='$this->pac_id' AND det_sta=1");
    return $resultado;
  }
//******************************************************************
  function Buscar_asigna_seccion2($asi_cod,$sec_id){
/*  echo "<script>alert('Buscar $asi_cod,$sec_id');</script>";*/
/*  echo "<script>alert('SELECT * FROM asigna_seccio WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pac_id=$this->pac_id AND asi_cod=$asi_cod AND sec_id=$sec_id');</script>";*/
    $this->Operacion("SELECT * FROM asigna_seccio WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pac_id='$this->pac_id' AND asi_cod='$asi_cod' AND sec_id='$sec_id' AND ase_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }  
//******************************************************************
  function Asigna_Seccion(){
    $sec_id=explode("*",$this->sec_id);
	$cu_can=explode("*",$this->ase_cma);
    $electi_cod=explode("*",$this->ele_cod);
	$asi_cod=explode("*",$this->asi_cod);
	$i=0;
//	$this->Asigna_Seccion_Eliminar_todo();
	while($asi_cod[$i]!=""){
	  $can=$this->Buscar_asigna_seccion2($asi_cod[$i],$sec_id[$i]);
/*  echo "<script>alert('Can $can');</script>";*/
	  if($can==0){
	    //AGREGAR DOS MATERIAS UNA PARA CADA PENSUM
		$this->Agregar_Asigna_Seccion($asi_cod[$i],$sec_id[$i],$electi_cod[$i],$cu_can[$i]);
 	    $accion='INSERTAR';//'$this->coh_id', '$this->mod_id', '$this->reg_id', '$this->esp_id', '$this->pen_top'
	    $Operacion="MOD: ".$this->mod_id." REG: ".$this->reg_id." ESP: ".$this->esp_id." COH: ".$this->coh_id." ASIG: ".$asi_cod[$i]." SECC: ".$sec_id[$i];
	    $this->guardar_accion($accion,"asigna_seccio",$Operacion);
	  }
	  else{
	    //MODIFICAR DOS MATERIAS UNA PARA CADA PENSUM
		$this->Modificar_Asigna_Seccion($asi_cod[$i],$sec_id[$i],$electi_cod[$i],$cu_can[$i]);
 	    $accion='MODIFICAR';//'$this->coh_id', '$this->mod_id', '$this->reg_id', '$this->esp_id', '$this->pen_top'
	    $Operacion="MOD: ".$this->mod_id." REG: ".$this->reg_id." ESP: ".$this->esp_id." COH: ".$this->coh_id." ASIG: ".$asi_cod[$i]." SECC: ".$sec_id[$i];
	    $this->guardar_accion($accion,"asigna_seccio",$Operacion);
	  }
	  $i++;
	}
	return 1;
  }
//******************************************************************
  function Agregar_Asigna_Seccion($asi_cod,$sec_id,$electi_cod,$cu_can){
/*  echo "<script>alert('INSERT INTO asigna_seccio (pac_id, coh_id, mod_id, reg_id, esp_id, asi_cod, sec_id, pen_top, ele_cod, ci_emp, ase_sta, ase_p11, ase_p12, ase_p21, ase_p22, ase_p31, ase_p32, ase_pla, ase_cma) VALUES ($this->pac_id, $this->coh_id, $this->mod_id, $this->reg_id, $this->esp_id, $asi_cod, $sec_id, 0, $electi_cod, 0, 1, , , , , , , ,$cu_can)');</script>";*/
    if($electi_cod!=""){
 	  $this->Operacion("INSERT INTO asigna_seccio (pac_id, coh_id, mod_id, reg_id, esp_id, asi_cod, sec_id, pen_top, ele_cod, ci_emp, ase_sta, ase_p11, ase_p12, ase_p21, ase_p22, ase_p31, ase_p32, ase_pla, ase_cma) VALUES ('$this->pac_id', '$this->coh_id', '$this->mod_id', '$this->reg_id', '$this->esp_id', '$asi_cod', '$sec_id', '0', '$electi_cod', '0', '1','','','','','','','','$cu_can')");
	  $this->Operacion("INSERT INTO asigna_seccio (pac_id, coh_id, mod_id, reg_id, esp_id, asi_cod, sec_id, pen_top, ele_cod, ci_emp, ase_sta, ase_p11, ase_p12, ase_p21, ase_p22, ase_p31, ase_p32, ase_pla, ase_cma) VALUES ('$this->pac_id', '$this->coh_id', '$this->mod_id', '$this->reg_id', '$this->esp_id', '$asi_cod', '$sec_id', '1', '$electi_cod', '0', '1','','','','','','','','$cu_can')");
	}else{
	  $this->Operacion("INSERT INTO asigna_seccio (pac_id, coh_id, mod_id, reg_id, esp_id, asi_cod, sec_id, pen_top, ele_cod, ci_emp, ase_sta, ase_p11, ase_p12, ase_p21, ase_p22, ase_p31, ase_p32, ase_pla, ase_cma) VALUES ('$this->pac_id', '$this->coh_id', '$this->mod_id', '$this->reg_id', '$this->esp_id', '$asi_cod', '$sec_id', '0', '0', '0', '1','','','','','','','','$cu_can')");
	  $this->Operacion("INSERT INTO asigna_seccio (pac_id, coh_id, mod_id, reg_id, esp_id, asi_cod, sec_id, pen_top, ele_cod, ci_emp, ase_sta, ase_p11, ase_p12, ase_p21, ase_p22, ase_p31, ase_p32, ase_pla, ase_cma) VALUES ('$this->pac_id', '$this->coh_id', '$this->mod_id', '$this->reg_id', '$this->esp_id', '$asi_cod', '$sec_id', '1', '0', '0', '1','','','','','','','','$cu_can')");
	}
  }
//******************************************************************
  function Modificar_Asigna_Seccion($asi_cod,$sec_id,$electi_cod,$cu_can){
    if($electi_cod!=""){
/*  echo "<script>alert('UPDATE asigna_seccio set ele_cod=$electi_cod, ase_sta=1, ase_cma=$cu_can, ase_obs= WHERE pac_id=$this->pac_id AND coh_id=$this->coh_id AND mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND asi_cod=$asi_cod AND sec_id=$sec_id');</script>";*/
 	  $this->Operacion("UPDATE asigna_seccio set ele_cod='$electi_cod', ase_sta='1', ase_cma='$cu_can', ase_obs=' ' WHERE pac_id='$this->pac_id' AND coh_id='$this->coh_id' AND mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND asi_cod='$asi_cod' AND sec_id='$sec_id'");
	}else{
/*  echo "<script>alert('UPDATE asigna_seccio set ase_sta=1, ase_cma=$cu_can, ase_obs= WHERE pac_id=$this->pac_id AND coh_id=$this->coh_id AND mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND asi_cod=$asi_cod AND sec_id=$sec_id');</script>";*/
 	  $this->Operacion("UPDATE asigna_seccio set ase_sta='1', ase_cma='$cu_can', ase_obs=' ' WHERE pac_id='$this->pac_id' AND coh_id='$this->coh_id' AND mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND asi_cod='$asi_cod' AND sec_id='$sec_id'");
	}
  }
//******************************************************************
  function Asigna_Seccion_Eliminar_todo(){  
	  $resp=$this->Listado_infraestructura();
	  $inf=$this->ConsultarCualquiera($resp);
/*echo "<script>alert('UPDATE asigna_seccio A, seccio B set A.ase_sta=2, A.ase_obs=ELIMINADA POR CREACION ERRONEA WHERE A.mod_id=$this->mod_id AND A.reg_id=$this->reg_id AND A.esp_id=$this->esp_id AND A.coh_id=$this->coh_id AND A.pac_id=$this->pac_id AND A.ase_sta=1 AND B.inf_id=$inf->inf_id AND A.sec_id=B.sec_id');</script>";*/
    $res=$this->Operacion("UPDATE asigna_seccio A, seccio B set A.ase_sta='2', A.ase_obs='ELIMINADA POR CREACIÓN ERRONEA' WHERE A.mod_id='$this->mod_id' AND A.reg_id='$this->reg_id' AND A.esp_id='$this->esp_id' AND A.coh_id='$this->coh_id' AND A.pac_id='$this->pac_id' AND A.ase_sta='1' AND B.inf_id='$inf->inf_id' AND A.sec_id=B.sec_id");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Asignar_valores($mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $pac_id, $asi_cod, $sec_id, $ele_cod, $ci_emp, $sta, $ase_p11,$ase_p12, $ase_p21, $ase_p22, $ase_p31, $ase_p32, $ase_pla, $ase_cma){
/*    echo "<script>alert('$mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $obs, $paca, $per, $uc, $asigna, $sta');</script>";*/
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
	$this->ase_cma=$ase_cma;
  }
//******************************************************************
  function Buscar_pensum($mod_id, $reg_id, $esp_id, $coh_id, $pen_top){
/*  echo "<script>alert('SELECT A.mod_id AS mod_id, B.mod_nom AS mod_nom, A.reg_id AS reg_id, C.reg_nom AS reg_nom, A.esp_id AS esp_id, D.esp_nom AS esp_nom, A.coh_id AS coh_id, E.coh_nom AS coh_nom, A.pen_top AS pen_top, A.pen_mpa AS pen_mpa, A.pen_muc AS pen_muc, A.pen_mpe AS pen_mpe, A.pen_obs AS pen_obs FROM pensum A, modali B, regimen C, especi D, cohort E WHERE A.mod_id=$mod_id AND A.mod_id=B.mod_id AND A.reg_id=$reg_id AND A.reg_id=C.reg_id AND A.esp_id=$esp_id AND A.esp_id=D.esp_id AND A.coh_id=$coh_id AND A.coh_id=E.coh_id AND A.pen_top=$pen_top');</script>";*/
    $this->Operacion("SELECT A.mod_id AS 'mod_id', B.mod_nom AS 'mod_nom', A.reg_id AS 'reg_id', C.reg_nom AS 'reg_nom', A.esp_id AS 'esp_id', D.esp_nom AS 'esp_nom', A.coh_id AS 'coh_id', E.coh_nom AS 'coh_nom', A.pen_top AS 'pen_top', A.pen_mpa AS 'pen_mpa', A.pen_muc AS 'pen_muc', A.pen_mpe AS 'pen_mpe', A.pen_obs AS 'pen_obs' FROM pensum A, modali B, regimen C, especi D, cohort E WHERE A.mod_id='$mod_id' AND A.mod_id=B.mod_id AND A.reg_id='$reg_id' AND A.reg_id=C.reg_id AND A.esp_id='$esp_id' AND A.esp_id=D.esp_id AND A.coh_id='$coh_id' AND A.coh_id=E.coh_id AND A.pen_top='$pen_top'");
  }
//******************************************************************  
  function Buscar_seccion_inf($sec_id, $inf_id){
/*  echo "<script>alert('SELECT * FROM seccio WHERE sec_id=$sec_id AND inf_id=$inf_id');</script>";*/
    $resp=$this->Listado_infraestructura();
	$inf_id="";
	while($array=$this->ConsultarCualquiera($resp)){
	  if($inf_id=="")
	    $inf_id="'".$array->inf_id."'";
	  else
	    $inf_id=$inf_id.",'".$array->inf_id."'";
    }
	$resultado=$this->OperacionCualquiera("SELECT DISTINCT(sec_id) AS 'sec_id', sec_nom, inf_id, sec_sta, sec_des FROM seccio WHERE sec_id='$sec_id'");
    $num_filas=$this->NumFilasCualquiera($resultado);
    return $num_filas;
  }
//******************************************************************
  function Buscar_asigna_seccion($asi_cod, $mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $pac_id){  
	  $resp=$this->Listado_infraestructura();
	  $inf=$this->ConsultarCualquiera($resp);  
/*  echo "<script>alert('SELECT A.asi_cod AS asi_cod, B.asi_nom AS asi_nom, A.sec_id AS sec_id, C.sec_nom AS sec_nom, A.ase_cma AS ase_cma, A.ele_cod AS ele_cod FROM asigna_seccio A, asigna B, seccio C WHERE A.mod_id=$mod_id AND A.reg_id=$reg_id AND A.esp_id=$esp_id AND A.coh_id=$coh_id AND A.asi_cod=$asi_cod AND A.pac_id=$pac_id AND A.asi_cod=B.asi_cod AND A.sec_id=C.sec_id AND ase_sta=1');</script>";*/
    $res=$this->OperacionCualquiera("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.sec_id AS 'sec_id', C.sec_nom AS 'sec_nom', A.ase_cma AS 'ase_cma', A.ele_cod AS ele_cod, B.inf_nom AS 'inf_nom' FROM asigna_seccio A, infrae B, seccio C WHERE A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.asi_cod='$asi_cod' AND A.pac_id='$pac_id' AND A.sec_id=C.sec_id AND A.ase_sta='1' AND B.inf_id=C.inf_id ORDER BY C.sec_nom,B.inf_nom");
	return $res;
  }
//******************************************************************
  function Buscar_Horario($asi_cod, $mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $pac_id){
/*  echo "<script>alert('SELECT A.asi_cod AS asi_cod, B.asi_nom AS asi_nom, A.sec_id AS sec_id, C.sec_nom AS sec_nom, A.ase_cma AS ase_cma, A.ele_cod AS ele_cod FROM asigna_seccio A, asigna B, seccio C WHERE A.mod_id=$mod_id AND A.reg_id=$reg_id AND A.esp_id=$esp_id AND A.coh_id=$coh_id AND A.asi_cod=$asi_cod AND A.pac_id=$pac_id AND A.asi_cod=B.asi_cod AND A.sec_id=C.sec_id AND ase_sta=1');</script>";*/
    $res=$this->OperacionCualquiera("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.sec_id AS 'sec_id', C.sec_nom AS 'sec_nom', A.ase_cma AS 'ase_cma', A.ele_cod AS ele_cod FROM asigna_seccio A, seccio C WHERE A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.asi_cod='$asi_cod' AND A.pac_id='$pac_id' AND A.sec_id=C.sec_id AND A.ase_sta='1'");
	return $res;
  }
//******************************************************************
  function Listado_electi_pensum($mod_id, $reg_id, $esp_id, $coh_id, $pen_top){
/*    echo "<script>alert('SELECT DISTINCT (A.ele_cod) AS ele_cod, B.ele_nom FROM electi_pensum A, electi B WHERE A.elp_sta=1 AND A.coh_id=$coh_id AND A.mod_id=$mod_id AND A.esp_id=$esp_id AND A.reg_id=$reg_id AND A.ele_cod=B.ele_cod ORDER BY A.pen_top, B.ele_nom');</script>";*/
    $res=$this->OperacionCualquiera("SELECT DISTINCT (A.ele_cod) AS 'ele_cod', B.ele_nom FROM electi_pensum A, electi B WHERE A.elp_sta='1' AND A.coh_id='$coh_id' AND A.mod_id='$mod_id' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.ele_cod=B.ele_cod ORDER BY A.pen_top, B.ele_nom");
    return $res;
  }
//******************************************************************
  function Listado_seccion($inf_id){
    $resp=$this->Listado_infraestructura();
	$inf_id="";
	while($array=$this->ConsultarCualquiera($resp)){
	  if($inf_id=="")
	    $inf_id="'".$array->inf_id."'";
	  else
	    $inf_id=$inf_id.",'".$array->inf_id."'";
    }
    $resultado=$this->OperacionCualquiera("SELECT DISTINCT(sec_id) AS 'sec_id', sec_nom, inf_id, sec_sta, sec_des FROM seccio WHERE sec_sta='1' order by sec_nom");
    return $resultado;
  }
//******************************************************************
  function Buscar_Infrae($inf_id){
    $resultado=$this->OperacionCualquiera("SELECT * FROM infrae WHERE inf_id='$inf_id'");
	$nombre=$this->ConsultarCualquiera($resultado);
    return $nombre;
  }
//******************************************************************
  function Listado_infraestructura(){
    $ci=$_SESSION['ci'];
/*	echo "<script>alert('cedula $ci');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.ci AS 'ci', B.inf_nom AS 'inf_nom' FROM estudi_infrae A, infrae B WHERE (A.est_inf_ffi='0000-00-00 00:00:00' OR A.est_inf_ffi='') AND A.ci='$ci' AND B.inf_id=A.inf_id");
    return $resultado;
  }
//******************************************************************
  function Buscar_Campos1($valor,$cual){
    $id="";
	$des="";
	$cuantos=0;
	$this->mod_id=$valor;
/*  echo "<script>alert('reg_id $this->mod_id');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT A.reg_id AS 'reg_id', B.reg_nom AS 'reg_nom' FROM reg_esp_mod A, regimen B WHERE rem_sta='1' AND A.mod_id='$valor' AND A.reg_id=B.reg_id GROUP BY A.reg_id ORDER BY B.reg_nom");
	while($array=$this->ConsultarCualquiera($resp)){
	  if($id==""){
	    $id=$array->reg_id;
	    $des=$array->reg_nom;
	  }
	  else{
	    $id=$id."*".$array->reg_id;
	    $des=$des."*".$array->reg_nom;
	  }
	  $cuantos++;
	}
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_Campos2($valor,$cual){
    $id="";
	$des="";
	$cuantos=0;
	$val=explode("*",$valor);
	$this->reg_id=$val[0];
	$this->mod_id=$val[1];
/*	echo "<script>alert('esp_id $this->mod_id, $this->reg_id');</script>";*/
	$resp=$this->OperacionCualquiera("SELECT A.esp_id AS 'esp_id', B.esp_nom AS 'esp_nom' FROM reg_esp_mod A, especi B WHERE rem_sta='1' AND A.mod_id='$this->mod_id' AND A.reg_id='$val[0]' AND A.esp_id=B.esp_id GROUP BY A.esp_id ORDER BY B.esp_nom");
	while($array=$this->ConsultarCualquiera($resp)){
	  if($id==""){
	    $id=$array->esp_id;
	    $des=$array->esp_nom;
	  }
	  else{
	    $id=$id."*".$array->esp_id;
	    $des=$des."*".$array->esp_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_Campos3($valor,$cual){
    $id="";
	$des="";
	$cuantos=0;
	$NuevoPens->Listado_Tip_ma();
    while($array=$NuevoPens->Consultar()){
	  if($id==""){
	    $id=$array->tip_id;
	    $des=$array->tip_nom;
	  }
	  else{
	    $id=$id."*".$array->tip_id;
	    $des=$des."*".$array->tip_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
}?>