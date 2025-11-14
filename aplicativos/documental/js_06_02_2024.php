<script type="text/javascript">
<!--

function ver_reportedatamodulo(irep)
{
   myWindow3=window.open('director/templateforms/maestro_standar_developer/panel_developerdata.php?ireport='+irep,'ventana_reporte','width=750,height=500,scrollbars=YES');
   myWindow3.focus();

}


function ingreso_usuario_ac(funciones_siguientes)
{


  if ($('#usuario_valor_ac').val()=='')
	{

	alert('Debe llenar el Campo USUARIO:');
    return false;
	}


  if ($('#clave_valor_ac').val()=='')
	{
	alert('Debe llenar el Campo CLAVE:');
	return false;
	}


  $("#acceso_usuario_ac").load("libreria/acceso/validar_ac.php",{

    accesousuario:'<?php echo $accesousuario ?>',usuario_valor_ac:$('#usuario_valor_ac').val(),clave_valor_ac:$('#clave_valor_ac').val(),punto_id:$('#punto_id').val(),tipo_ing:$('#tipo_ing').val(),
	funciones_siguientes:funciones_siguientes


  },function(result){  

  });  

  $("#acceso_usuario_ac").html("Espere un momento...");

}



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

function activar_formulario_ac(accesousuario,tipo_ing,funciones_siguientes)
{

    $("#divBody_ingreso_ac").load("<?php echo $ap_path ?>form_ing_ac.php",{
	accesousuario_p:accesousuario,
	tipo_ingp:tipo_ing,
	funciones_siguientes:funciones_siguientes

  },function(result){  


  });  

  $("#divBody_ingreso_ac").html("Espere un momento...");  

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
        xobjPadre.append("<div id='"+data_divDialog+"'  title='"+titulopantalla+"' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px' ></div>");
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

  $("#"+divBody).html("Espere un momento <img src='images/progress/progress_1.gif' width='31' height='31' />"); 
}

///FUNCION EXTENDIDA///

function ver_formularioenpantallaextendida(urlpantalla,titulopantalla,divBody,variable1,variable2,variable3,variable4,variable5,variable6,variable7,variable8,variable9,variable10,variable11,variable12)
{
    $("#"+divBody).load(urlpantalla,{
	pVar1:variable1,
	pVar2:variable2,
	pVar3:variable3,
	pVar4:variable4,
	pVar5:variable5,
	pVar6:variable6,
	pVar7:variable7,
	pVar8:variable8,
	pVar9:variable9,
	pVar10:variable10,
	pVar11:variable11,
	pVar12:variable12
  },function(result){       

  });  

  $("#"+divBody).html("Espere un momento <img src='images/progress/progress_1.gif' width='31' height='31' />"); 
}



function ver_formularioenpantallaregresar(urlpantalla,titulopantalla,divBody,variable1,variable2,variable3,variable4,variable5,variable6,variable7,table)
{    	
	//$( "#form_"+table ).submit();			 
    ver_formularioenpantalla(urlpantalla,titulopantalla,divBody,variable1,variable2,variable3,variable4,variable5,variable6,variable7);
}



function guardar_chek(tabla,campo,id,div,clie_id)
{


var valor_obj;
valor_obj=$('input:checkbox[name=check_'+id+']:checked').val();
$("#"+div).load('aplicativos/documental/opciones/grid/cliente/guardar_chek.php',{
	tabla:tabla,
	campo:campo,
	valor:valor_obj,
	id:id,
	clie_id:clie_id,
	even_id:id
  },function(result){        

  });  

  $("#"+div).html("Espere un momento...");  

}

//  End -->
</script>



<script type="text/javascript">
<!--

   $(".messages").hide();
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



function subir_archivopath(ncampo,table,patharchivo)
{

   if(isImage2(fileExtension))
     {
     var formData = new FormData($("#form_"+table)[0]);
	 formData.append("ncampo",ncampo);
     formData.append("patharchivo",patharchivo);
	 var nombre_campo=ncampo;
        var message = ""; 
        //hacemos la peticion ajax  
        $.ajax({
            url: 'libreria/archivo/uploadfiles.php', 
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
                if(isImage2(fileExtension))
                {

					if(data.trim()!='')
					{
					  $(".showImage"+ncampo).html("&nbsp;<a href='"+patharchivo+data+"' target='_blank' class='thumbnail' ><img src='images/file.png' alt='125x125' width='32px' ></a>");
					}
                }
				else
				{
				  if(data.trim()!='')
				   {
				     $(".showImage"+ncampo).html("&nbsp;<a href='"+patharchivo+data+"' target='_blank' class='thumbnail' ><img src='images/file.png' alt='125x125' width='32px' ></a>");
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
                message = $("<span class='success' >Archivo ha subido correctamente.</span>");
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

        case 'jpg': case 'gif': case 'png': case 'jpeg': case 'pdf': case 'PDF': case 'xml': case 'XML':

            return true;

        break;

        default:

            return false;

        break;

    }

}

///para xml

function isImagexml(extension)
{

    switch(extension.toLowerCase()) 
    {

        case 'jpg': case 'gif': case 'png': case 'jpeg': case 'pdf': case 'PDF': case 'xml': case 'XML':

            return true;

        break;

        default:

            return false;

        break;

    }

}


function isImage2(extension)
{
   
    switch(extension.toLowerCase()) 
    {

        case 'xls': case 'xlsx': case 'jpg': case 'gif': case 'png': case 'jpeg': case 'pdf': case 'docx': case 'csv':

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


function enviar_formulario(table)
{

  $( "#"+table ).submit();  
  $("#verifica_sess").load("aplicativos/documental/verifica_sess.php",{
  },function(result){  
  });  
  $("#verifica_sess").html("");  
  
}

function ver_botongg()
{

  //$('#mensaje_gsistema').html('');
  //$('#mensaje_gsistema2').html('');
  
   $('#boton_guardarformdata').show();
   $('#boton_guardarformdata2').show();
}


function enviar_formulariodatadirecto(table)
{

  // if($('#tarif_numval').val()==0)
 // {
  //  alert("Por favor agrege al menos una registro en TARIFARIO");
//	return false;
  
 // }
  
  
  $('#boton_guardarformdata').hide();
  $('#boton_guardarformdata2').hide();
  //$('#mensaje_gsistema').html('<center><table width="400" border="0" align="center" cellpadding="2" cellspacing="2"><tr><td bgcolor="#77B368"><div align="center" style="color: #FFFFFF;font-weight: bold;">Espere por favor...</div></td></tr></table></center>');
  
  //$('#mensaje_gsistema2').html('<center><table width="400" border="0" align="center" cellpadding="2" cellspacing="2"><tr><td bgcolor="#77B368"><div align="center" style="color: #FFFFFF;font-weight: bold;">Espere por favor...</div></td></tr></table></center>');
  
  $( "#"+table ).submit();
  
  window.setTimeout( ver_botongg, 2000 );
  

  $("#verifica_sess").load("aplicativos/documental/verifica_sess.php",{

  },function(result){  

  });  
  $("#verifica_sess").html("");  
  
  
}


function enviar_formulariodata(table)
{

  // if($('#tarif_numval').val()==0)
 // {
  //  alert("Por favor agrege al menos una registro en TARIFARIO");
//	return false;
  
 // }
  
  if($('#diagn_numval').val()==0)
  {
    alert("Por favor agrege al menos un DIAGNOSITCO");
    return false;
  }
  
  $('#boton_guardarformdata').hide();
  $('#boton_guardarformdata2').hide();
  //$('#mensaje_gsistema').html('<center><table width="400" border="0" align="center" cellpadding="2" cellspacing="2"><tr><td bgcolor="#77B368"><div align="center" style="color: #FFFFFF;font-weight: bold;">Espere por favor...</div></td></tr></table></center>');
  
  //$('#mensaje_gsistema2').html('<center><table width="400" border="0" align="center" cellpadding="2" cellspacing="2"><tr><td bgcolor="#77B368"><div align="center" style="color: #FFFFFF;font-weight: bold;">Espere por favor...</div></td></tr></table></center>');
  
  $( "#"+table ).submit();
  
  window.setTimeout( ver_botongg, 2000 );
  

  $("#verifica_sess").load("aplicativos/documental/verifica_sess.php",{

  },function(result){  

  });  
  $("#verifica_sess").html("");  
  
  
}


function ver_formularioenpantallapreconsulta(urlpantalla,titulopantalla,divBody,variable1,variable2,variable3,variable4,variable5,variable6,variable7,variable8,variable9,variable10)
{

    $("#"+divBody).load(urlpantalla,{
	pVar1:variable1,
	pVar2:variable2,
	pVar3:variable3,
	pVar4:variable4,
	pVar5:variable5,
	pVar6:variable6,
	pVar7:variable7,
	pVar8:variable8,
	pVar9:variable9,
	pVar10:variable10

  },function(result){ 
      

  });  

  $("#"+divBody).html("Espere un momento...");

}



function guardar_unasolaves(table)
{
  $('#boton_guardardata').html('<center><table width="400" border="0" align="center" cellpadding="2" cellspacing="2"><tr><td bgcolor="#77B368"><div align="center" style="color: #FFFFFF;font-weight: bold;">Guardando Registro... Espere por favor...</div></td></tr></table></center>');
  $( "#"+table ).submit();
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



function subir_archivoxml(ncampo,table,anchot,altot,anchoor,altoor)
{

   if(isImagexml(fileExtension))
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
            url: 'libreria/archivo/uploadinv.php',  
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
                if(isImagexml(fileExtension))
                {
					if(data.trim()!='')
					{
					$(".showImage"+ncampo).html("&nbsp;<a href='archivoinv/"+data+"' target='_blank' class='thumbnail' ><img src='archivo/file.png' alt='125x125' width='70px' ></a>");				

					}
                }
				else
				{
				  if(data.trim()!='')
					{
				   $(".showImage"+ncampo).html("&nbsp;<a href='archivoinv/"+data+"' target='_blank' class='thumbnail' ><img src='archivo/file.png' alt='125x125' width='70px' ></a>");
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

function showMessage(message,campo){
    $(".messages"+campo).html("").show();
    $(".messages"+campo).html(message);
}

//  End -->
</script>