<?php session_start();
class porcentaje extends conec_BD
{
 var $pen_top='';
 var $sec_id='';
 var $asi_cod='';
 var $esp_id='';
 var $reg_id='';
 var $mod_id='';
 var $coh_id='';
 var $pac_id='';
 var $aul_id='';
 var $blh_id='';
 var $dia_id='';
 var $dbh_tip='';
 var $hor_com='';
 var $ci='';
 var $inf_id='';
 var $sta='';
//******************************************************************
  function porcentaje($pen_top,$sec_id,$asi_cod,$esp_id,$reg_id,$mod_id,$coh_id,$pac_id,$aul_id,$blh_id,$dia_id,$hor_com,$inf_id,$sta){
    $this->pen_top=$pen_top;
    $this->sec_id=$sec_id;
    $this->asi_cod=$asi_cod;
    $this->esp_id=$esp_id;
    $this->reg_id=$reg_id;
    $this->mod_id=$mod_id;
    $this->coh_id=$coh_id;
    $this->pac_id=$pac_id;
    $this->aul_id=$aul_id;
    $this->blh_id=$blh_id;
    $this->dia_id=$dia_id;
    $this->dbh_tip='0';
    $this->hor_com=$hor_com;
    $this->ci=$_SESSION['ci'];
	$this->inf_id=$inf_id;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_horario_Nucleo_Infrae($nuc_id,$inf_id){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_nom AS 'asi_nom', A.asi_cba AS 'asi_cba', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_id AS 'nuc_id', C.nuc_nom AS 'nuc_nom' FROM asigna A, infrae B, nucleo C, seccio D, asigna_seccio E WHERE C.nuc_id='$nuc_id' AND B.inf_id='$inf_id' AND A.asi_cod=E.asi_cod AND E.sec_id=D.sec_id AND B.inf_id=D.inf_id AND B.nuc_id=C.nuc_id AND E.pac_id='$this->pac_id' AND E.ase_sta='1' AND B.inf_id IN (SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE ci = '$this->ci' AND eim_sta='1' AND eim_tip IN ('1','2')) AND A.asi_cod IN (SELECT DISTINCT(A.asi_cod) FROM asigna_seccio A, estudi_infrae_matric B WHERE A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.eim_tip IN('1','2') AND B.eim_sta='1' AND A.ci_emp='$this->ci' AND A.pac_id='$this->pac_id' AND A.ci_emp=B.ci) AND A.esp_id IN (SELECT esp_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.coh_id IN (SELECT coh_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.reg_id IN (SELECT reg_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.mod_id IN (SELECT mod_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci')");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_horario_Nucleo_Infrae($nuc_id,$inf_id,$inicial,$cantidad){
    $resultado=$this->Operacion("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_nom AS 'asi_nom', A.asi_cba AS 'asi_cba', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_id AS 'nuc_id', C.nuc_nom AS 'nuc_nom' FROM asigna A, infrae B, nucleo C, seccio D, asigna_seccio E WHERE C.nuc_id='$nuc_id' AND B.inf_id='$inf_id' AND A.asi_cod=E.asi_cod AND E.sec_id=D.sec_id AND B.inf_id=D.inf_id AND B.nuc_id=C.nuc_id AND E.pac_id='$this->pac_id' AND E.ase_sta='1' AND B.inf_id IN (SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE ci = '$this->ci' AND eim_sta='1' AND eim_tip IN ('1','2')) AND A.asi_cod IN (SELECT DISTINCT(A.asi_cod) FROM asigna_seccio A, estudi_infrae_matric B WHERE A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.eim_tip IN('1','2') AND B.eim_sta='1' AND A.ci_emp='$this->ci' AND A.pac_id='$this->pac_id' AND A.ci_emp=B.ci) AND A.esp_id IN (SELECT esp_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.coh_id IN (SELECT coh_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.reg_id IN (SELECT reg_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.mod_id IN (SELECT mod_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') ORDER BY nuc_nom,inf_nom,asi_nom,asi_cod LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Infrae($nuc_id){
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE ci = '$this->ci' AND eim_sta='1' AND eim_tip IN ('1','2')) order by A.inf_nom");
	return $resultado;
  }
//******************************************************************
  function Listado_Infrae_Nucleo($inf_id){
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom', A.nuc_id AS 'nuc_id', B.nuc_nom AS 'nuc_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND A.inf_id='$inf_id'");
	return $resultado;
  }
//******************************************************************
  function Contar_horario_Nucleo_Todas($nuc_id){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_nom AS 'asi_nom', A.asi_cba AS 'asi_cba', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_id AS 'nuc_id', C.nuc_nom AS 'nuc_nom' FROM asigna A, infrae B, nucleo C, seccio D, asigna_seccio E WHERE C.nuc_id='$nuc_id' AND  A.asi_cod=E.asi_cod AND E.sec_id=D.sec_id AND B.inf_id=D.inf_id AND B.nuc_id=C.nuc_id AND E.pac_id='$this->pac_id' AND E.ase_sta='1' AND B.inf_id IN (SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE ci = '$this->ci' AND eim_sta='1' AND eim_tip IN ('1','2')) AND A.asi_cod IN (SELECT DISTINCT(A.asi_cod) FROM asigna_seccio A, estudi_infrae_matric B WHERE A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.eim_tip IN('1','2') AND B.eim_sta='1' AND A.ci_emp='$this->ci' AND A.pac_id='$this->pac_id' AND A.ci_emp=B.ci) AND A.esp_id IN (SELECT esp_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.coh_id IN (SELECT coh_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.reg_id IN (SELECT reg_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.mod_id IN (SELECT mod_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci')");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_horario_Nucleo_Todas($nuc_id,$inicial,$cantidad){
    $resultado=$this->Operacion("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_nom AS 'asi_nom', A.asi_cba AS 'asi_cba', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_id AS 'nuc_id', C.nuc_nom AS 'nuc_nom' FROM asigna A, infrae B, nucleo C, seccio D, asigna_seccio E WHERE C.nuc_id='$nuc_id' AND A.asi_cod=E.asi_cod AND E.sec_id=D.sec_id AND B.inf_id=D.inf_id AND B.nuc_id=C.nuc_id AND E.pac_id='$this->pac_id' AND E.ase_sta='1' AND B.inf_id IN (SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE ci = '$this->ci' AND eim_sta='1' AND eim_tip IN ('1','2')) AND A.asi_cod IN (SELECT DISTINCT(A.asi_cod) FROM asigna_seccio A, estudi_infrae_matric B WHERE A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.eim_tip IN('1','2') AND B.eim_sta='1' AND A.ci_emp='$this->ci' AND A.pac_id='$this->pac_id' AND A.ci_emp=B.ci) AND A.esp_id IN (SELECT esp_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.coh_id IN (SELECT coh_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.reg_id IN (SELECT reg_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.mod_id IN (SELECT mod_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') ORDER BY nuc_nom,inf_nom,asi_nom,asi_cod LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Infraestructura_Nucleo($nuc_id){
    $id=$nom="";
    $cuantos=0;
	$this->ci=$_SESSION['ci'];
    $resp=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE ci = '$this->ci' AND eim_sta='1' AND eim_tip IN ('1','2')) order by A.inf_nom DESC");
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
    $resultado=$this->Operacion("SELECT DISTINCT (A.nuc_id) AS 'nuc_id', A.nuc_nom AS 'nuc_nom' FROM nucleo A, infrae B WHERE A.nuc_sta = '1' AND A.nuc_id = B.nuc_id AND B.inf_id IN (SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE ci = '$this->ci' AND eim_sta='1' AND eim_tip IN ('1','2')) order by A.nuc_nom");
    return $resultado;
  }
//******************************************************************
  function Contar_horario_Todas(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_nom AS 'asi_nom', A.asi_cba AS 'asi_cba', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_id AS 'nuc_id', C.nuc_nom AS 'nuc_nom' FROM asigna A, infrae B, nucleo C, seccio D, asigna_seccio E WHERE A.asi_cod=E.asi_cod AND E.sec_id=D.sec_id AND B.inf_id=D.inf_id AND B.nuc_id=C.nuc_id AND E.pac_id='$this->pac_id' AND E.ase_sta='1' AND B.inf_id IN (SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE ci = '$this->ci' AND eim_sta='1' AND eim_tip IN ('1','2')) AND A.asi_cod IN (SELECT DISTINCT(A.asi_cod) FROM asigna_seccio A, estudi_infrae_matric B WHERE A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.eim_tip IN('1','2') AND B.eim_sta='1' AND A.ci_emp='$this->ci' AND A.pac_id='$this->pac_id' AND A.ci_emp=B.ci) AND A.esp_id IN (SELECT esp_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.coh_id IN (SELECT coh_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.reg_id IN (SELECT reg_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.mod_id IN (SELECT mod_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci')");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_horario_Todas($inicial,$cantidad){
/*  echo "<script>alert('SELECT DISTINCT(A.asi_cod) AS asi_cod, A.asi_nom AS asi_nom, A.asi_cba AS asi_cba, B.inf_id AS inf_id, B.inf_nom AS inf_nom, C.nuc_id AS nuc_id, C.nuc_nom AS nuc_nom FROM asigna A, infrae B, nucleo C, seccio D, asigna_seccio E WHERE A.asi_cod=E.asi_cod AND E.sec_id=D.sec_id AND B.inf_id=D.inf_id AND B.nuc_id=C.nuc_id AND E.pac_id=$this->pac_id AND E.ase_sta=1 AND B.inf_id IN (SELECT DISTINCT(A.inf_id) FROM estudi_infrae A, reg_esp_mod_infrae B, reg_esp_mod C, matric D WHERE A.inf_id = B.inf_id AND A.est_inf_ffi = 0000-00-00 00:00:00 AND B.mod_id = C.mod_id AND B.esp_id = C.esp_id AND B.reg_id = C.reg_id AND B.remi_sta = 1 AND C.rem_sta = 1 AND D.mod_id = C.mod_id AND D.esp_id = C.esp_id AND D.reg_id = C.reg_id AND D.matr_tip = 1 AND D.matr_sta = 1 AND D.ci = $this->ci) AND A.asi_cod IN (SELECT DISTINCT(A.asi_cod) FROM asigna_seccio A, matric B WHERE A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.matr_tip=1 AND B.matr_sta=1 AND B.ci=$this->ci AND A.pac_id=$this->pac_id) ORDER BY nuc_nom,inf_nom,asi_nom,asi_cod LIMIT $cantidad OFFSET $inicial');</script>";*/
    $resultado=$this->Operacion("SELECT DISTINCT(A.asi_cod) AS 'asi_cod', A.asi_nom AS 'asi_nom', A.asi_cba AS 'asi_cba', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_id AS 'nuc_id', C.nuc_nom AS 'nuc_nom' FROM asigna A, infrae B, nucleo C, seccio D, asigna_seccio E WHERE A.asi_cod=E.asi_cod AND E.sec_id=D.sec_id AND B.inf_id=D.inf_id AND B.nuc_id=C.nuc_id AND E.pac_id='$this->pac_id' AND E.ase_sta='1' AND B.inf_id IN (SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE ci = '$this->ci' AND eim_sta='1' AND eim_tip IN ('1','2')) AND A.asi_cod IN (SELECT DISTINCT(A.asi_cod) FROM asigna_seccio A, estudi_infrae_matric B WHERE A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.eim_tip IN('1','2') AND B.eim_sta='1' AND A.ci_emp='$this->ci' AND A.pac_id='$this->pac_id' AND A.ci_emp=B.ci) AND A.esp_id IN (SELECT esp_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.coh_id IN (SELECT coh_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.reg_id IN (SELECT reg_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') AND A.mod_id IN (SELECT mod_id FROM estudi_infrae_matric WHERE eim_tip IN('1','2') AND eim_sta='1' AND ci='$this->ci') ORDER BY nuc_nom,inf_nom,asi_nom,asi_cod LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($pen_top,$sec_id,$asi_cod,$esp_id,$reg_id,$mod_id,$coh_id,$pac_id,$aul_id,$blh_id,$dia_id,$hor_com,$inf_id,$sta){
    $this->pen_top=$pen_top;
    $this->sec_id=$sec_id;
    $this->asi_cod=$asi_cod;
    $this->esp_id=$esp_id;
    $this->reg_id=$reg_id;
    $this->mod_id=$mod_id;
    $this->coh_id=$coh_id;
    $this->pac_id=$pac_id;
    $this->aul_id=$aul_id;
    $this->blh_id=$blh_id;
    $this->dia_id=$dia_id;
    $this->dbh_tip='0';
    $this->hor_com=$hor_com;
    $this->ci=$_SESSION['ci'];
	$this->inf_id=$inf_id;
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_Periodo(){
    $this->ci_est=$_SESSION[ci];
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
  function Buscar_horario($inf_id,$dbh_tip){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT DISTINCT(A.inf_id) AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.dbh_tip AS 'dbh_tip' FROM dia_blh A, infrae B, nucleo C, dias D, blo_hor E WHERE A.dbh_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.blh_id=E.blh_id AND A.dia_id=D.dia_id AND A.dbh_tip='$dbh_tip' AND A.inf_id='$inf_id'");
	return $res;
  }
//******************************************************************
  function Buscar_materia_pensum_horario_con_horario_todas($inf_id,$asi_cod,$asi_nom){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT DISTINCT(F.esp_nom) AS 'esp_nom', F.esp_id AS 'esp_id', G.reg_nom AS 'reg_nom', G.reg_id AS 'reg_id', H.mod_nom AS 'mod_nom', H.mod_id AS 'mod_id', I.coh_nom AS 'coh_nom', I.coh_id AS 'coh_id', B.sec_nom AS 'sec_nom', B.sec_id AS 'sec_id' FROM horario A, seccio B, asigna C, dias D, blo_hor E, especi F, regimen G, modali H, cohort I WHERE A.pac_id='$this->pac_id' AND A.hor_sta='1' AND A.sec_id=B.sec_id AND A.asi_cod=C.asi_cod AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND A.asi_cod='$asi_cod' AND C.asi_nom='$asi_nom' AND B.inf_id='$inf_id' AND A.dia_id=D.dia_id AND A.blh_id=E.blh_id AND A.esp_id=F.esp_id AND A.reg_id=G.reg_id AND A.mod_id=H.mod_id AND A.coh_id=I.coh_id AND B.sec_sta='1' AND C.asi_sta='1' AND D.dia_sta='1' AND E.blh_sta='1' AND F.esp_sta='1' AND G.reg_sta='1' AND H.mod_sta='1' AND I.coh_sta='1'");
	return $res;
  }
//******************************************************************
  function Buscar_materia_pensum_todas($inf_id,$asi_cod,$asi_nom){
/*      echo "<script>alert('SELECT DISTINCT(F.esp_nom) AS esp_nom, F.esp_id AS esp_id, G.reg_nom AS reg_nom, G.reg_id AS reg_id, H.mod_nom AS mod_nom, H.mod_id AS mod_id, I.coh_nom AS coh_nom, I.coh_id AS coh_id, B.sec_nom AS sec_nom, B.sec_id AS sec_id FROM asigna_seccio A, seccio B, asigna C, dias D, blo_hor E, especi F, regimen G, modali H, cohort I WHERE A.pac_id=$this->pac_id AND A.ase_sta=1 AND A.sec_id=B.sec_id AND A.asi_cod=C.asi_cod AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND A.asi_cod=$asi_cod AND C.asi_nom=$asi_nom AND B.inf_id=$inf_id AND A.esp_id=F.esp_id AND A.reg_id=G.reg_id AND A.mod_id=H.mod_id AND A.coh_id=I.coh_id AND B.sec_sta=1 AND C.asi_sta=1 AND F.esp_sta=1 AND G.reg_sta=1 AND H.mod_sta=1 AND I.coh_sta=1');</script>";*/
    $res=$this->Operacion("SELECT DISTINCT(F.esp_nom) AS 'esp_nom', F.esp_id AS 'esp_id', G.reg_nom AS 'reg_nom', G.reg_id AS 'reg_id', H.mod_nom AS 'mod_nom', H.mod_id AS 'mod_id', I.coh_nom AS 'coh_nom', I.coh_id AS 'coh_id', B.sec_nom AS 'sec_nom', B.sec_id AS 'sec_id' FROM asigna_seccio A, seccio B, asigna C, dias D, blo_hor E, especi F, regimen G, modali H, cohort I WHERE A.pac_id='$this->pac_id' AND A.ase_sta='1' AND A.sec_id=B.sec_id AND A.asi_cod=C.asi_cod AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND A.asi_cod='$asi_cod' AND C.asi_nom='$asi_nom' AND B.inf_id='$inf_id' AND A.esp_id=F.esp_id AND A.reg_id=G.reg_id AND A.mod_id=H.mod_id AND A.coh_id=I.coh_id AND B.sec_sta='1' AND C.asi_sta='1' AND F.esp_sta='1' AND G.reg_sta='1' AND H.mod_sta='1' AND I.coh_sta='1'");
	return $res;
  }
//******************************************************************
  function Buscar_materia_pensum_todas2($inf_id,$asi_cod,$asi_nom){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT DISTINCT(F.esp_id) AS 'esp_id', G.reg_id AS 'reg_id', H.mod_id AS 'mod_id', I.coh_id AS 'coh_id', B.sec_id AS 'sec_id', A.pen_top AS 'pen_top' FROM asigna_seccio A, seccio B, asigna C, dias D, blo_hor E, especi F, regimen G, modali H, cohort I WHERE A.pac_id='$this->pac_id' AND A.ase_sta='1' AND A.sec_id=B.sec_id AND A.asi_cod=C.asi_cod AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND A.asi_cod='$asi_cod' AND C.asi_nom='$asi_nom' AND B.inf_id='$inf_id' AND A.esp_id=F.esp_id AND A.reg_id=G.reg_id AND A.mod_id=H.mod_id AND A.coh_id=I.coh_id AND B.sec_sta='1' AND C.asi_sta='1' AND F.esp_sta='1' AND G.reg_sta='1' AND H.mod_sta='1' AND I.coh_sta='1'");
	return $res;
  }
//******************************************************************
  function Buscar_materia_pensum_horario($inf_id,$asi_cod,$asi_nom,$esp_id,$reg_id,$mod_id,$coh_id,$sec_id){
/*      echo "<script>alert('id: $id');</script>";*/
    $row=0;
    $res=$this->Operacion("SELECT DISTINCT(F.esp_nom) AS 'esp_nom', F.esp_id AS 'esp_id', G.reg_nom AS 'reg_nom', G.reg_id AS 'reg_id', H.mod_nom AS 'mod_nom', H.mod_id AS 'mod_id', I.coh_nom AS 'coh_nom', I.coh_id AS 'coh_id', B.sec_nom AS 'sec_nom', B.sec_id AS 'sec_id' FROM horario A, seccio B, asigna C, dias D, blo_hor E, especi F, regimen G, modali H, cohort I WHERE A.pac_id='$this->pac_id' AND A.hor_sta='1' AND A.sec_id=B.sec_id AND A.asi_cod=C.asi_cod AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND A.asi_cod='$asi_cod' AND C.asi_nom='$asi_nom' AND B.inf_id='$inf_id' AND A.dia_id=D.dia_id AND A.blh_id=E.blh_id AND A.esp_id=F.esp_id AND A.reg_id=G.reg_id AND A.mod_id=H.mod_id AND A.coh_id=I.coh_id AND B.sec_sta='1' AND C.asi_sta='1' AND D.dia_sta='1' AND E.blh_sta='1' AND F.esp_sta='1' AND G.reg_sta='1' AND H.mod_sta='1' AND I.coh_sta='1' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.mod_id='$mod_id' AND A.coh_id='$coh_id' AND A.sec_id='$sec_id'");
	$num_fila=$this->NumFilasCualquiera($res);
	if($num_fila>0)
	  $row=1;
	return $row;
  }
  
//******************************************************************
  function Buscar_materia_pensum_horario3($inf_id,$asi_cod,$asi_nom,$esp_id,$reg_id,$mod_id,$coh_id,$sec_id){
/*      echo "<script>alert('id: $id');</script>";*/
    $row=0;
    $res=$this->Operacion("SELECT DISTINCT(F.esp_nom) AS 'esp_nom', F.esp_id AS 'esp_id', G.reg_nom AS 'reg_nom', G.reg_id AS 'reg_id', H.mod_nom AS 'mod_nom', H.mod_id AS 'mod_id', I.coh_nom AS 'coh_nom', I.coh_id AS 'coh_id', B.sec_nom AS 'sec_nom', B.sec_id AS 'sec_id', A.hor_id AS hor_id FROM horario A, seccio B, asigna C, dias D, blo_hor E, especi F, regimen G, modali H, cohort I WHERE A.pac_id='$this->pac_id' AND A.hor_sta='1' AND A.sec_id=B.sec_id AND A.asi_cod=C.asi_cod AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND A.asi_cod='$asi_cod' AND C.asi_nom='$asi_nom' AND B.inf_id='$inf_id' AND A.dia_id=D.dia_id AND A.blh_id=E.blh_id AND A.esp_id=F.esp_id AND A.reg_id=G.reg_id AND A.mod_id=H.mod_id AND A.coh_id=I.coh_id AND B.sec_sta='1' AND C.asi_sta='1' AND D.dia_sta='1' AND E.blh_sta='1' AND F.esp_sta='1' AND G.reg_sta='1' AND H.mod_sta='1' AND I.coh_sta='1' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.mod_id='$mod_id' AND A.coh_id='$coh_id' AND A.sec_id='$sec_id'");
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
  function Buscar_aula_disponible($inf_id,$dia,$blh){
    $res=$this->Operacion("SELECT DISTINCT(A.aul_nom) AS 'aul_nom', A.aul_id AS 'aul_id' FROM aulas A WHERE A.aul_sta='1' AND A.inf_id='$inf_id' AND A.aul_id NOT IN(SELECT DISTINCT(B.aul_id) FROM horario B WHERE B.dia_id='$dia' AND B.blh_id='$blh' AND B.pac_id='$this->pac_id' AND B.dbh_tip='0' AND B.hor_sta='1')");
	return $res;
  }
//******************************************************************
  function Buscar_Docen($ci){
    $id=$no=$ap=$tm=$cor="";
    $resp=$this->OperacionCualquiera("SELECT A.ci AS ci, concat(A.ap1,' ',A.ap2) AS ap, concat(A.no1,' ', A.no2) AS no, A.tmo AS tm, B.usu_cor AS cor FROM persona A, usuari B WHERE A.ci=B.ci AND A.ci='$ci'");
	$cuantos=$this->NumFilasCualquiera($resp);
/*	echo "<script>alert('$cuantos');</script>";*/
    $array=$this->ConsultarCualquiera($resp);
	$cadena=$array->ap;
	$cadena1=$array->no;
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
	for ($i=0;$i<strlen($cadena1);$i++){
      if($cadena1[$i]=='Á')
        $cadena1[$i]='A';
	  else{
		if($cadena1[$i]=='É')
          $cadena1[$i]='E';
		else{
		  if($cadena1[$i]=='Í')
            $cadena1[$i]='I';
		  else{
			if($cadena1[$i]=='Ó')
              $cadena1[$i]='O';
			else{
			  if($cadena1[$i]=='Ú')
                $cadena1[$i]='U';
			  else{
				if($cadena1[$i]=='Ñ')
                  $cadena1[$i]='N';
			  }
			}
		  }
		}	
	  }
    }
	$id=$array->ci;
	$ap=$cadena;
	$no=$cadena1;
	$tm=$array->tm;
	$cor=$array->cor;
	$this->res=$id."!".$ap."!".$no."!".$tm."!".$cor."!".$cuantos;
  }
//******************************************************************
}?>