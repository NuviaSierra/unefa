<?php session_start();
class regimen extends conec_BD
{
 var $id='';
 var $reg_nom='';
 var $reg_des='';
 var $sta='';
//******************************************************************
  function regimen($id,$reg_nom,$reg_des,$sta){
    $this->id=$id;
	$this->reg_nom=$reg_nom;
    $this->reg_des=$reg_des;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_regimen(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM regimen WHERE reg_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_regimen($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT * FROM regimen WHERE reg_sta='1' order by reg_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$reg_nom,$reg_des,$sta){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->id=$this->ConvertirMayuscula($id);
/*    echo "<script>alert('id: $this->id');</script>";*/
	$this->reg_nom=$this->ConvertirMayuscula($reg_nom);
    $this->reg_des=$this->ConvertirMayuscula($reg_des);
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_regimen($id){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->Operacion("SELECT * FROM regimen WHERE reg_id='$id'");
  }
//******************************************************************
  function Buscar_Nombre(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM regimen WHERE reg_nom='$this->reg_nom' AND reg_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM regimen WHERE reg_id='$this->id' AND reg_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Nombre2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM regimen WHERE reg_nom='$this->reg_nom' AND reg_sta='1' AND reg_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM regimen WHERE reg_id='$this->id' AND reg_sta='1' AND reg_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_regimen(){
    $res=$this->Operacion("INSERT INTO regimen (reg_id, reg_nom,  reg_des, reg_sta)
						VALUES ('$this->id','$this->reg_nom', '$this->reg_des', '$this->sta')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_regimen(){
    $res=$this->Operacion("UPDATE regimen set reg_nom='$this->reg_nom', reg_des='$this->reg_des' WHERE reg_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_regimen(){
    $res=$this->Operacion("UPDATE regimen set reg_sta='$this->sta' WHERE reg_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>