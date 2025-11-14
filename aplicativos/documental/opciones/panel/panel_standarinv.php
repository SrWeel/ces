<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
@$tiempossss=14400000;
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
$subindice='_inventariodns';
$carpeta='inventariodns';


$centro_activoentrecentros=$objformulario->replace_cmb("dns_centrosalud","centro_id,centro_activoentrecentros"," where centro_id=",$_SESSION['ces1313777_centro_id'],$DB_gogess);


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

    <h3 class="panel-title" style="color:#000033" ><?php echo $rs_tabla->fields["tab_title"]; ?></h3>

 </div>
<div class="panel-body">

<form id="form_<?php echo $rs_tabla->fields["tab_name"] ?>" name="form_<?php echo $rs_tabla->fields["tab_name"] ?>" method="post" action="" class="form-horizontal" enctype="multipart/form-data" > 
<div class="form-group">
<div class="col-xs-2">
<?php

$comill_s="'";

$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_inventariodns.php'.$comill_s.','.$comill_s.'TARIFARIO'.$comill_s.','.$comill_s.'divBody_ext'.$comill_s.',0,'.$comill_s.$_POST["pVar2"].$comill_s.',0,0,0,0,0)" style=cursor:pointer';	



echo '<div align="center">';

//echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO</button>';

?>
</div>
</div>
</form>	

<div class="form-group" align="center">
<div class="col-md-12">
   <div class="form-group">
   <div class="col-xs-6">
     <?php
	 if($_SESSION['ces1313777_centro_id']!=55)
	 {
	 ?>
	<!-- <button type="button" class="mb-sm btn btn-primary" onclick="tablas_celdas(1)" style="cursor:pointer; width:250px" > MEDICAMENTOS </button>	-->
	 <?php
	 }
	 ?>
   </div>
   <div class="col-xs-6">
   <?php
	 if($_SESSION['ces1313777_centro_id']!=55)
	 {
	 ?>
	   <!--  <button type="button" class="mb-sm btn btn-primary" onclick="tablas_celdas(2)" style="cursor:pointer; width:250px" > DISPOSITIVOS </button> -->
	 <?php
	 }
	 ?>
   </div>
   </div>
   
   <div class="form-group">
   <div class="col-xs-6">
    <?php
	 if($_SESSION['ces1313777_centro_id']!=55)
	 {
	 ?>
     <!-- <button type="button" class="mb-sm btn btn-primary" onclick="tablas_celdasvisor(1)" style="cursor:pointer; width:250px" > LISTADO GLOBAL DE STOCK </button> -->
	<?php
	}
	?>
   </div>
   <div class="col-xs-6">
    <?php
	 if($_SESSION['ces1313777_centro_id']!=55)
	 {
	 ?>
     <!-- <button type="button" class="mb-sm btn btn-primary" onclick="tablas_celdascomparativo(1)" style="cursor:pointer; width:250px" > COMPARATIVO STOCK </button>-->
	 <?php
	 }
	 ?>
   </div>
   </div>
   
    <div class="form-group">
   <div class="col-xs-6">
    <?php
	 if($_SESSION['ces1313777_centro_id']!=55)
	 {
	 ?>
     <!-- <button type="button" class="mb-sm btn btn-primary" onclick="tablas_reporteskardex(1)" style="cursor:pointer; width:250px" > KARDEX </button> -->
	 <?php
	 }
	 ?> 
   </div>
   <div class="col-xs-6">
       <?php	
	 if($_SESSION['ces1313777_centro_id']!=55)
	 {	 
	?>
	 <button type="button" class="mb-sm btn btn-primary" onclick="tablas_celdasegresoscentros(1)" style="cursor:pointer; width:250px" > MOVIMIENTOS </button> 
	<?php
	}
	?>
   </div>
   </div>
   
   
   <div class="form-group">
   <div class="col-xs-6">
      	
	<?php
	 if($_SESSION['ces1313777_centro_id']!=55)
	 {
	 ?>
	<button type="button" class="mb-sm btn btn-primary" onclick="listar_ingresos()" style="cursor:pointer; width:250px" > INGRESOS </button>
	<?php
	}
	?>
	
   </div>
   <div class="col-xs-6">
      &nbsp;
   </div>
   </div>
   
</div>
</div>



<p>&nbsp;</p>
<div id="lista_pendientes"></div>

<p>&nbsp;</p><p>&nbsp;</p>
<!--<div id="lista_clientes"></div>-->
<div align="center" id=grid<?php echo $subindice; ?> ></div><br><br>
<script type="text/javascript">
<!--
//desplegar_grid();
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
<div id="divBody_producto" ></div>
<SCRIPT LANGUAGE=javascript>
<!--
function tablas_celdas(id) {

myWindow4=window.open('aplicativos/documental/opciones/grid/inventariodns/general_total.php?insu='+id,'ventana_celda','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}

function tablas_celdasvisor(id) {

myWindow4=window.open('aplicativos/documental/opciones/grid/inventariodns/general_totalvisor.php?insu='+id,'ventana_visor','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}

function tablas_celdascomparativo(id) {

myWindow4=window.open('aplicativos/documental/opciones/grid/inventariodns/general_totalcomparativo.php?insu='+id,'ventana_visor','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


function tablas_celdasegresoscentros(id) {

myWindow4=window.open('aplicativos/documental/opciones/grid/inventariocentros/general_egreso.php?insu='+id,'ventana_egresos','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}



function listar_ingresos()
{
  
  $("#lista_pendientes").load("aplicativos/documental/opciones/grid/inventariodns/listar_ingresos.php",{
   egrec_id:$('#egrec_id').val()
 
  },function(result){ 

  });  

  $("#lista_pendientes").html("Espere un momento...");
  

}



function abrir_standarv2(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	



    var data_divBody=divBody;
	var data_divDialog=divDialog;
	var data_ancho=ancho;
	var data_alto=alto;


    fnExpLabRegReg = function(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7) {

        var xobjPadre = $("#"+divBody);
        xobjPadre.append("<div id='"+data_divDialog+"'  title='"+titulopantalla+"'></div>");
        var xobj = $("#"+data_divDialog);

        xobj.dialog({

            open: function(event, ui) {



                $(".ui-pg-selbox").css({"visibility":"hidden"});



            },



            close: function(event, ui) {


                $(".ui-pg-selbox").css({"visibility":"visible"});

                $(this).remove();



            },

            resizable: false,
            autoOpen: false,
            width: data_ancho,
            height: data_alto,
            modal: true,

        });

        xobj.load(urlpantalla,{pVar1:variable1,pVar2:variable2,pVar3:variable3,pVar4:variable4,pVar5:variable5,pVar6:variable6,pVar7:variable7});
        xobj.dialog( "open" );
        return false;

    }

    fnExpLabRegReg(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7);


}




function tablas_reporteskardex(id) {
myWindow4=window.open('aplicativos/documental/opciones/panel/reportescentros/kardex.php?insu='+id,'ventana_kardex','width='+screen.width+',height='+screen.height+',top=0, left=0,scrollbars=YES,fullscreen=yes');
myWindow4.focus();

}


//-->
</SCRIPT>