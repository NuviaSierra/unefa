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
		var $ci='';
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
		$this->ci=$ci_est;
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
	  function Array_Solicitudes_Estu($ci){
		$num_filas='';
		//$this->ci=$_SESSION['nacid'];
		$res=$this->OperacionCualquiera("SELECT A.his_sol AS 'his_sol', A.his_fso AS 'his_fso', UPPER(CONCAT(A.ci_emp,' ',B.ap1,' ',B.ap2,', ',B.no1,' ',B.no2)) AS 'emp', C.pro_nom AS 'pro_nom', A.his_fap AS 'his_fap', UPPER(CONCAT(E.asi_cod,' ',E.asi_nom)) AS 'asig', F.sec_nom AS 'sec1', G.sec_nom AS 'sec2', A.his_obs as 'his_obs', A.his_des AS 'his_des', A.his_sta AS 'his_sta' FROM hisest A, persona B, proces C, detins D, asigna E, seccio F, seccio G WHERE A.ci_est='$ci' AND A.ci_emp=B.ci AND A.pro_id=C.pro_id AND A.det_id=D.det_id AND D.mod_id=E.mod_id AND D.reg_id=E.reg_id AND D.esp_id=E.esp_id AND D.coh_id=E.coh_id AND D.pen_top=E.pen_top AND D.asi_cod=E.asi_cod AND A.his_sac=F.sec_id AND A.his_sap=G.sec_id ORDER BY A.his_fso,A.his_fap ASC");
		return $res;
	  }
	//******************************************************************
	  function Contar_Solicitudes_Todas($ci_est){
		$num_filas='';
		//$this->ci=$_SESSION['nacid'];
		$this->Operacion("SELECT * FROM hisest WHERE ci_est='$ci_est'");
		$num_filas=$this->NumFilas();
		return $num_filas;
	  }
	//******************************************************************
	  function Buscar_Periodo($ci_est){
		$this->ci_est=$ci_est;
	/*	echo "<script>alert('Cedula $this->ci_est');</script>";*/
	/*	echo "<script>alert('SELECT DISTINCT(A.pac_id) AS pac_id, B.pac_nom AS pac_nom FROM detins A, pacade B, matric C WHERE A.pac_id=B.pac_id AND A.det_sta=1 AND A.ci_est=$this->ci_est AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.reg_id=C.reg_id AND A.esp_id=C.esp_id AND A.pen_top=C.pen_top AND A.ci_est=C.ci AND C.matr_sta=1 AND C.matr_tip=0 ORDER BY B.pac_ffin DESC');</script>";*/
		$res=$this->OperacionCualquiera("SELECT DISTINCT(A.pac_id) AS 'pac_id', B.pac_nom AS 'pac_nom' FROM detins A, pacade B, matric C WHERE A.pac_id=B.pac_id AND A.det_sta='1' AND A.ci_est='$this->ci_est' AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.reg_id=C.reg_id AND A.esp_id=C.esp_id AND A.pen_top=C.pen_top AND A.ci_est=C.ci AND C.matr_sta='1' AND C.matr_tip='0' ORDER BY B.pac_ffin DESC");
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
		$resp=$this->OperacionCualquiera("SELECT A.ap1 AS 'ap1', A.ap2 AS 'ap2', A.ap3 AS 'ap3', A.no1 AS 'no1', A.no2 AS 'no2', A.no3 AS 'no3', B.mod_id AS 'mod_id', C.mod_nom AS 'mod_nom', B.reg_id AS 'reg_id', D.reg_nom AS 'reg_nom', B.esp_id AS 'esp_id', E.esp_nom AS 'esp_nom', B.coh_id AS 'coh_id', F.coh_nom AS 'coh_nom', B.pen_top AS 'pen_top', G.pen_muc AS 'pen_muc', A.tmo AS 'tmo', H.usu_cor AS 'email' FROM persona A, matric B, modali C, regimen D, especi E, cohort F, pensum G, usuari H WHERE A.ci='$this->ci_est' AND A.ci=H.ci AND A.ci=B.ci AND B.mod_id=C.mod_id AND B.reg_id=D.reg_id AND B.esp_id=E.esp_id AND B.coh_id=F.coh_id AND B.mod_id=G.mod_id AND B.reg_id=G.reg_id AND B.esp_id=G.esp_id AND B.coh_id=G.coh_id AND B.pen_top=G.pen_top AND B.matr_sta='1' AND B.matr_tip='0'");
		$estudi=$this->ConsultarCualquiera($resp);
		$ap=$estudi->ap1." ".$estudi->ap2." ".$estudi->ap3;
		$nom=$estudi->no1." ".$estudi->no2." ".$estudi->no3;
		$this->res=$ap."@".$nom."@".$estudi->mod_id."@".$estudi->mod_nom."@".$estudi->reg_id."@".$estudi->reg_nom."@".$estudi->esp_id."@".$estudi->esp_nom."@".$estudi->coh_id."@".$estudi->coh_nom."@".$estudi->pen_top."@".$estudi->pen_muc."@".$estudi->tmo."@".$estudi->email;
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
	  $_SESSION[pac_id]=$this->pac_id;
	/*  echo "<script>alert('SELECT * FROM apli_reg WHERE ci_est=$this->ci_est AND pac_id =$this->pac_id AND apr_sta=1');</script>";*/
		$resp=$this->OperacionCualquiera("SELECT * FROM apli_reg WHERE ci_est='$this->ci_est' AND pac_id ='$this->pac_id' AND apr_sta='1'");	
		return $resp;
	  }//******************************************************************
	  function Buscar_Estudi_Reglamento_pacade($valor){
		$id="";
		$des="";
		$cuantos=0;
		$this->ci_est=$valor;
		$this->pac_id=$_SESSION[pacade_inc];
	/*  echo "<script>alert('SELECT * FROM apli_reg WHERE ci_est=$this->ci_est AND pac_id =$this->pac_id AND apr_sta=1');</script>";*/
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
	  }//******************************************************************
	  function Buscar_Pacade_id($pac_id){
		$num_filas='';
		$respuesta=$this->OperacionCualquiera("SELECT pac_id, pac_nom FROM pacade WHERE pac_sta='1' AND pac_id='$pac_id' ORDER BY pac_ffin DESC");
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
	function Buscar_Asigna_Pensum_pacade($mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
	  $this->ci_est=$_SESSION[ci_est];
	//  $pac=$this->Buscar_Pacade();
	  $this->pac_id=$pac_id;
		$resp=$this->OperacionCualquiera("SELECT * FROM asigna WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND asi_sta='1' ORDER BY asi_mod");
		$filas=$this->NumFilasCualquiera($resp);
	/*  echo "<script>alert('Buscar_Inscritas $ci_est, $this->pac_id, $filas');</script>";*/
		return $resp;
	}
	//******************************************************************
	function Buscar_Inscritas_pacade($ci_est,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
	$_SESSION[mod_id]=$mod_id;
	$_SESSION[reg_id]=$reg_id;
	$_SESSION[coh_id]=$coh_id;
	$_SESSION[esp_id]=$esp_id;
	$_SESSION[pen_top]=$pen_top;
	 $_SESSION[ci_est]=$this->ci_est=$ci_est;
	//  $pac=$this->Buscar_Pacade();
	  $this->pac_id=$_SESSION[pac_id];
	/*  echo "<script>alert('SELECT * FROM detins WHERE ci_est=$this->ci_est AND pac_id=$this->pac_id AND mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND coh_id=$coh_id AND pen_top=$pen_top AND det_sta=1');</script>";*/
		$resp=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$this->ci_est' AND pac_id='$this->pac_id' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND det_sta='1'");
		$filas=$this->NumFilasCualquiera($resp);
	/*  echo "<script>alert('Buscar_Inscritas $ci_est, $this->pac_id, $filas, $mod_id, $reg_id, $esp_id, $coh_id, $pen_top');</script>";*/
		return $resp;
	}
	//******************************************************************
	function Buscar_Inscritas_Aprobadas_pacade($ci_est,$asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
	  $this->ci_est=$ci_est;
	  $proc_pac=$this->OperacionCualquiera("SELECT * FROM pacade WHERE pac_sta='1' AND pac_id='$pac_id'");
	  $dat_pac=$this->ConsultarCualquiera($proc_pac);
	  $resp=$this->OperacionCualquiera("SELECT * FROM detins WHERE ci_est='$this->ci_est' AND asi_cod='$asi_cod' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND det_sta='1' AND det_con='1' AND pac_id NOT IN (SELECT pac_id FROM pacade WHERE pac_sta='1' AND DATEDIFF(pac_ffin,'$dat_pac->pac_ffin')>=0)");
	  $filas=$this->NumFilasCualquiera($resp);
	/*  echo "<script>alert('Buscar_Inscritas $ci_est, $this->pac_id, $filas');</script>";*/
		return $filas;
	}
	//******************************************************************
	function Buscar_Inscritas_Actual_pacade($ci_est,$asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
	  $this->ci_est=$ci_est;
	//  $pac=$this->Buscar_Pacade();
	  $this->pac_id=$pac_id;
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
	function Buscar_Oferta_actual_pacade($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
	//  $pac=$this->Buscar_Pacade();
	  $this->pac_id=$pac_id;
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
	function Buscar_Seccion2_pacade($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
	  $this->pac_id=$pac_id;
/*	  echo "<script>alert('SELECT A.ase_id AS ase_id, A.sec_id AS sec_id, B.sec_nom AS sec_nom, A.ase_cma AS ase_cma FROM asigna_seccio A, seccio B WHERE A.asi_cod=$asi_cod AND A.mod_id=$mod_id AND A.reg_id=$reg_id AND A.esp_id=$esp_id AND A.coh_id=$coh_id AND A.pen_top=$pen_top AND A.pac_id=$this->pac_id AND A.ase_sta=1 AND A.sec_id=B.sec_id GROUP BY ase_id');</script>";*/
	  $resp=$this->OperacionCualquiera("SELECT A.ase_id AS 'ase_id', A.sec_id AS 'sec_id', B.sec_nom AS 'sec_nom', A.ase_cma AS 'ase_cma' FROM asigna_seccio A, seccio B WHERE A.asi_cod='$asi_cod' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.pac_id='$this->pac_id' AND A.ase_sta='1' AND A.sec_id=B.sec_id GROUP BY ase_id");
	  return $resp;
	}
	//******************************************************************
	function Buscar_Sede($sec_id){
		$resp=$this->OperacionCualquiera("SELECT A.sec_nom AS 'sec_nom', B.inf_nom AS 'inf_nom' FROM seccio A, infrae B WHERE A.sec_id='$sec_id' AND A.inf_id=B.inf_id");
		return $resp;
	}
	//******************************************************************
	function Buscar_Obser($obs_id){
	/*  echo "<script>alert('Buscar_Obser $obs_id');</script>";*/
		$resp=$this->OperacionCualquiera("SELECT * FROM observ WHERE obs_id='$obs_id'");
		return $resp;
	}
	
	//******************************************************************
	function Contar_Inscritos_Actual($ase_id,$pac_id){
	  $this->ci_est=$ci_est;
	  $this->pac_id=$pac_id;
/*	  echo "<script>alert('SELECT B.ci_est FROM asigna_seccio A, detins B, matric C WHERE A.pac_id=B.pac_id AND A.pac_id=$this->pac_id AND A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.sec_id=B.sec_id AND B.det_sta=1 AND A.ase_id=$ase_id AND A.ase_sta=1 AND A.mod_id=C.mod_id AND A.reg_id=C.reg_id AND A.esp_id=C.esp_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND B.ci_est=C.ci AND C.matr_sta=1 AND C.matr_tip=0 GROUP BY B.ci_est');</script>";*/
		$resp=$this->OperacionCualquiera("SELECT B.ci_est FROM asigna_seccio A, detins B, matric C WHERE A.pac_id=B.pac_id AND A.pac_id='$this->pac_id' AND A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.sec_id=B.sec_id AND B.det_sta='1' AND A.ase_id='$ase_id' AND A.ase_sta='1' AND A.mod_id=C.mod_id AND A.reg_id=C.reg_id AND A.esp_id=C.esp_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND B.ci_est=C.ci AND C.matr_sta='1' AND C.matr_tip='0' GROUP BY B.ci_est");
		$filas=$this->NumFilasCualquiera($resp);
		return $filas;
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
	function Crear_Solicitud($pac_id){
	$this->mod_id=$_SESSION[mod_id];
	$this->reg_id=$_SESSION[reg_id];
	$this->esp_id=$_SESSION[esp_id];
	$this->coh_id=$_SESSION[coh_id];
	$this->pen_top=$_SESSION[pen_top];
	$this->pac_id=$_SESSION[pac_id]=$pac_id;
	  $proceso=explode("*",$this->pro_id);
		 $dias=(time());
		 $hoy=date("Y-m-d H:i:s",$dias);
	//-----------------------RETIRO----------------------------------//
	  $retiro=explode("!",$this->retiro);
	  $ret=explode("*",$retiro[0]);
	  $ret_pro=explode("*",$retiro[1]);
	  $ret_obs=explode("*",$retiro[2]);
	  $ret_sec=explode("*",$retiro[3]);
	  $i=0;
	//  $hisest=1;
	  $cuan_ret=0;
	  $sumar=0;
	  while($ret[$i]!=""){ 
		$dias=($dias+($sumar*10));
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
		$resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des, his_sac) VALUES ('$his_fso', '$this->his_sol', '$proc', '$this->ci_est', '$ret[$i]', '$this->ci_emp', '$proceso[0]', '$hoy', '$ret_obs[$i]', '$ret_sec[$i]')");
	  else
		$resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_sac) VALUES ('$his_fso', '$this->his_sol', '$proc', '$this->ci_est', '$ret[$i]', '$this->ci_emp', '$proceso[0]', '$hoy', '$ret_sec[$i]')");
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
	  $inc_des=explode("*",$inclusion[2]);
	  $inc_sec=explode("*",$inclusion[3]);
  $inc_nfi=explode("*",$inclusion[4]);
  $inc_nre=explode("*",$inclusion[5]);
  $inc_nde=explode("*",$inclusion[6]);
  $inc_obs=explode("*",$inclusion[7]);
	  $i=0;
	//  $hisest=1;
	  $cuan_inc=0;
	  while($inc[$i]!=""){
	/*  echo "<script>alert('$inc[$i]');</script>";*/
		$dias=($dias+($sumar*20));
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
	  $nom_mat=explode("-",$inc[$i]);
	  $mat_pas_tgr=0;
      $cond_apro='0';
	  if($nom_mat[0]=="PSI" || $nom_mat[0]=="TGR" || $nom_mat[0]=="IRA" || $nom_mat[0]=="IRC")
	    $mat_pas_tgr=1;
	  if((intval($inc_nde[$i])>=intval(10) && $mat_pas_tgr=='0') || (intval($inc_nde[$i])>=intval(14) && $mat_pas_tgr=='1')){
	    $cond_apro='1';
	  }
/*	  echo "<script>alert(' OBSERVAcion $inc_obs[$i]');</script>";*/
	  if($inc_obs[$i]=="")
	    $inc_obs[$i]='12';
		  if($filasregsec<=0){
/*	  echo "<script>alert('INSERT INTO detins (ins_id,pen_top,ci_est,sec_id,asi_cod,esp_id,reg_id,mod_id,coh_id,pac_id,obs_id,det_sta,det_fin,det_con,det_obs,det_nfi,det_nre,det_nde) VALUES ($this->ins_id,$this->pen_top,$this->ci_est,$inc_sec[$i],$inc[$i],$this->esp_id,$this->reg_id,$this->mod_id,$this->coh_id,$this->pac_id,$inc_obs[$i],1,$hoy,$cond_apro,INCLUSION DE ASIGNATURA,$inc_nfi[$i],$inc_nre[$i],$inc_nde[$i])');</script>";*/
		  $resp=$this->OperacionCualquiera("INSERT INTO detins (ins_id,pen_top,ci_est,sec_id,asi_cod,esp_id,reg_id,mod_id,coh_id,pac_id,obs_id,det_sta,det_fin,det_con,det_obs,det_nfi,det_nre,det_nde) VALUES ('$this->ins_id','$this->pen_top','$this->ci_est','$inc_sec[$i]','$inc[$i]','$this->esp_id','$this->reg_id','$this->mod_id','$this->coh_id','$this->pac_id','$inc_obs[$i]','1','$hoy','$cond_apro','INCLUSION DE ASIGNATURA','$inc_nfi[$i]','$inc_nre[$i]','$inc_nde[$i]')");
		  $ultimo_id = mysql_insert_id();
		  $det_inc=$this->filas_afectadas($resp);
		  }
		  else{
			$ultimo_id = $consregsec->det_id;
/*  echo "<script>alert('UPDATE detins SET det_sta=1,det_obs=INCLUSION DE ASIGNATURA, obs_id=$inc_obs[$i], det_con=$cond_apro, det_nfi=$inc_nfi[$i], det_nre=$inc_nre[$i], det_nde=$inc_nde[$i] WHERE  det_id=$ultimo_id');</script>";*/
			$resp=$this->OperacionCualquiera("UPDATE detins SET det_sta='1',det_obs='INCLUSION DE ASIGNATURA', obs_id='$inc_obs[$i]', det_con='$cond_apro', det_nfi='$inc_nfi[$i]', det_nre='$inc_nre[$i]', det_nde='$inc_nde[$i]' WHERE  det_id='$ultimo_id'");
			$det_cam_ins=$this->filas_afectadas($resp);
		  }
		  $cuan_inc++;
	/*	echo "<script>alert('$ultimo_id');</script>";  	  */
		}
		if($inc_pro[$i]=='N')
		  $proc=2;
	/*	echo "<script>alert('INSERT INTO hisest (his_fso, his_sol, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des) VALUES ($his_fso, $this->his_sol, $inc_sec[$i], $proc, $this->ci_est, $ultimo_id, $this->ci_emp, $proceso[1], $hoy, $inc_obs[$i])');</script>";*/
	//if($inc_sec[$i]=="")$inc_sec[$i]=0;
$inc_des[$i]=$inc_des[$i]." ASIGNACION DE NOTAS; NOTA FINAL= ".$inc_nfi[$i].", NOTA DE REPARACION= ".$inc_nre[$i].", NOTA DEFINITIVA= ".$inc_nde[$i].", OBSERVACION= ".$inc_obs[$i];
	  if($inc_des[$i]!=""){
/*	echo "<script>alert('INSERT INTO hisest (his_fso, his_sol, his_sac, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des) VALUES ($his_fso, $this->his_sol, 0, $inc_sec[$i], $proc, $this->ci_est, $ultimo_id, $this->ci_emp, $proceso[1], $hoy, $inc_des[$i])');</script>";*/
		$resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sac, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des) VALUES ('$his_fso', '$this->his_sol', '0', '$inc_sec[$i]', '$proc', '$this->ci_est', '$ultimo_id', '$this->ci_emp', '$proceso[1]', '$hoy', '$inc_des[$i]')");
	  }
	  else{
/*	echo "<script>alert('INSERT INTO hisest (his_fso, his_sol, his_sac, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap) VALUES ($his_fso, $this->his_sol, 0, $inc_sec[$i], $proc, $this->ci_est, $ultimo_id, $this->ci_emp, $proceso[1], $hoy)');</script>";	  */
		$resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sac, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap) VALUES ('$his_fso', '$this->his_sol', '0', '$inc_sec[$i]', '$proc', '$this->ci_est', '$ultimo_id', '$this->ci_emp', '$proceso[1]', '$hoy')");
	  }
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
	  $cam_sec_act=explode("*",$cambio[4]);
	  $cam_nfi=explode("*",$cambio[5]);
	  $cam_nre=explode("*",$cambio[6]);
	  $cam_nde=explode("*",$cambio[7]);
	  $ultimo_id="0";
	  $i=0;
	  $hisest=1;
	  $cuan_cam=0;
	  while($cam[$i]!=""){
		$dias=($dias+($sumar*50));
		$min=date("H:m:i",$dias);
		$his_fso=$this->his_fso." ".$min;
	/*    echo "<script>alert('HOY $his_fso MINUTOS $min');</script>";*/
		$proc=0;
	  $mat_pas_tgr=0;
      $cond_apro='0';
	  if($nom_mat[0]=="PSI" || $nom_mat[0]=="TGR" || $nom_mat[0]=="IRA" || $nom_mat[0]=="IRC")
	    $mat_pas_tgr=1;
	  if((intval($inc_nde[$i])>=intval(10) && $mat_pas_tgr=='0') || (intval($inc_nde[$i])>=intval(14) && $mat_pas_tgr=='1')){
	    $cond_apro='1';
	  }
	/*  echo "<script>alert('$his_fso, $cam_pro[$i], $cam_obs, $cam_sec');</script>";*/
		if($cam_pro[$i]=='S'){
		  $proc=1;//13
	/*  echo "<script>alert('UPDATE detins set det_sta=0, det_obs=CAMBIO DE SECCION, obs_id=13 WHERE ins_id=$this->ins_id AND pen_top=$this->pen_top AND ci_est=$this->ci_est AND asi_cod=$cam[$i] AND esp_id=$this->esp_id AND reg_id=$this->reg_id AND mod_id=$this->mod_id AND coh_id=$this->coh_id AND pac_id=$this->pac_id');</script>";*/
		  $resp=$this->OperacionCualquiera("UPDATE detins set det_sta=0, det_obs='CAMBIO DE SECCION', obs_id='13' WHERE pen_top='$this->pen_top' AND ci_est='$this->ci_est' AND asi_cod='$cam[$i]' AND esp_id='$this->esp_id' AND reg_id='$this->reg_id' AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND pac_id='$this->pac_id' AND det_sta='1'");
		  $det_cam_mod=$this->filas_afectadas($resp);
		  $regsec=$this->Buscar_detins($this->ci_est,$cam_sec[$i],$cam[$i],$this->mod_id,$this->reg_id,$this->esp_id,$this->coh_id,$this->pen_top,$this->pac_id);
		  $filasregsec=$this->NumFilasCualquiera($regsec);
		  $consregsec=$this->ConsultarCualquiera($regsec);
		  if($filasregsec<=0){
  echo "<script>alert('INSERT INTO detins INSERT INTO detins (ins_id,pen_top,ci_est,sec_id,asi_cod,esp_id,reg_id,mod_id,coh_id,pac_id,obs_id,det_sta,det_fin,det_con,det_obs,det_nfi,det_nre,det_nde) VALUES ($this->ins_id,$this->pen_top,$this->ci_est,$cam_sec[$i],$cam[$i],$this->esp_id,$this->reg_id,$this->mod_id,$this->coh_id,$this->pac_id,13,1,$hoy,'$cond_apro',CAMBIO DE SECCION,$cam_nfi[$i],$cam_nre[$i],$cam_nde[$i])');</script>";
		  $resp=$this->OperacionCualquiera("INSERT INTO detins (ins_id,pen_top,ci_est,sec_id,asi_cod,esp_id,reg_id,mod_id,coh_id,pac_id,obs_id,det_sta,det_fin,det_con,det_obs,det_nfi,det_nre,det_nde) VALUES ('$this->ins_id','$this->pen_top','$this->ci_est','$cam_sec[$i]','$cam[$i]','$this->esp_id','$this->reg_id','$this->mod_id','$this->coh_id','$this->pac_id','13','1','$hoy','$cond_apro','CAMBIO DE SECCION','$cam_nfi[$i]','$cam_nre[$i]','$cam_nde[$i]')");
		  $det_cam_ins=$this->filas_afectadas($resp);
		  $ultimo_id = mysql_insert_id();
		  }
		  else{
			$ultimo_id = $consregsec->det_id;
  echo "<script>alert('UPDATE detins SET det_sta=1,det_obs=CAMBIO DE SECCION, obs_id=13, det_nfi=$cam_nfi[$i], det_nre=$cam_nre[$i], det_nde=$cam_nde[$i], det_con=$cond_apro WHERE det_id=$ultimo_id');</script>";
			$resp=$this->OperacionCualquiera("UPDATE detins SET det_sta='1',det_obs='CAMBIO DE SECCION', obs_id='13', det_nfi='$cam_nfi[$i]', det_nre='$cam_nre[$i]', det_nde='$cam_nde[$i]', det_con='$cond_apro' WHERE  det_id='$ultimo_id'");
			$det_cam_ins=$this->filas_afectadas($resp);
		  }
		  $cuan_cam++;
		}
		if($cam_pro[$i]=='N'){
		  $proc=2;
	/*  echo "<script>alert('INSERT INTO hisest (his_fso, his_sol, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des) VALUES ($his_fso, $this->his_sol, $cam_sec[$i], $proc, $this->ci_est, $ultimo_id, $this->ci_emp, $proceso[2], $hoy, $cam_obs[$i])');</script>";*/
	     if($cam_obs[$i]=!""){
		  $resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sac, his_sap, his_sta, ci_est, ci_emp, pro_id, his_fap, his_des) VALUES ('$his_fso', '$this->his_sol', '$cam_sec_act[$i]', '$cam_sec[$i]', '$proc', '$this->ci_est', '$this->ci_emp', '15', '$hoy', '$cam_obs[$i]')");
		  }
		  else{
		  $resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sac, his_sap, his_sta, ci_est, ci_emp, pro_id, his_fap) VALUES ('$his_fso', '$this->his_sol', '$cam_sec_act[$i]', '$cam_sec[$i]', '$proc', '$this->ci_est', '$this->ci_emp', '15', '$hoy')");
		  }
		}
		else{
	/*  echo "<script>alert('INSERT INTO hisest (his_fso, his_sol, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des) VALUES ($his_fso, $this->his_sol, $cam_sec[$i], $proc, $this->ci_est, $ultimo_id, $this->ci_emp, $proceso[2], $hoy, $cam_obs[$i])');</script>";*/
$cam_obs[$i]=$cam_obs[$i]." ASIGNACION DE NOTAS; NOTA FINAL= ".$cam_nfi[$i].", NOTA DE REPARACION= ".$cam_nre[$i].", NOTA DEFINITIVA= ".$cam_nde[$i].", OBSERVACION= CAMBIO DE SECCION";	
		if($cam_obs[$i]!="")
		  $resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sac, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap, his_des) VALUES ('$his_fso', '$this->his_sol', '$cam_sec_act[$i]', '$cam_sec[$i]', '$proc', '$this->ci_est', '$ultimo_id', '$this->ci_emp', '15', '$hoy', '$cam_obs[$i]')");
		else
		  $resp=$this->OperacionCualquiera("INSERT INTO hisest (his_fso, his_sol, his_sac, his_sap, his_sta, ci_est, det_id, ci_emp, pro_id, his_fap) VALUES ('$his_fso', '$this->his_sol', '$cam_sec_act[$i]', '$cam_sec[$i]', '$proc', '$this->ci_est', '$ultimo_id', '$this->ci_emp', '15', '$hoy')");
		}
		$hisest=$this->filas_afectadas($resp);
		$i++;
		$sumar=$sumar+$i+370;
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
	  $dias=(time()-(5400+($i*100)));
	  $hoy=date("Y-m-d H:i:s",$dias);
		$dias=(time()-(5400+($i*100)));
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
	  function Buscar_Estudiante_detins_viejo_pacade($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
	/*  echo "<script>alert('SELECT * FROM pacade WHERE pac_sta=1 AND pac_id=$pac_id');</script>";*/
	  $proc_pac=$this->OperacionCualquiera("SELECT * FROM pacade WHERE pac_sta='1' AND pac_id='$pac_id'");
	  $dat_pac=$this->ConsultarCualquiera($proc_pac);
	/*  echo "<script>alert('SELECT det_id, coh_id FROM detins WHERE mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND coh_id=$coh_id AND pen_top=$pen_top AND ci_est=$ci AND det_sta=1 AND pac_id NOT IN (SELECT pac_id FROM pacade WHERE pac_sta=1 AND DATEDIFF(pac_ffin,$dat_pac->pac_ffin)>=0) GROUP BY pac_id');</script>";*/
	   $resultado=$this->OperacionCualquiera("SELECT det_id, coh_id FROM detins WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND ci_est='$ci' AND det_sta='1' AND pac_id NOT IN (SELECT pac_id FROM pacade WHERE pac_sta='1' AND DATEDIFF(pac_ffin,'$dat_pac->pac_ffin')>=0) GROUP BY pac_id");
	/*	if($ci=='21440012' || $ci=='24693022'){ 
			echo "<script>alert('FILAS: $filas');</script>";
		}*/
		$filas=$this->NumFilasCualquiera($resultado);
		$dat_det_id=$this->ConsultarCualquiera($resultado);
		if($filas<2 && $coh_id=='12')
		  $filas=0;
		else{
		  if($filas<1){
			$filas=0;
		  }
		  else
			$filas=1;
		}
	/*	echo "<script>alert('FILAS: $filas');</script>";*/
		return $filas;
	  }
	 //******************************************************************
	function Buscar_Oferta($viejo_discente){
		$this->pac_id=$_SESSION[pac_id];
		$this->coh_id=$_SESSION[coh_id];
		$this->mod_id=$_SESSION[mod_id];
		$this->reg_id=$_SESSION[reg_id];
		$this->esp_id=$_SESSION[esp_id];
		$this->pen_top=$_SESSION[pen_top];
	/*	if($this->ci=='19866493')  echo "<script>alert(' $viejo_discente: SELECT DISTINCT(asi_cod) AS asi_cod FROM asigna_seccio WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND pac_id=$this->pac_id AND ase_sta=1');</script>";*/
		if($viejo_discente=='1'){
	/*	echo "<script>alert(' $viejo_discente==1: SELECT DISTINCT(asi_cod) AS asi_cod FROM asigna_seccio WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND pac_id=$this->pac_id AND ase_sta=1');</script>";*/
		  $resul=$this->OperacionCualquiera("SELECT DISTINCT(asi_cod) AS 'asi_cod' FROM asigna_seccio WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND pac_id='$this->pac_id' AND ase_sta='1'");
		}
		else{
	/*	echo "<script>alert(' $viejo_discente!=1: SELECT DISTINCT(A.asi_cod) AS asi_cod FROM asigna_seccio A, asigna B WHERE A.mod_id=$this->mod_id AND A.reg_id=$this->reg_id AND A.esp_id=$this->esp_id AND A.coh_id=$this->coh_id AND A.pen_top=$this->pen_top AND A.pac_id=$this->pac_id AND A.ase_sta=1 AND B.asi_mod=1 AND A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.asi_sta=1');</script>";*/
		  $resul=$this->OperacionCualquiera("SELECT DISTINCT(A.asi_cod) AS 'asi_cod' FROM asigna_seccio A, asigna B WHERE A.mod_id='$this->mod_id' AND A.reg_id='$this->reg_id' AND A.esp_id='$this->esp_id' AND A.coh_id='$this->coh_id' AND A.pen_top='$this->pen_top' AND A.pac_id='$this->pac_id' AND A.ase_sta='1' AND B.asi_mod='1' AND A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.asi_sta='1'");
		}
		return $resul;
	}
	//******************************************************************
	function Buscar_Cond_Asig($asi_cod){
		$this->pac_id=$_SESSION[pac_id];
		$this->coh_id=$_SESSION[coh_id];
		$this->mod_id=$_SESSION[mod_id];
		$this->reg_id=$_SESSION[reg_id];
		$this->esp_id=$_SESSION[esp_id];
		$this->pen_top=$_SESSION[pen_top];
		$this->ci_est=$_SESSION[ci_est];
	/*	echo "<script>alert('SELECT * FROM pacade WHERE pac_sta=1 AND pac_id=$this->pac_id');</script>";*/
	  $proc_pac=$this->OperacionCualquiera("SELECT * FROM pacade WHERE pac_sta='1' AND pac_id='$this->pac_id'");
	  $dat_pac=$this->ConsultarCualquiera($proc_pac);
	/*  echo "<script>alert('SELECT det_con FROM detins WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND asi_cod=$asi_cod AND det_sta=1 AND ci_est=$this->ci_est AND det_con=1 AND pac_id NOT IN (SELECT pac_id FROM pacade WHERE pac_sta=1 AND DATEDIFF(pac_ffin,$dat_pac->pac_ffin)>=0)');</script>";*/
/*if($this->ci_est=='20627760' && ($asi_cod=='AGL-36143' || $asi_cod=='AGL-36133'))  echo "<script>alert('SELECT det_con FROM detins WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND asi_cod=$asi_cod AND det_sta=1 AND ci_est=$this->ci_est AND det_con=1 AND pac_id NOT IN (SELECT pac_id FROM pacade WHERE pac_sta=1 AND DATEDIFF(pac_ffin,$dat_pac->pac_ffin)>=0)');</script>";*/
		$resul=$this->OperacionCualquiera("SELECT det_con FROM detins WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$asi_cod' AND det_sta='1' AND ci_est='$this->ci_est' AND det_con='1' AND pac_id NOT IN (SELECT pac_id FROM pacade WHERE pac_sta='1' AND DATEDIFF(pac_ffin,'$dat_pac->pac_ffin')>=0)");
		return $resul;
	}
	//******************************************************************
	function Buscar_Requisito($asi_cod){
		$this->pac_id=$_SESSION[pac_id];
		$this->coh_id=$_SESSION[coh_id];
		$this->mod_id=$_SESSION[mod_id];
		$this->reg_id=$_SESSION[reg_id];
		$this->esp_id=$_SESSION[esp_id];
		$this->pen_top=$_SESSION[pen_top];
/*	if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('Buscar_Asignatura REQUISITO $asi_cod,$this->mod_id,$this->reg_id,$this->esp_id,$this->coh_id,$this->pen_top');</script>";*/
		$resul=$this->OperacionCualquiera("SELECT asi_cod_req, req_cuc FROM requis WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$asi_cod' AND req_sta='1' AND req_tip='1'");
/*	if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('SELECT asi_cod_req, req_cuc FROM requis WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND asi_cod=$asi_cod AND req_sta=1 AND req_tip=1');</script>";*/
		return $resul;
	}
	//******************************************************************
	function Suma_UC_Aprobadas(){
		$this->pac_id=$_SESSION[pac_id];
		$this->coh_id=$_SESSION[coh_id];
		$this->mod_id=$_SESSION[mod_id];
		$this->reg_id=$_SESSION[reg_id];
		$this->esp_id=$_SESSION[esp_id];
		$this->pen_top=$_SESSION[pen_top];
		$this->ci_est=$_SESSION[ci_est];
	  $proc_pac=$this->OperacionCualquiera("SELECT * FROM pacade WHERE pac_sta='1' AND pac_id='$this->pac_id'");
	  $dat_pac=$this->ConsultarCualquiera($proc_pac);
	/*  echo "<script>alert('Buscar_Asignatura REQUISITO $asi_cod,$this->mod_id,$this->reg_id,$this->esp_id,$this->coh_id,$this->pen_top');</script>";*/
	/*  echo "<script>alert('SELECT SUM( A.asi_cuc ) AS suma_uc_apr FROM asigna A, detins B WHERE B.ci_est = $this->ci_est AND B.det_sta = 1 AND B.det_con = 1 AND A.asi_cod = B.asi_cod AND A.mod_id = B.mod_id AND A.reg_id = B.reg_id AND A.esp_id = B.esp_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.asi_sta = 1 AND A.mod_id = $this->mod_id AND A.reg_id = $this->reg_id AND A.esp_id = $this->esp_id AND A.coh_id = $this->coh_id AND A.pen_top = $this->pen_top AND pac_id NOT IN (SELECT pac_id FROM pacade WHERE pac_sta=1 AND DATEDIFF(pac_ffin,$dat_pac->pac_ffin)>=0)');</script>";*/
		$resul=$this->OperacionCualquiera("SELECT SUM( A.asi_cuc ) AS suma_uc_apr FROM asigna A, `detins` B WHERE B.`ci_est` = '$this->ci_est' AND B.`det_sta` = '1' AND B.`det_con` = '1' AND A.asi_cod = B.asi_cod AND A.mod_id = B.mod_id AND A.reg_id = B.reg_id AND A.esp_id = B.esp_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.asi_sta = '1' AND A.mod_id = '$this->mod_id' AND A.reg_id = '$this->reg_id' AND A.esp_id = '$this->esp_id' AND A.coh_id = '$this->coh_id' AND A.pen_top = '$this->pen_top' AND pac_id NOT IN (SELECT pac_id FROM pacade WHERE pac_sta='1' AND DATEDIFF(pac_ffin,'$dat_pac->pac_ffin')>=0)");
		return $resul;
	}
	//******************************************************************
	function Buscar_Co_Requisito($asi_cod){
		$this->pac_id=$_SESSION[pac_id];
		$this->coh_id=$_SESSION[coh_id];
		$this->mod_id=$_SESSION[mod_id];
		$this->reg_id=$_SESSION[reg_id];
		$this->esp_id=$_SESSION[esp_id];
		$this->pen_top=$_SESSION[pen_top];
	/*if($this->ci=='24612599')  echo "<script>alert('Buscar_Asignatura co-requisito $asi_cod,$this->mod_id,$this->reg_id,$this->esp_id,$this->coh_id,$this->pen_top');</script>";*/
		$resul=$this->OperacionCualquiera("SELECT asi_cod_req FROM requis WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$asi_cod' AND req_sta='1' AND req_tip='0'");
		return $resul;
	}
	 //******************************************************************
	function Buscar_Asig_Oferta($asi_cod){
		$this->pac_id=$_SESSION[pac_id];
		$this->coh_id=$_SESSION[coh_id];
		$this->mod_id=$_SESSION[mod_id];
		$this->reg_id=$_SESSION[reg_id];
		$this->esp_id=$_SESSION[esp_id];
		$this->pen_top=$_SESSION[pen_top];
	/*if($this->ci=='23548519' && $asi_cod=='CIV-30314') echo "<script>alert('Buscar_Asignatura $asi_cod,$this->mod_id,$this->reg_id,$this->esp_id,$this->coh_id,$this->pen_top, $this->pac_id');</script>";*/
		$resul=$this->OperacionCualquiera("SELECT * FROM asigna_seccio WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND pac_id='$this->pac_id' AND ase_sta='1' AND asi_cod='$asi_cod'");
		return $resul;
	}
	//******************************************************************
	  function Ciclo($asi_cod,$revisado){
		$asi="";
		$requisi=$this->Buscar_Requisito($asi_cod);
		$cant_requi=$this->NumFilasCualquiera($requisi);
		$cant_req_apro=0;
	/*	if($this->ci=='23548519' && $asi_cod=='CIV-30314') echo "<script>alert('CANTIDAD DE REQUISITOS $cant_requi');</script>";*/
		while($array_requi=$this->ConsultarCualquiera($requisi)){//REVISAR CADA REQUISITO SI ESTA APROBADO
/*		  if($this->ci=='20627760' && $asi_cod=='AGL-36113') echo "<script>alert('ENTRE A REVISAR CADA REQUISITO SI ESTA APROBADO $array_req->asi_cod_req');</script>";*/
		  $requi_cond=$this->Buscar_Cond_Asig($array_requi->asi_cod_req);
		  $cant_req_tr=$this->NumFilasCualquiera($requi_cond);
		  if($cant_req_tr>0){
			$cant_req_apro=$cant_req_apro+1;
		  }
		  else{
		    if($array_requi->req_cuc!=""){		    
			  $resultado_UC=$this->ConsultarCualquiera($this->Suma_UC_Aprobadas());
			  if($resultado_UC->suma_uc_apr>=$array_requi->req_cuc && $resultado_UC->suma_uc_apr!='' && $resultado_UC->req_cuc!=''){
			    $cant_req_apro=$cant_req_apro+1;
			  }
			}
		  }
		}
/*	if($this->ci=='20627760' && $asi_cod=='AGL-36113') echo "<script>alert('COMPARAR CANT REQUISITOS $cant_requi==$cant_req_apro');</script>";*/
		if($cant_requi==$cant_req_apro){
		  $co_requisi=$this->Buscar_Co_Requisito($asi_cod);
		  $cant_co_requi=$this->NumFilasCualquiera($co_requisi);
		  $cant_co_req_apro=0;
	/*if($this->ci=='23548519' && $asi_cod='CIV-30314') echo "<script>alert('CANTIDAD DE CO-REQUISITOS $cant_co_requi');</script>";*/
		  while($array_co_requi=$this->ConsultarCualquiera($co_requisi)){//REVISAR CADA CO-REQUISITO SI ESTA APROBADO O OFERTADO.
	/*if($this->ci=='23548519' && $asi_cod=='CIV-30314') echo "<script>alert('ENTRE A REVISAR CADA CO-REQUISITO SI ESTA APROBADO O OFERTADO $array_co_req->asi_cod_req');</script>";*/
			$co_requi_cond=$this->Buscar_Cond_Asig($array_co_requi->asi_cod_req);
			$cant_co_req_tr=$this->NumFilasCualquiera($co_requi_cond);
	/*if($this->ci=='23548519' && $asi_cod=='CIV-30314') echo "<script>alert('CO $array_co_requi->asi_cod_req: $cant_co_req_tr>0');</script>";*/
			if($cant_co_req_tr>0){//REVISAR CADA CO-REQUISITO SI ESTA APROBADO
			  $cant_co_req_apro=$cant_co_req_apro+1;
			}
			else{ //REVISAR CADA CO-REQUISITO SI ESTA OFERTADO Y LA PUEDE VER
	/*if($this->ci=='23548519' && $asi_cod=='CIV-30314')  echo "<script>alert('$array_oferta->asi_cod REVISAR CADA CO-REQUISITO SI ESTA OFERTADO Y LA PUEDE VER');</script>";*/
			  $co_req_asi_ofert=$this->Buscar_Asig_Oferta($array_co_requi->asi_cod_req);
			  $cant_co_req_asi_ofert=$this->NumFilasCualquiera($co_req_asi_ofert);
	/*if($this->ci=='23548519' && $asi_cod=='CIV-30314')  echo "<script>alert('$cant_co_req_asi_ofert>0');</script>";*/
			  if($cant_co_req_asi_ofert>0){//REVISAR SI EL CORREQUISITO LO PUEDE VER
	/*if($this->ci=='23548519' && $asi_cod=='CIV-30314')  echo "<script>alert('$revisado!=$array_co_requi->asi_cod_req');</script>";*/
				if($revisado!=$array_co_requi->asi_cod_req){
				  $resul=$this->Ciclo($array_co_requi->asi_cod_req,$asi_cod);
				  if($resul!=""){
					$cant_co_req_apro=$cant_co_req_apro+1;
				  }
				}
				else{
				  $cant_co_req_apro=$cant_co_req_apro+1;
				}
			  }
			}
		  }
	/*if($this->ci=='23548519' && $asi_cod=='CIV-30314') echo "<script>alert('COMPARAR CO-REQUISITO $cant_co_requi==$cant_co_req_apro');</script>";*/
		  if($cant_co_requi<=$cant_co_req_apro){
	/*if($this->ci=='23548519' && $asi_cod=='CIV-30314') echo "<script>alert('COMPARAR SI ES SIN REQUISITO $cant_req_apro==0 && $cant_co_req_apro==0');</script>";*/
			if($cant_req_apro==0 && $cant_co_req_apro==0){
			  $asi_sin_requi=$this->Buscar_Asi_Sin_Requisito($asi_cod);
			  $cant_sin_requi=$this->NumFilasCualquiera($asi_sin_req);
			  $cant_sin_req_apro=0;
			  $cant_sin_requi=0;
	/*if($this->ci=='23548519' && $asi_cod=='CIV-30314') echo "<script>alert('CANTIDAD SIN REQUISITOS $cant_sin_requi, $cant_sin_req_apro');</script>";*/
			  while($array_sin_req=$this->ConsultarCualquiera($asi_sin_requi)){//REVISAR CADA ASIGNATURA SIN REQUISITO SI ESTA APROBADO
	/*if($this->ci=='23548519' && $asi_cod=='CIV-30314') echo "<script>alert('ENTRE A REVISAR CADA ASIGNATURA SIN REQUISITO SI ESTA APROBADO $array_sin_req->asi_cod');</script>";*/
				$sin_requi_cond=$this->Buscar_Cond_Asig($array_sin_req->asi_cod);
				$cant_sin_req_tr=$this->NumFilasCualquiera($sin_requi_cond);
				if($cant_sin_req_tr>0){
				  $cant_sin_req_apro++;
				}
				$cant_sin_requi++;
	/*if($this->ci=='23548519' && $asi_cod=='CIV-30314') echo "<script>alert('CANTIDAD DE ASIGNATURA SIN REQUISITO APROBADA $cant_sin_req_apro');</script>";*/
			  }
	/*if($this->ci=='23548519' && $asi_cod=='CIV-30314') echo "<script>alert(COMPARAR SIN REQUISITO $cant_sin_requi==$cant_sin_req_apro');</script>";*/
			  if($cant_sin_requi==$cant_sin_req_apro){ //SI TODO ESTA APROBADO GUARDAR EN LA LISTA A MOSTRAR
				$asi=$asi_cod;
			  }
			  else
				$asi="";
			}
			else{
			  $asi=$asi_cod;
			}
		  }
		}
	/*if($this->ci=='23548519' && $asi_cod=='CIV-30314') echo "<script>alert('RETORNA $asi');</script>";*/
		return $asi;
	  }
	//******************************************************************
	function Buscar_Asi_Sin_Requisito($asi_cod){
		$this->pac_id=$_SESSION[pac_id];
		$this->coh_id=$_SESSION[coh_id];
		$this->mod_id=$_SESSION[mod_id];
		$this->reg_id=$_SESSION[reg_id];
		$this->esp_id=$_SESSION[esp_id];
		$this->pen_top=$_SESSION[pen_top];
	/*if(($asi_cod=='02' || $asi_cod=='ADG-34143') && $this->ci=='14605972'){  echo "<script>alert('SELECT asi_cod, asi_mod, asi_cba FROM asigna WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND asi_sta=1 AND asi_cod NOT IN(SELECT asi_cod FROM requis WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND req_sta=1) AND asi_mod<(SELECT asi_mod FROM asigna WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND asi_sta=1 AND asi_cod=$asi_cod) AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE (DIN%)) AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE (IMI%)) AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE (ADG-1082%) AND asi_sta= 1 AND asi_nom LIKE (CATEDRA%)) AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE (ACO-0000%) AND asi_sta= 1 AND asi_nom LIKE (ACTIVIDAD%)) AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE (DEP-0000%) AND asi_sta= 1 AND asi_nom LIKE (DEPORTE%))');</script>";}*/
		$resul=$this->OperacionCualquiera("SELECT asi_cod, asi_mod, asi_cba FROM asigna WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_sta='1' AND asi_cod NOT IN(SELECT asi_cod FROM requis WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND req_sta='1') AND asi_mod<(SELECT asi_mod FROM asigna WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_sta='1' AND asi_cod='$asi_cod') AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE ('DIN%')) AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE ('IMI%')) AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE ('ADG-1082%') AND asi_sta= '1' AND asi_nom LIKE ('CATEDRA%')) AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE ('ACO-0000%') AND asi_sta= '1' AND asi_nom LIKE ('ACTIVIDAD%')) AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE ('DEP-0000%') AND asi_sta= '1' AND asi_nom LIKE ('DEPORTE%'))");
		return $resul;
	}
	//******************************************************************
	function Buscar_Asig_Ins($asi_cod){
		$this->pac_id=$_SESSION[pac_id];
		$this->coh_id=$_SESSION[coh_id];
		$this->mod_id=$_SESSION[mod_id];
		$this->reg_id=$_SESSION[reg_id];
		$this->esp_id=$_SESSION[esp_id];
		$this->ci_est=$_SESSION[ci_est];
		$this->pen_top=$_SESSION[pen_top];
	/*echo "<script>alert('SELECT det_id FROM detins WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND det_sta=1 AND asi_cod=$asi_cod AND pac_id=$this->pac_id AND ci_est=$this->ci_est');</script>";	*/
		$resul=$this->OperacionCualquiera("SELECT det_id FROM detins WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND det_sta='1' AND asi_cod='$asi_cod' AND pac_id='$this->pac_id' AND ci_est='$this->ci_est'");	
		return $resul;
	}
	//******************************************************************
	  function Inscripcion_Semestre_pacade($viejo_discente,$pac_id){
		$this->ci=$this->ci_est==$_SESSION[ci_est];
		$this->pac_id=$_SESSION[pac_id]=$pac_id;
		$this->coh_id=$_SESSION[coh_id];
		$this->mod_id=$_SESSION[mod_id];
		$this->reg_id=$_SESSION[reg_id];
		$this->esp_id=$_SESSION[esp_id];
		$this->pen_top=$_SESSION[pen_top];
	/*	echo "<script>alert('Inscripcion_Semestre_pacade $this->ci, $this->pac_id, $this->coh_id, $this->mod_id, $this->reg_id, $this->esp_id, $this->pen_top');</script>";*/
	//	$resp_ultimo=$this->Listado_Pacade3();
	//	$resp_todo=$this->Listado_Pacade_Todos();
	//	$pac_ant=$this->ConsultarCualquiera($resp_ultimo);
	//	$pac_tod=$this->ConsultarCualquiera($resp_todo);
	//	$PAC_ULTI=explode("-",$pac_tod->pac_id);//explode("-",'I-12011');
		$lis_asi_ofer='';
		$lis_asi_ofer1='';
	//	if($pac_ant->pac_id==$PAC_ULTI[1]){//REVISAR SI SE INSCRIBIO EN EL PERIODO ACADÉMICO ANTERIOR
		$oferta=$this->Buscar_Oferta($viejo_discente);
		while($array_oferta=$this->ConsultarCualquiera($oferta)){
/*  	  echo "<script>alert('ENTRE A REVISAR CADA ASIGNATURA $array_oferta->asi_cod');</script>";*/
	/*if($this->ci=='23548519' && $array_oferta->asi_cod=='CIV-30144') echo "<script>alert('ENTRE A REVISAR CADA ASIGNATURA $array_oferta->asi_cod');</script>";*/
		  $mat_ins=$this->Buscar_Asig_Ins($array_oferta->asi_cod);
		  $ins_asi=$this->NumFilasCualquiera($mat_ins);
		  $asi_cod=$array_oferta->asi_cod;
/*	if($this->ci=='20627760' && $array_oferta->asi_cod=='AGL-36143')  echo "<script>alert('Filas Buscar_Asig_Ins $array_oferta->asi_cod: $ins_asi ');</script>";*/
		  if($ins_asi==0){
			$mat_apro=$this->Buscar_Cond_Asig($array_oferta->asi_cod);
			$apro=$this->NumFilasCualquiera($mat_apro);
	/*	  echo "<script>alert('Filas Buscar_Cond_Asig: $apro ');</script>";*/
/*	if($this->ci=='20627760' && $array_oferta->asi_cod=='AGL-36143') echo "<script>alert('CONDICION DE APROBADA $array_oferta->asi_cod $apro');</script>";*/
			if($apro==0){ //ASIGNATURA NO APROBADA O NO VISTA
/*	if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('ASIGNATURA NO APROBADA O NO VISTA $array_oferta->asi_cod');</script>";*/
			  $requi=$this->Buscar_Requisito($array_oferta->asi_cod);
			  $cant_req=$this->NumFilasCualquiera($requi);
			  $cant_req_apr=0;
/*	if($this->ci=='20627760' && $array_oferta->asi_cod=='AGL-36143') echo "<script>alert('Filas Buscar_Requisito $array_oferta->asi_cod: $cant_req, $cant_req_apr');</script>";*/
	/*if($this->ci=='23548519' && $array_oferta->asi_cod=='CIV-30144') echo "<script>alert('CANTIDAD DE REQUISITOS $cant_req, $cant_req_apr');</script>";*/
	$prueba_i=0;
			  while($array_req=$this->ConsultarCualquiera($requi)){//REVISAR CADA REQUISITO SI ESTA APROBADO
			  	$prueba_i++;
/*	if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('$prueba_i, ENTRE A REVISAR CADA REQUISITO SI ESTA APROBADO $array_oferta->asi_cod: $array_req->asi_cod_req');</script>";*/
	/*	  echo "<script>alert('Buscar aprobacion de cada requisito: $array_req->asi_cod_req');</script>";*/
				$requi_con=$this->Buscar_Cond_Asig($array_req->asi_cod_req);
				$cant_req_t=$this->NumFilasCualquiera($requi_con);
	/*	  echo "<script>alert('Filas Buscar aprobacion de cada requisito: $cant_req_t');</script>";*/
/*	if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('REQUISITO APROBADO ANTES DEL IF $array_oferta->asi_cod: $array_req->asi_cod_req:  Aprobado=$cant_req_t, $cant_req_apr');</script>";*/
				if($cant_req_t>0){
				  $cant_req_apr=$cant_req_apr+1;
/*	if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('aprobo el requisito $cant_req_apr');</script>";*/
				}
				else{	
/*	if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('REQUISITO POR UC: $array_oferta->asi_cod=> $array_req->req_cuc');</script>";*/
				  if($array_req->req_cuc!=""){
/*	if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('ENTRE A COMPARAR UC 1');</script>";*/
				    $resul_UC=$this->ConsultarCualquiera($this->Suma_UC_Aprobadas());
/*	if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('ENTRE A COMPARAR UC 2 $resul_UC->suma_uc_apr>=$array_req->req_cuc && $resul_UC->suma_uc_apr!=');</script>";*/
				    if($resul_UC->suma_uc_apr>=$array_req->req_cuc && $resul_UC->suma_uc_apr!='' && $resul_UC->req_cuc!=''){
				      $cant_req_apr=$cant_req_apr+1;
				    }
				  }
				}
/*	if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('REQUISITO APROBADO DESPUES DEL IF $array_oferta->asi_cod: $array_req->asi_cod_req:  $cant_req_t, $cant_req_apr');</script>";*/
			  }
/*	if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('COMPARAR CANT REQUISITOS $array_oferta->asi_cod $cant_req==$cant_req_apr <=> $prueba_i==$cant_req_apr');</script>";*/
			  if($cant_req==$cant_req_apr){
				$co_requi=$this->Buscar_Co_Requisito($array_oferta->asi_cod);
				$cant_co_req=$this->NumFilasCualquiera($co_requi);
				$cant_co_req_apr=0;
/*	if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('CANTIDAD DE CO-REQUISITOS $array_oferta->asi_cod: $cant_co_req');</script>";*/
				while($array_co_req=$this->ConsultarCualquiera($co_requi)){//REVISAR CADA CO-REQUISITO SI ESTA APROBADO O OFERTADO.
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('ENTRE A REVISAR CADA CO-REQUISITO SI ESTA APROBADO O OFERTADO $asi_cod->$array_oferta->asi_cod: $array_co_req->asi_cod_req');</script>";*/
				  $co_requi_con=$this->Buscar_Cond_Asig($array_co_req->asi_cod_req);
				  $cant_co_req_t=$this->NumFilasCualquiera($co_requi_con);
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('CO $asi_cod->$array_oferta->asi_cod -> $array_co_req->asi_cod_req: $cant_co_req_t>0');</script>";*/
				  if($cant_co_req_t>0){//REVISAR CADA CO-REQUISITO SI ESTA APROBADO
					$cant_co_req_apr++;
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('APROBO EL CO-REQUISITO $asi_cod->$array_oferta->asi_cod -> $array_co_req->asi_cod_req: $cant_co_req_t>0');</script>";*/
				  }
				  else{ //REVISAR CADA CO-REQUISITO SI ESTA OFERTADO Y LA PUEDE VER
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('REVISAR CADA CO-REQUISITO SI ESTA OFERTADO Y LA PUEDE VER $array_oferta->asi_cod -> $array_co_req->asi_cod_req');</script>";*/
					$co_req_asi_ofer=$this->Buscar_Asig_Oferta($array_co_req->asi_cod_req);
					$cant_co_req_asi_ofer=$this->NumFilasCualquiera($co_req_asi_ofer);
					if($cant_co_req_asi_ofer>0){//REVISAR SI EL CORREQUISITO LO PUEDE VER
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('$array_oferta->asi_cod -> $array_co_req->asi_cod_req ESTA OFERTADA PERO HAY QUE REVISAR SI EL CORREQUISITO LO PUEDE VER');</script>";*/
					   $resul=$this->Ciclo($array_co_req->asi_cod_req,$array_oferta->asi_cod);
					   if($resul!="")
						 $cant_co_req_apr++;
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('$array_oferta->asi_cod -> $array_co_req->asi_cod_req ESTA OFERTADA y PUEDE VER EL CORREQUISITO');</script>";*/
					}
				  }
				}
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('$array_oferta->asi_cod COMPARAR CO-REQUISITO $cant_co_req==$cant_co_req_apr');</script>";*/
				if($cant_co_req==$cant_co_req_apr){
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('$array_oferta->asi_cod COMPARAR SE ES SIN REQUISITO $cant_req_apr==0 && $cant_co_req_apr==0');</script>";*/
				  if($cant_req_apr==0 && $cant_co_req_apr==0){
					$asi_sin_req=$this->Buscar_Asi_Sin_Requisito($array_oferta->asi_cod);
					$cant_sin_req=$this->NumFilasCualquiera($asi_sin_req);
					$cant_sin_req_apr=0;
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('$array_oferta->asi_cod CANTIDAD SIN REQUISITOS $cant_sin_req');</script>";*/
					while($array_sin_req=$this->ConsultarCualquiera($asi_sin_req)){//REVISAR CADA ASIGNATURA SIN REQUISITO SI ESTA APROBADO
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('ENTRE A REVISAR CADA CADA ASIGNATURA SIN REQUISITO SI ESTA APROBADO $array_oferta->asi_cod-> $array_sin_req->asi_cod');</script>";*/
					  $sin_requi_con=$this->Buscar_Cond_Asig($array_sin_req->asi_cod);
					  $cant_sin_req_t=$this->NumFilasCualquiera($sin_requi_con);
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('ENTRE A REVISAR CADA CADA ASIGNATURA SIN REQUISITO SI ESTA APROBADO $array_oferta->asi_cod -> $array_sin_req->asi_cod $cant_sin_req_t>0');</script>";*/
					  if($cant_sin_req_t>0){
						$cant_sin_req_apr++;
					  }
					}
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('COMPARAR SIN REQUISITO $array_oferta->asi_cod: $cant_sin_req==$cant_sin_req_apr');</script>";*/
					if($cant_sin_req==$cant_sin_req_apr){ //SI TODO ESTA APROBADO GUARDAR EN LA LISTA A MOSTRAR
					  if($lis_asi_ofer==''){
						$lis_asi_ofer1="".$array_oferta->asi_cod."";
						$lis_asi_ofer="'".$array_oferta->asi_cod."'";
					  }
					  else{
						$lis_asi_ofer1="".$lis_asi_ofer1.",".$array_oferta->asi_cod;
						$lis_asi_ofer="".$lis_asi_ofer.",'".$array_oferta->asi_cod."'";
					  }
	/*if($this->ci=='20792053' && $array_oferta->asi_cod=='MAT-31214') echo "<script>alert('LISTA: $array_oferta->asi_cod');</script>";*/
					}
				  }
				  else{
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('LISTA_DE_OFERTA TOTAL ANTES: $lis_asi_ofer1');</script>";*/
					if($lis_asi_ofer==''){
					  $lis_asi_ofer1="".$array_oferta->asi_cod."";
					  $lis_asi_ofer="'".$array_oferta->asi_cod."'";
					}
					else{
					  $lis_asi_ofer1="".$lis_asi_ofer1.",".$array_oferta->asi_cod;
					  $lis_asi_ofer="".$lis_asi_ofer.",'".$array_oferta->asi_cod."'";
					}
				  }
/*if($this->ci=='20627760' && $asi_cod=='AGL-36143') echo "<script>alert('LISTA_DE_OFERTA DESPUES: $lis_asi_ofer1');</script>";*/
				}
			  }
			}
		  }
		}
		return $lis_asi_ofer;
	  }
	 //******************************************************************
	function Buscar_Asignaturas_ofertadas($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
/*	echo "<script>alert('Buscar_Asignaturas_ofertadas: SELECT * FROM asigna WHERE asi_cod IN($asi_cod) AND mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND coh_id=$coh_id AND pen_top=$pen_top ORDER BY asi_mod,asi_nom');</script>";*/
		$resul=$this->OperacionCualquiera("SELECT * FROM asigna WHERE asi_cod IN($asi_cod) AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' ORDER BY asi_mod,asi_nom");
		return $resul;
	}
	//******************************************************************
	  function Buscar_UC_Maxima($mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
	/*echo "<script>alert('SELECT * FROM pensum WHERE mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND coh_id=$coh_id AND pen_top=$pen_top');</script>";*/
		$resul=$this->OperacionCualquiera("SELECT * FROM pensum WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top'");
		$UC_max=$this->ConsultarCualquiera($resul);
		return $UC_max->pen_muc;
	  }
	//******************************************************************
	  function Buscar_Seccion_Ofertadas($asi_cod,$pac_id){
		$this->pac_id=$_SESSION[pac_id];
		$this->coh_id=$_SESSION[coh_id];
		$this->mod_id=$_SESSION[mod_id];
		$this->reg_id=$_SESSION[reg_id];
		$this->esp_id=$_SESSION[esp_id];
		$this->pen_top=$_SESSION[pen_top];
	/*echo "<script>alert('SELECT DISTINCT(E.sec_id) AS sec_id, C.sec_nom AS sec_nom, C.inf_id AS inf_id, D.inf_nom AS inf_nom, E.ase_cma AS ase_cma FROM seccio C, infrae D, asigna_seccio E WHERE E.ase_sta=1 AND E.asi_cod=$asi_cod AND E.esp_id=$this->esp_id AND E.coh_id=$this->coh_id AND E.mod_id=$this->mod_id AND E.reg_id=$this->reg_id AND E.pen_top=$this->pen_top AND E.pac_id=$pac_id AND E.sec_id=C.sec_id AND C.inf_id=D.inf_id ORDER BY C.sec_nom,D.inf_nom');</script>";*/
		$resul=$this->OperacionCualquiera("SELECT DISTINCT(E.sec_id) AS 'sec_id', C.sec_nom AS 'sec_nom', C.inf_id AS 'inf_id', D.inf_nom AS 'inf_nom', E.ase_cma AS 'ase_cma' FROM seccio C, infrae D, asigna_seccio E WHERE E.ase_sta='1' AND E.asi_cod='$asi_cod' AND E.esp_id='$this->esp_id' AND E.coh_id='$this->coh_id' AND E.mod_id='$this->mod_id' AND E.reg_id='$this->reg_id' AND E.pen_top='$this->pen_top' AND E.pac_id='$pac_id' AND E.sec_id=C.sec_id AND C.inf_id=D.inf_id ORDER BY C.sec_nom,D.inf_nom");
		$num_filas=$this->NumFilasCualquiera($resul);
		return $resul;
	  }  
	//******************************************************************
	  function Buscar_ase_id($asi_cod,$pac_id,$sec_id){
	/*echo "<script>alert('SELECT ase_id FROM asigna_seccio WHERE pac_id=$pac_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND mod_id=$this->mod_id AND reg_id=$this->reg_id AND asi_cod=$asi_cod AND ase_sta=1 AND sec_id=$sec_id AND pen_top=$this->pen_top');</script>";*/
		$resul=$this->OperacionCualquiera("SELECT ase_id FROM asigna_seccio WHERE pac_id='$pac_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND asi_cod='$asi_cod' AND ase_sta='1' AND sec_id='$sec_id' AND pen_top='$this->pen_top'");
		$ase_id=$this->ConsultarCualquiera($resul);
		return $ase_id->ase_id;
	  }
	//******************************************************************
	  function Buscar_INS_Seccion_Ofertadas($asi_cod,$pac_id,$asi_cba,$sec_id){
		$this->pac_id=$_SESSION[pac_id];
		$this->coh_id=$_SESSION[coh_id];
		$this->mod_id=$_SESSION[mod_id];
		$this->reg_id=$_SESSION[reg_id];
		$this->esp_id=$_SESSION[esp_id];
		$this->pen_top=$_SESSION[pen_top];
		$ase_id=$this->Buscar_ase_id($asi_cod,$pac_id,$sec_id);
	/*echo "<script>alert('SELECT COUNT(A.det_id) AS INSCRITOS FROM detins A, asigna_seccio B WHERE A.pac_id=$pac_id AND A.pac_id=B.pac_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.asi_cod=B.asi_cod AND A.det_sta=1 AND A.sec_id=B.sec_id AND A.pen_top=B.pen_top AND B.ase_sta=1 AND B.ase_id=$ase_id');</script>";*/
		$resul=$this->OperacionCualquiera("SELECT COUNT(A.det_id) AS 'INSCRITOS' FROM detins A, asigna_seccio B WHERE A.pac_id='$pac_id' AND A.pac_id=B.pac_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.asi_cod=B.asi_cod AND A.det_sta='1' AND A.sec_id=B.sec_id AND A.pen_top=B.pen_top AND B.ase_sta='1' AND B.ase_id='$ase_id'");
		$num_filas=$this->NumFilasCualquiera($resul);
		$inscritos=$this->ConsultarCualquiera($resul);
	/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
		return $inscritos;
	  }
	
	//******************************************************************
	  function REPROBADAS_ASIGNATURAS($asi_cod,$ci,$pac_id){
	//  $ci=$_SESSION[ci_est];
	/*  echo "<script>alert('SELECT det_id FROM detins WHERE mod_id=$_SESSION[mod_id] AND reg_id=$_SESSION[reg_id] AND esp_id=$_SESSION[esp_id] AND coh_id=$_SESSION[coh_id] AND pen_top=$_SESSION[pen_top] AND asi_cod=$asi_cod AND ci_est=$ci AND det_sta=1 AND det_con=0 AND pac_id IN (SELECT pac_id FROM pacade WHERE pac_id='$pac_id' AND pac_sta=1 ORDER BY pac_ffin DESC)');</script>";*/
		$resultado1=$this->OperacionCualquiera("SELECT det_id FROM detins WHERE mod_id='$_SESSION[mod_id]' AND reg_id='$_SESSION[reg_id]' AND esp_id='$_SESSION[esp_id]' AND coh_id='$_SESSION[coh_id]' AND pen_top='$_SESSION[pen_top]' AND asi_cod='$asi_cod' AND ci_est='$ci' AND det_sta='1' AND det_con='0' AND pac_id IN (SELECT pac_id FROM pacade WHERE pac_id='$pac_id' AND pac_sta='1' ORDER BY pac_ffin DESC)");
		$filas=$this->NumFilasCualquiera($resultado1);
		if($filas>0)
		  return 1;
		else
		  return 0;
	  }
	//******************************************************************
	  function Buscar_Electiva($asi,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
	/*  echo "<script>alert('SELECT B.ele_nom AS ele_nom FROM asigna_seccio A, electi B WHERE A.mod_id=$mod_id AND A.reg_id=$reg_id AND A.esp_id=$esp_id AND A.coh_id=$coh_id AND A.pen_top=$pen_top AND A.ele_cod=B.ele_cod AND A.asi_cod=$asi AND A.pac_id=$pac_id');</script>";*/
		$resul=$this->OperacionCualquiera("SELECT B.ele_nom AS 'ele_nom' FROM asigna_seccio A, electi B WHERE A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.ele_cod=B.ele_cod AND A.asi_cod='$asi' AND A.pac_id='$pac_id'");
		$Elec=$this->ConsultarCualquiera($resul);
	/*	echo "<script>alert('ELECTIVA: ');</script>";*/
		$NOM=explode("(",$Elec->ele_nom);
		return $NOM[0];
	  }
	//******************************************************************
	function Buscar_Re_Co_Materia($asi_cod){
		$this->pac_id=$_SESSION[pac_id];
		$this->coh_id=$_SESSION[coh_id];
		$this->mod_id=$_SESSION[mod_id];
		$this->reg_id=$_SESSION[reg_id];
		$this->esp_id=$_SESSION[esp_id];
		$this->pen_top=$_SESSION[pen_top];
	/*  echo "<script>alert('SELECT asi_cod_req,req_tip,req_cuc FROM requis WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND asi_cod=$asi_cod AND req_sta=1');</script>";*/
		$resul=$this->OperacionCualquiera("SELECT asi_cod_req,req_tip,req_cuc FROM requis WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$asi_cod' AND req_sta='1'");
		return $resul;
	}
	
	//******************************************************************
	function Buscar_Asig_Ins_UC(){
		$this->pac_id=$_SESSION[pac_id];
		$this->coh_id=$_SESSION[coh_id];
		$this->mod_id=$_SESSION[mod_id];
		$this->reg_id=$_SESSION[reg_id];
		$this->esp_id=$_SESSION[esp_id];
		$this->ci_est=$_SESSION[ci_est];
		$this->pen_top=$_SESSION[pen_top];
	/*echo "<script>alert('SELECT SUM(B.asi_cuc) AS UC FROM detins A, asigna B WHERE A.mod_id=$this->mod_id AND A.reg_id=$this->reg_id AND A.esp_id=$this->esp_id AND A.coh_id=$this->coh_id AND A.pen_top=$this->pen_top AND A.det_sta=1 AND A.pac_id=$this->pac_id AND A.ci_est=$this->ci_est AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND B.asi_sta=1');</script>";*/
		$resul=$this->OperacionCualquiera("SELECT SUM(B.asi_cuc) AS UC FROM detins A, asigna B WHERE A.mod_id='$this->mod_id' AND A.reg_id='$this->reg_id' AND A.esp_id='$this->esp_id' AND A.coh_id='$this->coh_id' AND A.pen_top='$this->pen_top' AND A.det_sta='1' AND A.pac_id='$this->pac_id' AND A.ci_est='$this->ci_est' AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND B.asi_sta='1'");
		$fila=$this->NumFilasCualquiera($resul);
		if($fila>0){
		  $array=$this->ConsultarCualquiera($resul);
		  $enviar=$array->UC;
		}
		else
		 $enviar=0;
		return $enviar;
	}
//******************************************************************
function Listar_Obser(){
/*  echo "<script>alert('Buscar_Obser $obs_id');</script>";*/
    $resp=$this->OperacionCualquiera("SELECT * FROM observ WHERE obs_sta='1'");
	return $resp;
}
	//******************************************************************
	}?>