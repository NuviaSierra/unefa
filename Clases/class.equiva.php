<?php session_start();
class equiv extends conec_BD
{
//******************************************************************
  function List_modali(){
    $resultado=$this->Operacion("SELECT A.mod_id AS 'mod_id', A.mod_nom AS 'mod_nom' FROM modali A, reg_esp_mod B  WHERE A.mod_sta='1' AND A.mod_id=B.mod_id GROUP BY A.mod_id ORDER BY A.mod_nom");
    return $resultado;
  }
//******************************************************************
 function Buscar_Campos1($valor,$cual){
    $id="";
	$des="";
	$cuantos=0;
	$this->mod_id=$valor;
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
	$val=explode("*",$valor);
	$this->esp_id=$val[0];
	$this->reg_id=$val[1];
	$this->mod_id=$val[2];
	$resp=$this->OperacionCualquiera("SELECT A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom' FROM pensum A, cohort B WHERE pen_sta='1' AND A.mod_id='$this->mod_id' AND A.reg_id='$this->reg_id' AND A.esp_id='$val[0]' AND A.coh_id=B.coh_id GROUP BY A.coh_id ORDER BY B.coh_nom");
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
function Buscar_pensum($mod_id, $reg_id, $esp_id, $coh_id){
    $this->Operacion("SELECT distinct A.mod_id AS 'mod_id', B.mod_nom AS 'mod_nom', A.reg_id AS 'reg_id', C.reg_nom AS 'reg_nom', A.esp_id AS 'esp_id', D.esp_nom AS 'esp_nom', A.coh_id AS 'coh_id', E.coh_nom AS 'coh_nom', A.pen_mpa AS 'pen_mpa', A.pen_muc AS 'pen_muc', A.pen_mpe AS 'pen_mpe', A.pen_obs AS 'pen_obs' FROM pensum A, modali B, regimen C, especi D, cohort E WHERE A.mod_id='$mod_id' AND A.mod_id=B.mod_id AND A.reg_id='$reg_id' AND A.reg_id=C.reg_id AND A.esp_id='$esp_id' AND A.esp_id=D.esp_id AND A.coh_id='$coh_id' AND A.coh_id=E.coh_id");
  }
//******************************************************************
  function Buscar_asigna($cod_asig){
    $this->Operacion("SELECT * FROM asigna WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$cod_asig'");
    $num_filas=$this->NumFilas();
    return $num_filas;
 }
//******************************************************************
function Listado_asigna($mod_id, $reg_id, $esp_id, $coh_id){
    $resultado=$this->Operacion("SELECT asi_cod,asi_nom,asi_mod FROM asigna WHERE coh_id='$coh_id' AND mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND asi_sta='1' GROUP BY mod_id,reg_id,esp_id,coh_id,asi_cod order by asi_mod, asi_cod");
    return $resultado;
  }
//******************************************************************
function Listado_equivalencia($mod_id_eq, $reg_id_eq, $esp_id_eq, $coh_id_eq, $asi_cod,$mod_id, $reg_id, $esp_id, $coh_id){
/*    echo "<script>alert('Listado_equivalencia $mod_id, $reg_id, $esp_id, $coh_id, $asi_cod');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT asi_cod ,asi_cod_eq FROM tabequ WHERE coh_id_eq='$coh_id_eq' AND mod_id_eq='$mod_id_eq' AND esp_id_eq='$esp_id_eq' AND reg_id_eq='$reg_id_eq' AND asi_cod='$asi_cod' AND coh_id='$coh_id' AND mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND teq_sta='1' GROUP BY mod_id,reg_id,esp_id,coh_id,asi_cod,asi_cod_eq order by asi_cod_eq");
    return $resultado;
  }
//******************************************************************
    function Listado_asigna2($mod_id, $reg_id, $esp_id, $coh_id){
    $resultado=$this->OperacionCualquiera("SELECT asi_cod,asi_nom FROM asigna WHERE coh_id='$coh_id' AND mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND asi_sta='1' GROUP BY mod_id,reg_id,esp_id,coh_id,asi_cod order by asi_mod,asi_cod");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($mod_id, $reg_id, $esp_id, $coh_id, $pen_top, $obs, $paca, $per, $uc, $asigna, $sta){
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
//***************************************************************************************
function Equivalencia($coh_id,$mod_id,$reg_id,$esp_id,$asi_cod,$coh_id_eq,$mod_id_eq,$reg_id_eq,$esp_id_eq,$asi_cod_eq){
  $resp=$this->Operacion("SELECT * FROM `tabequ` WHERE coh_id='$coh_id' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND asi_cod='$asi_cod' AND coh_id_eq='$coh_id_eq' AND mod_id_eq='$mod_id_eq' AND reg_id_eq='$reg_id_eq' AND esp_id_eq='$esp_id_eq' AND asi_cod_eq='$asi_cod_eq'");
  if($this->NumFilasCualquiera($resp)>0){
  $this->Operacion("UPDATE tabequ SET teq_sta=1 WHERE coh_id='$coh_id' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND asi_cod='$asi_cod' AND coh_id_eq='$coh_id_eq' AND mod_id_eq='$mod_id_eq' AND reg_id_eq='$reg_id_eq' AND esp_id_eq='$esp_id_eq' AND asi_cod_eq='$asi_cod_eq' AND teq_sta=0");
  $accion='MODIFICAR';
  $Operacion="MODIFICAR LA EQUIVALENCIA DE MOD_ID_EQ:".$mod_id_eq.", REG_ID_EQ:".$reg_id_eq.", ESP_ID_EQ:".$esp_id_eq.", COH_ID_EQ:".$coh_id_eq.", MOD_ID:".$mod_id.", REG_ID:".$reg_id.", ESP_ID:".$esp_id.", COH_ID:".$coh_id.", DE INACTIVO A ACTIVO";	
  $this->guardar_accion($accion,"tabequ",$Operacion);
  }
  else
  {
  $this->Operacion("INSERT INTO tabequ (pen_top,pen_top_eq,coh_id_eq,mod_id_eq,reg_id_eq,esp_id_eq,asi_cod_eq,coh_id,mod_id,reg_id,esp_id,asi_cod,teq_sta) values ('1','1','$coh_id_eq','$mod_id_eq','$reg_id_eq','$esp_id_eq','$asi_cod_eq','$coh_id','$mod_id','$reg_id','$esp_id','$asi_cod','1'),('0','0','$coh_id_eq','$mod_id_eq','$reg_id_eq','$esp_id_eq','$asi_cod_eq','$coh_id','$mod_id','$reg_id','$esp_id','$asi_cod','1'),('0','1','$coh_id_eq','$mod_id_eq','$reg_id_eq','$esp_id_eq','$asi_cod_eq','$coh_id','$mod_id','$reg_id','$esp_id','$asi_cod','1'),('1','0','$coh_id_eq','$mod_id_eq','$reg_id_eq','$esp_id_eq','$asi_cod_eq','$coh_id','$mod_id','$reg_id','$esp_id','$asi_cod','1')");
  $accion='INSERTAR';
  $Operacion="INSERTAR LA EQUIVALENCIA DE MOD_ID_EQ:".$mod_id_eq.", REG_ID_EQ:".$reg_id_eq.", ESP_ID_EQ:".$esp_id_eq.", COH_ID_EQ:".$coh_id_eq.", MOD_ID:".$mod_id.", REG_ID:".$reg_id.", ESP_ID:".$esp_id.", COH_ID:".$coh_id;	
  $this->guardar_accion($accion,"tabequ",$Operacion);
  }
  return $this->NumFilasCualquiera($resp);
}
//**************************************************************************************
function Elim_equiva($coh_id,$mod_id,$reg_id,$esp_id,$coh_id_eq,$mod_id_eq,$reg_id_eq,$esp_id_eq){
  $this->Operacion("UPDATE tabequ SET teq_sta=0 WHERE coh_id='$coh_id' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id_eq='$coh_id_eq' AND mod_id_eq='$mod_id_eq' AND reg_id_eq='$reg_id_eq' AND esp_id_eq='$esp_id_eq' AND teq_sta=1");
}
//**************************************************************************************
function comprobar($coh_id,$mod_id,$reg_id,$esp_id,$coh_id_eq,$mod_id_eq,$reg_id_eq,$esp_id_eq){
$resp=$this->Operacion("SELECT DISTINCT teq_id AS teq_id FROM `tabequ` WHERE coh_id='$coh_id' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id_eq='$coh_id_eq' AND mod_id_eq='$mod_id_eq' AND reg_id_eq='$reg_id_eq' AND esp_id_eq='$esp_id_eq'");
  if($this->NumFilasCualquiera($resp)>0){
  $this->Operacion("update tabequ set teq_sta=0 WHERE coh_id='$coh_id' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id_eq='$coh_id_eq' AND mod_id_eq='$mod_id_eq' AND reg_id_eq='$reg_id_eq' AND esp_id_eq='$esp_id_eq' AND teq_sta=1");
  }
}
//***************************************************************************************
function ListEquiv($valor){
$Valor=explode("*","$valor");
$valor=$this->OperacionCualquiera("SELECT B.asi_mod, B.asi_cod, A.asi_cod_eq  FROM tabequ A, asigna B WHERE A.coh_id=B.coh_id AND A.coh_id='$Valor[2]' AND A.mod_id=B.mod_id AND A.mod_id='$Valor[0]' AND A.esp_id=B.esp_id AND A.esp_id='$Valor[3]' AND A.reg_id=B.reg_id AND A.reg_id='$Valor[1]' AND A.asi_cod=B.asi_cod AND A.coh_id_eq='$Valor[6]' AND A.mod_id_eq='$Valor[4]' AND A.esp_id_eq='$Valor[7]' AND A.reg_id_eq='$Valor[5]' AND A.teq_sta='1' GROUP BY A.mod_id,A.reg_id,A.esp_id,A.coh_id,A.asi_cod,A.asi_cod_eq ORDER BY B.asi_mod, B.asi_cod");
return $valor;
}
function MatEquiv($id, $reg_id, $coh_id, $mod_id, $esp_id){
$valor=$this->OperacionCualquiera("SELECT * FROM asigna WHERE asi_cod='$id' AND reg_id='$reg_id' AND coh_id='$coh_id' AND mod_id='$mod_id' AND esp_id='$esp_id'");
return $valor;
}
}
?>