<?php session_start();
class camb extends conec_BD
{
//******************************************************************
  function busc_alum($ci){
  $alum=$this->OperacionCualquiera("SELECT B.no1 AS no1,B.no2 AS no2 ,B.ap1 AS ap1,B.ap2 AS ap2 ,A.esp_id AS esp_id ,F.esp_nom AS esp_nom ,A.reg_id AS reg_id ,D.reg_nom AS reg_nom ,A.mod_id AS mod_id ,C.mod_nom AS mod_nom ,A.coh_id AS coh_id ,E.coh_nom AS coh_nom ,A.pen_top AS pen_top, A.matr_sta AS matr_sta FROM matric A ,persona B ,modali C ,regimen D ,cohort E ,especi F WHERE A.ci='$ci' AND matr_sta=1 AND matr_tip='0' AND A.ci=B.ci AND A.mod_id=C.mod_id AND A.reg_id=D.reg_id AND A.coh_id=E.coh_id AND A.esp_id=F.esp_id");
    if($this->NumFilas1($alum)>0){
	return $alum;
    }
	else
	{
	$busc_mat=$this->OperacionCualquiera("SELECT B.coh_id AS coh_id, B.mod_id AS mod_id, B.reg_id AS reg_id, B.esp_id AS esp_id, B.pen_top AS pen_top FROM pacade A,detins B WHERE A.pac_id=B.pac_id AND B.ci_est='$ci' AND A.mod_id=B.mod_id AND B.det_sta='1' GROUP BY B.coh_id, B.mod_id, B.reg_id, B.esp_id, B.pen_top, A.pac_id, B.ci_est ORDER BY pac_fin DESC");	
	$mat_enc=$this->ConsultarCualquiera($busc_mat);
	/*echo "<script>alert('$mat_enc->coh_id,$mat_enc->mod_id,$mat_enc->reg_id,$mat_enc->esp_id, $mat_enc->pen_top')</script>";*/
	$alum1=$this->OperacionCualquiera("SELECT B.no1 AS no1,B.no2 AS no2 ,B.ap1 AS ap1,B.ap2 AS ap2 ,A.esp_id AS esp_id ,F.esp_nom AS esp_nom ,A.reg_id AS reg_id ,D.reg_nom AS reg_nom ,A.mod_id AS mod_id ,C.mod_nom AS mod_nom ,A.coh_id AS coh_id ,E.coh_nom AS coh_nom ,A.pen_top AS pen_top, A.matr_sta AS matr_sta FROM matric A ,persona B ,modali C ,regimen D ,cohort E ,especi F WHERE A.ci='$ci' AND matr_sta=0 AND A.ci=B.ci AND A.mod_id=C.mod_id AND A.reg_id=D.reg_id AND A.coh_id=E.coh_id AND A.esp_id=F.esp_id AND A.mod_id='$mat_enc->mod_id' AND A.reg_id='$mat_enc->reg_id' AND A.esp_id='$mat_enc->esp_id' AND A.coh_id='$mat_enc->coh_id' AND A.pen_top='$mat_enc->pen_top'");
	return $alum1;
	}
  }
//******************************************************************
  function activ_matric($data_princ,$mod_id_sol,$reg_id_sol,$esp_id_sol,$coh_id_sol,$pen_top_sol,$fec_sol,$num_sol,$descrip,$observ,$ci_emp){
  $data=explode("*",$data_princ);
    if($descrip="CAMB CARRERA"){
    $pro_id="9";
    }
    else{
      if($descrip=="CAMB ESPEC"){
      $pro_id="9";
      }
      if($descrip=="CAMB REGIMEN"){
      $pro_id="8";
      }
      if($descrip=="EQUIVALENCIA"){
      $pro_id="11";
      }
      if($descrip=="REINGRESO"){
      $pro_id="3";
      }
    }
  $mat_act=$data[1]."*".$data[4]."*".$data[2]."*".$data[3]."*".$data[5];
  $mat_nueva=$mod_id_sol."*".$reg_id_sol."*".$esp_id_sol."*".$coh_id_sol."*".$pen_top_sol; 
	if($mat_act==$mat_nueva && $data[6]==0){
	$this->Operacion("UPDATE matric SET matr_sta='1' WHERE ci='$data[0]' AND mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol' AND matr_tip='0' AND matr_sta='0'");
	$accion='MODIFICAR';
    $Operacion="ACTIVAR MATRIC EST: CI: ".$data[0]." MOD: ".$mod_id_sol.", REG:".$reg_id_sol.", ESP:".$esp_id_sol.", COH:".$coh_id_sol.", PEN: ".$pen_top_sol;
	$this->guardar_accion($accion,"matric",$Operacion);
	}  
	else{
	  if($mat_act!=$mat_nueva && $data[6]==0){
/*echo "<script>alert('SELECT * FROM matric WHERE ci=$data[0] AND mod_id=$mod_id_sol AND reg_id=$reg_id_sol AND esp_id=$esp_id_sol AND coh_id=$coh_id_sol AND pen_top=$pen_top_sol AND matr_tip=0');</script>";*/
	    $this->Operacion("SELECT * FROM matric WHERE ci='$data[0]' AND mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol'");
	    if($this->NumFilas1($this->resul)>0){
		$cons_mat=$this->OperacionCualquiera("SELECT * FROM matric WHERE ci='$data[0]' AND mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol' AND matr_sta='0'");
		  if($this->NumFilas1($cons_mat)>0){
/*			echo "<script>alert('UPDATE matric SET matr_sta=1 WHERE ci=$data[0] AND mod_id=$mod_id_sol AND reg_id=$reg_id_sol AND esp_id=$esp_id_sol AND coh_id=$coh_id_sol AND pen_top=$pen_top_sol AND matr_sta=0 AND matr_tip=0');</script>";*/
	      $this->Operacion("UPDATE matric SET matr_sta='1' WHERE ci='$data[0]' AND mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol' AND matr_sta='0' AND matr_tip='0'");
	    $accion='MODIFICAR';
        $Operacion="ACTIVAR MATRIC EST: CI: ".$data[0]." MOD: ".$mod_id_sol.", REG:".$reg_id_sol.", ESP:".$esp_id_sol.", COH:".$coh_id_sol.", PEN: ".$pen_top_sol;
	    $this->guardar_accion($accion,"matric",$Operacion);
	      }
		}
	    else{
	    $this->Operacion("INSERT INTO matric (ci,esp_id,reg_id,mod_id,coh_id,pen_top,matr_tip,matr_sta) values ('$data[0]','$esp_id_sol','$reg_id_sol','$mod_id_sol','$coh_id_sol','$pen_top_sol','0','1')");
	    $accion='INSERTAR';
        $Operacion="AGREGAR MATRIC NUEVA EST: CI: ".$data[0]." MOD: ".$mod_id_sol.", REG:".$reg_id_sol.", ESP:".$esp_id_sol.", COH:".$coh_id_sol.", PEN: ".$pen_top_sol;
        $this->guardar_accion($accion,"matric",$Operacion);
	    }
	  }
	  if($mat_act!=$mat_nueva && $data[6]==1){
	  $this->Operacion("UPDATE matric SET matr_sta='0' WHERE ci='$data[0]' AND mod_id='$data[1]' AND reg_id='$data[4]' AND esp_id='$data[2]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND matr_sta='1' AND matr_tip='0'");    
	  $accion='ELIMINAR';
      $Operacion="DESACTIVAR MATRIC EST: CI: ".$data[0]." MOD: ".$data[1].", REG:".$data[4].", ESP:".$data[2].", COH:".$data[3].", PEN: ".$data[5];
	  $this->guardar_accion($accion,"matric",$Operacion);		
	  $this->Operacion("SELECT * FROM matric WHERE ci='$data[0]' AND mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol'");
	    if($this->NumFilas1($this->resul)>0){
		  $cons_mat=$this->OperacionCualquiera("SELECT * FROM matric WHERE ci='$data[0]' AND mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol' AND matr_sta='0'");
		  if($this->NumFilas1($cons_mat)>0){
/*			echo "<script>alert('UPDATE matric SET matr_sta=1 WHERE ci=$data[0] AND mod_id=$mod_id_sol AND reg_id=$reg_id_sol AND esp_id=$esp_id_sol AND coh_id=$coh_id_sol AND pen_top=$pen_top_sol AND matr_sta=0 AND matr_tip=0');</script>";*/
	    $this->Operacion("UPDATE matric SET matr_sta='1' WHERE ci='$data[0]' AND mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol' AND matr_sta='0' AND matr_tip='0'");
	    $accion='MODIFICAR';
        $Operacion="ACTIVAR MATRIC EST: CI: ".$data[0]." MOD: ".$mod_id_sol.", REG:".$reg_id_sol.", ESP:".$esp_id_sol.", COH:".$coh_id_sol.", PEN: ".$pen_top_sol;
	    $this->guardar_accion($accion,"matric",$Operacion);
		  }
		}
	    else{
		$this->Operacion("INSERT INTO matric (ci,esp_id,reg_id,mod_id,coh_id,pen_top,matr_tip,matr_sta) values ('$data[0]','$esp_id_sol','$reg_id_sol','$mod_id_sol','$coh_id_sol','$pen_top_sol','0','1')");
		$accion='INSERTAR';
        $Operacion="AGREGAR MATRIC EST: CI: ".$data[0].", MOD: ".$mod_id_sol.", REG:".$reg_id_sol.", ESP:".$esp_id_sol.", COH:".$coh_id_sol.", PEN: ".$pen_top_sol;
	    $this->guardar_accion($accion,"matric",$Operacion);
		}
	  }
	}
  }
//******************************************************************
  function inf_id_alum($ci,$matr_sta){
    if($matr_sta==0){
    $consul=$this->OperacionCualquiera("SELECT inf_id FROM estudi_infrae WHERE ci='$ci' ORDER BY est_inf_ffi DESC");
	}
    else{
    $consul=$this->OperacionCualquiera("SELECT inf_id FROM estudi_infrae WHERE ci='$ci' AND est_inf_ffi='0000-00-00 00:00:00'");
    }
  return $consul;
  }
//******************************************************************
  /*function busc_inf_alum($data_princ,$inf_id_sol){
  $data=explode("*",$data_princ);
  $dias=time();
  $fecha=date("Y-m-d",$dias);
	if($data[7]==$inf_id_sol and $data[6]==0){
	$this->Operacion("UPDATE estudi_infrae SET est_inf_ffi='' WHERE ci='$data[0]' AND inf_id='$inf_id_sol'");
	$accion='MODIFICAR';
    $Operacion="ACTIVAR INFRAESTRUCTURA DEL EST: CI: ".$data[0].", INF: ".$inf_id_sol;
	$this->guardar_accion($accion,"estudi_infrae",$Operacion);	
	}
	else{
	  if($data[7]!=$inf_id_sol && $data[6]==0){
	  $this->Operacion("SELECT inf_id FROM estudi_infrae where ci='$data[0]' AND inf_id='$inf_id_sol'");
	    if($this->NumFilas1($this->resul)==1){
		 $infra=$this->OperacionCualquiera("SELECT inf_id FROM estudi_infrae where ci='$data[0]' AND inf_id='$inf_id_sol' AND est_inf_ffi!=''");
		  if($this->NumFilas1($infra)==1){ 
	    $this->Operacion("UPDATE estudi_infrae SET est_inf_ffi='' WHERE ci='$data[0]' AND inf_id='$inf_id_sol'");
        $accion='MODIFICAR';
        $Operacion="ACTIVAR INFRAESTRUCTURA DEL EST: CI: ".$data[0].", INF: ".$inf_id_sol;
	    $this->guardar_accion($accion,"estudi_infrae",$Operacion);	
		  }
		}
        else{
	    $this->Operacion("INSERT INTO estudi_infrae (inf_id,est_inf_fin,ci) value ('$inf_id_sol','$fecha','$data[0]')");
		$accion='INSERTAR';
        $Operacion="AGREGAR INFRAESTRUCTURA DEL EST: CI: ".$data[0].", INF: ".$inf_id_sol;
	    $this->guardar_accion($accion,"estudi_infrae",$Operacion);
	    }
	  }
	  if($data[7]!=$inf_id_sol && $data[6]==1){
	  $this->Operacion("UPDATE estudi_infrae SET est_inf_ffi='$fecha' WHERE ci='$data[0]' AND inf_id='$data[7]'");
	  $accion='ELIMINAR';
      $Operacion="DESACTIVAR INFRAESTRUCTURA DEL EST: CI: ".$data[0].", INF: ".$data[7];
	  $this->guardar_accion($accion,"estudi_infrae",$Operacion);	
	  $this->Operacion("SELECT inf_id FROM estudi_infrae where ci='$data[0]' AND inf_id='$inf_id_sol'");
	    if($this->NumFilas1($this->resul)==1){
	    $infra=$this->OperacionCualquiera("SELECT inf_id FROM estudi_infrae where ci='$data[0]' AND inf_id='$inf_id_sol' AND est_inf_ffi!=''");
		  if($this->NumFilas1($infra)==1){
	      $this->Operacion("UPDATE estudi_infrae SET est_inf_ffi='' WHERE ci='$data[0]' AND inf_id='$inf_id_sol'");
        $accion='MODIFICAR';
        $Operacion="ACTIVAR INFRAESTRUCTURA DEL EST: CI: ".$data[0].", INF: ".$inf_id_sol;
	    $this->guardar_accion($accion,"estudi_infrae",$Operacion);
		  }
	    }
        else{
	    $this->Operacion("INSERT INTO estudi_infrae (inf_id,est_inf_fin,ci) value ('$inf_id_sol','$fecha','$data[0]')");
		$accion='INSERTAR';
        $Operacion="AGREGAR INFRAESTRUCTURA DEL EST: CI: ".$data[0].", INF: ".$inf_id_sol;
	    $this->guardar_accion($accion,"estudi_infrae",$Operacion);	
		}
	  }
	}
  }*/
  function busc_inf_alum($data_princ,$inf_id_sol){
  $data=explode("*",$data_princ);
  $dias=time();
  $fecha=date("Y-m-d",$dias);
	if($data[7]==$inf_id_sol and $data[6]==0){
	$this->Operacion("INSERT INTO estudi_infrae (inf_id,est_inf_fin,ci) value ('$inf_id_sol','$fecha','$data[0]')");
	$accion='INSERTAR';
    $Operacion="AGREGAR INFRAESTRUCTURA DEL EST: CI: ".$data[0].", INF: ".$inf_id_sol;
	$this->guardar_accion($accion,"estudi_infrae",$Operacion);	
	}
	else{
	  if($data[7]!=$inf_id_sol && $data[6]==0){
	  $this->Operacion("SELECT inf_id FROM estudi_infrae where ci='$data[0]' AND inf_id='$inf_id_sol'");
	    if($this->NumFilas1($this->resul)>0){
		 $infra=$this->OperacionCualquiera("SELECT inf_id FROM estudi_infrae where ci='$data[0]' AND inf_id='$inf_id_sol' AND est_inf_ffi!='0000-00-00 00:00:00'");
		  if($this->NumFilas1($infra)>0){ 
	      $this->Operacion("INSERT INTO estudi_infrae (inf_id,est_inf_fin,ci) value ('$inf_id_sol','$fecha','$data[0]')");
        $accion='INSERTAR';
        $Operacion="AGREGAR INFRAESTRUCTURA DEL EST: CI: ".$data[0].", INF: ".$inf_id_sol;
	    $this->guardar_accion($accion,"estudi_infrae",$Operacion);	
		  }
		}
        else{
	    $this->Operacion("INSERT INTO estudi_infrae (inf_id,est_inf_fin,ci) value ('$inf_id_sol','$fecha','$data[0]')");
		$accion='INSERTAR';
        $Operacion="AGREGAR INFRAESTRUCTURA DEL EST: CI: ".$data[0].", INF: ".$inf_id_sol;
	    $this->guardar_accion($accion,"estudi_infrae",$Operacion);
	    }
	  }
	  if($data[7]!=$inf_id_sol && $data[6]==1){
	  $this->Operacion("UPDATE estudi_infrae SET est_inf_ffi='$fecha' WHERE ci='$data[0]' AND inf_id='$data[7]'");
	    $accion='ELIMINAR';
        $Operacion="DESACTIVAR INFRAESTRUCTURA DEL EST: CI: ".$data[0].", INF: ".$data[7];
	    $this->guardar_accion($accion,"estudi_infrae",$Operacion);	
	  $this->Operacion("SELECT inf_id FROM estudi_infrae where ci='$data[0]' AND inf_id='$inf_id_sol'");
	    if($this->NumFilas1($this->resul)>0){
	    $infra=$this->OperacionCualquiera("SELECT inf_id FROM estudi_infrae where ci='$data[0]' AND inf_id='$inf_id_sol' AND est_inf_ffi!='0000-00-00 00:00:00'");
		  if($this->NumFilas1($infra)>0){
	      $this->Operacion("INSERT INTO estudi_infrae (inf_id,est_inf_fin,ci) values ('$inf_id_sol','$fecha','$data[0]')");
          $accion='INSERTAR';
          $Operacion="AGREGAR INFRAESTRUCTURA DEL EST: CI: ".$data[0].", INF: ".$inf_id_sol;
	      $this->guardar_accion($accion,"estudi_infrae",$Operacion);
		  }
	    }
        else{
	    $this->Operacion("INSERT INTO estudi_infrae (inf_id,est_inf_fin,ci) values ('$inf_id_sol','$fecha','$data[0]')");
		$accion='INSERTAR';
        $Operacion="AGREGAR INFRAESTRUCTURA DEL EST: CI: ".$data[0].", INF: ".$inf_id_sol;
	    $this->guardar_accion($accion,"estudi_infrae",$Operacion);	
		}
	  }
	}
  }
//******************************************************************
  function busc_tip_pen($mod_id,$reg_id,$esp_id,$coh_id){
  $id="";
  $des="";
  $cuantos=0;
  $array=$this->Operacion("SELECT pen_top FROM pensum WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_sta='1' GROUP BY pen_top ORDER BY pen_top");
  return $array;
  }
//******************************************************************
  function List_modali_carre($esp_nom){//se agrego AND rem_sta='1' AND esp_sta='1'
	$esp_nom=explode(" ",$esp_nom);
    $resultado=$this->Operacion("SELECT A.mod_id AS 'mod_id', A.mod_nom AS 'mod_nom' FROM modali A, reg_esp_mod B, especi C  WHERE A.mod_sta='1' AND rem_sta='1' AND esp_sta='1' AND A.mod_id=B.mod_id AND C.esp_id NOT IN (SELECT esp_id FROM especi WHERE esp_nom LIKE '$esp_nom[0]%') AND C.esp_id=B.esp_id GROUP BY A.mod_id ORDER BY A.mod_nom");
    return $resultado;
  }
//******************************************************************
  function List_modali(){
    $resultado=$this->Operacion("SELECT A.mod_id AS 'mod_id', A.mod_nom AS 'mod_nom' FROM modali A, reg_esp_mod B  WHERE A.mod_sta='1' AND A.mod_id=B.mod_id GROUP BY A.mod_id ORDER BY A.mod_nom");
    return $resultado;
  }
//******************************************************************
  function Buscar_Campos1($valor,$cual){// se agrego AND reg_sta='1'
    $id="";
	$des="";
	$cuantos=0;
	$this->mod_id=$valor;
    $resp=$this->OperacionCualquiera("SELECT A.reg_id AS 'reg_id', B.reg_nom AS 'reg_nom' FROM reg_esp_mod A, regimen B WHERE rem_sta='1' AND reg_sta='1' AND A.mod_id='$valor' AND A.reg_id=B.reg_id GROUP BY A.reg_id ORDER BY B.reg_nom");
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
  function Buscar_Campos2($valor,$cual){//se agrego AND esp_sta='1'
    $id="";
	$des="";
	$cuantos=0;
	$val=explode("*",$valor);
	$this->reg_id=$val[0];
	$this->mod_id=$val[1];
	$resp=$this->OperacionCualquiera("SELECT A.esp_id AS 'esp_id', B.esp_nom AS 'esp_nom' FROM reg_esp_mod A, especi B WHERE rem_sta='1' AND esp_sta='1' AND A.mod_id='$this->mod_id' AND A.reg_id='$val[0]' AND A.esp_id=B.esp_id GROUP BY A.esp_id ORDER BY B.esp_nom");
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
   function Buscar_Campos3($valor,$cual){//se agrego AND coh_sta='1'
    $id="";
	$des="";
	$cuantos=0;
	$val=explode("*",$valor);
	$this->esp_id=$val[0];
	$this->reg_id=$val[1];
	$this->mod_id=$val[2];
	$resp=$this->OperacionCualquiera("SELECT A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom' FROM pensum A, cohort B WHERE pen_sta='1' AND coh_sta='1' AND A.mod_id='$this->mod_id' AND A.reg_id='$this->reg_id' AND A.esp_id='$val[0]' AND A.coh_id=B.coh_id GROUP BY A.coh_id ORDER BY B.coh_nom");
	while($array=$this->ConsultarCualquiera($resp)){
	  if($id==""){
	    $id=$array->coh_id;
	    $des=$array->coh_nom;
	  }
	  else{
	    $id=$id."*".$array->coh_id;
	    $des=$des."*".$array->coh_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_Campos4($valor,$cual){
    $id="";
	$des="";
	$cuantos=0;
	$val=explode("*",$valor);
	$this->coh_id=$val[0];
	$this->esp_id=$val[1];
	$this->reg_id=$val[2];
	$this->mod_id=$val[3];
	$resp=$this->OperacionCualquiera("SELECT A.pen_top AS 'pen_top' FROM pensum A WHERE pen_sta='1' AND A.mod_id='$this->mod_id' AND A.reg_id='$this->reg_id' AND A.esp_id='$this->esp_id' AND A.coh_id='$val[0]' GROUP BY A.pen_top ORDER BY A.pen_top");
	while($array=$this->ConsultarCualquiera($resp)){
	  if($id==""){
	  $id=$array->pen_top;
		  if($array->pen_top==0)
	      $des="PASANTIAS";
		  else
		  $des="TRABAJO ESPECIAL DE GRADO";
	  }
	  else{
	    $id=$id."*".$array->pen_top;
		  if($array->pen_top==0)
	      $des=$des."*"."PASANTIAS";
		  else
		  $des=$des."*"."TRABAJO ESPECIAL DE GRADO";
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_Campos5($valor,$cual){//se agrego AND inf_sta='1'
    $id="";
	$des="";
	$cuantos=0;
	$val=explode("*",$valor);
	$this->esp_id=$val[0];
	$this->reg_id=$val[1];
	$this->mod_id=$val[2];
	$resp=$this->OperacionCualquiera("SELECT B.inf_id AS inf_id, B.inf_nom AS inf_nom FROM reg_esp_mod_infrae A, infrae B WHERE A.mod_id='$this->mod_id' AND A.reg_id='$this->reg_id' AND A.esp_id='$this->esp_id' AND A.inf_id=B.inf_id AND A.remi_sta='1' AND inf_sta='1' GROUP BY inf_id ORDER BY inf_nom");
	while($array=$this->ConsultarCualquiera($resp)){
	  if($id==""){
	    $id=$array->inf_id;
	    $des=$array->inf_nom;
	  }
	  else{
	    $id=$id."*".$array->inf_id;
	    $des=$des."*".$array->inf_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_Campos6($valor,$cual){//AND esp_sta='1'
    $id="";
	$des="";
	$cuantos=0;
	$valor1=explode("*",$valor);
	$this->mod_id=$valor1[0];
	$this->reg_id=$valor1[1];
	$this->esp_id=$valor1[2];
	$esp_nom=substr($valor1[3],0,4);
	$this->coh_id=$valor1[4];
	  if($esp_nom=="INGE"){
	  $resp=$this->OperacionCualquiera("SELECT A.mod_id,A.reg_id,A.esp_id AS 'esp_id', B.esp_nom AS 'esp_nom',A.coh_id FROM pensum A, especi B WHERE pen_sta='1' AND esp_sta='1' AND A.mod_id='$this->mod_id' AND A.reg_id='$this->reg_id' AND A.esp_id=B.esp_id AND B.esp_nom!='$valor1[3]' AND B.esp_nom LIKE '$esp_nom%' AND A.coh_id='$this->coh_id' GROUP BY B.esp_id ORDER BY B.esp_nom");
	  }
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
  function Buscar_Campos7($valor,$cual){
    $id="";
	$des="";
	$cuantos=0;
	$valor1=explode("*",$valor);
	$this->mod_id=$valor1[0];
	$this->reg_id=$valor1[1];
	$this->esp_id=$valor1[2];
	$this->coh_id=$valor1[3];
	$resp=$this->OperacionCualquiera("SELECT A.pen_top AS 'pen_top' FROM pensum A WHERE pen_sta='1' AND A.mod_id='$this->mod_id' AND A.reg_id='$this->reg_id' AND A.esp_id='$this->esp_id' AND A.coh_id='$this->coh_id' GROUP BY A.pen_top ORDER BY A.pen_top");
	while($array=$this->ConsultarCualquiera($resp)){
	  if($id==""){
	    if($array->pen_top=='0'){
	    $id="0";
	    $des="PASANTIAS";
		}
		else{
		$id="1";
		$des="TRABAJO ESPECIAL DE GRADO";
		}
	  }
	  else{
	    if($array->pen_top=='0'){
	    $id=$id."*0";
	    $des=$des."*PASANTIAS";
		}
		else{
		$id=$id."*1";
		$des=$des."*TRABAJO ESPECIAL DE GRADO";
		}
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
function Buscar_Campos8($valor,$cual){//se agrego AND B.rem_sta='1' AND C.esp_sta='1'
    $id="";
	$des="";
	$cuantos=0;
	$valor1=explode("*",$valor);
	$this->mod_id=$valor1[0];
	$esp_nom=substr($valor1[1],0,4);
	$resp=$this->OperacionCualquiera("SELECT A.reg_id AS 'reg_id', A.reg_nom AS 'reg_nom' FROM regimen A, reg_esp_mod B, especi C WHERE A.reg_sta='1' AND B.rem_sta='1' AND C.esp_sta='1' AND C.esp_id NOT IN (SELECT esp_id FROM especi WHERE esp_nom LIKE '$esp_nom%') AND B.esp_id=C.esp_id AND B.mod_id='$this->mod_id' AND A.reg_id=B.reg_id GROUP BY B.reg_id ORDER BY reg_nom");
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
function Buscar_Campos9($valor,$cual){
    $id="";
	$des="";
	$cuantos=0;
	$valor1=explode("*",$valor);
	$this->mod_id=$valor1[0];
	$this->reg_id=$valor1[1];
	$esp_nom=substr($valor1[2],0,4);
	$this->esp_id_act=$valor1[3];
	  if($esp_nom=="INGE"){
	  $resp=$this->OperacionCualquiera("SELECT A.esp_id AS 'esp_id', A.esp_nom AS 'esp_nom' FROM especi A, reg_esp_mod B WHERE A.esp_sta='1' AND B.rem_sta='1' AND A.esp_id NOT IN (SELECT esp_id FROM especi WHERE esp_nom LIKE ('$esp_nom%')) AND A.esp_id=B.esp_id AND B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' ORDER BY A.esp_nom");//se agrego  AND B.rem_sta='1'
	  }
	  else{
	  $resp=$this->OperacionCualquiera("SELECT A.esp_id AS 'esp_id', A.esp_nom AS 'esp_nom' FROM especi A, reg_esp_mod B WHERE A.esp_sta='1' AND B.rem_sta='1' AND A.esp_id!='$this->esp_id_act' AND A.esp_id=B.esp_id AND B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' GROUP BY A.esp_id ORDER BY A.esp_nom");//se agrego AND B.rem_sta='1'
	  }
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
function Buscar_Campos10($valor,$cual){//se agrego AND B.rem_sta='1' AND mod_sta='1' AND reg_sta='1'
    $id="";
	$des="";
	$cuantos=0;
	$valor1=explode("*",$valor);
	$this->mod_id=$valor1[0];
	$this->reg_id=$valor1[1];
	$this->esp_id=$valor1[2];
	$esp_id1=substr($valor1[2],0,4);
	$resp=$this->OperacionCualquiera("SELECT A.esp_id AS 'esp_id', A.esp_nom AS 'esp_nom' FROM especi A, reg_esp_mod B,modali C, regimen D WHERE A.esp_sta=1 AND B.rem_sta='1' AND mod_sta='1' AND reg_sta='1' AND A.esp_id LIKE '$esp_id1%' AND A.esp_id!='$this->esp_id' AND A.esp_id=B.esp_id AND B.mod_id='$this->mod_id' AND B.mod_id=C.mod_id AND B.reg_id='$this->reg_id' AND B.reg_id=D.reg_id GROUP BY A.esp_id ORDER BY A.esp_id");
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
  function Buscar_reg_especi($valor){//se agrego  AND B.coh_sta='1' AND C.reg_sta='1' AND D.esp_sta='1'
    $id="";
	$des="";
	$cuantos=0;
	$valor=explode("*",$valor);
	$this->mod_id=$valor[0];
	$this->esp_id=$valor[1];
	$esp_nom=explode(" ",$valor[2]);
	$this->coh_id=$valor[3];	
	$resp=$this->OperacionCualquiera("SELECT  A.reg_id AS 'reg_id', C.reg_nom AS 'reg_nom' FROM pensum A,cohort B, regimen C, especi D WHERE A.pen_sta='1' AND B.coh_sta='1' AND C.reg_sta='1' AND D.esp_sta='1' AND A.mod_id='$this->mod_id' AND A.esp_id!='$this->esp_id' AND A.coh_id='$this->coh_id' AND A.reg_id=C.reg_id AND A.esp_id=D.esp_id AND D.esp_nom!='$valor[2]' AND D.esp_nom LIKE '$esp_nom[0]%' GROUP BY A.reg_id ORDER BY C.reg_nom");
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
	$res=$id."@".$des."@".$cuantos;
  return $res;
  }
//******************************************************************
function Buscar_regimen($valor){//se agrego AND B.reg_sta='1'
    $id="";
	$des="";
	$cuantos=0;
	$val=explode("*",$valor);
	$this->mod_id=$val[0];
	$this->reg_id=$val[1];
	$resp=$this->OperacionCualquiera("SELECT A.reg_id AS 'reg_id', B.reg_nom AS 'reg_nom' FROM reg_esp_mod A, regimen B WHERE B.reg_id!='$this->reg_id' AND A.rem_sta='1' AND B.reg_sta='1' AND A.mod_id='$this->mod_id' AND A.reg_id=B.reg_id GROUP BY A.reg_id ORDER BY B.reg_nom");
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
	$res=$id."@".$des."@".$cuantos;
  return $res;
  }
//******************************************************************
  function Camb_matric_carre($ci,$mod_act,$reg_act,$esp_act,$coh_act,$pen_act,$inf_act){
  $this->busc_matric($ci,$mod_act,$reg_act,$esp_act,$coh_act,$pen_act);
  $this->busc_inf_alum($ci,$inf_act);
  }
//******************************************************************
  function camb_detins_esp($data_princ,$reg_id_sol,$esp_id_sol,$pen_top_sol,$fec_sol,$num_sol,$descrip,$observ,$ci_emp){
  $seccion="";
  $i=0;
  /* echo "<script>alert('$observ')</script>";*/
  $data=explode("*",$data_princ);
  //############VERIFICAR EL INF_ID ACTUAL PARA SABER QUE SEC_ID UTILIZAR
    if($data[7]==1 || $data[7]==3 || $data[7]==4 || $data[7]==5 || $data[7]==6){
  //############CONSULTAR EL DETINS ACTUAL PARA EXTRAER LA INFORMACION
    $detins_act=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$data[0]' AND mod_id='$data[1]' AND reg_id='$data[4]' AND esp_id='$data[2]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND det_sta='1' GROUP BY ins_id, pen_top, ci_est, sec_id, asi_cod, esp_id, reg_id, mod_id, coh_id, pac_id, obs_id");
      while($ext_detins_act=$this->ConsultarCualquiera($detins_act)){
	  //############CONSULTAR ASIGNA PARA SABER SI LA MATERIA ES DE CICLO BASICO
       $consul_asigna=$this->OperacionCualquiera("SELECT * FROM asigna WHERE asi_cod='$ext_detins_act->asi_cod' AND esp_id='$data[2]' AND reg_id='$data[4]' AND mod_id='$data[1]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND asi_sta='1'");
		$ext_asigna=$this->ConsultarCualquiera($consul_asigna);  
		  if($ext_asigna->asi_cba==1){
	  //#############CONSULTAR EL DETINS NUEVO PARA SABER SI EXISTE
      $detins_nuevo=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$data[0]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND ins_id='$ext_detins_act->ins_id' AND sec_id='89' AND asi_cod='$ext_detins_act->asi_cod' AND pac_id='$ext_detins_act->pac_id' AND obs_id='$ext_detins_act->obs_id' AND det_sta='1' GROUP BY ins_id, pen_top, ci_est, sec_id, asi_cod, esp_id, reg_id, mod_id, coh_id, pac_id, obs_id");
      $ext_detins_nuevo=$this->ConsultarCualquiera($detins_nuevo);
	  $fila_detins_nuevo=$this->NumFilas1($detins_nuevo);
		/*echo "<script>alert('$fila_detins_nuevo   $ext_detins_act->sec_id')</script>";*/
	    if($fila_detins_nuevo==0){ 
  //############CONSULTAR EL ASIGNA_SECCIO ACTUAL PARA EXTRAER INFORMACION
	      if($ext_detins_act->sec_id!='89'){
		  $busc_inf=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$ext_detins_act->pac_id' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='$ext_detins_act->sec_id' AND mod_id='$data[1]' AND reg_id='$data[4]' AND esp_id='$data[2]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND ase_sta='1'");
	      $ext_inf=$this->ConsultarCualquiera($busc_inf);
		  $ele_cod=$ext_inf->ele_cod;
  //############CONSULTAR SI EXISTE EL ASIGNA_SECCIO NUEVO 	  
	      $asig_sec=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$ext_detins_act->pac_id' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='89' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND ele_cod='$ext_inf->ele_cod' AND ase_sta='1'");    
		  $fila_asig_sec=$this->NumFilas1($asig_sec);
		    if($fila_asig_sec==0){
	        $this->Operacion("INSERT INTO asigna_seccio (pac_id,coh_id,mod_id,reg_id,esp_id,asi_cod,sec_id,pen_top,ci_emp,ele_cod,ase_sta ) values ('$ext_detins_act->pac_id','$data[3]','$data[1]','$reg_id_sol','$esp_id_sol','$ext_detins_act->asi_cod','89','$pen_top_sol','0','$ext_inf->ele_cod','1')");
		    $accion='INSERTAR';
            $Operacion="CAMBIO DE ESP: ASIGNA_SECCIO NUEVO MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: 89 , ELE: ".$ext_inf->ele_cod.", VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5]." ,SEC: ".$ext_detins_act->sec_id.", ELE: ".$ext_inf->ele_cod;
            $this->guardar_accion($accion,"asigna_seccio",$Operacion);
			}
		    else{
		    $consul_ase_sta=$this->ConsultarCualquiera($asigna_sec);
		      if($consul_ase_sta->ase_sta==0){
		      $this->Operacion("UPDATE asigna_seccio SET ase_sta='1' WHERE pac_id='$ext_detins_act->pac_id' AND coh_id='$data[3]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='89' AND pen_top='$pen_top_sol' AND ele_cod='$ext_inf->ele_cod' AND ase_sta='0'");	  
		      $accion='MODIFICAR';
              $Operacion="ACTIVAR ASIGNA_SECCIO: PAC: ".$ext_detins_act->pac_id.", COH: ".$data[3].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", ASI_COD: ".$ext_detins_act->asi_cod.", SEC: 89, PEN: ".$pen_top_sol." ELE: ".$ext_inf->ele_cod;
	          $this->guardar_accion($accion,"asigna_seccio",$Operacion);
			  }
		    }
		  }
		  else{
  //############CONSULTAR SI EXISTE EL ASIGNA_SECCIO NUEVO 
          $ele_cod=$ext_detins_act->det_obs;	  
	      $asig_sec=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$ext_detins_act->pac_id' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='89' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND ele_cod='$ext_detins_act->det_obs' AND ase_sta='1'");    
		  $fila_asig_sec=$this->NumFilas1($asig_sec);
		    if($fila_asig_sec==0){
	        $this->Operacion("INSERT INTO asigna_seccio (pac_id,coh_id,mod_id,reg_id,esp_id,asi_cod,sec_id,pen_top,ci_emp,ele_cod,ase_sta ) values ('$ext_detins_act->pac_id','$data[3]','$data[1]','$reg_id_sol','$esp_id_sol','$ext_detins_act->asi_cod','89','$pen_top_sol','0','$ext_detins_act->det_obs','1')");
		    $accion='INSERTAR';
            $Operacion="CAMBIO DE ESP: ASIGNA_SECCIO NUEVO MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: 89 , ELE: ".$ext_inf->ele_cod.", VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5]." ,SEC: ".$ext_detins_act->sec_id.", ELE: ".$ext_detins_act->det_obs;
            $this->guardar_accion($accion,"asigna_seccio",$Operacion);
			}
		    else{
		    $consul_ase_sta=$this->ConsultarCualquiera($asigna_sec);
		      if($consul_ase_sta->ase_sta==0){
		      $this->Operacion("UPDATE asigna_seccio SET ase_sta='1' WHERE pac_id='$ext_detins_act->pac_id' AND coh_id='$data[3]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='89' AND pen_top='$pen_top_sol' AND ele_cod='$ext_detins_act->det_obs' AND ase_sta='0'");	
		      $accion='MODIFICAR';
              $Operacion="ACTIVAR ASIGNA_SECCIO: PAC: ".$ext_detins_act->pac_id.", COH: ".$data[3].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", ASI_COD: ".$ext_detins_act->asi_cod.", SEC: 89, PEN: ".$pen_top_sol." ELE: ".$ext_detins_act->det_obs;
			  $this->guardar_accion($accion,"asigna_seccio",$Operacion);
			  }
		    }
		  }
  //############CONSULTAR ASIGNA PARA SABER SI LA MATERIA ES DE CICLO BASICO
       /* $consul_asigna=$this->OperacionCualquiera("SELECT * FROM asigna WHERE asi_cod='$ext_detins_act->asi_cod' AND esp_id='$data[2]' AND reg_id='$data[4]' AND mod_id='$data[1]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND asi_sta='1'");
		$ext_asigna=$this->ConsultarCualquiera($consul_asigna);  
		  if($ext_asigna->asi_cba==1){*/
  //############INSERTAR DETINS NUEVO
          /*echo "<script>alert('entra a insertar')</script>";*/
		  $this->Operacion("INSERT INTO detins (ins_id,pen_top,ci_est,sec_id,asi_cod,esp_id,reg_id,mod_id,coh_id,pac_id,obs_id,det_n11,det_n12,det_n13,det_n21,det_n22,det_n23,det_n31,det_n32,det_n33,det_nla,det_di1,det_di2,det_nfi,det_nre,det_nde,det_obs,det_sta,det_fin,det_con) values ('$ext_detins_act->ins_id','$pen_top_sol','$data[0]','89','$ext_detins_act->asi_cod','$esp_id_sol','$reg_id_sol','$data[1]','$data[3]','$ext_detins_act->pac_id','$ext_detins_act->obs_id','$ext_detins_act->det_n11','$ext_detins_act->det_n12','$ext_detins_act->det_n13','$ext_detins_act->det_n21','$ext_detins_act->det_n22','$ext_detins_act->det_n23','$ext_detins_act->det_n31','$ext_detins_act->det_n32','$ext_detins_act->det_n33','$ext_detins_act->det_nla','$ext_detins_act->det_di1','$ext_detins_act->det_di2','$ext_detins_act->det_nfi','$ext_detins_act->det_nre','$ext_detins_act->det_nde','$ele_cod','1','$ext_detins_act->det_fin','$ext_detins_act->det_con')");	  
		  $accion='INSERTAR';
          $Operacion="CAMBIO DE ESP: DETINS NUEVO CI: ".$data[0].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: 89  VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5]." ,SEC: ".$ext_detins_act->sec_id;
		  $this->guardar_accion($accion,"detins",$Operacion); 
		    if($seccion!=$ext_detins_act->sec_id){
		    $seccion=$ext_detins_act->sec_id;
			$this->hist_estud($fec_sol,$num_sol,$seccion,"89","89",$data[0],$ext_detins_act->det_id,$ci_emp,"9",$descrip,$observ);
			}
		  }
		}
	    else{
		  if($ext_detins_nuevo->det_sta==0){
		  /*echo "<script>alert('entra a actualizar')</script>";*/
          $this->Operacion("UPDATE detins SET det_sta='1' WHERE ci_est='$data[0]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND det_sta='0' AND ins_id='$ext_detins_act->ins_id' AND sec_id='89' AND asi_cod='$ext_detins_act->asi_cod' AND pac_id='$ext_detins_act->pac_id' AND obs_id='$ext_detins_act->obs_id'");
	      $accion='MODIFICAR';
          $Operacion="ACTIVAR DETINS NUEVO CI: ".$data[0].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: 89";
		  $this->guardar_accion($accion,"detins",$Operacion);
		    /*echo "<script>alert('$seccion')</script>";
			if($seccion!=$ext_detins_act->sec_id){
			echo "<script>alert('$seccion')</script>";
            $seccion=$ext_detins_act->sec_id;
		    $this->hist_estud($fec_sol,$num_sol,$seccion,"89","89",$data[0],"9",$descrip,$observ,$ci_emp);   }*/
		  }
	    }
	  }
	}
	else
	{
  //############CONSULTAR EL DETINS ACTUAL PARA EXTRAER LA INFORMACION
	$detins_act=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$data[0]' AND mod_id='$data[1]' AND reg_id='$data[4]' AND esp_id='$data[2]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND det_sta='1'");  
	  while($ext_detins_act=$this->ConsultarCualquiera($detins_act)){
  //############CONSULTAR ASIGNA PARA SABER SI LA MATERIA ES DE CICLO BASICO
        $consul_asigna=$this->OperacionCualquiera("SELECT * FROM asigna WHERE asi_cod='$ext_detins_act->asi_cod' AND esp_id='$data[2]' AND reg_id='$data[4]' AND mod_id='$data[1]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND asi_sta='1'");
		$ext_asigna=$this->ConsultarCualquiera($consul_asigna);  
		  if($ext_asigna->asi_cba==1){
  //#############CONSULTAR EL DETINS NUEVO PARA SABER SI EXISTE
      $detins_nuevo=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$data[0]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND ins_id='$ext_detins_act->ins_id' AND sec_id='LF-011' AND asi_cod='$ext_detins_act->asi_cod' AND pac_id='$ext_detins_act->pac_id' AND obs_id='$ext_detins_act->obs_id' AND det_sta='1'");
        $fila_detins_nuevo=$this->NumFilas1($detins_nuevo);
	    if($fila_detins_nuevo==0){ 
  //############CONSULTAR EL ASIGNA_SECCIO ACTUAL PARA EXTRAER INFORMACION
	      if($ext_detins_act->sec_id!='LF-011'){
		  $busc_inf=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$ext_detins_act->pac_id' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='$ext_detins_act->sec_id' AND mod_id='$data[1]' AND reg_id='$data[4]' AND esp_id='$data[2]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND ase_sta='1'");
	      $ext_inf=$this->ConsultarCualquiera($busc_inf);
		  $ele_cod=$ext_inf->ele_cod;
  //############CONSULTAR SI EXISTE EL ASIGNA_SECCIO NUEVO 	  
	      $asig_sec=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$ext_detins_act->pac_id' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='LF-011' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND ele_cod='$ext_inf->ele_cod' AND ase_sta='1'");    
		  $fila_asig_sec=$this->NumFilas1($asig_sec);
		    if($fila_asig_sec==0){
	        $this->Operacion("INSERT INTO asigna_seccio (pac_id,coh_id,mod_id,reg_id,esp_id,asi_cod,sec_id,pen_top,ci_emp,ele_cod,ase_sta ) values ('$ext_detins_act->pac_id','$data[3]','$data[1]','$reg_id_sol','$esp_id_sol','$ext_detins_act->asi_cod','LF-011','$pen_top_sol','0','$ext_inf->ele_cod','1')");
		    $accion='INSERTAR';
            $Operacion="CAMBIO DE ESP: ASIGNA_SECCIO NUEVO MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: LF-011 , ELE: ".$ext_inf->ele_cod.", VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5].",SEC: ".$ext_detins_act->sec_id.", ELE: ".$ext_inf->ele_cod;
            $this->guardar_accion($accion,"asigna_seccio",$Operacion);
			}
		    else{
			$consul_ase_sta=$this->ConsultarCualquiera($asigna_sec);
		      if($consul_ase_sta->ase_sta==0){
		      $this->Operacion("UPDATE asigna_seccio SET ase_sta='1' WHERE pac_id='$ext_detins_act->pac_id' AND coh_id='$data[3]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='LF-011' AND pen_top='$pen_top_sol' AND ele_cod='$ext_inf->ele_cod' AND ase_sta='0'");	  
		      $accion='MODIFICAR';
              $Operacion="ACTIVAR ASIGNA_SECCIO: PAC: ".$ext_detins_act->pac_id.", COH: ".$data[3].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", ASI_COD: ".$ext_detins_act->asi_cod.", SEC: LF-011, PEN: ".$pen_top_sol." ELE: ".$ext_inf->ele_cod;
			  $this->guardar_accion($accion,"asigna_seccio",$Operacion);
			  }
		    }
		  }
		  else{
		  $ele_cod=$ext_detins_act->det_obs;
  //############CONSULTAR SI EXISTE EL ASIGNA_SECCIO NUEVO 	  
	      $asig_sec=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$ext_detins_act->pac_id' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='LF-011' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND ele_cod='$ext_detins_act->det_obs' AND ase_sta='1'");    
		  $fila_asig_sec=$this->NumFilas1($asig_sec);
		    if($fila_asig_sec==0){
	        $this->Operacion("INSERT INTO asigna_seccio (pac_id,coh_id,mod_id,reg_id,esp_id,asi_cod,sec_id,pen_top,ci_emp,ele_cod,ase_sta ) values ('$ext_detins_act->pac_id','$data[3]','$data[1]','$reg_id_sol','$esp_id_sol','$ext_detins_act->asi_cod','LF-011','$pen_top_sol','0','$ext_detins_act->det_obs','1')");
		    $accion='INSERTAR';
            $Operacion="CAMBIO DE ESP: ASIGNA_SECCIO NUEVO MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: LF-011 , ELE: ".$ext_inf->ele_cod.", VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5].", SEC: ".$ext_detins_act->sec_id.", ELE: ".$ext_detins_act->det_obs;
            $this>guardar_accion($accion,"asigna_seccio",$Operacion);
			}
		    else{
			$consul_ase_sta=$this->ConsultarCualquiera($asigna_sec);
		      if($consul_ase_sta->ase_sta==0){
		      $this->Operacion("UPDATE asigna_seccio SET ase_sta='1' WHERE pac_id='$ext_detins_act->pac_id' AND coh_id='$data[3]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='LF-011' AND pen_top='$pen_top_sol' AND ele_cod='$ext_detins_act->det_obs' AND ase_sta='0'");	  
		      $accion='MODIFICAR';
              $Operacion="ACTIVAR ASIGNA_SECCIO: PAC: ".$ext_detins_act->pac_id.", COH: ".$data[3].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", ASI_COD: ".$ext_detins_act->asi_cod.", SEC: LF-011, PEN: ".$pen_top_sol." ELE: ".$ext_detins_act->det_obs;
			  $this->guardar_accion($accion,"asigna_seccio",$Operacion);
			  }
		    }
		  }
  //############CONSULTAR ASIGNA PARA SABER SI LA MATERIA ES DE CICLO BASICO
       /* $consul_asigna=$this->OperacionCualquiera("SELECT * FROM asigna WHERE asi_cod='$ext_detins_act->asi_cod' AND esp_id='$data[2]' AND reg_id='$data[4]' AND mod_id='$data[1]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND asi_sta='1'");
		$ext_asigna=$this->ConsultarCualquiera($consul_asigna);  
		  if($ext_asigna->asi_cba==1){*/
  //############INSERTAR DETINS NUEVO
          /*echo "<script>alert('entra a insertar')</script>";*/
		  $this->Operacion("INSERT INTO detins (ins_id,pen_top,ci_est,sec_id,asi_cod,esp_id,reg_id,mod_id,coh_id,pac_id,obs_id,det_n11,det_n12,det_n13,det_n21,det_n22,det_n23,det_n31,det_n32,det_n33,det_nla,det_di1,det_di2,det_nfi,det_nre,det_nde,det_obs,det_sta,det_fin,det_con) values ('$ext_detins_act->ins_id','$pen_top_sol','$data[0]','LF-011','$ext_detins_act->asi_cod','$esp_id_sol','$reg_id_sol','$data[1]','$data[3]','$ext_detins_act->pac_id','$ext_detins_act->obs_id','$ext_detins_act->det_n11','$ext_detins_act->det_n12','$ext_detins_act->det_n13','$ext_detins_act->det_n21','$ext_detins_act->det_n22','$ext_detins_act->det_n23','$ext_detins_act->det_n31','$ext_detins_act->det_n32','$ext_detins_act->det_n33','$ext_detins_act->det_nla','$ext_detins_act->det_di1','$ext_detins_act->det_di2','$ext_detins_act->det_nfi','$ext_detins_act->det_nre','$ext_detins_act->det_nde','$ele_cod','1','$ext_detins_act->det_fin','$ext_detins_act->det_con')");	  
		  $accion='INSERTAR';
          $Operacion="CAMBIO DE ESP: DETINS NUEVO CI: ".$data[0].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: LF-011  VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5]." ,SEC: ".$ext_detins_act->sec_id;
		  $this->guardar_accion($accion,"detins",$Operacion);
		    if($seccion!=$ext_detins_act->sec_id){
			$seccion=$ext_detins_act->sec_id;	
			$this->hist_estud($fec_sol,$num_sol,$seccion,"LF-011","LF-011",$data[0],$ext_detins_act->det_id,$ci_emp,"9",$descrip,$observ);
			}
		  }
		}
	    else{
		$ext_detins_nuevo=$this->ConsultarCualquiera($detins_nuevo);
		  if($ext_detins_nuevo->det_sta==0){
		  /*echo "<script>alert('entra a actualizar')</script>";*/
          $this->Operacion("UPDATE detins SET det_sta='1' WHERE ci_est='$data[0]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND det_sta='0' AND ins_id='$ext_detins_act->ins_id' AND sec_id='LF-011' AND asi_cod='$ext_detins_act->asi_cod' AND pac_id='$ext_detins_act->pac_id' AND obs_id='$ext_detins_act->obs_id'");
		  /*$accion='MODIFICAR';
          $Operacion="ACTIVAR DETINS NUEVO CI: ".$data[0].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: LF-011";
		  $this->guardar_accion($accion,"detins",$Operacion);*/
		  /*$this->hist_estud($fec_sol,$num_sol,$seccion,"LF-011","LF-011",$data[0],"9",$descrip,$observ,$ci_emp);*/
		  }
	    }
	  }
	}
  }  
//******************************************************************
function camb_detins_regi_reing($data_princ,$reg_id_sol,$esp_id_sol,$pen_top_sol,$fec_sol,$num_sol,$descrip,$observ,$ci_emp){
  $seccion="";
  $i=0;
  $data=explode("*",$data_princ);
  //############VERIFICAR EL INF_ID ACTUAL PARA SABER QUE SEC_ID UTILIZAR
    if($data[7]==1 or $data[7]==3 or $data[7]==4 or $data[7]==5 or $data[7]==6){
  //############CONSULTAR EL DETINS ACTUAL PARA EXTRAER LA INFORMACION
    $detins_act=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$data[0]' AND mod_id='$data[1]' AND reg_id='$data[4]' AND esp_id='$data[2]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND det_sta='1'");
      while($ext_detins_act=$this->ConsultarCualquiera($detins_act)){
	  //#############CONSULTAR EL DETINS NUEVO PARA SABER SI EXISTE
      $detins_nuevo=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$data[0]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND ins_id='$ext_detins_act->ins_id' AND sec_id='89' AND asi_cod='$ext_detins_act->asi_cod' AND pac_id='$ext_detins_act->pac_id' AND obs_id='$ext_detins_act->obs_id' AND det_sta='1'");
      $ext_detins_nuevo=$this->ConsultarCualquiera($detins_nuevo);
	  $fila_detins_nuevo=$this->NumFilas1($detins_nuevo);
		/*echo "<script>alert('$fila_detins_nuevo   $ext_detins_act->sec_id')</script>";*/
	    if($fila_detins_nuevo==0){ 
  //############CONSULTAR EL ASIGNA_SECCIO ACTUAL PARA EXTRAER INFORMACION
	      if($ext_detins_act->sec_id!='89'){
		  $busc_inf=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$ext_detins_act->pac_id' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='$ext_detins_act->sec_id' AND mod_id='$data[1]' AND reg_id='$data[4]' AND esp_id='$data[2]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND ase_sta='1'");
	      $ext_inf=$this->ConsultarCualquiera($busc_inf);
		  $ele_cod=$ext_inf->ele_cod;
  //############CONSULTAR SI EXISTE EL ASIGNA_SECCIO NUEVO 	  
	      $asig_sec=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$ext_detins_act->pac_id' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='89' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND ele_cod='$ext_inf->ele_cod' AND ase_sta='1'");    
		  $fila_asig_sec=$this->NumFilas1($asig_sec);
		    if($fila_asig_sec==0){
	        $this->Operacion("INSERT INTO asigna_seccio (pac_id,coh_id,mod_id,reg_id,esp_id,asi_cod,sec_id,pen_top,ci_emp,ele_cod,ase_sta ) values ('$ext_detins_act->pac_id','$data[3]','$data[1]','$reg_id_sol','$esp_id_sol','$ext_detins_act->asi_cod','89','$pen_top_sol','0','$ext_inf->ele_cod','1')");
		    $accion='INSERTAR';
            $Operacion="CAMBIO DE ESP: ASIGNA_SECCIO NUEVO MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: 89 , ELE: ".$ext_inf->ele_cod.", VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5]." ,SEC: ".$ext_detins_act->sec_id.", ELE: ".$ext_inf->ele_cod;	
            $this->guardar_accion($accion,"asigna_seccio",$Operacion);
			}
		    else{
		    $consul_ase_sta=$this->ConsultarCualquiera($asigna_sec);
		      if($consul_ase_sta->ase_sta==0){
		      $this->Operacion("UPDATE asigna_seccio SET ase_sta='1' WHERE pac_id='$ext_detins_act->pac_id' AND coh_id='$data[3]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='89' AND pen_top='$pen_top_sol' AND ele_cod='$ext_inf->ele_cod' AND ase_sta='0'");	  
		      $accion='MODIFICAR';
              $Operacion="ACTIVAR ASIGNA_SECCIO: PAC: ".$ext_detins_act->pac_id.", COH: ".$data[3].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", ASI_COD: ".$ext_detins_act->asi_cod.", SEC: 89, PEN: ".$pen_top_sol." ELE: ".$ext_detins_act->det_obs;
			  $this->guardar_accion($accion,"asigna_seccio",$Operacion);
			  }
		    }
		  }
		  else{
  //############CONSULTAR SI EXISTE EL ASIGNA_SECCIO NUEVO 
          $ele_cod=$ext_detins_act->det_obs;	  
	      $asig_sec=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$ext_detins_act->pac_id' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='89' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND ele_cod='$ext_detins_act->det_obs' AND ase_sta='1'");    
		  $fila_asig_sec=$this->NumFilas1($asig_sec);
		    if($fila_asig_sec==0){
	        $this->Operacion("INSERT INTO asigna_seccio (pac_id,coh_id,mod_id,reg_id,esp_id,asi_cod,sec_id,pen_top,ci_emp,ele_cod,ase_sta ) values ('$ext_detins_act->pac_id','$data[3]','$data[1]','$reg_id_sol','$esp_id_sol','$ext_detins_act->asi_cod','89','$pen_top_sol','0','$ext_detins_act->det_obs','1')");
			$accion='INSERTAR';
            $Operacion="CAMBIO DE ESP: ASIGNA_SECCIO NUEVO MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: 89 , ELE: ".$ext_inf->ele_cod.", VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5]." ,SEC: ".$ext_detins_act->sec_id.", ELE: ".$ext_detins_act->det_obs;	
            $this->guardar_accion($accion,"asigna_seccio",$Operacion);
		    }
		    else{
		    $consul_ase_sta=$this->ConsultarCualquiera($asigna_sec);
		      if($consul_ase_sta->ase_sta==0){
		      $this->Operacion("UPDATE asigna_seccio SET ase_sta='1' WHERE pac_id='$ext_detins_act->pac_id' AND coh_id='$data[3]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='89' AND pen_top='$pen_top_sol' AND ele_cod='$ext_detins_act->det_obs' AND ase_sta='0'");	
		      $accion='MODIFICAR';
              $Operacion="ACTIVAR ASIGNA_SECCIO: PAC: ".$ext_detins_act->pac_id.", COH: ".$data[3].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", ASI_COD: ".$ext_detins_act->asi_cod.", SEC: 89, PEN: ".$pen_top_sol." ELE: ".$ext_detins_act->det_obs;
			  $this->guardar_accion($accion,"asigna_seccio",$Operacion);
			  }
		    }
		  }
  //############INSERTAR DETINS NUEVO
          /*echo "<script>alert('entra a insertar')</script>";*/
		  $this->Operacion("INSERT INTO detins (ins_id,pen_top,ci_est,sec_id,asi_cod,esp_id,reg_id,mod_id,coh_id,pac_id,obs_id,det_n11,det_n12,det_n13,det_n21,det_n22,det_n23,det_n31,det_n32,det_n33,det_nla,det_di1,det_di2,det_nfi,det_nre,det_nde,det_obs,det_sta,det_fin,det_con) values ('$ext_detins_act->ins_id','$pen_top_sol','$data[0]','89','$ext_detins_act->asi_cod','$esp_id_sol','$reg_id_sol','$data[1]','$data[3]','$ext_detins_act->pac_id','$ext_detins_act->obs_id','$ext_detins_act->det_n11','$ext_detins_act->det_n12','$ext_detins_act->det_n13','$ext_detins_act->det_n21','$ext_detins_act->det_n22','$ext_detins_act->det_n23','$ext_detins_act->det_n31','$ext_detins_act->det_n32','$ext_detins_act->det_n33','$ext_detins_act->det_nla','$ext_detins_act->det_di1','$ext_detins_act->det_di2','$ext_detins_act->det_nfi','$ext_detins_act->det_nre','$ext_detins_act->det_nde','$ele_cod','1','$ext_detins_act->det_fin','$ext_detins_act->det_con')");	  
		$accion='INSERTAR';
        $Operacion="CAMBIO DE ESP: DETINS NUEVO CI: ".$data[0].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: 89  VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5]." ,SEC: ".$ext_detins_act->sec_id;
		$this->guardar_accion($accion,"detins",$Operacion);
		  if($seccion!=$ext_detins_act->sec_id){
		  $seccion=$ext_detins_act->sec_id;
		    if($descrip=="CAMB REGIMEN")
			$this->hist_estud($fec_sol,$num_sol,$seccion,"89","89",$data[0],$ext_detins_act->det_id,$ci_emp,"8",$descrip,$observ);
		    else
		  $this->hist_estud($fec_sol,$num_sol,$seccion,"89","89",$data[0],$ext_detins_act->det_id,$ci_emp,"3",$descrip,$observ);
		  }
		}
	    else{
		  if($ext_detins_nuevo->det_sta==0){
		  /*echo "<script>alert('entra a actualizar')</script>";*/
          $this->Operacion("UPDATE detins SET det_sta='1' WHERE ci_est='$data[0]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND det_sta='0' AND ins_id='$ext_detins_act->ins_id' AND sec_id='89' AND asi_cod='$ext_detins_act->asi_cod' AND pac_id='$ext_detins_act->pac_id' AND obs_id='$ext_detins_act->obs_id'");
		  $accion='MODIFICAR';
          $Operacion="ACTIVAR DETINS NUEVO CI: ".$data[0].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: 89";
		  $this->guardar_accion($accion,"detins",$Operacion);
		    /*if($descrip=="CAMB REGIMEN")
		    $this->hist_estud($fec_sol,$num_sol,$seccion,"89","89",$data[0],$ext_detins_act->det_id,$ci_emp,"8",$descrip,$observ);
			else
			$this->hist_estud($fec_sol,$num_sol,$seccion,"89","89",$data[0],$ext_detins_act->det_id,$ci_emp,"3",$descrip,$observ);*/
		  }
	    }
	  }
	}
	else
	{
  //############CONSULTAR EL DETINS ACTUAL PARA EXTRAER LA INFORMACION
    $detins_act=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$data[0]' AND mod_id='$data[1]' AND reg_id='$data[4]' AND esp_id='$data[2]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND det_sta='1'");
      while($ext_detins_act=$this->ConsultarCualquiera($detins_act)){
  //#############CONSULTAR EL DETINS NUEVO PARA SABER SI EXISTE
      $detins_nuevo=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$data[0]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND ins_id='$ext_detins_act->ins_id' AND sec_id='LF-011' AND asi_cod='$ext_detins_act->asi_cod' AND pac_id='$ext_detins_act->pac_id' AND obs_id='$ext_detins_act->obs_id' AND det_sta='1'");
        $fila_detins_nuevo=$this->NumFilas1($detins_nuevo);
	    if($fila_detins_nuevo==0){ 
  //############CONSULTAR EL ASIGNA_SECCIO ACTUAL PARA EXTRAER INFORMACION
	      if($ext_detins_act->sec_id!='LF-011'){
		  $busc_inf=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$ext_detins_act->pac_id' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='$ext_detins_act->sec_id' AND mod_id='$data[1]' AND reg_id='$data[4]' AND esp_id='$data[2]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND ase_sta='1'");
	      $ext_inf=$this->ConsultarCualquiera($busc_inf);
		  $ele_cod=$ext_inf->ele_cod;
  //############CONSULTAR SI EXISTE EL ASIGNA_SECCIO NUEVO 	  
	      $asig_sec=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$ext_detins_act->pac_id' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='LF-011' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND ele_cod='$ext_inf->ele_cod' AND ase_sta='1'");    
		  $fila_asig_sec=$this->NumFilas1($asig_sec);
		    if($fila_asig_sec==0){
	        $this->Operacion("INSERT INTO asigna_seccio (pac_id,coh_id,mod_id,reg_id,esp_id,asi_cod,sec_id,pen_top,ci_emp,ele_cod,ase_sta ) values ('$ext_detins_act->pac_id','$data[3]','$data[1]','$reg_id_sol','$esp_id_sol','$ext_detins_act->asi_cod','LF-011','$pen_top_sol','0','$ext_inf->ele_cod','1')");
		    $accion='INSERTAR';
            $Operacion="CAMBIO DE ESP: ASIGNA_SECCIO NUEVO MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: LF-011 , ELE: ".$ext_inf->ele_cod.", VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5]." ,SEC: ".$ext_detins_act->sec_id.", ELE: ".$ext_inf->ele_cod;
            $this->guardar_accion($accion,"asigna_seccio",$Operacion);
			}
		    else{
			$consul_ase_sta=$this->ConsultarCualquiera($asigna_sec);
		      if($consul_ase_sta->ase_sta==0){
		      $this->Operacion("UPDATE asigna_seccio SET ase_sta='1' WHERE pac_id='$ext_detins_act->pac_id' AND coh_id='$data[3]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='LF-011' AND pen_top='$pen_top_sol' AND ele_cod='$ext_inf->ele_cod' AND ase_sta='0'");	  
		      $accion='MODIFICAR';
              $Operacion="ACTIVAR ASIGNA_SECCIO: PAC: ".$ext_detins_act->pac_id.", COH: ".$data[3].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", ASI_COD: ".$ext_detins_act->asi_cod.", SEC: LF-011, PEN: ".$pen_top_sol." ELE: ".$ext_detins_act->det_obs;
			  $this->guardar_accion($accion,"asigna_seccio",$Operacion);
			  }
		    }
		  }
		  else{
		  $ele_cod=$ext_detins_act->det_obs;
  //############CONSULTAR SI EXISTE EL ASIGNA_SECCIO NUEVO 	  
	      $asig_sec=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$ext_detins_act->pac_id' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='LF-011' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND ele_cod='$ext_detins_act->det_obs' AND ase_sta='1'");    
		  $fila_asig_sec=$this->NumFilas1($asig_sec);
		    if($fila_asig_sec==0){
	        $this->Operacion("INSERT INTO asigna_seccio (pac_id,coh_id,mod_id,reg_id,esp_id,asi_cod,sec_id,pen_top,ci_emp,ele_cod,ase_sta ) values ('$ext_detins_act->pac_id','$data[3]','$data[1]','$reg_id_sol','$esp_id_sol','$ext_detins_act->asi_cod','LF-011','$pen_top_sol','0','$ext_detins_act->det_obs','1')");
		    $accion='INSERTAR';
            $Operacion="CAMBIO DE ESP: ASIGNA_SECCIO NUEVO MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: LF-011 , ELE: ".$ext_inf->ele_cod.", VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5]." ,SEC: ".$ext_detins_act->sec_id.", ELE: ".$ext_detins_act->det_obs;	
            $this->guardar_accion($accion,"asigna_seccio",$Operacion);
			}
		    else{
			$consul_ase_sta=$this->ConsultarCualquiera($asigna_sec);
		      if($consul_ase_sta->ase_sta==0){
		      $this->Operacion("UPDATE asigna_seccio SET ase_sta='1' WHERE pac_id='$ext_detins_act->pac_id' AND coh_id='$data[3]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND asi_cod='$ext_detins_act->asi_cod' AND sec_id='LF-011' AND pen_top='$pen_top_sol' AND ele_cod='$ext_detins_act->det_obs' AND ase_sta='0'");	      
			  $accion='MODIFICAR';
              $Operacion="ACTIVAR ASIGNA_SECCIO: PAC: ".$ext_detins_act->pac_id.", COH: ".$data[3].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", ASI_COD: ".$ext_detins_act->asi_cod.", SEC: LF-011, PEN: ".$pen_top_sol." ELE: ".$ext_detins_act->det_obs;
			  $this->guardar_accion($accion,"asigna_seccio",$Operacion);
		      }
		    }
		  }
  //############INSERTAR DETINS NUEVO
          /*echo "<script>alert('entra a insertar')</script>";*/
		  $this->Operacion("INSERT INTO detins (ins_id,pen_top,ci_est,sec_id,asi_cod,esp_id,reg_id,mod_id,coh_id,pac_id,obs_id,det_n11,det_n12,det_n13,det_n21,det_n22,det_n23,det_n31,det_n32,det_n33,det_nla,det_di1,det_di2,det_nfi,det_nre,det_nde,det_obs,det_sta,det_fin,det_con) values ('$ext_detins_act->ins_id','$pen_top_sol','$data[0]','LF-011','$ext_detins_act->asi_cod','$esp_id_sol','$reg_id_sol','$data[1]','$data[3]','$ext_detins_act->pac_id','$ext_detins_act->obs_id','$ext_detins_act->det_n11','$ext_detins_act->det_n12','$ext_detins_act->det_n13','$ext_detins_act->det_n21','$ext_detins_act->det_n22','$ext_detins_act->det_n23','$ext_detins_act->det_n31','$ext_detins_act->det_n32','$ext_detins_act->det_n33','$ext_detins_act->det_nla','$ext_detins_act->det_di1','$ext_detins_act->det_di2','$ext_detins_act->det_nfi','$ext_detins_act->det_nre','$ext_detins_act->det_nde','$ele_cod','1','$ext_detins_act->det_fin','$ext_detins_act->det_con')");	  
		$accion='INSERTAR';
        $Operacion="CAMBIO DE ESP: DETINS NUEVO CI: ".$data[0].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: LF-011  VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5]." ,SEC: ".$ext_detins_act->sec_id;
		$this->guardar_accion($accion,"detins",$Operacion);
		  if($seccion!=$ext_detins_act->sec_id){
		  $seccion=$ext_detins_act->sec_id;
		    if($descrip=="CAMB REGIMEN")
		    $this->hist_estud($fec_sol,$num_sol,$seccion,"LF-011","LF-011",$data[0],$ext_detins_act->det_id,$ci_emp,"8",$descrip,$observ);
		    else
		    $this->hist_estud($fec_sol,$num_sol,$seccion,"LF-011","LF-011",$data[0],$ext_detins_act->det_id,$ci_emp,"3",$descrip,$observ);
		  }
		}
	    else{
		$ext_detins_nuevo=$this->ConsultarCualquiera($detins_nuevo);
		  if($ext_detins_nuevo->det_sta==0){
		 /* echo "<script>alert('entra a actualizar')</script>";*/
          $this->Operacion("UPDATE detins SET det_sta='1' WHERE ci_est='$data[0]' AND mod_id='$data[1]' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$data[3]' AND pen_top='$pen_top_sol' AND det_sta='0' AND ins_id='$ext_detins_act->ins_id' AND sec_id='LF-011' AND asi_cod='$ext_detins_act->asi_cod' AND pac_id='$ext_detins_act->pac_id' AND obs_id='$ext_detins_act->obs_id'");
		  $accion='MODIFICAR';
          $Operacion="ACTIVAR DETINS NUEVO CI: ".$data[0].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$data[3].", PEN: ".$pen_top_sol." ,SEC: LF-011";
		  $this->guardar_accion($accion,"detins",$Operacion);
		    /*if($descrip=="CAMB REGIMEN")
		    $this->hist_estud($fec_sol,$num_sol,$seccion,"LF-011","LF-011",$data[0],"8",$descrip,$observ,$ci_emp);
			else
			$this->hist_estud($fec_sol,$num_sol,$seccion,"LF-011","LF-011",$data[0],"3",$descrip,$observ,$ci_emp);*/
		  }
	    }
	  }
	}
  }
//******************************************************************
  function rev_expedi($ci,$esp_id,$esp_id_act,$cambio){
  $this->Operacion("SELECT pac_nom AS pac_nom FROM pacade A,detins B WHERE A.pac_id=B.pac_id AND B.ci_est='$ci' AND pac_sta='1' AND A.mod_id=B.mod_id GROUP BY pac_id, ci_est ORDER BY pac_fin");
  $pac_nom=$this->ConsultarCualquiera($this->resul);
  $exp_id=$pac_nom->pac_nom."-".$esp_id."-".$ci;
  $busc_exp=$this->OperacionCualquiera("SELECT * FROM expedi WHERE exp_id='$exp_id' AND exp_sta='1'");
    if($this->Numfilas1($busc_exp)==1){
	$exp_id_act=$pac_nom->pac_nom."-".$esp_id_act."-".$ci;
	$ext_exp=$this->ConsultarCualquiera($busc_exp);
	$this->Operacion("UPDATE expedi SET exp_sta='0' WHERE exp_id='$exp_id'");
	$accion='ELIMINAR';   
    $Operacion=$cambio." DEL ESTUD CI: ".$data[0].", EXP VIEJO: ".$ext_id;
	$this->guardar_accion($accion,"expedi",$Operacion);
	$this->Operacion("INSERT INTO expedi (exp_id,min_id,ci_emp,ci_est,exp_pdp,exp_pcd,exp_ftc,exp_pic,exp_fcp,exp_fcc,exp_fod,exp_ccm,exp_ocs,exp_fnt,exp_nc9,exp_nc5,exp_pna,exp_fre,exp_mre,exp_nre,exp_fen,exp_ubi,exp_sta,exp_obs,exp_rus) values ('$exp_id_act','6','$ext_exp->ci_emp','$ext_exp->ci_est','$ext_exp->exp_pdp','$ext_exp->exp_pcd','$ext_exp->exp_ftc','$ext_exp->exp_pic','$ext_exp->exp_fcp','$ext_exp->exp_fcc','$ext_exp->exp_fod','$ext_exp->exp_ccm','$ext_exp->exp_ocs','$ext_exp->exp_fnt','$ext_exp->exp_nc9','$ext_exp->exp_nc5','$ext_exp->exp_pna','$ext_exp->exp_fre','$ext_exp->exp_mre','$ext_exp->exp_nre','$ext_exp->exp_fen','$ext_exp->exp_ubi','1','$ext_exp->exp_obs','$ext_exp->exp_rus')"); 
	$accion='INSERTAR';
    $Operacion=$cambio." DEL ESTUD CI: ".$data[0].", EXP VIEJO: ".$ext_id.", EXP NUEVO: ".$exp_id_act;
	$this->guardar_accion($accion,"expedi",$Operacion);
	}
  }
//******************************************************************
  function realiz_equiv($data_princ,$mod_id_sol,$reg_id_sol,$esp_id_sol,$coh_id_sol,$pen_top_sol,$fec_sol,$num_sol,$descrip,$observ,$ci_emp,$inf_id_sol){
  $seccion="";
  $data=explode("*",$data_princ);
  //############DEFINIR LA SECCION ACTUAL DEL ESTUDIANTE DESPUES DE LA EQUIVALENCIA  
	if($data[7]==1 || $data[7]==3 || $data[7]==4 || $data[7]==5 || $data[7]==6){
	$sec_id_nuevo="89";
	}
	else
	{
	$sec_id_nuevo="LF-011";
	}
  //############BUSCAR EL PRIMER PERIODO ACADEMICO DONDE SE INSCRIBIO
  	$prim_pac_id=$this->OperacionCualquiera("SELECT A.pac_id AS 'pac_id' FROM pacade A, matric B,detins C WHERE B.ci='$data[0]' AND B.mod_id='$data[1]' AND B.reg_id='$data[4]' AND B.esp_id='$data[2]' AND B.coh_id='$data[3]' AND B.pen_top='$data[5]' AND A.mod_id=B.mod_id AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top  AND B.ci=C.ci_est AND C.det_sta='1' AND A.pac_id=C.pac_id AND A.pac_sta='1' GROUP BY A.pac_id ORDER BY pac_fin");	
	$pac_id_nuevo=$this->ConsultarCualquiera($prim_pac_id);
	
	/*echo "<script>alert('pac_id:$pac_id_nuevo->pac_id  inf_id:$ins_id_nuevo->ins_id')</script>";*/
  //############BUSCAR LA TABLA DE EQUIVALENCIA PARA LOS PENSUM
  $tab_equ=$this->OperacionCualquiera("SELECT asi_cod FROM tabequ WHERE mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol' AND mod_id_eq='$data[1]' AND reg_id_eq='$data[4]' AND esp_id_eq='$data[2]' AND coh_id_eq='$data[3]' AND pen_top_eq='$data[5]' AND teq_sta='1' GROUP BY mod_id, reg_id, esp_id, coh_id, pen_top, asi_cod");
  $fila_tab_equ=$this->NumFilas1($tab_equ);
    if($fila_tab_equ>0){
  //#############BUSCAR LA INFRAESTRUCTURA DEL ESTUDIANTE
    $this->busc_inf_alum($data_princ,$inf_id_sol);
  //#############ACTIVAR MATRICULA DEL ESTUDIANTE
	$this->activ_matric($data_princ,$mod_id_sol,$reg_id_sol,$esp_id_sol,$coh_id_sol,$pen_top_sol,$fec_sol,$num_sol,$cambio,$observ,$ci_emp); 
  //#############REVISAR EXPEDIENTE ESTUDIANTE 
	$this->rev_expedi($data[0],$data[2],$esp_id_sol,$cambio);
	  while($ext_tab_equ=$this->ConsultarCualquiera($tab_equ)){
		/*echo "<script>alert('selecciona el asi_cod_nuevo: $ext_tab_equ->asi_cod')</script>";*/  
  //############BUSCAR LAS ASIGNATURAS EQUIVALENTES A LA ASIGNATURA DEL PENSUM NUEVO
	  $pensum_nuevo=$this->OperacionCualquiera("SELECT asi_cod_eq FROM tabequ WHERE mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol' AND mod_id_eq='$data[1]' AND reg_id_eq='$data[4]' AND esp_id_eq='$data[2]' AND coh_id_eq='$data[3]' AND pen_top_eq='$data[5]' AND asi_cod='$ext_tab_equ->asi_cod' AND teq_sta='1' GROUP BY mod_id, reg_id, esp_id, coh_id, pen_top, mod_id_eq, reg_id_eq, esp_id_eq, coh_id_eq, pen_top_eq, asi_cod, asi_cod_eq");
	     
	  $fila_pensum_nuevo=$this->NumFilas1($pensum_nuevo);
	  $cont_mat_aprob=0;
	  $ele_cod="";
		while($ext_pensum_nuevo=$this->ConsultarCualquiera($pensum_nuevo)){
		/*echo "<script>alert('asi_cod_act:$ext_pensum_nuevo->asi_cod_eq   num_filas_pensum=$fila_pensum_nuevo')</script>";*/		
			
			/*echo "<script>alert('asi_cod_act:$ext_pensum_nuevo->asi_cod_eq')</script>";*/
  //############BUSCAR LA ASIGNATURA EQUIVALENTE EN EL DETINS ACTUAL DEL ESTUDIANTE
        $detins_act_est=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$data[0]' AND mod_id='$data[1]' AND reg_id='$data[4]' AND esp_id='$data[2]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND asi_cod='$ext_pensum_nuevo->asi_cod_eq' AND det_con='1' AND det_sta='1'");
		$fila_detins_act_est=$this->NumFilas1($detins_act_est);
		$ext_detins_act_est=$this->ConsultarCualquiera($detins_act_est);
		
		/*echo "<script>alert('prueba si el asi_cod_actual cumple con la condicion')</script>";*/
          if($fila_detins_act_est>0){
		  $busc_tip_id=$this->OperacionCualquiera("SELECT tip_id FROM asigna WHERE mod_id='$data[1]' AND reg_id='$data[4]' AND esp_id='$data[2]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND asi_cod='$ext_pensum_nuevo->asi_cod_eq' AND asi_sta='1'");
		  $ext_tip_id=$this->ConsultarCualquiera($busc_tip_id);
		  
		   /*echo "<script>alert('extrae tip_id:$ext_tip_id->tip_id')</script>";*/
		    if($ext_tip_id->tip_id!='1' && $ext_tip_id->tip_id!='2'){
			  if($ext_detins_act_est->sec_id=="89" || $ext_detins_act_est->sec_id=='LF-011'){
	  $ext_inf=$this->ConsultarCualquiera($busc_inf);
			  $ext_asig_sec_act=$this->ConsultarCualquiera($busc_asig_sec_act);
			    if($ele_cod==""){
				$ele_cod=$ext_detins_act_est->det_obs;
				$pac_id=$ext_detins_act_est->pac_id;
				$ins_id=$ext_detins_act_est->ins_id;
				$asi_cod=$ext_detins_act_est->asi_cod;
				$sec_id=$ext_detins_act_est->sec_id;
				}
				else{
				$ele_cod=$ele_cod."*".$ext_detins_act_est->det_obs;
				$pac_id=$pac_id."*".$ext_detins_act_est->pac_id;
				$ins_id=$ins_id."*".$ext_detins_act_est->ins_id;;
				$asi_cod=$asi_cod."*".$asi_cod=$ext_detins_act_est->asi_cod;;
				$sec_id=$sec_id."*".$sec_id=$ext_detins_act_est->sec_id;;
				} 
			  }
			}
	        else{
		     /*echo "<script>alert('extrae los ele_cod')</script>";*/	
			$inf=$this->ext_ele_cod($ext_detins_act_est->pac_id, $ext_detins_act_est->asi_cod, $ext_detins_act_est->sec_id, $data[1], $data[4], $data[2], $data[3], $data[5]);
			  if($ele_cod==""){
			  $ele_cod=$inf;
			  $pac_id=$ext_detins_act_est->pac_id;
			  $ins_id=$ext_detins_act_est->ins_id;
			  $asi_cod=$ext_detins_act_est->asi_cod;
			  $sec_id=$ext_detins_act_est->sec_id;
			  }
			  else{
			  $ele_cod=$ele_cod."*".$inf;
			  $pac_id=$pac_id."*".$ext_detins_act_est->pac_id;
			  $ins_id=$ins_id."*".$ext_detins_act_est->ins_id;
			  $asi_cod=$asi_cod."*".$ext_detins_act_est->asi_cod;
			  $sec_id=$sec_id."*".$ext_detins_act_est->sec_id;
			  } 
			}
		  $cont_mat_aprob++;
		  /*echo "<script>alert('conteo de materias aprobadas $cont_mat_aprob')</script>";*/	
		  }
        }
/*echo "<script>alert('$cont_mat_aprob==$fila_pensum_nuevo');</script>";		*/
	    if($cont_mat_aprob==$fila_pensum_nuevo){  
		//############CONSULTAR EL DETINS nuevo PARA EXTRAER LA INFORMACION
/*echo "<script>alert('SELECT * FROM detins WHERE ci_est=$data[0] AND ins_id=$ext_detins_act_est->ins_id AND pac_id=$pac_id_nuevo->pac_id AND asi_cod=$ext_tab_equ->asi_cod AND sec_id=$sec_id_nuevo AND obs_id=4 AND mod_id=$mod_id_sol AND reg_id=$reg_id_sol AND esp_id=$esp_id_sol AND coh_id=$coh_id_sol AND pen_top=$pen_top_sol');</script>";*/
        $comp_detins_nuevo=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$data[0]' AND ins_id='$ext_detins_act_est->ins_id' AND pac_id='$pac_id_nuevo->pac_id' AND asi_cod='$ext_tab_equ->asi_cod' AND sec_id='$sec_id_nuevo' AND obs_id='4' AND mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol'");
          if($this->NumFilas1($comp_detins_nuevo)==0){
		    if($fila_pensum_nuevo>1){
		    $valor_ele_cod=explode("*",$ele_cod);
		    $valor_pac_id=explode("*",$pac_id);
		    $valor_ins_id=explode("*",$ins_id);
		    $valor_asi_cod=explode("*",$asi_cod);
		    $valor_sec_id=explode("*",$sec_id);
			  for($i=0;$i<$cont_mat_aprob;$i++){
			  $inf=$this->consul_detins_asig_secc($data[0], $data[1], $data[4], $data[2], $data[3],$data[5], $mod_id_sol, $reg_id_sol, $esp_id_sol, $coh_id_sol, $pen_top_sol, $valor_ins_id[$i],$ext_detins_act_est->ins_id, $valor_sec_id[$i], $sec_id_nuevo, $valor_asi_cod[$i],$ext_tab_equ->asi_cod, $valor_pac_id[$i],$pac_id_nuevo->pac_id, "4", $valor_ele_cod[$i]);
			  }
			/*echo "<script>alert('inserta detins')</script>";*/
		    $this->Operacion("INSERT INTO detins (ins_id,pen_top,ci_est,sec_id,asi_cod,esp_id,reg_id,mod_id,coh_id,pac_id,obs_id,det_n11,det_n12,det_n13,det_n21,det_n22,det_n23,det_n31,det_n32,det_n33,det_nla,det_di1,det_di2,det_nfi,det_nre,det_nde,det_obs,det_sta,det_fin,det_con) values ('$ext_detins_act_est->ins_id','$pen_top_sol','$data[0]','$sec_id_nuevo','$ext_tab_equ->asi_cod','$esp_id_sol','$reg_id_sol','$mod_id_sol','$coh_id_sol','$pac_id_nuevo->pac_id','4','','','','','','','','','','','','','','','','$ele_cod','1','','1')");	  
		    $accion='INSERTAR';
            $Operacion="EQUIVALENCIA: DETINS NUEVO CI: ".$data[0].", MOD: ".$mod_id_sol.", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$coh_id_sol.", PEN: ".$pen_top_sol." ,SEC: ".$sec_id_nuevo." VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5]." ,SEC: ".$ext_detins_act_est->sec_id;
		    $this->guardar_accion($accion,"detins",$Operacion);
		      if($seccion!=$ext_detins_act_est->sec_id){
			  $seccion=$ext_detins_act_est->sec_id;
			  $this->hist_estud($fec_sol,$num_sol,$seccion,$sec_id_nuevo,$sec_id_nuevo,$data[0],$ext_detins_act_est->det_id,$ci_emp,"11",$descrip,$observ);
			  }
			}
		    else{
		      if($ext_detins_act_est->sec_id=="89" || $ext_detins_act_est->sec_id=='LF-011'){
			  $ele_cod=$ext_detins_act_est->det_obs;
			  }
			  else{
			  $inf=$this->ext_ele_cod($ext_detins_act_est->pac_id, $ext_detins_act_est->asi_cod, $ext_detins_act_est->sec_id, $data[1], $data[4], $data[2], $data[3], $data[5]);
			  $ele_cod==$inf;
			  }
		    $inf=$this->consul_detins_asig_secc($data[0], $data[1], $data[4], $data[2], $data[3],$data[5], $mod_id_sol, $reg_id_sol, $esp_id_sol, $coh_id_sol, $pen_top_sol, $ext_detins_act_est->ins_id,$ext_detins_act_est->ins_id, $ext_detins_act_est->sec_id, $sec_id_nuevo, $ext_detins_act_est->asi_cod, $ext_tab_equ->asi_cod, $ext_detins_act_est->pac_id, $pac_id_nuevo->pac_id, "4", $ele_cod);
		  
		  /*echo "<script>alert('conteo de aprobados: $cont_mat_aprob,  inserta detins')</script>";*/
		    $this->Operacion("INSERT INTO detins (ins_id,pen_top,ci_est,sec_id,asi_cod,esp_id,reg_id,mod_id,coh_id,pac_id,obs_id,det_n11,det_n12,det_n13,det_n21,det_n22,det_n23,det_n31,det_n32,det_n33,det_nla,det_di1,det_di2,det_nfi,det_nre,det_nde,det_obs,det_sta,det_fin,det_con) values ('$ext_detins_act_est->ins_id','$pen_top_sol','$data[0]','$sec_id_nuevo','$ext_tab_equ->asi_cod','$esp_id_sol','$reg_id_sol','$mod_id_sol','$coh_id_sol','$pac_id_nuevo->pac_id','4','','','','','','','','','','','','','','','','$ele_cod','1','','1')");
		    $accion='INSERTAR';
            $Operacion="EQUIVALENCIA: DETINS NUEVO CI: ".$data[0].", MOD: ".$mod_id_sol.", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$coh_id_sol.", PEN: ".$pen_top_sol." ,SEC: ".$sec_id_nuevo." VIEJO: MOD: ".$data[1].", REG: ".$data[4].", ESP: ".$data[2].", COH:".$data[3].", PEN: ".$data[5]." ,SEC: ".$ext_detins_act_est->sec_id;
		    $this->guardar_accion($accion,"detins",$Operacion);
		      if($seccion!=$ext_detins_act_est->sec_id){
			  $seccion=$ext_detins_act_est->sec_id;
			  $this->hist_estud($fec_sol,$num_sol,$seccion,$sec_id_nuevo,$sec_id_nuevo,$data[0],$ext_detins_act_est->det_id,$ci_emp,"11",$descrip,$observ);
			  }
			}
		  }
		  else{
		    $CON_EQU=$this->ConsultarCualquiera($comp_detins_nuevo);
		    if($ext_detins_act_est->sec_id=="89" or $ext_detins_act_est->sec_id=='LF-011'){
			$ele_cod=$ext_detins_act_est->det_obs;
			}
			else{
			$inf=$this->ext_ele_cod($ext_detins_act_est->pac_id, $ext_detins_act_est->asi_cod, $ext_detins_act_est->sec_id, $data[1], $data[4], $data[2], $data[3], $data[5]);
			$ele_cod==$inf;
			}
		  $inf=$this->consul_detins_asig_secc($data[0], $data[1], $data[4], $data[2], $data[3],$data[5], $mod_id_sol, $reg_id_sol, $esp_id_sol, $coh_id_sol, $pen_top_sol, $ext_detins_act_est->ins_id,$ext_detins_act_est->ins_id, $ext_detins_act_est->sec_id, $sec_id_nuevo, $ext_detins_act_est->asi_cod, $ext_tab_equ->asi_cod, $ext_detins_act_est->pac_id, $pac_id_nuevo->pac_id, "4", $ele_cod);
            if($CON_EQU->det_sta==0){
			/*echo "<script>alert('UPDATE detins SET det_sta=1 WHERE ci_est=$data[0] AND mod_id=$mod_id_sol AND reg_id=$reg_id_sol AND esp_id=$esp_id_sol AND coh_id=$coh_id_sol AND pen_top=$pen_top_sol AND det_sta=0 AND ins_id=$ext_detins_act_est->ins_id AND sec_id=$sec_id_nuevo AND asi_cod=$ext_tab_equ->asi_cod AND pac_id=$pac_id_nuevo->pac_id AND obs_id=4');</script>";*/
		    $this->Operacion("UPDATE detins SET det_sta='1' WHERE ci_est='$data[0]' AND mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol' AND det_sta='0' AND ins_id='$ext_detins_act_est->ins_id' AND sec_id='$sec_id_nuevo' AND asi_cod='$ext_tab_equ->asi_cod' AND pac_id='$pac_id_nuevo->pac_id' AND obs_id='4'");
			}
		  }
		}
	  }
    }
	else{
    echo "<script>alert('NO EXISTE TABLA DE EQUIVALENCIAS PARA LOS PENSUM, POR FAVOR AGREGUELOS PRIMERO')
	location.href='../Equivalencia/Listar_Equiv.php'</script>";
	}
  }
//******************************************************************
  function consul_detins_asig_secc($ci, $mod_id_act, $reg_id_act, $esp_id_act, $coh_id_act,$pen_top_act, $mod_id_sol, $reg_id_sol, $esp_id_sol, $coh_id_sol, $pen_top_sol, $ins_id_act, $ins_id_nuevo, $sec_id_act, $sec_id_nuevo, $asi_cod_act, $asi_cod_nuevo, $pac_id_act, $pac_id_nuevo, $obs_id_act, $ele_cod){
  //#############CONSULTAR EL DETINS NUEVO PARA SABER SI EXISTE
  $detins_nuevo=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$ci' AND mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol' AND ins_id='$ins_id_nuevo' AND sec_id='$sec_id_nuevo' AND asi_cod='$asi_cod_nuevo' AND pac_id='$pac_id_nuevo' AND obs_id='$obs_id_act' AND det_sta='1'");
  $fila_detins_nuevo=$this->NumFilas1($detins_nuevo);
    if($fila_detins_nuevo==0){ 
  //############CONSULTAR EL ASIGNA_SECCIO ACTUAL PARA EXTRAER INFORMACION
	  $busc_inf=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$pac_id_act' AND asi_cod='$asi_cod_act' AND sec_id='$sec_id_act' AND mod_id='$mod_id_act' AND reg_id='$reg_id_act' AND esp_id='$esp_id_act' AND coh_id='$coh_id_act' AND pen_top='$pen_top_act' AND ase_sta='1'");
	  $ext_inf=$this->ConsultarCualquiera($busc_inf);
	  $ele_cod=$ext_inf->ele_cod;
  //############CONSULTAR SI EXISTE EL ASIGNA_SECCIO NUEVO 	  
	$asig_sec=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$pac_id_nuevo' AND asi_cod='$asi_cod_nuevo' AND sec_id='$sec_id_nuevo' AND mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol' AND ele_cod='$ele_cod' AND ase_sta='1'");    
	$fila_asig_sec=$this->NumFilas1($asig_sec);
	  if($fila_asig_sec==0){
	  $this->Operacion("INSERT INTO asigna_seccio (pac_id,coh_id,mod_id,reg_id,esp_id,asi_cod,sec_id,pen_top,ci_emp,ele_cod,ase_sta ) values ('$pac_id_nuevo','$coh_id_sol','$mod_id_sol','$reg_id_sol','$esp_id_sol','$asi_cod_nuevo','$sec_id_nuevo','$pen_top_sol','0','$ele_cod','1')"); 
	  $accion='INSERTAR';
      $Operacion="CAMBIO DE ESP: ASIGNA_SECCIO NUEVO MOD: ".$mod_id_sol.", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", COH: ".$coh_id_sol.", PEN: ".$pen_top_sol." ,SEC: ".$sec_id_nuevo.", ELE: ".$ext_inf->ele_cod.", VIEJO: MOD: ".$mod_id_act.", REG: ".$reg_id_act.", ESP: ".$esp_id_act.", COH:".$coh_id_act.", PEN: ".$pen_top_act." ,SEC: ".$sec_id_act.", ELE: ".$ele_cod;	
      $this->guardar_accion($accion,"asigna_seccio",$Operacion); 
	  }  
	  else{
      $consul_ase_sta=$this->ConsultarCualquiera($asigna_sec);
	    if($consul_ase_sta->ase_sta==0){
/*		echo "<script>alert('UPDATE asigna_seccio SET ase_sta=1 WHERE pac_id=$pac_id_nuevo AND asi_cod=$asi_cod_nuevo AND sec_id=$sec_id_nuevo AND mod_id=$mod_id_sol AND reg_id=$reg_id_sol AND esp_id=$esp_id_sol AND coh_id=$coh_id_sol AND pen_top=$pen_top_sol AND ele_cod=$ele_cod AND ase_sta=0');</script>";*/
		$this->Operacion("UPDATE asigna_seccio SET ase_sta='1' WHERE pac_id='$pac_id_nuevo' AND asi_cod='$asi_cod_nuevo' AND sec_id='$sec_id_nuevo' AND mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol' AND ele_cod='$ele_cod' AND ase_sta='0'");	  
		$accion='MODIFICAR';
        $Operacion="ACTIVAR ASIGNA_SECCIO: PAC: ".$ext_detins_act->pac_id.", COH: ".$data[3].", MOD: ".$data[1].", REG: ".$reg_id_sol.", ESP: ".$esp_id_sol.", ASI_COD: ".$ext_detins_act->asi_cod.", SEC: LF-011, PEN: ".$pen_top_sol." ELE: ".$ext_detins_act->det_obs;
		$this->guardar_accion($accion,"asigna_seccio",$Operacion);
		}
	  }
	}
  }
//******************************************************************
  function ext_ele_cod($pac_id_act, $asi_cod_act, $sec_id_act, $mod_id_act, $reg_id_act, $esp_id_act, $coh_id_act, $pen_top_act){
  //############CONSULTAR EL ASIGNA_SECCIO ACTUAL PARA EXTRAER INFORMACION
  $busc_inf=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$pac_id_act' AND asi_cod='$asi_cod_act' AND sec_id='$sec_id_act' AND mod_id='$mod_id_act' AND reg_id='$reg_id_act' AND esp_id='$esp_id_act' AND coh_id='$coh_id_act' AND pen_top='$pen_top_act' AND ase_sta='1'");
  $ext_inf=$this->ConsultarCualquiera($busc_inf);
  $ele_cod=$ext_inf->ele_cod;
  return $ele_cod;
  }
//******************************************************************
  function hist_estud($fec_sol,$num_sol,$sec_id_act,$sec_id_nuevo,$sec_id_aprob,$ci,$det_id,$ci_emp,$pro_id,$descrip,$observ){
  $num_sol=strtoupper($num_sol);
  $descrip=strtoupper($descrip);
  $observ=strtoupper($observ);
  $dias=time();
  $fecha=date("Y-m-d",$dias);
  $fec_sol1=explode("/",$fec_sol);
  $fec_sol2=$fec_sol1[2]."-".$fec_sol1[1]."-".$fec_sol1[0];
  /*echo "<script>alert('$fec_sol2,$num_sol,$sec_id_act,$sec_id_nuevo,1,$ci,$ci_emp,$pro_id,$fecha,$descrip,$obsev')</script>";*/
  $this->Operacion("INSERT INTO hisest (his_fso,his_sol,his_sac,his_sso,his_sap,his_sta,ci_est,det_id,ci_emp,pro_id,his_fap,his_obs,his_des) values ('$fec_sol2','$num_sol','$sec_id_act','$sec_id_nuevo','$sec_id_nuevo','1','$ci','$det_id','$ci_emp','$pro_id','$fecha','$descrip','$observ')");
  $accion='INSERTAR';
  $Operacion=$descrip." DEL ESTUD CI: ".$data[0];
  $this->guardar_accion($accion,"hisest",$Operacion);
  }
//******************************************************************
  function busc_nucleo_carrera($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $this->Operacion("SELECT E.nuc_nom AS nuc_nom, F.esp_nom AS esp_nom FROM matric A, detins B, estudi_infrae C, infrae D, nucleo E, especi F WHERE A.ci='$ci' AND A.matr_sta='1' AND A.matr_tip='0' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.ci=B.ci_est AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.obs_id='4' AND B.det_sta='1' AND A.ci=C.ci AND C.est_inf_ffi='0000-00-00 00:00' AND C.inf_id=D.inf_id AND D.inf_sta='1' AND D.nuc_id=E.nuc_id AND nuc_sta='1' AND B.esp_id=F.esp_id GROUP BY A.ci");
  return $this->resul;
  }
//******************************************************************
  function busc_mod_coh_nom($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$sta){
    if($sta=="valor")
	$sta=1;
	else
	$sta=0;
  $this->Operacion("SELECT B.mod_nom AS mod_nom, C.coh_nom AS coh_nom FROM matric A, modali B, cohort C WHERE A.ci='$ci' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.matr_sta='$sta' AND A.matr_tip='0' AND B.mod_id=A.mod_id AND B.mod_sta='1' AND C.coh_id=A.coh_id AND C.coh_sta='1'");
  return $this->resul;
  }
//******************************************************************
  function consul_asi_cod($data_princ){
  $data=explode("*",$data_princ);
  $this->Operacion("SELECT A.asi_cod AS asi_cod, B.asi_nom AS asi_nom FROM detins A, asigna B WHERE A.ci_est='$data[0]' AND A.mod_id='$data[1]' AND A.reg_id='$data[4]' AND A.esp_id='$data[2]' AND A.coh_id='$data[3]' AND A.pen_top='$data[5]' AND A.det_sta='1' AND obs_id='4' AND A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND asi_sta='1'");
  return $this->resul;
  }
//******************************************************************  
  function consul_asi_cod_eq($data_princ,$mod_id_sol,$reg_id_sol,$esp_id_sol,$coh_id_sol,$pen_top_sol,$asi_cod){
  $data=explode("*",$data_princ);	
  $this->Operacion("SELECT asi_cod_eq FROM tabequ WHERE mod_id_eq='$mod_id_sol' AND reg_id_eq='$reg_id_sol' AND esp_id_eq='$esp_id_sol' AND coh_id_eq='$coh_id_sol' AND pen_top_eq='$pen_top_sol' AND mod_id='$data[1]' AND reg_id='$data[4]' AND esp_id='$data[2]' AND coh_id='$data[3]' AND pen_top='$data[5]' AND asi_cod='$asi_cod' AND teq_sta='1' GROUP BY mod_id, reg_id, esp_id, coh_id, pen_top, mod_id_eq, reg_id_eq, esp_id_eq, coh_id_eq, pen_top_eq, asi_cod, asi_cod_eq");
  return $this->resul;
  }
//******************************************************************
  function consul_nom_asi_cod($data_princ,$mod_id_sol,$reg_id_sol,$esp_id_sol,$coh_id_sol,$pen_top_sol,$asi_cod_eq){
  $data=explode("*",$data_princ);
  $this->Operacion("SELECT A.asi_cod AS asi_cod, B.asi_nom AS asi_nom FROM detins A, asigna B WHERE A.ci_est='$data[0]' AND A.mod_id='$mod_id_sol' AND A.reg_id='$reg_id_sol' AND A.esp_id='$esp_id_sol' AND A.coh_id='$coh_id_sol' AND A.pen_top='$pen_top_sol' AND A.det_sta='1' AND A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod='$asi_cod_eq' AND asi_sta='1'");
  return $this->resul;
  }
//******************************************************************
  function check_mat($ci,$mod_id_sol,$reg_id_sol,$esp_id_sol,$coh_id_sol,$pen_top_sol){
  $this->Operacion("SELECT * FROM matric WHERE ci='$ci' AND mod_id='$mod_id_sol' AND reg_id='$reg_id_sol' AND esp_id='$esp_id_sol' AND coh_id='$coh_id_sol' AND pen_top='$pen_top_sol' AND matr_sta=0 AND matr_tip='0'");
  return $this->resul;  
  } 
//****************************************************************** 
  function observ($ci){
  $this->Operacion("SELECT his_des FROM hisest WHERE ci_est='$ci' AND pro_id='11' ORDER BY his_fap AND his_sta='1'");
  return $this->resul;
  }
//****************************************************************** 
  function busc_alum_equiv($ci){
  $this->Operacion("SELECT A.ci FROM matric A, detins B WHERE A.ci='$ci' AND A.matr_sta='1' AND A.matr_tip='0' AND A.ci=B.ci_est AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.det_sta='1' AND B.obs_id='4'");
  $fila=$this->ConsultarCualquiera($this->resul);
  return $fila;
  }
}
?>