<?php
$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

?>
<style type="text/css">
<!--

body,td,th {

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-size: 11px;

}
.css_cantidad {

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-size: 12px;

}
.css_cantidadterapia {

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-size: 11px;

}
css_cantidadterapiab
{

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-size: 11px;
}
-->
</style>
<script language="javascript">
<!--



//-->
</script>


<table border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>

     <td>&nbsp;</td>

    <td>
	 <input name="valor_b" type="text" id="valor_b" class="form-control" />
	
	</td>
    <td>&nbsp;</td>

    <td><input type="button" name="Submit" value="BUSCAR" onClick="desplegar_personal()" > </td>

    <td>&nbsp;</td>
  </tr>
</table>

<br />
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="89%" valign="top"><div id="list_personal" ></div></td>
  </tr>
</table>


<script language="javascript">
<!--

function desplegar_personalbtn(prof_id)
{

$("#list_personal").load("templateformsweb/maestro_standar_recibos/lista_personal.php",{

valor_b:'',
pVar1:'<?php echo $_POST["pVar1"]; ?>',
tippo_id:'<?php echo $_POST["pVar2"]; ?>',
prof_nombreval:$('#prof_nombreval').val(),
prof_id:prof_id,
conve_id:'<?php echo $_POST["pVar5"]; ?>',
doccab_autorizacion:'<?php echo $_POST["pVar6"]; ?>'


 },function(result){       

			 

  });  

  $("#list_personal").html("Espere un momento...");



}

function desplegar_personal()
{

$("#list_personal").load("templateformsweb/maestro_standar_recibos/lista_personal.php",{

valor_b:'',
pVar1:'<?php echo $_POST["pVar1"]; ?>',
tippo_id:'<?php echo $_POST["pVar2"]; ?>',
prof_nombreval:$('#prof_nombreval').val(),
conve_id:'<?php echo $_POST["pVar5"]; ?>',
doccab_autorizacion:'<?php echo $_POST["pVar6"]; ?>',
valor_b:$('#valor_b').val()


 },function(result){       

			 

  });  

  $("#list_personal").html("Espere un momento...");



}

desplegar_personalbtn('0');

//-->
</script>