<?php session_start();
class pensum extends conec_BD
{
 var $mod_id='';
 var $reg_id='';
 var $esp_id='';
 var $coh_id='';
 var $pen_top='';
 var $obs=''; 
 var $asigna='';
 var $sta='';
 var $pen_mpa='';
 var $pen_mpe='';
 var $pen_muc='';
//******************************************************************
//$_POST[mod_id],$_POST[reg_id],$_POST[esp_id],$_POST[coh_id],$todo
  function pensum($mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $obs, $asigna, $sta){
    $this->mod_id=$mod_id;
    $this->reg_id=$reg_id;
    $this->esp_id=$esp_id;
    $this->coh_id=$coh_id;
    $this->pen_top=$pen_top;
    $this->asigna=$this->ConvertirMayuscula($asigna);
    $this->obs=$this->ConvertirMayuscula($obs);
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_pensum(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM pensum WHERE pen_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_pensum($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', D.esp_id AS 'esp_id', D.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom', A.pen_top AS 'pen_top' FROM pensum A, cohort B, modali C, especi D, regimen E  WHERE A.pen_sta='1' AND A.coh_id=B.coh_id AND C.mod_id=A.mod_id AND D.esp_id=A.esp_id AND A.reg_id=E.reg_id order by B.coh_nom,C.mod_nom,E.reg_nom,D.esp_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_asigna($mod_id, $reg_id, $esp_id, $coh_id, $pen_top){
/*  echo "<script>alert('SELECT * FROM asigna WHERE coh_id=$coh_id AND mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND pen_top=$pen_top order by asi_mod, asi_cod');</script>";*/
    $resultado=$this->Operacion("SELECT * FROM asigna WHERE coh_id='$coh_id' AND mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND pen_top='$pen_top' AND asi_sta='1' order by asi_mod, asi_cod");
    return $resultado;
  }
//******************************************************************
  function Listado_asigna2($mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $st, $asi_cod){
/*  echo "<script>alert('SELECT * FROM asigna WHERE coh_id=$coh_id AND mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND pen_top=$pen_top AND asi_mod<=$st AND asi_cod!=$asi_cod order by asi_cod');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT * FROM asigna WHERE coh_id='$coh_id' AND mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND pen_top='$pen_top' AND asi_mod<='$st' AND asi_cod!='$asi_cod' AND asi_sta='1' order by asi_cod");
    return $resultado;
  }
//******************************************************************
  function Listado_requisito($mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $asi_cod){
/*  echo "<script>alert('SELECT * FROM requis WHERE coh_id=$coh_id AND mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND pen_top=$pen_top AND asi_cod=$asi_cod order by asi_cod_req');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT * FROM requis WHERE coh_id='$coh_id' AND mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND pen_top='$pen_top' AND asi_cod='$asi_cod' AND req_sta='1' AND asi_cod_req!='' order by asi_cod_req");
    return $resultado;
  }
//******************************************************************
  function Listado_requisito2($mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $asi_cod){
/*  echo "<script>alert('SELECT req_cuc FROM requis WHERE coh_id=$coh_id AND mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND pen_top=$pen_top AND asi_cod=$asi_cod AND req_sta=1 AND req_cuc!=');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT req_cuc FROM requis WHERE coh_id='$coh_id' AND mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND pen_top='$pen_top' AND asi_cod='$asi_cod' AND req_sta='1' AND req_cuc!=''");
    return $resultado;
  }
//******************************************************************
  function Listado_cohorte(){
    $resultado=$this->Operacion("SELECT * FROM cohort WHERE coh_sta='1' order by coh_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Tip_ma(){
    $resultado=$this->Operacion("SELECT * FROM tipoma WHERE tip_sta='1' order by tip_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Tip_ma2(){
    $resultado=$this->OperacionCualquiera("SELECT * FROM tipoma WHERE tip_sta='1' order by tip_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_modalidad(){
    $resultado=$this->Operacion("SELECT A.mod_id AS 'mod_id', A.mod_nom AS 'mod_nom' FROM modali A, reg_esp_mod B  WHERE A.mod_sta='1' AND A.mod_id=B.mod_id GROUP BY A.mod_id ORDER BY A.mod_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_regimen(){
    $resultado=$this->Operacion("SELECT * FROM regimen WHERE reg_sta='1' order by reg_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_especialidad(){
    $resultado=$this->Operacion("SELECT esp_id, A.niv_id AS 'niv_id', B.niv_nom AS 'niv_nom' FROM especi A, nivela B WHERE A.esp_sta='1' AND A.niv_id=B.niv_id order by B.niv_nom,A.esp_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_regimen2($valor){
    $resultado=$this->Operacion("SELECT A.reg_id AS 'reg_id', B.reg_nom AS 'reg_nom' FROM reg_esp_mod A, regimen B WHERE rem_sta='1' AND A.mod_id='$valor' AND A.reg_id=B.reg_id GROUP BY A.reg_id ORDER BY B.reg_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_especialidad2($val0,$val1){
    $resultado=$this->Operacion("SELECT A.esp_id AS 'esp_id', B.esp_nom AS 'esp_nom' FROM reg_esp_mod A, especi B WHERE rem_sta='1' AND A.mod_id='$val0' AND A.reg_id='$val1' AND A.esp_id=B.esp_id GROUP BY A.esp_id ORDER BY B.esp_nom");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $obs, $paca, $per, $uc, $asigna, $sta){
/*    echo "<script>alert('$mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $obs, $paca, $per, $uc, $asigna, $sta');</script>";*/
    $this->mod_id=$mod_id;
    $this->reg_id=$reg_id;
    $this->esp_id=$esp_id;
    $this->coh_id=$coh_id;
    $this->pen_top=$pen_top;
    $this->pen_mpa=$paca;
    $this->pen_mpe=$per;
    $this->pen_muc=$uc;
    $this->asigna=$this->ConvertirMayuscula($asigna);
    $this->obs=$this->ConvertirMayuscula($obs);
    $this->sta=$sta;
  }
//****************************************************************************************************
  function Agregar_pensum(){
/*    echo "<script>alert('$this->asigna');</script>";*/
    $res=$this->Operacion("INSERT INTO pensum (coh_id, mod_id, reg_id, esp_id, pen_top, pen_mpa, pen_muc, pen_mpe, pen_obs, pen_sta) VALUES ('$this->coh_id', '$this->mod_id', '$this->reg_id', '$this->esp_id', '$this->pen_top', '$this->pen_mpa', '$this->pen_muc', '$this->pen_mpe', '$this->obs', '$this->sta')");
    $num_filas=$this->filas_afectadas($res);	
	if($num_filas>0){
	  $dat_asi=explode("@",$this->asigna);
	  $asi_st=explode("*",$dat_asi[0]);//"asi_st*".$i;
	  $asi_co=explode("*",$dat_asi[1]);//"asi_co*".$i;
	  $asi_ma=explode("*",$dat_asi[2]);//"asi_ma*".$i;
	  $asi_tip=explode("*",$dat_asi[3]);//"asi_ma*".$i;
	  $asi_cb=explode("*",$dat_asi[4]);//"asi_cb*".$i;
	  $asi_rep=explode("*",$dat_asi[5]);//"asi_rep*".$i;
	  $asi_lab=explode("*",$dat_asi[6]);//"asi_lab*".$i;
	  $asi_uc=explode("*",$dat_asi[7]);//"asi_uc*".$i;
	  $asi_ht=explode("*",$dat_asi[8]);//"asi_ht*".$i;
	  $asi_hp=explode("*",$dat_asi[9]);//"asi_hp*".$i;
	  $asi_hl=explode("*",$dat_asi[10]);//"asi_hl*".$i;
	  $asi_obs=explode("*",$dat_asi[11]);//"asi_obs*".$i;
	  $cuantos=explode("*",$dat_asi[12]);//"asi_obs*".$i;
	  $i=0;
	  $band=0;
	  while($asi_st[$i]!=""){
/*        echo "<script>alert('Asigna: $asi_st[$i],$asi_co[$i],$asi_ma[$i],$asi_cb[$i],$asi_rep[$i],$asi_lab[$i],$asi_uc[$i],$asi_ht[$i],$asi_hp[$i],$asi_hl[$i],$asi_obs[$i]');</script>";*/
	    $num_filas=$this->Agregar_asigna($asi_st[$i],$asi_co[$i],$asi_ma[$i],$asi_tip[$i],$asi_cb[$i],$asi_rep[$i],$asi_lab[$i],$asi_uc[$i],$asi_ht[$i],$asi_hp[$i],$asi_hl[$i],$asi_obs[$i]);
/*        echo "<script>alert('Filas: $num_filas');</script>";*/
	    if($num_filas>0){
  	      $accion='INSERTAR';//'$this->coh_id', '$this->mod_id', '$this->reg_id', '$this->esp_id', '$this->pen_top'
	      $Operacion="MOD: ".$this->mod_id." REG: ".$this->reg_id." ESP: ".$this->esp_id." COH: ".$this->coh_id." TI_PE".$this->pen_top." ASIG: ".$asi_co[$i];
	      $this->guardar_accion($accion,"asigna",$Operacion);
		  $band++;
		}
		$i++;
	  }
	  if($cuantos==$band)
	    $num_filas=1;
	}
    return $num_filas;
  }
//****************************************************************************************************
 function Agregar_asigna($asi_st,$asi_co,$asi_ma,$asi_tip,$asi_cb,$asi_rep,$asi_lab,$asi_uc,$asi_ht,$asi_hp,$asi_hl,$asi_obs){
	  $res=$this->Operacion("INSERT INTO asigna (asi_cod, esp_id, reg_id, mod_id, coh_id, pen_top, tip_id, asi_nom, asi_des, asi_mod, asi_lab, asi_cuc, asi_chp, asi_cht, asi_chl, asi_sta, asi_cba, asi_rep)
	                          VALUES ('$asi_co', '$this->esp_id', '$this->reg_id', '$this->mod_id', '$this->coh_id', '$this->pen_top', '$asi_tip', '$asi_ma', '$asi_obs', '$asi_st', '$asi_lab', '$asi_uc', '$asi_hp', '$asi_ht', '$asi_hl', '1', '$asi_cb', '$asi_rep')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//****************************************************************************************************
  function Requisito(){
//	$todo=$req_asi_req."!".$req_asi."!".$req_tip."@".$req_uc."!".$req_uc_asi;
    $todo=explode("@",$this->asigna);
	$asig_req=explode("!",$todo[0]);
	$uc_req=explode("!",$todo[1]);
    $this->Eliminar_Requisito_Todos();
	$req_asi_req=explode("*",$asig_req[0]);
	$req_asi=explode("*",$asig_req[1]);
	$req_tip=explode("*",$asig_req[2]);
	$req_uc=explode("*",$uc_req[0]);
	$req_uc_asi=explode("*",$uc_req[1]);
	$i=0;
	while($req_asi_req[$i]!=""){
	  $encontre=$this->Buscar_Requisito($req_asi[$i],$req_asi_req[$i],"");
	  if($encontre==0){
		$this->Agregar_Requisito($req_asi[$i],$req_asi_req[$i],$req_tip[$i],"");
 	      $accion='INSERTAR';//'$this->coh_id', '$this->mod_id', '$this->reg_id', '$this->esp_id', '$this->pen_top'
	      $Operacion="MOD: ".$this->mod_id." REG: ".$this->reg_id." ESP: ".$this->esp_id." COH: ".$this->coh_id." TI_PE".$this->pen_top." ASIG: ".$req_asi[$i]." ASIG_REQ: ".$req_asi_req[$i];
	      $this->guardar_accion($accion,"requis",$Operacion);
	  }
	  else{//$asi_co,$asi_co_req,$asi_tip,$asi_uc
		$this->Modificar_Requisito($req_asi[$i],$req_asi_req[$i],$req_tip[$i],"");
 	      $accion='MODIFICAR';//'$this->coh_id', '$this->mod_id', '$this->reg_id', '$this->esp_id', '$this->pen_top'
	      $Operacion="MOD: ".$this->mod_id." REG: ".$this->reg_id." ESP: ".$this->esp_id." COH: ".$this->coh_id." TI_PE".$this->pen_top." ASIG: ".$req_asi[$i]." ASIG_REQ: ".$req_asi_req[$i];
	      $this->guardar_accion($accion,"requis",$Operacion);
	  }
	  $i++;
	}
	$i=0;
	while($req_uc[$i]!=""){
	  $encontre=$this->Buscar_Requisito($req_uc_asi[$i],"",$req_uc[$i]);
	  if($encontre==0){
		$this->Agregar_Requisito($req_uc_asi[$i],"",1,$req_uc[$i]);
 	      $accion='INSERTAR';//'$this->coh_id', '$this->mod_id', '$this->reg_id', '$this->esp_id', '$this->pen_top'
	      $Operacion="MOD: ".$this->mod_id." REG: ".$this->reg_id." ESP: ".$this->esp_id." COH: ".$this->coh_id." TI_PE".$this->pen_top." ASIG: ".$req_asi[$i]." UC_REQ: ".$req_uc[$i];
	      $this->guardar_accion($accion,"requis",$Operacion);
	  }
	  else{
		$this->Modificar_Requisito($req_uc_asi[$i],"",1,$req_uc[$i]);
 	      $accion='MODIFICAR';//'$this->coh_id', '$this->mod_id', '$this->reg_id', '$this->esp_id', '$this->pen_top'
	      $Operacion="MOD: ".$this->mod_id." REG: ".$this->reg_id." ESP: ".$this->esp_id." COH: ".$this->coh_id." TI_PE".$this->pen_top." ASIG: ".$req_asi[$i]." UC_REQ: ".$req_uc[$i];
	      $this->guardar_accion($accion,"requis",$Operacion);
	  }
	  $i++;
	}
	return 1;
  }
//****************************************************************************************************
  function Agregar_Requisito($asi_co,$asi_co_req,$asi_tip,$asi_uc){
    if($asi_uc==""){
/*echo "<script>alert('INSERT INTO requis (asi_cod, esp_id, reg_id, mod_id, coh_id, pen_top, asi_cod_req, esp_id_req, reg_id_req, mod_id_req, coh_id_req, pen_top_req, req_tip, req_sta) VALUES ($asi_co, $this->esp_id, $this->reg_id, $this->mod_id, $this->coh_id, $this->pen_top, $asi_co_req, $this->esp_id, $this->reg_id, $this->mod_id, $this->coh_id, $this->pen_top, $asi_tip, 1)');</script>";*/
	   $res=$this->Operacion("INSERT INTO requis (asi_cod, esp_id, reg_id, mod_id, coh_id, pen_top, asi_cod_req, esp_id_req, reg_id_req, mod_id_req, coh_id_req, pen_top_req, req_tip, req_sta) VALUES ('$asi_co', '$this->esp_id', '$this->reg_id', '$this->mod_id', '$this->coh_id', '$this->pen_top', '$asi_co_req', '$this->esp_id', '$this->reg_id', '$this->mod_id', '$this->coh_id', '$this->pen_top', '$asi_tip', '1')");
	 }
	 else{
/*echo "<script>alert('INSERT INTO requis (asi_cod, esp_id, reg_id, mod_id, coh_id, pen_top, req_tip, req_cuc, req_sta) VALUES ($asi_co, $this->esp_id, $this->reg_id, $this->mod_id, $this->coh_id, $this->pen_top, $asi_tip, '$asi_uc', 1)');</script>";*/
  	   $res=$this->Operacion("INSERT INTO requis (asi_cod, esp_id, reg_id, mod_id, coh_id, pen_top, req_tip, req_cuc, req_sta) VALUES ('$asi_co', '$this->esp_id', '$this->reg_id', '$this->mod_id', '$this->coh_id', '$this->pen_top', '$asi_tip', '$asi_uc', '1')");
	 }
     return $num_filas;
  }
//******************************************************************
  function Buscar_pensum($mod_id, $reg_id, $esp_id, $coh_id, $pen_top){
/*  echo "<script>alert('SELECT A.mod_id AS mod_id, B.mod_nom AS mod_nom, A.reg_id AS reg_id, C.reg_nom AS reg_nom, A.esp_id AS esp_id, D.esp_nom AS esp_nom, A.coh_id AS coh_id, E.coh_nom AS coh_nom, A.pen_top AS pen_top, A.pen_mpa AS pen_mpa, A.pen_muc AS pen_muc, A.pen_mpe AS pen_mpe, A.pen_obs AS pen_obs FROM pensum A, modali B, regimen C, especi D, cohort E WHERE A.mod_id=$mod_id AND A.mod_id=B.mod_id AND A.reg_id=$reg_id AND A.reg_id=C.reg_id AND A.esp_id=$esp_id AND A.esp_id=D.esp_id AND A.coh_id=$coh_id AND A.coh_id=E.coh_id AND A.pen_top=$pen_top');</script>";*/
    $this->Operacion("SELECT A.mod_id AS 'mod_id', B.mod_nom AS 'mod_nom', A.reg_id AS 'reg_id', C.reg_nom AS 'reg_nom', A.esp_id AS 'esp_id', D.esp_nom AS 'esp_nom', A.coh_id AS 'coh_id', E.coh_nom AS 'coh_nom', A.pen_top AS 'pen_top', A.pen_mpa AS 'pen_mpa', A.pen_muc AS 'pen_muc', A.pen_mpe AS 'pen_mpe', A.pen_obs AS 'pen_obs' FROM pensum A, modali B, regimen C, especi D, cohort E WHERE A.mod_id='$mod_id' AND A.mod_id=B.mod_id AND A.reg_id='$reg_id' AND A.reg_id=C.reg_id AND A.esp_id='$esp_id' AND A.esp_id=D.esp_id AND A.coh_id='$coh_id' AND A.coh_id=E.coh_id AND A.pen_top='$pen_top'");
  }
//******************************************************************
  function Buscar_asigna($cod_asig){
/*  echo "<script>alert('SELECT * FROM asigna WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND asi_cod=$cod_asig');</script>";*/
    $this->Operacion("SELECT * FROM asigna WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$cod_asig'");
    $num_filas=$this->NumFilas();
    return $num_filas;
 }
//******************************************************************
  function Buscar_asi_mod($mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$cod_asig){
/*  echo "<script>alert('SELECT * FROM asigna WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND asi_cod=$cod_asig');</script>";*/
    $res=$this->OperacionCualquiera("SELECT * FROM asigna WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND asi_cod='$cod_asig'");
    $array=$this->ConsultarCualquiera($res);
    return $array->asi_mod;
 }
//******************************************************************
  function Buscar_Requisito($cod_asig,$cod_asig_req,$uc){
/*  echo "<script>alert('SELECT * FROM asigna WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND asi_cod=$cod_asig');</script>";*/
    if($cod_asig_req!="")
      $this->Operacion("SELECT * FROM requis WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$cod_asig' AND asi_cod_req='$cod_asig_req'");
	else
	  $this->Operacion("SELECT * FROM requis WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$cod_asig'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }   
//******************************************************************
  function Buscar_mod($id){
    $this->Operacion("SELECT * FROM modali WHERE mod_id='$id'");
  }
//******************************************************************
  function Modificar_pensum(){
/*echo "<script>alert('UPDATE pensum set pen_obs=$this->obs, pen_mpa=$this->pen_mpa, pen_muc=$this->pen_muc, pen_mpe=$this->pen_mpe WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top');</script>";*/
//    $this->Eliminar_Requisito_Todos();
    $this->Eliminar_asigna_todo();
    $res=$this->Operacion("UPDATE pensum set pen_obs='$this->obs', pen_mpa='$this->pen_mpa', pen_muc='$this->pen_muc', pen_mpe='$this->pen_mpe' WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top'");
    $num_filas=$this->filas_afectadas($res);
/*	echo "<script>alert('NUMERO DE FILAS $num_filas');</script>";*/
	  $dat_asi=explode("@",$this->asigna);
	  $asi_st=explode("*",$dat_asi[0]);//"asi_st*".$i;
	  $asi_co=explode("*",$dat_asi[1]);//"asi_co*".$i;
	  $asi_ma=explode("*",$dat_asi[2]);//"asi_ma*".$i;
	  $asi_tip=explode("*",$dat_asi[3]);//"asi_ma*".$i;
	  $asi_cb=explode("*",$dat_asi[4]);//"asi_cb*".$i;
	  $asi_rep=explode("*",$dat_asi[5]);//"asi_rep*".$i;
	  $asi_lab=explode("*",$dat_asi[6]);//"asi_lab*".$i;
	  $asi_uc=explode("*",$dat_asi[7]);//"asi_uc*".$i;
	  $asi_ht=explode("*",$dat_asi[8]);//"asi_ht*".$i;
	  $asi_hp=explode("*",$dat_asi[9]);//"asi_hp*".$i;
	  $asi_hl=explode("*",$dat_asi[10]);//"asi_hl*".$i;
	  $asi_obs=explode("*",$dat_asi[11]);//"asi_obs*".$i;
	  $i=0;
	  $band=0;
	  while($asi_st[$i]!=""){
/*        echo "<script>alert('Asigna: $asi_st[$i],$asi_co[$i],$asi_ma[$i],$asi_tip[$i],$asi_cb[$i],$asi_rep[$i],$asi_lab[$i],$asi_uc[$i],$asi_ht[$i],$asi_hp[$i],$asi_hl[$i],$asi_obs[$i]');</script>";*/
	    $fil=$this->Buscar_asigna($asi_co[$i]);
/*		echo "<script>alert('FILAS ENCONTRADAS $fil');</script>";*/
		if($fil>0){
/*    	  echo "<script>alert('MODIFICAR');</script>";*/
	      $num_filas=$this->Modificar_asigna($asi_st[$i],$asi_co[$i],$asi_ma[$i],$asi_tip[$i],$asi_cb[$i],$asi_rep[$i],$asi_lab[$i],$asi_uc[$i],$asi_ht[$i],$asi_hp[$i],$asi_hl[$i],$asi_obs[$i]);
		  if($num_filas>0){
  	        $accion='MODIFICAR';
	        $Operacion="MOD: ".$this->mod_id." REG: ".$this->reg_id." ESP: ".$this->esp_id." COH: ".$this->coh_id." TI_PE".$this->pen_top." ASIG: ".$asi_co[$i];	
	        $this->guardar_accion($accion,"asigna",$Operacion);
		  }
		}
		else{
/*    	  echo "<script>alert('AGREGAR');</script>";*/
	      $num_filas=$this->Agregar_asigna($asi_st[$i],$asi_co[$i],$asi_ma[$i],$asi_tip[$i],$asi_cb[$i],$asi_rep[$i],$asi_lab[$i],$asi_uc[$i],$asi_ht[$i],$asi_hp[$i],$asi_hl[$i],$asi_obs[$i]);
		  if($num_filas>0){
  	        $accion='INSERTAR';
	        $Operacion="MOD: ".$this->mod_id." REG: ".$this->reg_id." ESP: ".$this->esp_id." COH: ".$this->coh_id." TI_PE".$this->pen_top." ASIG: ".$asi_co[$i];
	        $this->guardar_accion($accion,"asigna",$Operacion);
		  }
		}
/*        echo "<script>alert('Filas OJO: $num_filas');</script>";*/
	    $band++;
		$i++;
	  }
    return 1;
  }
//****************************************************************************************************
 function Modificar_asigna($asi_st,$asi_co,$asi_ma,$asi_tip,$asi_cb,$asi_rep,$asi_lab,$asi_uc,$asi_ht,$asi_hp,$asi_hl,$asi_obs){
/* echo "<script>alert('UPDATE asigna set tip_id=$asi_tip, asi_nom=$asi_ma, asi_des=$asi_obs, asi_mod=$asi_st, asi_lab=$asi_lab, asi_cuc=$asi_uc, asi_chp=$asi_hp, asi_cht=$asi_ht, asi_chl=$asi_hl, asi_sta=1, asi_cba=$asi_cb, asi_rep=$asi_rep WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND asi_cod=$asi_co');</script>";*/
   $res=$this->Operacion("UPDATE asigna set tip_id='$asi_tip', asi_nom='$asi_ma', asi_des='$asi_obs', asi_mod='$asi_st', asi_lab='$asi_lab', asi_cuc='$asi_uc', asi_chp='$asi_hp', asi_cht='$asi_ht', asi_chl='$asi_hl', asi_sta='1', asi_cba='$asi_cb', asi_rep='$asi_rep' WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$asi_co'");
   $num_filas=$this->filas_afectadas($res);
   return $num_filas;
 }
//****************************************************************************************************
  function Modificar_Requisito($asi_co,$asi_co_req,$asi_tip,$asi_uc){
/* echo "<script>alert('UPDATE requis set req_tip=$asi_tip, req_cuc=$asi_uc, req_sta=1 WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND asi_cod=$asi_co AND asi_cod_req=$asi_co_req');</script>";*/
    if($asi_uc=="")
      $res=$this->Operacion("UPDATE requis set req_sta='1', req_tip='$asi_tip' WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$asi_co' AND asi_cod_req='$asi_co_req'");
    else
      $res=$this->Operacion("UPDATE requis set req_cuc='$asi_uc', req_tip='$asi_tip', req_sta='1' WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$asi_co'");
     $num_filas=$this->filas_afectadas($res);
     return $num_filas;
  }
//******************************************************************
  function Eliminar_pensum(){
    $res=$this->Operacion("UPDATE pensum set pen_sta='$this->sta' WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top'");
    $num_filas=$this->filas_afectadas($res);	
	if($num_filas>0){
	  $num_filas=$this->Eliminar_asigna_todo();
  	  $accion='ELIMINAR';
	  $Operacion="MOD: ".$this->mod_id." REG: ".$this->reg_id." ESP: ".$this->esp_id." COH: ".$this->coh_id." TI_PE".$this->pen_top;	
	  $this->guardar_accion($accion,"asigna",$Operacion);
	}
    return 1;
  }
//******************************************************************
  function Eliminar_asigna_todo(){
/*   echo "<script>alert('UPDATE asigna set asi_sta=$this->sta WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top='$this->pen_top' AND asi_cod=$asi_co');</script>";*/
    $res=$this->Operacion("UPDATE asigna set asi_sta='0' WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_asigna($asi_co){
/*   echo "<script>alert('UPDATE asigna set asi_sta=$this->sta WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top='$this->pen_top' AND asi_cod=$asi_co');</script>";*/
   $res=$this->Operacion("UPDATE asigna set asi_sta='$this->sta' WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$asi_co'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//****************************************************************************************************
 function Eliminar_Requisito_Todos(){
/* echo "<script>alert('UPDATE requis set req_tip=$asi_tip, req_cuc=$asi_uc, req_sta=1 WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND asi_cod=$asi_co AND asi_cod_req=$asi_co_req');</script>";*/
   $res=$this->Operacion("UPDATE requis set req_sta='0' WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top'");
   $num_filas=$this->filas_afectadas($res);
   return $num_filas;
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