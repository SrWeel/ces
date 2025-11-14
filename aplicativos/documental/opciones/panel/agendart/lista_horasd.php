<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=45550000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");
?>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	
	
	
	<table width="180" border="1" align="center" cellpadding="0" cellspacing="0">

<?php
$lista_horas="select * from app_horas where hora_orden<12 order by hora_orden asc";
$rs_horas = $DB_gogess->executec($lista_horas,array());
				if($rs_horas)
                   {
	                  while (!$rs_horas->EOF) {	
					  
					  

  //$busca_siyauso="select * from faesa_terapiasregistro where atenc_hc='".$_POST["atenc_hc"]."' and especi_id='".$_POST["especi_idagt"]."' and usua_id='".$_POST["usua_idagt"]."' and terap_fecha='".$_POST["fecha_x"]."' and terap_hora='".$rs_horas->fields["hora_tiempo"]."' and centro_id='".$_POST["centro_id"]."'";
  
  
  $busca_siyauso="select * from faesa_terapiasregistro where especi_id='".$_POST["especi_idagt"]."' and usua_id='".$_POST["usua_idagt"]."' and terap_fecha='".$_POST["fecha_x"]."' and terap_hora='".$rs_horas->fields["hora_tiempo"]."' and centro_id='".$_POST["centro_id"]."'";
    
  $rs_siyauso = $DB_gogess->executec($busca_siyauso,array());
  
 
  
  
  if($rs_siyauso->fields["terap_id"])
  {
   $nombre_cliente="select * from app_cliente where clie_id=".$rs_siyauso->fields["clie_id"];
  $rs_ncliente = $DB_gogess->executec($nombre_cliente,array());
  echo '<tr>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;background-color:#E4E4E4" >'.$rs_ncliente->fields["clie_nombre"].'</td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;background-color:#E4E4E4" >'.$_POST["fecha_x"].'</td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;background-color:#E4E4E4" ><div align="right">'.$rs_horas->fields["hora_nombre"].'</div></td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;background-color:#E4E4E4" >&nbsp;</td>
  </tr> '; 
  
  }
  else
  {

  echo '<tr>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" ></td> 
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" >'.$_POST["fecha_x"].'</td> 
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" ><div align="right">'.$rs_horas->fields["hora_nombre"].'</div></td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" ><input id="val_hora" name="val_hora" type="radio" value="'.$rs_horas->fields["hora_nombre"].'" /></td>
  </tr> '; 
  }
                 
                    $rs_horas->MoveNext();
                         }
					}
					
 
?>  
</table>
	
	
	
	
	</td>
	
	<td>&nbsp;</td>
	
    <td>
	
	
	
	<table width="180" border="1" align="center" cellpadding="0" cellspacing="0">

<?php
$lista_horas="select * from app_horas where hora_orden>=12 order by hora_orden asc";
$rs_horas = $DB_gogess->executec($lista_horas,array());
				if($rs_horas)
                   {
	                  while (!$rs_horas->EOF) {	
					  
					  

  //$busca_siyauso="select * from faesa_terapiasregistro where atenc_hc='".$_POST["atenc_hc"]."' and especi_id='".$_POST["especi_idagt"]."' and usua_id='".$_POST["usua_idagt"]."' and terap_fecha='".$_POST["fecha_x"]."' and terap_hora='".$rs_horas->fields["hora_tiempo"]."' and centro_id='".$_POST["centro_id"]."'";
  
  
  $busca_siyauso="select * from faesa_terapiasregistro where especi_id='".$_POST["especi_idagt"]."' and usua_id='".$_POST["usua_idagt"]."' and terap_fecha='".$_POST["fecha_x"]."' and terap_hora='".$rs_horas->fields["hora_tiempo"]."' and centro_id='".$_POST["centro_id"]."'";
    
  $rs_siyauso = $DB_gogess->executec($busca_siyauso,array());
  
 
  
  
  if($rs_siyauso->fields["terap_id"])
  {
   $nombre_cliente="select * from app_cliente where clie_id=".$rs_siyauso->fields["clie_id"];
  $rs_ncliente = $DB_gogess->executec($nombre_cliente,array());
  echo '<tr>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;background-color:#E4E4E4" >'.$rs_ncliente->fields["clie_nombre"].'</td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;background-color:#E4E4E4" >'.$_POST["fecha_x"].'</td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;background-color:#E4E4E4" ><div align="right">'.$rs_horas->fields["hora_nombre"].'</div></td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px;background-color:#E4E4E4" >&nbsp;</td>
  </tr> '; 
  
  }
  else
  {

  echo '<tr>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" ></td> 
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" >'.$_POST["fecha_x"].'</td> 
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" ><div align="right">'.$rs_horas->fields["hora_nombre"].'</div></td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" ><input id="val_hora" name="val_hora" type="radio" value="'.$rs_horas->fields["hora_nombre"].'" /></td>
  </tr> '; 
  }
                 
                    $rs_horas->MoveNext();
                         }
					}
					
 
?>  
</table>
	
	
	
	
	
	</td>
  </tr>
</table>

<br>
<div align="center">
<input type="button" name="Submit" value="Agregar" onClick="guadar_hora()" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" >
</div>
<div id="g_horasd" ></div>
