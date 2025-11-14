<?php

$subindice_formulario='div_formulariodet';

?>

<script type="text/javascript">

<!--

function desplegar_formulario(id_ver)
{



$("#<?php echo $subindice_formulario; ?>").load("movimiento/grid_movimiento_nuevo.php",{

    pVar1:id_ver,
	pVar7:'<?php echo $_POST["pVar7"]; ?>',
	centro_id:'<?php echo $_POST["pVar6"]; ?>'

  },function(result){  



  });  

  $("#<?php echo $subindice_formulario; ?>").html("Espere un momento...");  



}



function desplegar_grid_su()

{

   $("#div_grid").load("movimiento/grid_movimiento.php",{

    cuadrobm_id:'<?php echo $_POST["pVar7"]; ?>',
	centro_id:'<?php echo $_POST["pVar6"]; ?>'

  },function(result){  



  });  

  $("#div_grid").html("Espere un momento...");  



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

            url: '../../../../../libreria/archivo/upload.php',  

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

					$(".showImage"+ncampo).html("&nbsp;<a href='../../../../../archivo/"+data+"' target='_blank' class='thumbnail' ><img src='../../../../../archivo/"+data+"' alt='125x125' width='180px' ></a>");
					

					}

                }

				else

				{

				  if(data.trim()!='')

					{

				   $(".showImage"+ncampo).html("&nbsp;<a href='../../../../../archivo/"+data+"' target='_blank' class='thumbnail' ><img src='../../../../../archivo/"+data+"' alt='125x125' width='180px' ></a>");

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
table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {

    padding: 2px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;

}
-->
</style>


<div id="grid_borrar"></div>

<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" bgcolor="#EFF4F5"><div id="div_formulariodet" ></div></td></tr>
    <tr><td valign="top"><div id="div_grid" ></div></td>
  </tr>
</table>



<script type="text/javascript">

<!--

desplegar_formulario(0);

desplegar_grid_su();



//  End -->

</script>