// JavaScript Document
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

            url: 'libreria/archivo/uploads.php',  

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

					$(".showImage"+ncampo).html("&nbsp;<a href='../archivo/"+data+"' target='_blank' class='thumbnail' ><img src='../archivo/"+data+"' alt='125x125' width='180px' ></a>");
					

					}

                }

				else

				{

				  if(data.trim()!='')

					{

				   $(".showImage"+ncampo).html("&nbsp;<a href='../archivo/"+data+"' target='_blank' class='thumbnail' ><img src='../archivo/"+data+"' alt='125x125' width='180px' ></a>");

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

function showMessage(message,campo){

    $(".messages"+campo).html("").show();

    $(".messages"+campo).html(message);

}


function isImage(extension)

{

    switch(extension.toLowerCase()) 

    {

        case 'jpg': case 'gif': case 'png': case 'jpeg': case 'pdf': case 'PDF': case 'pdf': case 'docx': case 'xlsx':

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
