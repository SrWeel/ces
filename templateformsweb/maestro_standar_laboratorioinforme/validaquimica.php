<?php
$tiempossss=4450000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

//echo $_POST["cant_val"]."<br>";
//echo $_POST["produ_id"]."<br>";
//echo $_POST["enlace"]."<br>";
if($_SESSION['ces1313777_sessid_inicio'])
{
$ic=0;
$busca_cliente="select tarterial_id,clie_genero from app_cliente where clie_id=".$_POST["clie_id"];
$rs_cliente = $DB_gogess->executec($busca_cliente,array());
$genero_clie=$rs_cliente->fields["clie_genero"];

$lista_valid="select * from dns_tipoquimica where tqui_id='".utf8_encode($_POST["gquimica_tipox"])."'";
$unidad_medida='';
$valor_referncia='';
$rs_valid = $DB_gogess->executec($lista_valid,array());
 if($rs_valid)
 {
	  while (!$rs_valid->EOF) {	

	    if($genero_clie=='F')
		{
			$unidad_medida=$rs_valid->fields["tqui_unidad"];
			$valor_referncia=$rs_valid->fields["tqui_mi"]."".$rs_valid->fields["tqui_mf"];
			 
			
			
		}
		else
		{
			$unidad_medida=$rs_valid->fields["tqui_unidad"];
			$valor_referncia=$rs_valid->fields["tqui_hi"]."".$rs_valid->fields["tqui_hf"];
	
		}
	  
	  $rs_valid->MoveNext();	
	  }
}	  



}
?>
<script>
$('#gquimica_unidadx').val('<?php echo $unidad_medida; ?>');
$('#gquimica_valorx').val('<?php echo $valor_referncia; ?>');
</script>