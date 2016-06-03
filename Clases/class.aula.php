<?php session_start();
class aula extends conec_BD
{
 var $id='';
 var $inf_id='';
 var $aul_nom='';
 var $aul_ubi='';
 var $sta='';
//******************************************************************
  function aula($id,$inf_id,$aul_nom,$aul_ubi,$sta){
    $this->id=$id;
    $this->inf_id=$inf_id;
	$this->aul_nom=$this->ConvertirMayuscula($aul_nom);
    $this->aul_ubi=$aul_ubi;
    $this->sta=$sta;
  }
//******************************************************************
  function Contar_aula_Nucleo_Infrae($nuc_id,$inf_id){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT A.aul_id as 'aul_id', A.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.aul_nom AS 'aul_nom', A.aul_ubi AS 'aul_ubi' FROM aulas A, infrae B, nucleo C WHERE A.aul_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND C.nuc_id='$nuc_id' AND B.inf_id='$inf_id'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_aula_Nucleo_Infrae($nuc_id,$inf_id,$inicial,$cantidad){
    $resultado=$this->Operacion("SELECT A.aul_id as 'aul_id', A.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.aul_nom AS 'aul_nom', A.aul_ubi AS 'aul_ubi' FROM aulas A, infrae B, nucleo C WHERE A.aul_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND C.nuc_id='$nuc_id' AND B.inf_id='$inf_id' order by C.nuc_nom,B.inf_nom,aul_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Infrae($nuc_id){
    $resultado=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' order by A.inf_nom");
	return $resultado;
  }
//******************************************************************
  function Contar_aula_Nucleo_Todas($nuc_id){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT A.aul_id as 'aul_id', A.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.aul_nom AS 'aul_nom', A.aul_ubi AS 'aul_ubi' FROM aulas A, infrae B, nucleo C WHERE A.aul_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND C.nuc_id='$nuc_id'");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_aula_Nucleo_Todas($nuc_id,$inicial,$cantidad){
    $resultado=$this->Operacion("SELECT A.aul_id as 'aul_id', A.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.aul_nom AS 'aul_nom', A.aul_ubi AS 'aul_ubi' FROM aulas A, infrae B, nucleo C WHERE A.aul_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND C.nuc_id='$nuc_id' order by C.nuc_nom,B.inf_nom,aul_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Listado_Infraestructura_Nucleo($nuc_id){
    $id=$nom="";
    $cuantos=0;
    $resp=$this->OperacionCualquiera("SELECT A.inf_id AS 'inf_id', A.inf_nom AS 'inf_nom' FROM infrae A, nucleo B WHERE A.nuc_id=B.nuc_id AND B.nuc_id='$nuc_id' AND A.inf_sta='1' order by A.inf_nom DESC");
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
    $resultado=$this->Operacion("SELECT * FROM nucleo WHERE nuc_sta='1' order by nuc_nom");
    return $resultado;
  }
//******************************************************************
  function Contar_aula_Todas(){
    $num_filas='';
    //$this->ci=$_SESSION['nacid'];
    $this->Operacion("SELECT A.aul_id as 'aul_id', A.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.aul_nom AS 'aul_nom', A.aul_ubi AS 'aul_ubi' FROM aulas A, infrae B, nucleo C WHERE A.aul_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id");
    $num_filas=$this->NumFilas();
    return $num_filas;
  }
//******************************************************************
  function Listado_aula_Todas($inicial,$cantidad){
    $resultado=$this->Operacion("SELECT A.aul_id as 'aul_id', A.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_nom AS 'nuc_nom', A.aul_nom AS 'aul_nom', A.aul_ubi AS 'aul_ubi' FROM aulas A, infrae B, nucleo C WHERE A.aul_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id order by C.nuc_nom,B.inf_nom,aul_nom LIMIT $cantidad OFFSET $inicial");
    return $resultado;
  }
//******************************************************************
  function Asignar_valores($id,$inf_id,$aul_nom,$aul_ubi,$sta){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->id=$id;
    $this->inf_id=$inf_id;
/*    echo "<script>alert('id: $this->id');</script>";*/
	$this->aul_nom=$this->ConvertirMayuscula($aul_nom);
    $this->aul_ubi=$this->ConvertirMayuscula($aul_ubi);
    $this->sta=$sta;
  }
//******************************************************************
  function Buscar_aula($id){
/*      echo "<script>alert('id: $id');</script>";*/
    $this->Operacion("SELECT A.aul_id as 'aul_id', A.inf_id AS 'inf_id', B.inf_nom AS 'inf_nom', C.nuc_id AS 'nuc_id', C.nuc_nom AS 'nuc_nom', A.aul_nom AS 'aul_nom', A.aul_ubi AS 'aul_ubi' FROM aulas A, infrae B, nucleo C WHERE A.aul_sta='1' AND A.inf_id=B.inf_id AND B.nuc_id=C.nuc_id AND A.aul_id='$id'");
  }
//******************************************************************
  function Buscar_Nombre(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $this->Operacion("SELECT A.aul_id as 'aul_id', A.inf_id AS 'inf_id' FROM aulas A, infrae B WHERE A.aul_nom='$this->aul_nom' AND A.aul_sta='1' AND A.inf_id=B.inf_id AND A.inf_id='$this->inf_id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Nombre2(){
    /*echo "<script>alert('Password: $this->passwo login: $this->login');</script>";*/
    $row=0;
    $resp=$this->Operacion("SELECT A.aul_id as 'aul_id', A.inf_id AS 'inf_id' FROM aulas A, infrae B WHERE A.aul_nom='$this->aul_nom' AND A.aul_sta='1' AND A.inf_id=B.inf_id AND A.inf_id='$this->inf_id' AND aul_id!='$this->id'");
    $num_filas=$this->NumFilas();
    if($num_filas>0)
      $row=1;
    return $row;
  }
//******************************************************************
  function Buscar_Nombre3(){
    /*echo "<script>alert('SELECT A.aul_id as aul_id, A.inf_id AS inf_id FROM aulas A, infrae B WHERE A.aul_nom=$this->aul_nom AND A.inf_id=B.inf_id AND A.inf_id=$this->inf_id');</script>";*/
    $row=0;
    $resp=$this->Operacion("SELECT A.aul_id as 'aul_id', A.inf_id AS 'inf_id' FROM aulas A, infrae B WHERE A.aul_nom='$this->aul_nom' AND A.inf_id=B.inf_id AND A.inf_id='$this->inf_id'");
    return $resp;
  }
//****************************************************************************************************

  function Agregar_aula(){
    $res=$this->Operacion("INSERT INTO aulas (aul_id, inf_id, aul_nom, aul_ubi, aul_sta)
						VALUES ('$this->id','$this->inf_id','$this->aul_nom', '$this->aul_ubi', '$this->sta')");
    $num_filas=$this->filas_afectadas($res);
	if($num_filas>0)
	  $ultimo=mysql_insert_id();
	else
	  $ultimo=$num_filas;
    return $ultimo;
  }
//******************************************************************
  function Modificar_aula(){
    $res=$this->Operacion("UPDATE aulas set aul_nom='$this->aul_nom', aul_ubi='$this->aul_ubi' WHERE aul_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Modificar_aula2($id){
    $res=$this->Operacion("UPDATE aulas set aul_nom='$this->aul_nom', aul_ubi='$this->aul_ubi', aul_sta='1' WHERE aul_id='$id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
  function Eliminar_aula(){
    $res=$this->Operacion("UPDATE aulas set aul_sta='$this->sta' WHERE aul_id='$this->id'");
    $num_filas=$this->filas_afectadas($res);
    return $num_filas;
  }
//******************************************************************
}?>