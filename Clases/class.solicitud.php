<?php session_start();
class solicitud extends conec_BD
{
    var $ins_id='';
    var $pac_id='';
    var $coh_id='';
    var $mod_id='';
    var $reg_id='';
    var $esp_id='';
    var $pen_top='';
    var $asi_cod='';
	var $obs_id='';
    var $sec_id='';
	var $ci_est='';
    var $ci_emp='';
    var $det_id='';
	var $det_dfi='';
	var $det_nre='';
	var $det_nde='';
    var $det_sta='';
    var $pro_id='';
    var $his_fso='';
    var $his_fap='';
    var $his_des='';
    var $his_obs='';
    var $his_sap='';
    var $his_sso='';
    var $his_sac='';	
    var $his_sol='';
    var $his_sta='';
	var $his_idc='';
	var $res='';
	var $resp='';
//******************************************************************
//$_POST[mod_id],$_POST[reg_id],$_POST[esp_id],$_POST[coh_id],$todo
  function solicitud($ins_id, $pac_id, $coh_id, $mod_id, $reg_id, $esp_id, $pen_top, $asi_cod, $sec_id, $det_id, $obs_id, $ci_est, $ci_emp, $pro_id, $his_sol, $his_idc){
    $this->ins_id=$ins_id;
    $this->pac_id=$pac_id;
    $this->coh_id=$coh_id;
    $this->mod_id=$mod_id;
    $this->reg_id=$reg_id;
    $this->esp_id=$esp_id;
    $this->pen_top=$pen_top;
    $this->asi_cod=$asi_cod;
    $this->sec_id=$sec_id;
    $this->det_id=$det_id;
	$this->obs_id=$obs_id;	
    $this->ci_est=$ci_est;
    $this->ci_emp=$ci_emp;
    $this->pro_id=$pro_id;
    $this->his_sol=$his_sol;
    $this->his_idc=$his_idc;
  }
//******************************************************************
                           //$_POST[mod_id],$_POST[reg_id],$_POST[esp_id],$_POST[coh_id],$_POST[pen_top],$_POST[pac_id],$_POST[ci_est],$_POST[sol],$_POST[fso],$todo_retiro,$todo_inclusion,$todo_cambio
  function Asignar_valores($mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id,$ci_est,$his_sol,$his_fso,$retiro,$inclusion,$cambio){
    $this->ins_id=$this->Buscar_Pro_Inscr($pac_id);
    $this->pac_id=$pac_id;
    $this->coh_id=$coh_id;
    $this->mod_id=$mod_id;
    $this->reg_id=$reg_id;
    $this->esp_id=$esp_id;
    $this->pen_top=$pen_top;
    $this->ci_est=$ci_est;
    $this->ci_emp=$_SESSION[ci];
    $this->pro_id="14*13*15";
    $this->his_sol=$this->ConvertirMayuscula($his_sol);
    $this->his_fso=$this->fechaMySql($his_fso);
    $this->retiro=$this->ConvertirMayuscula($retiro);
    $this->inclusion=$this->ConvertirMayuscula($inclusion);
    $this->cambio=$this->ConvertirMayuscula($cambio);
  }
//******************************************************************
                           //$_POST[mod_id],$_POST[reg_id],$_POST[esp_id],$_POST[coh_id],$_POST[pen_top],$_POST[pac_id],$_POST[ci_est],$_POST[sol],$_POST[fso],$todo_retiro,$todo_inclusion,$todo_cambio
  function Buscar_Pro_Inscr($pac_id){  
    $resp=$this->OperacionCualquiera("SELECT ins_id FROM inscri WHERE pac_id='$pac_id' AND ins_sta='1'");
	$insc=$this->ConsultarCualquiera($resp);
/*	echo "<script>alert(' PRO_INSCR $pac_id, $insc->ins_id');</script>";*/
	return $insc->ins_id;
  }
//******************************************************************
  function Contar_Solicitudes_Proc(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM hisest WHERE his_sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Contar_Solicitudes_NoPro(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM hisest WHERE his_sta='2'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Contar_Solicitudes_Pend(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM hisest WHERE his_sta='0'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Contar_Solicitudes_Fecha_Solici($fin,$ffi){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
	$his_fin_fso=$this->fechaMySql($fin)." 00:00:00";
	$his_ffi_fso=$this->fechaMySql($ffi)." 00:00:00";
    $this->Operacion("SELECT * FROM hisest WHERE DATEDIFF('$his_ffi_fso',his_fso)>=0 AND DATEDIFF(his_fso,'$his_fin_fso')>=0");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Contar_Solicitudes_Fecha_Proce($fin,$ffi){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
	$his_fin_fap=$this->fechaMySql($fin)." 00:00:00";
	$his_ffi_fap=$this->fechaMySql($ffi)." 00:00:00";
    $this->Operacion("SELECT * FROM hisest WHERE DATEDIFF('$his_ffi_fap',his_fap)>=0 AND DATEDIFF(his_fap,'$his_fin_fap')>=0");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Contar_Solicitudes_Empl($ci){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM hisest WHERE ci_emp='$ci'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Contar_Solicitudes_Estu($ci){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM hisest WHERE ci_est='$ci'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Contar_Solicitudes_Todas(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM hisest");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Buscar_Periodo($ci_est){
    $this->ci_est=$ci_est;
/*	echo "<script>alert('Cedula $this->ci_est');</script>";*/
    $res=$this->OperacionCualquiera("SELECT DISTINCT(A.pac_id) AS 'pac_id', B.pac_nom AS 'pac_nom' FROM detins A, pacade B WHERE A.pac_id=B.pac_id AND det_sta='1' AND ci_est='$this->ci_est' ORDER BY B.pac_ffin DESC");
    return $res;
  }
//******************************************************************
  function Buscar_Periodo2($ci_est){
    $this->ci_est=$ci_est;
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
/*	echo "<script>alert('Cedula $this->ci_est');</script>";*/
    $res=$this->OperacionCualquiera("SELECT DISTINCT(A.pac_id) AS 'pac_id', B.pac_nom AS 'pac_nom' FROM detins A, pacade B WHERE A.pac_id=B.pac_id AND det_sta='1' AND ci_est='$this->ci_est' AND A.pac_id!='$this->pac_id' ORDER BY B.pac_ffin DESC");
    return $res;
  }
//******************************************************************
  function Buscar_Observacion(){
/*	echo "<script>alert('Cedula $this->ci_est');</script>";*/
    $res=$this->OperacionCualquiera("SELECT * FROM observ WHERE obs_sta='1' ORDER BY obs_des");
    return $res;
  }
//******************************************************************
  function Buscar_Estudi($valor){
    $id="";
	$des="";
	$cuantos=0;
	$this->ci_est=$valor;
	$_SESSION[ci_est]=$valor;
/*  echo "<script>alert('SELECT A.ap1 AS ap1, A.ap2 AS ap2, A.ap3 AS ap3, A.no1 AS no1, A.no2 AS no2, A.no3 AS no3, B.mod_id AS mod_id, C.mod_nom AS mod_nom, B.reg_id AS reg_id, D.reg_nom AS reg_nom, B.esp_id AS esp_id, E.esp_nom AS esp_nom, B.coh_id AS coh_id, F.coh_nom AS coh_nom FROM persona A, matric B, modali C, regimen D, especi E, cohort F WHERE A.ci=$this->ci_est AND A.ci=B.ci AND B.mod_id=C.mod_id AND B.reg_id=D.reg_id AND B.esp_id=E.esp_id AND B.coh_id=F.coh_id AND B.matr_sta=1 AND B.matr_tip=0');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT A.ap1 AS 'ap1', A.ap2 AS 'ap2', A.ap3 AS 'ap3', A.no1 AS 'no1', A.no2 AS 'no2', A.no3 AS 'no3', B.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', B.reg_id AS 'reg_id', D.reg_nom AS 'reg_nom', B.esp_id AS 'esp_id', E.esp_nom AS 'esp_nom', B.coh_id AS 'coh_id', F.coh_nom AS 'coh_nom', B.pen_top AS 'pen_top', G.pen_muc AS 'pen_muc' FROM persona A, matric B, modali C, regimen D, especi E, cohort F, pensum G WHERE A.ci='$this->ci_est' AND A.ci=B.ci AND B.mod_id=C.mod_id AND B.reg_id=D.reg_id AND B.esp_id=E.esp_id AND B.coh_id=F.coh_id AND B.mod_id=G.mod_id AND B.reg_id=G.reg_id AND B.esp_id=G.esp_id AND B.coh_id=G.coh_id AND B.pen_top=G.pen_top AND B.matr_sta='1' AND B.matr_tip='0'");
	$estudi=$this->ConsultarCualquiera($resp);
    $ap=$estudi->ap1." ".$estudi->ap2." ".$estudi->ap3;
    $nom=$estudi->no1." ".$estudi->no2." ".$estudi->no3;
	$this->res=$ap."@".$nom."@".$estudi->mod_id."@".$estudi->mod_nom."@".$estudi->reg_id."@".$estudi->reg_nom."@".$estudi->esp_id."@".$estudi->esp_nom."@".$estudi->coh_id."@".$estudi->coh_nom."@".$estudi->pen_top."@".$estudi->pen_muc;
$_SESSION[mod_id]=$estudi->mod_id;
$_SESSION[reg_id]=$estudi->reg_id;
$_SESSION[coh_id]=$estudi->coh_id;
$_SESSION[esp_id]=$estudi->esp_id;
$_SESSION[pen_top]=$estudi->pen_top;
	return $this->res;
  }
//******************************************************************
  function Buscar_Estudi_Reglamento($valor){
    $id="";
	$des="";
	$cuantos=0;
	$this->ci_est=$valor;
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
/*  echo "<script>alert('SELECT A.ap1 AS ap1, A.ap2 AS ap2, A.ap3 AS ap3, A.no1 AS no1, A.no2 AS no2, A.no3 AS no3, B.mod_id AS mod_id, C.mod_nom AS mod_nom, B.reg_id AS reg_id, D.reg_nom AS reg_nom, B.esp_id AS esp_id, E.esp_nom AS esp_nom, B.coh_id AS coh_id, F.coh_nom AS coh_nom FROM persona A, matric B, modali C, regimen D, especi E, cohort F WHERE A.ci=$this->ci_est AND A.ci=B.ci AND B.mod_id=C.mod_id AND B.reg_id=D.reg_id AND B.esp_id=E.esp_id AND B.coh_id=F.coh_id AND B.matr_sta=1 AND B.matr_tip=0');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT * FROM apli_reg WHERE ci_est='$this->ci_est' AND pac_id ='$this->pac_id' AND apr_sta='1'");	
	return $resp;
  }
//******************************************************************
  function Buscar_Pacade(){
    $num_filas='';
	$hoy=date("Y-m-d");
	//SELECT DATEDIFF( '2011-03-19 00:00:00', `pac_fin` ) AS 'fin', DATEDIFF( `pac_ffin` , '2011-03-19 00:00:00' ) AS 'ffi' FROM pacade WHERE `pac_sta` = '1'
	$fecha=$hoy." 00:00:00";
    $respuesta=$this->OperacionCualquiera("SELECT pac_id FROM pacade WHERE DATEDIFF('$fecha',pac_fin)>=0 AND DATEDIFF(pac_ffin,'$fecha')>=0 AND pac_sta='1' ORDER BY pac_ffin DESC");
	$pacade=$this->ConsultarCualquiera($respuesta);
//    $num_filas=$this->NumFilas();
    return $pacade;
  }
//******************************************************************
function Buscar_Inclusion($ci_est){
  $this->ci_est=$valor;
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
/*  echo "<script>alert('Buscar_Inscritas $ci_est, $this->pac_id');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$this->ci_est' AND pac_id='$this->pac_id' AND det_sta='1'");
	return $resp;
}
//******************************************************************
function Buscar_Histo($pac_id){
	    $sem="";//SEM/TER
        $cod="";//CODIGO
        $asi="";//ASIGNATURA
        $uc="";//U.C.
        $sec="";//SECCION
        $inf="";//INFRAESTRUCTURA
        $nfi="";//NOTA FINAL
        $nre="";//NOTA DE REPARACION
        $nde="";//NOTA DEFINITIVA
        $obs="";//OBSERVACION
		$obs_id="";//OBSERVACION ID
		$cuantos=0;
		$cant_uc=0;
		$this->ci_est=$_SESSION[ci_est];
		$this->ci_emp=$_SESSION[ci];
/*		echo "<script>alert('$this->ci_est, $pac_id');</script>";*/
$mod_id=$_SESSION[mod_id];
$reg_id=$_SESSION[reg_id];
$coh_id=$_SESSION[coh_id];
$esp_id=$_SESSION[esp_id];
$pen_top=$_SESSION[pen_top];
/*		echo "<script>alert('$mod_id, $reg_id, $coh_id, $esp_id, $pen_top, $this->ci_est, $pac_id');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$this->ci_est' AND pac_id='$pac_id' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND det_sta='1'");
//	$filas=$this->NumFilasCualquiera($resp);
    while($array=$this->ConsultarCualquiera($resp)){	  
	  $respuesta=$this->Buscar_Asignatura($array->asi_cod,$array->mod_id,$array->reg_id,$array->esp_id,$array->coh_id,$array->pen_top);
      $asig=$this->ConsultarCualquiera($respuesta);
      $respuesta=$this->Buscar_Obser($array->obs_id);
	  $obser=$this->ConsultarCualquiera($respuesta);							
	  $respuesta=$this->Buscar_Seccion($array->sec_id);
	  $secc=$this->ConsultarCualquiera($respuesta);
      $cant_uc+=$asig->asi_cuc;
	  $cadena_inf=$secc->inf_nom;
	  for ($i=0;$i<strlen($cadena_inf);$i++){
        if($cadena_inf[$i]=='Á')
          $cadena_inf[$i]='A';
		else{
		  if($cadena_inf[$i]=='É')
            $cadena_inf[$i]='E';
		  else{
		    if($cadena_inf[$i]=='Í')
              $cadena_inf[$i]='I';
			else{
			  if($cadena_inf[$i]=='Ó')
                $cadena_inf[$i]='O';
			  else{
			    if($cadena_inf[$i]=='Ú')
                  $cadena_inf[$i]='U';
				else{
				  if($cadena_inf[$i]=='Ñ')
                    $cadena_inf[$i]='N';
				}
			  }
			}
		  }	
		}
      }
	  $cadena_asi=$asig->asi_nom;
	  for ($i=0;$i<strlen($cadena_asi);$i++){
        if($cadena_asi[$i]=='Á')
          $cadena_asi[$i]='A';
		else{
		  if($cadena_asi[$i]=='É')
            $cadena_asi[$i]='E';
		  else{
		    if($cadena_asi[$i]=='Í')
              $cadena_asi[$i]='I';
			else{
			  if($cadena_asi[$i]=='Ó')
                $cadena_asi[$i]='O';
			  else{
			    if($cadena_asi[$i]=='Ú')
                  $cadena_asi[$i]='U';
				else{
				  if($cadena_asi[$i]=='Ñ')
                    $cadena_asi[$i]='N';
				}
			  }
			}
		  }	
		}
      }
	  $cadena_obs=$obser->obs_des;
	  for ($i=0;$i<strlen($cadena_obs);$i++){
        if($cadena_obs[$i]=='Á')
          $cadena_obs[$i]='A';
		else{
		  if($cadena_obs[$i]=='É')
            $cadena_obs[$i]='E';
		  else{
		    if($cadena_obs[$i]=='Í')
              $cadena_obs[$i]='I';
			else{
			  if($cadena_obs[$i]=='Ó')
                $cadena_obs[$i]='O';
			  else{
			    if($cadena_obs[$i]=='Ú')
                  $cadena_obs[$i]='U';
				else{
				  if($cadena_obs[$i]=='Ñ')
                    $cadena_obs[$i]='N';
				}
			  }
			}
		  }	
		}
      }
	  if($sem==""){	    
	    $sem=$asig->asi_mod;//SEM/TER
        $cod=$asig->asi_cod;//CODIGO
        $asi=$cadena_asi;//ASIGNATURA
        $uc=$asig->asi_cuc;//U.C.
        $sec=$secc->sec_nom;//SECCION
        $inf=$cadena_inf;//INFRAESTRUCTURA
        $nfi=$array->det_nfi;//NOTA FINAL
        $nre=$array->det_nre;//NOTA DE REPARACION
        $nde=$array->det_nde;//NOTA DEFINITIVA
        $obs=$cadena_obs;//OBSERVACION
        $obs_id=$array->obs_id;//OBSERVACION ID
	  }
	  else{
	    $sem=$sem."*".$asig->asi_mod;//SEM/TER
        $cod=$cod."*".$asig->asi_cod;//CODIGO
        $asi=$asi."*".$cadena_asi;//ASIGNATURA
        $uc=$uc."*".$asig->asi_cuc;//U.C.
        $sec=$sec."*".$secc->sec_nom;//SECCION
        $inf=$inf."*".$cadena_inf;//INFRAESTRUCTURA
        $nfi=$nfi."*".$array->det_nfi;//NOTA FINAL
        $nre=$nre."*".$array->det_nre;//NOTA DE REPARACION
        $nde=$nde."*".$array->det_nde;//NOTA DEFINITIVA
        $obs=$obs."*".$cadena_obs;//OBSERVACION
        $obs_id=$obs_id."*".$array->obs_id;//OBSERVACION ID
	  }
	  $cuantos++;
	}
	$this->res=$sem."@".$cod."@".$asi."@".$uc."@".$sec."@".$inf."@".$nfi."@".$nre."@".$nde."@".$obs."@".$cuantos."@".$cant_uc."@".$obs_id;
/*  echo "<script>alert('$this->res');</script>";*/
}
//******************************************************************
function Buscar_NO_Inscritas(){
  $this->ci_est=$_SESSION[ci_est];
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
    $resp=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$this->ci_est' AND pac_id!='$this->pac_id' AND det_sta='1'");
	$filas=$this->NumFilasCualquiera($resp);
/*  echo "<script>alert('Buscar_Inscritas $ci_est, $this->pac_id, $filas');</script>";*/
	return $resp;
}
//******************************************************************
function Buscar_Asigna_Pensum($mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $this->ci_est=$_SESSION[ci_est];
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
    $resp=$this->OperacionCualquiera("SELECT * FROM asigna WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND asi_sta='1' ORDER BY asi_mod");
	$filas=$this->NumFilasCualquiera($resp);
/*  echo "<script>alert('Buscar_Inscritas $ci_est, $this->pac_id, $filas');</script>";*/
	return $resp;
}
//******************************************************************
function Buscar_Inscritas($ci_est,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
$_SESSION[mod_id]=$mod_id;
$_SESSION[reg_id]=$reg_id;
$_SESSION[coh_id]=$coh_id;
$_SESSION[esp_id]=$esp_id;
$_SESSION[pen_top]=$pen_top;
 $_SESSION[ci_est]=$this->ci_est=$ci_est;
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
    $resp=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$this->ci_est' AND pac_id='$this->pac_id' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND det_sta='1'");
	$filas=$this->NumFilasCualquiera($resp);
/*  echo "<script>alert('Buscar_Inscritas $ci_est, $this->pac_id, $filas, $mod_id, $reg_id, $esp_id, $coh_id, $pen_top');</script>";*/
	return $resp;
}
//******************************************************************
function Buscar_Inscritas_Aprobadas($ci_est,$asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $this->ci_est=$ci_est;
    $resp=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$this->ci_est' AND asi_cod='$asi_cod' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND det_sta='1' AND det_con='1'");
	$filas=$this->NumFilasCualquiera($resp);
/*  echo "<script>alert('Buscar_Inscritas $ci_est, $this->pac_id, $filas');</script>";*/
	return $filas;
}
//******************************************************************
function Buscar_Inscritas_Actual($ci_est,$asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $this->ci_est=$ci_est;
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
    $resp=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$this->ci_est' AND pac_id='$this->pac_id' AND asi_cod='$asi_cod' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND det_sta='1'");
	$filas=$this->NumFilasCualquiera($resp);
/*  echo "<script>alert('Buscar_Inscritas $ci_est, $this->pac_id, $filas');</script>";*/
	return $filas;
}
//******************************************************************
function Buscar_detins($ci_est,$sec_id,$asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
/*  echo "<script>alert('SELECT * FROM detins WHERE ci_est=$ci_est AND pac_id=$pac_id AND sec_id=$sec_id AND asi_cod=$asi_cod AND mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND coh_id=$coh_id AND pen_top=$pen_top');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$ci_est' AND pac_id='$pac_id' AND sec_id='$sec_id' AND asi_cod='$asi_cod' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top'");
/*  echo "<script>alert('Buscar_Inscritas $ci_est, $this->pac_id, $filas');</script>";*/
	return $resp;
}
//******************************************************************
function Buscar_Oferta_actual($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
/*  echo "<script>alert('Buscar_Oferta_actual $this->pac_id,$asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE pac_id='$this->pac_id' AND asi_cod='$asi_cod' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND ase_sta='1'");
	$filas=$this->NumFilasCualquiera($resp);
/*	echo "<script>alert('Buscar_Oferta_actual $asi_cod,$filas');</script>";*/
	return $filas;
}
//******************************************************************
  function Listado_requisito($asi_cod, $mod_id, $reg_id, $esp_id, $coh_id, $pen_top){
/*  echo "<script>alert('SELECT * FROM requis WHERE coh_id=$coh_id AND mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND pen_top=$pen_top AND asi_cod=$asi_cod order by asi_cod_req');</script>";*/
    $resultado=$this->OperacionCualquiera("SELECT * FROM requis WHERE coh_id='$coh_id' AND mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND pen_top='$pen_top' AND asi_cod='$asi_cod' AND req_sta='1' order by asi_cod_req");
    return $resultado;
  }
//******************************************************************
function Buscar_Asignatura($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
/*  echo "<script>alert('Buscar_Asignatura $asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT * FROM asigna WHERE asi_cod='$asi_cod' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top'");
	return $resp;
}
//******************************************************************
function Buscar_Seccion($sec_id){
/*  echo "<script>alert('Buscar_Seccion $sec_id');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT A.sec_id AS 'sec_id', A.sec_nom AS 'sec_nom', B.inf_nom AS 'inf_nom' FROM seccio A, infrae B WHERE A.sec_id='$sec_id' AND A.inf_id=B.inf_id");
	return $resp;
}
//******************************************************************
function Buscar_Seccion2($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
    $resp=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE asi_cod='$asi_cod' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND pac_id='$this->pac_id' AND ase_sta='1'");
	$filas=$this->NumFilasCualquiera($resp);
  if($filas>0)
	return $resp;
  else
    return $filas;
}
//******************************************************************
function Buscar_Sede($sec_id){
    $resp=$this->OperacionCualquiera("SELECT A.sec_nom AS 'sec_nom', B.inf_nom AS 'inf_nom' FROM seccio A, infrae B WHERE A.sec_id='$sec_id' AND A.inf_id=B.inf_id");
	return $resp;
}
//******************************************************************
function Listar_Obser(){
/*  echo "<script>alert('Buscar_Obser $obs_id');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT * FROM observ WHERE obs_sta='1'");
	return $resp;
}
//******************************************************************
function Buscar_Obser($obs_id){
/*  echo "<script>alert('Buscar_Obser $obs_id');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT * FROM observ WHERE obs_id='$obs_id'");
	return $resp;
}
//******************************************************************
  function Contar_Ing_Diurno($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$sec_id){
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
/*  echo "<script>alert('SELECT count(ci_est) AS cantidad FROM detins WHERE asi_cod=$asi_cod AND sec_id=$sec_id AND esp_id IN(2113D,2126D,2122D) AND reg_id=$reg_id AND mod_id=$mod_id AND coh_id=$coh_id AND pac_id=$this->pac_id AND det_sta=1');</script>";*/
    $resultado=$this->Operacion("SELECT count(ci_est) AS 'cantidad' FROM detins WHERE asi_cod='$asi_cod' AND sec_id='$sec_id' AND esp_id IN('2113D','2126D','2122D') AND reg_id='$reg_id' AND mod_id='$mod_id' AND coh_id='$coh_id' AND pac_id='$this->pac_id' AND det_sta=1");
    return $resultado;
  }
//******************************************************************
  function Contar_Ing_Nocturno($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$sec_id){
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
/*  echo "<script>alert('SELECT count(ci_est) AS cantidad FROM detins WHERE asi_cod=$asi_cod AND sec_id=$sec_id AND esp_id IN(2113N,2126N,2122N) AND reg_id=$reg_id AND mod_id=$mod_id AND coh_id=$coh_id AND pac_id=$this->pac_id AND det_sta=1');</script>";*/
    $resultado=$this->Operacion("SELECT count(ci_est) AS 'cantidad' FROM detins WHERE asi_cod='$asi_cod' AND sec_id='$sec_id' AND esp_id IN('2113N','2126N','2122N') AND reg_id='$reg_id' AND mod_id='$mod_id' AND coh_id='$coh_id' AND pac_id='$this->pac_id' AND det_sta=1");
    return $resultado;
  }
//******************************************************************
  function Contar_Licenciatura($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$sec_id){
  $pac=$this->Buscar_Pacade();
  $this->pac_id=$pac->pac_id;
/*  if($asi_cod=='02')
  echo "<script>alert('SELECT count(ci_est) AS cantidad FROM detins WHERE asi_cod=$asi_cod AND sec_id=$sec_id AND esp_id=$esp_id AND reg_id=$reg_id AND mod_id=$mod_id AND coh_id=$coh_id AND pac_id=$this->pac_id AND det_sta=1');</script>";*/
    $resultado=$this->Operacion("SELECT count(ci_est) AS 'cantidad' FROM detins WHERE asi_cod='$asi_cod' AND sec_id='$sec_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND mod_id='$mod_id' AND coh_id='$coh_id' AND pac_id='$this->pac_id' AND det_sta=1");
    return $resultado;
  }
//******************************************************************
function Crear_Solicitud(){
  $proceso=explode("*",$this->pro_id);
     $dias=time();
	 $hoy=date("Y-m-d H:i:s",$dias);
//-----------------------RETIRO----------------------------------//
  $retiro=explode("!",$this->retiro);
  $ret=explode("*",$retiro[0]);
  $ret_pro=explode("*",$retiro[1]);
  $ret_obs=explode("*",$retiro[2]);
  $i=0;
//  $hisest=1;
  $cuan_ret=0;
  $sumar=0;
  while($ret[$i]!=""){ 
	$dias=time()+$sumar+10;
	$min=date("H:m:i",$dias);
	$his_fso=$this->his_fso." ".$min;
/*    echo "<script>alert('HOY $hoy MINUTOS $min');</script>";*/
   	$proc=0;
    if($ret_pro[$i]=='S'){	
	  $proc=1;//11
/*  echo "<script>alert('$ret[$i], $ret_pro[$i], $ret_obs[$i], $i, $this->his_fso, $this->his_sol, $proc');</script>";*/
    $resp=$this->OperacionCualquiera("UPDATE detins set det_sta=0, det_obs='RETIRADA', obs_id='11' WHERE det_id='$ret[$i]'");
    $det_ret=$this->filas_afectadas($resp);
	  $cuan_ret++;
	}
	if($ret_pro[$i]=='N')
	  $proc=2;
/*  echo "<script>alert('INSERT INTO hisest (his_fso, his_sol, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des) VALUES ($his_fso, $this->his_sol, $proc, $this->ci_est, $ret[$i], $this->ci_emp, $proceso[0], $hoy, $ret_obs[$i])');</script>";*/
  if($ret_obs[$i]!="")
	$resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des) VALUES ('$his_fso', '$this->his_sol', '$proc', '$this->ci_est', '$ret[$i]', '$this->ci_emp', '$proceso[0]', '$hoy', '$ret_obs[$i]')");
  else
    $resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap) VALUES ('$his_fso', '$this->his_sol', '$proc', '$this->ci_est', '$ret[$i]', '$this->ci_emp', '$proceso[0]', '$hoy')");
    $hisest=$this->filas_afectadas($resp);
	$i++;
	$sumar=$sumar+$i+120;
  }
/*  echo "<script>alert('$cuan_ret==$i, $hisest');</script>";*/
  if($cuan_ret!=0)
    echo "<script>alert('FUERON PROCESADAS LAS SOLICITUDES DE RETIRO DE ASIGNATURAS');</script>";
//-----------------------INCLUSION----------------------------------//
  /*
    $this->inclusion=$this->ConvertirMayuscula($inclusion);  $todo_inclusion=$inclusion."!".$inc_pro."!".$inc_obs."!".$inc_sec;
    $this->cambio=$this->ConvertirMayuscula($cambio);        $todo_cambio=$cambio."!".$cam_pro."!".$cam_obs."!".$cam_sec;
  */
  $inclusion=explode("!",$this->inclusion);
  $inc=explode("*",$inclusion[0]);
  $ultimo_id ="0";
  $inc_pro=explode("*",$inclusion[1]);
  $inc_obs=explode("*",$inclusion[2]);
  $inc_sec=explode("*",$inclusion[3]);
  $i=0;
//  $hisest=1;
  $cuan_inc=0;
  $sumar=0;
  while($inc[$i]!=""){ 
	$dias=time()+$sumar+20;
	$min=date("H:m:i",$dias);
/*  echo "<script>alert('$sumar, $dias, $min');</script>";*/
	$his_fso=$this->his_fso." ".$min;
/*    echo "<script>alert('HOY $hoy MINUTOS $min');</script>";*/
   	$proc=0;
    if($inc_pro[$i]=='S'){
	  $proc=1;//12
/*	echo "<script>alert('INCLUIR $this->ins_id,$this->pen_top,$this->ci_est,$inc_sec[$i],$inc[$i],$this->esp_id,$this->reg_id,$this->mod_id,$this->coh_id,$this->pac_id,12,1,$hoy,0,INCLUSION DE ASIGNATURA');</script>";*/
	  $regsec=$this->Buscar_detins($this->ci_est,$inc_sec[$i],$inc[$i],$this->mod_id,$this->reg_id,$this->esp_id,$this->coh_id,$this->pen_top,$this->pac_id);
	  $filasregsec=$this->NumFilasCualquiera($regsec);
	  $consregsec=$this->ConsultarCualquiera($regsec);
	  if($filasregsec<=0){
      $resp=$this->OperacionCualquiera("INSERT INTO detins (ins_id,pen_top,ci_est,sec_id,asi_cod,esp_id,reg_id,mod_id,coh_id,pac_id,obs_id,det_sta,det_fin,det_con,det_obs) VALUES ('$this->ins_id','$this->pen_top','$this->ci_est','$inc_sec[$i]','$inc[$i]','$this->esp_id','$this->reg_id','$this->mod_id','$this->coh_id','$this->pac_id','12','1','$hoy','0','INCLUSION DE ASIGNATURA')");
  	  $ultimo_id = mysql_insert_id();
	  $det_inc=$this->filas_afectadas($resp);
	  }
	  else{
 	    $ultimo_id = $consregsec->det_id;
/*  echo "<script>alert('UPDATE detins SET det_sta=1,det_obs=CAMBIO DE SECCION, obs_id=13 WHERE det_id=$ultimo_id');</script>";*/
        $resp=$this->OperacionCualquiera("UPDATE detins SET det_sta='1',det_obs='INCLUSION DE ASIGNATURA', obs_id='12' WHERE  det_id='$ultimo_id'");
 	    $det_cam_ins=$this->filas_afectadas($resp);
	  }
	  $cuan_inc++;
/*	echo "<script>alert('$ultimo_id');</script>";  	  */
	}
	if($inc_pro[$i]=='N')
	  $proc=2;
/*	echo "<script>alert('INSERT INTO hisest (his_fso, his_sol, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des) VALUES ($his_fso, $this->his_sol, $inc_sec[$i], $proc, $this->ci_est, $ultimo_id, $this->ci_emp, $proceso[1], $hoy, $inc_obs[$i])');</script>";*/
  if($inc_obs[$i]!="")
	$resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des) VALUES ('$his_fso', '$this->his_sol', '$inc_sec[$i]', '$proc', '$this->ci_est', '$ultimo_id', '$this->ci_emp', '$proceso[1]', '$hoy', '$inc_obs[$i]')");
  else	
    $resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap) VALUES ('$his_fso', '$this->his_sol', '$inc_sec[$i]', '$proc', '$this->ci_est', '$ultimo_id', '$this->ci_emp', '$proceso[1]', '$hoy')");
  $hisest=$this->filas_afectadas($resp);
	$i++;
	$sumar=$sumar+$i+170;
  }
/*  echo "<script>alert('$cuan_inc==$i, $hisest');</script>";*/
  if($cuan_inc!=0)
    echo "<script>alert('FUERON PROCESADAS LAS SOLICITUDES DE INCLUSION DE ASIGNATURAS');</script>";

//-----------------------CAMBIO DE SECCION----------------------------------//
  /*
    $this->cambio=$this->ConvertirMayuscula($cambio);        $todo_cambio=$cambio."!".$cam_pro."!".$cam_obs."!".$cam_sec;
  *///$cambio."!".$cam_pro."!".$cam_obs."!".$cam_sec
  $cambio=explode("!",$this->cambio);
  $cam=explode("*",$cambio[0]);
  $cam_pro=explode("*",$cambio[1]);
  $cam_obs=explode("*",$cambio[2]);
  $cam_sec=explode("*",$cambio[3]);
  $ultimo_id="0";
  $i=0;
  $hisest=1;
  $cuan_cam=0;
  while($cam[$i]!=""){
	$dias=time()+$sumar+30;
	$min=date("H:m:i",$dias);
	$his_fso=$this->his_fso." ".$min;
/*    echo "<script>alert('HOY $his_fso MINUTOS $min');</script>";*/
   	$proc=0;
/*  echo "<script>alert('$his_fso, $cam_pro[$i], $cam_obs, $cam_sec');</script>";*/
    if($cam_pro[$i]=='S'){
	  $proc=1;//13
/*  echo "<script>alert('UPDATE detins set det_sta=0, det_obs=CAMBIO DE SECCION, obs_id=13 WHERE ins_id=$this->ins_id AND pen_top=$this->pen_top AND ci_est=$this->ci_est AND asi_cod=$cam[$i] AND esp_id=$this->esp_id AND reg_id=$this->reg_id AND mod_id=$this->mod_id AND coh_id=$this->coh_id AND pac_id=$this->pac_id');</script>";*/
      $resp=$this->OperacionCualquiera("UPDATE detins set det_sta=0, det_obs='CAMBIO DE SECCION', obs_id='13' WHERE ins_id='$this->ins_id' AND pen_top='$this->pen_top' AND ci_est='$this->ci_est' AND asi_cod='$cam[$i]' AND esp_id='$this->esp_id' AND reg_id='$this->reg_id' AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND pac_id='$this->pac_id' AND det_sta='1'");
	  $det_cam_mod=$this->filas_afectadas($resp);
	  $regsec=$this->Buscar_detins($this->ci_est,$cam_sec[$i],$cam[$i],$this->mod_id,$this->reg_id,$this->esp_id,$this->coh_id,$this->pen_top,$this->pac_id);
	  $filasregsec=$this->NumFilasCualquiera($regsec);
	  $consregsec=$this->ConsultarCualquiera($regsec);
	  if($filasregsec<=0){
/*  echo "<script>alert('INSERT INTO detins (ins_id,pen_top,ci_est,sec_id,asi_cod,esp_id,reg_id,mod_id,coh_id,pac_id,obs_id,det_sta,det_fin,det_con,det_obs) VALUES ($this->ins_id,$this->pen_top,$this->ci_est,$cam_sec[$i],$cam[$i],$this->esp_id,$this->reg_id,$this->mod_id,$this->coh_id,$this->pac_id,13,1,$hoy,0,CAMBIO DE SECCION)');</script>";*/
      $resp=$this->OperacionCualquiera("INSERT INTO detins (ins_id,pen_top,ci_est,sec_id,asi_cod,esp_id,reg_id,mod_id,coh_id,pac_id,obs_id,det_sta,det_fin,det_con,det_obs) VALUES ('$this->ins_id','$this->pen_top','$this->ci_est','$cam_sec[$i]','$cam[$i]','$this->esp_id','$this->reg_id','$this->mod_id','$this->coh_id','$this->pac_id','13','1','$hoy','0','CAMBIO DE SECCION')");
 	  $det_cam_ins=$this->filas_afectadas($resp);
	  $ultimo_id = mysql_insert_id();
	  }
	  else{
 	    $ultimo_id = $consregsec->det_id;
/*  echo "<script>alert('UPDATE detins SET det_sta=1,det_obs=CAMBIO DE SECCION, obs_id=13 WHERE det_id=$ultimo_id');</script>";*/
        $resp=$this->OperacionCualquiera("UPDATE detins SET det_sta='1',det_obs='CAMBIO DE SECCION', obs_id='13' WHERE  det_id='$ultimo_id'");
 	    $det_cam_ins=$this->filas_afectadas($resp);
	  }
	  $cuan_cam++;
	}
	if($cam_pro[$i]=='N'){
	  $proc=2;
/*  echo "<script>alert('INSERT INTO hisest (his_fso, his_sol, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des) VALUES ($his_fso, $this->his_sol, $cam_sec[$i], $proc, $this->ci_est, $ultimo_id, $this->ci_emp, $proceso[2], $hoy, $cam_obs[$i])');</script>";*/
	  $resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sap, his_sta, ci_est, ci_emp, pro_id, his_fap, his_des) VALUES ('$his_fso', '$this->his_sol', '$cam_sec[$i]', '$proc', '$this->ci_est', '$this->ci_emp', '$proceso[2]', '$hoy', '$cam_obs[$i]')");
	}
	else{
/*  echo "<script>alert('INSERT INTO hisest (his_fso, his_sol, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des) VALUES ($his_fso, $this->his_sol, $cam_sec[$i], $proc, $this->ci_est, $ultimo_id, $this->ci_emp, $proceso[2], $hoy, $cam_obs[$i])');</script>";*/
	if($cam_obs[$i]!="")
	  $resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des) VALUES ('$his_fso', '$this->his_sol', '$cam_sec[$i]', '$proc', '$this->ci_est', '$ultimo_id', '$this->ci_emp', '$proceso[2]', '$hoy', '$cam_obs[$i]')");
	else
      $resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap) VALUES ('$his_fso', '$this->his_sol', '$cam_sec[$i]', '$proc', '$this->ci_est', '$ultimo_id', '$this->ci_emp', '$proceso[2]', '$hoy')");
	}
    $hisest=$this->filas_afectadas($resp);
	$i++;
	$sumar=$sumar+$i+320;
  }
/*  echo "<script>alert('$cuan_inc==$i, $hisest');</script>";*/
  if($cuan_cam!=0)
    echo "<script>alert('FUERON PROCESADAS LAS SOLICITUDES DE CAMBIO DE SECCION');</script>";
  if($cuan_cam!=0 || $cuan_inc!=0 || $cuan_ret!=0)
    return 1;
  else
    return 0;
}
//******************************************************************
function Cambiar_Notas_Estudiante($acu,$sol,$fso,$obs_his,$cod_asig,$pac_id,$nfi_act,$nre_act,$nde_act,$obs_act,$nfi,$nre,$nde,$obs,$i){
$this->ci_est=$_SESSION[ci_est];
$mod_id=$_SESSION[mod_id];
$reg_id=$_SESSION[reg_id];
$coh_id=$_SESSION[coh_id];
$esp_id=$_SESSION[esp_id];
$pen_top=$_SESSION[pen_top];
/*echo "<script>alert('ENTRE A CAMBIAR NOTAS');</script>"; */
  $dias=time()-(5400+($i*100));
  $hoy=date("Y-m-d H:i:s",$dias);
	$dias=time()-(5400+($i*100));
	$min=date("H:m:i",$dias);
	$FS=explode("/",$fso);
	$his_fso=$FS[2]."-".$FS[1]."-".$FS[0]." ".$min;
	$his_sol=$acu."*".$sol;
	$this->ci_emp=$_SESSION[ci];
	$respdet_id=$this->OperacionCualquiera("SELECT det_id FROM detins WHERE pac_id='$pac_id' AND pen_top='$pen_top' AND ci_est='$this->ci_est' AND asi_cod='$cod_asig' AND esp_id='$esp_id' AND reg_id='$reg_id' AND mod_id='$mod_id' AND coh_id='$coh_id' AND pac_id='$pac_id'");
	$consdet_id=$this->ConsultarCualquiera($respdet_id);
	$det_id=$consdet_id->det_id;
	$det_con=0;
	if($nde_act>=10){
	  $det_con=1;
	}
$resp=$this->OperacionCualquiera("UPDATE detins SET det_nfi='$nfi_act', det_nre='$nre_act', det_nde='$nde_act', obs_id='$obs_act', det_con='$det_con' WHERE pac_id='$pac_id' AND pen_top='$pen_top' AND ci_est='$this->ci_est' AND asi_cod='$cod_asig' AND esp_id='$esp_id' AND reg_id='$reg_id' AND mod_id='$mod_id' AND coh_id='$coh_id' AND pac_id='$pac_id'");
$cambio=$this->filas_afectadas($resp);
$obs_des="CAMBIO DE NOTAS; DATOS ANTERIORES: NOTA FINAL=".$nfi.", NOTA DE REPARACION=".$nre.", NOTA DEFINITIVA=".$nde.", OBSERVACION=".$obs." NOTAS NUEVAS: NOTA FINAL=".$nfi_act.", NOTA DE REPARACION=".$nre_act.", NOTA DEFINITIVA=".$nde_act.", OBSERVACION=".$obs_act;
/*echo "<script>alert('CAMBIO $cambio');</script>";*/
if($cambio>0){
/*  echo "<script>alert('INSERT INTO hisest (his_fso, his_sol, his_sta, ci_est, ci_emp, pro_id, his_fap, his_obs, his_des) VALUES ($his_fso, $his_sol, 1, $this->ci_est, $this->ci_emp, 14, $hoy, $obs_his, $obs_des)';</script>";*/
  $resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_obs, his_des) VALUES ('$his_fso', '$his_sol', '1', '$this->ci_est', '$det_id', '$this->ci_emp', '16', '$hoy', '$obs_his', '$obs_des')");
  $hisest=$this->filas_afectadas($resp);
}
/*echo "<script>alert('CAMBIO $cambio');</script>"; */
return $cambio;
}
//******************************************************************
}?>