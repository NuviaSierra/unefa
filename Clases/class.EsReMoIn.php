<?php session_start();
class EsReMoIn extends conec_BD
{
 var $esp_id='';
 var $mod_id='';
 var $reg_id='';
 var $inf_id='';
 var $remi_tca='';
 var $sta='';
//******************************************************************
  function EsReMoIn($esp_id, $mod_id, $reg_id, $inf_id, $remi_tca, $sta){
    $this->esp_id=$id;
    $this->mod_id=$mod_id;
    $this->reg_id=$reg_id;
    $this->inf_id=$inf_id;
    $this->remi_tca=$remi_tca;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_EsReMoIn(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM reg_esp_mod_infrae WHERE remi_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Contar_Infrae(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM infrae WHERE inf_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_EsReMo(){
    $resultado=$this->Operacion("SELECT B.mod_nom AS 'mod_nom', C.reg_nom AS 'reg_nom', D.esp_nom AS 'esp_nom', B.mod_id AS 'mod_id', C.reg_id AS 'reg_id', A.esp_id AS 'esp_id' FROM reg_esp_mod A, modali B, regimen C, especi D WHERE A.rem_sta='1' AND A.mod_id=B.mod_id AND A.reg_id=C.reg_id AND A.esp_id=D.esp_id order by B.mod_nom, C.reg_nom, D.esp_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Infrae(){
    $resultado=$this->Operacion("SELECT B.nuc_nom AS 'nuc_nom', A.inf_nom AS 'inf_nom', A.nuc_id AS 'nuc_id', A.inf_id AS 'inf_id' FROM infrae A, nucleo B WHERE A.inf_sta='1' AND A.nuc_id=B.nuc_id order by B.nuc_nom, A.inf_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_EsReMoIn($mod_id,$reg_id,$esp_id,$inf_id){
/*  echo "<script>alert('SELECT * FROM reg_esp_mod_infrae WHERE remi_sta=1 AND mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND inf_id=$inf_id');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT * FROM reg_esp_mod_infrae WHERE remi_sta='1' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND inf_id='$inf_id'");
    return $resultado;
  }
//******************************************************************
  function Listado_EsReMoIn2($inf_id){
/*  echo "<script>alert('SELECT B.mod_nom AS mod_nom, C.reg_nom AS reg_nom, D.esp_nom AS esp_nom, B.mod_id AS mod_id, C.reg_id AS reg_id, A.esp_id AS esp_id, A.remi_tca AS remi_tca FROM reg_esp_mod_infrae A, modali B, regimen C, especi D WHERE remi_sta=1 AND inf_id=$inf_id AND A.mod_id=B.mod_id AND A.reg_id=C.reg_id AND A.esp_id=D.esp_id order by B.mod_nom, C.reg_nom, D.esp_nom');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT B.mod_nom AS 'mod_nom', C.reg_nom AS 'reg_nom', D.esp_nom AS 'esp_nom', B.mod_id AS 'mod_id', C.reg_id AS 'reg_id', A.esp_id AS 'esp_id', A.remi_tca AS 'remi_tca' FROM reg_esp_mod_infrae A, modali B, regimen C, especi D WHERE remi_sta='1' AND inf_id='$inf_id' AND A.mod_id=B.mod_id AND A.reg_id=C.reg_id AND A.esp_id=D.esp_id order by B.mod_nom, C.reg_nom, D.esp_nom");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($esp_id, $mod_id, $reg_id, $inf_id, $remi_tca, $sta){
    $this->esp_id=$esp_id;
    $this->mod_id=$mod_id;
    $this->reg_id=$reg_id;
    $this->inf_id=$inf_id;
    $this->remi_tca=$remi_tca;
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_EsReMoIn(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM reg_esp_mod_infrae WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND inf_id='$this->inf_id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function EsReMoIn_Agr_mod(){
/*    echo "<script>alert('$this->esp_id,$this->reg_id,$this->mod_id,$this->remi_tca,$this->inf_id');</script>";*/
    $mod_id=explode("*",$this->mod_id);
    $reg_id=explode("*",$this->reg_id);
    $esp_id=explode("*",$this->esp_id);
	$remi_tca=explode("*",$this->remi_tca);
	$i=0;
	$this->Eliminar_EsReMoIn_Todo($this->inf_id);
/*	echo "<script>alert('ELIMINO TODO $band');</script>";*/
	while($esp_id[$i]!=""){
	  $this->Buscar_EsReMoIn2($mod_id[$i],$reg_id[$i],$esp_id[$i],$this->inf_id);
      $num_filas=$this->NumFilas();
/*	echo "<script>alert('BUSCAR TODO $num_filas');</script>";*/
	  if($num_filas<=0){
        $num_filas=$this->Agregar_EsReMoIn($mod_id[$i],$reg_id[$i],$esp_id[$i],$this->inf_id,$remi_tca[$i]);
/*	echo "<script>alert('INSERTO TODO $num_filas');</script>";*/
	    if($num_filas>0){
		  $accion='INSERTAR';
		  $Operacion="MOD: ".$mod_id[$i]." REG: ".$reg_id[$i]." ESP:".$esp_id[$i]." INF:".$this->inf_id;
		  $this->guardar_accion($accion,"reg_esp_mod_infrae",$Operacion);
/*	echo "<script>alert('INSERTO EN BITACORA');</script>";*/
	    }
	  }
	  else{
        $num_filas=$this->Modificar_EsReMoIn($mod_id[$i],$reg_id[$i],$esp_id[$i],$this->inf_id,$remi_tca[$i]);
/*	echo "<script>alert('MODIFICO TODO $num_filas');</script>";*/
	    if($num_filas>0){
		  $accion='MODIFICAR';
  		  $Operacion="MOD: ".$this->mod_id." REG: ".$this->reg_id." ESP: ".$esp_id[$i]." INF:".$this->inf_id;
		  $this->guardar_accion($accion,"reg_esp_mod_infrae",$Operacion);
/*	echo "<script>alert('MODIFICO EN BITACORA');</script>";*/
  	    }	
	  }
	  $i++;
	}
    return 1;
  }
//******************************************************************
  function Buscar_EsReMoIn2($mod_id,$reg_id,$esp_id,$inf_id){
    $resultado=$this->Operacion("SELECT * FROM reg_esp_mod_infrae WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND inf_id='$inf_id' AND esp_id='$esp_id'");
  }
//******************************************************************
  function Buscar_Infrae($inf_id){
    $resultado=$this->Operacion("SELECT * FROM infrae WHERE inf_id='$inf_id'");
  }
//******************************************************************
  function Agregar_EsReMoIn($mod_id,$reg_id,$esp_id,$inf_id,$remi_tca){
      $res=$this->OperacionCualquiera("INSERT INTO reg_esp_mod_infrae (mod_id, reg_id, esp_id, inf_id, remi_tca, remi_sta) VALUES ('$mod_id', '$reg_id', '$esp_id', '$inf_id', '$remi_tca', '1')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_EsReMoIn($mod_id,$reg_id,$esp_id,$inf_id,$remi_tca){
/*	echo "<script>alert('UPDATE reg_esp_mod_infrae set remi_tca=$remi_tca, remi_sta=1 WHERE mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND inf_id=$inf_id');</script>";*/
    $res=$this->Operacion("UPDATE reg_esp_mod_infrae set remi_tca='$remi_tca', remi_sta='1' WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND inf_id='$inf_id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_EsReMoIn_Todo($inf_id){
    $res=$this->Operacion("UPDATE reg_esp_mod_infrae set remi_sta='0' WHERE inf_id='$inf_id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>