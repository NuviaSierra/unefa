<?php session_start();
class fechas extends conec_BD
{
 var $id='';
 var $pac_id='';
 var $fn1='';
 var $fp1='';
 var $fn2='';
 var $fp2='';
 var $fn3='';
 var $fp3='';
 var $fnr='';
 var $sta='';
 var $mod_id='';
//******************************************************************
  function pacade($id, $pac_id, $fn1, $fp1, $fn2, $fp2, $fn3, $fp3, $fnr){
    $this->id=$id;
    $this->pac_id=$pac_id;
    $this->fn1=$this->fechaMySql($fn1);
    $this->fp1=$this->fechaMySql($fp1);
    $this->fn2=$this->fechaMySql($fn2);
    $this->fp2=$this->fechaMySql($fp2);
    $this->fn3=$this->fechaMySql($fn3);
    $this->fp3=$this->fechaMySql($fp3);
    $this->fnr=$this->fechaMySql($fnr);
  }
//******************************************************************
  function Contar_pacade(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM pacade WHERE pac_sta='1' order by pac_ffin DESC");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_pacade($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT A.pac_nom AS 'pac_nom', A.pac_id AS 'pac_id', B.mod_nom AS 'mod_nom' FROM pacade A, modali B WHERE A.mod_id=B.mod_id AND pac_sta='1' order by A.pac_ffin DESC LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_modalidad(){
    $resultado=$this->Operacion("SELECT * FROM modali WHERE mod_sta='1' order by mod_nom");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id, $mod_id, $pac_id, $fn1, $hmsn1, $fp1, $hmsp1, $fn2, $hmsn2, $fp2, $hmsp2, $fn3, $hmsn3, $fp3, $hmsp3, $fnr, $hmsnr){
    $this->id=$id;
    $this->pac_id=$pac_id;
    $this->fn1=$this->fechaMySql($fn1)." ".$hmsn1;
    $this->fp1=$this->fechaMySql($fp1)." ".$hmsp1;
    $this->fn2=$this->fechaMySql($fn2)." ".$hmsn2;
    $this->fp2=$this->fechaMySql($fp2)." ".$hmsp2;
    $this->fn3=$this->fechaMySql($fn3)." ".$hmsn3;
    $this->fp3=$this->fechaMySql($fp3)." ".$hmsp3;
    $this->fnr=$this->fechaMySql($fnr)." ".$hmsnr;
/*    echo "<script>alert('FECHA Y HORA DE REPARACIÓN $this->fnr');</script>";*/
	$this->mod_id=$mod_id;
/*		echo "<script>alert('$this->id,$this->pac_id,$this->fn1,$this->fp1,$this->fn2,$this->fp2,$this->fn3,$this->fp3,$this->fnr,$this->mod');</script>";*/
  }
//******************************************************************
  function Buscar_pacade($id){
    $this->Operacion("SELECT * FROM pacade WHERE pac_id='$id'");
  }
//******************************************************************
  function Buscar_pacade_Mod($id){
    $resultado=$this->Operacion("SELECT A.pac_nom AS 'pac_nom', A.pac_id AS 'pac_id', B.mod_nom AS 'mod_nom' FROM pacade A, modali B WHERE A.mod_id=B.mod_id AND pac_sta='1' AND A.pac_id='$id'");
    return $resultado;
  }
//******************************************************************
  function Buscar_fe_ci_no($id){
    $this->Operacion("SELECT * FROM fe_ci_no WHERE pac_id='$id'");
  }
//******************************************************************
  function Agregar_fe_ci_no(){
  $num_filas=0;
/*  		echo "<script>alert('INSERT INTO fe_ci_no (pac_id, fcn_po1, fcn_ni1, fcn_po2, fcn_ni2, fcn_po3, fcn_ni3, fcn_nir) VALUES($this->pac_id,$this->fp1,$this->fn,$this->fp2,$this->fn2,$this->fp3,$this->fn3,$this->fnr)');</script>";*/
    $insert=$this->OperacionCualquiera("INSERT INTO fe_ci_no (pac_id, fcn_po1, fcn_ni1, fcn_po2, fcn_ni2, fcn_po3, fcn_ni3, fcn_nir) VALUES('$this->pac_id','$this->fp1','$this->fn1','$this->fp2','$this->fn2','$this->fp3','$this->fn3','$this->fnr')");	
	$num_filas=$this->filas_afectadas($insert);
/*  	echo "<script>alert('$num_filas>0');</script>";*/
	if($num_filas>0){
	  $ultimo=mysql_insert_id();
	  $accion='INSERTAR';
	  $Operacion="ID: ".$ultimo.", PACADE: ".$this->pac_id.", FCP1: ".$this->fp1.", FCN1: ".$this->fn1.", FCP2: ".$this->fp2.", FCN2: ".$this->fn2.", FCP3: ".$this->fp3.", FCN3: ".$this->fn3.", FCR: ".$this->fnr."";	
	  $this->guardar_accion($accion,"fe_ci_no",$Operacion);
	}
	return $num_filas;	
  }
//******************************************************************
  function Modificar_fe_ci_no($id){
  $num_filas=0;
    $insert=$this->OperacionCualquiera("UPDATE fe_ci_no SET fcn_po1='$this->fp1', fcn_ni1='$this->fn1', fcn_po2='$this->fp2', fcn_ni2='$this->fn2', fcn_po3='$this->fp3', fcn_ni3='$this->fn3', fcn_nir='$this->fnr' WHERE pac_id='$id'");
	$num_filas=$this->filas_afectadas($insert);
	if($num_filas>0){
	  $sel=$this->OperacionCualquiera("SELECT * FROM fe_ci_no WHERE pac_id='$id'");
	  $a_sel=$this->ConsultarCualquiera($sel);
	  $ultimo=$a_sel->fcn_id;
	  $accion='MODIFICAR';
	  $Operacion="ID: ".$ultimo.", PACADE: ".$this->pac_id.", FCP1: ".$this->fp1.", FCN1: ".$this->fn1.", FCP2: ".$this->fp2.", FCN2: ".$this->fn2.", FCP3: ".$this->fp3.", FCN3: ".$this->fn3.", FCR: ".$this->fnr."";	
	  $this->guardar_accion($accion,"fe_ci_no",$Operacion);
	}
	return $num_filas;
  }
//******************************************************************
  function Buscar_mod($id){
    $this->Operacion("SELECT * FROM modali WHERE mod_id='$id'");
  }
//******************************************************************
}?>