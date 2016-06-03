<?php session_start();
class docente extends conec_BD
{
 var $ci='';
 var $no1='';
 var $no2='';
 var $no3='';
 var $ap1='';
 var $ap2='';
 var $ap3='';
 var $sex='';
 var $ecv='';
 var $gsa='';
 var $frh='';
 var $tmo='';
 var $nfa='';
 var $tfa='';
 var $tip='';
 var $did='';
 var $cre='';
 var $correo='';
 var $inf_id='';
 var $mod_id='';
 var $esp_id='';
 var $reg_id='';
 var $coh_id='';
 var $sta='';
 var $coord='';
//******************************************************************
  function docente($ci,$no1,$no2,$no3,$ap1,$ap2,$ap3,$sex,$ecv,$gsa,$frh,$tmo,$nfa,$tfa,$tip,$did,$cre,$correo,$inf_id,$mod_id,$esp_id,$reg_id,$coh_id,$sta){
    $this->ci=$ci;
    $this->no1=$this->ConvertirMayuscula($no1);
    $this->no2=$this->ConvertirMayuscula($no2);
    $this->no3=$this->ConvertirMayuscula($no3);
    $this->ap1=$this->ConvertirMayuscula($ap1);
    $this->ap2=$this->ConvertirMayuscula($ap2);
    $this->ap3=$this->ConvertirMayuscula($ap3);
    $this->sex=$sex;
    $this->ecv=$ecv;
    $this->gsa=$gsa;
    $this->frh=$frh;
    $this->tmo=$tmo;
    $this->nfa=$this->ConvertirMayuscula($nfa);
    $this->tfa=$tfa;
    $this->tip=$tip;
    $this->did=$did;
    $this->cre=$cre;
    $this->correo=$this->ConvertirMayuscula($correo);
    $this->inf_id=$inf_id;
    $this->mod_id=$mod_id;
    $this->esp_id=$esp_id;
    $this->reg_id=$reg_id;
    $this->coh_id=$coh_id;
    $this->sta=$sta;
	$this->coord=$_SESSION['ci'];
  }
//******************************************************************
  function Contar_docente_Nucleo_Infrae_docente($nuc_id,$inf_id,$ci){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.ci) AS 'ci', CONCAT( A.no1,' ',A.no2) AS nombre, CONCAT( A.ap1,' ',A.ap2) AS apellido FROM persona A, estudi_infrae B, infrae C, nucleo D WHERE A.ci='$ci' AND A.tip!='0' AND A.sta='1' AND A.ci=B.ci AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND B.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_sta='1' AND D.nuc_sta='1' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') AND C.nuc_id='$nuc_id' AND B.inf_id='$inf_id'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_docente_Nucleo_Infrae_docente($nuc_id,$inf_id,$inicial,$cantidad,$ci){
    $resultado=$this->Operacion("SELECT DISTINCT(A.ci) AS 'ci', CONCAT(A.no1,' ',A.no2) AS nombre, CONCAT(A.ap1,' ',A.ap2) AS apellido FROM persona A, estudi_infrae B, infrae C, nucleo D WHERE A.ci='$ci' AND A.tip!='0' AND A.sta='1' AND A.ci=B.ci AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND B.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_sta='1' AND D.nuc_sta='1' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') AND C.nuc_id='$nuc_id' AND B.inf_id='$inf_id' order by ci, apellido, nombre LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Contar_docente_Nucleo_Infrae($nuc_id,$inf_id){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.ci) AS 'ci', CONCAT( A.no1,' ',A.no2) AS nombre, CONCAT( A.ap1,' ',A.ap2) AS apellido FROM persona A, estudi_infrae B, infrae C, nucleo D WHERE A.tip!='0' AND A.sta='1' AND A.ci=B.ci AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND B.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_sta='1' AND D.nuc_sta='1' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') AND C.nuc_id='$nuc_id' AND B.inf_id='$inf_id'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_docente_Nucleo_Infrae($nuc_id,$inf_id,$inicial,$cantidad){
    $resultado=$this->Operacion("SELECT DISTINCT(A.ci) AS 'ci', CONCAT(A.no1,' ',A.no2) AS nombre, CONCAT(A.ap1,' ',A.ap2) AS apellido FROM persona A, estudi_infrae B, infrae C, nucleo D WHERE A.tip!='0' AND A.sta='1' AND A.ci=B.ci AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND B.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_sta='1' AND D.nuc_sta='1' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') AND C.nuc_id='$nuc_id' AND B.inf_id='$inf_id' order by ci, apellido, nombre LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Infrae($nuc_id){
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' AND A.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') order by A.inf_nom");
	return $resultado;
  }
//******************************************************************
  function Listado_Infrae_Nucleo($inf_id){
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom', A.nuc_id AS 'nuc_id', B.nuc_nom AS 'nuc_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND A.inf_id='$inf_id'");
	return $resultado;
  }
//******************************************************************
  function Contar_docente_Nucleo_Todas_docente($nuc_id,$ci){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.ci) AS 'ci', CONCAT(A.no1,' ',A.no2) AS nombre, CONCAT(A.ap1,' ',A.ap2) AS apellido FROM persona A, estudi_infrae B, infrae C, nucleo D WHERE A.ci='$ci' AND A.tip!='0' AND A.sta='1' AND A.ci=B.ci AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND B.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_sta='1' AND D.nuc_sta='1' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') AND C.nuc_id='$nuc_id'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_docente_Nucleo_Todas_docente($nuc_id,$inicial,$cantidad,$ci){
    $resultado=$this->Operacion("SELECT DISTINCT(A.ci) AS 'ci', CONCAT(A.no1,' ',A.no2) AS nombre, CONCAT(A.ap1,' ',A.ap2) AS apellido FROM persona A, estudi_infrae B, infrae C, nucleo D WHERE A.ci='$ci' AND A.tip!='0' AND A.sta='1' AND A.ci=B.ci AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND B.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_sta='1' AND D.nuc_sta='1' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') AND C.nuc_id='$nuc_id' order by ci, apellido, nombre LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Contar_docente_Nucleo_Todas($nuc_id){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.ci) AS 'ci', CONCAT(A.no1,' ',A.no2) AS nombre, CONCAT(A.ap1,' ',A.ap2) AS apellido FROM persona A, estudi_infrae B, infrae C, nucleo D WHERE A.tip!='0' AND A.sta='1' AND A.ci=B.ci AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND B.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_sta='1' AND D.nuc_sta='1' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') AND C.nuc_id='$nuc_id'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_docente_Nucleo_Todas($nuc_id,$inicial,$cantidad){
    $resultado=$this->Operacion("SELECT DISTINCT(A.ci) AS 'ci', CONCAT(A.no1,' ',A.no2) AS nombre, CONCAT(A.ap1,' ',A.ap2) AS apellido FROM persona A, estudi_infrae B, infrae C, nucleo D WHERE A.tip!='0' AND A.sta='1' AND A.ci=B.ci AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND B.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_sta='1' AND D.nuc_sta='1' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') AND C.nuc_id='$nuc_id' order by ci, apellido, nombre LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Infraestructura_Nucleo($nuc_id){
    $id=$nom="";
    $cuantos=0;
    $resp=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' AND A.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') order by A.inf_nom DESC");
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
  $this->coord=$_SESSION[ci];
    $resultado=$this->Operacion("SELECT DISTINCT (A.nuc_id) AS 'nuc_id', A.nuc_nom AS 'nuc_nom' FROM nucleo A, infrae B WHERE A.nuc_sta = '1' AND A.nuc_id = B.nuc_id AND B.inf_id IN (SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') order by nuc_nom");
    return $resultado;
  }
//******************************************************************
  function Contar_docente_Todas_docente($ci){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.ci) AS 'ci', CONCAT(A.no1,' ',A.no2) AS nombre, CONCAT(A.ap1,' ',A.ap2) AS apellido FROM persona A, estudi_infrae_matric B, infrae C, nucleo D WHERE A.ci='$ci' AND A.tip!='0' AND A.sta='1' AND A.ci=B.ci AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id  AND B.eim_sta='1' AND C.inf_sta='1' AND D.nuc_sta='1' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord')");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_docente_Todas_docente($inicial,$cantidad,$ci){
    $resultado=$this->Operacion("SELECT DISTINCT(A.ci) AS 'ci', CONCAT(A.no1,' ',A.no2) AS nombre, CONCAT(A.ap1,' ',A.ap2) AS apellido FROM persona A, estudi_infrae B, infrae C, nucleo D WHERE A.ci='$ci' AND A.tip!='0' AND A.sta='1' AND A.ci=B.ci AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND B.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_sta='1' AND D.nuc_sta='1' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') order by ci, apellido, nombre LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Contar_docente_Todas(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.ci) AS 'ci', CONCAT(A.no1,' ',A.no2) AS nombre, CONCAT(A.ap1,' ',A.ap2) AS apellido FROM persona A, estudi_infrae B, infrae C, nucleo D WHERE A.tip!='0' AND A.sta='1' AND A.ci=B.ci AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND B.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_sta='1' AND D.nuc_sta='1' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord')");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_docente_Todas($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT DISTINCT(A.ci) AS 'ci', CONCAT(A.no1,' ',A.no2) AS nombre, CONCAT(A.ap1,' ',A.ap2) AS apellido FROM persona A, estudi_infrae B, infrae C, nucleo D WHERE A.tip!='0' AND A.sta='1' AND A.ci=B.ci AND B.inf_id=C.inf_id AND C.nuc_id=D.nuc_id AND B.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_sta='1' AND D.nuc_sta='1' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') order by ci, apellido, nombre LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($ci, $no1, $no2, $no3, $ap1, $ap2, $ap3, $sex, $ecv, $gsa, $frh, $tmo, $nfa, $tfa, $tip, $did, $cre, $correo, $sta){
    $this->ci=$ci;
    $this->no1=$this->ConvertirMayuscula($no1);
    $this->no2=$this->ConvertirMayuscula($no2);
    $this->no3=$this->ConvertirMayuscula($no3);
    $this->ap1=$this->ConvertirMayuscula($ap1);
    $this->ap2=$this->ConvertirMayuscula($ap2);
    $this->ap3=$this->ConvertirMayuscula($ap3);
    $this->sex=$sex;
    $this->ecv=$ecv;
    $this->gsa=$gsa;
    $this->frh=$frh;
    $this->tmo=$tmo;
    $this->nfa=$this->ConvertirMayuscula($nfa);
    $this->tfa=$tfa;
    $this->tip=$tip;
    $this->did=$did;
    $this->cre=$cre;
    $this->correo=$this->ConvertirMayuscula($correo);
    $this->sta=$sta;
	$this->coord=$_SESSION['ci'];
  }
//******************************************************************  
  function Asignar_matricula($inf_id,$mod_id, $esp_id, $reg_id, $coh_id, $sta){
    $this->$inf_id=$inf_id;
    $this->$mod_id=$mod_id;
    $this->$esp_id=$esp_id;
    $this->$reg_id=$reg_id;
    $this->$coh_id=$coh_id;
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_docente($ci){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT A.ci AS 'ci', CONCAT(A.no1,' ',A.no2) AS nombre, CONCAT(A.ap1,' ',A.ap2) AS apellido, A.did AS 'did', A.cre 'cre', A.tmo AS 'tmo', B.usu_cor AS 'usu_cor', A.tip AS 'tip', A.nfa AS 'nfa', A.tfa AS 'tfa' FROM persona A, usuari B WHERE A.ci=B.ci AND A.ci='$ci'");
	return $res;
  }
//******************************************************************
  function Buscar_docente_nucleo($ci){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT DISTINCT(A.nuc_id) AS 'nuc_id', A.nuc_nom AS 'nuc_nom' FROM nucleo A, estudi_infrae B, infrae C WHERE B.ci='$ci' AND B.inf_id=C.inf_id AND A.nuc_id=C.nuc_id AND A.nuc_sta='1' AND B.est_inf_ffi='0000-00-00 00:00:00'");
	return $res;
  }
//******************************************************************
  function Buscar_matricula_docente($ci){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT DISTINCT(A.nuc_id) AS 'nuc_id', A.nuc_nom AS 'nuc_nom', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', D.mod_id AS 'mod_id', D.mod_nom AS 'mod_nom', E.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom', C.esp_id AS 'esp_id', C.esp_nom AS 'esp_nom', F.coh_id AS 'coh_id', F.coh_nom AS 'coh_nom' FROM nucleo A, infrae B, especi C, modali D, regimen E, cohort F, reg_esp_mod_infrae G, reg_esp_mod H, matric I, estudi_infrae J WHERE A.nuc_id=B.nuc_id AND B.inf_id=J.inf_id AND G.reg_id=H.reg_id AND G.esp_id=H.esp_id AND G.mod_id=H.mod_id AND G.inf_id=B.inf_id AND H.reg_id=I.reg_id AND H.esp_id=I.esp_id AND H.mod_id=I.mod_id AND I.coh_id=F.coh_id AND I.mod_id=D.mod_id AND I.reg_id=E.reg_id AND I.esp_id=C.esp_id AND I.ci=J.ci AND A.nuc_sta='1' AND B.inf_sta='1' AND C.esp_sta='1' AND D.mod_sta='1' AND E.reg_sta='1' AND F.coh_sta='1' AND G.remi_sta='1' AND H.rem_sta='1' AND I.matr_sta='1' AND I.matr_tip='1' AND J.ci='$ci' AND J.est_inf_ffi='0000-00-00 00:00:00' ORDER BY nuc_nom,inf_nom,coh_nom,mod_nom,reg_nom,esp_nom");
	return $res;
  }
//******************************************************************
  function Buscar_matricula_docente_coord($ci){
	$this->coord=$_SESSION['ci'];
/*      echo "<script>alert('SELECT DISTINCT(A.nuc_id) AS nuc_id, A.nuc_nom AS nuc_nom, B.inf_id AS inf_id, B.inf_nom AS inf_nom, D.mod_id AS mod_id, D.mod_nom AS mod_nom, E.reg_id AS reg_id, E.reg_nom AS reg_nom, C.esp_id AS esp_id, C.esp_nom AS esp_nom, F.coh_id AS coh_id, F.coh_nom AS coh_nom FROM nucleo A, infrae B, especi C, modali D, regimen E, cohort F, reg_esp_mod_infrae G, reg_esp_mod H, matric I, estudi_infrae J WHERE A.nuc_id=B.nuc_id AND B.inf_id=J.inf_id AND G.reg_id=H.reg_id AND G.esp_id=H.esp_id AND G.mod_id=H.mod_id AND G.inf_id=B.inf_id AND H.reg_id=I.reg_id AND H.esp_id=I.esp_id AND H.mod_id=I.mod_id AND I.coh_id=F.coh_id AND I.mod_id=D.mod_id AND I.reg_id=E.reg_id AND I.esp_id=C.esp_id AND I.ci=J.ci AND A.nuc_sta=1 AND B.inf_sta=1 AND C.esp_sta=1 AND D.mod_sta=1 AND E.reg_sta=1 AND F.coh_sta=1 AND G.remi_sta=1 AND H.rem_sta=1 AND I.matr_sta=1 AND I.matr_tip=1 AND J.ci=$ci AND J.est_inf_ffi=0000-00-00 00:00:00 AND B.inf_id IN(SELECT inf_id FROM estudi_infrae WHERE ci=$this->coord AND est_inf_ffi=0000-00-00 00:00:00) ORDER BY nuc_nom,inf_nom,coh_nom,mod_nom,reg_nom,esp_nom');</script>";*/
    $res=$this->Operacion("SELECT DISTINCT(A.nuc_id) AS 'nuc_id', A.nuc_nom AS 'nuc_nom', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', D.mod_id AS 'mod_id', D.mod_nom AS 'mod_nom', E.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom', C.esp_id AS 'esp_id', C.esp_nom AS 'esp_nom', F.coh_id AS 'coh_id', F.coh_nom AS 'coh_nom' FROM nucleo A, infrae B, especi C, modali D, regimen E, cohort F, reg_esp_mod_infrae G, reg_esp_mod H, matric I, estudi_infrae_matric J WHERE A.nuc_id=B.nuc_id AND B.inf_id=J.inf_id AND G.reg_id=H.reg_id AND G.esp_id=H.esp_id AND G.mod_id=H.mod_id AND G.inf_id=B.inf_id AND H.reg_id=I.reg_id AND H.esp_id=I.esp_id AND H.mod_id=I.mod_id AND I.coh_id=F.coh_id AND I.mod_id=D.mod_id AND I.reg_id=E.reg_id AND I.esp_id=C.esp_id AND I.ci=J.ci AND G.reg_id=J.reg_id AND G.esp_id=J.esp_id AND G.mod_id=J.mod_id AND I.coh_id=J.coh_id AND A.nuc_sta='1' AND B.inf_sta='1' AND C.esp_sta='1' AND D.mod_sta='1' AND E.reg_sta='1' AND F.coh_sta='1' AND G.remi_sta='1' AND H.rem_sta='1' AND I.matr_sta='1' AND I.matr_tip='1' AND J.ci='$ci' AND J.eim_sta='1' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') ORDER BY nuc_nom,inf_nom,coh_nom,mod_nom,reg_nom,esp_nom");
	return $res;
  }
//******************************************************************
  function Buscar_matricula_coord(){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT DISTINCT(A.nuc_id) AS 'nuc_id', A.nuc_nom AS 'nuc_nom', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', D.mod_id AS mod_id, D.mod_nom AS 'mod_nom', E.reg_id AS 'reg_id', E.reg_nom AS 'reg_nom', C.esp_id AS 'esp_id', C.esp_nom AS 'esp_nom', F.coh_id AS 'coh_id', F.coh_nom AS 'coh_nom' FROM nucleo A, infrae B, especi C, modali D, regimen E, cohort F, reg_esp_mod_infrae G, reg_esp_mod H, matric I, estudi_infrae J WHERE A.nuc_id=B.nuc_id AND B.inf_id=J.inf_id AND G.reg_id=H.reg_id AND G.esp_id=H.esp_id AND G.mod_id=H.mod_id AND G.inf_id=B.inf_id AND H.reg_id=I.reg_id AND H.esp_id=I.esp_id AND H.mod_id=I.mod_id AND I.coh_id=F.coh_id AND I.mod_id=D.mod_id AND I.reg_id=E.reg_id AND I.esp_id=C.esp_id AND I.ci=J.ci AND A.nuc_sta='1' AND B.inf_sta='1' AND C.esp_sta='1' AND D.mod_sta='1' AND E.reg_sta='1' AND F.coh_sta='1' AND G.remi_sta='1' AND H.rem_sta='1' AND I.matr_sta='1' AND I.matr_tip='1' AND J.ci='$this->coord' AND J.est_inf_ffi='0000-00-00 00:00:00' AND B.inf_id IN(SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = '0000-00-00 00:00:00' AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = '1' AND C.rem_sta = '1' AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = '1' AND D.matr_sta = '1' AND D.ci = '$this->coord') ORDER BY nuc_nom,inf_nom,coh_nom,mod_nom,reg_nom,esp_nom");
	return $res;
  }
//******************************************************************
  function Buscar_matricula($ci,$inf,$mod,$reg,$esp,$coh){
/*    echo "<script>alert('SELECT matr_sta FROM matric WHERE ci=$ci AND mod_id=$mod AND reg_id=$reg AND esp_id=$esp AND coh_id=$coh AND matr_sta=1 AND matr_tip=1');</script>";*/
    $row=0;
    $resp=$this->Operacion("SELECT matr_sta FROM matric WHERE ci='$ci' AND mod_id='$mod' AND reg_id='$reg' AND esp_id='$esp' AND coh_id='$coh' AND matr_sta='1' AND matr_tip='1'");
    $num_filas=$this->NumFilasCualquiera($resp);
    if($num_filas>0)
      $row=1;
/*    echo "<script>alert('filas $row');</script>";*/
    return $row;
  }
 //******************************************************************
  function Buscar_estudi_infrae_matricula($ci,$inf,$mod,$reg,$esp,$coh){
/*    echo "<script>alert('SELECT matr_sta FROM matric WHERE ci=$ci AND mod_id=$mod AND reg_id=$reg AND esp_id=$esp AND coh_id=$coh AND matr_sta=1 AND matr_tip=1');</script>";*/
    $row=0;
    $resp=$this->Operacion("SELECT eim_sta FROM estudi_infrae_matric WHERE ci='$ci' AND mod_id='$mod' AND reg_id='$reg' AND esp_id='$esp' AND coh_id='$coh' AND eim_sta='1' AND inf_id='$inf'");
    $num_filas=$this->NumFilasCualquiera($resp);
    if($num_filas>0)
      $row=1;
/*    echo "<script>alert('filas $row');</script>";*/
    return $row;
  }
//******************************************************************
  function Buscar_matricula1($inf,$mod,$reg,$esp,$coh){
    $ci=$_SESSION['ci'];
/*    echo "<script>alert('Buscar_matricula1($inf,$mod,$reg,$esp,$coh), $ci');</script>";*/
    $row=0;
    $resp=$this->Operacion("SELECT matr_sta FROM matric WHERE ci='$ci' AND mod_id='$mod' AND reg_id='$reg' AND esp_id='$esp' AND coh_id='$coh' AND matr_sta='1'");
    $num_filas=$this->NumFilasCualquiera($resp);
/*echo "<script>alert('Filas: $num_filas');</script>";*/
    if($num_filas>0)
      $row=1;
  /*  echo "<script>alert('filas1 $row');</script>";*/
    return $row;
  }
//****************************************************************************************************
  function Agregar_persona($ci){
    $agre=0;
    $num=0;
	$num_filas2=0;
	$resultado=$this->OperacionCualquiera("SELECT sta FROM persona WHERE ci='$ci'");
    $num_filas=$this->NumFilasCualquiera($resultado);
/*    echo "<script>alert('Filas Persona: $num_filas');</script>";*/
    if($num_filas<=0){
/*    echo "<script>alert('INSERT INTO persona (ci, com, etn, dep, inc, bec, no1, no2, no3, ap1, ap2, ap3, sex, ecv, gsa, frh, fmi, fot, tmo, nfa, tfa, sta, tip, did, cre, com_id, etn_id) VALUES ($ci, 0, 0, 0, 0, 0, $this->no1, $this->no2, $this->no3, $this->ap1, $this->ap2, $this->ap3, $this->sex, $this->ecv, $this->gsa, $this->frh, 0, ../Fotos/, $this->tmo, $this->nfa, $this->tfa, 1, 1, $this->did, $this->cre, 5, 0)');</script>";*/
	  $resul=$this->OperacionCualquiera("INSERT INTO persona (ci, com, etn, dep, inc, bec, no1, no2, no3, ap1, ap2, ap3, sex, ecv, gsa, frh, fmi, fot, tmo, nfa, tfa, sta, tip, did, cre, com_id, etn_id) VALUES ('$ci', '0', '0', '0', '0', '0', '$this->no1', '$this->no2', '$this->no3', '$this->ap1', '$this->ap2', '$this->ap3', '$this->sex', '$this->ecv', '$this->gsa', '$this->frh', '0', '../Fotos/', '$this->tmo', '$this->nfa', '$this->tfa', '1', '1', '$this->did', '$this->cre', '5', '0')");
      $num_filas2=$this->filas_afectadas($resul);
	  if($num_filas2>0){
	    $accion='INSERTAR';
		$Operacion="DOCENTE ID: ".$ci." NOMBRE: ".$this->no1." Y APELLIDO:".$this->ap1."";	
		$this->guardar_accion($accion,"persona",$Operacion);
	  }
	}
	else{
	  $array=$this->ConsultarCualquiera($resultado);
	  if($array->sta=='0'){
	    $resul=$this->OperacionCualquiera("UPDATE persona SET sta='1' WHERE ci='$ci'");
        $num_filas2=$this->filas_afectadas($resul);
		if($num_filas2>0){
	      $accion='MODIFICAR';
		  $Operacion="DOCENTE ID: ".$ci." NOMBRE: ".$this->no1." Y APELLIDO:".$this->ap1."";	
		  $this->guardar_accion($accion,"persona",$Operacion);
	    }
	  }
	  else
	    $num_filas2=1;
	}
    return $num_filas2;
  }
//****************************************************************************************************
  function Agregar_estudi_infrae($ci,$inf){
    $agre=0;
    $num=0;
	$num_filas2=0;
	$resultado=$this->OperacionCualquiera("SELECT * FROM estudi_infrae WHERE ci='$ci' AND inf_id='$inf' AND est_inf_ffi='0000-00-00 00:00:00'");
    $num_filas=$this->NumFilasCualquiera($resultado);
/*    echo "<script>alert('Filas Agregar_estudi_infrae: $num_filas');</script>";*/
    if($num_filas<=0){
	  $dias=time();
	  $hoy=date("Y-m-d H:i:s",$dias);
/*    echo "<script>alert('INSERT INTO estudi_infrae (ci, inf_id, est_inf_fin, est_inf_ffi) VALUES ($ci, $inf, $hoy, 0000-00-00 00:00:00)');</script>";	  */
	  $res=$this->OperacionCualquiera("INSERT INTO estudi_infrae (ci, inf_id, est_inf_fin, est_inf_ffi) VALUES ('$ci', '$inf', '$hoy', '0000-00-00 00:00:00')");
      $num_filas2=$this->filas_afectadas($res);
	  if($num_filas2>0){
	    $accion='INSERTAR';
		$Operacion="DOCENTE ID: ".$ci." INFRAE ID: ".$inf."";
		$this->guardar_accion($accion,"estudi_infrae",$Operacion);
	  }
	}
	else
	  $num_filas2=1;
    return $num_filas2;
  }
//****************************************************************************************************
  function Agregar_usuari($ci,$correo){
    $agre=0;
    $num=0;
	$passwo=md5($ci);
	$num_filas2=0;
	$resultado=$this->OperacionCualquiera("SELECT * FROM usuari WHERE ci='$ci'");
    $num_filas=$this->NumFilasCualquiera($resultado);
/*    echo "<script>alert('Filas Agregar_usuari: $num_filas');</script>";*/
    if($num_filas<=0){
	  $dias=time();
	  $hoy=date("Y-m-d H:i:s",$dias);
	  $res=$this->OperacionCualquiera("INSERT INTO usuari (ci, usu_cor, usu_pas, usu_sta) VALUES ('$ci', '$correo', '$passwo', '1')");
      $num_filas2=$this->filas_afectadas($res);
	  if($num_filas2>0){
	    $accion='INSERTAR';
		$Operacion="DOCENTE ID: ".$ci."";	
		$this->guardar_accion($accion,"usuari",$Operacion);
	  }
	}
	else{
	  $array=$this->ConsultarCualquiera($resultado);
	  if($array->usu_sta==0){
	    $res=$this->OperacionCualquiera("UPDATE usuari SET usu_sta='1', usu_pas='$passwo' WHERE ci='$ci'");
        $num_filas2=$this->filas_afectadas($res);
	    if($num_filas2>0){
	      $accion='MODIFICAR';
		  $Operacion="DOCENTE ID: ".$ci."";	
		  $this->guardar_accion($accion,"usuari",$Operacion);
	    }
	  }
	  else
	    $num_filas2=1;
	}
    return $num_filas2;
  }
//****************************************************************************************************
  function Agregar_perfil_usuari($ci){
    $agre=0;
    $num=0;
	$num_filas2=0;
	$resultado=$this->OperacionCualquiera("SELECT peu_sta FROM perfil_usuari WHERE ci_usu='$ci' AND per_id='3'");
    $num_filas=$this->NumFilasCualquiera($resultado);
/*    echo "<script>alert('Filas Agregar_perfil_usuari: $num_filas');</script>";*/
    if($num_filas<=0){
	  $resul=$this->OperacionCualquiera("INSERT INTO perfil_usuari (ci_usu, per_id, peu_sta) VALUES ('$ci', '3', '1')");
      $num_filas2=$this->filas_afectadas($resul);
	  if($num_filas2>0){
	    $accion='INSERTAR';
		$Operacion="DOCENTE ID: ".$ci." PERFIL ID: 3";	
		$this->guardar_accion($accion,"perfil_usuari",$Operacion);
	  }
	}
	else{
	  $array=$this->ConsultarCualquiera($resultado);
	  if($array->peu_sta=='0'){
	    $resul=$this->OperacionCualquiera("UPDATE perfil_usuari SET peu_sta='1' WHERE ci_usu='$ci' AND per_id='3'");
        $num_filas2=$this->filas_afectadas($resul);
	    if($num_filas2>0){
	      $accion='MODIFICAR';
		  $Operacion="DOCENTE ID: ".$ci." PERFIL ID: 3";	
		  $this->guardar_accion($accion,"perfil_usuari",$Operacion);
	    }
	  }
	  else
	    $num_filas2=1;
	}
    return $num_filas2;
  }
//****************************************************************************************************
  function Agregar_matricula($ci,$inf,$mod,$reg,$esp,$coh){
    $agre=0;
    $num=0;
/*    echo "<script>alert('SELECT A.pen_top FROM pensum A, reg_esp_mod_infrae B WHERE A.mod_id=$mod AND A.reg_id=$reg AND A.esp_id=$esp AND A.coh_id=$coh AND B.inf_id=$inf AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND B.remi_sta=1');</script>";*/
	$res=$this->OperacionCualquiera("SELECT A.pen_top FROM pensum A, reg_esp_mod_infrae B WHERE A.mod_id='$mod' AND A.reg_id='$reg' AND A.esp_id='$esp' AND A.coh_id='$coh' AND B.inf_id='$inf' AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND B.remi_sta='1'");
    $num_filas=$this->NumFilasCualquiera($res);
/*    echo "<script>alert('Filas Agregar_matricula: $num_filas');</script>";*/
    if($num_filas>0){
	  while($array=$this->ConsultarCualquiera($res)){
	    $resul=$this->OperacionCualquiera("SELECT matr_sta FROM matric WHERE ci='$ci' AND mod_id='$mod' AND reg_id='$reg' AND esp_id='$esp' AND coh_id='$coh' AND pen_top='$array->pen_top'");
        $num_filas1=$this->NumFilasCualquiera($resul);
/*    echo "<script>alert('Filas matric: $num_filas1');</script>";*/
		if($num_filas1<=0){
	      $resultado=$this->OperacionCualquiera("INSERT INTO matric (ci, esp_id, reg_id, mod_id, coh_id, pen_top, matr_obs, matr_tip, matr_sta) VALUES ('$ci', '$esp', '$reg', '$mod', '$coh', '$array->pen_top', 'DOCENTE', '1', '1')");
          $num_filas2=$this->filas_afectadas($resultado);
	      if($num_filas2>0){
	        $accion='INSERTAR';
		    $Operacion="DOCENTE ID: ".$ci." ESP_ID: ".$esp." REG_ID: ".$reg." MOD_ID: ".$mod." COH_ID: ".$coh." PEN_TOP: ".$array->pen_top."";
		    $this->guardar_accion($accion,"matric",$Operacion);
	      }
		}
		else{
		  $array2=$this->ConsultarCualquiera($resul);
/*    echo "<script>alert('Estado matric: $array2->matr_sta');</script>";*/
		  if($array2->matr_sta=='0'){
		    $resulta=$this->OperacionCualquiera("UPDATE matric SET matr_sta='1' WHERE ci='$ci' AND esp_id='$esp' AND reg_id='$reg' AND mod_id='$mod' AND coh_id='$coh' AND pen_top='$array->pen_top'");
            $num_filas2=$this->filas_afectadas($resulta);
			if($num_filas2>0){
	          $accion='MODIFICAR';
		      $Operacion="DOCENTE ID: ".$ci." ESP_ID: ".$esp." REG_ID: ".$reg." MOD_ID: ".$mod." COH_ID: ".$coh." PEN_TOP: ".$array->pen_top."";
		      $this->guardar_accion($accion,"matric",$Operacion);
	        }
		  }
		  else{
		    $num_filas2='1';
		  }
		}
		if($num_filas2>0)
		  $agre++;
	  }
	}
	if($num_filas==$agre)
      $num=1;
    return $num;
  }

//******************************************************************
  function Eliminar_matricula($ci,$inf,$mod,$reg,$esp,$coh){
/*    echo "<script>alert('UPDATE tab_ope set tab_ope_sta=0, tab_ope_ffi=$Fecha WHERE ope_id=$ope AND tab_id=$tab AND per_id=$per');</script>";*/
    $eli=0;
    $num=0;
	$res=$this->OperacionCualquiera("SELECT A.pen_top FROM pensum A, reg_esp_mod_infrae B WHERE A.mod_id='$mod' AND A.reg_id='$reg' AND A.esp_id='$esp' AND A.coh_id='$coh' AND B.inf_id='$inf' AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND B.remi_sta='1'");
    $num_filas=$this->NumFilasCualquiera($res);
/*    echo "<script>alert('Filas Eliminar_matricula: $num_filas');</script>";*/
    if($num_filas>0){
	  while($array=$this->ConsultarCualquiera($res)){
	    $resultado=$this->Operacion("UPDATE matric SET matr_sta='0' WHERE ci='$ci' AND esp_id='$esp' AND reg_id='$reg' AND mod_id='$mod' AND coh_id='$coh' AND pen_top='$array->pen_top' AND matr_tip='1'");
        $num_filas2=$this->filas_afectadas($resultado);
		if($num_filas2>0)
		  $eli++;
		if($num_filas2>0){
	      $accion='ELIMINAR';
		  $Operacion="DOCENTE ID: ".$ci." ESP_ID: ".$esp." REG_ID: ".$reg." MOD_ID: ".$mod." COH_ID: ".$coh." PEN_TOP: ".$array->pen_top."";
		  $this->guardar_accion($accion,"matric",$Operacion);
	    }
	  }
	}
	if($num_filas==$eli)
      $num=1;
    return $num;
  }
//****************************************************************************************************
  function Agregar_estudi_infrae_matric($ci,$inf,$mod,$reg,$esp,$coh){
    $agre=0;
    $num=0;
/*    echo "<script>alert('SELECT A.pen_top AS pen_top, B.est_inf_fin AS est_inf_fin FROM matric A, estudi_infrae B WHERE A.ci=$ci AND A.mod_id=$mod AND A.reg_id=$reg AND A.esp_id=$esp AND A.coh_id=$coh AND A.matr_sta=1 AND B.ci=A.ci AND B.est_inf_ffi=0000-00-00 00:00:00');</script>";*/
	$res=$this->OperacionCualquiera("SELECT DISTINCT(A.pen_top) AS 'pen_top', B.est_inf_fin AS 'est_inf_fin' FROM matric A, estudi_infrae B, reg_esp_mod_infrae C WHERE A.ci='$ci' AND A.mod_id='$mod' AND A.reg_id='$reg' AND A.esp_id='$esp' AND A.coh_id='$coh' AND A.mod_id=C.mod_id AND A.reg_id=C.reg_id AND A.esp_id=C.esp_id AND A.matr_sta='1' AND B.ci=A.ci AND B.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_id='$inf' AND B.inf_id=C.inf_id");
    $num_filas=$this->NumFilasCualquiera($res);
/*    echo "<script>alert('Filas Agregar_estudi_infrae_matric: $num_filas');</script>";*/
    if($num_filas>0){
	  while($array=$this->ConsultarCualquiera($res)){
	    $resul=$this->OperacionCualquiera("SELECT eim_sta FROM estudi_infrae_matric WHERE ci='$ci' AND mod_id='$mod' AND reg_id='$reg' AND esp_id='$esp' AND coh_id='$coh' AND pen_top='$array->pen_top' AND inf_id='$inf' AND est_inf_fin='$array->est_inf_fin'");
        $num_filas1=$this->NumFilasCualquiera($resul);
		if($num_filas1<=0){
	      $resultado=$this->OperacionCualquiera("INSERT INTO estudi_infrae_matric (ci, esp_id, reg_id, mod_id, coh_id, pen_top, est_inf_fin, inf_id, eim_tip, eim_sta) VALUES ('$ci', '$esp', '$reg', '$mod', '$coh', '$array->pen_top', '$array->est_inf_fin', '$inf', '1', '1')");
          $num_filas2=$this->filas_afectadas($resultado);
	      if($num_filas2>0){
	        $accion='INSERTAR';
		    $Operacion="DOCENTE ID: ".$ci." ESP_ID: ".$esp." REG_ID: ".$reg." MOD_ID: ".$mod." COH_ID: ".$coh." PEN_TOP: ".$array->pen_top." INF_ID: ".$inf." EST_INF_FIN: ".$array->est_inf_fin;
		    $this->guardar_accion($accion,"estudi_infrae_matric",$Operacion);
	      }
		}
		else{
		  $array2=$this->ConsultarCualquiera($resul);
		  if($array2->matr_sta=='0'){
		    $resulta=$this->OperacionCualquiera("UPDATE estudi_infrae_matric SET eim_sta='1' WHERE ci='$ci' AND esp_id='$esp' AND reg_id='$reg' AND mod_id='$mod' AND coh_id='$coh' AND pen_top='$array->pen_top' AND eim_tip='1' AND est_inf_fin='$array->est_inf_fin'");
            $num_filas2=$this->filas_afectadas($resulta);
			if($num_filas2>0){
	          $accion='MODIFICAR';
		      $Operacion="DOCENTE ID: ".$ci." ESP_ID: ".$esp." REG_ID: ".$reg." MOD_ID: ".$mod." COH_ID: ".$coh." PEN_TOP: ".$array->pen_top." INF_ID: ".$inf." EST_INF_FIN: ".$array->est_inf_fin;
		      $this->guardar_accion($accion,"estudi_infrae_matric",$Operacion);
	        }
		  }
		  else{
		    $num_filas2='1';
		  }
		}
		if($num_filas2>0)
		  $agre++;
	  }
	}
	if($num_filas==$agre)
      $num=1;
    return $num;
  }
//****************************************************************************************************
  function Eliminar_estudi_infrae_matric($ci,$inf,$mod,$reg,$esp,$coh){
    $eli=0;
    $num=0;
	$res=$this->OperacionCualquiera("SELECT DISTINCT(A.pen_top) AS 'pen_top', B.est_inf_fin AS 'est_inf_fin' FROM matric A, estudi_infrae B, reg_esp_mod_infrae C WHERE A.ci='$ci' AND A.mod_id='$mod' AND A.reg_id='$reg' AND A.esp_id='$esp' AND A.coh_id='$coh' AND A.mod_id=C.mod_id AND A.reg_id=C.reg_id AND A.esp_id=C.esp_id AND A.matr_sta='1' AND B.ci=A.ci AND B.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_id='$inf' AND B.inf_id=C.inf_id");
    $num_filas=$this->NumFilasCualquiera($res);
/*    echo "<script>alert('Filas Eliminar_estudi_infrae_matric: $num_filas');</script>";*/
    if($num_filas>0){
	  while($array=$this->ConsultarCualquiera($res)){
	    $resultado=$this->Operacion("UPDATE estudi_infrae_matric SET eim_sta='0' WHERE ci='$ci' AND esp_id='$esp' AND reg_id='$reg' AND mod_id='$mod' AND coh_id='$coh' AND pen_top='$array->pen_top' AND eim_tip='1' AND est_inf_fin='$array->est_inf_fin'");
        $num_filas2=$this->filas_afectadas($resultado);
		if($num_filas2>0)
		  $eli++;
		if($num_filas2>0){
	      $accion='ELIMINAR';
		  $Operacion="DOCENTE ID: ".$ci." ESP_ID: ".$esp." REG_ID: ".$reg." MOD_ID: ".$mod." COH_ID: ".$coh." PEN_TOP: ".$array->pen_top." INF_ID: ".$inf." EST_INF_FIN: ".$array->est_inf_fin;
		  $this->guardar_accion($accion,"estudi_infrae_matric",$Operacion);
	    }
	  }
	}
	if($num_filas==$eli)
      $num=1;
    return $num;
  }
//******************************************************************
}?>