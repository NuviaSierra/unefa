<?php session_start();
class seccion extends conec_BD
{
 var $id='';
 var $nombre='';
 var $desc='';
 var $inf='';
 var $sta='';
//******************************************************************
  function seccion($id,$nombre,$desc,$inf,$sta){
    $this->id=$this->ConvertirMayuscula($id);
    $this->nombre=$this->ConvertirMayuscula($nombre);
    $this->desc=$this->ConvertirMayuscula($desc);
    $this->inf=$inf;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_seccion(){
    $res=$this->Listado_infraestructura();
	$array=$this->ConsultarCualquiera($res);
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM seccio WHERE sec_sta='1' AND inf_id='$array->inf_id'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_seccion($inicial,$cantidad){
    $res=$this->Listado_infraestructura();
	$array=$this->ConsultarCualquiera($res);
    $resultado=$this->Operacion("SELECT * FROM seccio WHERE sec_sta='1' AND inf_id='$array->inf_id' order by sec_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_infraestructura(){
    $ci=$_SESSION['ci'];
/*	echo "<script>alert('$ci');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.ci AS 'ci', B.inf_nom AS 'inf_nom' FROM estudi_infrae A, infrae B WHERE (A.est_inf_ffi='0000-00-00 00:00:00' OR A.est_inf_ffi='') AND A.ci='$ci' AND B.inf_id=A.inf_id");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$nombre,$desc,$inf,$sta){
    $this->id=$this->ConvertirMayuscula($id);
    $this->inf=$inf;
    $this->nombre=$this->ConvertirMayuscula($nombre);
    $this->desc=$this->ConvertirMayuscula($desc);
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_Nombre(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM seccio WHERE sec_nom='$this->nombre' AND sec_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_seccion(){
    $res=$this->Operacion("INSERT INTO seccio (sec_id, sec_des, sec_nom, inf_id, sec_sta)
						VALUES ('$this->id','$this->desc', '$this->nombre', '$this->inf', '$this->sta')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Buscar_seccion($id){
    $this->Operacion("SELECT * FROM seccio WHERE sec_id='$id'");
  }
//******************************************************************
  function Buscar_seccion2(){
    $this->Operacion("SELECT * FROM seccio WHERE sec_id='$this->id'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Buscar_seccion3(){
    $this->Operacion("SELECT * FROM seccio WHERE sec_id='$this->id' AND sec_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }  
//******************************************************************
  function Modificar_seccion(){
    $res=$this->Operacion("UPDATE seccio set sec_nom='$this->nombre', sec_des='$this->desc', inf_id='$this->inf', sec_sta='1' WHERE sec_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_seccion(){
    $res=$this->Operacion("UPDATE seccio set sec_sta='$this->sta' WHERE sec_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>