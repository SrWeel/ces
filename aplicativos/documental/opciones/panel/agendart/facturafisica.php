<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('display_errors',0);
error_reporting(E_ALL);
$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

if(@$_SESSION['ces1313777_sessid_inicio'])
{

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

$buscat="select * from faesa_terapiasregistro where terap_id=".$_POST["pVar1"];
$rs_buscat = $DB_gogess->executec($buscat,array());

?>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#DBE4EA"><strong>FACTURA FISICA </strong></td>
  </tr>
  <tr>
    <td><div align="center">
      <p>&nbsp;        </p>
      <p>
        <input name="valor_fisica" type="text" id="valor_fisica" value="<?php echo $rs_buscat->fields["terap_nfactura"]; ?>">
      </p>
      <p>
        <input type="button" name="Submit" value="Guardar" onClick="guardafacturas_fisicas('<?php echo $_POST["pVar1"]; ?>')">
</p>
    </div></td>
  </tr>
</table>
<div id="guarda_t"></div>
<?php
}

?>
<script type="text/javascript">
<!--
function guardafacturas_fisicas(terap_id)
{
 
 
   $("#guarda_t").load("aplicativos/documental/opciones/panel/agendar/guarda_t.php",{
      terap_id:terap_id,
	  valor_fisica:$('#valor_fisica').val()
  },function(result){  



  });  

  $("#guarda_t").html("Espere un momento...");  
  
   
}
//  End -->
</script>
