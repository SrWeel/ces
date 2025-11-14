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

for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 


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

	width: 100%;

	border-collapse: collapse;

}



table.adminlist th {

	margin: 0px;

	padding: 6px 4px 2px 4px;

	height: 25px;

	background-repeat: repeat;

	font-size: 11px;

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

	border-bottom: 1px solid #e5e5e5;

	padding: 6px 4px 2px 15px;

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

.Estilo1 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }

/* standard form style table */

-->

</style><br /><br />

<div align="center"><!-- 



<table width="400" border="0" cellpadding="2" cellspacing="0">

  <tr>

    <td colspan="3"><div align="center" class="Estilo1">PLANILLAS</div></td>

    </tr>

  <tr>

    <td bgcolor="#D1E7EF"><div align="right"><span class="Estilo1">MES</span></div></td>

    <td bgcolor="#D1E7EF"><span class="Estilo1">

      <select name="mes_valor" id="mes_valor">

        <option value="01">ENERO</option>

        <option value="02">FEBRERO</option>

        <option value="03">MARZO</option>

        <option value="04">ABRIL</option>

        <option value="05">MAYO</option>

        <option value="06">JUNIO</option>

        <option value="07">JULIO</option>

        <option value="08">AGOSTO</option>

        <option value="09">SEPTIEMBRE</option>

        <option value="10">OCTUBRE</option>

        <option value="11">NOVIEMBRE</option>

        <option value="12">DICIEMBRE</option>

        </select>

    </span></td>

    <td rowspan="2" bgcolor="#D1E7EF">

	

	<div class="form-group">	

<div class="col-md-12">

<center>



	<div onclick="ver_reporte()">

	<img src="images/informe.png" >

	</div>



</center>

</div>

</div>	</td>

  </tr>

  <tr>

    <td bgcolor="#D1E7EF"><div align="right"><span class="Estilo1">A&Ntilde;O</span></div></td>

    <td bgcolor="#D1E7EF"><span class="Estilo1">

      <select name="anio_valor" id="anio_valor">

        <option value="2018">2018</option>

        <option value="2019">2019</option>

        </select>

    </span></td>

    </tr>

  <tr>

    <td>&nbsp;</td>

    <td colspan="2">&nbsp;</td>

  </tr>

</table> -->

<br /><br />


<?php 
//echo print_r($_SESSION);
?>

<table width="400" align="center" class="adminlist" >
<tr>
 				<th colspan="7" align="left" bgcolor="#D2E2E3">
 					<div align="center"><strong>
					    <b> &nbsp;&nbsp;&nbsp;REGISTRO DE ATENCIONES RDCAA</b>
			      </strong> </div></th>
</tr>
  <tr>
<td width="21%" class="css_dos">REGISTRO DE ATENCIONES RDCAA</td>
<td width="27%"> <select name="centro_id" id="centro_id" class="form-control" >
	     <option value="">-Establecimiento-</option>
		 <?php
			$objformulario->fill_cmb('dns_centrosalud','centro_id,centro_nombre',$_SESSION['ces1313777_centro_id'],' order by centro_id asc',$DB_gogess);
			?>
  </select></td>
<td width="12%"><select name="mes_valor" id="mes_valor" class="form-control" >
        <option value="">-MES-</option>
        <option value="01">ENERO</option>
        <option value="02">FEBRERO</option>
        <option value="03">MARZO</option>
        <option value="04">ABRIL</option>
        <option value="05">MAYO</option>
        <option value="06">JUNIO</option>
        <option value="07">JULIO</option>
        <option value="08">AGOSTO</option>
        <option value="09">SEPTIEMBRE</option>
        <option value="10">OCTUBRE</option>
        <option value="11">NOVIEMBRE</option>
        <option value="12">DICIEMBRE</option>
      </select></td>
<td width="7%"> <select name="anio_valor" id="anio_valor" class="form-control" >
        <option value="2018">2018</option>
        <option value="2019">2019</option>
		<option value="2019">2020</option>
      </select></td>
  <td width="16%">
  <select name="prase_valor" id="prase_valor" class="form-control" >
	     <option value="">-%-</option>
		 <?php
			$objformulario->fill_cmb('dns_porcentajeasegurado','prase_valor,prase_nombre','',' order by prase_valor desc',$DB_gogess);
			?>
  </select>  </td>
  <td width="8%">
  <div onClick="ver_reporte_rdcaa()">
	<img src="images/reporter.png" >	</div>  </td>
  <td width="9%">
  
  </tr>
</table>  
<br /><br />
<br />
<br />
<br />
</div>
<br><br><br>

<script type="text/javascript">
<!--
//-------------------------------------------------------------
// REPORTE RDACC
//------------------------------------------------------------
function ver_reporte_rdcaa()
{
   window.open('aplicativos/documental/opciones/report/report_rdcaa.php?prase_valor='+$('#prase_valor').val()+'&centro_id='+$('#centro_id').val()+'&mes_valor='+$('#mes_valor').val()+'&anio_valor='+$('#anio_valor').val(), '_blank');

}


function ver_documento_rdcaa()
{
   window.open('aplicativos/documental/opciones/report/documento_rdcaa.php?prase_valor='+$('#prase_valor').val()+'&centro_id='+$('#centro_id').val()+'&mes_valor='+$('#mes_valor').val()+'&anio_valor='+$('#anio_valor').val(), '_blank');

}

//---------------------------------------------------
//  End -->
</script>

<?php
}
else
{
 echo '<div style="font-family:11px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FF0000" align="center" >Sesi&oacute;n de usuario ha terminado porfavor de clic en F5 para continuar...</div>';
 
}	
?>
