<?php ini_set("error_reporting",E_ALL ^ E_NOTICE ^ E_WARNING);
class conec_BD{
  var $BD;
  var $Host;
  var $Puerto;
  var $Usua;
  var $Pass;
  var $Conex;
  var $resultado;
  var $ultimoReg;
  var $Cadena;
  var $conexion;
  var $resul;
  var $resul1;
  var $resul2;
  var $resul3;
  var $fila;
  var $tama,$HOME,$PRINCIPAL,$HOSTT;
  var $nomope='';
  var $nomtab='';

  function conec_BD(){
    $this->BD="sidsecun";
    $this->Host="localhost";
    $this->Puerto="80";
    $this->Usua="root";
    $this->Pass="";
   // $this->Pass="";
    $this->Cadena="host=".$this->Host." port=".$this->Puerto." password=".$this->Pass." user=".$this->Usua." dbname=".$this->BD;
    //ini_set("error_reporting",E_ALL ^ E_NOTICE ^ E_WARNING);
  }
//********************************************************************************************
  function conectar_BD(){  
    $this->conexion=$this->Conex=mysql_connect("localhost","root","");
    $this->respuesta=mysql_select_db("sidsecun");
    return $this->Conex;
  }//fin Conectar
//****************************************************
  function close_BD(){
    mysql_close($this->Conex);
//    pg_close() or die("Error al Cerrar la Base de Datos");
  }
//*********************************************************
  function OperacionCualquiera($Oper){
    $resultado=mysql_db_query($this->BD,$Oper,$this->Conex)  or error_page( 'Error en consulta mysql Consulta: ' . $Oper . ' <br />'.mysql_error() );
    return $resultado;
  }//fin Operacion
//*********************************************************
  function Operacion($Oper){
    $this->resul=mysql_db_query($this->BD,$Oper,$this->Conex);  
	/*or error_page( 'Error en consulta mysql Consulta: ' . $Oper . ' <br />' . mysql_error() );*/
	//$this->resul=pg_query($this->Conex,$Oper); //or die("*".utf8_decode(pg_last_error($this->Conex))."*--".$Oper);
    return $this->resul;
  }//fin Operacion
//*********************************************************
  function Operacion1($Oper){
    $this->resul1=mysql_db_query($this->BD,$Oper,$this->Conex)  or error_page( 'Error en consulta mysql Consulta: ' . $Oper . ' <br />' . mysql_error() );
    return $this->resul1;
  }//fin Operacion
//*********************************************************
  function Operacion2($Oper){
    $this->resul2=@mysql_db_query($this->BD,$Oper,$this->Conex)  or error_page( 'Error en consulta mysql Consulta: ' . $Oper . ' <br />' . mysql_error() );
    return $this->resul2;
  }//fin Operacion
//*********************************************************
  function Operacion3($Oper){
    $this->resul3=@mysql_db_query($this->BD,$Oper,$this->Conex)  or error_page( 'Error en consulta mysql Consulta: ' . $Oper . ' <br />' . mysql_error() );
    return $this->resul3;
  }//fin Operacion
//************************************************************
function ConsultarUltimoRegistro($resultado){
	$this->ultimoReg=pg_last_oid($resultado);
	return $this->ultimoReg;
}

//************************************************************
function ConsultarCualquiera($resultado){
	$this->fila=mysql_fetch_object($resultado);
	return $this->fila;
}
//************************************************************
function Consultar(){
	$this->fila=mysql_fetch_object($this->resul);	
	return $this->fila;

}
//************************************************************
function Consultar1(){
	$this->fila=mysql_fetch_object($this->resul1);
	return $this->fila;
}
//************************************************************
function Consultar2(){
	$this->fila=mysql_fetch_object($this->resul2);
	return $this->fila;
}
//************************************************************
function Consultar3(){
	$this->fila=mysql_fetch_object($this->resul3);
	return $this->fila;
}
//**********************************************************
function Consultar_otra(){
	$this->fila=mysql_fetch_row($this->resul);
	return $this->fila;
}
//****************************************************************************************************
  function Buscar($tabla,$columna,$valor){
   	/*echo "<script>alert('SELECT * FROM \"$tabla\" WHERE \"$columna\"=$valor')</script>";*/
    $resp=$this->OperacionCualquiera("SELECT * FROM $tabla WHERE $columna='$valor'");
	return $resp;
  }
//**********************************************************
function NumFilas1($res)
 {
   $this->num=0;
   if(isset($res)){
     $this->num=mysql_num_rows($res);
	 /*echo "<script>alert('Entre Numero: $this->num');</script>";*/
   }
   //else die("No hay registros cargados");
   return $this->num;
 }
//**********************************************************
function NumFilas()
 {
   $this->num=0;
   if(isset($this->resul)){
     $this->num=mysql_num_rows($this->resul);
	 /*echo "<script>alert('Entre Numero: $this->num');</script>";*/
   }
   //else die("No hay registros cargados");
   return $this->num;
 }
 //**********************************************************
function NumFilasCualquiera($resultado)
 {
   $this->num=0;
   if(isset($resultado)){
     $this->num=mysql_num_rows($resultado);
	 /*echo "<script>alert('Entre');</script>";*/
   }
   //else die("No hay registros cargados");
   return $this->num;
 }
 //*****************************************************
  function filas_afectadas($resultado)
  {
    $this->tama=mysql_affected_rows();
    if($this->tama=="")
      $this->tama='-1';
    return $this->tama;
  }
//******************************************************************
  function Limpiar(){
    $_SESSION['nacid']="";
    $_SESSION['presec']="";
    $_SESSION['ressec']="";
    $_SESSION['newpas']="";
    $_SESSION['idoper']="";
    $_SESSION['idtab']="";
    $_SESSION['idper']="";
    $_SESSION['idusu']="";
    $_SESSION['ci']="";
    $_SESSION['login']="";
    $_SESSION['usuario']="";
    $_SESSION['nomper']="";
    $_SESSION['autentificado']= "SI";
  }
//******************************************************************
  function Buscar_id_Ope(){
/*	  	echo "<script>alert('SELECT ope_id FROM operac WHERE ope_nom=$this->nomope');</script>";*/
      $this->Operacion("SELECT ope_id FROM operac WHERE ope_nom='$this->nomope'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=$this->Consultar();
    return $row;
  }
//******************************************************************
  function Buscar_id_Tab(){
/*	  	echo "<script>alert('SELECT tab_id FROM tabla WHERE tab_nom=$this->nomtab');</script>";*/
    $this->Operacion("SELECT tab_id FROM tabla WHERE tab_nom='$this->nomtab'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=$this->Consultar();
    return $row;
  }
//******************************************************************
  function Autoriza()
  {
/*	  	echo "<script>alert('SELECT * FROM tab_ope WHERE ope_id=$_SESSION[idoper] AND tab_id=$_SESSION[idtab] AND per_id=$_SESSION[idper] AND tab_ope_sta=1');</script>";*/
    $this->Operacion("SELECT * FROM tab_ope WHERE ope_id='$_SESSION[idoper]' AND tab_id='$_SESSION[idtab]' AND per_id='$_SESSION[idper]' AND tab_ope_sta='1'");
    $row=$this->NumFilas();
    return $row;
  }

//******************************************************************
 function getRealIpAddr() {  
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
  function guardar_accion($accion,$tabla,$detalle)
  {
    $resul=0;
    $this->nomope=$accion;
    $this->nomtab=$tabla;
	$_SESSION['ip']=$this->getRealIpAddr(); //Falta la condici�n para conseguir el ip de la maquina de donde se estan conectado el usuario.
    $idope=$this->Buscar_id_Ope();
//    $_SESSION['idoper']=$idope->ope_id;
	$idtab=$this->Buscar_id_Tab();
    $_SESSION['idtab']=$idtab->tab_id;
/*	echo "<script>alert('$_SESSION[ip], $_SESSION[idoper], $_SESSION[idtab]');</script>";*/
    $row = $this->Autoriza();//recibe el login
    //if($row>0){
	$dias=time();
	 $fecha_hora_TS=date("Y-m-d H:i:s",$dias);
//    $fecha_hora_TS = date("Y-m-d h:i:s");
/*    if($_SESSION[ci]=='3997471'){
	  echo "<script>alert('INSERT INTO bitaco (ci_usu, ope_id, tab_id, per_id, bit_ip, bit_fej, bit_det) VALUES ($_SESSION[ci], $_SESSION[idoper], $_SESSION[idtab], $_SESSION[idper], $_SESSION[ip], $fecha_hora_TS, $detalle)');</script>";
	}*/
    $resultado=$this->Operacion("INSERT INTO bitaco (ci_usu, ope_id, tab_id, per_id, bit_ip, bit_fej, bit_det) VALUES ('$_SESSION[ci]', '$_SESSION[idoper]', '$_SESSION[idtab]', '$_SESSION[idper]', '$_SESSION[ip]', '$fecha_hora_TS', '$detalle')");
    $resul='1';
/*    if($_SESSION[ci]=='3997471'){
	  $num_filas=$this->NumFilasCualquiera($resultado);
	  echo "<script>alert('FILAS DETALES: $num_filas');</script>";
	}*/
    /*}
    else
	  echo "<script>alert('REVISAR LOS PRIVILEGIOS CON EL ADMINISTRADOR');</script>";*/
/*      echo "<script>alert('LO SIENTO NO TIENE AUTORIZACION PARA LA OPERACION QUE ESTA REALIZANDO. POR FAVOR COMINIQUESE CON EL ADMINISTRADOR DEL SISTEMA');</script>";*/
    return $resul;
  }
//******************************************************************
  function Convertir($valor){
    $dev=@number_format($valor,0,"",".");
    return $dev;
  }
//******************************************************************
  function Convertir_Monto($valor){
    $dev=@number_format($valor,2,",",".");
    return $dev;
  }
//******************************************************************
  function Convertir_Horas($valor){
    $dev=@number_format($valor,2,".",".");
    return $dev;
  }
//******************************************************************
  function Convertir_Ced($valor){
    $dev=@number_format($valor,0,".",".");
    return $dev;
  }
//******************************************************************
  function Convertir_otro($valor){
    $dev=@number_format($valor,0,"",",");
    return $dev;
  }
//************************************************************
public function consulta($consulta,$conexion)
  {
//$this->resultado=$this->OperacionCualquiera($consulta);
//echo "$consulta,$this->resultado";
    $this->resultado =mysql_query($consulta,$conexion);
//    return $this->resultado;
//   $this->resultado = mysqli_query($this->conexion,$consulta);
  }
//************************************************************
public function extraer()
  {
//   if ($fila = mysqli_fetch_array($this->resultado,MYSQLI_ASSOC))
   if ($fila = mysql_fetch_array($this->resultado))
    return $fila;
   else
    return false;	
  }
//************************************************************
  public function totfilas()
  {
//   return mysqli_num_rows($this->resultado);
   return mysql_num_rows($this->resultado);
  }
//******************************************************************
  function Buscar_Perf_Usu(){
	$num_filas=0;
    $this->Operacion("SELECT * FROM perfil_usuari WHERE ci_usu='$_SESSION[ci]' AND peu_sta='1' and per_id='$_SESSION[idoper]'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************************************
  function select_count($nombre,$Columna,$Valor)
	{
	 $this->cons = "select count(*) as cantidad from $nombre where $Columna = '$Valor'";
	 $this->resultado = mysql_query($this->cons, $this->conexion);
	 $vector = mysql_fetch_array($this->resultado);
	 return $vector[cantidad];
	}
//******************************************************************************************
  function select_tabla($tabla)
	{
	 $resul=$this->Mysql_Query("SELECT * FROM $tabla");
	 return $resul;
	}
//******************************************************************************************
  function select_tabla_where($tabla,$columna,$valor)
	{
     $resul=$this->Mysql_Query("SELECT * FROM $tabla WHERE $columna='$valor'");
	 return $resul;
	}
//******************************************************************************************
  function select_tabla_where_Doble($tabla,$columna1,$valor1,$columna2,$valor2)
	{
     $resul=$this->Mysql_Query("SELECT * FROM $tabla WHERE $columna1='$valor1' AND $columna2='$valor2'");
	 return $resul;
	}
//******************************************************************************************
  function select_tabla_where2($tabla,$columna,$valor)
	{
     $resul=$this->Mysql_Query("SELECT * FROM $tabla WHERE $columna!='$valor'");
	 return $resul;
	}
//******************************************************************************************
function select_tabla_where_order($tabla,$columna,$valor,$orden)
{
     $resul=$this->Mysql_Query("SELECT * FROM $tabla WHERE $columna='$valor' order by $orden");
	 return $resul;
}
//**********************************************************
function Mysql_Query($Oper){
	$resul = mysql_query($Oper, $this->Conex);
	return $resul;
}
//**********************************************************
function Mysql_array($resul){
	$this->fila=mysql_fetch_array($resul);
	return $this->fila;
}
//**********************************************************
function Mysql_object($resul){
	$this->fila=mysql_fetch_object($resul);
	return $this->fila;
}
//**********************************************************
function Mysql_num_rows($resul){
	$this->fila=mysql_num_rows($resul);
	return $this->fila;
}
//**********************************************************
//Convierte fecha de dd/mm/aa a mysql
    function cambia_a_mysql($fecha)
        {
          ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})", $fecha, $mifecha);
          $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
          return $lafecha;
        }
//**********************************************************
//convierte la fecha de mysql al formato dd/mm/aa
	function cambia_a_normal($fecha){
      ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
      $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1];
      return $lafecha;
    }
//******************************************************************
  function fechaMySql($fecha){
    $fec=explode("/",$fecha);
	$fecMyS=$fec[2]."/".$fec[1]."/".$fec[0];
	return $fecMyS;
  }

//******************************************************************
  function fechaMySql_time($fecha){
    $fec=explode("/",$fecha);
	$fecMyS=$fec[2]."-".$fec[1]."-".$fec[0];
	return $fecMyS;
  }
//******************************************************************
  function fechaNormal($fecha){
    $fech=explode(" ",$fecha);
    $fec=explode("-",$fech[0]);
	$fecMyS=$fec[2]."/".$fec[1]."/".$fec[0];
	return $fecMyS;
  }
//******************************************************************************************
function ConvertirMayuscula($carac){
    //$nuevoNum=round($num,'2');
  $nuevoCarac= strtoupper($carac);
  return $nuevoCarac;
}
//**********************************************************
function compara_fechas($fecha1,$fecha2)
{
     $fech1=split(" ",$fecha1);
     $fech2=split(" ",$fecha2);
	 if($fech1[1]!=""){
       list($hor1,$min1,$seg1)=split(":",$fech1[1]);
	 }
	 else{
	   $hor1=0; $min1=0; $seg1=0;
	 }
	 if($fech2[1]!=""){	 
       list($hor2,$min2,$seg2)=split(":",$fech2[1]);
	 }
	 else{
	   $hor2=0; $min2=0; $seg2=0;
	 }
     if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fech1[0]))
           list($dia1,$mes1,$a�o1)=split("/",$fech1[0]);
     if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fech1[0]))
           list($dia1,$mes1,$a�o1)=split("-",$fech1[0]);
     if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fech2[0]))
           list($dia2,$mes2,$a�o2)=split("/",$fech2[0]);
     if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fech2[0]))
            list($dia2,$mes2,$a�o2)=split("-",$fech2[0]);
     $dif = mktime($hor1,$min1,$seg1,$mes1,$dia1,$a�o1) - mktime($hor2,$min2,$seg2,$mes2,$dia2,$a�o2);
     return ($dif);                         
}
//**********************************************************
//**********Buscado por Miguel Acero************************
//#############convertir numeros en letras
//#############inicio
/*
http://micodigobeta.com.ar
http://dreamcoders.com.ar
 */
/*!
  @function num2letras ()
  @abstract Dado un n?mero lo devuelve escrito.
  @param $num number - N?mero a convertir.
  @param $fem bool - Forma femenina (true) o no (false).
  @param $dec bool - Con decimales (true) o no (false).
  @result string - Devuelve el n?mero escrito en letra.

*/
function num2letras($num, $fem = false, $dec = true) {
//if (strlen($num) > 14) die("El n?mero introducido es demasiado grande");
   $matuni[2]  = "dos";
   $matuni[3]  = "tres";
   $matuni[4]  = "cuatro";
   $matuni[5]  = "cinco";
   $matuni[6]  = "seis";
   $matuni[7]  = "siete";
   $matuni[8]  = "ocho";
   $matuni[9]  = "nueve";
   $matuni[10] = "diez";
   $matuni[11] = "once";
   $matuni[12] = "doce";
   $matuni[13] = "trece";
   $matuni[14] = "catorce";
   $matuni[15] = "quince";
   $matuni[16] = "dieciseis";
   $matuni[17] = "diecisiete";
   $matuni[18] = "dieciocho";
   $matuni[19] = "diecinueve";
   $matuni[20] = "veinte";
   $matunisub[2] = "dos";
   $matunisub[3] = "tres";
   $matunisub[4] = "cuatro";
   $matunisub[5] = "quin";
   $matunisub[6] = "seis";
   $matunisub[7] = "sete";
   $matunisub[8] = "ocho";
   $matunisub[9] = "nove";
   $matdec[2] = "veint";
   $matdec[3] = "treinta";
   $matdec[4] = "cuarenta";
   $matdec[5] = "cincuenta";
   $matdec[6] = "sesenta";
   $matdec[7] = "setenta";
   $matdec[8] = "ochenta";
   $matdec[9] = "noventa";
   $matsub[3]  = 'mill';
   $matsub[5]  = 'bill';
   $matsub[7]  = 'mill';
   $matsub[9]  = 'trill';
   $matsub[11] = 'mill';
   $matsub[13] = 'bill';
   $matsub[15] = 'mill';
   $matmil[4]  = 'millones';
   $matmil[6]  = 'billones';
   $matmil[7]  = 'de billones';
   $matmil[8]  = 'millones de billones';
   $matmil[10] = 'trillones';
   $matmil[11] = 'de trillones';
   $matmil[12] = 'millones de trillones';
   $matmil[13] = 'de trillones';
   $matmil[14] = 'billones de trillones';
   $matmil[15] = 'de billones de trillones';
   $matmil[16] = 'millones de billones de trillones';

   $num = trim((string)@$num);
   if ($num[0] == '-') {
      $neg = 'menos ';
      $num = substr($num, 1);
   }else
      $neg = '';
   while ($num[0] == '0') $num = substr($num, 1);
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
   $zeros = true;
   $punt = false;
   $ent = '';
   $fra = '';
   for ($c = 0; $c < strlen($num); $c++) {
      $n = $num[$c];
      if (! (strpos(".,'''", $n) === false)) {
         if ($punt) break;
         else{
            $punt = true;
            continue;
         }

      }elseif (! (strpos('0123456789', $n) === false)) {
         if ($punt) {
            if ($n != '0') $zeros = false;
            $fra .= $n;
         }else

            $ent .= $n;
      }else

         break;

   }
   $ent = '     ' . $ent;
   if ($dec and $fra and ! $zeros) {
      $fin = ' con';
      for ($n = 0; $n < strlen($fra); $n++) {
         if (($s = $fra[$n]) == '0')
            $fin .= ' cero';
         elseif ($s == '1')
            $fin .= $fem ? ' una' : ' un';
         else
            $fin .= ' ' . $matuni[$s];
      }
   }else
      $fin = '';
   if ((int)$ent === 0) return 'Cero ' . $fin;
   $tex = '';
   $sub = 0;
   $mils = 0;
   $neutro = false;
   while ( ($num = substr($ent, -3)) != '   ') {
      $ent = substr($ent, 0, -3);
      if (++$sub < 3 and $fem) {
         $matuni[1] = 'una';
         $subcent = 'as';
      }else{
         $matuni[1] = $neutro ? 'un' : 'uno';
         $subcent = 'os';
      }
      $t = '';
      $n2 = substr($num, 1);
      if ($n2 == '00') {
      }elseif ($n2 < 21)
         $t = ' ' . $matuni[(int)$n2];
      elseif ($n2 < 30) {
         $n3 = $num[2];
         if ($n3 != 0) $t = 'i' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }else{
         $n3 = $num[2];
         if ($n3 != 0) $t = ' y ' . $matuni[$n3];
         $n2 = $num[1];
         $t = ' ' . $matdec[$n2] . $t;
      }
      $n = $num[0];
      if ($n == 1) {
         $t = ' ciento' . $t;
      }elseif ($n == 5){
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
      }elseif ($n != 0){
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
      }
      if ($sub == 1) {
      }elseif (! isset($matsub[$sub])) {
         if ($num == 1) {
            $t = ' mil';
         }elseif ($num > 1){
            $t .= ' mil';
         }
      }elseif ($num == 1) {
         $t .= ' ' . $matsub[$sub] . '&oacute;n';
      }elseif ($num > 1){
         $t .= ' ' . $matsub[$sub] . 'ones';
      }   
      if ($num == '000') $mils ++;
      elseif ($mils != 0) {
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
         $mils = 0;
      }
      $neutro = true;
      $tex = $t . $tex;
   }
   $tex = $neg . substr($tex, 1) . $fin;
   //return ucfirst($tex);
   return $tex;
}
//Funcion para pasar de numeros a letras

function unidad($numuero){
	switch ($numuero)
	{
		case 9:
		{
			$numu = "NUEVE";
			break;
		}
		case 8:
		{
			$numu = "OCHO";
			break;
		}
		case 7:
		{
			$numu = "SIETE";
			break;
		}		
		case 6:
		{
			$numu = "SEIS";
			break;
		}		
		case 5:
		{
			$numu = "CINCO";
			break;
		}		
		case 4:
		{
			$numu = "CUATRO";
			break;
		}		
		case 3:
		{
			$numu = "TRES";
			break;
		}		
		case 2:
		{
			$numu = "DOS";
			break;
		}		
		case 1:
		{
			$numu = "UN";
			break;
		}		
		case 0:
		{
			$numu = "";
			break;
		}		
	}
	return $numu;	
}

function decena($numdero){
	
		if ($numdero >= 90 && $numdero <= 99)
		{
			$numd = "NOVENTA ";
			if ($numdero > 90)
				$numd = $numd."Y ".($this->unidad($numdero - 90));
		}
		else if ($numdero >= 80 && $numdero <= 89)
		{
			$numd = "OCHENTA ";
			if ($numdero > 80)
				$numd = $numd."Y ".($this->unidad($numdero - 80));
		}
		else if ($numdero >= 70 && $numdero <= 79)
		{
			$numd = "SETENTA ";
			if ($numdero > 70)
				$numd = $numd."Y ".($this->unidad($numdero - 70));
		}
		else if ($numdero >= 60 && $numdero <= 69)
		{
			$numd = "SESENTA ";
			if ($numdero > 60)
				$numd = $numd."Y ".($this->unidad($numdero - 60));
		}
		else if ($numdero >= 50 && $numdero <= 59)
		{
			$numd = "CINCUENTA ";
			if ($numdero > 50)
				$numd = $numd."Y ".($this->unidad($numdero - 50));
		}
		else if ($numdero >= 40 && $numdero <= 49)
		{
			$numd = "CUARENTA ";
			if ($numdero > 40)
				$numd = $numd."Y ".($this->unidad($numdero - 40));
		}
		else if ($numdero >= 30 && $numdero <= 39)
		{
			$numd = "TREINTA ";
			if ($numdero > 30)
				$numd = $numd."Y ".($this->unidad($numdero - 30));
		}
		else if ($numdero >= 20 && $numdero <= 29)
		{
			if ($numdero == 20)
				$numd = "VEINTE ";
			else
				$numd = "VEINTI".($this->unidad($numdero - 20));
		}
		else if ($numdero >= 10 && $numdero <= 19)
		{
			switch ($numdero){
			case 10:
			{
				$numd = "DIEZ ";
				break;
			}
			case 11:
			{		 		
				$numd = "ONCE ";
				break;
			}
			case 12:
			{
				$numd = "DOCE ";
				break;
			}
			case 13:
			{
				$numd = "TRECE ";
				break;
			}
			case 14:
			{
				$numd = "CATORCE ";
				break;
			}
			case 15:
			{
				$numd = "QUINCE ";
				break;
			}
			case 16:
			{
				$numd = "DIECISEIS ";
				break;
			}
			case 17:
			{
				$numd = "DIECISIETE ";
				break;
			}
			case 18:
			{
				$numd = "DIECIOCHO ";
				break;
			}
			case 19:
			{
				$numd = "DIECINUEVE ";
				break;
			}
			}	
		}
		else
			$numd = $this->unidad($numdero);
	return $numd;
}

	function centena($numc){
		if ($numc >= 100)
		{
			if ($numc >= 900 && $numc <= 999)
			{
				$numce = "NOVECIENTOS ";
				if ($numc > 900)
					$numce = $numce.($this->decena($numc - 900));
			}
			else if ($numc >= 800 && $numc <= 899)
			{
				$numce = "OCHOCIENTOS ";
				if ($numc > 800)
					$numce = $numce.($this->decena($numc - 800));
			}
			else if ($numc >= 700 && $numc <= 799)
			{
				$numce = "SETECIENTOS ";
				if ($numc > 700)
					$numce = $numce.($this->decena($numc - 700));
			}
			else if ($numc >= 600 && $numc <= 699)
			{
				$numce = "SEISCIENTOS ";
				if ($numc > 600)
					$numce = $numce.($this->decena($numc - 600));
			}
			else if ($numc >= 500 && $numc <= 599)
			{
				$numce = "QUINIENTOS ";
				if ($numc > 500)
					$numce = $numce.($this->decena($numc - 500));
			}
			else if ($numc >= 400 && $numc <= 499)
			{
				$numce = "CUATROCIENTOS ";
				if ($numc > 400)
					$numce = $numce.($this->decena($numc - 400));
			}
			else if ($numc >= 300 && $numc <= 399)
			{
				$numce = "TRESCIENTOS ";
				if ($numc > 300)
					$numce = $numce.($this->decena($numc - 300));
			}
			else if ($numc >= 200 && $numc <= 299)
			{
				$numce = "DOSCIENTOS ";
				if ($numc > 200)
					$numce = $numce.($this->decena($numc - 200));
			}
			else if ($numc >= 100 && $numc <= 199)
			{
				if ($numc == 100)
					$numce = "CIEN ";
				else
					$numce = "CIENTO ".($this->decena($numc - 100));
			}
		}
		else
			$numce = $this->decena($numc);
		
		return $numce;	
}

	function miles($nummero){
		if ($nummero >= 1000 && $nummero < 2000){
			$numm = "MIL ".($this->centena($nummero%1000));
		}
		if ($nummero >= 2000 && $nummero <10000){
			$numm = $this->unidad(Floor($nummero/1000))." MIL ".($this->centena($nummero%1000));
		}
		if ($nummero < 1000)
			$numm = $this->centena($nummero);
		
		return $numm;
	}

	function decmiles($numdmero){
		if ($numdmero == 10000)
			$numde = "DIEZ MIL";
		if ($numdmero > 10000 && $numdmero <20000){
			$numde = $this->decena(Floor($numdmero/1000))."MIL ".($this->centena($numdmero%1000));		
		}
		if ($numdmero >= 20000 && $numdmero <100000){
			$numde = $this->decena(Floor($numdmero/1000))." MIL ".($this->miles($numdmero%1000));		
		}		
		if ($numdmero < 10000)
			$numde = $this->miles($numdmero);
		
		return $numde;
	}		

	function cienmiles($numcmero){
		if ($numcmero == 100000)
			$num_letracm = "CIEN MIL";
		if ($numcmero >= 100000 && $numcmero <1000000){
			$num_letracm = $this->centena(Floor($numcmero/1000))." MIL ".($this->centena($numcmero%1000));		
		}
		if ($numcmero < 100000)
			$num_letracm = $this->decmiles($numcmero);
		return $num_letracm;
	}	
	
	function millon($nummiero){
		if ($nummiero >= 1000000 && $nummiero <2000000){
			$num_letramm = "UN MILLON ".($this->cienmiles($nummiero%1000000));
		}
		if ($nummiero >= 2000000 && $nummiero <10000000){
			$num_letramm = $this->unidad(Floor($nummiero/1000000))." MILLONES ".($this->cienmiles($nummiero%1000000));
		}
		if ($nummiero < 1000000)
			$num_letramm = $this->cienmiles($nummiero);
		
		return $num_letramm;
	}	

	function decmillon($numerodm){
		if ($numerodm == 10000000)
			$num_letradmm = "DIEZ MILLONES";
		if ($numerodm > 10000000 && $numerodm <20000000){
			$num_letradmm = $this->decena(Floor($numerodm/1000000))."MILLONES ".($this->cienmiles($numerodm%1000000));		
		}
		if ($numerodm >= 20000000 && $numerodm <100000000){
			$num_letradmm = $this->decena(Floor($numerodm/1000000))." MILLONES ".($this->millon($numerodm%1000000));		
		}
		if ($numerodm < 10000000)
			$num_letradmm = $this->millon($numerodm);
		
		return $num_letradmm;
	}

	function cienmillon($numcmeros){
		if ($numcmeros == 100000000)
			$num_letracms = "CIEN MILLONES";
		if ($numcmeros >= 100000000 && $numcmeros <1000000000){
			$num_letracms = $this->centena(Floor($numcmeros/1000000))." MILLONES ".($this->millon($numcmeros%1000000));		
		}
		if ($numcmeros < 100000000)
			$num_letracms = $this->decmillon($numcmeros);
		return $num_letracms;
	}	

	function milmillon($nummierod){
		if ($nummierod >= 1000000000 && $nummierod <2000000000){
			$num_letrammd = "MIL ".($this->cienmillon($nummierod%1000000000));
		}
		if ($nummierod >= 2000000000 && $nummierod <10000000000){
			$num_letrammd = $this->unidad(Floor($nummierod/1000000000))." MIL ".($this->cienmillon($nummierod%1000000000));
		}
		if ($nummierod < 1000000000)
			$num_letrammd = $this->cienmillon($nummierod);
		
		return $num_letrammd;
	}	
			
		
/*function convertir($numero){
		   $numf = $this->milmillon($numero);
		return $numf;
}*/
//############fin
}?>