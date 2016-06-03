<?php session_start();
class inscripcion extends conec_BD
{
 var $id='';
 var $pac_id='';
 var $nombre='';
 var $desc='';
 var $fin='';
 var $ffi='';
 var $fi1='';
 var $ff1='';
 var $fi2='';
 var $ff2='';
 var $sta='';
//******************************************************************
  function inscripcion($id,$pac_id,$nombre,$desc,$fin,$ffi,$sta){
    $this->id=$id;
    $this->pac_id=$pac_id;
    $this->nombre=$nombre;
    $this->desc=$desc;
    $this->fin=$fin;
    $this->ffi=$ffi;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_inscripcion(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM inscri WHERE ins_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_inscripcion($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT * FROM inscri WHERE ins_sta='1' order by ins_ffi DESC LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Periodo(){
    $resultado=$this->Operacion("SELECT * FROM pacade WHERE pac_sta='1' order by pac_ffin DESC");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$pac_id,$nombre,$desc,$fin,$ffi,$fi1,$ff1,$fi2,$ff2,$sta){
    $this->id=$this->ConvertirMayuscula($id);
    $this->pac_id=$pac_id;
    $this->nombre=$this->ConvertirMayuscula($nombre);
    $this->desc=$this->ConvertirMayuscula($desc);
    $this->fin=$this->fechaMySql_time($fin)." 00:00:00";
    $this->ffi=$this->fechaMySql_time($ffi)." 23:59:59";
    $this->fi1=$this->fechaMySql_time($fi1)." 00:00:00";
    $this->ff1=$this->fechaMySql_time($ff1)." 23:59:59";
    $this->fi2=$this->fechaMySql_time($fi2)." 00:00:00";
    $this->ff2=$this->fechaMySql_time($ff2)." 23:59:59";
    $this->sta=$sta;
/*	echo "<script>alert('$this->id, $this->pac_id, $this->nombre, $this->desc, $this->fin, $this->ffi, $this->fi1, $this->ff1, $this->fi2, $this->ff2, $this->sta');</script>";*/
  }
//******************************************************************
  function Buscar_Nombre(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM inscri WHERE ins_nom='$this->nombre' AND ins_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
 //******************************************************************
  function Buscar_Nombre1(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM inscri WHERE ins_nom='$this->nombre' AND ins_sta='1' AND ins_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Fecha(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM inscri WHERE ins_fin='$this->fin' AND ins_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
 //******************************************************************
  function Buscar_Fecha1(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM inscri WHERE ins_fin='$this->fin' AND ins_sta='1' AND ins_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_inscripcion(){
    echo "<script>alert('INSERT INTO inscri (ins_id, ins_fin, ins_ffi, ins_fi1, ins_ff1, ins_fi2, ins_ff2, ins_nom, ins_des, pac_id, ins_sta) VALUES ($this->id, $this->fin, $this->ffi, $this->fi1, $this->ff1, $this->fi2, $this->ff2, $this->nombre, $this->desc, $this->pac_id, $this->sta)');</script>";
    $res=$this->Operacion("INSERT INTO inscri (ins_id, ins_fin, ins_ffi, ins_fi1, ins_ff1, ins_fi2, ins_ff2, ins_nom, ins_des, pac_id, ins_sta) VALUES ('$this->id', '$this->fin', '$this->ffi', '$this->fi1', '$this->ff1', '$this->fi2', '$this->ff2', '$this->nombre', '$this->desc', '$this->pac_id', '$this->sta')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Buscar_inscripcion($id){
    $this->Operacion("SELECT * FROM inscri WHERE ins_id='$id'");
  }
//******************************************************************
  function Modificar_inscripcion(){
  $num_filas=0;
/*  echo "<script>alert('$this->fin, $this->ffi, $this->fi1, $this->ff1, $this->fi2, $this->ff2');</script>";
  echo "<script>alert('UPDATE inscri set ins_nom=$this->nombre, pac_id=$this->pac_id, ins_des=$this->desc, ins_fin=$this->fin, ins_ffi=$this->ffi, ins_fi1=$this->fi1, ins_ff1=$this->ff1, ins_fi2=$this->fi2, ins_ff2=$this->ff2 WHERE ins_id=$this->id');</script>";*/
  $res=$this->Operacion("UPDATE inscri set ins_nom='$this->nombre', pac_id='$this->pac_id', ins_des='$this->desc', ins_fin='$this->fin', ins_ffi='$this->ffi', ins_fi1='$this->fi1', ins_ff1='$this->ff1', ins_fi2='$this->fi2', ins_ff2='$this->ff2' WHERE ins_id='$this->id'");
  $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_inscripcion(){
    $res=$this->Operacion("UPDATE inscri set ins_sta='$this->sta' WHERE ins_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>