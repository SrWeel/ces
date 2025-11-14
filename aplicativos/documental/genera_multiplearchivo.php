<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44544000;
//ini_set("session.cookie_lifetime",$tiempossss);
//ini_set("session.gc_maxlifetime",$tiempossss);
//session_start();
$nombre_archivo_t='';
include("lib_excel.php");

$desde_val=$_GET["desde_val"];
$hasta_val=$_GET["hasta_val"];

$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");
include(@$director."libreria/estructura/aqualis_master.php");
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";

?>
<style type="text/css">
<!--
.TableScroll_fac {
        z-index:99;
		width:980px;
        height:550px;	
        overflow: auto;
      }

-->
</style>
<script type="text/javascript">
<!--

function ver_registrolista()
{

$("#archivo_plano").load("aplicativos/documental/srifile/archivo_plano.php",{
desde_val:$('#desde_val').val(),
hasta_val:$('#hasta_val').val(),
centro_id:$('#centro_id').val()

 },function(result){       


  });  

$("#archivo_plano").html("Espere un momento...");

}

function ver_registrolistaxlsx()
{

window.open('aplicativos/documental/srifile/excel.php?desde_val='+$('#desde_val').val()+'&hasta_val='+$('#hasta_val').val()+'&centro_id='+$('#centro_id').val(),'_blank');


}

function ver_reporte()
{

window.open('aplicativos/documental/reporte_facturas.php?desde_val='+$('#desde_val').val()+'&hasta_val='+$('#hasta_val').val()+'&centro_id='+$('#centro_id').val(),'_blank');


}

function ver_reportexarea()
{

window.open('aplicativos/documental/reporte_facturasxarea.php?desde_val='+$('#desde_val').val()+'&hasta_val='+$('#hasta_val').val()+'&centro_id='+$('#centro_id').val(),'_blank');


}


function ver_reporventas()
{

window.open('aplicativos/documental/reporte_ventascuentas.php?desde_val='+$('#desde_val').val()+'&hasta_val='+$('#hasta_val').val()+'&centro_id='+$('#centro_id').val(),'_blank');

}

function ver_reporcaja()
{

window.open('aplicativos/documental/reporte_cajacuentas.php?desde_val='+$('#desde_val').val()+'&hasta_val='+$('#hasta_val').val()+'&centro_id='+$('#centro_id').val(),'_blank');

}


function ver_repordeposito()
{

window.open('aplicativos/documental/reporte_depositocuentas.php?desde_val='+$('#desde_val').val()+'&hasta_val='+$('#hasta_val').val()+'&centro_id='+$('#centro_id').val(),'_blank');

}




function ver_reportet()
{

window.open('aplicativos/documental/reporte_facturasxareacliente.php?desde_val='+$('#desde_val').val()+'&hasta_val='+$('#hasta_val').val()+'&centro_id='+$('#centro_id').val(),'_blank');


}

 //  End -->
</script>
<center>
<div class="container" style="padding-top: 1em; padding-right:10px; padding-left:10px;">


<div class="form-group">

<div class="col-xs-2">
Desde:<input name="desde_val" type="text" id="desde_val" class="form-control" autocomplete="off">
</div>

<div class="col-xs-2">

Desde:<input name="hasta_val" type="text" id="hasta_val" class="form-control" autocomplete="off">
</div>

<div class="col-xs-2">
&nbsp;
 <select name="centro_id" id="centro_id" class="form-control" >
	     <option value="">-seleccionar-</option>
		 <?php
			$objformulario->fill_cmb('dns_centrosalud','centro_id,centro_nombre','',' order by centro_id asc',$DB_gogess);
			?>
  </select>
	  
</div>


<div class="col-xs-2">&nbsp;<br />
<input type="button" name="Submit2" value="Generar Datos" onClick="ver_registrolista()" style="width:150px">
</div>

<div class="col-xs-2">&nbsp;<br />
<input type="button" name="Submit2" value="Generar XLSX" onClick="ver_registrolistaxlsx()" style="width:150px" >
</div> 

<div class="col-xs-2">&nbsp;<br />
<input type="button" name="Submit2" value="Reporte" onClick="ver_reporte()" style="width:150px" >
</div>

<div class="col-xs-2">&nbsp;<br />
<input type="button" name="Submit2" value="Reporte por Especialidad" onClick="ver_reportexarea()" style="width:150px" >
</div>

<div class="col-xs-2">&nbsp;<br />
<input type="button" name="Submit2" value="R. Ventas (Cuentas Contables)" onClick="ver_reporventas()" style="width:150px" >
</div>

<div class="col-xs-2">&nbsp;<br />
<input type="button" name="Submit2" value="R. Caja (Cuentas Contables)" onClick="ver_reporcaja()" style="width:150px" >
</div>


<div class="col-xs-2">&nbsp;<br />
<input type="button" name="Submit2" value="Depositos (Cuentas Contables)" onClick="ver_repordeposito()" style="width:150px" >
</div>

</div>


<p>&nbsp;</p>


<div id="archivo_plano" >

</div>

</div>
</center>



<script type="text/javascript">
<!--

 $("#desde_val").datepicker({dateFormat: 'yy-mm-dd'});
 $("#hasta_val").datepicker({dateFormat: 'yy-mm-dd'}); 

 //  End -->
</script>