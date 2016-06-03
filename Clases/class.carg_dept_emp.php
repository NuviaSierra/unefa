<?php session_start(); // Iniciamos la sesion
class carg_dept_emp extends conec_BD
{
  function nucleo($ci){
  $nucleo=$this->OperacionCualquiera("SELECT A.nuc_id AS nuc_id, A.nuc_nom AS nuc_nom FROM nucleo A, infrae B, estudi_infrae C WHERE A.nuc_sta='1' AND C.ci='$ci' AND C.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_id=B.inf_id AND B.inf_sta='1' AND B.nuc_id=A.nuc_id AND A.nuc_sta='1' GROUP BY A.nuc_id ORDER BY A.nuc_nom");
  return $nucleo;
  }
//******************************************************************
  function infrae($nuc_id){
  $this->Operacion("SELECT A.inf_id, A.inf_nom FROM infrae A, nucleo B WHERE A.inf_sta='1' AND A.nuc_id=B.nuc_id AND B.nuc_sta='1' AND B.nuc_id='$nuc_id' GROUP BY A.inf_id ORDER BY A.inf_nom");
  while($array=$this->ConsultarCualquiera($this->resul)){
	  if($id==""){
	    $id=$array->inf_id;
	    $des=$array->inf_nom;
	  }
	  else{
	    $id=$id."*".$array->inf_id;
	    $des=$des."*".$array->inf_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function depart(){
  $this->Operacion("SELECT depa_id, depa_nom FROM depart WHERE depa_sta='1' GROUP BY depa_id ORDER BY depa_nom");
  while($array=$this->ConsultarCualquiera($this->resul)){
	  if($id==""){
	    $id=$array->depa_id;
	    $des=$array->depa_nom;
	  }
	  else{
	    $id=$id."*".$array->depa_id;
	    $des=$des."*".$array->depa_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function cargo($valor){
  $this->Operacion("SELECT B.car_id AS car_id, B.car_nom AS car_nom FROM depart_cargo A, cargo B WHERE A.depa_id='$valor' AND A.dec_sta='1' AND A.car_id=B.car_id AND B.car_sta='1' GROUP BY B.car_id ORDER BY B.car_nom");
  while($array=$this->ConsultarCualquiera($this->resul)){
	  if($id==""){
	    $id=$array->car_id;
	    $des=$array->car_nom;
	  }
	  else{
	    $id=$id."*".$array->car_id;
	    $des=$des."*".$array->car_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function cargo_emp($inf_id,$car_id,$depa_id){
  $this->Operacion("SELECT A.ci_emp AS ci_emp, B.no1 AS no1, B.no2 AS no2, B.ap1 AS ap1, B.ap2 AS ap2, C.car_id AS car_id, C.car_nom AS car_nom, A.depa_id AS depa_id, D.depa_nom AS depa_nom FROM cargo_depart_emplea A, persona B, cargo C, depart D WHERE A.inf_id='$inf_id' AND A.car_id='$car_id' AND A.cde_sta='1' AND A.ci_emp=B.ci AND B.sta='1' AND A.car_id=C.car_id AND C.car_sta='1' AND A.depa_id='$depa_id' AND A.depa_id=D.depa_id AND D.depa_sta='1' ORDER BY A.ci_emp ");
  return $this->resul;
  }
//******************************************************************  
  function cargo_emp_cedu($inf_id,$ci_emp,$depa_id){
  $this->Operacion("SELECT A.ci_emp AS ci_emp, B.no1 AS no1, B.no2 AS no2, B.ap1 AS ap1, B.ap2 AS ap2, C.car_nom AS car_nom, C.car_id AS car_id, D.depa_id AS depa_id, D.depa_nom AS depa_nom FROM cargo_depart_emplea A, persona B, cargo C, depart D WHERE A.inf_id='$inf_id' AND A.ci_emp='$ci_emp' AND A.cde_sta='1' AND A.ci_emp=B.ci AND B.sta='1' AND A.car_id=C.car_id AND C.car_sta='1' AND A.depa_id=D.depa_id AND D.depa_id='$depa_id' ORDER BY A.ci_emp");
  return $this->resul;
  }
//******************************************************************  
  function asig_cargo($depa_id){
  $this->Operacion("SELECT B.car_id AS car_id, B.car_nom AS car_nom FROM depart_cargo A, cargo B WHERE A.depa_id='$depa_id' AND A.dec_sta='1' AND A.car_id=B.car_id AND B.car_sta='1' ORDER BY B.car_nom");
  return $this->resul;
  }
//******************************************************************
  function val_nuc($nuc_id){
  $this->Operacion("SELECT * FROM nucleo WHERE nuc_id='$nuc_id' AND nuc_sta='1' ORDER BY nuc_nom");
  return $this->resul;
  } 
//****************************************************************** 
  function val_inf($inf_id){
  $this->Operacion("SELECT * FROM infrae WHERE inf_id='$inf_id' AND inf_sta='1' ORDER BY inf_nom");
  return $this->resul;
  }  
//****************************************************************** 
  function val_dept(){
  $this->Operacion("SELECT * FROM depart WHERE depa_sta='1' ORDER BY depa_nom");
  return $this->resul;
  } 
//****************************************************************** 
  function agregar_cde($inf_id,$car_id,$depa_id,$ci_emp){
  $dias=time();
  $fecha=date("Y-m-d H:i:s",$dias);
  $comp_cde=$this->OperacionCualquiera("SELECT * FROM cargo_depart_emplea WHERE inf_id='$inf_id' AND car_id='$car_id' AND depa_id='$depa_id' AND ci_emp='$ci_emp' AND cde_sta='1'");
    if($this->NumFilas1($comp_cde)>0){
	$comp_cde_activo=$this->OperacionCualquiera("SELECT * FROM cargo_depart_emplea WHERE inf_id='$inf_id' AND car_id='$car_id' AND depa_id='$depa_id' AND ci_emp='$ci_emp' AND cde_sta='1'");
	  if($this->NumFilas1($comp_cde_activo)>0){
	  echo "<script>alert('YA SE ENCUENTRA ASIGNADA LA PERSONA A ESE CARGO')
	  location.href='Listar.php'</script>";
	  }
	}
	else{
    $this->Operacion("INSERT INTO cargo_depart_emplea (cde_fin,inf_id,car_id,depa_id,ci_emp,cde_sta) values ('$fecha','$inf_id','$car_id','$depa_id','$ci_emp','1')");
    $accion='INSERTAR';
    $Operacion="AGREGAR CARGO FECHA: ".$fecha." CI: ".$ci_emp." INFRAE: ".$inf_id." DEPT: ".$depa_id." CARGO: ".$car_id;
    $this->guardar_accion($accion,"cargo_depart_emplea",$Operacion);
    echo "<script>alert('CARGO DEL EMPLEADO AGREGADO DE FORMA SATISFACTORIA')
    location.href='Listar.php'</script>";
	}
  }
//****************************************************************** 
  function eliminar($inf_cargo_emp){//ci_emp."*"infrae."*".nucleo."*".depa_id"*".cargo_emp
  $array=explode("*",$inf_cargo_emp);
  $dias=time();
  $fecha=date("Y-m-d H:i:s",$dias);  
  $this->Operacion("UPDATE cargo_depart_emplea SET cde_sta='0',cde_ffi='$fecha' WHERE inf_id='$array[1]' AND car_id='$array[4]' AND depa_id='$array[3]' AND ci_emp='$array[0]' AND cde_sta='1'");
  $accion='ELIMINAR';
  $Operacion="ELIMINAR CARGO FECHA: ".$fecha." CI: ".$ci_emp." INFRAE: ".$inf_id." DEPT: ".$depa_id." CARGO: ".$car_id;
  $this->guardar_accion($accion,"cargo_depart_emplea",$Operacion);
   echo "<script>alert('CARGO DEL EMPLEADO ELIMINADO DE FORMA SATISFACTORIA')
  location.href='Listar.php'</script>";
  }
//****************************************************************** 
  function modificar($inf_id_act,$car_id_act,$depa_id_act,$ci_emp,$inf_id_nuevo,$car_id_nuevo,$depa_id_nuevo){
  $dias=time();
  $fecha=date("Y-m-d H:i:s",$dias); 
  $comp_cde=$this->OperacionCualquiera("SELECT * FROM cargo_depart_emplea WHERE inf_id='$inf_id_nuevo' AND car_id='$car_id_nuevo' AND depa_id='$depa_id_nuevo' AND ci_emp='$ci_emp' AND cde_sta='1'");
    if($this->NumFilas1($comp_cde)>0){
	echo "<script>alert('YA SE ENCUENTRA ASIGNADA LA PERSONA A ESE CARGO')
	location.href='Listar.php'</script>";
	}
	else{
    $this->Operacion("UPDATE cargo_depart_emplea SET cde_sta='0',cde_ffi='$fecha' WHERE inf_id='$inf_id_act' AND car_id='$car_id_act' AND depa_id='$depa_id_act' AND ci_emp='$ci_emp' AND cde_sta='1'");
	$accion='ELIMINAR';
    $Operacion="DESACTIVAR CARGO FECHA FIN: ".$fecha." CI: ".$ci_emp." INFRAE: ".$inf_id_act." DEPT: ".$depa_id_act." CARGO: ".$car_id_act;
    $this->guardar_accion($accion,"cargo_depart_emplea",$Operacion);
    $this->Operacion("INSERT INTO cargo_depart_emplea (cde_fin,inf_id,car_id,depa_id,ci_emp,cde_sta) values ('$fecha','$inf_id_nuevo','$car_id_nuevo','$depa_id_nuevo','$ci_emp','1')");
    $accion='INSERTAR';
    $Operacion="AGREGAR CARGO FECHA: ".$fecha." CI: ".$ci_emp." INFRAE: ".$inf_id_nuevo." DEPT: ".$depa_id_nuevo." CARGO: ".$car_id_nuevo;
    $this->guardar_accion($accion,"cargo_depart_emplea",$Operacion);
    echo "<script>alert('CARGO DEL EMPLEADO MODIFICADO DE FORMA SATISFACTORIA')
    location.href='Listar.php'</script>";
	}
  }
//****************************************************************** 
}
?>