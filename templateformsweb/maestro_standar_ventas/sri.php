<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=5444000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if($_SESSION['ces1313777_sessid_inicio'])
{

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

$doccab_id=$_POST["pVar1"];

$busca_auto="select * from beko_documentocabecera where doccab_id='".$doccab_id."'";
$result_baut = $DB_gogess->executec($busca_auto,array());

$doccab_estadosri=$result_baut->fields["doccab_estadosri"];

//echo $doccab_estadosri;

}

?>



<div id="ultima_vez"></div>
<div id="img_datav">
  <div align="center"><img src="images/img_procesando.gif" width="200" height="200" /></div>
</div>
<div id="co_data">



<div id="valor_a_facturar"></div>

<div class="row" align="center" >
   <div id="div_firma" class="col-sm-3"> 
	<div id="firma_btn" ><div onClick="firma_directa($('#doccab_id').val())" style="cursor:pointer" ><img src="images/firma.png"></div></div>
  </div> 

  <div id="div_srienviar" class="col-sm-3">
	<div id="sri_btn" ><div onClick="enviar_sri($('#doccab_id').val())" style="cursor:pointer" ><img src="images/sri.png"></div></div>
  </div>
  
  <div id="div_sriobtener" class="col-sm-3">
	<div onClick="obtener_sri($('#doccab_id').val())" style="cursor:pointer" ><img src="images/srirecibir.png"></div>
  </div>
  
   <div id="div_sriemail" class="col-xs-3">
	<div onClick="enviar_correo()" style="cursor:pointer" ><img src="images/sriemail.png"></div>
  </div>  
</div>  

</div>
 
<div id="area_sri"></div>

<?php
if($doccab_estadosri!='AUTORIZADO' and $doccab_estadosri!='RECIBIDA')
{
?>
<script language="javascript">
<!--
 $('#co_data').hide();	
 guarda_data();	 
	 //-->
</script>
<?php
}
else
{
?>
<script language="javascript">
<!--
 $('#co_data').show();
 $('#img_datav').hide();	 
	 //-->
</script>
<?php
}
?>