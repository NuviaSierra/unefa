<?php session_start();
class infraestructura extends conec_BD
{
 var $id='';
 var $nuc_id='';
 var $nombre='';
 var $tip='';
 var $direc='';
 var $tel='';
 var $sta='';
//******************************************************************
  function infraestructura($id,$nuc_id,$nombre,$tip,$direc,$tel,$sta){
    $this->id=$id;
	$this->nuc_id=$nuc_id;
    $this->nombre=$this->ConvertirMayuscula($nombre);
    $this->tip=$tip;
    $this->direc=$direc;
    $this->tel=$tel;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_Infraes(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM infrae WHERE inf_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_Infraes($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT * FROM infrae WHERE inf_sta='1' order by inf_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_nucleo(){
    $resultado=$this->Operacion("SELECT * FROM nucleo WHERE nuc_sta='1' order by nuc_nom");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$nuc_id,$nombre,$tip,$direc,$tel,$sta){
    $this->id=$id;
	$this->nuc_id=$nuc_id;
    $this->nombre=$this->ConvertirMayuscula($nombre);
    $this->tip=$tip;
    $this->direc=$this->ConvertirMayuscula($direc);
    $this->tel=$tel;
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_Nombre(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM infrae WHERE inf_nom='$this->nombre' AND inf_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Id(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM infrae WHERE inf_id='$this->id' AND inf_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Nombre2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM infrae WHERE inf_nom='$this->nombre' AND inf_sta='1' AND inf_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_Infraes(){
/*	echo "<script>alert('VALORES: $this->id, $this->nuc_id, $this->nuc_id, $this->direc, $this->tel, $this->tip, $this->sta');</script>";*/
    $res=$this->Operacion("INSERT INTO infrae (inf_id, nuc_id, inf_nom, inf_dir, inf_tel, inf_tip, inf_sta)
						VALUES ('$this->id','$this->nuc_id', '$this->nombre', '$this->direc', '$this->tel','$this->tip','$this->sta')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Buscar_Infraes($id){
    $this->Operacion("SELECT * FROM infrae WHERE inf_id='$id'");
  }
//******************************************************************
  function Modificar_Infraes(){
    $res=$this->Operacion("UPDATE infrae set inf_nom='$this->nombre', nuc_id='$this->nuc_id', inf_dir='$this->direc', inf_tel='$this->tel', inf_tip='$this->tip' WHERE inf_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_Infraes(){
    $res=$this->Operacion("UPDATE infrae set inf_sta='$this->sta' WHERE inf_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>