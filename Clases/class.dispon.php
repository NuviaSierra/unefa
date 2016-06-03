<?php session_start();
class dispon extends conec_BD
{
 var $pac_id='';
 var $ci='';
 var $dia_id='';
 var $blh_id='';
 var $inf_id='';
 var $dbh_tip='';
 var $sta='';
//******************************************************************
  function dispon($pac_id,$dia_id,$blh_id,$inf_id,$sta){
    $this->pac_id=$pac_id;
    $this->ci=$_SESSION['ci'];
    $this->dia_id=$dia_id;
    $this->blh_id=$blh_id;
	$this->inf_id=$inf_id;
    $this->dbh_tip='0';
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_dispon_Nucleo_Infrae($nuc_id,$inf_id){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND C.nuc_id='$nuc_id' AND B.inf_id='$inf_id' AND A.dbh_tip='0'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_dispon_Nucleo_Infrae($nuc_id,$inf_id,$inicial,$cantidad){
    $resultado=$this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND C.nuc_id='$nuc_id' AND B.inf_id='$inf_id' AND A.dbh_tip='0' order by C.nuc_nom,B.inf_nom,D.dia_nom,E.blh_ini,E.blh_fin LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Infrae($nuc_id){
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$this->ci') order by A.inf_nom");
	return $resultado;
  }
//******************************************************************
  function Listado_Infrae_Nucleo($inf_id){
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom', A.nuc_id AS 'nuc_id', B.nuc_nom AS 'nuc_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND A.inf_id='$inf_id'");
	return $resultado;
  }
//******************************************************************
  function Contar_dispon_Nucleo_Todas($nuc_id){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND C.nuc_id='$nuc_id' AND A.dbh_tip='0' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$this->ci')");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_dispon_Nucleo_Todas($nuc_id,$inicial,$cantidad){
    $resultado=$this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND C.nuc_id='$nuc_id' AND A.dbh_tip='0' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$this->ci') order by C.nuc_nom,B.inf_nom,D.dia_nom,E.blh_ini,E.blh_fin LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Infraestructura_Nucleo($nuc_id){
    $id=$nom="";
    $cuantos=0;
	$this->ci=$_SESSION['ci'];
    $resp=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$this->ci') order by A.inf_nom DESC");
    while($array=$this->ConsultarCualquiera($resp)){
	  $cadena=$array->inf_nom;
	  for ($i=0;$i<strlen($cadena);$i++){
        if($cadena[$i]=='Á')
          $cadena[$i]='A';
		else{
		  if($cadena[$i]=='É')
            $cadena[$i]='E';
		  else{
		    if($cadena[$i]=='Í')
              $cadena[$i]='I';
			else{
			  if($cadena[$i]=='Ó')
                $cadena[$i]='O';
			  else{
			    if($cadena[$i]=='Ú')
                  $cadena[$i]='U';
				else{
				  if($cadena[$i]=='Ñ')
                    $cadena[$i]='N';
				}
			  }
			}
		  }	
		}
      } 
	  if($id==""){
	    $id=$array->inf_id;
	    $nom=$cadena;
	  }
	  else{
	    $id=$array->inf_id."*".$id;
	    $nom=$cadena."*".$nom;
	  }
	  $cuantos++;
	}
	$this->res=$id."@".$nom."@".$cuantos;
  }
//******************************************************************
  function Listado_Nucleo(){
    $resultado=$this->Operacion("SELECT DISTINCT (A.nuc_id) AS 'nuc_id', A.nuc_nom AS 'nuc_nom' FROM nucleo A, infrae B WHERE A.nuc_sta = '1' AND A.nuc_id = B.nuc_id AND B.inf_id IN (SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$this->ci') order by A.nuc_nom");
    return $resultado;
  }
//******************************************************************
  function Contar_dispon_Todas(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND A.dbh_tip='0' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$this->ci')");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_dispon_Todas($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND A.dbh_tip='0' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$this->ci') order by C.nuc_nom,B.inf_nom,D.dia_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($pac_id,$dia_id,$blh_id,$inf_id,$sta,$tip){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->pac_id=$pac_id;
    $this->ci=$_SESSION['ci'];
    $this->dia_id=$dia_id;
    $this->blh_id=$blh_id;
	$this->inf_id=$inf_id;
    $this->dbh_tip=$tip;
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_Periodo(){
    $this->ci_est=$ci_est;
	$dias=time();
	$fecha=date("Y-m-d H:i:s",$dias);
/*	echo "<script>alert('Cedula $this->ci_est');</script>";*/
    $res=$this->OperacionCualquiera("SELECT pac_id, pac_nom FROM pacade WHERE pac_sta='1' AND DATEDIFF(pac_ffin,'$fecha')>=0 ORDER BY pac_nom");
    return $res;
  }
//******************************************************************
  function Buscar_Pacade(){
    $num_filas='';
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
    $respuesta=$this->OperacionCualquiera("SELECT pac_id FROM pacade WHERE DATEDIFF('$fecha',pac_fin)>=0 AND DATEDIFF(pac_ffin,'$fecha')>=0 AND pac_sta='1'");
	$num_filas=$this->NumFilas();
	
	$pacade=$this->ConsultarCualquiera($respuesta);
//    $num_filas=$this->NumFilas();
    return $pacade->pac_id;
  }
//******************************************************************
  function Buscar_dispon($inf_id,$dbh_tip){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND A.dbh_tip='$dbh_tip' AND A.inf_id='$inf_id'");
	return $res;
  }
//******************************************************************
  function Buscar_docente1($ci){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT concat(ap1,' ',ap2,' ',no1,' ',no2) AS 'nombre' FROM persona WHERE ci='$ci'");
	$array=$this->ConsultarCualquiera($res);
	return $array->nombre;
  }
//******************************************************************
  function Buscar_pacade1($pac_id){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT pac_nom FROM pacade WHERE pac_id='$pac_id'");
	$array=$this->ConsultarCualquiera($res);
	return $array->pac_nom;
  }

//******************************************************************
  function Buscar_Blh_Ini_Fin($blh_id, $dia_id){
/*    echo "<script>alert('SELECT * FROM dispon WHERE blh_id=$blh_id AND dia_id=$dia_id AND inf_id=$this->inf_id AND dbh_tip=$this->dbh_tip AND pac_id=$this->pac_id AND ci_emp=$this->ci');</script>";*/
    $this->ci=$_SESSION['ci'];
    $res=$this->Operacion("SELECT * FROM dispon WHERE blh_id='$blh_id' AND dia_id='$dia_id' AND inf_id='$this->inf_id' AND dbh_tip='$this->dbh_tip' AND pac_id='$this->pac_id' AND ci_emp='$this->ci'");
    $num_filas=$this->NumFilas();
/*echo "<script>alert('Filas: $num_filas');</script>";*/
    if($num_filas>0)
      $row=$res;
    return $row;
  }
//******************************************************************
  function Buscar_Blh_Ini_Fin1($blh_id, $dia_id){
/*    echo "<script>alert('SELECT * FROM dispon WHERE blh_id=$blh_id AND dia_id=$dia_id AND inf_id=$this->inf_id AND dbh_tip=$this->dbh_tip AND pac_id=$this->pac_id AND ci_emp=$this->ci');</script>";*/
    $row=0;
	$this->ci=$_SESSION['ci'];
    $res=$this->Operacion("SELECT * FROM dispon WHERE blh_id='$blh_id' AND dia_id='$dia_id' AND inf_id='$this->inf_id' AND dbh_tip='$this->dbh_tip' AND pac_id='$this->pac_id' AND ci_emp='$this->ci'");
    $num_filas=$this->NumFilas();
    /*echo "<script>alert('Filas: $num_filas');</script>";*/
    if($num_filas>0)
      $row=1;
/*    echo "<script>alert('filas1 $row');</script>";*/
    return $row;
  }
//****************************************************************************************************
  function Agregar_Dia_Blo_Inf_Tip($blo,$dia,$sta){
/*    echo "<script>alert('INSERT INTO dispon (pac_id, dia_id, blh_id, inf_id, ci_emp, dbh_tip, dis_sta) VALUES ($this->pac_id,$dia, $blo, $this->inf_id, $this->ci, $this->dbh_tip, $sta)');</script>";*/
	$res=$this->Operacion("INSERT INTO dispon (pac_id, dia_id, blh_id, inf_id, ci_emp, dbh_tip, dis_sta)
						VALUES ('$this->pac_id','$dia', '$blo', '$this->inf_id', '$this->ci', '$this->dbh_tip', '$sta')");
    $num_filas=$this->filas_afectadas($res);
	if($num_filas>0){
	  $accion='INSERTAR';
      $Operacion="DOCENTE: ".$this->ci." INFRAE: ".$this->inf_id." PACADE: ".$this->pac_id." TIPO DE FORMATO: ".$this->dbh_tip." DIA: ".$dia." BLOQUE DE HORA: ".$blo." DISPONIBILIDAD: ".$sta."";	
	  $this->guardar_accion($accion,"dispon",$Operacion);
	}
    return $num_filas;
  }
//******************************************************************
  function Modificar_Dia_Blo_Inf_Tip($blo,$dia,$sta){
/*    echo "<script>alert('UPDATE dispon set dis_sta=$sta WHERE pac_id=$this->pac_id AND dia_id=$dia AND blh_id=$blo AND inf_id=$this->inf AND ci_emp=$this->ci AND dbh_tip=$this->dbh_tip');</script>";*/
    $res=$this->Operacion("UPDATE dispon set dis_sta='$sta' WHERE pac_id='$this->pac_id' AND dia_id='$dia' AND blh_id='$blo' AND inf_id='$this->inf_id' AND ci_emp='$this->ci' AND dbh_tip='$this->dbh_tip'");
    $num_filas=$this->filas_afectadas($res);
	if($num_filas>0){
	  $accion='MODIFICAR';
      $Operacion="DOCENTE: ".$this->ci." INFRAE: ".$this->inf_id." PACADE: ".$this->pac_id." TIPO DE FORMATO: ".$this->dbh_tip." DIA: ".$dia." BLOQUE DE HORA: ".$blo." DISPONIBILIDAD: ".$sta."";	
	  $this->guardar_accion($accion,"dispon",$Operacion);
	}
    return $num_filas;
  }
//******************************************************************
  function Listado_Infraestructura_Nucleo_docente($nuc_id,$ci_doc){
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
    $id=$nom="";
    $cuantos=0;
	$this->ci=$_SESSION['ci'];
    $resp=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$ci_doc' AND inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae WHERE ((DATEDIFF('$fecha',est_inf_fin)>=0 AND DATEDIFF(est_inf_ffi,'$fecha')>=0) OR (DATEDIFF('$fecha',est_inf_fin)>=0 AND est_inf_ffi='0000-00-00 00:00:00')) AND ci='$this->ci')) order by A.inf_nom DESC");
    while($array=$this->ConsultarCualquiera($resp)){
	  $cadena=$array->inf_nom;
	  for ($i=0;$i<strlen($cadena);$i++){
        if($cadena[$i]=='Á')
          $cadena[$i]='A';
		else{
		  if($cadena[$i]=='É')
            $cadena[$i]='E';
		  else{
		    if($cadena[$i]=='Í')
              $cadena[$i]='I';
			else{
			  if($cadena[$i]=='Ó')
                $cadena[$i]='O';
			  else{
			    if($cadena[$i]=='Ú')
                  $cadena[$i]='U';
				else{
				  if($cadena[$i]=='Ñ')
                    $cadena[$i]='N';
				}
			  }
			}
		  }	
		}
      } 
	  if($id==""){
	    $id=$array->inf_id;
	    $nom=$cadena;
	  }
	  else{
	    $id=$array->inf_id."*".$id;
	    $nom=$cadena."*".$nom;
	  }
	  $cuantos++;
	}
	$this->res=$id."@".$nom."@".$cuantos;
  }
//******************************************************************
  function Listado_Nucleo_docente($ci_doc){
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
    $resultado=$this->Operacion("SELECT DISTINCT (A.nuc_id) AS 'nuc_id', A.nuc_nom AS 'nuc_nom' FROM nucleo A, infrae B WHERE A.nuc_sta = '1' AND A.nuc_id = B.nuc_id AND B.inf_id IN (SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$ci_doc' AND inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae WHERE ((DATEDIFF('$fecha',est_inf_fin)>=0 AND DATEDIFF(est_inf_ffi,'$fecha')>=0) OR (DATEDIFF('$fecha',est_inf_fin)>=0 AND est_inf_ffi='0000-00-00 00:00:00')) AND ci='$this->ci')) order by A.nuc_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Infrae_docente($nuc_id,$ci_doc){
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$ci_doc' AND inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae WHERE ((DATEDIFF('$fecha',est_inf_fin)>=0 AND DATEDIFF(est_inf_ffi,'$fecha')>=0) OR (DATEDIFF('$fecha',est_inf_fin)>=0 AND est_inf_ffi='0000-00-00 00:00:00')) AND ci='$this->ci')) order by A.inf_nom");
	return $resultado;
  }
//******************************************************************
  function Contar_dispon_Todas_docente($ci_doc){
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND A.dbh_tip='0' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$ci_doc' AND inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae WHERE ((DATEDIFF('$fecha',est_inf_fin)>=0 AND DATEDIFF(est_inf_ffi,'$fecha')>=0) OR (DATEDIFF('$fecha',est_inf_fin)>=0 AND est_inf_ffi='0000-00-00 00:00:00')) AND ci='$this->ci'))");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_dispon_Todas_docente($inicial,$cantidad,$ci_doc){
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
    $resultado=$this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND A.dbh_tip='0' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$ci_doc' AND inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae WHERE ((DATEDIFF('$fecha',est_inf_fin)>=0 AND DATEDIFF(est_inf_ffi,'$fecha')>=0) OR (DATEDIFF('$fecha',est_inf_fin)>=0 AND est_inf_ffi='0000-00-00 00:00:00')) AND ci='$this->ci')) order by C.nuc_nom,B.inf_nom,D.dia_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Contar_dispon_Nucleo_Todas_docente($nuc_id,$ci_doc){
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND C.nuc_id='$nuc_id' AND A.dbh_tip='0' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$ci_doc' AND inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae WHERE ((DATEDIFF('$fecha',est_inf_fin)>=0 AND DATEDIFF(est_inf_ffi,'$fecha')>=0) OR (DATEDIFF('$fecha',est_inf_fin)>=0 AND est_inf_ffi='0000-00-00 00:00:00')) AND ci='$this->ci'))");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_dispon_Nucleo_Todas_docente($nuc_id,$inicial,$cantidad,$ci_doc){
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
    $resultado=$this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND C.nuc_id='$nuc_id' AND A.dbh_tip='0' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$ci_doc' AND inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae WHERE ((DATEDIFF('$fecha',est_inf_fin)>=0 AND DATEDIFF(est_inf_ffi,'$fecha')>=0) OR (DATEDIFF('$fecha',est_inf_fin)>=0 AND est_inf_ffi='0000-00-00 00:00:00')) AND ci='$this->ci')) order by C.nuc_nom,B.inf_nom,D.dia_nom,E.blh_ini,E.blh_fin LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Contar_dispon_Nucleo_Infrae_docente($nuc_id,$inf_id,$ci_doc){
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND C.nuc_id='$nuc_id' AND B.inf_id='$inf_id' AND A.dbh_tip='0' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$ci_doc' AND inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae WHERE ((DATEDIFF('$fecha',est_inf_fin)>=0 AND DATEDIFF(est_inf_ffi,'$fecha')>=0) OR (DATEDIFF('$fecha',est_inf_fin)>=0 AND est_inf_ffi='0000-00-00 00:00:00')) AND ci='$this->ci'))");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_dispon_Nucleo_Infrae_docente($nuc_id,$inf_id,$inicial,$cantidad,$ci_doc){
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
    $resultado=$this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND C.nuc_id='$nuc_id' AND B.inf_id='$inf_id' AND A.dbh_tip='0' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND eim_tip IN ('1','2','3','7') AND ci='$ci_doc' AND inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae WHERE ((DATEDIFF('$fecha',est_inf_fin)>=0 AND DATEDIFF(est_inf_ffi,'$fecha')>=0) OR (DATEDIFF('$fecha',est_inf_fin)>=0 AND est_inf_ffi='0000-00-00 00:00:00')) AND ci='$this->ci')) order by C.nuc_nom,B.inf_nom,D.dia_nom,E.blh_ini,E.blh_fin LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Buscar_Blh_Ini_Fin_docente($blh_id, $dia_id, $ci_doc){
/*    echo "<script>alert('SELECT * FROM dispon WHERE blh_id=$blh_id AND dia_id=$dia_id AND inf_id=$this->inf_id AND dbh_tip=$this->dbh_tip AND pac_id=$this->pac_id AND ci_emp=$this->ci');</script>";*/
    $this->ci=$_SESSION['ci'];
    $res=$this->Operacion("SELECT * FROM dispon WHERE blh_id='$blh_id' AND dia_id='$dia_id' AND inf_id='$this->inf_id' AND dbh_tip='$this->dbh_tip' AND pac_id='$this->pac_id' AND ci_emp='$ci_doc'");
    $num_filas=$this->NumFilas();
/*echo "<script>alert('Filas: $num_filas');</script>";*/
    if($num_filas>0)
      $row=$res;
    return $row;
  }
//******************************************************************
  function Buscar_Blh_Ini_Fin1_docente($blh_id, $dia_id,$ci_doc){
/*    echo "<script>alert('SELECT * FROM dispon WHERE blh_id=$blh_id AND dia_id=$dia_id AND inf_id=$this->inf_id AND dbh_tip=$this->dbh_tip AND pac_id=$this->pac_id AND ci_emp=$this->ci');</script>";*/
    $row=0;
	$this->ci=$_SESSION['ci'];
    $res=$this->Operacion("SELECT * FROM dispon WHERE blh_id='$blh_id' AND dia_id='$dia_id' AND inf_id='$this->inf_id' AND dbh_tip='$this->dbh_tip' AND pac_id='$this->pac_id' AND ci_emp='$ci_doc'");
    $num_filas=$this->NumFilas();
    /*echo "<script>alert('Filas: $num_filas');</script>";*/
    if($num_filas>0)
      $row=1;
/*    echo "<script>alert('filas1 $row');</script>";*/
    return $row;
  }
//****************************************************************************************************
  function Agregar_Dia_Blo_Inf_Tip_docente($blo,$dia,$sta,$ci_doc){
/*    echo "<script>alert('INSERT INTO dispon (pac_id, dia_id, blh_id, inf_id, ci_emp, dbh_tip, dis_sta) VALUES ($this->pac_id,$dia, $blo, $this->inf_id, $this->ci, $this->dbh_tip, $sta)');</script>";*/
	$res=$this->Operacion("INSERT INTO dispon (pac_id, dia_id, blh_id, inf_id, ci_emp, dbh_tip, dis_sta)
						VALUES ('$this->pac_id','$dia', '$blo', '$this->inf_id', '$ci_doc', '$this->dbh_tip', '$sta')");
    $num_filas=$this->filas_afectadas($res);
	if($num_filas>0){
	  $accion='INSERTAR';
      $Operacion="DOCENTE: ".$this->ci." INFRAE: ".$this->inf_id." PACADE: ".$this->pac_id." TIPO DE FORMATO: ".$this->dbh_tip." DIA: ".$dia." BLOQUE DE HORA: ".$blo." DISPONIBILIDAD: ".$sta."";	
	  $this->guardar_accion($accion,"dispon",$Operacion);
	}
    return $num_filas;
  }
//******************************************************************
  function Modificar_Dia_Blo_Inf_Tip_docente($blo,$dia,$sta,$ci_doc){
/*    echo "<script>alert('UPDATE dispon set dis_sta=$sta WHERE pac_id=$this->pac_id AND dia_id=$dia AND blh_id=$blo AND inf_id=$this->inf AND ci_emp=$this->ci AND dbh_tip=$this->dbh_tip');</script>";*/
    $res=$this->Operacion("UPDATE dispon set dis_sta='$sta' WHERE pac_id='$this->pac_id' AND dia_id='$dia' AND blh_id='$blo' AND inf_id='$this->inf_id' AND ci_emp='$ci_doc' AND dbh_tip='$this->dbh_tip'");
    $num_filas=$this->filas_afectadas($res);
	if($num_filas>0){
	  $accion='MODIFICAR';
      $Operacion="DOCENTE: ".$this->ci." INFRAE: ".$this->inf_id." PACADE: ".$this->pac_id." TIPO DE FORMATO: ".$this->dbh_tip." DIA: ".$dia." BLOQUE DE HORA: ".$blo." DISPONIBILIDAD: ".$sta."";	
	  $this->guardar_accion($accion,"dispon",$Operacion);
	}
    return $num_filas;
  }
//******************************************************************
}?>