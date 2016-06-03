<?php session_start();
class nucleo extends conec_BD
{
 var $id='';
 var $nuc_cod='';
 var $nombre='';
 var $sta='';
//******************************************************************
  function nucleo($id,$nuc_cod,$nombre,$sta){
    $this->id=$id;
	$this->nuc_cod=$nuc_cod;
    $this->nombre=$nombre;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_Nucleo(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM nucleo WHERE nuc_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_Nucleo($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT * FROM nucleo WHERE nuc_sta='1' order by nuc_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$nuc_cod,$nombre,$sta){
    $this->id=$id;
	$this->nuc_cod=$nuc_cod;
    $this->nombre=$this->ConvertirMayuscula($nombre);
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_Nombre(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM nucleo WHERE nuc_nom='$this->nombre' AND nuc_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM nucleo WHERE nuc_cod='$this->nuc_cod' AND nuc_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Nombre2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM nucleo WHERE nuc_nom='$this->nombre' AND nuc_sta='1' AND nuc_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM nucleo WHERE nuc_cod='$this->nuc_cod' AND nuc_sta='1' AND nuc_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_Nucleo(){
    $res=$this->Operacion("INSERT INTO nucleo (nuc_id, nuc_cod, nuc_nom, nuc_sta)
						VALUES ('$this->id','$this->nuc_cod', '$this->nombre', '$this->sta')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Buscar_Nucleo($id){
    $this->Operacion("SELECT * FROM nucleo WHERE nuc_id='$id'");
  }
//******************************************************************
  function Modificar_Nucleo(){
    $res=$this->Operacion("UPDATE nucleo set nuc_nom='$this->nombre', nuc_cod='$this->nuc_cod' WHERE nuc_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_Nucleo(){
    $res=$this->Operacion("UPDATE nucleo set nuc_sta='$this->sta' WHERE nuc_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>