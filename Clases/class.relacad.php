<?php
class relacad extends conec_BD
{
   var $cedu;
   var $cmate;   
   function relacad($ced,$mate)  /* Constructor */  
   {
	   $relac= new conec_BD();
	   $this->conexion=$relac->conectar_BD();
       	//$this->conexion=Conectarse();
		$this->cedu=$ced;
		$this->cmate=$mate;		
	}

  function buscar_relacad($ced,$mat)
	{
     //echo "<td><span class='Estilo2'>CEDULA = ".$ced."</span></td>";	  
	 $sql="SELECT asi_cod,det_nde,det_con FROM detins WHERE ci_est='$ced' and asi_cod='$mat' AND esp_id='$_SESSION[esp_id]' and pen_top='$_SESSION[pen_top]' and coh_id='$_SESSION[coh_id]' and mod_id='$_SESSION[mod_id]' and reg_id='$_SESSION[reg_id]' AND det_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
	   	if($n==0)
		{
/*          echo "<script>alert('NO CONSIGUIO RELACAD');</script>";*/
		  $cadena='FALSE';
		  //return $cadena;
		  return $n;
		 }
		 else
		 {	
		 	$cadena=$result;
		 	//return $cadena;
			return $n;
		 }		 
	}

  function buscar_detins($ced,$coh,$mod,$reg,$esp,$pac,$pen)
	{
     //echo "<td><span class='Estilo2'>CEDULA = ".$ced."</span></td>";	  	 	 	 		 
     //echo "<td><span class='Estilo2'>MATERIA = ".$mat."</span></td>";	
	 $sql="SELECT * FROM detins WHERE ci_est='$ced' AND pac_id='$pac' and esp_id='$esp' and pen_top='$pen' and coh_id='$coh' and mod_id='$mod' and reg_id='$reg' and det_sta=1";
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
	   	if($n==0)
		 {
           /*echo "<script>alert('NO CONSIGUIO DETINS');</script>";*/
		  $cadena='FALSE';
		 }
		 else
		  {
            /* echo "<script>alert('** SI CONSIGUIO DETINS **');</script>"; */
		 	$cadena=$result;
		  }
	  return $cadena;
	}

  function buscar_matricula($ced)
	{
     /* echo "<script>alert('buscar_matric --> Cedula: $ced');</script>"; */	
	 $sql="select * from matric where ci='$ced' and matr_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
	   	if($n==0)
		  $cadena='FALSE';
		else
		  $cadena=$result;
	 return $cadena;		 
	}

  function buscar_prelacion($mat)
	{
     //echo "<td><span class='Estilo2'>MATERIA = ".$mat."</span></td>";	 
	 $sql="SELECT asi_cod_req,req_cuc FROM requis WHERE asi_cod='$mat' and esp_id='$_SESSION[esp_id]' and pen_top='$_SESSION[pen_top]' and coh_id='$_SESSION[coh_id]' and mod_id='$_SESSION[mod_id]' and reg_id='$_SESSION[reg_id]' AND req_tip=1 AND req_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);

     /*   echo "<script>alert('n=$n Cmat= $mat')</script>";	 */

	   	if($n==0)
	     {
		  $cadena='FALSE';
		  return $cadena;
		 }
		 else
		 {	
		 	$cadena=$result;
		 	return $cadena;
		 }		 
	}

  function buscar_correquis($mat)
	{
     //echo "<td><span class='Estilo2'>MATERIA = ".$mat."</span></td>";	  	 	 	 		 	 
	 $sql="SELECT asi_cod_req FROM requis WHERE asi_cod='$mat' and esp_id='$_SESSION[esp_id]' and pen_top='$_SESSION[pen_top]' and coh_id='$_SESSION[coh_id]' and mod_id='$_SESSION[mod_id]' and reg_id='$_SESSION[reg_id]' AND req_tip=0 AND req_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
	   	if($n==0)
	     {
		  $cadena='FALSE';
		  return $cadena;
		 }
		 else
		 {	
		 	$cadena=$result;
		 	return $cadena;
		 }		 
	}


  function buscar_nota($ced,$mat)
	{
	 $sql="SELECT det_con FROM detins WHERE ci_est='$ced' and asi_cod='$mat' and esp_id='$_SESSION[esp_id]' and pen_top='$_SESSION[pen_top]' and coh_id='$_SESSION[coh_id]' and mod_id='$_SESSION[mod_id]' and reg_id='$_SESSION[reg_id]' and det_con=1 AND det_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
	   	if($n==0)
		{
		  $cadena='FALSE';
		  return $n;
		 }
		 else
		 {	
		 	$cadena=$result;
		 	return $cadena;
		 }		 
	}

  function borrar_oferta($ced)
	{
	 $sql="delete from ofertacad where cedula='$ced'"; 
	 $resul=mysql_query($sql,$this->conexion);
	}

  function ofertar_materia($ced,$mat)
	{
	 
	 $sql="INSERT INTO planestu SET CEDULA='$ced',CODMAT='$mat',STTINSC=1"; 
	 $resul=mysql_query($sql,$this->conexion);	 
	 /*if($resul)
      echo "<script>alert('Guardo: $mat');</script>";					  				 	 
	 else
      echo "<script>alert('No Pudo Guardar $mat');</script>";	*/
	}

  function guardar_oferta($ced,$mat)
	{
	 $sql="insert into ofertacad set cedula='$ced',codmat='$mat'"; 
	 $resul=mysql_query($sql,$this->conexion);
	}

 function buscar_oferta($ced)
	{
	 $sql="select * from ofertacad where cedula='$ced' order by codmat"; 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
	   	if($n==0)
	     {
         /* echo "<script>alert('Si consiguió la Oferta de: $ced');</script>"; */	
		 $cadena='FALSE';
		  return $cadena;
		 }
		 else
		 {	
		 	$cadena=$result;
		 	return $cadena;
		 }		 
	}

  function borrar_planestu($ced)
	{
	 $sql="delete from planestu where cedula='$ced'"; 
	 $resul=mysql_query($sql,$this->conexion);
	}


 function buscar_ofertacad($ced)
	{
	 $sql="select * from planestu INNER JOIN asigna ON planestu.codmat=asigna.asi_cod where cedula='$ced' and sttinsc='1' and asi_sta=1 group by asigna.asi_cod order by asigna.asi_cod,asigna.asi_mod asc"; 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
	   	if($n==0)
	     {
		  $cadena='FALSE';
		  return $cadena;
		 }
		 else
		 {	
		 	$cadena=$result;
		 	return $cadena;
		 }		 
	}

  function buscar_materia($mat,$esp)
	{
	 $sql="SELECT asi_nom,asi_mod,asi_cuc,asi_cba FROM asigna WHERE asi_cod='$mat' AND esp_id='$_SESSION[esp_id]' AND pen_top='$_SESSION[pen_top]' AND coh_id='$_SESSION[coh_id]' AND mod_id='$_SESSION[mod_id]' AND reg_id='$_SESSION[reg_id]' AND asi_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
	   	if($n==0)
		{
		  $cadena='FALSE';
		  return $n;
		 }
		 else
		 {	
		 	$cadena=$result;
		 	return $cadena;
		 }		 
	}

	function buscar_espec($espe)
	{
	//$sql="select ap1,ap2,no1,no2 from persona where ci='$ced'"; 
	$sql="select * from especi where esp_id='$espe' AND esp_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
	 $n=mysql_num_rows($result);
	   	if($n==0)
		{
		  $cadena='FALSE';
		 }
		 else
		 {
		    $cadena=$result;
		 }
		 return $cadena;
	}


	function buscar_estud($ced)
	{
/*	echo "<script>alert('$ced');</script>";*/
	//$sql="select ap1,ap2,no1,no2 from persona where ci='$ced'"; 
	$sql="select * from persona where ci='$ced' and sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
//     $row=mysql_fetch_array($result); 
	 $n=mysql_num_rows($result);
	   	if($n==0)
		{
		  $cadena='FALSE';
		 }
		 else
		 {
		    $cadena=$result;
		 }
		 return $cadena;
	}

 function buscar_cuc($ced)
 {
     $tuc=0;
	 $sql="select asi_cod,det_con from detins where ci_est='$ced' and esp_id='$_SESSION[esp_id]' and pen_top='$_SESSION[pen_top]' and coh_id='$_SESSION[coh_id]' and mod_id='$_SESSION[mod_id]' and reg_id='$_SESSION[reg_id]' AND det_sta=1 order by asi_cod"; 
	 $resul=mysql_query($sql,$this->conexion);
 	while ($row=mysql_fetch_array($resul))
	  {
       /* echo "<script>alert('Consiguió Detins: $ced');</script>";	*/  
	   $codi=$row['asi_cod'];
	   $cond=$row['det_con'];	   	   
       $n=mysql_num_rows($resul);
	   if($n!=0)
	   if($cond==1)
	    {
        /* echo "<script>alert('Asignatura Aprobada: $codi');</script>";	 */ 		
	    $sql="SELECT asi_cuc FROM asigna WHERE asi_cod='$codi' AND asi_sta=1 AND esp_id='$_SESSION[esp_id]' AND pen_top='$_SESSION[pen_top]' AND coh_id='$_SESSION[coh_id]' AND mod_id='$_SESSION[mod_id]' AND reg_id='$_SESSION[reg_id]'"; 
	    $result=mysql_query($sql,$this->conexion);
	    $row2=mysql_fetch_array($result); 	 
        /* echo "<script>alert('U.C.: $row2[0]');</script>";	  				*/
        $n=mysql_num_rows($result);
	    if($n>0)
      	  $tuc=$tuc+$row2[0];		   
		}
	   }	
	return $tuc;		   	   
 }
function buscar_infraestructura($inf_id){
  $sql="SELECT inf_nom FROM infrae WHERE inf_id='$inf_id'";
  $result=mysql_query($sql,$this->conexion);
  return $result;
}

  function buscar_seccion($sec,$rep,$asicba)
	{
/*     echo "<script>alert('Buscar_Seccion: $sec');</script>";*/
     $inf_id=0;	 
	 if($asicba==1)
	  {
		if($rep==1)
		   $inf_id=3;
		if($rep==2)
		   $inf_id=5;
	  }	   
	 if($inf_id==0)
    	 $sql="SELECT sec_nom,inf_id FROM seccio WHERE sec_id='$sec' AND sec_sta=1"; 
	 else	 
    	 $sql="SELECT sec_nom,inf_id FROM seccio WHERE sec_id='$sec' AND inf_id='$inf_id' AND sec_sta=1"; 	 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
	   	if($n==0)
		{
		  $cadena='FALSE';
          /*echo "<script>alert('NO LA CONSIGUIO Seccion: $sec');</script>";		  */
		  return $n;
		 }
		 else
		 {	
            /*echo "<script>alert('SII LA CONSIGUIO Seccion: $sec');</script>";	*/	  
		 	$cadena=$result;
		 	return $cadena;
		 }		 
	}

  function Buscar_Secciones($mat,$sede)
	{	
	 $cadena='FALSE';
	 $sqls="select * from asigna_seccio where asi_cod='$mat' AND ase_sta=1 AND pac_id='$_SESSION[pac_id]' AND esp_id='$_SESSION[esp_id]' AND pen_top='$_SESSION[pen_top]' AND coh_id='$_SESSION[coh_id]' AND mod_id='$_SESSION[mod_id]' AND reg_id='$_SESSION[reg_id]' order by sec_id";	        	  	 
	 $results=mysql_query($sqls,$this->conexion);	 
	 
	 while ($rows = mysql_fetch_array($results))				
      {
	  	 $sec_id=$rows['sec_id'];	 

		 $seccion= $this->buscar_seccion($sec_id);				   					 			  
	     $rsec = mysql_fetch_array($seccion);
		 $infr = $rsec['inf_id'];
	 
		 /*echo "<script>alert('Infr: $infr  --  Sede: $sede');</script>";	*/  		  			  			   	 
		
		 if($infr==$sede)
		   {
		   $sql="select A.*,B.* from asigna_seccio A,seccio B WHERE (A.asi_cod='$mat' AND B.inf_id='$infr' AND A.sec_id=B.sec_id AND A.pac_id='$_SESSION[pac_id]' AND A.mod_id='$_SESSION[mod_id]' AND A.reg_id='$_SESSION[reg_id]' AND A.esp_id='$_SESSION[esp_id]' AND A.pen_top='$_SESSION[pen_top]' AND A.coh_id='$_SESSION[coh_id]' AND A.ase_sta=1 AND B.sec_sta=1) order by A.sec_id";	   
	 	 	$result=mysql_query($sql,$this->conexion);
	     	$n=mysql_num_rows($result);
			if($n>0)
			   {
				 /*echo "<script>alert('Si: consulta');</script>";	 */ 		  			  
		  	     return $result;				 
			   }
//	   $cadena="select * from asigna_seccio INNER JOIN seccio ON asigna_seccio.sec_id=seccio.sec_id where seccio.inf_id='$infr' AND asigna_seccio.asi_cod='$mat' AND asigna_seccio.pac_id='$_SESSION[pac_id]' AND asigna_seccio.esp_id='$_SESSION[esp_id]' AND asigna_seccio.pen_top='$_SESSION[pen_top]' AND asigna_seccio.coh_id='$_SESSION[coh_id]' AND asigna_seccio.mod_id='$_SESSION[mod_id]' AND asigna_seccio.reg_id='$_SESSION[reg_id]' order by asigna_seccio.sec_id";
		   }  
	  } 	 
	 //$rows = mysql_fetch_array($results);	 
  	 return $cadena;
  }

  function Tiene_Seccion($mat,$sede)
	{
	if(empty($sede))
	 {
	 $sql="SELECT sec_id,ase_cma FROM asigna_seccio WHERE asi_cod='$mat' AND pac_id='$_SESSION[pac_id]' AND esp_id='$_SESSION[esp_id]' AND pen_top='$_SESSION[pen_top]' AND coh_id='$_SESSION[coh_id]' AND mod_id='$_SESSION[mod_id]' AND reg_id='$_SESSION[reg_id]' AND ase_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
     $cadena='FALSE'; 
	   	if($n==0)
		  return $cadena;
		 else
		 {	
      	    while ($row=mysql_fetch_array($result)) 		 
			{
		    $sec=$row[0];  		    $cupo=$row[1];
			$cantid=$this->contar_inscritos($mat,$sec,$_SESSION[esp_id],$_SESSION[reg_id],$_SESSION[mod_id],$_SESSION[coh_id],$_SESSION[pac_id]); 
/*            echo "<script>alert('MATERIA: $mat -- SECCION: $sec --  CUPO: $cupo -- INSCRITOS: $cantid');</script>";*/
			if($cantid < $cupo)			
		 	   $cadena=$sec;
			}
		 }		 
	  }	 
	 else
	  {
    /* echo "<script>alert('Buscar_Seccion: $mat -- PAC_ID: $_SESSION[pac_id] -- ESP_ID: $_SESSION[esp_id] -- PEN_TOP: $_SESSION[pen_top]');</script>";   */
	 $sql="SELECT sec_id,ase_cma FROM asigna_seccio WHERE asi_cod='$mat' AND pac_id='$_SESSION[pac_id]' AND esp_id='$_SESSION[esp_id]' AND pen_top='$_SESSION[pen_top]' AND coh_id='$_SESSION[coh_id]' AND mod_id='$_SESSION[mod_id]' AND reg_id='$_SESSION[reg_id]' AND ase_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
     $cadena='FALSE';	 
	   	if($n==0)
		  return $cadena;
		 else
		 {	
      	    while ($row=mysql_fetch_array($result)) 		 
			{
  		     $sec=$row[0];  		    $cupo=$row[1];
  	   		 $seccion= $this->buscar_seccion($sec);				   					 			  			
    		 $rsec = mysql_fetch_array($seccion);			 
			 if($rsec['inf_id']==$sede)
			 {

             /* echo "<script>alert('SI TIENE SECCION: $mat');</script>";  */
 			$cantid=$this->contar_inscritos($mat,$sec,$_SESSION[esp_id],$_SESSION[reg_id],$_SESSION[mod_id],$_SESSION[coh_id],$_SESSION[pac_id]); 
             /*echo "<script>alert('MATERIA: $mat -- SECCION: $sec --  CUPO: $cupo -- INSCRITOS: $cantid');</script>";  */
 			 if($cantid < $cupo)			
		 	    $cadena=$sec;
			  } //fin del if
			} // fin del While
		 } // Fin del if($m==0)		 
	 
	  } 
 	 return $cadena;		 
	}

function contar_inscritos($mat,$sec,$esp,$reg,$mod,$coh,$pac)
	{
    $matofer=$this->buscar_materia($mat,$esp);
 	$rowm = mysql_fetch_array($matofer);	
	$asicba=$rowm['asi_cba'];	
	if($asicba==1){
	  if($reg==3){  // Si la Materia es de Ciclo Básico
/*echo "<script>alert('CONTAR INSCRITOS SELECT count(ci_est) FROM detins WHERE asi_cod=$mat AND sec_id=$sec AND esp_id IN(2113D,2126D,2122D) AND reg_id=$reg AND mod_id=$mod AND coh_id=$coh AND pac_id=$pac AND det_sta=1');</script>";	  */
		$sql="SELECT count(ci_est) FROM detins WHERE asi_cod='$mat' AND sec_id='$sec' AND esp_id IN('2113D','2126D','2122D') AND reg_id='$reg' AND mod_id='$mod' AND coh_id='$coh' AND pac_id='$pac' AND det_sta=1"; 	  // Este no tiene esp_id='$esp'
	  }
	  else{
/*echo "<script>alert('CONTAR INSCRITOS SELECT count(ci_est) FROM detins WHERE asi_cod=$mat AND sec_id=$sec AND esp_id IN(2113N,2126N,2122N) AND reg_id=$reg AND mod_id=$mod AND coh_id=$coh AND pac_id=$pac AND det_sta=1');</script>";	  */
		$sql="SELECT count(ci_est) FROM detins WHERE asi_cod='$mat' AND sec_id='$sec' AND esp_id IN('2113N','2126N','2122N') AND reg_id='$reg' AND mod_id='$mod' AND coh_id='$coh' AND pac_id='$pac' AND det_sta=1"; 	  // Este no tiene esp_id='$esp
	  }
	}
	else{
/*echo "<script>alert('CONTAR INSCRITOS SELECT count(ci_est) FROM detins WHERE asi_cod=$mat AND sec_id=$sec AND esp_id=$esp AND reg_id=$reg AND mod_id=$mod AND coh_id=$coh AND pac_id=$pac AND det_sta=1');</script>";	  */
	  $sql="SELECT count(ci_est) FROM detins WHERE asi_cod='$mat' AND sec_id='$sec' AND esp_id='$esp' AND reg_id='$reg' AND mod_id='$mod' AND coh_id='$coh' AND pac_id='$pac' AND det_sta=1"; 
	}
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
     $n=mysql_num_rows($result);
	  if($n==0)
		{
		  $cadena='0';
		   return $cadena;
		 }
	   else
		   return $row[0];
	}

  function buscar_cupomax($sec,$mat,$esp,$mod,$reg,$coh,$pac)
	{
	 $sql="SELECT ase_cma,pac_id FROM asigna_seccio WHERE sec_id='$sec' AND asi_cod='$mat' AND esp_id='$esp' AND mod_id='$mod' AND reg_id='$reg' AND coh_id='$coh' AND pac_id='$pac' AND ase_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
	   	if($n==0)
		{
		  $cadena='FALSE';
		  return $n;
		 }
		 else
		 {	
		 	$cadena=$result;
		 	return $cadena;
		 }		 
	}
function buscar_periodo($pac)
	{
	 $sql="SELECT pac_id,pac_nom,pac_fin,pac_ffin FROM pacade WHERE pac_id='$pac' AND pac_sta=1"; 
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
//******************************************************************  
function buscar_PeriodoActivo()
	{
	// $sql="SELECT * FROM pacade WHERE pac_sta=1"; 
	 $sql="SELECT * FROM pacade WHERE pac_id='$_SESSION[pac_id]' AND pac_sta=1"; 
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


function buscar_regimen($reg)
	{
	 $sql="SELECT reg_nom FROM regimen WHERE reg_id='$reg' AND reg_sta=1"; 
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

function buscar_cohorte($coh)
	{
	 $sql="SELECT coh_nom FROM cohort WHERE coh_id='$coh' AND coh_sta=1"; 
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

function buscar_modalidad($mod)
	{
	 $sql="SELECT mod_nom FROM modali WHERE mod_id='$mod' and mod_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
 	 $rowm = mysql_fetch_array($result);		 
     $n=mysql_num_rows($result);
	  if($n==0)
		{
		  $cadena='FALSE';
		  return $cadena;
		 }
		 else
		 {		
		 return $rowm[0];
		}		 
	}


  function buscar_maxuc($esp,$reg,$mod)
	{
//	 $sql="SELECT rem_muc FROM reg_esp_mod WHERE esp_id='$esp' AND reg_id='$reg' AND mod_id='$mod'"; 
	 $sql="SELECT pen_muc FROM pensum WHERE esp_id='$esp' AND reg_id='$reg' AND mod_id='$mod' AND pen_top='$_SESSION[pen_top]' AND pen_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
     $n=mysql_num_rows($result);
	   	if($n==0)
		{
		  $cadena='FALSE';
		  return $n;
		 }
		 else
		 {	
		 	$cadena=$result;
		 	return $cadena;
		 }		 
	}

	
function total_inscritos()
	{
	 $sql="SELECT count(ci_est) FROM detins WHERE det_sta=1"; 
	 $result=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($result); 
     $n=mysql_num_rows($result);
	  if($n==0)
		{
		  $cadena='0';
		  return $cadena;
		 }
		 else
		 {		
		 return $row[0];
		}		 
	}

 function Ultimo_Inscrito()
	{
	 $sql="select det_id from detins WHERE det_sta=1"; 
	 $resul=mysql_query($sql,$this->conexion);
	 $ultimoReg=mysql_last_insert_id($resul);
	 $row=mysql_fetch_array($ultimoReg); 	 
	 $ulti=$row[0]; 
/*     echo "<script>alert('Ultimo: $ulti');</script>";	 */
	 return $row[0]; 
	}	
	
 function buscar_infra($sec_id,$rep,$asicba)
 {
	 $sql="select inf_id from seccio where sec_id='$sec_id' AND sec_sta=1"; 
	 $resul=mysql_query($sql,$this->conexion);
	 $row=mysql_fetch_array($resul); 	 
     $n=mysql_num_rows($resul);
	 if($n==0)
		{
		 $cadena='';
		 return $cadena;
	    }
	 else
	    {
		$inf_id=$row[0];
		if($asicba==1)
		 {
		  if($rep==1)
		     $inf_id=3;
		  if($rep==2)
		     $inf_id=5;
		 }

  	    $sql="select inf_nom from infrae where inf_id='$inf_id' AND inf_sta=1"; 
	    $resul=mysql_query($sql,$this->conexion);
	    $row2=mysql_fetch_array($resul); 	 
        $n=mysql_num_rows($resul);
	    if($n==0)
		  $cadena='';
		else 
   		   $cadena=$row2[0];
  	    return $cadena;		   
		}
 }
 	

 function inscribirmateria($ins,$ced,$obs,$nsec,$id,$esp,$reg,$mod,$coh,$pac,$pen)
	{
	 //$fecha=date("d/m/Y");
	 $dias=time();
	 $fecha=date("Y-m-d H:i:s",$dias);
	 /* Esto hay que cambiarlo porque Inscri es Maestro ----**** */
	 //$sql="insert into inscri set ins_id='$ins',ins_fej='$fecha'"; 
	 //$resul=mysql_query($sql,$this->conexion);
      /*echo "<script>alert('Inscribir: DET_ID=$deti -- INS_ID= $ins -- CI_EST= $ced -- OBS_ID= $obs -- SEC_ID=$nsec -- ASI_COD= $id -- ESP_ID= $esp -- REG_ID= $reg -- MOD_ID=$mod -- COH_ID=$coh -- PAC_ID= $pac -- PEN_TOP= $pen');</script>";  */
/*echo "<script>alert('insert into detins set ins_id=$ins,ci_est=$ced,obs_id=$obs,sec_id=$nsec, asi_cod=$id,esp_id=$esp, reg_id=$reg, mod_id=$mod,coh_id=$coh,pac_id=$pac, pen_top=$pen, det_fin=$fecha, det_sta=1');</script>";*/
	 $sql="insert into detins set ins_id='$ins',ci_est='$ced',obs_id='$obs',sec_id='$nsec', asi_cod='$id',esp_id='$esp', reg_id='$reg', mod_id='$mod',coh_id='$coh',pac_id='$pac', pen_top='$pen', det_fin='$fecha', det_sta=1"; 
	 $resul=mysql_query($sql,$this->conexion);
	 /*if($resul=mysql_query($sql,$this->conexion))
	     echo "<script>alert('INSCRIBIO LA MATERIA');</script>"; 
	 else
 	     echo "<script>alert('NO PUDO INSCRIBIR LA MATERIA');</script>";	*/
	}	
	
 function Repit_RJV($ced,$mat)
 {
 $cadena='FALSE';
 if(($_SESSION['coh_id']=='05' || $_SESSION['coh_id']=='09') && (($mat=='QUF-23025') || ($mat=='MAT-21235') || ($mat=='SYC-22112') || ($mat=='MAT-21413') || ($mat=='MAT-20714'))) 
 {
   $sql="SELECT asi_cod,det_nde FROM detins WHERE esp_id='$_SESSION[esp_id]' and pen_top='$_SESSION[pen_top]' and coh_id='$_SESSION[coh_id]' and mod_id='$_SESSION[mod_id]' and reg_id='$_SESSION[reg_id]' AND ci_est='$ced' and det_sta=1 and asi_cod='$mat' and det_con!=1"; //Si le aparece Reprobada..
   $result=mysql_query($sql,$this->conexion);
   $n=mysql_num_rows($result);
   if($n>0)
	   {
		 $sql2="SELECT asi_cod,det_nde FROM detins WHERE esp_id='$_SESSION[esp_id]' and pen_top='$_SESSION[pen_top]' and coh_id='$_SESSION[coh_id]' and mod_id='$_SESSION[mod_id]' and reg_id='$_SESSION[reg_id]' AND ci_est='$ced' and det_sta=1 and asi_cod='$mat' and det_con=1"; //Si le aparece Aprobada..
		 $result2=mysql_query($sql2,$this->conexion);
		 $n2=mysql_num_rows($result2);
         if($n2==0)
		    $cadena='TRUE';		 
	   } 
 }
 return $cadena;
 }	

 function Repit_Cordero($ced,$mat)
 {
 $cadena='FALSE';
 if(($_SESSION['coh_id']=='11') && (($mat=='MAT-21215') || ($mat=='MAT-21524'))) 
  {
   $sql="SELECT asi_cod,det_nde FROM detins WHERE ci_est='$ced' and det_sta=1 and asi_cod='$mat' and det_con!=1"; //Si le aparece Reprobada..
   $result=mysql_query($sql,$this->conexion);
   $n=mysql_num_rows($result);
   if($n>0)
	   {
		 $sql2="SELECT asi_cod,det_nde FROM detins WHERE ci_est='$ced' and det_sta=1 and asi_cod='$mat' and det_con=1"; //Si le aparece Aprobada..
		 $result2=mysql_query($sql2,$this->conexion);
		 $n2=mysql_num_rows($result2);
         if($n2==0)
		    $cadena='TRUE';		 
	   } 
  }
  return $cadena;
 }	

}// fin de la clase
?>