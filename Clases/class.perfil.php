<?php session_start();
class perfil extends conec_BD
{
 var $id='';
 var $nombre='';
 var $desc='';
 var $sta='';
//******************************************************************
  function perfil($id,$nombre,$desc,$sta){
    $this->id=$id;
    $this->nombre=$nombre;
    $this->desc=$desc;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_Perfil(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM perfil WHERE per_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_Perfil($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT * FROM perfil WHERE per_sta='1' order by per_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$nombre,$desc,$sta){
    $this->id=$id;
    $this->nombre=$this->ConvertirMayuscula($nombre);
    $this->desc=$this->ConvertirMayuscula($desc);
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_Nombre(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM perfil WHERE per_nom='$this->nombre' AND per_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Nombre2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM perfil WHERE per_nom='$this->nombre' AND per_sta='1' AND per_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_Perfil(){
    $res=$this->Operacion("INSERT INTO perfil (per_des, per_nom, per_sta)
						VALUES ('$this->desc', '$this->nombre', '$this->sta')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Buscar_Perfil($id){
    $this->Operacion("SELECT * FROM perfil WHERE per_id='$id'");
  }
//******************************************************************
  function Modificar_Perfil(){
    $res=$this->Operacion("UPDATE perfil set per_nom='$this->nombre', per_des='$this->desc' WHERE per_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_Perfil(){
    $res=$this->Operacion("UPDATE perfil set per_sta='$this->sta' WHERE per_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//****************************************************************************************************
  function Agregar_Ope_Tab_Per($tab,$ope,$per){
    $Fecha=date("Y-m-d h:i:s");
	$res=$this->Operacion("INSERT INTO tab_ope (ope_id, tab_id, per_id, tab_ope_sta, tab_ope_fin)
						VALUES ('$ope', '$tab', '$per', '1', '$Fecha')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_Stat_Ope_tab($tab,$ope,$per){
    $Fecha=date("Y-m-d h:i:s");
/*    echo "<script>alert('UPDATE tab_ope set tab_ope_sta=1, tab_ope_fin=$Fecha, tab_ope_ffi= WHERE ope_id=$ope AND tab_id=$tab AND per_id=$per');</script>";*/
    $res=$this->Operacion("UPDATE tab_ope set tab_ope_sta='1', tab_ope_fin='$Fecha', tab_ope_ffi='' WHERE ope_id='$ope' AND tab_id='$tab' AND per_id='$per'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_Stat_Ope_tab($tab,$ope,$per){
    $Fecha=date("Y-m-d h:i:s");
/*    echo "<script>alert('UPDATE tab_ope set tab_ope_sta=0, tab_ope_ffi=$Fecha WHERE ope_id=$ope AND tab_id=$tab AND per_id=$per');</script>";*/
    $res=$this->Operacion("UPDATE tab_ope set tab_ope_sta='0', tab_ope_ffi='$Fecha' WHERE ope_id='$ope' AND tab_id='$tab' AND per_id='$per'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>