<?php session_start();
class modalidad extends conec_BD
{
 var $id='';
 var $mod_nom='';
 var $mod_des='';
 var $sta='';
//******************************************************************
  function modalidad($id,$mod_nom,$mod_des,$sta){
    $this->id=$id;
	$this->mod_nom=$mod_nom;
    $this->mod_des=$mod_des;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_modalidad(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM modali WHERE mod_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_modalidad($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT * FROM modali WHERE mod_sta='1' order by mod_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$mod_nom,$mod_des,$sta){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->id=$this->ConvertirMayuscula($id);
/*    echo "<script>alert('id: $this->id');</script>";*/
	$this->mod_nom=$this->ConvertirMayuscula($mod_nom);
    $this->mod_des=$this->ConvertirMayuscula($mod_des);
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_modalidad($id){
    $this->Operacion("SELECT * FROM modali WHERE mod_id='$id'");
  }
//******************************************************************
  function Buscar_Nombre(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM modali WHERE mod_nom='$this->mod_nom' AND mod_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM modali WHERE mod_id='$this->id' AND mod_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Nombre2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM modali WHERE mod_nom='$this->mod_nom' AND mod_sta='1' AND mod_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM modali WHERE mod_id='$this->id' AND mod_sta='1' AND mod_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_modalidad(){
    $res=$this->Operacion("INSERT INTO modali (mod_id, mod_nom,  mod_des, mod_sta)
						VALUES ('$this->id','$this->mod_nom', '$this->mod_des', '$this->sta')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_modalidad(){
    $res=$this->Operacion("UPDATE modali set mod_nom='$this->mod_nom', mod_des='$this->mod_des' WHERE mod_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_modalidad(){
    $res=$this->Operacion("UPDATE modali set mod_sta='$this->sta' WHERE mod_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>