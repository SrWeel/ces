<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=444445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if(@$_SESSION['ces1313777_sessid_inicio'])
{

 $clie_id=$_POST["pVar2"];
 $mnupan_id=$_POST["pVar3"];
 $atenc_id=$_POST["pVar4"];
 $eteneva_id=$_POST["pVar5"]; 
 $centro_id=$_POST["pVar7"]; 
 $tipofor_id=$_POST["pVar6"]; 

//Llamando objetos

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

//include(@$director."libreria/estructura/aqualis_master.php");
$lista_tbldata=array('gogess_sisfield','gogess_sistable');


//saca datos de la tabla
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));
$tab_id=$rs_datosmenu->fields["tab_id"];



$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
$campo_primariodata=$rs_tabla->fields["tab_campoprimario"];  
//saca datos de la tabla

$titulo_formualario='';
if($rs_datosmenu->fields["tipofor_id"]==1 or $rs_datosmenu->fields["tipofor_id"]==0)
{
  $titulo_formualario=$rs_tabla->fields["tab_title"];
}
else
{
  $lista_tituloformulario="select * from cesdb_arextension.dns_tipoformulario where tipofor_id=?";
  $rs_datostituloformulario = $DB_gogess->executec($lista_tituloformulario,array($rs_datosmenu->fields["tipofor_id"]));
  $titulo_formualario=$rs_datostituloformulario->fields["tipofor_nombre"];
}

$table=$rs_tabla->fields["tab_name"]; 

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";
$subindice='_substandarrehabilitacionanamnesis';
$carpeta='substandarrehabilitacionanamnesis';
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
  pVar6:'<?php echo $tipofor_id; ?>'
  
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

    <h3 class="panel-title" style="color:#000033" ><?php echo $titulo_formualario; ?></h3>

 </div>
<div class="panel-body">
<?php

//$busca_sihaydata="select * from faesa_psicologia where atenc_id=? and clie_id=?";
//$rs_sihaydata = $DB_gogess->executec($busca_sihaydata,array($atenc_id,@$clie_id));
$psic_id_valor=0;
//$psic_id_valor=@$rs_sihaydata->fields["psic_id"];

$comill_s="'";

$linkeditar= 'onClick=ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_substandarrehabilitacionanamnesis.php'.$comill_s.','.$comill_s.'MEDICOS'.$comill_s.','.$comill_s.'divBody_ext'.$comill_s.','.$comill_s.$comill_s.','.$comill_s.@$clie_id.$comill_s.','.$comill_s.$mnupan_id.$comill_s.','.$comill_s.$atenc_id.$comill_s.','.$comill_s.$eteneva_id.$comill_s.','.$comill_s.$tipofor_id.$comill_s.','.$comill_s.$centro_id.$comill_s.')';	


$linkapaciente="onClick=ver_formularioenpantallaregresar('aplicativos/documental/datos_pacientes.php','Editar','divBody_ext','".@$clie_id."','25',0,'".$atenc_id."',0,0,0,'".$table."');";
echo '<button type="button" class="mb-sm btn btn-success" '.$linkapaciente.'  style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar </button>&nbsp;&nbsp;&nbsp;';


echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO...</button>';




?>
<!--<div id="lista_clientes"></div>-->
<div align="center" id=grid<?php echo $subindice; ?> ></div>
<div id="divBody_unico"  ></div>

<script type="text/javascript">
<!--

<?php
//echo $link_datos;
?>
desplegar_grid();

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