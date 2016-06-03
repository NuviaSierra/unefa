<?php session_start();
class cohorte extends conec_BD
{
 var $id='';
 var $coh_nom='';
 var $coh_des='';
 var $sta='';
//******************************************************************
  function cohorte($id,$coh_nom,$coh_des,$sta){
    $this->id=$id;
	$this->coh_nom=$this->ConvertirMayuscula($coh_nom);
    $this->coh_des=$coh_des;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_cohorte(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM cohort WHERE coh_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_cohorte($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT * FROM cohort WHERE coh_sta='1' order by coh_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$coh_nom,$coh_des,$sta){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->id=$this->ConvertirMayuscula($id);
/*    echo "<script>alert('id: $this->id');</script>";*/
	$this->coh_nom=$this->ConvertirMayuscula($coh_nom);
    $this->coh_des=$this->ConvertirMayuscula($coh_des);
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_cohorte($id){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->Operacion("SELECT * FROM cohort WHERE coh_id='$id'");
  }
//******************************************************************
  function Buscar_Nombre(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM cohort WHERE coh_nom='$this->coh_nom' AND coh_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM cohort WHERE coh_id='$this->id' AND coh_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Nombre2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM cohort WHERE coh_nom='$this->coh_nom' AND coh_sta='1' AND coh_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM cohort WHERE coh_id='$this->id' AND coh_sta='1' AND coh_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_cohorte(){
    $res=$this->Operacion("INSERT INTO cohort (coh_id, coh_nom, coh_obs, coh_sta)
						VALUES ('$this->id','$this->coh_nom', '$this->coh_des', '$this->sta')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_cohorte(){
    $res=$this->Operacion("UPDATE cohort set coh_nom='$this->coh_nom', coh_obs='$this->coh_des' WHERE coh_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_cohorte(){
    $res=$this->Operacion("UPDATE cohort set coh_sta='$this->sta' WHERE coh_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>