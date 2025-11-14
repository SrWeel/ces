<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=544445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if(@$_SESSION['ces1313777_sessid_inicio'])
{

 $clie_id=$_POST["pVar2"];
 $mnupan_id=$_POST["pVar3"];
 $atenc_id=$_POST["pVar4"];
 $centro_id=$_POST["pVar7"];
 $anam_id=$_POST["pVar6"]; 
 $tipofor_id=$_POST["pVar5"];

//Llamando objetos
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

//include(@$director."libreria/estructura/aqualis_master.php");
$lista_tbldata=array('gogess_sisfield','gogess_sistable');


//saca datos de la tabla
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));



$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
//saca datos de la tabla


$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";
$subindice='_substandarformrehabilitacionsubsecuente';
$carpeta='substandarformrehabilitacionsubsecuente';

?>

<script type="text/javascript">
<!--

function desplegar_grid()
{
   $("#grid<?php echo $subindice; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta; ?>/grid<?php echo $subindice; ?>.php",{
  
  pVar2:'<?php echo $clie_id; ?>',
  pVar3:'<?php echo $mnupan_id; ?>',
  pVar4:'<?php echo $atenc_id; ?>',
  pVar7:'<?php echo $centro_id; ?>',
  pVar6:'<?php echo $anam_id; ?>',
  pVar5:'<?php echo $tipofor_id; ?>'
  
  
  //filtro_val:$('#filtro_val').val()

  },function(result){  


  });  
  $("#grid<?php echo $subindice; ?>").html("Espere un momento");  
}


function  mensaje_borrado(mensaje)
{

alert(mensaje);

}

function borrar_registro(tabla,campo,valor)
{

	 if (confirm("Esta seguro que desea borrar este registro ?"))
	 { 

	 $("#grid_borrar").load("aplicativos/documental/opciones/grid/grid_borrar.php",{
     ptabla:tabla,
	 pcampo:campo,
	 pvalor:valor
  },function(result){  

      desplegar_grid();

  });  

  $("#grid_borrar").html("Espere un momento");  

  }

}

//  End -->
</script>

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
-->
</style>

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">
<!-- <div class="alert alert-success"> <B>PANEL CLIENTE</B> </div>-->
<div id="lista_manos">
<!-- despliegue -->
<div class="panel panel-default">
 <div class="panel-heading">

    <div class="panel-title" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;color:#000033" ><b><?php echo $rs_tabla->fields["tab_title"]; ?></b></div>

 </div>
<div class="panel-body">

<form id="form_<?php echo $rs_tabla->fields["tab_name"] ?>" name="form_<?php echo $rs_tabla->fields["tab_name"] ?>" method="post" action="" class="form-horizontal" enctype="multipart/form-data" > 
<div class="form-group">
<div class="col-xs-12">
<?php


$comill_s="'";
$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_substandarformrehabilitacionsubsecuente.php'.$comill_s.','.$comill_s.'MEDICOS'.$comill_s.','.$comill_s.'divBody_ext'.$comill_s.','.$comill_s.$comill_s.','.$comill_s.@$clie_id.$comill_s.','.$comill_s.$mnupan_id.$comill_s.','.$comill_s.$atenc_id.$comill_s.','.$comill_s.$tipofor_id.$comill_s.','.$comill_s.$anam_id.$comill_s.','.$comill_s.$centro_id.$comill_s.')" style=cursor:pointer';	


$linkapaciente="onClick=ver_formularioenpantalla('aplicativos/documental/datos_substandarrehabilitacionanamnesis.php','Editar','divBody_ext','".$anam_id."','".@$clie_id."',113,'".$atenc_id."',0,'".$tipofor_id."','".$centro_id."');";

echo '<button type="button" class="mb-sm btn btn-success" '.$linkapaciente.'  style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar a Rehabilitaci&oacute;n - Anamnesis y Examen F&iacute;sico </button>&nbsp;&nbsp;&nbsp;';


$linkimprimir='onClick=genera_pdfevolucion();';

echo '<button type="button" class="mb-sm btn btn-info" '.$linkimprimir.'  style="cursor:pointer"><span class="glyphicon glyphicon-print"></span></button>&nbsp;&nbsp;';

echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO...</button>';


?>

</div>
</div>
</form>	

<?php
$campos_data='';
$campos_data64='';
$campos_data='pVar2='.@$clie_id.'&pVar4='.$atenc_id.'&pVar3='.$mnupan_id;
$campos_data64=base64_encode($campos_data);
?>
	
<!--<div id="lista_clientes"></div>-->
<div align="center" id=grid<?php echo $subindice; ?> ></div><br><br>
<script type="text/javascript">
<!--
desplegar_grid();

function genera_pdfevolucion()
{
	 
	    location.href = "pdfformularios/pdfformulariorehabivolucion.php?ssr=<?php echo $campos_data64."|" ?>"+"<?php echo $anam_id; ?>";

}

//  End -->
</script>

<div id="divBody<?php echo $subindice; ?>" ></div>
<div id="grid_borrar" ></div>
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