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
  function Listado_Infraestructura_Nucleo($nuc_id,$ci_doc){
    $id=$nom="";
    $cuantos=0;
	$this->ci=$_SESSION['ci'];
    $resp=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND ci = '$ci_doc') order by A.inf_nom DESC");
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
  function Buscar_Periodo(){
    $this->ci_est=$ci_est;
	$dias=time();
	$fecha=date("Y-m-d H:i:s",$dias);
/*	echo "<script>alert('Cedula $this->ci_est');</script>";*/
    $res=$this->OperacionCualquiera("SELECT pac_id, pac_nom FROM pacade WHERE pac_sta='1' AND DATEDIFF(pac_ffin,'$fecha')>=0 ORDER BY pac_fin DESC");
    return $res;
  }
//******************************************************************
  function Buscar_pacade1($pac_id){
/*      echo "<script>alert('id: $id');</script>";*/
    $res=$this->Operacion("SELECT pac_nom FROM pacade WHERE pac_id='$pac_id'");
	$array=$this->ConsultarCualquiera($res);
	return $array->pac_nom;
  }
//******************************************************************
  function Buscar_docente1($ci){
/*      echo "<script>alert('SELECT concat(A.ap1, ,A.ap2, ,A.no1, ,A.no2) AS nombre, B.usu_cor AS correo, A.tmo AS telf FROM persona A, usuari B WHERE A.ci=B.ci AND A.ci=$ci AND A.sta=1');</script>";*/
    $res=$this->Operacion("SELECT concat(A.ap1,' ',A.ap2,' ',A.no1,' ',A.no2) AS 'nombre', B.usu_cor AS 'correo', A.tmo AS 'telf' FROM persona A, usuari B WHERE A.ci=B.ci AND A.ci='$ci' AND A.sta='1'");
	$array=$this->ConsultarCualquiera($res);
	return $array;
  }
//******************************************************************
function Buscar_docente_matricula($ci){
/*echo "<script>alert('SELECT DISTINCT(D.coh_nom) AS coh_nom, B.reg_nom AS reg_nom, C.esp_nom AS esp_nom, A.mod_nom AS mod_nom, F.inf_nom AS inf_nom FROM estudi_infrae_matric E, modali A, regimen B, especi C, cohort D, infrae F WHERE E.ci=$ci AND (E.eim_tip=1 OR E.eim_tip=2) AND E.eim_sta=1 AND E.mod_id=A.mod_id AND E.reg_id=B.reg_id AND E.esp_id=C.esp_id AND E.coh_id=D.coh_id AND E.inf_id=F.inf_id ORDER BY F.inf_nom,A.mod_nom,B.reg_nom,C.esp_nom,D.coh_nom');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT DISTINCT(D.coh_nom) AS 'coh_nom', B.reg_nom AS 'reg_nom', C.esp_nom AS 'esp_nom', A.mod_nom AS 'mod_nom', F.inf_nom AS 'inf_nom' FROM estudi_infrae_matric E, modali A, regimen B, especi C, cohort D, infrae F WHERE E.ci='$ci' AND (E.eim_tip='1' OR E.eim_tip='2') AND E.eim_sta='1' AND E.mod_id=A.mod_id AND E.reg_id=B.reg_id AND E.esp_id=C.esp_id AND E.coh_id=D.coh_id AND E.inf_id=F.inf_id ORDER BY F.inf_nom,A.mod_nom,B.reg_nom,C.esp_nom,D.coh_nom");
	return $resp;
}
//******************************************************************
  function Contar_horario_Todas($ci_doc){
    $num_filas='';
/*	echo "<script>alert('SELECT hor_id FROM horario as A RIGHT JOIN (SELECT F.pac_id AS pac_id, F.coh_id AS coh_id, F.mod_id AS mod_id, F.reg_id AS reg_id, F.esp_id AS esp_id, F.pen_top AS pen_top, F.asi_cod AS asi_cod, F.sec_id AS sec_id, E.inf_id AS inf_id FROM seccio E, asigna_seccio F WHERE F.pac_id=$this->pac_id AND E.sec_sta=1 AND E.sec_id=F.sec_id AND F.ase_sta=1) as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta=1 AND A.pac_id=$this->pac_id AND A.ci=$ci_doc GROUP BY hor_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id');</script>";*/
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT hor_id FROM horario as A RIGHT JOIN (SELECT F.pac_id AS 'pac_id', F.coh_id AS 'coh_id', F.mod_id AS 'mod_id', F.reg_id AS 'reg_id', F.esp_id AS 'esp_id', F.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id' FROM seccio E, asigna_seccio F WHERE F.pac_id='$this->pac_id' AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND (ci_emp='$ci_doc' OR ci_doc_pol='$ci_doc')) as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' GROUP BY hor_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id");
    $num_filas=$this->NumFilas();	/*echo "<script>alert('FILAS: $num_filas');</script>";*/
    return $num_filas;
  }
//******************************************************************
  function Listado_horario_Todas($inicial,$cantidad,$ci_doc){
/*  echo "<script>alert('SELECT hor_id FROM horario as A RIGHT JOIN (SELECT F.pac_id AS pac_id, F.coh_id AS coh_id, F.mod_id AS mod_id, F.reg_id AS reg_id, F.esp_id AS esp_id, F.pen_top AS pen_top, F.asi_cod AS asi_cod, F.sec_id AS sec_id, E.inf_id AS inf_id FROM seccio E, asigna_seccio F WHERE F.pac_id=$this->pac_id AND E.sec_sta=1 AND E.sec_id=F.sec_id AND F.ase_sta=1) as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta=1 AND A.pac_id=$this->pac_id AND A.ci=$ci_doc GROUP BY hor_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id LIMIT $cantidad OFFSET $inicial');</script>";*/
    $resultado=$this->Operacion("SELECT hor_id FROM horario as A RIGHT JOIN (SELECT F.pac_id AS 'pac_id', F.coh_id AS 'coh_id', F.mod_id AS 'mod_id', F.reg_id AS 'reg_id', F.esp_id AS 'esp_id', F.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id' FROM seccio E, asigna_seccio F WHERE F.pac_id='$this->pac_id' AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND F.ase_tev='1') as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' GROUP BY hor_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Contar_horario_Nucleo_Todas($nuc_id,$ci_doc){
    $num_filas='';
/*  echo "<script>alert('SELECT hor_id FROM horario as A RIGHT JOIN (SELECT F.pac_id AS pac_id, F.coh_id AS coh_id, F.mod_id AS mod_id, F.reg_id AS reg_id, F.esp_id AS esp_id, F.pen_top AS pen_top, F.asi_cod AS asi_cod, F.sec_id AS sec_id, E.inf_id AS inf_id FROM nucleo C, infrae D, seccio E, asigna_seccio F WHERE F.pac_id=$this->pac_id AND E.sec_sta=1 AND E.sec_id=F.sec_id AND F.ase_sta=1 AND D.inf_id=E.inf_id AND D.inf_sta=1 AND C.nuc_id=D.nuc_id AND C.nuc_id=$nuc_id AND C.nuc_sta=1) as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta=1 AND A.pac_id=$this->pac_id AND A.ci=$ci_doc GROUP BY hor_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id LIMIT $cantidad OFFSET $inicial');</script>";*/
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT hor_id FROM horario as A RIGHT JOIN (SELECT F.pac_id AS 'pac_id', F.coh_id AS 'coh_id', F.mod_id AS 'mod_id', F.reg_id AS 'reg_id', F.esp_id AS 'esp_id', F.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id' FROM nucleo C, infrae D, seccio E, asigna_seccio F WHERE F.pac_id='$this->pac_id' AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND F.ase_tev='1' AND D.inf_id=E.inf_id AND D.inf_sta='1' AND C.nuc_id=D.nuc_id AND C.nuc_id='$nuc_id' AND C.nuc_sta='1') as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' GROUP BY hor_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_horario_Nucleo_Todas($nuc_id,$inicial,$cantidad){
    $resultado=$this->Operacion("SELECT hor_id FROM horario as A RIGHT JOIN (SELECT F.pac_id AS 'pac_id', F.coh_id AS 'coh_id', F.mod_id AS 'mod_id', F.reg_id AS 'reg_id', F.esp_id AS 'esp_id', F.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id' FROM nucleo C, infrae D, seccio E, asigna_seccio F WHERE F.pac_id='$this->pac_id' AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND F.ase_tev='1' AND D.inf_id=E.inf_id AND D.inf_sta='1' AND C.nuc_id=D.nuc_id AND C.nuc_id='$nuc_id' AND C.nuc_sta='1') as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' GROUP BY hor_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Contar_horario_Nucleo_Infrae($nuc_id,$inf_id,$ci_doc){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT hor_id FROM horario as A RIGHT JOIN (SELECT F.pac_id AS 'pac_id', F.coh_id AS 'coh_id', F.mod_id AS 'mod_id', F.reg_id AS 'reg_id', F.esp_id AS 'esp_id', F.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id' FROM nucleo C, infrae D, seccio E, asigna_seccio F WHERE F.pac_id='$this->pac_id' AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND F.ase_tev='1' AND D.inf_id=E.inf_id AND D.inf_id='$inf_id' AND D.inf_sta='1' AND C.nuc_id=D.nuc_id AND C.nuc_id='$nuc_id' AND C.nuc_sta='1') as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' GROUP BY hor_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_horario_Nucleo_Infrae($nuc_id,$inf_id,$inicial,$cantidad,$ci_doc){
    $resultado=$this->Operacion("SELECT hor_id FROM horario as A RIGHT JOIN (SELECT F.pac_id AS 'pac_id', F.coh_id AS 'coh_id', F.mod_id AS 'mod_id', F.reg_id AS 'reg_id', F.esp_id AS 'esp_id', F.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id' FROM nucleo C, infrae D, seccio E, asigna_seccio F WHERE F.pac_id='$this->pac_id' AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND F.ase_tev='1' AND D.inf_id=E.inf_id AND D.inf_id='$inf_id' AND D.inf_sta='1' AND C.nuc_id=D.nuc_id AND C.nuc_id='$nuc_id' AND C.nuc_sta='1') as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' GROUP BY hor_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Nucleo($ci_doc){
    $resultado=$this->Operacion("SELECT DISTINCT (A.nuc_id) AS 'nuc_id', A.nuc_nom AS 'nuc_nom' FROM nucleo A, infrae B WHERE A.nuc_sta = '1' AND A.nuc_id = B.nuc_id AND B.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND ci = '$ci_doc') order by A.nuc_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Infrae($nuc_id,$ci_doc){
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' AND A.inf_id IN(SELECT DISTINCT(inf_id) FROM estudi_infrae_matric WHERE eim_sta='1' AND ci = '$ci_doc') order by A.inf_nom DESC");
	return $resultado;
  }
//******************************************************************
  function Buscar_materia_pensum_todas_tip_horario($hor_id,$ci_doc){
    $res=$this->Operacion("SELECT A.hor_tpl AS 'hor_tpl', B.asi_cht AS 'can_t', B.asi_chp AS 'can_p',B.asi_chl AS 'can_l' FROM horario as A RIGHT JOIN (SELECT F.pac_id AS 'pac_id', F.coh_id AS coh_id, F.mod_id AS 'mod_id', F.reg_id AS 'reg_id', F.esp_id AS 'esp_id', F.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', C.asi_nom AS 'asi_nom', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id', E.sec_nom AS 'sec_nom', G.inf_nom AS 'inf_nom', H.nuc_nom AS 'nuc_nom', I.esp_nom AS 'esp_nom', J.reg_nom AS 'reg_nom', K.mod_nom AS 'mod_nom', L.coh_nom AS 'coh_nom', C.asi_cht AS 'asi_cht', C.asi_chp AS 'asi_chp', C.asi_chl AS 'asi_chl' FROM asigna C, seccio E, asigna_seccio F, infrae G, nucleo H, especi I, regimen J, modali K, cohort L WHERE C.asi_cod=F.asi_cod AND C.esp_id=F.esp_id AND C.reg_id=F.reg_id AND C.mod_id=F.mod_id AND C.coh_id=L.coh_id AND C.pen_top=F.pen_top AND G.inf_id=E.inf_id AND G.nuc_id=H.nuc_id AND I.esp_id=F.esp_id AND J.reg_id=F.reg_id AND K.mod_id=F.mod_id AND L.coh_id=F.coh_id AND F.pac_id='$this->pac_id' AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND (F.ci_emp='$ci_doc' OR F.ci_doc_pol='$ci_doc')) as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' AND A.hor_id='$hor_id' GROUP BY A.hor_tpl ORDER BY A.hor_tpl,B.asi_cht,B.asi_chp,B.asi_chl");
	return $res;
  }
//******************************************************************
  function Buscar_materia_pensum_todas($hor_id,$ci_doc){
    $res=$this->Operacion("SELECT B.nuc_nom AS 'nuc_nom', B.inf_nom AS 'inf_nom', CONCAT(B.asi_cod,' ',B.asi_nom) AS 'asigna', B.sec_nom AS 'sec_nom', B.mod_nom AS 'mod_nom', B.coh_nom AS 'coh_nom', B.esp_nom AS 'esp_nom', B.reg_nom AS 'reg_nom', B.ele_cod AS 'ele_cod', B.ele_nom AS 'ele_nom', B.ase_id AS 'ase_id' FROM horario as A RIGHT JOIN (SELECT F.pac_id AS 'pac_id', F.coh_id AS 'coh_id', F.mod_id AS 'mod_id', F.reg_id AS 'reg_id', F.esp_id AS 'esp_id', F.pen_top AS 'pen_top', F.asi_cod AS 'asi_cod', C.asi_nom AS 'asi_nom', F.sec_id AS 'sec_id', E.inf_id AS 'inf_id', E.sec_nom AS 'sec_nom', G.inf_nom AS 'inf_nom', H.nuc_nom AS 'nuc_nom', I.esp_nom AS 'esp_nom', J.reg_nom AS 'reg_nom', K.mod_nom AS 'mod_nom', L.coh_nom AS 'coh_nom',F.ele_cod AS 'ele_cod', M.ele_nom AS 'ele_nom', F.ase_id AS 'ase_id' FROM asigna C, seccio E, asigna_seccio F, infrae G, nucleo H, especi I, regimen J, modali K, cohort L, electi M WHERE F.ele_cod=M.ele_cod AND C.asi_cod=F.asi_cod AND C.esp_id=F.esp_id AND C.reg_id=F.reg_id AND C.mod_id=F.mod_id AND C.coh_id=L.coh_id AND C.pen_top=F.pen_top AND G.inf_id=E.inf_id AND G.nuc_id=H.nuc_id AND I.esp_id=F.esp_id AND J.reg_id=F.reg_id AND K.mod_id=F.mod_id AND L.coh_id=F.coh_id AND F.pac_id='$this->pac_id' AND E.sec_sta='1' AND E.sec_id=F.sec_id AND F.ase_sta='1' AND (F.ci_emp='$ci_doc' OR F.ci_doc_pol='$ci_doc')) as B ON A.pac_id=B.pac_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=B.sec_id WHERE A.hor_sta='1' AND A.pac_id='$this->pac_id' AND A.ci='$ci_doc' AND A.hor_id='$hor_id' GROUP BY B.nuc_nom,B.inf_id,B.asi_cod,A.sec_id , A.mod_id, A.coh_id, A.esp_id, A.reg_id ORDER BY B.inf_id, A.asi_cod, A.sec_id, A.esp_id, A.reg_id, A.coh_id, A.pen_top, A.mod_id");
	return $res;
  }
//******************************************************************
  function Buscar_oferta_todas($ase_id){
  $ci_doc=$_SESSION[ci];
/*      echo "<script>alert('ase_id: $ase_id');</script>";*/
	  $res=$this->OperacionCualquiera("SELECT A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom', B.nuc_nom AS 'nuc_nom', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', CONCAT(A.asi_cod,' ',A.asi_nom) AS 'asigna', B.sec_id AS 'sec_id', B.sec_nom AS 'sec_nom', B.mod_id AS 'mod_id', B.mod_nom AS 'mod_nom', B.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', B.esp_id AS 'esp_id', B.esp_nom AS 'esp_nom', B.reg_id AS 'reg_id', B.reg_nom AS 'reg_nom', B.ele_nom AS 'ele_nom', B.ase_tev AS 'ase_tev', B.ase_pte AS 'ase_pte', B.ase_pla AS 'ase_pla', B.ase_cma AS 'ase_cma', A.asi_cht AS 'asi_cht', A.asi_chp AS 'asi_chp', A.asi_chl AS 'asi_chl', A.asi_lab AS 'asi_lab', B.doc_teo AS 'doc_teo', B.doc_lab AS 'doc_lab' FROM asigna AS A RIGHT JOIN(SELECT B.mod_id AS 'mod_id',F.mod_nom AS 'mod_nom', B.esp_id AS 'esp_id', G.esp_nom AS 'esp_nom', B.reg_id AS 'reg_id', H.reg_nom AS 'reg_nom', B.coh_id AS 'coh_id', I.coh_nom AS 'coh_nom', B.pen_top AS 'pen_top', B.asi_cod AS 'asi_cod', B.sec_id AS 'sec_id', E.sec_nom AS 'sec_nom', B.ase_id AS 'ase_id', C.nuc_nom AS 'nuc_nom', C.nuc_id AS 'nuc_id', D.inf_nom AS 'inf_nom', D.inf_id AS 'inf_id', J.ele_nom AS 'ele_nom', B.ase_tev AS 'ase_tev', B.ase_pte AS 'ase_pte', B.ase_pla AS 'ase_pla', B.ase_cma AS 'ase_cma', B.ci_emp AS 'doc_teo', B.ci_doc_pol AS 'doc_lab' FROM asigna_seccio B, nucleo C, infrae D, seccio E, modali F, especi G, regimen H, cohort I, electi J WHERE B.mod_id=F.mod_id AND B.esp_id=G.esp_id AND B.reg_id=H.reg_id AND B.coh_id=I.coh_id AND B.ele_cod=J.ele_cod AND B.mod_id=F.mod_id AND B.esp_id=G.esp_id AND B.reg_id=H.reg_id AND B.coh_id=I.coh_id AND B.sec_id=E.sec_id AND E.inf_id=D.inf_id AND D.nuc_id=C.nuc_id AND B.ase_sta='1' AND C.nuc_sta='1' AND D.inf_sta='1' AND E.sec_sta='1' AND F.mod_sta='1' AND G.esp_sta='1' AND H.reg_sta='1' AND I.coh_sta='1' AND B.ase_id='$ase_id' AND (B.ci_emp='$ci_doc' OR B.ci_doc_pol='$ci_doc')) AS B ON A.mod_id=B.mod_id AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod WHERE A.asi_sta='1' GROUP BY B.nuc_id,B.inf_id,A.mod_id,A.esp_id,A.reg_id,A.coh_id,A.asi_cod,A.asi_nom,B.sec_id");
	return $res;
  }
//******************************************************************
  function Contar_Inscritos($asi_cod,$mod_id,$esp_id,$reg_id,$coh_id,$sec_id){ 
/*  echo "<script>alert('SELECT COUNT(*) AS cant_ins FROM detins WHERE mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND coh_id=$coh_id AND asi_cod=$asi_cod AND sec_id=$sec_id AND det_sta=1 AND pac_id=$this->pac_id GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id');</script>";*/
    $res=$this->OperacionCualquiera("SELECT COUNT(*) AS 'cant_ins' FROM detins WHERE mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND coh_id='$coh_id' AND asi_cod='$asi_cod' AND sec_id='$sec_id' AND det_sta='1' AND pac_id='$this->pac_id' GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id");
	$array=$this->ConsultarCualquiera($res);
	if($array->cant_ins<=0)
	  $cant_ins=0;
	else
	  $cant_ins=$array->cant_ins;
    return $cant_ins;
  }
//******************************************************************
}?>