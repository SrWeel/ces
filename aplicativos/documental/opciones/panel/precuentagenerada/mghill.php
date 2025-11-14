<?php
$tiempossss=444500000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../../';
include("../../../../../cfg/clases.php");
include("../../../../../cfg/declaracion.php");

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
    <td><div align="center"><strong>CODIGO</strong></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><strong>PORCENTAJE</strong></div></td>
    <td>&nbsp;</td>
    <td><div align="center"><strong>CANTIDAD</strong></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>

     <td>&nbsp;</td>

    <td>
	  <input name="valor_b" type="text" id="valor_b" class="form-control" />	</td>
    <td>&nbsp;</td>

    <td><input name="valor_porcentajex" type="text" id="valor_porcentajex" class="form-control" /></td>
    <td>&nbsp;</td>
    <td><input name="cant_valor" type="text" id="cant_valor" value="1" size="10" /></td>
    <td>&nbsp;</td>
    <td><input type="button" name="Submit" value="BUSCAR" onClick="desplegar_tarihill()" ></td>

    <td>&nbsp;</td>
  </tr>
</table>


<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="89%" valign="top"><div id="list_personal" ></div></td>
  </tr>
</table>


<script language="javascript">
<!--

function desplegar_personalbtn(prof_id)
{

$("#list_personal").load("aplicativos/documental/opciones/panel/precuentagenerada/lista_thill.php",{

valor_b:'',
pVar1:'<?php echo $_POST["pVar1"]; ?>',
prof_nombreval:$('#prof_nombreval').val(),
prof_id:prof_id,
conve_id:'<?php echo $_POST["pVar5"]; ?>',
doccab_autorizacion:'<?php echo $_POST["pVar6"]; ?>'


 },function(result){       

			 

  });  

  $("#list_personal").html("Espere un momento...");



}

function desplegar_tarihill()
{

$("#list_personal").load("aplicativos/documental/opciones/panel/precuentagenerada/lista_thill.php",{

valor_b:$('#valor_b').val(),
pVar1:'<?php echo $_POST["pVar1"]; ?>',
valor_porcentaje:$('#valor_porcentajex').val()


 },function(result){       

			 

  });  

  $("#list_personal").html("Espere un momento...");



}

//-->
</script>