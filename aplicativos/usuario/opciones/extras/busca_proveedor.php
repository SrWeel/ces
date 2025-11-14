<?php
ini_set("session.gc_maxlifetime","14400");
session_start();


if($_SESSION['ces1313777_sessid_inicio'])
{
$director="../../../../";
include ("../../../../cfgclases/clases.php");
 
  $buscacliente="select * from ca_proveedor where prov_ciruc='".$_POST["pruc"]."'";
 
  
  $rs_bcliente = $DB_gogess->Execute($buscacliente);
  if($rs_bcliente)
  {
     	while (!$rs_bcliente->EOF) {
		
		
		$prov_ciruc=$rs_bcliente->fields["prov_ciruc"];
		$prov_nombre=$rs_bcliente->fields["prov_nombre"];
		$prov_apellido=$rs_bcliente->fields["prov_apellido"];
		$prov_direccion=$rs_bcliente->fields["prov_direccion"];
		$prov_telefono=$rs_bcliente->fields["prov_telefono"];
		$prov_mail=$rs_bcliente->fields["prov_mail"];

		
		$rs_bcliente->MoveNext();
		}
		
   }	



if($prov_ciruc)
{
?>
<input name="rucci_enc" type="hidden" id="rucci_enc" value="<?php echo $prov_ciruc ?>" />
<input name="nombreapellido_enc" type="hidden" id="nombreapellido_enc" value="<?php echo $prov_nombre." ".$prov_apellido ?>" />
<input name="direccion_enc" type="hidden" id="direccion_enc" value="<?php echo $prov_direccion ?>" />
<input name="telefono_enc" type="hidden" id="telefono_enc" value="<?php echo $prov_telefono ?>" />
<input name="email_enc" type="hidden" id="email_enc" value="<?php echo $prov_mail  ?>" />
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
<input name="encuentra_enc" type="hidden" id="encuentra_enc" value="0" />
<?php
}

}
?>
