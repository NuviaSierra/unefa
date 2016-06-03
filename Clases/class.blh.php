<?php session_start();
class blh extends conec_BD
{
 var $id='';
 var $blh_ini='';
 var $blh_fin='';
 var $sta='';
//******************************************************************
  function blh($id,$blh_ini,$blh_fin,$sta){
    $this->id=$id;
	$this->blh_ini=$this->ConvertirMayuscula($blh_ini);
	$this->blh_fin=$this->ConvertirMayuscula($blh_fin);	
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_blh(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM blo_hor WHERE blh_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_blh($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT * FROM blo_hor WHERE blh_sta='1' order by blh_ini,blh_fin LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$blh_ini,$blh_fin,$sta){
/*      echo "<script>alert('id: $id, blh_ini: $blh_ini, blh_fin: $blh_fin, sta=$sta');</script>";*/
    $this->id=$id;
	$this->blh_ini=$blh_ini;
	$this->blh_fin=$blh_fin;
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_blh($id){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->Operacion("SELECT * FROM blo_hor WHERE blh_id='$id'");
  }
//******************************************************************
  function Buscar_Blh_Ini_Fin(){
/*    echo "<script>alert('INICIO:$this->blh_ini, FIN: $this->blh_fin ');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM blo_hor WHERE blh_ini='$this->blh_ini' AND blh_fin='$this->blh_fin' AND blh_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
/*    echo "<script>alert('filas $row');</script>";*/
    return $row;
  }
//******************************************************************
  function Buscar_Blh_Ini_Fin1(){
/*    echo "<script>alert('INICIO1: $this->blh_ini, FIN1: $this->blh_fin ');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM blo_hor WHERE blh_ini='$this->blh_ini' AND blh_fin='$this->blh_fin' AND blh_sta='0'");
    $num_filas=$this->NumFilas();
    /*echo "<script>alert('Filas: $num_filas');</script>";*/
    if($num_filas>0)
      $row=1;
  /*  echo "<script>alert('filas1 $row');</script>";*/
    return $row;
  }
//******************************************************************
  function Buscar_Codigo(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM blo_hor WHERE blh_id='$this->id' AND blh_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Blh_Ini_Fin2(){
/*    echo "<script>alert('INICIO2: $this->blh_ini, FIN2: $this->blh_fin ');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM blo_hor WHERE blh_ini='$this->blh_ini' AND blh_fin='$this->blh_fin' AND blh_sta='1' AND blh_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
/*    echo "<script>alert('filas2 $row');</script>";	*/  
    return $row;
  }
//******************************************************************
  function Buscar_Codigo2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM blo_hor WHERE blh_id='$this->id' AND blh_sta='1' AND blh_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_blh(){
    $res=$this->Operacion("INSERT INTO blo_hor (blh_ini, blh_fin, blh_sta)
						VALUES ('$this->blh_ini', '$this->blh_fin', '$this->sta')");
    $num_filas=$this->filas_afectadas($res);
	if($num_filas>0)
	  $ultimo=mysql_insert_id();
	else
	  $ultimo=$num_filas;
    return $ultimo;
  }
//******************************************************************
  function Agregar_blh1($id){
    $res=$this->Operacion("UPDATE blo_hor set blh_sta='1' WHERE blh_id='$id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_blh(){
    $res=$this->Operacion("UPDATE blo_hor set blh_ini='$this->blh_ini', blh_fin='$this->blh_fin' WHERE blh_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_blh(){
    $res=$this->Operacion("UPDATE blo_hor set blh_sta='$this->sta' WHERE blh_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>