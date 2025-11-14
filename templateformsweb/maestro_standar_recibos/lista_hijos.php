<?php
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();


$lista_hijos="select distinct clie_nombre,clie_apellido,app_cliente.clie_id from app_cliente inner join dns_representante on app_cliente.clie_enlace=dns_representante.clie_enlace where repres_ci='".trim($_POST["ci"])."'";



$rs_datahijos = $DB_gogess->executec($lista_hijos,array());


echo '<table width="200" border="1" cellpadding="0" cellspacing="0">
<tr>
    <td nowrap="nowrap" bgcolor="#6AB3C8" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:10px" ><center>HISTORIA CLINICA</center></td>
    <td bgcolor="#6AB3C8" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:10px" ><center>PACIENTE</center></td>
  </tr>
';
if($rs_datahijos)

 {

	  while (!$rs_datahijos->EOF) {	

        
		// busca atencion la ultima
		 
		//echo $busca_ateva="select * from dns_atencionevaluacion where clie_id=".$rs_datahijos->fields["clie_id"]." order by eteneva_id desc limit 1";
		//$rs_buscaateva = $DB_gogess->executec($busca_ateva,array());
		

		
		$busca_at="select * from dns_atencion where clie_id='".$rs_datahijos->fields["clie_id"]."' order by atenc_id desc";
		$rs_buscaat = $DB_gogess->executec($busca_at,array());
		
		// busca atencion la ultima
		$nombre_valor='';
		$nombre_valor=utf8_encode($rs_datahijos->fields["clie_nombre"]." ".$rs_datahijos->fields["clie_apellido"])."<br>";
		$comilla_simple="'";
		echo '<tr>
    <td nowrap="nowrap" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; cursor:pointer" onclick="ver_calendario('.$comilla_simple.$rs_datahijos->fields["clie_id"].$comilla_simple.','.$comilla_simple.$rs_buscaat->fields["atenc_hc"].$comilla_simple.','.$comilla_simple.$rs_buscaat->fields["centro_id"].$comilla_simple.')" >'.$rs_buscaat->fields["atenc_hc"].'</td>
    <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px" >'.$nombre_valor.'</td>
  </tr>';


        $rs_datahijos->MoveNext();	   

	  }

  }
echo '</table>';
?>