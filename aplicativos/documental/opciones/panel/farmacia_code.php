<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();
if(@$_SESSION['ces1313777_sessid_inicio'])
{


$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
?>
<style type="text/css">
<!--
.css_uno {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #000000;
}
.css_dos {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}

/* standard list style table */
table.adminlist {
	background-color: #FFFFFF;
	margin: 0px;
	padding: 0px;
	border: 1px solid #ddd;
	border-spacing: 0px;
	width: 70%;
	border-collapse: collapse;
}

table.adminlist th {
	margin: 0px;
	padding: 2px 2px 2px 2px;
	height: 20px;
	background-repeat: repeat;
	font-size: 10px;
	color: #000;
}
table.adminlist th.title {
	text-align: left;
}

table.adminlist th a:link, table.adminlist th a:visited {
	color: #c64934;
	text-decoration: none;
}

table.adminlist th a:hover {
	text-decoration: underline;
}

table.adminlist tr.row0 {
	background-color: #F9F9F9;
}
table.adminlist tr.row1 {
	background-color: #FFF;
}
table.adminlist td {
    font-size: 10px;
	border-bottom: 1px solid #e5e5e5;
	padding: 2px 2px 2px 2px;
}
table.adminlist tr.row0:hover {
	background-color: #f1f1f1;
}
table.adminlist tr.row1:hover {
	background-color: #f1f1f1;
}
table.adminlist td.options {
	background-color: #ffffff;
	font-size: 8px;
}
select.options, input.options {
	font-size: 8px;
	font-weight: normal;
	border: 1px solid #999999;
}
/* standard form style table */
-->
</style>

<style type="text/css">
<!--
.style1 {
	font-size: 10px;
	font-weight: bold;
}
.style2 {font-size: 10px}
-->
</style>

<br /><br />
<div align="center">
ALERTA!!! LOS MEDICAMENTOS Y DISPOSITIVOS SOLO SE PUEDEN ENTREGAR HASTA 72 HORAS

<table width="400" align="center" class="adminlist" >
<tr>
 				<th colspan="3" align="left" bgcolor="#D2E2E3">
 					<div align="center"><strong>
					    <b> &nbsp;&nbsp;&nbsp;DESPACHO MEDICAMENTOS </b>
			      </strong>			      </div></th>
  </tr>
<tr>
  <td colspan="3"><div align="center"><strong>Historia cl&iacute;nica:</strong> 
      <input name="nhc" type="text" id="nhc" value=""  autocomplete="off" />
      <input type="button" name="Button" value="Buscar" onclick="ejecutaz_data();" />
      <input type="button" name="Button2" value="Ver Historial" onclick="ejecutaz_datahisto();" />
  </div></td>
</tr>
<tr>
  <td width="49%" bgcolor="#D0DBDF" class="css_uno"><div align="center" id="label_sind" >SIN DESPACHAR </div></td>
  <td width="6%" class="css_uno"><div align="center"></div></td>
  <td width="45%" bgcolor="#D0DBDF" class="css_uno"><div align="center" id="label_desp" >DESPACHADO</div></td>
</tr>
<tr>
<td valign="top"><div id="grid_recetan" ></div></td>
<td><p align="center">&nbsp;</p>
  <p align="center">&nbsp;</p></td>
<td valign="top"><div id="grid_recetad" ></div></td>
</tr>
</table>
</div><br><br><br>

<script type="text/javascript">

function desplega_recetasnd_h()
{
  
  $("#grid_recetan").load("aplicativos/documental/opciones/panel/farmacia/recetas_sindespacharh.php",{

  nhc:$('#nhc').val()

  },function(result){  


  });  

  $("#grid_recetan").html("Espere un momento...");  


}

function desplega_recetassd_h()
{
  
  $("#grid_recetad").load("aplicativos/documental/opciones/panel/farmacia/recetas_despachadash.php",{

  nhc:$('#nhc').val()

  },function(result){  


  });  

  $("#grid_recetad").html("Espere un momento...");  


}


function desplega_recetasnd()
{
  
  $("#grid_recetan").load("aplicativos/documental/opciones/panel/farmacia/recetas_sindespachar.php",{

  nhc:$('#nhc').val()

  },function(result){  


  });  

  $("#grid_recetan").html("Espere un momento...");  


}

function desplega_recetassd()
{
  
  $("#grid_recetad").load("aplicativos/documental/opciones/panel/farmacia/recetas_despachadas.php",{

  nhc:$('#nhc').val()

  },function(result){  


  });  

  $("#grid_recetad").html("Espere un momento...");  


}

function ejecutaz_data()
{

   desplega_recetasnd();
   desplega_recetassd();
   
   $('#label_sind').html('SIN DESPACHAR');
   $('#label_desp').html('DESPACHADO');
   

}

function ejecutaz_datahisto()
{

   desplega_recetasnd_h();
   desplega_recetassd_h();
   
   $('#label_sind').html('HISTORICO SIN DESPACHAR');
   $('#label_desp').html('HISTORICO DESPACHADO');

}


</script>

<?php
}
?>
