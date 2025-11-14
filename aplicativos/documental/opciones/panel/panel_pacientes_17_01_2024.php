<?php
ini_set('display_errors',0);
error_reporting(E_ALL);
@$tiempossss=44544000;
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director='../../../../';
include("../../../../cfg/clases.php");
include("../../../../cfg/declaracion.php");

if(@$_SESSION['ces1313777_sessid_inicio'])
{

//Llamando objetos
//saca datos de la tabla
$lista_datosmenu="select * from gogess_menupanel where 	mnupan_id=?";
$rs_datosmenu = $DB_gogess->executec($lista_datosmenu,array($_POST["pVar2"]));
$lista_tabla="select * from gogess_sistable where tab_id=".$rs_datosmenu->fields["tab_id"];
$rs_tabla = $DB_gogess->executec($lista_tabla,array());

//saca datos de la tabla

$objformulario= new  ValidacionesFormulario();
$objtableform= new templateform();
$comillasimple="'";
$subindice='_pacientes';
$carpeta='pacientes';
?>



<script type="text/javascript">

<!--


function verl_turno()
{
  $("#div_listaturno").load("aplicativos/documental/opciones/panel/turnos_code.php",{

     pVar2:'<?php echo $_POST["pVar2"]; ?>'
  },function(result){  





  });  

  $("#div_listaturno").html("Espere un momento");  

}


function desplegar_grid(todos)

{

   $("#grid<?php echo $subindice; ?>").load("aplicativos/documental/opciones/grid/<?php echo $carpeta; ?>/grid<?php echo $subindice; ?>.php",{

  

  pVar2:<?php echo $_POST["pVar2"] ?>,
  todos:todos,
  ci_medico:$('#ci_medico').val(),
  conve_id:$('#conve_id').val()
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



      desplegar_grid(0);



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

-->

</style>



<div class="container" style="padding-top: 1em; padding-right:1em; padding-left:1em; max-width:100%;">

<!-- <div class="alert alert-success"> <B>PANEL CLIENTE</B> </div>-->

<div id="lista_manos">

<!-- despliegue -->

<div class="panel panel-default">

 <div class="panel-heading">



    <h3 class="panel-title" style="color:#000033" ><?php echo strtoupper($rs_tabla->fields["tab_title"]); ?></h3>
	
	<div class="alert alert-success"><b>Nota Importante!!! <a href="AUTORIZACION_DEL_USO_DE_HISTORIA_CLINICA.doc" target="_blank">AUTORIZACION DEL USO DE HISTORIA CLINICA</a></b></div>




 </div>

<div class="panel-body">



<form id="form_<?php echo $rs_tabla->fields["tab_name"] ?>" name="form_<?php echo $rs_tabla->fields["tab_name"] ?>" method="post" action="" class="form-horizontal" enctype="multipart/form-data" > 

<div class="form-group">

<div class="col-xs-12">

<?php



$comill_s="'";



$linkeditar= 'onClick="ver_formularioenpantalla('.$comill_s.'aplicativos/documental/datos_pacientes.php'.$comill_s.','.$comill_s.'PACIENTES'.$comill_s.','.$comill_s.'divBody_ext'.$comill_s.','.$comill_s.$comill_s.','.$comill_s.$_POST["pVar2"].$comill_s.',0,0,0,0,0)" style=cursor:pointer';	







echo '<div align="center"><br><b>ALERTA!!! SI DA CLIC EN [MIS PACIENTES] SOLO VERA LA LISTA DE SUS PACIENTES, DAR CLIC EN [TODOS] PARA VER LA LISTA COMPLETA</b><br><BR>';



echo '<button type="button" class="mb-sm btn btn-primary"  '.$linkeditar.'  style="background-color:#000066"  ><span class="glyphicon glyphicon-plus"></span>NUEVO REGISTRO</button>';


$linkgayuda="onclick=abrir_standar('ayuda/ayuda.php','AYUDA','divBody_ext','divDialog_ext',900,600,1,0,0,0,0,0,0) style='cursor:pointer'";

echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-primary" '.$linkgayuda.'  style="cursor:pointer"> AYUDA </button>';

echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-success" onClick="desplegar_grid(1)"  style="cursor:pointer"> MIS PACIENTES </button>';

echo '&nbsp;&nbsp;&nbsp;<button type="button" class="mb-sm btn btn-success" onClick="desplegar_grid(0)"  style="cursor:pointer"> TODOS </button>';
echo '&nbsp;&nbsp;&nbsp;<input name="ci_medico" type="text" id="ci_medico" value="" />';


echo '<p>&nbsp;</p><div class="form-group"><label class="control-label col-xs-3">Seguro: <span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FF0000;">*</span></label>

<div class="col-xs-5">
<select name="conve_id" id="conve_id" class="form-control" >
      <option value="">--seleccionar evento--</option>';
		$objformulario->fill_cmb('cesdb_arextension.dns_convenios','conve_id,conve_nombre',' ',' order by conve_nombre asc',$DB_gogess);
 
echo '</select></div>
<div class="col-xs-1">
<button type="button" class="mb-sm btn btn-success" onClick="desplegar_grid(2)"  style="cursor:pointer"> LISTAR </button>
</div>
</div>';

?>

<style type="text/css">
<!--
.TableScroll_scrolldata {
        z-index:99;
		width:640px;
        height:170px;	
        overflow: auto;
      }
-->
</style>
<br /><br />
<div id="div_listaturno" class="TableScroll_scrolldata">

</div>

</div>

</div>

</form>	













<p>&nbsp;</p><p>&nbsp;</p>

<!--<div id="lista_clientes"></div>-->

<div align="center" id=grid<?php echo $subindice; ?> ></div><br><br>

<script type="text/javascript">

<!--
verl_turno();
desplegar_grid(0);

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



echo '<center><div style="background-color: rgb(255, 238, 221);" id="msg" class="errors">Tu sesi&oacute;n ha expirado</div></center>';

echo '
<script type="text/javascript">
<!--
abrir_standar("aplicativos/documental/activar_sesion.php","Activar_Sesi&oacute;n","divBody_acsession","divDialog_acsession",400,400,0,0,0,0,0,0,0);
//  End -->
</script>

<div id="divBody_acsession"></div>
';


}



?>