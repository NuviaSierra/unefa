<?php session_start();
class EsReMo extends conec_BD
{
 var $esp_id='';
 var $mod_id='';
 var $reg_id='';
 var $sta='';
//******************************************************************
  function EsReMo($esp_id, $mod_id, $reg_id, $sta){
    $this->esp_id=$id;
    $this->mod_id=$mod_id;
    $this->reg_id=$reg_id;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_EsReMo(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM reg_esp_mod WHERE rem_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_EsReMo($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT B.mod_nom AS 'mod_nom', C.reg_nom AS 'reg_nom', D.esp_nom AS 'esp_nom', B.mod_id AS 'mod_id', C.reg_id AS 'reg_id', A.esp_id AS 'esp_id' FROM reg_esp_mod A, modali B, regimen C, especi D WHERE A.rem_sta='1' AND A.mod_id=B.mod_id AND A.reg_id=C.reg_id AND A.esp_id=D.esp_id order by B.mod_nom, C.reg_nom, D.esp_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_modalidad(){
    $resultado=$this->Operacion("SELECT * FROM modali WHERE mod_sta='1' order by mod_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_regimen(){
    $resultado=$this->Operacion("SELECT * FROM regimen WHERE reg_sta='1' order by reg_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_especialidad(){
    $resultado=$this->Operacion("SELECT esp_id, A.esp_nom AS 'esp_nom', A.niv_id AS 'niv_id', B.niv_nom AS 'niv_nom' FROM especi A, nivela B WHERE A.esp_sta='1' AND A.niv_id=B.niv_id order by B.niv_nom, A.esp_nom");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($esp_id, $mod_id, $reg_id, $sta){
    $this->esp_id=$esp_id;
    $this->mod_id=$mod_id;
    $this->reg_id=$reg_id;
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_EsReMo(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM reg_esp_mod WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND rem_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_EsReMo(){
/*    echo "<script>alert('$this->esp_id, $this->rem_mpa, $this->rem_muc, $this->rem_tpm');</script>";*/
    $esp_id=explode("*",$this->esp_id);
	$i=0;
    $cuantas=0;
	$verd=0;
	while($esp_id[$i]!=""){
	  $this->Buscar_EsReMo2($this->mod_id,$this->reg_id,$esp_id[$i]);
      $num_filas=$this->NumFilas();
	  if($num_filas<=0){
/*      echo "<script>alert('$this->mod_id, $this->reg_id, $esp_id[$i], $this->sta');</script>";*/
/*	  echo "<script>alert('INSERT INTO reg_esp_mod (mod_id, reg_id, esp_id, rem_sta) VALUES ($this->mod_id, $this->reg_id, $esp_id[$i], $this->sta)');</script>";*/
      $res=$this->OperacionCualquiera("INSERT INTO reg_esp_mod (mod_id, reg_id, esp_id, rem_sta) VALUES ('$this->mod_id', '$this->reg_id', '$esp_id[$i]', '$this->sta')");
      $num_filas=$this->filas_afectadas($res);
/*	  echo "<script>alert('$num_filas');</script>";*/
	  if($num_filas>0){
	    $cuantas++;
		$accion='INSERTAR';
		$Operacion="MOD: ".$this->mod_id." REG: ".$this->reg_id." ESP:".$esp_id[$i];	
		$this->guardar_accion($accion,"reg_esp_mod",$Operacion);
	  }
	  else{
	    $this->Eliminar_EsReMo($esp_id[$i]);
	  }
	  $i++;
	  }
	}
	if($i==$cuantas && $i!=0)
	  $verd=1;
    return $verd;
  }
//******************************************************************
  function Buscar_EsReMo2($mod_id,$reg_id,$esp_id){
    $resultado=$this->Operacion("SELECT * FROM reg_esp_mod WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND rem_sta='1'");
  }
//******************************************************************
  function Buscar_modalidad($id){
    $resultado=$this->Operacion("SELECT * FROM modali WHERE mod_id='$id'");
  }
//******************************************************************
  function Buscar_regimen($id){
    $resultado=$this->Operacion("SELECT * FROM regimen WHERE reg_id='$id'");
  }
//******************************************************************
  function Buscar_especialidad($id){
    $resultado=$this->Operacion("SELECT * FROM especi WHERE esp_id='$id'");
  }
//******************************************************************
  function Modificar_EsReMo(){
    $res=$this->Operacion("UPDATE reg_esp_mod set WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_EsReMo($esp_id){
    $res=$this->Operacion("UPDATE reg_esp_mod set rem_sta='$this->sta' WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$esp_id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_EsReMo2($esp_id){
    $res=$this->Operacion("UPDATE reg_esp_mod set rem_sta='$this->sta' WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>