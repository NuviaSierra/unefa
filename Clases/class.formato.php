<?php session_start();
class formato extends conec_BD
{
 var $dia_id='';
 var $blh_id='';
 var $inf_id='';
 var $dbh_tip='';
 var $sta='';
//******************************************************************
  function formato($dia_id,$blh_id,$inf_id,$dbh_tip,$sta){
    $this->dia_id=$dia_id;
    $this->blh_id=$blh_id;
	$this->inf_id=$inf_id;
    $this->dbh_tip=$dbh_tip;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_formato_Nucleo_Infrae($nuc_id,$inf_id){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND C.nuc_id='$nuc_id' AND B.inf_id='$inf_id'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_formato_Nucleo_Infrae($nuc_id,$inf_id,$inicial,$cantidad){
    $resultado=$this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND C.nuc_id='$nuc_id' AND B.inf_id='$inf_id' order by C.nuc_nom,B.inf_nom,D.dia_nom,E.blh_ini,E.blh_fin LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Infrae($nuc_id){
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' order by A.inf_nom");
	return $resultado;
  }
//******************************************************************
  function Listado_Infrae_Nucleo($inf_id){
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom', A.nuc_id AS 'nuc_id', B.nuc_nom AS 'nuc_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND A.inf_id='$inf_id'");
	return $resultado;
  }
//******************************************************************
  function Contar_formato_Nucleo_Todas($nuc_id){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND C.nuc_id='$nuc_id'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_formato_Nucleo_Todas($nuc_id,$inicial,$cantidad){
    $resultado=$this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND C.nuc_id='$nuc_id' order by C.nuc_nom,B.inf_nom,D.dia_nom,E.blh_ini,E.blh_fin LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Infraestructura_Nucleo($nuc_id){
    $id=$nom="";
    $cuantos=0;
    $resp=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' order by A.inf_nom DESC");
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
/*        if($cadena[$i]=='Á')
          $cadena[$i]='\301';
		else{
		  if($cadena[$i]=='É')
            $cadena[$i]='\311';
		  else{
		    if($cadena[$i]=='Í')
              $cadena[$i]='\315';
			else{
			  if($cadena[$i]=='Ó')
                $cadena[$i]='\323';
			  else{
			    if($cadena[$i]=='Ú')
                  $cadena[$i]='\332';
				else{
				  if($cadena[$i]=='Ñ')
                    $cadena[$i]='\321';
				}*/
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
    $resultado=$this->Operacion("SELECT * FROM nucleo WHERE nuc_sta='1' order by nuc_nom");
    return $resultado;
  }
//******************************************************************
  function Contar_formato_Todas(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_formato_Todas($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id order by C.nuc_nom,B.inf_nom,D.dia_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($dia_id,$blh_id,$inf_id,$dbh_tip,$sta){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->dia_id=$dia_id;
    $this->blh_id=$blh_id;
/*    echo "<script>alert('id: $this->id');</script>";*/
	$this->inf_id=$inf_id;
    $this->dbh_tip=$dbh_tip;
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_formato($inf_id,$dbh_tip){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND A.dbh_tip='$dbh_tip' AND A.inf_id='$inf_id'");
	return $res;
  }
//******************************************************************
  function Buscar_Blh_Ini_Fin(){
/*    echo "<script>alert('INICIO:$this->blh_ini, FIN: $this->blh_fin ');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM dia_blh WHERE blh_id='$this->blh_id' AND dia_id='$this->dia_id' AND inf_id='$this->inf_id' AND dbh_tip='$this->dbh_tip' AND dbh_sta='1'");
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
    $this->Operacion("SELECT * FROM dia_blh WHERE blh_id='$this->blh_id' AND dia_id='$this->dia_id' AND inf_id='$this->inf_id' AND dbh_tip='$this->dbh_tip' AND blh_sta='0'");
    $num_filas=$this->NumFilas();
    /*echo "<script>alert('Filas: $num_filas');</script>";*/
    if($num_filas>0)
      $row=1;
  /*  echo "<script>alert('filas1 $row');</script>";*/
    return $row;
  }
//****************************************************************************************************
  function Agregar_Dia_Blo_Inf_Tip($blo,$dia,$inf,$tip){
	$res=$this->Operacion("INSERT INTO dia_blh (dia_id, blh_id, inf_id, dbh_tip, dbh_sta)
						VALUES ('$dia', '$blo', '$inf', '$tip', '1')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_Dia_Blo_Inf_Tip($blo,$dia,$inf,$tip){
/*    echo "<script>alert('UPDATE tab_ope set tab_ope_sta=1, tab_ope_fin=$Fecha, tab_ope_ffi= WHERE ope_id=$ope AND tab_id=$tab AND per_id=$per');</script>";*/
    $res=$this->Operacion("UPDATE dia_blh set dbh_sta='1' WHERE dia_id='$dia' AND blh_id='$blo' AND inf_id='$inf' AND dbh_tip='$tip'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_Dia_Blo_Inf_Tip($blo,$dia,$inf,$tip){
/*    echo "<script>alert('UPDATE tab_ope set tab_ope_sta=0, tab_ope_ffi=$Fecha WHERE ope_id=$ope AND tab_id=$tab AND per_id=$per');</script>";*/
    $res=$this->Operacion("UPDATE dia_blh set dbh_sta='0' WHERE dia_id='$dia' AND blh_id='$blo' AND inf_id='$inf' AND dbh_tip='$tip'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>