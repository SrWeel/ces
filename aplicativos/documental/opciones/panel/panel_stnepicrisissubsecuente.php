<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=4445000;
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
$subindice='_stnepicrisissubsecuente';
$carpeta='stnepicrisissubsecuente';

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
   
    alert("Archivo no permitido solo (jpg,png,gif)");
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
$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_stnepicrisissubsecuente.php'.$comill_s.','.$comill_s.'MEDICOS'.$comill_s.','.$comill_s.'divBody_ext'.$comill_s.','.$comill_s.$comill_s.','.$comill_s.@$clie_id.$comill_s.','.$comill_s.$mnupan_id.$comill_s.','.$comill_s.$atenc_id.$comill_s.','.$comill_s.$tipofor_id.$comill_s.','.$comill_s.$anam_id.$comill_s.','.$comill_s.$centro_id.$comill_s.')" style=cursor:pointer';	


$linkapaciente="onClick=ver_formularioenpantalla('aplicativos/documental/datos_stnepicrisisanamnesis.php','Editar','divBody_ext','".$anam_id."','".@$clie_id."',125,'".$atenc_id."',0,'".$tipofor_id."','".$centro_id."');";

echo '<button type="button" class="mb-sm btn btn-success" '.$linkapaciente.'  style="cursor:pointer"><span class="glyphicon glyphicon-arrow-left"></span> Regresar a Consulta Externa - Anamnesis y Examen F&iacute;sico </button>&nbsp;&nbsp;&nbsp;';

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
	 
	    location.href = "pdfformularios/pdfformevolucionepicrisis.php?ssr=<?php echo $campos_data64."|" ?>"+"<?php echo $anam_id; ?>";

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


