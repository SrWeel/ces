<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
$tiempossss=5414000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

if($_SESSION['datafrank_sessid_inicio'])
{
	//echo $_POST["valorp"];

     $busca_sidata="select docfpag_id,docfpag_valor from beko_documentoformapago where frm_id=".$_POST["frm_idp"]." and doccab_id='".$_POST["doccab_idp"]."'";
     $rs_bdata = $DB_gogess->executec($busca_sidata,array());
	 if($rs_bdata->fields["docfpag_id"])
	 {
	   $actualiza="update beko_documentoformapago set docfpag_valor='".$_POST["valorp"]."' where frm_id=".$_POST["frm_idp"]." and doccab_id='".$_POST["doccab_idp"]."'";
	   $rs_actualiza = $DB_gogess->executec($actualiza,array());
	 }
	 else
	 {
	  $inserta="insert into beko_documentoformapago (frm_id,doccab_id,docfpag_valor) values (".$_POST["frm_idp"].",'".$_POST["doccab_idp"]."',".$_POST["valorp"].")";
	   $rs_inserta = $DB_gogess->executec($inserta,array());
	 
	 }



}


$busca_sidata="select sum(docfpag_valor) as total_suma from beko_documentoformapago where doccab_id='".$_POST["doccab_idp"]."'";
$rs_bdata = $DB_gogess->executec($busca_sidata,array());
$numero_data=number_format($rs_bdata->fields["total_suma"], 2, '.', '');


?>

<script language="javascript">
<!--
$('#total_valor').html("<?php echo $numero_data; ?>");
//-->
</script>

<?php

$lista_fpagot="select doccab_total from beko_documentocabecera where doccab_id='".$_POST["doccab_idp"]."'";
$rs_datat = $DB_gogess->executec($lista_fpagot,array());
if($rs_datat->fields["doccab_total"]!=$numero_data)
{
	
	$mensaje="Valor no coincide con el total de la factura...";
}
echo $mensaje;
?>
