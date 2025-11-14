<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();


if(@$_SESSION['ces1313777_sessid_inicio'])
{
    
echo '<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->
</style>
<div id="divBodyref_ext">';


 $clie_id=$_POST["pVar2"];
 $mnupan_id=$_POST["pVar3"];
 $atenc_id=$_POST["pVar4"];
 
 $proviene_de=0;
 $proviene_de=@$_POST["pVar10"];
 
 $id_llega=$_POST["pVar5"];
 $tabla_llega=$_POST["pVar6"];

//Llamando objetos
$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

$lista_tbldata=array('gogess_sisfield','gogess_sistable');
//include(@$director."libreria/estructura/aqualis_master.php");


//saca datos de la tabla
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($mnupan_id));



$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
//saca datos de la tabla

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";
$subindice='_substandarformenlref';
$carpeta='substandarformenlref';

?>

<script type="text/javascript">
<!--

function desplegar_grid()
{
   $("#grid<?php echo $subindice; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta; ?>/grid<?php echo $subindice; ?>.php",{
  
  pVar2:'<?php echo $clie_id; ?>',
  pVar3:'<?php echo $mnupan_id; ?>',
  pVar4:'<?php echo $atenc_id; ?>',
  pVar10:'<?php echo $proviene_de; ?>',
  pVar5:'<?php echo $id_llega; ?>',
  pVar6:'<?php echo $tabla_llega; ?>'
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

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">
<div id="lista_manos">
<!-- despliegue -->

<div class="panel panel-default">
 <div class="panel-heading">
    <div class="panel-title" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;color:#000033" ><b><?php echo utf8_encode($rs_tabla->fields["tab_title"]); ?></b></div>
 </div>
<div class="panel-body">

<form id="form_<?php echo $rs_tabla->fields["tab_name"] ?>" name="form_<?php echo $rs_tabla->fields["tab_name"] ?>" method="post" action="" class="form-horizontal" enctype="multipart/form-data" > 
<div class="form-group">
<div class="col-xs-12">
<?php
$comill_s="'";
$linkeditar= 'onClick="ver_formularioenpantallapreconsulta('.$comill_s.'aplicativos/documental/datos_substandarformenlref.php'.$comill_s.','.$comill_s.'MEDICOS'.$comill_s.','.$comill_s.'divBodyref_ext'.$comill_s.','.$comill_s.$comill_s.','.$comill_s.@$clie_id.$comill_s.','.$comill_s.$mnupan_id.$comill_s.','.$comill_s.$atenc_id.$comill_s.','.$comill_s.$id_llega.$comill_s.','.$comill_s.$tabla_llega.$comill_s.',0,0,0,'.$comill_s.$proviene_de.$comill_s.')" style=cursor:pointer';

if(@$proviene_de==0)
{
$linkapaciente="onClick=ver_formularioenpantalla('aplicativos/documental/datos_pacientes.php','Editar','divBodyref_ext','".@$clie_id."','25',0,'".$atenc_id."',0,0,0);";
}

if(@$proviene_de==2)
{
$linkapaciente="onClick=ver_formularioenpantalla('aplicativos/documental/datos_consulta.php','Editar','divBodyref_ext','".@$clie_id."','112',0,'".$atenc_id."',0,0,0);";
}

//echo '<p></p><button type="button" class="mb-sm btn btn-success" '.$linkapaciente.'  style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> REGRESAR A PACIENTE </button>&nbsp;&nbsp;&nbsp;';
echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO...</button>';
?>
</div>
</div>
</form>		
<p>&nbsp;</p><p>&nbsp;</p>
<div align="center" id=grid<?php echo $subindice; ?> ></div><br><br>
<script type="text/javascript">
<!--
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
  echo '</div>';
}
else
{

  echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesi&oacute;n a caducado presione F5 para continuar</div></center>';

}

?>