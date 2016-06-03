<?php session_start();
class especi extends conec_BD
{
 var $id='';
 var $niv_id='';
 var $esp_nom='';
 var $esp_des='';
 var $sta='';
//******************************************************************
  function especi($id,$niv_id,$esp_nom,$esp_des,$sta){
    $this->id=$id;
    $this->niv_id=$niv_id;
	$this->esp_nom=$esp_nom;
    $this->esp_des=$esp_des;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_especi(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM especi WHERE esp_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_especi($inicial,$cantidad){
/*  echo "<script>alert('SELECT esp_id, A.esp_nom AS esp_nom, A.niv_id AS niv_id, B.niv_nom AS niv_nom FROM especi A, nivela B WHERE A.esp_sta=1 AND A.niv_id=B.niv_id order by B.niv_nom,A.esp_nom LIMIT $cantidad OFFSET $inicial');</script>":*/
    $resultado=$this->Operacion("SELECT esp_id, A.esp_nom AS 'esp_nom', A.niv_id AS 'niv_id', B.niv_nom AS 'niv_nom' FROM especi A, nivela B WHERE A.esp_sta='1' AND A.niv_id=B.niv_id order by B.niv_nom, A.esp_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_nivela(){
    $resultado=$this->Operacion("SELECT * FROM nivela WHERE niv_sta='1' order by niv_nom");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$niv_id,$esp_nom,$esp_des,$sta){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->id=$this->ConvertirMayuscula($id);
    $this->niv_id=$niv_id;
/*    echo "<script>alert('id: $this->id');</script>";*/
	$this->esp_nom=$this->ConvertirMayuscula($esp_nom);
    $this->esp_des=$this->ConvertirMayuscula($esp_des);
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_especi($id){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->Operacion("SELECT * FROM especi WHERE esp_id='$id'");
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
    $this->Operacion("SELECT * FROM especi WHERE esp_nom='$this->esp_nom' AND esp_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM especi WHERE esp_id='$this->id' AND esp_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Nombre2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM especi WHERE esp_nom='$this->esp_nom' AND esp_sta='1' AND esp_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM especi WHERE esp_id='$this->id' AND esp_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_especi(){
    $res=$this->Operacion("INSERT INTO especi (esp_id, niv_id, esp_nom, esp_des, esp_sta)
						VALUES ('$this->id', '$this->niv_id', '$this->esp_nom', '$this->esp_des', '$this->sta')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_especi(){
    $res=$this->Operacion("UPDATE especi set  niv_id='$this->niv_id', esp_nom='$this->esp_nom', esp_des='$this->esp_des' WHERE esp_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_especi(){
    $res=$this->Operacion("UPDATE especi set esp_sta='$this->sta' WHERE esp_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>