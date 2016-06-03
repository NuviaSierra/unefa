<?php session_start();
class pacade extends conec_BD
{
 var $id='';
 var $mod_id='';
 var $pac_nom='';
 var $pac_fin='';
 var $pac_ffin='';
 var $fi1='';
 var $ff1='';
 var $fi2='';
 var $ff2='';
 var $fi3='';
 var $ff3='';
 var $sem='';
 var $inten='';
 var $pac_obs='';
 var $sta='';
//******************************************************************
  function pacade($id, $mod_id, $pac_nom, $pac_fin, $pac_ffin, $fi1, $ff1, $fi2, $ff2, $fi3, $ff3, $pac_obs, $sta){
    $this->id=$id;
    $this->mod_id=$mod_id;
    $this->pac_nom=$this->ConvertirMayuscula($pac_nom);
    $this->pac_fin=$this->fechaMySql($pac_fin);
    $this->pac_ffin=$this->fechaMySql($pac_ffin);
    $this->fi1=$this->fechaMySql($fi1);
    $this->ff1=$this->fechaMySql($ff1);
    $this->fi2=$this->fechaMySql($fi2);
    $this->ff2=$this->fechaMySql($ff2);
    $this->fi3=$this->fechaMySql($fi3);
    $this->ff3=$this->fechaMySql($ff3);
    $this->pac_obs=$this->ConvertirMayuscula($pac_obs);
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_pacade(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM pacade WHERE pac_sta='1' ORDER BY pac_ffin DESC");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_pacade($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT A.pac_nom AS 'pac_nom', A.pac_id AS 'pac_id', B.mod_nom AS 'mod_nom' FROM pacade A, modali B WHERE A.mod_id=B.mod_id AND pac_sta='1' order by pac_ffin DESC LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_modalidad(){
    $resultado=$this->Operacion("SELECT * FROM modali WHERE mod_sta='1' order by mod_nom");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$mod_id,$pac_nom,$pac_fin,$pac_ffin,$fi1,$ff1,$fi2,$ff2,$fi3,$ff3,$pac_obs,$sta,$sem,$inten){
    $this->id=$id;
    $this->mod_id=$mod_id;
	$this->pac_nom=$this->ConvertirMayuscula($pac_nom);
    $this->pac_fin=$this->fechaMySql($pac_fin);
    $this->pac_ffin=$this->fechaMySql($pac_ffin);
    $this->fi1=$this->fechaMySql($fi1);
    $this->ff1=$this->fechaMySql($ff1);
    $this->fi2=$this->fechaMySql($fi2);
    $this->ff2=$this->fechaMySql($ff2);
    $this->fi3=$this->fechaMySql($fi3);
    $this->ff3=$this->fechaMySql($ff3);
	$this->sem=$sem;
	$this->inten=$inten;
    $this->pac_obs=$this->ConvertirMayuscula($pac_obs);
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_Nombre(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM pacade WHERE pac_nom='$this->nombre' AND pac_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
 //******************************************************************
  function Buscar_Nombre1(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM pacade WHERE pac_nom='$this->pac_nom' AND pac_sta='1' AND pac_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Fecha(){
/*    echo "<script>alert('SELECT * FROM pacade WHERE pac_fin=$this->pac_fin AND pac_ffin=$this->pac_ffi AND pac_sta=1');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM pacade WHERE pac_fin='$this->pac_fin' AND pac_ffin='$this->pac_ffin' AND pac_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
 //******************************************************************
  function Buscar_Fecha1(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM pacade WHERE pac_fin='$this->pac_fin' AND pac_sta='1' AND pac_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//****************************************************************************************************
  function Agregar_pacade(){
/*    echo "<script>alert('INSERT INTO pacade (pac_fin, pac_ffin, pac_nom, pac_fi1, pac_ff1, pac_fi2, pac_ff2, pac_fi3, pac_ff3, pac_obs, mod_id, pac_sta) VALUES ($this->pac_fin, $this->pac_ffin, $this->pac_nom, $this->fi1, $this->ff1, $this->fi2, $this->ff2, $this->fi3, $this->ff3, $this->pac_obs, $this->mod_id, $this->sta)');</script>";*/
    $res=$this->Operacion("INSERT INTO pacade (pac_id, pac_fin, pac_ffin, pac_nom, pac_fi1, pac_ff1, pac_fi2, pac_ff2, pac_fi3, pac_ff3, pac_obs, mod_id, pac_sta, pac_sem, pac_int)
						VALUES ('$this->id', '$this->pac_fin', '$this->pac_ffin', '$this->pac_nom', '$this->fi1', '$this->ff1', '$this->fi2', '$this->ff2', '$this->fi3', '$this->ff3', '$this->pac_obs', '$this->mod_id', '$this->sta', '$this->sem','$this->inten')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Buscar_pacade($id){
    $this->Operacion("SELECT * FROM pacade WHERE pac_id='$id'");
  }

//******************************************************************
  function Buscar_pacade_2($id){
    $res=$this->OperacionCualquiera("SELECT * FROM pacade WHERE pac_id='$id'");
    return $res;
  }
//******************************************************************
  function Buscar_mod($id){
    $this->Operacion("SELECT * FROM modali WHERE mod_id='$id'");
  }
//******************************************************************
  function Modificar_pacade(){
    $res=$this->Operacion("UPDATE pacade set pac_nom='$this->pac_nom', pac_obs='$this->pac_obs', pac_fin='$this->pac_fin', pac_ffin='$this->pac_ffin', pac_fi1='$this->fi1', pac_ff1='$this->ff1', pac_fi2='$this->fi2', pac_ff2='$this->ff2', pac_fi3='$this->fi3', pac_ff3='$this->ff3', pac_sem='$this->sem', pac_int='$this->inten', pac_sta='1' WHERE pac_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_pacade(){
    $res=$this->Operacion("UPDATE pacade set pac_sta='$this->sta' WHERE pac_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>