<?php session_start();
class dias extends conec_BD
{
 var $id='';
 var $dia_nom='';
 var $sta='';
//******************************************************************
  function dias($id,$dia_nom,$sta){
    $this->id=$id;
	$this->dia_nom=$dia_nom;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_dia(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM dias WHERE dia_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_dia($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT * FROM dias WHERE dia_sta='1' order by dia_id LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$dia_nom,$sta){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->id=$this->ConvertirMayuscula($id);
/*    echo "<script>alert('id: $this->id');</script>";*/
	$this->dia_nom=$this->ConvertirMayuscula($dia_nom);
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_dia($id){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->Operacion("SELECT * FROM dias WHERE dia_id='$id'");
  }
//******************************************************************
  function Buscar_Nombre(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM dias WHERE dia_nom='$this->dia_nom' AND dia_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Nombre1(){
    /*echo "<script>alert('NOMBRE: $this->dia_nom');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM dias WHERE dia_nom='$this->dia_nom' AND dia_sta='0'");
    $num_filas=$this->NumFilas();
    /*echo "<script>alert('Filas: $num_filas');</script>";*/
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM dias WHERE dia_id='$this->id' AND dia_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Nombre2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM dias WHERE dia_nom='$this->dia_nom' AND dia_sta='1' AND dia_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM dias WHERE dia_id='$this->id' AND dia_sta='1' AND dia_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_dia(){
    $res=$this->Operacion("INSERT INTO dias (dia_nom, dia_sta)
						VALUES ('$this->dia_nom', '$this->sta')");
    $num_filas=$this->filas_afectadas($res);
	if($num_filas>0)
	  $ultimo=mysql_insert_id();
	else
	  $ultimo=$num_filas;
    return $ultimo;
  }
//******************************************************************
  function Agregar_dia1($id){
    $res=$this->Operacion("UPDATE dias set dia_sta='1' WHERE dia_id='$id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_dia(){
    $res=$this->Operacion("UPDATE dias set dia_nom='$this->dia_nom' WHERE dia_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_dia(){
    $res=$this->Operacion("UPDATE dias set dia_sta='$this->sta' WHERE dia_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>