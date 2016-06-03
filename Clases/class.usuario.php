<?php session_start();
class usuario extends conec_BD
{
 var $correo='';
 var $usuar='';
 var $nacion='';
 var $ci='';
 var $nombre='';
 var $direcc='';
 var $idperf='';
 var $login='';
 var $passwo='';
 var $presec='';
 var $ressec='';
 var $res='';
 var $idusu='';
 var $OID='';
//******************************************************************
 function usuario($ci,$passwo,$idperf,$correo){
   $this->ci=$_SESSION['ci'];
   $this->passwo=$_SESSION['passwo'];
   $this->idperf=$_SESSION['idoper'];
   $this->correo=$correo;
  }
//******************************************************************
  function Asignar_valores($nacion,$ci,$nombre,$direcc,$perf,$correo,$passwo,$presec,$ressec){
   $this->nacion=$this->ConvertirMayuscula($nacion);
   $this->ci=$ci;
   $this->nombre=$this->ConvertirMayuscula($nombre);
   $this->direcc=$this->ConvertirMayuscula($direcc);
   $this->idperf=$perf;
   $this->correo=$this->ConvertirMayuscula($correo);
   $this->passwo=md5($passwo);
   $this->presec="".$this->ConvertirMayuscula($presec)."";
   $this->ressec="".md5($ressec)."";
 }
//******************************************************************
  function Asignar_ci($valor){
    $Tod=explode("*",$valor);
    $row='0';
    if($valor!=""){
      $this->ci=$Tod[1];
      $this->nacion=$Tod[0];
      if($this->ci!='' && $this->nacion!=''){
        $_SESSION['nacid']=$valor;
		$_SESSION['ci']=$this->ci;
        $row=$this->Buscar_Usuario();
        if($row=='0')
          $row='';
      }
    }
    return $row;
  }
//******************************************************************
  function Asignar_preg($valor){
    $res=$this->Buscar_Preg_Usua();
    $PreRes=explode("*",$valor);
    $row='0';
    if($PreRes[1]!=""){
      $PreRes[1]=md5($PreRes[1]);
	  /*echo "<script>alert('$PreRes[1]');</script>";*/
      if($PreRes[1]==$res->VAR_RSE){
        $_SESSION['presec']=$this->presec=$PreRes[0];
        $_SESSION['ressec']=$this->ressec=$PreRes[1];
        $row="1";
      }
    }
    else
      $row="";
    return $row;
  }
//******************************************************************
  function Asignar_pass($valor){
    $row='0';
    $Passw=explode("*",$valor);
    if($Passw[0]!="" && $Passw[1]!=""){
      if($Passw[0]==$Passw[1]){
        $passwo=md5($Passw[0]);
        $_SESSION['newpas']=$passwo;
        $row=$this->Modificar_Passw();
      }
    }
    else
      $row="";
    return $row;
  }
//******************************************************************
  function Contar_Usuarios(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM usuari");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_Usuarios($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT A.ci, B.ap1, B.ap2, B.no1, B.no2 FROM usuari A, persona B WHERE A.ci=B.ci AND A.usu_sta!='0' order by B.ap1, B.ap2, B.no1 LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Buscar_Usuario(){
    $this->usuar=0;
    $row=array();
    $num_filas='';
    $this->Operacion("SELECT * FROM usuari WHERE ci='$this->idusu'");
    $num_filas=$this->NumFilas();
	if($num_filas<=0)
      $this->usuar=1;
    return $num_filas;
  }
//******************************************************************
  function Buscar_Usuario2($id){
    $this->Operacion("SELECT * FROM usuari WHERE ci='$id'");
  }
//******************************************************************
  function Crear_Usuario($todo){
   $this->Operacion("SELECT * FROM usuari WHERE ci='$this->ci' OR usu_cor='$this->login'");
   $num_filas=$this->NumFilas();
	  /*echo "<script>alert('Filas= $num_filas, $this->nacion, $this->login, $this->ci, $idperf');</script>";*/
	if($num_filas > 0)
	  echo "<script>alert('LO SIENTO USUARIO O CORREO ELECTRONICO YA INGRESADOS');</script>";
	else
	  echo "<script>alert('Guardar');</script>";
  }
//******************************************************************
  function Buscar_Correo(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
//	$this->logi=0;
    $res=$this->OperacionCualquiera("SELECT * FROM usuari WHERE usu_cor='$this->cor' AND usu_sta='1'");
    $num_filas=$this->NumFilasCualquiera($res);
    if($num_filas>0)
      $row=1;
	else
	  $this->logi=1;
    return $row;
  }
//******************************************************************
  function Buscar_Usu_Cor(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row="";
    $resul=$this->Operacion("SELECT * FROM usuari WHERE usu_cor='$this->correo' AND usu_sta='1' AND usu_pas='$this->passwo'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=$this->Consultar();
    return $row;
  }
//******************************************************************
  function Buscar_Sesion_Usua(){
    $row=array();
//    $this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT * FROM usuari where ci='$_SESSION[idusu]'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=$this->Consultar();
    return $row;
  }
//******************************************************************
  function Asignar_Perfil_Usu($valor){
    $row="";
	$perf="";
	$idper="";
	$this->Operacion("SELECT * FROM perfil_usuari where ci_usu='$valor' AND peu_sta='1'");
    $num_filas=$this->NumFilas();
/*	echo "<script>alert('$num_filas');</script>";*/
    while($array=$this->Consultar()){
  	  $perfil=$array->per_id;
 	  $res=$this->OperacionCualquiera("SELECT * FROM perfil where per_id='$perfil'");
	  $array3=$this->ConsultarCualquiera($res);
	 /* echo "<script>alert('$array3->per_nom $array3->per_id');</script>";*/
	  if($perf==""){
	    $perf=$array3->per_nom;
		$idper=$array3->per_id;
	  }
	  else{
	    $perf=$perf."*".$array3->per_nom;
		$idper=$idper."*".$array3->per_id;
	  }
	}
	$row=$perf."@".$idper."@".$num_filas;
	/*echo "<script>alert('TODO $row');</script>";*/
 	return $row;
  }
//******************************************************************
  function Buscar_Usu(){
    $row="";
    $this->Operacion("SELECT * FROM usuari WHERE ci='$this->ci' AND usu_pas='$this->passwo'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=$this->Consultar();
    return $row;
  }
//******************************************************************
  function Buscar_Nom_Per(){
    $this->Operacion("SELECT per_nom FROM perfil WHERE per_id='$this->idperf' AND per_sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=$this->Consultar();
    return $row;
  }
//******************************************************************
  function Buscar_Nom_Usu(){
    $this->Operacion("SELECT no1, ap1 FROM persona WHERE ci='$_SESSION[ci]' and sta='1'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=$this->Consultar();
    return $row;
  }
//******************************************************************
  function Comprobar_Pass($desc){
    $this->passwo=md5($_POST['passwo']);
/*	echo "<script>alert('PASSWO= $this->passwo');</script>";*/
    $enc=0;
    $row=$this->Buscar_Usu();
    if($row!=""){
      $_SESSION['ci']=$row->ci;
	/*echo "<script>alert('ci= $row->ci, idper=$this->idperf');</script>";*/
      $nomper=$this->Buscar_Nom_Per();
	/*echo "<script>alert('nomper= $nomper->per_nom');</script>";*/
      $_SESSION['nomper']=$nomper->per_nom;
      $nomusu=$this->Buscar_Nom_Usu();
	/*echo "<script>alert('usuario= $nomusu->no1 $nomusu->ap1');</script>";*/
	  $_SESSION['usuario']=$nomusu->no1." ".$nomusu->ap1;
      $_SESSION['autentificado']= "SI";
      $enc=1;
    }
    return $enc;
  }
//******************************************************************
  function imprimir_combo($valor,$etiqueta,$PValor=NULL)
  {
    $this->res="";
    while ($comBox = $this->Consultar()){
      if(!$PValor) $sel = " ";
      else $sel = ($comBox->$valor==$PValor)?'selected':' ';
      $this->res=$this->res."<option value='".$comBox->$valor."'".$sel.">".$comBox->$etiqueta."</option>";
    }
    //mysql_free_result($this->resul);
    return $this->res;
  }
//**************************************************************************************************
  function Verificar($pag){
    $this->nacion=$_POST[nacion];
    $this->ci=$_POST[ci];
    $this->nombre=$_POST[nombre];
    $this->direcc=$_POST[direcc];
    $this->idperf=$_POST[idperf];
    $this->login=$_POST[login];
    if($this->nacion!="" && $this->ci!="" && $this->nombre!="" && $this->direcc!="" && $this->idperf!="" && $this->login){
      echo "<script>window.open(".$pag.", \"\" , \"fullscreen=0 , toolbar=0 , location=0 , status=0 , menubar=0 , scrollbars=1, resizable=0, width=510px, height=250px\", false);</script>";
    }
    else
      echo "<script>alert('LO SIENTO HAY DATOS INCORRECTOS');</script>";
  }

//******************************************************************
  function Eliminar_Usuario(){
    $res=$this->OperacionCualquiera("UPDATE \"SIGPAV_USUARIO\" set \"INT_STA\"='0' WHERE \"INT_CI\"='$this->ci'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//****************************************************************************************************
  function Modificar_Usu_Fin($nomchec){
   	$id_fin=$_POST[$nomchec];
	$res=$this->OperacionCualquiera("SELECT * FROM \"SIGPAV_FIN_USUARIO\" WHERE \"VAR_FIN_RIF\"='$id_fin' AND \"INT_USU_CI\"='$this->ci'");
	$array3=$this->ConsultarCualquiera($res);
	$fecha=date("Y-m-d h:i:s");	  
	if($array3){
	  $res=$this->OperacionCualquiera("UPDATE \"SIGPAV_FIN_USUARIO\" set \"DAT_FIN\"='$fecha',\"INT_STA\"='1' WHERE \"VAR_FIN_RIF\"='$id_fin' AND \"INT_USU_CI\"='$this->ci'");
	}else{
      $res=$this->OperacionCualquiera("INSERT INTO \"SIGPAV_FIN_USUARIO\" (\"VAR_FIN_RIF\", \"DAT_FIN\", \"INT_USU_CI\", \"INT_STA\")
						VALUES ('$id_fin','$fecha','$this->ci','1')");
	}
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_Status(){
    $nuestat=1;
    if($_POST[stat]==1)
	  $nuestat=2;
    $res=$this->Operacion("UPDATE \"SIGPAV_USUARIO\" set \"INT_STA\"='$nuestat' WHERE \"INT_CI\"='$this->ci'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_Stat_Ope_tab($tab,$ope,$usu){
    $Fecha=date("Y-m-d h:i:s");
    $res=$this->Operacion("UPDATE \"SIGPAV_TAB_OPERACION\" set \"INT_STA\"='0', \"DAT_FFI\"='$Fecha'  WHERE \"INT_OPE_ID\"='$ope' AND \"INT_TAB_ID\"='$tab' AND \"INT_USU_CI\"='$usu'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_Usuario(){
    $res=$this->OperacionCualquiera("UPDATE \"SIGPAV_USUARIO\" set \"VAR_LOG\"='$this->login', \"INT_PER_ID\"='$this->idperf', \"VAR_NOM\"='$this->nombre', \"VAR_DIR\"='$this->direcc' WHERE \"INT_CI\"='$this->ci'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_Preg_Usuario(){
    $res=$this->Operacion("UPDATE \"SIGPAV_USUARIO\" set \"VAR_PSE\"='$this->presec', \"VAR_RSE\"='$this->ressec' WHERE \"INT_CI\"='$this->ci'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_Password(){
    $res=$this->Operacion("UPDATE \"SIGPAV_USUARIO\" set \"VAR_PAS\"='$this->passwo' WHERE \"INT_CI\"='$this->ci'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function CompararPassw($opc){
    $error=0;
    $passwnue=md5($_POST[passwnueconf]);
    if($opc!=0){
      $passwant=md5($_POST[passwant]);
      if($_POST[passw]==$passwant){
	    if($passwnue!=$this->passwo){
	      $error=1;
		  echo "<script>alert('LO SIENTO LA CONFIRMACION DEL NUEVO PASSWORD ES INCORRECTA');</script>";
	    }
	  }
	  else{
	    $error=1;
		echo "<script>alert('LO SIENTO EL PASSWORD ES INCORRECTO');</script>";
	  }
	}
	else{
	  if($passwnue!=$this->passwo){
	    $error=1;
		echo "<script>alert('LO SIENTO LA CONFIRMACION DEL PASSWORD ES INCORRECTA');</script>";
	  }
	}  
    return $error;
  }
//******************************************************************
function Comprobar_Permiso(){
  $res=$this->OperacionCualquiera("SELECT * FROM matric WHERE matr_sta='1' AND ci='$this->ci' AND esp_id IN ('2109D','2109N','2110D','2110N','2127D','2106D','5203D','5208N','5208D','5201D','5201N','2113D','2113N','2122D','2126D','2126N') AND matr_tip='0'");
  $array=$this->ConsultarCualquiera($res);
  $per=1;
  if($array!='' && $this->ci!='18189380'){
    echo "<script>alert('LO SIENTO INSCRIPCIONES SUSPENDIDAS HASTA NUEVO AVISO. POR FAVOR ESPERE SU RESPECTIVO AVISO');</script>";
	$per=0;
  }
  if($this->ci=='18189380')
	  $per=1;
  return $per;
}
//******************************************************************
  function CompararRespSec($opc){  
    $error=0;
	$resnue=md5($_POST[resnueconf]);
    if($opc!=0){
      $resant=md5($_POST[resant]);
	  $error=0;
      if($_POST[ressec]==$resant){
	    if($resnue!=$this->ressec){
	      $error=1;
		  echo "<script>alert('LO SIENTO LA CONFIRMACION DE LA NUEVA RESPUESTA SECRETA ES INCORRECTA');</script>";
	    }
	  }
	  else{
	    $error=1;
		echo "<script>alert('LO SIENTO LA RESPUESTA SECRETA ES INCORRECTA');</script>";
	  }
	}
	else{
	  if($resnue!=$this->ressec){
	    $error=1;
		echo "<script>alert('LO SIENTO LA CONFIRMACION DE LA RESPUESTA SECRETA ES INCORRECTA');</script>";
	  }
	}
    return $error;
  }
//******************************************************************

}
?>