<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=50044000;
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


//saca datos de la tabla
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($_POST["pVar2"]));



$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());
//saca datos de la tabla


for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
{
  include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

} 

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";
$subindice='_bodegadns';
$carpeta='bodegadns';

?>

<script type="text/javascript">
<!--

function desplegar_grid()
{
   $("#grid<?php echo $subindice; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta; ?>/grid<?php echo $subindice; ?>.php",{
  
  pVar2:<?php echo $_POST["pVar2"] ?>
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


   $(".messages").hide();
    //queremos que esta variable sea global
    var fileExtension = "";
    //función que observa los cambios del campo file y obtiene información

function informacion_archivo(campo)
{

       //obtenemos un array con los datos del archivo

        var file = $("#"+campo+"imagen")[0].files[0];

        //obtenemos el nombre del archivo

        var fileName = file.name;

        //obtenemos la extensión del archivo

        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);

        //obtenemos el tamaño del archivo

        var fileSize = file.size;

        //obtenemos el tipo de archivo image/png ejemplo

        var fileType = file.type;

        //mensaje con la información del archivo

		var megas=0;

		megas=eval(fileSize)/1048576;

	
        showMessage("<span class='info"+campo+"' style='padding: 10px; border-radius: 10px; background: orange; color: #fff;font-family:Verdana, Arial, Helvetica, sans-serif;text-align: center;font-size:11px;' >Peso: "+megas.toFixed(4)+" MB.</span>",campo);


}



function subir_archivo(ncampo,table,anchot,altot,anchoor,altoor)
{

   if(isImage(fileExtension))
     {

     var formData = new FormData($("#form_"+table)[0]);

	 formData.append("ncampo",ncampo);
	 formData.append("anchot",anchot);
     formData.append("altot",altot);
	 formData.append("anchoor",anchoor);
     formData.append("altoor",altoor);

	 var nombre_campo=ncampo;

        var message = ""; 

        //hacemos la petición ajax  

		

        $.ajax({

            url: 'libreria/archivo/upload.php',  

            type: 'post',

            // Form data

            //datos del formulario

            data: formData,

            //necesario para subir archivos via ajax

            cache: false,

            contentType: false,

            processData: false,

            //mientras enviamos el archivo

            beforeSend: function(){

			

                message = $("<span class='before' >Subiendo imagen, por favor espere</span>");

                showMessage(message,nombre_campo)        

            },

            //una vez finalizado correctamente

            success: function(data){

			if(data.trim()!='')

					{

                message = $("<span class='success' >Imagen ha subido correctamente.</span>");

				}

else

{

 message = $("<span class='success' >Por favor seleccione un archivo.</span>");

}

                showMessage(message,nombre_campo);

                if(isImage(fileExtension))

                {

                    

					if(data.trim()!='')

					{

					$(".showImage"+ncampo).html("&nbsp;<a href='archivo/"+data+"' target='_blank' class='thumbnail' ><img src='archivo/file.png' alt='125x125' width='70px' ></a>");
					

					}

                }

				else

				{

				  if(data.trim()!='')
					{

				
					$(".showImage"+ncampo).html("&nbsp;<a href='archivo/"+data+"' target='_blank' class='thumbnail' ><img src='archivo/file.png' alt='125x125' width='70px' ></a>");
				
				   

				   }

				

				}

				$('#'+nombre_campo).val(data);

            },

            //si ha ocurrido un error

            error: function(){

                message = $("<span class='error' >Ha ocurrido un error. Seleccione el archivo</span>");

                showMessage(message,nombre_campo);

            }

        });

   

   
 }
   else
   {
   
    alert("Archivo no permitido solo (jpg,png,gif,pdf)");
   }
   



}







//como la utilizamos demasiadas veces, creamos una función para 

//evitar repetición de código

function showMessage(message,campo){

    $(".messages"+campo).html("").show();

    $(".messages"+campo).html(message);

}

 

//comprobamos si el archivo a subir es una imagen

//para visualizarla una vez haya subido

function isImage(extension)

{

    switch(extension.toLowerCase()) 

    {

        case 'jpg': case 'gif': case 'png': case 'jpeg': case 'pdf': case 'PDF':

            return true;

        break;

        default:

            return false;

        break;

    }

}


function refreshFrame(nframe,path){

    $('#'+nframe).attr('src', path);

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
.style1 {font-weight: bold}
-->
</style>

<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">
<!-- <div class="alert alert-success"> <B>PANEL CLIENTE</B> </div>-->
<div id="lista_manos">
<!-- despliegue -->
<div class="panel panel-default">
 <div class="panel-heading">

    <h3 class="panel-title" style="color:#000033" >COORDINACION DE MEDICAMENTOS Y DISPOSITIVOS MEDICOS</h3>

 </div>
<div class="panel-body">

<form id="form_<?php echo $rs_tabla->fields["tab_name"] ?>" name="form_<?php echo $rs_tabla->fields["tab_name"] ?>" method="post" action="" class="form-horizontal" enctype="multipart/form-data" > 
<div class="form-group">
<div class="col-xs-2">
<?php

$comill_s="'";

$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_bodegadns.php'.$comill_s.','.$comill_s.'TARIFARIO'.$comill_s.','.$comill_s.'divBody_ext'.$comill_s.',0,'.$comill_s.$_POST["pVar2"].$comill_s.',0,0,0,0,0)" style=cursor:pointer';	



echo '<div align="center">';

//echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO</button>';

?>
</div>
</div>
</form>	


<div id="entorno_centro">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="19%">&nbsp;</td>
    <td width="16%" style="cursor:pointer" onclick="tablas_celdas(1)" ><div align="center"><span class="style1"><b>MEDICAMENTOS</b></span></div></td>
    <td width="27%">&nbsp;</td>
    <td width="19%" style="cursor:pointer"  ><div align="center"><span class="style1"><b></b></span></div></td>
    <td width="19%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="cursor:pointer" onclick="tablas_celdas(1)" ><img src="images/medicamentos.png" width="200" height="179" /></td>
    <td>&nbsp;</td>
    <td style="cursor:pointer" onclick="tablas_celdas(2)" >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align="center"><b>REPORTES</b></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td onclick="ver_listacentro()" style="cursor:pointer"><img src="images/listacentros1.png" width="200" height="179" /></td>
    <td>&nbsp;</td>
    <td style="cursor:pointer" onclick="ver_listareportesbodega()" ><img src="images/cardex.png" width="200" height="179" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><span style="cursor:pointer"><a href="javascript:ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_standar.php','Perfil','divBody_ext','<?php echo $_SESSION['ces1313777_sessid_inicio'] ?>','194',0,0,0,0,0)"><img src="images/origen.png" width="200" height="179" /></a></span></td>
    <td>&nbsp;</td>
    <td><span style="cursor:pointer"><a href="javascript:ver_formularioenpantalla('aplicativos/documental/opciones/panel/panel_standar.php','Perfil','divBody_ext','<?php echo $_SESSION['ces1313777_sessid_inicio'] ?>','193',0,0,0,0,0)"><img src="images/destino.png" width="200" height="179" /></a></span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p><p>&nbsp;</p>
<!--<div id="lista_clientes"></div>-->
<div align="center" id=grid<?php echo $subindice; ?> ></div><br><br>
<script type="text/javascript">
<!--
//desplegar_grid();


function ver_listacentro()
{

$("#entorno_centro").load("aplicativos/documental/opciones/panel/coordinacion/lista_centros.php",{

 },function(result){       

  });  

$("#entorno_centro").html("Espere un momento...");

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

<SCRIPT LANGUAGE=javascript>
<!--
function tablas_celdas(id) {

myWindow4=window.open('aplicativos/documental/opciones/grid/bodegadns/general_totalbuscar.php?insu='+id,'ventana_celda','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


function tablas_celdascompras(id) {

myWindow4=window.open('aplicativos/documental/opciones/grid/bodegadns/general_facturascompras.php?insu='+id,'ventana_celda','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


function tablas_celdasdespacho(id) {

myWindow4=window.open('aplicativos/documental/opciones/grid/bodegadns/general_despachom.php?insu='+id,'ventana_celda','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}

function tablas_celdasegresos(id) {

myWindow4=window.open('aplicativos/documental/opciones/grid/bodegadns/general_egreso.php?insu='+id,'ventana_celda','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}

function tablas_celdasvisor(id) {

myWindow4=window.open('aplicativos/documental/opciones/grid/bodegadns/general_totalvisor.php?insu='+id,'ventana_visor','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}

function tablas_celdascomparativo(id) {

myWindow4=window.open('aplicativos/documental/opciones/grid/bodegadns/general_totalcomparativo.php?insu='+id,'ventana_visor','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}



function tablas_celdasingresos(id) {
myWindow4=window.open('aplicativos/documental/opciones/grid/bodegadns/general_ingresos.php?insu='+id,'ventana_celda','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


function ver_listareportesbodega()
{

$("#entorno_centro").load("aplicativos/documental/opciones/panel/reportesbodega/reportes.php",{

 },function(result){       

  });  

$("#entorno_centro").html("Espere un momento...");

}



//-->
</SCRIPT>