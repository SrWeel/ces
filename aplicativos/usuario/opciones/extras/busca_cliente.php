<?php
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{
$director="../../../../";
include ("../../../../cfgclases/clases.php");
 
 if(strtoupper($_POST["pruc"])=='CF')
 {
 $buscacliente="select * from ca_cliente where client_ciruc='9999999999999'";
 }
 else
 {
  $buscacliente="select * from ca_cliente where client_ciruc='".$_POST["pruc"]."'";
  }
  $rs_bcliente = $DB_gogess->Execute($buscacliente);
  if($rs_bcliente)
  {
     	while (!$rs_bcliente->EOF) {
		
		
		$client_ciruc=$rs_bcliente->fields["client_ciruc"];
		$client_nombre=str_replace('"',"",$rs_bcliente->fields["client_nombre"]);
		$client_apellido=str_replace('"',"",$rs_bcliente->fields["client_apellido"]);
		$client_direccion=str_replace('"',"",$rs_bcliente->fields["client_direccion"]);
		$client_telefono=$rs_bcliente->fields["client_telefono"];
		$client_mail=$rs_bcliente->fields["client_mail"];
        $tipodoc_codigocl=$rs_bcliente->fields["tipodoc_codigocl"];
		
		$rs_bcliente->MoveNext();
		}
		
   }	



if($client_ciruc)
{
?>
<input name="rucci_enc" type="hidden" id="rucci_enc" value="<?php echo $client_ciruc ?>" />
<input name="nombreapellido_enc" type="hidden" id="nombreapellido_enc" value="<?php echo $client_nombre." ".$client_apellido ?>" />
<input name="direccion_enc" type="hidden" id="direccion_enc" value="<?php echo $client_direccion ?>" />
<input name="telefono_enc" type="hidden" id="telefono_enc" value="<?php echo $client_telefono ?>" />
<input name="email_enc" type="hidden" id="email_enc" value="<?php echo $client_mail  ?>" />
<input name="tipodoc_enc" type="hidden" id="tipodoc_enc" value="<?php echo $tipodoc_codigocl  ?>" />
<input name="encuentra_enc" type="hidden" id="encuentra_enc" value="1" />


 
<?php
}
else
{
?>
<input name="rucci_enc" type="hidden" id="rucci_enc" value="" />
<input name="nombreapellido_enc" type="hidden" id="nombreapellido_enc" value="" />
<input name="direccion_enc" type="hidden" id="direccion_enc" value="" />
<input name="telefono_enc" type="hidden" id="telefono_enc" value="" />
<input name="email_enc" type="hidden" id="email_enc" value="" />
<input name="tipodoc_enc" type="hidden" id="tipodoc_enc" value="" />
<input name="encuentra_enc" type="hidden" id="encuentra_enc" value="0" />
<?php
}

}
?>
