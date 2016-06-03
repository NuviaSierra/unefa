<?php
class plantilla{
  var $resultado;
  var $consulta;
  var $Objeto;
//******************************************************************
  function plantilla($resultado,$consulta,$Objeto){
    $this->resultado=$resultado;
    $this->consulta=$consulta;
    $this->Objeto=$Objeto;
  }
//******************************************************************
  function borde(){
    $this->resultado="<tr>
        <td width=\"100%\">&nbsp;</td>
      </tr>
      <tr>
        <td width=\"100%\">&nbsp;</td>
      </tr>
      <tr>
        <td width=\"100%\" colspan=\"3\">
          <table style=\"width: 100%;\" border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
            <tr>";
      $Fecha=date("Y-m-d")."%";
      $a=explode("-",$Fecha);
              $this->resultado.="<td width=\"100%\"><div align=\"center\"><font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>&copy; Copyrigh@".$a[0]."&nbsp;www.unefa-tachira.edu.ve</strong></font></div></td>
            </tr>
            <tr>
              <td width=\"100%\">&nbsp;</td>
            </tr>
            <tr>
              <td width=\"100%\"><div align=\"center\"><font color=\"#000000\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><strong>DIVISION DE SECRETARIA NUCLEO TACHIRA</strong></font></div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>";
    return $this->resultado;
  }
//******************************************************************
  function table_scroll_ini($forma){
    $this->resultado="<table width=\"100%\" height=\"100%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\">
   <tr>
     <td colspan=\"1\"><div id=\"container2\">
       <table style=\"width:100%; text-align:center; margin-left:0; margin-right:0; margin-center:0;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">
         <tr>
           <td width=\"100%\">
             <table style=\"width: 100%; text-align:0; margin-left:0; margin-right:0;\" height=\"100%\" border=\"1\" align=\"left\" cellpadding=\"6\" cellspacing=\"2\" bordercolor=\"#777A4B\" bgcolor=\"#ffffff\">";
    /*echo "<script> alert('$this->resultado');</script>";*/
     return $this->resultado;
  }
//******************************************************************
  function table_scroll_fin(){
    $borde=$this->borde();
    $this->resultado="
             </table>
           </td>
         </tr>".$borde."
       </table></div>
     </td>
   </tr>
 </table>";
    /*echo "<script> alert('$this->resultado');</script>";*/
    return $this->resultado;
  }
}
?>