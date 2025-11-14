<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if(@$_SESSION['ces1313777_sessid_inicio'])
{
//Llamando objetos
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
$comillasimple="'";



?>

<style type="text/css">
<!--

.alert-success
{

color:#000033;
background-color:#FFFFFF;
border-color:#ffffff;

}


.alert-success1
{

color:#000033;
background-color:#FFFFFF;
border-color:#000000;

}
.css_titulo {font-weight: bold}

.css_texto {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;

}

.TableScroll_lista {
    z-index: 99;
    width: 100%;
    height: 450px;
    overflow: auto;
}


-->
</style>

<div class="container" style="padding-top: 2em; padding-right:1em; padding-left:1em; max-width:100%;">
<!-- <div class="alert alert-success"> <B>PANEL CLIENTE</B> </div>-->
<div id="lista_manos">
<!-- despliegue -->
<div class="panel panel-default">
 <div class="panel-heading">
    <h3 class="panel-title" style="color:#000033" >PRECUENTAS</h3>
 </div>
<div class="panel-body">

<a href="aplicativos/reportes/personalizado/panel.php?ireport=56" target="_blank" class="mb-sm btn btn-primary" style="background-color:#000066"><span class="glyphicon glyphicon-plus"></span>REPORTE PRECUENTAS</a>


<div class="table-responsive" >
  <table width="200" border="0" align="center" cellpadding="0" cellspacing="0" class="display responsive cell-border" >
    <tr>
      <td><div align="center">CI PACIENTE</div></td>
    </tr>
    <tr>
      <td><div align="center">
        <table border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><input name="ci_paciente" type="text" id="ci_paciente"  class="form-control"  /></td>
            <td><input type="button" name="Submit" value="OK" onclick="desplegar_precuenta()" /></td>
          </tr>
        </table>
      </div></td>
    </tr>
  </table>
  <div id="lsta_precuenta"></div>
  
</div>  
  
  <p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p>

<div id="divBody_precuenta" ></div>
<!--<div id="lista_clientes"></div>-->

<script type="text/javascript">
<!--

//  End -->
</script>


</div>
</div>


<!-- despliegue -->
</div>
</div>
<?php
}
else
{

  echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesi&oacute;n a caducado presione F5 para continuar</div></center>';

}

?>

<SCRIPT LANGUAGE=javascript>
<!--

function ver_detalle(precu_id)
{
   abrir_standar('aplicativos/documental/opciones/panel/precuenta_detalle.php','DETALLES _PRECUENTA','divBody_precuenta','divDialog_precuenta',800,500,precu_id,0,0,0,0,0,0);
}
//-->
</SCRIPT>

<script type="text/javascript">
<!--
function desplegar_precuenta()
{
  if($('#ci_paciente').val()=='')
  {
     alert("Ingrese la cedula del paciente");
     return false;
  }
  
   $("#lsta_precuenta").load("aplicativos/documental/opciones/panel/precuentagenerada/precuenta.php",{
      
	  ci_paciente:$('#ci_paciente').val()

  },function(result){  


  });  
  $("#lsta_precuenta").html("Espere un momento");  
}

//  End -->
</script>