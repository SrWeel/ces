<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=144000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();



if(@$_SESSION['ces1313777_sessid_inicio'])

{

//echo $_POST["pVar1"];

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
$subindice='_fichamascota';
$carpeta='fichamascota';
?>
<script type="text/javascript">

<!--



function desplegar_grid()

{

   $("#grid<?php echo $subindice; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta; ?>/grid<?php echo $subindice; ?>.php",{

  filtro_val:$('#filtro_val').val(),
  pVar2:'<?php echo $_POST["pVar2"]; ?>'

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



<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:950px;">

<!-- <div class="alert alert-success"> <B>PANEL CLIENTE</B> </div>-->



<div id="lista_manos">

<!-- despliegue -->

<div class="panel panel-default">

  <div class="panel-heading">
    <h3 class="panel-title" style="color:#000033" >MACOTAS</h3>
 </div>

 
  <div class="panel-body">
  
  <button type="button" class="mb-sm btn btn-success" onclick="ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_clientes.php','Perfil','divBody_ext',0,0,0,0,0,0,0)" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar </button>
<p></p>
<button type="button" class="mb-sm btn btn-primary" onclick="ver_formularioenpantalla('aplicativos/documental/datos_fichamascotal.php','CLIENTE','divBody_ext',0,<?php echo $_POST["pVar2"]; ?>,0,0,0,0,0)" style="cursor:pointer"><span class="glyphicon glyphicon-plus"></span> Agregar Mascota </button>



<form id="form_app_fichamascota" name="form_app_fichamascota" method="post" action="" class="form-horizontal" enctype="multipart/form-data" > 

<div class="form-group">
<div class="col-xs-2">

<?php
$comill_s="'";
$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_fichamascota.php'.$comill_s.','.$comill_s.'MASCOTAS'.$comill_s.','.$comill_s.'divBody_ext'.$comill_s.',0,0,0,0,0,0,0)" style=cursor:pointer';	

echo '<div align="center">';
//echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span> Agregar Mascota </button>';
?>

</div>
</div>

</form>		
<p>&nbsp;</p><p>&nbsp;</p>
		

		<!--<div id="lista_clientes"></div>-->

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

}

else

{

  echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Sesi&oacute;n a caducado presione F5 para continuar</div></center>';



}



?>