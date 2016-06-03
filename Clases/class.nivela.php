<?php session_start();
class nivela extends conec_BD
{
 var $id='';
 var $niv_nom='';
 var $niv_des='';
 var $sta='';
//******************************************************************
  function nivela($id,$niv_nom,$niv_des,$sta){
    $this->id=$id;
	$this->niv_nom=$niv_nom;
    $this->niv_des=$niv_des;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_nivela(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM nivela WHERE niv_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_nivela($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT * FROM nivela WHERE niv_sta='1' order by niv_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$niv_nom,$niv_des,$sta){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->id=$this->ConvertirMayuscula($id);
/*    echo "<script>alert('id: $this->id');</script>";*/
	$this->niv_nom=$this->ConvertirMayuscula($niv_nom);
    $this->niv_des=$this->ConvertirMayuscula($niv_des);
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_nivela($id){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->Operacion("SELECT * FROM nivela WHERE niv_id='$id'");
  }
//******************************************************************
  function Buscar_Nombre(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM nivela WHERE niv_nom='$this->niv_nom' AND niv_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM nivela WHERE niv_id='$this->id' AND niv_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Nombre2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM nivela WHERE niv_nom='$this->niv_nom' AND niv_sta='1' AND niv_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM nivela WHERE niv_id='$this->id' AND niv_sta='1' AND niv_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_nivela(){
    $res=$this->Operacion("INSERT INTO nivela (niv_id, niv_nom,  niv_des, niv_sta)
						VALUES ('$this->id','$this->niv_nom', '$this->niv_des', '$this->sta')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_nivela(){
    $res=$this->Operacion("UPDATE nivela set niv_nom='$this->niv_nom', niv_des='$this->niv_des' WHERE niv_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_nivela(){
    $res=$this->Operacion("UPDATE nivela set niv_sta='$this->sta' WHERE niv_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>