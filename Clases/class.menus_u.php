<?php
class menus extends conec_BD
{
  var $resultado='';
  var $bandera='';
  var $left='';
//******************************************************************
  function menus($resultado,$bandera,$left){
    $this->resultado=$resultado;
    $this->bandera=$bandera;
    $this->left=$left;
    $this->posicion=$posicion;
  }
//******************************************************************
  function sesion($id,$nom){
	$_SESSION['nuc_id']=$id;
	$_SESSION['nuc_nom']=$nom;
  }
//******************************************************************
  function menu_home(){
    $Bord_left=$this->left+80;
    $Centro=$Bord_left+4;
    $Bord_rigt=$Centro+62;
    $this->resultado="
      <td width=\"4px\" height=\"25px\"><div id=\"Layer13\" style=\"position:absolute; width:4px; height:20px; z-index:13; top: 0px; left:".$Bord_left."px;\" class=\"divDentroBorder_Izq\"></div></td>
      <td width=\"62px\" height=\"25px\"><div id=\"Layer1\" style=\"position:absolute; width:62px; height:20px; z-index:1; top: 0px; left:".$Centro."px;\" class=\"div1Dentro\" onMouseOver=\"CambiarFondo('Layer1','Layer13','Layer14','1','1')\" onMouseOut=\"CambiarFondo('Layer1','Layer13','Layer14','0','1')\" onClick=\"Pantalla_Inicial()\">
        <div align=\"center\"><strong><img src=\"../Imagenes/collapse-paw.gif\" width=\"18\" height=\"18\" align=\"absbottom\">Home</strong></div>
      </div></td>
      <td width=\"4px\" height=\"25px\"><div id=\"Layer14\" style=\"position:absolute; width:4px; height:20px; z-index:14; top: 0px; left:".$Bord_rigt."px;\" class=\"divDentroBorder_Der\"></div></td>";
    $this->left=$Bord_rigt+4;
    return $this->resultado;
  }
//******************************************************************
  function menu_estudiante(){
    $Bord_left=$this->left;
    $Centro=$Bord_left+4;
    $Bord_rigt=$Centro+108;
	$top=0;
	$idper=$_SESSION[idper];
	 $dias=time();
      $bandact=0;
//    $HORA=date("H:i:s",$dias);
	$FECHA=date("Y-m-d H:i:s",$dias);//"2012-03-05 12:00:00";//
	$ci=$_SESSION['ci'];// '18189380'
/*echo "<script>alert('ENTRE 2 SELECT A.pac_id AS pac_id, A.pac_nom AS pac_nom, A.pac_int AS pac_int, B.ins_nom AS ins_nom FROM pacade A, inscri B WHERE B.ins_sta=1 AND DATEDIFF($FECHA,A.pac_fin)>=0 AND DATEDIFF(A.pac_ffin,$FECHA)>=0 AND A.pac_id=B.pac_id AND A.pac_sta=1 ORDER BY A.pac_fin DESC');</script>";*/
    $resp_pac=$this->OperacionCualquiera("SELECT A.pac_id AS 'pac_id', A.pac_nom AS 'pac_nom', A.pac_int AS 'pac_int', B.ins_nom AS 'ins_nom' FROM pacade A, inscri B WHERE B.ins_sta='1' AND TIMEDIFF('$FECHA',B.ins_fin)>=0 AND TIMEDIFF(B.ins_ffi,'$FECHA')>=0 AND A.pac_id=B.pac_id AND A.pac_sta='1'");
	$PAC=$this->ConsultarCualquiera($resp_pac);
	if($PAC->pac_id!=""){
/*echo "<script>alert('ENTRE');</script>";*/
      $resp_det=$this->OperacionCualquiera("SELECT DISTINCT(ci_est) AS ci_est, pac_id FROM detins WHERE pac_id='$PAC->pac_id' AND det_sta='1' AND ci_est='$ci'");
	  $DET=$this->ConsultarCualquiera($resp_det);
	  $pac_id=$PAC->pac_id;
	  $pac_nom=ucwords($PAC->pac_nom);
	  $pac_nom=ucwords(strtolower($pac_nom));
	  $pac_int=$PAC->pac_int;
	}
	else{
/*echo "<script>alert('ENTRE 2 SELECT A.pac_id AS pac_id, A.pac_nom AS pac_nom, A.pac_int AS pac_int, B.ins_nom AS ins_nom FROM pacade A, inscri B WHERE B.ins_sta=1 AND DATEDIFF($FECHA,A.pac_fin)>=0 AND DATEDIFF(A.pac_ffin,$FECHA)>=0 AND A.pac_id=B.pac_id AND A.pac_sta=1 ORDER BY A.pac_fin DESC');</script>";*/
      $resp_pac_O=$this->OperacionCualquiera("SELECT A.pac_id AS 'pac_id', A.pac_nom AS 'pac_nom', A.pac_int AS 'pac_int', B.ins_nom AS 'ins_nom' FROM pacade A, inscri B WHERE B.ins_sta='1' AND TIMEDIFF('$FECHA',A.pac_fi1)>=0 AND TIMEDIFF(A.pac_ff3,'$FECHA')>=0 AND A.pac_id=B.pac_id AND A.pac_sta='1' ORDER BY A.pac_fin ASC");
	  $PAC_O=$this->ConsultarCualquiera($resp_pac_O);
	  $resp_det=$this->OperacionCualquiera("SELECT DISTINCT(ci_est) AS ci_est, pac_id FROM detins WHERE pac_id='$PAC_O->pac_id' AND det_sta='1' AND ci_est='$ci'");
	  $DET=$this->ConsultarCualquiera($resp_det);
	  $pac_id=$PAC_O->pac_id;
	  $pac_nom=ucwords($PAC_O->pac_nom);
	  $pac_nom=ucwords(strtolower($pac_nom));
	  $pac_int=$PAC_O->pac_int;
	}
	if($pac_int==1){
    $pac_nom=explode("-",$pac_nom);
	}
	else{
	$pac_nom=explode("*",$pac_nom);
	}
/*echo "<script>alert('semestre: $pac_nom[0], $pac_int==1 && $DET->ci_est==');</script>";*/
    $res=$this->OperacionCualquiera("SELECT * FROM tab_ope WHERE per_id='$idper' AND tab_ope_sta='1'");
	while($array=$this->ConsultarCualquiera($res)){
	  if($array->tab_id=='27' && ($array->ope_id=='2' || $array->ope_id=='3') && ($PAC->pac_id!="")){// && ($ci=='23547088' || $ci=='19541259' || $ci=='19541259' || $ci=='08332549' || $ci=='20899390' || $ci=='20367999' || $ci=='19541667')){// && ($ci=='19541667' || $ci=='23547088' || $ci=='19541259' || $ci=='08332549'  || $ci=='20899390'  || $ci=='20423818' || $ci=='20367999' || $ci=='19541667')){//){
	     if($pac_int=="1" && $DET->ci_est==''){ /*echo "<script>alert('bandInsI=$bandInsI');</script>";*/ $bandInsI=1; }else{ if($DET->ci_est=="") $bandIns=1;}
	  }
	  if($array->tab_id=='36' && ($array->ope_id=='1' || $array->ope_id=='2'  || $array->ope_id=='6'  || $array->ope_id=='7')){ // || $ci=='23547088' || $ci=='21179293' || $ci=='19541259' || $ci=='5643957'  || $ci=='20899390'  || $ci=='20423818')){ //
	    if($DET->ci_est!=""){ $bandpins=1; $bandcones=1; $_SESSION[pac_id]=$pac_id;} $bandconot=1; $bandconcal=1; $bandracad=1;
	  }
	}
/*	echo "<script>alert('bandInsI=$bandInsI -- bandpins=$bandpins');</script>";*/
    $this->resultado="
      <td width=\"4px\" height=\"25px\"><div id=\"Layer21\" style=\"position:absolute; width:4px; height:20px; z-index:21; top: 0px; left:".$Bord_left."px;\" class=\"divDentroBorder_Izq\"></div></td>
      <td width=\"108px\" height=\"25px\"><div id=\"Layer2\" style=\"position:absolute; width:108px; height:20px; z-index:2; top: 0px; left:".$Centro."px;\" class=\"div1Dentro\" onMouseOver=\"CambiarFondo('Layer2','Layer21','Layer22','1','1')\" onMouseOut=\"CambiarFondo('Layer2','Layer21','Layer22','0','1')\" onClick=\"MostrarOcultar_SubMen('Layer23','1','imagestudiante')\">
        <div align=\"center\"><strong><img src=\"../Imagenes/estudiante.png\" width=\"18\" height=\"18\" align=\"absbottom\">Estudiante <img id=\"imagestudiante\" src=\"../Imagenes/arr_black_right.gif\" width=\"7\" height=\"7\"></strong></div>
        <div id=\"Layer23\" style=\"position:absolute; width:150px; height:200px; z-index:23; border: 1px none #000000; visibility: hidden;\" onMouseMove=\"MostrarOcultar_SubMen('Layer23','1','imagestudiante')\" onMouseOut=\"MostrarOcultar_SubMen('Layer23','0','imagestudiante')\">
          <table width=\"150px\" height=\"200px\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
        if($bandact==1){ //ACTUALIZACIÓN
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordest_izq211\" style=\"position:absolute; width:4px; height:15px; z-index:211; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Estudiante211\" style=\"position:absolute; z-index:211; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Estudiante211','bordest_izq211','bordest_der211','1','0')\" onMouseOut=\"CambiarFondo('Estudiante211','bordest_izq211','bordest_der211','0','0')\" onClick=\"Opciones_SubMen('../Persona/actualizar.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Actualizaci&oacute;n de Datos</span></div><div id=\"bordest_der211\" style=\"position:absolute; width:4px; height:15px; z-index:211; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
        if($bandconcal==1){ //CONSTANCIA DE CALIFICACIÓN
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordest_izq212\" style=\"position:absolute; width:4px; height:15px; z-index:212; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Estudiante212\" style=\"position:absolute; z-index:212; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Estudiante212','bordest_izq212','bordest_der212','1','0')\" onMouseOut=\"CambiarFondo('Estudiante212','bordest_izq212','bordest_der212','0','0')\" onClick=\"Opciones_SubMen('../Estudiante/ConstanciaCalificacion.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Constancia de Calif.</span></div><div id=\"bordest_der212\" style=\"position:absolute; width:4px; height:15px; z-index:212; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
        if($bandcones==1){ //CONSTANCIA DE ESTUDIO
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordest_izq213\" style=\"position:absolute; width:4px; height:15px; z-index:213; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Estudiante213\" style=\"position:absolute; z-index:213; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Estudiante213','bordest_izq213','bordest_der213','1','0')\" onMouseOut=\"CambiarFondo('Estudiante213','bordest_izq213','bordest_der213','0','0')\" onClick=\"Opciones_SubMen('../Estudiante/ConstanciaEstudio.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Constancia de Estudio</span></div><div id=\"bordest_der213\" style=\"position:absolute; width:4px; height:15px; z-index:213; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
        if($bandconot==1){ //CONSULTA DE NOTAS
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordest_izq214\" style=\"position:absolute; width:4px; height:15px; z-index:214; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Estudiante214\" style=\"position:absolute; z-index:214; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Estudiante214','bordest_izq214','bordest_der214','1','0')\" onMouseOut=\"CambiarFondo('Estudiante214','bordest_izq214','bordest_der214','0','0')\" onClick=\"Opciones_SubMen('../Estudiante/ConsultaNota.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Consulta de Notas</span></div><div id=\"bordest_der214\" style=\"position:absolute; width:4px; height:15px; z-index:214; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
		if($bandInsI==1){ //Inscripcion Intensivo
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordest_izq215\" style=\"position:absolute; width:4px; height:15px; z-index:215; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Estudiante215\" style=\"position:absolute; z-index:215; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Estudiante215','bordest_izq215','bordest_der215','1','0')\" onMouseOut=\"CambiarFondo('Estudiante215','bordest_izq215','bordest_der215','0','0')\" onClick=\"Opciones_SubMen('../Estudiante/Intensivo.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Inscripción Intensivo</span></div><div id=\"bordest_der215\" style=\"position:absolute; width:4px; height:15px; z-index:215; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
		if($bandIns==1){ //Inscripcion
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordest_izq216\" style=\"position:absolute; width:4px; height:15px; z-index:216; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Estudiante216\" style=\"position:absolute; z-index:216; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Estudiante216','bordest_izq216','bordest_der216','1','0')\" onMouseOut=\"CambiarFondo('Estudiante216','bordest_izq216','bordest_der216','0','0')\" onClick=\"Opciones_SubMen('../Estudiante/Inscripcion.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Inscripción ".$pac_nom[0]."</span></div><div id=\"bordest_der216\" style=\"position:absolute; width:4px; height:15px; z-index:216; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }	
        if($bandpins==1){ //Ficha de Inscripcion
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordest_izq217\" style=\"position:absolute; width:4px; height:15px; z-index:217; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Estudiante217\" style=\"position:absolute; z-index:217; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Estudiante217','bordest_izq217','bordest_der217','1','0')\" onMouseOut=\"CambiarFondo('Estudiante217','bordest_izq217','bordest_der217','0','0')\" onClick=\"Opciones_SubMen('../Estudiante/InscripcionFicha.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Ficha de Inscripci&oacute;n</span></div><div id=\"bordest_der217\" style=\"position:absolute; width:4px; height:15px; z-index:217; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }  
	    if($bandracad==1)//Record Academico
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordest_izq218\" style=\"position:absolute; width:4px; height:15px; z-index:218; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Estudiante218\" style=\"position:absolute; z-index:218; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Estudiante218','bordest_izq218','bordest_der218','1','0')\" onMouseOut=\"CambiarFondo('Estudiante218','bordest_izq218','bordest_der218','0','0')\" onClick=\"Opciones_SubMen('../Estudiante/ConstanciaRecordAcademico_Est.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Record Acad&eacute;mico Cons</span></div><div id=\"bordcord_der218\" style=\"position:absolute; width:4px; height:15px; z-index:218; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		$this->resultado=$this->resultado."</table>
        </div>
      </div></td>
      <td width=\"4px\" height=\"25px\"><div id=\"Layer22\" style=\"position:absolute; width:4px; height:20px; z-index:22; top: 0px; left:".$Bord_rigt."px;\" class=\"divDentroBorder_Der\"></div></td>";
    $this->left=$Bord_rigt+4;
    return $this->resultado;
  }
//******************************************************************
  function menu_docente(){
    $Bord_left=$this->left;
    $Centro=$Bord_left+4;
    $Bord_rigt=$Centro+90;
    $bandact=0;
	$top=$bandcom=$bandidi=$bandetn=$banddep=$bandinc=$bandbec=$bandins=$bandcar=$banddepa=$bandtip=$bandsec=$bandreg=$bandcoh=$bandespe=$bandmod=$bandniv=$bandinf=$bandnuc=$bandpro=$bandperso=$bandusu=$bandperf=$bandobs=$bandpai=$bandesta=$bandmuni=$bandciud=0;
	$idper=$_SESSION[idper];
	$banddispon=0;
    $res=$this->OperacionCualquiera("SELECT * FROM tab_ope WHERE per_id='$idper' AND tab_ope_sta='1'");
	while($array=$this->ConsultarCualquiera($res)){
	  if($array->tab_id=='36' && ($idper=='1' || $idper=='3') && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $banddetins=1;
	  if($array->tab_id=='59' && ($idper=='1' || $idper=='3') && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandinas=1;
	  if($array->tab_id=='41' && ($idper=='1' || $idper=='3') && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandasignaseccio=1;
/*	  if($array->tab_id=='74' && ($idper=='1' || $idper=='3') && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $banddispon=1;*/
	}
    $this->resultado="
      <td width=\"4px\" height=\"25px\"><div id=\"Layer31\" style=\"position:absolute; width:4px; height:20px; z-index:31; top: 0px; left:".$Bord_left."px;\" class=\"divDentroBorder_Izq\"></div></td>
      <td width=\"90px\" height=\"25px\"><div id=\"Layer3\" style=\"position:absolute; width:90px; height:20px; z-index:3; top: 0px; left:".$Centro."px;\" class=\"div1Dentro\" onMouseOver=\"CambiarFondo('Layer3','Layer31','Layer32','1','1')\" onMouseOut=\"CambiarFondo('Layer3','Layer31','Layer32','0','1')\" onClick=\"MostrarOcultar_SubMen('Layer33','1','imagdocente')\">
        <div align=\"center\"><strong><img src=\"../Imagenes/docente1.png\" width=\"18\" height=\"18\" align=\"absbottom\">Docente <img id=\"imagdocente\" src=\"../Imagenes/arr_black_right.gif\" width=\"7\" height=\"7\"></strong></div>
        <div id=\"Layer33\" style=\"position:absolute; width:150px; height:200px; z-index:33; border: 1px none #000000; visibility: hidden;\" onMouseMove=\"MostrarOcultar_SubMen('Layer33','1','imagdocente')\" onMouseOut=\"MostrarOcultar_SubMen('Layer33','0','imagdocente')\">
          <table width=\"150px\" height=\"200px\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
        if($bandact==1){ //ACTUALIZACIÓN
           $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"borddoc_izq311\" style=\"position:absolute; width:4px; height:15px; z-index:311; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Docente311\" style=\"position:absolute; z-index:311; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Docente311','borddoc_izq311','borddoc_der311','1','0')\" onMouseOut=\"CambiarFondo('Docente311','borddoc_izq311','borddoc_der311','0','0')\" onClick=\"Opciones_SubMen('../Persona/actualizar.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Actualizaci&oacute;n de Datos</span></div><div id=\"borddoc_der311\" style=\"position:absolute; width:4px; height:15px; z-index:311; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }	
	  if($banddetins==1){ //Acta de Asistencia
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"borddoc_izq312\" style=\"position:absolute; width:4px; height:15px; z-index:312; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Docente312\" style=\"position:absolute; z-index:312; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Docente312','borddoc_izq312','borddoc_der312','1','0')\" onMouseOut=\"CambiarFondo('Docente312','borddoc_izq312','borddoc_der312','0','0')\" onClick=\"Opciones_SubMen('../Doc/ActaAsistencia.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Acta de Asistencia</span></div><div id=\"borddoc_der312\" style=\"position:absolute; width:4px; height:15px; z-index:312; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
          }
		  if($banddispon==1){ //Disponibilidad
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"borddoc_izq313\" style=\"position:absolute; width:4px; height:15px; z-index:313; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Docente313\" style=\"position:absolute; z-index:313; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Docente313','borddoc_izq313','borddoc_der313','1','0')\" onMouseOut=\"CambiarFondo('Docente313','borddoc_izq313','borddoc_der313','0','0')\" onClick=\"Opciones_SubMen('../Doc/Disponibilidad.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Disponibilidad</span></div><div id=\"borddoc_der313\" style=\"position:absolute; width:4px; height:15px; z-index:313; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
          }
		  if($bandinas==1){ //Inasistencias
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"borddoc_izq314\" style=\"position:absolute; width:4px; height:15px; z-index:314; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Docente314\" style=\"position:absolute; z-index:314; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Docente314','borddoc_izq314','borddoc_der314','1','0')\" onMouseOut=\"CambiarFondo('Docente314','borddoc_izq314','borddoc_der314','0','0')\" onClick=\"Opciones_SubMen('../Doc/Inasistencias.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Inasistencias</span></div><div id=\"borddoc_der314\" style=\"position:absolute; width:4px; height:15px; z-index:314; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
          }
        if($banddetins==1){ //Notas
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"borddoc_izq315\" style=\"position:absolute; width:4px; height:15px; z-index:315; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Docente315\" style=\"position:absolute; z-index:315; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Docente315','borddoc_izq315','borddoc_der315','1','0')\" onMouseOut=\"CambiarFondo('Docente315','borddoc_izq315','borddoc_der315','0','0')\" onClick=\"Opciones_SubMen('../Doc/Notas.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Notas</span></div><div id=\"borddoc_der315\" style=\"position:absolute; width:4px; height:15px; z-index:315; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
          }
		  if($bandasignaseccio==1){ //Porcentajes de Evaluac.
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"borddoc_izq316\" style=\"position:absolute; width:4px; height:15px; z-index:316; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Docente316\" style=\"position:absolute; z-index:316; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Docente316','borddoc_izq316','borddoc_der316','1','0')\" onMouseOut=\"CambiarFondo('Docente316','borddoc_izq316','borddoc_der316','0','0')\" onClick=\"Opciones_SubMen('../Doc/Porcentaje.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Porcentajes de Evaluac.</span></div><div id=\"borddoc_der316\" style=\"position:absolute; width:4px; height:15px; z-index:316; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
          }		  
		$this->resultado=$this->resultado."</table>
        </div>
      </div></td>
      <td width=\"4px\" height=\"25px\"><div id=\"Layer32\" style=\"position:absolute; width:4px; height:20px; z-index:32; top: 0px; left:".$Bord_rigt."px;\" class=\"divDentroBorder_Der\"></div></td>";
    $this->left=$Bord_rigt+4;
    return $this->resultado;

  }
//******************************************************************
  function menu_coordinador(){
    $Bord_left=$this->left;
    $Centro=$Bord_left+4;
    $Bord_rigt=$Centro+118;
$bandact=0;	
	$bandhorario_nuevo=$top=$bandasigsec=$bandofernuev=0;
	$idper=$_SESSION[idper];
	$ci=$_SESSION[ci];
    $res=$this->OperacionCualquiera("SELECT * FROM tab_ope WHERE per_id='$idper' AND tab_ope_sta='1'");
	while($array=$this->ConsultarCualquiera($res)){
		  if($array->tab_id=='41' && ($idper=='1' || $idper=='2') && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandofernuev=1;
		  if($array->tab_id=='41' && ($idper=='1' || $ci=='26807272') && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandofer=1;
		  if($array->tab_id=='36' && ($idper=='1' || $idper=='2' || $idper=='6') && ($array->ope_id=='2' || $array->ope_id=='5' || $array->ope_id=='6' || $array->ope_id=='7')) $bandlista=1;
	  	  if($array->tab_id=='39' && ($idper=='1') && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandsec=1;
		  if($array->tab_id=='27' && ($idper=='1' || $idper=='2') && ($array->ope_id=='2' || $array->ope_id=='5' || $array->ope_id=='6' || $array->ope_id=='7')) $banddocente=1;
	  	  if($array->tab_id=='69' && ($idper=='1'|| $ci=='26807272') && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandhorario=1;
		  if($array->tab_id=='69' && ($idper=='1' || $idper=='2') && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandhorario_nuevo=1;
		  if($array->tab_id=='36' && ($idper=='1' || $idper=='2') &&  ($array->ope_id=='6' || $array->ope_id=='7')){ $bandcestu=1; $bandcinsc=1; $bandracad=1; $bandccali=1;}
	}
	/*echo "<script>alert('Asig_Secc: $bandasigsec');</script>";*/
    $this->resultado="
      <td width=\"4px\" height=\"25px\"><div id=\"Layer41\" style=\"position:absolute; width:4px; height:20px; z-index:41; top: 0px; left:".$Bord_left."px;\" class=\"divDentroBorder_Izq\"></div></td>
      <td width=\"118px\" height=\"25px\"><div id=\"Layer4\" style=\"position:absolute; width:118px; height:20px; z-index:4; top: 0px; left:".$Centro."px;\" class=\"div1Dentro\" onMouseOver=\"CambiarFondo('Layer4','Layer41','Layer42','1','1')\" onMouseOut=\"CambiarFondo('Layer4','Layer41','Layer42','0','1')\" onClick=\"MostrarOcultar_SubMen('Layer43','1','imagCoordinador')\">
        <div align=\"center\"><strong><img src=\"../Imagenes/profe.png\" width=\"18\" height=\"18\" align=\"absbottom\">Coordinador <img id=\"imagCoordinador\" src=\"../Imagenes/arr_black_right.gif\" width=\"7\" height=\"7\"></strong></div>
        <div id=\"Layer43\" style=\"position:absolute; width:150px; height:200px; z-index:43; border: 1px none #000000; visibility: hidden;\" onMouseMove=\"MostrarOcultar_SubMen('Layer43','1','imagCoordinador')\" onMouseOut=\"MostrarOcultar_SubMen('Layer43','0','imagCoordinador')\">
          <table width=\"150px\" height=\"200px\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

        if($bandact==1){ //ACTUALIZACIÓN
           $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordcord_izq416\" style=\"position:absolute; width:4px; height:15px; z-index:416; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Coordinador416\" style=\"position:absolute; z-index:416; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Coordinador416','bordcord_izq416','bordcord_der416','1','0')\" onMouseOut=\"CambiarFondo('Coordinador416','bordcord_izq416','bordcord_der416','0','0')\" onClick=\"Opciones_SubMen('../Persona/actualizar.php','SinData','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Actualizaci&oacute;n de Datos</span></div><div id=\"bordcord_der416\" style=\"position:absolute; width:4px; height:15px; z-index:416; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
		if($bandccali==1)//Constancia de Calificacion
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordcord_izq417\" style=\"position:absolute; width:4px; height:15px; z-index:417; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Coordinador417\" style=\"position:absolute; z-index:417; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Coordinador417','bordcord_izq417','bordcord_der417','1','0')\" onMouseOut=\"CambiarFondo('Coordinador417','bordcord_izq417','bordcord_der417','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/ConstanciaCalificacion.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Constancia de Califi.</span></div><div id=\"bordcord_der417\" style=\"position:absolute; width:4px; height:15px; z-index:417; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandcestu==1)//Constancia de Estudio
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordcord_izq418\" style=\"position:absolute; width:4px; height:15px; z-index:418; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Coordinador418\" style=\"position:absolute; z-index:418; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Coordinador418','bordcord_izq418','bordcord_der418','1','0')\" onMouseOut=\"CambiarFondo('Coordinador418','bordcord_izq418','bordcord_der418','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/ConstanciaEstudio.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Constancia de Estudio</span></div><div id=\"bordcord_der418\" style=\"position:absolute; width:4px; height:15px; z-index:418; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandcinsc==1)//Constancia de Inscripcion
		{ 
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordcord_izq419\" style=\"position:absolute; width:4px; height:15px; z-index:419; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Coordinador419\" style=\"position:absolute; z-index:419; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Coordinador419','bordcord_izq419','bordcord_der419','1','0')\" onMouseOut=\"CambiarFondo('Coordinador419','bordcord_izq419','bordcord_der419','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/ConstanciaInscripcion.php?usu=','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Constancia de Inscrip.</span></div><div id=\"bordcord_der419\" style=\"position:absolute; width:4px; height:15px; z-index:419; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandlista==1) //Diferentes Listado
		{
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordcord_izq411\" style=\"position:absolute; width:4px; height:15px; z-index:411; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Coordinador411\" style=\"position:absolute; z-index:411; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Coordinador411','bordcord_izq411','bordcord_der411','1','0')\" onMouseOut=\"CambiarFondo('Coordinador411','bordcord_izq411','bordcord_der411','0','0')\" onClick=\"Opciones_SubMen('../Coord/Listado.php','SinData','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Diferentes Listados</span></div><div id=\"bordcord_der411\" style=\"position:absolute; width:4px; height:15px; z-index:411; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($banddocente==1) //Docentes
		{
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordcord_izq414\" style=\"position:absolute; width:4px; height:15px; z-index:414; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Coordinador414\" style=\"position:absolute; z-index:414; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Coordinador414','bordcord_izq414','bordcord_der414','1','0')\" onMouseOut=\"CambiarFondo('Coordinador414','bordcord_izq414','bordcord_der414','0','0')\" onClick=\"Opciones_SubMen('../Coord/Docente.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Docente</span></div><div id=\"bordcord_der414\" style=\"position:absolute; width:4px; height:15px; z-index:414; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandhorario==1) //Horarios
		{
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordcord_izq415\" style=\"position:absolute; width:4px; height:15px; z-index:415; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Coordinador415\" style=\"position:absolute; z-index:415; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Coordinador415','bordcord_izq415','bordcord_der415','1','0')\" onMouseOut=\"CambiarFondo('Coordinador415','bordcord_izq415','bordcord_der415','0','0')\" onClick=\"Opciones_SubMen('../Coord/Horario.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Horario Vie</span></div><div id=\"bordcord_der415\" style=\"position:absolute; width:4px; height:15px; z-index:415; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandhorario_nuevo==1) //Horarios_nuevo
		{
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordcord_izq4111\" style=\"position:absolute; width:4px; height:15px; z-index:4111; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Coordinador4111\" style=\"position:absolute; z-index:4111; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Coordinador4111','bordcord_izq4111','bordcord_der4111','1','0')\" onMouseOut=\"CambiarFondo('Coordinador4111','bordcord_izq4111','bordcord_der4111','0','0')\" onClick=\"Opciones_SubMen('../Coord/Horario_Nuevo.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Horarios</span></div><div id=\"bordcord_der4111\" style=\"position:absolute; width:4px; height:15px; z-index:4111; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
        if($bandofer==1){ //OFERTA ACADEMICA
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordcord_izq412\" style=\"position:absolute; width:4px; height:15px; z-index:412; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Coordinador412\" style=\"position:absolute; z-index:412; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Coordinador412','bordcord_izq412','bordcord_der412','1','0')\" onMouseOut=\"CambiarFondo('Coordinador412','bordcord_izq412','bordcord_der412','0','0')\" onClick=\"Opciones_SubMen('../Coord/Oferta.php','SinData','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Oferta Acad&eacute;mica Vie</span></div><div id=\"bordcord_der412\" style=\"position:absolute; width:4px; height:15px; z-index:412; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
        if($bandofernuev==1){ //OFERTA ACADEMICA NUEVA
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordcord_izq4112\" style=\"position:absolute; width:4px; height:15px; z-index:4112; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Coordinador4112\" style=\"position:absolute; z-index:4112; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Coordinador4112','bordcord_izq4112','bordcord_der4112','1','0')\" onMouseOut=\"CambiarFondo('Coordinador4112','bordcord_izq4112','bordcord_der4112','0','0')\" onClick=\"Opciones_SubMen('../Coord/Oferta_Nueva.php','SinData','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Oferta Acad&eacute;mica</span></div><div id=\"bordcord_der4112\" style=\"position:absolute; width:4px; height:15px; z-index:4112; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
	    if($bandracad==1)//Record Academico
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordcord_izq4110\" style=\"position:absolute; width:4px; height:15px; z-index:4110; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Coordinador4110\" style=\"position:absolute; z-index:4110; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Coordinador4110','bordcord_izq4110','bordcord_der4110','1','0')\" onMouseOut=\"CambiarFondo('Coordinador4110','bordcord_izq4110','bordcord_der4110','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/RecordAcademico.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Record Acad&eacute;mico</span></div><div id=\"bordcord_der4110\" style=\"position:absolute; width:4px; height:15px; z-index:4110; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandsec==1) //SECCION
		{
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordcord_izq413\" style=\"position:absolute; width:4px; height:15px; z-index:413; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Coordinador413\" style=\"position:absolute; z-index:413; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Coordinador413','bordcord_izq413','bordcord_der413','1','0')\" onMouseOut=\"CambiarFondo('Coordinador413','bordcord_izq413','bordcord_der413','0','0')\" onClick=\"Opciones_SubMen('../Coord/Seccion.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Secci&oacute;n</span></div><div id=\"bordcord_der413\" style=\"position:absolute; width:4px; height:15px; z-index:413; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		$this->resultado=$this->resultado."</table>
        </div>
      </div></td>
      <td width=\"4px\" height=\"25px\"><div id=\"Layer42\" style=\"position:absolute; width:4px; height:20px; z-index:42; top: 0px; left:".$Bord_rigt."px;\" class=\"divDentroBorder_Der\"></div></td>";
    $this->left=$Bord_rigt+4;
    return $this->resultado;
  }
//******************************************************************
  function menu_secretaria(){
    $Bord_left=$this->left;
    $Centro=$Bord_left+4;
    $Bord_rigt=$Centro+108;
	$bandact=0;
	$top=$bandpens=$bandinscr=$bandconstculm=$bandnotacert=$bandlisgraduan=0;
	$bandpens='0';
	$idper=$_SESSION[idper];
    $res=$this->OperacionCualquiera("SELECT * FROM tab_ope WHERE per_id='$idper' AND tab_ope_sta='1'");
	while($array=$this->ConsultarCualquiera($res)){
		  if(($array->tab_id=='43' || $array->tab_id=='52') && ($idper=='1' || $idper=='5' || $idper=='8') && ($array->ope_id=='1' || $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){ $bandpens=1; $bandreq=1;}
		  if($array->tab_id=='31' && ($idper=='1' || $idper=='5') && ($array->ope_id=='1' || $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandinscr=1;
	  	  if($array->tab_id=='46' && ($idper=='1' || $idper=='5') &&  ($array->ope_id=='1' || $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandpera=1;
		  if($array->tab_id=='55' && ($idper=='1' || $idper=='5') &&  ($array->ope_id=='1' || $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandresmin=1;
		  if($array->tab_id=='48' && ($idper=='1' || $idper=='5') &&  ($array->ope_id=='1' || $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandresm=1;
		  if($array->tab_id=='53' && ($idper=='1' || $idper=='5' || $idper=='8') &&  ($array->ope_id=='1' || $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){ $bandequ=1; $bandcamequ=1;}
		  if($array->tab_id=='61' && ($idper=='1' || $idper=='5') &&  ($array->ope_id=='1' || $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandelec=1;
		  if($array->tab_id=='29' && ($idper=='1' || $idper=='5') &&  ($array->ope_id=='1' || $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){ $bandsolici=1; $bandnotas=1;}
  		  if($array->tab_id=='29' && ($idper=='1' || $idper=='5' || $idper=='8') &&  ($array->ope_id=='1' || $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){ $bandsolici=1;}
		  if($array->tab_id=='36' && ($idper=='1' || $idper=='5' || $idper=='7' || $idper=='8' || $idper=='9') &&  ($array->ope_id=='6' || $array->ope_id=='7')){ $bandconstestu=1; $bandconstinsc=1; $bandrecordacad=1; $bandconstcali=1; $bandconstculm='1'; $bandnotacert='1'; $bandlisgraduan='1'; $bandreportes='1';}
		  if($array->tab_id=='73' && ($idper=='1' || $idper=='5') &&  ($array->ope_id=='6' || $array->ope_id=='7')){ $bandsemana=1;}
		  if($array->tab_id=='72' && ($idper=='1' || $idper=='5') &&  ($array->ope_id=='6' || $array->ope_id=='7')){ $bandfech=1;}
		  if($array->tab_id=='26' && ($idper=='1' || $idper=='5'|| $idper=='8') &&  ($array->ope_id=='6' || $array->ope_id=='7')){ $bandexped=1;}
   }
   /*echo "<script>alert('Pensum: $bandpens');</script>";*/
   if($idper=='7')
     $nombre="Decanato ";
   else{
     if($idper=='9')
	   $nombre="Pasante ";
	 else
     $nombre="Secretar&iacute;a ";
   }
    $this->resultado="
      <td width=\"4px\" height=\"25px\"><div id=\"Layer51\" style=\"position:absolute; width:4px; height:20px; z-index:51; top: 0px; left:".$Bord_left."px;\" class=\"divDentroBorder_Izq\"></div></td>
      <td width=\"108px\" height=\"25px\"><div id=\"Layer5\" style=\"position:absolute; width:108px; height:20px; z-index:5; top: 0px; left:".$Centro."px;\" class=\"div1Dentro\" onMouseOver=\"CambiarFondo('Layer5','Layer51','Layer52','1','1')\" onMouseOut=\"CambiarFondo('Layer5','Layer51','Layer52','0','1')\" onClick=\"MostrarOcultar_SubMen('Layer53','1','imagSecretaria')\">
        <div align=\"center\"><strong><img src=\"../Imagenes/secretaria.png\" width=\"18\" height=\"18\" align=\"absbottom\">".$nombre."<img id=\"imagSecretaria\" src=\"../Imagenes/arr_black_right.gif\" width=\"7\" height=\"7\"></strong></div>
        <div id=\"Layer53\" style=\"position:absolute; width:150px; height:200px; z-index:53; border: 1px none #000000; visibility: hidden;\" onMouseMove=\"MostrarOcultar_SubMen('Layer53','1','imagSecretaria')\" onMouseOut=\"MostrarOcultar_SubMen('Layer53','0','imagSecretaria')\">
          <table width=\"150px\" height=\"200px\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
	    if($bandact==1){ //ACTUALIZACIÓN
           $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5117\" style=\"position:absolute; width:4px; height:15px; z-index:5117; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5117\" style=\"position:absolute; z-index:5117; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5117','bordsecr_izq5117','bordsecr_der5117','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5117','bordsecr_izq5117','bordsecr_der5117','0','0')\" onClick=\"Opciones_SubMen('../Persona/actualizar.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Actualizaci&oacute;n de Datos</span></div><div id=\"bordsecr_der5117\" style=\"position:absolute; width:4px; height:15px; z-index:5117; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
		if($bandnotas==1)//Cambio de Notas
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5110\" style=\"position:absolute; width:4px; height:15px; z-index:5110; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5110\" style=\"position:absolute; z-index:5110; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5110','bordsecr_izq5110','bordsecr_der5110','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5110','bordsecr_izq5110','bordsecr_der5110','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/Notas.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Cambio de Notas</span></div><div id=\"bordsecr_der5110\" style=\"position:absolute; width:4px; height:15px; z-index:5110; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandconstcali==1)//Constancia de Calificacion
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5116\" style=\"position:absolute; width:4px; height:15px; z-index:5116; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5116\" style=\"position:absolute; z-index:5116; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5116','bordsecr_izq5116','bordsecr_der5116','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5116','bordsecr_izq5116','bordsecr_der5116','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/ConstanciaCalificacion.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Constancia de Califi.</span></div><div id=\"bordsecr_der5116\" style=\"position:absolute; width:4px; height:15px; z-index:5116; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandconstculm==1)//Constancia de Culminación
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5120\" style=\"position:absolute; width:4px; height:15px; z-index:5120; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5120\" style=\"position:absolute; z-index:5120; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5120','bordsecr_izq5120','bordsecr_der5120','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5120','bordsecr_izq5120','bordsecr_der5120','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/ConstanciaCulmin_Estud.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Constancia de Culmina.</span></div><div id=\"bordsecr_der5120\" style=\"position:absolute; width:4px; height:15px; z-index:5120; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandconstestu==1)//Constancia de Estudio
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5111\" style=\"position:absolute; width:4px; height:15px; z-index:5111; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5111\" style=\"position:absolute; z-index:5111; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5111','bordsecr_izq5111','bordsecr_der5111','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5111','bordsecr_izq5111','bordsecr_der5111','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/ConstanciaEstudio.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Constancia de Estudio</span></div><div id=\"bordsecr_der5111\" style=\"position:absolute; width:4px; height:15px; z-index:5111; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandconstinsc==1)//Constancia de Inscripcion
		{ 
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5113\" style=\"position:absolute; width:4px; height:15px; z-index:5113; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5113\" style=\"position:absolute; z-index:5113; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5113','bordsecr_izq5113','bordsecr_der5113','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5113','bordsecr_izq5113','bordsecr_der5113','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/ConstanciaInscripcion.php?usu=','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Constancia de Inscrip.</span></div><div id=\"bordsecr_der5113\" style=\"position:absolute; width:4px; height:15px; z-index:5113; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
        if($bandelec==1){ //electivas
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq518\" style=\"position:absolute; width:4px; height:15px; z-index:518; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria518\" style=\"position:absolute; z-index:518; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria518','bordsecr_izq518','bordsecr_der518','1','0')\" onMouseOut=\"CambiarFondo('Secretaria518','bordsecr_izq518','bordsecr_der518','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/Electiva.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Electivas</span></div><div id=\"bordsecr_der518\" style=\"position:absolute; width:4px; height:15px; z-index:518; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
        if($bandexped==1){ //expedientes
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5118\" style=\"position:absolute; width:4px; height:15px; z-index:5118; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5118\" style=\"position:absolute; z-index:5118; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5118','bordsecr_izq5118','bordsecr_der5118','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5118','bordsecr_izq5118','bordsecr_der5118','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/Expediente.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Expediente</span></div><div id=\"bordsecr_der5118\" style=\"position:absolute; width:4px; height:15px; z-index:5118; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
		
        if($bandfech==1){ //FECHAS DE CIERRE
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5115\" style=\"position:absolute; width:4px; height:15px; z-index:5115; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5115\" style=\"position:absolute; z-index:5115; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5115','bordsecr_izq5115','bordsecr_der5115','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5115','bordsecr_izq5115','bordsecr_der5115','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/Fechas.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Fechas de Cierre</span></div><div id=\"bordsecr_der5115\" style=\"position:absolute; width:4px; height:15px; z-index:5115; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
		if($bandlisgraduan==1){ //LISTADO DE GRADUANDOS
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5122\" style=\"position:absolute; width:4px; height:15px; z-index:5122; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5122\" style=\"position:absolute; z-index:5122; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5122','bordsecr_izq5122','bordsecr_der5122','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5122','bordsecr_izq5122','bordsecr_der5122','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/indice_merito.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Listados Graduandos</span></div><div id=\"bordsecr_der5122\" style=\"position:absolute; width:4px; height:15px; z-index:5122; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
	    if($bandresm==1)//Mod./Reg./Esp.
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq515\" style=\"position:absolute; width:4px; height:15px; z-index:515; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria515\" style=\"position:absolute; z-index:515; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria515','bordsecr_izq515','bordsecr_der515','1','0')\" onMouseOut=\"CambiarFondo('Secretaria515','bordsecr_izq515','bordsecr_der515','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/EsReMo.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Mod./Reg./Esp.</span></div><div id=\"bordsecr_der515\" style=\"position:absolute; width:4px; height:15px; z-index:515; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
	    if($bandresmin==1)//Mod./Reg./Esp./Inf.
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq514\" style=\"position:absolute; width:4px; height:15px; z-index:514; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria514\" style=\"position:absolute; z-index:514; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria514','bordsecr_izq514','bordsecr_der514','1','0')\" onMouseOut=\"CambiarFondo('Secretaria514','bordsecr_izq514','bordsecr_der514','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/EsReMoIn.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Mod./Reg./Esp./Inf.</span></div><div id=\"bordsecr_der514\" style=\"position:absolute; width:4px; height:15px; z-index:514; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandnotacert==1)//Nota Certificada
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5121\" style=\"position:absolute; width:4px; height:15px; z-index:5121; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5121\" style=\"position:absolute; z-index:5121; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5121','bordsecr_izq5121','bordsecr_der5121','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5121','bordsecr_izq5121','bordsecr_der5121','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/NotasCertificadas.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Notas Certificadas</span></div><div id=\"bordsecr_der5121\" style=\"position:absolute; width:4px; height:15px; z-index:5121; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
        if($bandpens==1 || $bandreq==1){ //pensum y requisitos
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq511\" style=\"position:absolute; width:4px; height:15px; z-index:511; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria511\" style=\"position:absolute; z-index:511; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria511','bordsecr_izq511','bordsecr_der511','1','0')\" onMouseOut=\"CambiarFondo('Secretaria511','bordsecr_izq511','bordsecr_der511','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/Pensum.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Pensum</span></div><div id=\"bordsecr_der511\" style=\"position:absolute; width:4px; height:15px; z-index:511; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
	    if($bandpera==1)//periodo académico
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq513\" style=\"position:absolute; width:4px; height:15px; z-index:513; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria513\" style=\"position:absolute; z-index:513; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria513','bordsecr_izq513','bordsecr_der513','1','0')\" onMouseOut=\"CambiarFondo('Secretaria513','bordsecr_izq513','bordsecr_der513','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/Pacade.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Periodo Acad&eacute;mico</span></div><div id=\"bordsecr_der513\" style=\"position:absolute; width:4px; height:15px; z-index:513; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
        if($bandinscr==1){ //Proc. de inscripcion
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq512\" style=\"position:absolute; width:4px; height:15px; z-index:512; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria512\" style=\"position:absolute; z-index:512; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria512','bordsecr_izq512','bordsecr_der512','1','0')\" onMouseOut=\"CambiarFondo('Secretaria512','bordsecr_izq512','bordsecr_der512','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/Inscripcion.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Proc. de Inscripci&oacute;n</span></div><div id=\"bordsecr_der512\" style=\"position:absolute; width:4px; height:15px; z-index:512; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
	    if($bandsolici==1)//Procesar Solicitud
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq519\" style=\"position:absolute; width:4px; height:15px; z-index:519; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria519\" style=\"position:absolute; z-index:519; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria519','bordsecr_izq519','bordsecr_der519','1','0')\" onMouseOut=\"CambiarFondo('Secretaria519','bordsecr_izq519','bordsecr_der519','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/Solicitud.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Procesar Solicitud</span></div><div id=\"bordsecr_der519\" style=\"position:absolute; width:4px; height:15px; z-index:519; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
	    if($bandrecordacad==1)//Record Academico
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5112\" style=\"position:absolute; width:4px; height:15px; z-index:5112; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5112\" style=\"position:absolute; z-index:5112; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5112','bordsecr_izq5112','bordsecr_der5112','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5112','bordsecr_izq5112','bordsecr_der5112','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/RecordAcademico.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Record Acad&eacute;mico</span></div><div id=\"bordsecr_der5112\" style=\"position:absolute; width:4px; height:15px; z-index:5112; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandreportes==1){ //REPORTES
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5123\" style=\"position:absolute; width:4px; height:15px; z-index:5122; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5123\" style=\"position:absolute; z-index:5123; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5123','bordsecr_izq5123','bordsecr_der5123','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5123','bordsecr_izq5123','bordsecr_der5123','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/Reportes.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Reportes</span></div><div id=\"bordsecr_der5123\" style=\"position:absolute; width:4px; height:15px; z-index:5123; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
	    if($bandsemana==1)//Semana
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5114\" style=\"position:absolute; width:4px; height:15px; z-index:5114; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5114\" style=\"position:absolute; z-index:5114; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5114','bordsecr_izq5114','bordsecr_der5114','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5114','bordsecr_izq5114','bordsecr_der5114','0','0')\" onClick=\"Opciones_SubMen('../Secretaria/Semana.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Semanas Acad&eacute;micas</span></div><div id=\"bordsecr_der5114\" style=\"position:absolute; width:4px; height:15px; z-index:5114; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
        if($bandequ==1){ //TABLA DE EQUIVALENCIAS
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq517\" style=\"position:absolute; width:4px; height:15px; z-index:517; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria517\" style=\"position:absolute; z-index:517; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria517','bordsecr_izq517','bordsecr_der517','1','0')\" onMouseOut=\"CambiarFondo('Secretaria517','bordsecr_izq517','bordsecr_der517','0','0')\" onClick=\"Opciones_SubMen('../Equivalencia/Listar_Equiv.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Tabla de Equivalencia</span></div><div id=\"bordsecr_der517\" style=\"position:absolute; width:4px; height:15px; z-index:517; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
		if($bandcamequ==1){ //OTROS PROCESOS
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordsecr_izq5119\" style=\"position:absolute; width:4px; height:15px; z-index:5119; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Secretaria5119\" style=\"position:absolute; z-index:5119; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Secretaria5119','bordsecr_izq5119','bordsecr_der5119','1','0')\" onMouseOut=\"CambiarFondo('Secretaria5119','bordsecr_izq5119','bordsecr_der5119','0','0')\" onClick=\"Opciones_SubMen('../Cambios_Reingreso/Opciones.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Otros Procesos</span></div><div id=\"bordsecr_der5119\" style=\"position:absolute; width:4px; height:15px; z-index:5119; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
		$this->resultado=$this->resultado."</table>
        </div>
      </div></td>
      <td width=\"4px\" height=\"25px\"><div id=\"Layer52\" style=\"position:absolute; width:4px; height:20px; z-index:52; top: 0px; left:".$Bord_rigt."px;\" class=\"divDentroBorder_Der\"></div></td>";
    $this->left=$Bord_rigt+4;
    return $this->resultado;
  }
//******************************************************************
  function menu_reportes(){
    $Bord_left=$this->left;
    $Centro=$Bord_left+4;
    $Bord_rigt=$Centro+80;
    $this->resultado="
      <td width=\"4px\" height=\"25px\"><div id=\"Layer61\" style=\"position:absolute; width:4px; height:20px; z-index:61; top: 0px; left:".$Bord_left."px;\" class=\"divDentroBorder_Izq\"></div></td>
      <td width=\"80px\" height=\"25px\"><div id=\"Layer6\" style=\"position:absolute; width:80px; height:20px; z-index:6; top: 0px; left:".$Centro."px;\" class=\"div1Dentro\" onMouseOver=\"CambiarFondo('Layer6','Layer61','Layer62','1','1')\" onMouseOut=\"CambiarFondo('Layer6','Layer61','Layer62','0','1')\" onClick=\"MostrarOcultar_SubMen('Layer63','1','imagreportes')\">
        <div align=\"center\"><strong><img src=\"../Imagenes/icon_office_pen2.gif\" width=\"18\" height=\"18\" align=\"absbottom\">Reportes <img id=\"imagreportes\" src=\"../Imagenes/arr_black_right.gif\" width=\"7\" height=\"7\"></strong></div>
        <div id=\"Layer62\" style=\"position:absolute; width:150px; height:200px; z-index:62; border: 1px none #000000; visibility: hidden;\" onMouseMove=\"MostrarOcultar_SubMen('Layer62','1','imagreportes')\" onMouseOut=\"MostrarOcultar_SubMen('Layer62','0','imagreportes')\">
          <table width=\"150px\" height=\"20px\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
            <tr><td width=\"150px\" height=\"20px\"><div id=\"bordrepor_izq611\" style=\"position:absolute; width:4px; height:20px; z-index:611; top: 0px; left: 0px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Reporte1\" style=\"position:absolute; z-index:611; border: 1px none #000000; top: 0px; width: 142px; height: 20px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Reporte1','bordrepor_izq611','bordrepor_der611','1','0')\" onMouseOut=\"CambiarFondo('Reporte1','bordrepor_izq611','bordrepor_der611','0','0')\" onClick=\"Opciones_SubMen('../Reportes/Crear.php','Crear','3')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Crear Reporte</span></div><div id=\"bordrepor_der611\" style=\"position:absolute; width:4px; height:20px; z-index:611; top: 0px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>
            <tr><td width=\"150px\" height=\"20px\"><div id=\"bordrepor_izq612\" style=\"position:absolute; width:4px; height:20px; z-index:612; top: 20px; left: 0px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Reporte2\" style=\"position:absolute; z-index:612; border: 1px none #000000; top: 20px; width: 142px; height: 20px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Reporte2','bordrepor_izq612','bordrepor_der612','1','0')\" onMouseOut=\"CambiarFondo('Reporte2','bordrepor_izq612','bordrepor_der612','0','0')\" onClick=\"Opciones_SubMen('../Reportes/Listar.php','Listar','3')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Listar Reporte</span></div><div id=\"bordrepor_der612\" style=\"position:absolute; width:4px; height:20px; z-index:612; top: 20px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>
          </table>
        </div>
      </div></td>
      <td width=\"4px\" height=\"25px\"><div id=\"Layer63\" style=\"position:absolute; width:4px; height:20px; z-index:63; top: 0px; left:".$Bord_rigt."px;\" class=\"divDentroBorder_Der\"></div></td>";
    $this->left=$Bord_rigt+4;
    return $this->resultado;
  }
//******************************************************************
  function menu_configuracion(){
    $Bord_left=$this->left;
    $Centro=$Bord_left+4;
    $Bord_rigt=$Centro+140;
	$top=$bandcardemp=$bandact=$bandcom=$bandidi=$bandetn=$banddep=$bandinc=$bandbec=$bandins=$bandcar=$banddepa=$bandtip=$bandsec=$bandreg=$bandcoh=$bandespe=$bandmod=$bandniv=$bandinf=$bandnuc=$bandpro=$bandperso=$bandusu=$bandperf=$bandobs=$bandpai=$bandesta=$bandmuni=$bandciud=0;
	$idper=$_SESSION[idper];	
//	if($idper=='1')
	  $bandact=1;
    $res=$this->OperacionCualquiera("SELECT * FROM tab_ope WHERE per_id='$idper' AND tab_ope_sta='1'");
	while($array=$this->ConsultarCualquiera($res)){
	  if($array->tab_id=='70' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandaula=1;
	  if($array->tab_id=='66' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $banddia=1;
	  if($array->tab_id=='67' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandfor=1;
	  if($array->tab_id=='65' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandblh=1;
	  if($array->tab_id=='21' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandcom=1;
	  if($array->tab_id=='11' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandidi=1;
	  if($array->tab_id=='16' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandetn=1;
	  if($array->tab_id=='17' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $banddepo=1;
	  if($array->tab_id=='12' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandinc=1;
	  if($array->tab_id=='8' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandbec=1;
	  if($array->tab_id=='37' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandins=1;
	  if($array->tab_id=='50' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandcar=1;
	  if($array->tab_id=='45' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $banddepa=1;
	  if($array->tab_id=='42' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandtip=1;
	  if($array->tab_id=='49' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandreg=1;
	  if($array->tab_id=='40' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandcoh=1;
	  if($array->tab_id=='44' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandesp=1;
	  if($array->tab_id=='54' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandmod=1;
	  if($array->tab_id=='38' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandniv=1;
	  if($array->tab_id=='51' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandinf=1;
	  if($array->tab_id=='56' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandnuc=1;
	  if($array->tab_id=='28' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandpro=1;
	  if($array->tab_id=='27' && ($idper=='1' ||  $idper=='5' ||  $idper=='8') && ($array->ope_id=='1' || $array->ope_id=='5' || $array->ope_id=='8' || $array->ope_id=='9')) $bandperso=1;
	  if($array->tab_id=='25' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandusu=1;
	  if($array->tab_id=='7' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandperf=1;
	  if($array->tab_id=='30' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandobs=1;
	  if($array->tab_id=='13' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandpai=1;
	  if($array->tab_id=='5' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandesta=1;
  	  if($array->tab_id=='6' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandmuni=1;
  	  if($array->tab_id=='14' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandciud=1;
  	  if($array->tab_id=='30' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandobs=1;
  	  if($array->tab_id=='60' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){ $bandcard=1; $bandcardemp=1;}
	  if($array->tab_id=='57' && $idper=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')) $bandmoding=1;
	}
    $this->resultado="
      <td width=\"4px\" height=\"25px\"><div id=\"Layer71\" style=\"position:absolute; width:4px; height:20px; z-index:71; top: 0px; left:".$Bord_left."px;\" class=\"divDentroBorder_Izq\"></div></td>
      <td width=\"140px\" height=\"25px\"><div id=\"Layer7\" style=\"position:absolute; width:140px; height:20px; z-index:7; top: 0px; left:".$Centro."px;\" class=\"div1Dentro\" onMouseOver=\"CambiarFondo('Layer7','Layer71','Layer72','1','1')\" onMouseOut=\"CambiarFondo('Layer7','Layer71','Layer72','0','1')\" onClick=\"MostrarOcultar_SubMen('Layer73','1','imagconfiguracion')\">
        <div align=\"center\"><strong><img src=\"../Imagenes/icon_win98_3.gif\" width=\"18\" height=\"18\" align=\"absbottom\">Mantenimiento <img id=\"imagconfiguracion\" src=\"../Imagenes/arr_black_right.gif\" width=\"7\" height=\"7\"></strong></div>
        <div id=\"Layer73\" style=\"position:absolute; width:150px; height:200px; z-index:73; border: 1px none #000000; visibility: hidden;\" onMouseMove=\"MostrarOcultar_SubMen('Layer73','1','imagconfiguracion')\" onMouseOut=\"MostrarOcultar_SubMen('Layer73','0','imagconfiguracion')\">
          <table width=\"150px\" height=\"200px\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		if($bandact==1){ //ACTUALIZACIÓN
           $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7133\" style=\"position:absolute; width:4px; height:15px; z-index:7133; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7133\" style=\"position:absolute; z-index:7133; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7133','bordconf_izq7133','bordconf_der7133','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7133','bordconf_izq7133','bordconf_der7133','0','0')\" onClick=\"Opciones_SubMen('../Persona/actualizar.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Actualizaci&oacute;n de Datos</span></div><div id=\"bordconf_der7133\" style=\"position:absolute; width:4px; height:15px; z-index:7133; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
		if($bandaula==1) //Aulas
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7111\" style=\"position:absolute; width:4px; height:15px; z-index:7111; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7111\" style=\"position:absolute; z-index:7111; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7111','bordconf_izq7111','bordconf_der7111','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7111','bordconf_izq7111','bordconf_der7111','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Aula.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Aula</span></div><div id=\"bordconf_der7111\" style=\"position:absolute; width:4px; height:15px; z-index:7111; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandbec==1) //becas
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq716\" style=\"position:absolute; width:4px; height:15px; z-index:716; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion716\" style=\"position:absolute; z-index:716; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion716','bordconf_izq716','bordconf_der716','1','0')\" onMouseOut=\"CambiarFondo('Configuracion716','bordconf_izq716','bordconf_der716','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/beca.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Beca</span></div><div id=\"bordconf_der716\" style=\"position:absolute; width:4px; height:15px; z-index:716; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandblh==1) //Bloque de Horas
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7116\" style=\"position:absolute; width:4px; height:15px; z-index:7116; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7116\" style=\"position:absolute; z-index:7116; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7116','bordconf_izq7116','bordconf_der7116','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7116','bordconf_izq7116','bordconf_der7116','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Blh.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Bloque de Horas</span></div><div id=\"bordconf_der7116\" style=\"position:absolute; width:4px; height:15px; z-index:7116; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandcar==1) //cargo
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq718\" style=\"position:absolute; width:4px; height:15px; z-index:718; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion718\" style=\"position:absolute; z-index:718; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion718','bordconf_izq718','bordconf_der718','1','0')\" onMouseOut=\"CambiarFondo('Configuracion718','bordconf_izq718','bordconf_der718','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/cargo.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Cargo</span></div><div id=\"bordconf_der718\" style=\"position:absolute; width:4px; height:15px; z-index:717; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
        if($bandcard==1){ //Cargo X Departamento
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7130\" style=\"position:absolute; width:4px; height:15px; z-index:7130; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7130\" style=\"position:absolute; z-index:7130; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7130','bordconf_izq7130','bordconf_der7130','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7130','bordconf_izq7130','bordconf_der7130','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/depart_cargo.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Cargo X Departamento</span></div><div id=\"bordconf_der7130\" style=\"position:absolute; width:4px; height:15px; z-index:7130; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
        if($bandcardemp==1){ //Cargo X Departamento Empleaqdo
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7135\" style=\"position:absolute; width:4px; height:15px; z-index:7135; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7135\" style=\"position:absolute; z-index:7135; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7135','bordconf_izq7135','bordconf_der7135','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7135','bordconf_izq7135','bordconf_der7135','0','0')\" onClick=\"Opciones_SubMen('../Cargo_Depart_Emplea/Listar.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Cargo/Depa/Emple</span></div><div id=\"bordconf_der7135\" style=\"position:absolute; width:4px; height:15px; z-index:7135; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
		if($bandcoh==1) //cohorte
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7113\" style=\"position:absolute; width:4px; height:15px; z-index:7113; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7113\" style=\"position:absolute; z-index:7113; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7113','bordconf_izq7113','bordconf_der7113','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7113','bordconf_izq7113','bordconf_der7113','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Cohorte.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Cohorte</span></div><div id=\"bordconf_der7113\" style=\"position:absolute; width:4px; height:15px; z-index:7113; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandcom==1) //componente militar
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq711\" style=\"position:absolute; width:4px; height:15px; z-index:711; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion711\" style=\"position:absolute; z-index:711; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion711','bordconf_izq711','bordconf_der711','1','0')\" onMouseOut=\"CambiarFondo('Configuracion711','bordconf_izq711','bordconf_der711','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/comil.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Componente Militar</span></div><div id=\"bordconf_der711\" style=\"position:absolute; width:4px; height:15px; z-index:711; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($banddepa==1)//departamento
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq719\" style=\"position:absolute; width:4px; height:15px; z-index:719; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion719\" style=\"position:absolute; z-index:719; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion719','bordconf_izq719','bordconf_der719','1','0')\" onMouseOut=\"CambiarFondo('Configuracion719','bordconf_izq719','bordconf_der719','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/depart.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Departamento</span></div><div id=\"bordconf_der719\" style=\"position:absolute; width:4px; height:15px; z-index:719; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($banddepo==1)//deporte
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq714\" style=\"position:absolute; width:4px; height:15px; z-index:714; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion714\" style=\"position:absolute; z-index:714; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion714','bordconf_izq714','bordconf_der714','1','0')\" onMouseOut=\"CambiarFondo('Configuracion714','bordconf_izq714','bordconf_der714','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/deport.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Deporte</span></div><div id=\"bordconf_der714\" style=\"position:absolute; width:4px; height:15px; z-index:714; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($banddia==1)//días
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7131\" style=\"position:absolute; width:4px; height:15px; z-index:7131; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7131\" style=\"position:absolute; z-index:7131; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7131','bordconf_izq7131','bordconf_der7131','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7131','bordconf_izq7131','bordconf_der7131','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Dia.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">D&iacute;a</span></div><div id=\"bordconf_der7131\" style=\"position:absolute; width:4px; height:15px; z-index:7131; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
        if($bandesp==1){ //especialidad
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7115\" style=\"position:absolute; width:4px; height:15px; z-index:7115; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7115\" style=\"position:absolute; z-index:7115; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7115','bordconf_izq7115','bordconf_der7115','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7115','bordconf_izq7115','bordconf_der7115','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Especi.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Especialidad</span></div><div id=\"bordconf_der7115\" style=\"position:absolute; width:4px; height:15px; z-index:7115; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
        if($bandesta==1){//estado
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7125\" style=\"position:absolute; width:4px; height:15px; z-index:7125; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7125\" style=\"position:absolute; z-index:7125; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7125','bordconf_izq7125','bordconf_der7125','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7125','bordconf_izq7125','bordconf_der7125','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/estado.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Estado</span></div><div id=\"bordconf_der7125\" style=\"position:absolute; width:4px; height:15px; z-index:7125; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
		if($bandetn==1) //etnia
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq713\" style=\"position:absolute; width:4px; height:15px; z-index:713; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion713\" style=\"position:absolute; z-index:713; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion713','bordconf_izq713','bordconf_der713','1','0')\" onMouseOut=\"CambiarFondo('Configuracion713','bordconf_izq713','bordconf_der713','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/etnia.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Etnia</span></div><div id=\"bordconf_der713\" style=\"position:absolute; width:4px; height:15px; z-index:713; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandfor==1) //Formato de Horarios
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7132\" style=\"position:absolute; width:4px; height:15px; z-index:7132; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7132\" style=\"position:absolute; z-index:7132; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7132','bordconf_izq7132','bordconf_der7132','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7132','bordconf_izq7132','bordconf_der7132','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Formato.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Formato de Horarios</span></div><div id=\"bordconf_der7132\" style=\"position:absolute; width:4px; height:15px; z-index:7132; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandidi==1) //idioma
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq712\" style=\"position:absolute; width:4px; height:15px; z-index:712; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion712\" style=\"position:absolute; z-index:712; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion712','bordconf_izq712','bordconf_der712','1','0')\" onMouseOut=\"CambiarFondo('Configuracion712','bordconf_izq712','bordconf_der712','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/idioma.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Idioma</span></div><div id=\"bordconf_der712\" style=\"position:absolute; width:4px; height:15px; z-index:712; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandinc==1) //incapacidades
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq715\" style=\"position:absolute; width:4px; height:15px; z-index:715; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion715\" style=\"position:absolute; z-index:715; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion715','bordconf_izq715','bordconf_der715','1','0')\" onMouseOut=\"CambiarFondo('Configuracion715','bordconf_izq715','bordconf_der715','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/incapa.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Incapacidad Motora</span></div><div id=\"bordconf_der715\" style=\"position:absolute; width:4px; height:15px; z-index:715; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandinf==1) //infraestructura
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7118\" style=\"position:absolute; width:4px; height:15px; z-index:7118; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7118\" style=\"position:absolute; z-index:7118; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7118','bordconf_izq7118','bordconf_der7118','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7118','bordconf_izq7118','bordconf_der7118','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Infraestructura.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Infraestuctura</span></div><div id=\"bordconf_der7118\" style=\"position:absolute; width:4px; height:15px; z-index:7118; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandins==1) //instituciones académicas
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq717\" style=\"position:absolute; width:4px; height:15px; z-index:717; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion717\" style=\"position:absolute; z-index:717; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion717','bordconf_izq717','bordconf_der717','1','0')\" onMouseOut=\"CambiarFondo('Configuracion717','bordconf_izq717','bordconf_der717','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/instit.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Instituci&oacute;n Educativa</span></div><div id=\"bordconf_der717\" style=\"position:absolute; width:4px; height:15px; z-index:717; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandmod==1) //modalidad académica
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7114\" style=\"position:absolute; width:4px; height:15px; z-index:7114; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7114\" style=\"position:absolute; z-index:7114; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7114','bordconf_izq7114','bordconf_der7114','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7114','bordconf_izq7114','bordconf_der7114','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Modalidad.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Modalidad Acad&eacute;mica</span></div><div id=\"bordconf_der7114\" style=\"position:absolute; width:4px; height:15px; z-index:7114; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
        if($bandmoding==1){ //modalidad de Ingreso
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7129\" style=\"position:absolute; width:4px; height:15px; z-index:7129; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7129\" style=\"position:absolute; z-index:7129; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7129','bordconf_izq7129','bordconf_der7129','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7129','bordconf_izq7129','bordconf_der7129','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/modali_ing.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Modalidad de Ingreso</span></div><div id=\"bordconf_der7129\" style=\"position:absolute; width:4px; height:15px; z-index:7129; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
        if($bandmuni==1){ //municipio
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7126\" style=\"position:absolute; width:4px; height:15px; z-index:7126; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7126\" style=\"position:absolute; z-index:7126; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7126','bordconf_izq7126','bordconf_der7126','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7126','bordconf_izq7126','bordconf_der7126','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/munici.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Municipio</span></div><div id=\"bordconf_der7126\" style=\"position:absolute; width:4px; height:15px; z-index:7126; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
		if($bandniv==1) //nivel académico
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7117\" style=\"position:absolute; width:4px; height:15px; z-index:7117; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7117\" style=\"position:absolute; z-index:7117; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7117','bordconf_izq7117','bordconf_der7117','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7117','bordconf_izq7117','bordconf_der7117','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Nivela.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Nivel Acad&eacute;mico</span></div><div id=\"bordconf_der7117\" style=\"position:absolute; width:4px; height:15px; z-index:7117; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
	    if($bandnuc==1) //nucleo
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7119\" style=\"position:absolute; width:4px; height:15px; z-index:7119; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7119\" style=\"position:absolute; z-index:7119; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7119','bordconf_izq7119','bordconf_der7119','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7119','bordconf_izq7119','bordconf_der7119','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Nucleo.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Nucleo</span></div><div id=\"bordconf_der7119\" style=\"position:absolute; width:4px; height:15px; z-index:7119; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
        if($bandobs==1){ //observaciones del detalle de inscripcion
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7128\" style=\"position:absolute; width:4px; height:15px; z-index:7128; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7128\" style=\"position:absolute; z-index:7128; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7128','bordconf_izq7128','bordconf_der7128','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7128','bordconf_izq7128','bordconf_der7128','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/observ.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Observ. de Inscripci&oacute;n</span></div><div id=\"bordconf_der7128\" style=\"position:absolute; width:4px; height:15px; z-index:7128; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
        if($bandpai==1){ //país
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7124\" style=\"position:absolute; width:4px; height:15px; z-index:7124; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7124\" style=\"position:absolute; z-index:7124; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7124','bordconf_izq7124','bordconf_der7124','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7124','bordconf_izq7124','bordconf_der7124','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/pais.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Pa&iacute;s</span></div><div id=\"bordconf_der7124\" style=\"position:absolute; width:4px; height:15px; z-index:7124; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
        if($bandciud==1){ //parroquia
            $this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7127\" style=\"position:absolute; width:4px; height:15px; z-index:7127; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7127\" style=\"position:absolute; z-index:7127; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7127','bordconf_izq7127','bordconf_der7127','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7127','bordconf_izq7127','bordconf_der7127','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/ciudad.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Parroquia</span></div><div id=\"bordconf_der7127\" style=\"position:absolute; width:4px; height:15px; z-index:7127; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
        }
		if($bandperf==1) //perfil
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7123\" style=\"position:absolute; width:4px; height:15px; z-index:7123; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7123\" style=\"position:absolute; z-index:7123; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7123','bordconf_izq7123','bordconf_der7123','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7123','bordconf_izq7123','bordconf_der7123','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Perfil.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Perfil</span></div><div id=\"bordconf_der7123\" style=\"position:absolute; width:4px; height:15px; z-index:7123; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandperso==1) //personas
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7121\" style=\"position:absolute; width:4px; height:15px; z-index:7121; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7121\" style=\"position:absolute; z-index:7121; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7121','bordnconf_izq7121','bordconf_der7121','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7121','bordconf_izq7121','bordconf_der7121','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Persona.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Personas</span></div><div id=\"bordconf_der7121\" style=\"position:absolute; width:4px; height:15px; z-index:7121; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandreg==1) //régimen
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7112\" style=\"position:absolute; width:4px; height:15px; z-index:7112; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7112\" style=\"position:absolute; z-index:7112; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7112','bordconf_izq7112','bordconf_der7112','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7112','bordconf_izq7112','bordconf_der7112','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Regimen.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">R&eacute;gimen</span></div><div id=\"bordconf_der7112\" style=\"position:absolute; width:4px; height:15px; z-index:7112; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandtip==1) //tipo de materias
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7110\" style=\"position:absolute; width:4px; height:15px; z-index:7110; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7110\" style=\"position:absolute; z-index:7110; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7110','bordconf_izq7110','bordconf_der7110','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7110','bordconf_izq7110','bordconf_der7110','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/tipoma.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Tipo de Materia</span></div><div id=\"bordconf_der7110\" style=\"position:absolute; width:4px; height:15px; z-index:7110; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		if($bandpro==1) //tipo de procesos
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7120\" style=\"position:absolute; width:4px; height:15px; z-index:7120; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7120\" style=\"position:absolute; z-index:7120; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7120','bordconf_izq7120','bordconf_der7120','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7120','bordconf_izq7120','bordconf_der7120','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/proces.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Tipos de Procesos</span></div><div id=\"bordconf_der7120\" style=\"position:absolute; width:4px; height:15px; z-index:7120; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}		
		if($bandusu==1) //usuario
		{
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7122\" style=\"position:absolute; width:4px; height:15px; z-index:7122; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7122\" style=\"position:absolute; z-index:7122; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7122','bordconf_izq7122','bordconf_der7122','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7122','bordconf_izq7122','bordconf_der7122','0','0')\" onClick=\"Opciones_SubMen('../Configuracion/Usuario.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Usuario</span></div><div id=\"bordconf_der7122\" style=\"position:absolute; width:4px; height:15px; z-index:7122; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
			$this->resultado=$this->resultado."<tr><td width=\"150px\" height=\"15px\"><div id=\"bordconf_izq7134\" style=\"position:absolute; width:4px; height:15px; z-index:7134; top: ".$top."px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Configuracion7134\" style=\"position:absolute; z-index:7134; border: 1px none #000000; top: ".$top."px; width: 142px; height: 15px; left: 4px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Configuracion7122','bordconf_izq7134','bordconf_der7134','1','0')\" onMouseOut=\"CambiarFondo('Configuracion7134','bordconf_izq7134','bordconf_der7134','0','0')\" onClick=\"Opciones_SubMen('../Pregunta_Secreta/camb_preg_sec.php','Listar','42')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\">Pregunta Secreta</span></div><div id=\"bordconf_der7134\" style=\"position:absolute; width:4px; height:15px; z-index:7134; top: ".$top."px; left: 146px;\" class=\"divDentroBorder_Der\"></div></td></tr>";
			$top=$top+15;
		}
		$this->resultado=$this->resultado."</table>
        </div>
      </div></td>
      <td width=\"4px\" height=\"25px\"><div id=\"Layer72\" style=\"position:absolute; width:4px; height:20px; z-index:72; top: 0px; left:".$Bord_rigt."px;\" class=\"divDentroBorder_Der\"></div></td>";
    $this->left=$Bord_rigt+4;
    return $this->resultado;
  }
//******************************************************************
  function menu_contactos(){
    $Bord_left=$this->left;
    $Centro=$Bord_left+4;
    $Bord_rigt=$Centro+122;
    $this->resultado="
      <td width=\"4px\" height=\"25px\"><div id=\"Layer81\" style=\"position:absolute; width:4px; height:20px; z-index:81; top: 0px; left:".$Bord_left."px;\" class=\"divDentroBorder_Izq\"></div></td>
      <td width=\"122px\" height=\"25px\"><div id=\"Layer8\" style=\"position:absolute; width:122px; height:20px; z-index:8; top: 0px; left:".$Centro."px;\" class=\"div1Dentro\" onMouseOver=\"CambiarFondo('Layer8','Layer81','Layer82','1','1')\" onMouseOut=\"CambiarFondo('Layer8','Layer81','Layer82','0','1')\" onClick=\"MostrarOcultar_SubMen('Layer83','1','imagcontactos')\">
        <div align=\"center\"><strong><img src=\"../Imagenes/In%20Box_ico_2.gif\" width=\"18\" height=\"18\" align=\"absbottom\">Contactenos <img id=\"imagcontactos\" src=\"../Imagenes/arr_black_right.gif\" width=\"7\" height=\"7\"></strong></div>
        <div id=\"Layer83\" style=\"position:absolute; width:150px; height:200px; z-index:83; visibility: hidden;\" onMouseMove=\"MostrarOcultar_SubMen('Layer83','1','imagcontactos')\" onMouseOut=\"MostrarOcultar_SubMen('Layer83','0','imagcontactos')\">
          <table width=\"400px\" height=\"40px\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
            <tr><td width=\"400px\" height=\"20px\"><div id=\"bordcont_izq1\" style=\"position:absolute; width:4px; height:20px; z-index:811; top: 0px; left: 0px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Contactos1\" style=\"position:absolute; z-index:10; border: 1px none #000000; top: 0px; left: 4px; width: 392px; height: 20px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Contactos1','bordcont_izq1','bordcont_der1','1','0')\" onMouseOut=\"CambiarFondo('Contactos1','bordcont_izq1','bordcont_der1','0','0')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\"><a href=\"mailto:divsec.tachira@gmail.com\">DIVISI&Oacute;N DE SECRETARIA T&Aacute;CHIRA</span></div><div id=\"bordcont_der1\" style=\"position:absolute; width:4px; height:20px; z-index:16; top: 0px; left: 396px;\" class=\"divDentroBorder_Der\"></div></td></tr>
            <tr><td width=\"400px\" height=\"20px\"><div id=\"bordcont_izq2\" style=\"position:absolute; width:4px; height:20px; z-index:812; top: 20px; left: 0px;\" class=\"divDentroBorder_Izq\"></div><div id=\"Contactos2\" style=\"position:absolute; z-index:10; border: 1px none #000000; top: 20px; left: 4px; width: 392px; height: 20px;\" align=\"left\" class=\"div2Dentro\" onMouseOver=\"CambiarFondo('Contactos2','bordcont_izq2','bordcont_der2','1','0')\" onMouseOut=\"CambiarFondo('Contactos2','bordcont_izq2','bordcont_der2','0','0')\"><img src=\"../Imagenes/small-green-glasy-bullet.gif\">&nbsp;<span class=\"Estilo11\"><a href=\"mailto:registroycontrol.tachira@gmail.com;\">DEPARTAMENTO DE INGRESO, REGISTRO Y EGRESO T&Aacute;CHIRA</span></div><div id=\"bordcont_der2\" style=\"position:absolute; width:4px; height:20px; z-index:16; top: 20px; left: 396px;\" class=\"divDentroBorder_Der\"></div></td></tr>
          </table>
        </div>
      </div></td>
      <td width=\"4px\" height=\"25px\"><div id=\"Layer82\" style=\"position:absolute; width:4px; height:20px; z-index:82; top: 0px; left:".$Bord_rigt."px;\" class=\"divDentroBorder_Der\"></div></td>";
    $this->left=$Bord_rigt+4;
    return $this->resultado;
  }
//******************************************************************
  function menu_ayuda($pag){
    $Bord_left=$this->left;
    $Centro=$Bord_left+4;
    $Bord_rigt=$Centro+64;
    $this->resultado="
      <td width=\"4px\" height=\"25px\"><div id=\"Layer91\" style=\"position:absolute; width:4px; height:20px; z-index:91; top: 0px; left:".$Bord_left."px;\" class=\"divDentroBorder_Izq\"></div></td>
      <td width=\"64px\" height=\"25px\"><div id=\"Layer9\" style=\"position:absolute; width:64px; height:20px; z-index:9; top: 0px; left:".$Centro."px;\" class=\"div1Dentro\" onMouseOver=\"CambiarFondo('Layer9','Layer91','Layer92','1','1')\" onMouseOut=\"CambiarFondo('Layer9','Layer91','Layer92','0','1')\" onClick=\"ayuda('".$pag."')\">
        <div align=\"center\"><strong><img src=\"../Imagenes/Help_ico_6.gif\" width=\"18\" height=\"18\" align=\"absbottom\">Ayuda</strong></div>
      </div></td>
      <td width=\"4px\" height=\"25px\"><div id=\"Layer92\" style=\"position:absolute; width:4px; height:20px; z-index:92; top: 0px; left:".$Bord_rigt."px;\" class=\"divDentroBorder_Der\"></div></td>";
    $this->left=$Bord_rigt+4;
    return $this->resultado;
  }
//******************************************************************
  function menu_session(){
    $Bord_left=$this->left;
    $Centro=$Bord_left+4;
    $Bord_rigt=$Centro+120;
    $this->resultado="
      <td width=\"4px\" height=\"25px\"><div id=\"Layer101\" style=\"position:absolute; width:4px; height:20px; z-index:101; top: 0px; left:".$Bord_left."px;\" class=\"divDentroBorder_Izq\"></div></td>
      <td width=\"120px\" height=\"25px\"><div id=\"Layer10\" style=\"position:absolute; width:120px; height:20px; z-index:10; top: 0px; left:".$Centro."px;\" class=\"div1Dentro\" onMouseOver=\"CambiarFondo('Layer10','Layer101','Layer102','1','1')\" onMouseOut=\"CambiarFondo('Layer10','Layer101','Layer102','0','1')\" onClick=\"Cerrar_Session()\">
        <div align=\"center\"><strong><img src=\"../Imagenes/person.gif\" width=\"18\" height=\"18\" align=\"absbottom\">Cerrar Sesi&oacute;n</strong></div>
      </div></td>
      <td width=\"4px\" height=\"25px\"><div id=\"Layer102\" style=\"position:absolute; width:4px; height:20px; z-index:102; top: 0px; left:".$Bord_rigt."px;\" class=\"divDentroBorder_Der\"></div></td>";
    $this->left=$Bord_rigt+4;
    return $this->resultado;
  }
//******************************************************************
  function menu_principal($pag){
	$banderaE=0;
	$banderaCoo=0;
	$banderaS=0;
  	$banderaR=0;
	$banderaC=0;
    $this->left=-80;
	$this->Operacion("SELECT * FROM perfil_usuari WHERE ci_usu='$_SESSION[ci]' AND peu_sta='1' and per_id='$_SESSION[idper]'");
    $num_filas=$this->NumFilas();
/*		echo "<script>alert('$_SESSION[idper]');</script>";*/
	if($num_filas>0){
	$idper=$_SESSION[idper];
    $_SESSION[per_id]=$idper;
    $res=$this->OperacionCualquiera("SELECT * FROM tab_ope WHERE per_id='$idper' AND tab_ope_sta='1'");
	while($array=$this->ConsultarCualquiera($res)){
/*	echo "<script>alert('$array->tab_id && ($array->ope_id)');</script>";*/
/*	  if($array->tab_id=='1' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
	    $banderaC=1;
	    if($array->ope_id=='5')
		  $banderaF=1;
	  }
	  if($array->tab_id=='2' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
	    $banderaC=1;
	    if($array->ope_id=='5')
		  $banderaF=1;
	  }
	  if($array->tab_id=='3' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
	    $banderaC=1;
	  }
	  if($array->tab_id=='4' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
	    $banderaC=1;
	  }*/
	  //estado  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='5' && ($array->ope_id=='1' || $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //municipio  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='6' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //perfil  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='7' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //beca  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='8' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //bitacora  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  /*if($array->tab_id=='9' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
	    $banderaC=1;
	  }*/
	  //tab_ope  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='10' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //idioma  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='11' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //incapacidad  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='12' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //pais  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='13' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //ciudad  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='14' && ($array->ope_id=='1' || $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //perfil_usuri  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='15' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //etnia  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='16' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //deport  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='17' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //estudi_deport  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='18' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //perso_idioma  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='19' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //perso_incapa  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='20' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //comil  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='21' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //nacionali  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='22' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //perso_bec  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='23' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //dir_hon  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='24' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //usuari  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='25' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //expedi  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='26' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaS=1;
/*		  echo "<script>alert('ENTRE SECRETARIA $banderaS $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //persona  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='27' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //proces  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='28' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //hisest  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='29' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='4'){
		  $banderaE=1;
/*		  echo "<script>alert('ENTRE ESTUDIANTE $banderaE $array->tab_id, $array->ope_id');</script>";*/
		}
		if($array->ope_id=='3'){
		  $banderaS=1;
/*		  echo "<script>alert('ENTRE SECRETARIA $banderaS $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //observ  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='30' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //inscri  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='31' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaS=1;
/*		  echo "<script>alert('ENTRE SECRETARIA $banderaS $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //matri  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='32' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaS=1;
/*		  echo "<script>alert('ENTRE SECRETARIA $banderaS $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //perso_inst  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='33' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //cargo_depart_emplea  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='34' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
	      $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //estudi_infrae  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='35' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //detins  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='36' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1'){
		  $banderaE=1;
/*		  echo "<script>alert('ENTRE ESTUDIANTE $banderaE $array->tab_id, $array->ope_id');</script>";*/
		}
		if($array->ope_id=='3'){
		  $banderaD=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }	
	  //instit  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='37' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //nivela  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='38' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //seccio  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='39' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='6' || $array->ope_id=='7'){
	      $banderaCoo=1;
/*		  echo "<script>alert('ENTRE COORDINADOR $banderaCoo $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //cohort  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='40' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //asigna_seccio  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='41' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='6' || $array->ope_id=='7'){
		  $banderaCoo=1;
/*		  echo "<script>alert('ENTRE COORDINADOR $banderaCoo $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //tipomat  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='42' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //pensum  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='43' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaS=1;
/*		  echo "<script>alert('ENTRE SECRETARIA $banderaS $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //especi  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='44' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //deport  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='45' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //pacade  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='46' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaS=1;
/*		  echo "<script>alert('ENTRE SECRETARIA $banderaS $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //asigna  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='47' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaS=1;
/*		  echo "<script>alert('ENTRE SECRETARIA $banderaS $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //reg_esp_mod  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='48' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaS=1;
/*		  echo "<script>alert('ENTRE SECRETARIA $banderaS $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //regimen  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='49' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //cargo  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='50' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //infrae  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='51' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //requis  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='52' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaS=1;
/*		  echo "<script>alert('ENTRE SECRETARIA $banderaS $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //tabequi  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='53' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaS=1;
/*		  echo "<script>alert('ENTRE SECRETARIA $banderaS $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //modali  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='54' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //reg_esp_mod_infrae  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='55' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaS=1;
/*		  echo "<script>alert('ENTRE SECRETARIA $banderaS $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //nucleo  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='56' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //modali_ingr  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='57' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //reposo  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='58' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1'){
		  $banderaCoo=1;
/*		  echo "<script>alert('ENTRE COORDINADOR $banderaCoo $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //inasistencia  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='59' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaD=1;
/*		  echo "<script>alert('ENTRE DOCENTE $banderaD $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	  //depart_cargo  1=insertar, 2=consultar, 3=modificar, 4=eliminar, 5=listar, 6=imprimir, 7=descargar
	  if($array->tab_id=='60' && ($array->ope_id=='1'|| $array->ope_id=='2' ||$array->ope_id=='3' || $array->ope_id=='4' || $array->ope_id=='5' || $array->ope_id=='6')){
		if($array->ope_id=='1' || $array->ope_id=='3' || $array->ope_id=='4'){
		  $banderaC=1;
/*		  echo "<script>alert('ENTRE MANTENIMIENTO $banderaC $array->tab_id, $array->ope_id');</script>";*/
		}
	  }
	}
/*	echo "<script>alert('$banderaC, $banderaCoo, $banderaD, $banderaS, $banderaR');</script>";*/
	$home=$this->menu_home();
	if($banderaE==1 && ($idper=='1' || $idper=='4'))
      $estudiante=$this->menu_estudiante();
	if($banderaD==1 && ($idper=='1' || $idper=='3'))
      $docente=$this->menu_docente();
	if($banderaCoo==1 && ($idper=='1' || $idper=='2' || $idper=='6'))
      $coordinador=$this->menu_coordinador();
	if(($banderaS==1 && ($idper=='1' || $idper=='5' || $idper=='8')) || $idper=='7' || $idper=='9')
      $Secretaria=$this->menu_Secretaria();
	if($banderaR==1 && ($idper=='1'))
      $reporte=$this->menu_reportes();
	if($banderaC==1)
      $configuracion=$this->menu_configuracion();
	}
	else{	  
	  $_SESSION['idper']="";
      $_SESSION['per_id']="";
	  $_SESSION['passwo']="";
	  $_SESSION['ci']="";
	}
    $contactos=$this->menu_contactos();
    $ayuda=$this->menu_ayuda($pag);
    $session=$this->menu_session();
    $this->resultado="<tr>".$home.$estudiante.$docente.$coordinador.$Secretaria.$reporte.$configuracion.$contactos.$ayuda.$session."</tr>";
    return $this->resultado;
  }
//******************************************************************
}
?>