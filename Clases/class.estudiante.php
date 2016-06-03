<?php session_start();
class estudiante extends conec_BD{
 var $ci='';
 var $no1='';
 var $no2='';
 var $ap1='';
 var $ap2='';
 var $res='';
 var $pac_id='';
 var $coh_id='';
 var $mod_id='';
 var $reg_id='';
 var $esp_id='';
 var $pen_top='';
 var $asi_cod='';
 var $sec_id='';
//******************************************************************
 function estudiante($ci,$no1,$no2,$ap1,$ap2){
   $estu= new conec_BD();
   $this->conexion=$estu->conectar_BD();
   $this->ci=$ci;
   $this->no1=$no1;
   $this->no2=$no2;
   $this->ap1=$ap2;
   $this->res="";
	$this->pac_id="";
    $this->coh_id="";
    $this->mod_id="";
    $this->reg_id="";
    $this->esp_id="";
    $this->pen_top="";
	$this->asi_cod="";
	$this->sec_id="";
  }
//******************************************************************
  function Buscar_Estudiante_Apli_reg($cedu,$pac_id){
    $row="";
/*	echo "<script>alert('SELECT DISTINCT(ci_est) AS ci_est FROM apli_reg WHERE pac_id=$pac_id AND ci_est=$cedu');</script>";*/
	 $sql="SELECT DISTINCT(ci_est) AS ci_est FROM apli_reg WHERE pac_id='$pac_id' AND ci_est='$cedu' AND apr_sta='1'"; 
	 $result=mysql_query($sql,$this->conexion);
     $num_filas=mysql_num_rows($result);
/*	echo "<script>alert(' FILA $num_filas');</script>";*/
    return $num_filas;
  }
//******************************************************************
  function Buscar_Estudiante(){
    $row="";
	/*echo "<script>alert('CEDULA= $this->ci');</script>";		*/
//    $this->Operacion("SELECT * FROM usuari WHERE ci='$this->ci' AND usu_pas='$this->passwo'");
	 $sql="SELECT * FROM persona WHERE ci='$this->ci' and sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
     $num_filas=mysql_num_rows($result);
    //$this->Operacion("SELECT * FROM usuari WHERE ci='$ced'");	
    //$num_filas=$this->NumFilas();
    if($num_filas>0)
	  {
      //$row=$this->Consultar();
	  $row=$result;
 	  /*echo "<script>alert('Si: Estudiante $cedu');</script>";  */
	  }
	/*else
	  echo "<script>alert('No consiguio Estudiante');</script>";  */
    return $row;
  }
//******************************************************************
  function Listado_Pacade(){
    $num_filas='';
	$ci=$_SESSION[ci];
    $sql="SELECT DISTINCT(A.pac_id) AS 'pac_id', B.pac_nom AS 'pac_nom' FROM detins A, pacade B, matric C WHERE A.pac_id=B.pac_id AND A.det_sta='1' AND A.ci_est='$ci' AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.reg_id=C.reg_id AND A.esp_id=C.esp_id AND A.pen_top=C.pen_top AND A.ci_est=C.ci AND C.matr_sta='1' AND C.matr_tip='0' ORDER BY B.pac_ffin DESC";
	$resul=mysql_query($sql,$this->conexion);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $resul;
  }
//******************************************************************
  function Listado_Pacade3(){
    $num_filas='';
	$ci=$_SESSION[ci];
    $sql="SELECT DISTINCT(A.pac_id) 'pac_id', A.pac_nom AS 'pac_nom' FROM pacade A, detins B WHERE B.ci_est='$ci' AND A.pac_id=B.pac_id AND A.pac_sta='1' AND B.det_sta='1' ORDER BY pac_fin DESC";
	$resul=mysql_query($sql,$this->conexion);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $resul;
  }
//******************************************************************
  function Listado_Pacade_Todos(){
    $num_filas='';
	 $dias=time();
	$FECHA=date("Y-m-d H:i:s",$dias);
	$ci=$_SESSION['ci'];// '18189380'
/*echo "<script>alert('SELECT A.pac_id AS pac_id, A.pac_nom AS pac_nom, A.pac_int AS pac_int, B.ins_nom AS ins_nom FROM pacade A, inscri B WHERE B.ins_sta=1 AND DATEDIFF($FECHA,B.ins_fin)>=0 AND DATEDIFF(B.ins_fin,$FECHA)>=0 AND A.pac_id=B.pac_id AND A.pac_sta=1');</script>";*/
    $sql="SELECT A.pac_id AS 'pac_id', A.pac_nom AS 'pac_nom', A.pac_int AS 'pac_int', B.ins_nom AS 'ins_nom' FROM pacade A, inscri B, detins C WHERE B.ins_sta='1' AND DATEDIFF('$FECHA',A.pac_fi1)>=0 AND DATEDIFF(A.pac_ff3,'$FECHA')>=0 AND A.pac_id=B.pac_id AND A.pac_sta='1' AND C.ci_est='$this->ci' AND C.pac_id=A.pac_id AND C.det_sta='1' ORDER BY A.pac_fin ASC";
	$resul=mysql_query($sql,$this->conexion);
	$num_filas=mysql_num_rows($resul);
	$array=mysql_fetch_object($resul);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $array;
  }
//******************************************************************
  function Listado_Pacade_Todos5(){
    $num_filas='';
    $sql="SELECT pac_id, pac_nom FROM pacade WHERE pac_sta='1' ORDER BY pac_fin DESC";
	$resul=mysql_query($sql,$this->conexion);
	$num_filas=mysql_num_rows($resul);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $resul;
  }
//******************************************************************
  function Listado_Pacade_Todos6(){
    $num_filas='';
    $sql="SELECT pac_id, pac_nom FROM pacade WHERE pac_sta='1' ORDER BY pac_fin DESC LIMIT 0 , 4";
	$resul=mysql_query($sql,$this->conexion);
	$num_filas=mysql_num_rows($resul);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $resul;
  }
//******************************************************************
  function Listado_Pacade_Todos2(){
    $num_filas='';
	 $dias=time();
	$FECHA=date("Y-m-d H:i:s",$dias);
	$ci=$_SESSION['ci'];// '18189380'
/*echo "<script>alert('SELECT A.pac_id AS pac_id, A.pac_nom AS pac_nom, A.pac_int AS pac_int, B.ins_nom AS ins_nom FROM pacade A, inscri B WHERE B.ins_sta=1 AND DATEDIFF($FECHA,B.ins_fin)>=0 AND DATEDIFF(B.ins_fin,$FECHA)>=0 AND A.pac_id=B.pac_id AND A.pac_sta=1');</script>";*/
    $sql="SELECT A.pac_id AS 'pac_id', A.pac_nom AS 'pac_nom', A.pac_int AS 'pac_int', B.ins_nom AS 'ins_nom' FROM pacade A, inscri B, detins C WHERE B.ins_sta='1' AND TIMEDIFF('$FECHA',A.pac_fin)>=0 AND TIMEDIFF(A.pac_ffin,'$FECHA')>=0 AND TIMEDIFF('$FECHA',B.ins_fin)>=0 AND TIMEDIFF(B.ins_ffi,'$FECHA')>=0 AND A.pac_id=B.pac_id AND A.pac_sta='1' AND C.ci_est='$this->ci' AND C.det_sta='1' AND C.pac_id=A.pac_id ORDER BY A.pac_fin ASC";
	$resul=mysql_query($sql,$this->conexion);
	$num_filas=mysql_num_rows($resul);
	$array=mysql_fetch_object($resul);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $array;
  }
//******************************************************************
  function Listado_Pacade_Todos3(){
    $num_filas='';
	 $dias=time();
	$FECHA=date("Y-m-d H:i:s",$dias);
	$ci=$_SESSION['ci'];// '18189380'
/*echo "<script>alert('SELECT A.pac_id AS pac_id, A.pac_nom AS pac_nom, A.pac_int AS pac_int, B.ins_nom AS ins_nom FROM pacade A, inscri B WHERE B.ins_sta=1 AND DATEDIFF($FECHA,B.ins_fin)>=0 AND DATEDIFF(B.ins_fin,$FECHA)>=0 AND A.pac_id=B.pac_id AND A.pac_sta=1');</script>";*/
    $sql="SELECT A.pac_id AS 'pac_id', A.pac_nom AS 'pac_nom', A.pac_int AS 'pac_int', B.ins_nom AS 'ins_nom' FROM pacade A, inscri B WHERE B.ins_sta='1' AND TIMEDIFF('$FECHA',B.ins_fin)>=0 AND TIMEDIFF(B.ins_ffi,'$FECHA')>=0 AND A.pac_id=B.pac_id AND A.pac_sta='1' ORDER BY B.ins_ffi DESC";
	$resul=mysql_query($sql,$this->conexion);
	$num_filas=mysql_num_rows($resul);
	$array=mysql_fetch_object($resul);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $array;
  }
//******************************************************************
  function Listado_Pacade_Todos4(){
    $num_filas='';
	 $dias=time();
	$FECHA=date("Y-m-d H:i:s",$dias);
	$ci=$_SESSION['ci'];// '18189380'
/*echo "<script>alert('SELECT A.pac_id AS pac_id, A.pac_nom AS pac_nom, A.pac_int AS pac_int, B.ins_nom AS ins_nom FROM pacade A, inscri B WHERE B.ins_sta=1 AND DATEDIFF($FECHA,B.ins_fin)>=0 AND DATEDIFF(B.ins_fin,$FECHA)>=0 AND A.pac_id=B.pac_id AND A.pac_sta=1');</script>";*/
    $sql="SELECT A.pac_id AS 'pac_id', A.pac_nom AS 'pac_nom', A.pac_int AS 'pac_int', B.ins_nom AS 'ins_nom' FROM pacade A, inscri B WHERE B.ins_sta='1' AND TIMEDIFF('$FECHA',A.pac_fin)>=0 AND TIMEDIFF(A.pac_ffin,'$FECHA')>=0 AND TIMEDIFF('$FECHA',B.ins_fin)>=0 AND TIMEDIFF(B.ins_ffi,'$FECHA')>=0 AND A.pac_id=B.pac_id AND A.pac_sta='1' ORDER BY A.pac_fin ASC";
	$resul=mysql_query($sql,$this->conexion);
	$num_filas=mysql_num_rows($resul);
	$array=mysql_fetch_object($resul);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $array;
  }
//******************************************************************
  function Listado_Pacade2($ci){
    $num_filas='';
    $sql="SELECT DISTINCT(A.pac_id) 'pac_id', A.pac_nom AS 'pac_nom' FROM pacade A, detins B WHERE B.ci_est='$ci' AND A.pac_id=B.pac_id AND A.pac_sta='1' AND B.det_sta='1' ORDER BY pac_fin";
	$resul=mysql_query($sql,$this->conexion);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $resul;
  }
//******************************************************************
  function Buscar_Matric(){
  $this->ci=$_SESSION[ci];
    $sql="SELECT A.mod_id AS 'mod_id', B.mod_nom AS 'mod_nom', A.reg_id AS 'reg_id', C.reg_nom AS 'reg_nom', A.esp_id AS 'esp_id', D.esp_nom AS 'esp_nom', A.coh_id AS 'coh_id', E.coh_nom AS 'coh_nom', A.pen_top AS 'pen_top' FROM matric A,  modali B, regimen C, especi D, cohort E WHERE A.ci='$this->ci' AND A.mod_id=B.mod_id AND A.reg_id=C.reg_id AND A.esp_id=D.esp_id AND A.coh_id=E.coh_id AND A.matr_sta='1'";	
	$resul=mysql_query($sql,$this->conexion);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $resul;
  }
//******************************************************************
  function Buscar_Matric2($ci){
/*if($ci=='21440012' || $ci=='24693022') echo "<script>alert('SELECT CONCAT(F.ap1, ,F.ap2) AS APELLIDOS, CONCAT(F.no1, ,F.no2) AS NOMBRES, F.ci AS CEDULA, A.mod_id AS mod_id, A.reg_id AS reg_id, A.esp_id AS esp_id, D.esp_nom AS ESPECIALIDAD, A.coh_id AS coh_id, A.pen_top AS pen_top FROM matric A, especi D, persona F WHERE A.ci=$ci AND A.esp_id=D.esp_id AND A.matr_sta=1 AND F.ci=A.ci AND A.matr_tip=0');</script>";*/
    $sql="SELECT CONCAT(F.ap1,' ',F.ap2) AS APELLIDOS, CONCAT(F.no1,' ',F.no2) AS NOMBRES, F.ci AS 'CEDULA', A.mod_id AS 'mod_id', A.reg_id AS 'reg_id', A.esp_id AS 'esp_id', D.esp_nom AS 'ESPECIALIDAD', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', B.nuc_nom AS 'NUCLEO' FROM matric A, especi D, persona F, nucleo B, estudi_infrae C, infrae E  WHERE A.ci='$ci' AND A.esp_id=D.esp_id AND A.matr_sta='1' AND F.ci=A.ci AND A.matr_tip='0' AND C.inf_id=E.inf_id AND E.nuc_id=B.nuc_id AND C.ci=A.ci AND C.est_inf_ffi='0000-00-00 00:00:00'";
	$resul=mysql_query($sql,$this->conexion);
	$num_filas=mysql_num_rows($resul);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $resul;
  }
//******************************************************************
  function Buscar_Asigna($pac_id){
    $sql="SELECT A.asi_cod AS 'asi_cod', B.asi_nom AS 'asi_nom' FROM detins A, asigna B, matric C WHERE A.ci_est='$this->ci' AND A.pac_id='$pac_id' AND A.asi_cod=B.asi_cod AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.det_sta='1' AND A.mod_id=C.mod_id AND A.coh_id=C.coh_id AND A.reg_id=C.reg_id AND A.esp_id=C.esp_id AND A.pen_top=C.pen_top AND A.ci_est=C.ci AND C.matr_sta='1' AND C.matr_tip='0'";	
	$resul=mysql_query($sql,$this->conexion);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $resul;
  }
//******************************************************************
  function Buscar_Asigna_Notas($pac_id){
    $sql="SELECT A.asi_cod AS 'asi_cod', B.asi_nom AS 'asi_nom', B.asi_mod AS 'asi_mod', B.asi_cuc AS 'asi_cuc', A.det_nfi AS 'det_nfi', A.det_nre AS 'det_nre', A.det_nde AS 'det_nde', A.sec_id AS 'sec_id', C.sec_nom AS 'sec_nom', C.inf_id AS 'inf_id', D.inf_nom AS 'inf_nom', A.obs_id AS 'obs_id', E.obs_des AS 'obs_des' FROM detins A, asigna B, seccio C, infrae D, observ E, matric F WHERE A.ci_est='$this->ci' AND A.pac_id='$pac_id' AND A.asi_cod=B.asi_cod AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.sec_id=C.sec_id AND C.inf_id=D.inf_id AND A.obs_id=E.obs_id AND A.det_sta='1' AND A.esp_id=F.esp_id AND A.reg_id=F.reg_id AND A.mod_id=F.mod_id AND A.coh_id=F.coh_id AND A.pen_top=F.pen_top AND A.ci_est=F.ci AND F.matr_sta='1' AND F.matr_tip='0'";
	$resul=mysql_query($sql,$this->conexion);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $resul;
  }
//******************************************************************
  function Buscar_Seccion_Ofertadas($asi_cod,$pac_id){
	$this->pac_id=$_SESSION[pac_id];
    $this->coh_id=$_SESSION[coh_id];
    $this->mod_id=$_SESSION[mod_id];
    $this->reg_id=$_SESSION[reg_id];
    $this->esp_id=$_SESSION[esp_id];
    $this->pen_top=$_SESSION[pen_top];
      $sql="SELECT DISTINCT(E.sec_id) AS 'sec_id', C.sec_nom AS 'sec_nom', C.inf_id AS 'inf_id', D.inf_nom AS 'inf_nom', E.ase_cma AS 'ase_cma' FROM seccio C, infrae D, asigna_seccio E WHERE E.ase_sta='1' AND E.asi_cod='$asi_cod' AND E.esp_id='$this->esp_id' AND E.coh_id='$this->coh_id' AND E.mod_id='$this->mod_id' AND E.reg_id='$this->reg_id' AND E.pen_top='$this->pen_top' AND E.pac_id='$pac_id' AND E.sec_id=C.sec_id AND C.inf_id=D.inf_id ORDER BY C.sec_nom,D.inf_nom";
	$resul=mysql_query($sql,$this->conexion);
	$num_filas=mysql_num_rows($resul);
/*echo "<script>alert('Numero de Filas $num_filas, $asi_cod, $this->pac_id, $this->coh_id, $this->mod_id, $this->reg_id, $this->esp_id, $this->pen_top');</script>";*/
    return $resul;
  }  
//******************************************************************
  function Buscar_ase_id($asi_cod,$pac_id,$sec_id){
  $sql="SELECT ase_id FROM asigna_seccio WHERE pac_id='$pac_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND asi_cod='$asi_cod' AND ase_sta='1' AND sec_id='$sec_id' AND pen_top='$this->pen_top'";
	$resul=mysql_query($sql,$this->conexion);
	$ase_id=mysql_fetch_object($resul);
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
    $sql="SELECT COUNT(A.det_id) AS 'INSCRITOS' FROM detins A, asigna_seccio B WHERE A.pac_id='$pac_id' AND A.pac_id=B.pac_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.asi_cod=B.asi_cod AND A.det_sta='1' AND A.sec_id=B.sec_id AND A.pen_top=B.pen_top AND B.ase_sta='1' AND B.ase_id='$ase_id'";
	$resul=mysql_query($sql,$this->conexion);
	$num_filas=mysql_num_rows($resul);
	$inscritos=mysql_fetch_object($resul);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $inscritos;
  }
//******************************************************************
  function Buscar_Seccio($pac_id){
    $sql="SELECT A.asi_cod AS 'asi_cod', B.asi_nom AS 'asi_nom', A.sec_id AS 'sec_id', C.sec_nom AS 'sec_nom', C.inf_id AS 'inf_id', D.inf_nom AS 'inf_nom' FROM detins A, asigna B, seccio C, infrae D WHERE A.ci_est='$this->ci' AND A.pac_id='$pac_id' AND A.asi_cod=B.asi_cod AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.sec_id=C.sec_id AND C.inf_id=D.inf_id AND A.det_sta='1'";	
	$resul=mysql_query($sql,$this->conexion);
/*echo "<script>alert('Numero de Filas $num_filas');</script>";*/
    return $resul;
  }
//******************************************************************
  function Buscar_Pacade_exp(){
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
    $sql="SELECT pac_id, pac_nom FROM pacade WHERE DATEDIFF('$fecha',pac_fin)>=0 AND DATEDIFF(pac_ffin,'$fecha')>=0 AND pac_sta='1' ORDER BY pac_fin DESC";
	$resul=mysql_query($sql,$this->conexion);
    return $resul;
  }
//******************************************************************
  function Buscar_Pacade(){
    $num_filas='';
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
    $sql="SELECT pac_id FROM pacade WHERE DATEDIFF('$fecha',pac_fin)>=0 AND DATEDIFF(pac_ffin,'$fecha')>=0 AND pac_sta='1'";
	$resul=mysql_query($sql,$this->conexion);
	$pacade=mysql_fetch_object($resul);
	$num_filas=mysql_num_rows($resul);
/*echo "<script>alert('Numero de Filas $num_filas SELECT pac_id FROM pacade WHERE DATEDIFF($fecha,pac_fin)>=0 AND DATEDIFF(pac_ffin,$fecha)>=0 AND pac_sta='1'');</script>";*/
    return $pacade;
  }
//******************************************************************
  function Buscar_Pacade2(){
    $num_filas='';
	$hoy=date("Y-m-d");
	$fecha=$hoy." 00:00:00";
/*echo "<script>alert('SELECT pac_id, pac_nom FROM pacade WHERE DATEDIFF($fecha,pac_fin)>=0 AND DATEDIFF(pac_ffin,$fecha)>=0 AND pac_sta=1');</script>";*/
	$sql="SELECT pac_id, pac_nom FROM pacade WHERE DATEDIFF('$fecha',pac_fin)>=0 AND DATEDIFF(pac_ffin,'$fecha')>=0 AND pac_sta='1'";
	$resul=mysql_query($sql,$this->conexion);
	$pacade=mysql_fetch_object($resul);
	return $pacade;
  }
//******************************************************************
  function Buscar_Pacade3($id){
    $num_filas='';
	$sql="SELECT pac_id, pac_nom, pac_fi1, pac_ff3 FROM pacade WHERE pac_id='$id'";
	$resul=mysql_query($sql,$this->conexion);
	$pacade=mysql_fetch_object($resul);
	return $pacade;
  }
/////****************************************************************
 function Buscar_Aplireg($ced,$paca)
 {
	 $sql="select * from apli_reg where ci_est='$ced' AND pac_id='$paca'"; 
	 $resul=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($resul); 	 
     $n=mysql_num_rows($resul);
	 if($n==0)
		 $cadena=FALSE;
	 else
		 $cadena=TRUE;		
     return $cadena;		   
 }
  
/////*******************************
 function GuardaExpedi($ced,$rusn)
	{
	 $sql="select * from expedi where ci_est='$ced' AND exp_sta=1"; 	
	 $resul=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($resul); 	 
     $n=mysql_num_rows($resul);
	 if($n==0)
		{
		 $sql="insert into expedi set ci_est='$ced',exp_rus='$rusn',exp_sta=1,ci_emp='17057572',exp_sta=1"; 
		 $resul=mysql_query($sql,$this->conexion);
		 return $resul;
	    }
	 else
		{
		 $sql="UPDATE expedi set exp_rus='$rusn',exp_sta=1,ci_emp='17057572' WHERE ci_est='$ced'"; 		 
		 $resul=mysql_query($sql,$this->conexion);
		 return $resul;
	    }	 
	}	
  
//*******************************************************************  
function ActualizarDatos($com,$com_id,$oco,$etn,$etn_id,$oet,$idi,$idi_id,$oid,$dep,$dep_id,$ode,$inc,$inc_id,$oin,$bec,$bec_id,$obe,$no1,$no2,$no3,$ap1,$ap2,$ap3,$sex,$ecv,$gsa,$frh,$fmi,$pmi,$nmi,$ran,$fot,$tmo,$nfa,$tfa,$tip,$did,$cre)
  {
  /*echo "<script>alert('com=$com com_id=$com_id oco=$oco etn=$etn etn_id=$etn_id oet=$oet idi=$idi oid=$oid dep=$dep ode=$ode inc=$inc oin=$oin bec=$bec obe=$obe ci=$this->ci');</script>";	   */

   if(empty($com_id))
     $com_id=5;
   if(empty($etn_id))
     $etn_id=0;

	$no1=strtoupper($no1);
	$no2=strtoupper($no2);
	$no3=strtoupper($no3);		
	$ap1=strtoupper($ap1);	
	$ap2=strtoupper($ap2);		
	$ap3=strtoupper($ap3);

 	$sql="UPDATE persona set com='$com', com_id='$com_id', oco='$oco', etn='$etn', etn_id='$etn_id',oet='$oet', idi='$idi', oid='$oid', dep='$dep', ode='$ode', inc='$inc', oin='$oin', bec='$bec', obe='$obe', no1='$no1', no2='$no2', no3='$no3', ap1='$ap1', ap2='$ap2', ap3='$ap3', sex='$sex', ecv='$ecv', gsa='$gsa', frh='$frh', fmi='$fmi', pmi='$pmi', nmi='$nmi', ran='$ran', fot='$fot', tmo='$tmo', nfa='$nfa', tfa='$tfa', tip='$tip', cre='$cre' WHERE ci='$this->ci'";
/*	 $sql="UPDATE persona set com='$com', com_id=if(idi>0,com_id=NULL,com_id=5), oco='', etn=0, etn_id=if(idi>0,etn_id=NULL,etn_id=2), oet='', idi=1, oid='', dep=0, ode='', inc=0, oin='', bec=0, obe='', no1='PRUEBA', no2='PR NOMBRE 2', no3='PR NOMBRE 3', ap1='PR ap1', ap2='PR ap2', ap3='PR ap3', sex=1, ecv='CASADO', gsa='A', frh=1, fmi=0, pmi='pmi', nmi='nmi', ran='rango', fot='direccion-foto', tmo='0414-253', nfa='juan', tfa='0276-86532', tip=0, cre='1' WHERE ci='$this->ci'"; */
/*  	 $sql="UPDATE persona set com='$com', oco='$oco', etn='$etn', oet='$oet', idi='$idi', oid='$oid', dep='$dep', ode='$ode', inc='$inc', oin='$oin', bec='$bec', obe='$obe' WHERE ci='$this->ci'"; */

 	 $result=mysql_query($sql,$this->conexion);
	 if (!$result) 
	   {
         die('Invalid query: '.mysql_error());
       }
	 return $result;
 
	 /*no1='$this->no1', no2='$this->no2', no3='$this->no3', ap1='$this->ap1', ap2='$this->ap2', ap3='$this->ap3', sex='$this->sex', ecv='$this->ecv', gsa='$this->gsa', frh='$this->frh', fmi='$this->fmi', pmi='$this->pmi', nmi='$this->nmi', ran='$this->ran', fot='$this->fot', tmo='$this->tmo', nfa='$this->nfa', tfa='$this->tfa', sta='$this->sta', tip='$this->tip', did='$this->did', cre='$this->cre'  WHERE ci='$this->ci'";	
	 */
  }
//*******************************************************************  
function Buscar_Inscripcion_Activa()
	{
     $hoy=date("Y-m-d",time());
  	 $sql="SELECT * FROM inscri WHERE ('$hoy' between ins_fin AND ins_ffi) and ins_sta=1";	
	 //$sql="SELECT * FROM inscri WHERE ins_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
	  if($n==0)
		{
		  $cadena='FALSE';
		  return $cadena;
		 }
		 else
		 {		
		 return $result;
		}		 
	}  
  //**********************************************************
  function Buscar_UltimoSem($ci,$pacade)
	{
/*	echo "<script>alert('$ci,$pacade');</script>";
	echo "<script>alert('SELECT J.nuc_nom AS NUCLEO, G.mod_nom AS MODALIDAD, C.esp_nom AS ESPECIALIDAD, D.reg_nom AS REGIMEN, E.asi_mod AS SEMESTRE, A.ci AS CEDULA, CONCAT( A.ap1, , A.ap2 ) AS APELLIDOS, CONCAT( A.no1, , A.no2 ) AS NOMBRES FROM persona A, detins B, especi C, regimen D, asigna E, matric F, modali G, estudi_infrae H, infrae I, nucleo J WHERE A.ci = B.ci_est AND A.ci= $ci AND A.ci = F.ci AND H.ci = A.ci AND H.est_inf_ffi = 0000-00-00 00:00:00 AND H.inf_id = I.inf_id AND I.nuc_id = J.nuc_id AND F.matr_sta = 1 AND B.esp_id = F.esp_id AND B.reg_id = F.reg_id AND B.mod_id = F.mod_id AND B.coh_id = F.coh_id AND B.pen_top = F.pen_top AND B.pac_id = 12011 AND B.det_sta = 1 AND B.esp_id = C.esp_id AND B.reg_id = D.reg_id AND B.asi_cod = E.asi_cod AND B.esp_id = E.esp_id AND B.reg_id = E.reg_id AND B.mod_id = E.mod_id AND F.mod_id = G.mod_id AND B.coh_id = E.coh_id AND B.pen_top = E.pen_top GROUP BY A.ci ORDER BY C.esp_nom, D.reg_nom, E.asi_mod, A.ci');</script>";*/
     $sql="SELECT I.inf_tip AS 'SEDE_TIPO', I.inf_nom AS 'SEDE', J.nuc_id AS 'NUCLEO_ID', J.nuc_nom AS 'NUCLEO', G.mod_nom AS 'MODALIDAD', G.mod_id AS 'mod_id', C.esp_nom AS 'ESPECIALIDAD', C.esp_id AS 'esp_id', D.reg_nom AS 'REGIMEN', D.reg_id AS 'reg_id', MIN(E.asi_mod) AS 'SEMESTRE', A.ci AS 'CEDULA', CONCAT( A.ap1,' ', A.ap2 ) AS 'APELLIDOS', CONCAT( A.no1,' ', A.no2 ) AS 'NOMBRES', F.coh_id AS 'coh_id', F.pen_top AS 'pen_top' FROM persona A, detins B, especi C, regimen D, asigna E, matric F, modali G, estudi_infrae H, infrae I, nucleo J WHERE A.ci = B.ci_est AND A.ci= '$ci' AND A.ci = F.ci AND H.ci = A.ci AND H.est_inf_ffi = '0000-00-00 00:00:00' AND H.inf_id = I.inf_id AND I.nuc_id = J.nuc_id AND F.matr_sta = '1' AND B.esp_id = F.esp_id AND B.reg_id = F.reg_id AND B.mod_id = F.mod_id AND B.coh_id = F.coh_id AND B.pen_top = F.pen_top AND B.pac_id = '$pacade' AND B.det_sta = '1' AND B.esp_id = C.esp_id AND B.reg_id = D.reg_id AND B.asi_cod = E.asi_cod AND B.esp_id = E.esp_id AND B.reg_id = E.reg_id AND B.mod_id = E.mod_id AND F.mod_id = G.mod_id AND B.coh_id = E.coh_id AND B.pen_top = E.pen_top GROUP BY A.ci ORDER BY C.esp_nom, D.reg_nom, E.asi_mod, A.ci";
	 $resul=mysql_query($sql,$this->conexion);
 	 $ultimosem=mysql_fetch_object($resul);
	  if($ultimosem->NUCLEO=="")
	  {
	    $cadena='FALSE';
		return $cadena;
 	  }
	  else
	    return $ultimosem;
	}  
//**********************************************************
  function Buscar_SedePrincipal($NUC_ID){
    $sql="SELECT inf_nom FROM infrae WHERE nuc_id='$NUC_ID' AND inf_tip='0' AND inf_sta='1'";
	 $resul=mysql_query($sql,$this->conexion);
 	 $SED_PRIN=mysql_fetch_object($resul);
	  if($SED_PRIN->inf_nom=="")
	  {
	    $cadena='FALSE';
		return $cadena;
 	  }
	  else
	    return $SED_PRIN;
  }
//******************************************************************
function ConvertirLetra($num){
/*echo "<script>alert('$num');</script>";*/
  $let="";
  if($num!=""){
    if($num==1)
	  $let="UNO";
    if($num==2)
	  $let="DOS";
    if($num==3)
	  $let="TRES";
    if($num==4)
	  $let="CUATRO";
    if($num==5)
	  $let="CINCO";
    if($num==6)
	  $let="SEIS";
    if($num==7)
	  $let="SIETE";
    if($num==8)
	  $let="OCHO";
    if($num==9)
	  $let="NUEVE";
    if($num==10)
	  $let="DIEZ";
    if($num==11)
	  $let="ONCE";
    if($num==12)
	  $let="DOCE";
    if($num==13)
	  $let="TRECE";
    if($num==14)
	  $let="CATORCE";
    if($num==15)
	  $let="QUINCE";
    if($num==16)
	  $let="DIECISEIS";
    if($num==17)
	  $let="DIECISIETE";
    if($num==18)
	  $let="DIESIOCHO";
    if($num==19)
	  $let="DIESINUEVE";
    if($num==20)
	  $let="VEINTE";
  }
  return $let;
}
//******************************************************************
  function Listado_Alumno_Not($sec_id){
    $ci=$_SESSION[ci];
/*	echo "<script>alert('SELECT A.ci AS ci, concat(A.no1, ,A.no2) AS no, concat(A.ap1, ,A.ap2) AS ap, B.det_n11 AS det_n11, B.det_n12 AS det_n12, B.det_n13 AS det_n13, B.det_n21 AS det_n21, B.det_n22 AS det_n22, B.det_n23 AS det_n23, B.det_n31 AS det_n31, B.det_n32 AS det_n32, B.det_n33 AS det_n33, B.det_di1 AS det_di1, B.det_di2 AS det_di2, B.det_nla AS det_nla, B.det_nfi AS det_nfi, B.det_nde AS det_nde, B.det_con AS det_con, B.esp_id As esp_id FROM persona A, detins B WHERE B.mod_id=$this->mod_id AND B.reg_id=$this->reg_id AND B.esp_id=$this->esp_id AND B.coh_id=$this->coh_id AND B.asi_cod=$this->asi_cod AND B.pac_id=$this->pac_id AND B.sec_id=$sec_id AND A.ci=B.ci_est AND B.det_sta=1 AND B.ci_est=$ci order by B.esp_id,B.sec_id,ap,no,ci ASC');</script>";*/
    $sql="SELECT A.ci AS 'ci', concat(A.no1,' ',A.no2) AS 'no', concat(A.ap1,' ',A.ap2) AS 'ap', B.det_n11 AS 'det_n11', B.det_n12 AS 'det_n12', B.det_n13 AS 'det_n13', B.det_n21 AS 'det_n21', B.det_n22 AS 'det_n22', B.det_n23 AS 'det_n23', B.det_n31 AS 'det_n31', B.det_n32 AS 'det_n32', B.det_n33 AS 'det_n33', B.det_di1 AS 'det_di1', B.det_di2 AS 'det_di2', B.det_nla AS 'det_nla', B.det_nfi AS 'det_nfi', B.det_nde AS 'det_nde', B.det_con AS 'det_con', B.esp_id As 'esp_id' FROM persona A, detins B WHERE B.mod_id='$this->mod_id' AND B.reg_id='$this->reg_id' AND B.esp_id='$this->esp_id' AND B.coh_id='$this->coh_id' AND B.asi_cod='$this->asi_cod' AND B.pac_id='$this->pac_id' AND B.sec_id='$sec_id' AND A.ci=B.ci_est AND B.det_sta='1' AND B.ci_est='$ci' order by B.esp_id,B.sec_id,ap,no,ci ASC";
	$resul=mysql_query($sql,$this->conexion);
    return $resul;
  }
//******************************************************************
function Buscar_DETINS($CEDULA,$pac_id,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
/*  echo "<script>alert('Buscar_Asignatura $asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top');</script>";*/
    $sql="SELECT * FROM detins WHERE ci_est='$CEDULA' AND pac_id='$pac_id' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND det_sta='1'";
	$resul=mysql_query($sql,$this->conexion);
	return $resul;
}
//******************************************************************
function Buscar_DETINS_IND($CEDULA,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
    $pac_lista="";
    $sql="SELECT pac_fin FROM pacade WHERE pac_id='$pac_id'";
	$resul=mysql_query($sql,$this->conexion);
//	$fi=mysql_num_rows($resul);
	$array_pac=mysql_fetch_object($resul);	     
/* echo "<script>alert('Buscar_Asignatura $CEDULA,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id, $fi,$array_pac->pac_fin');</script>";*/
    $sql2="SELECT * FROM detins WHERE ci_est='$CEDULA' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND det_sta='1' AND obs_id!='4' AND pac_id IN(SELECT pac_id FROM pacade WHERE DATEDIFF('$array_pac->pac_fin',pac_fin)>=0)";
	$resul2=mysql_query($sql2,$this->conexion);
	return $resul2;
}
//******************************************************************
function Calcular_IND($CEDULA,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
/*  echo "<script>alert('Buscar_Asignatura $asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top');</script>";*/
    $ind=0;
	$uc=0;
	$resp_ind=$this->Buscar_DETINS_IND($CEDULA,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id);
	$fi=mysql_num_rows($resp_ind);
    while($array_ind=mysql_fetch_object($resp_ind)){
      $sql="SELECT * FROM asigna WHERE asi_cod='$array_ind->asi_cod' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top'";
	  $resul_asig=mysql_query($sql,$this->conexion);
	  $array_asig=mysql_fetch_object($resul_asig);
	  $ind=$ind+($array_ind->det_nde*$array_asig->asi_cuc);
	  $uc=$uc+$array_asig->asi_cuc;
/*  	 echo "<script>alert('$ind+($array_ind->det_nde*$array_asig->asi_cuc)');</script>";*/
	}
	$ind_acum=$ind/$uc;
	$ind_acum=round($ind_acum,2);
	return $ind_acum;
}
 //******************************************************************
function Buscar_Asignatura($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
/*  echo "<script>alert('Buscar_Asignatura $asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top');</script>";*/
    $sql="SELECT * FROM asigna WHERE asi_cod='$asi_cod' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top'";
	$resul=mysql_query($sql,$this->conexion);
	return $resul;
}
 //******************************************************************
function Buscar_Asignaturas_ofertadas($asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
/*
if()  echo "<script>alert('SELECT * FROM asigna WHERE asi_cod IN($asi_cod) AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' ORDER BY asi_mod,asi_nom');</script>";*/
    $sql="SELECT * FROM asigna WHERE asi_cod IN($asi_cod) AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' ORDER BY asi_mod,asi_nom";
	$resul=mysql_query($sql,$this->conexion);
	return $resul;
}
//******************************************************************
function Buscar_Seccion($sec_id){
/*  echo "<script>alert('Buscar_Seccion $sec_id');</script>";*/
    $sql="SELECT A.sec_id AS 'sec_id', A.sec_nom AS 'sec_nom', B.inf_nom AS 'inf_nom' FROM seccio A, infrae B WHERE A.sec_id='$sec_id' AND A.inf_id=B.inf_id";
	$resul=mysql_query($sql,$this->conexion);
	return $resul;
}
//******************************************************************
function Buscar_Obser($obs_id){
/*  echo "<script>alert('Buscar_Obser $obs_id');</script>";*/
    $sql="SELECT * FROM observ WHERE obs_id='$obs_id'";
	$resul=mysql_query($sql,$this->conexion);
	return $resul;
}
//******************************************************************
  function Buscar_Nota($valor){
	$cuantos=0;
	$val=explode("*",$valor);
	$this->pac_id=$_SESSION[pac_id];
    $this->coh_id=$_SESSION[coh_id];
    $this->mod_id=$_SESSION[mod_id];
    $this->reg_id=$_SESSION[reg_id];
    $this->esp_id=$_SESSION[esp_id];
    $this->pen_top=$_SESSION[pen_top];
	$this->asi_cod=$val[0];
	$this->sec_id=$val[1];
    $resp=$this->Listado_Alumno_Not($this->sec_id);
    $sql="SELECT B.asd_p11 AS 'ase_p11', B.asd_p12 AS 'ase_p12', B.asd_p13 AS 'ase_p13', B.asd_p21 AS 'ase_p21', B.asd_p22 AS 'ase_p22', B.asd_p23 AS 'ase_p23', B.asd_p31 AS 'ase_p31', B.asd_p32 AS 'ase_p32', B.asd_p33 AS 'ase_p33', B.asd_f11 AS 'ase_f11', B.asd_f12 AS 'ase_f12', B.asd_f13 AS 'ase_f13', B.asd_f21 AS 'ase_f21', B.asd_f22 AS 'ase_f22', B.asd_f23 AS 'ase_f23', B.asd_f31 AS 'ase_f31', B.asd_f32 AS 'ase_f32', B.asd_f33 AS 'ase_f33', A.ci_emp AS 'ci_emp', A.ci_doc_pol, A.ase_pte AS 'ase_pte', A.ase_pla AS 'ase_pla', A.ase_tev AS 'ase_tev' FROM asigna_seccio A, asigna_seccio_docent B WHERE A.esp_id='$this->esp_id' AND A.esp_id=B.esp_id AND A.mod_id='$this->mod_id' AND A.mod_id=B.mod_id AND A.coh_id='$this->coh_id' AND A.coh_id=B.coh_id AND A.reg_id='$this->reg_id' AND A.reg_id=B.reg_id AND A.sec_id='$this->sec_id' AND A.sec_id=B.sec_id AND A.pac_id='$this->pac_id' AND A.pac_id=B.pac_id AND A.asi_cod='$this->asi_cod' AND A.asi_cod=B.asi_cod AND A.ase_sta='1' AND B.asd_sta='1' AND A.ci_emp=B.ci_doc";
    $res_ase=mysql_query($sql,$this->conexion);
 	$arr_ase=mysql_fetch_object($res_ase);
    $sql="SELECT COUNT(hor_tpl) AS teo FROM horario WHERE esp_id='$this->esp_id' AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='0'";
	$contar=mysql_query($sql,$this->conexion);
 	$cuan=mysql_fetch_object($contar);
	$cant_teo=$cuan->teo;
	$sql="SELECT COUNT(hor_tpl) AS pra FROM horario WHERE esp_id='$this->esp_id' AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='1'";
	$contar=mysql_query($sql,$this->conexion);
 	$cuan=mysql_fetch_object($contar);
	$cant_pra=$cuan->pra;
	$sql="SELECT COUNT(hor_tpl) AS lab FROM horario WHERE esp_id IN='$this->esp_id' AND mod_id='$this->mod_id' AND coh_id='$this->coh_id' AND reg_id='$this->reg_id' AND sec_id='$this->sec_id' AND pac_id='$this->pac_id' AND asi_cod='$this->asi_cod' AND hor_sta='1' AND ci='$arr_ase->ci_emp' AND hor_tpl='2'";
	$contar=mysql_query($sql,$this->conexion);
 	$cuan=mysql_fetch_object($contar);
	$cant_lab=$cuan->lab;
	$sql="SELECT * FROM persona WHERE ci='$arr_ase->ci_emp'";
	$res_doc=mysql_query($sql,$this->conexion);
 	$arr_doc=mysql_fetch_object($res_doc);
      $teor="";
      $cond="";
	  $n11="";
      $n12="";
      $n13="";	  
	  $p11="";
	  $p12="";
  	  $p13="";
	  $n21="";
	  $n22="";
  	  $n23="";	  
	  $p21="";
	  $p22="";
  	  $p23="";
	  $n31="";
	  $n32="";
  	  $n33="";	  
	  $p31="";
	  $p32="";
      $p33="";
	  $pla="";
      $nla="";
      $defi="";
	  $letr="";	
	  $esp="";
	  $array=mysql_fetch_object($resp);
        $sum=0;
  	    $no11="00";
	    $no12="00";
	    $no13="00";	  
	    $por11="";
	    $por12="";
  	    $por13="";
	    $no21="00";
	    $no22="00";
  	    $no23="00";
	    $por21="";
	    $por22="";
  	    $por23="";
	    $no31="00";
	    $no32="00";
  	    $no33="00";	  
	    $por31="";
	    $por32="";
        $por33="";
	    $pola="";
        $nola="00";
        $def="";
	    $let="";
		$i=1;
/*		echo "<script>alert('$array->det_n11==');</script>";*/
/*		echo "<script>alert('20>=$i && $por11==');</script>";*/
	    while(20>=$i && $por11==""){
	      if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n11==$nota){
		    $por11=($i*$arr_ase->ase_p11)/100;
		    $sum=$sum+$por11;
		    $no11=$n;
/*		echo "<script>alert('PORCENTAJE $por11, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
/*		echo "<script>alert('$array->det_n11==$nota, $por11, $sum, $no11');</script>";*/
		  $i++;
	    }		
	    if($array->det_n11=="" || $no11=='00'){
		  $por11=(1*$arr_ase->ase_p11)/100;
		  $sum=$sum+$por11;
	      $no11="01";
	    }
/*		echo "<script>alert('PORCENTAJE $por11, ($i*$arr_ase->ase_p11)/100');</script>";*/
		$i=1;
	    while(20>=$i && $por12==""){
	      if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n12==$nota){
		    $por12=($i*$arr_ase->ase_p12)/100;
		    $sum=$sum+$por12;
		    $no12=$n;
		/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  $i++;
	    }
		if($array->det_n12=="" || $no12=='00'){
		  $por12=(1*$arr_ase->ase_p12)/100;
		  $sum=$sum+$por12;
	      $no12="01";
	    }
		$i=1;
	    while(20>=$i && $por13==""){
	      if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n13==$nota){
		    $por13=($i*$arr_ase->ase_p13)/100;
		    $sum=$sum+$por13;
		    $no13=$n;
		/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  $i++;
	    }
		if($array->det_n13=="" || $no13=='00'){
		  $por13=(1*$arr_ase->ase_p13)/100;
		  $sum=$sum+$por13;
	      $no13="01";
	    }
		$i=1;
	    while(20>=$i && $por21==""){
	      if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n21==$nota){
		    $por21=($i*$arr_ase->ase_p21)/100;
		    $sum=$sum+$por21;
		    $no21=$n;
		/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  $i++;
	    }
		if($array->det_n21==""  || $no21=='00'){
		  $por21=(1*$arr_ase->ase_p21)/100;
		  $sum=$sum+$por21;
	      $no21="01";
	    }
		$i=1;
	    while(20>=$i && $por22==""){
	      if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n22==$nota){
		    $por22=($i*$arr_ase->ase_p22)/100;
		    $sum=$sum+$por22;
		    $no22=$n;
		/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  $i++;
	    }
		if($array->det_n22=="" || $no22=='00'){
		  $por22=(1*$arr_ase->ase_p22)/100;
		  $sum=$sum+$por22;
	      $no22="01";
	    }
		$i=1;
	    while(20>=$i && $por23==""){
	      if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n23==$nota){
		    $por23=($i*$arr_ase->ase_p23)/100;
		    $sum=$sum+$por23;
		    $no23=$n;
		/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  $i++;
	    }
		if($array->det_n23=="" || $no23=='00'){
		  $por23=(1*$arr_ase->ase_p23)/100;
		  $sum=$sum+$por23;
	      $no23="01";
	    }
		$i=1;
	    while(20>=$i && $por31==""){
	      if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n31==$nota){
		    $por31=($i*$arr_ase->ase_p31)/100;
		    $sum=$sum+$por31;
		    $no31=$n;
		/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  $i++;
	    }	
		if($array->det_n31=="" || $no31=='00'){
		  $por31=(1*$arr_ase->ase_p31)/100;
		  $sum=$sum+$por31;
	      $no31="01";
	    }
		$i=1;
	    while(20>=$i && $por32==""){
	      if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n32==$nota){
		    $por32=($i*$arr_ase->ase_p32)/100;
		    $sum=$sum+$por32;
		    $no32=$n;
		/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  $i++;
	    }
		if($array->det_n32=="" || $no32=='00'){
		  $por32=(1*$arr_ase->ase_p32)/100;
		  $sum=$sum+$por32;
	      $no32="01";
	    }
		$i=1;
	    while(20>=$i && $por33==""){
	      if($i<=9) $n="0".$i; else $n="".$i;
		  $nota=md5($n);
		  if($array->det_n33==$nota){
		    $por33=($i*$arr_ase->ase_p33)/100;
		    $sum=$sum+$por33;
		    $no33=$n;
		/*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		  }
		  $i++;
	    }
		if($array->det_n33=="" || $no33=='00'){
		  $por33=(1*$arr_ase->ase_p33)/100;
		  $sum=$sum+$por33;
	      $no33="01";
	    }
		if(intval($arr_ase->ase_pte)!=intval(100)){
	      $teo=$sum;
	      $i=1;
	      $pola="";
	      $nola="NP";
	      if($arr_ase->ci_doc_pol==0){
		    while(20>=$i && $pola==""){
	          if($i<=9) $n="0".$i; else $n="".$i;
		      $nota=md5($n);
		      if($array->det_nla==$nota){
		        $pola=($i*$arr_ase->ase_pla)/100;
		        $sum=$sum+$pola;
		        $nola=$n;
		  /*echo "<script>alert('PORCENTAJE $por, ($i*$arr_ase->ase_p11)/100');</script>";*/
		      }
		      $i++;
	        }
	        if($array->det_nla=="" || $nola=='00'){
		      $pola=(1*$arr_ase->ase_pla)/100;
		      $sum=$sum+$pola;
	          $nola="01";
	        }
		  }
		  else{
		    $pola=($array->det_nla*$arr_ase->ase_pla)/100;
		    $sum=$sum+$pola;
	        $nola="".$array->det_nla;
		  }
        }
	    $def=round($array->det_nfi);
		$let=$this->ConvertirLetra($def);
		if($array->det_con==0)
		  $con="R";
		else
		  $con="A";
	    if($ci==""){
	      $ci=$array->ci;
	      $ap=$array->ap;
	      $no=$array->no;
	      $esp=$array->esp_id;
	      $n11=$no11;
	      $n12=$no12;
	      $n13=$no13;
	      $p11=$por11;
	      $p12=$por12;
	      $p13=$por13;
	      $n21=$no21;
	      $n22=$no22;
	      $n23=$no23;
	      $p21=$por21;
	      $p22=$por22;
	      $p23=$por23;
	      $n31=$no31;
	      $n32=$no32;
	      $n33=$no33;
	      $p31=$por31;
	      $p32=$por32;
	      $p33=$por33;
		  if(intval($arr_ase->ase_pte)!=intval(100)){
  	        $nla=$nola;
   	        $pla=$pola;
		    $teor=$teo;
	      }
	      $defi=$def;
	      $letr=$let;
	      $cond=$con;
		}
	    else{
	      $ci=$ci."*".$array->ci;
	      $ap=$ap."*".$array->ap;
	      $no=$no."*".$array->no;
	      $esp=$esp."*".$array->esp_id;
	      $n11=$n11."*".$no11;
	      $n12=$n12."*".$no12;
	      $n13=$n13."*".$no13;
	      $p11=$p11."*".$por11;
	      $p12=$p12."*".$por12;
	      $p13=$p13."*".$por13;
	      $n21=$n21."*".$no21;
	      $n22=$n22."*".$no22;
	      $n23=$n23."*".$no23;
	      $p21=$p21."*".$por21;
	      $p22=$p22."*".$por22;
	      $p23=$p23."*".$por23;
	      $n31=$n31."*".$no31;
	      $n32=$n32."*".$no32;
	      $n33=$n33."*".$no33;
	      $p31=$p31."*".$por31;
	      $p32=$p32."*".$por32;
	      $p33=$p33."*".$por33;
		  if(intval($arr_ase->ase_pte)!=intval(100)){
  	        $nla=$nla."*".$nola;
   	        $pla=$pla."*".$pola;
		    $teor=$teor."*".$teo;
	      }
	      $defi=$defi."*".$def;
	      $letr=$letr."*".$let;
	      $cond=$cond."*".$con;
	    }
	    $cuantos++;
    if($arr_ase->ase_f11!="") $fech11=$this->fechaNormal($arr_ase->ase_f11); else $fech11="";
    if($arr_ase->ase_f12!="") $fech12=$this->fechaNormal($arr_ase->ase_f12); else $fech12="";
    if($arr_ase->ase_f13!="") $fech13=$this->fechaNormal($arr_ase->ase_f13); else $fech13="";
	if($arr_ase->ase_f21!="") $fech21=$this->fechaNormal($arr_ase->ase_f21); else $fech21="";
    if($arr_ase->ase_f22!="") $fech22=$this->fechaNormal($arr_ase->ase_f22); else $fech22="";
    if($arr_ase->ase_f23!="") $fech23=$this->fechaNormal($arr_ase->ase_f23); else $fech23="";
    if($arr_ase->ase_f31!="") $fech31=$this->fechaNormal($arr_ase->ase_f31); else $fech31="";
    if($arr_ase->ase_f32!="") $fech32=$this->fechaNormal($arr_ase->ase_f32); else $fech32="";
    if($arr_ase->ase_f33!="") $fech33=$this->fechaNormal($arr_ase->ase_f33); else $fech33="";
	$this->res=$ci."@".$ap."@".$no."@".$n11."@".$n12."@".$n13."@".$p11."@".$p12."@".$p13."@".$n21."@".$n22."@".$n23."@".$p21."@".$p22."@".$p23."@".$n31."@".$n32."@".$n33."@".$p31."@".$p32."@".$p33."@".$nla."@".$pla."@".$teor."@".$defi."@".$letr."@".$cond."@".$cuantos."@".$fech11."@".$fech12."@".$fech13."@".$fech21."@".$fech22."@".$fech23."@".$fech31."@".$fech32."@".$fech33."@".$arr_ase->ase_p11."@".$arr_ase->ase_p12."@".$arr_ase->ase_p13."@".$arr_ase->ase_p21."@".$arr_ase->ase_p22."@".$arr_ase->ase_p23."@".$arr_ase->ase_p31."@".$arr_ase->ase_p32."@".$arr_ase->ase_p33."@".$arr_ase->ase_pla."@".$arr_doc->ci."@".$arr_doc->ap1." ".$arr_doc->ap2." ".$arr_doc->no1." ".$arr_doc->no2."@".$cant_lab."@".$cant_teo."@".$esp."@".$arr_ase->ase_pte;
	$this->res=$this->ConvertirMayuscula($this->res);
	return $this->res;
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
    $sql="SELECT DISTINCT(asi_cod) AS 'asi_cod' FROM asigna_seccio WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND pac_id='$this->pac_id' AND ase_sta='1'";
}
else{
    $sql="SELECT DISTINCT(A.asi_cod) AS 'asi_cod' FROM asigna_seccio A, asigna B WHERE A.mod_id='$this->mod_id' AND A.reg_id='$this->reg_id' AND A.esp_id='$this->esp_id' AND A.coh_id='$this->coh_id' AND A.pen_top='$this->pen_top' AND A.pac_id='$this->pac_id' AND ase_sta='1' AND B.asi_mod='1' AND A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.asi_sta='1'";
	}
	$resul=mysql_query($sql,$this->conexion);
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
/*  echo "<script>alert('Buscar_Asignatura $asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top');</script>";*/
    $sql="SELECT * FROM asigna_seccio WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND pac_id='$this->pac_id' AND ase_sta='1' AND asi_cod='$asi_cod'";
	$resul=mysql_query($sql,$this->conexion);
	return $resul;
}
//******************************************************************
function Buscar_Oferta_Secc($asi_cod){
	$this->pac_id=$_SESSION[pac_id];
    $this->coh_id=$_SESSION[coh_id];
    $this->mod_id=$_SESSION[mod_id];
    $this->reg_id=$_SESSION[reg_id];
    $this->esp_id=$_SESSION[esp_id];
    $this->pen_top=$_SESSION[pen_top];
/*  echo "<script>alert('Buscar_Asignatura $asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top');</script>";*/
    $sql="SELECT sec_id FROM asigna_seccio WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND pac_id='$this->pac_id' AND ase_sta='1' AND asi_cod='$asi_cod'";
	$resul=mysql_query($sql,$this->conexion);
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
	$this->ci=$_SESSION[ci];
/*if(($asi_cod=='02' || $asi_cod=='ADG-34143') && $this->ci=='14605972'){  echo "<script>alert('SELECT det_con FROM detins WHERE mod_id=$this->mod_id AND reg_id=$this->reg_id AND esp_id=$this->esp_id AND coh_id=$this->coh_id AND pen_top=$this->pen_top AND asi_cod=$asi_cod AND det_sta=1 AND ci_est=$this->ci AND det_con=1');</script>";}*/
    $sql="SELECT det_con FROM detins WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$asi_cod' AND det_sta='1' AND ci_est='$this->ci' AND det_con='1'";
	$resul=mysql_query($sql,$this->conexion);
	return $resul;
}
//******************************************************************
function Buscar_Re_Co_Materia($asi_cod){
	$this->pac_id=$_SESSION[pac_id];
    $this->coh_id=$_SESSION[coh_id];
    $this->mod_id=$_SESSION[mod_id];
    $this->reg_id=$_SESSION[reg_id];
    $this->esp_id=$_SESSION[esp_id];
    $this->pen_top=$_SESSION[pen_top];
/*  echo "<script>alert('Buscar_Asignatura $asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top');</script>";*/
    $sql="SELECT asi_cod_req,req_tip,req_cuc FROM requis WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$asi_cod' AND req_sta='1'";
	$resul=mysql_query($sql,$this->conexion);
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
/*  echo "<script>alert('Buscar_Asignatura REQUISITO $asi_cod,$this->mod_id,$this->reg_id,$this->esp_id,$this->coh_id,$this->pen_top');</script>";*/
    $sql="SELECT asi_cod_req, req_cuc FROM requis WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$asi_cod' AND req_sta='1' AND req_tip='1'";
	$resul=mysql_query($sql,$this->conexion);
	return $resul;
}
//******************************************************************
function Buscar_Requisito_UC($asi_cod){
	$this->pac_id=$_SESSION[pac_id];
    $this->coh_id=$_SESSION[coh_id];
    $this->mod_id=$_SESSION[mod_id];
    $this->reg_id=$_SESSION[reg_id];
    $this->esp_id=$_SESSION[esp_id];
    $this->pen_top=$_SESSION[pen_top];
/*  echo "<script>alert('Buscar_Asignatura REQUISITO $asi_cod,$this->mod_id,$this->reg_id,$this->esp_id,$this->coh_id,$this->pen_top');</script>";*/
    $sql="SELECT req_cuc FROM requis WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$asi_cod' AND req_sta='1' AND req_tip='0'";
	$resul=mysql_query($sql,$this->conexion);
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
	$this->ci=$_SESSION[ci];
/*  echo "<script>alert('Buscar_Asignatura REQUISITO $asi_cod,$this->mod_id,$this->reg_id,$this->esp_id,$this->coh_id,$this->pen_top');</script>";*/
    $sql="SELECT SUM( A.asi_cuc ) AS suma_uc_apr FROM asigna A, `detins` B WHERE B.`ci_est` = '$this->ci' AND B.`det_sta` = '1' AND B.`det_con` = '1' AND A.asi_cod = B.asi_cod AND A.mod_id = B.mod_id AND A.reg_id = B.reg_id AND A.esp_id = B.esp_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.asi_sta = '1' AND A.mod_id = '$this->mod_id' AND A.reg_id = '$this->reg_id' AND A.esp_id = '$this->esp_id' AND A.coh_id = '$this->coh_id' AND A.pen_top = '$this->pen_top'";
	$resul=mysql_query($sql,$this->conexion);
	return $resul;
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
    $sql="SELECT asi_cod, asi_mod, asi_cba FROM asigna WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_sta='1' AND asi_cod NOT IN(SELECT asi_cod FROM requis WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND req_sta='1') AND asi_mod<(SELECT asi_mod FROM asigna WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_sta='1' AND asi_cod='$asi_cod') AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE ('DIN%')) AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE ('IMI%')) AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE ('ADG-1082%') AND asi_sta= '1' AND asi_nom LIKE ('CATEDRA%')) AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE ('ACO-0000%') AND asi_sta= '1' AND asi_nom LIKE ('ACTIVIDAD%')) AND asi_cod NOT IN(SELECT asi_cod FROM asigna WHERE asi_cod LIKE ('DEP-0000%') AND asi_sta= '1' AND asi_nom LIKE ('DEPORTE%'))";
	$resul=mysql_query($sql,$this->conexion);
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
    $sql="SELECT asi_cod_req FROM requis WHERE mod_id='$this->mod_id' AND reg_id='$this->reg_id' AND esp_id='$this->esp_id' AND coh_id='$this->coh_id' AND pen_top='$this->pen_top' AND asi_cod='$asi_cod' AND req_sta='1' AND req_tip='0'";
	$resul=mysql_query($sql,$this->conexion);
	return $resul;
}
//******************************************************************
  function Inscripcion_Intensivo($viejo_discente){
	$this->ci=$_SESSION[ci];
	$this->pac_id=$_SESSION[pac_id];
    $this->coh_id=$_SESSION[coh_id];
    $this->mod_id=$_SESSION[mod_id];
    $this->reg_id=$_SESSION[reg_id];
    $this->esp_id=$_SESSION[esp_id];
    $this->pen_top=$_SESSION[pen_top];
	$resp_ultimo=$this->Listado_Pacade3();
	$resp_todo=$this->Listado_Pacade_Todos();
	$pac_ant=mysql_fetch_object($resp_ultimo);
	$pac_tod=mysql_fetch_object($resp_todo);
	$PAC_ULTI=explode("-",'I-12013');//explode("-",$pac_tod->pac_id);
	$lis_asi_ofer='';
	$lis_asi_ofer1='';
/*	  echo "<script>alert('$pac_ant->pac_id==$PAC_ULTI[1]');</script>";	*/
	if($pac_ant->pac_id==$PAC_ULTI[1]){//$PAC_ULTI[1]){//REVISAR SI SE INSCRIBIO EN EL PERIODO ACADÉMICO ANTERIOR
	  $oferta=$this->Buscar_Oferta($viejo_discente);
	  while($array_oferta=mysql_fetch_object($oferta)){//REVISAR CADA ASIGNATURA
/*	    if($this->ci='16745192') echo "<script>alert('ENTRE A REVISAR CADA ASIGNATURA $array_oferta->asi_cod');</script>";*/
	    $mat_apro=$this->Buscar_Cond_Asig($array_oferta->asi_cod);
		$apro=mysql_num_rows($mat_apro);
/*	    if($this->ci='16745192' && $array_oferta->asi_cod=='CSL-10623') echo "<script>alert('CONDICION DE APROBADA $apro');</script>";*/
		if($apro==0){ //ASIGNATURA NO APROBADA O NO VISTA
/*	    echo "<script>alert('ASIG $array_oferta->asi_cod');</script>";*/
		  $requi=$this->Buscar_Requisito($array_oferta->asi_cod);
		  $cant_req=mysql_num_rows($requi);
		  $cant_req_apr=0;
/*	    if($this->ci='16745192' && $array_oferta->asi_cod=='CSL-10623') echo "<script>alert('CANTIDAD DE REQUISITOS $cant_req');</script>";*/
		  while($array_req=mysql_fetch_object($requi)){//REVISAR CADA REQUISITO SI ESTA APROBADO
/*	    echo "<script>alert('ENTRE A REVISAR CADA REQUISITO SI ESTA APROBADO $array_req->asi_cod_req');</script>";*/
		    $requi_con=$this->Buscar_Cond_Asig($array_req->asi_cod_req);
		    $cant_req_t=mysql_num_rows($requi_con);
			if($cant_req_t>0){
			  $cant_req_apr++;
			}
		  }
/*if($this->ci='16745192' && $array_oferta->asi_cod=='CSL-10623') echo "<script>alert('COMPARAR CANT REQUISITOS $cant_req==$cant_req_apr');</script>";*/
		  if($cant_req==$cant_req_apr){
		    $co_requi=$this->Buscar_Co_Requisito($array_oferta->asi_cod);
		    $cant_co_req=mysql_num_rows($co_requi);
		    $cant_co_req_apr=0;
/*if($this->ci='16745192' && $array_oferta->asi_cod=='CSL-10623') echo "<script>alert('CANTIDAD DE CO-REQUISITOS $cant_co_req');</script>";*/
		    while($array_co_req=mysql_fetch_object($co_requi)){//REVISAR CADA CO-REQUISITO SI ESTA APROBADO O OFERTADO.
/*	    echo "<script>alert('ENTRE A REVISAR CADA CO-REQUISITO SI ESTA APROBADO O OFERTADO $array_co_req->asi_cod_req');</script>";*/
		      $co_requi_con=$this->Buscar_Cond_Asig($array_co_req->asi_cod_req);
		      $cant_co_req_t=mysql_num_rows($co_requi_con);
/*	    echo "<script>alert('CO $cant_co_req_t>0');</script>";*/
			  if($cant_co_req_t>0){//REVISAR CADA CO-REQUISITO SI ESTA APROBADO
			    $cant_co_req_apr++;
			  }
			  /*else{ //REVISAR CADA CO-REQUISITO SI ESTA OFERTADO Y LA PUEDE VER
			    $co_req_asi_ofer=$this->Buscar_Asig_Oferta($array_co_req->asi_cod_req);
				$cant_co_req_asi_ofer=mysql_num_rows($co_req_asi_ofer);
				if($cant_co_req_asi_ofer>0){//REVISAR SI EL CORREQUISITO LO PUEDE VER
				   $resul=$this->Ciclo($array_co_req->asi_cod_req);
			       if($resul!="")
			         $cant_co_req_apr++;
				}
			  }*/
		    }
/*if($this->ci='16745192' && $array_oferta->asi_cod=='CSL-10623') echo "<script>alert('COMPARAR CO-REQUISITO $cant_co_req==$cant_co_req_apr');</script>";*/
			if($cant_co_req==$cant_co_req_apr){
/*if($this->ci='16745192' && $array_oferta->asi_cod=='CSL-10623') echo "<script>alert('COMPARAR SE ES SIN REQUISITO $cant_req_apr==0 && $cant_co_req_apr==0');</script>";*/
		      if($cant_req_apr==0 && $cant_co_req_apr==0){
			    $asi_sin_req=$this->Buscar_Asi_Sin_Requisito($array_oferta->asi_cod);
		        $cant_sin_req=mysql_num_rows($asi_sin_req);
		        $cant_sin_req_apr=0;
/*if($this->ci='16745192' && $array_oferta->asi_cod=='CSL-10623') echo "<script>alert('CANTIDAD SIN REQUISITOS $cant_sin_req');</script>";*/
			    while($array_sin_req=mysql_fetch_object($asi_sin_req)){//REVISAR CADA ASIGNATURA SIN REQUISITO SI ESTA APROBADO
/*if($this->ci='16745192' && $array_oferta->asi_cod=='CSL-10623') echo "<script>alert('ENTRE A REVISAR CADA CADA ASIGNATURA SIN REQUISITO SI ESTA APROBADO $array_sin_req->asi_cod');</script>";*/
			      $sin_requi_con=$this->Buscar_Cond_Asig($array_sin_req->asi_cod);
		          $cant_sin_req_t=mysql_num_rows($sin_requi_con);
			      if($cant_sin_req_t>0){
			        $cant_sin_req_apr++;
			      }
			    }
/*if($this->ci='16745192' && $array_oferta->asi_cod=='CSL-10623') echo "<script>alert(COMPARAR SIN REQUISITO cant_sin_req==$cant_sin_req_apr');</script>";*/
			    if($cant_sin_req==$cant_sin_req_apr){ //SI TODO ESTA APROBADO GUARDAR EN LA LISTA A MOSTRAR
			      if($lis_asi_ofer==''){
				    $lis_asi_ofer1="".$array_oferta->asi_cod."";
				    $lis_asi_ofer="'".$array_oferta->asi_cod."'";
				  }
			      else{
				    $lis_asi_ofer1="".$lis_asi_ofer1.",".$array_oferta->asi_cod;
				    $lis_asi_ofer="".$lis_asi_ofer.",'".$array_oferta->asi_cod."'";
				  }
/*if($this->ci='16745192' && $array_oferta->asi_cod=='CSL-10623') echo "<script>alert('$array_oferta->asi_cod');</script>";*/
			    }
			  }
			  else{
			    if($lis_asi_ofer==''){
				  $lis_asi_ofer1="".$array_oferta->asi_cod."";
				  $lis_asi_ofer="'".$array_oferta->asi_cod."'";
				}
			    else{
				  $lis_asi_ofer1="".$lis_asi_ofer1.",".$array_oferta->asi_cod;
				  $lis_asi_ofer="".$lis_asi_ofer.",'".$array_oferta->asi_cod."'";
				}
			  }
			}
		  }
		}
	  }
	}
	else{
	  echo "<script>alert('LO SIENTO NO SE REALIZO UN PROCESO DE INSCRIPCIÓN EN EL PERÍODO ACADÉMICO $PAC_ULTI[1]');</script>";
	    $accion='INSERTAR';
        $Operacion="PROCESO DE INSCRIPCIÓN ".$this->pac_id." NO SE REALIZO UN PROCESO DE INSCRIPCIÓN EN EL PERIODO ACADEMICO ANTERIOR";
	    $this->guardar_accion2($accion,"detins",$Operacion);
		echo "<script>setTimeout(\"location.href='../Menu/menu_princ.php'\");</script>";
	}
	if($lis_asi_ofer==""){
	  echo "<script>alert('LO SIENTO NO SE REALIZÓ OFERTA DE ASIGNATURAS PARA LA CARRERA Y COHORTE AL QUE PERTENECE Ó NINGUNA ASIGNATURA OFERTADA TIENE DERECHO A INSCRIBIRLA POR NO CUMPLIR CON LOS REQUISITOS NECESARIOS Ó POR YA ESTAR APROBADAS');</script>";
	    $accion='INSERTAR';
        $Operacion="PROCESO DE INSCRIPCIÓN ".$this->pac_id." NO SE REALIZÓ OFERTA DE ASIGNATURAS PARA LA CARRERA Y COHORTE AL QUE PERTENECE Ó NINGUNA ASIGNATURA OFERTADA TIENE DERECHO A INSCRIBIRLA POR NO CUMPLIR CON LOS REQUISITOS NECESARIOS Ó POR YA ESTAR APROBADAS";
	    $this->guardar_accion2($accion,"detins",$Operacion);
		echo "<script>setTimeout(\"location.href='../Menu/menu_princ.php'\");</script>";
	}
/*	echo "<script>alert('LISTA $lis_asi_ofer1');</script>";*/
	return $lis_asi_ofer;
  }
//******************************************************************
  function Inscripcion_Semestre($viejo_discente){
	$this->ci=$_SESSION[ci];
	$this->pac_id=$_SESSION[pac_id];
    $this->coh_id=$_SESSION[coh_id];
    $this->mod_id=$_SESSION[mod_id];
    $this->reg_id=$_SESSION[reg_id];
    $this->esp_id=$_SESSION[esp_id];
    $this->pen_top=$_SESSION[pen_top];
//	$resp_ultimo=$this->Listado_Pacade3();
//	$resp_todo=$this->Listado_Pacade_Todos();
//	$pac_ant=mysql_fetch_object($resp_ultimo);
//	$pac_tod=mysql_fetch_object($resp_todo);
//	$PAC_ULTI=explode("-",$pac_tod->pac_id);//explode("-",'I-12011');
	$lis_asi_ofer='';
	$lis_asi_ofer1='';
//	if($pac_ant->pac_id==$PAC_ULTI[1]){//REVISAR SI SE INSCRIBIO EN EL PERIODO ACADÉMICO ANTERIOR
	  $oferta=$this->Buscar_Oferta($viejo_discente);
	  while($array_oferta=mysql_fetch_object($oferta)){
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('ENTRE A REVISAR CADA ASIGNATURA $array_oferta->asi_cod');</script>";*/
	    $mat_apro=$this->Buscar_Cond_Asig($array_oferta->asi_cod);
		$apro=mysql_num_rows($mat_apro);
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('CONDICION DE APROBADA $apro');</script>";*/
		if($apro==0){ //ASIGNATURA NO APROBADA O NO VISTA
/*      if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('ASIG $array_oferta->asi_cod');</script>";*/
		  $requi=$this->Buscar_Requisito($array_oferta->asi_cod);
		  $cant_req=mysql_num_rows($requi);
		  $cant_req_apr=0;
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('CANTIDAD DE REQUISITOS $cant_req, $cant_req_apr');</script>";*/
		  while($array_req=mysql_fetch_object($requi)){//REVISAR CADA REQUISITO SI ESTA APROBADO
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('ENTRE A REVISAR CADA REQUISITO SI ESTA APROBADO $array_req->asi_cod_req');</script>";*/
		    $requi_con=$this->Buscar_Cond_Asig($array_req->asi_cod_req);
		    $cant_req_t=mysql_num_rows($requi_con);
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('REQUISITO APROBADO $cant_req_t');</script>";*/
			if($cant_req_t>0){
			  $cant_req_apr++;
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('aprobo el requisito $cant_req_apr');</script>";*/
			}
			else{
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('ENTRE A COMPARAR UC 1');</script>";*/
			  if($array_req->req_cuc!=""){
			    $resul_UC=mysql_fetch_object($this->Suma_UC_Aprobadas());
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('ENTRE A COMPARAR UC 2 $resul_UC->suma_uc_apr==$array_req->req_cuc');</script>";*/
                if($resul_UC->suma_uc_apr>=$array_req->req_cuc && $resul_UC->suma_uc_apr!='' && $resul_UC->req_cuc!=''){
				  $cant_req_apr++;
				}
			  }
			}
		  }
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('COMPARAR CANT REQUISITOS $cant_req==$cant_req_apr');</script>";*/
		  if($cant_req==$cant_req_apr){
		    $co_requi=$this->Buscar_Co_Requisito($array_oferta->asi_cod);
		    $cant_co_req=mysql_num_rows($co_requi);
		    $cant_co_req_apr=0;
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('CANTIDAD DE CO-REQUISITOS $cant_co_req');</script>";*/
		    while($array_co_req=mysql_fetch_object($co_requi)){//REVISAR CADA CO-REQUISITO SI ESTA APROBADO O OFERTADO.
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('ENTRE A REVISAR CADA CO-REQUISITO SI ESTA APROBADO O OFERTADO $array_co_req->asi_cod_req');</script>";*/
		      $co_requi_con=$this->Buscar_Cond_Asig($array_co_req->asi_cod_req);
		      $cant_co_req_t=mysql_num_rows($co_requi_con);
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('CO $cant_co_req_t>0');</script>";*/
			  if($cant_co_req_t>0){//REVISAR CADA CO-REQUISITO SI ESTA APROBADO
			    $cant_co_req_apr++;
			  }
			  else{ //REVISAR CADA CO-REQUISITO SI ESTA OFERTADO Y LA PUEDE VER
			    $co_req_asi_ofer=$this->Buscar_Asig_Oferta($array_co_req->asi_cod_req);
				$cant_co_req_asi_ofer=mysql_num_rows($co_req_asi_ofer);
				if($cant_co_req_asi_ofer>0){//REVISAR SI EL CORREQUISITO LO PUEDE VER
				   $resul=$this->Ciclo($array_co_req->asi_cod_req,$array_oferta->asi_cod);
			       if($resul!="")
			         $cant_co_req_apr++;
				}
			  }
		    }
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('COMPARAR CO-REQUISITO $cant_co_req==$cant_co_req_apr');</script>";*/
			if($cant_co_req==$cant_co_req_apr){
/*if(($array_oferta->asi_cod=='02' || $array_oferta->asi_cod=='ADG-34143') && $this->ci=='14605972') echo "<script>alert('COMPARAR SE ES SIN REQUISITO $cant_req_apr==0 && $cant_co_req_apr==0 && $cant_req_UC==0');</script>";*/
		      if($cant_req_apr==0 && $cant_co_req_apr==0){
			    $asi_sin_req=$this->Buscar_Asi_Sin_Requisito($array_oferta->asi_cod);
		        $cant_sin_req=mysql_num_rows($asi_sin_req);
		        $cant_sin_req_apr=0;
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('CANTIDAD SIN REQUISITOS $cant_sin_req');</script>";*/
			    while($array_sin_req=mysql_fetch_object($asi_sin_req)){//REVISAR CADA ASIGNATURA SIN REQUISITO SI ESTA APROBADO
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('ENTRE A REVISAR CADA CADA ASIGNATURA SIN REQUISITO SI ESTA APROBADO $array_sin_req->asi_cod');</script>";*/
			      $sin_requi_con=$this->Buscar_Cond_Asig($array_sin_req->asi_cod);
		          $cant_sin_req_t=mysql_num_rows($sin_requi_con);
			      if($cant_sin_req_t>0){
			        $cant_sin_req_apr++;
			      }
			    }
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert(COMPARAR SIN REQUISITO cant_sin_req==$cant_sin_req_apr');</script>";*/
			    if($cant_sin_req==$cant_sin_req_apr){ //SI TODO ESTA APROBADO GUARDAR EN LA LISTA A MOSTRAR
			      if($lis_asi_ofer==''){
				    $lis_asi_ofer1="".$array_oferta->asi_cod."";
				    $lis_asi_ofer="'".$array_oferta->asi_cod."'";
				  }
			      else{
				    $lis_asi_ofer1="".$lis_asi_ofer1.",".$array_oferta->asi_cod;
				    $lis_asi_ofer="".$lis_asi_ofer.",'".$array_oferta->asi_cod."'";
				  }
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('LISTA: $array_oferta->asi_cod');</script>";*/
			    }
			  }
			  else{
/*if(($array_oferta->asi_cod=='CSL-11027') && $this->ci=='19866493') echo "<script>alert('inserto: $array_oferta->asi_cod');</script>";*/
			    if($lis_asi_ofer==''){
				  $lis_asi_ofer1="".$array_oferta->asi_cod."";
				  $lis_asi_ofer="'".$array_oferta->asi_cod."'";
				}
			    else{
				  $lis_asi_ofer1="".$lis_asi_ofer1.",".$array_oferta->asi_cod;
				  $lis_asi_ofer="".$lis_asi_ofer.",'".$array_oferta->asi_cod."'";
				}
			  }
			}
		  }
		}
	  }
	/*}
	else{
	  echo "<script>alert('LO SIENTO NO SE REALIZO UN PROCESO DE INSCRIPCIÓN EN EL PERÍODO ACADÉMICO $PAC_ULTI[0]-$PAC_ULTI[1]');</script>";
	    $accion='INSERTAR';
        $Operacion="PROCESO DE INSCRIPCIÓN ".$this->pac_id." NO SE REALIZO UN PROCESO DE INSCRIPCIÓN";
	    $this->guardar_accion2($accion,"detins",$Operacion);
		echo "<script>setTimeout(\"location.href='../Menu/menu_princ.php'\");</script>";
	}*/
/*if($this->ci=='19866493') echo "<script>alert('LISTA DE OFERTA $lis_asi_ofer1');</script>"; */
	if($lis_asi_ofer==""){
	  echo "<script>alert('LO SIENTO NO SE REALIZÓ OFERTA DE ASIGNATURAS PARA LA CARRERA Y COHORTE AL QUE PERTENECE Ó NINGUNA ASIGNATURA OFERTADA TIENE DERECHO A INSCRIBIRLA POR NO CUMPLIR CON LOS REQUISITOS NECESARIOS Ó POR YA ESTAR APROBADAS');</script>";
	    $accion='INSERTAR';
        $Operacion="PROCESO DE INSCRIPCIÓN ".$this->pac_id." NO SE REALIZÓ OFERTA DE ASIGNATURAS PARA LA CARRERA Y COHORTE AL QUE PERTENECE Ó NINGUNA ASIGNATURA OFERTADA TIENE DERECHO A INSCRIBIRLA POR NO CUMPLIR CON LOS REQUISITOS NECESARIOS Ó POR YA ESTAR APROBADAS";
	    $this->guardar_accion2($accion,"detins",$Operacion);
		echo "<script>setTimeout(\"location.href='../Menu/menu_princ.php'\");</script>";
	}
/*	echo "<script>alert('LISTA $lis_asi_ofer1');</script>";*/
	return $lis_asi_ofer;
  }
//******************************************************************
  function Ciclo($asi_cod,$revisado){
    $asi="";
    $requisi=$this->Buscar_Requisito($asi_cod);
	$cant_requi=mysql_num_rows($requisi);
	$cant_req_apro=0;
/*	    if($this->ci='21003047 ' && $array_oferta->asi_cod=='CSL-10623') echo "<script>alert('CANTIDAD DE REQUISITOS $cant_requi');</script>";*/
	while($array_requi=mysql_fetch_object($requisi)){//REVISAR CADA REQUISITO SI ESTA APROBADO
/*	  echo "<script>alert('ENTRE A REVISAR CADA REQUISITO SI ESTA APROBADO $array_req->asi_cod_req');</script>";*/
	  $requi_cond=$this->Buscar_Cond_Asig($array_requi->asi_cod_req);
	  $cant_req_tr=mysql_num_rows($requi_cond);
	  if($cant_req_tr>0){
		$cant_req_apro++;
	  }
	  else{
		if($array_requi->req_cuc!=""){
	      $resultado_UC=mysql_fetch_object($this->Suma_UC_Aprobadas());
          if($resultado_UC->suma_uc_apr>=$array_requi->req_cuc && $resultado_UC->suma_uc_apr!='' && $resultado_UC->req_cuc!=''){
		    $cant_req_apro++;
		  }
		}
	  }
	}
/*if($this->ci='21003047 ' && $array_oferta->asi_cod=='CSL-10623') echo "<script>alert('COMPARAR CANT REQUISITOS $cant_requi==$cant_req_apro');</script>";*/
	if($cant_requi==$cant_req_apro){
	  $co_requisi=$this->Buscar_Co_Requisito($asi_cod);
	  $cant_co_requi=mysql_num_rows($co_requisi);
	  $cant_co_req_apro=0;
/*if($this->ci='21003047 ' && $array_oferta->asi_cod=='CSL-10623') echo "<script>alert('CANTIDAD DE CO-REQUISITOS $cant_co_requi');</script>";*/
	  while($array_co_requi=mysql_fetch_object($co_requisi)){//REVISAR CADA CO-REQUISITO SI ESTA APROBADO O OFERTADO.
/*	    echo "<script>alert('ENTRE A REVISAR CADA CO-REQUISITO SI ESTA APROBADO O OFERTADO $array_co_req->asi_cod_req');</script>";*/
		$co_requi_cond=$this->Buscar_Cond_Asig($array_co_requi->asi_cod_req);
		$cant_co_req_tr=mysql_num_rows($co_requi_cond);
/*	    echo "<script>alert('CO $cant_co_req_tr>0');</script>";*/
		if($cant_co_req_tr>0){//REVISAR CADA CO-REQUISITO SI ESTA APROBADO
		  $cant_co_req_apro++;
		}
		else{ //REVISAR CADA CO-REQUISITO SI ESTA OFERTADO Y LA PUEDE VER
		  $co_req_asi_ofert=$this->Buscar_Asig_Oferta($array_co_requi->asi_cod_req);
		  $cant_co_req_asi_ofert=mysql_num_rows($co_req_asi_ofert);
		  if($cant_co_req_asi_ofert>0){//REVISAR SI EL CORREQUISITO LO PUEDE VER
            if($revisado!=$array_co_requi->asi_cod_req){
			  $resul=$this->Ciclo($array_co_requi->asi_cod_req,$asi_cod);
			  if($resul!=""){
			    $cant_co_req_apro++;
			  }
			}
			else{
			  $cant_co_req_apro++;
			}
		  }
		}
	  }
/*if($this->ci='21003047' && $asi_cod=='CIV-30314') echo "<script>alert('COMPARAR CO-REQUISITO $cant_co_requi==$cant_co_req_apro');</script>";*/
	  if($cant_co_requi<=$cant_co_req_apro){
/*if($this->ci='21003047' && $asi_cod=='CIV-30314') echo "<script>alert('COMPARAR SE ES SIN REQUISITO $cant_req_apro==0 && $cant_co_req_apro==0');</script>";*/
		if($cant_req_apro==0 && $cant_co_req_apro==0){
		  $asi_sin_requi=$this->Buscar_Asi_Sin_Requisito($asi_cod);
		  $cant_sin_requi=mysql_num_rows($asi_sin_req);
		  $cant_sin_req_apro=0;
/*if($this->ci='21003047' && $asi_cod=='CIV-30314') echo "<script>alert('CANTIDAD SIN REQUISITOS $cant_sin_requi');</script>";*/
		  while($array_sin_req=mysql_fetch_object($asi_sin_requi)){//REVISAR CADA ASIGNATURA SIN REQUISITO SI ESTA APROBADO
/*if($this->ci='21003047' && $array_oferta->asi_cod=='CIV-30314') echo "<script>alert('ENTRE A REVISAR CADA ASIGNATURA SIN REQUISITO SI ESTA APROBADO $array_sin_req->asi_cod');</script>";*/
			$sin_requi_cond=$this->Buscar_Cond_Asig($array_sin_req->asi_cod);
		    $cant_sin_req_tr=mysql_num_rows($sin_requi_cond);
			if($cant_sin_req_tr>0){
			  $cant_sin_req_apro++;
			}
		  }
/*if($this->ci='10167336' && $asi_cod=='CIV-30314') echo "<script>alert(COMPARAR SIN REQUISITO $cant_sin_requi==$cant_sin_req_apr');</script>";*/
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
	return $asi;
  }
//*******************************************************************  
  function Buscar_Inscripcion_Pacade($pac_id){     
	$dias=time();
//  $HORA=date("H:i:s",$dias);
	$FECHA=date("Y-m-d H:i:s",$dias);
  	$sql="SELECT * FROM inscri WHERE ('$FECHA' BETWEEN ins_fin AND ins_ffi) AND pac_id='$pac_id' AND ins_sta=1";	
	//$sql="SELECT * FROM inscri WHERE ins_sta=1"; 
	$result=mysql_query($sql,$this->conexion);
    $array=mysql_fetch_object($result);
	return $array->ins_id;
  }
//******************************************************************
  function Inscribir($pac_id,$asi_cod,$sec_id){
    $this->coh_id=$_SESSION[coh_id];
    $this->mod_id=$_SESSION[mod_id];
    $this->reg_id=$_SESSION[reg_id];
    $this->esp_id=$_SESSION[esp_id];
    $this->pen_top=$_SESSION[pen_top];
    $this->ci=$_SESSION[ci];
	$cod_ins=$this->Buscar_Inscripcion_Pacade($pac_id);//'112011';//
	$dias=time();
//  $HORA=date("H:i:s",$dias);
	$FECHA=date("Y-m-d H:i:s",$dias);
	$entre=0;
/*	echo "<script>alert('INSERT INTO detins SET ins_id=$cod_ins, ci_est=$this->ci, obs_id=1, sec_id=$sec_id, asi_cod=$asi_cod,esp_id=$this->esp_id, reg_id=$this->reg_id, mod_id=$this->mod_id,coh_id=$this->coh_id,pac_id=$pac_id, pen_top=$this->pen_top, det_fin=$FECHA, det_sta=1, det_con=0');</script>";*/
	if($cod_ins!=""){
	  $sql="INSERT INTO detins SET ins_id='$cod_ins', ci_est='$this->ci', obs_id='1', sec_id='$sec_id', asi_cod='$asi_cod',esp_id='$this->esp_id', reg_id='$this->reg_id', mod_id='$this->mod_id',coh_id='$this->coh_id',pac_id='$pac_id', pen_top='$this->pen_top', det_fin='$FECHA', det_sta='1', det_con='0'"; 
	  if(mysql_query($sql,$this->conexion)){
	    $id = mysql_insert_id();
	    $entre=1;
	    $accion='INSERTAR';
        $Operacion="DET_ID: ".$id." ASIGNATURA: ".$asi_cod." PACADE: ".$pac_id." ESTUDIANTE: ".$this->ci." SECCION: ".$sec_id."";	
	    $this->guardar_accion2($accion,"detins",$Operacion);
	  }
	}
	return $entre;
  }
//******************************************************************
  function Sentencia_Inscribir($sql,$mat_insc,$pac_id){
    $entre=0;
    $this->ci=$_SESSION[ci];
    if(mysql_query($sql,$this->conexion)){
	  $id = mysql_insert_id();
	  $entre=1;
	  $accion='INSERTAR';
      $Operacion="ASIG, SECC: ".$mat_insc." PACADE: ".$pac_id." ESTUDIANTE: ".$this->ci."";	
	  $this->guardar_accion2($accion,"detins",$Operacion);
	}
	return $entre;
  }
//******************************************************************
  function Buscar_id_Ope1($nomope){
/*	  	echo "<script>alert('SELECT ope_id FROM operac WHERE ope_nom=$this->nomope');</script>";*/
    $sql="SELECT ope_id FROM operac WHERE ope_nom='$nomope'";	
	$result=mysql_query($sql,$this->conexion);
    $array=mysql_fetch_object($result);
    return $array;
  }
//******************************************************************
  function Buscar_id_Tab1($nomtab){
/*	  	echo "<script>alert('SELECT tab_id FROM tabla WHERE tab_nom=$this->nomtab');</script>";*/
    $sql="SELECT tab_id FROM tabla WHERE tab_nom='$nomtab'";
	$result=mysql_query($sql,$this->conexion);
    $array=mysql_fetch_object($result);
    return $array;
  }
//******************************************************************
  function Autoriza1()
  {
/*	  	echo "<script>alert('SELECT * FROM tab_ope WHERE ope_id=$_SESSION[idoper] AND tab_id=$_SESSION[idtab] AND per_id=$_SESSION[idper] AND tab_ope_sta=1');</script>";*/
    $sql="SELECT * FROM tab_ope WHERE ope_id='$_SESSION[idoper]' AND tab_id='$_SESSION[idtab]' AND per_id='$_SESSION[idper]' AND tab_ope_sta='1'";
	$result=mysql_query($sql,$this->conexion);
    $array=mysql_fetch_object($result);
    return $array;
  }
//******************************************************************
 function getRealIpAddr1() {  
       if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  
              $ip=$_SERVER['HTTP_CLIENT_IP'];  
       } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
              $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];  
       }else{  
              $ip=$_SERVER['REMOTE_ADDR'];  
       }  
       return $ip;  
 }
//******************************************************************
  function guardar_accion2($accion,$tabla,$detalle)
  {
    $resul=0;
	$_SESSION['ip']=$this->getRealIpAddr1(); //Falta la condición para conseguir el ip de la maquina de donde se estan conectado el usuario.
    $idope=$this->Buscar_id_Ope1($accion);
    $_SESSION['idoper']=$idope->ope_id;
	$idtab=$this->Buscar_id_Tab1($tabla);
    $_SESSION['idtab']=$idtab->tab_id;
/*	echo "<script>alert('$_SESSION[ip], $_SESSION[idoper], $_SESSION[idtab]');</script>";*/
    $row = $this->Autoriza1();//recibe el login
    //if($row>0){
	$dias=time();
	 $fecha_hora_TS=date("Y-m-d H:i:s",$dias);
//    $fecha_hora_TS = date("Y-m-d h:i:s");
/*	echo "<script>alert('INSERT INTO bitaco (ci_usu, ope_id, tab_id, per_id, bit_ip, bit_fej, bit_det) VALUES ($_SESSION[ci], $_SESSION[idoper], $_SESSION[idtab], $_SESSION[idper], $_SESSION[ip], $fecha_hora_TS, $detalle)');</script>";*/
    $sql="INSERT INTO bitaco (ci_usu, ope_id, tab_id, per_id, bit_ip, bit_fej, bit_det) VALUES ('$_SESSION[ci]', '$_SESSION[idoper]', '$_SESSION[idtab]', '$_SESSION[idper]', '$_SESSION[ip]', '$fecha_hora_TS', '$detalle')";
	$result=mysql_query($sql,$this->conexion);
    if($result)
	  $resul=1;
    /*}
    else
	  echo "<script>alert('REVISAR LOS PRIVILEGIOS CON EL ADMINISTRADOR');</script>";*/
/*      echo "<script>alert('LO SIENTO NO TIENE AUTORIZACION PARA LA OPERACION QUE ESTA REALIZANDO. POR FAVOR COMINIQUESE CON EL ADMINISTRADOR DEL SISTEMA');</script>";*/
    return $resul;
  }
  
//******************************************************************
  function Buscar_Detins_Secc($cedu,$pac_id,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
    $sql="SELECT A.asi_cod AS 'asi_cod',A.asi_mod AS 'asi_mod', A.asi_nom AS 'asi_nom', A.asi_cuc AS 'asi_cuc', C.sec_nom AS 'sec_nom', D.inf_nom AS 'inf_nom' FROM asigna A, detins B, seccio C, infrae D WHERE B.pac_id='$pac_id' AND B.ci_est='$cedu' AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' AND B.mod_id=A.mod_id AND B.reg_id=A.reg_id AND B.esp_id=A.esp_id AND B.coh_id=A.coh_id AND B.pen_top=A.pen_top AND A.asi_cod=B.asi_cod AND B.sec_id=C.sec_id AND C.inf_id=D.inf_id AND B.det_sta='1'";
	$result=mysql_query($sql,$this->conexion);
    return $result;
  }
//******************************************************************
  function Buscar_UC_Maxima($mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
    $sql="SELECT * FROM pensum WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top'";
	$resul=mysql_query($sql,$this->conexion);
	$UC_max=mysql_fetch_object($resul);
	return $UC_max->pen_muc;
  }
//******************************************************************
  function Buscar_Electiva($asi,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
  
    $sql="SELECT B.ele_nom AS 'ele_nom' FROM asigna_seccio A, electi B WHERE A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.ele_cod=B.ele_cod AND A.asi_cod='$asi' AND A.pac_id='$pac_id'";
	$resul=mysql_query($sql,$this->conexion);
	$Elec=mysql_fetch_object($resul);
/*	echo "<script>alert('ELECTIVA: ');</script>";*/
	$NOM=explode("(",$Elec->ele_nom);
	return $NOM[0];
  }

//******************************************************************
  function Buscar_Estudiante_detins_viejo($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
/*  if($ci=='21440012' || $ci=='24693022'){
  echo "<script>alert('SELECT det_id FROM detins WHERE mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND coh_id=$coh_id AND pen_top=$pen_top AND ci_est=$ci AND det_sta=1');</script>";
  }*/
    $sql="SELECT det_id, coh_id FROM detins WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND ci_est='$ci' AND det_sta='1' GROUP by pac_id";
	$resultado=mysql_query($sql,$this->conexion);
/*	if($ci=='21440012' || $ci=='24693022'){ 
	    echo "<script>alert('FILAS: $filas');</script>";
    }*/
$ext_detins=mysql_fetch_object($resultado);
	$filas=mysql_num_rows($resultado);
        if($ext_detins->coh_id!='12'){
	if($filas<1)
	  $filas=0;
	else
	  $filas=1;
        }
        else{
          if($filas<2)
	    $filas=0;
  	  else
	    $filas=1;
          
        }
	return $filas;
  }
//******************************************************************
  function REPROBADAS_ASIGNATURAS($asi_cod,$ci,$pac){
    $sql="SELECT det_id FROM detins WHERE mod_id='$_SESSION[mod_id]' AND reg_id='$_SESSION[reg_id]' AND esp_id='$_SESSION[esp_id]' AND coh_id='$_SESSION[coh_id]' AND pen_top='$_SESSION[pen_top]' AND asi_cod='$asi_cod' AND ci_est='$ci' AND det_sta='1' AND det_con='0' AND pac_id IN (SELECT pac_id FROM pacade WHERE pac_sta='1' AND mod_id='02' ORDER BY pac_ffin DESC LIMIT 1 , 1)";
	$resultado1=mysql_query($sql,$this->conexion);
	$filas=mysql_num_rows($resultado1);
	if($filas>0)
	  return 1;
	else
	  return 0;
  }
//******************************************************************
  function Buscar_Estudiante_expediente_nuevo($ci){
    $sql="SELECT exp_id FROM expedi WHERE exp_sta='1' AND ci_est='$ci'";
	$resultado2=mysql_query($sql,$this->conexion);
	$filas=mysql_num_rows($resultado2);
	if($filas>0)
	  return 1;
	else
	  return 0;
  }
//******************************************************************
  function Buscar_dat_usuario($ci){
    $sql="SELECT CONCAT(UPPER(ap1),' ',UPPER(ap2),' ',UPPER(no1),' ', UPPER(no2)) AS no_ape FROM persona WHERE ci='$ci' AND sta='1'";
    $usu=mysql_query($sql,$this->conexion);
    $num_filas=mysql_num_rows($usu);
/*	echo "<script>alert('FILAS: $num_filas');</script>";*/
	return $usu;
  }
function Buscar_dat_alum_Matric($ci,$mod_id,$esp_id,$reg_id,$coh_id,$pen_top){
  /*$sql="SELECT B.no1 AS 'no1', B.no2 AS 'no2', B.no3 AS 'no3',B.ap1 AS 'ap1', B.ap2 AS 'ap2', B.ap3 AS 'ap3', C.mod_nom AS 'mod_nom', A.mod_id AS mod_id, A.reg_id AS reg_id ,D.esp_id AS 'esp_id', A.coh_id AS coh_id, A.pen_top AS pen_top, D.esp_nom AS 'esp_nom', E.reg_nom AS 'reg_nom' FROM matric A, persona B, modali C, especi D, regimen E WHERE A.ci='$ci' AND A.matr_sta='1' AND A.matr_tip='0' AND A.ci=B.ci AND B.sta='1' AND A.mod_id=C.mod_id AND C.mod_sta='1'  AND A.esp_id=D.esp_id AND D.esp_sta='1' AND A.reg_id=E.reg_id AND E.reg_sta='1'";
  $alum=mysql_query($sql,$this->conexion);
  return $alum;*/
  $sql="SELECT B.no1 AS 'no1', B.no2 AS 'no2', B.no3 AS 'no3',B.ap1 AS 'ap1', B.ap2 AS 'ap2', B.ap3 AS 'ap3', C.mod_nom AS 'mod_nom', A.mod_id AS mod_id, A.reg_id AS 'reg_id', D.esp_id AS 'esp_id', A.coh_id AS 'coh_id', A.pen_top AS 'pen_top', D.esp_nom AS 'esp_nom', E.reg_nom AS 'reg_nom' FROM matric A, persona B, modali C, especi D, regimen E WHERE A.ci='$ci' AND A.matr_tip='0' AND A.ci=B.ci AND B.sta='1' AND A.mod_id=C.mod_id AND C.mod_sta='1' AND A.esp_id=D.esp_id AND D.esp_sta='1' AND A.reg_id=E.reg_id AND E.reg_sta='1' AND A.mod_id='$mod_id' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top'";
  $alum=mysql_query($sql,$this->conexion);
	return $alum;
  }
//******************************************************************
//******************REALIZADO POR MIGUEL ACERO
//************************INICIO************************************
  function Buscar_dat_alum($ci){
  /*$sql="SELECT B.no1 AS 'no1', B.no2 AS 'no2', B.no3 AS 'no3',B.ap1 AS 'ap1', B.ap2 AS 'ap2', B.ap3 AS 'ap3', C.mod_nom AS 'mod_nom', A.mod_id AS mod_id, A.reg_id AS reg_id ,D.esp_id AS 'esp_id', A.coh_id AS coh_id, A.pen_top AS pen_top, D.esp_nom AS 'esp_nom', E.reg_nom AS 'reg_nom' FROM matric A, persona B, modali C, especi D, regimen E WHERE A.ci='$ci' AND A.matr_sta='1' AND A.matr_tip='0' AND A.ci=B.ci AND B.sta='1' AND A.mod_id=C.mod_id AND C.mod_sta='1'  AND A.esp_id=D.esp_id AND D.esp_sta='1' AND A.reg_id=E.reg_id AND E.reg_sta='1'";
  $alum=mysql_query($sql,$this->conexion);
  return $alum;*/
  $sql="SELECT B.no1 AS 'no1', B.no2 AS 'no2', B.no3 AS 'no3',B.ap1 AS 'ap1', B.ap2 AS 'ap2', B.ap3 AS 'ap3', C.mod_nom AS 'mod_nom', A.mod_id AS mod_id, A.reg_id AS reg_id ,D.esp_id AS 'esp_id', A.coh_id AS coh_id, A.pen_top AS pen_top, D.esp_nom AS 'esp_nom', E.reg_nom AS 'reg_nom' FROM matric A, persona B, modali C, especi D, regimen E WHERE A.ci='$ci' AND A.matr_sta='1' AND A.matr_tip='0' AND A.ci=B.ci AND B.sta='1' AND A.mod_id=C.mod_id AND C.mod_sta='1' AND A.esp_id=D.esp_id AND D.esp_sta='1' AND A.reg_id=E.reg_id AND E.reg_sta='1'";
  $alum=mysql_query($sql,$this->conexion);
    if(mysql_num_rows($alum)>0){
	return $alum;
    }
	else
	{
	$sql1="SELECT B.coh_id AS coh_id, B.mod_id AS mod_id, B.reg_id AS reg_id, B.esp_id AS esp_id, B.pen_top AS pen_top FROM pacade A,detins B WHERE A.pac_id=B.pac_id AND B.ci_est='$ci' AND A.mod_id=B.mod_id AND B.det_sta='1' GROUP BY B.coh_id, B.mod_id, B.reg_id, B.esp_id, B.pen_top, A.pac_id, B.ci_est ORDER BY pac_fin DESC";	
	$busc_mat=mysql_query($sql1,$this->conexion);
	$mat_enc=mysql_fetch_object($busc_mat);
	/*echo "<script>alert('A.mod_id=$mat_enc->mod_id AND A.reg_id=$mat_enc->reg_id AND A.esp_id=$mat_enc->esp_id AND A.coh_id=$mat_enc->coh_id AND A.pen_top=$mat_enc->pen_top')</script>";*/
	$sql2="SELECT B.no1 AS 'no1', B.no2 AS 'no2', B.no3 AS 'no3',B.ap1 AS 'ap1', B.ap2 AS 'ap2', B.ap3 AS 'ap3', C.mod_nom AS 'mod_nom', A.mod_id AS mod_id, A.reg_id AS reg_id ,D.esp_id AS 'esp_id', A.coh_id AS coh_id, A.pen_top AS pen_top, D.esp_nom AS 'esp_nom', E.reg_nom AS 'reg_nom' FROM matric A, persona B, modali C, especi D, regimen E WHERE A.ci='$ci' AND A.matr_sta='0' AND A.matr_tip='0' AND A.ci=B.ci AND B.sta='1' AND A.mod_id=C.mod_id AND C.mod_sta='1'  AND A.esp_id=D.esp_id AND D.esp_sta='1' AND A.reg_id=E.reg_id AND E.reg_sta='1' AND A.mod_id='$mat_enc->mod_id' AND A.reg_id='$mat_enc->reg_id' AND A.esp_id='$mat_enc->esp_id' AND A.coh_id='$mat_enc->coh_id' AND A.pen_top='$mat_enc->pen_top'";
	$alum1=mysql_query($sql2,$this->conexion);
	/*$mat_enc1=mysql_fetch_object($alum1);
	/*echo "<script>alert('$mat_enc1->no1, $mat_enc1->no2, $mat_enc1->no3,$mat_enc1->ap1, $mat_enc1->ap2, $mat_enc1->ap3, $mat_enc1->mod_nom, $mat_enc1->mod_id, $mat_enc1->reg_id ,$mat_enc1->esp_id, $mat_enc1->coh_id, $mat_enc1->pen_top, $mat_enc1->esp_nom, $mat_enc1->reg_nom')</script>";*/
	return $alum1;
	}
  }
 //******************************************************************  
  function Prim_peri_acad($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $dias=time();
  $fecha=date("Y-m-d H:i:s",$dias);  
  $sql="SELECT A.pac_id AS pac_id, A.pac_nom AS pac_nom, B.coh_id AS coh_id FROM pacade A, detins B, matric C WHERE A.pac_sta='1' AND det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' AND A.pac_id NOT IN (SELECT pac_id FROM pacade WHERE pac_sta='1' AND DATEDIFF(pac_ffin,'$fecha')>=0) GROUP BY A.pac_id, A.pac_nom, A.pac_sta, B.det_sta, B.mod_id, C.matr_sta, C.matr_tip, C.ci, B.reg_id, B.esp_id, B.coh_id, B.pen_top ORDER BY A.pac_fin";
  $pacade=mysql_query($sql,$this->conexion);
  return $pacade;
  }
 //******************************************************************  
  function Prim_peri_acad_Reporte($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $dias=time();
  $fecha=date("Y-m-d H:i:s",$dias);  
  $sql="SELECT A.pac_id AS pac_id, A.pac_nom AS pac_nom, B.coh_id AS coh_id FROM pacade A, detins B, matric C WHERE A.pac_sta='1' AND det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' GROUP BY A.pac_id, A.pac_nom, A.pac_sta, B.det_sta, B.mod_id, C.matr_sta, C.matr_tip, C.ci, B.reg_id, B.esp_id, B.coh_id, B.pen_top ORDER BY A.pac_fin";
  $pacade=mysql_query($sql,$this->conexion);
  return $pacade;
  }
//****************************************************************** 
  //******************************************************************  
  function Ultimo_peri_acad($ci){
  $dias=time();
  $fecha=date("Y-m-d H:i:s",$dias);  
  $sql="SELECT MAX( RIGHT( ins_id, 4 ) ) FROM detins WHERE ci_est =  '$ci' and det_sta=1";
  $ano_ult=mysql_query($sql,$this->conexion);
  $row=mysql_fetch_row($ano_ult);
  $ano_ult=implode('/*',$row);
  return $ano_ult;
  }
//******************************************************************
  function Ano_grado($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
/*echo "<script>alert('$ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top');</script>";*/
/*echo "<script>alert('SELECT A.gra_fec AS gra_fec FROM gra_aca A, gradua B WHERE A.gra_sta=1 AND B.grad_sta=1 AND A.gra_id=B.gra_id AND B.ci_est=$ci AND B.esp_id=$esp_id AND B.reg_id=$reg_id AND B.mod_id=$mod_id AND B.coh_id=$coh_id AND B.pen_top=$pen_top');</script>";*/
  $sql_grado="SELECT A.gra_fec AS gra_fec, B.ci_est AS ci_est FROM gra_aca A, gradua B WHERE A.gra_sta='1' AND B.grad_sta='1' AND A.gra_id=B.gra_id AND B.ci_est='$ci' AND B.esp_id='$esp_id' AND B.reg_id='$reg_id' AND B.mod_id='$mod_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top'";
  $ano_gra=mysql_query($sql_grado,$this->conexion);
  $fila=mysql_num_rows($ano_gra);
  $ext_val_ano_grado=mysql_fetch_object($ano_gra);
/*  echo "<script>alert('fila $fila, fecha de grado $ext_val_ano_grado->gra_fec');</script>";*/
  return $ext_val_ano_grado;
  }
//******************************************************************  
  function Record($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $dias=time();
  $fecha=date("Y-m-d H:i:s",$dias);
//  $valor="SELECT pac_id FROM pacade WHERE pac_sta='1' AND DATEDIFF(pac_ffin,'$fecha')>=0 ORDER BY pac_fin DESC";
//  $ult_pac_id=mysql_query($valor,$this->conexion);
//  $ext_ult_pac_id=mysql_fetch_object($ult_pac_id);
//  $pac_id=$ext_ult_pac_id->pac_id;
  $sql="SELECT A.pac_fin AS pac_fin, A.pac_id AS pac_id, A.pac_nom AS pac_nom, A.pac_int AS pac_int, D.asi_mod AS asi_mod, D.asi_cod AS asi_cod, D.asi_nom AS asi_nom, D.asi_rep AS asi_rep, D.tip_id AS tip_id, B.det_nfi AS det_nfi, B.det_nre AS det_nre, B.det_nde AS det_nde, D.asi_cuc AS asi_cuc, B.obs_id AS obs_id, B.det_con AS det_con FROM pacade A, detins B, matric C, asigna D WHERE A.pac_sta='1' AND B.det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.asi_cod=D.asi_cod AND  B.mod_id=D.mod_id AND B.reg_id=D.reg_id AND B.esp_id=D.esp_id AND B.coh_id=D.coh_id AND B.pen_top=D.pen_top AND D.asi_sta='1' AND A.pac_id NOT IN (SELECT pac_id FROM pacade WHERE pac_sta='1' AND DATEDIFF(pac_ffin,'$fecha')>=0) AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' GROUP BY A.pac_id, A.pac_nom, A.pac_sta, B.obs_id, B.det_sta, B.mod_id, C.matr_sta, C.matr_tip, C.ci, B.reg_id, B.esp_id, B.coh_id, B.pen_top, D.asi_cod, D.asi_sta ORDER BY A.pac_fin, D.asi_mod, D.asi_nom";
  $record=mysql_query($sql,$this->conexion);  
	  $fila=mysql_num_rows($record);
/*  echo "<script> alert(' PASO LA SENTENCIA FILA $fila');</script>";*/
  
  return $record;
  }
//******************************************************************    
  function redondeado ($numero, $decimales){
  $factor = pow(10, $decimales);  
  return (round($numero*$factor)/$factor); 
  } 
//****************************************************************** 
  function obs_matric($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $sql="SELECT matr_obs FROM matric WHERE ci='$ci' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top'";
  $observ=mysql_query($sql,$this->conexion);
  return $observ;
  }
//******************************************************************
  function buscar_electivas_record($ci,$asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $sql="SELECT ele_cod, ele_nom FROM electi WHERE ele_cod IN (SELECT A.ele_cod FROM asigna_seccio A, detins B, matric C WHERE C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.det_sta='1' AND C.mod_id=B.mod_id AND C.reg_id=B.reg_id AND C.esp_id=B.esp_id AND C.coh_id=B.coh_id AND C.pen_top=B.pen_top AND B.asi_cod=A.asi_cod AND B.pac_id=A.pac_id AND B.sec_id=A.sec_id AND B.mod_id=A.mod_id AND B.reg_id=A.reg_id AND B.esp_id=A.esp_id AND B.coh_id=A.coh_id AND B.pen_top=A.pen_top AND A.ase_sta='1' AND B.asi_cod='$asi_cod' AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top')";
  $valor=mysql_query($sql,$this->conexion);
  return $valor;
  } 
//******************************************************************
  function busc_semes_term($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $dias=time();
  $fecha=date("Y-m-d H:i:s",$dias);
  $valor="SELECT B.pac_id AS pac_id FROM matric A, detins B, pacade C WHERE A.ci='$ci' AND matr_tip='0' AND A.ci=B.ci_est AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.det_sta='1' AND B.pac_id=C.pac_id AND B.mod_id=C.mod_id AND C.pac_sta='1' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND DATEDIFF(pac_ffin,'$fecha')>=0) GROUP BY B.pac_id ORDER BY C.pac_fin DESC";
  $ult_pac_id=mysql_query($valor,$this->conexion);
  $ext_ult_pac_id=mysql_fetch_object($ult_pac_id);
  $pac_id=$ext_ult_pac_id->pac_id;
  $sql="SELECT C.asi_mod FROM matric A, detins B, asigna C WHERE A.ci='$ci' AND matr_tip='0' AND A.ci=B.ci_est AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.det_sta='1' AND B.asi_cod=C.asi_cod AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND C.asi_sta='1' AND B.pac_id='$pac_id' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' GROUP BY C.asi_mod ORDER BY C.asi_mod";
   $valor=mysql_query($sql,$this->conexion);
  return $valor;
  }
//******************************************************************  
  function Conteo_Record($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
/*  $valor="SELECT pac_id FROM pacade ORDER BY pac_fin DESC";
  $ult_pac_id=mysql_query($valor,$this->conexion);
  $ext_ult_pac_id=mysql_fetch_object($ult_pac_id);
  $pac_id=$ext_ult_pac_id->pac_id;*/
  $dias=time();
  $fecha=date("Y-m-d H:i:s",$dias);
  $sql="SELECT A.pac_id AS pac_id, count(A.pac_id) AS conteo, A.pac_int AS pac_int FROM pacade A, detins B, matric C, asigna D WHERE A.pac_sta='1' AND B.det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.asi_cod=D.asi_cod AND  B.mod_id=D.mod_id AND B.reg_id=D.reg_id AND B.esp_id=D.esp_id AND B.coh_id=D.coh_id AND B.pen_top=D.pen_top AND D.asi_sta='1' AND A.pac_id NOT IN (SELECT pac_id FROM pacade WHERE pac_sta='1' AND DATEDIFF(pac_ffin,'$fecha')>=0) AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' GROUP BY A.pac_id ORDER BY A.pac_fin, D.asi_mod, D.asi_nom";
  $conteo_record=mysql_query($sql,$this->conexion);
  return $conteo_record;
  }
//******************************************************************  
  function Conteo_Record_2($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id_buscar){
/*  $valor="SELECT pac_id FROM pacade ORDER BY pac_fin DESC";
  $ult_pac_id=mysql_query($valor,$this->conexion);
  $ext_ult_pac_id=mysql_fetch_object($ult_pac_id);
  $pac_id=$ext_ult_pac_id->pac_id;*/
  $dias=time();
  $fecha=date("Y-m-d H:i:s",$dias);
  $sql="SELECT A.pac_id AS pac_id, B.asi_cod AS asi_cod, A.pac_int AS pac_int FROM pacade A, detins B, matric C, asigna D WHERE A.pac_sta='1' AND B.det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.asi_cod=D.asi_cod AND A.pac_id='$pac_id_buscar' AND  B.mod_id=D.mod_id AND B.reg_id=D.reg_id AND B.esp_id=D.esp_id AND B.coh_id=D.coh_id AND B.pen_top=D.pen_top AND asi_sta='1' AND A.pac_id NOT IN (SELECT pac_id FROM pacade WHERE pac_sta='1' AND DATEDIFF(pac_ffin,'$fecha')>=0) AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' GROUP BY A.pac_id, B.pac_id ORDER BY A.pac_fin, D.asi_mod, D.asi_nom";
  $conteo_record=mysql_query($sql,$this->conexion);  
	  $fila=mysql_num_rows($conteo_record);
  return $fila;
  }
//******************************************************************
  function Last_pacade_alum($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $valor="SELECT pac_id FROM pacade ORDER BY pac_fin DESC";
  $ult_pac_id=mysql_query($valor,$this->conexion);
  $ext_ult_pac_id=mysql_fetch_object($ult_pac_id);
  $pac_id=$ext_ult_pac_id->pac_id;
  $sql="SELECT A.pac_id FROM pacade A, detins B, matric C, asigna D WHERE A.pac_sta='1' AND B.det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.asi_cod=D.asi_cod AND  B.mod_id=D.mod_id AND B.reg_id=D.reg_id AND B.esp_id=D.esp_id AND B.coh_id=D.coh_id AND B.pen_top=D.pen_top AND asi_sta='1' AND A.pac_id NOT IN ('$pac_id') AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' GROUP BY A.pac_id ORDER BY A.pac_fin DESC";
  $last_pacade_estud=mysql_query($sql,$this->conexion);
  return $last_pacade_estud;
  }
//******************************************************************   
  function conteo_rep_alum($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $valor="SELECT pac_id FROM pacade ORDER BY pac_fin DESC";
  $ult_pac_id=mysql_query($valor,$this->conexion);
  $ext_ult_pac_id=mysql_fetch_object($ult_pac_id);
  $pac_id=$ext_ult_pac_id->pac_id;
  $sql="SELECT A.pac_id AS pac_id, count(A.pac_id) AS conteo FROM pacade A, detins B, matric C, asigna D WHERE A.pac_sta='1' AND B.det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.asi_cod=D.asi_cod AND  B.mod_id=D.mod_id AND B.reg_id=D.reg_id AND B.esp_id=D.esp_id AND B.coh_id=D.coh_id AND B.pen_top=D.pen_top AND asi_sta='1' AND A.pac_id NOT IN ('$pac_id') AND B.det_nre!='' AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' GROUP BY A.pac_id ORDER BY A.pac_fin, D.asi_mod, D.asi_nom";
  $cont_rep_alum=mysql_query($sql,$this->conexion);
  return $cont_rep_alum;
  }
//******************************************************************   
  function conteo_equiv_alum($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $valor="SELECT pac_id FROM pacade ORDER BY pac_fin DESC";
  $ult_pac_id=mysql_query($valor,$this->conexion);
  $ext_ult_pac_id=mysql_fetch_object($ult_pac_id);
  $pac_id=$ext_ult_pac_id->pac_id;
  $sql="SELECT A.pac_id AS pac_id, B.asi_cod AS asi_cod, B.det_nde AS 'nde', B.det_con AS 'cond' FROM pacade A, detins B, matric C, asigna D WHERE A.pac_sta='1' AND B.det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.asi_cod=D.asi_cod AND B.mod_id=D.mod_id AND B.reg_id=D.reg_id AND B.esp_id=D.esp_id AND B.coh_id=D.coh_id AND B.pen_top=D.pen_top AND asi_sta='1' AND A.pac_id NOT IN ('$pac_id') AND B.obs_id='4' AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' AND B.asi_cod NOT IN ('CIF-03110', 'CIL-02110', 'CIM-01110') GROUP BY A.pac_id, B.asi_cod ORDER BY A.pac_fin, D.asi_mod, D.asi_nom";
  $cont_equ_alum=mysql_query($sql,$this->conexion);
  return $cont_equ_alum;
  }
//******************************************************************   
  function conteo_equiv_alum_CINU($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $valor="SELECT pac_id FROM pacade ORDER BY pac_fin DESC";
  $ult_pac_id=mysql_query($valor,$this->conexion);
  $ext_ult_pac_id=mysql_fetch_object($ult_pac_id);
  $pac_id=$ext_ult_pac_id->pac_id;
  $sql="SELECT A.pac_id AS pac_id, B.asi_cod AS asi_cod, B.det_nde AS 'nde', B.det_con AS 'cond' FROM pacade A, detins B, matric C, asigna D WHERE A.pac_sta='1' AND B.det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.asi_cod=D.asi_cod AND B.mod_id=D.mod_id AND B.reg_id=D.reg_id AND B.esp_id=D.esp_id AND B.coh_id=D.coh_id AND B.pen_top=D.pen_top AND D.asi_sta='1' AND A.pac_id NOT IN ('$pac_id') AND B.obs_id='4' AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' AND B.asi_cod IN ('CIF-03110', 'CIL-02110', 'CIM-01110') GROUP BY A.pac_id, B.asi_cod ORDER BY A.pac_fin, D.asi_mod, D.asi_nom";
  $cont_equ_alum=mysql_query($sql,$this->conexion);
  return $cont_equ_alum;
  }
//******************************************************************   
  function conteo_mat_pacade($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
    $sql="SELECT A.pac_id AS pac_id, B.asi_cod AS asi_cod, D.asi_nom AS 'asi_nom' FROM pacade A, detins B, matric C, asigna D WHERE A.pac_sta='1' AND B.det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.asi_cod=D.asi_cod AND B.mod_id=D.mod_id AND B.reg_id=D.reg_id AND B.esp_id=D.esp_id AND B.coh_id=D.coh_id AND B.pen_top=D.pen_top AND D.asi_sta='1' AND A.pac_id='$pac_id' AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' AND B.asi_cod NOT IN ('CIF-03110', 'CIL-02110', 'CIM-01110') GROUP BY A.pac_id, B.asi_cod ORDER BY A.pac_fin, D.asi_mod, D.asi_nom";
    $cont_mat_alum=mysql_query($sql,$this->conexion);
    return $cont_mat_alum;
  }
//******************************************************************   
  function conteo_mat_pacade_CINU($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
    $sql="SELECT A.pac_id AS pac_id, B.asi_cod AS asi_cod, D.asi_nom AS 'asi_nom' FROM pacade A, detins B, matric C, asigna D WHERE A.pac_sta='1' AND B.det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.asi_cod=D.asi_cod AND B.mod_id=D.mod_id AND B.reg_id=D.reg_id AND B.esp_id=D.esp_id AND B.coh_id=D.coh_id AND B.pen_top=D.pen_top AND D.asi_sta='1' AND A.pac_id='$pac_id' AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' AND B.asi_cod IN ('CIF-03110', 'CIL-02110', 'CIM-01110') GROUP BY A.pac_id, B.asi_cod ORDER BY A.pac_fin, D.asi_mod, D.asi_nom";
    $cont_mat_alum=mysql_query($sql,$this->conexion);
    return $cont_mat_alum;
  }
//******************************************************************   
  function conteo_mat_pacade_equi($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
    $valor="SELECT pac_id FROM pacade ORDER BY pac_fin DESC";
    $ult_pac_id=mysql_query($valor,$this->conexion);
    $ext_ult_pac_id=mysql_fetch_object($ult_pac_id);
    $pac_id=$ext_ult_pac_id->pac_id;
    $sql="SELECT A.pac_id AS pac_id, B.asi_cod AS asi_cod, D.asi_nom AS 'asi_nom' FROM pacade A, detins B, matric C, asigna D WHERE A.pac_sta='1' AND B.det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.asi_cod=D.asi_cod AND B.mod_id=D.mod_id AND B.reg_id=D.reg_id AND B.esp_id=D.esp_id AND B.coh_id=D.coh_id AND B.pen_top=D.pen_top AND asi_sta='1' AND A.pac_id NOT IN ('$pac_id') AND B.obs_id='4' AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' AND B.asi_cod NOT IN ('CIF-03110', 'CIL-02110', 'CIM-01110') GROUP BY A.pac_id, B.asi_cod ORDER BY A.pac_fin, D.asi_mod, D.asi_nom";
    $cont_equ_alum=mysql_query($sql,$this->conexion);
    return $cont_equ_alum;
  }
//******************************************************************   
  function conteo_mat_pacade_equi_CINU($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
    $valor="SELECT pac_id FROM pacade ORDER BY pac_fin DESC";
    $ult_pac_id=mysql_query($valor,$this->conexion);
    $ext_ult_pac_id=mysql_fetch_object($ult_pac_id);
    $pac_id=$ext_ult_pac_id->pac_id;
    $sql="SELECT A.pac_id AS pac_id, B.asi_cod AS asi_cod, D.asi_nom AS 'asi_nom' FROM pacade A, detins B, matric C, asigna D WHERE A.pac_sta='1' AND B.det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.asi_cod=D.asi_cod AND B.mod_id=D.mod_id AND B.reg_id=D.reg_id AND B.esp_id=D.esp_id AND B.coh_id=D.coh_id AND B.pen_top=D.pen_top AND asi_sta='1' AND A.pac_id NOT IN ('$pac_id') AND B.obs_id='4' AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' AND B.asi_cod IN ('CIF-03110', 'CIL-02110', 'CIM-01110') GROUP BY A.pac_id, B.asi_cod ORDER BY A.pac_fin, D.asi_mod, D.asi_nom";
    $cont_equ_alum=mysql_query($sql,$this->conexion);
    return $cont_equ_alum;
  }
//******************************************************************   
  function conteo_mat_rep_alum($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
  $sql="SELECT A.pac_id AS pac_id, B.asi_cod AS asi_cod, D.asi_nom AS 'asi_nom' FROM pacade A, detins B, matric C, asigna D WHERE A.pac_sta='1' AND B.det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND C.ci='$ci' AND C.matr_tip='0' AND C.ci=B.ci_est AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.asi_cod=D.asi_cod AND  B.mod_id=D.mod_id AND B.reg_id=D.reg_id AND B.esp_id=D.esp_id AND B.coh_id=D.coh_id AND B.pen_top=D.pen_top AND D.asi_sta='1' AND A.pac_id='$pac_id' AND B.det_nre!='' AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' GROUP BY A.pac_id, B.asi_cod ORDER BY A.pac_fin, D.asi_mod, D.asi_nom";
  $cont_rep_alum=mysql_query($sql,$this->conexion);
  return $cont_rep_alum;
  }
//******************************************************************   
  function cantidad_lineas_nom_mat($nom){
    $can_car=strlen($nom);  	 
  	 $can_lin=0;
  	 if(intval($can_car)>intval(48)){
  	   $arr_nom_mat=explode(" ",$nom);
  	   $cuant_array=count($arr_nom_mat);
  	   $i=0;
  	   $sum_car=0;
  	   /*echo "<script>alert('$arr_nom_mat[$i]');</script>";*/
  	   while($i<$cuant_array){
  	     /*echo "<script>alert('$arr_nom_mat[$i]');</script>";*/
  	     $car_pal=strlen($arr_nom_mat[$i]);
        if($sum_car==0)  	     
  	       $sum_car=$sum_car+$car_pal;
  	     else
  	     	 $sum_car=$sum_car+$car_pal+1;
  	     if(intval($sum_car)>intval(48)){
  	     	 $sum_car=$car_pal;
  	     	 $can_lin=$can_lin+1;
  	     }
  	     $i++;
  	   }
  	 }
    return $can_lin;
  }
//******************************************************************   
  function paralelo($ci,$asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
  $inf="";
  $valor="SELECT * FROM requis WHERE asi_cod_req='$asi_cod' AND mod_id_req='$mod_id' AND reg_id_req='$reg_id' AND esp_id_req='$esp_id' AND coh_id_req='$coh_id' AND pen_top_req='$pen_top' AND req_tip='1' AND req_sta='1'";
  $paralelo=mysql_query($valor,$this->conexion); 
    while($ext_paralelo=mysql_fetch_object($paralelo)){
/*	  if($ext_paralelo->asi_cod=='MAT-21235'){ echo "<script>alert('SELECT * FROM detins WHERE ci_est='$ci' AND pac_id='$pac_id' AND asi_cod='$ext_paralelo->asi_cod' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND det_sta='1'');</script>";}*/
      $valor1="SELECT * FROM detins WHERE ci_est='$ci' AND pac_id='$pac_id' AND asi_cod='$ext_paralelo->asi_cod' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND det_sta='1'";
	  $mat_paralelo=mysql_query($valor1,$this->conexion);
	  $fila=mysql_num_rows($mat_paralelo);
	  if($fila>0){
	  $inf="PARALELO ";
/*	  echo "<script>alert('entre es paralelo');";*/
	  break;
	  }
	}
  return $inf;
  }
//******************************************************************   
  function trans_num_let($num){
    if($num==1)
	$val="uno";
	else{
	  if($num==2)
	  $val="dos";
	  if($num==3)
	  $val="tres";
	  if($num==4)
	  $val="cuatro";
	  if($num==5)
	  $val="cinco";
	  if($num==6)
	  $val="seis";
	  if($num==7)
	  $val="siete";
	  if($num==8)
	  $val="ocho";
	  if($num==9)
	  $val="nueve";
	  if($num==10)
	  $val="diez";
	  if($num==11)
	  $val="once";
	  if($num==12)
	  $val="doce";
	  if($num==13)
	  $val="trece";
	  if($num==14)
	  $val="catorce";
	  if($num==15)
	  $val="quince";
	  if($num==16)
	  $val="dieciseis";
	  if($num==17)
	  $val="diecisiete";
	  if($num==18)
	  $val="dieciocho";
	  if($num==19)
	  $val="diecinueve";
	  if($num==20)
	  $val="veinte";
	  if($num==21)
	  $val="veintiuno";
	  if($num==22)
	  $val="ventidos";
	  if($num==23)
	  $val="ventitres";
	  if($num==24)
	  $val="venticuatro";
	  if($num==25)
	  $val="veinticinco";
	  if($num==26)
	  $val="veintiseis";
	  if($num==27)
	  $val="veintisiete";
	  if($num==28)
	  $val="veintiocho";
	  if($num==29)
	  $val="veintinueve";
	  if($num==30)
	  $val="treinta";
	  if($num==31)
	  $val="treinta y uno";
	}
  return $val;
  }  
//****************************************************************** 
  function pacade_GenerarActas(){
  $ci_usu=$_SESSION['ci'];
  $pacade="SELECT A.pac_id AS 'pac_id', B.pac_nom AS 'pac_nom' FROM asigna_seccio A, pacade B, matric C WHERE A.pac_id=B.pac_id AND C.ci='$ci_usu' AND A.ase_sta='1' AND B.pac_sta='1' AND C.matr_sta='1' AND C.matr_tip!='0' AND C.mod_id=A.mod_id AND C.esp_id=A.esp_id AND C.reg_id=A.reg_id AND C.coh_id=A.coh_id AND C.pen_top=A.pen_top GROUP BY A.pac_id ORDER BY B.pac_fin DESC";
  $ext_pacade=mysql_query($pacade,$this->conexion);
  return $ext_pacade;
  }

//****************************************************************** 
  function nucleo($ci){
  $nucleo="SELECT A.nuc_id AS nuc_id, A.nuc_nom AS nuc_nom FROM nucleo A, infrae B, estudi_infrae C WHERE C.ci='$ci' AND C.est_inf_ffi='0000-00-00 00:00:00' AND C.inf_id=B.inf_id AND B.inf_sta='1' AND B.nuc_id=A.nuc_id AND A.nuc_sta='1' GROUP BY A.nuc_id ORDER BY A.nuc_nom";
  $ext_nucleo=mysql_query($nucleo,$this->conexion);
  return $ext_nucleo;
  }
//****************************************************************** 
  function busc_graduac($ci,$nuc_id){
  $dias=time();
  $fecha=date("Y-m-d",$dias); 
  $busc_gradua="SELECT A.ci_est AS ci_est FROM gradua A, gra_aca B WHERE A.ci_est='$ci' AND A.grad_sta='1' AND A.gra_id=B.gra_id AND B.nuc_id='$nuc_id' AND B.gra_sta='1'";
  $ext_gradua=mysql_query($busc_gradua,$this->conexion);
    if(mysql_num_rows($ext_gradua)==0){
	echo "<script>alert('NO ESTÁ ASIGNADO A NINGÚN ACTO DE GRADUACIÓN')
	location.href='ConstanciaCulmin_Estud.php'</script>";
	}
	else{
	$busc_gradua1="SELECT A.ci_est AS ci_est, B.gra_fec AS gra_fec FROM gradua A, gra_aca B WHERE A.ci_est='$ci' AND A.grad_sta='1' AND A.gra_id=B.gra_id AND DATEDIFF(B.gra_fec,'$fecha')>=0 AND B.nuc_id='$nuc_id' AND B.gra_sta='1'";
	$ext_gradua1=mysql_query($busc_gradua1,$this->conexion);
      if(mysql_num_rows($ext_gradua1)==0){
	  echo "<script>alert('EL ESTUDIANTE YA SE GRADUÓ')
	  location.href='ConstanciaCulmin_Estud.php'</script>";
	  }
	  else{
	  return $ext_gradua1;
	  }
	}
  }
  function verif_culm_estud($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $mat_pensum=0;
  $mat_aprob_estud=0;
  $i=0;
  $sql_busc_mat="SELECT asi_cod, asi_nom FROM asigna WHERE asi_cod NOT IN ('ADG-10820','ADG-10821') AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND asi_sta='1'";
  $busc_mat=mysql_query($sql_busc_mat,$this->conexion);
    while($ext_busc_mat=mysql_fetch_object($busc_mat)){
/*	  echo "<script>alert('SELECT asi_cod FROM detins WHERE asi_cod=$ext_busc_mat->asi_cod AND ci_est=$ci AND mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND coh_id=$coh_id AND pen_top=$pen_top AND det_con=1 AND det_sta=1');</script>";*/
      $sql_mat_estud="SELECT asi_cod FROM detins WHERE asi_cod='$ext_busc_mat->asi_cod' AND ci_est='$ci' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND det_con='1' AND det_sta='1'";
	  $mat_estud=mysql_query($sql_mat_estud,$this->conexion);
	  $fila=mysql_num_rows($mat_estud);
	  if($fila<='0'){
	    $dat_mat[$i]=$ext_busc_mat->asi_cod." ".$ext_busc_mat->asi_nom;
	    $i++;
	  }
	  else{
	    $mat_aprob_estud++;
	  }
	  $mat_pensum++;
	}
/*	echo "<script>alert('$mat_aprob_estud!=$mat_pensum')</script>";*/
	if($mat_aprob_estud!=$mat_pensum){
	  for($j=0;$j<$i;$j++){
		if($j==0)
		$valor=$dat_mat[$j];
		else
	    $valor=$valor.", ".$dat_mat[$j];
	  }
	echo "<script>alert('LE FALTA POR APROBAR LA(S) SIGUIENTE(S) MATERIA(S): $valor')</script>";
	echo "<script>location.href='ConstanciaCulmin_Estud.php'</script>";
	}
  }
//****************************************************************** 
  function indice_academ1($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){ 
  $sql="SELECT SUM(A.det_nde*B.asi_cuc/(SELECT SUM(B.asi_cuc) AS ia FROM detins A, asigna B WHERE A.det_sta='1' AND A.ci_est='$ci' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.pac_id='$pac_id' AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.asi_sta='1' AND A.asi_cod=B.asi_cod)) AS ia FROM detins A, asigna B WHERE A.det_sta='1' AND A.ci_est='$ci' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.pac_id='$pac_id' AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.asi_sta='1' AND A.asi_cod=B.asi_cod";
  $ia=mysql_query($sql);
  $ext_ia=mysql_fetch_object($ia);
  return $ext_ia->ia;
  }
//****************************************************************** 
  function indice_academ_acum($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_fin){ 
    $i=0;
    $sum_ia=0;
    $uc=0;
    $mat_curs=0;
    $sql="SELECT A.asi_cod AS asi_cod FROM detins A, asigna B, pacade C WHERE A.det_sta='1' AND A.ci_est='$ci' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.obs_id!='4' AND DATEDIFF('$pac_fin',C.pac_fin)>=0 AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND B.asi_sta='1' AND C.pac_id=A.pac_id AND A.mod_id=C.mod_id AND C.pac_sta='1' GROUP BY A.asi_cod ORDER BY C.pac_fin DESC";
    $array=mysql_query($sql);
    while($ext_array=mysql_fetch_object($array)){
/*	echo "<script>alert('$ext_array->asi_cod');</script>";*/
	  $sql_MATERIA="SELECT A.asi_cod AS asi_cod, A.pac_id AS pac_id, A.det_nde AS det_nde, B.asi_cuc AS asi_cuc FROM detins A, asigna B, pacade C WHERE A.det_sta='1' AND A.asi_cod='$ext_array->asi_cod' AND A.ci_est='$ci' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.obs_id!='4' AND DATEDIFF('$pac_fin',C.pac_fin)>=0 AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND B.asi_sta='1' AND C.pac_id=A.pac_id AND A.mod_id=C.mod_id AND C.pac_sta='1' ORDER BY C.pac_fin DESC";
	  $array_materia=mysql_query($sql_MATERIA);
	  $ext_array_materia=mysql_fetch_object($array_materia);
	  $ia=$ext_array_materia->det_nde*$ext_array_materia->asi_cuc;
	  $uc=$uc+$ext_array_materia->asi_cuc;
	  $sum_ia=$sum_ia+$ia;
	  $mat_curs++;
	  $i++;
	}
    $iaa=$sum_ia/$uc;
    $valor=$iaa."@".$uc."@".$sum_ia."@".$mat_curs;
    return $valor;
  }
//****************************************************************** 
  function indice_merito(){ 
  $sql_ult_matric="SELECT * FROM ultima_matricula WHERE 1";
  $ult_matric=mysql_query($sql_ult_matric);
  return $ult_matric;
  }
//****************************************************************** 
  function verif_culm_inc_mer($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $valor="";
  $mat_aprob_estud=0;
  $mat_pensum=0;
  $cont_aux=0;
  $det_nfi="";
  $uc="";
  $sql_busc_mat="SELECT asi_cod, asi_nom FROM asigna WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND asi_sta='1' AND asi_cod NOT IN ('ADG-10820','ADG-10821')";
  $busc_mat=mysql_query($sql_busc_mat,$this->conexion);
    while($ext_busc_mat=mysql_fetch_object($busc_mat)){
	$sql="SELECT asi_cod FROM detins WHERE ci_est='$ci' AND asi_cod='$ext_busc_mat->asi_cod' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND det_con='1' AND det_sta='1'";
	$mat_estud=mysql_query($sql,$this->conexion);
	$fila=mysql_num_rows($mat_estud);
	  if($fila>0){
      $mat_aprob_estud++;
	  }
	  else{
	  $cont_aux++;
	  }
	$mat_pensum++;
	}
	if($mat_aprob_estud==$mat_pensum){
	$sql_mat_estud="SELECT A.asi_cod AS asi_cod, A.det_nfi AS det_nfi, A.det_nde AS det_nde, B.asi_cuc AS asi_cuc FROM detins A, asigna B, pacade C WHERE A.ci_est='$ci' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.obs_id!='4' AND A.det_sta='1' AND A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.asi_sta='1' AND A.pac_id=C.pac_id AND C.pac_sta='1' GROUP BY A.mod_id, A.reg_id, A.esp_id, A.coh_id, A.pen_top, A.asi_cod ORDER BY C.pac_fin";
	$mat_estud=mysql_query($sql_mat_estud,$this->conexion);
	$fila=mysql_num_rows($mat_estud);
	  while($ext_mat_estud=mysql_fetch_object($mat_estud)){
	    //if($ext_mat_estud->det_nfi<$ext_mat_estud->det_nde)
		  $nota=$ext_mat_estud->det_nfi;
		/*else
		  $nota=$ext_mat_estud->det_nde;*/
	    if($det_nfi=="" && $uc==""){
		$det_nfi=($nota*$ext_mat_estud->asi_cuc);
		$uc=$ext_mat_estud->asi_cuc;
		}
		else{
		$det_nfi=$det_nfi."*".($nota*$ext_mat_estud->asi_cuc);
		$uc=$uc."*".$ext_mat_estud->asi_cuc;
		}
	  }
	$valor=$det_nfi."@".$uc."@".$fila;
	}
  return $valor;
  }
//****************************************************************** 
  function dat_alum_ind_mer($ci){
  $sql="SELECT A.no1 AS no1, A.no2 AS no2, A.no3 AS no3, A.ap1 AS ap1, A.ap2 AS ap2, A.ap3 AS ap3, A.sex AS sex, C.niv_nom AS niv_nom FROM persona A, perso_ins B, nivela C WHERE A.ci='$ci' AND A.sta='1' AND A.ci=B.ci AND B.ise_sta='1' AND B.niv_id=C.niv_id AND C.niv_sta='1'";
  $dat_alum=mysql_query($sql,$this->conexion);
  return $dat_alum;
  }
//****************************************************************** 
  function dat_carrera($mod_id,$reg_id,$esp_id){
  $sql="SELECT A.mod_nom AS mod_nom, B.reg_nom AS reg_nom, C.esp_nom AS esp_nom FROM modali A, regimen B, especi C WHERE A.mod_id='$mod_id' AND A.mod_sta='1' AND B.reg_id='$reg_id' AND B.reg_sta='1' AND C.esp_id='$esp_id' AND C.esp_sta='1' GROUP BY A.mod_id, B.reg_id, C.esp_id";
  $dat_carrera=mysql_query($sql,$this->conexion);
  return $dat_carrera;
  }
//****************************************************************** 
  function indice_academ($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
  $det_nfi=="";
  $uc=="";
  $valor="";
  $sql="SELECT A.asi_cod AS asi_cod, A.det_nde AS det_nde, B.asi_cuc AS asi_cuc FROM detins A, asigna B WHERE A.ci_est='$ci' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.det_sta='1' AND A.asi_cod=B.asi_cod AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND B.asi_sta='1' ORDER BY B.asi_nom";
  $indice=mysql_query($sql,$this->conexion);
  $fila=mysql_num_rows($indice);
    while($ext_indice=mysql_fetch_object($indice)){
	  if($det_nfi=="" && $uc==""){
	  $det_nfi=($ext_indice->det_nde*$ext_indice->asi_cuc);
	  $uc=$ext_indice->asi_cuc;
	  }
	  else{
	  $det_nfi=$det_nfi."*".($ext_indice->det_nde*$ext_indice->asi_cuc);
	  $uc=$uc."*".$ext_indice->asi_cuc;
	  } 
	}
  $valor=$det_nfi."@".$uc."@".$fila;
  return $valor;
  }
  //******************************************************************
  function ano_egre($gra_id){
  $sql="SELECT gra_fec FROM gra_aca WHERE gra_id='$gra_id' AND gra_sta='1'";
  $fecha_egre=mysql_query($sql,$this->conexion);
  $ext_fecha=mysql_fetch_object($fecha_egre);
  $ano_egre=$ext_fecha->gra_fec;
  return $ano_egre;
  }
//******************************************************************
  function fecha_IA($pac_id){
  $sql="SELECT pac_fin FROM pacade WHERE pac_sta='1' AND pac_id='$pac_id'";
  $pac_fin=mysql_query($sql,$this->conexion);
  $ext_pac_fin=mysql_fetch_object($pac_fin);
  return $ext_pac_fin->pac_fin;
  }
//******************************************************************
  function repitencia($cedu,$asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id,$pac_fin){
  /*echo "<script>alert('$cedu,$asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id,$pac_fin')</script>";*/
  $paralelo=$this->paralelo($cedu,$asi_cod,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id);
	if($paralelo!=""){
	$repitencia="";
	}
	else{
	/*echo "<script>alert('SELECT B.ci_est AS ci_est FROM pacade A, detins B WHERE B.ci_est=$cedu AND B.asi_cod=$asi_cod AND B.mod_id=$mod_id AND B.reg_id=$reg_id AND B.esp_id=$esp_id AND B.coh_id=$coh_id AND B.pen_top=$pen_top AND B.det_sta=1 AND B.pac_id=A.pac_id AND B.mod_id=A.mod_id AND A.pac_sta=1 AND DATEDIFF($pac_fin,A.pac_fin)>0')</script>";*/
    $sql="SELECT B.ci_est AS ci_est FROM pacade A, detins B WHERE B.ci_est='$cedu' AND B.asi_cod='$asi_cod' AND B.mod_id='$mod_id' AND B.reg_id='$reg_id' AND B.esp_id='$esp_id' AND B.coh_id='$coh_id' AND B.pen_top='$pen_top' AND B.det_sta='1' AND B.pac_id=A.pac_id AND B.mod_id=A.mod_id AND A.pac_sta='1' AND DATEDIFF('$pac_fin',A.pac_fin)>0";
    $rep=mysql_query($sql,$this->conexion);
	  if(mysql_num_rows($rep)>0){
	  /*echo "<script>alert('pasa a repitencia')</script>";*/
	  $repitencia="REPITENCIA ";
	  }
	  else{
	  $repitencia="";
	  }
	}
  return $repitencia;
  }
//******************************************************************
  function infrae($nuc_id){
	  $ci=$_SESSION[ci];
    if($nuc_id!="todos")
	  $nucleo="AND B.nuc_id='$nuc_id'";
	else
	  $nuc_id="";
	$sql="SELECT A.inf_id, A.inf_nom FROM infrae A, nucleo B, matric C, reg_esp_mod_infrae D WHERE A.inf_sta='1' AND A.nuc_id=B.nuc_id AND B.nuc_sta='1' AND C.reg_id=D.reg_id AND C.esp_id=D.esp_id AND C.mod_id=D.mod_id AND C.matr_sta='1' AND D.inf_id=A.inf_id AND D.remi_sta='1' AND matr_tip='1' AND C.ci='".$ci."' ".$nucleo." GROUP BY A.inf_id ORDER BY A.inf_nom";
      $resul=mysql_query($sql,$this->conexion);
      while($array=mysql_fetch_object($resul)){
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
  function pacade_pasantes($valor){
	$sql="SELECT pac_id AS pac_id, pac_nom AS pac_nom FROM pacade WHERE pac_sta='1'";
      $resul=mysql_query($sql,$this->conexion);
      while($array=mysql_fetch_object($resul)){
	    if($id==""){
	      $id=$array->pac_id;
	      $des=$array->pac_nom;
	    }
	    else{
	      $id=$id."*".$array->pac_id;
	      $des=$des."*".$array->pac_nom;
	    }
	    $cuantos++;
	  }	
	  $this->res=$id."@".$des."@".$cuantos;
    /*if($valor1[0]!="todos" && $valor1[1]!="todos"){$sql="SELECT A.pac_id AS pac_id, A.pac_nom AS pac_nom FROM pacade A, detins B, seccio C, infrae D WHERE A.pac_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND B.det_sta='1' AND B.sec_id=C.sec_id AND C.sec_sta='1' AND C.inf_id=D.inf_id AND D.inf_sta='1' AND D.inf_id='$valor1[1]' AND D.nuc_id='$valor1[0]' GROUP BY A.pac_id ORDER BY A.pac_fin";$resul=mysql_query($sql,$this->conexion);while($array=mysql_fetch_object($resul)){if($id==""){$id=$array->pac_id;$des=$array->pac_nom;}else{$id=$id."*".$array->pac_id;$des=$des."*".$array->pac_nom;}$cuantos++;}$this->res=$id."@".$des."@".$cuantos;}else{if($valor1[0]!="todos" && $valor1[1]=="todos"){$sql="SELECT A.pac_id AS pac_id, A.pac_nom AS pac_nom FROM pacade A, detins B, seccio C, infrae D WHERE A.pac_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND B.det_sta='1' AND B.sec_id=C.sec_id AND C.sec_sta='1' AND C.inf_id=D.inf_id AND D.inf_sta='1' AND D.nuc_id='$valor1[0]' GROUP BY A.pac_id ORDER BY A.pac_fin";$resul=mysql_query($sql,$this->conexion);while($array=mysql_fetch_object($resul)){if($id==""){$id=$array->pac_id;$des=$array->pac_nom;}else{$id=$id."*".$array->pac_id;$des=$des."*".$array->pac_nom;}$cuantos++;}$this->res=$id."@".$des."@".$cuantos;}if($valor1[0]=="todos" && $valor1[1]!="todos"){$sql="SELECT A.pac_id AS pac_id, A.pac_nom AS pac_nom FROM pacade A, detins B, seccio C, infrae D WHERE A.pac_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND B.det_sta='1' AND B.sec_id=C.sec_id AND C.sec_sta='1' AND C.inf_id=D.inf_id AND D.inf_sta='1' AND D.inf_id='$valor1[1]' GROUP BY A.pac_id ORDER BY A.pac_fin";$resul=mysql_query($sql,$this->conexion);while($array=mysql_fetch_object($resul)){if($id==""){$id=$array->pac_id;$des=$array->pac_nom;else{$id=$id."*".$array->pac_id;$des=$des."*".$array->pac_nom;}$cuantos++;}$this->res=$id."@".$des."@".$cuantos;if($valor1[0]=="todos" && $valor1[1]=="todos"){$sql="SELECT A.pac_id AS pac_id, A.pac_nom AS pac_nom FROM pacade A, detins B, seccio C, infrae D WHERE A.pac_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND B.det_sta='1' AND B.sec_id=C.sec_id AND C.sec_sta='1' AND C.inf_id=D.inf_id AND D.inf_sta='1' GROUP BY A.pac_id ORDER BY A.pac_fin";$resul=mysql_query($sql,$this->conexion);while($array=mysql_fetch_object($resul)){if($id==""){$id=$array->pac_id;$des=$array->pac_nom;}else{$id=$id."*".$array->pac_id;$des=$des."*".$array->pac_nom;}$cuantos++;}$this->res=$id."@".$des."@".$cuantos;}}*/
  }
//******************************************************************
  function pacade($valor){
  $valor1=explode("*",$valor);//nuc_id*inf_id
  $ci=$_SESSION[ci]; 
    if($valor1[0]!="todos")
	  $nucleo="AND D.nuc_id='$valor1[0]'";
	else
	  $nucleo="";
	if($valor1[1]!="todos")
	  $infrae="AND D.inf_id='$valor1[1]'";
	else
	  $infrae="";
	$sql="SELECT A.pac_id AS pac_id, A.pac_nom AS pac_nom FROM pacade A, asigna_seccio B, seccio C, infrae D, matric E WHERE A.pac_sta='1' AND A.pac_id=B.pac_id AND B.mod_id=E.mod_id AND B.esp_id=E.esp_id AND B.reg_id=E.reg_id AND B.ase_sta='1' AND B.sec_id=C.sec_id AND C.sec_sta='1' AND C.inf_id=D.inf_id AND D.inf_sta='1' AND E.matr_sta='1' AND E.matr_tip='1' AND E.ci='".$ci."' ".$infrae." ".$nucleo." GROUP BY A.pac_id ORDER BY A.pac_fin";
      $resul=mysql_query($sql,$this->conexion);
      while($array=mysql_fetch_object($resul)){
	    if($id==""){
	      $id=$array->pac_id;
	      $des=$array->pac_nom;
	    }
	    else{
	      $id=$id."*".$array->pac_id;
	      $des=$des."*".$array->pac_nom;
	    }
	    $cuantos++;
	  }	
	  $this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_modalidad($valor){
	  $ci=$_SESSION[ci];
    /*echo "<script>alert('$valor')</script>";*/
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id
	if($valor1[1]!="todos")
	  $infrae="AND D.inf_id='$valor1[1]'";
	else
	  $infrae="";
	if($valor1[0]!="todos")
	  $nucleo="AND D.nuc_id='$valor1[0]'";
	else
	  $nucleo="";
	if($valor1[2]!="todos" && $valor1[3]!='1')
	  $periodo="AND B.pac_id='$valor1[2]'";
	else
	  $periodo="";
    $sql="SELECT E.mod_id AS mod_id, E.mod_nom AS mod_nom FROM pacade A, asigna_seccio B, seccio C, infrae D, modali E, matric F WHERE A.pac_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND B.mod_id=F.mod_id AND B.ase_sta='1' AND B.sec_id=C.sec_id AND C.sec_sta='1' AND C.inf_id=D.inf_id AND D.inf_sta='1' ".$infrae." ".$nucleo." ".$periodo." AND B.mod_id=E.mod_id AND B.esp_id=F.esp_id AND B.reg_id=F.reg_id AND F.matr_sta=1 AND F.matr_tip='1' AND F.ci='".$ci."' AND E.mod_sta='1' GROUP BY E.mod_id ORDER BY E.mod_nom";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->mod_id;
	    $des=$array->mod_nom;
	  }
	  else{
	    $id=$id."*".$array->mod_id;
	    $des=$des."*".$array->mod_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_modalidad_Generador_Actas($valor){
    /*echo "<script>alert('$valor')</script>";*/
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id
    $ci_usu=$_SESSION['ci'];
    $sql="SELECT A.mod_id AS 'mod_id', B.mod_nom AS 'mod_nom' FROM asigna_seccio A, modali B, matric C WHERE A.mod_id=B.mod_id AND A.pac_id='$valor1[0]' AND C.ci='$ci_usu' AND A.ase_sta='1' AND B.mod_sta='1' AND C.matr_sta='1' AND C.matr_tip!='0' AND C.mod_id=A.mod_id AND C.esp_id=A.esp_id AND C.reg_id=A.reg_id AND C.coh_id=A.coh_id AND C.pen_top=A.pen_top GROUP BY A.mod_id ORDER BY B.mod_nom";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->mod_id;
	    $des=$array->mod_nom;
	  }
	  else{
	    $id=$id."*".$array->mod_id;
	    $des=$des."*".$array->mod_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_modalidad_posible_Pasante($valor){
    /*echo "<script>alert('$valor')</script>";*/
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id
	if($valor1[1]!="todos")
	  $infrae="AND D.inf_id='$valor1[1]'";
	else
	  $infrae="";
	if($valor1[0]!="todos")
	  $nucleo="AND D.nuc_id='$valor1[0]'";
	else
	  $nucleo="";
	$periodo="";
	/*echo "<script>alert('SELECT E.mod_id AS mod_id, E.mod_nom AS mod_nom FROM pacade A, detins B, seccio C, infrae D, modali E WHERE A.pac_id=1 AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND B.det_sta=1 AND B.sec_id=C.sec_id AND C.sec_sta=1 AND C.inf_id=D.inf_id AND inf_sta=1 .$infrae. .$nucleo. .$periodo. AND B.mod_id=E.mod_id AND E.mod_sta=1 GROUP BY E.mod_id ORDER BY E.mod_nom')</script>";*/
    //if($valor1[0]!="todos" && $valor1[1]!="todos" && $valor1[2]!="todos"){
    $sql="SELECT E.mod_id AS mod_id, E.mod_nom AS mod_nom FROM pacade A, detins B, seccio C, infrae D, modali E WHERE A.pac_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND B.det_sta='1' AND B.sec_id=C.sec_id AND C.sec_sta='1' AND C.inf_id=D.inf_id AND inf_sta='1' ".$infrae." ".$nucleo." ".$periodo." AND B.mod_id=E.mod_id AND E.mod_sta='1' GROUP BY E.mod_id ORDER BY E.mod_nom";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->mod_id;
	    $des=$array->mod_nom;
	  }
	  else{
	    $id=$id."*".$array->mod_id;
	    $des=$des."*".$array->mod_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_regimen($valor){
	  $ci=$_SESSION[ci];
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id
	if($valor1[1]!="todos")
	  $infrae="AND D.inf_id='$valor1[1]'";
	else
	  $infrae="";
	if($valor1[0]!="todos")
	  $nucleo="AND D.nuc_id='$valor1[0]'";
	else
	  $nucleo="";
	if($valor1[2]!="todos" && $valor1[4]!='1')
	  $periodo="AND B.pac_id='$valor1[2]'";
	else
	  $periodo="";
	if($valor1[3]!="todos")
	  $modalidad="AND B.mod_id='$valor1[3]'";
	else
	  $modalidad="";
    $sql="SELECT F.reg_id AS reg_id, F.reg_nom AS reg_nom FROM pacade A, asigna_seccio B, seccio C, infrae D, modali E, regimen F, matric G WHERE A.pac_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND B.ase_sta='1' AND B.sec_id=C.sec_id AND C.sec_sta='1' AND C.inf_id=D.inf_id AND D.inf_sta='1' AND G.ci='".$ci."' ".$infrae." ".$nucleo." ".$periodo." ".$modalidad." AND B.mod_id=E.mod_id AND E.mod_sta='1' AND B.reg_id=F.reg_id AND F.reg_sta='1' AND B.mod_id=G.mod_id AND B.esp_id=G.esp_id AND B.reg_id=G.reg_id AND G.matr_sta='1' AND G.matr_tip='1' GROUP BY F.reg_id ORDER BY F.reg_nom";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->reg_id;
	    $des=$array->reg_nom;
	  }
	  else{
	    $id=$id."*".$array->reg_id;
	    $des=$des."*".$array->reg_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_regimen_Generador_Actas($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id
	if($valor1[2]!="todos"){
	  $esp_id=explode("D",$valor1[2]);
	  $esp_id_otro=explode("N",$esp_id[0]);
	  $especi="AND A.esp_id LIKE ('$esp_id_otro[0]%')";
	}
	else
	  $especi="";
    $ci_usu=$_SESSION['ci'];
    $sql="SELECT A.reg_id AS 'reg_id', B.reg_nom AS 'reg_nom' FROM asigna_seccio A, regimen B, matric C WHERE A.reg_id=B.reg_id AND A.pac_id='$valor1[0]' AND C.ci='$ci_usu' AND A.mod_id='$valor1[1]' ".$especi."AND A.ase_sta='1' AND B.reg_sta='1' AND C.matr_sta='1' AND C.matr_tip!='0' AND C.mod_id=A.mod_id AND C.esp_id=A.esp_id AND C.reg_id=A.reg_id AND C.coh_id=A.coh_id AND C.pen_top=A.pen_top GROUP BY A.reg_id ORDER BY B.reg_nom";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->reg_id;
	    $des=$array->reg_nom;
	  }
	  else{
	    $id=$id."*".$array->reg_id;
	    $des=$des."*".$array->reg_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_regimen_Record_matric($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id
    $ci_usu=$valor1[0];
    $mod_id=$valor1[1];
/*	echo "<script>alert('$ci_usu, $mod_id');</script>";*/
    $sql="SELECT A.reg_id AS 'reg_id', B.reg_nom AS 'reg_nom' FROM matric A, regimen B WHERE A.reg_id=B.reg_id AND A.ci='$ci_usu' AND A.mod_id='$mod_id' AND B.reg_sta='1' AND A.matr_tip='0' GROUP BY A.reg_id ORDER BY B.reg_nom";
	$id="";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->reg_id;
	    $des=$array->reg_nom;
	  }
	  else{
	    $id=$id."*".$array->reg_id;
	    $des=$des."*".$array->reg_nom;
	  }
	  $cuantos++;
	}
	$this->res=$id."@".$des."@".$cuantos;
/*	echo "<script>alert('$this->res');</script>";*/
  }
//******************************************************************
  function Buscar_carrera($valor){
	  $ci=$_SESSION[ci];
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id
	if($valor1[1]!="todos")
	  $infrae="AND D.inf_id='$valor1[1]'";
	else
	  $infrae="";
	if($valor1[0]!="todos")
	  $nucleo="AND D.nuc_id='$valor1[0]'";
	else
	  $nucleo="";
	if($valor1[2]!="todos" && $valor1[5]!='1')
	  $periodo="AND B.pac_id='$valor1[2]'";
	else
	  $periodo="";
	if($valor1[3]!="todos")
	  $modalidad="AND B.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND B.reg_id='$valor1[4]'";
	else
	  $regimen="";
    $sql="SELECT G.esp_id AS esp_id, G.esp_nom AS esp_nom FROM pacade A, asigna_seccio B, seccio C, infrae D, matric E, especi G WHERE A.pac_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND B.ase_sta='1' AND B.sec_id=C.sec_id AND C.sec_sta='1' AND C.inf_id=D.inf_id AND D.inf_sta='1' ".$infrae." ".$nucleo." ".$periodo." ".$modalidad." ".$regimen." AND B.mod_id=E.mod_id AND E.matr_sta='1' AND B.reg_id=E.reg_id AND E.matr_tip='1' AND B.esp_id=G.esp_id AND B.coh_id=E.coh_id AND G.esp_sta='1' AND E.ci='".$ci."' GROUP BY G.esp_nom ORDER BY G.esp_nom";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->esp_id;
	    $des=$array->esp_nom;
	  }
	  else{
	    $id=$id."*".$array->esp_id;
	    $des=$des."*".$array->esp_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_carrera_Generador_Actas($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id
	if($valor1[1]!="todos")
	  $modali="AND A.mod_id='$valor1[1]' ";
	else
	  $modali="";
    $ci_usu=$_SESSION['ci'];
    $sql="SELECT A.esp_id AS 'esp_id', B.esp_nom AS 'esp_nom' FROM asigna_seccio A, especi B, matric C WHERE A.esp_id=B.esp_id AND A.pac_id='$valor1[0]' AND C.ci='$ci_usu' ".$modali."AND A.ase_sta='1' AND B.esp_sta='1' AND C.matr_sta='1' AND C.matr_tip!='0' AND C.mod_id=A.mod_id AND C.esp_id=A.esp_id AND C.reg_id=A.reg_id AND C.coh_id=A.coh_id AND C.pen_top=A.pen_top GROUP BY B.esp_nom ORDER BY B.esp_nom";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->esp_id;
	    $des=$array->esp_nom;
	  }
	  else{
	    $id=$id."*".$array->esp_id;
	    $des=$des."*".$array->esp_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_carrera_Record_matric($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id
    $ci_usu=$valor1[0];
    $mod_id=$valor1[1];
    $reg_id=$valor1[2];
    $sql="SELECT A.esp_id AS 'esp_id', B.esp_nom AS 'esp_nom' FROM especi B, matric A WHERE A.esp_id=B.esp_id AND B.esp_sta='1' AND A.matr_tip='0' AND A.ci='$ci_usu' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' GROUP BY B.esp_id ORDER BY B.esp_nom";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->esp_id;
	    $des=$array->esp_nom;
	  }
	  else{
	    $id=$id."*".$array->esp_id;
	    $des=$des."*".$array->esp_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_pensum($valor){
	  $ci=$_SESSION[ci];
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id
	if($valor1[1]!="todos")
	  $infrae="AND D.inf_id='$valor1[1]'";
	else
	  $infrae="";
	if($valor1[0]!="todos")
	  $nucleo="AND D.nuc_id='$valor1[0]'";
	else
	  $nucleo="";
	if($valor1[2]!="todos" && $valor1[6]!='1')
	  $periodo="AND B.pac_id='$valor1[2]'";
	else
	  $periodo="";
	if($valor1[3]!="todos")
	  $modalidad="AND B.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND B.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND B.esp_id='$valor1[5]'";
	else
	  $carrera="";
    $sql="SELECT H.coh_id AS coh_id, H.coh_nom AS coh_nom FROM pacade A, asigna_seccio B, seccio C, infrae D, matric E, cohort H WHERE A.pac_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND B.ase_sta='1' AND B.sec_id=C.sec_id AND C.sec_sta='1' AND C.inf_id=D.inf_id AND D.inf_sta='1' ".$infrae." ".$nucleo." ".$periodo." ".$modalidad." ".$regimen." ".$carrera." AND B.mod_id=E.mod_id AND E.matr_sta='1' AND B.reg_id=E.reg_id AND E.matr_tip='1' AND B.esp_id=E.esp_id AND B.coh_id=H.coh_id AND H.coh_sta='1' AND E.ci='".$ci."' GROUP BY H.coh_id ORDER BY H.coh_nom";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->coh_id;
	    $des=$array->coh_nom;
	  }
	  else{
	    $id=$id."*".$array->coh_id;
	    $des=$des."*".$array->coh_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_pensum_Generador_Actas($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id
	if($valor1[2]!="todos"){
	  $esp_id=explode("D",$valor1[2]);
	  $esp_id_otro=explode("N",$esp_id[0]);
	  $especi="AND A.esp_id LIKE ('$esp_id_otro[0]%') ";
	}
	else
	  $especi="";
	if($valor1[3]!="todos"){
	  $regimen=" AND A.reg_id='$valor1[3]' ";
	}
	else
	  $regimen="";
    $ci_usu=$_SESSION['ci'];
    $sql="SELECT A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom' FROM asigna_seccio A, cohort B, matric C WHERE A.coh_id=B.coh_id AND A.pac_id='$valor1[0]' AND C.ci='$ci_usu' AND A.mod_id='$valor1[1]' ".$especi."".$regimen."AND A.ase_sta='1' AND B.coh_sta='1' AND C.matr_sta='1' AND C.matr_tip!='0' AND C.mod_id=A.mod_id AND C.esp_id=A.esp_id AND C.reg_id=A.reg_id AND C.coh_id=A.coh_id AND C.pen_top=A.pen_top GROUP BY A.coh_id ORDER BY B.coh_nom";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->coh_id;
	    $des=$array->coh_nom;
	  }
	  else{
	    $id=$id."*".$array->coh_id;
	    $des=$des."*".$array->coh_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_pensum_Record_matric($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id
    $ci_usu=$valor1[0];
    $mod_id=$valor1[1];
    $reg_id=$valor1[2];
    $esp_id=$valor1[3];
    $sql="SELECT A.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom' FROM cohort B, matric A WHERE A.coh_id=B.coh_id AND A.ci='$ci_usu' AND A.mod_id='$mod_id' AND B.coh_sta='1' AND A.matr_tip='0' AND A.esp_id='$esp_id' AND A.reg_id='$reg_id' GROUP BY A.coh_id ORDER BY B.coh_nom";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->coh_id;
	    $des=$array->coh_nom;
	  }
	  else{
	    $id=$id."*".$array->coh_id;
	    $des=$des."*".$array->coh_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_asigna_Generador_Actas($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id
	if($valor1[2]!="todos"){
	  $esp_id=explode("D",$valor1[2]);
	  $esp_id_otro=explode("N",$esp_id[0]);
	  $especi="AND A.esp_id LIKE ('$esp_id_otro[0]%') ";
	}
	else
	  $especi="";
	if($valor1[3]!="todos"){
	  $regimen=" AND A.reg_id='$valor1[3]' ";
	}
	else
	  $regimen="";
	if($valor1[4]!="todos"){
	  $pensum=" AND A.coh_id='$valor1[4]' ";
	}
	else
	  $pensum="";
    $ci_usu=$_SESSION['ci'];
    $sql="SELECT A.asi_cod AS 'asi_cod', CONCAT(B.asi_cod,' ',B.asi_nom) AS 'asi_nom' FROM asigna_seccio A, asigna B, matric C WHERE A.asi_cod=B.asi_cod AND A.pac_id='$valor1[0]' AND C.ci='$ci_usu' AND A.mod_id='$valor1[1]' ".$especi."".$regimen."".$pensum."AND A.ase_sta='1' AND B.asi_sta='1' AND B.mod_id=A.mod_id AND B.esp_id=A.esp_id AND B.reg_id=A.reg_id AND B.coh_id=A.coh_id AND B.pen_top=A.pen_top AND C.matr_sta='1' AND C.matr_tip!='0' AND C.mod_id=A.mod_id AND C.esp_id=A.esp_id AND C.reg_id=A.reg_id AND C.coh_id=A.coh_id AND C.pen_top=A.pen_top GROUP BY A.asi_cod,B.asi_nom ORDER BY B.asi_mod,A.asi_cod,B.asi_nom";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->asi_cod;
	    $des=$array->asi_nom;
	  }
	  else{
	    $id=$id."*".$array->asi_cod;
	    $des=$des."*".$array->asi_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_pen_top_Record_matric($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id
    $ci_usu=$valor1[0];
    $mod_id=$valor1[1];
    $reg_id=$valor1[2];
    $esp_id=$valor1[3];
    $coh_id=$valor1[4];
	$id="";	
/*	echo "<script>alert('SELECT pen_top FROM matric WHERE ci=$ci_usu AND mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND coh_id=$coh_id AND matr_tip=0 GROUP BY pen_top ORDER BY pen_top');</script>";*/
    $sql="SELECT pen_top FROM matric WHERE ci='$ci_usu' AND mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND coh_id='$coh_id' AND matr_tip='0' GROUP BY pen_top ORDER BY pen_top";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->pen_top;
        if($array->pen_top=='0')
	      $des="PASANTIA";
        else
          $des="TRABAJO ESPECIAL DE GRADO";
	  }
	  else{
	    $id=$id."*".$array->pen_top;
        if($array->pen_top=='0')
	      $des=$des."*PASANTIA";
        else
          $des=$des."*TRABAJO ESPECIAL DE GRADO";
	  }
	  $cuantos++;
	}	
/*	echo "<script>alert('$id@$des$cuantos');</script>";*/
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Buscar_seccion_Generador_Actas($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id
	if($valor1[2]!="todos"){
	  $esp_id=explode("D",$valor1[2]);
	  $esp_id_otro=explode("N",$esp_id[0]);
	  $especi="AND A.esp_id LIKE ('$esp_id_otro[0]%') ";
	}
	else
	  $especi="";
	if($valor1[3]!="todos"){
	  $regimen=" AND A.reg_id='$valor1[3]' ";
	}
	else
	  $regimen="";
	if($valor1[4]!="todos"){
	  $pensum=" AND A.coh_id='$valor1[4]' ";
	}
	else
	  $pensum="";
	if($valor1[5]!="todos"){
	  $asigna=" AND A.asi_cod='$valor1[5]' ";
	}
	else
	  $asigna="";
    $ci_usu=$_SESSION['ci'];
    $sql="SELECT A.sec_id AS 'sec_id', CONCAT(B.sec_nom,' ',D.inf_nom,' ',E.nuc_nom) AS 'sec_nom' FROM asigna_seccio A, seccio B, matric C, infrae D, nucleo E WHERE A.sec_id=B.sec_id AND A.pac_id='$valor1[0]' AND C.ci='$ci_usu' AND A.mod_id='$valor1[1]' ".$especi."".$regimen."".$pensum."".$asigna."AND A.ase_sta='1' AND B.inf_id=D.inf_id AND D.nuc_id=E.nuc_id AND C.matr_sta='1' AND C.matr_tip!='0' AND C.mod_id=A.mod_id AND C.esp_id=A.esp_id AND C.reg_id=A.reg_id AND C.coh_id=A.coh_id AND C.pen_top=A.pen_top GROUP BY A.sec_id ORDER BY E.nuc_nom,D.inf_nom,B.sec_nom";
    $resul=mysql_query($sql,$this->conexion);
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->sec_id;
	    $des=$array->sec_nom;
	  }
	  else{
	    $id=$id."*".$array->sec_id;
	    $des=$des."*".$array->sec_nom;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function estud_insc_pacade($valor){
    /*echo "<script>alert('$valor')</script>";*/
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id*coh_id
	if($valor1[1]!="todos")
	  $infrae="AND I.inf_id='$valor1[1]'";
	else
	  $infrae="";
	if($valor1[0]!="todos")
	  $nucleo="AND H.nuc_id='$valor1[0]'";
	else
	  $nucleo="";
	if($valor1[2]!="todos")
	  $periodo="AND B.pac_id='$valor1[2]'";
	else
	  $periodo="";
	if($valor1[3]!="todos")
	  $modalidad="AND B.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND B.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND B.esp_id='$valor1[5]'";
	else
	  $carrera="";
	if($valor1[6]!="todos")
	  $pensum="AND B.coh_id='$valor1[6]'";
	else 
	  $pensum="";
    $sql="SELECT H.nuc_nom AS 'NUCLEO',I.inf_nom AS 'SEDE',K.mod_nom AS 'MODALIDAD',C.esp_nom AS 'ESPECIALIDAD',D.reg_nom AS 'REGIMEN',G.coh_nom AS 'PENSUM',MIN(E.asi_mod) AS 'ASI_MOD',A.ci AS 'CEDULA',UPPER(CONCAT(A.ap1,' ', A.ap2)) AS 'APELLIDOS',UPPER(CONCAT(A.no1,' ', A.no2)) AS 'NOMBRES',K.mod_id AS mod_id,C.esp_id AS esp_id,D.reg_id AS reg_id,G.coh_id AS coh_id,B.pen_top AS pen_top FROM persona A,detins B,especi C,regimen D,asigna E,matric F,cohort G,nucleo H,infrae I,seccio J,modali K WHERE A.ci=B.ci_est AND A.ci=F.ci AND G.coh_id=F.coh_id AND F.matr_sta='1' AND B.esp_id=F.esp_id AND B.reg_id=F.reg_id AND B.mod_id=F.mod_id AND B.coh_id=F.coh_id AND B.pen_top=F.pen_top ".$infrae." ".$nucleo." ".$periodo." ".$modalidad." ".$regimen." ".$carrera." ".$pensum." AND B.det_sta='1' AND A.sta='1' AND B.esp_id=C.esp_id AND B.reg_id=D.reg_id AND B.asi_cod=E.asi_cod AND B.esp_id=E.esp_id AND B.reg_id=E.reg_id AND B.mod_id=E.mod_id AND B.coh_id=E.coh_id AND B.pen_top=E.pen_top AND B.mod_id=K.mod_id AND B.sec_id=J.sec_id AND J.inf_id=I.inf_id AND I.nuc_id=H.nuc_id GROUP BY A.ci ORDER BY H.nuc_nom,I.inf_nom,K.mod_nom,C.esp_nom,D.reg_nom,G.coh_nom,MIN(E.asi_mod),A.ci";
	//esta consulta debe escoger el periodo academico para que funcione correctamente
  $estud_insc_pacade=mysql_query($sql,$this->conexion);
  return $estud_insc_pacade;
  }
//******************************************************************
  function estud_insc_pacade_pasados($valor){
    /*echo "<script>alert('$valor')</script>";*/
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id*coh_id
	if($valor1[1]!="todos")
	  $infrae="AND I.inf_id='$valor1[1]'";
	else
	  $infrae="";
	if($valor1[0]!="todos")
	  $nucleo="AND H.nuc_id='$valor1[0]'";
	else
	  $nucleo="";
	if($valor1[2]!="todos")
	  $periodo="AND B.pac_id='$valor1[2]'";
	else
	  $periodo="";
	if($valor1[3]!="todos")
	  $modalidad="AND B.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND B.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND B.esp_id='$valor1[5]'";
	else
	  $carrera="";
	if($valor1[6]!="todos")
	  $pensum="AND B.coh_id='$valor1[6]'";
	else 
	  $pensum="";
    $sql="SELECT H.nuc_id AS 'COD_NUCLEO',H.nuc_nom AS 'NUCLEO', I.inf_id AS 'COD_SEDE',I.inf_nom AS 'SEDE',K.mod_id AS 'COD_MODALIDAD',K.mod_nom AS 'MODALIDAD',C.esp_id AS 'COD_ESPECIALIDAD',C.esp_nom AS 'ESPECIALIDAD',D.reg_id AS 'COD_REGIMEN',D.reg_nom AS 'REGIMEN',G.coh_id AS 'COD_PENSUM',G.coh_nom AS 'PENSUM',MIN(E.asi_mod) AS 'ASI_MOD',A.ci AS 'CEDULA',UPPER(CONCAT(A.ap1,' ', A.ap2)) AS 'APELLIDOS',UPPER(CONCAT(A.no1,' ', A.no2)) AS 'NOMBRES',K.mod_id AS mod_id,C.esp_id AS esp_id,D.reg_id AS reg_id,G.coh_id AS coh_id,B.pen_top AS pen_top FROM persona A,detins B,especi C,regimen D,asigna E,matric F,cohort G,nucleo H,infrae I,seccio J,modali K WHERE A.ci=B.ci_est AND A.ci=F.ci AND G.coh_id=F.coh_id AND B.esp_id=F.esp_id AND B.reg_id=F.reg_id AND B.mod_id=F.mod_id AND B.coh_id=F.coh_id AND B.pen_top=F.pen_top ".$infrae." ".$nucleo." ".$periodo." ".$modalidad." ".$regimen." ".$carrera." ".$pensum." AND B.det_sta='1' AND B.esp_id=C.esp_id AND B.reg_id=D.reg_id AND B.asi_cod=E.asi_cod AND B.esp_id=E.esp_id AND B.reg_id=E.reg_id AND B.mod_id=E.mod_id AND B.coh_id=E.coh_id AND B.pen_top=E.pen_top AND B.mod_id=K.mod_id AND B.sec_id=J.sec_id AND J.inf_id=I.inf_id AND I.nuc_id=H.nuc_id GROUP BY A.ci ORDER BY H.nuc_nom,I.inf_nom,K.mod_nom,C.esp_nom,D.reg_nom,G.coh_nom,MIN(E.asi_mod),A.ci";
	//esta consulta debe escoger el periodo academico para que funcione correctamente
  $estud_insc_pacade=mysql_query($sql,$this->conexion);
  return $estud_insc_pacade;
  }
//******************************************************************
  function estud_insc_uc($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_fin){
	$sql="SELECT SUM(B.asi_cuc) AS CANT_UC_APROBADAS FROM detins A,asigna B, pacade C WHERE A.ci_est='$ci' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.det_sta='1' AND A.det_con='1' AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND B.asi_sta='1' AND A.mod_id=C.mod_id AND A.pac_id=C.pac_id AND DATEDIFF('$pac_fin',pac_fin)>=0 AND C.pac_sta='1'";
  $estud_insc_uc=mysql_query($sql,$this->conexion);
  return $estud_insc_uc;
  }
//******************************************************************
  function total_uc_carrera($mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
	$sql="SELECT SUM(asi_cuc) AS TOTAL FROM asigna WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND asi_sta='1'";
    $total_uc=mysql_query($sql,$this->conexion);
  return $total_uc;
  }
//******************************************************************
  function oferta_academica($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id*coh_id
	if($valor1[0]!="todos")
	  $nucleo="AND H.nuc_id='$valor1[0]'";
    else
      $nucleo="";	
	if($valor1[1]!="todos")
	    $infrae="AND H.inf_id='$valor1[1]'";
	else
	    $infrae="";
	if($valor1[2]!="todos")
	  $periodo="AND A.pac_id='$valor1[2]'";
	else
	  $periodo="";	
	if($valor1[3]!="todos")
	  $modalidad="AND A.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND A.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND A.esp_id='$valor1[5]'";
	else
	  $carrera="";
	if($valor1[6]!="todos")
	  $pensum="AND A.coh_id='$valor1[6]'";
	else
	  $pensum="";
	$sql="SELECT J.nuc_nom AS 'NUCLEO',E.mod_nom AS 'MODALIDAD',B.esp_nom AS 'ESPECIALIDAD',C.reg_nom AS 'REGIMEN',D.coh_nom AS 'COHORTE',F.asi_nom 'ASIGNATURA',I.ele_nom AS 'ELECTIVA',G.sec_nom AS 'SECCION',H.inf_nom AS 'SEDE',A.ase_cma AS 'CUPO_MAXIMO'
FROM asigna_seccio A,`especi` B,regimen C,cohort D,modali E,asigna F,seccio G,infrae H,electi I,nucleo J WHERE A.mod_id=E.mod_id AND A.esp_id=B.esp_id AND A.reg_id=C.reg_id AND A.coh_id=D.coh_id AND A.asi_cod=F.asi_cod AND A.mod_id=F.mod_id AND A.esp_id=F.esp_id AND A.reg_id=F.reg_id AND A.coh_id=F.coh_id AND A.sec_id=G.sec_id AND G.inf_id=H.inf_id AND I.ele_cod=A.ele_cod AND A.ase_sta='1' AND A.ase_cma!='0' AND H.nuc_id=J.nuc_id AND J.nuc_sta='1' ".$infrae." ".$nucleo." ".$periodo." ".$modalidad."  ".$regimen." ".$carrera." ".$pensum." GROUP BY A.mod_id,A.esp_id,A.reg_id,A.coh_id,A.asi_cod,A.sec_id ORDER BY E.mod_nom,B.esp_nom,C.reg_nom,D.coh_nom,F.asi_nom,I.ele_nom,G.sec_nom,H.inf_nom";
  //esta consulta duplica algunos registros porque el asi_cod de la misma materia son distintos
  $ofert_acad=mysql_query($sql,$this->conexion);
  return $ofert_acad;
  }
//******************************************************************
  function seccion_menor_15_no_regulares($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id*coh_id
	if($valor1[0]!="todos")
	  $nucleo="AND H.nuc_id='$valor1[0]'";
    else
      $nucleo="";	
	if($valor1[1]!="todos")
	    $infrae="AND H.inf_id='$valor1[1]'";
	else
	    $infrae="";
	if($valor1[2]!="todos")
	  $periodo="AND A.pac_id='$valor1[2]'";
	else
	  $periodo="";	
	if($valor1[3]!="todos")
	  $modalidad="AND A.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND A.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND A.esp_id='$valor1[5]'";
	else
	  $carrera="";
	if($valor1[6]!="todos")
	  $pensum="AND A.coh_id='$valor1[6]'";
	else
	  $pensum="";
	$sql="SELECT A.ase_id AS 'ase_id', J.nuc_nom AS 'NUCLEO',E.mod_nom AS 'MODALIDAD',B.esp_nom AS 'ESPECIALIDAD',C.reg_nom AS 'REGIMEN',D.coh_nom AS 'COHORTE',F.asi_nom 'ASIGNATURA',I.ele_nom AS 'ELECTIVA',G.sec_nom AS 'SECCION',H.inf_nom AS 'SEDE',A.ase_cma AS 'CUPO_MAXIMO'
FROM asigna_seccio A,`especi` B,regimen C,cohort D,modali E,asigna F,seccio G,infrae H,electi I,nucleo J WHERE A.mod_id=E.mod_id AND A.esp_id=B.esp_id AND A.reg_id=C.reg_id AND A.coh_id=D.coh_id AND A.asi_cod=F.asi_cod AND A.mod_id=F.mod_id AND A.esp_id=F.esp_id AND A.reg_id=F.reg_id AND A.coh_id=F.coh_id AND A.sec_id=G.sec_id AND G.inf_id=H.inf_id AND I.ele_cod=A.ele_cod AND A.ase_sta='1' AND A.ase_cma!='0' AND H.nuc_id=J.nuc_id AND J.nuc_sta='1' ".$infrae." ".$nucleo." ".$periodo." ".$modalidad."  ".$regimen." ".$carrera." ".$pensum." GROUP BY A.ase_id ORDER BY F.asi_nom,A.ase_id,E.mod_nom,B.esp_nom,C.reg_nom,D.coh_nom,I.ele_nom,G.sec_nom,H.inf_nom";
  //esta consulta duplica algunos registros porque el asi_cod de la misma materia son distintos
  $ofert_acad=mysql_query($sql,$this->conexion);
  return $ofert_acad;
  }
//******************************************************************
  function Buscar_oferta_todas($ase_id){
/*      echo "<script>alert('SELECT C.nuc_nom AS nuc_nom, D.inf_nom AS inf_nom, CONCAT(B.asi_cod, ,B.asi_nom) AS asigna, E.sec_nom AS sec_nom, F.mod_nom AS mod_nom, I.coh_nom AS coh_nom, G.esp_nom AS esp_nom, H.reg_nom AS reg_nom, J.ele_nom AS ele_nom FROM asigna_seccio A, asigna B, nucleo C, infrae D, seccio E, modali F, especi G, regimen H, cohort I, electi J WHERE A.ase_id=$ase_id AND A.ele_cod=J.ele_cod AND A.mod_id=B.mod_id AND B.mod_id=F.mod_id AND A.esp_id=B.esp_id AND B.esp_id=G.esp_id AND A.reg_id=B.reg_id AND B.reg_id=H.reg_id AND A.coh_id=B.coh_id AND B.coh_id=I.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=E.sec_id AND E.inf_id=D.inf_id AND D.nuc_id=C.nuc_id AND A.ase_sta=1 AND B.asi_sta=1 AND C.nuc_sta=1 AND D.inf_sta=1 AND E.sec_sta=1 AND F.mod_sta=1 AND G.esp_sta=1 AND H.reg_sta=1 AND I.coh_sta=1 GROUP BY C.nuc_id,D.inf_id,A.mod_id,A.esp_id,A.reg_id,A.coh_id,A.asi_cod,B.asi_nom,A.sec_id');</script>";*/
/*    $res=$this->Operacion("SELECT C.nuc_nom AS 'nuc_nom', D.inf_nom AS 'inf_nom', CONCAT(B.asi_cod,' ',B.asi_nom) AS 'asigna', E.sec_nom AS 'sec_nom', F.mod_nom AS 'mod_nom', I.coh_nom AS 'coh_nom', G.esp_nom AS 'esp_nom', H.reg_nom AS 'reg_nom', J.ele_nom AS 'ele_nom' FROM asigna_seccio A, asigna B, nucleo C, infrae D, seccio E, modali F, especi G, regimen H, cohort I, electi J WHERE A.ase_id='$ase_id' AND A.ele_cod=J.ele_cod AND A.mod_id=B.mod_id AND B.mod_id=F.mod_id AND A.esp_id=B.esp_id AND B.esp_id=G.esp_id AND A.reg_id=B.reg_id AND B.reg_id=H.reg_id AND A.coh_id=B.coh_id AND B.coh_id=I.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND A.sec_id=E.sec_id AND E.inf_id=D.inf_id AND D.nuc_id=C.nuc_id AND A.ase_sta='1' AND B.asi_sta='1' AND C.nuc_sta='1' AND D.inf_sta='1' AND E.sec_sta='1' AND F.mod_sta='1' AND G.esp_sta='1' AND H.reg_sta='1' AND I.coh_sta='1' GROUP BY C.nuc_id,D.inf_id,A.mod_id,A.esp_id,A.reg_id,A.coh_id,A.asi_cod,B.asi_nom,A.sec_id");*/
	$sql="SELECT A.asi_cod AS 'asi_cod',A.asi_nom AS 'asi_nom', B.nuc_nom AS 'nuc_nom', B.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', CONCAT(A.asi_cod,' ',A.asi_nom) AS 'asigna', B.sec_id AS 'sec_id', B.sec_nom AS 'sec_nom', B.mod_id AS 'mod_id', B.mod_nom AS 'mod_nom', B.coh_id AS 'coh_id', B.coh_nom AS 'coh_nom', B.esp_id AS 'esp_id', B.esp_nom AS 'esp_nom', B.reg_id AS 'reg_id', B.reg_nom AS 'reg_nom', B.ele_nom AS 'ele_nom', B.ase_tev AS 'ase_tev', B.ase_pte AS 'ase_pte', B.ase_pla AS 'ase_pla', B.ase_cma AS 'ase_cma', B.pac_id AS 'pac_id' FROM asigna AS A RIGHT JOIN(SELECT B.mod_id AS 'mod_id',F.mod_nom AS 'mod_nom', B.esp_id AS 'esp_id', G.esp_nom AS 'esp_nom', B.reg_id AS 'reg_id', H.reg_nom AS 'reg_nom', B.coh_id AS 'coh_id', I.coh_nom AS 'coh_nom', B.pen_top AS 'pen_top', B.asi_cod AS 'asi_cod', B.sec_id AS 'sec_id', E.sec_nom AS 'sec_nom', B.ase_id AS 'ase_id', C.nuc_nom AS 'nuc_nom', C.nuc_id AS 'nuc_id', D.inf_nom AS 'inf_nom', D.inf_id AS 'inf_id', J.ele_nom AS 'ele_nom', B.ase_tev AS 'ase_tev', B.ase_pte AS 'ase_pte', B.ase_pla AS 'ase_pla', B.ase_cma AS 'ase_cma', B.pac_id AS 'pac_id' FROM asigna_seccio B, nucleo C, infrae D, seccio E, modali F, especi G, regimen H, cohort I, electi J WHERE B.ele_cod=J.ele_cod AND B.mod_id=F.mod_id AND B.esp_id=G.esp_id AND B.reg_id=H.reg_id AND B.coh_id=I.coh_id AND B.sec_id=E.sec_id AND E.inf_id=D.inf_id AND D.nuc_id=C.nuc_id AND B.ase_sta='1' AND C.nuc_sta='1' AND D.inf_sta='1' AND E.sec_sta='1' AND F.mod_sta='1' AND G.esp_sta='1' AND H.reg_sta='1' AND I.coh_sta='1' AND B.ase_id='$ase_id') AS B ON A.mod_id=B.mod_id AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod WHERE A.asi_sta='1' GROUP BY B.nuc_id,B.inf_id,A.mod_id,A.esp_id,A.reg_id,A.coh_id,A.asi_cod,A.asi_nom,B.sec_id";
	$res=mysql_query($sql,$this->conexion);
    return $res;
  }
//******************************************************************
  function Buscar_estudiantes_matric($ci_est){ 
/*  echo "<script>alert('SELECT COUNT(*) AS cant_ins FROM detins WHERE mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND coh_id=$coh_id AND asi_cod=$asi_cod AND sec_id=$sec_id AND det_sta=1 AND pac_id=$this->pac_id GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id');</script>";*/
    $sql="SELECT A.pac_id AS 'pac_id', A.pac_fin AS 'pac_fin' FROM pacade AS A, detins B WHERE B.det_sta='1' AND A.pac_sta='1' AND A.pac_int='0' AND B.pac_id=A.pac_id AND B.ci_est='$ci_est' GROUP BY A.pac_id ORDER BY A.pac_fin ASC";
	$res=mysql_query($sql,$this->conexion);
	$array=mysql_fetch_object($res);
	$sql="SELECT A.pac_id AS 'pac_id', A.pac_fin AS 'pac_fin' FROM pacade AS A WHERE DATEDIFF(A.pac_fin,'$array->pac_fin')>=0 AND A.pac_int='0' ORDER BY A.pac_fin ASC";
	$res_sem=mysql_query($sql,$this->conexion);
	$array_sem=mysql_num_rows($res_sem);
    return $array_sem;
  }
//******************************************************************
  function Buscar_semestre_asigna_estudiantes_matric($ci_est,$ase_id){ 
/*  echo "<script>alert('SELECT COUNT(*) AS cant_ins FROM detins WHERE mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND coh_id=$coh_id AND asi_cod=$asi_cod AND sec_id=$sec_id AND det_sta=1 AND pac_id=$this->pac_id GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id');</script>";*/
    $sql="SELECT A.asi_mod AS 'asi_mod' FROM asigna AS A, detins B, asigna_seccio C WHERE B.det_sta='1' AND A.asi_sta='1' AND C.ase_sta='1' AND B.pac_id=C.pac_id AND B.ci_est='$ci_est' AND B.mod_id=C.mod_id AND B.esp_id=C.esp_id AND B.reg_id=C.reg_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND B.asi_cod=C.asi_cod AND B.sec_id=C.sec_id AND B.pac_id=C.pac_id AND C.ase_id='$ase_id' AND A.mod_id=C.mod_id AND A.esp_id=C.esp_id AND A.reg_id=C.reg_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND A.asi_cod=C.asi_cod";
	$res=mysql_query($sql,$this->conexion);
	$array=mysql_fetch_object($res);
    return $array->asi_mod;
  }
//******************************************************************
  function Contar_Inscritos($asi_cod,$mod_id,$esp_id,$reg_id,$coh_id,$sec_id,$pac_id){ 
/*  echo "<script>alert('SELECT COUNT(*) AS cant_ins FROM detins WHERE mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND coh_id=$coh_id AND asi_cod=$asi_cod AND sec_id=$sec_id AND det_sta=1 AND pac_id=$pac_id GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id');</script>";*/
    $sql="SELECT COUNT(*) AS 'cant_ins' FROM detins WHERE mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND coh_id='$coh_id' AND asi_cod='$asi_cod' AND sec_id='$sec_id' AND det_sta='1' AND pac_id='$pac_id' GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id";
	$res=mysql_query($sql,$this->conexion);
	$array=mysql_fetch_object($res);
	if($array->cant_ins<=0)
	  $cant_ins=0;
	else
	  $cant_ins=$array->cant_ins;
    return $cant_ins;
  }
//******************************************************************
  function Contar_Inscritos_aprobados($asi_cod,$mod_id,$esp_id,$reg_id,$coh_id,$sec_id,$pac_id){ 
/*  echo "<script>alert('SELECT COUNT(*) AS cant_ins FROM detins WHERE mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND coh_id=$coh_id AND asi_cod=$asi_cod AND sec_id=$sec_id AND det_sta=1 AND pac_id=$pac_id GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id');</script>";*/
    $sql="SELECT COUNT(*) AS 'cant_ins' FROM detins WHERE mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND coh_id='$coh_id' AND asi_cod='$asi_cod' AND sec_id='$sec_id' AND det_sta='1' AND pac_id='$pac_id' AND det_con='1' GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id";
	$res=mysql_query($sql,$this->conexion);
	$array=mysql_fetch_object($res);
	if($array->cant_ins<=0)
	  $cant_ins=0;
	else
	  $cant_ins=$array->cant_ins;
    return $cant_ins;
  }
//******************************************************************
  function Contar_Inscritos_reprobados($asi_cod,$mod_id,$esp_id,$reg_id,$coh_id,$sec_id,$pac_id){ 
/*  echo "<script>alert('SELECT COUNT(*) AS cant_ins FROM detins WHERE mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND coh_id=$coh_id AND asi_cod=$asi_cod AND sec_id=$sec_id AND det_sta=1 AND pac_id=$pac_id GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id');</script>";*/
    $sql="SELECT COUNT(*) AS 'cant_ins' FROM detins WHERE mod_id='$mod_id' AND esp_id='$esp_id' AND reg_id='$reg_id' AND coh_id='$coh_id' AND asi_cod='$asi_cod' AND sec_id='$sec_id' AND det_sta='1' AND pac_id='$pac_id' AND det_con='0' GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id";
	$res=mysql_query($sql,$this->conexion);
	$array=mysql_fetch_object($res);
	if($array->cant_ins<=0)
	  $cant_ins=0;
	else
	  $cant_ins=$array->cant_ins;
    return $cant_ins;
  }
//******************************************************************
  function Contar_Inscritos_ase_id($ase_id){ 
/*  echo "<script>alert('SELECT COUNT(*) AS cant_ins FROM detins WHERE mod_id=$mod_id AND esp_id=$esp_id AND reg_id=$reg_id AND coh_id=$coh_id AND asi_cod=$asi_cod AND sec_id=$sec_id AND det_sta=1 AND pac_id=$this->pac_id GROUP BY mod_id,esp_id,reg_id,coh_id,pen_top,asi_cod,sec_id');</script>";*/
    $sql="SELECT B.ci_est AS 'ci_est',A.coh_id AS 'coh_id',A.esp_id AS 'esp_id',A.reg_id AS 'reg_id',A.pen_top AS 'pen_top' FROM asigna_seccio AS A, detins AS B WHERE A.ase_id = '$ase_id' AND A.mod_id = B.mod_id AND A.esp_id = B.esp_id AND A.reg_id = B.reg_id AND A.coh_id = B.coh_id AND A.pen_top = B.pen_top AND A.asi_cod = B.asi_cod AND A.sec_id = B.sec_id AND A.pac_id = B.pac_id AND A.ase_sta = '1' AND B.det_sta = '1'";
    $res=mysql_query($sql,$this->conexion);
	return $res;
  }
//******************************************************************
  function List_Estud_Insc_Fec_Nac_nacio_sexo($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id*coh_id
	if($valor1[0]!="todos")
	  $nucleo="AND L.nuc_id='$valor1[0]'";
    else
      $nucleo="";	
	if($valor1[1]!="todos")
	    $infrae="AND L.inf_id='$valor1[1]'";
	else
	    $infrae="";
	if($valor1[2]!="todos")
	  $periodo="AND B.pac_id='$valor1[2]'";
	else
	  $periodo="";	
	if($valor1[3]!="todos")
	  $modalidad="AND B.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND B.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND B.esp_id='$valor1[5]'";
	else
	  $carrera="";
	if($valor1[6]!="todos")
	  $pensum="AND B.coh_id='$valor1[6]'"; 
	else
	  $pensum="";
	$sql="SELECT N.nuc_nom AS 'NUCLEO',L.inf_nom AS 'SEDE',M.mod_nom AS 'MODALIDAD',C.esp_nom AS 'ESPECIALIDAD',D.reg_nom AS 'REGIMEN',G.coh_nom AS 'PENSUM',MIN(E.asi_mod) AS 'SEMESTRE',A.ci AS 'CEDULA',UPPER(CONCAT(A.ap1,' ',A.ap2)) AS 'APELLIDOS',UPPER(CONCAT(A.no1,' ',A.no2)) AS 'NOMBRES',H.hon_fna AS 'FECHA_DE_NACIMIENTO',J.pai_nac AS 'NACIONALIDAD',A.sex AS 'SEXO' FROM persona A,detins B,especi C,regimen D,asigna E,matric F,cohort G,dir_hon H,nacionali I,pais J,estudi_infrae K, infrae L, modali M, nucleo N WHERE A.ci=B.ci_est AND A.ci=F.ci AND A.ci=H.ci AND G.coh_id=F.coh_id AND F.matr_sta='1' AND B.esp_id=F.esp_id AND B.reg_id=F.reg_id AND B.mod_id=F.mod_id AND B.coh_id=F.coh_id AND B.pen_top=F.pen_top AND B.det_sta='1' AND A.sta='1' AND B.mod_id=M.mod_id AND M.mod_sta='1' AND B.esp_id=C.esp_id AND B.reg_id=D.reg_id AND B.asi_cod=E.asi_cod AND B.esp_id=E.esp_id AND B.reg_id=E.reg_id AND B.mod_id=E.mod_id AND B.coh_id=E.coh_id AND B.pen_top=E.pen_top AND A.ci=I.ci AND I.nac_est='1' AND I.pai_id=J.pai_id AND J.pai_sta='1' AND A.ci=K.ci AND K.est_inf_ffi='0000-00-00 00:00:00' AND K.inf_id=L.inf_id AND L.inf_sta='1' AND L.nuc_id=N.nuc_id AND N.nuc_sta='1' ".$infrae." ".$nucleo." ".$periodo." ".$modalidad."  ".$regimen." ".$carrera." ".$pensum." GROUP BY A.ci,J.pai_nac ORDER BY C.esp_nom,D.reg_nom,G.coh_nom,MIN(E.asi_mod),A.ci";
	//esta consulta no funciona bien si no se coloca el periodo academico
  $List_Estud_Insc_Fec_Nac_nacio_sexo=mysql_query($sql,$this->conexion);
  return $List_Estud_Insc_Fec_Nac_nacio_sexo;
  }
//******************************************************************
  function List_Estud_Posi_Art_7($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id*coh_id
	if($valor1[0]!="todos")
	  $nucleo="AND L.nuc_id='$valor1[0]'";
    else
      $nucleo="";	
	if($valor1[1]!="todos")
	    $infrae="AND L.inf_id='$valor1[1]'";
	else
	    $infrae="";
	if($valor1[2]!="todos")
	  $periodo="AND B.pac_id='$valor1[2]'";
	else
	  $periodo="";	
	if($valor1[3]!="todos")
	  $modalidad="AND B.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND B.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND B.esp_id='$valor1[5]'";
	else
	  $carrera="";
	if($valor1[6]!="todos")
	  $pensum="AND B.coh_id='$valor1[6]'"; 
	else
	  $pensum="";
	$sql="SELECT N.nuc_nom AS 'NUCLEO', L.inf_nom AS 'SEDE', M.mod_nom AS 'MODALIDAD', C.esp_nom AS 'ESPECIALIDAD', D.reg_nom AS 'REGIMEN', G.coh_nom AS 'PENSUM', A.ci AS 'CEDULA', UPPER(CONCAT(A.ap1,' ',A.ap2)) AS 'APELLIDOS', UPPER(CONCAT(A.no1,' ',A.no2)) AS 'NOMBRES', E.asi_mod AS 'SEMESTRE', E.asi_cod AS 'CODIGO', E.asi_nom AS 'ASIGNATURA', B.pac_id AS 'PACADE', B.det_nde AS 'DEFINITIVA', E.pen_top AS 'pen_top', B.mod_id AS 'mod_id', B.esp_id AS 'esp_id', B.reg_id AS 'reg_id', B.coh_id AS 'coh_id' FROM persona A, detins B, especi C, regimen D, asigna E, matric F, cohort G, seccio H, infrae L, modali M, nucleo N WHERE A.ci=B.ci_est AND A.ci=F.ci AND G.coh_id=F.coh_id AND B.esp_id=F.esp_id AND B.reg_id=F.reg_id AND B.mod_id=F.mod_id AND B.coh_id=F.coh_id AND B.pen_top=F.pen_top AND B.det_sta='1' AND B.sec_id=H.sec_id AND H.sec_sta='1' AND A.sta='1' AND B.mod_id=M.mod_id AND M.mod_sta='1' AND B.esp_id=C.esp_id AND B.reg_id=D.reg_id AND B.asi_cod=E.asi_cod AND B.esp_id=E.esp_id AND B.reg_id=E.reg_id AND B.mod_id=E.mod_id AND B.coh_id=E.coh_id AND B.pen_top=E.pen_top AND L.inf_sta='1' AND L.nuc_id=N.nuc_id AND N.nuc_sta='1' AND B.det_con='0' ".$infrae." ".$nucleo." ".$periodo." ".$modalidad."  ".$regimen." ".$carrera." ".$pensum." GROUP BY A.ci, E.asi_cod ORDER BY C.esp_nom, D.reg_nom, G.coh_nom, A.ci, E.asi_mod, E.asi_cod";
	//esta consulta no funciona bien si no se coloca el periodo academico
  $List_List_Estud_Posi_Art_7=mysql_query($sql,$this->conexion);
  return $List_List_Estud_Posi_Art_7;
  }
//******************************************************************
  function List_Estud_Art_7($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id*coh_id
	if($valor1[0]!="todos")
	  $nucleo="AND L.nuc_id='$valor1[0]'";
    else
      $nucleo="";	
	if($valor1[1]!="todos")
	    $infrae="AND L.inf_id='$valor1[1]'";
	else
	    $infrae="";
	if($valor1[2]!="todos")
	  $periodo="AND B.pac_id='$valor1[2]'";
	else
	  $periodo="";	
	if($valor1[3]!="todos")
	  $modalidad="AND B.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND B.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND B.esp_id='$valor1[5]'";
	else
	  $carrera="";
	if($valor1[6]!="todos")
	  $pensum="AND B.coh_id='$valor1[6]'"; 
	else
	  $pensum="";
	$sql="SELECT N.nuc_nom AS 'NUCLEO', L.inf_nom AS 'SEDE', M.mod_nom AS 'MODALIDAD', C.esp_nom AS 'ESPECIALIDAD', D.reg_nom AS 'REGIMEN', G.coh_nom AS 'PENSUM', A.ci AS 'CEDULA', UPPER(CONCAT(A.ap1,' ',A.ap2)) AS 'APELLIDOS', UPPER(CONCAT(A.no1,' ',A.no2)) AS 'NOMBRES', E.asi_mod AS 'SEMESTRE', E.asi_cod AS 'CODIGO', E.asi_nom AS 'ASIGNATURA', B.pac_id AS 'PACADE' FROM persona A, detins B, especi C, regimen D, asigna E, matric F, cohort G, infrae L, modali M, nucleo N, apli_reg P WHERE A.ci=B.ci_est AND A.ci=F.ci AND G.coh_id=F.coh_id AND B.esp_id=F.esp_id AND B.reg_id=F.reg_id AND B.mod_id=F.mod_id AND B.coh_id=F.coh_id AND B.pen_top=F.pen_top AND B.det_sta='1' AND A.sta='1' AND B.mod_id=M.mod_id AND M.mod_sta='1' AND B.esp_id=C.esp_id AND B.reg_id=D.reg_id AND B.asi_cod=E.asi_cod AND B.esp_id=E.esp_id AND B.reg_id=E.reg_id AND B.mod_id=E.mod_id AND B.coh_id=E.coh_id AND B.pen_top=E.pen_top AND L.inf_sta='1' AND L.nuc_id=N.nuc_id AND N.nuc_sta='1' AND B.det_con='0' ".$infrae." ".$nucleo." ".$periodo." ".$modalidad."  ".$regimen." ".$carrera." ".$pensum." AND B.pac_id=P.pac_id AND P.ci_est=B.ci_est AND B.asi_cod=P.asi_cod AND P.apr_sta='1' GROUP BY A.ci, E.asi_cod ORDER BY C.esp_nom, D.reg_nom, G.coh_nom, A.ci, E.asi_mod, E.asi_cod";
	//esta consulta no funciona bien si no se coloca el periodo academico
  $List_List_Estud_Posi_Art_7=mysql_query($sql,$this->conexion);
  return $List_List_Estud_Posi_Art_7;
  }
//******************************************************************
  function List_Estud_Posi_Art_7_Nota($esp_id, $reg_id, $coh_id, $pen_top, $asi_cod, $ci_est, $mod_id, $pac_id){	  
	$sql_pacade="SELECT pac_fin FROM pacade WHERE pac_id='$pac_id'";
    $fecha_pacade=mysql_query($sql_pacade,$this->conexion);
	$pacade_fecha=mysql_fetch_object($fecha_pacade);  
	$sql_nota="SELECT A.det_nde, A.pac_id FROM detins A, pacade B WHERE A.esp_id='$esp_id' AND A.reg_id='$reg_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.asi_cod='$asi_cod' AND A.ci_est='$ci_est' AND A.det_sta='1' AND A.det_con='0' AND A.pac_id=B.pac_id AND B.pac_sta='1' AND B.mod_id='$mod_id' AND DATEDIFF('$pacade_fecha->pac_fin',B.pac_fin)>0 ORDER BY B.pac_fin";
  $List_Nota_Estud_Posi_Art_7=mysql_query($sql_nota,$this->conexion);  
	$num_filas=mysql_num_rows($List_Nota_Estud_Posi_Art_7);
  return $List_Nota_Estud_Posi_Art_7;
  }
//******************************************************************
  function List_Estud_Insc_Mater_Seccio($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id*coh_id
	if($valor1[0]!="todos")
	  $nucleo="AND L.nuc_id='$valor1[0]'";
    else
      $nucleo="";	
	if($valor1[1]!="todos")
	    $infrae="AND K.inf_id='$valor1[1]'";
	else
	    $infrae="";
	if($valor1[2]!="todos")
	  $periodo="AND C.pac_id='$valor1[2]'";
	else
	  $periodo="";	
	if($valor1[3]!="todos")
	  $modalidad="AND M.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND C.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND C.esp_id='$valor1[5]'";
	else
	  $carrera="";
	if($valor1[6]!="todos")
	  $pensum="AND C.coh_id='$valor1[6]'"; 
	else
	  $pensum="";
	$sql="SELECT L.nuc_nom AS 'NUCLEO', K.inf_nom AS 'SEDE', M.mod_nom AS 'MODALIDAD', I.coh_nom AS 'PENSUM', G.esp_nom AS 'ESPECIALIDAD', H.reg_nom AS 'REGIMEN',A.ci AS 'CEDULA_ESTUDIANTE',
UPPER(CONCAT(A.ap1,' ',A.ap2,' ',A.no1,' ',A.no2)) AS 'APELLIDOS_Y_NOMBRES_DEL_ESTUDIANTE',
F.asi_mod AS 'SEMESTRE', UPPER(F.asi_cod) AS 'CODIGO_DE_LA_ASIGNATURA', UPPER(F.asi_nom) AS 'NOMBRE_DE_LA_ASIGNATURA',
E.sec_nom AS 'SECCION', B.ci AS 'CEDULA_DEL_DOCENTE', UPPER(CONCAT(B.ap1,' ',B.ap2,' ',B.no1,' ',B.no2)) AS 'APELLIDOS_Y_NOMBRES_DEL_DOCENTE'
FROM persona A, persona B, detins C, asigna_seccio D, seccio E, asigna F, especi G, regimen H, cohort I, matric J, infrae K, nucleo L, modali M WHERE
M.mod_id=C.mod_id AND
E.inf_id=K.inf_id AND
K.nuc_id=L.nuc_id AND
C.det_sta='1' AND
A.ci=C.ci_est AND
C.asi_cod=D.asi_cod AND
C.sec_id=D.sec_id AND
C.esp_id=D.esp_id AND
C.reg_id=D.reg_id AND
C.coh_id=D.coh_id AND
C.mod_id=D.mod_id AND
C.pen_top=D.pen_top AND
C.pac_id=D.pac_id AND
D.sec_id=E.sec_id AND
F.asi_cod=D.asi_cod AND
F.esp_id=D.esp_id AND
F.reg_id=D.reg_id AND
F.coh_id=D.coh_id AND
F.mod_id=D.mod_id AND
F.pen_top=D.pen_top AND
F.esp_id=G.esp_id AND
F.reg_id=H.reg_id AND
F.coh_id=I.coh_id AND
J.matr_sta='1' AND
A.ci=J.ci AND
C.esp_id=J.esp_id AND
C.reg_id=J.reg_id AND
C.coh_id=J.coh_id AND
C.mod_id=J.mod_id AND
C.pen_top=J.pen_top AND
B.ci=D.ci_emp ".$infrae." ".$nucleo." ".$periodo." ".$modalidad."  ".$regimen." ".$carrera." ".$pensum." ORDER BY I.coh_nom,G.esp_nom,H.reg_nom,A.ci,A.ap1,A.ap2,A.no1,A.no2,F.asi_cod,F.asi_nom,E.sec_nom,B.ci,B.ap1,B.ap2,B.no1,B.no2";
	/*$sql="SELECT I.coh_nom AS 'PENSUM',G.esp_nom AS 'ESPECIALIDAD',H.reg_nom AS 'REGIMEN',A.ci AS 'CEDULA_ESTUDIANTE',UPPER(CONCAT(A.ap1,' ',A.ap2,' ',A.no1,' ',A.no2)) AS 'APELLIDOS_Y_NOMBRES_DEL_ESTUDIANTE',F.asi_mod AS 'SEMESTRE',UPPER(F.asi_cod) AS 'CODIGO_DE_LA_ASIGNATURA',UPPER(F.asi_nom) AS 'NOMBRE_DE_LA_ASIGNATURA',E.sec_nom AS 'SECCION',B.ci AS 'CEDULA_DEL_DOCENTE',UPPER(CONCAT(B.ap1,' ',B.ap2,' ',B.no1,' ',B.no2)) AS 'APELLIDOS_Y_NOMBRES_DEL_DOCENTE' FROM persona A,persona B,detins C,asigna_seccio D,seccio E,asigna F,especi G,regimen H,cohort I,matric J,infrae K WHERE C.det_sta='1' AND A.ci=C.ci_est AND C.asi_cod=D.asi_cod AND C.sec_id=D.sec_id AND C.esp_id=D.esp_id AND C.reg_id=D.reg_id AND C.coh_id=D.coh_id AND C.mod_id=D.mod_id AND C.pen_top=D.pen_top AND C.pac_id=D.pac_id AND D.sec_id=E.sec_id AND F.asi_cod=D.asi_cod AND F.esp_id=D.esp_id AND F.reg_id=D.reg_id AND F.coh_id=D.coh_id AND F.mod_id=D.mod_id AND F.pen_top=D.pen_top AND F.esp_id=G.esp_id AND F.reg_id=H.reg_id AND F.coh_id=I.coh_id AND J.matr_sta='1' AND A.ci=J.ci AND C.esp_id=J.esp_id AND C.reg_id=J.reg_id AND C.coh_id=J.coh_id AND C.mod_id=J.mod_id AND C.pen_top=J.pen_top AND B.ci=D.ci_emp AND E.inf_id=K.inf_id AND E.sec_sta='1' AND K.inf_sta='1' ".$infrae." ".$nucleo." ".$periodo." ".$modalidad."  ".$regimen." ".$carrera." ".$pensum." ORDER BY I.coh_nom,G.esp_nom,H.reg_nom,A.ci,A.ap1,A.ap2,A.no1,A.no2,F.asi_cod,F.asi_nom,E.sec_nom,B.ci,B.ap1,B.ap2,B.no1,B.no2";*/
  $List_Estud_Insc_Mater_Seccio=mysql_query($sql,$this->conexion);
  return $List_Estud_Insc_Mater_Seccio;
  }
//******************************************************************
  function Deserciones_PA($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id*coh_id
	if($valor1[0]!="todos")
	  $nucleo="AND I.nuc_id='$valor1[0]'";
    else
      $nucleo="";	
	if($valor1[1]!="todos")
	    $infrae="AND I.inf_id='$valor1[1]'";
	else
	    $infrae="";
	if($valor1[2]!="todos"){
	  $periodo="AND B.pac_id='$valor1[2]'";
	  $sql1="SELECT pac_id FROM pacade WHERE DATEDIFF((SELECT pac_fin FROM pacade WHERE pac_id='$valor1[2]' AND pac_sta='1' ORDER BY pac_fin DESC),pac_fin)>0 AND pac_sta='1' ORDER BY pac_fin DESC"; 
	  $periodo_ant=mysql_query($sql1,$this->conexion);
	  $ext_periodo_ant=mysql_fetch_object($periodo_ant);
	}
	else
	  $periodo="";	
	if($valor1[3]!="todos")
	  $modalidad="AND B.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND B.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND B.esp_id='$valor1[5]'";
	else
	  $carrera="";
	if($valor1[6]!="todos")
	  $pensum="AND B.coh_id='$valor1[6]'"; 
	else
	  $pensum="";
	$sql="SELECT K.nuc_nom AS 'NUCLEO',I.inf_nom AS 'SEDE',J.mod_nom AS 'MODALIDAD',C.esp_nom AS 'ESPECIALIDAD',D.reg_nom AS 'REGIMEN',G.coh_nom AS 'PENSUM',MIN( E.asi_mod ) AS 'SEMESTRE',A.ci AS 'CEDULA',UPPER(CONCAT(A.ap1,' ',A.ap2)) AS 'APELLIDOS',UPPER(CONCAT(A.no1,' ',A.no2)) AS 'NOMBRES' FROM persona A,detins B,especi C,regimen D,asigna E,matric F,cohort G,seccio H,infrae I,modali J,nucleo K WHERE A.ci=B.ci_est AND A.ci NOT IN (SELECT DISTINCT(ci_est) FROM detins WHERE det_sta='1' AND pac_id='$valor1[2]') AND A.ci NOT IN (SELECT DISTINCT(ci_est) FROM apli_reg WHERE pac_id='$valor1[2]') AND A.ci=F.ci AND G.coh_id=F.coh_id AND F.matr_sta='1' AND B.esp_id=F.esp_id AND B.reg_id=F.reg_id AND B.mod_id=F.mod_id AND B.coh_id=F.coh_id AND B.pen_top=F.pen_top AND B.pac_id='$ext_periodo_ant->pac_id' AND A.ci NOT IN (SELECT DISTINCT(ci_est) FROM detins WHERE pac_id='$ext_periodo_ant->pac_id' AND det_sta='1' AND (asi_cod LIKE('PSI%') OR asi_cod='IRA-30303' OR asi_cod='IRC-30303') AND det_con='1') AND B.det_sta='1' AND B.esp_id=C.esp_id AND B.reg_id=D.reg_id AND B.asi_cod=E.asi_cod AND B.esp_id=E.esp_id AND B.reg_id=E.reg_id AND B.mod_id=E.mod_id AND B.coh_id=E.coh_id AND B.pen_top=E.pen_top AND B.sec_id=H.sec_id AND H.sec_sta='1' AND H.inf_id=I.inf_id AND I.inf_sta='1' AND B.mod_id=J.mod_id AND J.mod_sta='1' AND I.nuc_id=K.nuc_id AND K.nuc_sta='1' ".$infrae." ".$nucleo." ".$modalidad."  ".$regimen." ".$carrera." ".$pensum." GROUP BY A.ci ORDER BY C.esp_nom,D.reg_nom,G.coh_nom,MIN(E.asi_mod),A.ci";
  $Deserciones_PA=mysql_query($sql,$this->conexion);
  return $Deserciones_PA;
  }
//******************************************************************
  function List_Posib_pasan($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
	$mat_pensum=0;
    $mat_aprob_estud=0;
	$dat_mat="";
    $i=0;
	$pac_fin=$this->fecha_IA($pac_id);
/*echo "<script>alert('$pac_fin  $ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id')</script>";*/
    $sql="SELECT asi_cod, asi_nom FROM asigna WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND asi_sta=1 AND asi_cod NOT IN (SELECT asi_cod FROM asigna WHERE mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND asi_sta=1 AND (asi_cod like ('ACO-0000%') OR asi_cod like ('IMI-%') OR asi_cod like ('DEP-0000%') OR asi_cod like ('ADG-1082%')  OR asi_cod like ('PSI%') OR asi_cod='IRA-30303' OR asi_cod='IRC-30303' OR asi_cod LIKE 'TGR%')) AND asi_cod NOT IN ('PRO-00001','TAL-00001')";
    $busc_mat=mysql_query($sql,$this->conexion); 
	$fila_materias=mysql_num_rows($busc_mat);
    while($ext_busc_mat=mysql_fetch_object($busc_mat)){
/*	  echo "<script>alert('SELECT asi_cod FROM detins WHERE asi_cod=$ext_busc_mat->asi_cod AND ci_est=$ci AND mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND coh_id=$coh_id AND pen_top=$pen_top AND det_con=1 AND det_sta=1');</script>";*/
      $sql_mat_estud="SELECT A.asi_cod AS asi_cod FROM detins A,pacade B WHERE A.asi_cod='$ext_busc_mat->asi_cod' AND A.ci_est='$ci' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.det_con='1' AND A.det_sta='1' AND A.pac_id=B.pac_id AND A.mod_id=B.mod_id AND B.pac_sta='1' AND DATEDIFF('$pac_fin',B.pac_fin)>=0";
	  $mat_estud=mysql_query($sql_mat_estud,$this->conexion);
	  $fila=mysql_num_rows($mat_estud);
	  if($fila<='0'){
	    if($dat_mat=="")
	      $dat_mat=$ext_busc_mat->asi_cod." ".$ext_busc_mat->asi_nom;
		else
		  $dat_mat=$dat_mat."@".$ext_busc_mat->asi_cod." ".$ext_busc_mat->asi_nom;
	    $i++;		
	   /*if($ci=='18256200' || $ci=='18313749'){
	      echo "<script>alert('MATERIA POR APROBAR $ext_busc_mat->asi_cod')</script>";
		}*/
	  }
	  else{
	    $mat_aprob_estud++;
	  }
	  $mat_pensum++;
	}
	/*echo "<script>alert('$ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id,        $mat_aprob_estud!=$mat_pensum')</script>";*/
	if($fila_materias!=$mat_aprob_estud)
	  $posible_pasante=0;
	else{
	  $fila=$this->pasant_aprob($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id);
	  if($fila>0)
	    $posible_pasante=0;
	  else
	    $posible_pasante=1;
	}
/*	if($ci=='18256200' || $ci=='18313749'){
  echo "<script>alert('$fila_materias!=$mat_aprob_estud  $posible_pasante');</script>";
    }*/
    return $posible_pasante;
  }
//******************************************************************
  function pasant_aprob($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
    $sql1="SELECT det_con FROM detins WHERE ci_est='$ci' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND det_sta='1' AND (asi_cod LIKE('PSI%') OR asi_cod='IRA-30303' OR asi_cod='IRC-30303' OR asi_cod LIKE 'TGR%') AND pac_id='$pac_id'";
	$mat_pasan=mysql_query($sql1,$this->conexion);
	$valor=mysql_num_rows($mat_pasan);
	return $valor;
  }
//******************************************************************
  function buscar_asi_mod($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top,$pac_id){
    $sql1="SELECT MIN(B.asi_mod) AS 'ASI_MOD' FROM detins A,asigna B,asigna_seccio C WHERE A.ci_est='$ci' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.esp_id='$esp_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top' AND A.pac_id='$pac_id' AND A.det_sta='1' AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND A.pac_id=C.pac_id AND B.asi_cod=C.asi_cod AND B.asi_sta='1' AND C.ase_sta='1' GROUP BY B.asi_mod ORDER BY MIN(B.asi_mod)";
	$valor=mysql_query($sql1,$this->conexion);
	/*echo "<script>alert('SELECT MIN(B.asi_mod) AS ASI_MOD FROM detins A,asigna B,asigna_seccio C WHERE A.ci_est=$ci AND A.mod_id=$mod_id AND A.reg_id=$reg_id AND A.esp_id=$esp_id AND A.coh_id=$coh_id AND A.pen_top=$pen_top AND A.pac_id=$pac_id AND A.det_sta=1 AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.pen_top=B.pen_top AND A.asi_cod=B.asi_cod AND B.mod_id=C.mod_id AND B.reg_id=C.reg_id AND B.esp_id=C.esp_id AND B.coh_id=C.coh_id AND B.pen_top=C.pen_top AND A.pac_id=C.pac_id AND B.asi_cod=C.asi_cod GROUP BY B.asi_mod ORDER BY MIN(B.asi_mod)')</script>";*/
	return $valor;
  }
//******************************************************************
  function List_Estud_Insc_IA_sin_pasan($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id*coh_id
	if($valor1[1]!="todos")
	  $infrae="AND I.inf_id='$valor1[1]'";
	else
	  $infrae="";
	if($valor1[0]!="todos")
	  $nucleo="AND H.nuc_id='$valor1[0]'";
	else
	  $nucleo="";
	if($valor1[2]!="todos")
	  $periodo="AND B.pac_id='$valor1[2]'";
	else
	  $periodo="";
	if($valor1[3]!="todos")
	  $modalidad="AND B.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND B.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND B.esp_id='$valor1[5]'";
	else
	  $carrera="";
	if($valor1[6]!="todos")
	  $pensum="AND B.coh_id='$valor1[6]'";
	else 
	  $pensum="";
	$sql="SELECT H.nuc_nom AS 'NUCLEO',I.inf_nom AS 'SEDE',K.mod_nom AS 'MODALIDAD',C.esp_nom AS 'ESPECIALIDAD',D.reg_nom AS 'REGIMEN',G.coh_nom AS 'PENSUM',MIN(E.asi_mod) AS 'ASI_MOD',A.ci AS 'CEDULA',UPPER(CONCAT(A.ap1,' ', A.ap2)) AS 'APELLIDOS',UPPER(CONCAT(A.no1,' ', A.no2)) AS 'NOMBRES',K.mod_id AS mod_id,C.esp_id AS esp_id,D.reg_id AS reg_id,G.coh_id AS coh_id,B.pen_top AS pen_top FROM persona A,detins B,especi C,regimen D,asigna E,matric F,cohort G,nucleo H,infrae I,seccio J,modali K WHERE A.ci=B.ci_est AND A.ci=F.ci AND G.coh_id=F.coh_id AND F.matr_sta='1' AND B.esp_id=F.esp_id AND B.reg_id=F.reg_id AND B.mod_id=F.mod_id AND B.coh_id=F.coh_id AND B.pen_top=F.pen_top ".$infrae." ".$nucleo." ".$periodo." ".$modalidad." ".$regimen." ".$carrera." ".$pensum." AND B.det_sta='1' AND A.sta='1' AND B.esp_id=C.esp_id AND B.reg_id=D.reg_id AND B.asi_cod=E.asi_cod AND B.esp_id=E.esp_id AND B.reg_id=E.reg_id AND B.mod_id=E.mod_id AND B.coh_id=E.coh_id AND B.pen_top=E.pen_top AND B.mod_id=K.mod_id AND B.sec_id=J.sec_id AND J.inf_id=I.inf_id AND I.nuc_id=H.nuc_id AND B.ci_est IN (SELECT DISTINCT(ci_est) FROM detins WHERE det_sta='1' ".$periodo." ".$modalidad." ".$regimen." ".$carrera." ".$pensum.") AND B.ci_est NOT IN (SELECT DISTINCT(ci_est) FROM detins WHERE det_sta='1' ".$periodo." ".$modalidad." ".$regimen." ".$carrera." ".$pensum." AND (asi_cod LIKE('PSI%') OR asi_cod='IRA-30303' OR asi_cod='IRC-30303' OR asi_cod LIKE 'TGR%')) GROUP BY A.ci ORDER BY H.nuc_nom,I.inf_nom,K.mod_nom,C.esp_nom,D.reg_nom,G.coh_nom,MIN(E.asi_mod),A.ci";
  $List_Estud_Insc_IA_sin_pasan=mysql_query($sql,$this->conexion);
  return $List_Estud_Insc_IA_sin_pasan;
  }
//******************************************************************
  function oferta_academica_docent($valor){
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id*coh_id
	if($valor1[0]!="todos")
	  $nucleo="AND K.nuc_id='$valor1[0]'";
    else
      $nucleo="";	
	if($valor1[1]!="todos")
	    $infrae="AND J.inf_id='$valor1[1]'";
	else
	    $infrae="";
	if($valor1[2]!="todos")
	  $periodo="AND A.pac_id='$valor1[2]'";
	else
	  $periodo="";	
	if($valor1[3]!="todos")
	  $modalidad="AND A.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND A.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND A.esp_id='$valor1[5]'";
	else
	  $carrera="";
	if($valor1[6]!="todos")
	  $pensum="AND A.coh_id='$valor1[6]'";
	else
	  $pensum="";
	$sql="SELECT K.nuc_nom AS 'NUCLEO', J.inf_nom AS 'SEDE', D.mod_nom AS 'MODALIDAD', F.reg_nom AS 'REGIMEN', E.coh_nom AS 'PENSUM', G.esp_nom AS 'ESPECIALIDAD', C.asi_mod AS 'SEMESTRE', CONCAT(C.asi_cod,' ',C.asi_nom) AS 'ASIGNATURA', UPPER(CONCAT(L.ele_cod,' ',L.ele_nom)) AS 'ELECTIVA', H.sec_nom AS 'SECCION', A.ase_cma AS 'CUPO_MAXIMO', B.ci AS 'CEDULA', UPPER(CONCAT(B.ap1,' ',B.ap2)) AS 'APELLIDOS', UPPER(CONCAT(B.no1,' ',B.no2)) AS 'NOMBRES' FROM asigna_seccio A, persona B, asigna C, modali D, cohort E, regimen F, especi G, seccio H, detins I, infrae J, nucleo K, electi L WHERE L.ele_cod=A.ele_cod AND H.inf_id=J.inf_id AND J.nuc_id=K.nuc_id AND A.ase_sta='1' AND A.ci_emp=B.ci AND A.coh_id=C.coh_id AND A.mod_id=C.mod_id AND A.reg_id=C.reg_id AND A.esp_id=C.esp_id AND A.asi_cod=C.asi_cod AND A.pen_top=C.pen_top AND A.mod_id=D.mod_id AND A.coh_id=E.coh_id AND A.reg_id=F.reg_id AND A.esp_id=G.esp_id AND A.sec_id=H.sec_id AND A.asi_cod=I.asi_cod AND A.pen_top=I.pen_top AND A.mod_id=I.mod_id AND A.coh_id=I.coh_id AND A.reg_id=I.reg_id AND A.esp_id=I.esp_id AND A.sec_id=I.sec_id ".$infrae." ".$nucleo." ".$periodo." ".$modalidad."  ".$regimen." ".$carrera." ".$pensum." GROUP BY D.mod_nom,F.reg_nom,E.coh_nom,G.esp_nom,C.asi_mod,C.asi_nom,H.sec_nom ORDER BY D.mod_nom,F.reg_nom,E.coh_nom,G.esp_nom,C.asi_mod,C.asi_nom,H.sec_nom";
  $ofert_acad=mysql_query($sql,$this->conexion);
  return $ofert_acad;
  }
//******************************************************************
  function List_Soli_Proc_Sidsecun_periodo($periodo){
    $sql="SELECT UPPER(CONCAT(F.coh_nom)) AS 'PENSUM',UPPER(CONCAT(D.esp_id,' ',D.esp_nom)) AS 'ESPECIALIDAD',UPPER(CONCAT(E.reg_nom)) AS 'REGIMEN', UPPER(CONCAT(C.ci,'',C.ap1,' ',C.ap2,' ',C.no1,' ',C.no2)) AS 'DATOS_DEL_ESTUDIANTE', UPPER(CONCAT(G.asi_cod,'',G.asi_nom)) AS 'DATOS_DE_LA_ASIGNATURA', UPPER(CONCAT(H.sec_nom)) AS 'SECCION',I.pro_nom AS 'PROCESO_SOLICITADO',A.his_fso AS 'FECHA_DE_LA_SOLICITUD',B.`det_obs` AS 'OBSERVACIÓN' FROM `hisest` A,detins B,persona C,especi D,regimen E,cohort F,asigna G,seccio H,proces I WHERE A.det_id=B.det_id AND B.ci_est=C.ci AND B.esp_id=D.esp_id AND B.reg_id=E.reg_id AND B.coh_id=F.coh_id AND B.esp_id=G.esp_id AND B.reg_id=G.reg_id AND B.coh_id=G.coh_id AND B.pen_top=G.pen_top AND B.asi_cod=G.asi_cod AND B.sec_id=H.sec_id AND A.`pro_id`=I.pro_id AND B.pac_id='$periodo'";
	$valor=mysql_query($sql,$this->conexion);
	return $valor;
  }
//******************************************************************
//************************FIN***************************************
//******************************************************************   
  function graduando($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
/*  echo "<script>alert('SELECT * FROM gradua WHERE ci_est=$ci AND mod_id=$mod_id AND reg_id=$reg_id AND esp_id=$esp_id AND coh_id=$coh_id AND pen_top=$pen_top AND grad_sta=1 AND gra_id=1');</script>";*/
    $valor1="SELECT * FROM gradua WHERE ci_est='$ci' AND mod_id='$mod_id' AND reg_id='$reg_id' AND esp_id='$esp_id' AND coh_id='$coh_id' AND pen_top='$pen_top' AND grad_sta='1'";
    $gradua=mysql_query($valor1,$this->conexion); 
    $fila=mysql_num_rows($gradua);
	if($fila>0){
/*	  echo "<script>alert('entre');</script>";*/
	  $val=1;
	}
	else{
      $val=0;
	}
	return $val;
  }
//******************************************************************   
  function Listado_grado($nuc_id){	
    $id="";
	$sql="SELECT * FROM gra_aca WHERE nuc_id='$nuc_id' AND gra_sta='1' order by gra_fec DESC";
      $resul=mysql_query($sql,$this->conexion);
      while($array=mysql_fetch_object($resul)){
		$fec_gra=explode("-",$array->gra_fec);
	    if($id==""){
	      $id=$array->gra_id;
	      $des=$fec_gra[2]."/".$fec_gra[1]."/".$fec_gra[0];
	    }
	    else{
	      $id=$id."*".$array->gra_id;
	      $des=$des."*".$fec_gra[2]."/".$fec_gra[1]."/".$fec_gra[0];
	    }
	    $cuantos++;
	  }	
	  $this->res=$id."@".$des."@".$cuantos;
  } 
//****************************************************************** 
  function indice_merito2($gra_id){ 
  $sql_ult_matric="SELECT * FROM gradua WHERE gra_id='$gra_id' and grad_sta='1' ORDER BY mod_id,esp_id,reg_id,coh_id,pen_top";
  $ult_matric=mysql_query($sql_ult_matric);
  return $ult_matric;
  }
 //******************************************************************
function matric_activas($valor){
/*echo "<script>alert('$valor')</script>";*/
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id*coh_id
	if($valor1[1]!="todos")
	  $infrae="AND I.inf_id='$valor1[1]'";
	else
	  $infrae="";
	if($valor1[0]!="todos")
	  $nucleo="AND H.nuc_id='$valor1[0]'";
	else
	  $nucleo="";
	if($valor1[2]!="todos")
	  $periodo="AND B.pac_id='$valor1[2]'";
	else
	  $periodo="";
	if($valor1[3]!="todos")
	  $modalidad="AND B.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND B.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND B.esp_id='$valor1[5]'";
	else
	  $carrera="";
	if($valor1[6]!="todos")
	  $pensum="AND B.coh_id='$valor1[6]'";
	else 
	  $pensum="";
    $sql="SELECT H.nuc_nom AS 'NUCLEO',I.inf_nom AS 'SEDE',K.mod_nom AS 'MODALIDAD',C.esp_nom AS 'ESPECIALIDAD',D.reg_nom AS 'REGIMEN',G.coh_nom AS 'PENSUM',MIN(E.asi_mod) AS 'ASI_MOD',A.ci AS 'CEDULA',UPPER(CONCAT(A.ap1,' ', A.ap2)) AS 'APELLIDOS',UPPER(CONCAT(A.no1,' ', A.no2)) AS 'NOMBRES',K.mod_id AS mod_id,C.esp_id AS esp_id,D.reg_id AS reg_id,G.coh_id AS coh_id,B.pen_top AS pen_top FROM persona A,detins B,especi C,regimen D,asigna E,matric F,cohort G,nucleo H,infrae I,seccio J,modali K WHERE A.ci=B.ci_est AND A.ci=F.ci AND G.coh_id=F.coh_id AND F.matr_sta='1' AND B.esp_id=F.esp_id AND B.reg_id=F.reg_id AND B.mod_id=F.mod_id AND B.coh_id=F.coh_id AND B.pen_top=F.pen_top ".$infrae." ".$nucleo." ".$modalidad." ".$regimen." ".$carrera." ".$pensum." AND B.det_sta='1' AND A.sta='1' AND B.esp_id=C.esp_id AND B.reg_id=D.reg_id AND B.asi_cod=E.asi_cod AND B.esp_id=E.esp_id AND B.reg_id=E.reg_id AND B.mod_id=E.mod_id AND B.coh_id=E.coh_id AND B.pen_top=E.pen_top AND B.mod_id=K.mod_id AND B.sec_id=J.sec_id AND J.inf_id=I.inf_id AND I.nuc_id=H.nuc_id GROUP BY A.ci ORDER BY H.nuc_nom,I.inf_nom,K.mod_nom,C.esp_nom,D.reg_nom,G.coh_nom,MIN(E.asi_mod),A.ci";
	//esta consulta debe escoger el periodo academico para que funcione correctamente
  $estud_insc_pacade=mysql_query($sql,$this->conexion);
  return $estud_insc_pacade;
  }
 //******************************************************************
function matric_activas_posibles_pasantes($valor){
/*echo "<script>alert('$valor')</script>";*/
    $valor1=explode("*",$valor);//nuc_id*inf_id*pac_id*mod_id*reg_id*esp_id*coh_id
	if($valor1[1]!="todos")
	  $infrae="AND I.inf_id='$valor1[1]'";
	else
	  $infrae="";
	if($valor1[0]!="todos")
	  $nucleo="AND H.nuc_id='$valor1[0]'";
	else
	  $nucleo="";
	if($valor1[2]!="todos")
	  $periodo="AND B.pac_id='$valor1[2]'";
	else
	  $periodo="";
	if($valor1[3]!="todos")
	  $modalidad="AND B.mod_id='$valor1[3]'";
	else
	  $modalidad="";
	if($valor1[4]!="todos")
	  $regimen="AND B.reg_id='$valor1[4]'";
	else
	  $regimen="";
	if($valor1[5]!="todos")
	  $carrera="AND B.esp_id='$valor1[5]'";
	else
	  $carrera="";
	if($valor1[6]!="todos")
	  $pensum="AND B.coh_id='$valor1[6]'";
	else 
	  $pensum="";
    $sql="SELECT H.nuc_nom AS 'NUCLEO',I.inf_nom AS 'SEDE',K.mod_nom AS 'MODALIDAD',C.esp_nom AS 'ESPECIALIDAD',D.reg_nom AS 'REGIMEN',G.coh_nom AS 'PENSUM',MIN(E.asi_mod) AS 'ASI_MOD',A.ci AS 'CEDULA',UPPER(CONCAT(A.ap1,' ', A.ap2)) AS 'APELLIDOS',UPPER(CONCAT(A.no1,' ', A.no2)) AS 'NOMBRES',K.mod_id AS mod_id,C.esp_id AS esp_id,D.reg_id AS reg_id,G.coh_id AS coh_id,B.pen_top AS pen_top FROM persona A,detins B,especi C,regimen D,asigna E,matric F,cohort G,nucleo H,infrae I,seccio J,modali K WHERE A.ci=B.ci_est AND A.ci=F.ci AND G.coh_id=F.coh_id AND F.matr_sta='1' AND B.esp_id=F.esp_id AND B.reg_id=F.reg_id AND B.mod_id=F.mod_id AND B.coh_id=F.coh_id AND B.pen_top=F.pen_top ".$infrae." ".$nucleo." ".$modalidad." ".$regimen." ".$carrera." ".$pensum." AND B.det_sta='1' AND A.sta='1' AND B.esp_id=C.esp_id AND B.reg_id=D.reg_id AND B.asi_cod=E.asi_cod AND B.esp_id=E.esp_id AND B.reg_id=E.reg_id AND B.mod_id=E.mod_id AND B.coh_id=E.coh_id AND B.pen_top=E.pen_top AND B.mod_id=K.mod_id AND B.sec_id=J.sec_id AND J.inf_id=I.inf_id AND I.nuc_id=H.nuc_id AND A.ci NOT IN (SELECT DISTINCT(L.ci_est) FROM detins L, matric M WHERE (L.asi_cod like ('PSI%') OR L.asi_cod='IRA-30303' OR L.asi_cod='IRC-30303' OR L.asi_cod LIKE 'TGR%') AND L.det_con='1' AND L.ci_est=M.ci AND L.esp_id=M.esp_id AND L.reg_id=M.reg_id AND L.mod_id=M.mod_id AND L.coh_id=M.coh_id AND L.pen_top=M.pen_top AND M.matr_sta='1' AND L.det_sta='1') GROUP BY A.ci ORDER BY H.nuc_nom,I.inf_nom,K.mod_nom,C.esp_nom,D.reg_nom,G.coh_nom,MIN(E.asi_mod),A.ci";
	//esta consulta debe escoger el periodo academico para que funcione correctamente
  $estud_insc_pacade=mysql_query($sql,$this->conexion);
  return $estud_insc_pacade;
  }
//******************************************************************
  function fecha_pac_fin_ant($pac_id){
  $sql1="SELECT pac_fin FROM pacade WHERE DATEDIFF((SELECT pac_fin FROM pacade WHERE pac_id='$pac_id' AND pac_sta='1' ORDER BY pac_fin DESC),pac_fin)>0 AND pac_sta='1' ORDER BY pac_fin DESC"; 
  $pac_fin_ant=mysql_query($sql1,$this->conexion);
  $ext_pac_fin_ant=mysql_fetch_object($pac_fin_ant);
  return $ext_pac_fin_ant->pac_fin;
  }
//******************************************************************
  function Buscar_Dias(){  
    $sql="SELECT * FROM dias WHERE dia_sta='1' AND dia_id IN (SELECT dia_id FROM dia_blh WHERE dbh_sta='1' AND dbh_tip='0' GROUP BY dia_id) order by dia_id ASC"; 
    $res_dia=mysql_query($sql,$this->conexion);
	return $res_dia;
  }
//******************************************************************
  function Buscar_Horas(){
    $sql2="SELECT * FROM blo_hor WHERE blh_sta='1' AND blh_id IN (SELECT blh_id FROM dia_blh WHERE dbh_sta='1' AND dbh_tip='0' GROUP BY blh_id) order by blh_ini ASC"; 
    $res_hor=mysql_query($sql2,$this->conexion);
	return $res_hor;
  }
//******************************************************************
  function Buscar_horario($ase_id){
/*  echo "<script>alert('SELECT B.blh_id AS blh_id, B.dia_id AS dia_id, B.aul_id AS aul_id, C.aul_nom AS aul_nom FROM asigna_seccio A, horario B, aulas C WHERE A.pac_id=B.pac_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.asi_cod=B.asi_cod AND ase_sta=1 AND A.sec_id=B.sec_id AND A.pen_top=B.pen_top AND B.hor_sta=1 AND ase_id=$ase_id AND B.dbh_tip=0 AND C.aul_id=B.aul_id AND C.aul_sta=1 GROUP BY B.dia_id,B.blh_id,B.aul_id');</script>";*/
  $sql="SELECT B.blh_id AS 'blh_id', B.dia_id AS 'dia_id', B.aul_id AS 'aul_id', C.aul_nom AS 'aul_nom' FROM asigna_seccio A, horario B, aulas C WHERE A.pac_id=B.pac_id AND A.esp_id=B.esp_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.reg_id=B.reg_id AND A.asi_cod=B.asi_cod AND ase_sta='1' AND A.sec_id=B.sec_id AND A.pen_top=B.pen_top AND B.hor_sta='1' AND ase_id='$ase_id' AND B.dbh_tip='0' AND C.aul_id=B.aul_id AND C.aul_sta='1' GROUP BY B.dia_id,B.blh_id,B.aul_id";
	$resul=mysql_query($sql,$this->conexion);
    $fila=mysql_num_rows($resul);
	$horario="";
	while($ar_hor=mysql_fetch_object($resul)){
	  if($horario=="") $horario=$ar_hor->dia_id.":".$ar_hor->blh_id."!".$ar_hor->aul_nom;
	  else $horario=$horario."?".$ar_hor->dia_id.":".$ar_hor->blh_id."!".$ar_hor->aul_nom;
	}
/*  echo "<script>alert('$horario ¡ $fila');</script>";*/
	$horario=$horario."¡".$fila;
/*  echo "<script>alert('$horario');</script>";*/
	return $horario;
  }
//******************************************************************
  function Buscar_Taller_Proyecto_comunitario($ci,$mod_id,$reg_id,$esp_id,$coh_id,$pen_top){
/*  echo "<script>alert('SELECT asi_cod FROM detins A, matric B WHERE A.ci_est=B.ci AND A.ci_est=$ci AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.pen_top=B.pen_top AND A.det_sta=1 AND B.matr_sta=1 AND A.asi_cod IN (PRO-000001,TAL-000001) AND A.det_con=1');</script>";*/
  $sql="SELECT asi_cod FROM detins WHERE ci_est='$ci' AND esp_id='$esp_id' AND reg_id='$reg_id' AND coh_id='$coh_id' AND mod_id='$mod_id' AND pen_top='$pen_top' AND det_sta='1' AND asi_cod IN ('PRO-00001', 'TAL-00001') AND det_con='1'";
	$resul=mysql_query($sql,$this->conexion);
    $fila=mysql_num_rows($resul);
/*  echo "<script>alert('$fila');</script>";*/
	return $fila;
  }
//******************************************************************
  function Buscar_Graduandos_todos($gra_id,$nuc_id){
/*  echo "<script>alert('SELECT asi_cod FROM detins A, matric B WHERE A.ci_est=B.ci AND A.ci_est=$ci AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.coh_id=B.coh_id AND A.mod_id=B.mod_id AND A.pen_top=B.pen_top AND A.det_sta=1 AND B.matr_sta=1 AND A.asi_cod IN (PRO-000001,TAL-000001) AND A.det_con=1');</script>";*/
    $sql="SELECT A.ci_est FROM gradua AS A, reg_esp_mod_infrae B, infrae C, nucleo D WHERE A.gra_id='$gra_id' AND A.grad_sta='1' AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND B.inf_id=C.inf_id AND B.remi_sta='1' AND C.nuc_id=D.nuc_id AND C.inf_sta='1' AND D.nuc_id='$nuc_id' AND D.nuc_sta='1' GROUP BY A.ci_est";
	$resul=mysql_query($sql,$this->conexion);
	return $resul;
  }
//******************************************************************
  function Buscar_Graduandos_todos_java($gra_id,$nuc_id){
    $id="";
    $sql="SELECT A.ci_est AS 'ci_est' FROM gradua AS A, reg_esp_mod_infrae B, infrae C, nucleo D WHERE A.gra_id='$gra_id' AND A.grad_sta='1' AND A.esp_id=B.esp_id AND A.reg_id=B.reg_id AND A.mod_id=B.mod_id AND B.inf_id=C.inf_id AND B.remi_sta='1' AND C.nuc_id=D.nuc_id AND C.inf_sta='1' AND D.nuc_id='$nuc_id' AND D.nuc_sta='1' GROUP BY A.ci_est";
    $resul=mysql_query($sql,$this->conexion);
	
	
    while($array=mysql_fetch_object($resul)){
	  if($id==""){
	    $id=$array->ci_est;
	  }
	  else{
	    $id=$id."*".$array->ci_est;
	  }
	  $cuantos++;
	}	
	$this->res=$id."@".$id."@".$cuantos;
  }
//******************************************************************
  function busc_mod_est($cedu){
    $id="";
    $sql="SELECT A.mod_id AS mod_id, B.mod_nom As mod_nom FROM matric A, modali B WHERE A.ci='$cedu' AND A.mod_id=B.mod_id AND A.matr_tip='0' GROUP BY A.mod_id";
    $resul=mysql_query($sql,$this->conexion);
	return $resul;
  }
//******************************************************************  
  function Buscar_Estudiante_SIN_INS_SEM_ANT($cedu){	
	 $dias=time();
	$FECHA=date("Y-m-d H:i:s",$dias);
  $sql="SELECT A.pac_id AS 'pac_id', A.pac_nom AS 'pac_nom', A.pac_int AS 'pac_int', B.ins_nom AS 'ins_nom' FROM pacade A, inscri B WHERE B.ins_sta='1' AND TIMEDIFF('$FECHA',A.pac_fin)>=0 AND TIMEDIFF(A.pac_ffin,'$FECHA')>=0 AND TIMEDIFF('$FECHA',B.ins_fin)>=0 AND TIMEDIFF(B.ins_ffi,'$FECHA')>=0 AND A.pac_id=B.pac_id AND A.pac_sta='1' ORDER BY A.pac_fin ASC";
	$resul=mysql_query($sql,$this->conexion);
	$array=mysql_fetch_object($resul);
	$sql_sem_ant="SELECT * FROM pacade WHERE pac_id!='$array->pac_id' AND pac_int='0' AND TIMEDIFF('$FECHA',pac_ffin)>=0 ORDER BY pac_ffin DESC";
	$resul_sem_ant=mysql_query($sql_sem_ant,$this->conexion);
	$array_sem_ant=mysql_fetch_object($resul_sem_ant);
	$sql_ins_sem_ant="SELECT * FROM detins WHERE pac_id='$array_sem_ant->pac_id' AND ci_est='$cedu' AND det_sta='1'";
	$resul_ins_sem_ant=mysql_query($sql_ins_sem_ant,$this->conexion);
	$num_filas=mysql_num_rows($resul_ins_sem_ant);
    return $num_filas;
  }
//******************************************************************
function pacade_equivalencias($ci_est,$esp_id,$mod_id,$coh_id,$reg_id,$pen_top){
/*	echo "<script>alert('SELECT DISTINCT(A.pac_id) AS pac_id, B.pac_fin AS pac_fin FROM detins A, pacade B, matric C  WHERE A.pac_id=B.pac_id AND A.ci_est=$ci_est AND A.ci_est=C.ci AND A.esp_id=$esp_id AND A.mod_id=$mod_id AND A.reg_id=$reg_id AND A.coh_id=$coh_id AND A.pen_top=$pen_top AND A.esp_id=C.esp_id AND A.mod_id=C.mod_id AND A.reg_id=C.reg_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND C.matr_tip=0 AND B.pac_sta=1 AND A.det_sta=1 AND A.obs_id!=4 ORDER BY B.pac_fin');</script>";*/
	$sql="SELECT DISTINCT(A.pac_id) AS 'pac_id', B.pac_fin AS pac_fin FROM detins A, pacade B, matric C  WHERE A.pac_id=B.pac_id AND A.ci_est='$ci_est' AND A.ci_est=C.ci AND A.esp_id='$esp_id' AND A.mod_id='$mod_id' AND A.reg_id='$reg_id' AND A.coh_id='$coh_id' AND A.pen_top='$pen_top'AND A.esp_id=C.esp_id AND A.mod_id=C.mod_id AND A.reg_id=C.reg_id AND A.coh_id=C.coh_id AND A.pen_top=C.pen_top AND B.pac_sta='1' AND A.det_sta='1' AND C.matr_tip='0' AND A.obs_id!='4' ORDER BY B.pac_fin";
	$resul=mysql_query($sql,$this->conexion);
	$array=mysql_fetch_object($resul);
/*	echo "<script>alert('SELECT * FROM pacade WHERE pac_int=0 AND TIMEDIFF($array->pac_fin,pac_fin)>0 ORDER BY pac_ffin DESC');</script>";*/
	
	$sql_pac_ant="SELECT * FROM pacade WHERE pac_int='0' AND TIMEDIFF('$array->pac_fin',pac_fin)>=0 ORDER BY pac_ffin DESC";
	$resul_pac_ant=mysql_query($sql_pac_ant,$this->conexion);
	return $resul_pac_ant;
}
//******************************************************************
  function telefono($cedu){
    $sql="SELECT tmo FROM persona WHERE ci='$cedu'";
	$resul=mysql_query($sql,$this->conexion);
	$val_array=mysql_fetch_object($resul);
    return $val_array;
  }
//******************************************************************
  function email($cedu){
    $sql="SELECT usu_cor FROM usuari WHERE ci='$cedu'";
	$resul=mysql_query($sql,$this->conexion);
	$val_array=mysql_fetch_object($resul);
    return $val_array;
  }
//******************************************************************
  function direc_hab($cedu){
    $sql="SELECT hon_dir, hon_tha FROM dir_hon WHERE ci='$cedu' AND hon_sta='1' AND hon_tip='1'";
	$resul=mysql_query($sql,$this->conexion);
	$val_array=mysql_fetch_object($resul);
    return $val_array;
  }
//******************************************************************
  function direc_nac($cedu){
    $sql="SELECT hon_dir, hon_fna FROM dir_hon WHERE ci='$cedu' AND hon_sta='1' AND hon_tip='0'";
	$resul=mysql_query($sql,$this->conexion);
	$val_array=mysql_fetch_object($resul);
    return $val_array;
  }
//******************************************************************
}?>