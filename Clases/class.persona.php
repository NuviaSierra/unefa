<?php session_start();
class persona extends conec_BD
{
 var $ci='';
 var $com='';
 var $com_id='';
 var $oco='';
 var $etn='';
 var $etn_id='';
 var $oet='';
 var $idi='';
 var $idi_id='';
 var $oid='';
 var $dep='';
 var $dep_id='';
 var $ode='';
 var $inc='';
 var $inc_id='';
 var $oin='';
 var $bec='';
 var $bec_id='';
 var $obe='';
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
 var $fmi='';
 var $pmi='';
 var $nmi='';
 var $ran='';
 var $fot='';
 var $tmo='';
 var $nfa='';
 var $tfa='';
 var $sta='';
 var $tip='';
 var $did='';
 var $cre='';
 var $nac='';
 var $fbec='';
 var $mbec='';
 var $ibec='';
 var $ins_id=''; 
 var $niv='';
 var $ise_men='';
 var $faca='';
 var $prom=''; 
 var $ciun=''; 
 var $lugn=''; 
 var $fen=''; 
 var $ciuh=''; 
 var $direc=''; 
 var $tha='';
 var $correo='';
 var $inf_id='';
 var $mat='';
 var $tip_mat='';
 var $ruta_anex='';
//******************************************************************
  function persona($ci, $com, $com_id, $oco, $etn, $etn_id, $oet, $idi, $idi_id, $oid, $dep, $dep_id, $ode, $inc, $inc_id, $oin, $bec, $bec_id, $obe, $no1, $no2, $no3, $ap1, $ap2, $ap3, $sex, $ecv, $gsa, $frh, $fmi, $pmi, $nmi, $ran, $fot, $tmo, $nfa, $tfa, $sta, $tip,$did,$cre){
     $this->ci=$ci;
     $this->com=$com;
     $this->com_id=$com_id;
     $this->oco=$oco;
     $this->etn=$etn;
     $this->etn_id=$etn_id;
     $this->oet=$oet;
     $this->idi=$idi;
     $this->idi_id=$idi_id;
     $this->oid=$oid;
     $this->dep=$dep;
     $this->dep_id=$dep_id;
     $this->ode=ode;
     $this->inc=$inc;
     $this->inc_id=$inc_id;
     $this->oin=$oin;
     $this->bec=$bec;
     $this->bec_id=$bec_id;
     $this->obe=$obe;
     $this->no1=$no1;
     $this->no2=$no2;
     $this->no3=$no3;
     $this->ap1=$ap1;
     $this->ap2=$ap2;
     $this->ap3=$ap3;
     $this->sex=$sex;
     $this->ecv=$ecv;
     $this->gsa=$gsa;
     $this->frh=$frh;
     $this->fmi=$fmi;
     $this->pmi=$pmi;
     $this->nmi=$nmi;
     $this->ran=$ran;
     $this->fot=$fot;
     $this->tmo=$tmo;
     $this->nfa=$nfa;
     $this->tfa=$tfa;
     $this->sta=$sta;
     $this->tip=$tip;
     $this->did=$did;
     $this->cre=$cre;
     $this->ruta_anex="../Fotos/";
  }
//******************************************************************
  function Contar_Perso(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM persona WHERE sta='1'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_Perso($inicial,$cantidad,$tip){
   if($tip!=-1)
    $resultado=$this->Operacion("SELECT * FROM persona WHERE sta='1' AND tip='$tip' order by ap1, ap2, ap3, no1 LIMIT $cantidad OFFSET $inicial");
   else
     $resultado=$this->Operacion("SELECT * FROM persona WHERE sta='1' order by ap1, ap2, ap3, no1 LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Nacionalidad(){
    $resultado=$this->Operacion("SELECT * FROM pais WHERE pai_sta='1' AND pai_id!='302' order by pai_nac");
    return $resultado;
  }
 //******************************************************************
  function Listado_Componente(){
    $resultado=$this->Operacion("SELECT * FROM comil WHERE com_sta='1' order by com_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Incapacidad(){
    $resultado=$this->Operacion("SELECT * FROM incapa WHERE inc_sta='1' AND inc_id!='0' AND inc_id!='11' order by inc_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Etnia(){
    $resultado=$this->Operacion("SELECT * FROM etnia WHERE etn_sta='1' AND etn_id!='0' AND etn_id!='30' AND etn_id!='99' order by etn_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Pais(){
    $resultado=$this->Operacion("SELECT * FROM pais WHERE pai_sta='1' AND pai_id!='302' order by pai_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Estado($pai){
    $resultado=$this->Operacion("SELECT * FROM estado WHERE esta_sta='1' AND pai_id='$pai' order by esta_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Municipio($esta){
    $resultado=$this->Operacion("SELECT * FROM munici WHERE mun_sta='1' AND esta_id='$esta' order by mun_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Ciudad($muni){
    $resultado=$this->Operacion("SELECT * FROM ciudad WHERE ciu_sta='1' AND mun_id='$muni' order by ciu_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Niv(){
    $resultado=$this->Operacion("SELECT * FROM nivela WHERE niv_sta='1' order by niv_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Mod(){
    $resultado=$this->Operacion("SELECT * FROM modali_ing WHERE min_sta='1' order by min_des");
    return $resultado;
  }

//******************************************************************
  function Listado_Ins(){
    $resultado=$this->Operacion("SELECT * FROM instit WHERE ins_sta='1' order by ins_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Idioma(){
    $resultado=$this->Operacion("SELECT * FROM idioma WHERE idi_sta='1' order by idi_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Deporte(){
    $resultado=$this->Operacion("SELECT * FROM deport WHERE dep_sta='1' order by dep_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Beca(){
    $resultado=$this->Operacion("SELECT * FROM beca WHERE bec_sta='1' AND bec_id!='-1' order by bec_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_nucleo(){
    $resultado=$this->Operacion("SELECT * FROM nucleo WHERE nuc_sta='1' order by nuc_nom");
    return $resultado;
  }
//******************************************************************
  function Listado_Pensum(){
    $resultado=$this->Operacion("SELECT B.mod_nom AS 'modalidad', C.esp_nom AS 'especialidad', D.reg_nom AS 'regimen', E.coh_nom AS 'cohorte', B.mod_id AS 'mod_id', C.esp_id AS 'esp_id', D.reg_id AS 'reg_id', E.coh_id AS 'coh_id' FROM pensum A, modali B, especi C, regimen D, cohort E WHERE pen_sta='1' AND A.mod_id=B.mod_id AND A.esp_id=C.esp_id AND A.reg_id=D.reg_id AND A.coh_id=E.coh_id order by B.mod_nom, C.esp_nom, D.reg_nom, E.coh_nom");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($valor){
	$val=explode(",",$valor);
	$this->ci=$val[0];
    $this->com=$val[1];
    $this->com_id=$val[2];
    $this->oco=$this->ConvertirMayuscula($val[3]);
    $this->etn=$val[4];
    $this->etn_id=$val[5];
    $this->oet=$this->ConvertirMayuscula($val[6]);
    $this->idi=$val[7];
    $this->idi_id=$val[8];
    $this->oid=$this->ConvertirMayuscula($val[9]);
    $this->dep=$val[10];
    $this->dep_id=$val[11];
    $this->ode=$this->ConvertirMayuscula($val[12]);
    $this->inc=$val[13];
    $this->inc_id=$val[14];
    $this->oin=$this->ConvertirMayuscula($val[15]);
    $this->bec=$val[16];
    $this->bec_id=$val[17];
    $this->obe=$this->ConvertirMayuscula($val[18]);
    $this->no1=$this->ConvertirMayuscula($val[19]);
    $this->no2=$this->ConvertirMayuscula($val[20]);
    $this->no3=$this->ConvertirMayuscula($val[21]);
    $this->ap1=$this->ConvertirMayuscula($val[22]);
    $this->ap2=$this->ConvertirMayuscula($val[23]);
    $this->ap3=$this->ConvertirMayuscula($val[24]);
    $this->sex=$val[25];
    $this->ecv=$val[26];
    $this->gsa=$val[27];
    $this->frh=$val[28];
    $this->fmi=$val[29];
    $this->pmi=$this->ConvertirMayuscula($val[30]);
    $this->nmi=$this->ConvertirMayuscula($val[31]);
    $this->ran=$this->ConvertirMayuscula($val[32]);
    $this->fot=$val[33];
    $this->tmo=$val[34];
    $this->nfa=$this->ConvertirMayuscula($val[35]);
    $this->tfa=$val[36];
    $this->sta=$val[37];
    $this->tip=$val[38];
    $this->did=$val[39];
    $this->cre=$val[40];
    $this->nac=$val[41];
    $this->fbec=$val[42];
    $this->mbec=$val[43];
    $this->ibec=$this->ConvertirMayuscula($val[44]);
    $this->ins_id=$val[45]; 
    $this->niv=$val[46];
    $this->ise_men=$this->ConvertirMayuscula($val[47]);
    $this->faca=$val[48];
    $this->prom=$val[49]; 
    $this->ciun=$val[50]; 
    $this->lugn=$this->ConvertirMayuscula($val[51]); 
    $this->fen=$val[52]; 
    $this->ciuh=$val[53]; 
    $this->direc=$this->ConvertirMayuscula($val[54]); 
    $this->tha=$val[55];
    $this->correo=$this->ConvertirMayuscula($val[56]);
	$this->inf_id=$val[57];
	$this->mat=$val[58];
	$this->tip_mat=$val[59];
	$this->res=1;
  }
  function Comprobar_Null($comp){
    if($comp=="")
	  $comp=NULL;
	else
	  $comp="'".$comp."'";
	return $comp;
  }
  function crear_sentencia($val,$nom){
/*  echo "<script>alert('crear_sentencia: $val ');</script>";*/
    if($val=="" || $val=="OTRO")
	  $sentencia="";
	else
	  $sentencia="".$nom.", ";
/*  echo "<script>alert('crear_sentencia: $sentencia ');</script>";*/
	return $sentencia;
  }
  function crear_valor($val){
    $sentencia="";
/*  echo "<script>alert('crear_valor: $val ');</script>";*/
    if($val!="" && $val!="OTRO")
	  $sentencia="'".$val."', ";
	return $sentencia;
  }
  function crear_valor_p($val){
    $sentencia="";
    if($val!="" && $val!="OTRO")
	  $sentencia=$val.", ";
/*  echo "<script>alert('$sentencia');</script>";*/
	return $sentencia;
  }
//****************************************************************************************************
  function Agregar_Perso(){
    $band=0;
	$num_filas=0;
	$select="INSERT INTO persona (ci, com, ".$this->crear_sentencia($this->com_id,'com_id')."".$this->crear_sentencia($this->oco,'oco')."etn, ".$this->crear_sentencia($this->etn_id,'etn_id')."".$this->crear_sentencia($this->oet,'oet')."idi, ".$this->crear_sentencia($this->oid,'oid')."dep, ".$this->crear_sentencia($this->ode,'ode')."inc, ".$this->crear_sentencia($this->oin,'oin')."bec, no1, ".$this->crear_sentencia($this->no2,'no2')."".$this->crear_sentencia($this->no3,'no3')."ap1, ".$this->crear_sentencia($this->ap2,'ap2')."".$this->crear_sentencia($this->ap3,'ap3')."sex, ".$this->crear_sentencia($this->ecv,'ecv')."gsa, frh, fmi, ".$this->crear_sentencia($this->pmi,'pmi')."".$this->crear_sentencia($this->nmi,'nmi')."".$this->crear_sentencia($this->ran,'ran')."fot, tmo, nfa, tfa, sta, ".$this->crear_sentencia($this->tip,'tip')."did, cre) ";
/*	echo "<script>alert('$select');</script>";*/
	$select="".$select."VALUES ('$this->ci', '$this->com', ".$this->crear_valor($this->com_id)."".$this->crear_valor($this->oco)."'$this->etn', ".$this->crear_valor($this->etn_id)."".$this->crear_valor($this->oet)."'$this->idi', ".$this->crear_valor($this->oid)."'$this->dep', ".$this->crear_valor($this->ode)."'$this->inc', ".$this->crear_valor($this->oin)."'$this->bec', '$this->no1', ".$this->crear_valor($this->no2)."".$this->crear_valor($this->no3)."'$this->ap1', ".$this->crear_valor($this->ap2)."".$this->crear_valor($this->ap3)."'$this->sex', ".$this->crear_valor($this->ecv)."'$this->gsa', '$this->frh', '$this->fmi', ".$this->crear_valor($this->pmi)."".$this->crear_valor($this->nmi)."".$this->crear_valor($this->ran)."'$this->fot', '$this->tmo', '$this->nfa', '$this->tfa', '$this->sta', ".$this->crear_valor($this->tip)."'$this->did', '$this->cre')";
/*	$probando="".$select."VALUES ($this->ci, $this->com, ".$this->crear_valor_p($this->com_id)."".$this->crear_valor_p($this->oco)."$this->etn, ".$this->crear_valor_p($this->etn_id)."".$this->crear_valor_p($this->oet)."$this->idi, ".$this->crear_valor_p($this->oid)."$this->dep, ".$this->crear_valor_p($this->ode)."$this->inc, ".$this->crear_valor($this->oin)."$this->bec, ".$this->crear_valor_p($this->obe)."$this->no1, ".$this->crear_valor_p($this->no2)."".$this->crear_valor_p($this->no3)."$this->ap1, ".$this->crear_valor_p($this->ap2)."".$this->crear_valor_p($this->ap3)."$this->sex, ".$this->crear_valor_p($this->ecv)."$this->gsa, $this->frh, $this->fmi, ".$this->crear_valor_p($this->pmi)."".$this->crear_valor_p($this->nmi)."".$this->crear_valor_p($this->ran)."$this->fot, $this->tmo, $this->nfa, $this->tfa, $this->sta, ".$this->crear_valor_p($this->tip)."$this->did, $this->cre)";
	echo "<script>alert('$probando');</script>";	*/
//																																																															*			*										 *										 *						   *			  			   *					  *						   *								   *								   *			  			   *			*			  *													 *			 *			   *			*			   *			 			  *				 * 
//                                                                                                                                                                                                                                                    	    ci,        com,         com_id,         oco,         etn,         etn_id,        oet,        idi,          oid,       dep,         ode,          inc,         oin,       bec,        obe,          no1,       no2,        no3,        ap1,         ap2,        ap3,       sex,          ecv,          gsa,         frh,          fmi,          pmi,        nmi,        ran,         fot,        tmo,          nfa,         tfa,           sta,          tip,         did,           cre
    $res=$this->Operacion($select);
    $num_filas=$this->filas_afectadas($res);
	/*echo "<script>alert('Num_fila: $num_filas');</script>";*/
	if($num_filas>0){
	  $deporte=explode("-",$this->dep_id);
	  $i=0;
	  if($deporte[$i]=="")
	    $N_Dep=1;
	  while($deporte[$i]!=""){
	    $N_Dep=$this->Agregar_Perso_Deport($deporte[$i]);
		$i++;
	  }
	  $idioma=explode("-",$this->idi_id);
	  $i=0;
	  if($idioma[$i]=="")
	    $N_Idi=1;
	  while($idioma[$i]!=""){
	    $N_Idi=$this->Agregar_Perso_Idioma($idioma[$i]);
		$i++;
	  }
	  $incapa=explode("-",$this->inc_id);
	  $i=0;
	  if($incapa[$i]=="")
	    $N_Inc=1;
	  while($incapa[$i]!=""){
	    $N_Inc=$this->Agregar_Perso_Incapa($incapa[$i]);
		$i++;
	  }
	  $nacion=explode("-",$this->nac);
	  $i=0;
	  while($nacion[$i]!=""){
	    $N_Nac=$this->Agregar_Nacion($nacion[$i]);
		$i++;
	  }
	  $mat=explode("-",$this->mat);
	  $tip_mat=explode("-",$this->tip_mat);
	  $i=0;
	  while($mat[$i]!=""){
	    $N_Mat=$this->Agregar_Matricula($mat[$i],$tip_mat[$i]);
		$i++;
	  }
	  $N_Ins=$this->Agregar_Ins_Perso($this->ins_id, $this->niv, $this->ise_men, $this->faca, $this->prom);
	  $beca=explode("-",$this->bec_id);
	  $fbeca=explode("/",$this->fbec);
	  $mbeca=explode("-",$this->mbec);
	  $ibeca=explode("-",$this->ibec);
	  $nbeca=explode("-",$this->obe);
	  $i=0;
	  if($beca[$i]=="")
	    $N_Bec=1;
	  while($beca[$i]!=""){
	    $N_Bec=$this->Agregar_Perso_Bec($beca[$i], $fbeca[$i], $mbeca[$i], $ibeca[$i], $nbeca[$i]);
		$i++;
	  }
	  $N_DHN=$this->Agregar_Dir_Hon_Nac($this->ciun, $this->lugn, $this->fen);
	  $N_DHH=$this->Agregar_Dir_Hon_Hab($this->ciuh, $this->direc, $this->tha);
	  $Ninf=$this->Agregar_Estudi_Infrae();
	  $N_USU=$this->Agregar_Usuario();
/*	  echo "<script>alert('$N_Dep!=0 && $N_Idi!=0 && $N_Inc!=0 && $N_Nac!=0 && $N_Ins!=0 && $N_Bec!=0 && $N_DHN!=0 && $N_DHH!=0 && $Ninf!=0 && $N_USU!=0');</script>";*/
	  if($N_Dep!=0 && $N_Idi!=0 && $N_Inc!=0 && $N_Nac!=0 && $N_Ins!=0 && $N_Bec!=0 && $N_DHN!=0 && $N_DHH!=0 && $Ninf!=0 && $N_USU!=0)
	    $band=1;
	  else{
	    $this->sta=0;
	    $this->Eliminar_Persona();
	  }	    
	}
    return $band;
  }  
  function Agregar_Estudi_Infrae(){
/*  echo "<script>alert('INSERT INTO estudi_infrae (ci, inf_id, est_inf_sta) VALUES ($this->ci, $this->inf_id, 1)');</script>";*/
    $res=$this->OperacionCualquiera("INSERT INTO estudi_infrae (ci, inf_id, est_inf_sta) VALUES ('$this->ci', '$this->inf_id', '1')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Agregar_Usuario(){
    $passwo=md5($this->ci);  
/*    echo "<script>alert('INSERT INTO usuari (ci, usu_cor, usu_pas, usu_sta) VALUES ($this->ci, $this->correo, $passwo, 1)');</script>";*/
    $res=$this->OperacionCualquiera("INSERT INTO usuari (ci, usu_cor, usu_pas, usu_sta) VALUES ('$this->ci', '$this->correo', '$passwo','1')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Agregar_Perso_Deport($dep_id){
/*    echo "<script>alert('INSERT INTO estudi_deport (ci, dep_id, esd_sta) VALUES ($this->ci, $dep_id, 1)');</script>";*/
	$res=$this->OperacionCualquiera("INSERT INTO estudi_deport (ci, dep_id, esd_sta) VALUES ('$this->ci', '$dep_id', '1')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Agregar_Perso_Idioma($idi_id){
/*     echo "<script>alert('INSERT INTO perso_idioma (ci, idi_id, esi_sta) VALUES ($this->ci, $idi_id, 1)');</script>";*/
	$res=$this->OperacionCualquiera("INSERT INTO perso_idioma (ci, idi_id, esi_sta) VALUES ('$this->ci', '$idi_id', '1')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Agregar_Perso_Incapa($inc_id){
/*       echo "<script>alert('INSERT INTO perso_incapa (ci, inc_id, ein_sta) VALUES ($this->ci, $inc_id, 1)');</script>";*/
    $res=$this->OperacionCualquiera("INSERT INTO perso_incapa (ci, inc_id, ein_sta) VALUES ('$this->ci', '$inc_id', '1')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Agregar_Nacion($pai_id){
   if($pai_id!="OTRO"){
/*       echo "<script>alert('INSERT INTO nacionali (ci, pai_id, nac_est) VALUES ($this->ci, $pai_id, 1)');</script>";*/
    $res=$this->OperacionCualquiera("INSERT INTO nacionali (ci, pai_id, nac_est) VALUES ('$this->ci', '$pai_id', '1')");
    $num_filas=$this->filas_afectadas($res);
   }
   else
    $num_filas=1;
    return $num_filas;
  }
  function Agregar_Matricula($mat_id,$tip_mat){
    $mat=explode("*",$mat_id);
/*       echo "<script>alert('INSERT INTO matric (ci, pai_id, nac_est) VALUES ($this->ci, $pai_id, 1)');</script>";*/
    $res=$this->OperacionCualquiera("INSERT INTO matric (ci, mod_id, esp_id, reg_id, coh_id, pen_top, matr_tip, matr_sta) VALUES ('$this->ci', '$mat[0]', '$mat[1]', '$mat[2]', '$mat[3]', '0', '$tip_mat', '1')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Agregar_Ins_Perso($ins_id, $niv_id, $ise_men, $ise_fgr, $ise_pno){
   if($ins_id!="OTRO"){
/*       echo "<script>alert('INSERT INTO perso_ins (ci, ins_id, niv_id, ise_men, ise_fgr, ise_pno, ise_sta) VALUES ($this->ci, $ins_id, $niv_id, $ise_men, $ise_fgr, $ise_pno, 1)');</script>";*/
    $res=$this->OperacionCualquiera("INSERT INTO perso_ins (ci, ins_id, niv_id, ise_men, ise_fgr, ise_pno, ise_sta) VALUES ('$this->ci', '$ins_id', '$niv_id', '$ise_men', '$ise_fgr', '$ise_pno', '1')");
    $num_filas=$this->filas_afectadas($res);
   }
   else
    $num_filas=1;
    return $num_filas;
  }
  function Agregar_Perso_Bec($bec_id, $esb_fec, $esb_mon, $esb_ins, $esb_nom){
/*       echo "<script>alert('INSERT INTO perso_bec (ci, bec_id, esb_fec, esb_mon, esb_ins, esb_nom, esb_sta) VALUES ($this->ci, $bec_id, $esb_fec, $esb_mon, $esb_ins, $esb_nom, 1)');</script>";*/
	$res=$this->OperacionCualquiera("INSERT INTO perso_bec (ci, bec_id, esb_fec, esb_mon, esb_ins, esb_nom, esb_sta) VALUES ('$this->ci', '$bec_id', '$esb_fec', '$esb_mon', '$esb_ins', '$esb_nom', '1')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Agregar_Dir_Hon_Nac($ciu_id_nacimiento, $hon_dir_nac, $hon_fna){
/*       echo "<script>alert('INSERT INTO dir_hon (ci, ciu_id, hon_tip, hon_dir, hon_fna, hon_sta) VALUES ($this->ci, $ciu_id_nacimiento, 0, $hon_dir_nac, $hon_fna, 1)');</script>";*/
	$res=$this->OperacionCualquiera("INSERT INTO dir_hon (ci, ciu_id, hon_tip, hon_dir, hon_fna, hon_sta) VALUES ('$this->ci', '$ciu_id_nacimiento', '0', '$hon_dir_nac', '$hon_fna', '1')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Agregar_Dir_Hon_Hab($ciu_id_hab, $hon_dir_hab, $hon_tha){
/*       echo "<script>alert('INSERT INTO dir_hon (ci, ciu_id, hon_tip, hon_dir, hon_tha, hon_sta) VALUES ($this->ci, $ciu_id_hab, 1, $hon_dir_hab, $hon_tha, 1)');</script>";*/
	$res=$this->OperacionCualquiera("INSERT INTO dir_hon (ci, ciu_id, hon_tip, hon_dir, hon_tha, hon_sta) VALUES ('$this->ci', '$ciu_id_hab', '1', '$hon_dir_hab', '$hon_tha', '1')");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Buscar_Cedula(){
    /*echo "<script>alert('CI: $this->ci');</script>";*/
    $row=0;
    $this->Operacion("SELECT * FROM persona WHERE ci='$this->ci' AND sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
	/*echo "<script>alert('Filas: $num_filas, row: $row');</script>";*/
    return $row;
  }
//******************************************************************
  function Buscar_Perso($id){
    $this->Operacion("SELECT * FROM persona WHERE ci='$id'");
  }
  function Buscar_Componente($id){
    $this->Operacion("SELECT * FROM persona WHERE ci='$id'");
  }
  function Buscar_Inf(){
	$res=$this->OperacionCualquiera("SELECT * FROM infrae WHERE inf_id='$this->inf_id'");
    $array=$this->ConsultarCualquiera($res);
    return $array->inf_nom;
  }
  function Buscar_Nuc(){
	$res=$this->OperacionCualquiera("SELECT * FROM infrae WHERE inf_id='$this->inf_id'");
    $array=$this->ConsultarCualquiera($res);
	$resultado=$this->OperacionCualquiera("SELECT * FROM nucleo WHERE nuc_id='$array->nuc_id'");
    $array2=$this->ConsultarCualquiera($res);
    return $array2->nuc_nom;
  }  
  function Buscar_Nucleo($ci,$nuc){
	$res=$this->Operacion("SELECT A.ci AS 'ci', A.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', B.nuc_id AS 'nuc_id', C.nuc_nom AS 'nuc_nom' FROM estudi_infrae A, infrae B, nucleo C WHERE A.ci='$ci' AND A.est_inf_ffi='' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND C.nuc_id='$nuc'");
	$num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }  
  function Buscar_Infraestructura($ci){
	$res=$this->Operacion("SELECT A.ci, A.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom' FROM estudi_infrae A, infrae B WHERE A.ci='$ci' AND A.est_inf_ffi='' AND A.inf_id=B.inf_id");
  }
  function Buscar_Estudi_Deport($dep_id){
	$res=$this->Operacion("SELECT * FROM estudi_deport WHERE ci='$this->ci' AND dep_id='$dep_id' AND esd='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Buscar_Estudi_Idioma($idi_id){
	$res=$this->Operacion("SELECT * FROM perso_idioma WHERE ci='$this->ci' AND idi_id='$idi_id' AND esi_sta='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Buscar_Estudi_Incapa($inc_id){
    $res=$this->Operacion("SELECT * FROM perso_incapa WHERE ci='$this->ci' AND inc_id='$inc_id' AND ein_sta='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Buscar_Nacion($pai_id){
    $res=$this->Operacion("SELECT * FROM nacionali WHERE ci='$this->ci' AND pai_id='$pai_id' AND nac_est='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Buscar_Ins_Est($ins_id, $niv_id){
    $res=$this->Operacion("SELECT A.ise_fgr AS 'ise_fgr', A.niv_id AS 'niv_id', B.niv_nom AS 'niv_nom', A.ise_pno AS 'ise_pno', A.ins_id AS 'ins_id', C.ins_nom AS 'ins_nom' FROM perso_ins A, nivela B, instit C WHERE A.ci='$this->ci' AND ins_id='$ins_id' AND niv_id='$niv_id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Buscar_Inst($ci){
    $res=$this->Operacion("SELECT MAX(A.ise_fgr) AS 'ise_fgr', A.ise_men AS 'ise_men', A.niv_id AS 'niv_id', B.niv_nom AS 'niv_nom', A.ise_pno AS 'ise_pno', A.ins_id AS 'ins_id', C.ins_nom AS 'ins_nom' FROM perso_ins A, nivela B, instit C WHERE A.ci='$ci' AND A.ins_id=C.ins_id AND A.niv_id=B.niv_id GROUP BY A.ise_fgr, A.niv_id, A.ins_id");
  }
  function Buscar_Est_Bec($bec_id){
	$res=$this->Operacion("SELECT * FROM perso_bec WHERE ci='$this->ci' AND bec_id='$bec_id' AND esb_sta='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Buscar_Dir_Hon_Nac($ciu_id_nacimiento, $sta){
  	$res=$this->Operacion("SELECT * FROM dir_hon WHERE ci='$this->ci' AND ciu_id='$ciu_id_nacimiento' AND hon_tip='0'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Buscar_Dir_Nac($ci){
  	$res=$this->Operacion("SELECT A.hon_fna AS 'hon_fna', A.hon_dir AS 'hon_dir', A.ciu_id AS 'ciu_id', B.ciu_nom AS 'ciu_nom', B.mun_id AS 'mun_id', C.mun_nom AS 'mun_nom', C.esta_id AS 'esta_id', D.esta_nom AS 'esta_nom', D.pai_id AS 'pai_id', E.pai_nom AS 'pai_nom' FROM dir_hon A, ciudad B, munici C, estado D, pais E WHERE A.ci='$ci' AND A.hon_tip='0' AND A.hon_sta='1' AND A.ciu_id=B.ciu_id AND B.mun_id=C.mun_id AND C.esta_id=D.esta_id AND D.pai_id=E.pai_id");
  }
  function Buscar_Dir_Hab($ci){
  	$res=$this->Operacion("SELECT A.hon_tha AS 'hon_tha', A.hon_dir AS 'hon_dir', A.ciu_id AS 'ciu_id', B.ciu_nom AS 'ciu_nom', B.mun_id AS 'mun_id', C.mun_nom AS 'mun_nom', C.esta_id AS 'esta_id', D.esta_nom AS 'esta_nom', D.pai_id AS 'pai_id', E.pai_nom AS 'pai_nom' FROM dir_hon A, ciudad B, munici C, estado D, pais E WHERE A.ci='$ci' AND A.hon_tip='1' AND A.hon_sta='1' AND A.ciu_id=B.ciu_id AND B.mun_id=C.mun_id AND C.esta_id=D.esta_id AND D.pai_id=E.pai_id");
  }
  function Buscar_Usuario($ci){
  	$res=$this->Operacion("SELECT * FROM usuari WHERE ci='$ci'");
  }
  function Buscar_Dir_Hon_Hab($ciu_id_hab, $sta){
	$res=$this->Operacion("SELECT * FROM dir_hon WHERE ci='$this->ci' AND ciu_id='$ciu_id_hab' AND hon_tip='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Buscar_Estudi_Infrae($inf_id,$sta){
    $res=$this->Operacion("SELECT * FORM estudi_infrae WHERE ci='$this->ci' AND inf_id='$inf_id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_Persona(){
    $band=0;
	//$NUSU=$N_Dep=$N_Idi=
    $res=$this->Operacion("UPDATE persona set com='$this->com', com_id='$this->com_id', oco='$this->oco', etn='$this->etn', etn_id='$this->etn_id', oet='$this->oet', idi='$this->idi', oid='$this->oid', dep='$this->dep', ode='$this->ode', inc='$this->inc', oin='$this->oin', bec='$this->bec', obe='$this->obe', no1='$this->no1', no2='$this->no2', no3='$this->no3', ap1='$this->ap1', ap2='$this->ap2', ap3='$this->ap3', sex='$this->sex', ecv='$this->ecv', gsa='$this->gsa', frh='$this->frh', fmi='$this->fmi', pmi='$this->pmi', nmi='$this->nmi', ran='$this->ran', fot='$this->fot', tmo='$this->tmo', nfa='$this->nfa', tfa='$this->tfa', sta='$this->sta', tip='$this->tip', did='$this->did', cre='$this->cre'  WHERE ci='$this->ci'");
    $num_filas=$this->filas_afectadas($res);
	if($num_filas>0){
	  $deporte=explode("-",$this->dep_id);
	  $i=0;
	  $res=$this->OperacionCualquiera("SELECT * FROM estudi_deport WHERE ci='$this->ci' AND esd_sta='1'");
	  while($array=$this->ConsultarCualquiera($res)){
	    $this->Eliminar_Perso_Deport($array->dep_id,0);
	  }
	  while($deporte[$i]!=""){
	    $res=$this->OperacionCualquiera("SELECT * FROM estudi_deport WHERE ci='$this->ci' AND dep_id='$deporte[$i]'");
		$num_filas=$this->NumFilasCualquiera($res);
	    if($num_filas>0){
		  $N_Dep=$this->Modificar_Perso_Deport($deporte[$i],1);
	    }
		else
	      $N_Dep=$this->Agregar_Perso_Deport($deporte[$i]);
		$i++;
	  }
	  $idioma=explode("-",$this->idi_id);
	  $i=0;
	  $res=$this->OperacionCualquiera("SELECT * FROM perso_idioma WHERE ci='$this->ci' AND esi_sta='1'");
	  while($array=$this->ConsultarCualquiera($res)){
	    $this->Eliminar_Perso_Idioma($array->idi_id,0);
	  }
	  while($idioma[$i]!=""){
	    $res=$this->OperacionCualquiera("SELECT * FROM perso_idioma WHERE ci='$this->ci' AND idi_id='$idioma[$i]'");
		$num_filas=$this->NumFilasCualquiera($res);
	    if($num_filas>0){
		  $N_Idi=$this->Modificar_Perso_Idioma($idioma[$i],1);
	    }
		else
	      $N_Idi=$this->Agregar_Perso_Idioma($idioma[$i]);
		$i++;
	  }
	  $incapa=explode("-",$this->inc_id);
	  $i=0;
	  $res=$this->OperacionCualquiera("SELECT * FROM perso_incapa WHERE ci='$this->ci' AND ein_sta='1'");
	  while($array=$this->ConsultarCualquiera($res)){
	    $this->Eliminar_Perso_Incapa($array->inc_id,0);
	  }
	  while($incapa[$i]!=""){
	    $res=$this->OperacionCualquiera("SELECT * FROM perso_incapa WHERE ci='$this->ci' AND inc_id='$incapa[$i]'");
		$num_filas=$this->NumFilasCualquiera($res);
	    if($num_filas>0){
		  $N_Inc=$this->Modificar_Perso_Incapa($incapa[$i],1);
	    }
		else
	      $N_Inc=$this->Agregar_Perso_Incapa($incapa[$i]);
		$i++;
	  }
	  $nacion=explode("-",$this->nac);
	  $i=0;
	  $res=$this->OperacionCualquiera("SELECT * FROM nacinali WHERE ci='$this->ci' AND nac_sta='1'");
	  while($array=$this->ConsultarCualquiera($res)){
	    $this->Eliminar_Nacion($array->pai_id,0);
	  }
	  while($nacion[$i]!=""){
	    $res=$this->OperacionCualquiera("SELECT * FROM nacinali WHERE ci='$this->ci' AND pai_id='$nacion[$i]'");
		$num_filas=$this->NumFilasCualquiera($res);
	    if($num_filas>0){
		  $N_Nac=$this->Modificar_Nacion($nacion[$i],1);
	    }
		else
		  $N_Nac=$this->Agregar_Nacion($nacion[$i]);
		$i++;
	  }
	  $res=$this->OperacionCualquiera("SELECT * FROM perso_ins WHERE ci='$this->ci' AND ins_id='$this->ins_id' AND niv='$this->niv' AND ise_fgr='$this->faca'");
	  $num_filas=$this->NumFilasCualquiera($res);
	  if($num_filas>0)
	    $N_Ins=$this->Modificar_Ins_Perso($this->ins_id, $this->niv, $this->ise_men, $this->faca, $this->prom, '1');
	  else{
	    $N_Ins=$this->Eliminar_Ins_Perso(0);
	    $N_Ins=$this->Agregar_Ins_Perso($this->ins_id, $this->niv, $this->ise_men, $this->faca, $this->prom);
	  }
	  $beca=explode("-",$this->bec_id);
	  $fbeca=explode("-",$this->fbec);
	  $mbeca=explode("-",$this->mbec);
	  $i=0;
	  $res=$this->OperacionCualquiera("SELECT * FROM perso_bec WHERE ci='$this->ci' AND esb_sta='1'");
	  while($array=$this->ConsultarCualquiera($res)){
	    $this->Eliminar_Perso_Incapa($array->bec_id,0);
	  }
	  while($beca[$i]!=""){
	    $res=$this->OperacionCualquiera("SELECT * FROM perso_bec WHERE ci='$this->ci' AND bec_id='$beca[$i]'");
		$num_filas=$this->NumFilasCualquiera($res);
	    if($num_filas>0){
		  $N_Bec=$this->Modificar_Perso_Bec($beca[$i], $fbeca[$i], $mbeca[$i],1);
	    }
		else
	      $N_Bec=$this->Agregar_Perso_Bec($beca[$i], $fbeca[$i], $mbeca[$i]);
		$i++;
	  }
	  $res=$this->OperacionCualquiera("SELECT * FROM dir_hon WHERE ci='$this->ci' AND hon_tip='0' AND ciu_id='$this->ciun'");
	  $num_filas=$this->NumFilasCualquiera($res);
	  if($num_filas>0)
	    $N_DHN=$this->Modificar_Dir_Hon_Nac($this->ciun, $this->lugn, $this->fen);
	  else{
	    $N_DHN=$this->Eliminar_Dir_Hon_Nac(0);
	    $N_DHN=$this->Agregar_Dir_Hon_Nac($this->ciun, $this->lugn, $this->fen);
	  }	  
	  $res=$this->OperacionCualquiera("SELECT * FROM dir_hon WHERE ci='$this->ci' AND hon_tip='1' AND ciu_id='$this->ciuh'");
	  $num_filas=$this->NumFilasCualquiera($res);
	  if($num_filas>0)
	    $N_DHH=$this->Modificar_Dir_Hon_Hab($this->ciuh, $this->lugn, $this->fen);
	  else{
	    $N_DHH=$this->Eliminar_Dir_Hon_Hab(0);
	    $N_DHH=$this->Agregar_Dir_Hon_Hab($this->ciuh, $this->direc, $this->tha);
	  }	  
	  $res=$this->OperacionCualquiera("SELECT * FROM estudi_infrae WHERE ci='$this->ci' AND est_inf_ffi='' AND inf_id='$this->inf_id'");
	  $num_filas=$this->NumFilasCualquiera($res);
	  if($num_filas<=0){
	    $Ninf=$this->Eliminar_Estudi_Infrae(0);
	    $Ninf=$this->Agregar_Estudi_Infrae();
	  }
	  else
	    $Ninf=1;
	  $res=$this->OperacionCualquiera("SELECT * FROM usuari WHERE ci='$this->ci' AND usu_cor='$this->correo'");
	  $num_filas=$this->NumFilasCualquiera($res);
	  if($num_filas<=0){
	    $res=$this->OperacionCualquiera("SELECT * FROM usuari WHERE ci='$this->ci'");
	    $num_filas=$this->NumFilasCualquiera($res);
		if(num_filas>0)
	      $NUSU=$this->Modificar_Uuario();
		else
	      $NUSU=$this->Agregar_Uuario();
	  }
	  else
	    $NUSU=1;
	  if(N_Dep!=0 && N_Idi!=0 && N_Inc!=0 && N_Nac!=0 && N_Ins!=0 && N_Bec!=0 && N_DHN!=0 && N_DHH!=0 && Ninf!="")
	    $band=1;
	}
    return $band;
  }
  function Modificar_Ins_Perso($ins_id, $niv_id, $ise_men, $ise_fgr, $ise_pno, $sta){ //$this->ins_id, $this->niv, $this->ise_men, $this->faca, $this->prom
    $res=$this->Operacion("UPDATE perso_ins set ise_fgr='$ise_fgr', ise_men='$ise_men', ise_pno='$ise_pno', ise_sta='$sta' WHERE ci='$this->=ci' AND ins_id='$ins_id' AND niv_id='$niv_id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Modificar_Est_Bec($bec_id, $esb_fec, $esb_mon,$sta){
	$res=$this->Operacion("UPDATE perso_bec set esb_fec='$esb_fec', esb_mon='$esb_mon', esb_sta='$sta' WHERE ci='$this->ci' AND bec_id='$bec_id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Modificar_Dir_Hon_Nac($ciu_id_nacimiento, $hon_dir_nac, $hon_fna, $sta){
  	$res=$this->Operacion("UPDATE dir_hon set hon_dir='$hon_dir_nac', hon_fna='$hon_fna', hon_sta='$sta' WHERE ci='$this->ci' AND ciu_id='$ciu_id_nacimiento' AND hon_tip='0'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Modificar_Dir_Hon_Hab($ciu_id_hab, $hon_dir_hab, $hon_tha, $sta){
	$res=$this->Operacion("UPDATE dir_hon set hon_dir='$hon_dir_hab', hon_tha='$hon_tha', hon_sta='$sta' WHERE ci='$this->ci' AND ciu_id='$ciu_id_hab' AND hon_tip='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Modificar_Nacion($pai_id,$sta){
    $res=$this->Operacion("UPDATE nacion set nac_sta='$sta' WHERE ci='$this->ci' AND pai_id='$pai_id' AND nac_sta='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_Persona(){
/*  echo "<script>alert('A ELIMINAR');</script>";*/
    $res=$this->Operacion("UPDATE persona set sta='$this->sta' WHERE ci='$this->ci'");
    $num_filas=$this->filas_afectadas($res);
	if($num_filas>0){
	  $Eusu=$this->Eliminar_Todo("usuari","usu_sta",0);
	  $Edep=$this->Eliminar_Todo("estudi_deport","esd_sta",0);
  	  $Eidi=$this->Eliminar_Todo("perso_idioma","esi_sta",0);
	  $Einc=$this->Eliminar_Todo("perso_incapa","ein_sta",0);
	  $Enac=$this->Eliminar_Todo("nacionali","nac_est",0);
	  $Ebec=$this->Eliminar_Todo("perso_bec","esb_sta",0);
	  $Edhn=$this->Eliminar_Todo("dir_hon","hon_sta",0);
	  $Eexp=$this->Eliminar_Todo("expedi","exp_sta",0);
	  $Edet=$this->Eliminar_Todo("detins","det_sta",0);
	  $Emat=$this->Eliminar_Todo("matric","matr_sta",0);
	  $Eins=$this->Eliminar_Todo("perso_ins","ise_sta",0);
	  $Ecdp=$this->Eliminar_Todo("cargo_depart_emplea","cde_sta",0);
	  $Einf=$this->Eliminar_Estudi_Infrae(0);
	  if($Eusu>0 && $Edep>0 && $Eidi>0 && $Einc>0 && $Enac>0 && $Ebec>0 && $Edhn>0 && $Eexp>0 && $Edet>0 && $Emat>0 && $Eins>0 && $Ecdp>0 && $Einf>0)
	    $num_filas=1;
	}  
    return $num_filas;
  }
  function Eliminar_Todo($tabla,$campo,$sta){
    $sentencia="SELECT * from $tabla WHERE ci='$this->ci' AND $campo='1'";
/*    $sentprueba="SELECT * from $tabla WHERE ci=$this->ci AND $campo=1";
	 echo "<script>alert('$sentprueba');</script>";*/
    $res=$this->Operacion($sentencia);
    $num_filas=$this->filas_afectadas($res);
	if($num_filas>0){
	  $sentencia="UPDATE $tabla set $campo='$sta' WHERE ci='$this->ci' AND $campo='1'";
/*	  $sentprueba="UPDATE $tabla set $campo=$sta WHERE ci=$this->ci AND $campo=1";
	 echo "<script>alert('$sentprueba');</script>";*/
	  $res=$this->OperacionCualquiera($sentencia);
      $num_filas=$this->filas_afectadas($res);
    }
	else
	  $num_filas=1;
	return $num_filas;
  }
  function Eliminar_Estudi_Infrae($sta){
    $dat=date("Y-m-d")."%";
    $res=$this->Operacion("UPDATE estudi_infrae set est_inf_sta='$sta', est_inf_ffi='$dat' WHERE ci='$this->ci' AND est_inf_sta='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Eliminar_Usuario($sta){
    $res=$this->Operacion("UPDATE usuari set usu_sta='$sta' WHERE ci='$this->ci'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Eliminar_Estudi_Deport($dep_id,$sta){
	$res=$this->Operacion("UPDATE estudi_deport set esd_sta='$sta' WHERE ci='$this->ci' AND dep_id='$dep_id' AND esd_sta='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Eliminar_Estudi_Idioma($idi_id,$sta){
	$res=$this->Operacion("UPDATE perso_idioma set esi_sta='$sta' WHERE ci='$this->ci' AND idi_id='$idi_id' AND esi_sta='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Eliminar_Estudi_Incapa($inc_id,$sta){
    $res=$this->Operacion("UPDATE perso_incapa set ein_sta='$sta' WHERE ci='$this->ci' AND inc_id='$inc_id' AND ein_sta='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Eliminar_Nacion($pai_id,$sta){
    $res=$this->Operacion("UPDATE nacion set nac_sta='$sta' WHERE ci='$this->ci' AND pai_id='$pai_id' AND nac_sta='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Eliminar_Ins_Perso($sta){
    $res=$this->Operacion("UPDATE perso_ins set ise_sta='$sta' WHERE ci='$this->ci' AND ise_sta='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Eliminar_Est_Bec($bec_id, $sta){
	$res=$this->Operacion("UPDATE perso_bec set esb_sta='$sta' WHERE ci='$this->ci' AND bec_id='$bec_id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Eliminar_Dir_Hon_Nac($sta){
  	$res=$this->Operacion("UPDATE dir_hon set hon_sta='$sta' WHERE ci='$this->ci' AND hon_tip='0'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
  function Eliminar_Dir_Hon_Hab($sta){
	$res=$this->Operacion("UPDATE dir_hon set hon_sta='$sta' WHERE ci='$this->ci' AND hon_tip='1'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Buscar_Infraes($valor,$cual){
    $id="";
	$des="";
	$cuantos=0;
    $resp=$this->Operacion("SELECT * FROM infrae WHERE inf_sta='1' AND nuc_id='$valor' ORDER BY inf_nom");
	while($array=$this->Consultar($resp)){
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
  function Buscar_Campos($valor,$cual){
    $id="";
	$des="";
	$cuantos=0;
	/*echo "<script>alert('Valor= $valor, cual= $cual');</script>";*/
	//$//pais_nac,'estado_nac','municipio_nac','ciudad_nac','lugar_nac'/pais_dir,'estado_dir','municipio_dir','ciudad_dir','direccion'
	if($cual=="estado_nac" || $cual=="estado_dir"){
      $resp=$this->Operacion("SELECT * FROM estado WHERE esta_sta='1' AND pai_id='$valor' ORDER BY esta_nom");
	  while($array=$this->Consultar($resp)){
	    if($id==""){
	      $id=$array->esta_id;
	      $des=$array->esta_nom;
	    }
	    else{
	      $id=$id."*".$array->esta_id;
	      $des=$des."*".$array->esta_nom;
	    }
	    $cuantos++;
	  }
	}
	else{//pais_nac,'estado_nac','municipio_nac','ciudad_nac','lugar_nac'/pais_dir,'estado_dir','municipio_dir','ciudad_dir','direccion'
	  if($cual=="municipio_nac" || $cual=="municipio_dir"){
	    $resp=$this->Operacion("SELECT * FROM munici WHERE mun_sta='1' AND esta_id='$valor' ORDER BY mun_nom");
	    while($array=$this->Consultar($resp)){
	      if($id==""){
	        $id=$array->mun_id;
	        $des=$array->mun_nom;
	      }
	      else{
	        $id=$id."*".$array->mun_id;
	        $des=$des."*".$array->mun_nom;
	      }
	      $cuantos++;
	    }
	  }
	  else{
        $resp=$this->Operacion("SELECT * FROM ciudad WHERE ciu_sta='1' AND mun_id='$valor' ORDER BY ciu_nom");
	    while($array=$this->Consultar($resp)){
	      if($id==""){
	        $id=$array->ciu_id;
	        $des=$array->ciu_nom;
	      }
	      else{
	        $id=$id."*".$array->ciu_id;
	        $des=$des."*".$array->ciu_nom;
	      }
	      $cuantos++;
	    }
	  }
	}	
	$this->res=$id."@".$des."@".$cuantos;
  }
//******************************************************************
  function Comprobar_seleccion($s_n,$id,$otro){
    $band=0;
    if($_POST[s_n]=='1'){
	  if($_POST[id]!=""){
		if($_POST[id]=="OTRO"){
		  if($_POST[otro]!="")
			$band=1;
		  else
			echo "<script>alert('LO SIENTO SI TIENE OTRO COMPONENTE MILITAR, OTRA INCAPACIDAD, OTRA UNA ETNIA Y/O OTRO IDIOMA DEBE DE ESCRIBIR EN EL CAMPO CORRESPONDIENTE EL NOMBRE');</script>";
		}
		else
 		  $band=1;
	  }
	  else
		echo "<script>alert('LO SIENTO SI TIENE UN COMPONENTE MILITAR, ALGUNA INCAPACIDAD, POSEE UNA ETNIA Y/O IDIOMA DEBE DE SELECCIONAR UNO');</script>";
	}
	else
	  $band=1;
	$this->res=$band;
  }
//******************************************************************
  function Buscar_Nombre_arch($arch){
    $row=0;
    $this->Operacion("SELECT * FROM persona WHERE fot='$arch' AND sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0){
      $row=1;
	}
    return $row;
  }
//******************************************************************
  function Listado_Nacionalidad2(){
    $id="";
    $resultado=$this->Operacion("SELECT * FROM pais WHERE pai_sta='1' order by pai_nac");
    while($array=$this->Consultar()){
	  if($id="")
	    $id=$array->pai_id;
	  else
	    $id=$array->pai_id."@".$id;
	}
	$this->res=$id;
  }
//******************************************************************
 function Listado_Pensum2(){
    $id="";
    $resultado=$this->Operacion("SELECT B.mod_id AS 'mod_id', C.esp_id AS 'esp_id', D.reg_id AS 'reg_id', E.coh_id AS 'coh_id' FROM pensum A, modali B, especi C, regimen D, cohort E WHERE pen_sta='1' AND A.mod_id=B.mod_id AND A.esp_id=C.esp_id AND A.reg_id=D.reg_id AND A.coh_id=E.coh_id order by B.mod_nom, C.esp_nom, D.reg_nom, E.coh_nom");
    while($array=$this->Consultar()){
	  if($id="")
	    $id=$array->mod_id."*".$array->esp_id."*".$array->reg_id."*".$array->coh_id;
	  else
	    $id=$array->mod_id."*".$array->esp_id."*".$array->reg_id."*".$array->coh_id."@".$id;
	}
	$this->res=$id;
  }  
//******************************************************************
  function Listado_Beca2(){
    $id="";
    $resultado=$this->Operacion("SELECT bec_id FROM beca WHERE bec_sta='1' AND bec_id!='-1' order by bec_nom");
    while($array=$this->Consultar()){
	  if($id="")
	    $id=$array->bec_id;
	  else
	    $id=$array->bec_id."@".$id;
	}
	$this->res=$id;
  }
//******************************************************************
  function Listado_Incapacidad2(){
    $id="";
    $resultado=$this->Operacion("SELECT inc_id FROM incapa WHERE inc_sta='1' order by inc_nom");
    while($array=$this->Consultar()){
	  if($id="")
	    $id=$array->inc_id;
	  else
	    $id=$array->inc_id."@".$id;
	}
	$this->res=$id;
  }
//******************************************************************
  function Listado_Idioma2(){
    $id="";
    $resultado=$this->Operacion("SELECT idi_id FROM idioma WHERE idi_sta='1' order by idi_nom");
    while($array=$this->Consultar()){
	  if($id="")
	    $id=$array->idi_id;
	  else
	    $id=$array->idi_id."@".$id;
	}
	$this->res=$id;
  }
//******************************************************************
  function Listado_Deporte2(){
    $id="";
    $resultado=$this->Operacion("SELECT dep_id FROM deport WHERE dep_sta='1' order by dep_nom");
    while($array=$this->Consultar()){
	  if($id="")
	    $id=$array->dep_id;
	  else
	    $id=$array->dep_id."@".$id;
	}
	$this->res=$id;
  }
//**********************REALIZADO POR MIGUEL ACERO******************
//**************************INICIO**********************************
  function busc_persona($ci){
  $valor=$this->OperacionCualquiera("SELECT ci, no1, no2, no3, ap1, ap2, ap3, tip FROM persona WHERE ci='$ci' AND sta='1'");
  return $valor;
  }
//******************************************************************
  function busc_tipo($tipo){
  $valor=$this->OperacionCualquiera("SELECT ci, no1, no2, ap1, ap2 FROM persona WHERE tip='$tipo' AND sta='1'");
  return $valor;
  }
//******************************************************************
  function tipo_persona($tipo){ 
    if($tipo==0)
    return "ESTUDIANTE";
	else{
	  if($tipo==1)
	  return utf8_decode("ACADÉMICO");
	  if($tipo==2)
	  return utf8_decode("ESTUDIANTE-ACADÉMICO");
	  if($tipo==3)
	  return "ADMINISTRATIVO";
	  if($tipo==4)
	  return "ESTUDIANTE-ADMINISTRATIVO";
	}                       
  }
//******************************************************************
  function agr_persona($est_tip,$est_sex,$cedula,$est_tid,$no1,$no2,$ap1,$ap2){
  $no1=strtoupper($no1);
  $no2=strtoupper($no2);
  $ap1=strtoupper($ap1);
  $ap2=strtoupper($ap2);
  $this->Operacion("INSERT INTO persona (ci,no1,no2,ap1,ap2,sex,tip,did,sta) values ('$cedula','$no1','$no2','$ap1','$ap2','$sex','$est_tip','$est_tid','1')");
  $accion='INSERTAR';
  $Operacion="AGREGAR PERSONA, CI: ".$cedula." NOMBRES: ".$no1." ".$no2." APELLIDOS: ".$ap1." ".$ap2;
  $this->guardar_accion($accion,"persona",$Operacion);
  echo "<script>alert('LOS DATOS DE LA PERSONA HAN SIDO AGREGADOS DE FORMA SATISFACTORIA')
  location.href='Listar.php'</script>";
  }  
//******************************************************************
  function modif_persona($est_tip,$cedula,$no1,$no2,$no3,$ap1,$ap2,$ap3){
  $no1=strtoupper($no1);
  $no2=strtoupper($no2);
  $no3=strtoupper($no3);
  $ap1=strtoupper($ap1);
  $ap2=strtoupper($ap2);
  $ap3=strtoupper($ap3); 
  $this->Operacion("UPDATE persona SET no1='$no1',no2='$no2',no3='$no3',ap1='$ap1',ap2='$ap2',ap3='$ap3',tip='$est_tip' WHERE ci='$cedula' AND sta='1'");
  $accion='MODIFICAR';
  $Operacion="MODIFICAR PERSONA, CI: ".$cedula." NOMBRES: ".$no1." ".$no2." ".$no3." APELLIDOS: ".$ap1." ".$ap2." ".$ap3;
  $this->guardar_accion($accion,"persona",$Operacion);
  echo "<script>alert('LOS DATOS DE LA PERSONA HAN SIDO MODIFICADOS DE FORMA SATISFACTORIA')
  location.href='Listar.php'</script>";
  }  
//***REALIZADO POR MIGUEL ACERO FIN*********************/
//******************************************************************
}?>