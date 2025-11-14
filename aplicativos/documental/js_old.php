<script type="text/javascript">
<!--

function ingreso_usuario()
{
 
 

  if ($('#usuario_valor').val()=='')

	{

	alert('Debe llenar el Campo USUARIO:');

	return false;

	}



  if ($('#clave_valor').val()=='')

	{

	alert('Debe llenar el Campo CLAVE:');

	return false;

	}




 

  $("#acceso_usuario").load("libreria/acceso/validar.php",{

  

    accesousuario:'<?php echo $accesousuario ?>',usuario_valor:$('#usuario_valor').val(),clave_valor:$('#clave_valor').val(),punto_id:$('#punto_id').val(),tipo_ing:$('#tipo_ing').val()

  

  

  },function(result){  



  });  

  $("#acceso_usuario").html("Espere un momento...");

}





function salir_sistema()
{

   $("#acceso_panel").load("libreria/acceso/salir.php",{



  },function(result){  



  });  

  $("#acceso_panel").html("Espere un momento...");  



}






function funcion_cerrar_pop(valor_pop)
{

$('#'+valor_pop).dialog( "close" );

}



function mensajemch()
{

alert("Su perfil no permite el acceso a esta opcion...");

}





function activar_formulario(accesousuario,tipo_ing)
{

	

    $("#divBody_ingreso").load("<?php echo $ap_path ?>form_ing.php",{

	accesousuario_p:accesousuario,
	tipo_ingp:tipo_ing

  },function(result){  

      

  });  

  $("#divBody_ingreso").html("Espere un momento...");  



}



function abrir_pantalla_servicio(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	

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

				location.reload();

									

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



function abrir_standar(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	

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




function abrir_standar_pop(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7){	

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

            modal: false,

           

        });

        xobj.load(urlpantalla,{pVar1:variable1,pVar2:variable2,pVar3:variable3,pVar4:variable4,pVar5:variable5,pVar6:variable6,pVar7:variable7});

        xobj.dialog( "open" );

        return false;

    }

    fnExpLabRegReg(urlpantalla,titulopantalla,variable1,variable2,variable3,variable4,variable5,variable6,variable7);

}



function abrir_standar_archivo(urlpantalla,titulopantalla,divBody,divDialog,ancho,alto,variable1,variable2,variable3,variable4,variable5,variable6,variable7,pregf_id,form_id){	

    var data_divBody=divBody;

	var data_divDialog=divDialog;

	var data_ancho=ancho;

	var data_alto=alto;
	var data_variablepreg=pregf_id;
	var data_variableform=form_id;
	

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

				actualiza_datos(data_variableform,data_variablepreg);

									

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



function ejecuta_imp(parametro,idimp) {
window.open('impresion/imprimir.php?pa=' + parametro +'&imp='+idimp,'IMPRIMIR','width=750,height=600,scrollbars=YES');

}



function ver_formularioenpantalla(urlpantalla,titulopantalla,divBody,variable1,variable2,variable3,variable4,variable5,variable6,variable7)
{
    $("#"+divBody).load(urlpantalla,{
	pVar1:variable1,
	pVar2:variable2,
	pVar3:variable3,
	pVar4:variable4,
	pVar5:variable5,
	pVar6:variable6,
	pVar7:variable7
  },function(result){  
      
  });  
  $("#"+divBody).html("Espere un momento...");  

}

//  End -->

</script>

<script type="text/javascript">
<!--

    //queremos que esta variable sea global
    var fileExtension = "";
    //función que observa los cambios del campo file y obtiene información
function informacion_archivomult(campo)
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
		
        showMessagemult("<span class='info"+campo+"' style='padding: 10px; border-radius: 10px; background: orange; color: #fff;font-family:Verdana, Arial, Helvetica, sans-serif;text-align: center;font-size:11px;' >Peso: "+megas.toFixed(4)+" MB.</span>",campo);

}

function subir_archivomult(ncampo,table)
{
   
     var formData = new FormData($("#form_"+table)[0]);
	 formData.append("ncampo",ncampo);
	 var nombre_campo=ncampo;
        var message = ""; 
        //hacemos la petición ajax  
		
        $.ajax({
            url: 'libreria/archivo/uploadmult.php',  
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
			
                message = $("<span class='before' >Subiendo la imagen, por favor espere...</span>");
                showMessagemult(message,nombre_campo)        
            },
            //una vez finalizado correctamente
            success: function(data){
			if(data.trim()!='')
					{
                message = $("<span class='success' >La imagen ha subido correctamente.</span>");
				
				}
else
{
 message = $("<span class='success' >Por favor seleccione un archivo.</span>");
}
                showMessagemult(message,nombre_campo);
                
				
				if(data.trim()!='')
					{
				$('#'+nombre_campo).val($('#'+nombre_campo).val()+','+data.replace("\n",""));
				}
				
				ver_lista(nombre_campo,$('#'+nombre_campo).val());
				
            },
            //si ha ocurrido un error
            error: function(){
                message = $("<span class='error' >Ha ocurrido un error. Seleccione el archivo</span>");
                showMessagemult(message,nombre_campo);
            }
        });
   
   
   

}



//como la utilizamos demasiadas veces, creamos una función para 
//evitar repetición de código
function showMessagemult(message,campo){
    $(".messages"+campo).html("").show();
    $(".messages"+campo).html(message);
}
 
//comprobamos si el archivo a subir es una imagen
//para visualizarla una vez haya subido
function isImage(extension)
{
    switch(extension.toLowerCase()) 
    {
        case 'jpg': case 'gif': case 'png': case 'jpeg':
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

function borrar_img(ncampo,imgb)
{
 
  var actual=$('#'+ncampo).val();
  var nuevo='';
  nuevo=actual.replace(','+imgb.replace("\n",""),'');
  $('#'+ncampo).val(nuevo);
  
  
$(".showImage"+ncampo).load("libreria/archivo/lista_img.php",{

	nuevop:nuevo,
	ncampop:ncampo

  },function(result){  

      

  });  

  $(".showImage"+ncampo).html("Espere un momento...");  
  
   
}

function ver_lista(ncampo,lista)
{
 
 $(".showImage"+ncampo).load("libreria/archivo/lista_img.php",{

	nuevop:lista,
	ncampop:ncampo

  },function(result){  

      

  });  

  $(".showImage"+ncampo).html("Espere un momento...");  

}
//  End -->
</script>
