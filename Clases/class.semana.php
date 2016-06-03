<?php session_start();
class semana extends conec_BD
{
 var $sem_nom='';
 var $pac_id='';
 var $sem_fin='';
 var $sem_ffi='';
 var $fer_dia='';
 var $fer_sta='';
//******************************************************************
  function semana($sem_nom, $pac_id, $sem_fin, $sem_ffi, $fer_dia, $fer_sta){
    $this->sem_nom=$sem_nom;
    $this->pac_id=$pac_id;
    $this->sem_fin=$this->fechaMySql($sem_fin);
    $this->sem_ffi=$this->fechaMySql($sem_ffi);
    $this->fer_sta=$fer_sta;
  }
//******************************************************************
  function Contar_pacade(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM pacade WHERE pac_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_pacade($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT A.pac_nom AS 'pac_nom', A.pac_id AS 'pac_id', B.mod_nom AS 'mod_nom' FROM pacade A, modali B WHERE A.mod_id=B.mod_id AND pac_sta='1' order by pac_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($sem_nom, $pac_id, $sem_fin, $sem_ffi, $fer_dia, $fer_sta){
    $this->sem_nom=$sem_nom;
    $this->pac_id=$pac_id;
    $this->sem_fin=$this->fechaMySql_time($sem_fin)." 00:00:00";
    $this->sem_ffi=$this->fechaMySql_time($sem_ffi)." 23:59:59";
    $this->fer_sta=$fer_sta;
/*		echo "<script>alert('$this->id,$this->pac_id,$this->fn1,$this->fp1,$this->fn2,$this->fp2,$this->fn3,$this->fp3,$this->fnr,$this->mod');</script>";*/
  }
//******************************************************************
  function Buscar_pacade($id){
    $resultado=$this->Operacion("SELECT * FROM pacade WHERE pac_id='$id'");
	return $resultado;
  }
//******************************************************************
  function Buscar_pacade_Mod($id){
    $resultado=$this->Operacion("SELECT A.pac_nom AS 'pac_nom', A.pac_id AS 'pac_id', A.pac_sem AS 'pac_sem', A.pac_fi1 AS 'pac_fi1', A.pac_ff3 AS 'pac_ff3', B.mod_nom AS 'mod_nom' FROM pacade A, modali B WHERE A.mod_id=B.mod_id AND pac_sta='1' AND A.pac_id='$id'");
    return $resultado;
  }
//******************************************************************
  function Buscar_semana($sem_nom,$pac_id){
    $Res=$this->OperacionCualquiera("SELECT * FROM semana WHERE pac_id='$pac_id' AND sem_nom='$sem_nom'");
	return $Res;
  }
//******************************************************************
  function Buscar_feriado_semana($sem_nom,$pac_id){
/*    echo "<script>alert('SELECT * FROM feriado WHERE pac_id=$pac_id AND sem_nom=$sem_nom AND fer_sta=1');</script>";*/
    $Res=$this->OperacionCualquiera("SELECT * FROM feriado WHERE pac_id='$pac_id' AND sem_nom='$sem_nom' AND fer_sta='1'");
	return $Res;
  }
//******************************************************************
  function Buscar_feriado($pac_id,$fer_dia){
    $Res=$this->OperacionCualquiera("SELECT * FROM feriado WHERE pac_id='$pac_id' AND fer_dia='$fer_dia'");
	return $Res;
  }
//******************************************************************
  function Buscar_semana_pacade($pac_id,$pac_sem){
    $Res=$this->OperacionCualquiera("SELECT * FROM semana WHERE pac_id='$pac_id' ORDER BY sem_nom LIMIT $pac_sem OFFSET 0");
	return $Res;
  }
//******************************************************************
  function Agregar_semana($sem_nom,$sem_fin,$sem_ffi,$pac_id){
    $num_filas=0;
/*    echo "<script>alert('INSERT INTO semana (pac_id, sem_nom, sem_fin, sem_ffi) VALUES($pac_id,$sem_nom,$sem_fin,$sem_ffi)');</script>";*/
    $insert=$this->OperacionCualquiera("INSERT INTO semana (pac_id, sem_nom, sem_fin, sem_ffi) VALUES('$pac_id','$sem_nom','$sem_fin','$sem_ffi')");
	$num_filas=$this->filas_afectadas($insert);
	if($num_filas>0){
	  $accion='INSERTAR';
	  $Operacion="SEM: ".$sem_nom.", PACADE: ".$pac_id.", FIN: ".$sem_fin.", FFI: ".$sem_ffi."";
/*  	echo "<script>alert('$accion, $Operacion');</script>";*/
	  $this->guardar_accion($accion,"semana",$Operacion);
	}
/*  	echo "<script>alert('$num_filas>0');</script>";*/
	return $num_filas;	
  }
//******************************************************************
  function Modificar_semana($sem_nom,$sem_fin,$sem_ffi,$pac_id){
    $num_filas=0;
/*	echo "<script>alert('UPDATE semana SET sem_fin=$sem_fin, sem_ffi=$sem_ffi WHERE pac_id=$pac_id AND sem_nom=$sem_nom');</script>";*/
    $insert=$this->OperacionCualquiera("UPDATE semana SET sem_fin='$sem_fin', sem_ffi='$sem_ffi' WHERE pac_id='$pac_id' AND sem_nom='$sem_nom'");
	$num_filas=$this->filas_afectadas($insert);
	if($num_filas>0){
	  $accion='MODIFICAR';
	  $Operacion="SEM: ".$sem_nom.", PACADE: ".$pac_id.", FIN: ".$sem_fin.", FFI: ".$sem_ffi."";	
	  $this->guardar_accion($accion,"semana",$Operacion);
	}
	return $num_filas;
  }
//******************************************************************
  function Agregar_feriado($sem_nom,$fer_dia,$pac_id){
    $num_filas=0;
/*    echo "<script>alert('INSERT INTO feriado (pac_id, sem_nom, fer_dia, fer_sta) VALUES($pac_id,$sem_nom,$fer_dia,1)');</script>";*/
    $insert=$this->OperacionCualquiera("INSERT INTO feriado (pac_id, sem_nom, fer_dia, fer_sta) VALUES('$pac_id','$sem_nom','$fer_dia','1')");	
	$num_filas=$this->filas_afectadas($insert);
/*  	echo "<script>alert('$num_filas>0');</script>";*/
	if($num_filas>0){
	  $accion='INSERTAR';
	  $Operacion="SEM: ".$sem_nom.", PACADE: ".$pac_id.", dia: ".$fer_dia."";
	  $this->guardar_accion($accion,"feriado",$Operacion);
	}
	return $num_filas;	
  }
//******************************************************************
  function Modificar_feriado($sem_nom,$fer_dia,$fer_sta,$pac_id){
  $num_filas=0;
/*    echo "<script>alert('UPDATE feriado SET fer_sta=$fer_sta AND sem_nom=$sem_nom WHERE pac_id=$pac_id AND fer_dia=$fer_dia');</script>";*/
    $insert=$this->OperacionCualquiera("UPDATE feriado SET fer_sta='$fer_sta' AND sem_nom='$sem_nom' WHERE pac_id='$pac_id' AND fer_dia='$fer_dia'");
	$num_filas=$this->filas_afectadas($insert);
	if($num_filas>0){
	  $accion='MODIFICAR';
	  $Operacion="SEM: ".$sem_nom.", PACADE: ".$pac_id.", dia: ".$fer_dia."";
	  $this->guardar_accion($accion,"feriado",$Operacion);
	}
	return $num_filas;
  }
//******************************************************************
  function Modificar_feriado_TODOS($pac_id,$sem_nom){
    $num_filas=0;
    $insert=$this->OperacionCualquiera("UPDATE feriado SET fer_sta='0' WHERE pac_id='$pac_id' AND sem_nom='$sem_nom'");
	$num_filas=$this->filas_afectadas($insert);
	return $num_filas;
  }
//******************************************************************
}?>