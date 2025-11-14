<?php
ini_set('display_errors',1);
ini_set('memory_limit',-1);
error_reporting(E_ALL);
@$tiempossss=55544000;
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

$tab_name=$rs_tabla->fields["tab_name"];
//saca datos de la tabla


for($itbl=0;$itbl<count($lista_tbldata);$itbl++)
{
  //include(@$director."libreria/estructura/".$lista_tbldata[$itbl].".php");

} 

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";
$subindice='_standarcierrecontable';
$carpeta='standarcierrecontable';

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

        case 'jpg': case 'gif': case 'png': case 'jpeg': case 'pdf': case 'PDF': case 'XML': case 'xml':

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

    <h3 class="panel-title" style="color:#000033" ><?php echo $rs_tabla->fields["tab_title"]; ?></h3>

 </div>
<div class="panel-body">

<form id="form_<?php echo $rs_tabla->fields["tab_name"] ?>" name="form_<?php echo $rs_tabla->fields["tab_name"] ?>" method="post" action="" class="form-horizontal" enctype="multipart/form-data" > 
<div class="form-group">
<div class="col-xs-12">
<?php

$comill_s="'";

$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_standarcierrecontable.php'.$comill_s.','.$comill_s.'TARIFARIO'.$comill_s.','.$comill_s.'divBody_ext'.$comill_s.',0,'.$comill_s.$_POST["pVar2"].$comill_s.',0,0,0,0,0)" style=cursor:pointer';	



echo '<div align="center">';

echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO</button>';

if($rs_tabla->fields["tab_name"]=='conco_rubrosg')
{
$link_asignar='onClick="asiganr_data()"';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary"  '.$link_asignar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-signal"></span>&nbsp;&nbsp;ASIGNAR RUBROS A TODOS</button>';

echo '<div id="asigna_datos" style="height:20px" ></div>';
}

if($tab_name=='efacsistema_producto')
{
$link_b=' onClick="ver_reportelista()" ';
echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-success"  '.$link_b.'  style="background-color:#000066"  >LISTADO</button>';
}
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



function ver_reportelista()
{

window.open('aplicativos/documental/reporte_listap.php','_blank');

}

function asiganr_data()
{
  
  $("#asigna_datos").load("aplicativos/documental/opciones/panel/asignar_rubros/asignar_rubros.php",{
	
	},function(result){  
		
	  });  
	
	$("#asigna_datos").html("Espere un momento...");


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