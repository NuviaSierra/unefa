<?php session_start();
class electiva extends conec_BD
{
 var $ele_cod='';
 var $ele_nom='';
 var $ele_sta='';
 var $coh_id='';
 var $mod_id='';
 var $reg_id='';
 var $esp_id='';
 var $pen_top='';
 var $elp_sta=''; 
//******************************************************************
  function electiva($ele_cod,$ele_nom,$ele_sta,$coh_id,$mod_id,$reg_id,$esp_id,$pen_top,$elp_sta){
    $this->ele_cod=$ele_cod;
    $this->ele_nom=$this->ConvertirMayuscula($ele_nom);
    $this->ele_sta=$ele_sta;
    $this->coh_id=$coh_id;
    $this->mod_id=$mod_id;
    $this->reg_id=$reg_id;
    $this->esp_id=$esp_id;
    $this->pen_top=$pen_top;
    $this->elp_sta=$elp_sta;
  }
//******************************************************************
  function Contar_electiva(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM electi WHERE ele_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_electiva($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT * FROM electi WHERE ele_sta='1' order by ele_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($ele_cod,$ele_nom,$ele_sta,$coh_id,$mod_id,$reg_id,$esp_id,$pen_top,$elp_sta){
    $this->ele_cod=$this->ConvertirMayuscula($ele_cod);
    $this->ele_nom=$this->ConvertirMayuscula($ele_nom);
    $this->ele_sta=$ele_sta;
    $this->coh_id=$coh_id;
    $this->mod_id=$mod_id;
    $this->reg_id=$reg_id;
    $this->esp_id=$esp_id;
    $this->pen_top=$pen_top;
    $this->elp_sta=$elp_sta;
  }
//******************************************************************
  function Buscar_Codigo1(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM electi WHERE ele_cod='$this->ele_cod'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Codigo2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM electi WHERE ele_cod='$this->ele_cod' AND ele_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
 //******************************************************************
  function Listado_electi_pensum(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $this->Operacion("SELECT * FROM electi_pensum WHERE ele_cod='$this->ele_cod' AND elp_sta='1'");
    return $resultado;
  }
//******************************************************************
  function Listado_pensum(){
    $resultado=$this->Operacion("SELECT A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', D.esp_id AS 'esp_id', D.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom', A.pen_top AS 'pen_top' FROM pensum A, cohort B, modali C, especi D, regimen E  WHERE A.pen_sta='1' AND A.coh_id=B.coh_id AND C.mod_id=A.mod_id AND D.esp_id=A.esp_id AND A.reg_id=E.reg_id order by B.coh_nom,C.mod_nom,E.reg_nom,D.esp_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_electi_pensum2($ele_cod){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $this->Operacion("SELECT A.ele_cod AS 'ele_cod', F.ele_nom AS 'ele_nom', A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', A.esp_id AS 'esp_id', D.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom', A.pen_top AS 'pen_top' FROM electi_pensum A, cohort B, modali C, especi D, regimen E, electi F WHERE A.ele_cod='$ele_cod' AND elp_sta='1' AND A.coh_id=B.coh_id AND A.mod_id=C.mod_id AND A.esp_id=D.esp_id AND A.reg_id=E.reg_id AND A.ele_cod=F.ele_cod ORDER BY B.coh_nom,C.mod_nom,E.reg_nom,D.esp_nom");
    return $resultado;
  }
//******************************************************************
  function Buscar_electi_pensum($ele_cod, $mod_id, $reg_id, $esp_id, $coh_id, $pen_top){
/*    echo "<script>alert('SELECT A.coh_id AS coh_id, B.coh_nom AS coh_nom, A.mod_id AS mod_id, C.mod_nom AS mod_nom, A.esp_id AS esp_id, D.esp_nom AS esp_nom, A.reg_id AS reg_id, E.reg_nom AS reg_nom, A.pen_top AS pen_top FROM electi_pensum A, cohort B, modali C, especi D, regimen E, electi F WHERE A.ele_cod=$ele_cod AND elp_sta=1 AND A.coh_id=B.coh_id AND A.mod_id=C.mod_id AND A.esp_id=D.esp_id AND A.reg_id=E.reg_id AND A.ele_cod=F.ele_cod AND A.coh_id=$coh_id AND A.mod_id=$mod_id AND A.esp_id=$esp_id AND A.reg_id=$reg_id AND A.pen_top=$pen_top');</script>";*/
    $this->Operacion("SELECT A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', A.esp_id AS 'esp_id', D.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom', A.pen_top AS 'pen_top' FROM electi_pensum A, cohort B, modali C, especi D, regimen E, electi F WHERE A.ele_cod='$ele_cod' AND A.coh_id=B.coh_id AND A.mod_id=C.mod_id AND A.esp_id=D.esp_id AND A.reg_id=E.reg_id AND A.ele_cod=F.ele_cod AND A.coh_id='$coh_id' AND A.mod_id='$mod_id' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.pen_top='$pen_top'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_electi_pensum2($ele_cod, $mod_id, $reg_id, $esp_id, $coh_id, $pen_top){
/*    echo "<script>alert('SELECT A.coh_id AS coh_id, B.coh_nom AS coh_nom, A.mod_id AS mod_id, C.mod_nom AS mod_nom, A.esp_id AS esp_id, D.esp_nom AS esp_nom, A.reg_id AS reg_id, E.reg_nom AS reg_nom, A.pen_top AS pen_top FROM electi_pensum A, cohort B, modali C, especi D, regimen E, electi F WHERE A.ele_cod=$ele_cod AND elp_sta=1 AND A.coh_id=B.coh_id AND A.mod_id=C.mod_id AND A.esp_id=D.esp_id AND A.reg_id=E.reg_id AND A.ele_cod=F.ele_cod AND A.coh_id=$coh_id AND A.mod_id=$mod_id AND A.esp_id=$esp_id AND A.reg_id=$reg_id AND A.pen_top=$pen_top');</script>";*/
    $res=$this->OperacionCualquiera("SELECT A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', A.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', A.esp_id AS 'esp_id', D.esp_nom AS 'esp_nom', A.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom', A.pen_top AS 'pen_top' FROM electi_pensum A, cohort B, modali C, especi D, regimen E, electi F WHERE A.ele_cod='$ele_cod' AND elp_sta='1' AND A.coh_id=B.coh_id AND A.mod_id=C.mod_id AND A.esp_id=D.esp_id AND A.reg_id=E.reg_id AND A.ele_cod=F.ele_cod AND A.coh_id='$coh_id' AND A.mod_id='$mod_id' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.pen_top='$pen_top'");
    return $res;
  }
//****************************************************************************************************
  function Agregar_electiva(){
    $res=$this->Operacion("INSERT INTO electi (ele_cod, ele_nom, ele_sta)
						VALUES ('$this->ele_cod', '$this->ele_nom', '$this->ele_sta')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//****************************************************************************************************
  function Electiva_pensum(){
    $mod_id=explode("*",$this->mod_id);
    $reg_id=explode("*",$this->reg_id);
    $esp_id=explode("*",$this->esp_id);
	$coh_id=explode("*",$this->coh_id);
	$pen_top=explode("*",$this->pen_top);
	$i=0;
/*	echo "<script>alert('$this->mod_id, $this->reg_id, $this->esp_id, $this->coh_id, $this->pen_top');</script>";*/
	$this->Eliminar_electiva_pensum();
	while($esp_id[$i]!=""){
	  $num_filas=$this->Buscar_electi_pensum($this->ele_cod, $mod_id[$i], $reg_id[$i], $esp_id[$i], $coh_id[$i], $pen_top[$i]);
/*	echo "<script>alert('$num_filas');</script>";*/
	  if($num_filas<=0){
        $num_filas=$this->Agregar_electiva_pensum($mod_id[$i],$reg_id[$i],$esp_id[$i],$coh_id[$i], $pen_top[$i]);
	    if($num_filas>0){
		  $accion='INSERTAR';
		  $Operacion="MOD: ".$mod_id[$i]." REG: ".$reg_id[$i]." ESP:".$esp_id[$i]." COH:".$coh_id[$i]." PENTOP:".$pen_top[$i]." ELE:".$this->ele_cod;
		  $this->guardar_accion($accion,"electi_pensum",$Operacion);
	    }
	  }
	  else{
        $num_filas=$this->Modificar_electiva_pensum($mod_id[$i],$reg_id[$i],$esp_id[$i],$coh_id[$i],$pen_top[$i]);
	    if($num_filas>0){
		  $accion='MODIFICAR';
		  $Operacion="MOD: ".$mod_id[$i]." REG: ".$reg_id[$i]." ESP:".$esp_id[$i]." COH:".$coh_id[$i]." PENTOP:".$pen_top[$i]." ELE:".$this->ele_cod;
		  $this->guardar_accion($accion,"electi_pensum",$Operacion);
  	    }	
	  }
	  $i++;
	}
    return 1;
  }
//****************************************************************************************************
  function Agregar_electiva_pensum($mod_id, $reg_id, $esp_id, $coh_id, $pen_top){
    $res=$this->Operacion("INSERT INTO electi_pensum (ele_cod, coh_id, mod_id, esp_id, reg_id, pen_top, elp_sta)
						VALUES ('$this->ele_cod', '$coh_id', '$mod_id', '$esp_id', '$reg_id', '$pen_top', '1')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Buscar_electiva($id){
    $this->Operacion("SELECT * FROM electi WHERE ele_cod='$id'");
  }
//******************************************************************
  function Modificar_electiva(){
/*  echo "<script>alert('UPDATE electi set ele_nom=$this->ele_nom, ele_sta=1 WHERE ele_cod=$this->ele_cod');</script>";*/
    $res=$this->Operacion("UPDATE electi set ele_nom='$this->ele_nom', ele_sta='1' WHERE ele_cod='$this->ele_cod'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_electiva_pensum($mod_id, $reg_id, $esp_id, $coh_id, $pen_top){
/*  echo "<script>alert('UPDATE electi_pensum set elp_sta='1' WHERE ele_cod=$this->ele_cod AND mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND coh_id=$coh_id AND pen_top=$pen_top');</script>";*/
    $res=$this->Operacion("UPDATE electi_pensum set elp_sta='1' WHERE ele_cod='$this->ele_cod' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_electiva(){
    $res=$this->Operacion("UPDATE electi set ele_sta='$this->ele_sta' WHERE ele_cod='$this->ele_cod'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_electiva_pensum(){
    $res=$this->Operacion("UPDATE electi_pensum set elp_sta='0' WHERE ele_cod='$this->ele_cod'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>