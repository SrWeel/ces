<?php
include("lib_contable.php");
$obj_contable=new contable_funciones();
?>
<style>

		#calendar {

			font-family:Arial;

			font-size:12px;

		}

		#calendar caption {

			text-align:left;

			padding:5px 10px;

			background-color:#003366;

			color:#fff;

			font-weight:bold;

		}

		#calendar th {

			background-color:#006699;

			color:#fff;

			width:40px;

			border:thin solid #000000;

		}

		#calendar td {

			text-align: right;

            padding: 2px 5px;

            background-color: #eee;

            border: thin solid #1f1f2a;

		}

		#calendar .hoy {

			background-color:red;

		}

.Estilo3 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }

</style>


<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:1050px;">
<!-- <div class="alert alert-success"> <B>PANEL CLIENTE</B> </div>-->
<div id="lista_manos">
<!-- despliegue -->
<div class="panel panel-default">
 <div class="panel-heading">

    <h3 class="panel-title" style="color:#000033" >REPORTES</h3>

 </div>
<div class="panel-body">


<table width="800" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#F7F9FB" ><blockquote>
          <p><span class="Estilo1">LIBRO DIARIO</span></p>
        </blockquote></td>
  </tr>
  <tr>
    <td>
	
	<form action="" method="post" name="fa_cen1" class="Estilo1" id="fa_cen1">
  <table border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td>Desde</td>
      <td>&nbsp;</td>
      <td>Hasta</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	   <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input name="fecha_i" type="text" id="fecha_i" autocomplete="off" /></td>
      <td>&nbsp;</td>
      <td><input name="fecha_f" type="text" id="fecha_f" autocomplete="off" /></td>
      <td><input type="button" name="Submit" value="Ver Libro Diario" onclick="verlibrodiario_cen('aplicativos/documental/reportes/librodiario.php')" /></td>
      <td>&nbsp;</td>
      <td><input type="button" name="Submit2" value="Ver Libro Diario EXCEL" onclick="verlibrodiario_cen('aplicativos/documental/reportes/librodiario.php?exls=1')" /></td>
      <td>&nbsp;</td>
	   <td><input type="button" name="Submit2" value="Ver Libro Diario CSV" onclick="verlibrodiario_cen('aplicativos/documental/reportes/librodiariocsv.php?exls=1')" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <BR />

</form>




	</td>



  </tr>



</table>


</div>

</div>



<SCRIPT LANGUAGE=javascript>
<!--

	function verlibrodiario_cen(url)
		{			

		window.document.fa_cen1.action=url;
		window.document.fa_cen1.target='_blank';
		window.document.fa_cen1.submit();
		window.document.fa_cen1.target='_top';				

		}
		

$( "#fecha_i" ).datepicker({dateFormat: 'yy-mm-dd'});
$( "#fecha_f" ).datepicker({dateFormat: 'yy-mm-dd'});

//-->
</SCRIPT>