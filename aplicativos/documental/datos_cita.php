<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

//echo $_POST["pVar1"];
//Llamando objetos
$director='../../';
include("../../cfg/clases.php");
include("../../cfg/declaracion.php");

include(@$director."libreria/estructura/aqualis_master.php");
for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
 {
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");
 } 
$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();

$objformulario->sisfield_arr=$gogess_sisfield;
$objformulario->sistable_arr=$gogess_sistable;
$comillasimple="'";

?>
<style type="text/css">
body{margin:0;font-family:Lato;}
ul,li{list-style-type:none;margin:0;padding:0;}
.calendar{padding:30px;}
.calendar .day{background:#ecf0f1;border-bottom:2px solid #bdc3c7;float:left;margin:3px;position:relative;height:180px;width:180px;}
.day.marked{background:#C5D9E2;border-color:#2980b9;}
.day .day-number{color:#7f8c8d;left:5px;position:absolute;top:5px;}
.day.marked .day-number{color:white;}
.day .events{margin:29px 7px 7px;height:140px;overflow-x:hidden;}
.day .events h5{margin:0 0 5px;overflow:hidden;text-overflow:ellipsis;width:100%; color:#000000;}
.day .events strong,.day .events span{display:block;font-size:11px;}
.day .events ul{}.day .events li{}
.TableScroll {
        z-index:99;
		width:170px;
        height:170px;	
        overflow: auto;
      }
</style>

<script type="text/javascript">
<!--
function ver_calendario()
{

   $("#div_calendario").load("aplicativos/documental/datos_calendario.php",{
   fich_id:'<?php echo $_POST["pVar1"]; ?>'
  },function(result){  



  });  

  $("#div_calendario").html("Espere un momento...");  

}


function ver_calendario_mes()
{

   $("#div_calendario").load("aplicativos/documental/datos_calendario.php",{
   anio:$('#num_anio').val(),
   mes:$('#num_mes').val(),
   fich_id:'<?php echo $_POST["pVar1"]; ?>'
  },function(result){  



  });  

  $("#div_calendario").html("Espere un momento...");  

}



//  End -->
</script>



<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:950px;">

<button type="button" class="mb-sm btn btn-success" onclick="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_fichamascota.php','Perfil','divBody_ext',0,'<?php echo $_POST['pVar2']; ?>',0,0,0,0,0)" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar </button>
<p></p>

<div class="panel panel-default">

  <div class="panel-heading">
    <h3 class="panel-title" style="color:#000033" >RESGISTRAR CITAS</h3>
 </div>

 
  <div class="panel-body">
  <?php

  $busca_datos="select * from app_fichamascota inner join app_cliente on app_fichamascota.clie_id=app_cliente.clie_id where fich_id=".$_POST["pVar1"];
  $rs_datos = $DB_gogess->executec($busca_datos,array());
  ?>

  <div class="row">
   <div class="col-md-6">
   

  <div class="form-group">
    <label for="ejemplo_email_1">Cliente:</label>
		   
		   <?php echo $rs_datos->fields["clie_nombre"];  ?>
  </div>
  <div class="form-group">
    <label for="ejemplo_email_1">CI:</label>
		   
		   <?php echo $rs_datos->fields["clie_rucci"];  ?>
  </div>
 
 
  </div>
    <div class="col-md-6">

    <div class="form-group">
    <label for="ejemplo_email_1">NOMBRE MASCOTA:</label>
		   
		   <?php echo $rs_datos->fields["fich_nombre"];  ?>
  </div> 
  
      <div class="form-group">
    <label for="ejemplo_email_1">SEXO:</label>
		   
		   <?php echo $rs_datos->fields["fich_sexo"];  ?>
  </div> 

    <div class="form-group">
    <label for="ejemplo_email_1">COLOR:</label>
		   
		   <?php echo $rs_datos->fields["fich_color"];  ?>
  </div> 
  
	</div>
  </div>	
  </div>
  
 
  
 </div>

 
 
</div>
<center>
   <div class="calendar" id="div_calendario" style="position:inherit" align="center" >
 
 
 </div>
 </center>
 <div id="divBody_horas"></div>

<script type="text/javascript">
<!--	
ver_calendario();
//  End -->
</script>