<?php
header('Content-Type: text/html; charset=UTF-8'); 
include("../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
define("UTF_8", 1);
define("ASCII", 2);
define("ISO_8859_1", 3);

if($_SESSION['ces1313777_sessid_inicio'])
{
$formato_pdf=0;
 $subindice="_facturas";

$director="../../../../";
include ("../../../../cfgclases/clases.php");


$banderaencontro='';
$busca_facturaguardad="select * from ca_factura_cabecera where comcab_id='".$_POST["pcomcab_id"]."'";

$rs_bfactura = $DB_gogess->Execute($busca_facturaguardad);
if($rs_bfactura)
{
   while (!$rs_bfactura->EOF) {
		
        $banderaencontro=$rs_bfactura->fields["comcab_id"];

        $rs_bfactura->MoveNext(); 
   }
}
if($banderaencontro)
{
?>
<input name="existe_factura" type="hidden" id="existe_factura" value="1" />
<?php
}
else
{
?>
<input name="existe_factura" type="hidden" id="existe_factura" value="0" />
<?php
}

}
else
{
echo 'Por favor vuelva a ingresar al sistema la sesion ha terminado...';
}

?>